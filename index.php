<?php 
//sınıfımızı sayfaya dahil ettik
require_once 'crud.class.php';

/* sınıfımızı kullanabilmek için değişkene atadık
$app = new PhpYardimlasmaGrubu;

/* tablodaki bütün verilerimizi getirdik
$sql = "SELECT * FROM products";
$request = $app->pdoQueryMultiple($sql);
var_dump($request);
*/

/* id ye göre 1 satır veri getirdik  id değerini post veya get ile alıyorsak getSecurity fonksiyonu ile güvene alıyoruz
$sql = "SELECT * FROM products WHERE id =:id";
$args = $app->getSecurity(['id' => '1']);
$request = $app->pdoPrepareSingle($sql, $params);
var_dump($request);
*/
