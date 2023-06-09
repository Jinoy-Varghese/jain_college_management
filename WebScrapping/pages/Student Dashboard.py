
from pytrends.request import TrendReq
from neuralprophet import NeuralProphet
from neuralprophet import set_random_seed
from templ import *
delete_page("Predicted_score.py", "Predicted_score")
delete_page("Predict_Score.py", "Predict_Score")

delete_page("test.py", "test")
delete_page("Current_Trends.py", "Current_Trends")
delete_page("Forcast.py", "Forcast")
delete_page("Search_Forcast.py", "Search_Forcast")
delete_page("Single_Trend_Analysis.py", "Single_Trend_Analysis")

import mysql.connector
add_logo_fn()
st.markdown("# My Dashboard")
def init_connection():
    return mysql.connector.connect(**st.secrets["mysql"])


data=st.experimental_get_query_params()
st_id=list(data)[0]
st.markdown("# 1. My Interests")

conn = init_connection()

def run_query(query):
    with conn.cursor() as cur:
        cur.execute(query)
        return cur.fetchall()

big=0

query = "SELECT DISTINCT(subject) from subject_attendance where s_id='"+st_id+"';"
rowstemp = run_query(query)
for rowtemp in rowstemp:

    query = "SELECT count(s_id) from subject_attendance where s_id='"+st_id+"' AND s_attendance='present' AND subject='"+rowtemp[0]+"';"
    rows = run_query(query)
    for row in rows:
        present=row[0]
    query = "SELECT count(s_id) from subject_attendance where s_id='"+st_id+"' AND s_attendance='absent' AND subject='"+rowtemp[0]+"';"
    rows = run_query(query)
    for row in rows:
        absent=row[0]

    tally=present-absent
    if(tally>=big):
        subject_interested_1=rowtemp[0]
st.write("a) Interested subject by attendance : " +subject_interested_1)
st.write("a) Interested subject by exam marks  : " +subject_interested_1)
st.write("a) Interested subject by assignment : " +subject_interested_1)

value=subject_interested_1

#forcasting interested subject
st.markdown("# 2. Interested subject forcast")
"""
TERMS = [value]
FORECAST_WEEKS = 52
nid_cookie = f"NID={get_cookie()}"
pt = TrendReq(hl='en-US', tz=360, requests_args={"headers": {"Cookie": nid_cookie}})
pt.build_payload(TERMS)
df = pt.interest_over_time()


TARGET_TERM = value

df = df[df['isPartial']==False].reset_index()
data = df.rename(columns={'date': 'ds', TARGET_TERM: 'y'})[['ds', 'y']]
data.tail()

model = NeuralProphet(daily_seasonality=True)
metrics = model.fit(data, freq="W")
future = model.make_future_dataframe(data, periods=FORECAST_WEEKS, n_historic_predictions=True)
future.head()
forecast = model.predict(future)


ax = model.plot(forecast, ylabel='Google Searches', xlabel='Year', figsize=(14,5))

st.plotly_chart(ax,use_container_width=True)

"""
