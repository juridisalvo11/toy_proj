@extends('layouts.app')
@section('page-title', "Edit Event")

@section('content')
<section class="create-event">
        <div class="container">
            <div class="row">
                <div clas="col-12">
                    <div class="text-center">
                        <h1>Event edit</h1>
                    </div>
                    <div>
                        <form action="{{route('events.update', ['event' => $event->id])}}" method="post">
                        @method('PUT')
                        @csrf
                            <div class="form-group">
                                <label for="eventTitle">Insert event title :</label>
                                <input type=text class="form-control" name="title" value="{{$event->title}}" id="event-title">
                            </div>
                            <div class="form-group">
                                <label for="eventDescription">Insert event description :</label>
                                <textarea class="form-control" name="description" id="">{{$event->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="eventDate">Insert event date :</label>
                                <input type="date" class="form-control" name="event_date" id="eventDate" value="{{$event->event_date}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Event</button>
                            <input id="checkbox-year" type="checkbox" name="every_year" value="ogni_anno" {{old('every_year', $event->every_year) ? 'checked' : ''}}> Every year
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
