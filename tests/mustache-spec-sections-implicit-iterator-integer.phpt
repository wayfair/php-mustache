--TEST--
Implicit Iterator - Integer
--DESCRIPTION--
Implicit iterators should cast integers to strings and interpolate.
--SKIPIF--
<?php if(!extension_loaded('mustache')) die('skip '); ?>
--FILE--
<?php
$test = array (
  'name' => 'Implicit Iterator - Integer',
  'desc' => 'Implicit iterators should cast integers to strings and interpolate.',
  'data' => 
  array (
    'list' => 
    array (
      0 => 1,
      1 => 2,
      2 => 3,
      3 => 4,
      4 => 5,
    ),
  ),
  'template' => '"{{#list}}({{.}}){{/list}}"',
  'expected' => '"(1)(2)(3)(4)(5)"',
);
$mustache = new Mustache();
echo $mustache->render($test["template"], $test["data"]);
?>
--EXPECTREGEX--
"\(1\)\(2\)\(3\)\(4\)\(5\)"