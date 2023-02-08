<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
        <script>
           am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
chart.data = [{
  "year": "2011",
  "value": 600000
}, {
  "year": "2012",
  "value": 900000
}, {
  "year": "2013",
  "value": 180000
}, {
  "year": "2014",
  "value": 600000
}, {
  "year": "2015",
  "value": 350000
}, {
  "year": "2016",
  "value": 600000
}, {
  "year": "2017",
  "value": 670000
}];

// Populate data
for (var i = 0; i < (chart.data.length - 1); i++) {
  chart.data[i].valueNext = chart.data[i + 1].value;
}

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

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
var chart = am4core.create("piechart", am4charts.RadarChart);

// Add data
chart.data = [{
  "category": "S1",
  "value": 100,
  "full": 100
}, {
  "category": "S2",
  "value": 80,
  "full": 100
}, {
  "category": "S3",
  "value": 90,
  "full": 100
}, {
  "category": "S4",
  "value": 75,
  "full": 100
}, {
  "category": "S5",
  "value": 95,
  "full": 100
}
];

// Make chart not full circle
chart.startAngle = -90;
chart.endAngle = 180;
chart.innerRadius = am4core.percent(20);

// Set number format
chart.numberFormatter.numberFormat = "#.#'%'";

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.grid.template.strokeOpacity = 0;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.fontWeight = 500;
categoryAxis.renderer.labels.template.adapter.add("fill", function(fill, target) {
  return (target.dataItem.index >= 0) ? chart.colors.getIndex(target.dataItem.index) : fill;
});
categoryAxis.renderer.minGridDistance = 10;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.grid.template.strokeOpacity = 0;
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;

// Create series
var series1 = chart.series.push(new am4charts.RadarColumnSeries());
series1.dataFields.valueX = "full";
series1.dataFields.categoryY = "category";
series1.clustered = false;
series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
series1.columns.template.fillOpacity = 0.08;
series1.columns.template.cornerRadiusTopLeft = 20;
series1.columns.template.strokeWidth = 0;
series1.columns.template.radarColumn.cornerRadius = 20;

var series2 = chart.series.push(new am4charts.RadarColumnSeries());
series2.dataFields.valueX = "value";
series2.dataFields.categoryY = "category";
series2.clustered = false;
series2.columns.template.strokeWidth = 0;
series2.columns.template.tooltipText = "{category}: [bold]{value}[/]";
series2.columns.template.radarColumn.cornerRadius = 20;

series2.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

// Add cursor
chart.cursor = new am4charts.RadarCursor();

}); // end am4core.ready()
</script>

<!-- HTML -->



<h1 class="mt-4">Dashboard</h1>
<div class="container-fluid">
    <div class="row mt-5"> 
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(54,58,252,1) 0%, rgba(63,128,254,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class="fa fa-graduation-cap text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation1">
                    <?php echo $this->db->count_all('student_data');?></div>
                <div class="text-white font-weight-bold">STUDENTS</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(90deg, rgba(188,58,252,1) 0%, rgba(251,63,225,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class="far fa-file-video text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation2">
                    <?php echo $this->db->like('status','1')->from('meeting_data')->count_all_results(); ?></div>
                <div class="text-white font-weight-bold">ACTIVE MEETING</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(34,195,82,1) 0%, rgba(45,253,222,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class="far fa-file-alt text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation3">
                <?php echo $this->db->count_all('subjects');?></div>
                <div class="text-white font-weight-bold">SUBJECTS</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(252,54,54,1) 0%, rgba(253,45,120,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class="fa fa-flask text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation4">
                    <?php echo $this->db->like('is_lab','lab')->from('subjects')->count_all_results(); ?></div>
                <div class="text-white font-weight-bold">LABS</div>
        </div></div>
    </div>
    <div class="row mt-5">        
        <div class="col-lg-8 col-md-8 mt-1 pr-lg-2 p-0">
            <div class="col-md-12 shadow pl-0 d-flex justify-content-center text-center align-items-center display-5" id="chartdiv_t" style="height:300px;">Not much data available for payment comparison</div>
        </div>
        
        <div class="col-lg-4 col-md-4 mt-1 p-0"> 
          <div class="shadow col-md-12 p-0 justify-content-center align-items-center d-flex" style="height:100%;">
            <div id="piechart" class="col-md-12 p-0" style="height:230px;"></div>
          </div>
        </div>
    </div>
        <div class="row mt-5">  
          <div class="col-lg-3 col-md-6 shadow pt-3 mt-1" style="overflow:hidden;"> 
            <div class="col-md-12 p-0" style="max-height:440px;overflow:hidden;">
              <h6 class="justify-content-center d-flex">Notice Board</h6>
              <div class="border border-primary bg-primary rounded"></div>
              <marquee direction='up' scrollamount='2' style=" ">
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
             <div class="col-md-12 shadow pt-3" style="height:100%"> 
                <h6 class="justify-content-center d-flex">College News</h6>
                <div class="border border-primary bg-primary rounded"></div>
                <marquee direction='up' scrollamount='2' class='font-weight-bold text-center'
                                                                                                    style="height:90%;">
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
