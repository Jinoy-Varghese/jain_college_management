from templ import *
from pytrends.request import TrendReq
from neuralprophet import set_random_seed
import mysql.connector

add_logo_fn()
set_random_seed(0)

st.title("Current Job Trends Analysis")


def init_connection():
    return mysql.connector.connect(**st.secrets["mysql"])

conn = init_connection()

# Perform query.
# Uses st.cache_data to only rerun when the query changes or after 10 min.
def run_query(query):
    with conn.cursor() as cur:
        cur.execute(query)
        return cur.fetchall()

terms=[]
rows = run_query("SELECT job_post FROM offers GROUP BY job_post ORDER BY COUNT(job_post) DESC LIMIT 4;")
for row in rows:
    terms.append(row[0])




# Only need to run this once, the rest of requests will use the same session.
nid_cookie = f"NID={get_cookie()}"
pt =  TrendReq(hl='en-US', tz=360, requests_args={"headers": {"Cookie": nid_cookie}})

forecast_weeks = 52

# Fetch data from Google Trends
pt.build_payload(terms)
df = pt.interest_over_time()

# Compare trends as sentences
trend_comparison = ""
for term in terms:
    if df[term].sum() > 0:
        if df[term].iloc[-1] == df[term].max():
            trend_comparison += f"{term.title()} is currently the trending term on Google. "
        if df[term].iloc[-1] == df[term].min():
            trend_comparison += f"{term.title()} is currently the least searched term on Google. "

trend_comparison += "Over the last year, "
for term in terms:
    if df[term].sum() > 0:
        trend_comparison += f"{term.title()} has been searched {df[term].sum():,} times. "

st.write(trend_comparison)
st.line_chart(df, use_container_width=True, y=terms)