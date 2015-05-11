<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<!--CUSTOM MARQUEE-->
<script type="text/javascript" src="../js/jquery.liMarquee.js"></script>

<script>
    $(window).load(function(){
        $('.slide-radios').liMarquee({
            direction: 'left'
        });
    });
</script>

<script type="text/javascript">
    // on page load...
    $(window).load(function(){
        moveProgressBar();
        // on browser resize...
    });

    $(window).resize(function() {
        moveProgressBar();
    });

    // SIGNATURE PROGRESS
    function moveProgressBar() {
        console.log("moveProgressBar");

        <?php
        foreach($radios as $radio){
        ?>
        var getPercent1<?php echo $radio["id"]; ?> = ($('.progress-wrap1<?php echo $radio["id"]; ?>').data('progress-percent') / 100);
        var getPercent2<?php echo $radio["id"]; ?> = ($('.progress-wrap2<?php echo $radio["id"]; ?>').data('progress-percent') / 100);
        var getProgressWrapWidth1<?php echo $radio["id"]; ?> = $('.progress-wrap1<?php echo $radio["id"]; ?>').width();
        var getProgressWrapWidth2<?php echo $radio["id"]; ?> = $('.progress-wrap2<?php echo $radio["id"]; ?>').width();
        var progressTotal1<?php echo $radio["id"]; ?> = getPercent1<?php echo $radio["id"]; ?> * getProgressWrapWidth1<?php echo $radio["id"]; ?>;
        var progressTotal2<?php echo $radio["id"]; ?> = getPercent2<?php echo $radio["id"]; ?> * getProgressWrapWidth2<?php echo $radio["id"]; ?>;
        var animationLength = 2500;

        // on page load, animate percentage bar to data percentage length
        // .stop() used to prevent animation queueing
        $('.progress-bar2<?php echo $radio["id"]; ?>.progress-win').stop().animate({
            left: progressTotal2<?php echo $radio["id"]; ?>
        }, animationLength);
        $('.progress-bar2<?php echo $radio["id"]; ?>.progress-lost').stop().animate({
            left: progressTotal2<?php echo $radio["id"]; ?>
        }, animationLength);
        $('.progress-bar1<?php echo $radio["id"]; ?>.progress-win').stop().animate({
            right: progressTotal1<?php echo $radio["id"]; ?>
        }, animationLength);
        $('.progress-bar1<?php echo $radio["id"]; ?>.progress-lost').stop().animate({
            right: progressTotal1<?php echo $radio["id"]; ?>
        }, animationLength);
        <?php } ?>
    }
</script>

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

<?php include("../ga.php") ?>

</body>
</html>