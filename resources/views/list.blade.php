@extends('layouts.app')
@section('page-title', 'Homepage')

@section('content')
<section class="event-order">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="new_event" class="text-center mt-5 mb-5">
                        <a class="btn btn-primary btn-sm" href="{{route('events.create')}}">Create a new event</a>
                    </div>
                    <div class="event-list">

                            <div class="form-group">
                                <label for="eventTitle">Search title :</label>
                                <input type=text class="form-control" id="eventTitle" placeholder="Event title">
                            </div>
                            <div class="filters-list">
                                <div class="form-group filter-input">
                                    <label for="eventDate">From :</label>
                                    <input type="date" name="begin" class="form-control" id="eventDateFrom">
                                </div>
                                <div class="form-group filter-input">
                                    <label for="eventDate">To :</label>
                                    <input type="date" name="end" class="form-control" id="eventDateto">
                                </div>
                                {{-- <div class="form-group every-year">
                                <label for="everyYear">Every Year :</label>
                                <input class="d-block" type="checkbox" name="everyYear">
                                </div> --}}
                            </div>
                            <div class="text-center">
                                <button id="filter-button" class="btn btn-primary">Filter event</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="event-box">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="">ID</a>
                                </th>
                                <th>
                                    <a href="">Title</a>
                                </th>
                                <th>
                                    <a href="">Description</a>
                                </th>
                                <th>
                                    <a href="">Date</a>
                                </th>
                                <th>
                                    <a href="">Actions</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="events-table">
                            @foreach ($events as $event)
                            <tr>
                                <td>{{$event->id}}</td>
                                <td class="titleCopy" value="title-copy">{{$event->title}}</td>
                                <td>{{$event->description}}</td>
                                <td class="dateCopy" value="date-copy">{{$event->event_date}}</td>
                                <td>
                                    <button class="copyText">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    <a class="btn btn-info btn-sm" href="{{route('events.show', ['event' => $event->id])}}">Details</a>
                                    <a class="btn btn-warning btn-sm" href="{{route('events.edit', ['event' => $event->id])}}">Edit</a>
                                    <form class="d-inline" action="{{route('events.destroy', ['event' => $event->id])}}"
                                    method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" name="button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="box-template">
          <script id="event-template" type="text/x-handlebars-template">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <table class="table">
                    <tbody class="events-table">
                      <td>@{{id}}</td>
                      <td class="titleCopy" value="title-copy">@{{title}}</td>
                      <td>@{{description}}</td>
                      <td class="dateCopy" value="date-copy">@{{date}}</td>
                      <td>
                          <button class="copyText">
                              <i class="fas fa-copy"></i>
                          </button>
                          <a class="btn btn-info btn-sm" href="{{route('events.show', ['event' => $event->id])}}">Details</a>
                          <a class="btn btn-warning btn-sm" href="{{route('events.edit', ['event' => $event->id])}}">Edit</a>
                          <form class="d-inline" action="{{route('events.destroy', ['event' => $event->id])}}"
                          method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit" name="button">Delete</button>
                          </form>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </script>
        </div>
    </section>
@endsection
