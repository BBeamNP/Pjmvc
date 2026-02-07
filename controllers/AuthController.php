<?php
class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['username'] === 'admin' && $_POST['password'] === '1234') {
                $_SESSION['user'] = 'admin';
                header('Location: index.php');
            }
            if ($_POST['username'] === 'user' && $_POST['password'] === '0000') {
                $_SESSION['user'] = 'user';
                header('Location: index.php');
            }

        }
        include 'views/login.php';
    }
    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>