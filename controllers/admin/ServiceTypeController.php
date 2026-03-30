<?php
class ServiceTypeController
{
    public $serviceTypeModel;
    public $serviceModel;

    public function __construct()
    {
        requireAdmin();
        $this->serviceTypeModel = new ServiceTypeModel();
        $this->serviceModel = new ServiceModel(); // để check services liên quan khi xóa
    }

    // Trang danh sách + form thêm
    public function index()
    {
        $search = $_GET['search'] ?? null;
        $serviceTypes = $search ? $this->serviceTypeModel->search($search) : $this->serviceTypeModel->getAll();

        $data = $_POST ?? [];
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);

        require_once './views/admin/service-type/index.php';
    }

    
}
