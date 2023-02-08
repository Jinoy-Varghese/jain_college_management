<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
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
            selectable:true,
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

<!-- Chart code -->
<script>
           am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
chart.data = [
    
<?php
    $id=$_SESSION['u_id'];
    $this->db->select('*');
    $this->db->from('users');
    $this->db->join('hod_data','hod_data.email=users.email');
    $this->db->where('users.email',$id);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
    $dept=$user_data->dept;
    }
    $sql=$this->db->select('DISTINCT(timestamp)')->from('attendance')->limit(7)->get();
    foreach($sql->result() as $data)
    {
    $sql=$this->db->select('*')->from('attendance')->where('timestamp',$data->timestamp)->where('s_attendance','present')->join('student_data','student_data.student_id=attendance.s_id')->where('dept',$dept)->get();
    $number=$sql->num_rows();

?>
    

     {
  "year": "<?php echo  date('d-m-Y',strtotime($data->timestamp)); ?>",
  "value": <?php echo $number; ?>
},


<?php
}
?>



];

// Populate data
for (var i = 0; i < (chart.data.length - 1); i++) {
  chart.data[i].valueNext = chart.data[i + 1].value;
}

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.fontSize = 11;
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "value";
series.dataFields.categoryX = "year";

// Add series for showing variance arrows
var series2 = chart.series.push(new am4charts.ColumnSeries());
series2.dataFields.valueY = "valueNext";
series2.dataFields.openValueY = "value";
series2.dataFields.categoryX = "year";
series2.columns.template.width = 1;
series2.fill = am4core.color("#555");
series2.stroke = am4core.color("#555");

// Add a triangle for arrow tip
var arrow = series2.bullets.push(new am4core.Triangle);
arrow.width = 10;
arrow.height = 10;
arrow.horizontalCenter = "middle";
arrow.verticalCenter = "top";
arrow.dy = -1;

// Set up a rotation adapter which would rotate the triangle if its a negative change
arrow.adapter.add("rotation", function(rotation, target) {
  return getVariancePercent(target.dataItem) < 0 ? 180 : rotation;
});

// Set up a rotation adapter which adjusts Y position
arrow.adapter.add("dy", function(dy, target) {
  return getVariancePercent(target.dataItem) < 0 ? 1 : dy;
});

// Add a label
var label = series2.bullets.push(new am4core.Label);
label.padding(10, 10, 10, 10);
label.text = "";
label.fill = am4core.color("#0c0");
label.strokeWidth = 0;
label.horizontalCenter = "middle";
label.verticalCenter = "bottom";
label.fontWeight = "bolder";

// Adapter for label text which calculates change in percent
label.adapter.add("textOutput", function(text, target) {
  var percent = getVariancePercent(target.dataItem);
  return percent ? percent + "%" : text;
});

// Adapter which shifts the label if it's below the variance column
label.adapter.add("verticalCenter", function(center, target) {
  return getVariancePercent(target.dataItem) < 0 ? "top" : center;
});

// Adapter which changes color of label to red
label.adapter.add("fill", function(fill, target) {
  return getVariancePercent(target.dataItem) < 0 ? am4core.color("#c00") : fill;
});

function getVariancePercent(dataItem) {
  if (dataItem) {
    var value = dataItem.valueY;
    var openValue = dataItem.openValueY;
    var change = value - openValue;
    return Math.round(change / openValue * 100);
  }
  return 0;
}

}); // end am4core.ready()
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("piechart", am4charts.PieChart);

// Add data
chart.data = [ 
  

  <?php 

$sql=$this->db->select('DISTINCT(gender)')->from('users')->join('student_data','student_data.email=users.email')->where('dept',$dept)->get();
foreach($sql->result() as $se)
{

?>



  {
  "country": "<?php
  if($se->gender=='m')
  {
    echo "Male";
  }
  else{
    echo 'Female';
  }
  
  ?>",
  "litres": <?php 
  
  
  $sql2=$this->db->select('*')->from('users')->join('student_data','student_data.email=users.email')->where('dept','Computer Science')->where('gender',$se->gender)->get();
  echo $sql2->num_rows(); ?>
},


<?php
}
?>



];

// Set inner radius
chart.innerRadius = am4core.percent(50);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.labels.template.paddingTop=0;
pieSeries.labels.template.paddingBottom=0;

pieSeries.labels.template.fontSize=6;
pieSeries.ticks.template.disabled=false;


// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;
categoryAxis.fontSize = 9;

}); // end am4core.ready()
</script>

<!-- HTML -->



<h1 class="mt-4">Dashboard</h1>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(45deg, rgba(54,58,252,1) 0%, rgba(63,128,254,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-user-graduate"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation1">
                    <?php $query=$this->db->select('*')->from('student_data')->where('s_status',2)->get();echo $query->num_rows(); ?></div>
                <div class="text-white font-weight-bold ">STUDENTS</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(90deg, rgba(188,58,252,1) 0%, rgba(251,63,225,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-chalkboard-teacher"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation2">
                    <?php echo $this->db->count_all('professor_data');?></div>
                <div class="text-white font-weight-bold ">PROFESSORS</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(45deg, rgba(34,195,82,1) 0%, rgba(45,253,222,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-sticky-note"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation3">
                    <?php echo $this->db->count_all('subjects');?></div>
                <div class="text-white font-weight-bold ">SUBJECTS</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(45deg, rgba(252,54,54,1) 0%, rgba(253,45,120,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-graduation-cap"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation4">
                    <?php echo $this->db->count_all('course_list');?></div>
                <div class="text-white font-weight-bold ">COURSES</div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8 col-md-8 mt-1 pr-lg-2 p-0">
            <div class="col-md-12 shadow pl-0" id="chartdiv" style="height:300px;"></div>
        </div>

        <div class="col-lg-4 col-md-4 mt-1 p-0">
            <div class="shadow col-md-12 p-0 justify-content-center align-items-center d-flex" style="height:100%;">
                <div id="piechart" class="col-md-12 p-0" style="height:230px;">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-3 col-md-6 shadow pt-3 mt-1">
            <div class="col-md-12 p-0" style="max-height:440px;overflow:hidden;">
                <h6 class="justify-content-center d-flex">
                    Notice Board</h6>
                <div class="border border-primary bg-primary rounded">
                </div>
                <marquee direction='up' scrollamount='2' style="height:440px;">
                    <?php
            $this->db->select('*');
            $this->db->from('notifications');
             $sql=$this->db->get();
             foreach($sql->result() as $news_data)
           {
             
             echo "&#10146 $news_data->description"."<br>";
             
           }?>
                </marquee>
            </div>

        </div>
        <div class="col-lg-3 col-md-6  mt-1">
            <div class="col-md-12 shadow pt-3" style="max-height:490px;overflow:hidden;">
                <h6 class="justify-content-center d-flex">
                    College News
                </h6>
                <div class="border border-primary bg-primary rounded">
                </div>
                <marquee direction='up' scrollamount='2' class='font-weight-bold text-center' style="height:440px;">
                    <?php
            $this->db->select('*');
            $this->db->from('news');
             $sql=$this->db->get();
             foreach($sql->result() as $news_data)
           {
            $image=$news_data->news_file;
            echo "<div class='row'><div class='col-12'>$news_data->news</div></div><br>";
            echo "<div class='row'><div class='col-12'><img src='".base_url($image)."' class='img-fluid img-thumbnail' style='height:150px;'></div></div><br>";
           }?></marquee>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 shadow pt-3 mt-1s ">
            <?php $this->load->view("calendar/calendar.php");?>
        </div>
    </div>
</div>

<style>
@media only screen and (max-width: 479px) {
    .fc-calender .fc-header-toolbar .fc-right .fc-button-group {
        width: 160px;
    }
}
</style>
<script>
let elm = document.querySelector('.number-animation1');

function animateValue(id, start, duration) {
    let end = parseInt(elm.innerText);
    let range = end - start;
    let current = start;
    let increment = end > start ? 1 : -1;
    let stepTime = Math.abs(Math.floor(duration / range));
    let obj = elm;
    let timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}

if (elm.innerHTML <= 0) {

} else {
    animateValue(elm, 0, 2000);
}
</script>
<script>
let elm2 = document.querySelector('.number-animation2');

function animateValue(id, start, duration) {
    let end = parseInt(elm2.innerText);
    let range = end - start;
    let current = start;
    let increment = end > start ? 1 : -1;
    let stepTime = Math.abs(Math.floor(duration / range));
    let obj = elm2;
    let timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}

if (elm2.innerHTML <= 0) {

} else {
    animateValue(elm2, 0, 2000);
}
</script>
<script>
let elm3 = document.querySelector('.number-animation3');

function animateValue(id, start, duration) {
    let end = parseInt(elm3.innerText);
    let range = end - start;
    let current = start;
    let increment = end > start ? 1 : -1;
    let stepTime = Math.abs(Math.floor(duration / range));
    let obj = elm3;
    let timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}

if (elm3.innerHTML <= 0) {

} else {
    animateValue(elm3, 0, 2000);
}
</script>
<script>
let elm4 = document.querySelector('.number-animation4');

function animateValue(id, start, duration) {
    let end = parseInt(elm4.innerText);
    let range = end - start;
    let current = start;
    let increment = end > start ? 1 : -1;
    let stepTime = Math.abs(Math.floor(duration / range));
    let obj = elm4;
    let timer = setInterval(function() {
        current += increment;

        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}
if (elm4.innerHTML <= 0) {

} else {
    animateValue(elm4, 0, 2000);
}
</script>

<br>
<br><br><br><br><br><br><br>