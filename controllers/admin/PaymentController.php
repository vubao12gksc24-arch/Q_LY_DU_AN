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

    
}