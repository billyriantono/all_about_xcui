--TEST--
__serialize() mechanism (015): Uninitialized properties from __sleep can be serialized and unserialized
--SKIPIF--
<?php if (PHP_VERSION_ID < 80000) { echo "skip __serialize/__unserialize error message different in php < 8"; } ?>
--FILE--
<?php
error_reporting(E_ALL);
set_error_handler(function ($errno, $message) {
    echo $message . "\n";
});
class OSI {
    public stdClass $o;
    public string $s;
    public ?int $i;
    public float $f;
    public function __sleep() {
        return ['o', 's', 'i'];
    }
}
// 00000002               -- header
// 17 03 4d79436c617373   -- object of type "MyClass"
//   14 03 000000           -- with 3 uninitialized properties
$m = new OSI();
var_dump($m);
var_dump($s = serialize($m));
try {
    var_dump(unserialize($s));
} catch (Error $e) {
    // TODO: Double check if this is a deliberate design decision.
    echo "unserialize: {$e->getMessage()}\n";
}
var_dump(bin2hex($s = igbinary_serialize($m)));
try {
    var_dump(igbinary_unserialize($s));
} catch (Error $e) {
    echo "igbinary_unserialize: {$e->getMessage()}\n";
}
--EXPECT--
object(OSI)#2 (0) {
  ["o"]=>
  uninitialized(stdClass)
  ["s"]=>
  uninitialized(string)
  ["i"]=>
  uninitialized(?int)
  ["f"]=>
  uninitialized(float)
}
serialize(): "o" returned as member variable from __sleep() but does not exist
serialize(): "s" returned as member variable from __sleep() but does not exist
serialize(): "i" returned as member variable from __sleep() but does not exist
string(44) "O:3:"OSI":3:{s:1:"o";N;s:1:"s";N;s:1:"i";N;}"
unserialize: Cannot assign null to property OSI::$o of type stdClass
igbinary_serialize(): "o" returned as member variable from __sleep() but does not exist
igbinary_serialize(): "s" returned as member variable from __sleep() but does not exist
igbinary_serialize(): "i" returned as member variable from __sleep() but does not exist
string(46) "0000000217034f5349140311016f001101730011016900"
igbinary_unserialize: Cannot assign null to property OSI::$o of type stdClass