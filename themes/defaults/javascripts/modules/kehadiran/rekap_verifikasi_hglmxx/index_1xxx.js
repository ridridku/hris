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
	 if (kode_cabang.value == "") 
		{ 
			alert ("Silahkan Pilih Cabang !"); 
			kode_cabang.focus();
			return false; 
		}
    
        if (tahun.value == "") 
		{ 
			alert ("Silahkan Pilih tahun !"); 
			r_pegawai__nama.focus();
			return false; 
		}

	if (bulan.value == "") 
		{ 
			alert ("Masukan Bulan !"); 
			 bulan.focus();
			return false; 
		}	
                                
	else
		{
			submit();
			return true;
		}
}
	
	
}
// --------------------CLOSE VALIDASI----//

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


function cari_jenis(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'index.php?get_jenis=1&no_prop='+prop_id);
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
function goPemberikerja() {
    
			
			kode_cabang= document.frmCreate.kode_cabang.value;
			window.open('../../../function/rekap_verifikasi_hrd.php?kode_cabang='+kode_cabang+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
 			}



//------------------JS PILIH SUBCAB-----------//

function cari_subcab(subcab_id)
{
alert(subcab_id)
if (subcab_id != '') {
	http.open('get','index.php?get_subcab=1&no_subcab='+subcab_id);
        //http.open('get','index.php?get_prop_ktp=1&no_prop_ktp='+prop_id_ktp);
	http.onreadystatechange = handlechoice_kab_ktp; 
	http.send(null);
	} 
}

function handlechoice_kab_ktp(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_subcabang').innerHTML = a[0];
		
    }
}
//------------------CLOSE JS PILIH SUBCAB-----------//
</SCRIPT>