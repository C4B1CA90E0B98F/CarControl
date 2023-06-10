## CarControl

### Daftar Username dan Password
> Note: login dapat menggunakan Username ataupun Email
- Admin :
  - Username: admin
  - Email: admin@test.com
  - Password: 12345678
- Pihak yang Menyetujui: 
  - Username : Approver1
  - Email : Approver1@test.com
  - Password : 12345678
 
- Pihak ke 2 yang Menyetujui: 
  - Username: Approver2
  - Email : Approver2@test.com
  - Password: 12345678

### Informasi Aplikasi
- Versi Database: MySQL 8.0
- Versi PHP: ^8.1
- Framework: Laravel

### Cara Instalasi Aplikasi
1. Clone repository ini ke komputer Anda.
2. Buka terminal dan masuk ke direktori aplikasi.
3. Jalankan perintah `composer install` untuk menginstall dependency.
4. Buat file `.env` dengan menyalin isi file `.env.example`.
5. Buat database baru di MySQL.
6. Isi konfigurasi database di file `.env` dengan konfigurasi database Anda.
7. Jalankan perintah `php artisan key:generate` untuk membuat key aplikasi.
8. Jalankan perintah `php artisan migrate` untuk membuat tabel-tabel di database.
9. Jalankan perintah `php artisan db:seed` untuk mengisi data awal ke database.
10. Jalankan perintah `php artisan serve` untuk menjalankan aplikasi.

### Panduan Penggunaan Aplikasi
1. Masuk ke Halaman Login
   - Buka aplikasi pemesanan kendaraan melalui URL: `http://<alamat_aplikasi>/login`
   - Masukkan username dan password sesuai dengan peran pengguna:
     - Admin: Masukkan username "`Admin`" dan password "`12345678`"
     - Pihak yang Menyetujui: Masukkan username "`Approver1`" dan password "`12345678`"
     - Pihak ke 2 yang Menyetujui: Masukkan username "`Approver2`" dan password "`12345678`"
   - Klik tombol "Login" untuk masuk ke aplikasi.

2. Dashboard
   - Setelah login berhasil, admin akan diarahkan ke halaman dashboard admin, dan pihak yang menyetujui akan diarahkan ke halaman dashboard pihak yang menyetujui.
   - Pada halaman dashboard, Anda dapat melihat jumlah User, Kendaraan, Lokasi, pemesanan kendaraan, dan Log Aktivitas.
3. Data User dan Driver (Admin)
    - Pada halaman user dan driver, Anda dapat menambahkan, menganti, menghapus user ataupun driver dengan langkah berikut:
        - Menambahkan user/driver dan Mengedit User
            - Klik tombol User pada menu lalu pilih ingin menginput user atau driver
            - Klik tombol Tambah User
            - Isi informasi yang dibutuhkan
            - Setelah mengisi semua informasi, klik tombol "Submit" untuk menyimpan.
        - Menghapus user/driver
            - Klik tombol ⁝ pada bagian aksi
            - Pilih Delete maka user/driver langsung terhapus
4. Kendaraan (Admin)
    - Pada halaman kendaraan, Anda dapat menambahkan, menganti, menghapus, dan dapat melihat grafik pemakaian kendaraan dan laporan penggunaan kendaraan dengan langkah berikut:
        - Menambahkan Kendaraan
            - Klik tombol Kendaraan pada menu
            - Klik tombol Tambah User
            - Isi informasi yang dibutuhkan
            - Setelah mengisi semua informasi, klik tombol “Submit” untuk menyimpan.
        - Mengedit Kendaraan
            - Klik tombol ⁝ pada bagian aksi
            - Isi informasi yang dibutuhkan
            - Setelah mengisi semua informasi, klik tombol “Submit” untuk menyimpan.
        - Melihat informasi dan grafik pemakaian
            - Klik tombol ⁝ pada bagian aksi.
            - Klik Show dan anda dapat melihat informasi dan grafik pemakaian kendaraan.
        - Menghapus Kendaraan
            - Klik tombol ⁝ pada bagian aksi
            - Pilih Delete maka Kendaraan langsung terhapus 
5. Lokasi (Admin)
    - Pada halaman lokasi, Anda dapat melihat, mengedit ataupun menghapus lokasi dengan langkah berikut:
        - Klik tombol lokasi pada menu
            - Klik tombol Tambah lokasi
            - Isi informasi yang dibutuhkan
            - Setelah mengisi semua informasi, klik tombol “Submit” untuk menyimpan.
        - Mengedit/menghapus lokasi
            - Klik tombol ⁝ pada bagian aksi
            - pilih edit/delete
            - Isi informasi yang dibutuhkan
            - Setelah mengisi semua informasi, klik tombol “Submit” untuk menyimpan.
6. Pemesanan Kendaraan (Admin)
   - Pada halaman pemesanan, Anda dapat menginputkan pemesanan kendaraan dan mengexport menjadi file excel dengan langkah berikut:
     - Klik tombol "`Pesan Baru`" atau navigasi menu yang sesuai.
     - Isi informasi yang dibutuhkan
     - Setelah mengisi semua informasi, klik tombol "Submit" untuk menyimpan pemesanan.

     -- Mengexport Pemesanan
        - Klik tombol "`Export`" maka list pemesanan di export ke file excel

7. Persetujuan Pemesanan Kendaraan (Approver)
   - Pada halaman dashboard pihak yang menyetujui, Anda dapat melihat daftar pemesanan yang perlu disetujui atau ditolak.
   - Pilih pemesanan yang ingin Anda tinjau.
   - Tinjau informasi pemesanan dan klik tombol "`Setujui`" atau "`Tolak`" untuk memberikan persetujuan atau penolakan.
   - Setelah mengambil keputusan, status pemesanan akan diperbarui.
