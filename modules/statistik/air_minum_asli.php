<?php
	include("FusionCharts/FusionCharts.php");
	include"FusionCharts/FusionCharts_Gen.php";
	//include"database.php";
		
	mysql_connect("localhost", "root", "adminhris") ;
    mysql_select_db("db_hibah");

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
	$sql_="SELECT COUNT(*) as jml FROM tbl_hibah_status_program  WHERE tahun='$cari'";
	$sql_ =mysql_query($sql_);
	while ($rs = mysql_fetch_array($sql_)){
	$jml = $rs['jml'];
	}
?>

    
<html>
	<head>
		<script language='javascript' src="FusionCharts/FusionCharts.js"></script>
		<script type="text/javascript" LANGUAGE="Javascript" SRC="FusionCharts/jquery.min.js"></script>
		<script type="text/javascript" LANGUAGE="Javascript" SRC="FusionCharts/lib.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="../asset/css/style_.css" rel="stylesheet" media="screen">
				 <script language="JavaScript">
				 function goDet(NIP,tahun) {
				  
							window.open('airminum?tahun='+tahun+'',null,'height=300,width=800,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0') 
							
				 }


</script>
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
<form method="post" action="air_minum_asli.php"  >
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
 <table width="93%"> 
 <TR><TD align="right">Status : <?php IF ($jml >0) { ?> <?=$nama_bulan?> <?=$cari?> <?php } ?></TD></TR>
 </TABLE>
<?php
	include"FusionCharts/FC_Colors.php";
	//include"FusionCharts/FusionCharts_Gen.php";

	 
	
	//labelDisplay='ROTATE' 
	echo"<SCRIPT LANGUAGE='Javascript' SRC='FusionCharts/FusionCharts.js'></SCRIPT>";

	 $strXML="<graph exportEnabled='1'    exportAction='download'  exportShowMenuItem='1'  xAxisName='$program' yAxisName='$jumlah (SR)' 
 decimalPrecision='0' formatNumberScale='0'   palette='2' animation='1' showvalues='1' formatnumberscale='1' rotateNames='0' outCnvBaseFontSize='10' 
slantLabels='1' numDivLines='5'  exportAtClient='1' exportHandler='fcExporter1' html5ExportHandler='http://export.api3.fusioncharts.com'   >";

	$kategori="<categories>";
	$data = "<dataset seriesName='$judul1'  color='".getFCColor()."' >";
	$data1 = "<dataset seriesName='$judul2' color='".getFCColor()."' >";
	$data2 = "<dataset seriesName='$judul3' color='".getFCColor()."' >";
	$data3 = "<dataset seriesName='$judul4' color='".getFCColor()."' >";
	$data4 = "<dataset seriesName='$judul5' color='".getFCColor()."' >";
	 

	$sql="SELECT  count(*) as jml_prog ,
		jenis_hibah as jenis_hibah,    
		CONCAT(upper(nama_program_$lang) , ': ' , count(*)  , '  PDAM')   as nama_program   ,  tbl_hibah_status.kdprog ,
		ifnull(SR_SPPH.sr_spph,0)  AS  jumlah_rencana_sr  ,
		ifnull(SR_BASELINE.hasil_baseline_sr,0)  AS hasil_baseline,
		ifnull(SR_FISIK.jml_sr,0)  AS pemasangan ,
		ifnull(SR_VERIFIKASI.hasil_verifikasi_sr,0)  AS hasil_verifikasi ,
		ifnull(SR_PENCAIRAN.pencairan_sr,0)  AS pencairan_sr
		FROM  tbl_hibah_status_program AS  tbl_hibah_status 
		LEFT JOIN tbl_mast_program on tbl_mast_program.kdprog = tbl_hibah_status.kdprog 

		LEFT JOIN 
		(SELECT ifnull(SUM(tbl_sr_spph.sr_spph),0) as sr_spph , kdprog  FROM tbl_sr_spph, tbl_hibah_status_program WHERE    tbl_hibah_status_program.id_hibah = tbl_sr_spph.id_hibah AND   tbl_hibah_status_program.tahun='$cari'   AND 
		((tbl_sr_spph.tahun < '$cari')  OR (tbl_sr_spph.bulan <= '$bulan' AND tbl_sr_spph.tahun='$cari'))
		and tbl_hibah_status_program.jenis_hibah=1 
		GROUP BY kdprog) as SR_SPPH  ON SR_SPPH.kdprog = tbl_hibah_status.kdprog

		LEFT JOIN 
		(SELECT ifnull(SUM(tbl_hasil_baseline.hasil_baseline_sr),0) as hasil_baseline_sr , kdprog  FROM tbl_hasil_baseline, tbl_hibah_status_program WHERE    tbl_hibah_status_program.id_hibah = tbl_hasil_baseline.id_hibah AND  tbl_hibah_status_program.tahun='$cari'   AND  
		((tbl_hasil_baseline.tahun < '$cari')  OR (tbl_hasil_baseline.bulan <= '$bulan' AND tbl_hasil_baseline.tahun='$cari')) 
		and tbl_hibah_status_program.jenis_hibah=1 
		GROUP BY kdprog) as SR_BASELINE  ON SR_BASELINE.kdprog = tbl_hibah_status.kdprog

		LEFT JOIN 
		(SELECT ifnull(SUM(tbl_hibah_status_program_fisik.jml_sr),0) as jml_sr , kdprog  FROM tbl_hibah_status_program_fisik, tbl_hibah_status_program WHERE    tbl_hibah_status_program.id_hibah = tbl_hibah_status_program_fisik.id_hibah AND  tbl_hibah_status_program.tahun='$cari'   AND 
		((tbl_hibah_status_program_fisik.tahun < '$cari')  OR (tbl_hibah_status_program_fisik.bulan <= '$bulan' AND tbl_hibah_status_program_fisik.tahun='$cari')) 
		
		AND tbl_hibah_status_program_fisik.status='1'   and tbl_hibah_status_program.jenis_hibah=1  
		GROUP BY kdprog) as SR_FISIK  ON SR_FISIK.kdprog = tbl_hibah_status.kdprog

		LEFT JOIN 
		(SELECT ifnull(SUM(tbl_hasil_verifikasi.hasil_verifikasi_sr),0) as hasil_verifikasi_sr , kdprog  FROM tbl_hasil_verifikasi, tbl_hibah_status_program WHERE    tbl_hibah_status_program.id_hibah = tbl_hasil_verifikasi.id_hibah AND  tbl_hibah_status_program.tahun='$cari'   AND 
		((tbl_hasil_verifikasi.tahun < '$cari')  OR (tbl_hasil_verifikasi.bulan <= '$bulan' AND tbl_hasil_verifikasi.tahun='$cari')) 
		and tbl_hibah_status_program.jenis_hibah=1 
		GROUP BY kdprog) as SR_VERIFIKASI  ON SR_VERIFIKASI.kdprog = tbl_hibah_status.kdprog

		LEFT JOIN 
		(SELECT ifnull(SUM(tbl_pencairan_sr.pencairan_sr),0) as pencairan_sr , kdprog  FROM tbl_pencairan_sr, tbl_hibah_status_program WHERE    tbl_hibah_status_program.id_hibah = tbl_pencairan_sr.id_hibah AND  tbl_hibah_status_program.tahun='$cari'   AND 
		((tbl_pencairan_sr.tahun < '$cari')  OR (tbl_pencairan_sr.bulan <= '$bulan' AND tbl_pencairan_sr.tahun='$cari')) 
		and tbl_hibah_status_program.jenis_hibah=1 
		GROUP BY kdprog) as SR_PENCAIRAN  ON SR_PENCAIRAN.kdprog = tbl_hibah_status.kdprog

		WHERE tahun='$cari' and jenis_hibah=1 
		group by   tbl_hibah_status.kdprog "; 
	$qr=mysql_query($sql); 
	// echo $sql;die;
	while($Data=mysql_fetch_array($qr))
	{
		$arrData[0][1]="$Data[nama_program]"; //program
		$arrData[0][2]="$Data[jumlah_rencana_sr]";  // rencana
		$arrData[0][3]="$Data[hasil_baseline]"; // total
		$arrData[0][4]="$Data[pemasangan]"; // total
		$arrData[0][5]="$Data[hasil_verifikasi]"; // total
		$arrData[0][6]="$Data[pencairan_sr]"; // total

		$kdprog=$Data['kdprog'];
		$var1="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=1&lang=$lang";
		$var2="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=2&lang=$lang";
		$var3="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=3&lang=$lang";
		$var4="tahun=$cari&bulan=$bulan&kd_prog=$kdprog&jenis=4&lang=$lang";

		foreach ($arrData as $arSubData) 
		{
			$kategori .= "<category name='".$arSubData[1]."' />";
			$data .= "<set value='".$arSubData[2] ."'  />";
			$data1 .= "<set value='".$arSubData[3] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/baseline.php?$var1'/>";
			$data2 .= "<set value='".$arSubData[4] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/pasang.php?$var1' />";
			$data3 .= "<set value='".$arSubData[5] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/verifikasi.php?$var1'  />";
			$data4 .= "<set value='".$arSubData[6] ."' link='P-detailsPopUp,width=600,height=500,toolbar=no,scrollbars=yes,resizable=yes-airminum/pencairan.php?$var1' />";
		}

	}
	$kategori .= "</categories>";
	$data .= "</dataset>";
	$data1 .= "</dataset>";
	$data2 .= "</dataset>";
	$data3 .= "</dataset>";
	$data4 .= "</dataset>";
	 
	$strXML .= $kategori . $data . $data1. $data2 . $data3 . $data4    ;
	$strXML .= "</graph>";
	FC_SetRenderer('javascript');
	echo renderChart("FusionCharts/MSColumn2D.swf", "", $strXML, "myChart", 900, 350, false, true);

?>
			 
   </body>
</html>

 
