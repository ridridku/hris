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
<form action="index.php?Menu={$Action}" method="post">
<br>

<br>

<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
  <tr>
    <td width="2%" style="font-size:10px"  >&nbsp;</td>
	 <td width="98%">&nbsp;</td>
  </tr>

  <tr>
    <td width="2%" style="font-size:10px"  ><img src="index.php?Menu={$ImgGraphKeterangan}"/></td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphJalan}"/></td>
  </tr>
  <tr>
    <td width="2%" style="font-size:10px"  >&nbsp;</td>
	 <td width="98%">&nbsp;</td>
  </tr>
</table>
	
<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="90%">
  <tr> 
    <td width="16%" id="control_1">Detail Kilometer Ke : </td>
    <td width="50%" id="control_2" >
		<select name="km_ke">
			{section name=x loop=$jumlah} 
			<option value="{$smarty.section.x.index+1}">{$smarty.section.x.index+1}</option>			
			{/section}
			<option value="{$Km_Ke}" selected="selected">{$Km_Ke}</option>
		</select>
		<input type="submit" name="submit" value="submit">		
	</td>
    <td width="34%" ></td>
  </tr>
</table>

<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
  <tr>
    <td width="2%" style="font-size:10px"  >&nbsp;</td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphKmPer10}"/></td>
  </tr>

  <tr>
    <td width="2%" style="font-size:10px"  >2KI<br>1KI<br>1KA<br>2KA</td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphJalanKe}"/></td>
  </tr>
  <tr>
    <td width="2%" style="font-size:10px"  >&nbsp;</td>
	 <td width="98%">&nbsp;</td>
  </tr>
</table>


<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:3px solid balck;" width="95%">
 
 <tr>
    <td ><table width="72%" border=0 cellspacing=5 cellpadding=0 style="border:3px solid black;">
      <tr>
        <td width="5%">Kondisi: </td>
        <td>&nbsp;</td>
        <td><strong>Lajur Kiri 2</strong> </td>
        <td><strong>Lajur Kiri 1</strong> </td>
        <td><strong>Lajur Kanan 1</strong> </td>
        <td><strong>Lajur Kanan 2</strong> </td>
        <td><strong>Total</strong></td>
        <td><strong>Persentase</strong></td>
      </tr>
      <tr>
        <td style="border:1px outset white;" bgcolor="#00FFFF"></td>
        <td>Baik</td>
        <td>{$DataAwal[1]} Km </td>
        <td>{$DataAwal[0]} Km</td>
        <td>{$DataAwal[2]} Km</td>
        <td>{$DataAwal[3]} Km</td>
        <td>{$DataAwal[16]} Km</td>
        <td>{$DataAwal[20]}%</td>
      </tr>
      <tr>
        <td style="border:1px outset white;" bgcolor="#00FF33">&nbsp;</td>
        <td>Sedang</td>
        <td>{$DataAwal[5]} Km</td>
        <td>{$DataAwal[4]} Km</td>
        <td>{$DataAwal[6]} Km</td>
        <td>{$DataAwal[7]} Km</td>
        <td>{$DataAwal[17]} Km</td>
        <td>{$DataAwal[21]}%</td>
      </tr>
      <tr>
        <td style="border:1px outset white;" bgcolor="#FFFF00">&nbsp;</td>
        <td>Rusak Ringan</td>
        <td>{$DataAwal[9]} Km</td>
        <td>{$DataAwal[8]} Km</td>
        <td>{$DataAwal[11]} Km</td>
        <td>{$DataAwal[10]} Km</td>
        <td>{$DataAwal[18]} Km</td>
        <td>{$DataAwal[22]}%</td>
      </tr>
      <tr>
        <td style="border:1px outset white;" bgcolor="#FF0000">&nbsp;</td>
        <td>Rusak Berat </td>
        <td>{$DataAwal[13]}Km</td>
        <td>{$DataAwal[12]} Km</td>
        <td>{$DataAwal[15]}Km</td>
        <td>{$DataAwal[14]} Km</td>
        <td>{$DataAwal[19]} Km</td>
        <td>{$DataAwal[23]}%</td>
      </tr>
    </table></td>
</tr>
</table>

<br>
<br>
<br>
<br>

<br>

<br>


</body>
</html>