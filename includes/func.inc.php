<?php

function GetNameMonth($sDate) {
	
	if(!empty($sDate)) {
		$s = explode("-",$sDate);
		switch(intval($s[1])) {
			case 1: $monthName="Januari"; break;
			case 2: $monthName="Febuari"; break;
			case 3: $monthName="Maret"; break;
			case 4: $monthName="April"; break;
			case 5: $monthName="Mei"; break;
			case 6: $monthName="Juni"; break;
			case 7: $monthName="Juli"; break;
			case 8: $monthName="Agustus"; break;
			case 9: $monthName="September"; break;
			case 10: $monthName="Oktober"; break;
			case 11: $monthName="Nopember"; break;
			case 12: $monthName="Desember"; break;
		}
		return $monthName;
	} else {
		return false;	
	}

}


function ConvertDate($sDate){
	
	if(!empty($sDate)) {
		$s = explode("-",$sDate);
		return $s[2]."-".$s[1]."-".$s[0];
	}
	
}

function size_hum_read($size){
$i=0;
$iec = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");
while (($size/1024)>1) {
$size=$size/1024;
$i++;
}
return substr($size,0,strpos($size,',')+4)." ".$iec[$i];
}

function clsWriteFile($fdata,$contentData) {
	
	$fp=fopen($fdata,"w");
	if(!is_resource($fp))
	return false;
	
	stream_set_write_buffer($fp, 0);
	
	fwrite($fp,$contentData);
	fclose($fp);

}
	
?>