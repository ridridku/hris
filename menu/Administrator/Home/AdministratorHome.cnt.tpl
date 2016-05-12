<link rel="stylesheet" href="styles/new/style.css" type="text/css">
{literal}
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style10 {color: #666666; font-size: 11px; font-family: Arial, Helvetica, sans-serif;}
.style11 {color: #FFFFFF; font-size: 11px; font-family: Arial, Helvetica, sans-serif;}
</style>
{/literal}
 
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="100%" align="center">


			{section name=idx loop=$datalink}
			<div id="cpanel">
			<div style="float: left;">
			<div class="icon"> <a href="?Menu={$datalink[idx].link}"> 
			<img src="{$datalink[idx].image}" alt="Add New Content" align="middle" border="0"> <span>{$datalink[idx].nama}</span> </a></div></div></div>
			{/section}

		  
		  </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="15">&nbsp;</td>
          <td height="18"></td>
          <td>&nbsp;</td>
        </tr>
      </table>