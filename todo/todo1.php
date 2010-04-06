<?php
  include('functions.inc');
  openHTML("To-Do List","ToDo");
  $db = openDatabase('myToDo');

  // Get item number to display
  $item=$_GET['item'];

  // Conntect to server
  echo "<p>\n";
  echo "</p>\n";

  $q1 = "SELECT `due`,`priority`,`category`,`predecessor`,`hours`," .
    "`percent`,`short_desc`,`description`,`comment`,`item_id`,`predecessor`" .
    " FROM `todo_items`" .
    " WHERE `item_id`=" . $item;
  $result = getResult($q1,$db);
  $row = mysql_fetch_row( $result );
  echo "<form name=\"edit1\" method=\"post\" action=\"todo2.php?item=" . 
    $row[9] . "\">\n";
  echo "<table width=\"100%\" border=\"1\">\n";

  // To-Do item number (item_id)
  echo "<tr><th align=\"right\">ID</th>";
  echo "<td id=\"id\"><b>" . $row[9] . "</b></font></td></tr>\n";

  // Short description (short_desc)
  echo "<tr><th align=\"right\">Item</th>";
  echo "<td>" . $row[6] . "</td></tr>\n";

  // Date due (due)
  echo "<tr><th align=\"right\">Due</th>";
  $dueyr=substr($row[0],0,4);
  $duemo=substr($row[0],5,2);
  $dueda=substr($row[0],8,2);
//echo "<td>" . $row[0] . "</td></tr>\n";
  echo "<td>";
  echo "<select name=\"dueyr\" value=\"" . $dueyr . "\" >\n";
  echo "<option>" . $dueyr . "</option>\n";
  echo "<option>2010</option>\n";
  echo "<option>2011</option>\n";
  echo "<option>2012</option>\n";
  echo "<option>2013</option>\n";
  echo "</select>\n";
  echo " - ";
  echo "<select name=\"duemo\" value=\"" . $duemo . "\" >\n";
  echo "<option>" . $duemo . "</option>\n";
  echo "<option>01</option>\n";
  echo "<option>02</option>\n";
  echo "<option>03</option>\n";
  echo "<option>04</option>\n";
  echo "<option>05</option>\n";
  echo "<option>06</option>\n";
  echo "<option>07</option>\n";
  echo "<option>08</option>\n";
  echo "<option>09</option>\n";
  echo "<option>10</option>\n";
  echo "<option>11</option>\n";
  echo "<option>12</option>\n";
  echo "</select>\n";
  echo " - ";
  echo "<select name=\"dueda\" value=\"" . $dueda . "\" >\n";
  echo "<option>" . $dueda . "</option>\n";
  for ( $i=1; $i<32; $i++ )
    {
      echo "<option value=\"" . $i . "\">";
      if ( $i<10 )
	echo "0" . $i . "</option>\n";
      else
	echo $i . "</option>\n";
    }
  echo "</select>\n";

  // Priority (priority)
  echo "<tr><th align=\"right\">Priority</th>";
  echo "<td>\n";
  echo "<select name=\"priority\" value=\""  . $row[1] . 
    "\" style=\"font-size: 28pt;\">\n";
  echo "<option value=\"" . $row[1] . "\">" . $row[1] . "</option>\n";
  echo "<option value=\"1\">1</option>\n";
  echo "<option value=\"2\">2</option>\n";
  echo "<option value=\"3\">3</option>\n";
  echo "<option value=\"4\">4</option>\n";
  echo "<option value=\"5\">5</option>\n";
  echo "</select>\n";
  echo "</td></tr>\n";

  // Hours (hours)
  echo "<tr><th align=\"right\">Hours</th>";
  echo "<td><input name=\"hours\" type=\"text\" value=\"" . $row[4] . 
    "\" size=\"3\" /></td></tr>\n";

  // Percent complete (percent)
  echo "<tr><th align=\"right\">% Complete</th>";
  echo "<td>\n";
  echo "<select name=\"complete\" value=\""  . $row[5] . 
    "\">\n";
  echo "<option value=\"" . $row[5] . "\">" . $row[5] . "</option>\n";
  echo "<option value=\"0\">0</option>\n";
  echo "<option value=\"10\">10</option>\n";
  echo "<option value=\"20\">20</option>\n";
  echo "<option value=\"30\">30</option>\n";
  echo "<option value=\"40\">40</option>\n";
  echo "<option value=\"50\">50</option>\n";
  echo "<option value=\"60\">60</option>\n";
  echo "<option value=\"70\">70</option>\n";
  echo "<option value=\"80\">80</option>\n";
  echo "<option value=\"90\">90</option>\n";
  echo "<option value=\"100\">100</option>\n";
  echo "</select>\n";
  echo "</td></tr>\n";

  // Predecessor (predecessor)
  if ( $row[10]>0 )
    {
      $q3="SELECT `short_desc` FROM `todo_items` " .
	"WHERE `item_id`=" . $row[10];
      $re3 = mysql_query($q3,$db);
      $rw3 = mysql_fetch_row( $re3 );
      $pred = "<b>" . $row[10] . "</b>: " . $rw3[0];
    }
  else
    $pred = $row[10];
  echo "<tr><th align=\"right\">Predecessor</th>";
  echo "<td>" . $pred . "</td></tr>\n";

  // Description (description)
  echo "<tr><th align=\"right\">Description</th>";
  echo "<td><textarea name=\"descrip\"  cols=\"27\" rows=\"2\">" . 
    $row[7] . "</textarea></td></tr>\n";

  // Comments (comments)
  echo "<tr><th align=\"right\">Comments</th>";
  echo "<td><textarea name=\"comment\" cols=\"27\" rows=\"2\" >" . 
    $row[8] . "</textarea></td></tr>\n";

  echo "<tr>";
  echo "<td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Submit\" style=\"font-size: 28pt; \"></td></tr>\n";

  echo "</table>\n";
  echo "</form>\n";
  echo "<p>&nbsp;</p>\n";
  echo "<p><center><a href=\"todo.php\">Back to list</a></center></p>\n";
  echo "<p>&nbsp;</p>\n";
?>
</div>
</body>
</html>
