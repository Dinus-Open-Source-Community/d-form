# Google OAuth Setup untuk D-Form

Dokumentasi ini menjelaskan cara mengkonfigurasi Google OAuth untuk login di aplikasi D-Form.

## Langkah 1: Buat Project di Google Cloud Console

1. Kunjungi [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. Pastikan project Anda sudah aktif

## Langkah 2: Enable Google+ API

1. Di Google Cloud Console, buka menu **APIs & Services** → **Library**
2. Cari "Google+ API" atau "Google People API"
3. Klik **Enable** untuk mengaktifkan API

## Langkah 3: Buat OAuth 2.0 Credentials

1. Buka menu **APIs & Services** → **Credentials**
2. Klik **Create Credentials** → **OAuth client ID**
3. Jika diminta, konfigurasikan OAuth consent screen terlebih dahulu:
   - Pilih **External** (kecuali Anda menggunakan Google Workspace)
   - Isi informasi aplikasi:
     - App name: **D-Form** (atau nama aplikasi Anda)
     - User support email: email Anda
     - Developer contact information: email Anda
   - Klik **Save and Continue**
   - Di bagian Scopes, tambahkan scope berikut:
     - `.../auth/userinfo.email`
     - `.../auth/userinfo.profile`
   - Klik **Save and Continue**
   - Tambahkan test users jika masih dalam mode testing
   - Klik **Save and Continue**

4. Kembali ke **Credentials** → **Create Credentials** → **OAuth client ID**
5. Pilih **Application type**: **Web application**
6. Isi informasi:
   - Name: **D-Form Web Client** (atau nama lain)
   - Authorized JavaScript origins:
     ```
     http://localhost:8000
     http://127.0.0.1:8000
     https://yourdomain.com (untuk production)
     ```
   - Authorized redirect URIs:
     ```
     http://localhost:8000/auth/google/callback
     http://127.0.0.1:8000/auth/google/callback
     https://yourdomain.com/auth/google/callback (untuk production)
     ```
7. Klik **Create**
8. Salin **Client ID** dan **Client Secret** yang muncul

## Langkah 4: Konfigurasi di Aplikasi Laravel

1. Buka file `.env` di root project Anda
2. Tambahkan konfigurasi Google OAuth:

```env
# Google OAuth Configuration
GOOGLE_CLIENT_ID=your-client-id-here.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Untuk production
# GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
```

3. Ganti `your-client-id-here` dan `your-client-secret-here` dengan credentials yang Anda dapatkan dari Google Cloud Console

## Langkah 5: Testing

1. Jalankan aplikasi Laravel:
   ```bash
   php artisan serve
   ```

2. Buka browser dan akses halaman login:
   ```
   http://localhost:8000/admin/login
   ```

3. Klik tombol **Sign in with Google**

4. Anda akan diarahkan ke halaman login Google

5. Setelah berhasil login, Anda akan diarahkan kembali ke dashboard admin

## Troubleshooting

### Error: redirect_uri_mismatch

**Solusi**: Pastikan URL redirect yang dikonfigurasi di Google Cloud Console sama persis dengan URL di aplikasi Anda (termasuk protokol http/https dan port).

### Error: invalid_client

**Solusi**: Periksa kembali Client ID dan Client Secret di file `.env`. Pastikan tidak ada spasi atau karakter tambahan.

### Error: Access blocked: This app's request is invalid

**Solusi**: 
- Pastikan Google+ API atau Google People API sudah diaktifkan
- Periksa konfigurasi OAuth consent screen
- Jika masih dalam mode testing, pastikan email Anda sudah ditambahkan sebagai test user

### User tidak bisa login (bukan admin)

**Catatan**: Secara default, user yang login melalui Google OAuth akan dibuat sebagai user biasa. Jika Anda ingin user tertentu memiliki akses admin, Anda perlu:

1. Assign role admin melalui database atau seeder:
   ```php
   $user = User::where('email', 'admin@example.com')->first();
   $user->assignRole('admin');
   ```

2. Atau modifikasi controller `GoogleController.php` untuk assign role secara otomatis berdasarkan email tertentu.

## Konfigurasi untuk Production

Ketika deploy ke production:

1. Update Authorized redirect URIs di Google Cloud Console dengan domain production Anda
2. Update file `.env` di server production:
   ```env
   GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
   APP_URL=https://yourdomain.com
   ```

3. Publish OAuth consent screen (dari Testing ke Production) jika diperlukan

## Keamanan

- **JANGAN** commit file `.env` ke repository
- **JANGAN** share Client Secret secara publik
- Gunakan HTTPS di production
- Pertimbangkan untuk menambahkan rate limiting pada route OAuth

## Fitur Tambahan (Opsional)

### Logout

Untuk menambahkan fungsi logout, tambahkan route di `routes/web.php`:

```php
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
```

### Menampilkan Avatar User

Avatar user dari Google sudah disimpan di database. Untuk menampilkannya di UI, Anda bisa menggunakan:

```blade
@auth
    @if(auth()->user()->avatar)
        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="rounded-full w-10 h-10">
    @else
        <div class="rounded-full w-10 h-10 bg-gray-300 flex items-center justify-center">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
    @endif
@endauth
```

## Support

Jika mengalami masalah, silakan:
- Periksa log Laravel di `storage/logs/laravel.log`
- Periksa console browser untuk error JavaScript
- Pastikan semua migration sudah dijalankan: `php artisan migrate`

---

**Dibuat untuk D-Form (DOSCOM Form)**  
Laravel 12 + Livewire + Google OAuth

