import requests
import csv
from bs4 import BeautifulSoup
from fake_useragent import UserAgent

def main():
    url = 'https://www.halodoc.com/cari-dokter/spesialis/dermato-venereologist'
    headers = {'User-Agent': UserAgent().random}
    doctors = []

    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.content, "lxml")

    doctor_elements = soup.find_all("div", class_="doctor-appointment-card__content")
    

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
        
    for item in doctors:
        print(f"Name: {item['name']} - Sp.: {item['speciality']} - Hospital: {item['hospital']} - City: {item['city']}")
        
    with open('doctors.csv', 'w', newline='', encoding='utf-8') as f:
        writer = csv.DictWriter(f, fieldnames=["name", "speciality", "hospital", "city"])
        writer.writeheader()
        writer.writerows(doctors)
        
if __name__ == "__main__":
    main()