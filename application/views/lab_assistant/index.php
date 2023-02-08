<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
        <script>
            am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end



// create chart
var chart = am4core.create("chartdiv", am4charts.GaugeChart);
chart.innerRadius = -15;

var axis = chart.xAxes.push(new am4charts.ValueAxis());
axis.min = 0;
axis.max = 50;
axis.strictMinMax = true;

var colorSet = new am4core.ColorSet();

var gradient = new am4core.LinearGradient();
gradient.stops.push({color:am4core.color("red")})
gradient.stops.push({color:am4core.color("yellow")})
gradient.stops.push({color:am4core.color("green")})

axis.renderer.line.stroke = gradient;
axis.renderer.line.strokeWidth = 15;
axis.renderer.line.strokeOpacity = 1;

axis.renderer.grid.template.disabled = true;

var hand = chart.hands.push(new am4charts.ClockHand());
hand.radius = am4core.percent(97);

setInterval(function() {
    hand.showValue(<?php 
      
      
      
      $sql=$this->db->select('complaint_id')->from('lab_complaints')->where('registered_on BETWEEN DATE_SUB(NOW(), INTERVAL 90 DAY) AND NOW()')->get();
      $num=$sql->num_rows();
      echo $num;
      
      
      
      
      
      ?>, 1000, am4core.ease.cubicOut);
}, 2000);


}); // end am4core.ready()


            am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("piechart", am4charts.PieChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in


<?php

$sql=$this->db->get_where('lab_complaints',array('status'=>0));
$fixed=$sql->num_rows();
$sql=$this->db->get_where('lab_complaints',array('status'=>1));
$not_fixed=$sql->num_rows();
?>


chart.data = [
  {
    country: "Fixed",
    value: <?php echo $fixed; ?>
  },
  {
    country: "Not Fixed",
    value: <?php echo $not_fixed; ?>
  }

];
chart.radius = am4core.percent(70);
chart.innerRadius = am4core.percent(40);
chart.startAngle = 180;
chart.endAngle = 360;  

var series = chart.series.push(new am4charts.PieSeries());
series.dataFields.value = "value";
series.dataFields.category = "country";

series.slices.template.cornerRadius = 0;
series.slices.template.innerCornerRadius = 7;
series.slices.template.draggable = true;
series.slices.template.inert = true;
series.alignLabels = false;

series.hiddenState.properties.startAngle = 90;
series.hiddenState.properties.endAngle = 90;

chart.legend = new am4charts.Legend();

}); // end am4core.ready()
</script>

<!-- HTML -->



<h1 class="mt-4">Dashboard</h1>
<div class="container-fluid">
    <div class="row mt-5"> 
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(54,58,252,1) 0%, rgba(63,128,254,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class=" fa fa-flask text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation1">
                    <?php echo $this->db->count_all('lab_assistant_data');?> </div>
                <div class="text-white font-weight-bold ">LAB ASSISTANTS</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(90deg, rgba(188,58,252,1) 0%, rgba(251,63,225,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class=" far fa-list-alt text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation2">
                    <?php echo $this->db->count_all('lab_complaints');?> </div>
                <div class="text-white font-weight-bold ">COMPLAINTS</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(34,195,82,1) 0%, rgba(45,253,222,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class=" far fa-check-circle text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation3">
                <?php echo $this->db->like('status','0')->from('lab_complaints')->count_all_results(); ?> </div>
                <div class="text-white font-weight-bold ">FIXED</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(252,54,54,1) 0%, rgba(253,45,120,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class=" far fa-times-circle text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation4">
                <?php echo $this->db->like('status','1')->from('lab_complaints')->count_all_results(); ?> </div>
                <div class="text-white font-weight-bold ">UNFIXED</div>
        </div></div>
    </div>
    <div class="row mt-5">        
        <div class="col-lg-8 col-md-8 mt-1 pr-lg-2 p-0">
            <div class="col-md-12 shadow pl-0" id="chartdiv" style="height:300px;"></div>
        </div>
        
        <div class="col-lg-4 col-md-4 mt-1 p-0"> 
          <div class="shadow col-md-12 p-0 justify-content-center align-items-center d-flex" style="height:100%;">
            <div id="piechart" class="col-md-12 p-0" style="height:230px;"></div>
          </div>
        </div>
    </div>
        <div class="row mt-5">  
          <div class="col-lg-3 col-md-6 shadow pt-3 mt-1"> 
            <div class="col-md-12"  style="max-height:440px;overflow:hidden;">
              <h6 class="justify-content-center d-flex">Notice Board</h6>
              <div class="border border-primary bg-primary rounded"></div>
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
                <h6 class="justify-content-center d-flex">College News </h6>
                <div class="border border-primary bg-primary rounded"></div>
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
  .fc-calender .fc-header-toolbar .fc-right .fc-button-group{
    width:160px;
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
