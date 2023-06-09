from templ import *
add_logo_fn()
import numpy as np
import pandas as pd
import plotly.graph_objects as go
from sklearn.linear_model import LinearRegression
import mysql.connector


st.title("Predict the next Score")
def init_connection():
    return mysql.connector.connect(**st.secrets["mysql"])

conn = init_connection()

# Perform query.
# Uses st.cache_data to only rerun when the query changes or after 10 min.
def run_query(query):
    with conn.cursor() as cur:
        cur.execute(query)
        return cur.fetchall()


rows = run_query("SELECT value from streamlit_datastore where data_key='predict_student';")
for row in rows:
    id=row[0]
rows = run_query("SELECT name from users where email='"+id+"';")
for row in rows:
    name=row[0]

rows = run_query("SELECT mark_obtained from exam_marks where student_id='"+id+"';")
i=0
data=[]
for row in rows:
    i+=1
    data.append([i,row[0]])
if i<=0:
    st.write("No data available for prediction")
else:

    X = np.array(data)[:, 0].reshape(-1, 1)
    y = np.array(data)[:, 1].reshape(-1, 1)

    to_predict_x = [i+1, i+2, i+3]
    to_predict_x = np.array(to_predict_x).reshape(-1, 1)

    regsr = LinearRegression()
    regsr.fit(X, y)

    predicted_y = regsr.predict(to_predict_x)
    m = regsr.coef_
    c = regsr.intercept_

    new_y = [m * i + c for i in np.append(X, to_predict_x)]
    new_y = np.array(new_y).reshape(-1, 1)

    df = pd.DataFrame({'x': np.append(X, to_predict_x).ravel(), 'y': new_y.ravel()})
    fig = go.Figure(data=go.Scatter(x=df['x'], y=df['y'], mode='lines+markers'))

    df_actual = pd.DataFrame({'x': X.ravel(), 'y': y.ravel()})
    df_predicted = pd.DataFrame({'x': to_predict_x.ravel(), 'y': predicted_y.ravel()})
    df_all = pd.concat([df_actual, df_predicted], ignore_index=True)

    fig = go.Figure()
    fig.add_trace(go.Scatter(x=df_actual['x'], y=df_actual['y'], mode='markers', name='Actual'))
    fig.add_trace(go.Scatter(x=df_predicted['x'], y=df_predicted['y'], mode='lines+markers', name='Predicted'))
    fig.update_layout(title=name+"'s score predicted in next 3 exams", xaxis_title='No. of Exams', yaxis_title='Marks', font=dict(color='white'))


    st.plotly_chart(fig)

delete_page("Predicted_score.py", "Predicted_score")


