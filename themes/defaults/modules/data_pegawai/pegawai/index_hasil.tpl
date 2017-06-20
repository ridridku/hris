<HTML>
<HEAD>

<title><!--{$TITLE}--></title>


<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/preload.css" type="text/css">
<script language="JavaScript" type="text/javascript">

n=document.layers
ie=document.all

//Hides the layer onload
function hideIt(){
	if(ie || n){
		if(n) document.divLoadCont.display="none"
		else divLoadCont.style.display="none"
	} else {
		document.getElementById('divLoadCont').style.display='none';
	}
}

</script>
<div id="divLoadCont">
	<table width="100%" height="95%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Loading Page....
		</td></tr>
	</table>
</div>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-sack.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
 


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>


<body onLoad="hideIt(); <!--{if ($OPT==1)}--> showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);hideAll('_menuEntry3_',1);<!--{elseif ($OPT==5)}--> showAll('_menuEntry3_',1);hideAll('_menuEntry2_',1);hideAll('_menuEntry1_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);hideAll('_menuEntry3_',1);showAll('_menuEntry2_',1);<!--{/if}-->">

 
  
		 

 		
		<FORM METHOD=GET ACTION="" NAME="frmList">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">Data Pegawai Baru Belum Ditempatkan</td></tr>
		</table>

		
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Selanjutnya Masuk Ke menu Penempatan Pilih Karyawan Verifikasi</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                        <TH class="tdatahead" align="left" width="30%">NAMA </TH>
											<TH class="tdatahead" align="left" >TGL MASUK</TH>                                                                                       
                                                                                        <TH class="tdatahead" align="left" >ID PEGAWAI</TH>
											                                                           
											
			
		</THEAD>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                                                                                        <TD class="tdatacontent"  width="50" ><!--{$DATA_TB[x].r_pegawai__nama}--></TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_pegawai__tgl_masuk}--> </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_pegawai__id}--> </TD>
										
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="14" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<!--{/section}-->
			</tbody>
		</table>
<div id="panel-footer">
    <!--halaman -->
                    <table width="100%">
                    <tr class="text-regular">
                    <td width="20">Tampilkan</td>
                    <td width="35">
                    <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
                    <INPUT TYPE="hidden" name="kode_perwakilan_cari" value="<!--{$KODE_PERWAKILAN_CARI}-->">
                    <INPUT TYPE="hidden" name="no_paspor_cari" value="<!--{$NO_PASPOR_CARI}-->">
                    <INPUT TYPE="hidden" name="nama_wni_cari" value="<!--{$NAMA_WNI_CARI}-->">
                    <INPUT TYPE="hidden" name="kode_sumber" value="<!--{$KODE_SUMBER}-->">
                    <SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
                    <!--{section name=x loop=$LISTVAL}-->
                    <OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
                    <!--{/section}-->
                    </SELECT></td>
                    <td>Baris : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> Dari <!--{$COUNT}--></td>
                    <td align="right"><!--{$NEXT_PREV}--></td>
                    </tr>
                    </table>
    <!--halaman -->
</div>
		</td></tr>
		</table>
                        
                <!--BERHASIL-->        
                <table width="100%">
		<tr><th class="tdatahead" align="center"><font color="#ff0000"><a href="#" onclick="history.go(-1);return false;" style="text-decoration:underline;">Back</a>  <!--{$LABEL_ERROR}--> </font></th>
		</tr>
		</table>
		
		  <!--TUTUP    BERHASIL-->     
		</form>


			 
								
							</TABLE></TD>
						</TR>
						
 
</BODY>
</HTML>
