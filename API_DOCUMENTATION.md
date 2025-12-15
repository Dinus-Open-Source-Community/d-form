# D-Form API Documentation

Dokumentasi API lengkap untuk D-Form menggunakan Swagger/OpenAPI 3.0

## 📚 Akses Dokumentasi

Setelah menjalankan aplikasi, dokumentasi Swagger dapat diakses di:

```
http://localhost:8000/api/documentation
```

## 🚀 Generate Dokumentasi

Untuk me-regenerate dokumentasi Swagger setelah melakukan perubahan pada API:

```bash
php artisan l5-swagger:generate
```

## 📋 Endpoints yang Tersedia

### System
- `GET /api/ping` - Health check endpoint

### Events
- `GET /api/events` - Get all events (dengan filter optional)
- `GET /api/events/{id}` - Get event by ID
- `POST /api/events` - Create new event
- `PUT /api/events/{id}` - Update event
- `DELETE /api/events/{id}` - Delete event

### Recruitments
- `GET /api/recruitments` - Get all recruitments (dengan filter optional)
- `GET /api/recruitments/statistics` - Get recruitment statistics
- `GET /api/recruitments/division-statistics` - Get division-wise statistics
- `GET /api/recruitments/{shortUuid}` - Get recruitment by short UUID
- `POST /api/recruitments` - Create new recruitment
- `PUT /api/recruitments/{shortUuid}` - Update recruitment
- `PATCH /api/recruitments/{shortUuid}/review` - Review recruitment (approve/reject)
- `DELETE /api/recruitments/{shortUuid}` - Delete recruitment

### Participants
- `GET /api/participants` - Get all participants (dengan filter optional)
- `GET /api/participants/{id}` - Get participant by ID
- `POST /api/participants` - Register new participant
- `PUT /api/participants/{id}` - Update participant
- `PATCH /api/participants/{id}/presence` - Mark participant presence
- `DELETE /api/participants/{id}` - Delete participant

## 🔧 Konfigurasi

Konfigurasi Swagger dapat diubah di:
- `config/l5-swagger.php` - Konfigurasi utama L5-Swagger
- `.env` - Environment variables untuk Swagger

### Environment Variables

```env
L5_SWAGGER_CONST_HOST=http://localhost:8000
L5_SWAGGER_GENERATE_ALWAYS=false
L5_SWAGGER_UI_DARK_MODE=false
```

## 📝 Cara Menambahkan Dokumentasi Baru

1. **Untuk endpoint baru**, tambahkan annotation di controller method:

```php
/**
 * @OA\Get(
 *     path="/api/your-endpoint",
 *     tags={"YourTag"},
 *     summary="Summary of endpoint",
 *     description="Detailed description",
 *     @OA\Response(
 *         response=200,
 *         description="Success response"
 *     )
 * )
 */
public function yourMethod()
{
    // Your code
}
```

2. **Untuk model schema baru**, tambahkan di `SchemaController.php`:

```php
/**
 * @OA\Schema(
 *     schema="YourModel",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string")
 * )
 */
```

3. **Generate ulang dokumentasi**:

```bash
php artisan l5-swagger:generate
```

## 🎯 Testing API

Anda dapat test API langsung dari Swagger UI dengan:
1. Buka `http://localhost:8000/api/documentation`
2. Pilih endpoint yang ingin di-test
3. Klik "Try it out"
4. Isi parameter yang diperlukan
5. Klik "Execute"

## 📦 File Struktur

```
app/
└── Http/
    └── Controllers/
        └── Api/
            ├── DocController.php          # OpenAPI spec & ping endpoint
            ├── EventController.php        # Event CRUD endpoints
            ├── RecruitmentController.php  # Recruitment endpoints
            ├── ParticipantController.php  # Participant endpoints
            └── SchemaController.php       # Model schemas

routes/
└── api.php                                # API routes definition

config/
└── l5-swagger.php                         # Swagger configuration

storage/
└── api-docs/
    └── api-docs.json                      # Generated Swagger JSON
```

## 🔍 Tips

1. **Auto-generate on request** (Development only):
   ```env
   L5_SWAGGER_GENERATE_ALWAYS=true
   ```
   
2. **Dark Mode UI**:
   ```env
   L5_SWAGGER_UI_DARK_MODE=true
   ```

3. **Custom Host**:
   ```env
   L5_SWAGGER_CONST_HOST=https://your-domain.com
   ```

## 📖 Referensi

- [L5-Swagger Documentation](https://github.com/DarkaOnLine/L5-Swagger)
- [OpenAPI Specification](https://swagger.io/specification/)
- [Swagger PHP Annotations](https://zircote.github.io/swagger-php/)

## 🐛 Troubleshooting

### Permission Denied Error
```bash
sudo chown -R $USER:$USER storage/
chmod -R 775 storage/
```

### Swagger UI Not Loading
1. Clear cache: `php artisan cache:clear`
2. Regenerate docs: `php artisan l5-swagger:generate`
3. Check storage permissions

### Changes Not Reflected
1. Regenerate documentation: `php artisan l5-swagger:generate`
2. Clear browser cache
3. Hard refresh (Ctrl+Shift+R)
