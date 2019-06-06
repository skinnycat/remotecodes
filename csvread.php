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
$models = array();
$manu_list = array();
$codes_list = array();
$split_index = array();
$a_z_splitIndex = array();
$correctFormat=1;
$targetFolder = "remotecodes/";


//Code files
$codeFileName =    Array("Codes_a_to_c.txt",
                         "Codes_d_to_f.txt",
                         "Codes_g.txt",
                         "Codes_h_to_k.txt",
                         "Codes_l_to_m.txt",
                         "Codes_n_to_o.txt",
                         "Codes_p.txt",
                         "Codes_q_to_s.txt",
                         "Codes_t_to_z.txt");

//Model files
$modelsFileName =  Array("Models_a_to_c.txt",
                         "Models_d_to_f.txt",
                         "Models_g.txt",
                         "Models_h_to_k.txt",
                         "Models_l_to_m.txt",
                         "Models_n_to_o.txt",
                         "Models_p.txt",
                         "Models_q_to_s.txt",
                         "Models_t_to_z.txt");

$t5FileName =      Array("T5_a_to_c.txt",
                         "T5_d_to_f.txt",
                         "T5_g.txt",
                         "T5_h_to_k.txt",
                         "T5_l_to_m.txt",
                         "T5_n_to_o.txt",
                         "T5_p.txt",
                         "T5_q_to_s.txt",
                         "T5_t_to_z.txt");

//List of files to be archived
$files_to_zip =    Array(
	       $targetFolder."Manu_list.txt",
	       $targetFolder."manufacturers.txt",
           $targetFolder."Codes_a_to_c.txt",
           $targetFolder."Codes_d_to_f.txt",
           $targetFolder."Codes_g.txt",
           $targetFolder."Codes_h_to_k.txt",
           $targetFolder."Codes_l_to_m.txt",
           $targetFolder."Codes_n_to_o.txt",
           $targetFolder."Codes_p.txt",
           $targetFolder."Codes_q_to_s.txt",
           $targetFolder."Codes_t_to_z.txt",
           $targetFolder."Models_a_to_c.txt",
           $targetFolder."Models_d_to_f.txt",
           $targetFolder."Models_g.txt",
           $targetFolder."Models_h_to_k.txt",
           $targetFolder."Models_l_to_m.txt",
           $targetFolder."Models_n_to_o.txt",
           $targetFolder."Models_p.txt",
           $targetFolder."Models_q_to_s.txt",
           $targetFolder."Models_t_to_z.txt");


$row = 0;
$manuRow = 0;
$splitIndexPos = 0;

if (($handle = fopen("remotecodes/codemaster.csv", "r")) !== FALSE) {

    //initialise manufacturer index
    $manu_index = array("0","d","g","h","l","n","p","q","t");


    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

        if ($num == 3) {

            //add to the manufacturers list
            if ($row > 0) {

                if ($manu_list[$manuRow-1] !== $data[0]) {
                    $manu_list[$manuRow] = $data[0];

                    //Index asterix point
                    $split_index[$splitIndexPos] = $row;

                    //echo "split_index[$splitIndexPos]: ".$split_index[$splitIndexPos]."<br>\n";
                    $splitIndexPos++;

                    $manuRow++;
                }

            } else {

                $manu_list[$manuRow] = $data[0];
                //echo "Row ".$manuRow.": ".$manu_list[$manuRow]."<br>\n";
                $manuRow++;

            }


            //deal with the manufacturers index

            $a_z_splitIndex[0] = 0;

            if ((strtoupper(substr($data[0],0,1)) > "C" ) && ($manu_index[1]=="d")) {
                $manu_index[1] = ($manuRow-1);
                $a_z_splitIndex[1] = ($row);
            }

            if ((strtoupper(substr($data[0],0,1)) == "G" ) && ($manu_index[2]=="g")) {
                $manu_index[2] = ($manuRow-1);
                $a_z_splitIndex[2] = ($row);
            }

            if ((strtoupper(substr($data[0],0,1)) > "G" ) && ($manu_index[3]=="h")) {
                $manu_index[3] = ($manuRow-1);
                $a_z_splitIndex[3] = ($row);

            }

            if ((strtoupper(substr($data[0],0,1)) > "K" ) && ($manu_index[4]=="l")) {
                $manu_index[4] = ($manuRow-1);
                $a_z_splitIndex[4] = ($row);
            }

            if ((strtoupper(substr($data[0],0,1)) > "M" ) && ($manu_index[5]=="n")) {
                $manu_index[5] = ($manuRow-1);
                $a_z_splitIndex[5] = ($row);
            }

            if ((strtoupper(substr($data[0],0,1)) == "P" ) && ($manu_index[6]=="p")) {
                $manu_index[6] = ($manuRow-1);
                $a_z_splitIndex[6] = ($row);
            }

            if ((strtoupper(substr($data[0],0,1)) > "P" ) && ($manu_index[7]=="q")) {
                $manu_index[7] = ($manuRow-1);
                $a_z_splitIndex[7] = ($row);
            }

            if ((strtoupper(substr($data[0],0,1)) > "S" ) && ($manu_index[8]=="t")) {
                $manu_index[8] = ($manuRow-1);
                $a_z_splitIndex[8] = ($row);
            }

            $models[$row] = $data[1];
            $codes_list[$row] = $data[2];

            //echo $codes_list[$row]."\n";

            $row++;

        } else {

            $correctFormat = 0;
        }

    }


    fclose($handle);

    if ($correctFormat == 1){

    $a_z_splitIndex[9] = $row;

    //Write Manufacturer list file
    $manFileName = $targetFolder."Manu_list.txt";
	$manFile = fopen($manFileName, 'w') or die("can't open file");
	$stringData = "!POPULATE\n";
	fwrite($manFile, $stringData);
	$stringData = "*\n";
	fwrite($manFile, $stringData);

    for ($c=0;$c < count($manu_list);$c++){
        $stringData = $manu_list[$c]."\n";
        fwrite($manFile, $stringData);
    }
    fclose($manFile);

    //Write Manufacturer Index file
    $indexFileName = $targetFolder."manufacturers.txt";
    $indexFile = fopen($indexFileName, 'w') or die("can't open file");
    $stringData = "a=".$manu_index[0]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "d=".$manu_index[1]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "g=".$manu_index[2]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "h=".$manu_index[3]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "l=".$manu_index[4]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "n=".$manu_index[5]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "p=".$manu_index[6]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "q=".$manu_index[7]."\n";
    fwrite ($indexFile, $stringData);
    $stringData = "t=".$manu_index[8]."\n";
    fwrite ($indexFile, $stringData);
    fclose($indexFile);

    echo $row." rows of data processed.<br><br>";

    echo "<table>\n";
    echo "<tr>\n";
    echo "<td class='noBorder'><u>Filename</u></td><td class='noBorder'><u>Size</u></td><td class='noBorder'></td><td class='noBorder'></td>";
    echo "</tr>";

    echo "<tr><td class='noBorder' width='200px'>Manu_list.txt ($manuRow)</td><td class='noBorder' width='100px'>".(round(filesize($manFileName)/1024,2))." Kb</td><td class='noBorder' width='75px'><a href='$manFileName' target='_blank'>View</a></td><td class='noBorder'><a href='download.php?fn=".$manFileName."'>Download</a></td></tr>\n";
    echo "<tr><td class='noBorder' width='200px'>manufacturers.txt</td><td class='noBorder' width='100px'>".(round(filesize($indexFileName),2))." bytes</td><td class='noBorder' width='75px'><a href='$indexFileName' target='_blank'>View</a></td><td class='noBorder'><a href='download.php?fn=".$indexFileName."'>Download</a></td></tr>\n";

    //echo "<a href='".$targetFolder."Manu_list.txt' target='_blank'>Manu_list.txt</a> file written - ".(round(filesize($manFileName)/1024,2))." Kb<br>\n";
    //echo "<a href='".$targetFolder."manufacturers.txt' target='_blank'>manufacturers.txt</a> file written - ".(round(filesize($indexFileName),2))." bytes<br><br>\n";


    $splitIndexPos = 0;

    $azIndexPointerStart = 0;
    $azIndexPointerEnd = 1;
    $firstTimeIn = True;

    //Write model and code files


    //for each file group
    for ($index=0; $index<9; $index++){

        $azCodeFileName = $targetFolder.$codeFileName[$index];
        $azCodeFile = fopen($azCodeFileName, 'w') or die("can't open $codeFileName file");
        $azModelsFileName = $targetFolder.$modelsFileName[$index];
        $azModelFile = fopen($azModelsFileName, 'w') or die("can't open $modelsFileName file");
//***   $azT5FileName = $targetFolder.$t5FileName[$index];
//***   $azT5File = fopen($azT5FileName, 'w') or die ("can't open $t5FileName file");

        $stringData = "!POPULATE\n";
        fwrite ($azCodeFile, $stringData);
        fwrite ($azModelFile, $stringData);
//***   fwrite ($azT5File, $stringData);


        if ($firstTimeIn) {
            $stringData = "*\n";
            fwrite ($azCodeFile, $stringData);
            fwrite ($azModelFile, $stringData);
//***       fwrite ($azT5File, $stringData);
            $firstTimeIn = false;
        }

        for ($c=$a_z_splitIndex[$azIndexPointerStart];$c<$a_z_splitIndex[$azIndexPointerEnd];$c++) {

            if ($c == $split_index[$splitIndexPos]) {

                $stringData = "*\n";
                fwrite ($azCodeFile, $stringData);
                fwrite ($azModelFile, $stringData);
                $splitIndexPos++;
                $stringData = str_replace('T','',$codes_list[$c])."\n";
                fwrite ($azCodeFile, $stringData);
                $models[$c] = str_replace('"',' ', $models[$c]);
                $stringData = $models[$c]."\n";
                fwrite ($azModelFile, $stringData);

            } else {

                $stringData = str_replace('T','',$codes_list[$c])."\n";
                fwrite ($azCodeFile, $stringData);
                $models[$c] = str_replace('"',' ', $models[$c]);
                $stringData = $models[$c]."\n";
                fwrite ($azModelFile, $stringData);

            }

        } //end a-z loop

        $azIndexPointerStart++;
        $azIndexPointerEnd++;

        fclose($azCodeFile);
        fclose($azModelFile);

        echo "<tr><td class='noBorder' width='200px'>".$codeFileName[$index]."</td><td class='noBorder' width='100px'>".(round(filesize($azCodeFileName)/1024,2))."Kb</td><td class='noBorder' width='75px'><a href='$azCodeFileName' target='_blank'>View</a></td><td class='noBorder'><a href='download.php?fn=".$azCodeFileName."'>Download</a></td></tr>\n";
        echo "<tr><td class='noBorder' width='200px'>".$modelsFileName[$index]."</td><td class='noBorder' width='100px'>".(round(filesize($azModelsFileName)/1024,2))."Kb</td><td class='noBorder' width='75px'> <a href='$azModelsFileName' target='_blank'>View</a></td><td class='noBorder'><a href='download.php?fn=".$azModelsFileName."'>Download</a></td></tr>\n";
    }
    echo "</table>\n";

	//if true, good; if false, zip creation failed
    $result = create_zip($files_to_zip,$targetFolder.'remotecodes.zip');
    echo "<br>Download ALL files (.Zip File): <a href='".$targetFolder."remotecodes.zip'>remotecodes.zip</a><br><br>";

    } else {
       echo "The .CSV file is not in the correct format.<br><br>The correct format is:<br><br>MANUFACTURER,MODEL,CODE,<br><br>";

    }

?>

            <form action="index.php" method="get">
                <button type="submit">Back</button>
            </form>


<?php
}

/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

		//close the zip -- done!
		$zip->close();

		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}

?>
                </div>
           </div>
           <div id="footer">Neil Cooper BSKYB 2011</div>
       </div>
	</body>
</html>