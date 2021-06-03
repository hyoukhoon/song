from selenium import webdriver

PROXY = "23.23.23.23:3128" # IP:PORT or HOST:PORT

chrome_options = webdriver.ChromeOptions()
chrome_options.add_argument('--proxy-server=%s' % PROXY)

chrome = webdriver.Chrome('/home/hyoukhoon/chromedriver', chrome_options=chrome_options)
chrome.get("http://www.everyboardy.com/ip.php")
html = chrome.page_source

print(html)