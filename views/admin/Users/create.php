<?php
require_once './views/components/header.php';
require_once './views/components/sidebar.php';
?>

<main class="mt-24 p-6 min-h-screen bg-gray-50 font-sans">
  <!-- Breadcrumb -->
  <div class="mb-8">
    <div class="flex items-center gap-3 text-sm mb-4">
      <a href="?act=user" class="text-gray-600 hover:text-orange-600 flex items-center gap-2">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Quay lại
      </a>
      <span class="text-gray-400">/</span>
      <span class="text-gray-900 font-medium">Thêm nhân viên mới</span>
    </div>
    <h1 class="text-3xl font-medium text-gray-900">Thêm nhân viên mới</h1>
    <p class="text-gray-600 mt-2">Điền thông tin để tạo tài khoản nhân viên mới</p>
  </div>

  


<?php require_once './views/components/footer.php'; ?>