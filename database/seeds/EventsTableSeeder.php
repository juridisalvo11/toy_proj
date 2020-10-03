<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = config('events.list_events');

        foreach ($events as $event) {
            $newEvent = new Event();
            $newEvent->title = $event['title'];
            $newEvent->description = $event['description'];
            $newEvent->event_date = $event['date'];
            $newEvent->save();
        }
    }
}
