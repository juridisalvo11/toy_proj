@extends('layouts.app')
@section('page-title', "Create Event")

@section('content')
    <section class="create-event">
        <div class="container">
            <div class="row">
                <div clas="col-12">
                    <div>
                        <h1>Inserisci nuovo evento</h1>
                    </div>
                    <div>
                        <form action="{{route('events.store')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="eventTitle">Insert event title :</label>
                                <input type=text class="form-control" name="title" id="eventTitle" placeholder="Event title">
                            </div>
                            <div class="form-group">
                                <label for="eventDescription">Insert event description :</label>
                                <textarea class="form-control" name="description" id="eventDescription"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="eventDate">Insert event date :</label>
                                <input type="date" name="event_date" class="form-control" id="eventDate">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Event</button>
                            <input type="checkbox" aria-label="Checkbox for following text input"> Every year
                        </form>
                    </div>                
                </div>
            </div>
        </div>
    </section>
@endsection

