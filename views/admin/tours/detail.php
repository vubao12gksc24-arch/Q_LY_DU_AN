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
      <span class="text-gray-900 font-medium">Chi tiết nhân viên</span>
    </div>
    <h1 class="text-3xl font-medium text-gray-900">Chi tiết nhân viên</h1>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Left Column - Avatar & Info -->
    <div class="bg-white rounded-lg border border-gray-200 p-8">
      <div class="flex items-center gap-6 mb-8">
        <!-- Avatar lớn -->
        <div class="w-40 h-40 rounded-lg bg-blue-100 flex items-center justify-center overflow-hidden flex-shrink-0">
          <?php if (!empty($user['avatar'])): ?>
            <img src="/uploads/avatar/<?= $user['avatar'] ?>" alt="Avatar" class="w-full h-full object-cover">
          <?php else: ?>
            <span class="text-6xl font-bold text-blue-600"><?= strtoupper(substr($user['fullname'], 0, 1)) ?></span>
          <?php endif; ?>
        </div>

        <!-- Info bên cạnh avatar -->
        <div class="flex-1">
          <h2 class="text-2xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($user["fullname"]) ?></h2>

          <!-- Role Badge -->
          <div class="mb-3">
            <?php if ($user["roles"] == 'admin'): ?>
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg bg-pink-100 text-pink-800">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
                Admin
              </span>
            <?php else: ?>
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg bg-blue-100 text-blue-800">
                <i data-lucide="user" class="w-4 h-4"></i>
                Hướng dẫn viên
              </span>
            <?php endif; ?>
          </div>

          <!-- Status Badge -->
          <div>
            <?php if ($user['status'] == 1): ?>
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg bg-green-100 text-green-800">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                Đang hoạt động
              </span>
            <?php else: ?>
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg bg-gray-100 text-gray-800">
                <i data-lucide="x-circle" class="w-4 h-4"></i>
                Tạm dừng
              </span>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Thông tin cá nhân theo hàng ngang -->