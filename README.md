# UTS Pemrograman Web – Magical Library

## Deskripsi Singkat
**Magical Library** adalah aplikasi web sederhana berbasis Laravel 10 yang mensimulasikan sebuah “toko buku sihir”. Pengguna dapat:
- **Login** (siapa saja bisa masuk)
- **Splash screen** dengan sapaan “Okairi nasai…”
- **Dashboard** menyambut penyihir
- **Pengelolaan Buku Sihir**: menambahkan dan menghapus (simulasi CRD menggunakan session)
- **Profil Penyihir**: menampilkan nama, entitas, asal planet, dan satu foto acak dari daftar

Seluruh fitur diimplementasikan tanpa basis data: buku disimpan di _session_ PHP, foto diambil secara acak dari koleksi URL.

---

## Fitur Utama
1. **Login Sihir**  
   - Form dengan `username` & `password` (kosongkan saja), selalu berhasil.
2. **Splash Screen**  
   - Menampilkan “Okairi nasai, \<username\>…” selama 3 detik, lalu otomatis ke Dashboard.
3. **Dashboard**  
   - Menyambut penyihir dengan nama.
4. **Pengelolaan Buku Sihir**  
   - Tabel/kartu 30 buku awal (hard-code).  
   - _Add book_: menambah entri baru ke session (ID unik).  
   - _Delete book_: menghapus entri dari session.  
5. **Profile Penyihir**  
   - Menampilkan nama, entitas “Manusia”, planet “Bumi”, dan satu foto acak dari daftar link.
6. **Logout**  
   - Tombol “Mahou Shoten no Tobira o Shimeru” mengembalikan ke halaman Login.

---

## Teknologi & Library
- **Framework**: Laravel 10  
- **Template Engine**: Blade  
- **Styling**: Bootstrap 5 + CSS kustom (`public/css/custom.css`)  
- **Session**: PHP Session untuk menyimpan daftar buku  
- **Query Parameter**: `?username=…` menjaga username antar-halaman  
- **Komponen Blade**:  
  - `@extends`, `@section` / `@endsection`, `@yield`  
  - `@include` dan `<x-navbar>`, `<x-footer>` untuk layout master  
  - `@push('scripts')` / `@stack('scripts')` untuk splash JS

---

## Struktur Proyek
app/
└─ Http/
└─ Controllers/
└─ PageController.php
public/
└─ css/
└─ custom.css
resources/
└─ views/
├─ layouts/
│ ├─ guest.blade.php
│ └─ app.blade.php
├─ components/
│ ├─ navbar.blade.php
│ └─ footer.blade.php
├─ login.blade.php
├─ splash.blade.php
├─ dashboard.blade.php
├─ pengelolaan.blade.php
└─ profile.blade.php
routes/
└─ web.php

## 🔄 Alur Aplikasi
1. **Login** (`/login`) → isi `username`/`password` → `POST /login`  
2. **Splash Screen** (`/splash?username=…`) → tampil sapaan “Okairi nasai…” → JS `setTimeout` 3 detik  
3. **Dashboard** (`/dashboard?username=…`) → tampil sambutan & navbar  
4. **Pengelolaan Buku** (`/pengelolaan?username=…`) → simpan & manipulasi array `books` di _session_  
5. **Profile** (`/profile?username=…`) → tampil detail profil & satu foto acak  
6. **Logout** (`POST /logout`) → kembali ke `/login`

---

## 🛠️ Penjelasan Teknis
- **Routing** (`routes/web.php`):  
  - `Route::get()`, `Route::post()`, `Route::redirect()` untuk mendefinisikan alur halaman.  
- **Controller** (`PageController.php`):  
  - Mengambil `username` lewat `$request->query('username')`.  
  - Simulasi CRUD menyimpan & membaca daftar buku melalui `session()->put()` dan `session()->get()`.  
- **Blade Layout**:  
  - `layouts.guest` untuk halaman **Login** & **Splash** (tanpa navbar).  
  - `layouts.app` untuk halaman utama (dengan `<x-navbar>` & `<x-footer>`).  
- **Session-based CRUD**:  
  - Default 30 buku diisi lewat `defaultBooks()`.  
  - Fungsi **createBook()** dan **deleteBook()** memodifikasi data di _session_ agar perubahan persist selama sesi.  
- **CSS Kustom** (`public/css/custom.css`):  
  - Latar gradien, font *Cinzel*, `text-shadow` kuning keemasan.  
  - Placeholder form login diwarnai emas (`#f1c40f`) agar kontras dengan tema gelap.  

