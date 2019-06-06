<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="stylesheet" href="styles/style.css"/>
</head>

    <body>

<?php

//*** Connect to Live DB
mysql_connect("10.20.88.46", "SkyGames", "h1ghd1v3") or die(mysql_error());
mysql_select_db("highscores") or die(mysql_error());

//*** Gets top 250 scores
$result = mysql_query("SELECT * FROM tblEntry where compId = 140 order By score desc limit 250");
$Data = "<leaderboard>\n\n";
echo $Data;

//** Enter results loop
while($row = mysql_fetch_array($result))
  {

  $Data = "\t<entry>\n\t\t<username>";
  echo $Data;
  echo substr($row['uName'], 0, 18);

  $Data = "</username>\n\t\t<score>";
  echo $Data;
  echo $row['score'];

  $Data = "</score>\n\t</entry>\n\n";
  echo $Data;

  }

// end database retrieval code

$Data = "</leaderboard>\n";
echo $Data;

?>

</body>
</html>