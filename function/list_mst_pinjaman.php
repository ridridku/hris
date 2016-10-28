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
  r_ang__id,
  r_ang__jenis,
  r_ang__platfond,
  r_ang__ket,
  r_ang__total,
  r_ang__tenor_bulan,
  r_ang__cicilan

FROM
  r_angsuran  WHERE 1=1 ";


if ($pil !="") {
	
		if ($pil==1) {
			$sql.=" and r_ang__jenis LIKE '%".addslashes($cari)."%' ";
		} 
		if ($pil==2) {
			$sql .= "AND r_ang__platfond = '".$cari."' ";
		}

}


$sql.=" order by r_ang__id "; 
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

<form action="list_mst_pinjaman.php" method="POST" name="frm">

<TABLE width="500" height="400" border="0" cellpadding="0" cellspacing="0">
<TR>
<TD width="500"  valign="top">


<table width="500" border="0" cellpadding="0" cellspacing="0">
 <tr><td colspan="5" align="center" class="judul"><strong>&nbsp;</strong></td></tr>

<tr><td colspan="5" align="center" class="judul"><strong>JENIS PINJAMAN </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>
<td width="50">Berdasarkan</td>
<td width="10">:</td>
<td width="30">
<select name='pil' class="text">
<option value=''> Pilih berdasarkan</option>
<option value='1' <?PHP if ($pil==1) { echo "selected"; } ?>>Jenis  </option>
   <option value='2' <?PHP if ($pil==2) { echo "selected"; } ?>>Plafond</option>

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
			<td  align="left" valign="top" class="ewTableHeader">Jenis Pinjaman</td>
                        <td  align="left" valign="top" class="ewTableHeader">Plafon</td>
			<td  align="left" valign="top" class="ewTableHeader">Tenor (Bulan)</td>
			<td  align="left" valign="top" class="ewTableHeader">Cicilan (Bulan)</td>
			

			
 
			</tr>
		 
		      <?PHP if ($jum <= 0) { ?>
				<tr> 
					<td colspan="9" bgcolor="pink" align="center">Data Tidak Ditemukan... </td>
				</tr>
				<? } else ?>

				<? for ($i=0;$i<count($list_arr_satuan);$i++) { 
				   $j = $i+1;	
                                        $angsuran_id=str_replace("'","",$list_arr_satuan[$i]['r_ang__id']);
				   	$jenis=str_replace("'","",$list_arr_satuan[$i]['r_ang__jenis']);
                                        $plafond=str_replace("'","",$list_arr_satuan[$i]['r_ang__platfond']);
                                        $tenor=str_replace("'","",$list_arr_satuan[$i]['r_ang__tenor_bulan']);
                                        $cicilan=str_replace("'","",$list_arr_satuan[$i]['r_ang__cicilan']);    
                                 
				?>
				
				<tr align="center" 
                                    onclick="GetPengaduan('<?=$angsuran_id;?>','<?=$jenis;?>','<?="Rp " . number_format($plafond,2,',','.');?>','<?=$tenor;?>','<?="Rp " . number_format($cicilan,2,',','.');?>');"  
                                    onMouseOver="setPointer(this, <?=$initSet[$i];?>, 'over', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseOut="setPointer(this, <?=$initSet[$i];?>, 'out', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');" 
                                    onMouseDown="setPointer(this, <?=$initSet[$i];?>, 'click', '<?=$row_class[$i];?>', '#CCFFCC', '#FFCC99');"> 
				 
				<? 
				$no = ($n_limit *($hal_ke-1)) + $j; 
				$id=$list_arr_satuan[$i]['id'];
				$a=$list_arr_satuan[$i]['id'];
				?>
				
			
					 <td align="left" class="tdatacontent"> <?=strtoupper($list_arr_satuan[$i]['r_ang__jenis']);?> </td>
                                          <td align="left" class="tdatacontent"> <?="Rp ".number_format($plafond,2,',','.');?> </td>
					 <td align="left" class="tdatacontent"><?=strtoupper($list_arr_satuan[$i]['r_ang__tenor_bulan']);?> </td>
                                         <td align="left" class="tdatacontent"><?="Rp " . number_format($cicilan,2,',','.');?></td>
					 
                                         
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

function GetPengaduan(angsuran_id,jenis,plafond,tenor,cicilan) {
         
         window.opener.document.getElementById('angsuran_id').value=angsuran_id;
          window.opener.document.getElementById('jenis').value=jenis;
         window.opener.document.getElementById('plafond').value=plafond;
         window.opener.document.getElementById('tenor').value=tenor;
         window.opener.document.getElementById('cicilan').value=cicilan;
         
         window.close();
    //    alert(KodeDepartemen);
}


function doPaging(hal) {
  frm.action="list_mst_pinjaman.php";
  frm.submit();
}


function submit(){
  frm.action="list_mst_pinjaman.php";
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