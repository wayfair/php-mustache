--TEST--
Mustache::autorender_by_callable() member function - lambdas enabled
--SKIPIF--
<?php
if(!extension_loaded('mustache')) die('skip ');
 ?>
--FILE--
<?php
$temp_file = dirname(__FILE__) . '/template.php';
file_put_contents($temp_file, '{{value}}');

$output = Mustache::autorender_by_callable(
  $temp_file,
  array('value' => function () { return 'foo'; }),
  function ($partial_name) {
    return dirname(__FILE__) . '/' . $partial_name . '.php';
  },
  true
);

var_dump($output);
?>
--CLEAN--
<?php
$temp_file = dirname(__FILE__) . '/template.php';
unlink($temp_file);
?>
--EXPECT--
string(3) "foo"