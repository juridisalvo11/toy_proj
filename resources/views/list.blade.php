@extends('layouts.app')
@section('page-title', 'Homepage')

@section('content')
<section class="event-order">
      <div class="box-every-year">
        <div class="every_year_event">
          <div class="notification-event">
            <span>Every year events : </span>
            @foreach ($events as $event)
              @if ($event->every_year == 1)
              <span>{{$event->title}} ; </span>
              @endif
            @endforeach
          </div>
        </div>
      </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="new_event" class="text-center">
                      <section class="create-event">
                          <div class="container">
                              <div class="row">
                                  <div clas="col-12">
                                      <div>
                                          <h1>Insert new event</h1>
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
                                              <input id="checkbox-year" type="checkbox" name="every_year" value="ogni_anno"> Every year
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section>
                    </div>
                    <div class="event-list">
                            <div class="form-group">
                                <label for="eventTitleSearch">Search event title :</label>
                                <input type=text class="form-control" id="eventTitleSearch" placeholder="Event title">
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
                            </div>
                            <div class="buttons d-flex justify-content-flex-start">
                              <div class="text-center">
                                  <button id="filter-button" class="btn btn-primary mr-3">Filter event</button>
                              </div>
                              <div class="text-center">
                                  <button id="filter-reset" class="btn btn-primary">Reset filter</button>
                              </div>
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
                            <tr class="text-center">
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
                                    <a href="">Every year</a>
                                </th>
                                <th>
                                    <a href="">Actions</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="events-table">
                            @foreach ($events as $event)
                            <tr class="text-center events-list">
                                <td>{{$event->id}}</td>
                                <td class="titleCopy" value="title-copy">{{$event->title}}</td>
                                <td>{{$event->description}}</td>
                                <td class="dateCopy" value="date-copy">{{$event->event_date}}</td>
                                <td class="every_year_choose">{{($event->every_year == 0) ? '' : 'si'}}</td>
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
          <script id="event-template" type="text/x-handlebars-template">
                      <tr class="text-center box-template">
                        <td>@{{id}}</td>
                        <td class="titleCopy" value="title-copy">@{{title}}</td>
                        <td>@{{description}}</td>
                        <td class="dateCopy" value="date-copy">@{{date}}</td>
                        <td class="every_year_choose">@{{every_year}}</td>
                        <td>
                            <button class="copyText">
                                <i class="fas fa-copy"></i>
                            </button>
                            <a class="btn btn-info btn-sm" href="localhost:8000/events/@{{id}}">Details</a>
                            <a class="btn btn-warning btn-sm" href="localhost:8000/events/@{{id}}/edit">Edit</a>
                            <form class="d-inline" action="localhost:8000/events/@{{id}}"
                            method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit" name="button">Delete</button>
                            </form>
                          </td>
                      </tr>
          </script>
    </section>
@endsection
