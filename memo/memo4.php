<?php
  // Connect to server
  include('functions.inc');
  $db = openDatabase('myToDo');

  // Get the title
  if ( isset($_POST['title']) )
    $title="'" . mysql_real_escape_string($_POST['title'],$db) . "'";
  else
    $title = "NULL";
  if ( $title=="''" )
    $title = "NULL";

  // Get the content
  if ( isset($_POST['content']) )
    $content="'" . mysql_real_escape_string($_POST['content'],$db) . "'";
  else
    $content = "NULL";
  if ( $content=="''" )
    $content = "NULL";

  // Get the category
  if ( isset($_POST['category']) )
    $category=$_POST['category'];
  if ( $category<1 )
    $category=4;

  $q1 = "INSERT INTO `memos` (`title`,`content`,`category`,`updated`) VALUES(" .
    $title . ',' . $content . "," . $category . ",now());";
  $r1 = mysql_query($q1,$db);

  header("Location: memo.php");

?>