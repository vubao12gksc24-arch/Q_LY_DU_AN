<?php
class NotificationController
{
  public $notificationModel;

  public function __construct()
  {
    checkLogin();
    $this->notificationModel = new NotificationModel();
  }

  // Danh sách thông báo
  public function index()
  {
    requireAdmin();
    $notifications = $this->notificationModel->getAll();
    $totalNotifications = $this->notificationModel->getTotalNotifications();

    require_once './views/admin/notifications/index.php';
  }

  // Form tạo thông báo mới
  
}