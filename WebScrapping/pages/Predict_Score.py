from templ import *
add_logo_fn()
import mysql.connector
import webbrowser




# Initialize connection.
# Uses st.cache_resource to only run once.
def init_connection():
    return mysql.connector.connect(**st.secrets["mysql"])

conn = init_connection()

# Perform query.
# Uses st.cache_data to only rerun when the query changes or after 10 min.
def run_query(query):
    with conn.cursor() as cur:
        cur.execute(query)
        return cur.fetchall()


def predict_function(id):
    conn.cursor().execute("UPDATE streamlit_datastore SET value='" + id + "' WHERE data_key='predict_student';")
    conn.commit()
    add_page("Predicted_score.py", "Predicted_score")
    webbrowser.open_new("http://localhost:8501/Predicted_score/")


course_list=['Choose']
rows = run_query("SELECT course_name from course_list;")
for row in rows:
    course_list.append(f"{row[0]}")



option = st.selectbox(
    'Enter the course :',
    (course_list),key="op1")


if option!="Choose":

    query="SELECT sem_num from course_list where course_name='"+option+"';"
    rows2 = run_query(query)
    sem_nums=['Choose']
    for row in rows2:

        for i in range(1,row[0]+1):
            sem_nums.append(i)


    option2 = st.selectbox(
        'Enter the semester :',
        (sem_nums),key="op2")

    if option2!="Choose":

        rows = run_query("SELECT * from users u inner join student_data sd on u.email=sd.email where u.user_status=1 and sd.s_course='"+option+"' and s_sem='s"+str(option2)+"' and s_status=2;")

        i=0

        for row in rows:
            i+=1

            col1, col2, col3 = st.columns(3)

            # Column Names
            if(i==1):
                with col1:
                    st.write("Id")
                    st.write("---")
                with col2:
                    st.write("Name")
                    st.write("___")
                with col3:
                    st.write("Action")
                    st.write("___")

                # End of Column Names

            with col1:
                st.write(f"{row[0]}")
            with col2:
                st.write(f"{row[1]}")
            with col3:
                if st.button("Predict",key=i):
                    predict_function(row[2])


