<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ParticipantController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/participants",
     *     tags={"Participants"},
     *     summary="Get all participants",
     *     description="Retrieve a list of all participants with optional event filter",
     *     @OA\Parameter(
     *         name="event_id",
     *         in="query",
     *         description="Filter by event ID",
     *         required=false,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Parameter(
     *         name="is_presence",
     *         in="query",
     *         description="Filter by presence status",
     *         required=false,
     *         @OA\Schema(type="boolean")
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
     *                 @OA\Items(ref="#/components/schemas/Participant")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $query = Participant::query()->with('event');

        if ($request->has('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->has('is_presence')) {
            $query->where('is_presence', $request->boolean('is_presence'));
        }

        $participants = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $participants
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/participants/{id}",
     *     tags={"Participants"},
     *     summary="Get participant by ID",
     *     description="Retrieve a single participant by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Participant ID (UUID)",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Participant")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Participant not found"
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        $participant = Participant::with('event')->find($id);

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Participant not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $participant
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/participants",
     *     tags={"Participants"},
     *     summary="Register a new participant",
     *     description="Register a participant for an event",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"event_id", "name", "school", "email"},
     *             @OA\Property(property="event_id", type="string", format="uuid", example="9d4e5f6a-7b8c-9d0e-1f2a-3b4c5d6e7f8a"),
     *             @OA\Property(property="name", type="string", example="Jane Smith"),
     *             @OA\Property(property="school", type="string", example="Universitas Dian Nuswantoro"),
     *             @OA\Property(property="email", type="string", format="email", example="jane@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Participant registered successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Participant registered successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Participant")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
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
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $event = Event::find($validated['event_id']);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        $validated['is_presence'] = false;

        $participant = Participant::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Participant registered successfully',
            'data' => $participant
        ], 201);
    }

    /**
     * @OA\Patch(
     *     path="/api/participants/{id}/presence",
     *     tags={"Participants"},
     *     summary="Mark participant presence",
     *     description="Mark a participant as present for an event",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Participant ID (UUID)",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Presence marked successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Presence marked successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Participant")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Participant not found"
     *     )
     * )
     */
    public function markPresence(string $id): JsonResponse
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Participant not found'
            ], 404);
        }

        $participant->update([
            'is_presence' => true,
            'presence_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Presence marked successfully',
            'data' => $participant
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/participants/{id}",
     *     tags={"Participants"},
     *     summary="Update participant",
     *     description="Update participant information",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Participant ID (UUID)",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Jane Smith Updated"),
     *             @OA\Property(property="school", type="string", example="Universitas Dian Nuswantoro"),
     *             @OA\Property(property="email", type="string", format="email", example="jane.updated@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Participant updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Participant not found"
     *     )
     * )
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Participant not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'school' => 'sometimes|string|max:255',
            'email' => 'sometimes|email',
        ]);

        $participant->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Participant updated successfully',
            'data' => $participant
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/participants/{id}",
     *     tags={"Participants"},
     *     summary="Delete participant",
     *     description="Delete a participant registration",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Participant ID (UUID)",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Participant deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Participant not found"
     *     )
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Participant not found'
            ], 404);
        }

        $participant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Participant deleted successfully'
        ]);
    }
}
