<?PHP
 require_once('../includes/db.conf.php');
 require_once('../adodb/adodb.inc.php');
 require_once('../includes/config.conf.php');

//$p = new Pager;
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


if($_POST['q'])
{ $q= $_POST['q'];
}else{ $q= $_GET['q'];}

if($_POST['y'])
{ $y= $_POST['y'];
}else{ $y= $_GET['y'];}

if($_POST['h'])
{ $h= $_POST['h'];
}else{ $h= $_GET['h'];}


if($q!='')
{
    $kode_cabang=  base64_decode($q);
}

if($y!='')
{
    $pil=  base64_decode($y);
}

if($h!='')
{
    $paging=  base64_decode($h);
}




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


$sql=" SELECT r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                            r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
                                            r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                            r_penempatan.r_pnpt__status AS r_pnpt__status,
                                            r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
                                            r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
                                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                            r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
                                            r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
                                            r_penempatan.r_pnpt__shift AS r_pnpt__shift,
                                            r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
                                            r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
                                            r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                                            r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
                                            r_jabatan.r_jabatan__id AS r_jabatan__id,
                                            r_jabatan.r_jabatan__ket AS r_jabatan__ket,
                                            r_subdepartement.r_subdept__id AS r_subdept__id,
                                            r_subdepartement.r_subdept__ket AS r_subdept__ket,
                                            r_departement.r_dept__akronim AS r_dept__akronim,
                                            r_departement.r_dept__id AS r_dept__id,
                                            r_departement.r_dept__ket AS r_dept__ket,
                                            r_subcabang.r_subcab__nama AS r_subcab__nama,
                                            r_cabang.r_cabang__nama AS r_cabang__nama,
                                            r_cabang.r_cabang__id AS r_cabang__id,
                                            r_subcabang.r_subcab__id AS r_subcab__id,
                                            r_subcabang.r_subcab__cabang AS r_subcab__cabang,
                                            r_pegawai.r_pegawai__id AS r_pegawai__id,
                                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                            r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                              r_pegawai.r_pegawai__tgl_masuk AS masuk,
                                            r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
                                            r_status_pegawai.r_stp__id AS r_stp__id,
                                            r_status_pegawai.r_stp__nama AS r_stp__nama,
                                       (YEAR(CURDATE())-YEAR(r_pegawai__tgl_masuk)) - (RIGHT(CURDATE(),5)<RIGHT(r_pegawai__tgl_masuk,5)) AS lama_kerja                                        
                                           
                                    FROM
                                            r_pegawai
                                    INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                    INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                    INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                    INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                    INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                    INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                    INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
                                    WHERE
                                    r_pnpt__aktif = 1 AND r_cabang__id ='$kode_cabang' ";


if ($pil !="") {

		if ($pil==1) {
			$sql.=" and r_pegawai__nama LIKE '%".addslashes($cari)."%' ";
		}
		if ($pil==2) {
			$sql .= "AND r_pnpt__nip = '".$cari."' ";
		}

}

$sql.=" Order by r_pegawai__nama ";
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
?>


<link href="style.css" type="text/css" rel="stylesheet" />
<link href="formulir.css" type="text/css" rel="stylesheet" />
<SCRIPT LANGUAGE="JavaScript" SRC="global.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="tw-sack.js"></SCRIPT>
 <SCRIPT LANGUAGE="JavaScript" SRC="<?=$HREF_THEME?>/defaults/javascripts/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<link rel="stylesheet" href="<?=$HREF_THEME?>/defaults/css/dhtmlgoodies_calendar.css" type="text/css">


<div id="ajax_input">

<form action="list_pegawai_mdrp.php" method="POST" name="frm">

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
			<td  align="left" valign="top" class="ewTableHeader">CABANG</td>
			<td  align="left" valign="top" class="ewTableHeader">DEPARTEMEN</td>
			<td  align="left" valign="top" class="ewTableHeader">JABATAN</td>



			</tr>

		      <?PHP if ($jum <= 0) { ?>
				<tr>
					<td colspan="9" bgcolor="pink" align="center">Data Tidak Ditemukan... </td>
				</tr>
				<? } else ?>

				<? for ($i=0;$i<count($list_arr_satuan);$i++) {
				   $j = $i+1;
				   	$nama=str_replace("'","",$list_arr_satuan[$i]['r_pegawai__nama']);
                                        $finger=str_replace("'","",$list_arr_satuan[$i]['r_pnpt__nip']);
                                        $dep_lama=str_replace("'","",$list_arr_satuan[$i]['r_dept__ket']);
                                        $cabang=str_replace("'","",$list_arr_satuan[$i]['r_cabang__nama']);
                                        $jabatan=str_replace("'","",$list_arr_satuan[$i]['r_jabatan__ket']);
                                        $subdep=str_replace("'","",$list_arr_satuan[$i]['r_subdept__ket']);
                                        $id_pegawai=str_replace("'","",$list_arr_satuan[$i]['r_pegawai__id']);
                                        $lama_kerja=str_replace("'","",$list_arr_satuan[$i]['lama_kerja']);
                                        $masuk=strtotime($list_arr_satuan[$i]['masuk']);   
                              
                                        ?>

				<tr align="center"
                                    onclick="GetPengaduan('<?=$list_arr_satuan[$i]['r_pegawai__nama'];?>',
                                                '<?=$id_pegawai;?>','<?=$list_arr_satuan[$i]['r_jabatan__ket'];?>','<?=$list_arr_satuan[$i]['r_cabang__nama'];?>','<?=$lama_kerja;?>','<?=date("Y-M-d",$masuk);?>','<?=$dep_lama;?>','<?=$subdep;?>');"
                                    onMouseOver="oldColor=this.style.backgroundColor;this.style.backgroundColor='#CCFFCC';"onMouseOut="this.style.backgroundColor=oldColor;",<?=$initSet[$i];?>,'over','<?=$row_class[$i];?>','#CCFFCC','#FFCC99');"
                                    onMouseOut="setPointer(this), <?=$initSet[$i];?>,'out','<?=$row_class[$i];?>','#CCFFCC', '#FFCC99');"
                                    onMouseDown="setPointer(this), <?=$initSet[$i];?>,'click','<?=$row_class[$i];?>','#CCFFCC', '#FFCC99');">

				<?
				$no = ($n_limit *($hal_ke-1)) + $j;
				$id=$list_arr_satuan[$i]['id'];
				$a=$list_arr_satuan[$i]['id'];
				?>


					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pegawai__nama']);?> </td>
                                          <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pnpt__nip']);?> </td>
					 <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['r_cabang__nama']);?> </td>
                                         <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['r_dept__ket']);?></td>
					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pegawai__tgl_masuk']);?> </td>

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
    

                   
function GetPengaduan(r_pegawai__nama,id_pegawai,r_jabatan__ket,r_cabang__nama,lama_kerja,masuk,dep_lama,subdep) {
    
  
        window.opener.document.getElementById('r_pegawai__nama').value=r_pegawai__nama;
        window.opener.document.getElementById('id_pegawai').value=id_pegawai;
        window.opener.document.getElementById('r_jabatan__ket').value=r_jabatan__ket;
        window.opener.document.getElementById('r_cabang__nama').value=r_cabang__nama;
        window.opener.document.getElementById('lama_kerja').value=lama_kerja;
        window.opener.document.getElementById('tgl_masuk').value=masuk;
         window.opener.document.getElementById('dep_lama').value=dep_lama;
          window.opener.document.getElementById('subdep_lama').value=subdep;
        
       
       
         window.close();

}



//function doPaging(hal) {
//  frm.action="list_pegawai_mdrp.php";
//  frm.submit();
//}
//
//
//function submit(){
//  frm.action="list_pegawai_mdrp.php";
//  frm.submit();
//}

function doPaging(hal) {
    var kode_cabang= document.frm.kode_cabang.value;
    var  paging= document.frm.paging.value;

// Encode the String
                var kode_cabang_encoded = btoa(kode_cabang);
                var paging_encoded = btoa(paging);
//'../../../function/list_penempatan.php?q='+kode_cabang_encoded+'&y='+tipe_pdrm_encoded,null
  frm.action='list_pegawai_mdrp.php?q='+kode_cabang_encoded+'&h='+paging_encoded;
  frm.submit();
}


function submit(){
    var kode_cabang= document.frm.kode_cabang.value;
    var  pil= document.frm.pil.value;

// Encode the String
                var kode_cabang_encoded = btoa(kode_cabang);
                var pil_encoded = btoa(pil);
    frm.action='list_pegawai_mdrp.php?q='+kode_cabang_encoded+'&y='+pil_encoded;
  frm.submit();
}
// JAVA SCRIPT AJAX

//CEK FORM
function checkFrm(theForm){
with (theForm){
	 if (kode_cabang.value == "")
		{
			alert ("Silahkan Pilih Perwakilan !");
			kode_cabang.focus();
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
