


<div class="firstSectionStatistics row">
    <div class="col-6  col-m-6 col-l-6">
        <p class="textAboveSectionCount">Number Users :</p>
        <div class="sectionCount">
            <p class="backgroundCount">
                <?php echo $CountUser['User'];?>
            </p>
        </div>
    </div>
    <div class="col-6  col-m-6 col-l-6">
        <p class="textAboveSectionCount">Number Articles :</p>
        <div class="sectionCount">
            <p class="backgroundCount">
                <?php echo $CountUser['Article'];?>
            </p>
        </div>
    </div>
</div>
<div class="firstSectionStatistics row">
    <div class="col-12  col-m-12 col-l-6">
        <div class="graph" id="evolutionUser"></div>
    </div>
    <div class="col-12  col-m-12 col-l-6">
        <div class="graph"  id="evolutionArticle"></div>
    </div>
</div>





<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


<script>




    am4core.ready(function() {


// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        var chart = am4core.create("evolutionUser", am4charts.XYChart);

        var User = [];

        $.ajax({
            url: 'Statistics/evolutionUser',
            data: {},
            type: 'POST',
            dataType: "json",
            success: function (data) {



                for (i=0; i < data.length; i++){

                    User.push({date:data[i].date, value: data[i].NumberMember});
                }


                chart.data = User;

// Create axes
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 60;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "value";
                series.dataFields.dateX = "date";
                series.tooltipText = "{value} saved at {date}"

                series.tooltip.pointerOrientation = "vertical";

                chart.cursor = new am4charts.XYCursor();
                chart.cursor.snapToSeries = series;
                chart.cursor.xAxis = dateAxis;

//chart.scrollbarY = new am4core.Scrollbar();
                chart.scrollbarX = new am4core.Scrollbar();

            }
        });
    }); // end am4core.ready()
</script>


<script>
    am4core.ready(function() {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        var chart = am4core.create("evolutionArticle", am4charts.XYChart);

        var Article = [];

        $.ajax({
            url: 'Statistics/evolutionArticle',
            data: {},
            type: 'POST',
            dataType: "json",
            success: function (data) {


                for (i = 0; i < data.length; i++) {

                        Article.push({date: data[i].date, value: data[i].NumberArticle});

                }

                chart.data = Article;

                console.log(chart.data)

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 60;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());


                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "value";
                series.dataFields.dateX = "date";
                series.tooltipText = "{value} saved at {date}"
                series.tooltip.pointerOrientation = "vertical";

                chart.cursor = new am4charts.XYCursor();
                chart.cursor.snapToSeries = series;
                chart.cursor.xAxis = dateAxis;


                chart.scrollbarX = new am4core.Scrollbar();

            }
        });
    });
</script>