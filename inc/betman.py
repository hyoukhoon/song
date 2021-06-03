import requests
from bs4 import BeautifulSoup as bs
from selenium import webdriver
import pymysql
from datetime import datetime
import sys
import os
import json
from pprint import pprint
import urllib.request
import urllib.parse
import time
import paramiko
import shutil
from pyvirtualdisplay import Display

conn = pymysql.connect(host='127.0.0.1', user='rotel', password='soon0605', db='python', charset='utf8')
curs = conn.cursor()

dtime=datetime.today().strftime("%Y-%m-%d %H:%M:%S")

curs.execute("SELECT turn FROM protoTimeTable where startTime<'%s' and endTime>'%s'" % (dtime,dtime))

for rs in curs:
    gameRound=int(rs[0]);

#print(gameRound)
#sys.exit()


def addslashes(s):
    d = {'"':'\\"', "'":"\\'", "\0":"\\\0", "\\":"\\\\"}
    return ''.join(d.get(c, c) for c in s)

headers = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'}
datas={}
para1=[]
para2=[]
para3=[]
para4=[]

display = Display(visible=0, size=(1024, 768)) 
display.start() 
driver = webdriver.Chrome('/home/hyoukhoon/chromedriver', service_args=['--verbose','--no-sandbox', '--log-path=/home/hyoukhoon/chromedriver.log'])

#driver.get('http://www.betman.co.kr/gameInfoMain.so?gameId=G101&gameRound=180052')


#driver.get('http://www.betman.co.kr/slipTermProto.so?method=stepOne&gameId=G101&gameRound=%d' % gameRound)
driver.get('http://www.betman.co.kr/gameInfoMain.so?gameId=G101&gameRound=%d' % gameRound)

driver.implicitly_wait(3)
html = driver.page_source
soup = bs(html, 'html.parser') # Soup으로 만들어 줍시다.

dtime=datetime.today().strftime("%Y-%m-%d ")

#print(soup)
#sys.exit()

s1=soup.find_all("script")

#print(s1)
#sys.exit()

s2=str(s1[26])

#print(s2)
#sys.exit()

if 'memoryGameRound' in s2:
    s2=s2
else:
    s2=str(s1[24])


s3=s2.split('--')
s4=s3[1].split('////')
#print(s4[31])
#sys.exit()
s5=s4[0]+s4[31]
s6=s5.replace("&gt;",">")
s6=s6.replace("&lt;","<")
s6=s6.replace("/","//")


dtime=datetime.today().strftime("%Y%m%d")
f = open(r"%s.js" % dtime, 'w')
print(f)
f.write(str(s6))
f.close

localpath = './'+dtime+'.js'
remotepath = '/var/www/html/inc/'+dtime+'.js'

shutil.move (localpath , remotepath)

driver.get('http://www.everyboardy.com/inc/betman.php?gameRound=%d' % gameRound)
driver.implicitly_wait(3)
html = driver.page_source

driver.close();