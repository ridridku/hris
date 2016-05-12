 <?php
require_once('../includes/db.conf.php');
require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');
 
 
 
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 if($_POST['kode_negara'])
{ $kode_negara = $_POST['kode_negara'];
}else{ $kode_negara = $_GET['kode_negara'];}

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


$sql="SELECT
  tbl_wna.kode_wna,
  tbl_wna.nama_wna,
  tbl_wna.alamat_ind,
  tbl_wna.tlp_ind,
  tbl_wna.alamat_ln,
  tbl_wna.tlp_ln,
  tbl_wna.kode_negara,
  tbl_wna.keterangan,
  tbl_mast_negara.kode_negara,
  nama_negara
FROM
  tbl_mast_negara
  INNER JOIN tbl_wna
    ON tbl_mast_negara.kode_negara = tbl_wna.kode_negara where 1=1 ";
	//where tbl_wna.kode_negara='$kode_negara'  


if ($pil !="") {
	
		if ($pil==1) {//nama wna
			$sql.=" and tbl_wna.nama_wna LIKE '%".addslashes($cari)."%' ";
		} 
		if ($pil==2) {//kode negara
			$sql .= "AND nama_negara LIKE '%".addslashes($cari)."%' ";
		}
		if ($pil==3) { //kode wna
			$sql .= "AND tbl_wna.kode_wna = '".addslashes($cari)."' ";
		}

		if ($pil==4) { //alamat Luar negeri
			$sql .= "AND tbl_wna.alamat_ln = '".addslashes($cari)."' ";
		}
		if ($pil==5) { //Telepon Luar negeri
			$sql .= "AND tbl_wna.tlp_ln = '".addslashes($cari)."' ";
		}
 
		if ($pil==6) { // keterangan
			$sql.=" and tbl_wna.keterangan LIKE '%".addslashes($cari)."%' ";
		}

}
$sql .= " order by nama_wna ";

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

$sql_pw="select upper(nama_negara) as nama_negara  from tbl_mast_negara where kode_negara='$kode_negara'";
$rs_pw	= $db->execute($sql_pw);
$nama_negara=$rs_pw->fields['nama_negara'];

//echo "PILIHANNNNNNNNNN".$pil;

?>


<link href="style.css" type="text/css" rel="stylesheet" />
<link href="formulir.css" type="text/css" rel="stylesheet" />
<SCRIPT LANGUAGE="JavaScript" SRC="global.js"></SCRIPT> 
<SCRIPT LANGUAGE="JavaScript" SRC="tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="tw-sack.js"></SCRIPT>
 <SCRIPT LANGUAGE="JavaScript" SRC="<?=$HREF_THEME?>/defaults/javascripts/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<link rel="stylesheet" href="<?=$HREF_THEME?>/defaults/css/dhtmlgoodies_calendar.css" type="text/css">
 
<div id="ajax_input"> 

<form action="list_wna.php" method="POST" name="frm">

 <TABLE width="500" height="400" border="0" cellpadding="0" cellspacing="0">
<TR>
<TD width="500"  valign="top">


<table width="500" border="0" cellpadding="0" cellspacing="0">
 <tr><td colspan="5" align="center" class="judul"><strong>&nbsp;</strong></td></tr>

<tr><td colspan="5" align="center" class="judul"><strong>DAFTAR  WNA <?=$nama_negara?> </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>
<td width="50">Berdasarkan</td>
<td width="10">:</td>
<td width="30">
<select name='pil' class="text">
<option value=0></option>
<option value='1' <? if ($pil==1) { echo "selected"; } ?>>Nama WNA</option>
<option value='2' <? if ($pil==2) { echo "selected"; } ?>>Nama Negara</option>
<option value='4' <? if ($pil==4) { echo "selected"; } ?>>Alamat luar Negeri</option>
<option value='5' <? if ($pil==5) { echo "selected"; } ?>>Telepon luar Negeri</option>
<option value='6' <? if ($pil==6) { echo "selected"; } ?>>Keterangan</option>

 </select>

</td>
<td  NOWRAP>&nbsp;Karakter dicari  </td>
<td width="10">:</td>
<td width="100"><input class="text" type="text" name="cari" size="15"  value="<?=$cari?>"  ></td>
<td width="10">&nbsp;</td>
<td   >
<a href="#" onclick="submit();">
<img src="icon_find.gif" border="0">&nbsp;cari
</a>
 <a href="#" OnClick="JavaScript:Ajax('ajax_input','wna/form.php?kode_perwakilan=<?=$kode_perwakilan?>')">
 <img src="disk.png" border="0">&nbsp;Tambah  
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
			<td  align="left" valign="top" class="ewTableHeader">NAMA WNA</td>
	 
			<td  align="left" valign="top" class="ewTableHeader">NEGARA</td>
			<td  align="left" valign="top" class="ewTableHeader">ALAMAT DI LUAR NEGERI</td>
			<td  align="left" valign="top" class="ewTableHeader">TELEPON DI LUAR NEGERI</td>
			<td  align="left" valign="top" class="ewTableHeader">KETERANGAN</td>

		 
			</tr>
		 
		      <? if ($jum <= 0) { ?>
				<tr> 
					<td colspan="7" bgcolor="pink" align="center">Data Tidak Ditemukan... </td>
				</tr>
				<? } else ?>

				<? for ($i=0;$i<count($list_arr_satuan);$i++) { 
				   $j = $i+1;	

				    $nama_wna=str_replace("'","",$list_arr_satuan[$i]['nama_wna']);
			 

				?>
                
				<tr align="center" onclick="GetPengaduan('<?=$list_arr_satuan[$i]['kode_wna'];?>', '<?=$nama_wna;?>');"  onMouseOver="setPointer(this, <?=$initSet[$i];?>, 'over', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" onMouseOut="setPointer(this, <?=$initSet[$i];?>, 'out', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" onMouseDown="setPointer(this, <?=$initSet[$i];?>, 'click', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');"> 
				 
				<? 
				$no = ($n_limit *($hal_ke-1)) + $j; 
				$id=$list_arr_satuan[$i]['id'];
				$a=$list_arr_satuan[$i]['id'];
				?>
				
			 
					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['nama_wna']);?> </td>			 
					<td align="left" class="tdatacontent"><?=$list_arr_satuan[$i]['nama_negara'];?></td>
					<td align="left" class="tdatacontent"><?=$list_arr_satuan[$i]['alamat_ln'];?></td>
					 <td align="left" class="tdatacontent"><?=$list_arr_satuan[$i]['tlp_ln'];?></td>
					 <td align="left" class="tdatacontent"><?=$list_arr_satuan[$i]['keterangan'];?></td>
					 

					 
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

			 
			<INPUT TYPE="hidden" name="kode_negara" value="<?=$kode_negara?>">		 
 


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
function GetPengaduan(kode_wna,nama_wna) {
    
    window.opener.document.getElementById('kode_wni').value=kode_wna;
	 window.opener.document.getElementById('nama').value=nama_wna;

    window.close();
    //    alert(KodeDepartemen);
}

function doPaging(hal) {
  frm.action="list_wna.php";
  frm.submit();
}


function submit(){
  frm.action="list_wna.php";
  frm.submit();
}

//CEK FORM
//CEK FORM
//CEK FORM
function checkFrm(theForm){
with (theForm){
	if (kode_wna.value == "") 
		{ 
			alert ("Silahkan isi field kode wna !"); 
			kode_wna.focus();
			return false; 
		}
		else if (kode_negara.value == "") 
		{ 
			alert ("Silahkan isi field kode negara WNA !"); 
			kode_negara.focus();
			return false; 
		}
		else if (nama_wna.value == "") 
		{ 
			alert ("Silahkan isi field nama WNA !"); 
			nama_wna.focus();
			return false; 
		}
		
		else if (alamat_ind.value == "") 
		{ 
			alert ("Silahkan isi field alamat WNA di Dalam Negeri !"); 
			alamat_ind.focus();
			return false; 
		}
		else if (tlp_ind.value == "") 
		{ 
			alert ("Silahkan isi field telepon WNA di Dalam Negeri !"); 
			tlp_ind.focus();
			return false; 
		}
		else if (alamat_ln.value == "") 
		{ 
			alert ("Silahkan isi field alamat WNA di Luar Negeri !"); 
			alamat_ln.focus();
			return false; 
		}
		else if (tlp_ln.value == "") 
		{ 
			alert ("Silahkan isi field telepon WNA di Luar Negeri !"); 
			tlp_ln.focus();
			return false; 
		}
		else if (keterangan.value == "") 
		{ 
			alert ("Silahkan isi field Keterangan WNA !"); 
			keterangan.focus();
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