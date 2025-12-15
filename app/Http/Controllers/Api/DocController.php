<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="D-Form API Documentation",
 *         description="Dokumentasi API lengkap untuk D-Form - Platform manajemen event dan recruitment DOSCOM",
 *         @OA\Contact(
 *             email="doscom@dinus.ac.id",
 *             name="DOSCOM - Dinus Open Source Community"
 *         ),
 *         @OA\License(
 *             name="MIT",
 *             url="https://opensource.org/licenses/MIT"
 *         )
 *     ),
 *     @OA\Server(
 *         url=L5_SWAGGER_CONST_HOST,
 *         description="Development Server"
 *     ),
 *     @OA\Server(
 *         url="http://localhost:8000",
 *         description="Local Development Server"
 *     )
 * )
 *
 * @OA\Tag(
 *     name="System",
 *     description="System endpoints untuk testing dan health check"
 * )
 *
 * @OA\Tag(
 *     name="Events",
 *     description="Endpoints untuk manajemen event"
 * )
 *
 * @OA\Tag(
 *     name="Recruitments",
 *     description="Endpoints untuk manajemen recruitment/pendaftaran anggota"
 * )
 *
 * @OA\Tag(
 *     name="Participants",
 *     description="Endpoints untuk manajemen peserta event"
 * )
 */
class DocController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/ping",
     *     tags={"System"},
     *     summary="Ping test untuk Swagger",
     *     @OA\Response(
     *         response=200,
     *         description="Swagger aktif meski backend pakai Livewire"
     *     )
     * )
     */
    public function ping()
    {
        return response()->json(['message' => 'Swagger & Livewire jalan bareng!']);
    }
}
