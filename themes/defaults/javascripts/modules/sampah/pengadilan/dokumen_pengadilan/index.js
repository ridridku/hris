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
	 
		  if (kode_jenis_panggil.value == "") 
		{ 
			alert ("Silahkan  pilih kategori !"); 
			kode_jenis_panggil.focus();
			return false; 
		}
 
	else if (nama.value == "") 
		{ 
			alert ("Silahkan isi nama !"); 
			nama.focus();
			return false; 
		}				
	else if (kode_asal.value == "") 
		{ 
			alert ("Silahkan pilih asal Pengadilan !"); 
			kode_asal.focus();
			return false; 
		}

	 else if (kode_pn.value == "") 
		{ 
			alert ("Silahkanpilih   Pengadilan !"); 
			kode_pn.focus();
			return false;			
		} 

	else if (no_surat_pengadilan.value == "") 
		{ 
			alert ("Silahkan isi no surat pengadilan!"); 
			no_surat_pengadilan.focus();
			return false;			
		} 

		 else if (no_surat_keluar.value == "") 
		{ 
			alert ("Silahkan isi no surat keluar !"); 
			no_surat_keluar.focus();
			return false;			
		} 

		 else if (tgl_surat_keluar.value == "") 
		{ 
			alert ("Silahkan isi tanggal surat keluar!"); 
			tgl_surat_keluar.focus();
			return false;			
		} 

		 else if (no_surat_balasan.value == "") 
		{ 
			alert ("Silahkan isi no surat balasan !"); 
			no_surat_balasan.focus();
			return false;			
		} 

		 else if (tgl_surat_balasan.value == "") 
		{ 
			alert ("Silahkan isi tanggal surat balasan !"); 
			tgl_surat_balasan.focus();
			return false;			
		} 

		 else if (no_surat_releas.value == "") 
		{ 
			alert ("Silahkan isi no surat realease !"); 
			no_surat_releas.focus();
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
with(theForm){

	op.value = "0";
	}
	doNavigateContentOver('index.php?mod_id=<?=$_GET[mod_id];?>','mainFrame');
}

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

function cari_kec(prop_id,kab_id)
{
//alert(prop_id+'  -- '+kab_id);
if (prop_id != '') {
	http.open('get', 'index.php?get_kec=1&no_prop='+prop_id+'&no_kab='+kab_id);
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
	http.open('get', 'index.php?get_kec=1&no_prop='+prop_id+'&no_kab='+kab_id+'&no_kec='+kec_id);
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


 function goPengaduan() {
			//document.frm.KodeEselon1.value='';
			//document.frm.NamaEselon1.value='';
			 kode_perwakilan= document.frmCreate.kode_perwakilan.value;
			 kode_jenis_panggil = document.frmCreate.kode_jenis_panggil.value;

		if (kode_jenis_panggil==1) //wni/tki/abk/staf
		{
			window.open('../../../function/list_wni.php?kode_perwakilan='+kode_perwakilan+'&kode_jenis_panggil='+kode_jenis_panggil+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0') 

		} else if (kode_jenis_panggil==2) {	 //BHI
			window.open('../../../function/list_bhi.php?kode_perwakilan='+kode_perwakilan+'&kode_jenis_panggil='+kode_jenis_panggil+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0') 
 		} else if (kode_jenis_panggil==3) {	 //WNA
			window.open('../../../function/list_wna.php?&kode_jenis_panggil='+kode_jenis_panggil+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0') 
 	 
		} else if (kode_jenis_panggil==4) {	 //BHA
			window.open('../../../function/list_bha.php?&kode_jenis_panggil='+kode_jenis_panggil+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0') 
 		}	
		
		
			
			}



function cari_item_detail(kode_asal,no_propinsi)
{
// alert(kode_asal);
if (kode_asal != '') {
	http.open('get', 'index.php?get_item_detail=1&kode_asal='+kode_asal+'&no_propinsi='+no_propinsi);
	http.onreadystatechange = handlechoice3; 
	http.send(null);
	} 
}

function handlechoice3(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
 
		document.getElementById('ajax_pengadilan').innerHTML = a[0];
	}
}


 function cari_kab(prop_id)
{
 //alert(prop_id);
	if (prop_id==3) { //wna
	 frmCreate.kode_perwakilan.disabled=true;
	 } else if (prop_id==2) { //bhi
	 frmCreate.kode_perwakilan.disabled=false;
	 } else if (prop_id==1) { //wni
	 frmCreate.kode_perwakilan.disabled=false;
	   
	}  
}




</SCRIPT>