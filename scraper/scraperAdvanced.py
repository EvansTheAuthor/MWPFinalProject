from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from selenium.common.exceptions import NoSuchElementException, ElementClickInterceptedException
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

def click_load_more(driver):
    try:
        button = driver.find_element(By.XPATH, '//button[contains(text(),"Muat Lebih Banyak Dokter")]')
        button.click()
        return True
    except (NoSuchElementException, ElementClickInterceptedException):
        return False
    
def extract_data_from_html(html):
    soup = BeautifulSoup(html, 'lxml')
    doctor_elements = soup.find_all("div", class_="doctor-appointment-card__content")

    doctors = []
    for doctor in doctor_elements:
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
            "city": doc_city
            })
    return doctors

def main():
    url = "https://www.halodoc.com/cari-dokter/spesialis/dermato-venereologist"
    driver = setup_driver()
    driver.get(url)
    time.sleep(2)
    
    while True:
        if not click_load_more(driver):
            break
        time.sleep(2.5)
        
    full_html = driver.page_source
    driver.quit()
    
    doctors = extract_data_from_html(full_html)
    
    with open("doctorAdvanced.csv", "w", newline="", encoding="utf-8") as f:
        writer = csv.DictWriter(f, fieldnames=["name", "speciality", "hospital", "city"])
        writer.writeheader()
        writer.writerows(doctors)
        
    print(f"[DONE] Berhasil menyimpan {len(doctors)} dokter ke doctors.csv")
    
if __name__ == "__main__":
    main()