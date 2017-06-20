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

<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/jquery.dataTables.min.css" type="text/css">
 <link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/fixedColumns.dataTables.min.css" type="text/css">
 <link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/buttons.dataTables.min.css" type="text/css">	  
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jquery-1.12.4.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jquery.dataTables.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.fixedColumns.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.buttons.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.colVis.min.js"></SCRIPT>

<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/style_sorting.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/script_sorting.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/script_p.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.flash.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jszip.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/pdfmake.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/vfs_fonts.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.html5.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.print.min.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.flash.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jszip.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/pdfmake.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/vfs_fonts.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.html5.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.print.min.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/select.dataTables.min.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.select.min.js"></SCRIPT>

<script>
$(document).ready(function() {
    var table = $('#payroll').DataTable( {
       scrollY:        "430",
       scrollX:        true,
       scrollCollapse: true,
       info:true,
      paging: false,  
       //dom: 'Bfrtip',
       //buttons: ['excel'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
       select: {style: 'single'},
       Sorting: [[ 2, "desc" ]], 
       pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
       fixedColumns:   { leftColumns: 3,rightColumns:0}
        });
        
} );
</script>

<STYLE>
/* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {width: 1100;margin: 0 auto;}
    .number_range_filter{width:100px;}
    
      div.ColVis {
        float: centerPage;
    }
  </STYLE>
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
		<TABLE id="table-search-box">
                <TR>
                    <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang_cari" onchange="cari_subcab(this.value);"> 
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
                                                                        <DIV id="ajax_subcabang">
                                                                            <select name="kode_subcab_cari" >
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
                                    <TR>
                           <TD>Jabatan <font color="#ff0000">*</font></TD>
                           <TD><DIV id="ajax_jabatan">
                                       <select name="jabatan_cari" >
                                       <option value="">[Pilih Jabatan]</option>
                                       <!--{section name=x loop=$DATA_JABATAN}-->
                                       <!--{if trim($DATA_JABATAN[x].r_jabatan__id)==0}-->
                                       <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->" selected > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                       <!--{else}-->
                                       <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->"  > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                       <!--{/if}-->
                                       <!--{/section}-->
                                       </select>
                               </DIV>
                           </TD>
                   </TR>    
                                       <TD>Status Pegawai</TD>
                                       <TD>
                                            <select name="sts_pegawai" >
                                                    <option value="">[Pilih Status pegawai]</option>
                                                    <!--{section name=x loop=$DATA_STS}-->
                                                    <!--{if trim($DATA_STS[x].r_stp__id)==0}-->
                                                    <option value="<!--{$DATA_STS[x].r_stp__id}-->" selected > <!--{$DATA_STS[x].r_stp__nama}--> </option>
                                                    <!--{else}-->
                                                    <option value="<!--{$DATA_STS[x].r_stp__id}-->"  > <!--{$DATA_STS[x].r_stp__nama}--> </option>
                                                    <!--{/if}-->
                                                    <!--{/section}-->
                                            </select> 
                                       </TD>
                                    </TR>
                                                         <TR>
							<TD>Periode Akhir Kontrak</TD>
							<TD>							
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01" >Januari</OPTION>
								<OPTION VALUE="02" >Februari</OPTION>
								<OPTION VALUE="03">Maret</OPTION>
								<OPTION VALUE="04">April</OPTION>
								<OPTION VALUE="05">Mei</OPTION>
								<OPTION VALUE="06">Juni</OPTION>
								<OPTION VALUE="07">Juli</OPTION>
								<OPTION VALUE="08">Agustus</OPTION>
								<OPTION VALUE="09">September</OPTION>
								<OPTION VALUE="10">Oktober</OPTION>
								<OPTION VALUE="11">November</OPTION>
								<OPTION VALUE="12">Desember</OPTION>				 
                                                        </SELECT> 


						<SELECT NAME="tahun" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==""}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT> 
						 </TD></TR>

							<TR>
                                                                <TD>Nama</TD>
                                                                        <TD>
                                                                            <INPUT TYPE="text" NAME="nama_karyawan_cari" value=""  id="nama_karyawan_cari"  size="35" > 
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
                                                               
                                                               <a class="button" href="#" onclick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';"  onSubmit="frmList1.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> Cari</span></a>
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
		<tr><td class="tcat">LAPORAN PEGAWAI</td></tr>
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

				<!--{if ($BULAN !='' or  $TAHUN !='' ) }-->


											<tr><td class="tdatacontent"  >PERIODE </td><td> : </td><td>
											<!--{if ($BULAN==1)}--> Januari <!--{/if}--> 
											<!--{if ($BULAN==2)}--> Februari <!--{/if}--> 
											<!--{if ($BULAN==3)}--> Maret <!--{/if}--> 
											<!--{if ($BULAN==4)}--> April <!--{/if}--> 
											<!--{if ($BULAN==5)}--> Mei <!--{/if}--> 
											<!--{if ($BULAN==6)}--> Juni <!--{/if}--> 
											<!--{if ($BULAN==7)}--> Juli <!--{/if}--> 
											<!--{if ($BULAN==8)}--> Agustus <!--{/if}--> 
											<!--{if ($BULAN==9)}--> September <!--{/if}--> 
											<!--{if ($BULAN==10)}--> Oktober <!--{/if}--> 
											<!--{if ($BULAN==11)}--> November <!--{/if}--> 
											<!--{if ($BULAN==12)}--> Desember <!--{/if}--> 									
											<!--{$TAHUN}--> &nbsp;</td></tr>
				<!--{/if}-->
				<!--{if ($KODE_KAT_KASUS !='') }-->
                                
											<tr><td class="tdatacontent">KATEGORI KASUS</td><td width="5"> : </td>
											<td colspan="2" class="tdatacontent" >
											<!--{if ($KODE_KAT_KASUS==1)}--> WNI NON TKI<!--{/if}--> 
											<!--{if ($KODE_KAT_KASUS==2)}--> TKI <!--{/if}-->  &nbsp;
											</td>
											</tr>
					<!--{/if}-->
											</table>
										   </TD>
											</TR>
			


								<TR>
									<TD COLSPAN="2">
									 <table id="payroll" class="display" cellpadding="4" cellspacing="6" width="100%" >									
									<thead >									 
									<TH class="alt2" align="left">NO </TH>
                                                                        <TH class="alt2"  align="left">NIP </TH>
                                                                        <TH class="alt2" align="left">ID FINGER </TH>
									<TH class="alt2" align="left">NAMA PEGAWAI</TH>
									<TH class="alt2" align="left">SUB CABANG</TH>
									<TH class="alt2" align="left">DEPARTEMEN</TH>
                                                                        <TH   class="alt2" align="left">JABATAN</TH>
                                                                        <TH  class="alt2" align="left">LEVEL JABATAN</TH>
                                                                        <TH  class="alt2" align="left">STATUS PEGAWAI</TH>
                                                                        <TH class="alt2"  align="left">AWAL KONTRAK</TH>
                                                                        <TH class="alt2" align="left">AKHIR KONTRAK</TH>
                                                                        <TH class="alt2" align="left">NO REK</TH>
                                                                        <TH   class="alt2" align="left">SHIFT</TH>
                                                                                        
											
 									 
																			 
										</thead>
										
										<tbody class="tdatacontent"> 									
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
                                                                                    <TD> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>  
                                                                                    <TD><!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                                                                                    <TD><!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                                                                                    <TD><!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                                                                                    <TD><!--{$DATA_TB[x].r_subcab__nama}--></TD>
                                                                                    <TD><!--{$DATA_TB[x].r_dept__ket}--></TD>
                                                                                    <TD><!--{$DATA_TB[x].r_jabatan__ket}--></TD>
                                                                                    <TD><!--{$DATA_TB[x].r_level__ket}--></TD>
                                                                                    <TD><!--{$DATA_TB[x].r_stp__nama}--></TD>
                                                                                    <TD ><!--{if ($DATA_TB[x].r_stp__id)<4}-->
                                                                                            <!--{$DATA_TB[x].r_pnpt__kon_awal|date_format:"%d-%m-%Y"}--> 
                                                                                        <!--{else}-->Tetap<!--{/if}--></TD>
                                                                                   <TD > <!--{if ($DATA_TB[x].r_stp__id)<4}-->
                                                                                         <!--{$DATA_TB[x].r_pnpt__kon_akhir|date_format:"%d-%m-%Y"}-->
                                                                                        <!--{else}-->
                                                                                          Tetap
                                                                                         <!--{/if}-->
                                                                                    <!--{if ($DATA_TB[x].warning) ==(-2) and ($DATA_TB[x].r_stp__id)<4}-->
                                                                                    <br><font color="#c45f36"><b>Kontrak Akan Habis 2 Bulan lagi</b></font>
                                                                                   <!--{elseif ($DATA_TB[x].warning) ==(-1)and ($DATA_TB[x].r_stp__id)<4}-->
                                                                                   <br> <font color="#ea4402"><b>Kontrak Akan Habis 1 Bulan lagi</b></font>
                                                                                   <!--{elseif ($DATA_TB[x].warning)==0 and ($DATA_TB[x].r_stp__id)<4}-->
                                                                                   <br> <font color="#f48342"><b>Kontrak Akan Segera habis</b></font>
                                                                                    <!--{elseif ($DATA_TB[x].warning)>=0 and ($DATA_TB[x].r_stp__id)<4}-->
                                                                                   <br> <font color="#ff0000"><b>Kontrak Sudah habis</b></font>
                                                                                   <!--{elseif ($DATA_TB[x].r_stp__id)<4}-->
                                                                                   <br> <font color="#4286f4"><b>Kontrak Masih Berjalan</b></font>
                                                                                   <!--{/if}--></TD>
                                                                                       <TD ><!--{$DATA_TB[x].r_pegawai__bank1_norek}--></TD>
                                                                                        <TD ><!--{$DATA_TB[x].r_shift__ket}--></TD>

										<!--{sectionelse}-->
										<TR>
											<TD  COLSPAN="16" align="center">Maaf, Data Masih Kosong</TD>
										</TR>
										<!--{/section}-->
										</tbody>
                                                                           </TABLE>
                                                                                <TABLE>
                                                                                <TR><!--{section name=y loop=$DATA_TB4}-->
										<Td  colspan="10" align="right" ><b>JML Karyawan : </b></td>	
										<Td  colspan="4"  align=" " > <!--{$DATA_TB4[y].total_orang}--> Orang </td>	
                                                                                <!--{/section}-->
										</TR>
                                                                                                
                                                                                                
                                                                                                
                                                                                                
									</TABLE></TD> 
										  


								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>


									<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
									&nbsp;&nbsp;
                                                                    <IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Download';" onMouseOut="document.frmList.print_desc.value='';" 
                                                                    onClick = "window.open('<!--{$FILES}-->');">							
									</div>
					</FORM>
<!--CLOSE_VIEW_INDEX-->
					<!--{/if}-->

	</DIV>

</BODY>
</HTML>