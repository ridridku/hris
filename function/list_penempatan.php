<?PHP
require_once('../includes/config.conf.php');

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../includes/header.redirect.inc');
}else{
 
 
 require_once('../includes/db.conf.php');
 require_once('../adodb/adodb.inc.php');
 require_once('../includes/config.conf.php');
 
 
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 if($_POST['kode_cabang'])
{ $kode_cabang= $_POST['kode_cabang'];
}else{ $kode_cabang= $_GET['kode_cabang'];}

 if($_POST['tipe_pdrm'])
{ $tipe_pdrm = $_POST['tipe_pdrm'];
}else{ $tipe_pdrm = $_GET['tipe_pdrm'];}


 if($_POST['pil'])
{ $pil = $_POST['pil'];
}else{ $pil = $_GET['pil'];}


 if($_POST['kode_subcab_cari'])
{ $kode_subcab_cari = $_POST['kode_subcab_cari'];
}else{ $kode_subcab_cari = $_GET['kode_subcab_cari'];}


 if($_POST['departemen_cari'])
{ $departemen_cari = $_POST['departemen_cari'];
}else{ $departemen_cari = $_GET['departemen_cari'];}


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
if ($tipe_pdrm==0) {
 
    
    $sql=  " select A.r_pegawai__id AS r_pegawai__id,A.r_pegawai__nama AS r_pegawai__nama, A.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk 
            from r_pegawai A where A.r_pegawai__id not in (select distinct B.r_pnpt__id_pegawai from r_penempatan B)";
                             
			} else{
                    
$sql="SELECT
     A.r_pnpt__pdrm AS r_pnpt__pdrm,
    A.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
    A.r_pnpt__jabatan AS r_pnpt__jabatan,
    A.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
    A.r_pnpt__nip AS r_pnpt__nip,
    A.r_pnpt__status AS r_pnpt__status,
    A.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
    A.r_pnpt__subdept AS r_pnpt__subdept,
    A.r_pnpt__finger_print AS r_pnpt__finger_print,
    A.r_pnpt__gapok AS r_pnpt__gapok,
    A.r_pnpt__subcab AS r_pnpt__subcab,
    A.r_pnpt__shift AS r_pnpt__shift,
    A.r_pnpt__kon_awal AS r_pnpt__kon_awal,
    A.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
    A.r_pnpt__aktif AS r_pnpt__aktif,
    B.r_pegawai__id AS r_pegawai__id, 
  B.r_pegawai__nama AS r_pegawai__nama,
  B.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
  C.r_cabang__nama AS r_cabang__nama,
  C.r_cabang__id AS r_cabang__id,
  D.r_subcab__id AS r_subcab__id,
  D.r_subcab__nama AS r_subcab__nama,
  E.r_dept__id AS r_dept__id,
  E.r_dept__ket AS r_dept__ket,
  F.r_subdept__id AS r_subdept__id,
  F.r_subdept__ket AS r_subdept__ket,
  G.r_jabatan__id AS r_jabatan__id,
  G.r_jabatan__ket AS r_jabatan__ket

FROM
  r_penempatan A, r_pegawai B, r_cabang C, r_subcabang D,r_departement E,r_subdepartement F ,r_jabatan G
WHERE
  A.r_pnpt__id_pegawai = B.r_pegawai__id
  AND
  A.r_pnpt__subcab = D.r_subcab__id
  AND
  D.r_subcab__cabang = C.r_cabang__id 
  
  AND
  A.r_pnpt__subdept=F.r_subdept__id AND F.r_subdept__dept=E.r_dept__id
  AND
  G.r_jabatan__id=A.r_pnpt__jabatan AND  A.r_pnpt__aktif = 1 AND r_cabang__id ='$kode_cabang' ";
                        }

                        
                        
    if ($pil!="") {
	
                               if ($pil==1) {
                                $sql.=" and r_pegawai__nama LIKE '%".addslashes($cari)."%' ";
                                 } 
		
                 }
$sql.="Order by r_pegawai__nama "; 
//echo $sql;
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


$sql_pw="SELECT r_cabang__id,r_cabang__nama FROM r_cabang where r_cabang__id='$kode_cabang'";
$rs_pw	= $db->execute($sql_pw);
$nm_cabang=$rs_pw->fields['r_cabang__nama'];

}
?>


<link href="style.css" type="text/css" rel="stylesheet" />
<link href="formulir.css" type="text/css" rel="stylesheet" />
<SCRIPT LANGUAGE="JavaScript" SRC="global.js"></SCRIPT> 
<SCRIPT LANGUAGE="JavaScript" SRC="tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="tw-sack.js"></SCRIPT>
 <SCRIPT LANGUAGE="JavaScript" SRC="<?=$HREF_THEME?>/defaults/javascripts/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<link rel="stylesheet" href="<?=$HREF_THEME?>/defaults/css/dhtmlgoodies_calendar.css" type="text/css">


<div id="ajax_input"> 

<form action="list_penempatan.php" method="POST" name="frm">
   
<TABLE width="500" height="400" border="0" cellpadding="0" cellspacing="0">
<TR>
<TD width="500"  valign="top">


<table width="500" border="0" cellpadding="0" cellspacing="0">
 <tr><td colspan="5" align="center" class="judul"><strong>&nbsp;</strong></td></tr>

<tr><td colspan="5" align="center" class="judul"><strong>DAFTAR  KARYAWAN <?PHP echo $nm_cabang ?> </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>
<td width="50">Berdasarkan</td>
<td width="10">:</td>
<td width="30">
<select name='pil' class="text">
<option value=''> Pilih Berdasarkan</option>
<option value='1' <?PHP if ($pil==1) { echo "selected"; } ?>>Nama  </option>
<option value='2' <?PHP if ($pil==2) { echo "selected"; } ?>>NIP</option>
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
                        <td  align="left" valign="top" class="ewTableHeader">NIP</td>
                        <td  align="left" valign="top" class="ewTableHeader">ID FINGER</td>
			<td  align="left" valign="top" class="ewTableHeader">CABANG</td>
			<td  align="left" valign="top" class="ewTableHeader">SUB CABANG</td>
			<td  align="left" valign="top" class="ewTableHeader">DEPARTEMEN</td>
                        

			
 
			</tr>
		 
		      <?PHP if ($jum <= 0) { ?>
				<tr> 
					<td colspan="9" bgcolor="pink" align="center">Data Tidak Ditemukan... </td>
				</tr>
				<? } else ?>

				<? for ($i=0;$i<count($list_arr_satuan);$i++) { 
				   $j = $i+1;	
                                        $r_pegawai__id=str_replace("'","",$list_arr_satuan[$i]['r_pegawai__id']);
				   	$r_pegawai__nama=str_replace("'","",$list_arr_satuan[$i]['r_pegawai__nama']);
                                        $r_pegawai__tgl_masuk=str_replace("'","",$list_arr_satuan[$i]['r_pegawai__tgl_masuk']);
                                        $tipe_pdrm=str_replace("'","",$list_arr_satuan[$i]['r_pnpt__pdrm']);
                                        $r_pnpt__nip=str_replace("'","",$list_arr_satuan[$i]['r_pnpt__nip']);
                                        $nama_cabang=str_replace("'","",$list_arr_satuan[$i]['r_cabang__nama']);
                                        $cabang_id=str_replace("'","",$list_arr_satuan[$i]['r_cabang__id']);
                                        $jabatan=str_replace("'","",$list_arr_satuan[$i]['r_subcab__nama']);
                                        $dept=str_replace("'","",$list_arr_satuan[$i]['r_dept__ket']);    
                                    
                                        
                                
				?>
				
                                
				<tr align="center" 
                                    onclick="GetPengaduan(
                                                 '<?=$list_arr_satuan[$i]['r_pegawai__id'];?>',
                                                '<?=$list_arr_satuan[$i]['r_pegawai__nama'];?>',
                                                 '<?=$list_arr_satuan[$i]['r_pegawai__tgl_masuk'];?>',
                                                '<?=$list_arr_satuan[$i]['r_pnpt__nip'];?>',
                                                '<?=$list_arr_satuan[$i]['r_pnpt__finger_print'];?>'
                                                
                                                );"  
                                    onMouseOver="setPointer(this, <?=$initSet[$i];?>, 'over', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseOut="setPointer(this, <?=$initSet[$i];?>, 'out', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseDown="setPointer(this, <?=$initSet[$i];?>, 'click', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');"> 
				 
				<? 
				$no = ($n_limit *($hal_ke-1)) + $j; 
				$id=$list_arr_satuan[$i]['id'];
				$a=$list_arr_satuan[$i]['id'];
				?>
				
			
					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pegawai__nama']);?> </td>
                                          <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pnpt__nip']);?> </td>
                                           <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pnpt__finger_print']);?> </td>
					 <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['r_cabang__nama']);?> </td>
                                         <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['r_dept__ket']);?></td>
					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_jabatan__ket']);?> </td>
                                       
                                         
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
			 
    <INPUT TYPE="hidden" name="kode_cabang" value="<?PHP echo $cabang_id?>">
                        
          <INPUT TYPE="hidden" name="tipe_pdrm" value="<?PHP echo $tipe_pdrm?>">              
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
function GetPengaduan(r_pegawai__id,r_pegawai__nama,r_pegawai__tgl_masuk,r_pnpt__nip,r_pnpt__finger_print) {
         window.opener.document.getElementById('r_pegawai__id').value=r_pegawai__id;
          window.opener.document.getElementById('r_pegawai__nama').value=r_pegawai__nama;
         window.opener.document.getElementById('r_pegawai__tgl_masuk').value=r_pegawai__tgl_masuk;
         window.opener.document.getElementById('r_pnpt__nip').value=r_pnpt__nip;
         window.opener.document.getElementById('r_pnpt__finger_print').value=r_pnpt__finger_print;
         window.close();
    //    alert(KodeDepartemen);
}



function doPaging(hal) {
  frm.action="list_penempatan.php";
  frm.submit();
}


function submit(){
  frm.action="list_penempatan.php";
  frm.submit();
}

function cari_kab(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'list_penempatan.php?get_prop=1&no_prop='+prop_id);
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
	http.open('get', 'list_penempatan.php?get_kec=1&no_prop='+prop_id+'&no_kab='+kab_id);
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
	http.open('get', 'list_penempatan.php?get_kec=1&no_prop='+prop_id+'&no_kab='+kab_id+'&no_kec='+kec_id);
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
	http.open('get', 'list_penempatan.php?get_jenis=1&no_prop='+prop_id);
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
	http.open('get', 'list_penempatan.php?get_jenis_sektor=1&no_prop='+prop_id);
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