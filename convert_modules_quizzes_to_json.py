# -*- coding: utf-8 -*-
import json
import os
import re

# Read generate_full_sql.py to extract courses_data and quizzes_data
with open("generate_full_sql.py", "r", encoding="utf-8") as f:
    code = f.read()

# Extract courses_data
start_c = code.find("courses_data = [")
end_c = code.find("quizzes_data = {")
courses_code = code[start_c:end_c].strip()

# Extract quizzes_data
start_q = code.find("quizzes_data = {")
end_q = code.find("# Generate SQL insert statements")
quizzes_code = code[start_q:end_q].strip()

# Execute in clean scope
scope = {}
exec(courses_code, scope)
exec(quizzes_code, scope)

courses_data = scope["courses_data"]
quizzes_data = scope["quizzes_data"]

# Map course IDs to slugs
slug_map = {
    1: "microsoft-excel-dasar",
    2: "microsoft-excel-lanjutan",
    3: "microsoft-word-surat-dokumen",
    4: "microsoft-powerpoint-presentasi",
    5: "menulis-cv-surat-lamaran-ats",
    6: "persiapan-wawancara-kerja",
    7: "literasi-keuangan-dasar",
    8: "memulai-usaha-kecil-modal-minim"
}

# Structure modul.json: list of all modules
all_modules = []
mod_id = 1
for c in courses_data:
    cid = c["id"]
    cslug = slug_map[cid]
    for idx, m in enumerate(c["modules"], 1):
        all_modules.append({
            "id": mod_id,
            "kursus_id": cid,
            "kursus_slug": cslug,
            "kursus_judul": c["title"],
            "urutan": idx,
            "judul_modul": m["title"],
            "estimasi_menit": m["duration"],
            "video_url": m["video"],
            "konten": m["content"]
        })
        mod_id += 1

data_dir = os.path.join("skill4life", "assets", "data")
with open(os.path.join(data_dir, "modul.json"), "w", encoding="utf-8") as f:
    json.dump(all_modules, f, indent=2, ensure_ascii=False)

# Structure kuis.json: list of quiz questions
all_quizzes = []
q_id = 1
for cid, qlist in quizzes_data.items():
    cslug = slug_map[cid]
    for idx, q in enumerate(qlist, 1):
        all_quizzes.append({
            "id": q_id,
            "kursus_id": cid,
            "kursus_slug": cslug,
            "urutan": idx,
            "pertanyaan": q["q"],
            "pilihan": {
                "A": q["a"],
                "B": q["b"],
                "C": q["c"],
                "D": q["d"]
            },
            "jawaban_benar": q["key"],
            "pembahasan": q["desc"]
        })
        q_id += 1

with open(os.path.join(data_dir, "kuis.json"), "w", encoding="utf-8") as f:
    json.dump(all_quizzes, f, indent=2, ensure_ascii=False)

print(f"Exported {len(all_modules)} modules and {len(all_quizzes)} quiz questions to JSON!")
