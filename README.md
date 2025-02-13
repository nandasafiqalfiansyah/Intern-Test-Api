# Back End - Web Developer Intern Test

Tes masuk magang Backend Developer di PT Aksamedia Mulia Digital dirancang untuk mengevaluasi pemahaman dan kemampuan Anda dalam membuat API serta mengukur pemahaman Anda terhadap SQL. Tes ini juga akan mengevaluasi kemampuan logika Anda dalam menyelesaikan masalah.

## Requirement
- Laravel
- MySQL/MariaDB
- PhpMyAdmin / Adminer / HeidiSQL
- Postman

## Tugas

### Tugas 1: Membuat API Login
- **Endpoint:** `/login`
- **Method:** `POST`
- **Expected Request Format:**
- **Expected Response Format:**

### Tugas 2: Membuat API Get All Data Divisi
- **Endpoint:** `/divisions`
- **Method:** `GET`
- **Fitur:** Bisa difilter berdasarkan nama
- **Data Dummy:** (Mobile Apps, QA, Full Stack, Backend, Frontend, UI/UX Designer)
- **Expected Request Format:**
- **Expected Response Format:**

### Tugas 3: Membuat API Get All Data Karyawan
- **Endpoint:** `/employees`
- **Method:** `GET`
- **Fitur:** Bisa difilter berdasarkan nama dan divisi
- **Expected Request Format:**
- **Expected Response Format:**

### Tugas 4: Membuat API Create Data Karyawan
- **Endpoint:** `/employees`
- **Method:** `POST`
- **Expected Request Format:**
- **Expected Response Format:**

### Tugas 5: Membuat API Update Data Karyawan
- **Endpoint:** `/employees/{uuid pegawai}`
- **Method:** `PUT`
- **Expected Request Format:**
- **Expected Response Format:**

### Tugas 6: Membuat API Delete Data Karyawan
- **Endpoint:** `/employees/{uuid pegawai}`
- **Method:** `DELETE`
- **Expected Response Format:**

### Tugas 7: Membuat API Logout
- **Endpoint:** `/logout`
- **Method:** `POST`
- **Expected Response Format:**

## Aturan Pengerjaan
1. API tugas 1 hanya bisa diakses ketika belum login atau tanpa autentikasi, jika ada autentikasi maka ditolak.
2. API tugas 2 sampai 7 hanya bisa diakses ketika sudah login, jika belum login atau tanpa autentikasi maka ditolak.
3. Manfaatkan fitur Laravel dengan sebaik-baiknya seperti penggunaan request validation, Eloquent, dan lainnya.
4. Deploy hasil karya kalian dan kumpulkan link GitHub beserta link hasil deploy.

## Kriteria Penilaian
- Kesesuaian hasil dengan soal
- Kerapian hasil kodingan
- Pemanfaatan fitur-fitur Laravel
- **Baik hati, suka menolong, tidak sombong, bukan LGBT, dan rajin menabung**
- Jika teridentifikasi melakukan kecurangan, seperti mengcopy dari tim lain, secara otomatis akan didiskualifikasi.

---

# TES BACKEND (SQL) -> BONUS NILAI
Tes ini dirancang untuk mengevaluasi pemahaman Anda dalam SQL.

## Requirement
- Laravel
- MySQL/MariaDB
- PhpMyAdmin / Adminer / HeidiSQL

### Tugas
Buatkan kode dengan:
- **Endpoint:** `/nilaiRT`
- **Endpoint:** `/nilaiST`

### Aturan
- Perhitungan wajib menggunakan SQL, penggunaan Collection hanya diperbolehkan untuk pengolahan data terakhir (grouping).

### Petunjuk
- Untuk nilai RT menggunakan `materi_uji_id = 7`, tetapi tidak mengikutkan `pelajaran_khusus`.
- Untuk nilai ST menggunakan `materi_uji_id = 4` dengan perhitungan:
  - `pelajaran_id 44` dikali **41.67**
  - `pelajaran_id 45` dikali **29.67**
  - `pelajaran_id 46` dikali **100**
  - `pelajaran_id 47` dikali **23.81**
- Hasil akhir harus diurutkan dari total nilai terbesar.

## Penilaian
- Sesuai dengan output gambar
- Penamaan variabel yang memanusiakan manusia
- **Baik hati, suka menolong, tidak sombong, bukan LGBT, dan rajin menabung**

