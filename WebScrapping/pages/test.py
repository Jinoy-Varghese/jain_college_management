# https://hackernoon.com/how-to-use-google-trends-api-with-python
from time import sleep
from selenium import webdriver
from webdriver_manager.chrome import ChromeDriverManager

from templ import *
from pytrends.request import TrendReq
import plotly.express as px
add_logo_fn()
def get_cookie():
    options = webdriver.ChromeOptions()
    options.add_argument("--headless")
    driver = webdriver.Chrome(ChromeDriverManager().install())
    driver.get("https://trends.google.com/")
    #sleep(1)
    cookie = driver.get_cookie("NID")["value"]
    driver.quit()
    return cookie

nid_cookie = f"NID={get_cookie()}"
pytrends = TrendReq(hl='en-US', tz=360,requests_args={"headers": {"Cookie": nid_cookie}})

value = st.text_input('Enter the keyword to forcast trends: ', 'ML')
if st.button("Submit"):

    kw_list = [value] # list of keywords to get data

    pytrends.build_payload(kw_list, cat=0, timeframe='today 5-y')
    data = pytrends.interest_over_time()
    data = data.reset_index()

    fig = px.line(data, x="date", y=[value], title=' ')
    st.plotly_chart(fig, use_container_width=True)


