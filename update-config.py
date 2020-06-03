#!/usr/bin/python
# -*- coding: utf-8 -*-
import subprocess, os, random, string, sys, shutil, socket
from itertools import cycle, izip

rDownloadURL = {"main": "https://raw.githubusercontent.com/billyriantono/all_about_xcui/master/nginx/conf/nginx.conf", "sub": "https://raw.githubusercontent.com/billyriantono/all_about_xcui/master/nginx/conf/nginx_in_lb.conf"}
rDownloadIspAddonURL = "https://raw.githubusercontent.com/billyriantono/all_about_xcui/master/nginx/conf/nginx_isp_addon.conf"
rInstall = {"MAIN": "main", "LB": "sub"}

class col:
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'
    UNDERLINE = '\033[4m'

def generate(length=16): return ''.join(random.choice(string.ascii_letters + string.digits) for i in range(length))

def getIP():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(("8.8.8.8", 80))
    return s.getsockname()[0]

def getVersion():
    try: return subprocess.check_output("lsb_release -d".split()).split(":")[-1].strip()
    except: return ""

def printc(rText, rColour=col.OKBLUE, rPadding=0):
    print "%s ┌──────────────────────────────────────────┐ %s" % (rColour, col.ENDC)
    for i in range(rPadding): print "%s │                                          │ %s" % (rColour, col.ENDC)
    print "%s │ %s%s%s │ %s" % (rColour, " "*(20-(len(rText)/2)), rText, " "*(40-(20-(len(rText)/2))-len(rText)), col.ENDC)
    for i in range(rPadding): print "%s │                                          │ %s" % (rColour, col.ENDC)
    print "%s └──────────────────────────────────────────┘ %s" % (rColour, col.ENDC)
    print " "

def install(rType="MAIN"):
    global rInstall, rDownloadURL
    try: rURL = rDownloadURL[rInstall[rType]]
    except:
        printc("Invalid download URL!", col.FAIL)
        return False
    if os.path.exists("/home/xtreamcodes/iptv_xtream_codes/nginx/conf/nginx.conf"):
        printc("Remove old nginx.conf")
        try: os.remove("/home/xtreamcodes/iptv_xtream_codes/nginx/conf/nginx.conf")
        except: pass
        try: os.remove("/home/xtreamcodes/iptv_xtream_codes/nginx/conf/nginx_isp_addon.conf")
        except: pass
        printc("Download configuration %s" % rURL)
        os.system('wget -q -O "/home/xtreamcodes/iptv_xtream_codes/nginx/conf/nginx.conf" "%s"' % rURL)
        os.system('wget -q -O "/home/xtreamcodes/iptv_xtream_codes/nginx/conf/nginx_isp_addon.conf" "%s"' % rDownloadIspAddonURL)
        return True
    printc("Failed to download installation file!", col.FAIL)
    return False

def start(first=True):
    if first: printc("Starting Nginx")
    else: printc("Restarting Nginx")
    os.system("service nginx restart > /dev/null")

if __name__ == "__main__":
    printc("Nginx Config Updated", col.OKGREEN, 2)
    rType = raw_input("  Installation Type [MAIN, LB]: ")
    print " "
    if rType.upper() in ["MAIN", "LB"]:
        printc("Start installation? Y/N", col.WARNING)
        if raw_input("  ").upper() == "Y":
            print " "
            if not install(rType.upper()): sys.exit(1)
            start()
            printc("Update completed!", col.OKGREEN, 2)
        else: printc("Installation cancelled", col.FAIL)
    else: printc("Invalid installation type", col.FAIL)

