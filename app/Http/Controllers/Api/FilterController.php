<?php

namespace App\Http\Controllers\Api;
use App\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function event(Request $request)
    {
        //Imposto la query per filtrare gli evnti per nome e data
        $events = Event::where('event_date', '>', $request->begin)->where('event_date', '<', $request->end)->where('title', $request->title)->get()->sortBy('created_at');

        //Se non c'è nessun evento imposto un messaggio d'errore
        if ($events->isEmpty()) {
            return response()->json([
                    'success' => true,
                    'length' => $events->count(),
                    "error" => "Nessun evento trovato",
                    'results' => []
            ]);

        } else {
          //altrimenti mostro gli eventi filtrati
            return response()->json([
                    'success' => true,
                    'length' => $events->count(),
                    'results' => $events
            ]);
        }
    }
}
