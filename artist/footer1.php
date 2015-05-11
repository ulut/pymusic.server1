<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

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

<!--ANIMATION PROGRESS-BAR-->
<script type="text/javascript">
    $(function() {
        $(".meter > span").each(function() {
            $(this)
                .data("origWidth", $(this).width())
                .width($(this).width())
                .animate({
                    width: $(this).data("origWidth")
                }, 1200);
        });
    });
</script>

<?php include("../ga.php") ?>

</body>
</html>