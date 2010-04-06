<?php
function openHTML($title,$keywords)
{
  echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
  echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">\n";
  echo "<head>\n";
  echo "  <title>" . $title . "</title>\n";
  echo "  <meta name=\"KEYWORDS\" content=\"" . $keywords . "\" />\n";
  echo "  <style type=\"text/css\" media=\"all\">@import \"palm.css\";</style>\n";
  echo "</head>\n";

  echo "<body>\n";
  echo "<div id=\"container\">\n";
}


function openDatabase($databasename)
{
  // Get connection info
  $fh = fopen( '/var/www/.tododb','r');
  $dbusr=base64_decode(fgets($fh,4096));
  $dbpwd=base64_decode(fgets($fh,4096));
  fclose($fh);

  // Connect to server
  $db = mysql_connect("localhost", $dbusr, $dbpwd);
  if ( $db == NULL )
    {
	echo '<BR>' . mysql_error($db),' connect error ', _('Database Error') 
	  . "<br />\n";
	exit;
    }

  // Select the database
  mysql_select_db($databasename,$db);
  if (mysql_errno($db) != 0 )
    {
	echo '<p>' . mysql_error($db),' select error ', _('Database Error') 
	  . "</p>\n";
	exit;
    }
  return $db;
}

// Get a result from the database, display error if fails
function getResult( $query, $db )
{
  $result = mysql_query($query,$db);
  if (mysql_errno($db) != 0 )
    {
	echo '<p>' . mysql_error($db) . 
	  ' query error ', _('Database Error') . "</p>\n";
    }
  return $result;
}

// Close out the html page
function closeHTML()
{
echo "</div>\n</body>\n</html>\n";
}
?>
