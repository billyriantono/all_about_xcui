--TEST--
__serialize() mechanism (007): handle __destruct of returned data
--SKIPIF--
<?php if (PHP_VERSION_ID < 70400) { echo "skip __serialize/__unserialize not supported in php < 7.4 for compatibility with serialize()"; } ?>
--FILE--
<?php

class DestructorThrows {
    public function __construct(string $val) {
        $this->val = $val;
    }
    public function __destruct() {
        echo "DestructorThrows called val=$this->val\n";
        throw new RuntimeException($this->val);
    }
}

class Xyz {
    public $Xyz;
    public function __serialize() {
        return [new DestructorThrows($this->Xyz)];
    }
    public function __unserialize(array $data) {
        $this->Xyz = $data[0];
    }

    public function __destruct() {
        // should not be called
        echo "Called destruct prop=$this->Xyz\n";
    }
}

$test = new Xyz;
$test->Xyz = 'Xyz';

try {
    var_dump(bin2hex($s = igbinary_serialize($test)));
} catch (RuntimeException $e) {
    echo "message={$e->getMessage()}\n";
}
unset($test);

$test = new Xyz;
$test->Xyz = '';
try {
    var_dump(bin2hex($s = igbinary_serialize($test)));
} catch (RuntimeException $e) {
    echo "message={$e->getMessage()}\n";
}
?>
--EXPECT--
DestructorThrows called val=Xyz
message=Xyz
DestructorThrows called val=
Called destruct prop=Xyz
message=
Called destruct prop=
