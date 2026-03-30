<?php

class ServiceController
{
    private $serviceModel;
    private $supplierModel;
    private $serviceTypeModel;

    public function __construct()
    {
        requireAdmin(); // Kiểm tra quyền admin trước khi dùng controller
        $this->serviceModel = new ServiceModel();
        $this->supplierModel = new SupplierModel();
        $this->serviceTypeModel = new ServiceTypeModel();
    }

    public function index()
    {
        $keyword = $_GET['keyword'] ?? ''; // Lọc theo từ khóa tìm kiếm
        $type = $_GET['service_type_id'] ?? ''; // Lọc theo loại dịch vụ
        $supplier = $_GET['supplier_id'] ?? ''; // Lọc theo nhà cung cấp

        $services = $this->serviceModel->getAll($keyword, $type, $supplier); // Lấy danh sách có lọc
        $serviceTypes = $this->serviceTypeModel->getAll();
        $suppliers = $this->supplierModel->getAll();

        require_once './views/admin/services/index.php';
    }

    
}
