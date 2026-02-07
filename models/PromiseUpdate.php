<?php
require_once 'helpers/CsvHelper.php';
class PromiseUpdate {
    private $file = 'data/promise_updates.csv';
    public function getByPromiseId($id) {
        return array_filter(CsvHelper::read($this->file), fn($r)=>$r['promise_id']===$id);
    }
    public function add($id, $detail) {
        CsvHelper::append($this->file, [$id, date('Y-m-d'), $detail]);
    }
}
?>