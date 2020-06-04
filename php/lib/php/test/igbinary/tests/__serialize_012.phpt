--TEST--
Test unserialization of classes derived from ArrayIterator
--SKIPIF--
<?php if (PHP_VERSION_ID < 70400) { echo "Skip requires php 7.4+"; } ?>
--FILE--
<?php
// based on bug45706.phpt from php-src
class Foo1 extends ArrayIterator
{
}
class Foo2 {
}
$x = array(new Foo1(),new Foo2);
$s = igbinary_serialize($x);
$s = str_replace("Foo", "Bar", $s);
$y = igbinary_unserialize($s);
var_dump($y);
--EXPECTF--
array(2) {
  [0]=>
  object(__PHP_Incomplete_Class)#3 (4) {
    ["__PHP_Incomplete_Class_Name"]=>
    string(4) "Bar1"
    ["0"]=>
    int(0)
    ["1"]=>
    array(0) {
    }
    ["2"]=>
    array(0) {
    }
  }
  [1]=>
  object(__PHP_Incomplete_Class)#4 (1) {
    ["__PHP_Incomplete_Class_Name"]=>
    string(4) "Bar2"
  }
}
