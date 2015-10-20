--TEST--
Mustache::autorender_by_callable() member function - partial
--SKIPIF--
<?php
if(!extension_loaded('mustache') || (defined('PHP_VERSION_ID') && PHP_VERSION_ID >= 70000)) die('skip ');
 ?>
--FILE--
<?php
$temp_file1 = dirname(__FILE__) . '/template.php';
file_put_contents($temp_file1, '{{>partial}}');

$temp_file2 = dirname(__FILE__) . '/partial.php';
file_put_contents($temp_file2, '{{string}}');

$output = Mustache::autorender_by_callable(
  $temp_file1,
  array('string' => 'foo'),
  function ($partial_name) {
    return dirname(__FILE__) . '/' . $partial_name . '.php';
  }
);

var_dump($output);
?>
--CLEAN--
<?php
$temp_file1 = dirname(__FILE__) . '/template.php';
unlink($temp_file1);

$temp_file2 = dirname(__FILE__) . '/partial.php';
unlink($temp_file2);
?>
--EXPECT--
string(3) "foo"