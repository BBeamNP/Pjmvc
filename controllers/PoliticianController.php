<?php
require_once 'models/Politician.php';
require_once 'models/Promise.php';

class PoliticianController {
    public function show($id) {
        $politician = (new Politician())->findById($id);
        $promises = (new Promise())->getByPolitician($id);
        include 'views/politicians/show.php';
    }
}
?>