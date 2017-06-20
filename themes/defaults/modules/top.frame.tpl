<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
 </script>
 <!-- 1800000000 30 minutes
 60000000  1 Menit
 30 minutes->1800 detik->1800000 millisecond -->
 <script>
//     $(document).ready(function(){
// setInterval(function(){cache_clear()},1800000);
// });
// function cache_clear()
//{
 //window.location.reload(true);
// window.location.href = '../modules/logout.php';

// }
</script>
<title><!--{$TITLE}--></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body leftmargin="0" topmargin="0" style="background: url('<!--{$HREF_IMG_PATH}-->/common/global_bg.jpg');">
<table width=60% border="0">

  <tr style="font-style: italic; font-size:12;color:blue;">
    <th width="18" scope="row"></th>
    <td width="31" align="center" ><img class="pngfix" align="absmiddle" src="http://hris.tmw.co.id/hris/themes/defaults/images/icon/card_address.png"></td>
    <td width="77" ><!--{$SESSION_NAMA}--></td>
    <td width="504">Periode aktif absensi : <!--{$PERIODE_AWAL|date_format:"%d-%B-%Y"}--> s/d <!--{$PERIODE_AKHIR|date_format:"%d-%B-%Y"}--> &nbsp;&nbsp;&nbsp;<font color="#003fff"><br>Infomasi : Gunakan<FONT style="font-style: italic; font-size:15;color:#ff0800;"> Google Chrome</font> Untuk yang tampilan Lebih Baik </td>
    <td width="13">&nbsp;</td>
  </tr>
  <tr style="font-style: italic; font-size:12;color:blue;">
    <th colspan="4" scope="row"><img src="<!--{$HREF_IMG_PATH}-->/common/bg.gif" /></th>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
