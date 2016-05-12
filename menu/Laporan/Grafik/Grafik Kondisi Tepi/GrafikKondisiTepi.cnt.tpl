<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Cetak Grafik Tepi Jalan</title>
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
    <td width="2%" style="font-size:10px" align="right"><img src="index.php?Menu={$ImgGraphKeterangan}"/></td>
	 <td width="98%"><img src="index.php?Menu={$ImgGraphJalan}"/></td>
  </tr>
  
</table>
<br>
<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
 
 <tr>
    <td height="10%" colspan="2"><b>------------------------------------------------Keterangan----------------------------------------------------------------------------------------------------------------------------------------------</b></td>
  </tr>
<tr>
    <td width="8%" height="10%">Lajur</td>
	 <td width="88%" height="10%"><b>:</b> {section name=x loop=$Lajur}{$Lajur[x][0]} : {$Lajur[x][1]}{if !$smarty.section.x.last},
{/if} {/section}</td>
</tr>
<tr>
    <td >Non Perkerasan </td>
	 <td><b>:</b> {section name=x loop=$NonPerkerasan}{$NonPerkerasan[x][0]} : {$NonPerkerasan[x][1]}{if !$smarty.section.x.last}, {/if} {/section}</td>
</tr>
</table>


<br>
<table  border=0 cellspacing=5 cellpadding=0 align="center" style="background-color:#FFFFFF;border:1px solid white;" width="95%">
 
		  
		<tr>
			<td ><table width="35%" style="background-color:#FFFFFF;border:1px solid white;" >
  <tr >
    <td valign="top">
	<table  border=0 cellspacing=5 cellpadding=0 align="left" style=" background-color:#FFFFFF;border:1px solid white;" width="15%">
  <tr height="5">
    <td width="30%">Bahu<b>&nbsp;:</b></td>
	   
		<td align="left"></td>
	  </tr> 
	   {section name=x loop=$Bahu}
			  <tr >
				<td style="border:1px outset white;" bgcolor={$Bahu[x].warna}>				
				<td width="80%">{$Bahu[x].nama}</td>
				
			  </tr> 
		{/section} 
	 
	</table>
	</td>
    <td valign="top">
	<table  border=0 cellspacing=5 cellpadding=0 align="left" style=" background-color:#FFFFFF;border:1px solid white;">
  <tr>
    <td>Drainase<b>&nbsp;:</b></td>
   
    <td align="left"></td>
  </tr> 
	{section name=x loop=$Drainase}
	  <tr >
		<td style="border:1px outset white;" bgcolor={$Drainase[x].warna}>				
		<td width="80%">{$Drainase[x].nama}</td>
	  </tr> 
	{/section} 
</table>
	</td>
	<td valign="top">
	<table  border=0 cellspacing=5 cellpadding=0 align="left" style=" background-color:#FFFFFF;border:1px solid white;">
  <tr>
    <td>Tebing<b>&nbsp;:</b></td>
   
    <td align="left"></td>
  </tr> 
	{section name=x loop=$Tebing}
	  <tr >
		<td style="border:1px outset white;" bgcolor={$Tebing[x].warna}>				
		<td width="80%">{$Tebing[x].nama}</td>
	  </tr> 
	{/section} 
 
</table>	
	</td>
  </tr>
  
</table></td>
		</tr>
		<tr><td>
{if $Cetak==1}
<input type="button" name="t3d" value="Print" onClick="HideThis(this);
	javascript:window.print();
"
 >
{/if}</td></tr>
		
</table>
</body>
</html>