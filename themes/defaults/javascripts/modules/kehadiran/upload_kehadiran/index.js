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


//------------------SUBPENEMPATAN--------------||

function pilih_ext(subpenempatan_id)
{
//alert(subpenempatan_id);

if (subpenempatan_id != '') {
	http.open('get','index.php?get_subpenempatan=1&no_subpenempatan='+subpenempatan_id);
	http.onreadystatechange = handlechoice_subpenempatan;
	http.send(null);
	}
}
function handlechoice_subpenempatan(){
if(http.readyState == 4)
	{
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_subpenempatan').innerHTML = a[0];

    }
}



//------------------CLOSE PENEMPATAN-----------||


function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
             }
             
             
 function checkextensionxls() {
  var file = document.querySelector("#file_xls");
  if ( /\.(xls)$/i.test(file.files[0].name) === false ) { alert("Format Upload Salah Harus File excel 2003!");
  return true; }
}


function checkextensiondat() {
  var file = document.querySelector("#file_dat");
  if ( /\.(dat)$/i.test(file.files[0].name) === false ) { alert("Format Upload Salah Harus File Format (.dat) Dari Mesin secure!");
  return true; }


        
        

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
             else if (tipe_file.value == "") 
       { 
               alert ("Silahkan Tipe File !"); 
               tipe_file.focus();
               
               return false; 
       }
         

       else
       {
               submit();

           var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.open("POST", "engine.php", true);
            ajax.send(theForm);
               return true;
       }
}
	


}


//function uploadFile() {
//    alert('aaaa');
//    // membaca data file yg akan diupload, dari komponen 'fileku'
//    var file = document.getElementById("file_xls").files[0];
//    var theForm = new FormData();
//    theForm.append("file_xls", file);
//
//    // proses upload via AJAX disubmit ke 'upload.php'
//    // selama proses upload, akan menjalankan progressHandler()
//    var ajax = new XMLHttpRequest();
//    ajax.upload.addEventListener("progress", progressHandler, false);
//    ajax.open("POST", "engine.php", true);
//    ajax.send(theForm);
//}

function progressHandler(event){
    // hitung prosentase
    var percent = (event.loaded / event.total) * 100;
    // menampilkan prosentase ke komponen id 'progressBar'
    document.getElementById("progressBar").value = Math.round(percent);
    // menampilkan prosentase ke komponen id 'status'
   // document.getElementById("status").innerHTML = Math.round(percent)+"% Telah terupload".fontsize(2);
    // menampilkan file size yg tlh terupload dan totalnya ke komponen id 'total'
    document.getElementById("total").innerHTML = "Telah terupload "+event.loaded+" bytes dari "+event.total;
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









</SCRIPT>