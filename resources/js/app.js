require('./bootstrap');

var $ = require('jquery');

import 'bootstrap';

//import handlebars
const Handlebars = require("handlebars");

 $(document).ready(function() {
   //Imposto la ricerca del titolo in maniera dinamica in modo da far apparire i risultati mentre si sta scrivendo
   $('#eventTitleSearch').keyup(function() {
     $('tbody tr').each(function() {
       var input_text = $('#eventTitleSearch').val().trim();
       var current_title = $(this).find('.titleCopy').text().toLowerCase().trim();
       if (current_title.includes(input_text)) {
         $(this).show();
       } else {
         $(this).hide();
       }
     })
   })
   //Intercetto il click sul tasto filtra
    $('#filter-button').click(function() {
      //svuoto i contenitori contententi gli eventi
        $(".box-template").html("");
        $(".events-table").html("");
        $(".no-result").remove("");
      //vado a leggere i valori inseriti negli input title e date
        var title = $('#eventTitleSearch').val();
        var date_from = $("#eventDateFrom").val();
        var date_to = $("#eventDateto").val();

        if($('#eventTitleSearch').val().length == 0 && $('#eventDateFrom').val().length == 0 && $('#eventDateto').val().length == 0) {
          $(".events-table").append("<h4 class='no-result'>seleziona almeno un parametro di ricerca</h4>");
        } else {
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
                     console.log(data);
                     //imposto il template dove andrò ad inserire i dati recuperati
                     var source   = document.getElementById("event-template").innerHTML;
                     var template = Handlebars.compile(source);
                        // svuoto il contenuto della pagina

                         if (data.length > 0) {
                             for (var i = 0; i < data.length; i++) {
                                 var current_event = data.results[i];
                                 var context = {
                                     id : current_event.id,
                                     title: current_event.title,
                                     description : current_event.description,
                                     date: current_event.event_date,
                                     every_year: (current_event.every_year == 0) ? '' : 'si'
                                 }
                                 console.log(current_event.every_year);
                                 var html_finale = template(context);
                                 $(".events-table").after(html_finale);
                             }
                         }else if($('.events-table td').length == 0){
                             $(".events-table").append("<h3 class='no-result'>Nessun evento trovato</h3>");
                         }
                      },
                       "error": function() {
                       },
                })
        }

    })
    //Intercetto il click sul tasto filtra
    $('#filter-reset').click(function() {
      //svuoto i relativi input
      var title = $('#eventTitleSearch').val("");
      var date_from = $("#eventDateFrom").val("");
      var date_to = $("#eventDateto").val("");
      //ricarico la pagina mostrando la lista completa degli eventi
      location.reload();
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
