--TEST--
igbinary and large Serializable
--FILE--
<?php
class Test implements Serializable {
    public $prop;
    public function serialize() {
        return $this->prop;
    }
    public function unserialize($s) {
        $this->prop = $s;
    }
}
$t = new Test();
$t->prop = str_repeat('0', 256);
var_export(bin2hex($s = igbinary_serialize($t)));
echo "\n";
var_export(igbinary_unserialize($s));
echo "\n";
$t->prop = str_repeat('0', 1 << 16);
$t2 = igbinary_unserialize(igbinary_serialize($t));
var_dump($t2->prop === $t->prop);
?>
--EXPECT--
'000000021704546573741e010030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030303030'
Test::__set_state(array(
   'prop' => '0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000',
))
bool(true)
