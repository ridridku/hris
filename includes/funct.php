<?php

function sqlvalue($val, $quote)
{
  if ($quote) //true == num
    $tmp = sqlstr($val);
  else
    $tmp = $val;
  if ($tmp == "")
    $tmp = "NULL";
  elseif ($quote)
    $tmp = "'".$tmp."'";
  return $tmp;
}

function sqlstr($val)
{
  return str_replace("'", "''", $val);
}

function get_data_kecamatan($jml) {
	$data="";
	for($i=0;$i<$jml;$i++) {
		if ($_POST["kecamatan".$i]!='') {
		$data.=$_POST["kecamatan".$i].";";
		}
	}
	return substr($data,0,-1);
}

function get_data_kecamatan2($jml) {
	$data="";
	for($i=0;$i<$jml;$i++) {
		if ($_POST["kecamatan_".$i]!='') {
		$data.=$_POST["kecamatan_".$i].";";
		}
	}
	return substr($data,0,-1);
}


function get_data_kabupaten($jml) {
	$data="";
	for($i=0;$i<$jml;$i++) {
		if ($_POST["kabupaten".$i]!='') {
		$data.=$_POST["kabupaten".$i].";";
		}
	}
	return substr($data,0,-1);
}

function covt($kd) {
	$arrays = array(
			"B"=>"BAIK",
			"S"=>"SEDANG",
			"RR"=>"RUSAK RINGAN",
			"RB"=>"RUSAK BERAT"
			);
	while (list($key, $val) = each($arrays)) {
		if($kd==$key){
			$value=$val;
			break;	
		}
	}	
	$value = "'".$value."'";
	return $value;
}

/******
function covt_bln_thn($v,$arr){

	$tgl = explode("-", $v, strlen($v));
	$bln = $tgl[1];
	$thn = $tgl[0];
	$format_bln = $arr[$bln]; 
	$bln_thn	= $format_bln." ".$thn;
	return $bln_thn;
}*****/
?>