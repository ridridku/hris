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

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->

</HEAD>

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">

<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
		
		<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Pemulangan WNI/TKI</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Add/Edit Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">

                <TR>
					<TD>No. BAST</TD>
					<TD><INPUT TYPE="text" NAME="no_sk_pemulangan" value="<!--{$EDIT_NO_SK_PEMULANGAN}-->" size="35"></TD>
				</TR>


                  	<TR>
					<TD>Tanggal BAST</TD>
					<TD>
                	<!--{if $EDIT_VAL==0}-->

							 <input type="text" name="tgl_sk" value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_sk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="tgl_sk" value="<!--{$EDIT_TGL_SK}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_sk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
					</TD>
				</TR>

                	<TR>
					<TD>Tanggal Pemulangan</TD>
					<TD>
                	<!--{if $EDIT_VAL==0}-->

							 <input type="text" name="tgl_pemulangan" value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_pemulangan,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="tgl_pemulangan" value="<!--{$EDIT_TGL_PEMULANGAN}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_pemulangan,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
					</TD>
				</TR>

				<TR>
					<TD>Perwakilan</TD>
					<TD>
					 
						
						<!--{if ($JENIS_USER_SES==1)}-->

								<select name="kode_perwakilan" > 
								<option value=""> Pilih Perwakilan </option>
								<!--{section name=x loop=$DATA_PWK}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_PWK[x].kode_perwakilan) == $EDIT_KODE_PERWAKILAN}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->" selected > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"  > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{/if}-->

								<!--{else}-->

									<!--{if  ($DATA_PWK[x].kode_perwakilan) == $KODE_PW_SES}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->" selected > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"  > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{/if}-->
								<!--{/if}-->

								<!--{/section}-->
								</SELECT>	

						<!--{else}-->
 
								<select name="kode_perwakilan" > 
						<option value=""> Pilih Perwakilan </option>
								<!--{section name=x loop=$DATA_PWK}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_PWK[x].kode_perwakilan) == $EDIT_KODE_PERWAKILAN}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->" selected > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"  disabled> <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{/if}-->

								<!--{else}-->

									<!--{if  trim($DATA_PWK[x].kode_perwakilan) == trim($KODE_PW_SES)}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->" selected > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"  disabled> <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{/if}-->

								<!--{/if}-->

								<!--{/section}-->
								</SELECT>

						<!--{/if}-->
						</TD>
				</TR>


				<TR>
					<TD>WNI/TKI</TD>
					<TD>
						<INPUT TYPE="text" NAME="nama" readonly  id="nama"  size="35" value="<!--{$EDIT_NAMA}-->">
						<INPUT TYPE="hidden" NAME="kode_wni" id="kode_wni"  size="35" value="<!--{$EDIT_KODE_WNI}-->">
						<INPUT TYPE="hidden" NAME="kode_form_pengaduan"  id="kode_form_pengaduan" size="35" value="<!--{$EDIT_KODE_FORM_PENGADUAN}-->" >
						<input name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goPemulangan()" value=" ... " />
					</TD>
				</TR>



               <TR>
					<TD>Pilihan Pemulangan</TD>
					<TD>
				        <select name="kode_pilihan" >
                        <option value="">[Pilih Pilihan Pemulangan]</option>
                       <option value="1"   <!--{if  ($EDIT_KODE_PILIHAN  == 1)}--> selected <!--{/if}--> > Deportasi </option>
		      <option value="2"   <!--{if  ($EDIT_KODE_PILIHAN  == 2)}--> selected <!--{/if}-->   > Repatriasi </option>
		       <option value="3"   <!--{if  ($EDIT_KODE_PILIHAN  == 3)}--> selected <!--{/if}-->   > Evakuasi </option>
  
                   </select>
                   </TD>
				</TR>

                 <TR>
					<TD>Petugas</TD>
					<TD><INPUT TYPE="text" NAME="petugas" value="<!--{$EDIT_PETUGAS}-->" size="35"></TD>
				</TR>


                <TR>
					<TD>Pihak Yang Menerima</TD>
					<TD><INPUT TYPE="text" NAME="diserahkan" value="<!--{$EDIT_DISERAHKAN}-->" size="35"></TD>
				</TR>


                <TR>
					<TD>Flight</TD>
					<TD><INPUT TYPE="text" NAME="flight" value="<!--{$EDIT_FLIGHT}-->" size="35"></TD>
				</TR>

				<TR>
					<TD>Tanggal Tiba</TD>
					<TD>
					<!--{if $EDIT_VAL==0}-->

							 <input type="text" name="tgl_tiba" value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_tiba,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="tgl_tiba" value="<!--{$EDIT_TGL_TIBA}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_tiba,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
					</TD>
				</TR>

                <TR>
					<TD>Entry Point</TD>
					<TD><INPUT TYPE="text" NAME="entry_point" value="<!--{$EDIT_ENTRY_POINT}-->" size="35"></TD>
				</TR>

				 <TR>
					<TD>Keterangan</TD>
					<TD><textarea cols="50" rows="3" name="keterangan"><!--{$EDIT_KETERANGAN}--></textarea> </TD>
				</TR>

				 
				<TR><td height="40"></td>
					<TD>
					  
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
					</TD>
				</TR>
			</TABLE>
		</FORM>
		</td></tr>
		</table>
		</DIV>	
		
	<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
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
					<!--{if ($JENIS_USER_SES=='1')}-->


			<TR>
								<TD>Perwakilan</TD>
								<TD><select name="kode_perwakilan_cari" > 
									<option value=""> Pilih Perwakilan </option>
									<!--{section name=x loop=$DATA_PWK}-->
									<!--{if trim($DATA_PWK[x].kode_perwakilan) == $EDIT_KODE_PERWAKILAN}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->" selected > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"  > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{/if}-->
									<!--{/section}-->
									</select> </TD>
							</TR>
				<!--{/if}-->	
                            <TR>
								<TD>Nama TKI/WNI </TD>
								<TD><INPUT TYPE="text" NAME="nama_wni_cari" size="30"></TD>
							</TR>

							  <TR>
								<TD>NO. SK Pemulangan </TD>
								<TD><INPUT TYPE="text" NAME="no_sk_pemulangan_cari" size="30"></TD>
							</TR>

							 <TR>
								<TD>Pilihan Pemulangan </TD>
								<TD> 
								 <select name="kode_pilihan" >
									<option value="">[Pilih Pilihan Pemulangan]</option>
								       <option value="1"  > Deportasi </option>
								      <option value="2"     > Repatriasi </option>
								       <option value="3"     > Evakuasi </option>						  
								  </select>
								</TD>
							</TR>


							  <TR>
								<TD>Tahun</TD>
								<TD> 
								<select name="tahun_cari">
								<option value="1000"></option>
								<option value="2005" <!--{if ($TAHUN_SES==2005)}-->  selected <!--{/if}--> >2005</option>
								<option value="2006" <!--{if ($TAHUN_SES==2006)}-->  selected <!--{/if}--> >2006</option>
								<option value="2007" <!--{if ($TAHUN_SES==2007)}-->  selected <!--{/if}--> >2007</option>
								 <option value="2008" <!--{if ($TAHUN_SES==2008)}-->  selected <!--{/if}--> >2008</option>

								<option value="2009" <!--{if ($TAHUN_SES==2009)}-->  selected <!--{/if}--> >2009</option>
								<option value="2010"  <!--{if ($TAHUN_SES==2010)}-->  selected <!--{/if}--> >2010</option>
								<option value="2011"  <!--{if ($TAHUN_SES==2011)}-->  selected <!--{/if}--> >2011</option>
								<option value="2012"  <!--{if ($TAHUN_SES==2012)}-->  selected <!--{/if}-->>2012</option>
								<option value="2013"  <!--{if ($TAHUN_SES==2013)}-->  selected <!--{/if}-->>2013</option>
								<option value="2014"  <!--{if ($TAHUN_SES==2014)}-->  selected <!--{/if}-->>2014</option>
								<option value="2015"  <!--{if ($TAHUN_SES==2015)}-->  selected <!--{/if}-->>2015</option>
								<option value="2016"  <!--{if ($TAHUN_SES==2016)}-->  selected <!--{/if}-->>2016</option>
								<option value="2017"  <!--{if ($TAHUN_SES==2017)}-->  selected <!--{/if}-->>2017</option>
								<option value="2018"  <!--{if ($TAHUN_SES==2018)}-->  selected <!--{/if}-->>2018</option>
								<option value="2019"  <!--{if ($TAHUN_SES==2019)}-->  selected <!--{/if}-->>2019</option>
								<option value="2020"  <!--{if ($TAHUN_SES==2020)}-->  selected <!--{/if}-->>2020</option>
								</select>
								
								</TD>
							</TR>



			<TR><TD></TD>
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
				<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
				<INPUT TYPE="hidden" name="search" value="1">
				<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
				<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
				<INPUT TYPE="hidden" name="op" value="0">
				<CENTER>
				<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Cari</span></a>
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
				</CENTER>
				</TD>
			</TR>
			</TABLE>
			</FORM>
			</div></div>	
		</DIV>
		
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Pemulangan WNI/TKI</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Daftar Pemulangan WNI/TKI</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
											<th class="tdatahead" align="left">No</TH>
                                            	<th class="tdatahead" align="left">Perwakilan</TH>
											<th class="tdatahead" align="left">No. BAST</TH>
                                            <th class="tdatahead" align="left">Nama WNI</TH>
                                             <th class="tdatahead" align="left">Pilihan Pemulangan</TH>

                                            <th class="tdatahead" align="left">Pihak Yang Menerima</TH>
											<th class="tdatahead" align="left">Tanggal Tiba</TH>
											<th class="tdatahead" align="left">Flight</TH>
											<th class="tdatahead" align="left">Entry Point</TH>

											 <th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
			</tr>
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->										
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                                            	<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nm_perwakilan}--> </TD>
                                            <TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].no_sk_pemulangan}--> </TD>
										     <TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama}--> </TD>
             <TD class="tdatacontent" nowrap> 
	     
	     <!--{if ($DATA_TB[x].kode_pilihan==1)}-->  Deportasi <!--{/if}-->
			  <!--{if ($DATA_TB[x].kode_pilihan==2)}-->  Repatriasi <!--{/if}-->
			    <!--{if ($DATA_TB[x].kode_pilihan==3)}-->  Evakuasi <!--{/if}-->
			    
			    </TD>


             <TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].diserahkan}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].tgl_tiba}-->
											<TD class="tdatacontent" nowrap><!--{$DATA_TB[x].flight}--></TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].entry_point}--> </TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&no_sk_pemulangan=<!--{$DATA_TB[x].no_sk_pemulangan}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&no_sk_pemulangan=<!--{$DATA_TB[x].no_sk_pemulangan}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="11" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<!--{/section}-->
			</tbody>
		</table>
<div id="panel-footer">
<table width="100%">
<tr class="text-regular">
<td width="20">Tampilkan</td>
<td width="35"><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">

		<INPUT TYPE="hidden" name="kode_perwakilan_cari" value="<!--{$KODE_PERWAKILAN_CARI}-->">
		<INPUT TYPE="hidden" name="no_sk_pemulangan_cari" value="<!--{$NO_SK_PEMULANGAN_CARI}-->">
		<INPUT TYPE="hidden" name="nama_wni_cari" value="<!--{$NAMA_WNI_CARI}-->">
		<INPUT TYPE="hidden" name="tahun_cari" value="<!--{$TAHUN_CARI}-->">
		<INPUT TYPE="hidden" name="kode_pilihan" value="<!--{$KODE_PILIHAN}-->">


<SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
		<!--{section name=x loop=$LISTVAL}-->
		<OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
		<!--{/section}-->
		</SELECT></td>
<td>Baris : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> dari <!--{$COUNT}--></td>
<td align="right"><!--{$NEXT_PREV}--></td>
</tr>
</table>
</div>				
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>