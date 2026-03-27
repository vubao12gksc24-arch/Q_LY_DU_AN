<?php
class BookingController
{
    public $bookingModel;
    public $tourModel;
    public $customerModel;
    public $serviceModel;
    public $contractModel;
    public $paymentModel;
    public $checkinModel;
    public $journalModel;


    public function __construct()
    {
        requireAdmin();
        $this->bookingModel = new BookingModel();
        $this->tourModel = new TourModel();
        $this->customerModel = new CustomerModel();
        $this->serviceModel = new ServiceModel();
        $this->contractModel = new ContractModel();
        $this->paymentModel = new PaymentModel();
        $this->checkinModel = new CheckinModel();
        $this->journalModel = new JournalModel();
    }

    // Hiển thị danh sách booking
    public function index()
    {
        $filters = [
            'keyword' => $_GET['keyword'] ?? '',
            'status' => $_GET['status'] ?? '',
            'date_from' => $_GET['date_from'] ?? '',
            'date_to' => $_GET['date_to'] ?? ''
        ];
        // Lấy danh sách booking từ model với bộ lọc
        $bookings = $this->bookingModel->getAll($filters);
        foreach ($bookings as $booking) {
            if (
                $booking['end_date'] < date('Y-m-d') &&
                in_array($booking['status'], ['paid', 'in_progress', 'deposited'])
            ) {
                $this->bookingModel->updateStatus($booking['id'], 'completed');
                $booking['status'] = 'completed';
            }
        }
        $bookings = $this->bookingModel->getAll($filters);
        require_once './views/admin/bookings/index.php';
    }
}