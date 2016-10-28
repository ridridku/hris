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
	if (kode_wna.value == "") 
		{ 
			alert ("Silahkan isi field kode wna !"); 
			kode_wna.focus();
			return false; 
		}
		else if (kode_negara.value == "") 
		{ 
			alert ("Silahkan isi field kode negara WNA !"); 
			kode_negara.focus();
			return false; 
		}
	else if (nama_wna.value == "") 
		{ 
			alert ("Silahkan isi field nama WNA !"); 
			nama_wna.focus();
			return false; 
		}
		
		else if (alamat_ind.value == "") 
		{ 
			alert ("Silahkan isi field alamat WNA di Dalam Negeri !"); 
			alamat_ind.focus();
			return false; 
		}
		else if (tlp_ind.value == "") 
		{ 
			alert ("Silahkan isi field telepon WNA di Dalam Negeri !"); 
			tlp_ind.focus();
			return false; 
		}
		else if (alamat_ln.value == "") 
		{ 
			alert ("Silahkan isi field alamat WNA di Luar Negeri !"); 
			alamat_ln.focus();
			return false; 
		}
		else if (tlp_ln.value == "") 
		{ 
			alert ("Silahkan isi field telepon WNA di Luar Negeri !"); 
			tlp_ln.focus();
			return false; 
		}
		else if (keterangan.value == "") 
		{ 
			alert ("Silahkan isi field Keterangan WNA !"); 
			keterangan.focus();
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
</SCRIPT>