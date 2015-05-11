
</div>
<!-- /#wrapper -->


<!-- Metis Menu Plugin JavaScript -->
<script src="../admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../admin/dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="../admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

<!-- Include JS files. -->
<script src="../admin/froala-js/froala_editor.min.js"></script>

<!-- Include IE8 JS. -->
<!--[if lt IE 9]>
<script src="../admin/froala-js/froala_editor_ie8.min.js"></script>
<![endif]-->

<script>
    $(function() {
        $('div#edit').editable({
            inlineMode: false
        });
        $('div#edit1').editable({
            inlineMode: false
        })
    });
</script>

<script>
    var _validFileExtensions = [".mp3"];
    function Validate(oForm) {
        var arrInputs = oForm.getElementsByTagName("input");
        for (var i = 0; i < arrInputs.length; i++) {
            var oInput = arrInputs[i];
            if (oInput.type == "file") {
                var sFileName = oInput.value;
                if (sFileName.length > 0) {
                    var blnValid = false;
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                            blnValid = true;
                            break;
                        }
                    }

                    if (!blnValid) {
                        alert("Бир гана mp3 форматтагы файлдарды жүктѳй аласыз!");
                        return false;
                    }
                }
            }
        }

        return true;
    }
</script>

<script type="text/javascript" src="../css/bootstrap-3.3.2-dist/js/date.js"></script>



    </body>

</html>

