<?php
session_start();
require_once '../models/UserModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = 'customer';
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Konfirmasi password tidak sama";
        exit;
    }

    $userModel = new UserModel();

    $userModel->register($name, $email, $role, $password);

    $user = $userModel->login($email);

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];

        header("Location: ../views/customer/home.php");
        exit;
    }
}
?>
