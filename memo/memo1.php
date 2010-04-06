<?php
{
  include('functions.inc');
  openHTML("Edit Memo","memos Palm");
  $db = openDatabase('myToDo');
  
  $id = $_GET['item'];

  echo "<p>Item: " . $id . "</p>\n";

  $q1 = "SELECT A.`title`,A.`content`,A.`category`,B.`color` " .
    "FROM `memos` A, `categories` B " .
    "WHERE A.`memo_id`=" . $id .
    " AND  A.`category` = B.`cat_id`";
  //echo "<p>[" . $q1 . "]</p>\n";
  $r1 = getResult( $q1, $db );
  $row = mysql_fetch_row($r1);

  echo "<form name=\"memo\" method=\"post\" action=\"memo2.php?item=" .
    $id . "\">\n";
  echo "<b><input type=\"text\" name=\"title\" size=\"34\" value=\"" . $row[0] . "\" style=\"background-color: " . $row[3] . "; \" /></b>\n";
  echo "<textarea name=\"content\" cols=\"36\" rows=\"40\">\n";
  echo $row[1] . "\n";
  echo "</textarea><br />\n";
  echo "<p>&nbsp;</p>\n<center>\n";
  echo "<input type=\"submit\" value=\"Submit\" style=\"font-size: 28pt; \">\n";
  echo "<p>&nbsp;</p>\n";
  echo "<a href=\"memo.php\">Back to list</a>\n";
  echo "<p>&nbsp;</p>\n";
  echo "</form>\n";

  closeHTML();
}
?>