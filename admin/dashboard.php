<?php
session_start();
if($_SESSION['level'] !='3'){

	header('location:index.php');

}

require('../class/C_profile_admin.php');

$admin = new C_Admin;
$id = $_SESSION['IdMember'];
$data = $admin->getProfile($id);
require_once('../template/header.php');

;?>