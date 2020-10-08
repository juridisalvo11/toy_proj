@extends('layouts.app')
@section('page-title', "Details Event")

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-12" id="card-box">
          <div class="text-center">
              <h1>Event details</h1>
          </div>
          <div class="card m-auto" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{$event->title}}</h5>
              <p class="card-subtitle mb-2">{{$event->description}}</p>
              <p class="card-text">{{$event->event_date}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
