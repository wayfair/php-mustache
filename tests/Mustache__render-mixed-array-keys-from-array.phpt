--TEST--
Mustache::render() member function - mixed array keys from array
--SKIPIF--
<?php 

if(!extension_loaded('mustache')) die('skip ');
 ?>
--FILE--
<?php
$m = new Mustache();
$r = $m->render('', array('mixed' => array(0 => 'long', 'one' => 'string')));
var_dump($r);
?>
--EXPECTF--
Warning: Mixed numeric and associative arrays are not supported (key: mixed) in %s on line 3
string(0) ""