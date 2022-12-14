<?php 
/* SINIFIMIZI DAHİL ETTİK */
require_once 'crud.class.php';
/* SINIFIMIZI KULLANABİLMEK İÇİN YENİ BİR NESNE TÜRETTİK... */
$app = new PhpYardimlasmaGrubu;

// $sql = "SELECT * FROM ch_test_table";
// $request = $app->pdoMultipleSelect($sql);
// var_dump($request);

$sql = "SELECT * FROM ch_test_table WHERE id =:id";
$params = ['id' => '2'];
$request = $app->pdoSelect($sql, $params);
var_dump($request);