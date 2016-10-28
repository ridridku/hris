<SCRIPT LANGUAGE="JavaScript">
<!--

<?php if($_GET[opt]=="1") { ?> 
document.frmCreate.op.value = '1';
<?php } ?>

function checkPages(cond_1,cond_2){
if ((document.frmList.page.value > cond_1 )||(document.frmList.page.value <= '0' )) {
	document.frmList.page.value = cond_2;
	}
}

function check(str_msg, str_location){
	if(str_location == ''){
	if (confirm(str_msg)) return true; else return false;
	}else{
	if (confirm(str_msg)) return doNavigateContentOver(str_location,'mainFrame'); else return false;
	}
 }


var err = 0;
var err_ = 0;

function checkFrm(theForm){
with (theForm){
	if (kode_pelayanan.value == "") 
		{ 
			alert ("Silahkan isi field kode pelayanan !"); 
			kode_pelayanan.focus();
			return false; 
		}
	if (kode_sub_jenis_pelayanan.value == "") 
		{ 
			alert ("Silahkan isi field kode sub jenis pelayanan !"); 
			kode_sub_jenis_pelayanan.focus();
			return false; 
		}
	
	else if (tgl_pelayanan.value == "") 
		{ 
			alert ("Silahkan isi field tanggal jenis pelayanan !"); 
			tgl_pelayanan.focus();
			return false; 
		}
		else if (keterangan.value == "") 
		{ 
			alert ("Silahkan isi field keterangan !"); 
			keterangan.focus();
			return false; 
		}
			else if (kode_perwakilan.value == "") 
		{ 
			alert ("Silahkan Pilih Kode Perwakilan !"); 
			kode_perwakilan.focus();
			return false; 
		}
	else
		{
			submit();
			return true;
			
		}

}
	
	
}



function checkSubmit(){

<?php
if (substr($result->fields[idmod], 2,1)!="1"){
?>
	alert("<?php echo _ERR_NOT_AUTH_ENTRY ; ?>");
	doNavigateContentOver('index.php?mod_id=<?=$_GET[mod_id];?>','mainFrame');
	err_ = 1;

<?php } else { ?>
	err_ = 0;
<?php } ?>
}

function checkEdit(str_location){

	doNavigateContentOver(str_location,'mainFrame');

}

function checkDelete(str_location){

	return check('<?php echo _CONF_DELETE; ?>', str_location);

}


function resetFrm(theForm){
with(theForm){

	op.value = "0";
	}
	doNavigateContentOver('index.php?mod_id=<?=$_GET[mod_id];?>','mainFrame');
}
//-->


function cari_kab(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'index.php?get_prop=1&no_prop='+prop_id);
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

 function goJenazah() {
			//document.frm.KodeEselon1.value='';
			//document.frm.NamaEselon1.value='';
			 kode_perwakilan= document.frmCreate.kode_perwakilan.value;
			window.open('../../../function/list_pelayanan.php?kode_perwakilan='+kode_perwakilan+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
 			}
</SCRIPT>