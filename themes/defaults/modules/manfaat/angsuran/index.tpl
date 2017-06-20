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
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle">Posting</span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">Posting Angsuran Pinjaman Periode </td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="left">
                 <tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0">Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;"> 

                <FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
                
                  <TABLE width="100%" border="0" align="left" > 
                        <THEAD>
                                <TH class="tdatahead" align="left">NO</TH>
                                  <TH class="tdatahead" align="left">NIP </TH>
                                <TH class="tdatahead" align="left">NAMA </TH>
                              
                                <TH class="tdatahead" align="left">ID PJM</TH>
                                <TH class="tdatahead" align="left">CABANG </TH>
                                <TH class="tdatahead" align="left" >JENIS PINJAMAN</TH>                                                                                       
                                <TH class="tdatahead" align="left" >TOTAL PINJAMAN</TH>
                                <TH class="tdatahead" align="left" >SUDAH BAYAR</TH>
                                <TH class="tdatahead" align="left">TENOR</TH>
                                <TH class="tdatahead" align="left" >CICILAN PER BULAN</TH>   
                                <TH class="tdatahead" align="left" >STATUS</TH> 
                                 <TH class="tdatahead" align="left" >SISA</TH> 

                                <TH class="tdatahead" align="left" width="10%">APROVAL</TH>   

			
			</THEAD>
			<tbody>
			<!--{section name=x loop=$DATA_PJM}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
                           
                        <td class="tdatacontent-first-col"> <!--{$smarty.section.x.index+1}--></TD>
                        <TD class="tdatacontent" ><!--{$DATA_PJM[x].r_pnpt__nip}--></TD>
                        <TD class="tdatacontent" ><!--{$DATA_PJM[x].r_pegawai__nama}--></TD>
                        <TD class="tdatacontent" ><!--{$DATA_PJM[x].t_pjm__no_pinjaman}--></TD>
                        <TD class="tdatacontent" ><!--{$DATA_PJM[x].r_cabang__nama}--></TD>
                        <TD class="tdatacontent"><!--{if ($DATA_PJM[x].t_pjm__jenis)==1}--><font color="#1a842d">COP</font><!--{else}-->  <font color="#2785c4">PRIBADI</font><!--{/if}--></TD>
                        <TD class="tdatacontent"><!--{$DATA_PJM[x].t_pjm__total_pinjam|number_format:2:".":","}--> </TD>
                        <TD class="tdatacontent"><!--{$DATA_PJM[x].jml_sudah_bayar|number_format:2:".":","}--> </TD>
                        <TD class="tdatacontent"> <!--{$DATA_PJM[x].t_pjm__tenor}--></TD>
                        <TD class="tdatacontent"><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" name="angsuran[]"  value=" <!--{$DATA_PJM[x].t_pjm__cicilan_perbulan|number_format:0:".":","}--> "></TD>                                                                                                                                                                    
                        <TD class="tdatacontent"><!--{if ($DATA_PJM[x].sisa_status)==0}--><font color="#2605FF">Lunas</font><!--{else}--><font color="#FA0505">Belum Lunas</font><!--{/if}--></TD> 
                                
                        <TD class="tdatacontent"><!--{$DATA_PJM[x].sisa_pembayaran|number_format:0:".":","}--> </TD>
                        <TD class="tdatacontent" align="center">
                            <INPUT type="checkbox" name="no_pjm[]" id="check_list" value="<!--{$DATA_PJM[x].t_pjm__no_pinjaman}-->">
                            <INPUT type="hidden" name="jenis[]"  value="<!--{$DATA_PJM[x].t_pjm__jenis}-->">
                            <INPUT type="hidden" name="mutasi[]"  value="<!--{$DATA_PJM[x].r_pnpt__no_mutasi}-->">
                            <INPUT type="hidden" name="id_karyawan[]"  value="<!--{$DATA_PJM[x].r_pegawai__id}-->">
                            <INPUT type="hidden" name="tgl_bayar[]"  value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->">
                        
                       
                        
                    
                  
                        
                        
                        
                        </TD>

                                                                                          
											
										</TR>
                                                                                
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="7" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<!--{/section}-->
			</tbody>
                                        
										
                        <TR><TD></TD><TD>
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
                                        
                               
                                     
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Posting</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
                                       
                                        
                                 </TD>
                                 
                                 <TD colspan="4" >
                                     
                                     
                                        
                                 </TD>
                                  <TD colspan="2" >
                                     
                                     
                                        
                                 </TD>
                                 <TD colspan="3">
                                    <a style="font-size:9pt;" class="button"   name="Check_All" value="Check All" onClick="CheckAll(document.frmCreate.check_list)"><span>Checked All</span></a>
                                   <a style="font-size:9pt;" class="button"  name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.frmCreate.check_list)"><span>Unchecked All</span></a>
                                 </TD>
                                
                                
				</TR>
                                
                                <TR><td  colspan="2" style="font-size:8pt;"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td></tr>   
                                       
		</table>
               
				
					
            </table>                  
                    
                
			
                </form>
 </td></tr>
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
                                <TD>Nama karyawan </TD><TD><INPUT TYPE="text" NAME="nama_cari"></TD>
                            </TR>
                             <TR>
                                <TD>No Pinjaman </TD><TD><INPUT TYPE="text" NAME="nopjm_cari"></TD>
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
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
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
		<tr><td class="tcat">Data Pembayaran Pinjaman</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Data Pembayaran Pinjaman</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                        <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                        <TH class="tdatahead" align="left">NAMA KARYAWAN </TH>
                                                                                        <TH class="tdatahead" align="left" >NIP </TH>
                                                                                          <TH class="tdatahead" align="left" >ID PJM </TH>
											<TH class="tdatahead" align="left" >TOTAL PINJAM</TH>                                                                                       
											<TH class="tdatahead" align="left">JML CICILAN</TH>
											<TH class="tdatahead" align="left" >PEMBAYARAN</TH>                                                                                       
											<TH class="tdatahead" align="left" width="10%">SISA PEMBAYARAN</TH>    
                                                                                        <TH class="tdatahead" align="left" width="10%">STATUS</TH>  
                                                                                        </THEAD>
                                                                                        <tbody>
                                                                                        <!--{section name=x loop=$DATA_TB}-->
                                                                                        <tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                                                                                        <TD class="tdatacontent" ><!--{$DATA_TB[x].r_pegawai__nama}--></TD>
                                                                                        <TD class="tdatacontent"  ><!--{$DATA_TB[x].r_pnpt__nip}--></TD>
                                                                                        <TD class="tdatacontent"  ><!--{$DATA_TB[x].t_pjm__no_pinjaman}--></TD>
                                                                                        <TD class="tdatacontent">Rp.<!--{$DATA_TB[x].t_pjm__total_pinjam|number_format:2:".":","}--> </TD>
											<TD class="tdatacontent">Rp.<!--{$DATA_TB[x].t_pjm__cicilan_perbulan|number_format:2:".":","}--> </TD>
                                                                                        <TD class="tdatacontent">Rp.<!--{$DATA_TB[x].jml_sudah_bayar|number_format:2:".":","}--> </TD>                                                                                        
											<TD class="tdatacontent">Rp.<!--{$DATA_TB[x].sisa_pembayaran|number_format:2:".":","}--></TD>
                                                                                        <TD class="tdatacontent"><!--{if ($DATA_TB[x].sisa_status)==0}--><font color="#2605FF">Lunas</font><!--{else}--><font color="#FA0505">Belum Lunas</font><!--{/if}--></TD>
    
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
