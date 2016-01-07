--TEST--
Mustache::render() member function - Will not overflow int
--SKIPIF--
<?php

if(!extension_loaded('mustache')) die('skip ');
 ?>
--FILE--
<?php
$m = new Mustache();
$data = new stdClass;
$data->var = 2147483648;
$r = $m->render('{{var}}', $data);
var_dump($r);
?>
--EXPECT--
string(10) "2147483648"