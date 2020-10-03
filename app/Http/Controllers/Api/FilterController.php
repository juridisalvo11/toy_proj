<?php

namespace App\Http\Controllers\Api;
use App\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function event(Request $request)
    {
        $events = Event::where('event_date', '>', $request->begin)->where('event_date', '<', $request->end)->where('title', $request->title)->get()->sortBy('created_at');

        if ($events->isEmpty()) {
            return response()->json([
                    'success' => true,
                    'length' => $events->count(),
                    "error" => "Nessun evento trovato",
                    'results' => []
            ]);

        } else {
            return response()->json([
                    'success' => true,
                    'length' => $events->count(),
                    'results' => $events
            ]);
        }
    }
}
