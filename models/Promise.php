<?php
require_once 'helpers/CsvHelper.php';
class Promise {
    private $file = 'data/promises.csv';
    public function getAll() {
        return CsvHelper::read($this->file);
    }
    public function findById($id) {
        foreach ($this->getAll() as $row) if ($row['promise_id']===$id) return $row;
    }
    public function getByPolitician($pid) {
        return array_filter($this->getAll(), fn($r)=>$r['politician_id']===$pid);
    }
    public function updateStatus($id, $newStatus) {
    $rows = array_map('str_getcsv', file($this->file));
    $header = array_shift($rows);

    foreach ($rows as &$row) {
        if ($row[0] === $id) { // promise_id
            $row[4] = $newStatus; // status
        }
    }

    $f = fopen($this->file, 'w');
    fputcsv($f, $header);
    foreach ($rows as $row) {
        fputcsv($f, $row);
    }
    fclose($f);
}
public function getAllSorted() {
    $promises = CsvHelper::read($this->file);
    $updates = CsvHelper::read('data/promise_updates.csv');
    $politicians = CsvHelper::read('data/politicians.csv');

    // map politician_id → party
    $partyMap = [];
    foreach ($politicians as $p) {
        $partyMap[$p['politician_id']] = $p['party'];
    }

    // หา "วันที่แก้ไขล่าสุด" ของแต่ละ promise
    foreach ($promises as &$promise) {
        $latestDate = $promise['announce_date'];

        foreach ($updates as $u) {
            if ($u['promise_id'] === $promise['promise_id']) {
                if ($u['update_date'] > $latestDate) {
                    $latestDate = $u['update_date'];
                }
            }
        }

        $promise['last_update'] = $latestDate;
        $promise['party'] = $partyMap[$promise['politician_id']] ?? '';
    }

    // sort: วันที่ล่าสุด DESC → ชื่อพรรค ASC
    usort($promises, function ($a, $b) {
        if ($a['last_update'] === $b['last_update']) {
            return strcmp($a['party'], $b['party']);
        }
        return strcmp($b['last_update'], $a['last_update']);
    });

    return $promises;
}


}

?>