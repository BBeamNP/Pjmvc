<?php
class CsvHelper {
    public static function read($file) {
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);
        return array_map(fn($r)=>array_combine($header,$r), $rows);
    }
    public static function append($file, $data) {
        $f = fopen($file,'a');
        fputcsv($f,$data);
        fclose($f);
    }
}
?>