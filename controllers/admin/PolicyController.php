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
    
}
