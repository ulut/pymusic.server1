<!DOCTYPE html>
<html>
<head>
    <title>Upload Multiple Images Using jquery and PHP</title>

    <script type="text/javascript">
            $('input[type=file]').simpleFilePreview({
                existingFiles: {
                    "123": "linux-1.jpg",
                    "456": "linux-2.png"
                }
            });
    </script>
<body>
<div id="maindiv">
    <div id="formdiv">
        <h2>Multiple Image Upload Form</h2>
        <form enctype="multipart/form-data" action="" method="post">
            First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.
            <input type='file' id='ex2' name='ex2[]' multiple='multiple' />

            <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
        </form>
        <!------- Including PHP Script here ------>
        <?php include "upload.php"; ?>
    </div>
</div>
</body>
</html>