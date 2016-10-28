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
if (jns_user.value == "") 
     {
         
         alert ("Pilih Level User !"); 
                jns_user.focus();
                return false; 
         
     }
     else if (kode_cabang.value == "") 
     {
         
         alert ("Pilih Cabang!"); 
                kode_cabang.focus();
                return false; 
         
     }
else if (user_first_name.value == "") 
        { 
                alert ("Silahkan Masukan Nama !"); 
                user_first_name.focus();
                return false; 
        }
 else if (user_last_name.value == "") 
     {
         
         alert ("Silahkan Masukan Nama Belakang !"); 
                user_last_name.focus();
                return false; 
         
     }
    
     
        else if (user_address.value == "") 
     {
         
         alert ("Silahkan Masukan Alamat !"); 
                user_address.focus();
                return false; 
         
     }
       else if (user_status.value == "") 
     {
         
         alert ("Silahkan Pilih level User !"); 
                user_status.focus();
                return false; 
         
     }
      else if (group_user.value == "") 
     {
         
         alert ("Silahkan Pilih Group user !"); 
                group_user.focus();
                return false; 
         
     }
     
     
     
     
else if (user_id.value == "") 
     {
         
         alert ("Silahkan Masukan User ID !"); 
                user_id.focus();
                return false; 
         
     }
 else if (user_password.value == "") 
     {
         
         alert ("Silahkan Masukan Password Anda !"); 
                user_password.focus();
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
	//<?php echo $field_name; ?>_code.value = "";
        
       
        
	user_first_name.value = "";
	user_id.value = "";
	op.value = "0";
	}
	doNavigateContentOver('index.php','mainFrame');
}
//-->


function cari(jenis_user)
{

if (jenis_user != '') {
	http.open('get','index.php?get_propinsi=1&jenis_user='+jenis_user);
	http.onreadystatechange = handlechoice3; 
	http.send(null);
	} 
}

function handlechoice3(){
if(http.readyState == 4)
	{ 
		var response = http.responseText;
		var a = response.split('^/&'); 
		document.getElementById('ajax_instansi').innerHTML = a[0];
       }
}


function goPemberikerja() {
  
			kode_cabang= document.frmCreate.kode_cabang.value;
			window.open('../../../function/list_daftar_user.php?kode_cabang='+kode_cabang+'',null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
 			}

</SCRIPT>