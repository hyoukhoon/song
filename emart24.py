import socks
import socket
socks.set_default_proxy(socks.SOCKS5, "127.0.0.1", 9050)
socket.socket = socks.socksocket
import requests
from bs4 import BeautifulSoup as bs
import pymysql
import json
from datetime import datetime
import time 
from datetime import date 
import sys
import re
conn = pymysql.connect(host='59.10.169.99', user='rotel', password='soon0605', db='python', charset='utf8')
curs = conn.cursor()

def addslashes(s):
    d = {'"':'\\"', "'":"\\'", "\0":"\\\0", "\\":"\\\\"}
    return ''.join(d.get(c, c) for c in s)

def multiName(multi):
    if multi=="1n1":
        return "1+1행사"
    elif multi=="2n1":
        return "2+1행사"

def emart24(cate):

    for k in range(1,5):

        domain="https://www.emart24.co.kr"
        datas={}
        para1=[]
        para2=[]
        para3=[]
        para4=[]

        post_one = requests.get('https://www.emart24.co.kr/product/eventProduct.asp?productCategory=%s&cpage=%d' % (cate,k))
        soup = bs(post_one.text, 'html.parser') # Soup으로 만들어 줍시다.
        print(soup)
        sys.exit()
        goodsName= soup.find_all('p', {'class': 'prodName'})
        priceAll= soup.find_all('p', {'class': 'prodPrice'})
        img= soup.find_all('img', {'height': '180'})
#        print(goodsName)
#        print(img)
#        print(len(img))
#        sys.exit()
        arrLen=len(img)
        for n in range(1,arrLen):
            goodsNm=goodsName[n].text
            price=priceAll[n].text
            price=price.replace(",","")
            price=price.replace("원","")
            imgUrl=img[n].get('src')
            query="insert into every_board (site_name,multi,site_domain, subject,imgurl,price,etc1,reg_date) values ('emart24','conven','"+domain+"','"+goodsNm+"','"+imgUrl+"','"+price+"','"+multiName(cate)+"',now());"
            print(query)
#            sys.exit()
            curs.execute(query)
        conn.commit()

emart24("1n1")
emart24("2n1")


conn.close()


