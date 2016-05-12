<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>

<!--{if $SEARCH_BOX==1}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{else}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{/if}-->
<div style="left:10;top:10;float:left;position:absolute;">
<a class="button" href="#" onClick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>"" AND $NO_JENIS_JALAN<>"" }-->
<a class="button" href="#" onClick = "window.open('<!--{$FILES}-->');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/print.gif" align="absmiddle"> &nbsp;Print</span></a>
<!--{/if}-->
</div>

	<DIV ID="_menuEntry2_1" style="width:100%;top:25px;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
		<DIV ID="_menuEdit_1">

		<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">
			<TR>
				<TD><!--{$TB_JENIS_JALAN}--></TD>
				<TD>
				<select name="jns_jln">
				<option value="Semua">[Pilih Kategori Jalan]</option>
					<!--{section name=x loop=$DATA_JENIS_JLN}-->
					<!--{if $DATA_JENIS_JLN[x].id == $PID_JENIS_JLN2}-->
					<option value="<!--{$DATA_JENIS_JLN[x].id}-->" selected > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
					<!--{else}-->
					<option value="<!--{$DATA_JENIS_JLN[x].id}-->"  > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
					<!--{/if}-->
					<!--{/section}-->
				</select>
				</TD>
			</TR>
            
		
							<TR>
								<TD>Nama Pulau</TD>
								<TD>
								<SELECT name="id_pulau" onChange="cari_kabupaten(this.value)">
							    <OPTION VALUE="">[Pilih Pulau]</OPTION>
								<!--{section name=x loop=$DATA_PULAU}-->
								<!--{if $DATA_PULAU[x].id_pulau == $ID_PULAU}-->
								<option value="<!--{$DATA_PULAU[x].id_pulau}-->" selected > <!--{$DATA_PULAU[x].nama_pulau}--> </option>				
								<!--{else}-->
									<option value="<!--{$DATA_PULAU[x].id_pulau}-->"  > <!--{$DATA_PULAU[x].nama_pulau}--> </option>
								<!--{/if}-->
								<!--{/section}-->
								</SELECT>
								</TD>
							</TR>

							<TR>
								<TD><!--{$TB_PROPINSI}--></TD>
								<TD>
						
                                <div id="ajax_kabupaten">
							    <SELECT name="no_propinsi" >
								<OPTION VALUE="Semua">[Pilih Provinsi]</OPTION>
								<!--{section name=x loop=$DATA_PROPINSI}-->
								<!--{if $DATA_PROPINSI[x].no_propinsi == $NO_PROPINSI}-->
								<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>		
								<!--{else}-->
							<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
								<!--{/if}-->
								<!--{/section}-->								
								</SELECT>	
								</div>								
								</TD>
							</TR>
							<TR>
								<TD>Tahun</TD>
								<TD>
								<!--{html_select_date prefix="Search_" display_days=false display_months=false start_year="2000" end_year="+10"}-->
								</TD>
							</TR>
							<TR>
								<TD></TD>
								<TD>
								<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
								<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
								<INPUT TYPE="hidden" name="search" value="1">
								<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
								<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
								<INPUT TYPE="hidden" name="op" value="0">
								<a class="button" href="#" onClick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';"  onSubmit="frmList1.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$SUBMIT}--></span></a>
								<a class="button" href="#" onClick="this.blur();document.frmList1.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>					
								</TD>
							</TR>	
						</TABLE>
			</FORM>
			</div></div>	
		</DIV>
														
<!--{if $NO_PROPINSI<>""}-->
					<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$LIST_ME}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">								
	
								<TR>
									<TD COLSPAN="2">
									<table width="100%" class="tbheader">	
                                    <!--{if $NO_PULAU  <>""}-->
                                    <tr><td width="149" nowrap>Pulau		</td><td width="10"> : </td><td width="612"><!--{$NAMA_PULAU}--></td><td colspan="3"></td></tr>
                                    <!--{/if}-->	
                                   
                                     <!--{if ($NO_PROPINSI  <>"[Pilih Propinsi]") and ($NO_PROPINSI  <>"Semua") }-->																	
									<tr><td width="149" nowrap>Provinsi 		</td><td width="10"> : </td><td width="612"><!--{$NAMA_PROPINSI}--></td><td colspan="3"></td></tr>
                                      <!--{/if}-->	
								
									<tr><td width="149" nowrap>Kategori Jalan 	</td><td width="10"> : </td><td><!--{if $NO_JENIS_JALAN=="1"}-->Provinsi<!--{else}-->Kabupaten/ Kota<!--{/if}--></td></tr>
									<tr><td width="149" nowrap>Tahun 			</td><td width="10"> : </td><td><!--{$SEARCH_YEAR}--></td></tr>									
									</table>
									</TD>
								</TR>														
								<TR>
									
                                  <TD COLSPAN="2"><table align="CENTER" width="100%"  cellspacing="1" cellpadding="2">
                                    <thead>
                                      <tr>
                                        <th class="tdatahead" rowspan="2">No</th>
                                        <th class="tdatahead" rowspan="2">
                                        <!--{if $NO_PULAU  =="" }-->
                                          Pulau
                                            <!--{else if $NO_PULAU  <>"" }-->
                                             <!--{if ($NO_PROPINSI<>"" && $NO_PROPINSI<>"[Pilih Propinsi]" )}-->
                                             Kabupaten
                                              <!--{else}-->
                                              Provinsi
                                               <!--{/if}-->
                                            <!--{/if}--></th>
                                        <th class="tdatahead" rowspan="2">Panjang Ruas (Km)</th>
                                        <th class="tdatahead" colspan="4">Permukaan Jalan</th>
                                      </tr>
                                      <tr>
                                        <th class="tdatahead">Baik</th>
                                        <th class="tdatahead">Sedang</th>
                                        <th class="tdatahead">Rusak Ringan</th>
                                        <th class="tdatahead">Rusak Berat</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <!--{section name=x loop=$DATA_TB}-->
                                      <tr>
                                        <td width="17" class="tdatacontent-first-col">
                                          <!--{$smarty.section.x.index+$COUNT_VIEW}-->
                                          .</td>
                                        <td class="tdatacontent" nowrap>
                                          <!--{$DATA_TB[x].kecamatan_yg_dilalui}--></td>
                                        <td class="tdatacontent" align="center" nowrap>
                                          <!--{$DATA_TB[x].panjang_ruas}-->
                                        </td>
                                        <td class="tdatacontent" align="center" nowrap>
                                          <!--{$DATA_TB[x].baik}-->
                                          (
                                          <!--{$DATA_TB[x].baik/$DATA_TB[x].panjang_ruas*100|string_format:"%d"}-->
                                          %)</td>
                                        <td class="tdatacontent" align="center" nowrap>
                                          <!--{$DATA_TB[x].sedang}-->
        (
        <!--{$DATA_TB[x].sedang/$DATA_TB[x].panjang_ruas*100|string_format:"%d"}-->
        %)</td>
                                        <td class="tdatacontent" align="center" nowrap>
                                          <!--{$DATA_TB[x].rusak_ringan}-->
        (
        <!--{$DATA_TB[x].rusak_ringan/$DATA_TB[x].panjang_ruas*100|string_format:"%d"}-->
        %)</td>
                                        <td class="tdatacontent" align="center" nowrap>
                                          <!--{$DATA_TB[x].rusak_berat}-->
        (
        <!--{$DATA_TB[x].rusak_berat/$DATA_TB[x].panjang_ruas*100|string_format:"%d"}-->
        %)</td>
                                      </tr>
                                      <!--{if ($smarty.section.x.index+$COUNT_VIEW==$JUMLAH) }-->
                                      <tr>
                                        <td colspan="2" class="tdatahead">
                                          <div align="center">Total</div></td>
                                        <td class="tdatacontent" align="center" nowrap><!--{$DATA_TOT_PANJANG_RUAS}-->
                                        </td>
                                        <td class="tdatacontent" align="center" nowrap><!--{$DATA_TOT_BAIK}-->
        (
          <!--{$DATA_TOT_BAIK/$DATA_TOT_PANJANG_RUAS*100|string_format:"%d"}-->
          %) </td>
                                        <td class="tdatacontent" align="center" nowrap><!--{$DATA_TOT_SEDANG}-->
        (
          <!--{$DATA_TOT_SEDANG/$DATA_TOT_PANJANG_RUAS*100|string_format:"%d"}-->
          %) </td>
                                        <td class="tdatacontent" align="center" nowrap><!--{$DATA_TOT_RINGAN}-->
        (
          <!--{$DATA_TOT_RINGAN/$DATA_TOT_PANJANG_RUAS*100|string_format:"%d"}-->
          %) </td>
                                        <td class="tdatacontent" align="center" nowrap><!--{$DATA_TOT_BERAT}-->
        (
          <!--{$DATA_TOT_BERAT/$DATA_TOT_PANJANG_RUAS*100|string_format:"%d"}-->
          %)</td>
                                      </tr>
                                      <!--{/if}-->
                                      <!--{sectionelse}-->
                                      <tr>
                                        <td class="tdatacontent" bgcolor="red" colspan="22" align="center">Sorry, your query has not been successful, please try again</td>
                                      </tr>
                                      <!--{/section}-->
                                    </tbody>
                                  </table></TD>
								</TR>	
</TABLE></TD>	
</TR>	
</TABLE>
							
							
							
<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
									&nbsp;&nbsp;
									<IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';" onMouseOut="document.frmList.print_desc.value='';" 
									onClick = "window.open('<!--{$FILES}-->');">	
									</div>
					</FORM>
					<!--{/if}-->

	</DIV>
</BODY>
</HTML>
