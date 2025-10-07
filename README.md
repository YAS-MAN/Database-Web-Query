# QUERY BIAYA  
**Analisis Data Biaya Produksi (PHP PDO & Bootstrap 5)**  

Proyek web sederhana ini dibuat untuk menganalisis data transaksi dari dua tabel utama: **KartuPesanan** dan **RincianBiaya**,  
melalui **8 studi kasus (CASE A–H)** menggunakan query SQL yang kompleks.  

Dibangun dengan **PHP PDO** untuk keamanan koneksi database dan **Bootstrap 5** untuk tampilan yang elegan serta responsif.

---

## TAMPILAN UTAMA

- **8 CASE Analisis Data:**
  - CASE A: Total Biaya per Pesanan & Kelompok  
  - CASE B: Total Biaya per Bulan & Kelompok  
  - CASE C: Total Biaya per Jenis Produksi & Kelompok  
  - CASE D: Analisis Biaya Produksi per Unit  
  - CASE E: Statistik Biaya (rata-rata, max, min)  
  - CASE F: Biaya Pesanan Khusus "Sepatu"  
  - CASE G: Total Pesanan > 20 Juta  
  - CASE H: Pesanan Biaya Tertinggi  

- **Tampilan Data Awal:**  
  Menampilkan tabel `kartupesanan` dan `rincianbiaya` untuk memberikan konteks sumber data sebelum hasil query.

- **Aksi Dinamis:**  
  Setiap case memiliki tombol:
  - 🔍 **Detail:** menampilkan informasi detail data
  - ✏️ **Edit:** mengubah data transaksional
  - 🗑️ **Delete:** menghapus data tertentu  
  Tombol edit/delete hanya muncul pada data yang memiliki *kunci unik (Nomor Pesanan)* dan bisa dimodifikasi langsung.

- **Koneksi Aman & Cepat:**  
  Menggunakan **PDO** dengan try–catch exception handling, sehingga koneksi database lebih aman dari SQL Injection.

- **Desain Responsif:**  
  UI menggunakan **Bootstrap 5.3.8** dengan **Font Awesome 4.7.0** untuk ikon tombol dan header tab navigasi.

---
