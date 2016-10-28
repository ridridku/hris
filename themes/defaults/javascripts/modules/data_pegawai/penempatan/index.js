<SCRIPT LANGUAGE="JavaScript">
<!--

<?PHP if($_GET[opt]=="1") { ?> 
document.frmCreate.op.value = '1';
<?PHP } ?>

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
    
	 if (r_pnpt__no_mutasi.value == "") 
		{ 
			alert ("Silahkan isi No Penempatan !"); 
			r_pnpt__no_mutasi.focus();
			return false; 
		}
 else if (kode_cabang.value == "") 
		{ 
			alert ("Silahkan Pilih Cabang !"); 
			kode_cabang.focus();
			return false; 
		}               
 else if (kode_subcab_cari.value == "") 
		{ 
			alert ("Silahkan Pilih Sub Cabang !"); 
			kode_subcab_cari.focus();
			return false; 
		}

//else if (kode_subcab.value == "") 
//       { 
//               alert ("Silahkan Pilih Sub Cabang !"); 
//               kode_subcab.focus();
//               return false; 
//       }
 else if (kode_departemen.value == "") 
       { 
               alert ("Silahkan Pilih Departemen !"); 
               kode_departemen.focus();
               return false; 
       }      
       
else if (kode_subdep.value == "") 
       { 
               alert ("Silahkan Pilih Sub Departemen !"); 
               kode_subdep.focus();
               return false; 
       }        
       
  else if (r_pnpt__status.value == "") 
       { 
               alert ("Silahkan Pilih Status Karyawan !"); 
               r_pnpt__status.focus();
               return false; 
       }      
       
                
  else if (r_jabatan.value == "") 
       { 
               alert ("Silahkan Pilih Jabatan !"); 
               r_jabatan.focus();
               return false; 
       }   
       
       
 else if (r_pnpt__tipe_salary.value == "") 
       { 
               alert ("Silahkan Pilih Tipe Salary !"); 
               r_pnpt__tipe_salary.focus();
               return false; 
       }        
  else if (tipe_pdrm.value == "") 
       { 
               alert ("Silahkan Pilih Tipe Penempatan !"); 
               tipe_pdrm.focus();
               return false; 
       }            
 else if (r_pegawai__nama.value == "") 
		{ 
			alert ("Silahkan Masukan Nama !"); 
			r_pegawai__nama.focus();
			return false; 
		}

else if (r_pnpt__kon_awal.value == "") 
		{ 
			alert ("Silahkan Masukan Tgl Kontrak Awal !"); 
			r_pnpt__kon_awal.focus();
			return false; 
		}
                
                
                
else if (r_pnpt__kon_akhir.value == "") 
		{ 
			alert ("Silahkan Masukan Tgl Kontrak Akhir !"); 
			r_pnpt__kon_akhir.focus();
			return false; 
		}
else if (r_pnpt__finger_print.value == "") 
{ 
        alert ("Silahkan Masukan ID Finger Print!"); 
        r_pnpt__finger_print.focus();
        return false; 
}
else if (r_pnpt__shift.value == "") 
{ 
        alert ("Silahkan Pilih Shift Karyawan!"); 
        r_pnpt__shift.focus();
        return false; 
}

                
else if (r_pnpt__aktif.value == "") 
		{ 
			alert ("Silahkan Pilih Aktivasi Karyawan !"); 
			r_pnpt__aktif.focus();
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
//----------------------- AJAX KTP-----------------------------//
function cari_kab_ktp(prop_id_ktp)
{
  //alert(prop_id_ktp)
if (prop_id_ktp != '') {
	http.open('get','index.php?get_prop_ktp=1&no_prop_ktp='+prop_id_ktp);
	http.onreadystatechange = handlechoice_kab_ktp; 
	http.send(null);
	} 
}

function handlechoice_kab_ktp(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kabupaten_ktp').innerHTML = a[0];
		
    }
}

function cari_kec_ktp(kab_id)
{
//alert(kab_id)
if (kab_id!= '') {
	http.open('get','index.php?get_kec_ktp=1&kab_id='+kab_id);
	http.onreadystatechange = handlechoice_kec_ktp; 
	http.send(null);
	} 
}

function handlechoice_kec_ktp(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kecamatan_ktp').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

function cari_kec2_ktp(kec_id_desa)
{
alert(kec_id_desa)
if (kec_id_desa!= '') {
	http.open('get','index.php?get_desa_ktp=1&kec_id='+kec_id_desa);
	http.onreadystatechange = handlechoice_kec2_ktp; 
	http.send(null);
	} 
}

function handlechoice_kec2_ktp(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
                 document.getElementById('ajax_kecamatan2_ktp').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

//-----------------------CLOSE AJAX KTP-----------------------------//

//----------------------- AJAX DOMISILI-----------------------------//
function cari_kab_alm(prop_id_alm)
{
  //alert(prop_id_alm)
if (prop_id_alm != '') {
	http.open('get','index.php?get_prop_alm=1&no_prop_alm='+prop_id_alm);
	http.onreadystatechange = handlechoice_kab_alm; 
	http.send(null);
	} 
}

function handlechoice_kab_alm(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kabupaten_alm').innerHTML = a[0];
		
    }
}

function cari_kec_alm(kab_id)
{
//alert(kab_id)
if (kab_id!= '') {
	http.open('get','index.php?get_kec_alm=1&kab_id='+kab_id);
	http.onreadystatechange = handlechoice_kec_alm; 
	http.send(null);
	} 
}

function handlechoice_kec_alm(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kecamatan_alm').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

function cari_kec2_alm(kec_id)
{
//alert(kec_id)
if (kec_id!= '') {
	http.open('get','index.php?get_desa_alm=1&kec_id='+kec_id);
	http.onreadystatechange = handlechoice_kec2_alm; 
	http.send(null);
	} 
}

function handlechoice_kec2_alm(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
                 document.getElementById('ajax_kecamatan2_alm').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}


//-----------------------CLOSE AJAX DOMISILI-----------------------------//




//------------------JS PILIH SUBCAB-----------//

function cari_subcab(subcab_id)
{
if (subcab_id != '') {
	http.open('get','index.php?get_subcab=1&no_subcab='+subcab_id);
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



//------------------JS AJAX SUBDEP-----------//subdep
function cari_subdep(subdep_id)
{
//alert (subdep_id)
if (subdep_id != '') {
	http.open('get','index.php?get_subdep=1&no_subdep='+subdep_id);
        //http.open('get','index.php?get_prop_ktp=1&no_prop_ktp='+prop_id_ktp);
	http.onreadystatechange = handlechoice_subdep; 
	http.send(null);
	} 
}

function handlechoice_subdep(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_subdep').innerHTML = a[0];
		
    }
}
//------------------CLOSE AJAX SUBDEP-----------//


function goCarikaryawan() {
    
			kode_cabang= document.frmCreate.kode_cabang.value;
                        tipe_pdrm= document.frmCreate.tipe_pdrm.value;
			window.open('../../../function/list_penempatan.php?kode_cabang='+kode_cabang+'&tipe_pdrm='+tipe_pdrm,null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
 			}


function goCarijabatan() {
    
			kode_cabang= document.frmCreate.kode_cabang.value;
                        tipe_pdrm= document.frmCreate.tipe_pdrm.value;
			window.open('../../../function/list_carijabatan.php?kode_cabang='+kode_cabang+'&tipe_pdrm='+tipe_pdrm,null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
 			}


//------------------JS PILIH SUBCAB2-----------//

function cari_subcab2(subcab_id)
{
    
if (subcab_id != '') {
	http.open('get','index.php?get_subcab2=1&no_subcab='+subcab_id);
	http.onreadystatechange = handlechoice_subcab2; 
	http.send(null);
	} 
}

function handlechoice_subcab2(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_subcabang2').innerHTML = a[0];
		
    }
}
//------------------CLOSE JS PILIH SUBCAB2-----------//

</SCRIPT>