<?php
session_start();
require_once '../models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userModel = new UserModel();
    $user = $userModel->login($email);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            if ($user['role'] === 'admin') {
                header("Location: ../views/admin/home.php");
            } elseif ($user['role'] === 'customer') {
                header("Location: ../views/customer/home.php");
            }
            exit();
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Password salah'
            ];

            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Email tidak terdaftar'
        ];

        header("Location: ../index.php");
        exit();
    }
}
