<div align="center">

# Project Guideline Semester 4 🚀
<span>
  <img src="https://img.shields.io/badge/Docker-28%2B-blue?style=for-the-badge" alt="Docker">
  <img src="https://img.shields.io/badge/PHP-8%2B-purple?style=for-the-badge" alt="PHP">
  <img src="https://img.shields.io/badge/Laravel-12-red?style=for-the-badge" alt="Laravel">
  <img src="https://img.shields.io/badge/MariaDB-10%2B-orange?style=for-the-badge" alt="MariaDB">
</span>
</div>

---

## 📋 Requirement
- [Docker & Docker Compose](https://docs.docker.com/get-docker)
- Git

## 🛠️ Setup Awal
### 1. Clone Repository

#### HTTPS
```bash
git clone https://github.com/Noxius18/project_semester4.git
```
#### SSH
```bash
git clone git@github.com:Noxius18/project_semester4.git
```
### Setup env file
```bash
cp .env-example .env
```
---
# 🐳 Docker Deployment
Disini development menggunakan Docker Container, bukan menggunakan Laragon, WAMP Server ataupun XAMPP. Jadi bisa kalian nonaktifkan software tersebut

## Start Service
Untuk menghidupkan container docker
```bash
docker compose up -d --build
```

## Stop Service
Untuk menonaktifkan container docker jika sudah selesai
```bash
docker compose down
```

## Log container (Jika service tidak running)
Untuk melihat log pada container jika service tidak running
```bash
docker logs <nama-service>
```

## Enter Container
Untuk masuk ke container docker, jika ingin menjalankan Composer, Migrate dan sebagainya
```bash
# Service masuk ke php_smt4
docker exec -it <nama-service> bash
```
---
# 🔧 Konfigurasi Utama
## 🔐 Database Credentials
**Adminer Interface:** http://localhost:8080
```md
System:    MySQL/MariaDB
Server:    mariadb
Username:  project
Password:  password
Database:  semester_4
```

## 🌐 URL Aplikasi
**Laravel Backend:** http://localhost:8000
**Vite Frontend:** http://localhost:5173

## 📝 File .env
```
DB_CONNECTION=mariadb
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=semester_4
DB_USERNAME=project
DB_PASSWORD=password
```

# 🖥️ Development Workflow
## 1. Masuk ke Container PHP
```bash
docker exec -it php_smt4 bash
```
## 2. Install Dependencies yang dibutuhkan
```bash
# Install Dependencies untuk PHP
composer install
```

## 3. Setup Laravel
```bash
# Generate key untuk Laravel
php artisan key:generate

# Migrate Database Awal
php artisan migrate:fresh --seed
```

---

# 🚀 Branching dan Commit git guidelines
## 1. Branching
> ⚠️ WARNING!
> 🚫 Branch master hanya untuk produksi. Jangan langsung push ke branch master! 🚫

### 1.1 Buat branch baru
``` bash
git checkout -b <branch-baru>
```

## 2. Commit Message
Pastikan untuk membuat pesan commit mengikuti format seperti ini
- ```feat:``` untuk penambahan fitur baru
- ```fix: ``` untuk perbaikan pada fitur
- ```docs: ``` untuk perubahan pada dokumentasi
- ```style: ``` untuk perubahan format (semisal penambahan style baru pada cssnya)

**Contoh** 
```bash
git commit -m "feat: Tambah fitur menghapus tiket"
```

## 3. Push code
> ⚠️ WARNING!
> 🚫 Branch master hanya untuk produksi. Jangan langsung push ke branch master! 🚫

```bash
git push origin <nama-branch>
```
### 3.1 Pull branch (opsional)
ini berguna untuk menarik code dari branch lain ke device lokal kalian
```bash
git pull origin <nama-branch>
```
