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
	
function diffTime($time1, $time2) {
	list($h,$m,$s) = explode(":",$time1);
	$dtAwal = mktime($h,$m,$s,"1","1","1");
	list($h,$m,$s) = explode(":",$time2);
	$dtAkhir = mktime($h,$m,$s,"1","1","1");
	$dtSelisih = ($dtAkhir-$dtAwal);
	return $dtSelisih;
}

function detik2jam($seconds)
{
    /*** return value ***/
    $ret = "";
    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0)
    {
        $ret .= "$hours";
    }
    /*** get the minutes ***/
    $minutes = bcmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0)
    {
        $ret .= "$minutes";
    }
  
    /*** get the seconds ***/
//    $seconds = bcmod(intval($seconds),60);
  //  $ret .= "$seconds detik";

    return $ret;
}	


function update_time($time){
    $ap = $time[5].$time[6];
    $ttt = explode(":", $time);
    $th = $ttt['0'];
    $tm = $ttt['1'];
    if($ap=='pm' || $ap=='PM'){
        $th+=12;
        if($th==24){
            $th = 12;
        }
    }
    if($ap=='am' || $ap=='AM'){
        if($th==12){
            $th = '00';
        }
    }
    $newtime = $th.":".$tm[0].$tm[1];
    return $newtime;
}


function rubah_tanggal($tgl)
 {
 $exp = explode('-',$tgl);
 if(count($exp) == 3)
 {
 $tgl = $exp[2].'-'.$exp[1].'-'.$exp[0];
 }
 return $tgl;
 }

 
 
 
 function rupiah2($harga)
{
	$a=(string)$harga; //membuat $harga menjadi string
	$len=strlen($a); //menghitung panjang string $a
	
	if ( $len <=18 )
	{
		$ratril=$len-3-1;
		$ramil=$len-6-1;
		$rajut=$len-9-1; //untuk mengecek apakah ada nilai ratusan juta (9angka dari belakang)
		$juta=$len-12-1; //untuk mengecek apakah ada nilai jutaan (6angka belakang)
		$ribu=$len-15-1; //untuk mengecek apakah ada nilai ribuan (3angka belakang)
		
		$angka='';
		for ($i=0;$i<$len;$i++)
		{
			if ( $i == $ratril )
			{
				$angka=$angka.$a[$i].".";
			}
			else if ($i == $ramil )
			{
				$angka=$angka.$a[$i].".";
			}
			else if ( $i == $rajut )
			{
				$angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 3angka dari depan
			}
			else if ( $i == $juta )
			{
				$angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 6angka dari depan
			}
			else if ( $i == $ribu )
			{
				$angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 9angka dari depan
			}
			else
			{
				$angka=$angka.$a[$i];
			}
		}
	}

	echo "Rp. ". $angka.",-";
}



function remove_non_numerics($str)
{ 
    $temp       = trim($str);
    $result  = "";
    $pattern    = '/[^0-9]*/';
    $result     = preg_replace($pattern, '', $temp);

    return $result;
}
?>