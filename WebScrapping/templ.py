from streamlit_extras.app_logo import add_logo
import streamlit as st

from pathlib import Path
from streamlit.source_util import (
    page_icon_and_name,
    calc_md5,
    get_pages,
    _on_pages_changed
)


def delete_page(main_script_path_str, page_name):
    current_pages = get_pages(main_script_path_str)

    for key, value in current_pages.items():
        if value['page_name'] == page_name:
            del current_pages[key]
            break
        else:
            pass
    _on_pages_changed.send()


def add_page(main_script_path_str, page_name):
    pages = get_pages(main_script_path_str)
    main_script_path = Path(main_script_path_str)
    pages_dir = main_script_path.parent / "pages"
    script_path = [f for f in pages_dir.glob("*.py") if f.name.find(page_name) != -1][0]
    script_path_str = str(script_path.resolve())
    pi, pn = page_icon_and_name(script_path)
    psh = calc_md5(script_path_str)
    pages[psh] = {
        "page_script_hash": psh,
        "page_name": pn,
        "icon": pi,
        "script_path": script_path_str,
    }
    _on_pages_changed.send()

delete_page("Predicted_score.py","Predicted_score")
def add_logo_fn():
    add_logo("images/jain_logo.png", height=100)
    st.markdown(
        """
        <style>
            [data-testid="stSidebarNav"] {
                margin-top:30px;
                background-size:auto 70px;
            }
            #MainMenu {visibility: hidden;}
            footer {visibility: hidden;}
        </style>
        """,
        unsafe_allow_html=True,
    )

from selenium import webdriver
from webdriver_manager.chrome import ChromeDriverManager




def get_cookie():
    options = webdriver.ChromeOptions()
    options.add_argument("--headless")
    driver = webdriver.Chrome(ChromeDriverManager().install())
    driver.get("https://trends.google.com/")
    # sleep(1)
    cookie = driver.get_cookie("NID")["value"]
    driver.quit()
    return cookie

