<?php

function parseToXML($htmlStr)
{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}



header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';


$file = fopen("../dataAccess/eventos.txt", "r");
// Iterate through the rows, printing XML nodes for each
while (!feof($file)){
	$linea = fgets($file);
	$row =  explode(';',$linea);
	if(sizeof($row)>1){
		echo '<marker ';
		echo 'name="' . parseToXML($row[0]) . '" ';
		echo 'address="' . parseToXML($row[1]) . '" ';
		echo 'lat="' . $row[2] . '" ';
		echo 'lng="' . $row[3] . '" ';
		echo '/>';
	}
}
fclose($file);
  // Add to XML document node
  

// End XML file
echo '</markers>';

/*header('Location: eventos.php');*/
?>