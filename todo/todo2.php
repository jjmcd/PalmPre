<?php
  // Connect to server
  include('functions.inc');
  $db = openDatabase('myToDo');

  // Get the ID for the to-do item
  $item=$_GET['item'];

  // get the description and update if necessary
  if ( isset($_POST['descrip']) )
    {
      $descrip=$_POST['descrip'];
      $q2 = "UPDATE `todo_items` SET `description`='" . 
	mysql_real_escape_string($descrip,$db) . 
	"' WHERE `item_id`=" . $item;
      $r2=mysql_query($q2,$db);
    }

  // get the comment and update if necessary
  if ( isset($_POST['comment']) )
    {
      $comment=$_POST['comment'];
      $q3 = "UPDATE `todo_items` SET `comment`='" . 
	mysql_real_escape_string($comment,$db) . 
	"' WHERE `item_id`=" . $item;
      $r3=mysql_query($q3,$db);
    }

  // get the priority and update if necessary
  if ( isset($_POST['priority']) )
    {
      $prio=$_POST['priority'];
      $q1 = "UPDATE `todo_items` SET `priority`=" . $prio . 
	" WHERE `item_id`=" . $item;
      $r1=mysql_query($q1,$db);
    }

  // get the percent complete and update if necessary
  if ( isset($_POST['complete']) )
    {
      $complete=$_POST['complete'];
      $q4 = "UPDATE `todo_items` SET `percent`=" . $complete . 
	" WHERE `item_id`=" . $item;
      $r4=mysql_query($q4,$db);
    }

  // get the hours and update if necessary
  if ( isset($_POST['hours']) )
    {
      $hours=$_POST['hours'];
      $q5= "UPDATE `todo_items` SET `hours`=" . $hours . 
	" WHERE `item_id`=" . $item;
      $r5=mysql_query($q5,$db);
    }

/*echo "<p>&nbsp;</p>\n";
  echo "<p><center><a href=\"todo.php\">Back to list</a></center></p>\n";
  echo "<p>&nbsp;</p>\n";*/

  header("Location: todo.php");

?>
</div>
</body>
</html>
