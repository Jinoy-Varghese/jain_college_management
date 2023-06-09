from pytrends.request import TrendReq
from templ import *
from neuralprophet import NeuralProphet
from neuralprophet import set_random_seed
add_logo_fn()
set_random_seed(0)

st.markdown("# Forecasting Next Year")
value = st.text_input('Enter the keyword to forcast trends: ', 'ML')
if st.button("Forcast"):

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