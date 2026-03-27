<?php
session_start();
$act = $_GET['act'] ?? '/';

if ($act !== 'login'  && $act !== 'check-login' && $act !== 'logout') {
  checkLogin();
}

match ($act) {
  // Admin Dashboard
  '/' => (new DashboardController())->Dashboard(),

};
