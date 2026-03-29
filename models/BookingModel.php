<?php
class BookingModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy danh sách booking (có hỗ trợ lọc)
    public function getAll($filters = [])
    {
        try {
            $sql = "SELECT DISTINCT b.*, t.name AS tour_name, u.fullname as guide_name,
                       (SELECT c2.name FROM customers c2 
                        JOIN booking_customers bc2 ON c2.id = bc2.customer_id 
                        WHERE bc2.booking_id = b.id AND bc2.is_representative = 1 LIMIT 1) as representative_name
                    FROM bookings b
                    LEFT JOIN tours t ON t.id = b.tour_id
                    LEFT JOIN tour_assignments ta ON ta.booking_id = b.id
                    LEFT JOIN users u ON u.id = ta.guide_id
                    LEFT JOIN booking_customers bc ON bc.booking_id = b.id
                    LEFT JOIN customers c ON c.id = bc.customer_id
                    WHERE 1=1";

            $params = [];

            if (!empty($filters['keyword'])) {
                $keyword = '%' . $filters['keyword'] . '%';
                $sql .= " AND (b.booking_code LIKE ? OR t.name LIKE ? OR c.name LIKE ?)";
                $params[] = $keyword;
                $params[] = $keyword;
                $params[] = $keyword;
            }

            if (!empty($filters['status'])) {
                $sql .= " AND b.status = ?";
                $params[] = $filters['status'];
            }

            if (!empty($filters['date_from'])) {
                $sql .= " AND b.start_date >= ?";
                $params[] = $filters['date_from'];
            }

            if (!empty($filters['date_to'])) {
                $sql .= " AND b.start_date <= ?";
                $params[] = $filters['date_to'];
            }

            $sql .= " ORDER BY b.id DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Lỗi getAll():" . $e->getMessage());
        }
    }

    // Lấy booking theo id
    public function getById($id)
    {
        try {
            $sql = "SELECT b.*, t.name AS tour_name
                FROM bookings b
                LEFT JOIN tours t ON t.id = b.tour_id
                WHERE b.id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $booking = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($booking) {
                // Auto-update nếu tour đã kết thúc
                if (
                    $booking['end_date'] < date('Y-m-d') &&
                    in_array($booking['status'], ['paid', 'in_progress', 'deposited'])
                ) {
                    $this->updateStatus($id, 'completed');
                    $booking['status'] = 'completed';
                }

                $booking['customers'] = $this->getCustomers($id);
                // --- Lấy người đại diện ---
                $rep = array_filter($booking['customers'], fn($c) => $c['is_representative'] == 1);
                $booking['is_representative'] = $rep ? array_values($rep)[0]['id'] : null;

                $booking['services'] = $this->getServices($id);
            }

            return $booking;
        } catch (PDOException $e) {
            die("Lỗi getById():" . $e->getMessage());
        }
    }

    
}
