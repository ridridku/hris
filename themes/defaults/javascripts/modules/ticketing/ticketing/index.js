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
 if (pengirim.value == "") 
                { 
                        alert ("Isi Nama Karyawan"); 
                        pengirim.focus();
                        return false; 
                }    
else if (modul_parent.value == "") 
                { 
                        alert ("Silahkan Isi Modul !"); 
                        modul_parent.focus();
                        return false; 
                }
else if (modul_child.value == "") 
                { 
                        alert ("Silahkan Pilih Sub Modul"); 
                        modul_child.focus();
                        return false; 
                }
 else if (keterangan.value == "") 
                { 
                        alert ("Isi Keterangan"); 
                        keterangan.focus();
                        return false; 
                }
 else if (status.value == "") 
                { 
                        alert ("Pilih Status "); 
                        status.focus();
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



//------------------JS AJAX SUBDEP-----------//subdep
function cari_subdep(subdep_id)
{
//alert (subdep_id)
if (subdep_id != '') {
	http.open('get','index.php?get_subdep=1&no_subdep='+subdep_id);
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
                        
 if(kode_cabang =='')
    {
           alert('Isi Dahulu Cabang!');
           return false; 
    }
else
{
    window.open('../../../function/list_idpeg.php?kode_cabang='+kode_cabang+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
}   
 }

function cek_id_pel() {
                      // kode_cabang= document.frmCreate.kode_cabang.value;
                        window.open('../../../function/list_mst_pelatihan.php',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
                       
                    }
                    
function cari_subcab2(subcab_id)
{
    
    if (subcab_id != '') {
            http.open('get','index.php?get_subcab2=1&no_subcab='+subcab_id);
            //http.open('get','index.php?get_prop_ktp=1&no_prop_ktp='+prop_id_ktp);
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
var err = 0;
var err_ = 0;

function formatangka(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}


function codename() {
    if(document.frmCreate.checkboxname.checked)
    {
         document.frmCreate.file_gambar.disabled=false;
         document.frmCreate.foto2.disabled=true;
    }
    else
    {
            document.frmCreate.file_gambar.disabled=true;
            document.frmCreate.foto2.disabled=false;
    }
    
    
    
}


</SCRIPT>