### ✅ Langkah Instalasi Laravel Project

```bash
# 1. Clone project dari repository
git clone <repo-url>
cd mx100-job-portal

# 2. Install semua dependencies Laravel (karena folder vendor tersedia)
composer install

# 3. Copy file environment dan konfigurasi
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Setup database (ubah .env dengan konfigurasi DB kamu)
#    Contoh: DB_DATABASE=mx100, DB_USERNAME=root, DB_PASSWORD=

# 6. Jalankan migration & seeder
php artisan migrate --seed

# 7. Jalankan aplikasi
php artisan serve
```

## 📬 Postman Collection

Import file berikut ke Postman:
**MX100_API.json**

---

## 🎤 FLOW PROJECT

1. **Role & Use-case**
   > "Saya membagi sistem menjadi dua role, Employer dan Freelancer, dengan pembatasan akses menggunakan middleware role-based."

2. **Autentikasi Sanctum**
   > "Saya menggunakan Laravel Sanctum untuk autentikasi token, agar lebih ringan dan cocok untuk API-only project."

3. **Alur Melalui Postman**
   > "Employer membuat pekerjaan → Freelancer apply → Employer melihat CV."

4. **Business Logic**
   > "Freelancer hanya bisa melamar satu kali ke setiap pekerjaan. Employer hanya bisa melihat pelamar untuk job miliknya."
