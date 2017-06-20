<?php
	include("FusionCharts/FusionCharts.php");
	include"FusionCharts/FusionCharts_Gen.php";
	//include"database.php";
		
	mysql_connect("localhost", "root", "adminhris") ;
        mysql_select_db("db_hris_tmw_full");

	date_default_timezone_set('Asia/Jakarta');
	$cari=$_POST['cari'];
	if($_POST[Submit]=="Submit")
	{
		$_SESSION["cari"] = $cari; 
	}
	$bulan=$_POST['bulan'];
	if($_POST[Submit]=="Submit")
	{
		$_SESSION["bulan"] = $bulan; 
	}
	
 
	$cari=$_SESSION['cari'];
	$cari=$_POST['cari'];
	$bulan=$_SESSION['bulan'];
	$bulan=$_POST['bulan'];

	if ($cari =='' and $bulan=='')
	{
		$cari=date('Y');
		$bulan=date('m');
	} else 
	{
		$cari=$_POST['cari'];
		$bulan=$_POST['bulan'];
	}
	// $sql_="SELECT COUNT(*) as jml FROM tbl_hibah_status_program  WHERE tahun='$cari'";
	// $sql_ =mysql_query($sql_);
	// while ($rs = mysql_fetch_array($sql_)){
	// $jml = $rs['jml'];
	// }
	$jml = 2;
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
	<h2><a href="#"  onclick="goDet('1','<?=$cari;?>')"  ><?=$judul?>   <?=$nama_bulan?> <?=$cari?></a></h2>
	<center>
<form method="post" action="kpi.php"  >
	<table  cellpadding="2" cellspacing="8"   border="0">
		<TR>
			<TD><center><div class="judul_tahun"> </div></center></TD>
			<TD>

			<select name="bulan" onChange="this.form.submit()">
				<?php
					if ($lang=="in"){ //indonesia
						$namabulan=array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
					} ELSE IF ($lang=="en"){ //english
						$namabulan=array("","JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER");
					}
					for ($i=1;$i<=12;$i++) 
					{
						if($bulan== $i ) 
						{ 
				?>
                <option value="<?=$i?>" selected> <?=$namabulan[$i]?> </option>
				<?  } else {?>
                <option value="<?=$i?>" > <?=$namabulan[$i]?> </option>
              <?  } }   ?>
            </select> 


			<select name="cari" onChange="this.form.submit()">
				<option value="">[Pilih Tahun]</option>
					<? 	for ($i=2011; $i<=2014; $i++)
						{
							if ($i==$cari) 
							{
					?>
				<option value="<?=$i?>" selected > <?=$i?> </option>
					<? } else { ?>
				<option value="<?=$i?>"   > <?=$i?> </option>
					<?}	} ?>
			</select>
			
			</td>
		</tr>
<!-- 
	   <TR>
	  <TD   align="right"> Status : </TD>
	  </TR>   -->
	  </table>

	  <input type="hidden" name="lang" value="<?php echo $lang;?>">
</form>
</center>
<center>
 <table width="100%">  
 <TR><TD align="right">Status : <?php IF ($jml >0) { ?> <?=$nama_bulan?> <?=$cari?> <?php } ?></TD></TR>
 </TABLE></center>
<?php
	include"FusionCharts/FC_Colors.php";
	//include"FusionCharts/FusionCharts_Gen.php";

	  if($_POST['mutasi'])
{ $mutasi = $_POST['mutasi'];
}else{ $mutasi = $_GET['mutasi'];}

if ($_GET['date1']) $date1 = $_GET['date1'];
else if ($_POST['date1']) $date1 = $_POST['date1'];
else $date1="";

if ($_GET['date2']) $date2= $_GET['date2'];
else if ($_POST['date2']) $date2 = $_POST['date2'];
else $date2="";
	
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
        WHERE date(r_kpi__tgl) BETWEEN '$date1' AND '$date2' AND r_pnpt__no_mutasi = '$mutasi' order by r_kpi__id ASC  "; 
                
       
	$qr=mysql_query($sql); 
	var_dump($sql)or die();
	while($Data=mysql_fetch_array($qr))
	{
		$arrData[0][1]="$Data[r_kpi__bulan]"; 
		

		//program yAxisName
		$arrData[0][2]="$Data[r_kpi__nilai]";  // rencana
		// $arrData[0][3]="$Data[r_kpi__bulan]"; // total
		// $arrData[0][4]="$Data[r_kpi__tahun]"; // total
		// $arrData[0][5]="$Data[r_kpi__nilai]"; // total
		// $arrData[0][6]="$Data[r_kpi__keterangan]"; // total

		$kdprog=$Data['r_kpi__bulan'];  //xAxisName
		// $var1="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=1&lang=$lang";
		// $var2="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=2&lang=$lang";
		// $var3="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=3&lang=$lang";
		// $var4="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=4&lang=$lang";

		foreach ($arrData as $arSubData) 
		{
			$kategori .= "<category name='".$arSubData[1]."' />";
			 $data .= "<set value='".$arSubData[2] ."'  />";
			// $data1 .= "<set value='".$arSubData[3] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/baseline.php?$var1'/>";
			// $data2 .= "<set value='".$arSubData[4] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/pasang.php?$var1' />";
			// $data3 .= "<set value='".$arSubData[5] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/verifikasi.php?$var1'  />";
			// $data4 .= "<set value='".$arSubData[6] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/pencairan.php?$var1' />";
		}

	}
	$kategori .= "</categories>";
	$data .= "</dataset>";
	$data1 .= "</dataset>";
	// $data2 .= "</dataset>";
	// $data3 .= "</dataset>";
	// $data4 .= "</dataset>";
	 
	$strXML .= $kategori . $data . $data1. $data2 . $data3 . $data4    ;
	$strXML .= "</graph>";
	FC_SetRenderer('javascript');
	//echo renderChart("FusionCharts/Line.swf", "", $strXML, "myChart", 900, 350, false, true);
	//echo renderChart("FusionCharts/MSColumn3DLineDY.swf", "", $strXML, "myChart", 900, 350, false, true);MSLine.swf
	echo renderChart("FusionCharts/MSLine.swf", "", $strXML, "myChart", 500, 350, false, true);

?>
			 
   </body>
</html>

 
