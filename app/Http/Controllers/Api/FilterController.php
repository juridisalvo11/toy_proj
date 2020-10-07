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
        if(isset($request->begin)) {
          if(isset($events)) {
            $events = $events->where('event_date', '>', $request->begin);
          }else {
            $events = Event::where('event_date', '>', $request->begin);
          }
        }
        if(isset($request->end)) {
          if(isset($events)) {
            $events = $events->where('event_date', '<', $request->end);
          }else {
            $events= Event::where('event_date', '<', $request->end);
          }

        }
        if(isset($request->title)) {
          if(isset($events)) {
            $events = $events->where('title', '=', $request->title);
          }else {
            $events = Event::where('title', '=', $request->title);
          }
        }

        if(isset($events)) {
          $events = $events->orderByDesc('created_at')->get();
        }



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
