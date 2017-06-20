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
   // background: #c3daf9 url("../images/layout/bg000000.gif") repeat-x scroll 0 0;
    color: #083772;
    font-size: 12px;
    
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
<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/select.dataTables.min.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.select.min.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->


<script>
 $(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "430",
        scrollX:        true,
        scrollCollapse: true,
        info:true,
       // paging: true,  
         dom: 'Bfrtip',
        buttons: ['excel','copy'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
        select: {style: 'single'},
          Sorting: [[ 2, "desc" ]], 
          pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
       fixedColumns:   { leftColumns: 2}

        });
        
} );   
/*     $(document).ready(function() {
    var table = $('#verifikasi').DataTable( {
        scrollY:        "430",
        scrollX:        "100",
        scrollCollapse: true,
        columnDefs: [
            { width: '5%', targets: 0 }
        ], 
        info:true,
        paging: false,
       dom: 'Bfrtip',
      buttons: ['excel'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
        select: {style: 'single'},
          Sorting: [[ 2, "desc" ]], 
         // pageLength: "50"
    // lengthMenu: [ 50, 100, 300, 1000],
     fixedColumns: true, fixedColumns:   { leftColumns: 3,rightColumns:0 }

    } );
   
    
} );*/
    
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#verifikasi tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#verifikasi').DataTable(
    {
        //scrollY: "430",
       //scrollX: "100",
        scrollCollapse: true,
       // columnDefs: [
        //    { width: '5%', targets: 0 }
       // ], 
    serching:true,
    ordering: true,
    info:true,
    paging: false,
     //  dom: 'Bfrtip',
     // buttons: ['excel'],
    language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
    select: {style: 'single'}
      //    Sorting: [[ 2, "desc" ]], 
         // pageLength: "50"
    // lengthMenu: [ 50, 100, 300, 1000],
  // fixedColumns: true, fixedColumns:   { leftColumns: 3,rightColumns:0 }

    } 
    
    
    
    );
 
    // Apply the search
   table.columns().every( function () {
       var that = this;
 
  $( 'input', this.footer() ).on( 'keyup change', function () {
          if ( that.search() !== this.value ) {
            that
                .search( this.value )
             .draw();
      }
     } );
  } );

      
      
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
  
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
  </STYLE>
</HEAD>

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--tombol_tambah -->
<div id="add-search-box">
<!--{if $OPT==0}-->        
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>     
   <!--{/if}-->    
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
                            
<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">   
<table border="0" class="tborder" cellpadding="4" cellspacing="1" border="0" width="100%" >
<tr><td class="tcat" colspan="22">
        <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
<INPUT TYPE="hidden" name="op" value="0">
<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>   
</td></tr></TABLE>

<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Rekap Data Kehadiran Oleh <!--{$NAMA_PRIV}--></td></tr>
<tr><td class="alt2" style="padding:0px;">

<table id="verifikasi" class="display" cellpadding="6" cellspacing="1" width="100%">
<thead class="tdatahead">
        <tr>
                <th  class="alt2"  align="left">NO</TH>
                <th class="alt2"  align="center">ID FINGER</TH>
                <th  class="alt2" align="center">NAMA</TH>											
                <th  class="alt2"  align="center" >CABANG</TH>
                <th  class="alt2"  align="center" >SUB CABANG</TH>
                <th  class="alt2"  align="center" >DEPARTEMEN</TH>
                <th  class="alt2"  align="center" >JABATAN</TH>
                <th  class="alt2"  align="center" >AWAL</TH>
                <th  class="alt2"  align="center" >AKHIR</TH>
                <th  class="alt2"  align="center" >MAKS HK</TH>
                 <th  class="alt2"  align="center" >STATUS AKTIF</TH>
                <th  class="alt2"  align="center" >APPROVAL STATUS</TH>
               
                <th  class="alt2"  align="center" >HADIR</TH>
                <th  class="alt2"  align="center" >SAKIT</TH>
                <th  class="alt2"  align="center" >IZIN</TH>
                <th  class="alt2"  align="center" >ALPA</TH>
                <th  class="alt2"  align="center" >DINAS</TH>
                <th  class="alt2"  align="center" >CUTI</TH>
                <th  class="alt2"  align="center" >KETERANGAN</TH>
             
        </tr>
</thead>

 <tfoot>
             <tr>
                <th  class="alt2"  align="left">NO</TH>
                <th class="alt2"  align="center">ID FINGER</TH>
                <th  class="alt2" align="center">NAMA</TH>											
                <th  class="alt2"  align="center" >CABANG</TH>
                <th  class="alt2"  align="center" >SUB CABANG</TH>
                <th  class="alt2"  align="center" >DEPARTEMEN</TH>
                <th  class="alt2"  align="center" >JABATAN</TH>
                <th  class="alt2"  align="center" >AWAL</TH>
                <th  class="alt2"  align="center" >AKHIR</TH>
                <th  class="alt2"  align="center" >MAKS HK</TH>
                 <th  class="alt2"  align="center" >STATUS AKTIF</TH>
                <th  class="alt2"  align="center" >APPROVAL STATUS</TH>
               
                <th  class="alt2"  align="center" >HADIR</TH>
                <th  class="alt2"  align="center" >SAKIT</TH>
                <th  class="alt2"  align="center" >IZIN</TH>
                <th  class="alt2"  align="center" >ALPA</TH>
                <th  class="alt2"  align="center" >DINAS</TH>
                <th  class="alt2"  align="center" >CUTI</TH>
                <th  class="alt2"  align="center" >KETERANGAN</TH>
             
        </tr>
        </tfoot>
<tbody class="tdatacontent">
<!--{section name=x loop=$DATA_RKP}-->
<tr>
<TD><!--{$smarty.section.x.index+1}-->.</TD>
<TD align="center"> <!--{$DATA_RKP[x].r_pnpt__finger_print}--> </TD>
<TD align="center"> <!--{$DATA_RKP[x].r_pegawai__nama}--></TD>
<TD align="center"><!--{$DATA_RKP[x].r_cabang__nama}-->  </TD>
<TD align="center"><!--{$DATA_RKP[x].r_subcab__nama}--> </TD> 
<TD align="center"><!--{$DATA_RKP[x].r_dept__ket}--> </TD>
<TD align="center"><!--{$DATA_RKP[x].r_jabatan__ket}--> </TD>
<TD align="center"><!--{$DATA_RKP[x].t_rkp__awal}--></TD>
<TD align="center"><!--{$DATA_RKP[x].t_rkp__akhir}--> </TD>
<TD align="center"><!--{$DATA_RKP[x].mx_day}--> 
<INPUT type="hidden"  name="mutasi[]" value="<!--{$DATA_RKP[x].r_pnpt__no_mutasi}-->">
<INPUT type="hidden" name="awal[]" value="<!--{$DATA_RKP[x].t_rkp__awal}-->">
<INPUT type="hidden" name="akhir[]" value="<!--{$DATA_RKP[x].t_rkp__akhir}-->">
<INPUT type="hidden" name="status[]" value="<!--{$DATA_RKP[x].t_rkp__approval}-->">
<INPUT type="hidden" name="akhir[]" value="<!--{$DATA_RKP[x].t_rkp__akhir}-->">
</TD>
<TD align="center">
<!--{if ($DATA_RKP[x].ket_keluar) ==0}-->Aktif<!--{else}-->  <font color="#ff0000">Resign</font>
                    <!--{/if}-->  </TD>
<TD align="center"  >  
<!--{if ($DATA_RKP[x].t_rkp__approval) ==1}-->
Telah disetujui HRD
<!--{elseif ($DATA_RKP[x].t_rkp__approval) ==2 &&  $JENIS_USER_SES!='1'}-->
<font color="green">Telah disetujui BOM</font>
<!--{elseif ($DATA_RKP[x].t_rkp__approval) ==2 &&  $JENIS_USER_SES=='1'}-->
<font color="green"> Telah disetujui Koordinator</font>
<!--{elseif ($DATA_RKP[x].t_rkp__approval) ==3}-->  
<font color="#1384a0">Telah disetujui HGLM</font>
<!--{elseif ($DATA_RKP[x].t_rkp__approval) ==4}-->  
<font color="#d15e93">Closing</font>
<!--{else}-->  
<font color="#ff0000">Kehadiran Kosong</font>
<!--{/if}-->

</TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="hadir[]" value="<!--{$DATA_RKP[x].t_rkp__hadir|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :Right;"> </TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="sakit[]" value="<!--{$DATA_RKP[x].t_rkp__sakit|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :Right;"></TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="izin[]" value="<!--{$DATA_RKP[x].t_rkp__izin|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :Right;"> </TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="alpa[]" value="<!--{$DATA_RKP[x].t_rkp__alpa|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :Right;"> </TD>
<TD align="left"><input  maxlength="2" size="2" type="text" name="dinas[]" value="<!--{$DATA_RKP[x].t_rkp__dinas|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :Right;"></TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="cuti[]" value="<!--{$DATA_RKP[x].t_rkp__cuti|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :Right;"></TD>
<TD align="center"  > 
<textarea name="keterangan[]" cols="5" rows="1"><!--{$DATA_RKP[x].t_rkp__keterangan}--></textarea>

</TD>

              
                

        </TR>
        <!--{sectionelse}-->
        <TR>
                <TD  COLSPAN="16" align="center">Maaf, Data masih kosong</TD>
        </TR>
<!--{/section}-->
</tbody>
</table>

                       
      </td></tr>
		</table>       
				
</form>

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
                    
		<TR>
                                <TD>Cabang <font color="#ff0000">*</font></TD> 
				<TD>
					<!--{if ($JENIS_USER_SES==1)}-->

								<select name="kode_perwakilan_cari" onchange="cari_subcab(this.value);">
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

					<select name="kode_perwakilan_cari  >
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
							
							
							
                                                        
                        <TR><TD>Nama Karyawan </TD><TD><INPUT TYPE="text" NAME="nama_karyawan_cari" size="30"></TD></TR>
                        <TR><TD>ID Finger </TD><TD><INPUT TYPE="text" NAME="id_finger_cari" size="30"></TD></TR>
			<TR>
							<TD>Periode</TD>
							<TD>							
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01" <!--{if $BULAN_SES==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="02"<!--{if $BULAN_SES==2}-->selected<!--{/if}-->>Februari</OPTION>
								<OPTION VALUE="03"<!--{if $BULAN_SES==3}-->selected<!--{/if}-->>Maret</OPTION>
								<OPTION VALUE="04"<!--{if $BULAN_SES==4}-->selected<!--{/if}-->>April</OPTION>
								<OPTION VALUE="05"<!--{if $BULAN_SES==5}-->selected<!--{/if}-->>Mei</OPTION>
								<OPTION VALUE="06"<!--{if $BULAN_SES==6}-->selected<!--{/if}-->>Juni</OPTION>
								<OPTION VALUE="07"<!--{if $BULAN_SES==7}-->selected<!--{/if}-->>Juli</OPTION>
								<OPTION VALUE="08"<!--{if $BULAN_SES==8}-->selected<!--{/if}-->>Agustus</OPTION>
								<OPTION VALUE="09"<!--{if $BULAN_SES==9}-->selected<!--{/if}-->>September</OPTION>
								<OPTION VALUE="10"<!--{if $BULAN_SES==10}-->selected<!--{/if}-->>Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $BULAN_SES==11}-->selected<!--{/if}-->>November</OPTION>
								<OPTION VALUE="12"<!--{if $BULAN_SES==12}-->selected<!--{/if}-->>Desember</OPTION>				 
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
		<tr><td class="tcat">Verifikasi Rekap Data Absen <!--{$NAMA_PRIV}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Periode aktif  Mulai : <!--{$PERIODE_AWAL|date_format:"%d-%B-%Y"}--> s/d <!--{$PERIODE_AKHIR|date_format:"%d-%B-%Y"}--> </td></tr>
                        <tr><td class="alt2" style="padding:0px;">
                    
             
		
<table id="example" class="display" cellpadding="6" cellspacing="6" width="100%">
             <thead class="tdatahead">
		<tr>
					<th width="4%" rowspan="2" align="left" class="alt2">NO</TH>							
					<th width="8%" rowspan="2" align="left" class="alt2" >CABANG</TH>
					<th width="13%" align="left" class="alt2" >PERIODE AWAL</TH>
					<th width="13%" align="left" class="alt2" >PERIODE AKHIR</TH>
					<th width="4%" rowspan="2" align="left" class="alt2" >HK</TH>
					<th colspan="3" align="left" class="alt2" ><div align="center">PEGAWAI</div></TH>
					<th align="left" class="alt2" ><div align="center">REKAP ABSEN </div></TH>
                    <th colspan="5" align="left" class="alt2" ><div align="center">APPROVAL</div></TH>
                                    
	          </tr>
			<tr>
			  <th width="13%" align="left" class="alt2" >
                              <!--{if ($AWAL_CARI)!=''}--> 
                              <!--{$AWAL_CARI}-->
                            <!--{else}--> 
                            <!--{$PERIODE_AWAL}-->
                                 <!--{/if}--></TH>
                            <th width="13%" align="left" class="alt2" > <!--{if ($AWAL_CARI)!=''}--> 
                              <!--{$AKHIR_CARI}-->
                            <!--{else}--> 
                            <!--{$PERIODE_AKHIR}-->
                                 <!--{/if}--></TH>
                            <th width="11%" align="left" class="alt2" ><div align="left">PEG AWAL </div></TH>
                            <th width="11%" align="left" class="alt2" ><div align="left">PEG RESIGN </div></TH>
                            <th width="11%" align="left" class="alt2" ><div align="left">PEG AKTIF </div></TH>
                            <th width="7%" align="left" class="alt2" >TDK ADA ABSEN</TH>
                            <th width="8%" align="left" class="alt2" > HRD</TH>
                            <th width="14%" align="left" class="alt2" >BOM/KOORD</TH>
                            <th width="9%" align="left" class="alt2" > HGLM</TH>
                            <th width="9%" align="left" class="alt2" >CLOSING</TH>
							  <th width="9%" align="left" class="alt2" >AKSI</TH>
			</tr>
			</thead>
			<tbody class="tdatacontent" >
			<!--{section name=x loop=$DATA_TB}-->
			<tr>
                        <TD  align="center"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                        <TD align="left"> <!--{$DATA_TB[x].r_cabang__nama}-->  </TD>
                        <TD align="center"> <!--{if ($DATA_TB[x].t_rkp__awal)>0}--> <!--{$DATA_TB[x].t_rkp__awal}-->
                            <!--{else}--> <font color="#ff0000">Blm ada Rkp Absen</font> 
                                 <!--{/if}--> </TD>
                        <TD align="center"><!--{if ($DATA_TB[x].t_rkp__akhir)>0}--> <!--{$DATA_TB[x].t_rkp__akhir}-->
                            <!--{else}--> <font color="#ff0000">Blm ada Rkp Absen</font> 
                                 <!--{/if}--> </TD>
                        <TD align="center"> <!--{$DATA_TB[x].mx_day}--> </TD>
                        <TD align="center"><font color="#0c49f2"> <!--{$DATA_TB[x].rkp_peg}--></font> </TD>
			<TD> <!--{$DATA_TB[x].rkp_resign}--> </TD>
			<TD> <font color="#0c49f2"><!--{$DATA_TB[x].rkp_peg_aktif}--></font> </TD>
                        <TD align="center"><font color="#ff0000"><!--{$DATA_TB[x].rkp_nol}--></font> </TD>
                        <TD align="center"><font color="#137477"><!--{$DATA_TB[x].rkp_hrd}--></font> </TD>
                        <TD align="center"><font color="#28490a"><!--{$DATA_TB[x].rkp_bom}--></font> </TD>
                        <TD align="center"><font color="#310538"><!--{$DATA_TB[x].rkp_hglm}--></font> </TD>
                         <TD align="center"><font color="#a00404"><!--{$DATA_TB[x].rkp_closing}--></font> </TD>
                          <TD width="20" ALIGN="CENTER">
                                    <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/tick.png" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_cabang__id}-->&tahun=<!--{$DATA_TB[x].t_rkp__thn}-->&bulan=<!--{$DATA_TB[x].t_rkp__bln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink">
                                  </TD>
                        </TR>
                        <!--{sectionelse}-->
                        <TR>
                                <TD COLSPAN="18" align="center">Maaf, Data masih kosong</TD>
                        </TR>
			<!--{/section}-->
			</tbody>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>