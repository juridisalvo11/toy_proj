require('./bootstrap');

var $ = require('jquery');

import 'bootstrap';

//import handlebars
const Handlebars = require("handlebars");

 $(document).ready(function() {

    $('#filter-button').click(function() {
        var title = $('#eventTitle').val();
        var date_from = $("#eventDateFrom").val();
        var date_to = $("#eventDateto").val();

        $.ajax({
            "url": "http://localhost:8000/api/filter/events",
                 "method": "GET",
                 "data": {
                     'title': title,
                     'begin': date_from,
                     "end": date_to
                 },
                 "success": function(data) {
                   var source   = document.getElementById("event-template").innerHTML;
                   var template = Handlebars.compile(source);
                     console.log(data);
                    //svuoto il contenuto della pagina
                    $(".events-table").html("");
                    $(".normal").html("");
                    $(".no-result").remove();
                    // se i risultati sono maggiori di 0 inserisco gli appartamenti in pagina
                       //svuoto il contenuto della pagina
                       $(".event-template").html("");
                       if (data.length > 0) {
                           for (var i = 0; i < data.length; i++) {
                               var current_event = data.results[i];
                               var context = {
                                   id : current_event.id,
                                   title: current_event.title,
                                   description : current_event.description,
                                   date: current_event.event_date
                               }
                               var html_finale = template(context);
                               $(".box-template").append(html_finale);
                           }
                       }
                    },
                     "error": function() {
                         alert('errore')
                     },
              })
    })

    $('.copyText').click(function() {
        var name = $(this).closest('tr').find('.titleCopy').text();
        var date = $(this).closest('tr').find('.dateCopy').text();

        var copy_text = name + ' - ' + date;

        var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(copy_text).select();
            document.execCommand("copy");
            $temp.remove();
    })






 })
