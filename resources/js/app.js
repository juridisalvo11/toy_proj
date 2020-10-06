require('./bootstrap');

var $ = require('jquery');

import 'bootstrap';

//import handlebars
const Handlebars = require("handlebars");

 $(document).ready(function() {
   //Intercetto il click sul tasto filtra
    $('#filter-button').click(function() {
      //vado a leggere i valori inseriti negli input title e date
        var title = $('#eventTitleSearch').val();
        var date_from = $("#eventDateFrom").val();
        var date_to = $("#eventDateto").val();
        //faccio partire una chiamata ajax per recuperare gli eventi filtrati
        $.ajax({
            "url": "http://localhost:8000/api/filter/events",
                 "method": "GET",
                 "data": {
                     'title': title,
                     'begin': date_from,
                     "end": date_to
                 },
                 "success": function(data) {
                   //imposto il template dove andrò ad inserire i dati recuperati
                   var source   = document.getElementById("event-template").innerHTML;
                   var template = Handlebars.compile(source);
                       //svuoto il contenuto della pagina
                       //$(".event-template").html("");
                       $(".events-table").html("");
                       $(".no-result").remove("");
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
                       }else if($('.events-table td').length == 0){
                           $(".events-table").append("<h3 class='no-result'>Nessun evento trovato</h3>");
                       }
                    },
                     "error": function() {
                         alert('errore')
                     },
              })
    })
    //intercetto il click sul tasto copy
    $('.copyText').click(function() {
      //vado a recuperare i valori per quanto riguarda titolo e data
        var name = $(this).closest('tr').find('.titleCopy').text();
        var date = $(this).closest('tr').find('.dateCopy').text();

        //imposto il modo in cui voglio che i valori mi vengano restituiti
        var copy_text = name + ' - ' + date;

        //creo un'input da cui poter copiare titolo e data sotto forma di stringa per poterla riutilizzare, infine  rimuovo l'input
        var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(copy_text).select();
            document.execCommand("copy");
            $temp.remove();
    })
 })
