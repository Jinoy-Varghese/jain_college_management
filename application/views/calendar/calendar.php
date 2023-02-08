
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


    <script>

        $(document).ready(function(){
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:"<?php echo base_url(); ?>Fullcalendar/load",
            selectable:false,
            selectHelper:true,
            selectMirror:true,
            select:function(start, end, allDay)
            {
                var title = prompt("Enter Event Title");
                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url:"<?php echo base_url(); ?>Fullcalendar/insert",
                        type:"POST",
                        data:{title:title, start:start, end:end},
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Added Successfully");
                        }
                    })
                }
            },
            editable:true,
            eventResize:function(event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                var title = event.title;

                var id = event.id;

                $.ajax({
                    url:"<?php echo base_url(); ?>Fullcalendar/update",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Update");
                    }
                })
            },
            eventDrop:function(event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //alert(start);
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //alert(end);
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"<?php echo base_url(); ?>Fullcalendar/update",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated");
                    }
                })
            },
            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"<?php echo base_url(); ?>Fullcalendar/delete",
                        type:"POST",
                        data:{id:id},
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert('Event Removed');
                        }
                    })
                }
            }
        });
    });
          

</script>

    <style>
    
    .fc-calender .fc-header-toolbar .fc-right {
  width: 50%;
  margin-bottom: 30px;
}
.fc-calender .fc-header-toolbar .fc-right h2 {
  font-size: 18px;
  font-weight: 600;
  color: #111111;
}
/* thazoot right aanu */
.fc-calender .fc-header-toolbar .fc-left {
  margin-bottom: 30px;
  width: 50%;
}
.fc-calender .fc-header-toolbar .fc-left .fc-button-group {
  /*float: right;*/
  display:flex;
  width:auto;
}
.fc-calender .fc-header-toolbar .fc-left .fc-button-group .fc-button {
  background: none;
  box-shadow: none;
  border: none;
  padding: 0;
}
.fc-calender .fc-header-toolbar .fc-left .fc-button-group .fc-button:hover {
  color: #cdcdcd;
}
.fc-calender .fc-header-toolbar .fc-left .fc-button-group .fc-button:focus {
  outline: none;
}
/* thazoot center aanu */
.fc-calender .fc-header-toolbar .fc-right .fc-button-group {
  background-color: #f3f4f5;
  border-radius: 40px;
}
.fc-calender .fc-header-toolbar .fc-right .fc-button-group .fc-button {
  background-image: none;
  box-shadow: none;
  border: none;
  background: none;
  height: auto;
  font-size: 14px;
  color: #a5a5a5;
  text-transform: capitalize;
  padding: 8px 20px;
}
.fc-calender .fc-header-toolbar .fc-right .fc-button-group .fc-button:focus {
  outline: none;
}
@media only screen and (max-width: 479px) {
  .fc-calender .fc-header-toolbar .fc-right .fc-button-group .fc-button {
    padding: 8px 10px;
  }
}
.fc-left .fc-today-button
  {
    color:white;
    border:2px solid rgb(188,58,252);
    background: linear-gradient(45deg, rgba(188,58,252,1) 39%, rgba(251,63,225,1) 100%);
    opacity:0.8;
    box-shadow:0 4px 8px 0 rgba(0,0,0,.2)
  }
  .fc-left .fc-state-disabled 
  {
    border:2px solid rgb(188,58,252);
    color:rgb(188,58,252);
    background:none;
    box-shadow:none;
    
  }

.fc-calender .fc-header-toolbar .fc-right .fc-button-group .fc-button.fc-state-active {
  background-color: #f50057;
  color: #ffffff;
  border-radius: 40px;
  box-shadow: 0px 4px 10px 0px rgba(255, 151, 188, 0.75);
}
.fc-calender .fc-view-container .fc-month-view .fc-event-container {
  /*display: block;*/
}
.fc-calender .fc-view-container .fc-month-view .fc-event-container .fc-day-grid-event {
  color: #fff;
}
@media only screen and (max-width: 767px) {
  .fc-calender .fc-view-container .fc-month-view .fc-event-container .fc-day-grid-event {
    display: none;
  }
}
.fc-calender .fc-view-container .fc-month-view .fc-day-grid-container {
  height: auto !important;
}
.fc-calender .fc-view-container .fc-month-view .fc-day-grid-container .fc-week {
  min-height: 30px !important;
}
.fc-calender .fc-view-container .fc-month-view table,
.fc-calender .fc-view-container .fc-basicDay-view table {
  font-size: 14px;
  color: #444444;
}
.fc-calender .fc-view-container .fc-month-view table .fc-head tr .fc-head-container,
.fc-calender .fc-view-container .fc-basicDay-view table .fc-head tr .fc-head-container {
  border: none;
}
.fc-calender .fc-view-container .fc-month-view table .fc-head tr .fc-head-container .fc-row,
.fc-calender .fc-view-container .fc-basicDay-view table .fc-head tr .fc-head-container .fc-row {
  border-bottom: 1px solid #e1e1e1;
  margin-bottom: 10px;
}
.fc-calender .fc-view-container .fc-month-view table .fc-head tr .fc-head-container .fc-row .fc-day-header,
.fc-calender .fc-view-container .fc-basicDay-view table .fc-head tr .fc-head-container .fc-row .fc-day-header {
  border: none;
  text-align: center;
  padding-bottom: 15px;
}
@media only screen and (max-width: 479px) {
  .fc-calender .fc-view-container .fc-month-view table .fc-head tr .fc-head-container .fc-row .fc-day-header,
  .fc-calender .fc-view-container .fc-basicDay-view table .fc-head tr .fc-head-container .fc-row .fc-day-header {
    font-size: 13px;
  }
}
.fc-calender .fc-view-container .fc-month-view table .fc-body tr td,
.fc-calender .fc-view-container .fc-basicDay-view table .fc-body tr td {
  border: none;
  text-align: center;
}

@media only screen and (max-width: 479px) {
  .fc-calender .fc-view-container .fc-basicWeek-view .fc-head-container .fc-day-header {
    font-size: 10px;
  }
}
.fc-calender .fc-header-toolbar .fc-center h2
  {
    position:absolute;
    margin-left:-29%;
    font-size:44px;
    margin-top:40%;
    opacity:0.1;
  }

    </style>

    <div class="calender-wrap" style="padding-bottom:20px;">
        <div id="calendar" class="fc-calender"></div>
    </div>


