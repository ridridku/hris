<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Surat Undangan</title>
</head>
<link rel="stylesheet" type="text/css" href="styles/style_cetak.css">
<script language="JavaScript" src="js/EditGUI.js" type="text/javascript">
</script>
<script language="JavaScript" src="js/HttpClient.js" type="text/javascript"></script>
<br>

{if $Cetak==1}
<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="90%">
  <tr>
    <td width="7%">Propinsi</td>
    <td width="1%"><strong>:</strong></td>
    <td width="82%">{$Data[1]}</td>
  </tr>
  <tr>
    <td>Nama Ruas </td>
    <td><strong>:</strong></td>
    <td>{$Data[0]}</td>
  </tr>
  <tr>
    <td>Waktu</td>
    <td><strong>:</strong></td>
    <td>{$Data[2]}</td>
  </tr>
</table>
{/if}
<br>
<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
 
  <tr>
    <td width="2%">&nbsp;</td>
    <td width="98%" rowspan="6"><img src="?Menu={$ImgGraphJalan}"/></td>
  </tr>
  <tr>
    <td>2KI</td>
  </tr>
  <tr>
    <td>1KI</td>
  </tr>
  <tr>
    <td>1KA</td>
  </tr>
  <tr>
    <td>2KA</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<br>
<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
 
  
  <tr>
    <td>&nbsp;</td>
	<td><div align="left"><strong>2KI: Lajur 2 Kiri, 1KI: Lajur 1 Kiri, 1KA: Lajur 1 Kanan, 2KA: Lajur 2 Kanan</strong></div></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
	<td colspan="2" valign="middle"><img src="images/warna_lajur_1.JPG" /> : Lajur 1 &nbsp;&nbsp;&nbsp;&nbsp;<img src="images/warna_lajur_2.JPG" /> : Lajur 2</td>
  </tr>
</table>
{if $Cetak==1}
<input type="button" name="t3d" value="Print" onClick="HideThis(this);
	javascript:window.print();
"
 >
 {/if}

</body>
</html>