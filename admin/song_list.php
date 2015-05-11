<?php
include("header.php");
$table = $db->select("melody");
$count = $db->select_count("melody");
?>
<?php
include("nav.php");
?>
<!-- Pagination -->
<?php
if(!empty($_GET['letter'])){
    $letter = $_GET['letter'];
    $where = "where song like '$letter%'";
}else{
    $where = "";
}

    if(!empty($_POST['submit'])){
        $singer = getpost('singer');
        $where = "where artist = '$singer'";
        $limit = 150;
    }else{
        $where = "";
        $limit = 40;
    }


$tbl_name="melody";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;

/*
   First get total number of rows in data table.
   If you have a WHERE clause in your query, make sure you mirror it here.
*/
$query = "SELECT COUNT(*) as num FROM $tbl_name $where";

$total_pages = mysql_fetch_array(mysql_query($query));
$total_pages = $total_pages[num];


/* Setup vars for query. */
$targetpage = "song_list.php"; 	//your file name  (the name of this file)
								//how many items to show per page
$page = $_GET['page'];
if($page)
    $start = ($page - 1) * $limit; 			//first item to display on this page
else
    $start = 0;								//if no page var is given, set start to 0

/* Get data. */
$sql = "SELECT * FROM $tbl_name $where ORDER BY song asc LIMIT $start, $limit";
//echo $sql;
$result = mysql_query($sql);

/* Setup page vars for display. */
if ($page == 0) $page = 1;					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/*
    Now we apply our rules and draw the pagination object.
    We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
if($lastpage > 1)
{
    $pagination .= "<nav class=\"paging clearfix\"><ul class=\"pagination col-lg-9 no-padding\">";
    //previous button
    if ($page > 1)
        $pagination.= "<li><a href=\"$targetpage?page=$prev\" aria-label=\"Previous\">&laquo;</a>";
    else
        $pagination.= "<li class=\"disabled\"><a><span aria-hidden=\"true\">&laquo;</span></a></li>";

    //pages
    if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
    {
        for ($counter = 1; $counter <= $lastpage; $counter++)
        {
            if ($counter == $page)
                $pagination.= "<li class=\"active\"><a>$counter <span class=\"sr-only\">(current)</span></a></li>";
            else
                $pagination.= "<li><a href=\"$targetpage?page=$counter\"> $counter </a></li>";
        }
    }
    elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
    {
        //close to beginning; only hide later pages
        if($page < 1 + ($adjacents * 2))
        {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li class=\"active\"><a><span> $counter </span></a></li>";
                else
                    $pagination.= "<li><a href=\"$targetpage?page=$counter\"> $counter <span class=\"sr-only\">(current)</span></a></li>";
            }
            //$pagination.= "...";

            $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">... $lpm1</a></li>";
            $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</li></a>";
        }
        //in middle; hide some front and some back
        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
        {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            //$pagination.= "...";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li class=\"active\"><span class=\"current active\"> $counter</span></li>";
                else
                    $pagination.= "<li><a href=\"$targetpage?page=$counter\"> $counter</a></li>";
            }
            //$pagination.= "...";
            $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">... $lpm1</a></li>";
            $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
        }
        //close to end; only hide early pages
        else
        {
            $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
            $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";

            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li class=\"active\"><span class=\"current\"> $counter </span></li>";
                else
                    $pagination.= "<li><a href=\"$targetpage?page=$counter\"> $counter </a></li>";
            }
        }
    }

    //next button
    if ($page < $counter - 1)
        $pagination.= "<li><a href=\"$targetpage?page=$next\" aria-label=\"Next\"> <span aria-hidden=\"true\">&raquo;</span> </a></li>";
    else
        $pagination.= "<li class=\"disabled\" <a href=\"$targetpage?page=$next\" aria-label=\"Next\"> <span aria-hidden=\"true\">&raquo;</span> </a></li>";
    $pagination.= "</ul></nav>\n";
}

?>
<!-- end Pagination -->




    <script type="text/javascript">
        var btns = "";
        var letters = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";
        //var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var letterArray = letters.split("");
        for(var i = 0; i < 26; i++){
            var letter = letterArray.shift();
            btns += '<button class="mybtns" onclick="alphabetSearch(\''+letter+'\');">'+letter+'</button>';
        }
        function alphabetSearch(let){
            //window.location = "song_list.php?letter="+let;
        }
    </script>

    <div id="page-wrapper">
        <div class="row">
            <!-- alphabetical sorting-->
            <script>//document.write(btns); </script>
            <!-- end alphabetical sorting-->

            <form role="form" method="POST" action="song_list.php">
                <div class="ui-widget">
                    <label for="singer">Исполнитель<br/>
                        <select id="combobox" name="singer" onchange="this.form.submit();" class="form-control">
                            <option value="">Select one...</option>
                            <?php
                            $artist = $db->select("artist");
                            foreach($artist as $art){
                                ?>
                                <option value="<?php echo $art['name']; ?>"><?php echo $art['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Поиск"/>
                </div>
            </form>


            <div class="col-lg-12">
                <h4 class="page-header">Все песни</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список песен
                        <span class="pull-right">Общее количество: <?php echo $count;?></span>
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover tex">
                                <thead>
                                <tr>
<!--                                    <th class="col-lg-2">№</th>-->
                                    <th class="col-lg-2">MP3</th>
                                    <th class="col-lg-2">Песня</th>
                                    <th class="col-lg-2">Исполнитель</th>
                                    <th class="col-lg-2">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php
                            $key = 0;
                            while($item = mysql_fetch_array($result))
                            {
                                $mp3 = explode("/radio/", $item['filename']);

                            ?>
                                <tr class="odd gradeX" id="refresh_div<?php echo $item['id'];?>">
                                    <td>
                                        <object type="application/x-shockwave-flash" data="dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
                                            <param name="wmode" value="transparent" />
                                            <param name="movie" value="dewplayer.swf" />
                                            <param name="flashvars" value="mp3=radio/<?php echo $mp3[1];?>&amp;showtime=1" />
                                        </object>
                                    </td>
                                    <td>

                                        <!-- Button trigger modal -->
                                        <button type="button" id="refresh_div<?php echo $item['id'];?>" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal<?php echo $item['id'];?>">
                                            <?php echo $item['song'];?>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal<?php echo $item['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Изменить название песни</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                            <div class="form-group">
                                                                <label class="sr-only" for="exampleInputEmail3">Название</label>
                                                                <input type="text" class="form-control" id="song_name_<?php echo $item['id'];?>" placeholder="название">
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="submit<?php echo $item['id'];?>" class="btn btn-default" data-dismiss="modal">Сохранить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                    <td><?=$item['artist'];?></td>
                                    <td>
                                        <a href="song_edit.php?id=<?=$item['id'];?>" class="btn btn-info col-lg-12">Изменить</a>
                                    </td>
                                </tr>

                                <script type="text/javascript">
                                    $(document).ready(function(){


                                        $("#submit<?php echo $item['id']; ?>").click(function(){
                                            var song_id = <?php echo $item['id']; ?>;
                                            var song_name = $("#song_name_<?php echo $item['id']; ?>").val();

// Returns successful data submission message when the entered information is stored in database.
                                            var dataString = 'song_id='+ song_id + '&song_name='+ song_name;

                                            if(song_id==0)
                                            {
                                                alert("Please Fill All Fields");
                                            }
                                            else
                                            {
// AJAX Code To Submit Form.
                                                //alert(dataString);
                                                $.ajax({
                                                    type: "GET",
                                                    url: "song_name_only.php",
                                                    data: dataString,
                                                    cache: false
                                                });
                                            }
                                            return false;
                                        });
                                    });
                                </script>

                            <?php
                                } // end of foreach(userlist);
                                ?>
                                </tbody>
                            </table>
                        </div><!-- dataTable_wrapper -->

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php
                echo $pagination;

            ?>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


    <?php
    include("footer.php");
    ?>