<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/events",
     *     tags={"Events"},
     *     summary="Get all events",
     *     description="Retrieve a list of all events with optional filters",
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter by event type",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="division",
     *         in="query",
     *         description="Filter by division",
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
     *                 @OA\Items(ref="#/components/schemas/Event")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $query = Event::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('division')) {
            $query->where('division', $request->division);
        }

        $events = $query->with('user')->orderBy('start_date', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/events/{id}",
     *     tags={"Events"},
     *     summary="Get event by ID",
     *     description="Retrieve a single event by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Event ID (UUID)",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Event")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Event not found")
     *         )
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        $event = Event::with(['user', 'participantList'])->find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/events",
     *     tags={"Events"},
     *     summary="Create a new event",
     *     description="Create a new event (requires authentication)",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "start_date", "start_time", "end_time", "duration_days", "type"},
     *             @OA\Property(property="name", type="string", example="Workshop Laravel"),
     *             @OA\Property(property="description", type="string", example="Workshop tentang Laravel framework"),
     *             @OA\Property(property="price", type="number", example=50000),
     *             @OA\Property(property="address", type="string", example="Gedung A Lantai 3"),
     *             @OA\Property(property="map_url", type="string", example="https://maps.google.com/..."),
     *             @OA\Property(property="gform_url", type="string", example="https://forms.google.com/..."),
     *             @OA\Property(property="start_date", type="string", format="date", example="2025-12-15"),
     *             @OA\Property(property="start_time", type="string", format="time", example="09:00:00"),
     *             @OA\Property(property="end_time", type="string", format="time", example="17:00:00"),
     *             @OA\Property(property="duration_days", type="integer", example=1),
     *             @OA\Property(property="participants", type="integer", example=50),
     *             @OA\Property(property="type", type="string", example="workshop"),
     *             @OA\Property(property="division", type="string", example="Pemrograman")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Event created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Event created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Event")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'address' => 'nullable|string',
            'map_url' => 'nullable|url',
            'gform_url' => 'nullable|url',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration_days' => 'required|integer|min:1',
            'participants' => 'nullable|integer',
            'type' => 'required|string',
            'division' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id() ?? 1; // Default to user 1 if not authenticated

        $event = Event::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => $event
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/events/{id}",
     *     tags={"Events"},
     *     summary="Update an event",
     *     description="Update an existing event by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Event ID (UUID)",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Workshop Laravel Updated"),
     *             @OA\Property(property="description", type="string", example="Updated description"),
     *             @OA\Property(property="price", type="number", example=75000),
     *             @OA\Property(property="address", type="string", example="Gedung B Lantai 2"),
     *             @OA\Property(property="map_url", type="string", example="https://maps.google.com/..."),
     *             @OA\Property(property="gform_url", type="string", example="https://forms.google.com/..."),
     *             @OA\Property(property="start_date", type="string", format="date", example="2025-12-20"),
     *             @OA\Property(property="start_time", type="string", format="time", example="10:00:00"),
     *             @OA\Property(property="end_time", type="string", format="time", example="16:00:00"),
     *             @OA\Property(property="duration_days", type="integer", example=2),
     *             @OA\Property(property="participants", type="integer", example=100),
     *             @OA\Property(property="type", type="string", example="seminar"),
     *             @OA\Property(property="division", type="string", example="Data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Event updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Event")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
     *     )
     * )
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'nullable|numeric',
            'address' => 'nullable|string',
            'map_url' => 'nullable|url',
            'gform_url' => 'nullable|url',
            'start_date' => 'sometimes|date',
            'start_time' => 'sometimes',
            'end_time' => 'sometimes',
            'duration_days' => 'sometimes|integer|min:1',
            'participants' => 'nullable|integer',
            'type' => 'sometimes|string',
            'division' => 'nullable|string',
        ]);

        $event->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => $event
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/events/{id}",
     *     tags={"Events"},
     *     summary="Delete an event",
     *     description="Delete an event by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Event ID (UUID)",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Event deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
     *     )
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }
}
