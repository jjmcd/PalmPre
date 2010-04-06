<?php
{
  include('functions.inc');
  openHTML("New memo","memos Palm");
  $db = openDatabase('myToDo');
  

  echo "<form name=\"memo\" method=\"post\" action=\"memo4.php \">\n";
  echo "<b>Title:</b><br />\n";
  echo "<b><br /><input type=\"text\" name=\"title\" size=\"34\" /></b>\n";

  echo "<br />Category:<br />\n";
  $q1 = "SELECT `cat_id`,`name`,`color` FROM `categories`";
  $r1 = getResult($q1,$db);
  echo "<select name=\"category\" type=\"select\">\n";
  while ( $row1 = mysql_fetch_row($r1) )
    {
      echo "  <option value=\"" . $row1[0] . "\" >";
      echo $row1[1];
      echo "</option>\n";
    }
  echo "</select>\n";
  echo "<br /><b>Contents:</b><br />\n";
  echo "<textarea name=\"content\" cols=\"36\" rows=\"40\">\n";
  //echo $row[1] . "\n";
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