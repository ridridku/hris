 <?PHP
 require_once('../includes/db.conf.php');
 require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');

 
 
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 if($_POST['kode_cabang'])
{ $kode_cabang = $_POST['kode_cabang'];
}else{ $kode_cabang = $_GET['kode_cabang'];}

 if($_POST['pil'])
{ $pil = $_POST['pil'];
}else{ $pil = $_GET['pil'];}


 if($_POST['cari'])
{ $cari = $_POST['cari'];
}else{ $cari = $_GET['cari'];}

$n_limit=20;
if (empty($_POST['paging']))
{	$hal_ke=1;
}else{
	$hal_ke = $_POST['paging'];
}
$hal_ke_ = $n_limit*($hal_ke-1);


// TAMBAHAN UNTUK AJAX WNI */
// TAMBAHAN UNTUK AJAX WNI */
// TAMBAHAN UNTUK AJAX WNI */
// TAMBAHAN UNTUK AJAX WNI */

if ($_GET[get_prop] == 1)
{  
	$no_propinsi = $_GET[no_prop_ktp];   
        
       
      
			if($no_propinsi!=''){
					$sql_kabupaten = "SELECT A.r_provinsi__id,A.r_provinsi__nama,B.r_kabupaten__id,B.r_kabupaten__nama,B.r_kabupaten__sts FROM r_provinsi A
                                                            LEFT JOIN r_kabupaten B on A.r_provinsi__id = B.r_kabupaten__provinsi_id
                                                            WHERE A.r_provinsi__id='".$no_propinsi."' ORDER BY A.r_provinsi__id ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=r_pegawai__ktp_kab  onchange=\"cari_kec_ktp(this.value)\">";
					$input_kab.="<option value=[Pilih Kabupaten]> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['r_kabupaten__id'].">".$recordSet_kabupaten->fields['r_kabupaten__sts'].'-'.$recordSet_kabupaten->fields['r_kabupaten__nama'];
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile;
					$input_kab.="</select> ";
					//
					$delimeter   = "-";
                                      
					$option_choice = $input_kab."^/&".$delimeter;
					echo $option_choice;
                                        
                                        
			}
}

if ($_GET[get_kec] == 1)
{
	$kab_id = $_GET[kab_id];
    
			if($kab_id!=''){
					$sql_kecamatan = "SELECT A.r_kecamatan__id as kec_id,
                                                        A.r_kecamatan__kabupaten_id,
                                                        A.r_kecamatan__nama,
                                                        B.r_kabupaten__nama,
                                                        B.r_kabupaten__provinsi_id
                                                        FROM r_kecamatan A
                                                          LEFT JOIN r_kabupaten B on A.r_kecamatan__kabupaten_id= B.r_kabupaten__id
                                                           WHERE r_kabupaten__id='".$kab_id."' ORDER BY r_kecamatan__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
					
					//$input_kec="<select name=r_kecamatan__id onchange=\"cari_kec2($r_kecamatan__id,this.value)\">";
                                        $input_kec="<select name=r_pegawai__ktp_kec  onchange=\"cari_kec2_ktp(this.value)\">";
					$input_kec.="<option value=[Pilih Kecamatan]> ";
					$input_kec.="</option> ";
                                        
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields[kec_id].">".$recordSet_kecamatan->fields['r_kecamatan__nama'];
                                            
						$input_kec.="</option>";
                                               
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
}

		

 
// END TAMBAHAN UNTUK AJAX WNI */
// END TAMBAHAN UNTUK AJAX WNI */
// END TAMBAHAN UNTUK AJAX WNI */
// END TAMBAHAN UNTUK AJAX WNI */




$sql="SELECT
  A.r_pnpt__nip,
   A.r_pnpt__no_mutasi,
  A.r_pnpt__finger_print,
  A.r_pnpt__shift,
  B.r_pegawai__nama,
  C.r_jabatan__ket,
  D.r_level__ket,
  E.*,
  CC.r_subdept__id,
  CC.r_subdept__ket,
  CC.r_dept__akronim,
  CC.r_dept__ket,
  DD.jenis_kelamin,
  x.r_stp__nama AS status
FROM
  r_penempatan A
  LEFT JOIN r_pegawai B
    ON B.r_pegawai__id = A.r_pnpt__id_pegawai
  LEFT JOIN r_jabatan C
    ON A.r_pnpt__jabatan = C.r_jabatan__id
  LEFT JOIN r_level D
    ON C.r_jabatan__level = r_level__id
  LEFT JOIN
  (SELECT DISTINCT
    BB.r_subcab__id AS subcab_id,
    BB.r_subcab__cabang AS subcabang,
    BB.r_subcab__nama AS subcabangnama,
    AA.r_cabang__nama AS cabang
  FROM
    r_cabang AA
    LEFT JOIN r_subcabang BB
      ON AA.r_cabang__id = BB.r_subcab__cabang) AS E
    ON A.r_pnpt__subcab = E.subcab_id
  
  LEFT JOIN
  (SELECT
    SUBDEP.r_subdept__id,
    SUBDEP.r_subdept__ket,
    SUBDEP.r_subdept__dept,
    DEP.r_dept__id,
    DEP.r_dept__akronim,
    DEP.r_dept__ket
  FROM
    r_departement DEP
    LEFT JOIN r_subdepartement SUBDEP
      ON SUBDEP.r_subdept__dept = DEP.r_dept__id) AS CC
    ON CC.r_subdept__id = A.r_pnpt__subdept
  LEFT JOIN
  (SELECT
    CASE PEG.r_pegawai__jk WHEN '1' THEN 'LAKI-LAKI' WHEN '0' THEN 'PEREMPUAN' END jenis_kelamin,
    PEG.r_pegawai__id
  FROM
    r_pegawai PEG
    LEFT JOIN r_penempatan PEN
      ON PEG.r_pegawai__id = PEN.r_pnpt__id_pegawai) AS DD
    ON DD.r_pegawai__id = A.r_pnpt__id_pegawai
  LEFT JOIN r_status_pegawai X
    ON X.r_stp__id = A.r_pnpt__status
  LEFT JOIN r_shift Y ON A.r_pnpt__shift=Y.r_shift__id where A.r_pnpt__subcab ='$kode_cabang' ";


//if ($pil !="") {
//	
//		if ($pil==1) {
//			$sql.=" and tbl_wni.nama LIKE '%".addslashes($cari)."%' ";
//		} 
//		if ($pil==2) {
//			$sql .= "AND kode_form_pengaduan = '".$cari."' ";
//		}
//		if ($pil==3) { //ktp
//
//			$sql .= "AND tbl_wni.no_paspor = '".addslashes($cari)."' ";
// 
//		}
//
//		if ($pil==4) { //paspor
//			$sql .= "AND tbl_wni.finger_print = '".addslashes(trim($cari))."' ";
//		}
// 
//		if ($pil==6) { // tahun
//			$sql.=" and nama_kabupaten LIKE '%".addslashes($cari)."%' ";
//		}
// 
//
//}


$sql.=" order by r_pegawai__nama "; 
$rs_paging	= $db->execute($sql);
$n_rec = $rs_paging->recordCount();
$sql .= "limit $hal_ke_,$n_limit ";
$n_page = ceil($n_rec/$n_limit);  
$rs2	= $db->execute($sql);
$list_arr_satuan = array();
$row_class = array();
$initSet = array();
$z=0;$i=1;$y=2;$n=0;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	if ($i%2==0){ 
			$ROW_CLASSNAME="#FFFFFF"; }
		else {
			$ROW_CLASSNAME="#F0F0F0";
	    }
    array_push($row_class, $ROW_CLASSNAME);
	array_push($initSet, $z);
	$z++;$i++;$y++;$n++;
}

$jum = count($list_arr_satuan);

//$sql_pw="select upper(nm_perwakilan) as nm_perwakilan  from tbl_mast_perwakilan where kode_perwakilan='$kode_perwakilan'";
$sql_pw="SELECT r_cabang__id,r_cabang__nama FROM r_cabang where r_cabang__id='$kode_cabang'";
$rs_pw	= $db->execute($sql_pw);
$nm_cabang=$rs_pw->fields['r_cabang__nama'];
?>


<link href="style.css" type="text/css" rel="stylesheet" />
<link href="formulir.css" type="text/css" rel="stylesheet" />
<SCRIPT LANGUAGE="JavaScript" SRC="global.js"></SCRIPT> 
<SCRIPT LANGUAGE="JavaScript" SRC="tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="tw-sack.js"></SCRIPT>
 <SCRIPT LANGUAGE="JavaScript" SRC="<?=$HREF_THEME?>/defaults/javascripts/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<link rel="stylesheet" href="<?=$HREF_THEME?>/defaults/css/dhtmlgoodies_calendar.css" type="text/css">


<div id="ajax_input"> 

<form action="list_tki_penampungan.php" method="POST" name="frm">

<TABLE width="500" height="400" border="0" cellpadding="0" cellspacing="0">
<TR>
<TD width="500"  valign="top">


<table width="500" border="0" cellpadding="0" cellspacing="0">
 <tr><td colspan="5" align="center" class="judul"><strong>&nbsp;</strong></td></tr>

<tr><td colspan="5" align="center" class="judul"><strong>DAFTAR  KARYAWAN  UNTUK CABANG <?=$nm_cabang?> </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>
<td width="50">Berdasarkan</td>
<td width="10">:</td>
<td width="30">
<select name='pil' class="text">
<option value=0></option>
<option value='1' <?PHP if ($pil==1) { echo "selected"; } ?>>Nama  </option>
<option value='3' <?PHP if ($pil==3) { echo "selected"; } ?>>Cabang</option>
<option value='4' <?PHP if ($pil==4) { echo "selected"; } ?>>Jabatan</option>
 
<option value='6' <?PHP if ($pil==6) { echo "selected"; } ?>>Level</option>

 </select>

</td>
<td  NOWRAP>&nbsp;Karakter dicari  </td>
<td width="10">:</td>
<td width="100"><input class="text" type="text" name="cari" size="20"  value="<?=$cari?>"  ></td>
<td width="10">&nbsp;</td>
<td width="240" >
<a href="#" onclick="submit();">
<img src="icon_find.gif" border="0">&nbsp;cari
</a>
 <a href="#" OnClick="JavaScript:Ajax('ajax_input','penampungan/form.php?kode_cabang=<?=$kode_cabang?>')">
<img src="disk.png" border="0">&nbsp;Tambah Data
</a> 


</td>
</tr>
</table>



<br>


		<table width="500">
		<tr>
		<td align="center">
		 
			<table width="500" border="0" cellpadding="0" cellspacing="0">
			<tr><td colspan="10" align="center"><hr width="100%"></td></tr>
			</table>

			<table width="500" border="0" cellpadding="0" cellspacing="0" class="ewTable">
			<tr> 
			<td  align="left" valign="top" class="ewTableHeader">NAMA KARYAWAN</td>
                        <td  align="left" valign="top" class="ewTableHeader">NO MUTASI</td>
			<td  align="left" valign="top" class="ewTableHeader">CABANG</td>
			<td  align="left" valign="top" class="ewTableHeader">JABATAN</td>
			<td  align="left" valign="top" class="ewTableHeader">LEVEL</td>

			
 
			</tr>
		 
		      <?PHP if ($jum <= 0) { ?>
				<tr> 
					<td colspan="9" bgcolor="pink" align="center">Data Tidak Ditemukan... </td>
				</tr>
				<? } else ?>

				<? for ($i=0;$i<count($list_arr_satuan);$i++) { 
				   $j = $i+1;	
				   	$nama=str_replace("'","",$list_arr_satuan[$i]['r_pegawai__nama']);
                                        $finger=str_replace("'","",$list_arr_satuan[$i]['r_pnpt__no_mutasi']);
                                        $cabang=str_replace("'","",$list_arr_satuan[$i]['cabang']);
                                        $jabatan=str_replace("'","",$list_arr_satuan[$i]['r_jabatan__ket']);
                                        $level=str_replace("'","",$list_arr_satuan[$i]['r_level__ket']);    
                                        $finger=str_replace("'","",$list_arr_satuan[$i]['r_pnpt__finger_print']);
                                        $shift=str_replace("'","",$list_arr_satuan[$i]['r_pnpt__shift']);
                                       
				?>
				
				<tr align="center" 
                                    onclick="GetPengaduan('<?=$list_arr_satuan[$i]['r_pegawai__nama'];?>','<?=$list_arr_satuan[$i]['r_pnpt__no_mutasi'];?>','<?=$list_arr_satuan[$i]['r_pnpt__finger_print'];?>','<?=$list_arr_satuan[$i]['r_pnpt__shift'];?>');"  
                                    onMouseOver="setPointer(this, <?=$initSet[$i];?>, 'over', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseOut="setPointer(this, <?=$initSet[$i];?>, 'out', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseDown="setPointer(this, <?=$initSet[$i];?>, 'click', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');"> 
				 
				<? 
				$no = ($n_limit *($hal_ke-1)) + $j; 
				$id=$list_arr_satuan[$i]['id'];
				$a=$list_arr_satuan[$i]['id'];
				?>
				
					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pegawai__nama']);?> </td>
                                          <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pnpt__no_mutasi']);?> </td>
					 <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['cabang']);?> </td>
                                         <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['r_jabatan__ket']);?></td>
					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_level__ket']);?> </td>
                                         
				</tr>
				<? }?>

		</table>




</TD>
</TR>
</TABLE>

</center>

<table width="100%">
<tr class="text-regular">
 
<td>

			 
			<INPUT TYPE="hidden" name="kode_cabang" value="<?=$kode_cabang?>">		 
 			&nbsp;Hal : 
                    <select name="paging" size="1" onChange="doPaging(this.value);">
					   <? for($i=1;$i<=($n_page);$i++) {?>	

						<option value="<?=$i;?>" <? if ($hal_ke == $i)  echo 'SELECTED'?> ><?=$i;?></option>
					   <? }?>
					  </select>
                    &nbsp; &nbsp; 
                	</td>
			<td align="right">Jumlah data : <strong> <?=$n_rec;?> records </strong> </td>
			<td align="right"> </td>
</tr>
</table>
</FORM>
</div>

<script>
function GetPengaduan(r_pegawai__nama,r_pnpt__finger_print,r_pnpt__no_mutasi,r_pnpt__shift) {
         window.opener.document.getElementById('r_pegawai__nama').value=r_pegawai__nama;
         window.opener.document.getElementById('r_pnpt__finger_print').value=r_pnpt__finger_print;
         window.opener.document.getElementById('r_pnpt__no_mutasi').value=r_pnpt__no_mutasi;
         window.opener.document.getElementById('r_pnpt__shift').value=r_pnpt__shift;
         window.close();
    //    alert(KodeDepartemen);
}



function doPaging(hal) {
  frm.action="rekap_verifikasi_hrd.php";
  frm.submit();
}


function submit(){
  frm.action="rekap_verifikasi_hrd.php";
  frm.submit();
}

// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX

function cari_kab(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'list_tki_penampungan.php?get_prop=1&no_prop='+prop_id);
	http.onreadystatechange = handlechoice_kab; 
	http.send(null);
	} 
}
function handlechoice_kab(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kabupaten').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}
function cari_kec(prop_id,kab_id)
{
//alert(prop_id+'  -- '+kab_id);
if (prop_id != '') {
	http.open('get', 'list_tki_penampungan.php?get_kec=1&no_prop='+prop_id+'&no_kab='+kab_id);
	http.onreadystatechange = handlechoice_kec; 
	http.send(null);
	} 
}
function handlechoice_kec(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kecamatan').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}
function cari_kec2(prop_id,kab_id,kec_id)
{
//alert(prop_id+'  -- '+kab_id);
if (prop_id != '') {
	http.open('get', 'list_tki_penampungan.php?get_kec=1&no_prop='+prop_id+'&no_kab='+kab_id+'&no_kec='+kec_id);
	http.onreadystatechange = handlechoice_kec2; 
	http.send(null);
	} 
}

function handlechoice_kec2(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kecamatan2').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

//-->
function cari_jenis(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'list_tki_penampungan.php?get_jenis=1&no_prop='+prop_id);
	http.onreadystatechange = handlechoice_jenis; 
	http.send(null);
	} 
}
function handlechoice_jenis(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_sektor').innerHTML = a[0];
		document.getElementById('ajax_jenis_wni').innerHTML = a[1];
		//frmCreate.nama_lengkap.focus();
    }
}
function cari_jenis2(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'list_tki_penampungan.php?get_jenis_sektor=1&no_prop='+prop_id);
	http.onreadystatechange = handlechoice_jenis_sektor; 
	http.send(null);
	} 
}
function handlechoice_jenis_sektor(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
	 
		document.getElementById('ajax_jenis_wni').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}
// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX


//CEK FORM
//CEK FORM
//CEK FORM
function checkFrm(theForm){
with (theForm){
	 if (kode_perwakilan.value == "") 
		{ 
			alert ("Silahkan Pilih Perwakilan !"); 
			kode_perwakilan.focus();
			return false; 
		}
	else if (finger_print.value == "") 
		{ 
			alert ("Silahkan isi No.Paspor WNI !"); 
			finger_print.focus();
			return false; 
		}
 
	 else if (nama.value == "") 
		{ 
			alert ("Silahkan isi Nama WNI !"); 
			nama.focus();
			return false; 
		}

	 
 
	else if (jk.value == "") 
		{ 
			alert ("Silahkan Pilih Jenis Kelamin !"); 
			jk.focus();
			return false; 
		}

   else if (kode_klasifikasi_wni.value == "") 
		{ 
			alert ("Silahkan Pilih Jenis Klasifikasi WNI !"); 
			kode_klasifikasi_wni.focus();
			return false; 
		}
	  
   else if (kode_jenis.value == "") 
	 		{ 
			alert ("Silahkan Pilih Jenis WNI !"); 
			kode_jenis.focus();
			return false; 
		}
 
	else
		{
			submit();
			return true;
		}
}
	
}
  

// CEK FORM
// CEK FORM
// CEK FORM
 
</script>