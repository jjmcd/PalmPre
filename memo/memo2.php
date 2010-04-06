<?php
  // Connect to server
  include('functions.inc');
  $db = openDatabase('myToDo');

  // Get the ID for the to-do item
  $item=$_GET['item'];

  // Get the title
  if ( isset($_POST['title']) )
    {
      $title=$_POST['title'];
      $q1 = "UPDATE `memos` SET `title`='" . 
        mysql_real_escape_string($title,$db) . 
        "' WHERE `memo_id`=" . $item;
      echo "<p>$q2</p>\n";
      $r1=mysql_query($q1,$db);
    }

  // Get the content
  if ( isset($_POST['content']) )
    {
      $content=$_POST['content'];
      $q2 = "UPDATE `memos` SET `content`='" . 
        mysql_real_escape_string($content,$db) . 
        "' WHERE `memo_id`=" . $item;
      echo "<p>$q2</p>\n";
      $r2=mysql_query($q2,$db);
    }

  header("Location: memo.php");

?>