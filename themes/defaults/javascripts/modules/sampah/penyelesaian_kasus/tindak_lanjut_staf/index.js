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
	 
		if (kode_perwakilan.value == "") 
		{ 
			alert ("Silahkan Pilih Perwakilan !"); 
			kode_perwakilan.focus();
			return false; 
		}
	else if (kode_wni.value == "") 
		{ 
			alert ("Silahkan Pilih Nama TKI !"); 
			kode_wni.focus();
			return false; 
		}

	 else if (kode_pjtki.value == "") 
		{ 
			alert ("Silahkan Pilih Nama PJTKI !"); 
			no_paspor.focus();
			return false; 
		}

	else if (kode_pjtka.value == "") 
		{ 
			alert ("Silahkan Pilih Nama PJTKA !"); 
			kode_agama.focus();
			return false; 
		}				
	else if (nama_majikan.value == "") 
		{ 
			alert ("Silahkan Isi Nama Majikan !"); 
			id_kab.focus();
			return false; 
		}

		else if (alamat_majikan.value == "") 
		{ 
			alert ("Silahkan Isi Alamat Majikan !"); 
			id_kab.focus();
			return false; 
		}

		else if (tlp_majikan.value == "") 
		{ 
			alert ("Silahkan Isi Tlp Majikan !"); 
			id_kab.focus();
			return false; 
		}


	 

	 

	else
		{
			submit();
			return true;
		}
}
	
	
}
// --------------------


function checkFrm2(theForm){
    	if (frmCreate_.tanggal.value == "") 
		{ 
			alert ("Silahkan Pilih/Isi Tanggal!"); 
			 
			return false; 
		}
	
	   else if (frmCreate_.kode_jenis_tl.value == "") 
		{  
			alert ("Silahkan Pilih Jenis Tindak Lanjut!"); 
			 
			return false; 
		}	
		else if (frmCreate_.tindak_lanjut.value == "") 
		{  
			alert ("Silahkan isi Tindak Lanjut yang dilakukan oleh PWNI!"); 
			 
			return false; 
		}
			else if (frmCreate_.perkembangan.value == "") 
		{  
			alert ("Silahkan isi Keterangan!"); 
			 
			return false; 
		}

	
	else
		{
			frmCreate_.submit();
			return true;
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
// --------------------

function resetFrm(theForm){
 
	doNavigateContentOver('index.php?mod_id=<?=$_GET[mod_id];?>','mainFrame');
}

function cari_tki(kode_perwakilan)
{
//alert(prop_id);
if (kode_perwakilan != '') {
	http.open('get', 'index.php?get_tki=1&kode_perwakilan='+kode_perwakilan);
	http.onreadystatechange = handlechoice_tki; 
	http.send(null);
	} 
}

function handlechoice_tki(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_tki').innerHTML = a[0];
	 	document.getElementById('ajax_pjtka').innerHTML = a[1];
		//frmCreate.nama_lengkap.focus();
    }
}


 function cari_kab3(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'index.php?get_prop3=1&no_prop='+prop_id);
	http.onreadystatechange = handlechoice_kab2; 
	http.send(null);
	} 
}

function handlechoice_kab2(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kabupaten3').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

 
</SCRIPT>