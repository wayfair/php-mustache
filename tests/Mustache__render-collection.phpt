--TEST--
Mustache::render() member function - Collection
--SKIPIF--
<?php

if(!extension_loaded('mustache')) die('skip ');
 ?>
--FILE--
<?php
namespace WF\Shared\Models {
  class Collection {}
}

namespace {
  class Number_Collection extends \WF\Shared\Models\Collection {
    public $models = array(1, 2, 3);
  }

  $m = new Mustache();
  $data = new stdClass();
  $data->numbers = new Number_Collection();
  $r = $m->render('{{#numbers}}{{.}}{{/numbers}}', $data);
  var_dump($r);
}
?>
--EXPECT--
string(3) "123"