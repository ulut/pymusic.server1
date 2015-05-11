<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        // Initialize collapse button
        $(".button-collapse").sideNav();
        // Initialize collapsible (uncomment the line below if you use the dropdown variation)
        //$('.collapsible').collapsible();
        $(".dropdown-button").dropdown({
            inDuration: 300,
            outDuration: 225,
            constrain_width: false, // Does not change width of dropdown to that of the activator
            hover: false, // Activate on hover
            gutter: 0, // Spacing from edge
            belowOrigin: true // Displays dropdown below the button
        });
        $('select').material_select();
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });

    });
</script>

<!-- CHART.JS -->
<!--<script type="text/javascript" src="js/Chart.js"></script>-->
<!---->
<!--<script>-->
<!--    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};-->
<!--    var lineChartData = {-->
<!--        labels : ["January","February","March","April","May","June","July"],-->
<!--        datasets : [-->
<!--            {-->
<!--                label: "My First dataset",-->
<!--                fillColor : "rgba(220,220,220,0.2)",-->
<!--                strokeColor : "rgba(220,220,220,1)",-->
<!--                pointColor : "rgba(220,220,220,1)",-->
<!--                pointStrokeColor : "#fff",-->
<!--                pointHighlightFill : "#fff",-->
<!--                pointHighlightStroke : "rgba(220,220,220,1)",-->
<!--                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]-->
<!--            },-->
<!--            {-->
<!--                label: "My Second dataset",-->
<!--                fillColor : "rgba(151,187,205,0.2)",-->
<!--                strokeColor : "rgba(151,187,205,1)",-->
<!--                pointColor : "rgba(151,187,205,1)",-->
<!--                pointStrokeColor : "#fff",-->
<!--                pointHighlightFill : "#fff",-->
<!--                pointHighlightStroke : "rgba(151,187,205,1)",-->
<!--                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]-->
<!--            }-->
<!--        ]-->
<!---->
<!--    }-->
<!---->
<!--    window.onload = function(){-->
<!--        var ctx = document.getElementById("canvas").getContext("2d");-->
<!--        window.myLine = new Chart(ctx).Line(lineChartData, {-->
<!--            responsive: true-->
<!--        });-->
<!--    }-->
<!---->
<!---->
<!--</script>-->
</body>
</html>