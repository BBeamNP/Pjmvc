<?php
require_once 'models/Promise.php';
require_once 'models/PromiseUpdate.php';

class PromiseController
{
    public function index()
    {
        $promises = (new Promise())->getAllSorted();

        include 'views/promises/index.php';
    }
    public function detail($id)
    {
        $promise = (new Promise())->findById($id);
        $updates = (new PromiseUpdate())->getByPromiseId($id);
        $promiseModel = new Promise();
        $updateModel = new PromiseUpdate();

        $politicianModel = new Politician();
        $promise = $promiseModel->findById($id);
        $updates = $updateModel->getByPromiseId($id);
        $politician = $politicianModel->findById($promise['politician_id']);
        include 'views/promises/detail.php';
    }
    public function addUpdate($id)
    {

        if ($_SESSION['user'] !== 'admin') {
            die('เฉพาะ admin เท่านั้นที่อัปเดตข้อมูลได้');
        }

        $promise = (new Promise())->findById($id);

        if ($promise['status'] === 'เงียบหาย') {
            die('ไม่สามารถอัปเดตคำสัญญาที่เงียบหายได้');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new PromiseUpdate())->add($id, $_POST['detail']);
            header("Location: index.php?action=detail&id=$id");
            exit;
        }

        include 'views/promises/update.php';
    }


    public function updateStatus($id)
    {

        if ($_SESSION['user'] !== 'admin') {
            die('คุณไม่มีสิทธิ์แก้ไขสถานะ');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new Promise())->updateStatus($id, $_POST['status']);
            header("Location: index.php?action=detail&id=$id");
            exit;
        }
    }


}

?>