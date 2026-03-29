<?php
class GuideTourAssignmentController
{
    public $assignmentModel;
    public $bookingModel;
    public $customerModel;
    public $serviceModel;
    public $tourModel;
    public $checkinModel;


    public function __construct()
    {
        $this->assignmentModel = new TourAssignmentModel();
        $this->bookingModel = new BookingModel();
        $this->customerModel = new CustomerModel();
        $this->serviceModel = new ServiceModel();
        $this->tourModel = new TourModel();
        $this->checkinModel = new CheckinModel();
    }

    // danh sách tour của guide
    public function index()
    {
        checkLogin();
        $guideId = $_SESSION['currentUser']['id'];

        // Tab trạng thái
        $status_tab = $_GET['status'] ?? 'upcoming';

        // Lấy tất cả assignment
        $allAssignments = $this->assignmentModel->getAssignmentsByGuide($guideId);

        $today = date('Y-m-d');
        $assignments = [];
        $upcomingCount = $ongoingCount = $completedCount = 0;

        foreach ($allAssignments as $a) {
            if ($a['end_date'] < $today) {
                $a['status'] = 'completed';
                $completedCount++;
            } elseif ($a['start_date'] <= $today && $a['end_date'] >= $today) {
                $a['status'] = 'ongoing';
                $ongoingCount++;
            } else {
                $a['status'] = 'upcoming';
                $upcomingCount++;
            }

            if ($a['status'] === $status_tab) {
                $assignments[] = $a;
            }
        }

        require_once './views/guide/tour-assignments/index.php';
    }

    
}
