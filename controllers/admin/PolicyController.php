<?php
class PolicyController
{
    public $model;
    public function __construct()
    {
        requireAdmin();
        $this->model = new PolicyModel();
    }
    // list danh sách khách hàng
    public function index()
    {
        $policies = $this->model->getAll();
        require_once "./views/admin/policies/index.php";
    }
    // chi tiết chính sách
    public function detail()
    {
        $id = $_GET['id'];
        $policy = $this->model->getByID($id);
        // dd($policy);
        require_once "./views/admin/policies/detail.php";
    }

    // xoá chính sách
    public function delete()
    {
        $id = $_GET['id'];

        // Kiểm tra xem policy có đang được sử dụng không
        if ($this->model->isUsedInTours($id)) {
            Message::set("error", "Không thể xóa chính sách này vì đang được sử dụng trong tour!");
            redirect("policies");
            die();
        }

        $this->model->delete($id);
        Message::set("success", "Xóa thành công!");
        redirect("policies");
        die();
    }
    // sửa chính sách
    
}
