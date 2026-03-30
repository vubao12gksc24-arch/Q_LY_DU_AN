<?php
class TourController
{
  public $tourModel;
  public $policyModel;
  public $categoryModel;
  public $destinationModel;
  public $serviceModel;

  public function __construct()
  {
    requireAdmin();
    $this->tourModel = new TourModel();
    $this->policyModel = new PolicyModel();
    $this->categoryModel = new CategoryModel();
    $this->destinationModel = new DestinationModel();
    $this->serviceModel = new ServiceModel();
  }

  public function index()
  {
    // Lấy filter parameters từ GET
    $filters = [
      'name' => $_GET['name'] ?? '',
      'category_id' => $_GET['category_id'] ?? '',
      'status' => $_GET['status'] ?? '',
      'is_fixed' => $_GET['is_fixed'] ?? '',
      'duration' => $_GET['duration'] ?? '',
      'destination_id' => $_GET['destination_id'] ?? '',
      'min_price' => $_GET['min_price'] ?? '',
      'max_price' => $_GET['max_price'] ?? '',
    ];

    // Lấy tours với filter
    $tours = $this->tourModel->getAll($filters);

    // Lấy data cho dropdowns
    $categories = $this->categoryModel->getAll();
    $destinations = $this->destinationModel->getAll();

    // Tính giá min/max để set slider range
    $priceRange = $this->tourModel->getPriceRange();

    require_once './views/admin/tours/index.php';
  }
public function create()
  {
    $policies = $this->policyModel->getAll();
    $categories = $this->categoryModel->getAll();
    $destinations = $this->destinationModel->getAll();
    $services = $this->serviceModel->getAll();
    $tree = buildTree($categories);
    require_once './views/admin/tours/create.php';
  }

  
  
}