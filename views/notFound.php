<?php
$currentUser = $_SESSION['currentUser'] ?? null;
$fullname = $currentUser['fullname'] ?? 'User';
$role = ($currentUser['role_id'] ?? 0) == 1 ? 'Admin' : 'Hướng dẫn viên';
$avatar = strtoupper(mb_substr($fullname, 0, 1));
?>

<!DOCTYPE html>
<html lang="vi" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Không tìm thấy trang | Tour Manager</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="<?= BASE_URL ?>assets/common.js"></script>
</head>

<body>

  

  <!-- Animation CSS (giữ nguyên + thêm hiệu ứng nền cam nhẹ) -->
  <style>
    @keyframes float {

      0%,
      100% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }
    }

    @keyframes ping-slow {

      0%,
      100% {
        opacity: 0.4;
        transform: scale(1);
      }

      50% {
        opacity: 0.15;
        transform: scale(1.2);
      }
    }

    @keyframes fade-in-up {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-float {
      animation: float 7s ease-in-out infinite;
    }

    .animate-ping-slow {
      animation: ping-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.9s ease-out forwards;
    }

    .animate-fade-in {
      animation: fade-in-up 0.8s ease-out forwards;
    }

    .animation-delay-300 {
      animation-delay: 300ms;
    }

    .animation-delay-700 {
      animation-delay: 700ms;
    }

    .animation-delay-1000 {
      animation-delay: 1000ms;
    }

    .animation-delay-1500 {
      animation-delay: 1500ms;
    }
  </style>

  <?php require_once './views/components/footer.php'; ?>