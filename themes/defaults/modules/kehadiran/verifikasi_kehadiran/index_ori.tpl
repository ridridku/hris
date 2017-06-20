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
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
                            
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Tambah Data Kehadiran</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" enctype="multipart/form-data">
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

									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_KODE_CABANG}-->
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

									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_KODE_CABANG}-->
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
                                    <INPUT TYPE="text" NAME="r_pegawai__nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_T_ABS__NAMA}-->">
                                    <INPUT TYPE="hidden" NAME="r_pnpt__finger_print" readonly id="r_pnpt__finger_print" size="35" value="<!--{$EDIT_T_ABS__FINGERPRINT}-->" >
                                    <INPUT TYPE="hidden" NAME="r_pnpt__shift" readonly id="r_pnpt__shift" size="35" value="<!--{$EDIT_T_ABS__ID_SHIFT}-->" >
                                    <INPUT TYPE="hidden" NAME="shift_ket" readonly id="shift_ketasdas" size="35" value="<!--{$EDIT_SHIFT_KET}-->" >
                                    <!--{if $EDIT_VAL==0}-->
                                    <INPUT TYPE="button"  name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goPemberikerja()" value=" ... " />
                               <!--{/if}-->
                                </TD>
                                
                        </TR>
                         <TR>
                                <TD> Shift Kerja<font color="#ff0000">*</font> </TD>
                                 <TD>:<INPUT TYPE="text" NAME="shift_ket" readonly id="shift_ket" size="35" value="<!--{$EDIT_SHIFT_KET}-->" >   </TD>
                         </TR>
                         <TR>
				<TD>Tgl Hari Kerja  <font color="#ff0000">*</font></TD>
                                <TD>:
                                <!--{if $EDIT_VAL==0}-->
                                <input type="text" readonly="" NAME="t_abs__tgl" value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.t_abs__tgl,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
                                        <input readonly="" type="text" name="t_abs__tgl" value="<!--{$EDIT_T_ABS__TGL|date_format:"%Y-%m-%d"}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.t_abs__tgl,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
                                
                                
                                </TD>
			</TR>       
				
                 
                               
                                <TR>
                                    <TD >Jam Masuk Kerja</TD>
                                    <TD>: <input type="time" name="t_abs__jam_masuk" min="9:00" max="18:00" step="1800" value="<!--{$EDIT_T_ABS__JAM_MASUK}-->"/>
                                       
                                </TR>
                                <TR>
                                     <TD >Jam Keluar Kerja</TD>    
                                     <TD>: <input type="time" name="t_abs__jam_keluar" min="9:00" max="18:00" step="1800" value="<!--{$EDIT_T_ABS__JAM_KELUAR}-->"/>
                                       
                                         
                                        </TD>
                                </TR>
                                <TR>
                                    <TD >Jumlah Jam Kerja</TD>    
                                    <TD>: <input type="time" name="t_abs__worktime"  value="<!--{$EDIT_T_ABS__WORKTIME}-->"/>
                                        
                                        </TD>
                                </TR>
                                
                                <TR>
                                    <TD>Jam Datang lebih Awal</TD>    
                                    <TD>: <input type="time" name="t_abs__early"  value="<!--{$EDIT_T_ABS__EARLY}-->"/>
                                         
                                    </TD>
                                </TR>
                                
                                <TR>
                                <TD>Jam Datang Terlambat</TD>    
                                <TD>: <INPUT type="time" name="t_abs__lately"  value="<!--{$EDIT_T_ABS__LATELY}-->"/>
                                         
                                 </TD>
                                </TR>
                                
                                <TR>
                                    <TD>Jam Kerja Kurang</TD>    
                                    <TD>: 
                                        <INPUT type="time" name="t_abs__lesstime"  value="<!--{$EDIT_T_ABS__LESSTIME}-->"/>
                                         
                                    </TD>
                                </TR>
                                
                                <TR>
                                    <TD >Jam Kerja Lebih </TD>    
                                    <TD>:  <INPUT type="time" name="t_abs__overtime"  value="<!--{$EDIT_T_ABS__OVERTIME}-->"/>
                                          
                                    </TD>
                                </TR>
                                <TR>
                                <TD >Keterangan Kehadiran</TD>
                                <TD>:
                                        <select name="t_abs__status" >
                                            <OPTION value="">[Pilih Keterangan]</OPTION>
                                             <OPTION value="1" <!--{if $EDIT_T_ABS__STATUS == '1'}--> selected <!--{/if}--> >HADIR</OPTION>
                                            <OPTION value="2" <!--{if $EDIT_T_ABS__STATUS == '2'}--> selected <!--{/if}--> >SAKIT</OPTION>
                                            <OPTION value="3" <!--{if $EDIT_T_ABS__STATUS == '3'}--> selected <!--{/if}-->>IZIN</OPTION>
                                            <OPTION value="4" <!--{if $EDIT_T_ABS__STATUS == '4'}--> selected <!--{/if}-->>ALFA</OPTION>
                                            <OPTION value="5" <!--{if $EDIT_T_ABS__STATUS == '5'}--> selected <!--{/if}-->>DINAS LUAR KOTA</OPTION>
                                             <OPTION value="6" <!--{if $EDIT_T_ABS__STATUS == '6'}--> selected <!--{/if}-->>CUTI</OPTION>
					
                                        </select>      
                                </TD>
                                </TR>
                                
                                <TR>
                                    <TD>Catatan</TD> 
                                    <TD>:    
                                       <textarea rows="5" cols="50" NAME="t_abs__catatan"  size="12" ><!--{$EDIT_T_ABS__CATATAN}--></textarea>
                                    </TD>
                        </TR>
                                <INPUT TYPE="hidden" name="t_abs__id" value="<!--{$EDIT_T_ABS__ID}-->"> 
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
                                                        <TR>
								<TD> ID finger </TD>
								<TD><INPUT TYPE="text" NAME="idfinger_cari" size="30"></TD>
							</TR>
                                                         <TR>
								<TD> Status</TD>
                                                                <TD><SELECT name="status_cari">
                                                                        <option value="" selected>Pilih Status</OPTION>
                                                                        <option value="505">Belum Diverifikasi </OPTION>
                                                                        <option value="1">Izin</OPTION>
                                                                        <option value="2">Sakit</OPTION>
                                                                        <option value="3">Alfa</OPTION>
                                                                        <option value="4">Dinas Luar Kota</OPTION>
                                                                    </SELECT></TD>
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
<!--form_cari--> 			
		</DIV>
		
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Verifikasi Kehadiran HRD</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Daftar Hadir Periode aktif  Mulai : <!--{$PERIODE_AWAL|date_format:"%d-%B-%Y"}--> s/d <!--{$PERIODE_AKHIR|date_format:"%d-%B-%Y"}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                         <tr>
                            <th class="tdatahead" align="left">NO</TH>
                            <th class="tdatahead" align="left">ID FINGER</TH>
                            <th class="tdatahead" align="left" width="10%">NAMA KARYAWAN</TH>
                            <th class="tdatahead" align="left">CABANG</TH>											
                            <th class="tdatahead" align="left" >TGL MASUK</TH>
                            <th class="tdatahead" align="left" >RULE JAM MASUK</TH>
                            <th class="tdatahead" align="left" >RULE KELUAR</TH>
                            <th class="tdatahead" align="left" >JAM MASUK</TH>
                            <th class="tdatahead" align="left" >JAM KELUAR</TH>
                            <th class="tdatahead" align="left" >EARLY</TH>
                            <th class="tdatahead" align="left" >LATELY</TH>
                            <th class="tdatahead" align="left" >WORKTIME</TH>
                            <th class="tdatahead" align="left" >OVERTIME</TH>
                            <th class="tdatahead" align="left" >LESSTIME</TH>
                            <th class="tdatahead" align="left" >KETERANGAN</TH>
                            <th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
			</tr>
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent"  > <!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
											<TD class="tdatacontent"  > <!--{$DATA_TB[x].r_cabang__nama}-->  </TD>
                                                                                        <TD class="tdatacontent"  > 
                                                                                            <!--{if ($DATA_TB[x].t_abs__worktime) !=''}-->
                                                                                            <!--{$DATA_TB[x].t_abs__tgl|date_format:"%d-%m-%Y"}--> 
                                                                                            <!--{else}-->
                                                                                            <!--{$DATA_TB[x].t_abs__tgl}--> 
                                                                                            <!--{/if}-->
                                                                                        </TD> 
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].ketentuan_jam_masuk}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].ketentuan_jam_keluar}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_abs__jam_masuk}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_abs__jam_keluar}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].t_abs__early}--> </TD>
                                                                                       <TD class="tdatacontent"  > 
                                                                                           <!--{if ($DATA_TB[x].t_abs__lately) >'00:00:00'}-->
                                                                                           <font color="#ff0000"><!--{$DATA_TB[x].t_abs__lately}--> </font>
                                                                                           <!--{else}-->
                                                                                              <!--{$DATA_TB[x].t_abs__lately}-->   
                                                                                            <!--{/if}-->
                                                                                       </TD>
                                                                                        <TD class="tdatacontent"  >
                                                                                        <!--{if ($DATA_TB[x].t_abs__worktime) <'08:00:00'}-->
                                                                                                <font color="#ff0000"><!--{$DATA_TB[x].t_abs__worktime}--> </font>
                                                                                        <!--{elseif ($DATA_TB[x].t_abs__worktime) >'08:00:00'}-->
                                                                                                  <font color="#072ff9"><!--{$DATA_TB[x].t_abs__worktime}--> </font>
                                                                                        <!--{else}-->
                                                                                                    <!--{$DATA_TB[x].t_abs__worktime}--> 
                                                                                            <!--{/if}-->
                                                                                           </TD>
                                                                                            <TD class="tdatacontent"  >
                                                                                            <!--{if ($DATA_TB[x].t_abs__overtime) >'00:00:00'}-->
                                                                                                <font color="#072ff9"><!--{$DATA_TB[x].t_abs__overtime}--> </font>
                                                                                           <!--{else}-->
                                                                                                    <!--{$DATA_TB[x].t_abs__overtime}--> 
                                                                                            <!--{/if}-->
                                                                                            </TD>
                                                                                        <TD class="tdatacontent"  >
                                                                                                 <!--{if ($DATA_TB[x].t_abs__lesstime) >'00:00:00'}-->
                                                                                                <font color="#ff0000"><!--{$DATA_TB[x].t_abs__lesstime}--> </font>
                                                                                           <!--{else}-->
                                                                                                    <!--{$DATA_TB[x].t_abs__lesstime}--> 
                                                                                            <!--{/if}-->
                                                                                            
                                                                                            
                                                                                          </TD>
                                                                                         <TD class="tdatacontent"  > 
                                            <!--{if ($DATA_TB[x].t_abs__status) ==1}-->
                                                     <font color="#088706">Hadir</font> 
                                            <!--{elseif ($DATA_TB[x].t_abs__status) ==2}-->
                                                      <font color="#072ff9">Sakit</font>
                                            <!--{elseif ($DATA_TB[x].t_abs__status) ==3}-->  
                                                       <font color="072ff9">Izin</font>
                                            <!--{elseif ($DATA_TB[x].t_abs__status) ==4}-->  
                                                      <font color="#072ff9">Alfa</font> 
                                            <!--{elseif ($DATA_TB[x].t_abs__status) ==5}-->  
                                                  <font color="#072ff9">Dinas Luar Kota</font>   
                                                    <!--{elseif ($DATA_TB[x].t_abs__status) =='6'}-->  
                                                     <font color="#072ff9">Cuti</font>   
                                                       <!--{else}-->  
                                                     <font color="#ff0000">Belum Terverifikasi</font>   
                                            <!--{/if}-->  
                                          
                                          
                                         

                                                                                         </TD>
                                                                                       <TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].t_abs__id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].t_abs__id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
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
                    <td width="35"><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
                    <INPUT TYPE="hidden" name="idfinger_cari" value="<!--{$ID_FINGER_CARI}-->">
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