<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //Recupero tutti gli eventi ordinandoli per data di creazione
        $events = Event::all()->sortBy('created_at');
        //ritorno alla view homepage
        return view('list', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //ritorno la view per creare un nuovo evento
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //valido i dati pervenuti lato-cliet
      $request->validate([
          "title" => "required|string|max:255",
          "description" => "nullable",
          "event_date" => "required"
          ]);
        //recupero i dati
          $data = $request->all();
          if(isset($request->every_year)) {
            $data['every_year'] = true;
          } else {
            $data['every_year'] = false;
          }
          //creo un nuov evento
          $new_event = new Event();
          //vado a riempire il database con i dati
          $new_event->fill($data);
          //salvo i dati nel database
          $new_event->save();
          //una volta salvati i dati faccio un redirect all'homepage
          return redirect()->route('list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //recupero il singolo evento tramite l'id
        $event = Event::find($id);
        //ritorno la view show con i dettagli del singolo evento
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //recupero il singolo evento tramite l'id
        $event = Event::find($id);
        //ritorno la view edit per modificare il singolo evento
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event)
    {
        //recupero i dati
           $data = $request->all();
           if(isset($request->every_year)) {
             $data['every_year'] = true;
           } else {
             $data['every_year'] = false;
           }
           //cerco il singolo evento da modificare
           $event = Event::find($event);
           //modifico il singolo evento
           $event->update($data);
           //faccio un redirect all'homepage
           return redirect()->route('list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {     //recupero il singolo evento tramite l'id
            $event = Event::find($id);
            // elimino l'evento
            $event->delete();
            //faccio un redirect all'homepage
            return redirect()->route('list');
    }
}
