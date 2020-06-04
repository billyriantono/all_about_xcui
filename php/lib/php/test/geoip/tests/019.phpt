--TEST--
Checking geoip_setup_custom_directory() (with trailing slash)
--SKIPIF--
<?php if (!extension_loaded("geoip")) print "skip"; ?>
--INI--
geoip.custom_directory="/test/"
--FILE--
<?php

var_dump( geoip_country_name_by_name_v6('0000:0000:0000:0000') );

?>
--EXPECT--
string(27) "/some/other/place/GeoIP.dat"
string(6) "/test/"