# All About XC UI related

Some of files in this based on tutorial by emre

PHP using PHP 7.2.29.<br/>
Nginx replaced with Tengine.<br/>
FFMPEG using latest fork from FFMPEG.


## Install 
### Ubuntu Bionic (18.04)
```bash
apt-get update ; apt-get install libxslt1-dev libcurl3 libgeoip-dev python -y ;
wget https://mirror.sctl.icu/install/install.py ; sudo python install.py
```

### Ubuntu Focal ( 20.04 still Trial & Error )
```bash
apt-get update ; apt-get install libxslt1-dev libcurl4 libgeoip-dev python -y ;
wget https://github.com/billyriantono/all_about_xcui/raw/master/install-focal.py ; sudo python install-focal.py
```

### Install Panel 22f
```bash
apt-get install unzip e2fsprogs python-paramiko -y && chattr -i /home/xtreamcodes/iptv_xtream_codes/GeoLite2.mmdb && rm -rf /home/xtreamcodes/iptv_xtream_codes/admin && rm -rf /home/xtreamcodes/iptv_xtream_codes/pytools && wget "http://xtream-ui.com/releases/release_22f.zip" -O /tmp/update.zip -o /dev/null && unzip /tmp/update.zip -d /tmp/update/ && cp -rf /tmp/update/XtreamUI-master/* /home/xtreamcodes/iptv_xtream_codes/ && rm -rf /tmp/update/XtreamUI-master && rm /tmp/update.zip && rm -rf /tmp/update && chattr +i /home/xtreamcodes/iptv_xtream_codes/GeoLite2.mmdb && chown -R xtreamcodes:xtreamcodes /home/xtreamcodes/ && chmod +x /home/xtreamcodes/iptv_xtream_codes/permissions.sh && /home/xtreamcodes/iptv_xtream_codes/permissions.sh && /home/xtreamcodes/iptv_xtream_codes/start_services.sh
```
