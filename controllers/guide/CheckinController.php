<?php
class CheckinController
{
  public $checkinModel;
  public $bookingModel;

  public function __construct()
  {
    $this->checkinModel = new CheckinModel();
    $this->bookingModel = new BookingModel();
  }

  // Hiển thị chi tiết đợt check-in và danh sách khách
  public function detail()
  {
    $linkId = $_GET['link_id'] ?? null;
    $assignmentId = $_GET['assignment_id'] ?? null;
    $customers = $this->checkinModel->getCustomersWithCheckinStatus($assignmentId, $linkId);
    $checkinLink = $this->checkinModel->getCheckinLink($linkId, $assignmentId);
    if (!$linkId || !$assignmentId) {
      Message::set('error', 'Thiếu thông tin');
      redirect('my-schedule');
      exit;
    }
    if (!$checkinLink) {
      Message::set('error', 'Không tìm thấy đợt check-in');
      redirect('my-schedule');
      exit;
    }
    require './views/guide/checkin/detail.php';
  }
}
?>