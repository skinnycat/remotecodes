<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
Written by Neil Cooper
Interactive Development and Support
BSKYB

Date: 17-06-2011

-->

<head>
    <title></title>
	<link rel="stylesheet" href="styles/style.css"/>
</head>



<body>

    <div id="container">
        <div id="containerMain">
            <div id="mainTitle">Remote Control Top 5 Code File Processor</div>
            <div id="subTitle"><a href="help.php">Help</a></div>
            <div id="formArea">
                <form enctype="multipart/form-data" action="fileUploader.php" method="POST">
			        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
			        Select .csv file to upload:&nbsp;&nbsp;<input name="uploadedfile" type="file" /> <input type="submit" value="Upload File" />
			        Select manufacturers list .csv file to upload:&nbsp;&nbsp;<input name="manufile" type="file" /> <input type="submit" value="Upload File" />
                </form>
            </div>
       </div>
       <div id="footer">Neil Cooper BSKYB 2011</div>
   </div>
</body>
</html>
