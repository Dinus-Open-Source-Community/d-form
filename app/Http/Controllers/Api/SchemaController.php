<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\Schema(
 *     schema="Event",
 *     type="object",
 *     title="Event",
 *     description="Event model",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d4e5f6a-7b8c-9d0e-1f2a-3b4c5d6e7f8a"),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Workshop Laravel"),
 *     @OA\Property(property="description", type="string", example="Workshop tentang Laravel framework"),
 *     @OA\Property(property="price", type="number", format="float", example=50000),
 *     @OA\Property(property="cover_event", type="string", nullable=true, example="http://localhost/storage/events/cover.jpg"),
 *     @OA\Property(property="address", type="string", example="Gedung A Lantai 3"),
 *     @OA\Property(property="map_url", type="string", example="https://maps.google.com/..."),
 *     @OA\Property(property="gform_url", type="string", example="https://forms.google.com/..."),
 *     @OA\Property(property="start_time", type="string", format="time", example="09:00:00"),
 *     @OA\Property(property="end_time", type="string", format="time", example="17:00:00"),
 *     @OA\Property(property="duration_days", type="integer", example=1),
 *     @OA\Property(property="participants", type="integer", example=50),
 *     @OA\Property(property="type", type="string", example="workshop"),
 *     @OA\Property(property="division", type="string", example="Pemrograman"),
 *     @OA\Property(property="start_date", type="string", format="date", example="2025-12-15"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-12-08T12:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-12-08T12:00:00.000000Z")
 * )
 *
 * @OA\Schema(
 *     schema="Recruitment",
 *     type="object",
 *     title="Recruitment",
 *     description="Recruitment model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="short_uuid", type="string", example="ABC12345"),
 *     @OA\Property(property="nama_lengkap", type="string", example="John Doe"),
 *     @OA\Property(property="nim", type="string", example="A11.2023.12345"),
 *     @OA\Property(property="semester", type="string", enum={"1", "3"}, example="3"),
 *     @OA\Property(property="nomor_hp", type="string", example="081234567890"),
 *     @OA\Property(property="email_pribadi", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="email_mahasiswa", type="string", format="email", example="111202312345@mhs.dinus.ac.id"),
 *     @OA\Property(property="divisi_utama", type="string", enum={"Pemrograman", "Data", "Jaringan", "Medcrev"}, example="Pemrograman"),
 *     @OA\Property(property="divisi_tambahan", type="string", nullable=true, enum={"Pemrograman", "Data", "Jaringan", "Medcrev"}, example="Data"),
 *     @OA\Property(property="cv", type="string", nullable=true, example="recruitments/cv/file.pdf"),
 *     @OA\Property(property="portofolio", type="string", nullable=true, example="https://github.com/johndoe"),
 *     @OA\Property(property="bukti_follow_instagram", type="string", nullable=true, example="recruitments/instagram/proof.jpg"),
 *     @OA\Property(property="bukti_follow_linkedin", type="string", nullable=true, example="recruitments/linkedin/proof.jpg"),
 *     @OA\Property(property="username_instagram", type="string", nullable=true, example="@johndoe"),
 *     @OA\Property(property="status", type="string", enum={"pending", "approved", "rejected"}, example="pending"),
 *     @OA\Property(property="catatan", type="string", nullable=true, example="Kandidat yang baik"),
 *     @OA\Property(property="reviewed_by", type="integer", nullable=true, example=1),
 *     @OA\Property(property="reviewed_at", type="string", format="date-time", nullable=true, example="2025-12-08T12:00:00.000000Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-12-08T12:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-12-08T12:00:00.000000Z"),
 *     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true, example=null)
 * )
 *
 * @OA\Schema(
 *     schema="Participant",
 *     type="object",
 *     title="Participant",
 *     description="Participant model",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d4e5f6a-7b8c-9d0e-1f2a-3b4c5d6e7f8a"),
 *     @OA\Property(property="event_id", type="string", format="uuid", example="9d4e5f6a-7b8c-9d0e-1f2a-3b4c5d6e7f8a"),
 *     @OA\Property(property="name", type="string", example="Jane Smith"),
 *     @OA\Property(property="school", type="string", example="Universitas Dian Nuswantoro"),
 *     @OA\Property(property="email", type="string", format="email", example="jane@example.com"),
 *     @OA\Property(property="is_presence", type="boolean", example=false),
 *     @OA\Property(property="presence_at", type="string", format="date-time", nullable=true, example=null),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-12-08T12:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-12-08T12:00:00.000000Z")
 * )
 */
class SchemaController extends Controller
{
    // This controller is only used for Swagger schema definitions
}
