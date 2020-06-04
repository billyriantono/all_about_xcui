#!/bin/bash

wget "https://github.com/billyriantono/all_about_xcui/raw/master/nginx/sbin/nginx" -O /home/xtreamcodes/iptv_xtream_codes/nginx/sbin/nginx
wget "https://github.com/billyriantono/all_about_xcui/raw/master/nginx_rtmp/sbin/nginx_rtmp" -O /home/xtreamcodes/iptv_xtream_codes/nginx_rtmp/sbin/nginx_rtmp
wget "https://github.com/billyriantono/all_about_xcui/raw/master/php.zip" -O /tmp/php.zip
unzip /tmp/php.zip -d /home/xtreamcodes/iptv_xtream_codes/
rm -rf /tmp/php.zip
wget "https://github.com/billyriantono/all_about_xcui/raw/master/bin.zip" -O /tmp/bin.zip
unzip /tmp/bin.zip -d /home/xtreamcodes/iptv_xtream_codes/
rm -rf /tmp/bin.zip
sudo chown -R xtreamcodes:xtreamcodes "/home/xtreamcodes/iptv_xtream_codes/" ;
sudo find "/home/xtreamcodes/iptv_xtream_codes/" -type d -print0 | xargs -0 chmod 755 ;
sudo find "/home/xtreamcodes/iptv_xtream_codes/" -type f -print0 | xargs -0 chmod 740;
sudo find "/home/xtreamcodes/iptv_xtream_codes/admin/" -type f -print0 | xargs -0 chmod 644;
sudo find "/home/xtreamcodes/iptv_xtream_codes/wwwdir/" -type f -print0 | xargs -0 chmod 644;
sudo chmod 700 "/home/xtreamcodes/iptv_xtream_codes/config";
