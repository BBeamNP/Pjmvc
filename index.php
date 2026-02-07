<?php
session_start();
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

require_once 'controllers/PromiseController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/PoliticianController.php';

if (!isset($_SESSION['user']) && $action !== 'login') {
    header('Location: index.php?action=login');
    exit;
}
if (
    isset($_SESSION['user']) &&
    $_SESSION['user'] === 'user' &&
    in_array($action, ['update', 'updateStatus'])
) {
    die('คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
}

switch ($action) {
    case 'login':
        (new AuthController())->login();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'detail':
        (new PromiseController())->detail($id);
        break;
    case 'update':
        (new PromiseController())->addUpdate($id);
        break;
    case 'politician':
        (new PoliticianController())->show($id);
        break;
    case 'updateStatus':
        (new PromiseController())->updateStatus($id);
        break;
    default:
        (new PromiseController())->index();
}
?>