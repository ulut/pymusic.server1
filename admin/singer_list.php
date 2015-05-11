<?php
include("header.php");
$table = $db->select("artist");
$count = $db->select_count("artist");
?>
<?php
include("nav.php");
?>
    <!-- Pagination -->
<?php
if(!empty($_GET['letter'])){
    $letter = $_GET['letter'];
    $where = "where name like '$letter%'";
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


$tbl_name="artist";		//your table name
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
$targetpage = "singer_list.php"; 	//your file name  (the name of this file)
//how many items to show per page
$page = $_GET['page'];
if($page)
    $start = ($page - 1) * $limit; 			//first item to display on this page
else
    $start = 0;								//if no page var is given, set start to 0

/* Get data. */
$sql = "SELECT * FROM $tbl_name $where LIMIT $start, $limit";
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
        function alphabetSearch(letters){
            window.location = "singer_list.php?letter="+letters;
        }
    </script>

    <div id="page-wrapper">
        <div class="row">
            <!-- alphabetical sorting-->
            <script>document.write(btns); </script>
            <!-- end alphabetical sorting-->

            <div class="col-lg-12">
                <h4 class="page-header">Все исполнители</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список исполнителей
                        <span class="pull-right">Общее количество: <?php echo $count;?></span>
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover tex">
                                <thead>
                                <tr>
                                    <th class="col-lg-2">Имя</th>
                                    <th class="col-lg-2">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                while($item = mysql_fetch_array($result))
                                {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?=$item['name'];?></td>
                                        <td>
                                            <a href="singer_edit.php?id=<?=$item['id'];?>" class="btn btn-info col-lg-5">Изменить</a>
                                        </td>
                                    </tr>
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