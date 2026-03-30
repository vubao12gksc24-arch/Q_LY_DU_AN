<?php
class SupplierController
{
    public $supplierModel;
    public $destinationModel;
    public $userModel;
    public $serviceModel;

    public function __construct()
    {
        // Chỉ admin mới truy cập được controller này
        requireAdmin();

        // Khởi tạo các model dùng trong controller
        $this->supplierModel = new SupplierModel();
        $this->destinationModel = new DestinationModel();
        $this->userModel = new UserModel();
        $this->serviceModel = new ServiceModel();
    }

    // Hiển thị danh sách nhà cung cấp
    public function index()
    {
        // Lấy toàn bộ nhà cung cấp
        $suppliers = $this->supplierModel->getALL();

        // Lấy danh sách điểm đến (hiện thị trong filter hoặc bảng)
        $destinations = $this->destinationModel->getALL();

        // Load view danh sách
        require_once "./views/admin/suppliers/index.php";
    }

}