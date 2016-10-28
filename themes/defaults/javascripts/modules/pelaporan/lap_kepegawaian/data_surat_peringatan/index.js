<SCRIPT LANGUAGE="JavaScript">
<!--

<?php if($_GET[opt]=="1") { ?> 
document.frmList1.op.value = '1';
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

function checkFrm(frmList1){
with (frmList1){
      if (kode_cabang_cari.value == "") 
		{ 
			alert ("Silahkan Pilih Cabang !"); 
			kode_cabang_cari.focus();
			return false; 
		}
//      else  if (kode_subcab_cari.value == "") 
//		{ 
//			alert ("Silahkan Pilih Sub Cabang !"); 
//			kode_subcab_cari.focus();
//			return false; 
//		}
//         else  if (departemen_cari.value == "") 
//		{ 
//			alert ("Silahkan Pilih Departemen !"); 
//			departemen_cari.focus();
//			return false; 
//		}
                
	else if (r_pegawai__nama.value == "") 
		{ 
			alert ("Silahkan Cari Nama Dan Nik !"); 
			r_pegawai__nama.focus();
			return false; 
		}
             
                               

                
                
                
                
										
	else
		{
			submit();
			return true;
		}
}}

// --------------------


function checkSubmit(){

<?php
if (substr($result->fields[idmod], 2,1)!="1"){
?>
	alert("<?php echo _ERR_NOT_AUTH_ENTRY ; ?>");
	doNavigateContentOver('index.php','mainFrame');
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
// --------

function resetFrm(frmList1){
with(frmList1){
    
	//kode_bahan_jembatan.value = "";
	//nama_bahan_jembatan.value = "";
//        kode_cabang_cari= document.frmList1.kode_cabang_cari.value;
//kode_subcab_cari= document.frmList1.kode_subcab_cari.value;
//departemen_cari= document.frmList1.departemen_cari.value
	op.value = "0";
	}
	doNavigateContentOver('index.php?<?="mod_id=".$_GET[mod_id]."&kode_cabang_cari=".$_GET[kode_cabang_cari];?>','mainFrame');
}

function cari_kabupaten(no_propinsi)
{

if (no_propinsi != '') {
	http.open('get', 'index.php?get_propinsi=1&no_propinsi='+no_propinsi);
	http.onreadystatechange = handlechoice; 
	http.send(null);
	} 
}

function handlechoice(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_kabupaten').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

function cari_kabupaten2(no_propinsi)
{

if (no_propinsi != '') {
	http.open('get', 'index.php?get_propinsi=1&no_propinsi='+no_propinsi);
	http.onreadystatechange = handlechoice2; 
	http.send(null);
	} 
}

function handlechoice2(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_kabupaten2').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}

function openPopUp_Print(str_location, str_title) {
	var win_width = 850;
	var win_height =530;
	w_left = ( screen.width / 2 ) - ( win_width / 2 );
	w_top = ( screen.height / 2 ) - ( win_height / 2 );
	
	if (str_title || !str_title.closed){
	childwindow = window.open(str_location,str_title,"toolbar=no, location=0,directories=no,status=no,menubar=0, scrollbars=yes,resizable=0,copyhistory=0,width="+win_width+",height="+win_height+",top="+w_top+",left="+w_left);
	window.onfocus = function(){if (childwindow.closed == false || childwindow.blur == true){childwindow.focus();};};
	}
}
//

function printPage()
{
    document.getElementById('noprint').style.visibility = 'hidden';
    // Do print the page
    if (typeof(window.print) != 'undefined') {
        window.print();
    }
    document.getElementById('noprint').style.visibility = '';
}
//-->



function cari_ruas(kode_proyek)
{

if (kode_proyek != '') {
	http.open('get', 'index.php?get_proyek=1&kode_proyek='+kode_proyek);
	http.onreadystatechange = handlechoice2; 
	http.send(null);
	}
}

function handlechoice2(){
if(http.readyState == 4)
	{
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_ruas').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}





function cari_proyek(tahun,kode_instansi)
{
//alert (tahun);
if (tahun != '') {
	http.open('get', 'index.php?get_tahun=1&tahun='+tahun+'&kode_instansi='+kode_instansi);
	http.onreadystatechange = handlechoice; 
	http.send(null);
	}
}

function handlechoice(){
if(http.readyState == 4)
	{
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_proyek').innerHTML = a[0];
		 
    }
}




function cari_info_proyek(kode_instansi,tahun)
{

if (tahun != '') {
	http.open('get', 'index.php?get_info_tahun=1&tahun='+tahun+'&kode_instansi='+kode_instansi);
	http.onreadystatechange = handlechoice; 
	http.send(null);
	}
}

function handlechoice(){
if(http.readyState == 4)
	{
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_proyek').innerHTML = a[0];
		//document.getElementById('ajax_lokasi').innerHTML = a[1];
		 
    }
}

//------------------JS PILIH SUBCAB-----------//

function cari_subcab(subcab_id)
{

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




function goCarikaryawan() {
			//document.frm.KodeEselon1.value='';
			//document.frm.NamaEselon1.value='';
kode_cabang_cari= document.frmList1.kode_cabang_cari.value;
//kode_subcab_cari= document.frmList1.kode_subcab_cari.value;
//departemen_cari= document.frmList1.departemen_cari.value;
           
 window.open('../../../../function/list_sp_detail.php?kode_cabang_cari='+kode_cabang_cari,null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
//  window.open('../../../../function/list_sp_detail.php?kode_cabang_cari='+kode_cabang_cari+'&kode_subcab_cari='+kode_subcab_cari+'&departemen_cari='+departemen_cari+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
 			
                            }
</SCRIPT>