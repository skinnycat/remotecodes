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
$man_list = array();
$correctFormat = 1;
$newFile = 1;
$splitIndex = array();
$splitIndexPos = 0;
$targetFolder = "remotecodes/";

$t5FileName =      Array("top5abc.txt",
                         "top5def.txt",
                         "top5g.txt",
                         "top5hijk.txt",
                         "top5lm.txt",
                         "top5no.txt",
                         "top5p.txt",
                         "top5qrs.txt",
                         "top5tuvwxyz.txt");

$manu_index = array("0","d","g","h","l","n","p","q","t","zz");
$manu_index_pointer = 0;
$man_list_pointer = 0;


//Code files
//$t5FileName = "top5.txt";
$currentT5File = "";


$row = 0;


if ((($handle = fopen("remotecodes/t5codes.csv", "r")) !== FALSE) && (($manuhandle = fopen("remotecodes/Manu_list.txt", "r")) !== FALSE)) {


    //Pull in the Manufacturers list into an array

    while (($manuData = fgetcsv($manuhandle, 1000, ",")) !== FALSE) {

        if ($row > 1) {
          $man_list[$row-2] = $manuData[0];
          //echo $row." ".$man_list[$row-2] . "<br>";
        }

        $row++;

    }

    //set the row pointer back to zero
    $row = 0;

    $currentT5File = $targetFolder.$t5FileName[$manu_index_pointer];
    //echo "t5FileName[$manu_index_pointer]: ".$t5FileName[$manu_index_pointer]."<br>";
    //echo "currentT5File>: ".$currentT5File."<br>";
    //Open the first T5 output file

    //echo "opening $currentT5File <br>";
    $azT5File = fopen($currentT5File, 'w') or die ("can't open $currentT5File file");



    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        $tryAgain = 1;

        while ($tryAgain == 1) {

        //echo "row: ".$row."<br>";

        $num = count($data);


        if ($num == 7) {

            //if name starts with next letter in the list

           // echo "manu_index+1: ".$manu_index[$manu_index_pointer + 1]."<br>";

           // echo ">> if ".$data[1]." >= ".$manu_index[$manu_index_pointer + 1]."<br>";

            if (strtolower(substr($data[1], 0, 1)) >= $manu_index[$manu_index_pointer+1]) {

                //close the last file
                fclose ($azT5File);

                //Set the newFile flag
                $newFile = 1;
                // echo "newFile: ".$newFile."<br>";

                $manu_index_pointer = $manu_index_pointer + 1;
                //echo "manu_index_pointer: ".$manu_index_pointer."<br>";


            }

            $currentT5File = $targetFolder.$t5FileName[$manu_index_pointer];
            //echo "currentT5File: ".$currentT5File."<br>";

            if ($newFile == 1) {


                //reset the old file
                $newFile = 0;
                //echo "newFile: ".$newFile."<br>";

                $azT5File = fopen($currentT5File, 'w') or die ("can't open $currentT5File file");

                $stringData = "!POPULATE\n";
                fwrite ($azT5File, $stringData);
                //echo $stringData;
                $stringData = "*\n";
                fwrite ($azT5File, $stringData);
                //echo $stringData;
            }

            //add to codes list

            //if splitCheck is TRUE, an * has been written
            $splitCheck = FALSE;

            //If this is a REV9 code

            if ($data[0] == "REV9"){

                //Check manufacturer again Manufacturer list
                //echo "if ".strtolower ($man_list[$man_list_pointer])." == ".(strtolower ($data[1]))."<br>";
                if (strtolower ($man_list[$man_list_pointer]) == strtolower ($data[1])) {

                    for ($dataItem=2;$dataItem < 7;$dataItem++){

                        $currentData = $data[$dataItem];

                        if ( !(empty($currentData)) ) {

                            $codes_list[$row] = $data[$dataItem]."\n";
                            //Write current data into the file
                            fwrite ($azT5File, $codes_list[$row]);
                            //echo $codes_list[$row];
                            $row++;

                        } else {

                            if (!$splitCheck){
                                $codes_list[$row] = "*\n";
                                $splitCheck = TRUE;
                                //Write current data into the file
                                fwrite ($azT5File, $codes_list[$row]);
                                //echo $codes_list[$row];
                                $row++;
                            }

                        }

                    } //if manufacturer is in the list

                    if (!$splitCheck){
                            $codes_list[$row] = "*\n";
                            //Write current data into the file
                            fwrite ($azT5File, $codes_list[$row]);
                            //echo $codes_list[$row];
                            $row++;
                    }

                    $man_list_pointer++;

                    $tryAgain = 0;

                } elseif (strtolower ($man_list[$man_list_pointer]) > strtolower ($data[1])) {

                    $tryAgain = 0;

                } else {

                    $codes_list[$row] = "9999\n";
                    fwrite ($azT5File, $codes_list[$row]);
                    $row++;
                    $codes_list[$row] = "*\n";
                    $row++;
                    $man_list_pointer = $man_list_pointer+1;
                    $tryAgain = 1;
                }



            }


        } else {

            $correctFormat = 0;

        }

        }

    }

    fclose($azT5File);
    fclose($handle);
    fclose($manuhandle);

    if ($correctFormat == 1){


        echo $row." rows of data processed.<br><br>";



        echo "<table>\n";
        echo "<tr>\n";
        echo "<td class='noBorder'><u>Filename</u></td><td class='noBorder'><u>Size</u></td><td class='noBorder'></td><td class='noBorder'></td>";
        echo "</tr>";

        for ($i=0; $i < count($t5FileName); $i++){

            echo "<tr><td class='noBorder' width='200px'>$t5FileName[$i] ($row)</td><td class='noBorder' width='100px'>".(round(filesize($targetFolder.$t5FileName[$i])/1024,2))." Kb</td><td class='noBorder' width='75px'><a href='$targetFolder$t5FileName[$i]' target='_blank'>View</a></td><td class='noBorder'><a href='download.php?fn=".$targetFolder.$t5FileName[$i]."'>Download</a></td></tr>\n";
        }

        echo "</table>\n";


    } else {

        echo "The .CSV file is not in the correct format.<br><br>";

    }

?>

            <form action="t5index.php" method="get">
                <button type="submit">Back</button>
            </form>


<?php
} //end open files

?>
                </div>
           </div>
           <div id="footer">Neil Cooper BSKYB 2011</div>
       </div>
	</body>
</html>