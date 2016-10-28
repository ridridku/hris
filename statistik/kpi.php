<?php
include("FusionCharts/FusionCharts.php");
include"FusionCharts/FusionCharts_Gen.php";
require_once('../includes/db.conf.php');
require_once('../includes/config.conf.php');
require_once('../adodb/adodb.inc.php');
if($_POST['mutasi'])
{ $mutasi = $_POST['mutasi'];
}else{ $mutasi = $_GET['mutasi'];}

if($_POST['date1'])
{ $date1 = $_POST['date1'];
}else{ $date1 = $_GET['date1'];}


if($_POST['date2'])
{ $date2 = $_POST['date2'];
}else{ $date2 = $_GET['date2'];}



 //$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//    mysql_connect("localhost", "root", "adminhris") ;
//    mysql_select_db("db_hris_tmw_full");

	date_default_timezone_set('Asia/Jakarta');
	
        if($_POST['mutasi'])
{ $mutasi = $_POST['mutasi'];
}else{ $mutasi = $_GET['mutasi'];}

 
 $sql_pw="SELECT 	
r_pegawai.r_pegawai__id AS r_pegawai__id,
r_pegawai.r_pegawai__nama AS r_pegawai__nama,
r_penempatan.r_pnpt__nip AS r_pnpt__nip,
r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
r_cabang.r_cabang__nama AS r_cabang__nama,
r_cabang.r_cabang__id AS r_cabang__id,
r_departement.r_dept__ket AS r_dept__ket
FROM
r_kpi
INNER JOIN r_penempatan ON r_penempatan.r_pnpt__finger_print = r_kpi.r_kpi__finger
INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
INNER JOIN r_subcabang ON r_subcabang.r_subcab__id = r_penempatan.r_pnpt__subcab
INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
INNER JOIN r_subdepartement ON r_subdepartement.r_subdept__id = r_pnpt__subdept
INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
  WHERE r_pnpt__no_mutasi='$mutasi'";
         

         $rs_pw	= $db->execute($sql_pw);
$nama_pegawai=$rs_pw->fields['r_pegawai__nama'];
$cabang=$rs_pw->fields['r_cabang__nama'];
$departemen=$rs_pw->fields['r_dept__ket'];

	// var_dump($nm_cabang) or die();
       
?>

    
<html>
	<head>
		<script language='javascript' src="FusionCharts/FusionCharts.js"></script>
		<script type="text/javascript" LANGUAGE="Javascript" SRC="FusionCharts/jquery.min.js"></script>
		<script type="text/javascript" LANGUAGE="Javascript" SRC="FusionCharts/lib.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="../asset/css/style_.css" rel="stylesheet" media="screen">
			
<script type="text/javascript">
    function ExportMyChart(format) {
         var chartObject = FusionCharts('myChart');
         //if( chartObject.hasRendered() ) chartObject.exportChart({exportAtClient:'1',exportFormat:format}); 
		//alert(format);
   }
</script> 
    <style type="text/css">
	
	input, textarea, select{
	background-color: #FFFFFF;
    border: 1px solid #85AB4A;
    color: #999;
    font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif;
    font-size: 8pt;
    padding: 1px 3px;
	}
	
	.judul_tahun { color: #333333;
    font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif;
    font-size: 9pt;}
	
    </style>
	</HEAD>
	<body>
	<?
	//ECHO "LANG = ".$_GET['lang'];
  
	if ($_GET['lang']) $lang = $_GET['lang'];
	else if ($_POST['lang']) $lang = $_POST['lang'];
	else $lang="in";

 
	if ($lang=="in"){
				 include "in.php";
	} else {
				include "en.php";
	}

 ?>
 
	<center>
            
<form method="post" action="kpi.php"  >
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<table >
    <TR><td colspan="3"><font size="3"><?=$judul?>   </font></td></tr>
    <TR><td>Nama Karyawan</td><td>:</td><td><?=$nama_pegawai?></td></tr>
     <TR><td>Cabang</td><td>:</td><td><?=$cabang?></td></TR>
      <TR><td>Departemen</td><td>:</td><td><?=$departemen?></td></TR>
      <TR><td>Periode</td><td>:</td><td><?=$date1?> S/D  <?=$date2?> </td></TR>
</table>
</form>
        </center>
<center>

<?php
	include"FusionCharts/FC_Colors.php";
	//include"FusionCharts/FusionCharts_Gen.php";


	
	//labelDisplay='ROTATE' 
	echo"<SCRIPT LANGUAGE='Javascript' SRC='FusionCharts/FusionCharts.js'></SCRIPT>";

	 $strXML="<graph exportEnabled='1'    exportAction='download'  exportShowMenuItem='1'  xAxisName='$program' yAxisName='$jumlah ' 
 decimalPrecision='0' formatNumberScale='0'   palette='2' animation='1' showvalues='1' formatnumberscale='1' rotateNames='0' outCnvBaseFontSize='10' 
slantLabels='1' numDivLines='5'  exportAtClient='1' exportHandler='fcExporter1' html5ExportHandler='http://export.api3.fusioncharts.com'   >";

	$kategori="<categories>";
	$data = "<dataset seriesName='$judul1'  color='".getFCColor()."' >";
	$data1 = "<dataset seriesName='$judul2' color='".getFCColor()."' >";
	$data2 = "<dataset seriesName='$judul3' color='".getFCColor()."' >";
	$data3 = "<dataset seriesName='$judul4' color='".getFCColor()."' >";
	$data4 = "<dataset seriesName='$judul5' color='".getFCColor()."' >";
	 

	$sql="SELECT
	r_kpi.r_kpi__id AS r_kpi__id,
	r_kpi.r_kpi__finger AS r_kpi__finger,
	r_kpi.r_kpi__bulan AS r_kpi__bulan,
	r_kpi.r_kpi__tahun AS r_kpi__tahun,
	r_kpi.r_kpi__nilai AS r_kpi__nilai,
	r_kpi.r_kpi__keterangan AS r_kpi__keterangan,
	r_kpi.r_kpi__approval AS r_kpi__approval,
	r_kpi.r_kpi__date_created AS r_kpi__date_created,
	r_kpi.r_kpi__date_updated AS r_kpi__date_updated,
	r_departement.r_dept__akronim AS r_dept__akronim,
	r_departement.r_dept__id AS r_dept__id,
	r_departement.r_dept__ket AS r_dept__ket,
	r_subcabang.r_subcab__nama AS r_subcab__nama,
	r_cabang.r_cabang__nama AS r_cabang__nama,
	r_cabang.r_cabang__id AS r_cabang__id,
	r_pegawai.r_pegawai__id AS r_pegawai__id,
	r_pegawai.r_pegawai__nama AS r_pegawai__nama,
	r_penempatan.r_pnpt__nip AS r_pnpt__nip,
	r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
	r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print
FROM
	r_kpi
INNER JOIN r_penempatan ON r_penempatan.r_pnpt__finger_print = r_kpi.r_kpi__finger
INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
INNER JOIN r_subcabang ON r_subcabang.r_subcab__id = r_penempatan.r_pnpt__subcab
INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
INNER JOIN r_subdepartement ON r_subdepartement.r_subdept__id = r_pnpt__subdept
INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
WHERE date(r_kpi__date_updated) BETWEEN '$date1' AND '$date2' AND r_pnpt__no_mutasi = '$mutasi'
order by r_kpi__id ASC  "; 
$qr=mysql_query($sql); 
	$i=1;
	while($Data=mysql_fetch_array($qr))
	{
		$arrData[0][1]=$Data[r_kpi__bulan]; //x_axis
                $nama_bulan=  tampil_bulan($arrData[0][1]);
		//program yAxisName
		$arrData[0][2]=$Data[r_kpi__nilai];  // rencana
                $arrData[0][3]=$Data[r_kpi__id]; //x_axis
                foreach ($arrData as $arSubData) 
		{
			$kategori .= "<category name='".$nama_bulan."' />";
			$data .= "<set value='".$arSubData[2] ."'  />";
                        $data1 .= "<set value='".$arSubData[3] ."'  />";
			
		}
$i++;
	}
	$kategori .= "</categories>";
	$data .= "</dataset>";
        $data1 .= "</dataset>";
	
	$strXML .= $kategori.$data  ;
	$strXML .= "</graph>";
	FC_SetRenderer('javascript');
	//echo renderChart("FusionCharts/Line.swf", "", $strXML, "myChart", 900, 350, false, true);
	//echo renderChart("FusionCharts/MSColumn3DLineDY.swf", "", $strXML, "myChart", 900, 350, false, true);MSLine.swf
	echo renderChart("FusionCharts/MSLine.swf", "", $strXML, "myChart", 600, 450, false, true);

?>
			 
   </body>
</html>

 
