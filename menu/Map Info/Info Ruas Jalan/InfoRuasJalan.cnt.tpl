<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Information Values</title>
</head>
<link rel="stylesheet" type="text/css" href="styles/style_Grid.css">
<body>
<table width="286" border="0" cellpadding="0" cellspacing="0" class="td_end">
  <tr>
    <td width="27" class="td_kn_bawah"><div align="center"><strong>No.</strong></div></td>
    <td width="120" class="td_kn_bawah"><div align="center"><strong>Property</strong></div></td>
    <td width="150" class="td_bawah"><div align="center"><strong>Value</strong></div></td>
  </tr>
  {section name=Property loop=$Name}
  <tr>
    <td class="td_kn_bawah" valign="top"><div align="center">{$Nomor[Property]}</div></td>
    <td class="td_kn_bawah" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      	<tr>
			<td width="5%">&nbsp;</td>
			<td>{$Name[Property]}</td>
      	</tr>
    </table>	
	</td>
    <td class="td_bawah" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      	<tr>
			<td width="5%">&nbsp;</td>
			<td>{$Value[Property]}</td>
      	</tr>
    </table>
    </td>
  </tr>
  {/section}
</table>
</body>
</html>