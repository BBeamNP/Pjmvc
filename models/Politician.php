<?php
require_once 'helpers/CsvHelper.php';
class Politician {
    private $file = 'data/politicians.csv';
    public function findById($id) {
        foreach (CsvHelper::read($this->file) as $r) if ($r['politician_id']===$id) return $r;
    }
}
?>