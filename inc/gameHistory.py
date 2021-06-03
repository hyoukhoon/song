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

def addslashes(s):
    d = {'"':'\\"', "'":"\\'", "\0":"\\\0", "\\":"\\\\"}
    return ''.join(d.get(c, c) for c in s)

#1:승리 0:무승부 -1:패매 2:취소 7:언더 8:오버
def gr(s):
    if("ico_result01" in s):
        return 1
    elif("ico_result02" in s):
        return -1
    elif("ico_result03" in s):
        return 0
    elif("ico_result00" in s):
        return 2
    elif("ico_result07" in s):
        return 7
    elif("ico_result08" in s):
        return 8
    


datas={}
para1=[]
para2=[]
para3=[]
para4=[]

display = Display(visible=0, size=(1024, 768)) 
display.start() 
driver = webdriver.Chrome('/home/hyoukhoon/chromedriver', service_args=['--verbose','--no-sandbox', '--log-path=/home/hyoukhoon/chromedriver.log'])

#driver.get('http://www.betman.co.kr/gameInfoMain.so?gameId=G101&gameRound=180052')

gameId="G101"
gameRound=180001
istate=4

driver.get('http://www.betman.co.kr/winningResultProto.so?method=detail&gameId=G101&gameRound=%d' % gameRound)

driver.implicitly_wait(3)
html = driver.page_source
soup = bs(html, 'html.parser') # Soup으로 만들어 줍시다.
t1=soup.find('table', {'id': 'tblSort'})
t2=t1.find_all('tr')

for t3 in t2:
    t4=t3.find_all('td')
    if(t4):
        que=str(gameId)+str(gameRound)+str(istate)+str(t4[5].text)+str(t4[10].text.strip())+str(t4[11].text.strip())+str(t4[12].text.strip())+str(t4[0].text)+str(t4[10].text)+str(t4[7].text)+str(t4[9].text)+str(t4[10].text)+str(t4[2].text)+str(t4[3].text)+str(t4[13].text)
        print(que)


