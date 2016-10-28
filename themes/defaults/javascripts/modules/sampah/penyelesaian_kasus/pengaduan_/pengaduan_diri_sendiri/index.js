<SCRIPT LANGUAGE="JavaScript">

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
	 
 if (wni_non_tki.value == "") 
		{ 
			alert ("Silahkan Pilih Kategori Kasus !"); 
			wni_non_tki.focus();
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
// --------------------

function resetFrm(theForm){
with(theForm){

	op.value = "0";
	}
	doNavigateContentOver('index.php?mod_id=<?=$_GET[mod_id];?>','mainFrame');
}

function cari_wni(kode_wni)
{
	alert(kode_wni);
if (kode_wni != '') {
	http.open('get', 'index.php?get_wni=1&kode_wni='+kode_wni);
	http.onreadystatechange = handlechoice_kab; 
	http.send(null);
	} 
}

function handlechoice_kab(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		 var a = response.split('^/&');
		document.getElementById('ajax_nama_wni').innerHTML = a[0];
		//frmCreate.nama_lengkap.focus();
    }
}


function pilih_kasus(kategory) {
	alert(kategori);
	if (kategory ==1) {
		http.open('get', 'wni_non_tki.php?get_kategori=1&kategory='+kategory);
		http.onreadystatechange = handlechoice_kategori; 
		http.send(null);
		} 	
}

function handlechoice_kategori(){
	if(http.readyState == 4)
		{ 
			var response = http.responseText;
			 var a = response.split('^/&');
			document.getElementById('ajax_input_kategory').innerHTML = a[0];
			//frmCreate.nama_lengkap.focus();
	    }
	}



function display(obj,id1,id2) {
	alert('aaaaaaaaaaaaaaa');
	txt = obj.options[obj.selectedIndex].value;
	document.getElementById(id1).style.display = 'none';
	document.getElementById(id2).style.display = 'none';


	if ( txt.match(id1) ) {
	document.getElementById(id1).style.display = 'block';
	}
	if ( txt.match(id2) )
	 {
	document.getElementById(id2).style.display = 'block';
	}
	}


</SCRIPT>