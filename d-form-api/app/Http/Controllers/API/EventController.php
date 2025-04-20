<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function count(string $timestamp)
    {


        $filters = "";
        switch($timestamp)
        {
            case "completed" :
                $filters="NOW() > DATE_ADD(start_date, INTERVAL duration_days DAY)";
                break;
            case "ongoing" :
                $filters="NOW() >= start_date AND NOW() <= DATE_ADD(start_date, INTERVAL duration_days DAY)";
                break;
            case "upcoming" :
                $filters="NOW() < start_date";
                break;
        }
        $count=Event::query()
        ->select('id')
        ->whereRaw($filters)
        ->count();

        

        return response()->json([
            'success' => true,
            'message' => 'Events count retrieved successfully',
            'data' => $count,

        ]);
    }
    public function index(Request $request)
    {
        $per_page = $request->query('per_page', 10);
        $current_page = $request->query('current_page', 1);




        $events = Event::query()
            ->when($request->query('search'), function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            // GROUPING LOGIC START
            // Fetch events based on timestamp parameter value. If none of timestamp
            // values [upcoming, ongoing, today] was sent to controller, it will fetch all
            // events.
            // Author : Felix
            ->when($request->query('timestamp') == 'today', function($query) {
                return $query->where('start_date', '=', Carbon::now());
            })
            ->when($request->query('timestamp') == 'upcoming', function($query) {
                return $query->where('start_date', '>', Carbon::now());
            })
            ->when($request->query('timestamp') == 'ongoing', function($query) {
                return $query->where('start_date', '<=', Carbon::now())
                ->whereRaw('DATE_ADD(start_date, INTERVAL duration_days DAY) >= NOW()');
            })
            // GROUPING LOGIC END
            ->with(['user'])
            ->paginate($per_page, ['*'], 'page', $current_page);



        if ($events->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No events found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Events retrieved successfully',
            'data' => $events->items(),
            'meta' => [
                'current_page' => $events->currentPage(),
                'last_page' => $events->lastPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'cover_event' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'address' => 'required|string|max:255',
            'map_url' => 'nullable|url',
            'gform_url' => 'nullable|url',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration_days' => 'required|integer|min:1',
            'participants' => 'required|integer|min:1',
            'type' => 'required|in:rkt,non-rkt',
            'division' => 'in:general,programming,multimedia,networking',
        ]);

        if ($request->hasFile('cover_event')) {
            $file = $request->file('cover_event');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/events'), $filename);
            $validated['cover_event'] = 'images/events/' . $filename;
        }

        $event = Event::create([
            'user_id' => $request->user()->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'cover_event' => $validated['cover_event'] ?? null,
            'address' => $validated['address'],
            'map_url' => $validated['map_url'],
            'gform_url' => $validated['gform_url'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'duration_days' => $validated['duration_days'],
            'participants' => $validated['participants'],
            'type' => $validated['type'],
            'division' => $validated['division'] ?? 'general',
        ]);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event creation failed',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => $event,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::where('id', $id)
            ->with(['user'])
            ->first();

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Event retrieved successfully',
            'data' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }

        if ($event->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'cover_event' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'address' => 'required|string|max:255',
            'map_url' => 'nullable|url',
            'gform_url' => 'nullable|url',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration_days' => 'required|integer|min:1',
            'participants' => 'required|integer|min:1',
            'type' => 'required|in:rkt,non-rkt',
            'division' => 'in:general,programming,multimedia,networking',
        ]);

        if ($request->hasFile('cover_event')) {
            $file = $request->file('cover_event');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/events'), $filename);
            $validated['cover_event'] = 'images/events/' . $filename;
        }

        $event->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => $event,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }

        if ($event->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        if ($event->participants()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete event with participants',
            ], 403);
        }

        if ($event->cover_event && file_exists(public_path($event->cover_event))) {
            unlink(public_path($event->cover_event));
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully',
        ]);
    }
}
