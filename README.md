# Sistem Manajemen Buku

Aplikasi web sederhana untuk mengelola data buku dengan fitur CRUD (Create, Read, Update, Delete), ekspor CSV, dan generate laporan PDF.

## Persyaratan Sistem

- PHP >= 7.4
- MySQL/MariaDB
- Composer
- Web Server (Apache, Nginx, dll)

## Instalasi

### 1. Masuk ke Project
```bash
cd \htdocs\project_sertifikasi
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Database

Buat database baru bernama `books_db`:

```sql
CREATE DATABASE books_db;
USE books_db;

CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publisher VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    qty INT NOT NULL
);
```

### 4. Konfigurasi Koneksi Database

Edit file `config/Conf.php` dan sesuaikan dengan konfigurasi database Anda:

```php
private $host = "localhost";      // Host database
private $username = "root";       // Username MySQL
private $password = "";           // Password MySQL
private $db = "books_db";         // Nama database
```

### 5. Jalankan Aplikasi

Akses melalui browser:
```
http://localhost/project_sertifikasi/
```

## Struktur Folder

```
project_sertifikasi/
├── app/
│   ├── Models/
│   │   └── Books.php           # Model untuk operasi database buku
│   ├── Services/
│   │   └── Reports.php         # Service untuk generate laporan
│   └── Interfaces/
│       └── Reportable.php      # Interface untuk laporan
├── config/
│   └── Conf.php                # Konfigurasi database
├── pages/
│   ├── add.php                 # Halaman tambah buku
│   ├── edit.php                # Halaman edit buku
│   ├── delete.php              # Handler delete buku
│   └── export.php              # Handler export CSV/PDF
├── files/                       # Folder untuk menyimpan laporan
├── vendor/                      # Dependencies Composer
├── composer.json               # File konfigurasi Composer
├── index.php                   # Halaman utama
└── README.md                   # File dokumentasi ini
```

## Fitur Utama

### 1. **Lihat Data Buku**
- Tampilkan semua data buku dalam tabel
- Akses dari halaman utama (`index.php`)

### 2. **Tambah Buku**
- Klik tombol "Tambah Buku"
- Isi form: Judul, Penulis, Penerbit, Tahun, Jumlah
- Klik "Simpan"

### 3. **Ubah Data Buku**
- Klik link "Ubah" pada baris buku yang ingin diubah
- Form akan terisi otomatis dengan data saat ini
- Ubah data sesuai kebutuhan
- Klik "Simpan"

### 4. **Hapus Buku**
- Klik link "Hapus" pada baris buku
- Konfirmasi penghapusan
- Data akan dihapus dari database

### 5. **Export Laporan**
- **CSV**: Klik tombol "Cetak CSV" untuk download file CSV
- **PDF**: Klik tombol "Cetak PDF" untuk generate laporan PDF

## Penggunaan

### Halaman Utama (`index.php`)
Menampilkan tabel semua buku dengan opsi:
- Tambah Buku
- Ubah (Edit)
- Hapus (Delete)
- Export CSV
- Export PDF

### Tambah Buku (`pages/add.php`)
Form untuk input data buku baru.

### Ubah Buku (`pages/edit.php`)
Form untuk mengubah data buku yang sudah ada. Data akan ditampilkan otomatis berdasarkan ID.

### Export (`pages/export.php`)
Menghandle permintaan export dalam format CSV atau PDF berdasarkan parameter `type`.

## Model: Books

Class `App\Models\Books` menyediakan method:

- `getAll()` - Ambil semua data buku
- `getById($id)` - Ambil data buku berdasarkan ID
- `insert($title, $author, $publisher, $year, $qty)` - Tambah buku baru
- `update($id, $title, $author, $publisher, $year, $qty)` - Update data buku
- `delete($id)` - Hapus buku berdasarkan ID

## Service: Reports

Class `App\Services\Reports` menyediakan method:

- `generateCSV()` - Generate laporan CSV dan simpan ke `files/laporan_buku.csv`
- `generateReport()` - Generate dan stream laporan PDF menggunakan Dompdf

## Teknologi yang Digunakan

- **PHP 7.4+** - Server-side scripting
- **MySQLi** - Database connection
- **Composer** - Package manager
- **Dompdf** - PDF generation
- **PSR-4 Autoloading** - Class autoloading

## Troubleshooting

### Error: "Class 'App\Models\Books' not found"
- Pastikan `vendor/autoload.php` sudah di-include
- Jalankan `composer dump-autoload`

### Error: "Koneksi Gagal" atau "Failed to connect to MySQL"
- Verifikasi konfigurasi database di `config/Conf.php`
- Pastikan MySQL service sudah running
- Pastikan database `books_db` sudah dibuat

### Error: "Failed to load PDF document"
- Pastikan folder `files/` ada dan writable
- Periksa tidak ada output sebelum PDF stream (no whitespace before `<?php`)
- Jalankan `composer require dompdf/dompdf`

### Operasi tidak tersimpan
- Periksa MySQL user punya permission `INSERT`, `UPDATE`, `DELETE`
- Verifikasi struktur tabel books sudah sesuai

## Author

Andhika Tanaka
