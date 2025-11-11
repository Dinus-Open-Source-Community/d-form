# D-Form (DOSCOM Form)

---

## Deskripsi

D-Form adalah singkatan dari DOSCOM Form. D-Form adalah aplikasi berbasis web yang dibangun menggunakan framework Laravel dan React.js. Aplikasi ini bertujuan untuk mempermudah proses pendaftaran event yang diadakan oleh DOSCOM. Dengan D-Form, pengguna dapat dengan mudah mendaftar untuk berbagai event yang diadakan oleh DOSCOM, seperti seminar, workshop, dan lain-lain.

## Fitur

-   Melihat event yang tersedia
-   Melihat event yang akan datang
-   Pendaftaran event
-   Countdown event
-   Absensi menggunakan QR Code
-   **Login dengan Google OAuth** (Admin)

## Google OAuth Setup

Aplikasi ini mendukung login menggunakan akun Google untuk admin. Untuk mengaktifkan fitur ini:

1. Lihat dokumentasi lengkap di [GOOGLE_OAUTH_SETUP.md](GOOGLE_OAUTH_SETUP.md)
2. Dapatkan Google OAuth credentials dari [Google Cloud Console](https://console.cloud.google.com/)
3. Tambahkan konfigurasi ke file `.env`:
   ```env
   GOOGLE_CLIENT_ID=your-client-id-here
   GOOGLE_CLIENT_SECRET=your-client-secret-here
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```
4. Jalankan migration: `php artisan migrate`
5. Akses halaman login dan klik tombol "Sign in with Google"