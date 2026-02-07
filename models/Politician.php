<?php
require_once 'helpers/CsvHelper.php';
class Politician {
    private $file = 'data/politicians.csv';
    public function findById($id) {
        foreach (CsvHelper::read($this->file) as $r) if ($r['politician_id']===$id) return $r;
    }
    public function getAllPoliticians() {
    $rows = array_map('str_getcsv', file('data/politicians.csv'));
    return $rows;
}
public function getPromisesByPolitician($politicianId) {
    $rows = array_map('str_getcsv', file('data/promises.csv'));
    $result = [];

    foreach ($rows as $i => $row) {
        if ($i === 0) continue; 

        if (trim($row[1]) == trim($politicianId)) {
            $result[] = $row;
        }
    }

    return $result;
}


}
?>