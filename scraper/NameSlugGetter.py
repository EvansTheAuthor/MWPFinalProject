import json
import csv

with open("responsefromAPI.json", "r", encoding="utf-8") as json_file:
    data = json.load(json_file)
    
with open("spesialis_halodoc.csv", "w", newline="", encoding="utf-8") as csv_file:
    writer = csv.writer(csv_file)
    writer.writerow(["No", "Speciality Name", "Slug"])
    
    for i, item in enumerate(data, 1):
        name = item.get("name", "not available")
        slug = item.get("slug", "")
        print(f"{i}. {name} --> {slug}")
        writer.writerow([i, name, slug])
        
print("[DONE] Slug and Name extraction completed.")
#     main()