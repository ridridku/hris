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
	if (tanggal.value == "") 
		{ 
			alert ("Silahkan isi field tanggal !"); 
			tanggal.focus();
			return false; 
		}
	else if (no_propinsi.value == "") 
		{ 
			alert ("Silahkan isi field Data Propinsi !"); 
			no_propinsi.focus();
			return false; 
		}
	else if (no_kabupaten.value == "") 
		{ 
			alert ("Silahkan isi field Data Kabupaten !"); 
			no_kabupaten.focus();
			return false; 
		}
	else if (no_ruas.value == "") 
		{ 
			alert ("Silahkan isi field no ruas !"); 
			no_ruas.focus();
			return false; 
		}
	else if (nama_ruas.value == "") 
		{ 
			alert ("Silahkan isi field nama ruas !"); 
			nama_ruas.focus();
			return false; 
		}
	else if (panjang.value == "") 
		{ 
			alert ("Silahkan isi field panjang ruas !"); 
			panjang.focus();
			return false; 
		}	
	else if (lebar.value == "") 
		{ 
			alert ("Silahkan isi field lebar ruas !"); 
			lebar.focus();
			return false; 
		}									
	else 
		{
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
// --------------------

function resetFrm(theForm){
with(theForm){
	//kode_bahan_jembatan.value = "";
	//nama_bahan_jembatan.value = "";
	op.value = "0";
	}
	doNavigateContentOver('index.php?<?="mod_id=".$_GET[mod_id]."&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&search=1&jns_jln=".$_GET[jns_jln];?>','mainFrame');
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






</SCRIPT>