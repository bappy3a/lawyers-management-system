@extends('layouts.app')

@section('heading','Dashboard')
@section('content')

  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Your Case</span>
          <span class="info-box-number">{{ \App\Cas::where('user_id',auth()->user()->id)->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Hire Lawyer</span>
          <span class="info-box-number">{{ \App\Hare::where('client_id',auth()->user()->id)->groupBy('client_id')->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Your Case Post</span>
          <span class="info-box-number">{{ \App\Post::where('user_id',auth()->user()->id)->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
@endsection

@section('js')
	<script>
	  $(function () {

	    /* initialize the external events
	     -----------------------------------------------------------------*/
	    function init_events(ele) {
	      ele.each(function () {

	        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
	        // it doesn't need to have a start or end
	        var eventObject = {
	          title: $.trim($(this).text()) // use the element's text as the event title
	        }

	        // store the Event Object in the DOM element so we can get to it later
	        $(this).data('eventObject', eventObject)

	        // make the event draggable using jQuery UI
	        $(this).draggable({
	          zIndex        : 1070,
	          revert        : true, // will cause the event to go back to its
	          revertDuration: 0  //  original position after the drag
	        })

	      })
	    }

	    init_events($('#external-events div.external-event'))

	    /* initialize the calendar
	     -----------------------------------------------------------------*/
	    //Date for the calendar events (dummy data)
	    var date = new Date()
	    var d    = date.getDate(),
	        m    = date.getMonth(),
	        y    = date.getFullYear()
	    $('#calendar').fullCalendar({
	      header    : {
	        left  : 'prev,next today',
	        center: 'title',
	        right : 'month,agendaWeek,agendaDay'
	      },
	      buttonText: {
	        today: 'today',
	        month: 'month',
	        week : 'week',
	        day  : 'day'
	      },
	      //Random default events
	      events    : [
	        {
	          title          : 'Today',
	          start          : new Date(y, m, d),
	          backgroundColor: '#f56954', //red
	          borderColor    : '#f56954' //red
	        }
	      ],
	      editable  : true,
	      droppable : true, // this allows things to be dropped onto the calendar !!!
	      drop      : function (date, allDay) { // this function is called when something is dropped

	        // retrieve the dropped element's stored Event Object
	        var originalEventObject = $(this).data('eventObject')

	        // we need to copy it, so that multiple events don't have a reference to the same object
	        var copiedEventObject = $.extend({}, originalEventObject)

	        // assign it the date that was reported
	        copiedEventObject.start           = date
	        copiedEventObject.allDay          = allDay
	        copiedEventObject.backgroundColor = $(this).css('background-color')
	        copiedEventObject.borderColor     = $(this).css('border-color')

	        // render the event on the calendar
	        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
	        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

	        // is the "remove after drop" checkbox checked?
	        if ($('#drop-remove').is(':checked')) {
	          // if so, remove the element from the "Draggable Events" list
	          $(this).remove()
	        }

	      }
	    })

	    /* ADDING EVENTS */
	    var currColor = '#3c8dbc' //Red by default
	    //Color chooser button
	    var colorChooser = $('#color-chooser-btn')
	    $('#color-chooser > li > a').click(function (e) {
	      e.preventDefault()
	      //Save color
	      currColor = $(this).css('color')
	      //Add color effect to button
	      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
	    })
	    $('#add-new-event').click(function (e) {
	      e.preventDefault()
	      //Get value and make sure it is not null
	      var val = $('#new-event').val()
	      if (val.length == 0) {
	        return
	      }

	      //Create events
	      var event = $('<div />')
	      event.css({
	        'background-color': currColor,
	        'border-color'    : currColor,
	        'color'           : '#fff'
	      }).addClass('external-event')
	      event.html(val)
	      $('#external-events').prepend(event)

	      //Add draggable funtionality
	      init_events(event)

	      //Remove event from text input
	      $('#new-event').val('')
	    })
	  })
	</script>
@endsection