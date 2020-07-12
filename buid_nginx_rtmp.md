### how to compile nginx with rtmp module

sudo apt-get -y install build-essential zlib1g-dev libpcre3 libpcre3-dev libbz2-dev libssl-dev libgd-dev libxslt-dev libgeoip-dev tar unzip curl


cd /tmp/
sudo wget https://github.com/openssl/openssl/archive/OpenSSL_1_1_1g.tar.gz
tar -xzvf OpenSSL_1_1_1g.tar.gz

--copy /tmp/openssl.. folder name and use it on ngix ./configure, look at end of that row.

cd /root/


#geoip2 module

sudo add-apt-repository ppa:maxmind/ppa
sudo apt-get update
sudo apt-get install -y libmaxminddb-dev
git clone https://github.com/leev/ngx_http_geoip2_module.git

#nginx rtmp module

wget https://github.com/arut/nginx-rtmp-module/archive/v1.2.1.zip
unzip v1.2.1.zip

#folder name is,

/root/nginx-rtmp-module-1.2.1/

--continue  now, 

cd /root/

wget http://nginx.org/download/nginx-1.19.0.tar.gz
tar -xzvf nginx-1.19.0.tar.gz
cd nginx-1.19.0
===========
wget https://tengine.taobao.org/download/tengine-2.3.2.tar.gz

tar -xzvf tengine-2.3.2.tar.gz
cd tengine-2.3.2


./configure --prefix=/home/xtreamcodes/iptv_xtream_codes/nginx_rtmp/ --lock-path=/home/xtreamcodes/iptv_xtream_codes/nginx_rtmp/nginx_rtmp.lock --conf-path=/home/xtreamcodes/iptv_xtream_codes/nginx_rtmp/conf/nginx.conf --error-log-path=/home/xtreamcodes/iptv_xtream_codes/logs/rtmp_error.log --http-log-path=/home/xtreamcodes/iptv_xtream_codes/logs/rtmp_access.log --pid-path=/home/xtreamcodes/iptv_xtream_codes/nginx_rtmp/nginx.pid --add-module=/root/nginx-rtmp-module-1.2.1 --with-ld-opt='-Wl,-z,relro -Wl,--as-needed -static' --with-pcre --without-http_rewrite_module --with-file-aio --with-cpu-opt=generic --with-cc-opt='-static -static-libgcc -g -O2 -Wformat -Wall' --with-openssl=/tmp/openssl-OpenSSL_1_1_1g --add-module=/root/ngx_http_geoip2_module --with-http_ssl_module

-compile,

make

-to install compiled nginx, (not: don't do this in xtream-ui server, use a test server to compile nginx)

make install
