<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
        <script>
            am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4charts.XYChart);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.data = [
              <?php 
          $id=$_SESSION['u_id'];
          $this->db->select('*');
          $this->db->from('parent_data');
          $this->db->where('email',$id);
          $sql=$this->db->get();
          foreach($sql->result() as $user_data)
          {
            $s_mail=$user_data->s_mail;
          }

          $this->db->select('*');
          $this->db->from('exam_marks');
          $this->db->where('student_id',$s_mail);
          $sql=$this->db->get();
          $i=1;
          foreach($sql->result() as $user_data)
          {
          ?>

        {
            country: "<?php echo date('d/m/Y',strtotime($user_data->date)); ?>",
            visits: <?php echo $user_data->mark_obtained; ?>
        },
  
  
          <?php
          }
          ?>



            ];

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.dataFields.category = "country";
            categoryAxis.renderer.minGridDistance = 40;
            categoryAxis.fontSize = 9;
            

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.max = 10;
            valueAxis.strictMinMax = true;
            valueAxis.renderer.minGridDistance = 30;
            valueAxis.renderer.labels.template.fontSize = 9;
            // axis break
            var axisBreak = valueAxis.axisBreaks.create();
            axisBreak.startValue = 400;
            axisBreak.endValue = 700;
            //axisBreak.breakSize = 0.005;

            // fixed axis break
            var d = (axisBreak.endValue - axisBreak.startValue) / (valueAxis.max - valueAxis.min);
            axisBreak.breakSize = 0.05 * (1 - d) / d; // 0.05 means that the break will take 5% of the total value axis height

            // make break expand on hover
            var hoverState = axisBreak.states.create("hover");
            hoverState.properties.breakSize = 1;
            hoverState.properties.opacity = 0.1;
            hoverState.transitionDuration = 1500;

            axisBreak.defaultState.transitionDuration = 1000;
            /*
            // this is exactly the same, but with events
            axisBreak.events.on("over", function() {
            axisBreak.animate(
                [{ property: "breakSize", to: 1 }, { property: "opacity", to: 0.1 }],
                1500,
                am4core.ease.sinOut
            );
            });
            axisBreak.events.on("out", function() {
            axisBreak.animate(
                [{ property: "breakSize", to: 0.005 }, { property: "opacity", to: 1 }],
                1000,
                am4core.ease.quadOut
            );
            });*/

            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.categoryX = "country";
            series.dataFields.valueY = "visits";
            series.columns.template.tooltipText = "{valueY.value}";
            series.columns.template.tooltipY = 0;
            series.columns.template.strokeOpacity = 0;
            
            // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
            series.columns.template.adapter.add("fill", function(fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
            });

            }); // end am4core.ready()
            am4core.ready(function() {


// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("piechart", am4charts.PieChart);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  // change the cursor on hover to make it apparent the object can be interacted with
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = true;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend
chart.legend = new am4charts.Legend();



<?php 
$id=$_SESSION['u_id'];
$this->db->select('*');
$this->db->from('parent_data');
$this->db->where('email',$id);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
  $s_mail=$user_data->s_mail;
}

$this->db->select('*');
$this->db->from('student_data');
$this->db->where('email',$s_mail);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
  $student_id=$user_data->student_id;
  $s_sem=$user_data->s_sem;
}

$this->db->select('*');
$this->db->from('attendance');
$this->db->where('s_id',$student_id);
$this->db->where('s_sem',$s_sem);
$this->db->where('s_attendance','present');
$sql=$this->db->get();
$present=$sql->num_rows();


$this->db->select('*');
$this->db->from('attendance');
$this->db->where('s_id',$student_id);
$this->db->where('s_sem',$s_sem);
$this->db->where('s_attendance','absent');
$sql=$this->db->get();
$absent=$sql->num_rows();

?>

// Add data
chart.data = [  
  
  
   {
    country: "Present",
    litres: <?php echo $present; ?>
  },
  {
    country: "Absent",
    litres: <?php echo $absent; ?>
  }
  
  
  
   ];

  }); // end am4core.ready()
</script>

<!-- HTML -->



<h1 class="mt-4">Dashboard</h1>
<div class="container-fluid">
    <div class="row mt-5"> 
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(54,58,252,1) 0%, rgba(63,128,254,1) 100%);height:100px;margin-bottom:10px;">
        
        <div class="text-right" style="opacity:0.8;"><i class="far fa-hand-paper text-black"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation1">
                <?php 
$id=$_SESSION['u_id'];
$this->db->select('*');
$this->db->from('users');
$this->db->join('parent_data','parent_data.email=users.email');
$this->db->where('users.email',$id);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
  $s_mail=$user_data->s_mail;
}

$this->db->select('*');
$this->db->from('student_data');
$this->db->where('email',$s_mail);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
  $s_id=$user_data->student_id;
  $s_sem=$user_data->s_sem;
}

$this->db->select('*');
$this->db->from('attendance');
$this->db->where('s_id',$s_id);
$this->db->where('s_sem',$s_sem);
$sql=$this->db->get();
$slno=1;
foreach($sql->result() as $user_data)
{
  $s_attendance=$user_data->s_attendance;
}

$con = mysqli_connect("localhost", "root", "", "college_management");
$query2="SELECT COUNT(s_attendance) as total FROM attendance WHERE s_id='$s_id' AND s_sem='$s_sem' AND s_attendance='present'";
$sql2=mysqli_query($con,$query2);
$result2=mysqli_fetch_assoc($sql2);
$result2['total'];

$query4="SELECT s_id,s_sem,count(*) as occur from attendance group by s_id,s_sem having count(*)=(SELECT COUNT(*) as occur from attendance group by s_id,s_sem order by occur desc limit 1)";
$sql4=mysqli_query($con,$query4);
$result4=mysqli_fetch_assoc($sql4);
$result4['occur'];

$present=$result2['total'];
$total=$result4['occur'];
$total_attendance=round(($present*5)/$total);
echo $total_attendance;
?>
                    
                    </div>
                <div class="text-white font-weight-bold">ATTENDENCE</div>
        
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(90deg, rgba(188,58,252,1) 0%, rgba(251,63,225,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class="fab fa-jenkins text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation2">
                <?php echo $this->db->count_all('parent_data');?></div>
                <div class="text-white font-weight-bold">PARENTS</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(34,195,82,1) 0%, rgba(45,253,222,1) 100%);height:100px;margin-bottom:10px;">
        <div class="text-right" style="opacity:0.8;"><i class="far fa-file-video text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation3">
        <?php echo $this->db->where("status='1' AND subject='null'")->from('meeting_data')->count_all_results(); ?>
        </div>
                <div class="text-white font-weight-bold">PTA MEETING</div>
        </div></div>
        <div class="col-lg-3 col-md-6"> <div class="col-md-12 shadow" style="background: linear-gradient(45deg, rgba(252,54,54,1) 0%, rgba(253,45,120,1) 100%);height:100px;margin-bottom:10px;">
        
        <div class="text-right" style="opacity:0.8;"><i class="far fa-clipboard text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation4">
        <?php echo $this->db->where("last_date>curdate()")->from('exam_questions')->count_all_results(); ?>
        </div>
                <div class="text-white font-weight-bold">UPCOMING EXAMS</div></div></div>
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
            <div class="col-md-12" style="max-height:440px;overflow:hidden;">
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
                <h6 class="justify-content-center d-flex">College News</h6>
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


