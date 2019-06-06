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
    <div id="wrap">
        <div id="containerMainHelp">

            <div id="mainTitle">Remote Control Code File Processor</div>
            <div id="mainArea">
                <p>This application processes the remote control code information file provided to BSkyB by UEBV or UEI and produces the files required by the remote control interactive application.</p>
                <p><br>The input file must be a comma delimited value file with a .CSV extension in the following format:</p>
                <p><br><span class="italics eightpoint">&lt;Manufacturer&gt;,&lt;TV Model&gt;,&lt;Remote Code&gt;,<br>&lt;Manufacturer&gt;,&lt;TV Model&gt;,&lt;Remote Code&gt;,<br>...</span></p>
                <p><br>The resulting files are the following:<br><br>
                   <table class="borderOnePx">
                       <tr><td width="200px" class="padFivePx">Manu_list.txt</td><td class="padFivePx">Alphabetical list of manufacturers</td></tr>
                       <tr><td class="padFivePx">manufacturers.txt</td><td class="padFivePx">Index file. Pointer positions for interactive app.</td></tr>
                       <tr><td class="padFivePx">Codes_a_to_c.txt</td><td class="padFivePx">Codes for models made by manufacturers names A through to C</td></tr>
                       <tr><td class="padFivePx">Codes_d_to_f.txt</td><td class="padFivePx">Codes for models made by manufacturers names D through to F</td></tr>
                       <tr><td class="padFivePx">Codes_g.txt</td><td class="padFivePx">Codes for models made by manufacturers names starting with G</td></tr>
                       <tr><td class="padFivePx">Codes_h_to_k.txt</td><td class="padFivePx">Codes for models made by manufacturers names H through to K</td></tr>
                       <tr><td class="padFivePx">Codes_l_to_m.txt</td><td class="padFivePx">Codes for models made by manufacturers names L through to M</td></tr>
                       <tr><td class="padFivePx">Codes_n_to_o.txt</td><td class="padFivePx">Codes for models made by manufacturers names N through to O</td></tr>
                       <tr><td class="padFivePx">Codes_p.txt</td><td class="padFivePx">Codes for models made by manufacturers names starting with P</td></tr>
                       <tr><td class="padFivePx">Codes_q_to_s.txt</td><td class="padFivePx">Codes for models made by manufacturers names Q through to S</td></tr>
                       <tr><td class="padFivePx">Codes_t_to_z.txt</td><td class="padFivePx">Codes for models made by manufacturers names T through to Z</td></tr>
                       <tr><td class="padFivePx">Models_a_to_c.txt</td><td class="padFivePx">Models made by manufacturers names A through to C</td></tr>
                       <tr><td class="padFivePx">Models_d_to_f.txt</td><td class="padFivePx">Models made by manufacturers names D through to F</td></tr>
                       <tr><td class="padFivePx">Models_g.txt</td><td class="padFivePx">Models made by manufacturers names starting with G</td></tr>
                       <tr><td class="padFivePx">Models_h_to_k.txt</td><td class="padFivePx">Models made by manufacturers names H through to K</td></tr>
                       <tr><td class="padFivePx">Models_l_to_m.txt</td><td class="padFivePx">Models made by manufacturers names L through to M</td></tr>
                       <tr><td class="padFivePx" class="padFivePx">Models_n_to_o.txt</td><td class="padFivePx">Models made by manufacturers names N through to O</td></tr>
                       <tr><td class="padFivePx">Models_p.txt</td><td class="padFivePx">Models made by manufacturers names starting with P</td></tr>
                       <tr><td class="padFivePx">Models_q_to_s.txt</td><td class="padFivePx">Models made by manufacturers names Q through to S</td></tr>
                       <tr><td class="padFivePx">Models_t_to_z.txt</td><td class="padFivePx">Models made by manufacturers names T through to Z</td></tr>
                   </table>
                   <tr>
                </p>
            </div>

       </div>
       </div>
       <div id="footer">Neil Cooper BSKYB 2011</div>
   </div>
</body>
</html>
