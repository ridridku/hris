<br> 
 <link href="style.css" type="text/css" rel="stylesheet" />

<?php
 
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
 $db = &ADONewConnection($DB_TYPE);
 // $db->debug = true;
 $db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 include "../libchart/classes/libchart.php";

if ($_GET['kode_perwakilan']) $kode_perwakilan = $_GET['kode_perwakilan'];
else if ($_POST['kode_perwakilan']) $kode_perwakilan = $_POST['kode_perwakilan'];
else $kode_perwakilan="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";

if ($_GET['kode_kasus']) $kode_kasus = $_GET['kode_kasus'];
else if ($_POST['kode_kasus']) $kode_kasus = $_POST['kode_kasus'];
else $kode_kasus="";
 

if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
 

if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";
 

if ($_GET['kode_negara']) $kode_negara = $_GET['kode_negara'];
else if ($_POST['kode_negara']) $kode_negara = $_POST['kode_negara'];
else $kode_negara="";

 if ($_GET['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_GET['kode_klasifikasi_wni'];
else if ($_POST['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_POST['kode_klasifikasi_wni'];
else $kode_klasifikasi_wni="";
 

if ($_GET['kode_sektor']) $kode_sektor = $_GET['kode_sektor'];
else if ($_POST['kode_sektor']) $kode_sektor = $_POST['kode_sektor'];
else $kode_sektor="";
 

 if ($_GET['kode_jenis']) $kode_jenis = $_GET['kode_jenis'];
else if ($_POST['kode_jenis']) $kode_jenis = $_POST['kode_jenis'];
else $kode_jenis="";
 

if ($_GET['usia']) $usia = $_GET['usia'];
else if ($_POST['usia']) $usia = $_POST['usia'];
else $usia="";

if ($_GET['jk']) $jk = $_GET['jk'];
else if ($_POST['jk']) $jk = $_POST['jk'];
else $jk="";




if ($_GET['jenis_grafik']) $jenis_grafik = $_GET['jenis_grafik'];
else if ($_POST['jenis_grafik']) $jenis_grafik = $_POST['jenis_grafik'];
else $jenis_grafik="1";

if ($_GET['pil_grafik']) $pil_grafik = $_GET['pil_grafik'];
else if ($_POST['pil_grafik']) $pil_grafik = $_POST['pil_grafik'];
else $pil_grafik="1";		
				
			//	echo "JENIS GRAFIK ".$jenis_grafik;
 if ($bulan==1) { $nama_bulan="JANUARI"; }
if ($bulan==2) { $nama_bulan="FEBRUARI"; }
if ($bulan==3) { $nama_bulan="MARET"; }
if ($bulan==4) { $nama_bulan="APRIL"; }
if ($bulan==5) { $nama_bulan="MEI"; }
if ($bulan==6) { $nama_bulan="JUNI"; }
if ($bulan==7) { $nama_bulan="JULI"; }
if ($bulan==8) { $nama_bulan="AGUSTUS"; }
if ($bulan==9) { $nama_bulan="SEPTEMBER"; }
if ($bulan==10) { $nama_bulan="OKTOBER"; }
if ($bulan==11) { $nama_bulan="NOVEMBER"; }
if ($bulan==12) { $nama_bulan="DESEMBER"; }
				$label="BULAN ".$nama_bulan;
				
				if ($kode_kasus !='') { 
				$sql__="select upper(nama_kasus) as nama_kasus from tbl_mast_kasus where kode_kasus='$kode_kasus' ";
				$rs__=$db->Execute($sql__);			  
				$nama_kasus = $rs__->fields['nama_kasus']; 			 
	 
				}

				  if ($jk!='') { 
					  if ($jk==1) {
						$nama_jk="PEREMPUAN";	
					  }
					    if ($jk==2) {
						$nama_jk="LAKI - LAKI ";	
					  }				  
				 }


				  if ($usia!='') { 
					  if ($usia==1) {
						$nama_usia=" 0 - 20 ";	
					  }
					    if ($usia==2) {
						$nama_usia="  21 - 40 ";	
					  }

					  if ($usia==3) {
						$nama_usia="  41 - 60 ";	
					  }

					  if ($usia==4) {
						$nama_usia="  60 Keatas ";	
					  }
  
					  
				 }
 
				 

			    if ($kode_klasifikasi_wni!='') { 

					  if ($kode_klasifikasi_wni==1) {
						$nama_kw="WNI NON TKI";	
							if ($kode_jenis !='') {
							 $sql_jenis="select upper( nama_jenis_wni) as nama_jenis_wni  from tbl_mast_jenis_wni where  kode_jenis_wni='$kode_jenis' ";
							 $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_jenis_wni']; 

							}
					  }
					  if ($kode_klasifikasi_wni==3) {
						$nama_kw="  TKI FORMAL ";
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper (nama_formal) as nama_formal  from tbl_mast_jenis_formal  where  kode_jenis_formal='$kode_jenis' ";
							  $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_formal']; 
							}
					  }

					   if ($kode_klasifikasi_wni==4) {
						$nama_kw="  TKI INFORMAL ";	
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper(nama_informal) as nama_informal  from tbl_mast_jenis_informal  where  kode_jenis_informal='$kode_jenis' ";
							   $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_informal']; 
							}
					  }

					   if ($kode_klasifikasi_wni==6) {
						$nama_kw="  TKI ABK ";
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper(nama_abk) as nama_abk  from tbl_mast_jenis_abk  where  kode_jenis_abk='$kode_jenis' ";
							  $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_abk']; 
							}
					  } 
					 $nama_klasifikasi = $nama_kw;
					  $nama_jenis = $nama_jenis;

				 }


			$sql__="select * , upper(nama_kawasan) as nama_kawasan from tbl_mast_kawasan where kode_kawasan='$kode_kawasan' ";
				$rs__=$db->Execute($sql__);			  
				 $nm_kawasan = $rs__->fields['nama_kawasan']; 

?>


<table width="100%"    border=0 width="100%">	
				 
			 
				

				<? if ($tahun !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>TAHUN</b></td><td width="5"> <b>:</b> </td><td colspan="2"><b><?=$tahun?></b>&nbsp;</td></tr>
				<? } ?>
 

				<? if ($bulan !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>BULAN</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_bulan?></b>&nbsp;</td></tr>
				<? } ?>

				<? if ($nama_kasus !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>NAMA KASUS</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_kasus?></b>&nbsp;</td></tr>
				<? } ?>

				
				<? if ($nama_klasifikasi !='') {  ?>
				 <tr><td width="150" ><b>KLASIFIKASI WNI</b></td><td width="5"> <b>: </b></td><td colspan="2"><b><?=$nama_klasifikasi?></b> &nbsp;</td></tr>
				<? } ?>

				<? if ($nama_jenis !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>JENIS WNI</b></td><td width="5"> <b>:</b> </td><td colspan="2"><b><?=$nama_jenis?></b>&nbsp;</td></tr>
				<? } ?>
				<? if ($nama_jk !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>JENIS KELAMIN</b></td><td width="5"> <b>:</b> </td><td colspan="2"><b><?=$nama_jk?></b> &nbsp;</td></tr>
				<? } ?>
				<? if ($nama_usia !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>USIA</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_usia?> </b> &nbsp;</td></tr>
				<? } ?>

				<? if ($pil_grafik =='2' and $kode_kawasan !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>KAWASAN</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nm_kawasan?> </b> &nbsp;</td></tr>
				<? } ?> 
				 </table>
				<br>

			<?

if ($pil_grafik==1) { //KAWASAN

   if ($kode_kasus !='') {  // ada pilihan kasus

			if ($bulan !='') {	
			 

					 $sql_kawasan= "select kode_kawasan, nama_kawasan , 
					 (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan
					inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 	
					inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus
					inner join tbl_wni on tbl_kasus_pengaduan.kode_wni = tbl_wni.kode_wni
					where tbl_mast_kawasan.kode_kawasan  =a.kode_kawasan   and year(tgl_pengaduan)='$tahun' and month(tgl_pengaduan)='$bulan'  and  tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus' ";
					// -----------
					 if ($kode_klasifikasi_wni !='') { 
					 $sql_kawasan.= " AND kode_sumber='$kode_klasifikasi_wni' ";
					 }
							 if ($kode_jenis !='') { 
									 $sql_kawasan.= " and tbl_wni.kode_jenis='$kode_jenis' ";
							 }
  
							  if ($jk!='') { 
								  $sql_kawasan.= "  AND jk='$jk' ";
							 }

							
							if ($usia!='') { 
								  if ($usia=='1') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
								 }

								 if ($usia=='2') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
								 }

								  if ($usia=='3') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
								 }


								   if ($usia=='4') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
								 } 
							}


					//-----

					$sql_kawasan.=" ) as  orang from tbl_mast_kawasan as a  where 1=1 " ;

					 
						//if ($kode_kawasan !='') {
						//	$sql_kawasan.= " and   a.kode_kawasan='$kode_kawasan'  "; 
						//}

			 
 				
				}

			if ($bulan =='') {
			 
					 $sql_kawasan= "select kode_kawasan, nama_kawasan , (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan 	inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  inner join tbl_wni on tbl_kasus_pengaduan.kode_wni = tbl_wni.kode_wni where tbl_mast_kawasan.kode_kawasan  = a.kode_kawasan and year(tgl_pengaduan)='$tahun'   and  tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'  ";
					
					 if ($kode_klasifikasi_wni !='') { 
 $sql_kawasan.= " AND kode_sumber='$kode_klasifikasi_wni' ";
 }
							 if ($kode_jenis !='') { 
									 $sql_kawasan.= " and tbl_wni.kode_jenis='$kode_jenis' ";
							 }
  
							  if ($jk!='') { 
								  $sql_kawasan.= "  AND jk='$jk' ";
							 }

							
							if ($usia!='') { 
								  if ($usia=='1') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
								 }

								 if ($usia=='2') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
								 }

								  if ($usia=='3') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
								 }


								   if ($usia=='4') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
								 } 
							}




					$sql_kawasan.=" ) as  orang from tbl_mast_kawasan as a  where 1=1 " ;
					//if ($kode_kawasan !='') {
						// $sql_kawasan.= " and   a.kode_kawasan='$kode_kawasan'  "; 
					// }


					 
				
			 }

} else { //tidak ada pilihan kasusnya

				

				if ($bulan !='') {			 

					 $sql_kawasan= "select kode_kawasan, nama_kawasan , (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  inner join tbl_wni on tbl_kasus_pengaduan.kode_wni = tbl_wni.kode_wni where tbl_mast_kawasan.kode_kawasan  =a.kode_kawasan   and year(tgl_pengaduan)='$tahun' and month(tgl_pengaduan)='$bulan'   ";
					
					 if ($kode_klasifikasi_wni !='') { 
					 $sql_kawasan.= " AND kode_sumber='$kode_klasifikasi_wni' ";
					 }
							 if ($kode_jenis !='') { 
									 $sql_kawasan.= " and tbl_wni.kode_jenis='$kode_jenis' ";
							 }
  
							  if ($jk!='') { 
								  $sql_kawasan.= "  AND jk='$jk' ";
							 }

							
							if ($usia!='') { 
								  if ($usia=='1') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
								 }

								 if ($usia=='2') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
								 }

								  if ($usia=='3') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
								 }


								   if ($usia=='4') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
								 } 
							}



					$sql_kawasan.=") as  orang from tbl_mast_kawasan as a where 1=1  " ;

					//if ($kode_kawasan !='') {
						//	$sql_kawasan.= " and   a.kode_kawasan='$kode_kawasan'  "; 
					//	}
			 
					
				}

			if ($bulan =='') {
			 
					 $sql_kawasan= "select kode_kawasan, nama_kawasan , (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  inner join tbl_wni on tbl_kasus_pengaduan.kode_wni = tbl_wni.kode_wni where tbl_mast_kawasan.kode_kawasan  = a.kode_kawasan   and year(tgl_pengaduan)='$tahun'  ";
					
					 if ($kode_klasifikasi_wni !='') { 
					 $sql_kawasan.= " AND kode_sumber='$kode_klasifikasi_wni' ";
					 }
							 if ($kode_jenis !='') { 
									 $sql_kawasan.= " and tbl_wni.kode_jenis='$kode_jenis' ";
							 }
  
							  if ($jk!='') { 
								  $sql_kawasan.= "  AND jk='$jk' ";
							 }

							
							if ($usia!='') { 
								  if ($usia=='1') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
								 }

								 if ($usia=='2') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
								 }

								  if ($usia=='3') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
								 }


								   if ($usia=='4') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
								 } 
							}



					$sql_kawasan.=" ) as  orang from tbl_mast_kawasan as a where 1=1  " ; 
					 
 
			 }
 
}

 $sql_kawasan.= " order by nama_kawasan asc ";
 $rs = $db->Execute($sql_kawasan);				

if ($jenis_grafik==1) {
	$chart = new VerticalBarChart();
	$dataSet = new XYDataSet();
	while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_kawasan'];
		$orang = $rs->fields['orang'];
		$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
	 $rs->MoveNext();
	 endwhile;
	$chart->setDataSet($dataSet);
	$chart->setTitle("GRAFIK REKAP KASUS PER KAWASAN ");
	$chart->render("generated/demo1.png");


} else if ($jenis_grafik==2) {
	$chart = new LineChart();
	$dataSet = new XYDataSet();
 
	 while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_kawasan'];
		$orang = $rs->fields['orang'];
		$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
	 $rs->MoveNext();
	 endwhile;



	$chart->setDataSet($dataSet);

	$chart->setTitle("GRAFIK REKAP KASUS PER KAWASAN ");
	$chart->render("generated/demo5.png");

} else if ($jenis_grafik==3) { //pie Chart
		$chart = new HorizontalBarChart(600, 450);

	$dataSet = new XYDataSet();

 	 
	  while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_kawasan'];
		$orang = $rs->fields['orang'];
		$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
	 $rs->MoveNext();
	 endwhile;


	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));

	$chart->setTitle("GRAFIK REKAP KASUS PER KAWASAN ");
	$chart->render("generated/demo2.png");


} 


} // AKHIR PIL GRAFIK BERDASARKAN KAWASAN

if ($pil_grafik ==2) {
//GRAFIK BERDARKAN NEGARA
 //GRAFIK BERDARKAN NEGARA
//GRAFIK BERDARKAN NEGARA
  $sql_kawasan= "select IFNULL(count(*),0) as orang, nama_negara from tbl_kasus_pengaduan
inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
 inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan 
 	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
 inner join tbl_wni on tbl_kasus_pengaduan.kode_wni = tbl_wni.kode_wni where 1=1 

";
 
			  if ($kode_kasus!='') { 
								  $sql_kawasan.= "  AND tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus' ";
			  }


			  if ($tahun!='') { 
								  $sql_kawasan.= "  AND year(tgl_pengaduan)='$tahun' ";		
			  
			  }

			  if ($bulan!='') { 
								  $sql_kawasan.= "  and month(tgl_pengaduan)='$bulan' ";		
			  
			  }

 

			 	 if ($kode_klasifikasi_wni !='') { 
					 $sql_kawasan.= " AND kode_sumber='$kode_klasifikasi_wni' ";
					 }
							 if ($kode_jenis !='') { 
									 $sql_kawasan.= " and tbl_wni.kode_jenis='$kode_jenis' ";
							 }
  
							  if ($jk!='') { 
								  $sql_kawasan.= "  AND jk='$jk' ";
							 }

							
							if ($usia!='') { 
								  if ($usia=='1') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
								 }

								 if ($usia=='2') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
								 }

								  if ($usia=='3') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
								 }


								   if ($usia=='4') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
								 } 
							}



							if ($kode_kawasan!='') { 
								  $sql_kawasan.= "  AND tbl_mast_negara.kode_kawasan='$kode_kawasan' ";
							 }


$sql_kawasan.=" group by tbl_mast_negara.kode_negara  ";
 
 
 $rs = $db->Execute($sql_kawasan);				

if ($jenis_grafik==1) {
	$chart = new VerticalBarChart();
	$dataSet = new XYDataSet();
	while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_negara'];
		$orang = $rs->fields['orang'];
		if ($orang !='') {
			$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
		}
	 $rs->MoveNext();
	 endwhile;
	$chart->setDataSet($dataSet);
	$chart->setTitle("GRAFIK REKAP KASUS PER NEGARA ");
	$chart->render("generated/demo1.png");


} else if ($jenis_grafik==2) {
	$chart = new LineChart();
	$dataSet = new XYDataSet();
 
	 while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_negara'];
		$orang = $rs->fields['orang'];
		if ($orang !='') {
			$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
		} 
	 $rs->MoveNext();
	 endwhile;



	$chart->setDataSet($dataSet);

	$chart->setTitle("GRAFIK REKAP KASUS PER NEGARA ");
	$chart->render("generated/demo5.png");

} else if ($jenis_grafik==3) { //pie Chart
		$chart = new HorizontalBarChart(600, 450);

	$dataSet = new XYDataSet();

 	 
	  while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_negara'];
		$orang = $rs->fields['orang'];
		if ($orang !='') {
			$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
		}
	 $rs->MoveNext();
	 endwhile;


	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));

	$chart->setTitle("GRAFIK REKAP KASUS PER NEGARA ");
	$chart->render("generated/demo2.png");


} 


// AKHIR PILIHAN GRAFIK
// AKHIR PILIHAN GRAFIK
// AKHIR PILIHAN GRAFIK
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>GRAFIK REKAP KASUS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<? if ($jenis_grafik==1) { ?> 
	<img alt="Vertical bars chart" src="generated/demo1.png" style="border: 1px solid gray;"/>
<? } ?> 

<? if ($jenis_grafik==2) { ?> 
	<img alt="Vertical bars chart" src="generated/demo5.png" style="border: 1px solid gray;"/>
<? } ?> 

 <? if ($jenis_grafik==3) { ?> 
	<img alt="Vertical bars chart" src="generated/demo2.png" style="border: 1px solid gray;"/>
<? } ?> 







<form name="frm" action="rekap_kasus.php" > 
	<table width="100%" border=0 width="100%">	
	  <tr>
	  <td class="ewTableHeader"  width="100" > <b>JENIS GRAFIK  : </b>

 <select name="jenis_grafik" OnChange="window.location.href='rekap_kasus.php?kode_perwakilan=<?=$kode_perwakilan?>&pil_grafik=<?=$pil_grafik?>&bulan=<?=$bulan?>&tahun=<?=$tahun?>&kode_kasus=<?=$kode_kasus?>&kode_kawasan=<?=$kode_kawasan?>&kode_negara=<?=$kode_negara?>&kode_klasifikasi_wni=<?=$kode_klasifikasi_wni?>&kode_sektor=<?=$kode_sektor?>&kode_jenis=<?=$kode_jenis?>&usia=<?=$usia?>&jk=<?=$jk?>&jenis_grafik='+frm.jenis_grafik.value+''";>

<option value="">  [ Pilih Jenis Grafik ] </option>

			 <option value="1" <? if ($jenis_grafik==1) { ?> selected <? } ?> > Vertical bar Chart </option>
			 <option value="2" <? if ($jenis_grafik==2) { ?> selected <? } ?>> Line Chart </option>		  
			<option value="3" <? if ($jenis_grafik==3) { ?> selected <? } ?>> Horizontal Chart </option>
		  </select>

	   </td></tr>
	</table>
 </form>



</body>
</html>
