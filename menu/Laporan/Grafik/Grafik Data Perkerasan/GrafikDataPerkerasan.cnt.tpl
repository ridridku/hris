<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Cetak Data</title>
</head>
<link rel="stylesheet" type="text/css" href="styles/style_cetak.css">
<script language="JavaScript" src="js/EditGUI.js" type="text/javascript">
</script>
<script language="JavaScript" src="js/HttpClient.js" type="text/javascript"></script>
<form action="index.php?Menu={$Action}" method="post">
<br>
{if $Cetak==true}
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
    <td width="2%" style="font-size:40px" align="center">{$lajur}</td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphKM}"/></td>
  </tr>
  <tr>
    <td width="2%" style="font-size:10px" align="right"><img src="index.php?Menu={$ImgGraphKeterangan}"/></td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphJalan}"/></td>
  </tr>
  
</table>
<br>
<br>
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
    <td width="34%" >
	</td>
  </tr>
</table>

<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
  <tr>
    <td width="2%" style="font-size:10px"  >&nbsp;</td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphKmPer10}"/></td>
  </tr>

  <tr>
    <td width="2%" style="font-size:10px"  ><img src="index.php?Menu={$ImgGraphKeterangan}"/></td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphJalanKe}"/></td>
  </tr>
  <tr>
    <td width="2%" style="font-size:10px"  >&nbsp;</td>
	 <td width="98%">&nbsp;</td>
  </tr>
</table>

<br>
<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
  <tr>
    <td width="8%" >Tahun &nbsp;&nbsp;&nbsp;&nbsp;	</td>
	 <td width="92%"><table width="40%" border="0">
       <tr>
         <td style="border:1px outset white;" bgcolor="#00FFFF" height="30" width="90">&nbsp;</td>
         <td>{$tahun}</td>
         <td style="border:1px outset white;" bgcolor="#00FF33" width="90">&nbsp;</td>
         <td>{$tahun-1}</td>
         <td style="border:1px outset white;" bgcolor="#FFFF00" width="90">&nbsp;</td>
         <td>{$tahun-2}</td>
         <td style="border:1px outset white;" bgcolor="#FF9900" width="90">&nbsp;</td>
         <td>{$tahun-3}</td>
         <td style="border:1px outset white;" bgcolor="#FF0000" width="90">&nbsp;</td>
         <td>{$tahun-4}</td>
         <td style="border:1px outset white;" bgcolor="#FF00CC" width="90">&nbsp;</td>
         <td>&lt;{$tahun-5}</td>
       </tr>
     </table></td>
  </tr>
</table>

<!--<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
 

  <tr>
        <td width="10%">&nbsp;</td>
        <td>Tahun</td>
  </tr>
      
      <tr>
        <td style="border:1px outset white;" bgcolor="#00FFFF">&nbsp;</td>
        <td>{$tahun}</td>
      </tr>
      <tr>
        <td style="border:1px outset white;" bgcolor="#00FF33">&nbsp;</td>
        <td>{$tahun-1}</td>
      </tr>
      <tr>
        <td style="border:1px outset white;" bgcolor="#FFFF00">&nbsp;</td>
        <td>{$tahun-2}</td>
      </tr>
	  <tr>
        <td style="border:1px outset white;" bgcolor="#FF9900">&nbsp;</td>
        <td>{$tahun-3}</td>
      </tr>
	  
	  <tr>
        <td style="border:1px outset white;" bgcolor="#FF0000">&nbsp;</td>
        <td>  {$tahun-4}</td>
      </tr>
	  <tr>
        <td style="border:1px outset white;" bgcolor="#FF00CC"></td>
        <td><{$tahun-5}</td>
      </tr>
  
</table>-->


<br>
{if $Cetak==1}
<input type="button" name="t3d" value="Print" onClick="HideThis(this);
	javascript:window.print();
"
 >
{/if}

</body>
</html>