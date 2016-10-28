<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
<STYLE>{
    {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


ul, ol {
    list-style-type: none;
}
p, label {
   background: #c3daf9 url("../images/layout/bg000000.gif") repeat-x scroll 0 0;
    color: #083772;
    font-size: 11px;
    
}
.container-wrapper {
    margin: 7% auto;
    overflow: hidden;
    position: relative;
    width: 100%;
}
input.tab-menu-radio {
    display: none;
}
label.tab-menu {
    cursor: pointer;
    display: inline-block;
    float: left;
    padding: 10px 30px;
  
}
.tab-content {
    background-color: #eef2f8 none repeat scroll 0 0;
    border-top: #eef2f8 none repeat scroll 0 0;
    clear: both;
  //  padding: 20px;
   // position: relative;
  //  top: -3px;
    width: 100%;
}
.tab-menu-radio:checked + label {
    background-color: #eef2f8 none repeat scroll 0 0;
    color: #000000;
    transition: all 1s ease 0s;
}
.tab-content .tab {
    height: 0;
    opacity: 0;
}
#tab-menu1:checked ~ .tab-content .tab-1, #tab-menu2:checked ~ .tab-content .tab-2, #tab-menu3:checked ~ .tab-content .tab-3 {
    height: auto;
    opacity: 1;
    transition: opacity 1s ease 0s;
}




pre.code {
    border: 1px solid #999;
    background-color: #FF9;
    padding: 1em;
    margin: 0;
}

input.time-hh-mm {
    border: 1px solid #929aa9;
    font-size: 12px;
    width: 55px;
}

</STYLE>   
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
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-sack.js"></SCRIPT>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->


</HEAD>
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--tombol_tambah -->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
                            
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Rekap verifikasi Kehadiran BOM</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Rekap verifikasi Kehadiran BOM</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" >
		<TABLE id="table-add-box">
				
					<!--{if $EDIT_VAL==0}-->
                                        <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
                                        <INPUT TYPE="hidden" NAME="id" value="<!--{$EDIT_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
			<TR>
                                <TD>Cabang <font color="#ff0000">*</font></TD> 
				<TD>:

					<!--{if ($JENIS_USER_SES==1)}-->

								<select name="kode_cabang" >
								<option value=""> Pilih Cabang </option>
								<!--{section name=x loop=$DATA_CABANG}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_R_CABANG__ID}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{/if}-->

								<!--{else}-->

									<!--{if  ($DATA_CABANG[x].kode_cabang) == $KODE_PW_SES}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{/if}-->
								<!--{/if}-->

								<!--{/section}-->
								</SELECT>

						<!--{else}-->

					<select name="kode_cabang" >
						<option value=""> Pilih Cabang </option>
								<!--{section name=x loop=$DATA_CABANG}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_R_CABANG__ID}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  disabled> <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{/if}-->

								<!--{else}-->

									<!--{if  trim($DATA_CABANG[x].r_cabang__id) == trim($KODE_PW_SES)}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  disabled> <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{/if}-->

								<!--{/if}-->

								<!--{/section}-->
								</SELECT>

						<!--{/if}-->
				</TD>
			</TR>
                        
                         <TR>
                                <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="r_pegawai__nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_R_PEGAWAI__NAMA}-->">
                                </TD>   
                        </TR>
                         <TR>
                                <TD>Jumlah Hadir<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__hadir"  size="5" value="<!--{$EDIT_T_RKP__HADIR}-->">
                                </TD>
                        </TR>
                        <TR>
                                <TD>Jumlah Sakit<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__sakit"  size="5" value="<!--{$EDIT_T_RKP__SAKIT}-->">
                                </TD>
                        </TR>
                        <TR>
                                <TD>Jumlah Izin<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__izin"  size="5" value="<!--{$EDIT_T_RKP__IZIN}-->">
                                </TD>
                                
                        </TR>
                        <TR>
                                <TD>Jumlah Alpa<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__alpa"  size="5" value="<!--{$EDIT_T_RKP__ALPA}-->">
                                </TD>  
                        </TR>
                        <TR>
                                <TD>Jumlah Perjalanan Dinas<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__dinas"  size="5" value="<!--{$EDIT_T_RKP__DINAS}-->">
                                </TD>   
                        </TR>
                         <TR>
                                <TD>Jumlah Cuti<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__cuti"  size="5" value="<!--{$EDIT_T_RKP__CUTI}-->">
                                </TD>
                        </TR>
                        <TR>
                                <TD>Tahun <font color="#ff0000">*</font></TD> 
			
					<TD>: <SELECT name="tahun" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2016 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$EDIT_T_RKP__THN}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT> 
					</TD>
			</TR>
                        <TR>
                                <TD>Bulan <font color="#ff0000">*</font></TD> 
					<TD>: <SELECT name="bulan" >
							<OPTION value="">[Pilih Bulan]</OPTION>
							<OPTION value="1" <!--{if $EDIT_T_RKP__BLN==1}-->selected<!--{/if}-->>Januari</OPTION>
							<OPTION value="2" <!--{if $EDIT_T_RKP__BLN==2}-->selected<!--{/if}-->>Februari</OPTION>
                                                        <OPTION value="3" <!--{if $EDIT_T_RKP__BLN==3}-->selected<!--{/if}-->>Maret</OPTION>
							<OPTION value="4" <!--{if $EDIT_T_RKP__BLN==4}-->selected<!--{/if}-->>April</OPTION>
							<OPTION value="5" <!--{if $EDIT_T_RKP__BLN==5}-->selected<!--{/if}-->>Mei</OPTION>
                                                        <OPTION value="6" <!--{if $EDIT_T_RKP__BLN==6}-->selected<!--{/if}-->>Juni</OPTION>
                                                        <OPTION value="7" <!--{if $EDIT_T_RKP__BLN==7}-->selected<!--{/if}-->>Juli</OPTION>
							<OPTION value="8" <!--{if $EDIT_T_RKP__BLN==8}-->selected<!--{/if}-->>Agustus</OPTION>
                                                        <OPTION value="9" <!--{if $EDIT_T_RKP__BLN==9}-->selected<!--{/if}-->>September</OPTION>
                                                        <OPTION value="10" <!--{if $EDIT_T_RKP__BLN==10}-->selected<!--{/if}-->>Oktober</OPTION>
							<OPTION value="11" <!--{if $EDIT_T_RKP__BLN==11}-->selected<!--{/if}-->>Nopember</OPTION>
                                                        <OPTION value="12" <!--{if $EDIT_T_RKP__BLN==12}-->selected<!--{/if}-->>Desember</OPTION>
                                                        
						</SELECT>
					</TD>
			</TR>
                        
                        
                    <TR>
                                <TD>Status <font color="#ff0000">*</font></TD> 
			
					<TD>: <SELECT name="approval">
							<OPTION value="">[Pilih Status]</OPTION>
							<OPTION value="1" <!--{if $EDIT_T_RKP__APPROVAL =='1'}-->selected<!--{/if}-->>Tidak Disetujui BOM</OPTION>
							<OPTION value="2" <!--{if $EDIT_T_RKP__APPROVAL =='2'}-->selected<!--{/if}-->>Disetujui BOM</OPTION>
                                                        
						</SELECT>
			</TD>
                        
                        <TR>
                                <TD>Keterangan <font color="#ff0000">*</font></TD> 
			
                                <TD>: 
                                    <textarea rows="5" cols="20" NAME="t_rkp__keterangan"  size="12" ><!--{$EDIT_T_RKP__KETERANGAN}--></textarea>
                                  </TD>
                        </TR>
</TR>                       
  
<INPUT TYPE="hidden" NAME="t_rkp__thn"  size="5" value="<!--{$EDIT_T_RKP__THN}-->">
<INPUT TYPE="hidden" NAME="t_rkp__bln"  size="5" value="<!--{$EDIT_T_RKP__BLN}-->">
<INPUT TYPE="hidden" NAME="t_rkp__no_mutasi"  size="5" value="<!--{$EDIT_T_RKP__NO_MUTASI}-->">
<INPUT TYPE="hidden" NAME="t_rkp__approval"  size="5" value="<!--{$EDIT_T_RKP__APPROVAL}-->">

                              
                                
                                <TR><TD height="40"></TD>
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
					<TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>

					</tr>
                
			</TABLE>
		</FORM>
		</td></tr>
		</table>
		</DIV>
		
<!--form_tambah_tutup-->                              	
<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
		<DIV ID="_menuEdit_1">
<!--form_cari--> 
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
									<option value=""> [Pilih Perwakilan] </option>
									<!--{section name=x loop=$DATA_CABANG}-->
									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_KODE_CABANG}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{/if}-->
									<!--{/section}-->
									</select>		</TD>
							</TR>
					<!--{/if}-->	
							
							
							<TR>
								<TD>Nama Karyawan </TD>
								<TD><INPUT TYPE="text" NAME="nama_karyawan_cari" size="30"></TD>
							</TR>
                                                        <TR><TD>ID Finger </TD><TD><INPUT TYPE="text" NAME="id_finger_cari" size="30"></TD></TR>
			<TR>
							<TD>Periode</TD>
							<TD>							
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01" <!--{if $BULAN_SES==01}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="02"<!--{if $BULAN_SES==02}-->selected<!--{/if}-->  >Februari</OPTION>
								<OPTION VALUE="03"<!--{if $BULAN_SES==03}-->selected<!--{/if}-->  >Maret</OPTION>
								<OPTION VALUE="04"<!--{if $BULAN_SES==04}-->selected<!--{/if}-->  >April</OPTION>
								<OPTION VALUE="05"<!--{if $BULAN_SES==05}-->selected<!--{/if}--> >Mei</OPTION>
								<OPTION VALUE="06"<!--{if $BULAN_SES==06}-->selected<!--{/if}-->  >Juni</OPTION>
								<OPTION VALUE="07"<!--{if $BULAN_SES==07}-->selected<!--{/if}-->  >Juli</OPTION>
								<OPTION VALUE="08"<!--{if $BULAN_SES==08}-->selected<!--{/if}-->  >Agustus</OPTION>
								<OPTION VALUE="09"<!--{if $BULAN_SES==09}-->selected<!--{/if}-->  >September</OPTION>
								<OPTION VALUE="10"<!--{if $BULAN_SES==10}-->selected<!--{/if}-->  >Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $BULAN_SES==11}-->selected<!--{/if}-->  >November</OPTION>
								<OPTION VALUE="12"<!--{if $BULAN_SES==12}-->selected<!--{/if}-->  >Desember</OPTION>				 
                                                        </SELECT> 


							<SELECT name="tahun" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$TAHUN_SES}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT> 
						 </TD></TR>
                                                        
                                   			 
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



<!--form_cari--> 			
		</DIV>
		
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">Verifikasi Rekap Data Kehadiran oleh BOM</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Verifikasi Rekap Data Kehadiran oleh BOM </td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
                                        						<th class="tdatahead" align="left">NO</TH>
                                                                                        <th class="tdatahead" align="left">ID FINGER</TH>
											<th class="tdatahead" align="left">NAMA</TH>											
											<th class="tdatahead" align="left" >CABANG</TH>
                                                                                        <th class="tdatahead" align="left" >SUB CABANG</TH>
                                                                                        <th class="tdatahead" align="left" >DEPARTEMEN</TH>
                                                                                        <th class="tdatahead" align="left" >TAHUN</TH>
                                                                                        <th class="tdatahead" align="left" >BULAN</TH>
                                                                                        <th class="tdatahead" align="left" >APPROVAL STATUS</TH>
                                                                                        <th class="tdatahead" align="left" >HADIR</TH>
                                                                                        <th class="tdatahead" align="left" >SAKIT</TH>
                                                                                        <th class="tdatahead" align="left" >IZIN</TH>
                                                                                        <th class="tdatahead" align="left" >ALPA</TH>
                                                                                        <th class="tdatahead" align="left" >DINAS</TH>
                                                                                        <th class="tdatahead" align="left" >CUTI</TH>
                                                                                        <th class="tdatahead" align="left" >KETERANGAN</TH>
                                                                                       
                                                                                       <th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
                                                                                        
											
			</tr>
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<TD width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].r_cabang__nama}-->  </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].r_subcab__nama}--> </TD> 
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].r_dept__ket}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__thn}--></TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__bln}--> </TD>
                                                                                        <TD class="tdatacontent"  >
                                                                                        
                                                                                         <!--{if ($DATA_TB[x].t_rkp__approval) ==1}-->
                                                                                                        Telah disetujui HRD
                                                                                           <!--{elseif ($DATA_TB[x].t_rkp__approval) ==2}-->
                                                                                                         <font color="green">Telah disetujui BOM</font>
                                                                                            <!--{else ($DATA_TB[x].t_rkp__approval) ==3}-->  
                                                                                                         <font color="#ff0000">Telah disetujui HGLM</font>
                                                                                            <!--{/if}--> 
                                                                                        </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__hadir}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__sakit}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__izin}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__alpa}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__dinas}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_rkp__cuti}--></TD>
                                                                                        <TD class="tdatacontent"  > 
                                                                                        <!--{if ($DATA_TB[x].t_rkp__keterangan) =='KURANG'}-->
                                                                                              <font color="#ff0000"><!--{$DATA_TB[x].t_rkp__keterangan}--></font>
                                                                                                <!--{else}-->
                                                                                              <!--{$DATA_TB[x].t_rkp__keterangan}-->   
                                                                                            <!--{/if}-->
                                                                                        </TD>
                                                                                     
                                                                                        <INPUT TYPE="hidden" name="tahun" value="<!--{$DATA_TB[x].t_rkp__thn}-->">
                                                                                        <INPUT TYPE="hidden" name="bulan" value="<!--{$DATA_TB[x].t_rkp__bln}-->">
                                                                                        <TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].t_rkp__no_mutasi}-->&tahun=<!--{$DATA_TB[x].t_rkp__thn}-->&bulan=<!--{$DATA_TB[x].t_rkp__bln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].t_rkp__no_mutasi}-->&tahun=<!--{$DATA_TB[x].t_rkp__thn}-->&bulan=<!--{$DATA_TB[x].t_rkp__bln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
                                                                                       
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="17" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<!--{/section}-->
			</tbody>
		</table>
<div id="panel-footer">
    <!--halaman -->
 <table width="100%">
                    <tr class="text-regular">
                    <td width="20">Tampilkan</td>
                    <td width="35"><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
                    <INPUT TYPE="hidden" name="kode_perwakilan_cari" value="<!--{$KODE_PERWAKILAN_CARI}-->">
                    <INPUT TYPE="hidden" name="nama_karyawan_cari" value="<!--{$NAMA_KARYAWAN_CARI}-->">
              
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
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>