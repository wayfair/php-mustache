--TEST--
Mustache::render() member function - Unserializable trait
--SKIPIF--
<?php

if(!extension_loaded('mustache')) die('skip ');
 ?>
--FILE--
<?php
namespace WF\Shared\Traits\Mustache {
  trait Unserializable_Trait {}
}

namespace {
  class Data {
    use \WF\Shared\Traits\Mustache\Unserializable_Trait;

    public $var = 'foo';
  }

  $m = new Mustache();
  $data = new stdClass();
  $data->data = new Data();
  $r = $m->render('{{data.var}}', $data);
  var_dump($r);
}
?>
--EXPECT--
string(0) ""