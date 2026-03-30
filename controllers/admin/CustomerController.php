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

    
}
