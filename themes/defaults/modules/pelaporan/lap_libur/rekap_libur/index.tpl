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
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>


<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<!--{if $SEARCH_BOX==1}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{else}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{/if}-->

<div style="left:10;top:10;float:left;position:absolute;">
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
<!--{if $SEARCH_YEAR<>""}-->
<a class="button" href="#" onClick = "window.open('<!--{$FILES}-->');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/print.gif" align="absmiddle"> &nbsp;Cetak</span></a>
<!--{/if}-->
</div>

	<DIV ID="_menuEntry2_1" style="width:100%;top:25px;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
                  <!--PENCARIAN_DATA -->      
		<DIV ID="_menuEdit_1">

		<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box" > 
                
                                                        
                                                        <TR>
								<TD>Jenis Shift</TD>
								<TD>
                                                                            <select name="nama_shift_cari" >
                                                                            <option value="">[Pilih Shift]</option>
                                                                            <!--{section name=x loop=$DATA_SHIFT}-->
                                                                            <!--{if trim($DATA_SHIFT[x].r_shift__id)==0}-->
                                                                            <option value="<!--{$DATA_SHIFT[x].r_shift__id}-->" selected > <!--{$DATA_SHIFT[x].r_shift__ket}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_SHIFT[x].r_shift__id}-->"  > <!--{$DATA_SHIFT[x].r_shift__ket}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
                                                                            </select> 
                                                                            
                                                   
                                                                    
                                                                </TD>
							</TR>
                                                          <TR>
                            <TD>Jenis Libur  <font color="#ff0000">*</font></TD>
                            <TD>
                                <SELECT name="jenis_cari">
                                    <OPTION value="">Pilih Jenis Libur</OPTION> 
                                    <OPTION value="1" >Libur Reguler</OPTION> 
                                    <OPTION value="2" >Libur Cuti Bersama</OPTION> 
                                </SELECT>
                            </TD>
                    </TR>       
                             
                                                        <TR>
							<TD>Periode Awal</TD>
							<TD>
                                                        <SELECT NAME="tgl1" > 
                                                        <OPTION VALUE="" selected>[Pilih Tgl]</OPTION>
                                                        <!--{section name=foo start=1 loop=31 step=1}-->
                                                                  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%d"}-->
                                                                         <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
                                                                  <!--{else}-->
                                                                                 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
                                                                 <!--{/if}--> 
                                                        <!--{/section}-->
                                                        </SELECT> 
							<SELECT name="bulan1"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01"<!--{if $BULAN_SES==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="02"<!--{if $BULAN_SES==2}-->selected<!--{/if}-->  >Februari</OPTION>
								<OPTION VALUE="03"<!--{if $BULAN_SES==3}-->selected<!--{/if}-->  >Maret</OPTION>
								<OPTION VALUE="04"<!--{if $BULAN_SES==4}-->selected<!--{/if}-->  >April</OPTION>
								<OPTION VALUE="05"<!--{if $BULAN_SES==5}-->selected<!--{/if}--> >Mei</OPTION>
								<OPTION VALUE="06"<!--{if $BULAN_SES==6}-->selected<!--{/if}-->  >Juni</OPTION>
								<OPTION VALUE="07"<!--{if $BULAN_SES==7}-->selected<!--{/if}-->  >Juli</OPTION>
								<OPTION VALUE="08"<!--{if $BULAN_SES==8}-->selected<!--{/if}-->  >Agustus</OPTION>
								<OPTION VALUE="09"<!--{if $BULAN_SES==9}-->selected<!--{/if}-->  >September</OPTION>
								<OPTION VALUE="10"<!--{if $BULAN_SES==10}-->selected<!--{/if}-->  >Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $BULAN_SES==11}-->selected<!--{/if}-->  >November</OPTION>
								<OPTION VALUE="12"<!--{if $BULAN_SES==12}-->selected<!--{/if}-->  >Desember</OPTION>				 
                                                        </SELECT> 
						<SELECT NAME="tahun1" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%Y"}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT>                                                 
						 </TD></TR>    
                                         <TR>
							<TD>Periode Akhir</TD>
							<TD>
                                                        <SELECT NAME="tgl2" > 
                                                        <OPTION VALUE="" selected>[Pilih Tgl]</OPTION>
                                                        <!--{section name=foo start=1 loop=31 step=1}-->
                                                                  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%d"}-->
                                                                         <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
                                                                  <!--{else}-->
                                                                                 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
                                                                 <!--{/if}--> 
                                                        <!--{/section}-->
                                                        </SELECT> 
							<SELECT name="bulan2"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01"<!--{if $BULAN_SES==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="02"<!--{if $BULAN_SES==2}-->selected<!--{/if}-->  >Februari</OPTION>
								<OPTION VALUE="03"<!--{if $BULAN_SES==3}-->selected<!--{/if}-->  >Maret</OPTION>
								<OPTION VALUE="04"<!--{if $BULAN_SES==4}-->selected<!--{/if}-->  >April</OPTION>
								<OPTION VALUE="05"<!--{if $BULAN_SES==5}-->selected<!--{/if}--> >Mei</OPTION>
								<OPTION VALUE="06"<!--{if $BULAN_SES==6}-->selected<!--{/if}-->  >Juni</OPTION>
								<OPTION VALUE="07"<!--{if $BULAN_SES==7}-->selected<!--{/if}-->  >Juli</OPTION>
								<OPTION VALUE="08"<!--{if $BULAN_SES==8}-->selected<!--{/if}-->  >Agustus</OPTION>
								<OPTION VALUE="09"<!--{if $BULAN_SES==9}-->selected<!--{/if}-->  >September</OPTION>
								<OPTION VALUE="10"<!--{if $BULAN_SES==10}-->selected<!--{/if}-->  >Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $BULAN_SES==11}-->selected<!--{/if}-->  >November</OPTION>
								<OPTION VALUE="12"<!--{if $BULAN_SES==12}-->selected<!--{/if}-->  >Desember</OPTION>				 
                                                        </SELECT> 
						<SELECT NAME="tahun2" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%Y"}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT>                                                 
						 </TD></TR>
                                    <TR>
					<TD></TD>
					<TD>
                                            <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
                                            <INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
                                            <INPUT TYPE="hidden" name="search" value="1">
                                            <INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
                                            <INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
                                            <INPUT TYPE="hidden" name="op" value="0">
                                            <a class="button" href="#" onclick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';" onSubmit="frmList1.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> Cari</span></a>
                                            <a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>					
                                        </TD>
                                        </TR>							
                </TABLE>
			</FORM>
			</div></div>	 <!--TUTUP_PENCARIAN_DATA -->  
		</DIV>												
		<!--{if $SEARCH<>""}--><br>
                <!--VIEW_INDEX-->
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">DATA HARI LIBUR</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%" >
		<TR>
		<TD COLSPAN="2">
				<table width="100%" class="tbheader" border=0>	
				<!--{if ($NM_PERWAKILAN !='') }-->
				<tr><td class="tdatacontent"  width="100" >CABANG</td><td width="5"> : </td><td colspan="2"><!--{$NM_PERWAKILAN}--> &nbsp;</td></tr>
				<!--{/if}-->
                            

				<!--{if ($PERIODE_AWAL !='' or  $PERIODE_AKHIR !='' ) }-->


											<tr><td class="tdatacontent"  >PERIODE </td><td> : </td><td>
																			
											<!--{$PERIODE_AWAL|date_format:"%d-%b-%Y"}--> &nbsp; s/d &nbsp;  <!--{$PERIODE_AKHIR|date_format:"%d-%b-%Y"}--></td></tr>
				<!--{/if}-->
				
				</table></TD></TR>
                                <TR>
									<TD COLSPAN="2">
										<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<THEAD>									 
										<TR>
                                                                                    <TH class="tdatahead" align="left">NO</TH>
                                                                                    <TH class="tdatahead" align="left">KET SHIFT</TH>
                                                                                    <TH class="tdatahead" align="left">TGL LIBUR </TH>   
                                                                                    <TH class="tdatahead" align="left"> KETERANGAN</TH>
                                                                                    <TH class="tdatahead" align="left"> JENIS LIBUR</TH>
                                                                                     
										</TR>										 
										</thead>
										
										<tbody>									
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
                                                                                    <TD width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>  
                                                                                    <TD class="tdatacontent"><!--{$DATA_TB[x].r_shift__ket}--> </TD>
                                                                                    <TD class="tdatacontent"><!--{$DATA_TB[x].r_libur__tgl|date_format:"%A-%d-%b-%Y"}--> </TD>
                                                                                    <TD class="tdatacontent"><!--{$DATA_TB[x].r_libur__ket}--> </TD>
                                                                                     <TD class="tdatacontent"> 
                                                                                          <!--{if ($DATA_TB[x].r_libur__jenis)==1}-->
                                                                                               Libur Reguler
                                                                                            <!--{else ($DATA_TB[x].r_libur__jenis) ==2}-->  
                                                                                               <font color="#FF0000">Cuti Bersama</font>     
                                                                                             <!--{/if}--> 
                                                                                        
                                                                                        </TD>
                                                                                   
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="11" align="center">Maaf, Data Masih Kosong</TD>
										</TR>
										<!--{/section}-->
										</tbody>
                                                                                <TR><!--{section name=y loop=$DATA_TB4}-->
										<Td class="tdatahead" colspan="3" align="right" ><b>JML HARI LIBUR : </b></td>	
										<Td class="tdatahead"  colspan="1"  align=" left" > <!--{$DATA_TB4[y].total_orang}-->Hari</td>	
                                                                                <!--{/section}-->
										</TR>
                                                                                                
                                                                                                
                                                                                                
                                                                                                
									</TABLE></TD> 
										  
								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>


									
<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" onMouseOver="document.frmList.print_desc.value='Download';" style="background:transparant;border:0;">
&nbsp;&nbsp;
 <IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Download';"  
 onClick = "window.open('<!--{$FILES}-->');">	
					</FORM>
<!--CLOSE_VIEW_INDEX-->

					
<!--{/if}-->

	</DIV>

</BODY>
</HTML>