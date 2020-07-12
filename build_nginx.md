###How to compile nginx with http2 ve up to date openssl

https://fak3r.com/2015/09/29/howto-build-nginx-with-http-2-support/

sudo apt-get -y install build-essential zlib1g-dev libpcre3 libpcre3-dev libbz2-dev libssl-dev libgd-dev libxslt-dev libgeoip-dev tar unzip curl


cd /tmp/
sudo wget https://github.com/openssl/openssl/archive/OpenSSL_1_1_1g.tar.gz
tar -xzvf OpenSSL_1_1_1g.tar.gz

---copy /tmp/openssl.. folder name and use it on ngix ./configure, look at end of that row.


cd /root/

wget http://nginx.org/download/nginx-1.19.0.tar.gz
tar -xzvf nginx-1.19.0.tar.gz


if want use tengine 

wget https://tengine.taobao.org/download/tengine-2.3.2.tar.gz
tar -xzvf tengine-2.3.2.tar.gz


----download geoip2 module files

sudo add-apt-repository ppa:maxmind/ppa -y
sudo apt-get update
sudo apt-get install -y libmaxminddb-dev
git clone https://github.com/leev/ngx_http_geoip2_module.git


---configure nginx,

cd nginx-1.19.0

./configure --prefix=/home/xtreamcodes/iptv_xtream_codes/nginx/ --http-client-body-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/client_temp --http-proxy-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/proxy_temp --http-fastcgi-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/fastcgi_temp --lock-path=/home/xtreamcodes/iptv_xtream_codes/tmp/nginx.lock --http-uwsgi-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/uwsgi_temp --http-scgi-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/scgi_temp --conf-path=/home/xtreamcodes/iptv_xtream_codes/nginx/conf/nginx.conf --error-log-path=/home/xtreamcodes/iptv_xtream_codes/logs/error.log --http-log-path=/home/xtreamcodes/iptv_xtream_codes/logs/access.log --pid-path=/home/xtreamcodes/iptv_xtream_codes/nginx/nginx.pid --with-http_ssl_module --with-http_realip_module --with-http_addition_module --with-http_sub_module --with-http_dav_module --with-http_gunzip_module --with-http_gzip_static_module --with-http_v2_module --with-ld-opt='-Wl,-z,relro -Wl,--as-needed -static' --with-pcre --with-http_random_index_module --with-http_secure_link_module --with-http_stub_status_module --with-http_auth_request_module --with-threads --with-mail --with-mail_ssl_module --with-file-aio --with-cpu-opt=generic --with-cc-opt='-static -static-libgcc -g -O2 -Wformat -Wall' --add-module=/root/ngx_http_geoip2_module --with-openssl=/tmp/openssl-OpenSSL_1_1_1g

--compile nginx,

make

--to install compiled nginx, (not: don't do this in xtream-ui server, use a test server to compile nginx)

make install

-- tengine
cd tengine-2.3.2

./configure --prefix=/home/xtreamcodes/iptv_xtream_codes/nginx/ --http-client-body-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/client_temp --http-proxy-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/proxy_temp --http-fastcgi-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/fastcgi_temp --lock-path=/home/xtreamcodes/iptv_xtream_codes/tmp/nginx.lock --http-uwsgi-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/uwsgi_temp --http-scgi-temp-path=/home/xtreamcodes/iptv_xtream_codes/tmp/scgi_temp --conf-path=/home/xtreamcodes/iptv_xtream_codes/nginx/conf/nginx.conf --error-log-path=/home/xtreamcodes/iptv_xtream_codes/logs/error.log --http-log-path=/home/xtreamcodes/iptv_xtream_codes/logs/access.log --pid-path=/home/xtreamcodes/iptv_xtream_codes/nginx/nginx.pid --with-http_ssl_module --with-http_realip_module --with-http_addition_module --with-http_sub_module --with-http_dav_module --with-http_gunzip_module --with-http_gzip_static_module --with-http_v2_module --with-ld-opt='-Wl,-z,relro -Wl,--as-needed -static' --with-pcre --with-http_random_index_module --with-http_secure_link_module --with-http_stub_status_module --with-http_auth_request_module --with-threads --with-mail --with-mail_ssl_module --with-file-aio --with-cpu-opt=generic --with-cc-opt='-static -static-libgcc -g -O2 -Wformat -Wall' --add-module=/root/ngx_http_geoip2_module --with-openssl=/tmp/openssl-OpenSSL_1_1_1g

--compile nginx,

make

--to install compiled nginx, (not: don't do this in xtream-ui server, use a test server to compile nginx)

make install





18-02-2020

https://github.com/leev/ngx_http_geoip2_module
ngx_http_geoip2_module added for blocking ip addresses with geoip2 database.
https://docs.nginx.com/nginx/admin-guide/security-controls/controlling-access-by-geoip/#config
