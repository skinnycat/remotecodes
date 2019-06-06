<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
Written by Neil Cooper
Interactive Development and Support
BSKYB

Date: 17-06-2011

-->

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="stylesheet" href="styles/style.css"/>
</head>

    <body>

        <div id="container">
            <div id="containerMain">
                <div id="formArea">
        <?php
            $target_path = "remotecodes/t5codes.csv";
            $errorMessage = "";

		    $ok=1;

		    $filename = $_FILES['uploadedfile']['name'];
		    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
		    $manufilename = $_FILES['uploadedfile']['name'];
		    $manuext = substr($manufilename, strpos($manufilename,'.'), strlen($filename)-1);

		    if (!($ext == ".csv")){

		        $errorMessage = "This was not a .csv file<br><br>";
		        $ok=0;
		    }

		    //This is our size condition
		    if ($uploaded_size > 10000000)
		    {
		        $errorMessage += "Your file is too large.<br><br>";
		        $ok=0;
		    }


            if ($ok==0) {
                echo "Sorry your file could not be uploaded<br><br>Reason: ". $errorMessage;

		?>
        <form action="index.php" method="get">
            <button type="submit">Back</button>
        </form>

		<?php

            } else {
		if(!(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], "remotecodes/t5codes.csv")) || !(move_uploaded_file($_FILES['manufile']['tmp_name'], "remotecodes/manut5list.csv"))) {

		//if(!(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], "remotecodes/t5codes.csv"))) {
		    echo "There was an error uploading the file, please try again!";
		?>
        <form action="index.php" method="get">
            <button type="submit">Back</button>
        </form>

		<?php

		} else{
		    echo "<br><br>The file: [".  basename( $_FILES['uploadedfile']['name'])."] has been uploaded successfully.<br><br>";

		    echo "File Size: ".(round(filesize($target_path)/1024,2))."Kb<br>\n";
        ?>
        <br>
        <form action="top5read.php" method="get">
            <button type="submit">Process Remote Codes</button>
        </form>

        <?php
         }
         }
        ?>
        </div>
		</div>
		<div id="footer">Neil Cooper BSKYB 2011</div>
		</div>
	</body>
</html>

