<?php
  include('functions.inc');
  openHTML("To-Do List","ToDo");
  $db = openDatabase('myToDo');

  // If category passed in display only that category
  if ( isset($_GET['category']) )
    {
      $category=$_GET['category'];
      $SelectCat = " AND `category`=" . $category;
    }
  else
    $SelectCat = "";

  echo "<p></p>\n";

  // Display to do items
  echo "<div id=\"head\">\n";
  echo "<h1><center>ToDo items</center></h1>\n</div>\n";
  echo "  <table width=100%>\n";
  echo "    <tr><th>Prio</th><th>Due</th><th>Desc</th></tr>\n";
  $q1 = "SELECT A.priority,A.due,A.short_desc,B.color,A.item_id" .
    " FROM `todo_items` A, categories B" .
    " WHERE A.category = B.cat_id" .
    " AND `percent`<100 " . 
    $SelectCat . 
    " ORDER BY `due`,`priority`" .
    " LIMIT 0,19";
  $result = getResult($q1,$db);
  while ( $myrow = mysql_fetch_row($result) )
    {
      $disdate = substr($myrow[1],5,5);
      $textcolor="#bbb";
      if ( $myrow[0] == 4 )
	$textcolor="#888";
      if ( $myrow[0] == 3 )
	$textcolor="#666";
      if ( $myrow[0] == 2 )
	$textcolor="#000";
      if ( $myrow[0] == 1 )
	$textcolor="#f00";
      echo "    <tr style=\"background-color: " . $myrow[3] . 
	"; height: 30pt; \" valign=\"middle\">\n";
      echo "      <td align=\"center\" style=\"font-size: 36pt; color: " . 
	$textcolor . "\">" . $myrow[0] . 
	"</td>\n      <td align=\"center\">" . 
	$disdate . 
	"</td>\n      <td><a href=\"todo1.php?item=" . $myrow[4] . "\">" . 
	$myrow[2] . "</a></td>\n";
      echo "    </tr>\n";
    }
  echo "  </table>\n";
  echo "\n";
  echo "  <hr />\n";

  // List categories with self link filtered by category
  echo "  <div id=\"head\"><h1><center>Categories</center></h1></div>\n";
  echo "  <table width=\"100%\">\n";
  $q2 = "SELECT `name`,`color`, `cat_id` FROM `categories`" .
    " ORDER BY `shortname`";
  $r2 = getResult($q2,$db);
  while ( $row2 = mysql_fetch_row($r2) )
    {
      echo "<tr><td style=\"background-color: " . $row2[1] .
	"; height: 30pt; \" align=\"center\">";
      echo "<a href=\"todo.php?category=" . $row2[2] . "\">";
      echo $row2[0] . "</a></td></tr>\n";
    }
  echo "<tr><td align=\"center\"><a href=\"todo.php\">All</a></td></tr>\n";
  echo "</table>\n";
  echo "</p>\n";
?>
</div>
</body>
</html>
