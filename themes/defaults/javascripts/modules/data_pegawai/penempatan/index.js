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
 else if (kode_departemen_new.value == "")
       {
               alert ("Silahkan Pilih Departemen !");
               kode_departemen_new.focus();
               return false;
       }

else if (kode_subdep.value == "")
       {
               alert ("Silahkan Pilih Sub Departemen !");
               kode_subdep.focus();
               return false;
       }
else if (r_jabatan.value == "")
       {
               alert ("Silahkan Pilih Jabatan !");
               r_jabatan.focus();
               return false;
       }
  else if (r_pnpt__status.value == "")
       {
               alert ("Silahkan Pilih Status Karyawan !");
               r_pnpt__status.focus();
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


 else if (r_pnpt__tipe_salary.value == "")
       {
               alert ("Silahkan Pilih Tipe Salary !");
               r_pnpt__tipe_salary.focus();
               return false;
       }
       
  else if (tgl_sk.value == "")
       {
               alert ("Isi Tgl SK !");
               tgl_sk.focus();
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
function cari_jabatan(subdep)
{
         
if (subdep != '') {
	http.open('get','index.php?get_jab_cari=1&subdep='+subdep);
	http.onreadystatechange = handlechoice_cari_jabatan;
	http.send(null);
	}
}

function handlechoice_cari_jabatan(){
if(http.readyState == 4)
	{
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_jabatan').innerHTML = a[0];

        }
}









//------------------JS PILIH SUBCAB-----------//

function cari_subcab(subcab_id)
{
if (subcab_id != '')
        {
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
    r_pnpt__status= document.frmCreate.r_pnpt__status.value;
    tipe_pdrm= document.frmCreate.tipe_pdrm.value;
    kode_subcab_cari= document.frmCreate.kode_subcab_cari.value;
   kode_departemen_new= document.frmCreate.kode_departemen_new.value;
   kode_subdep= document.frmCreate.kode_subdep.value;
    if(kode_cabang =='')
    {
           alert('Isi Dahulu Cabang!');
           return false;
    }
    else if(kode_subcab_cari=='')
    {
         alert('Isi Status Sub Cabang!');
         return false;
    }
    else if(kode_departemen_new=='')
    {
         alert('Isi Status Departemen!');
         return false;
    }
     else if(kode_subdep=='')
    {
         alert('Isi Status Sub Departemen!');
         return false;
    }

    else if(r_pnpt__status=='')
    {
         alert('Isi Status Karyawan!');
         return false;
    }
    else if(tipe_pdrm=='')
    {
         alert('Isi Keterangan Penempatan !');
         return false;
    }

    else{
             var kode_cabang= document.frmCreate.kode_cabang.value;
             var tipe_pdrm= document.frmCreate.tipe_pdrm.value;

// Encode the String
                var kode_cabang_encoded = base64_encode(kode_cabang);
                var tipe_pdrm_encoded = base64_encode(tipe_pdrm);

			window.open('../../../function/list_penempatan.php?q='+kode_cabang_encoded+'&y='+tipe_pdrm_encoded,null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
                 
    }
  
}


function goCarijabatan() {

			kode_cabang= document.frmCreate.kode_cabang.value;
                        tipe_pdrm= document.frmCreate.tipe_pdrm.value;
			window.open('../../../function/list_carijabatan.php?kode_cabang='+kode_cabang+'&tipe_pdrm='+tipe_pdrm,null,'height=500,width=550,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')
 			}

function cek_jabatan() {

            r_pegawai__id= document.frmCreate.r_pegawai__id.value;
            if (r_pegawai__id != '') {
            http.open('get','index.php?cek_list=1&cek_jabatan='+r_pegawai__id);
            http.onreadystatechange = handlechoice_cekjabatan;
            http.send(null);
 			}
 }

 function handlechoice_cekjabatan(){
if(http.readyState == 4)
	{
		var response = http.responseText;
		var a = response.split('^/&');
		document.getElementById('ajax_cekjabatan').innerHTML = a[0];

    }
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



//------------------SUBPENEMPATAN--------------||

function cari_subpenempatan(subpenempatan_id)
{


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
//decode encode base64 javascript
function base64_encode( str )
    {
        if (window.btoa) // Internet Explorer 10 and above
            return window.btoa(unescape(encodeURIComponent( str )));
        else
        {
            // Cross-Browser Method (compressed)
            // Create Base64 Object
            var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
            // Encode the String
            return Base64.encode(unescape(encodeURIComponent( str )));
        }
    }

    function base64_decode( str )
    {
        if (window.atob) // Internet Explorer 10 and above
            return decodeURIComponent(escape(window.atob( str )));
        else
        {
            // Cross-Browser Method (compressed)
            // Create Base64 Object
            var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
            // Encode the String
            return decodeURIComponent(escape(Base64.decode( str )));
        }
    }
</SCRIPT>
