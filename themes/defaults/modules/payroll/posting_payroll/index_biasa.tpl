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
	var tableWidget_okToSort = true;
	var tableWidget_arraySort = new Array();
	tableWidget_tableCounter = 1;
	var activeColumn = new Array();
	var currentColumn = false;

	

	
	
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
<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/modules/payroll/posting_payroll/style_sorting.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/modules/payroll/posting_payroll/script_sorting.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/modules/payroll/posting_payroll/script_p.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-sack.js"></SCRIPT>


<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/modules/payroll/posting_payroll/media/js/jquery-1.12.4.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/modules/payroll/posting_payroll/media/js/jquery.dataTables.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></SCRIPT>


<link rel="stylesheet" type="text/css" href="<!--{$HREF_JS_PATH}-->/modules/payroll/posting_payroll/media/css/jquery.dataTables.css">



<script>
$(document).ready(function() {
    var table = $('#payroll').DataTable( {
       
        paging:false,
        ordering:true,
        label:false,
        info:true,
        fixedColumns:   {
           leftColumns: 0,
            rightColumns: 0
        }
    } );
} );
   
</script>
<style>
div.dataTables_wrapper {
 margin-bottom: 0.5em;
   
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
    <!--tombol_tambah  -->
<div id="add-search-box">
<!--{if $EDIT_VAL==0}-->
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
<!--{else}-->
 
 <!--{/if}-->
</div>
<!--tombol_tambah  -->

<!--form_tambah -->

<DIV ID="_menuEntry1_1" style="top:10px; width:100%; display:none;position:absolute;">
<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
    <table border="0" class="tborder" cellpadding="4" cellspacing="1" border="0" width="180%" >
<tr><td class="tcat" colspan="22">
<a class="button" href="#" name="Check_All" value="CheckAll" onClick="CheckAll(document.frmCreate.check_list)"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/tick.png" align="absmiddle"> Approve All</span></a>
<a class="button" href="#" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.frmCreate.check_list)"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/purge.gif" align="absmiddle"> Unchecked All</span></a>
	<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
				  <a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Posting</span></a>
                                   <a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>   
                             	
                                       
    
    
    </td></tr></TABLE>
		
<table border="0" class="tborder" cellpadding="4" cellspacing="1" border="0" width="180%" >
   <THEAD>
       <TR> <TD class="thead">Approval Salary Per Periode <!--{$PRE_ACTIVE|date_format:"%d %B-%Y"}--> s/d <!--{$END_ACTIVE|date_format:"%d %B-%Y"}--> </TD>
  
    </TR>
    </THEAD></TABLE>
		
<table id="payroll" class="display" cellpadding="4" cellspacing="6" width="100%">
    <thead>
        <tr>
             <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>NO</u><br>A </font></TH>
          <TH class="tdatahead" align="center"><img src="<!--{$HREF_IMG_PATH}-->/icon/tick.png" align="absmiddle"><br>B</TH>   
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>NAMA</u><br>C</font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>JABATAN</u><br>D</font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>LEVEl</u><br>E</font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>SB LOKASI</u><br>F</font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>LAMA(BLN)</u><br>G</font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>JML HADIR</u><br>F</font></TH>                                
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>GAJI POKOK</u><br>G</font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>T.JABATAN</u><br>H</font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>T.TRANS</u><br>I</font></TH>         
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>T.MAKAN</u><br>J</font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>T.KOSAN</u><br>K</font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>T.LAIN-LAIN</u><br>L</font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>KEMAHALAN</u><br>M</font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>GAJI NETTO</u><br>N</font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>DASAR BPJS</u><br>O</font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;">BPJS TK Perus 0,0424<BR>P </font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;">BPJS TK Kary 0,02<BR>Q </font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;">BPJS Kes Peru 0,040<BR>R </font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;">BPJS Kes Kar 0,010<BR>S </font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>ANGSURAN</u><BR>T</font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>KOREKSI LAIN</u><BR>U</font></TH> 
            <TH class="tdatahead" align="center" ><Font style="font-size:10;"><u>THP</u><BR>V</font></TH> 
</tr>
    </thead>
  
 
    <!-- isi kontent  -->
    <tbody class="tdatacontent">
<!--{section name=x loop=$DATA_PJM}-->
                <tr>
            <td class="tdatacontent-first-col"><!--{$smarty.section.x.index+1}--></td>
            <TD align="center"><INPUT type="checkbox" name="approval[]" id="check_list" value="<!--{$DATA_PJM[x].id_pegawai}-->" > </TD>
            <TD><input type="hidden"  name="mutasi[]" value="<!--{$DATA_PJM[x].r_pnpt__no_mutasi}-->"><Font style="font-size:12;"><!--{$DATA_PJM[x].r_pegawai__nama}--></TD>
            <TD><input type="hidden" name="jabatan[]" value="<!--{$DATA_PJM[x].r_jabatan__ket}-->"><!--{$DATA_PJM[x].r_jabatan__ket}--></TD>
            <TD><input type="hidden" name="level[]" value="<!--{$DATA_PJM[x].r_level__ket}-->"><!--{$DATA_PJM[x].r_level__ket}--></TD>
            <TD>
               
                <input type="hidden" name="cabang__id[]" value="<!--{$DATA_PJM[x].r_cabang__id}-->">
                <input type="hidden" name="cabang__nama[]" value="<!--{$DATA_PJM[x].r_cabang__nama}-->">   
                <input type="hidden" name="subcab__id[]" value="<!--{$DATA_PJM[x].r_subcab__id}-->">
                <input type="hidden" name="subcab__nama[]" value="<!--{$DATA_PJM[x].r_subcab__nama}-->">    
                <input type="hidden" name="nip[]" value="<!--{$DATA_PJM[x].r_pnpt__nip}-->"> 
                <input type="hidden" name="nama[]" value="<!--{$DATA_PJM[x].r_pegawai__nama}-->"> 
                
                <input type="hidden" name="bank_nama[]" value="<!--{$DATA_PJM[x].r_pegawai__bank1}-->"> 
                <input type="hidden" name="bank_akun_peg[]" value="<!--{$DATA_PJM[x].r_pegawai__bank1_rek}-->"> 
                <input type="hidden" name="bank_norek[]" value="<!--{$DATA_PJM[x].r_pegawai__bank1_norek}-->"> 
                <input type="hidden" name="bank_alm[]" value="<!--{$DATA_PJM[x].r_pegawai__bank1_alm}-->"> 
                <input type="hidden" name="nama_pegawai[]" value="<!--{$DATA_PJM[x].r_pegawai__nama}-->"> 
               <!--{$DATA_PJM[x].r_subcab__nama}--></TD>
            <TD>

            <input type="hidden" name="tgl_masuk[]" value="<!--{$DATA_PJM[x].r_pegawai__tgl_masuk}-->">   
            <input type="hidden" name="lama_bln[]" value="<!--{$DATA_PJM[x].lama_bln}-->"> 
            <input type="hidden" name="dept__ket[]" value="<!--{$DATA_PJM[x].r_dept__ket}-->"> 
            <input type="hidden" name="dept__cc[]" value="<!--{$DATA_PJM[x].r_dept__cc}-->"> 
            <input type="hidden" name="dept__id[]" value="<!--{$DATA_PJM[x].r_dept__id}-->"> 

             <!--{$DATA_PJM[x].lama_bln}--> </TD>
                        <TD >
                            <input type="hidden" name="rekap_awal[]" value="<!--{$DATA_PJM[x].t_rkp__awal}-->">   
                            <input type="hidden" name="rekap_akhir[]" value="<!--{$DATA_PJM[x].t_rkp__akhir}-->"> 
                            <input type="hidden" name="rekap_hadir[]" value="<!--{$DATA_PJM[x].absen_hadir}-->"> 
                            <input type="hidden" name="rekap_sakit[]" value="<!--{$DATA_PJM[x].t_rkp__sakit}-->">   
                            <input type="hidden" name="rekap_izin[]" value="<!--{$DATA_PJM[x].t_rkp__izin}-->">   
                            <input type="hidden" name="rekap_cuti[]" value="<!--{$DATA_PJM[x].t_rkp__cuti}-->"> 
                            <input type="hidden" name="rekap_dinas[]" value="<!--{$DATA_PJM[x].t_rkp__dinas}-->">
                            <input type="hidden" name="rekap_alpa[]" value="<!--{$DATA_PJM[x].t_rkp__alpa}-->">
                         <textarea name="ket_resign[]" style="display:none;" rows="4" cols="50"><!--{$DATA_PJM[x].ket_resign}--></textarea>
                          H=<!--{$DATA_PJM[x].absen_hadir}--><br>     
                          Ket=<!--{if ($DATA_PJM[x].ket_resign) ==1}--><font color="#ff0000">Resign</font>     
                        <!--{else}-->  
                       aktif</font>
                        <!--{/if}--> 
                  
                        
                        </TD>
                        
                        <TD > <input type="hidden" name="gapok[]" value="<!--{$DATA_PJM[x].gapok}-->"> <!--{$DATA_PJM[x].gapok|number_format:0:".":","}--></TD><!-- gajipokok -->
                        <TD ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="7" name="t_jabatan[]" value="<!--{$DATA_PJM[x].tunj_jabatan|number_format:0:".":","}-->"></TD><!-- t.jabatan -->
                        <TD ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="7"  name="t_transport[]" value="<!--{$DATA_PJM[x].gaji_transport|number_format:0:".":","}-->"></TD><!-- t.tranportasi -->
                        <TD ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="7"  name="t_makan[]"  value="<!--{$DATA_PJM[x].gaji_makan|number_format:0:".":","}-->"></TD><!-- t.makan -->
                        <TD ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="7"  name="t_kosan[]"  value="<!--{$DATA_PJM[x].r_level__kosan|number_format:0:".":","}-->"></TD><!-- t.kosan -->
                        <TD ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="7"  name="t_lainlain[]" value="<!--{$DATA_PJM[x].tunj_lain|number_format:0:".":","}-->"></TD><!-- t.lainlain -->
                        <TD ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="7"  name="kemahalan[]" value="<!--{$DATA_PJM[x].tunj_kemahalan|number_format:0:".":","}-->"></TD><!-- kemahalan -->
                        <TD ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="8"  name="gaji_kotor[]" value="<!--{$DATA_PJM[x].gaji_netto|number_format:0:".":","}-->"></TD><!-- GAJI KOTOR -->
                        <TD ><INPUT type="hidden"name="dasar_bpjs[]" value="<!--{$DATA_PJM[x].dasar_bpjs}-->"><!--{$DATA_PJM[x].dasar_bpjs|number_format:0:".":","}--></TD><!-- dasar_bpjs -->
                        <TD ><INPUT type="hidden"name="bpjs_tk_tmw[]" value="<!--{$DATA_PJM[x].dasar_bpjs*0.0424}-->"><!--{$DATA_PJM[x].dasar_bpjs*0.0424|number_format:0:".":","}--></TD><!-- bpjs TK TMW -->
                        <TD ><INPUT type="hidden"name="bpjs_tk_peg[]"  value="<!--{$DATA_PJM[x].dasar_bpjs*0.02}-->"><font color="#2200ff"><!--{$DATA_PJM[x].dasar_bpjs*0.02|number_format:0:".":","}--></font></TD><!-- bpjs TK karyawan -->
                        <TD ><INPUT type="hidden"name="bpjs_kes_tmw[]" value="<!--{$DATA_PJM[x].dasar_bpjs*0.040}-->"><!--{$DATA_PJM[x].dasar_bpjs*0.040|number_format:0:".":","}--></TD><!-- bpjs kes TMW -->
                        <TD ><INPUT type="hidden"name="bpjs_kes_peg[]" value="<!--{$DATA_PJM[x].dasar_bpjs*0.010}-->"><font color="#2200ff"><!--{$DATA_PJM[x].dasar_bpjs*0.010|number_format:0:".":","}--></font></TD><!-- bpjs kes karyawan -->       
                        <TD ><INPUT type="hidden" size="8"  name="angsuran[]"  value="<!--{$DATA_PJM[x].angsuran}-->"><!--{$DATA_PJM[x].angsuran|number_format:0:".":","}--></TD><!-- angsuran -->  
                        <TD ><INPUT type="text" size="8"  name="koreksi[]"  value=""></TD><!-- koreksi lain -->  
                        <TD  align="center"><INPUT type="text" size="8"  name="thp[]"  value="<!--{$DATA_PJM[x].thp|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :left;"></TD>
                       
        </tr>
           <!--{sectionelse}-->
        <TR>
        <TD  COLSPAN="21" align="center">Maaf karyawan Tersebut Tidak Ada</TD>
        </TR>
	<!--{/section}-->
           
        
    </tbody>
</table>

                       
                </form>

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
                                <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_karyawan_cari" value="" ></TD>
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
		<TABLE class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
                <TR><td class="tcat"> Posting Pengajian Per Cabang  </td></tr>
		</TABLE>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Cabang <!--{$PRE_ACTIVE|date_format:"%d %B-%Y"}--> s/d <!--{$END_ACTIVE|date_format:"%d %B-%Y"}--> </td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                <THEAD>
                <tr>
                        <th class="tdatahead" align="left">NO</TH>
                        <th class="tdatahead" align="left" >CABANG</TH>
                        <th class="tdatahead" align="left">Periode Awal</TH>
                        <th class="tdatahead" align="left" >Periode Akhir</TH>
                         <th class="tdatahead" align="left" >Keterangan</TH>
                        <th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
		</tr>
		</thead>
                <tbody>
                <!--{section name=x loop=$DATA_TB}-->
                <TR class='<!--{cycle values="alt,alt3"}-->'>
                <td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
               
                <TD class="tdatacontent"> <!--{$DATA_TB[x].r_cabang__nama}--> </TD>
                <TD class="tdatacontent"> <!--{$DATA_TB[x].t_rkp__awal}-->  </TD>
                <TD class="tdatacontent"> <!--{$DATA_TB[x].t_rkp__akhir}--> </TD>
                <TD class="tdatacontent">
<!--{if ($DATA_TB[x].ket_posting)==0}-->
<font color="#450ef9">Payroll Belum Di Posting</font>
<!--{else}-->  
<font color="#ff0000">Sudah Di Posting</font>
<!--{/if}-->

                    
                    
                </TD>
                <TD width="20" class="tdatacontent" ALIGN="CENTER">
                    <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_cabang__id}-->&parent_id=<!--{$DATA_TB[x].r_subcab__parent}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
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
