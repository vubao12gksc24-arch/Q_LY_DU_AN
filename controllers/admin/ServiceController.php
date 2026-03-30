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

    public function detail($id = null)
    {
        $id = $id ?? $_GET['id'] ?? 0; // Ưu tiên id truyền vào controller → sau đó lấy từ url

        if (!is_numeric($id) || $id <= 0) { // Chặn id không hợp lệ
            Message::set("error", "ID không hợp lệ!");
            redirect("service");
            exit;
        }

        $service = $this->serviceModel->getDetail($id); // Lấy thông tin chi tiết dịch vụ

        if (!$service) { // Không tồn tại trong DB
            Message::set("error", "Dịch vụ không tồn tại!");
            redirect("service");
            exit;
        }

        require_once './views/admin/services/detail.php';
    }

    public function delete($id = null)
    {
        $id = $id ?? $_GET['id'] ?? 0;

        if (!is_numeric($id) || $id <= 0) { // Chặn id lỗi
            Message::set("error", "ID không hợp lệ!");
            redirect("service");
            exit;
        }

        if ($this->serviceModel->delete($id)) { // Xóa trong DB
            Message::set("success", "Xóa dịch vụ thành công!");
        } else {
            Message::set("error", "Xóa dịch vụ thất bại!");
        }

        redirect("service");
    }

    public function create()
    {
        $serviceTypes = $this->serviceTypeModel->getAll();
        $suppliers = $this->supplierModel->getAll();

        require_once './views/admin/services/create.php';
    }

    
}
