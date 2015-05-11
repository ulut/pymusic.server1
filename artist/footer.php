<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<!--CUSTOM MARQUEE-->
<script type="text/javascript" src="../js/jquery.liMarquee.js"></script>

<script>
    $(document).ready(function(){
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

        var getProgressOuterWidth = $('.progress-outer-left').width();

        <?php
        foreach($radios as $radio){
        ?>
            var getPercent1<?php echo $radio["id"]; ?> = ($('.progress-wrap1<?php echo $radio["id"]; ?>').data('progress-percent') / 100);
            var getPercent2<?php echo $radio["id"]; ?> = ($('.progress-wrap2<?php echo $radio["id"]; ?>').data('progress-percent') / 100);
            var getPinWidth1<?php echo $radio["id"]; ?> = $('.pin1<?php echo $radio["id"]; ?>').outerWidth();
            var getPinWidth2<?php echo $radio["id"]; ?> = $('.pin2<?php echo $radio["id"]; ?>').outerWidth();
            var getProgressWrapWidth1<?php echo $radio["id"]; ?> = $('.progress-wrap1<?php echo $radio["id"]; ?>').width();
            var getProgressWrapWidth2<?php echo $radio["id"]; ?> = $('.progress-wrap2<?php echo $radio["id"]; ?>').width();
            var progressTotal1<?php echo $radio["id"]; ?> = getPercent1<?php echo $radio["id"]; ?> * getProgressWrapWidth1<?php echo $radio["id"]; ?>;
            var progressTotal2<?php echo $radio["id"]; ?> = getPercent2<?php echo $radio["id"]; ?> * getProgressWrapWidth2<?php echo $radio["id"]; ?>;
            var animationLength = 2500;

            // on page load, animate percentage bar to data percentage length
            // .stop() used to prevent animation queueing
            $('.progress-bar1<?php echo $radio["id"]; ?>').stop().animate({
                right: progressTotal1<?php echo $radio["id"]; ?>
            }, animationLength);

            if((getPinWidth1<?php echo $radio["id"]; ?> + progressTotal1<?php echo $radio["id"]; ?>) > getProgressOuterWidth){
                $('.pin1<?php echo $radio["id"]; ?>').stop().animate({
                    right: progressTotal1<?php echo $radio["id"]; ?> - getPinWidth1<?php echo $radio["id"]; ?>
                }, animationLength);
            }else{
                $('.pin1<?php echo $radio["id"]; ?>').stop().animate({
                    right: progressTotal1<?php echo $radio["id"]; ?>
                }, animationLength);
            }

            $('.progress-bar2<?php echo $radio["id"]; ?>').stop().animate({
                left: progressTotal2<?php echo $radio["id"]; ?>
            }, animationLength);

            if((getPinWidth2<?php echo $radio["id"]; ?> + progressTotal2<?php echo $radio["id"]; ?>) > getProgressOuterWidth){
                $('.pin2<?php echo $radio["id"]; ?>').stop().animate({
                    left: progressTotal2<?php echo $radio["id"]; ?> - getPinWidth2<?php echo $radio["id"]; ?>
                }, animationLength);
            }else{
                $('.pin2<?php echo $radio["id"]; ?>').stop().animate({
                    left: progressTotal2<?php echo $radio["id"]; ?>
                }, animationLength);
            }
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

<script>
    (function( $ ) {
        $.widget( "custom.combobox", {
            _create: function() {
                this.wrapper = $( "<span>" )
                    .addClass( "custom-combobox" )
                    .insertAfter( this.element );

                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children( ":selected" ),
                    value = selected.val() ? selected.text() : "";

                this.input = $( "<input>" )
                    .appendTo( this.wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy( this, "_source" )
                    })
                    .tooltip({
                        tooltipClass: "ui-state-highlight"
                    });

                this._on( this.input, {
                    autocompleteselect: function( event, ui ) {
                        ui.item.option.selected = true;
                        this._trigger( "select", event, {
                            item: ui.item.option
                        });
                    },

                    autocompletechange: "_removeIfInvalid"
                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false;

                $( "<a>" )
                    .attr( "tabIndex", -1 )
                    .attr( "title", "Баарын к?рс?т" )
                    .tooltip()
                    .appendTo( this.wrapper )
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass( "ui-corner-all" )
                    .addClass( "custom-combobox-toggle ui-corner-right" )
                    .mousedown(function() {
                        wasOpen = input.autocomplete( "widget" ).is( ":visible" );
                    })
                    .click(function() {
                        input.focus();

                        // Close if already visible
                        if ( wasOpen ) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete( "search", "" );
                    });
            },

            _source: function( request, response ) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                response( this.element.children( "option" ).map(function() {
                    var text = $( this ).text();
                    if ( this.value && ( !request.term || matcher.test(text) ) )
                        return {
                            label: text,
                            value: text,
                            option: this
                        };
                }) );
            },

            _removeIfInvalid: function( event, ui ) {

                // Selected an item, nothing to do
                if ( ui.item ) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children( "option" ).each(function() {
                    if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if ( valid ) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val( "" )
                    .attr( "title", value + " didn't match any item" )
                    .tooltip( "open" );
                this.element.val( "" );
                this._delay(function() {
                    this.input.tooltip( "close" ).attr( "title", "" );
                }, 2500 );
                this.input.autocomplete( "instance" ).term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });
    })( jQuery );

    $(function() {
        $( "#combobox" ).combobox();
        $( "#toggle" ).click(function() {
            $( "#combobox" ).toggle();
        });
    });
</script>

<?php include("../ga.php") ?>

</body>
</html>