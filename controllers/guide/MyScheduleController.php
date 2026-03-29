<?php
class MyScheduleController
{
    public $bookingModel;
    public $tourAssignmentModel;

    public function __construct()
    {
        $this->bookingModel  = new BookingModel();
        $this->tourAssignmentModel = new TourAssignmentModel();
    }

    //   Trang lịch của guide / admin
    public function index()
    {
        $user = $_SESSION['currentUser'];
        $guideId = $user['id'];
        $today = date('Y-m-d');

        // 2. Lấy tất cả tour được phân công cho guide
        $assignments = $this->tourAssignmentModel->getGuideSchedule($guideId);

        $currentTours = [];
        $upcomingTours = [];

        // 3. Tính tổng ngày và ngày hiện tại của từng tour
        foreach ($assignments as $a) {
            // Tính tổng số ngày tour
            $a['total_days']   = calculateTotalDays($a['start_date'], $a['end_date']);
            // Tính ngày hiện tại
            $a['current_day']  = getCurrentDay($a['start_date'], $a['end_date']);

            // 4. Phân loại tour theo ngày
            if ($a['start_date'] <= $today && $a['end_date'] >= $today) {
                $currentTours[] = $a;
            } elseif ($a['start_date'] > $today) {
                $upcomingTours[] = $a;
            }
        }

        // Thống kê tổng số tour
        $totalAssignedTours = count($assignments);

        // Lấy danh sách khách hàng của tour hiện tại đầu tiên (nếu có)
        $customers = [];
        if (!empty($currentTours)) {
            $bookingId = $currentTours[0]['booking_id'];
            $customers = $this->bookingModel->getCustomers($bookingId);
        }
        $role = 'guide'; // biến phân biệt giao diện
        $userName = $_SESSION['currentUser']['roles'] ?? 'Hướng dẫn viên';

        // Truyền dữ liệu sang view
        require_once './views/guide/my_schedule.php';
    }

    // Trang chi tiết
    
}