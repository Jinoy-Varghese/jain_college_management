<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/wordCloud.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("chartdiv", am4charts.XYChart3D);
    chart.paddingBottom = 30;
    chart.angle = 35;
    chart.data = [

        <?php 
    

                $sql=$this->db->select('*')->from('books')->limit(9)->order_by('b_times','DESC')->get();
                foreach($sql->result() as $max)
                {
                  echo '
                    {
                        country: "'.$max->book_name.'",
                        visits: '.$max->b_times.'
                    },';
                }

              ?>
    ]


    let title = chart.titles.create();
    title.text = "Most issued books";
    title.fontSize = 22;
    
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.inside = true;
    categoryAxis.renderer.grid.template.disabled = true;

    let labelTemplate = categoryAxis.renderer.labels.template;
    labelTemplate.rotation = -90;
    labelTemplate.horizontalCenter = "left";
    labelTemplate.verticalCenter = "middle";
    labelTemplate.dy = 10; // moves it a bit down;
    labelTemplate.inside = false; // this is done to avoid settings which are not suitable when label is rotated

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.grid.template.disabled = true;

    // Create series
    var series = chart.series.push(new am4charts.ConeSeries());
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";

    var columnTemplate = series.columns.template;
    columnTemplate.adapter.add("fill", function(fill, target) {
        return chart.colors.getIndex(target.dataItem.index);
    })

    columnTemplate.adapter.add("stroke", function(stroke, target) {
        return chart.colors.getIndex(target.dataItem.index);
    })

}); // end am4core.ready()







am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("piechart", am4charts.XYChart);

    // Add data
    chart.data = [
            <?php 
    
    $i=8;
              $sql=$this->db->select('*')->from('book_issues')->limit(8)->get();
              foreach($sql->result() as $max)
              {
                $week = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-$i,date("Y")));
               $sql2=$this->db->select('*')->from('book_issues')->where('DATE(issue_date)',$week)->get();
               $value=$sql2->num_rows();

               
            ?>
                  {
                  "date": <?php echo $week = date("d-m-Y",mktime(0, 0, 0, date("m"), date("d")-$i,date("Y"))); ?>,
                  "value": <?php echo $value; ?>
                },

           <?php
           $i--;
                }
            ?>
    ];


    let title = chart.titles.create();
    title.text = "Book issued on last 7 days";
    title.fontSize = 20;
    // Create axes
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.labels.template.fontSize = 8;
    // Create value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.labels.template.fontSize = 8;
    // Create series
    var lineSeries = chart.series.push(new am4charts.LineSeries());
    lineSeries.dataFields.valueY = "value";
    lineSeries.dataFields.dateX = "date";
    lineSeries.name = "Sales";
    lineSeries.strokeWidth = 3;
    // Add simple bullet
    var bullet = lineSeries.bullets.push(new am4charts.Bullet());
    var image = bullet.createChild(am4core.Image);
    image.href = "";
    image.width = 30;
    image.height = 30;
    image.horizontalCenter = "middle";
    image.verticalCenter = "middle";

}); // end am4core.ready()
</script>

<!-- HTML -->


<h1 class="mt-4">Dashboard</h1>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(45deg, rgba(54,58,252,1) 0%, rgba(63,128,254,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-book-open text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation1">
                    <?php echo $this->db->count_all('books');?></div>
                <div class="text-white font-weight-bold ">Total books</div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(90deg, rgba(188,58,252,1) 0%, rgba(251,63,225,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-address-book text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation2">
                    <?php echo $this->db->count_all('book_issues');?></div>
                <div class="text-white font-weight-bold ">Total books issued</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(45deg, rgba(34,195,82,1) 0%, rgba(45,253,222,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-undo-alt text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation3">
                    <?php echo $this->db->like('status','issued')->from('book_issues')->count_all_results(); ?></div>
                <div class="text-white font-weight-bold ">Need to return</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="col-md-12 shadow"
                style="background: linear-gradient(45deg, rgba(252,54,54,1) 0%, rgba(253,45,120,1) 100%);height:100px;margin-bottom:10px;">
                <div class="text-right" style="opacity:0.8;"><i class="fa fa-calendar-day text-white"></i></div>
                <div style=" font-size:30px;opacity:0.9;" class=" text-white font-weight-bold number-animation4"><?php  
            
            echo $this->db->from('book_issues')->like('return_date',date('Y-m-d'))->count_all_results(); 
            
            ?></div>
                <div class="text-white font-weight-bold ">Books returning today</div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8 col-md-8 mt-1 pr-lg-2 p-0">
            <div class="col-md-12 shadow pl-0" id="chartdiv" style="height:300px;"></div>
        </div>

        <div class="col-lg-4 col-md-4 mt-1 p-0">
            <div class="shadow col-md-12 p-0 justify-content-center align-items-center d-flex" style="height:100%;">
                <div id="piechart" class="col-md-12 p-0" style="height:300px;"></div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-3 col-md-6 shadow pt-3 mt-1">
            <div class="col-md-12 p-0" style="max-height:440px;overflow:hidden;">
                <h6 class="justify-content-center d-flex">Notice Board</h6>
                <div class="border bg-primary border-primary rounded"></div>
                <marquee direction='up' scrollamount='2' style="height:100%;">
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
        <div class="col-lg-3 col-md-6  mt-1 pl-0 pr-0 pl-md-3 pr-md-3">
            <div class="col-md-12 shadow pt-3" style="height:490px;overflow:hidden;">
                <h6 class="justify-content-center d-flex">College News</h6>
                <div class="border border-primary bg-primary rounded"></div>
                <marquee direction='up' scrollamount='2' class='font-weight-bold text-center' style="height:90%;">
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