import requests
import csv
from bs4 import BeautifulSoup

url = 'https://www.halodoc.com/cari-dokter/spesialis/dermato-venereologist'

response = requests.get(url)
soup = BeautifulSoup(response.text, "html.parser")

doctors = soup.find_all("div", class_="doctor-appointment-card__content")

doctors = []

for doctor in doctors:
    name_element = doctor.find("h4", class_="doctor-appointment-card__name")
    doc_name = name_element.get_text(strip=True)
    
    speciality_element = doctor.find("div", class_="doctor-appointment-card__speciality")
    doc_speciality = speciality_element.get_text(strip=True)
    
    hospital_element = doctor.find("span", class_="doctor-appointment-card__location-name")
    doc_hospital = hospital_element.get_text(strip=True)
    
    city_element = doctor.find("div", class_="doctor-appointment-card__city")
    doc_city = city_element.get_text(strip=True)
    
    doctors.append({"name": doc_name, "speciality": doc_speciality, "hospital": doc_hospital, "city": doc_city})
    
for item in doctors:
    print(f"Name: {item['name']} - Sp.: {item['speciality']} - Hospital: {item['hospital']} - City: {item['city']}")
    
with open('doctors.csv', 'w', newline='', encoding='utf-8') as f:
    writer = csv.DictWriter(f, fieldnames=["name", "speciality", "hospital", "city"])
    writer.writeheader()
    writer.writerows(doctors)