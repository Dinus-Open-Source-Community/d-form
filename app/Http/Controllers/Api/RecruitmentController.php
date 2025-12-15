<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecruitmentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/recruitments",
     *     tags={"Recruitments"},
     *     summary="Get all recruitments",
     *     description="Retrieve a list of all recruitments with optional filters",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status (pending, approved, rejected)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"pending", "approved", "rejected"})
     *     ),
     *     @OA\Parameter(
     *         name="division",
     *         in="query",
     *         description="Filter by division",
     *         required=false,
     *         @OA\Schema(type="string", enum={"Pemrograman", "Data", "Jaringan", "Medcrev"})
     *     ),
     *     @OA\Parameter(
     *         name="semester",
     *         in="query",
     *         description="Filter by semester",
     *         required=false,
     *         @OA\Schema(type="string", enum={"1", "3"})
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by name, NIM, email, or phone",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Recruitment")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $query = Recruitment::query()->with('reviewer');

        if ($request->has('status')) {
            $query->byStatus($request->status);
        }

        if ($request->has('division')) {
            $query->byDivision($request->division);
        }

        if ($request->has('semester')) {
            $query->bySemester($request->semester);
        }

        if ($request->has('search')) {
            $query->search($request->search);
        }

        $recruitments = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $recruitments
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/recruitments/statistics",
     *     tags={"Recruitments"},
     *     summary="Get recruitment statistics",
     *     description="Retrieve overall recruitment statistics",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer", example=150),
     *                 @OA\Property(property="pending", type="integer", example=50),
     *                 @OA\Property(property="approved", type="integer", example=80),
     *                 @OA\Property(property="rejected", type="integer", example=20),
     *                 @OA\Property(property="today", type="integer", example=5),
     *                 @OA\Property(property="this_week", type="integer", example=25),
     *                 @OA\Property(property="this_month", type="integer", example=100)
     *             )
     *         )
     *     )
     * )
     */
    public function statistics(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Recruitment::getStatistics()
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/recruitments/division-statistics",
     *     tags={"Recruitments"},
     *     summary="Get division-wise statistics",
     *     description="Retrieve recruitment statistics grouped by division",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="Pemrograman",
     *                     type="object",
     *                     @OA\Property(property="total", type="integer", example=60),
     *                     @OA\Property(property="approved", type="integer", example=40),
     *                     @OA\Property(property="pending", type="integer", example=15),
     *                     @OA\Property(property="rejected", type="integer", example=5)
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function divisionStatistics(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Recruitment::getDivisionStatistics()
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/recruitments/{shortUuid}",
     *     tags={"Recruitments"},
     *     summary="Get recruitment by short UUID",
     *     description="Retrieve a single recruitment by its short UUID",
     *     @OA\Parameter(
     *         name="shortUuid",
     *         in="path",
     *         description="Recruitment short UUID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Recruitment")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recruitment not found"
     *     )
     * )
     */
    public function show(string $shortUuid): JsonResponse
    {
        $recruitment = Recruitment::where('short_uuid', $shortUuid)->with('reviewer')->first();

        if (!$recruitment) {
            return response()->json([
                'success' => false,
                'message' => 'Recruitment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $recruitment
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/recruitments",
     *     tags={"Recruitments"},
     *     summary="Create a new recruitment",
     *     description="Submit a new recruitment application",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_lengkap", "nim", "semester", "nomor_hp", "email_pribadi", "email_mahasiswa", "divisi_utama"},
     *             @OA\Property(property="nama_lengkap", type="string", example="John Doe"),
     *             @OA\Property(property="nim", type="string", example="A11.2023.12345"),
     *             @OA\Property(property="semester", type="string", enum={"1", "3"}, example="3"),
     *             @OA\Property(property="nomor_hp", type="string", example="081234567890"),
     *             @OA\Property(property="email_pribadi", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="email_mahasiswa", type="string", format="email", example="111202312345@mhs.dinus.ac.id"),
     *             @OA\Property(property="divisi_utama", type="string", enum={"Pemrograman", "Data", "Jaringan", "Medcrev"}, example="Pemrograman"),
     *             @OA\Property(property="divisi_tambahan", type="string", enum={"Pemrograman", "Data", "Jaringan", "Medcrev"}, example="Data"),
     *             @OA\Property(property="username_instagram", type="string", example="@johndoe"),
     *             @OA\Property(property="portofolio", type="string", example="https://github.com/johndoe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Recruitment created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Recruitment created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Recruitment")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|unique:recruitments,nim',
            'semester' => 'required|in:1,3',
            'nomor_hp' => 'required|string',
            'email_pribadi' => 'required|email',
            'email_mahasiswa' => 'required|email',
            'divisi_utama' => 'required|in:Pemrograman,Data,Jaringan,Medcrev',
            'divisi_tambahan' => 'nullable|in:Pemrograman,Data,Jaringan,Medcrev',
            'username_instagram' => 'nullable|string',
            'portofolio' => 'nullable|string',
        ]);

        // Generate short UUID
        $validated['short_uuid'] = strtoupper(substr(md5(uniqid()), 0, 8));
        $validated['status'] = 'pending';

        $recruitment = Recruitment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Recruitment created successfully',
            'data' => $recruitment
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/recruitments/{shortUuid}",
     *     tags={"Recruitments"},
     *     summary="Update recruitment",
     *     description="Update an existing recruitment application",
     *     @OA\Parameter(
     *         name="shortUuid",
     *         in="path",
     *         description="Recruitment short UUID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_lengkap", type="string", example="John Doe Updated"),
     *             @OA\Property(property="nomor_hp", type="string", example="081234567899"),
     *             @OA\Property(property="divisi_utama", type="string", enum={"Pemrograman", "Data", "Jaringan", "Medcrev"}),
     *             @OA\Property(property="divisi_tambahan", type="string", enum={"Pemrograman", "Data", "Jaringan", "Medcrev"}),
     *             @OA\Property(property="portofolio", type="string", example="https://github.com/johndoe-updated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recruitment updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recruitment not found"
     *     )
     * )
     */
    public function update(Request $request, string $shortUuid): JsonResponse
    {
        $recruitment = Recruitment::where('short_uuid', $shortUuid)->first();

        if (!$recruitment) {
            return response()->json([
                'success' => false,
                'message' => 'Recruitment not found'
            ], 404);
        }

        $validated = $request->validate([
            'nama_lengkap' => 'sometimes|string|max:255',
            'nomor_hp' => 'sometimes|string',
            'email_pribadi' => 'sometimes|email',
            'divisi_utama' => 'sometimes|in:Pemrograman,Data,Jaringan,Medcrev',
            'divisi_tambahan' => 'nullable|in:Pemrograman,Data,Jaringan,Medcrev',
            'username_instagram' => 'nullable|string',
            'portofolio' => 'nullable|string',
        ]);

        $recruitment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Recruitment updated successfully',
            'data' => $recruitment
        ]);
    }

    /**
     * @OA\Patch(
     *     path="/api/recruitments/{shortUuid}/review",
     *     tags={"Recruitments"},
     *     summary="Review recruitment application",
     *     description="Approve or reject a recruitment application (admin only)",
     *     @OA\Parameter(
     *         name="shortUuid",
     *         in="path",
     *         description="Recruitment short UUID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"approved", "rejected"}, example="approved"),
     *             @OA\Property(property="catatan", type="string", example="Kandidat yang sangat baik")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recruitment reviewed successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recruitment not found"
     *     )
     * )
     */
    public function review(Request $request, string $shortUuid): JsonResponse
    {
        $recruitment = Recruitment::where('short_uuid', $shortUuid)->first();

        if (!$recruitment) {
            return response()->json([
                'success' => false,
                'message' => 'Recruitment not found'
            ], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'catatan' => 'nullable|string',
        ]);

        $recruitment->update([
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? null,
            'reviewed_by' => auth()->id() ?? 1,
            'reviewed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Recruitment reviewed successfully',
            'data' => $recruitment
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/recruitments/{shortUuid}",
     *     tags={"Recruitments"},
     *     summary="Delete recruitment",
     *     description="Soft delete a recruitment application",
     *     @OA\Parameter(
     *         name="shortUuid",
     *         in="path",
     *         description="Recruitment short UUID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recruitment deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recruitment not found"
     *     )
     * )
     */
    public function destroy(string $shortUuid): JsonResponse
    {
        $recruitment = Recruitment::where('short_uuid', $shortUuid)->first();

        if (!$recruitment) {
            return response()->json([
                'success' => false,
                'message' => 'Recruitment not found'
            ], 404);
        }

        $recruitment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Recruitment deleted successfully'
        ]);
    }
}
