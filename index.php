<?php 
/* SINIFIMIZI DAHİL ETTİK */
require_once 'crud.class.php';
/* SINIFIMIZI KULLANABİLMEK İÇİN YENİ BİR NESNE TÜRETTİK... */
$app = new PhpYardimlasmaGrubu;
/* KOŞULSUZ SELECT 
$sql = "SELECT * FROM products";
$request = $app->pdoQueryMultiple($sql);
var_dump($request);
*/

/* KOŞULLU SELECT 
$sql = "SELECT * FROM ch_test_table WHERE id =:id";
$args = $app->getSecurity(['id' => '1']);
$request = $app->pdoPrepareSingle($sql, $params);
var_dump($request);
*/
