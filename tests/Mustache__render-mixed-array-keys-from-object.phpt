--TEST--
Mustache::render() member function - mixed array keys from object
--SKIPIF--
<?php 

if(!extension_loaded('mustache')) die('skip ');
 ?>
--FILE--
<?php
$m = new Mustache();
$data = new stdClass;
$data->mixed = array(0 => 'long', 'one' => 'string');
$r = $m->render('', $data);
var_dump($r);
?>
--EXPECTF--
Warning: Mixed numeric and associative arrays are not supported (key: mixed) in %s on line 5
string(0) ""