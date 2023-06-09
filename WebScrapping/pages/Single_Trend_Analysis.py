# https://hackernoon.com/how-to-use-google-trends-api-with-python
from templ import *
from pytrends.request import TrendReq
import plotly.express as px
add_logo_fn()

nid_cookie = f"NID={get_cookie()}"
pytrends = TrendReq(hl='en-US', tz=360, requests_args={"headers": {"Cookie": nid_cookie}})


value = st.text_input('Enter the subject name to check current trends: ', 'ML')
if st.button("Submit"):

    kw_list = [value] # list of keywords to get data

    pytrends.build_payload(kw_list, cat=0, timeframe='today 5-y')
    data = pytrends.interest_over_time()
    data = data.reset_index()

    fig = px.line(data, x="date", y=[value], title='ML Trend')
    st.plotly_chart(fig, use_container_width=True)




