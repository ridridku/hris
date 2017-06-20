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
  var numbers = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/;
  //  var numbers = ''^(-?0[.]\\d+)$|^(-?[1-9]+\\d*([.]\\d+)?)$|^0$;

function checkFrm(theForm){
with (theForm){
 
			submit();
			return true;
//		
}
	
	
}
// --------------------
function formatangka(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "," + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}


function formatdurasi(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = 2;
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




function goCarikaryawan() {
    
kode_cabang= document.frmCreate.kode_cabang.value;
     if(kode_cabang =='')
    {
           alert('Isi Dahulu Cabang!');
           return false; 
    } 
                      window.open('../../../function/list_surat_lembur.php?kode_cabang='+kode_cabang+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
                        }
                        
                        
function goCarikaryawan2() {
    
kode_cabang= document.frmCreate.kode_cabang.value;
  if(kode_cabang =='')
    {
           alert('Isi Dahulu Cabang!');
           return false; 
    } 
         window.open('../../../function/list_surat_lembur2.php?kode_cabang='+kode_cabang+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
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


function cek_lembur() {

            level_id= document.frmCreate.level_id.value;
            lembur_tanggal= document.frmCreate.lembur_tanggal.value;
            lembur_durasi= document.frmCreate.lembur_durasi.value;
            id_pegawai= document.frmCreate.karyawan_id.value;
            
  if(level_id =='')
    {
           alert('Isi Nama Karyawan!');
           return false; 
    }else if(lembur_tanggal=='')
    {
        
         alert('Isi Dahulu tgl Lembur!');
         return false; 
    }
    else if(lembur_durasi=='')
    {
        
         alert('Isi Jam Lembur !');
         return false; 
    }
  
  
        
    
     else {          
            http.open('get','index.php?cek_lembur=1&level_id='+level_id+'&lembur_tanggal='+lembur_tanggal+'&lembur_durasi='+lembur_durasi+'&id_pegawai='+id_pegawai);
           http.onreadystatechange = handlechoice_ceklembur; 
            http.send(null);

 			}
                        
                  
 }
 
 function handlechoice_ceklembur(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('lembur_cost').innerHTML = a[0];
		
    }
}






function CheckAll(chk)
{
for (i = 0; i < chk.length; i++)
	chk[i].checked = true ;
}

function UnCheckAll(chk)
{
for (i = 0; i < chk.length; i++)
	chk[i].checked = false ;
}










</SCRIPT>