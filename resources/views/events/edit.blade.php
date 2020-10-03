@extends('layouts.app')
@section('page-title', "Edit Event")

@section('content')
<section class="create-event">
        <div class="container">
            <div class="row">
                <div clas="col-12">
                    <div>
                        <h1>Inserisci nuovo evento</h1>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        <form action="{{route('events.update', ['event' => $event->id])}}" method="post">
                        @method('PUT')
                        @csrf
                            <div class="form-group">
                                <label for="eventTitle">Insert event title :</label>
                                <input type=text class="form-control" name="title" value="{{$event->title}}" id="event-title">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="eventDescription">Insert event description :</label>
                                <textarea class="form-control" name="description" id="">{{$event->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="eventDate">Insert event date :</label>
                                <input type="date" class="form-control" name="event_date" id="eventDate" value="{{$event->event_date}}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update event</button>
                            <input type="checkbox" aria-label="Checkbox for following text input"> Every year
                        </form>
                    </div>                
                </div>
            </div>
        </div>
    </section>
@endsection

