<?php
$fileName = $_GET["fn"];
$displayName = str_replace("remotecodes/","",$fileName);
header('Content-disposition: attachment; filename="'.$displayName.'"');
header('Content-type: text/plain');
readfile($fileName);
?>