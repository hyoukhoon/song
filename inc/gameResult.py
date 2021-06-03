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

for i in range(gameRound-1, gameRound+1):

    driver.get('http://www.betman.co.kr/winningResultProto.so?method=detail&gameId=G101&gameRound=%d' % i)

    driver.implicitly_wait(3)
    html = driver.page_source
    soup = bs(html, 'html.parser') # Soup으로 만들어 줍시다.
    print(soup)
    t1=soup.find('table', {'id': 'tblSort'})
    t2=t1.find_all('tr')

    for t3 in t2:
        t4=t3.find_all('td')
        if(t4):
            islip=t4[0].text
    #        print(t4[13].text)
    #        print(t4[14].img)
            timg=str(t4[14].img)
            gart=gr(timg)
            
            #print("ico_result01" in timg)
            t5=t4[13].text.strip()
            t5=" ".join(t5.split())
            homeScore=0
            awayScore=0
    #        print(gart)
            if(gart==2):
                query="update proto set istate='4', homeScore='"+str(homeScore)+"', awayScore='"+str(awayScore)+"', gameResult='"+str(gart)+"' where  gameRound='"+str(i)+"' and islip='"+str(islip)+"'"
                curs.execute(query)
            if ":" in t5:
                t6=t5.split(':')
                homeScore=t6[0].strip()
                awayScore=t6[1].strip()
    #            print(islip+"->"+homeScore+":"+awayScore+":"+str(gart))
                query="update proto set istate='4', homeScore='"+str(homeScore)+"', awayScore='"+str(awayScore)+"', gameResult='"+str(gart)+"' where gameRound='"+str(i)+"' and islip='"+str(islip)+"'"
            else:
    #            print(islip+"->"+t5+":"+str(gart))
                if(gart==7 or gart==8):
                    homeScore=int(t5.strip())
                if(homeScore>0):
                    query="update proto set istate='4', homeScore='"+str(homeScore)+"', awayScore='"+str(awayScore)+"', gameResult='"+str(gart)+"' where  gameRound='"+str(i)+"' and islip='"+str(islip)+"'"
                else:
                    query="update proto set homeScore='"+str(homeScore)+"', awayScore='"+str(awayScore)+"', gameResult='"+str(gart)+"' where  gameRound='"+str(i)+"' and islip='"+str(islip)+"'"
    #        print(query)
            curs.execute(query)



conn.commit()

conn.close()


