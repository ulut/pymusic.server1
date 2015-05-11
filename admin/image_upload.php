<?php
    include('../config.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Multiple Images Using jquery and PHP</title>
    <!-------Including jQuery from Google ------>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!------- Including CSS File ------>
    <link rel="stylesheet" type="text/css" href="style.css">

    <script type="text/javascript">
        var abc = 0;      // Declaring and defining global increment variable.
        $(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
            $('#add_more').click(function() {
                $(this).before($("<div/>", {
                    id: 'filediv'
                }).fadeIn('slow').append($("<input/>", {
                        name: 'file[]',
                        type: 'file',
                        id: 'file'
                    }), $("<br/><br/>")));
            });
// Following function will executes on change event of file input to select different file.
            $('body').on('change', '#file', function() {
                if (this.files && this.files[0]) {
                    abc += 1; // Incrementing global variable by 1.
                    var z = abc - 1;
                    var x = $(this).parent().find('#previewimg' + z).remove();
                    $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                    $(this).hide();
                    $("#abcd" + abc).append($("<img/>", {
                        id: 'img',
                        src: 'x.png',
                        alt: 'delete'
                    }).click(function() {
                            $(this).parent().parent().remove();
                        }));
                }
            });
// To Preview Image
            function imageIsLoaded(e) {
                $('#previewimg' + abc).attr('src', e.target.result);
            };
            $('#upload').click(function(e) {
                var name = $(":file").val();
                if (!name) {
                    alert("First Image Must Be Selected");
                    e.preventDefault();
                }
            });
        });
    </script>
<body>
<div id="maindiv">
    <div id="formdiv">
        <h2>Multiple Image Upload Form</h2>
        <form enctype="multipart/form-data" action="" method="post">
            First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.
            <div id="filediv"><input name="file[]" type="file" id="file"/></div>
            <input type="button" id="add_more" class="upload" value="Add More Files"/>
            <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
        </form>
        <!------- Including PHP Script here ------>
        <?php include "upload.php"; ?>
    </div>
</div>
</body>
</html>
