<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
<STYLE>   {
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
    <!--tombol_tambah  -->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Lembur</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
                    <TABLE id="table-add-box">
				
					<!--{if $EDIT_VAL==0}-->
                                        <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
                                        <INPUT TYPE="hidden" NAME="id" value="<!--{$EDIT_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
                                        
             <!--{if $EDIT_VAL==0}-->  
              <TR>
                        <TD>No Lembur <font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" name="lembur__no" size="35" readonly="" value="<!--{$LEMBUR_AUTO}-->"></TD>
             </TR>
             
             <!--{else}-->
             <TR>
                        <TD>No Lembur <font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" name="lembur__no" size="35" value="<!--{$EDIT_T_LEMBUR__NO}-->"></TD>
             </TR>
             <!--{/if}-->
            <TR>
                    <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang" > 
                                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <!--{section name=x loop=$DATA_CABANG}-->

                                                                                           <!--{if ($OPT==1)}-->

                                                                                                   <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_T_LEMBUR__CABANG}-->
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

                                                <SELECT name="kode_cabang" >
                                                        <option value=""> Pilih Cabang </option>
                                                                        <!--{section name=x loop=$DATA_CABANG}-->

                                                                        <!--{if ($OPT==1)}-->

                                                                                <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_T_LEMBUR__CABANG}-->
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
                            <TD><INPUT TYPE="text" NAME="karyawan_nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_T_LEMBUR__PEGAWAI_NAMA}-->">
                                <INPUT TYPE="text" NAME="karyawan_id" readonly id="finger" size="35" value="<!--{$EDIT_T_LEMBUR__NIP}-->" >
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                            </TD>

                    </TR>
                    <TR>
                            <TD>Jabatan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="jabatan_id" readonly  id="r_pnpt__jabatan"  size="35" value="<!--{$EDIT_JABATAN}-->">
                                <INPUT TYPE="hidden" NAME="level_id" readonly  id="level_id"  size="35" value="<!--{$EDIT_LEVEL}-->">
                            </TD>

                    </TR>
                    <TR>
                            <TD>Nama Atasan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="atasan__nama" readonly  id="atasan_nama"  size="35" value="<!--{$EDIT_T_LEMBUR__ATASAN_NAMA}-->">
                                <INPUT TYPE="hidden" NAME="atasan__nip" readonly id="atasan_id" size="35" value="<!--{$EDIT_T_LEMBUR__ATASAN_NIP}-->" >
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan2()" value=" ... " />
                            </TD>
                    </TR>
                    <TR>
				<TD>Tanggal Lembur</TD>
                                <TD>
                                    <!--{if $EDIT_VAL==0}-->

                                    <input readonly="" type="text" NAME="lembur_tanggal"  id="lembur_tanggal" value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.lembur_tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input readonly="" type="text" name="lembur_tanggal" id="lembur_tanggal" value="<!--{$EDIT_T_LEMBUR__TANGGAL}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.lembur_tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->                                    
                                </TD>
			</TR>
                    <TR>
                        <TD>Durasi Jam Lembur  <font color="#ff0000">*</font> </TD>
                            <TD> 
                                <INPUT TYPE="text" name="lembur_durasi" value="<!--{$EDIT_T_LEMBUR__DURASI}-->" size="10" >  
                                
                            </TD>
                    </TR> 
                     <TR>
                        <TD>Rincian Lembur<font color="#ff0000">*</font> </TD>
                            <TD> 
                                <div id="lembur_cost">
                                   <TABLE class='tborder' border='0' cellpadding='1' cellspacing='1' border='0' width='100%' align='left'>
                                       <THEAD>
                                       <th class='tdatahead' align='left' width='10%'>Nominal Lembur/Jam</th>
                                         <th class='tdatahead' align='left' width='10%'>Jumlah Lembur</th>
                                         <th class='tdatahead' align='left' width='10%'>Uang Makan</th>
                                         <th class='tdatahead'  align='left'  width='10%'>Uang Transport</th>
                                         <th class='tdatahead'  align='left'  width='10%'>Total</th>
				  </THEAD>
                                  <TR>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_nominal' value=<!--{$EDIT_T_LEMBUR__NOMINAL}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_jml' value=<!--{$EDIT_T_LEMBUR__NOMINAL_JML}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_makan' value=<!--{$EDIT_T_LEMBUR__MAKAN}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_transport' value=<!--{$EDIT_T_LEMBUR__TRANSPORT}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_total' value=<!--{$EDIT_T_LEMBUR__TOTAL}-->></TD>
                                   </TABLE>
                      
                            </div>
                        <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;"  value="Hitung" onclick="cek_lembur()" />
                            </TD>
                    </TR>
                    
                    
                    
                     <TR>
                                <TD>Job Description <font color="#ff0000">*</font></TD>
                                <TD><textarea rows="5" cols="55" NAME="lembur_deskripsi"  size="12" ><!--{$EDIT_T_LEMBUR__JOB_DESCRIPTION}--></textarea></TD>
                    </TR>
                     <TR>
                                <TD>Hasil Evaluasi Atasan <font color="#ff0000">*</font></TD> 
                                <TD><textarea rows="5" cols="55" NAME="lembur_evaluasi"  size="12" ><!--{$EDIT_T_LEMBUR__JOB_EVALUASI}--></textarea></TD>
                    </TR>
                    <TR>
                    </TR>
                    <TR>
                                <TD>Approval <font color="#ff0000">*</font></TD> 
					<TD><SELECT name="approval">
							<OPTION value="">[Pilih Approval]</OPTION>
							<OPTION value="1" <!--{if $EDIT_T_LEMBUR__APPROVAL=='1'}-->selected<!--{/if}-->>Disetujui HRD</OPTION>
                                                        <OPTION value="2" <!--{if $EDIT_T_LEMBUR__APPROVAL=='2'}-->selected<!--{/if}-->>Tidak Disetujui</OPTION>
						</SELECT>
                                </TD>
                    </TR>
                    <INPUT TYPE="hidden" name="mod_id" value="<!--{$EDIT_T_LEMBUR__ATASAN_NIP}-->">
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
                </form>
 </td></tr>
 </table>
 </DIV>

<!--close_form_tambah-->

<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR><TD>
		<DIV ID="_menuEdit_1">
<!--form_cari-->
<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">

		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box" >
                <TR>
                <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang_cari" onchange="cari_subcab2(this.value);"> 
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

                                                                   <select name="kode_cabang_cari" >
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
                                                        <TD>Pilih Sub Cabang</TD>
								<TD>
                                                                    <DIV id="ajax_subcabang2">
                                                                       <select name="kode_subcab_cari">
                                                                            <option value="">[Pilih Sub Cabang]</option>
                                                                            <!--{section name=x loop=$DATA_SUBCABANG}-->
                                                                            <!--{if trim($DATA_SUBCABANG[x].r_subcab__id)==0}-->
                                                                            <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->" selected > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->"  > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
                                                                       </select> 
                                                                          
                                                                    </DIV>
                                                                </TD>
							</TR>
                                                        
                                                        
                                                      <TR>
								<TD>Departemen</TD>
								<TD>
                                                                            <select name="departemen_cari" >
                                                                            <option value="">[Pilih Departemen]</option>
                                                                            <!--{section name=x loop=$DATA_DEPARTEMEN}-->
                                                                            <!--{if trim($DATA_DEPARTEMEN[x].r_dept__id)==0}-->
                                                                            <option value="<!--{$DATA_DEPARTEMEN[x].r_dept__id}-->" selected > <!--{$DATA_DEPARTEMEN[x].r_dept__ket}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_DEPARTEMEN[x].r_dept__id}-->"  > <!--{$DATA_DEPARTEMEN[x].r_dept__ket}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
                                                                            </select> 
                                                                            
                                                   
                                                                    
                                                                </TD>
                                                     </TR>   
                            <TR>
                                    <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_pegawai_cari" ></TD>
                            </TR>
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
		<tr><td class="tcat"> Data Pengajuan Lembur</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Data Pengajuan Lembur</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
											<th class="tdatahead" align="left">NO</TH>
											<th class="tdatahead" align="left" width="10%">NAMA KARYAWAN</TH>
                                                                                        <th class="tdatahead" align="left" width="10%">NIP KARYAWAN</TH>                                                                                        
                                                                                        <th class="tdatahead" align="left" >CABANG</TH>
											<th class="tdatahead" align="left">DEPARTEMEN</TH>  
                                                                                        
											<th class="tdatahead" align="left">TGL LEMBUR</TH>
                                                                                        <th class="tdatahead" align="left">LAMA LEMBUR</TH>
											<th class="tdatahead" align="left" >NOMINAL /JAM</TH>
                                                                                        
                                                                                        <th class="tdatahead" align="left" >UANG MAKAN</TH>
                                                                                         <th class="tdatahead" align="left">UANG TRANSPORT</TH>
                                                                                        <th class="tdatahead" align="left">TOTAL</TH>
										
                                                                                        <th class="tdatahead" align="left">STATUS</TH>
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
			</tr>
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__nip}--> </TD>                                                                                        
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_cabang__nama}--> </TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].r_dept__ket}-->  </TD>
                                                                                      
                                                                                        
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].t_lembur__tanggal}--></TD>                                                                                        
											<TD class="tdatacontent"> <!--{$DATA_TB[x].t_lembur__durasi}--></TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].t_lembur__nominal}--></TD>
                                                                                        
											<TD class="tdatacontent">Rp. <!--{$DATA_TB[x].t_lembur__makan}--></TD>                                                                                        
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].t_lembur__transport}--></TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].t_lembur__total}--></TD>
                                                                                        <TD class="tdatacontent">                                                                                            
                                                                                             <!--{if ($DATA_TB[x].t_lembur__approval==1)}-->
                                                                                                       Disetujui 
                                                                                            <!--{else}-->  
                                                                                                         <font color="red">Tidak Disetujui</font>
                                                                                            <!--{/if}--> 
                                                                                          </TD>
                                                                                          <INPUT TYPE="hidden" name="t_lembur__no" value="<!--{$MOD_ID}-->">
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].t_lembur__no}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].t_lembur__no}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="13" align="center">Maaf, Data masih kosong</TD>
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

		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>
