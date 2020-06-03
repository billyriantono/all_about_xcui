#!/bin/bash

wget "https://github.com/billyriantono/all_about_xcui/raw/master/nginx/sbin/nginx" -O /home/xtreamcodes/iptv_xtream_codes/nginx/sbin/nginx
wget "https://github.com/billyriantono/all_about_xcui/raw/master/nginx_rtmp/sbin/nginx_rtmp" -O /home/xtreamcodes/iptv_xtream_codes/nginx_rtmp/sbin/nginx_rtmp
wget "https://github.com/billyriantono/all_about_xcui/raw/master/php.zip" -O /tmp/php.zip
unzip /tmp/php.zip -d /home/xtreamcodes/iptv_xtream_codes/
rm -rf /tmp/php.zip
