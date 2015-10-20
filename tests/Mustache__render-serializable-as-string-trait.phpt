--TEST--
Mustache::render() member function - Serializable As String trait
--SKIPIF--
<?php

if(!extension_loaded('mustache')) die('skip ');
 ?>
--FILE--
<?php
namespace WF\Shared\Traits\Mustache {
  trait Serializable_As_String_Trait {}
}

namespace {
  class Data {
    use \WF\Shared\Traits\Mustache\Serializable_As_String_Trait;

    public function __toString() {
      return 'foo';
    }
  }

  $m = new Mustache();
  $data = new stdClass();
  $data->data = new Data();
  $r = $m->render('{{data}}', $data);
  var_dump($r);
}
?>
--EXPECT--
string(3) "foo"