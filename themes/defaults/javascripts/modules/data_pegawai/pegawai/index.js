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


function angka(e) {
  if (!/^[0-9]+$/.test(e.value)) {
    e.value = e.value.substring(0,e.value.length-1);
  }
}

function checkFrm(theForm){
with (theForm){
      if(r_pegawai__tgl_masuk.value == "") 
        { 
                alert ("Silahkan Tgl Masuk Karyawan  !"); 
                r_pegawai__tgl_masuk.focus();
                return false; 
        }
	else if (r_pegawai__nama.value == "") 
        { 
                alert ("Silahkan Masukan Nama !"); 
                r_pegawai__nama.focus();
                return false; 
        }
    
        else if (r_pegawai__tmpt_lahir.value == "") 
        { 
                alert ("Silahkan Isi Tempat Lahir Karyawan!"); 
                r_pegawai__tmpt_lahir.focus();
                return false; 
        }
		
	 else if (r_pegawai__tgl_lahir.value == "") 
        { 
                alert ("Silahkan isi Tgl Lahir !"); 
                r_pegawai__tgl_lahir.focus();
                return false; 
        }
        else if (r_pegawai__jk.value == "") 
		{ 
			alert ("Silahkan isi Jenis Kelamin !"); 
			r_pegawai__jk.focus();
			return false; 
		}
         else if (r_pegawai__ktp.value == "") 
		{ 
			alert ("Silahkan isi No KTP !"); 
			r_pegawai__ktp.focus();
			return false; 
		}
        else if (r_pegawai__agama.value == "") 
           { 
                   alert ("Silahkan isi Agama !"); 
                   r_pegawai__agama.focus();
                   return false; 
           }    
              
        else if (r_pegawai__ktp_prov.value == "") 
           { 
                   alert ("Silahkan isi Propinsi KTP !"); 
                   r_pegawai__ktp_prov.focus();
                   return false; 
           }    
           
        else if (r_pegawai__ktp_kab.value == "") 
           { 
                   alert ("Silahkan isi Kabupaten KTP !"); 
                   r_pegawai__ktp_kab.focus();
                   return false; 
           }    
        
        else if (r_pegawai__ktp_kec.value == "") 
		{ 
			alert ("Silahkan isi kecamatan KTP !"); 
			r_pegawai__ktp_kec.focus();
			return false; 
		}
                
          
        else if (r_pegawai__ktp_desa.value == "") 
		{ 
			alert ("Silahkan isi Desa KTP  !"); 
			r_pegawai__ktp_desa.focus();
			return false; 
		}       
                
          else if (r_pegawai__pend_tgl_lulus.value == "") 
		{ 
			alert ("Silahkan isi Tgl Lulus  !"); 
			r_pegawai__pend_tgl_lulus.focus();
			return false; 
		}    
                 else if (r_pegawai__no_bpjs.value == "") 
		{ 
			alert (" NO BPJS KETENEGA KERJAAN HARUS ADA  !"); 
			r_pegawai__no_bpjs.focus();
			return false; 
		}    
                   else if (r_pegawai__bank1.value == "") 
		{ 
			alert ("NO REKENING  BANK HARUS ADA !"); 
			r_pegawai__bank1.focus();
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

//-----------------------OPEN  AJAX ORTU-----------------------------//r_pegawai__ortu_prov
function cari_kab_ortu(prop_id_ortu)
{
 //alert(prop_id_ortu)
if (prop_id_ortu != '') {
	http.open('get','index.php?get_prop_ortu=1&no_prop_ortu='+prop_id_ortu);
	http.onreadystatechange = handlechoice_kab_ortu; 
	http.send(null);
	} 
}

function handlechoice_kab_ortu(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_kabupaten_ortu').innerHTML = a[0];
		
    }
}

function cari_kec_ortu(kab_id)
{
//alert(kab_id)
if (kab_id!= '') {
	http.open('get','index.php?get_kec_ortu=1&kab_id='+kab_id);
	http.onreadystatechange = handlechoice_kec_ortu; 
	http.send(null);
	} 
}

function handlechoice_kec_ortu(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kecamatan_ortu').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

function cari_kec2_ortu(kec_id)
{

if (kec_id!= '') {
	http.open('get','index.php?get_desa_ortu=1&kec_id='+kec_id);
	http.onreadystatechange = handlechoice_kec2_ortu; 
	http.send(null);
	} 
}

function handlechoice_kec2_ortu(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
                 document.getElementById('ajax_kecamatan2_ortu').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}
//-----------------------CLOSE  AJAX ORTU-----------------------------//



//-----------------------OPEN AJAX PASANGAN-----------------------------//
function cari_kab_pas(prop_id_pas)
{
//alert(prop_id_pas)
if (prop_id_pas != '') {
	http.open('get','index.php?get_prop_pas=1&no_prop_pas='+prop_id_pas);
	http.onreadystatechange = handlechoice_kab_pas; 
	http.send(null);
	} 
}

function handlechoice_kab_pas(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_kabupaten_pas').innerHTML = a[0];
		
    }
}

function cari_kec_pas(kab_id_pas)
{
//alert(kab_id)
if (kab_id_pas!= '') {
	http.open('get','index.php?get_kec_pas=1&kab_id_pas='+kab_id_pas);
	http.onreadystatechange = handlechoice_kec_pas; 
	http.send(null);
	} 
}

function handlechoice_kec_pas(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_kecamatan_pas').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}


function cari_desa_pas(kec_id)
{
    //alert(kec_id)
if (kec_id!= '') {
	http.open('get','index.php?get_desa_pas=1&kec_id='+kec_id);
	http.onreadystatechange = handlechoice_desa_pas; 
	http.send(null);
	} 
}

function handlechoice_desa_pas(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
                 document.getElementById('ajax_desa_pas').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

//-----------------------CLOSE AJAX PASANGAN-----------------------------//



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


function cari_jenis2(prop_id)
{
//alert(prop_id);
if (prop_id != '') {
	http.open('get', 'index.php?get_jenis_sektor=1&no_prop='+prop_id);
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

//------------------JS PILIH SUBCAB2-----------//

function cari_subcab2(subcab_id)
{

if (subcab_id != '') {
	http.open('get','index.php?q=1&y='+subcab_id);
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

function codename() {


    if(document.frmCreate.checkboxname.checked)
    {
         document.frmCreate.file_foto.disabled=false;
         document.frmCreate.foto2.disabled=true;
          
           
    }
    else
    {
           document.frmCreate.file_foto.disabled=true;
           document.frmCreate.foto2.disabled=false;
    }
    
    
    
}
//------------------CLOSE JS PILIH SUBCAB2-----------//

</SCRIPT>