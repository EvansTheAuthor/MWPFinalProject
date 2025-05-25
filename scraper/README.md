# How do I do scraping from halodoc?

*This documentation is a work-in-progress.*

> My Environment
>
> WSL: Yes (Debian-based distro)
>
> The WSL is installed on my vscode, differently from my local WSL. But, seems that they both share the same root folder for our coding environment.

----------

1. The requirements for them need to set up on Python environment. Since I use WSL, here is the instalation you need to adjust on your WSL terminal.

```
sudo apt update && sudo apt install -y \
    python3 python3-pip python3-venv unzip wget curl \
    libglib2.0-0 libnss3 libgconf-2-4 libxss1 libasound2 \
    libx11-xcb1 libxcomposite1 libxcursor1 libxdamage1 libxi6 libxtst6
```

You also need a browser. I use chrome here so maybe you want to just copy-paste it then do it.

```
wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
sudo apt install -y ./google-chrome-stable_current_amd64.deb
```

If you want to make it sure, check it with code below.
```
CHROME_VERSION=$(google-chrome --version | grep -oP '[0-9]+' | head -1)
```

Install the chrome driver.

```
CHROMEDRIVER_VERSION=$(wget -qO- https://chromedriver.storage.googleapis.com/LATEST_RELEASE_${CHROME_VERSION})
wget https://chromedriver.storage.googleapis.com/${CHROMEDRIVER_VERSION}/chromedriver_linux64.zip
unzip chromedriver_linux64.zip
sudo mv chromedriver /usr/local/bin/
sudo chmod +x /usr/local/bin/chromedriver
```

2. Prepare out your python environment. I use .venv here.

Install Python on your Python on the WSL. Keep on your mind that local Python is totally different from WSL Python. Here it is. Copy paste it on your WSL terminal.

```
sudo apt install -y python3 python3-pip python3-venv
```

Try to make your Python environment and access it. Make sure that you install the environment on your project directory `(~/Your-Project)`, not root folder.

```
python3 -m venv .venv
source .venv/bin/activate
```

Remember, if `.venv` appears on your root project, that means you're totally wrong.
If you got that case, consult your programmer friend or AI chatbot to know how to do it on the right way.
How to exit the environment? Just type it on your terminal.

```
deactivate
```

Then, install the required Python packages. There, I use BeautifulSoup4, lxml (the html parser), Webdriver Manager, fake-useragent, and Selenium.

```
pip install selenium beautifulsoup4 lxml fake-useragent webdriver-manager
```

Make sure they installed properly with checking the installed Python libraries/packages.

```
pip list
```

3. I created the [scraperAdvanced.py](scraperAdvanced.py). Since it was a scraper designed to scrape from lazy pagination and lazy loading based sites, you can't just copy-paste my code. If you want to apply it on another site, adjust it. Consult your chatbot or fellow devs to adapt it.

4. To get the access to all categories, I try to make scraper with GET request but it can't work (my request denied with error code `HTTP 405 Error` and I'm too lazy for debugging so I delete it :v). So, I use the manual method. I visit "[https://www.halodoc.com/rumah-sakit](https://www.halodoc.com/rumah-sakit)", opened the dev inspection page (in Chrome, it's F12), then move out to Network tab and try to make request to client API with click "Lihat Semua" on the speciality categories. Fortunately, I found the API request (XHR) for client:
```
https://customers.api.halodoc.com/magneto-api/rumah-sakit/v1/hospitals/personnel/specialities

```
so I copy paste the responses to my own file[responsefromAPI.json](responsefromAPI.json). If you want to do it so, try it out. Check the API request for client on your inspection page.

> "Why don't you just click each category needed instead of making it harder?"

I've tried that, dude since I'm a lazy dev :v. But, they blocked it. I can't click it while I visiting the [all categories page](https://www.halodoc.com/cari-dokter/spesialisasi). I try to check it on dev mode but seems they don't make it can visit any link. Seems that it just can be clickable while I was logged in with an halodoc account, maybe? Dunno. Okay, next.

5. Since I've got the slugs and specialist names, I use it on my scraping. I'm saving the list with [responsefromAPI.json](responsefromAPI.json) and [NameSlugGetter.py](NameSlugGetter.py). They use format "https://www.halodoc.com/cari-dokter/spesialisasi/<slug>" so I scrape any categories that I want. Just scrape any categories you need. But, don't forget to check it earlier before you scrape them since I found some categories are null.