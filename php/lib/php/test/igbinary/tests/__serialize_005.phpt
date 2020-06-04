--TEST--
__serialize() mechanism (005): parent::__unserialize() is safe
--SKIPIF--
<?php if (PHP_VERSION_ID < 70400) { echo "skip __serialize/__unserialize not supported in php < 7.4 for compatibility with serialize()"; } ?>
--FILE--
<?php

class A {
    private $data;
    public function __construct(array $data) {
        $this->data = $data;
    }
    public function __serialize() {
        return $this->data;
    }
    public function __unserialize(array $data) {
        $this->data = $data;
    }
}

class B extends A {
    private $data2;
    public function __construct(array $data, array $data2) {
        parent::__construct($data);
        $this->data2 = $data2;
    }
    public function __serialize() {
        return [$this->data2, parent::__serialize()];
    }
    public function __unserialize(array $payload) {
        [$data2, $data] = $payload;
        parent::__unserialize($data);
        $this->data2 = $data2;
    }
}

$common = new stdClass;
$obj = new B([$common], [$common]);
var_dump(bin2hex($s = igbinary_serialize($obj)));
var_dump(igbinary_unserialize($s));

?>
--EXPECT--
string(70) "0000000217014214020600140106001708737464436c61737314000601140106002202"
object(B)#3 (2) {
  ["data2":"B":private]=>
  array(1) {
    [0]=>
    object(stdClass)#4 (0) {
    }
  }
  ["data":"A":private]=>
  array(1) {
    [0]=>
    object(stdClass)#4 (0) {
    }
  }
}
