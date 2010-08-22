<?php
  include('functions.inc');
  openHTML("Memos","memos Palm");
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

  // Display memo items
  echo "<div id=\"head\">\n";
  echo "<h1><center>Memos</center></h1>\n</div>\n";
  echo "  <table width=100%>\n";
  echo "    <tr><th>ID</th><th>Title</th></tr>\n";
  $q1 = "SELECT A.memo_id,A.title,B.color" .
    " FROM `memos` A, categories B" .
    " WHERE A.category = B.cat_id" .
    $SelectCat . 
    " ORDER BY A.`updated` DESC" .
    " LIMIT 0,10";
  $result = getResult($q1,$db);
  while ( $myrow = mysql_fetch_row($result) )
    {
      echo "    <tr style=\"background-color: " . $myrow[2] . 
	"; height: 28pt; \" valign=\"middle\">\n";
      echo "      <td align=\"center\" style=\"font-size: 28pt; \">" . $myrow[0] . 
	"</td>\n      <td><a href=\"memo1.php?item=" . $myrow[0] . "\">" . 
	$myrow[1] . "</a></td>\n";
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
      echo "<a href=\"memo.php?category=" . $row2[2] . "\">";
      echo $row2[0] . "</a></td></tr>\n";
    }
  echo "<tr><td align=\"center\" style=\"background-color:black;\">" .
    "<a href=\"memo3.php\" style=\"color:yellow;\">New</a></td></tr>\n";
  echo "<tr><td align=\"center\"><a href=\"memo.php\">All</a></td></tr>\n";
  echo "</table>\n";
  echo "</p>\n";
  closeHTML();
?>