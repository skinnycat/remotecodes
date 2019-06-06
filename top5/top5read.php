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
            <div id="containerMainFileList">
                <div id="formArea">
<?php
$codes_list = array();
$correctFormat=1;
$splitIndex = array();
$splitIndexPos = 0;
$targetFolder = "top5/";


//Code files
$t5FileName = "top5.txt";


$row = 0;

if (($handle = fopen("remotecodes/top5.csv", "r")) !== FALSE) {


    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

        if ($num == 7) {

            //add to codes list

            $rowPos = 3;

            while ($data[$rowPos]!=="") {

                $codes_list[$row] = $data[$rowPos];

                $rowPos++;
                if ($rowPos == 8) {$rowPos = 3};
                $row++;
            }

            //Index asterix point
            $codes_list[$row] = "*";


        } else {

            $correctFormat = 0;
        }

    }


    fclose($handle);

    if ($correctFormat == 1){


    //Write Manufacturer list file
    $targetFileName = $targetFolder.$t5FileName;
	$t5File = fopen($targetFileName, 'w') or die("can't open file");
	$stringData = "!POPULATE\n";
	fwrite($t5File, $stringData);
	$stringData = "*\n";
	fwrite($t5File, $stringData);

    for ($c=0;$c < count($codes_list);$c++){
        $stringData = $manu_list[$c]."\n";
        fwrite($t5File, $stringData);
    }
    fclose($t5File);

    echo $row." rows of data processed.<br><br>";

    echo "<table>\n";
    echo "<tr>\n";
    echo "<td class='noBorder'><u>Filename</u></td><td class='noBorder'><u>Size</u></td><td class='noBorder'></td><td class='noBorder'></td>";
    echo "</tr>";

    echo "<tr><td class='noBorder' width='200px'>$t5FileName ($row)</td><td class='noBorder' width='100px'>".(round(filesize($t5FileName)/1024,2))." Kb</td><td class='noBorder' width='75px'><a href='$manFileName' target='_blank'>View</a></td><td class='noBorder'><a href='download.php?fn=".$manFileName."'>Download</a></td></tr>\n";

    echo "</table>\n";


    } else {
       echo "The .CSV file is not in the correct format.<br><br>The correct format is:<br><br>REVISION No.,MANUFACTURER,MODEL,CODE,CODE,CODE..<br><br>";

    }

?>

            <form action="index.php" method="get">
                <button type="submit">Back</button>
            </form>


<?php
}

?>
                </div>
           </div>
           <div id="footer">Neil Cooper BSKYB 2011</div>
       </div>
	</body>
</html>