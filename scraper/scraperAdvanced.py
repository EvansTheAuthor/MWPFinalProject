from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException, NoSuchElementException, ElementClickInterceptedException
from bs4 import BeautifulSoup
import csv
import time

def setup_driver():
    chrome_options = Options()
    chrome_options.add_argument("--headless")
    chrome_options.add_argument("--no-sandbox")
    chrome_options.add_argument("--disable-dev-shm-usage")
    service = Service()
    return webdriver.Chrome(service=service, options=chrome_options)

def click_next_page(driver, timeout=10):
    try:
        wait = WebDriverWait(driver, timeout)
        button = wait.until(
            EC.element_to_be_clickable((By.XPATH, '//button[.//mat-icon[text()="arrow_forward"]]'))
        )
        
        class_attr = button.get_attribute("class")
        if "mat-button-disabled" in class_attr:
            return False
        
        driver.execute_script(
            "arguments[0].click();", button
            )
        time.sleep(2)
        return True
    except TimeoutException:
        print("Timeout while waiting for the next page button.")
        return False
    except Exception as e:
        print(f"An error occurred: {e}")
        return False
    
def extract_data_from_html(html):
    soup = BeautifulSoup(html, 'lxml')
    doctor_elements = soup.find_all("div", class_="doctor-appointment-card__content")
    
    timestamp = time.strftime("%Y-%m-%d %H:%M:%S")

    doctors = []
    for doctor in doctor_elements:
        try:
            name_element = doctor.find("h4", class_="doctor-appointment-card__name")
            doc_name = name_element.get_text(strip=True)

            speciality_element = doctor.find("div", class_="doctor-appointment-card__speciality")
            doc_speciality = speciality_element.get_text(strip=True)

            hospital_element = doctor.find("span", class_="doctor-appointment-card__location-name")
            doc_hospital = hospital_element.get_text(strip=True)

            city_element = doctor.find("div", class_="doctor-appointment-card__city")
            doc_city = city_element.get_text(strip=True)

            doctors.append({
                "name": doc_name,
                "speciality": doc_speciality,
                "hospital": doc_hospital,
                "city": doc_city,
                "timestamp": timestamp
            })
        except AttributeError:
            continue
    return doctors

def main():
    url = "https://www.halodoc.com/cari-dokter/spesialis/midwife"
    driver = setup_driver()
    driver.get(url)
    time.sleep(2)
    
    all_doctors = []
    
    try:
        while True:
            html = driver.page_source
            doctors = extract_data_from_html(html)
            all_doctors.extend(doctors)
            has_more = click_next_page(driver)
            if not has_more:
                break
    except KeyboardInterrupt:
        print("Scraping interrupted by user.")
    except Exception as e:  
        print(f"An error occurred: {e}")
    finally:
        driver.quit()
    
        with open("ibuBidan.csv", "w", newline="", encoding="utf-8") as f:
            writer = csv.DictWriter(f, fieldnames=["name", "speciality", "hospital", "city", "timestamp"])
            writer.writeheader()
            writer.writerows(all_doctors)
            
        print(f"[DONE] Berhasil menyimpan {len(doctors)} dokter ke doctors.csv")
    
if __name__ == "__main__":
    main()