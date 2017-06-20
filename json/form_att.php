<?PHP

require_once('../includes/db.conf.php');
require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');
$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;1800000
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

 
?>
<head>
<script>
function uploadFile() {
    // membaca data file yg akan diupload, dari komponen 'fileku'
    var file = document.getElementById("file").files[0];
    var formdata = new FormData();
    formdata.append("file", file);

    // proses upload via AJAX disubmit ke 'upload.php'
    // selama proses upload, akan menjalankan progressHandler()
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.open("POST", "json_absensi_file.php", true);
    ajax.send(formdata);
}

function progressHandler(event){
    // hitung prosentase
    var percent = (event.loaded / event.total) * 100;
    // menampilkan prosentase ke komponen id 'progressBar'
    document.getElementById("progressBar").value = Math.round(percent);
    // menampilkan prosentase ke komponen id 'status'
    document.getElementById("status").innerHTML = Math.round(percent)+"% telah terupload";
    // menampilkan file size yg tlh terupload dan totalnya ke komponen id 'total'
    document.getElementById("total").innerHTML = "Telah terupload "+event.loaded+" bytes dari "+event.total;
}

</script>
</head>
<form action="json_absensi_attlog.php" method="POST"  enctype="multipart/form-data" >
<input type="text" name="periode" value="2016-01-01">
<input type="text" name="kunci" value="tmw2016">
<input type="file" NAME="file_absen" id="file"> 
<hr>
<input type="submit" onclick="uploadFile()" value="upload">
   <progress id="progressBar" max="100" style="width: 300px;" value="0"></progress>
<h3 id="status">
</h3>
<div id="total">
</div>
</form>

