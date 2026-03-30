<?php
class CustomerController
{
    public $model;
    public function __construct()
    {
        requireAdmin(); // Gọi hàm kiểm tra xem có phải admin không
        $this->model = new CustomerModel(); // Khởi tạo model khách hàng
    }

    //list danh sách khách hàng
    public function index()
    {
        // Lấy dữ liệu tìm kiếm từ URL (nếu không có thì để rỗng)
        $search = $_GET['search'] ?? '';

        // Gọi model để lọc khách hàng
        $listCustomers = $this->model->filter(
            $search,
        );

        // Lấy toàn bộ khách hàng
        $customers = $this->model->getAll();

        // Gọi view hiển thị danh sách
        require_once "./views/admin/customers/index.php";
    }

    public function detail()
    {
        $id = $_GET['id']; // Lấy id khách hàng từ URL
        $customer = $this->model->getByID($id); // Lấy chi tiết khách hàng
        require_once "./views/admin/customers/detail.php";
    }

    public function delete()
    {
        $id = $_GET['id']; // Lấy id từ URL
        $this->model->delete($id); // Xóa khách hàng
        redirect("customers"); // Quay về danh sách
        Message::set("success", "Xóa thành công!"); // Gửi thông báo
        die();
    }

    public function edit()
    {
        $id = $_GET['id']; // Lấy ID
        $customer = $this->model->getByID($id); // Lấy dữ liệu khách hàng để hiển thị lên form
        require_once "./views/admin/customers/edit.php";
    }

    // Thêm mới khách hàng
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Kiểm tra xem có submit form không
            // Lấy dữ liệu từ form
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'passport' => trim($_POST['passport'] ?? ''),
                'gender' => trim($_POST['gender'] ?? 'other'),
                'citizen_id' => trim($_POST['citizen_id'] ?? ''),
            ];
            $created_by = $_SESSION['currentUser']['id'] ?? 1; // Lấy ID người tạo

            // Rules validate dữ liệu
            $rules = [
                'name' => 'required|min:2|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'required|phone',
                'address' => 'required|min:5|max:255',
                'gender' => 'required',
            ];

            // Thực hiện validate
            $errors = validate($data, $rules);

            // Nếu có lỗi → giữ lại dữ liệu + hiện lại form
            if (!empty($errors)) {
                $_SESSION['validate_errors'] = $errors;
                $_SESSION['old'] = $data;
                redirect("customer-create");
                return;
            }

            // Kiểm tra trùng email hoặc số điện thoại
            $existingCustomer = $this->model->findByEmailOrPhone($data['email'], $data['phone']);
            if ($existingCustomer) {
                Message::set('error', 'Email hoặc số điện thoại đã tồn tại!');
                $_SESSION['old'] = $data;
                redirect("customer-create");
                return;
            }

            // Gọi model để thêm khách hàng
            $this->model->create($data['name'], $data['email'], $data['phone'], $data['address'], $created_by, $data['passport'], $data['gender'], $data['citizen_id']);
            Message::set("success", "Thêm khách hàng thành công!");
            redirect("customers");
            die();
        } else {
            // Hiện form thêm mới
            require_once "./views/admin/customers/create.php";
        }
    }

    // Cập nhật thông tin khách hàng
    
}
