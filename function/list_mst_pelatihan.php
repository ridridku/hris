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





$sql="SELECT
        r_mastpel__id as id,
        r_mastpel__mutasi as mutasi ,
        r_mastpel__email_pic as email_pic,
        r_mastpel__tema as tema,
        DATE_FORMAT(r_mastpel__tgl_awal,'%d %M %Y') as awal,
        r_mastpel__tgl_akhir as akhir,
        r_mastpel__penyelenggara as penyelenggara,
        r_mastpel__jenis as jenis,
        r_mastpel__deskripsi as deskripsi,
        r_mastpel__tempat as tempat,
        r_mastpel__status as r_mastpel__status,
        CASE r_mastpel__status
            When r_mastpel__status ='1' then 'Belum Dilaksanakan'
            Else  'Sudah Dilaksanakan'
          end AS status_kegiatan,
          peg.r_pegawai__nama AS r_pegawai__nama,
          peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi

FROM
  r_master_pelatihan 
  INNER JOIN v_pegawai peg ON r_master_pelatihan.r_mastpel__mutasi =peg.r_pnpt__no_mutasi WHERE 1=1  AND r_mastpel__status=2";


if ($pil !="") {
	
		if ($pil==1) {
			$sql.=" AND r_mastpel__tema LIKE '%".addslashes($cari)."%' ";
		} 
		if ($pil==2) {
			$sql .= " AND r_pegawai__nama LIKE  '%".$cari."%' ";
		}
                if ($pil==3) {
			$sql .= " AND YEAR(r_mastpel__tgl_awal) =  '".$cari."' ";
		}

}


$sql.=" order by id desc "; 
//echo ($sql);
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
<form action="list_mst_pelatihan.php" method="POST" name="frm">
<TABLE width="500" height="400" border="0" cellpadding="0" cellspacing="0">
<TR>
<TD width="500"  valign="top">
<table width="500" border="0" cellpadding="0" cellspacing="0">
<tr><td colspan="5" align="center" class="judul"><strong>&nbsp;</strong></td></tr>
<tr><td colspan="5" align="center" class="judul"><strong>TEMA PELATIHAN  </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="50">Berdasarkan</td>
<td width="10">:</td>
<td width="30">
<select name='pil' class="text">
<option value=''> Pilih berdasarkan</option>
<option value='1' <?PHP if ($pil==1) { echo "selected"; } ?>>Tema  </option>
<option value='2' <?PHP if ($pil==2) { echo "selected"; } ?>>PIC Acara</option>
<option value='3' <?PHP if ($pil==3) { echo "selected"; } ?>>Tahun</option>
</select>

</td>
<td  NOWRAP>&nbsp;Karakter dicari  </td>
<td width="10">:</td>
<td width="100"><input class="text" type="text" name="cari" size="20"  value="<?=$cari?>"  ></td>
<td width="10">&nbsp;</td>
<td width="240" >
<a href="#" onclick="submit();"><img src="icon_find.gif" border="0">&nbsp;cari</a>
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
    <td  align="left" valign="top" class="ewTableHeader">No</td>
    <td  align="left" valign="top" class="ewTableHeader">PIC ACARA</td>
    <td  align="left" valign="top" class="ewTableHeader">TEMA</td>
    <td  align="left" valign="top" class="ewTableHeader">TEMPAT</td>
    <td  align="left" valign="top" class="ewTableHeader">TGL KEGIATAN</td>
    <td  align="left" valign="top" class="ewTableHeader">STATUS</td>
    </tr>
		 
		      <?PHP if ($jum <= 0) { ?>
				<tr> 
					<td colspan="9" bgcolor="pink" align="center">Data Tidak Ditemukan... </td>
				</tr>
				<? } else ?>

				<? for ($i=0;$i<count($list_arr_satuan);$i++) { 
				   $j = $i+1;	
                                        $id=str_replace("'","",$list_arr_satuan[$i]['id']);
                                        $mutasi=str_replace("'","",$list_arr_satuan[$i]['mutasi']);
				   	$tema=str_replace("'","",$list_arr_satuan[$i]['tema']);
                                        $awal=str_replace("'","",$list_arr_satuan[$i]['awal']);
                                        $akhir=str_replace("'","",$list_arr_satuan[$i]['akhir']);
                                        $tempat=str_replace("'","",$list_arr_satuan[$i]['tempat']);
                                        $status=str_replace("'","",$list_arr_satuan[$i]['r_mastpel__status']);    
                                        
                                        
                                        
                                 
				?>
				
				<tr align="center" 
                                    onclick="GetPengaduan('<?=$id;?>','<?=$tema;?>');"  
                                    onMouseOver="setPointer(this, <?=$initSet[$i];?>, 'over', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseOut="setPointer(this, <?=$initSet[$i];?>, 'out', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseDown="setPointer(this, <?=$initSet[$i];?>, 'click', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');"> 
				 
				<? 
				$no = ($n_limit *($hal_ke-1)) + $j; 
				$id=$list_arr_satuan[$i]['id'];
				$a=$list_arr_satuan[$i]['id'];
				?>
				
                            <td align="left" class="tdatacontent"> <?=$no;?> </td>
                            <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_pegawai__nama']);?> </td>
                            <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['tema']);?> </td>
                            <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['tempat']);?> </td>
                            <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['awal'].' <font color="#ff0000"> S/D </font> '.$list_arr_satuan[$i]['akhir']);?> </td>
                            <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['status_kegiatan']);?></td>
					 
                                         
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

function GetPengaduan(id,tema) {
         
         window.opener.document.getElementById('id').value=id;
          window.opener.document.getElementById('tema').value=tema;
        
         
         window.close();
    //    alert(KodeDepartemen);
}


function doPaging(hal) {
  frm.action="list_mst_pelatihan.php";
  frm.submit();
}


function submit(){
  frm.action="list_mst_pelatihan.php";
  frm.submit();
}

// JAVA SCRIPT AJAX

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