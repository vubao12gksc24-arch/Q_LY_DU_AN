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

    
}
