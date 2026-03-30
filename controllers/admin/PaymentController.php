<?php

class PaymentController
{
    public $paymentModel;
    public $bookingModel;

    public function __construct()
    {
        requireAdmin(); // Bắt buộc admin mới được dùng controller này
        $this->paymentModel = new PaymentModel(); // Model xử lý thanh toán
        $this->bookingModel = new BookingModel(); // Model booking để cập nhật trạng thái booking
    }

    // Hiển thị danh sách thanh toán của 1 booking
    public function index()
    {
        $booking_id = $_GET['booking_id']; // Lấy booking_id từ URL
        $payments = $this->paymentModel->getAllByBooking($booking_id); // Lấy tất cả payment của booking

        require_once './views/admin/payments/list.php'; // Load view
    }

    // Hiển thị form tạo thanh toán
    public function create()
    {
        $booking_id = $_GET['booking_id'];

        // Lấy thông tin booking
        $booking = $this->bookingModel->getById($booking_id);

        // Ngăn thêm payment cho booking đã completed
        if ($booking['status'] === 'completed') {
            Message::set('error', 'Không thể thêm thanh toán cho booking đã hoàn thành');
            header("Location: " . BASE_URL . "?act=booking-detail&id=$booking_id&tab=payments");
            exit();
        }

        // Tính tổng đã thanh toán
        $totalPaid = $this->bookingModel->getTotalPaid($booking_id);

        // Tính số tiền còn lại
        $remaining = $booking['total_amount'] - $totalPaid;

        require_once './views/admin/payments/create.php';
    }

    // Lưu thanh toán mới
    public function store()
    {
        // Validation
        $errors = [];

        // Nếu chuyển khoản thì bắt buộc có mã giao dịch
        if ($_POST['payment_method'] === 'bank_transfer' && empty($_POST['transaction_code'])) {
            $errors[] = 'Vui lòng nhập mã giao dịch cho chuyển khoản';
        }

        // Xử lý upload file
        $receiptFile = null;
        if (isset($_FILES['receipt_file']) && $_FILES['receipt_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/receipts/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
            $fileType = $_FILES['receipt_file']['type'];

            if (!in_array($fileType, $allowedTypes)) {
                $errors[] = 'Chỉ chấp nhận file JPG, PNG hoặc PDF';
            }

            if ($_FILES['receipt_file']['size'] > 5 * 1024 * 1024) {
                $errors[] = 'File không được vượt quá 5MB';
            }

            if (empty($errors)) {
                $fileName = time() . '_' . basename($_FILES['receipt_file']['name']);
                if (move_uploaded_file($_FILES['receipt_file']['tmp_name'], $uploadDir . $fileName)) {
                    $receiptFile = $fileName;
                } else {
                    $errors[] = 'Lỗi khi upload file';
                }
            }
        }
    }
}
