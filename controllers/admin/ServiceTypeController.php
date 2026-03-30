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

    public function store()
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];

        // Validate
        $errors = validate($data, [
            'name' => 'required|min:2|max:100',
            'description' => 'max:255'
        ]);

        // Kiểm tra trùng tên
        if (empty($errors) && $this->serviceTypeModel->existsByName($data['name'])) {
            $errors['name'][] = "Loại dịch vụ '{$data['name']}' đã tồn tại.";
        }

        // Nếu lỗi → quay lại form + hiện lỗi
        if (!empty($errors)) {
            $serviceTypes = $this->serviceTypeModel->getAll();
            require_once './views/admin/service-type/index.php';
            return;
        }

        // Người tạo
        $created_by = $_SESSION['currentUser']['id'] ?? 1;

        // Gọi model thêm dữ liệu
        $result = $this->serviceTypeModel->create(
            $data['name'],
            $data['description'],
            $created_by
        );

        if ($result) {
            Message::set('success', "Thêm loại dịch vụ thành công!");
        } else {
            Message::set('error', "Thêm loại dịch vụ thất bại. Vui lòng thử lại!");
        }

        // Điều hướng
        redirect('service-type');
        exit;
    }


    // Form edit
    
}
