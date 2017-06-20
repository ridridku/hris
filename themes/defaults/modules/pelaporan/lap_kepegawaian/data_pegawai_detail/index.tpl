<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/preload.css" type="text/css">
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/
      " type="text/css">
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
var err = 0;
var err_ = 0;
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
<!--{if $KODE_CABANG_CARI<>""}-->
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
                                                                        <DIV id="ajax_subcabang" >
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
                                                                            <select name="departemen_cari">
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
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nama_karyawan_cari" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_T_LEMBUR__PEGAWAI_NAMA}-->">
                                                                 
                                </TD>

                    </TR>
                     <TR>
                         <TD >NIP<font color="#ff0000" >*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nip_karyawan_cari" readonly id="r_pnpt__nip" size="35" value="<!--{$EDIT_T_LEMBUR__NIP}-->" >
                              
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />  
                               
                            </TD>

                    </TR>
                   

                                                                        
                                                                   

                                                                       
                                                           </TD>
                                                                                             
                                                        <TR>
								<TD></TD>
								<TD>
								<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
								<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
								<INPUT TYPE="hidden" name="search" value="1">
								<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
								<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
								<INPUT TYPE="hidden" name="op" value="0">
                                                               
<a class="button" href="#"  onclick="return checkFrm(frmList1);"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> Cari</span></a>
<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmList1); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>					
								</TD>
							</TR>	
                   
						
                </TABLE>
                                  

                                                                
			</FORM>
			</div></div>	 <!--TUTUP_PENCARIAN_DATA -->  
		</DIV>
       
														
		<!--{if $SEARCH<>""}--><br>
                <!--VIEW_INDEX-->
		<FORM METHOD=GET ACTION="" NAME="frmList">
		
		<!--<TABLE class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		</TD>	
                
		</TR>	
		</TABLE>-->
                <br>
<center>
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style2 {font-size: 14px}
-->
</style>
<table width='95%' height="124" border="0">
  <tr>
    <td width="4" height="28">&nbsp;</td>
    <td width="197" rowspan="3" align="right"><img src="http://hris.tmw.co.id/hris/images/logo_tmw.jpg" width=82 height=75 border=0 alt=""></td>
    <td width="552"><div align="center">
      <h2 class="style2">PT.TRITUNGGAL MULIA WISESA </h2>
    </div></td>
    <td width="1">&nbsp;</td>
    <td width="180" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td><div align="center"><span class="style3 style1">Jl.Kopo Jaya I No.8 Telp (022) 5416678 Fax.(022) 5415888 </span></div></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td class="style3" valign="top"><div align="center" class="style1">Kompleks Perkantoran Kopo Cirangrang - Bandung 40224 </div></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td colspan="5"><hr width="80%" size="4"></td>
  </tr>
  <tr>
    <td height="21">&nbsp;<!--{section name=x loop=$DATA_TB}--></td>
    <td>&nbsp;</td>
    <td><div align="center" class="style1">BIO DATA PEGAWAI </div></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
    <!--tutup_data-->
    <!--{sectionelse}-->
    <!--{/section}-->
</table>
<table cellpadding=2 cellspacing=0 border=0 bordercolor=#333300 width="95%">
<tr><td>

<!--{section name=x loop=$DATA_TB}-->
<!-- section I. DATA PRIBADI -->
<table cellpadding=5 cellspacing=0 border=0 width="95%" >
<tr>
	<td colspan=5></td>
	<td rowspan="14" valign=top>
            <!--<img src="http://localhost/hris/themes/defaults/images/common/image_user/admin.png" width=105 height=134 border=0 alt=""> -->
        </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top width=10>&nbsp;</td>
	<td valign=top width=150 nowrap>Nama</td>
	<td valign=top align=center width=20>:</td>
	<td valign=top width=500><!--{$DATA_TB[x].r_pegawai__nama}--> </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top width=10>&nbsp;</td>
	<td valign=top width=150 nowrap>NIP</td>
	<td valign=top align=center width=20>:</td>
	<td valign=top width=500><!--{$DATA_TB[x].r_pnpt__nip}--> </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top width=10>&nbsp;</td>
	<td valign=top width=150 nowrap>Tgl lahir</td>
	<td valign=top align=center width=20>:</td>
	<td valign=top width=500><!--{$DATA_TB[x].r_pegawai__tgl_lahir}--> </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Agama</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_agama__nama}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>No KTP</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_pegawai__ktp}--></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Propinsi</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_provinsi__nama}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Kabupaten</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_kabupaten__nama}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Kecamatan</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_kecamatan__nama}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Desa</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_desa__nama}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Alamat Domisili</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_pegawai__nama_jalan}--></td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Tgl Mulai Bekerja</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_pegawai__tgl_masuk}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Departemen</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_dept__ket}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Jabatan</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_jabatan__ket}--></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Cabang</td>
	<td valign=top align=center>:</td>
	<td valign=top><!--{$DATA_TB[x].r_cabang__nama}--></td>
</tr>


</table>
</td></tr></table>
<p>

	
<!-- section II. RIWAYAT JABATAN -->
<table cellpadding=2 cellspacing=0 border=0 width="95%">
    <tr> 
      <td><div class=head2><br>RIWAYAT JABATAN</div></td>
    </tr>

    <tr>
      <td valign=top nowrap> 
        <table border="1" cellspacing="0" cellpadding="2" bordercolor="#000000" width="100%%"%>
          <tr bgcolor="#CCCCCC"> 
            <td class=bdr><div align="center"><b>NO</b></div></td>
            <td class=bdr><div align="center"><b>KONTRAK AWAL</b></div></td>
            <td class=bdr><div align="center"><b>KONTRAK AKHIR</b></div></td>
             <td class=bdr><div align="center"><b>STATUS</b></div></td>
            <td class=bdr><div align="center"><b>JABATAN</b></div></td>
            <td class=bdr><div align="center"><b>DEPARTEMEN</b></div></td>
          </tr>

<!--{section name=x loop=$CV_JABATAN}-->					
          <tr> 
              <TD class=bdr align=right width=10 valign=top><!--{$smarty.section.x.index+1}-->.&nbsp;</td>
               <TD class=bdr align=center width=80 valign=top>
                   <!--{if ($CV_JABATAN[x].r_stp__id)<4}-->
                  <!--{$CV_JABATAN[x].r_pnpt__kon_awal|date_format:"%d-%m-%Y"}--> 
                <!--{else}-->Tetap<!--{/if}--></TD>
                <TD class=bdr align=center width=80 valign=top> <!--{if ($CV_JABATAN[x].r_stp__id)<4}-->
                  <!--{$CV_JABATAN[x].r_pnpt__kon_akhir|date_format:"%d-%m-%Y"}--> 
                <!--{else}-->Tetap<!--{/if}--></td>
                  <TD class=bdr align=center width=80 valign=top><!--{$CV_JABATAN[x].r_stp__nama}--></td>
            <TD class=bdr align=center width=80 valign=top><!--{$CV_JABATAN[x].r_jabatan__ket}--></td>
            <TD class=bdr align=center width=80 valign=top><!--{$CV_JABATAN[x].r_dept__ket}--></td>
           
          </tr>
<!--{/section}-->	

        </table>
      </td>
    </tr>
</table>
<p>
	
<!-- SECTION II. RIWAYAT PENDIDIKAN DAN PENGHARGAAN -->	
<table cellpadding=2 cellspacing=0 border=0 width="95%">
    <tr>
		<td colspan=4><div class=head2><br>RIWAYAT PENDIDIKAN</div></td>
    </tr>
    <tr> 
      <td>
        <table border="1" cellspacing="0" cellpadding="2" bordercolor="#000000" width=100%>
          <tr bgcolor="#CCCCCC"> 
              <td class=bdr width=10><div align="center"><b>NO</div></b></td>
            <td class=bdr width=175><div align="center"><b>PENDIDIKAN AKHIR</b></div></td>
            <td class=bdr><div align="center"><b>SEKOLAH / UNIVERSITAS </b></div></td>
            <td class=bdr width=200><div align="center"><b>JURUSAN</b></div></td>
            <td class=bdr width=200><div align="center"><b>TAHUN LULUS</b></div></td>
          </tr>
	<!--{section name=x loop=$CV_PENDIDIKAN}-->				
          <tr> 
            <td class=bdr align=center width=80 valign=top><!--{$smarty.section.x.index+1}-->.&nbsp;</td>
            <td class=bdr align=center width=80 valign=top><!--{$CV_PENDIDIKAN[x].r_pegawai__pend_akhir}--></td>
           <td class=bdr align=center width=80 valign=top><!--{$CV_PENDIDIKAN[x].r_pegawai__pend_sekolah}--></td>
            <td class=bdr align=center width=80 valign=top><!--{$CV_PENDIDIKAN[x].r_pegawai__pend_jurusan}--></td>
             <td class=bdr align=center width=80 valign=top><!--{$CV_PENDIDIKAN[x].r_pegawai__pend_tgl_lulus}--></td>
          </tr>
		<!--{/section}-->	
        </table>
      </td>
    </tr>
</table>  
  <P>

<!-- SECTION II. RIWAYAT PELATIHAN -->	
  <table cellpadding=2 cellspacing=0 border=0 width="95%">
    <tr>
		<td colspan=4><div class=head2><br>RIWAYAT PELATIHAN DI TMW</div></td>
    </tr>
    <tr> 
      <td>
        <table border="1" cellspacing="0" cellpadding="2" bordercolor="#000000" width=100%>
          <tr bgcolor="#CCCCCC"> 
            <td class=bdr width=10><b>NO</b></td>
            <td class=bdr><b>TEMA</b></td>
            <td class=bdr><b>TAHUN</b></td>
            <td class=bdr width=80><b>PENYELENGGARA</b></td>
            <td class=bdr width=80><b>NILAI</b></td>
          </tr>
          <!--{section name=x loop=$CV_PELATIHAN}-->				
          <tr> 
            <td class=bdr align=center width=80 valign=top><!--{$smarty.section.x.index+1}-->.&nbsp;</td>
            <td class=bdr align=center width=80 valign=top><!--{$CV_PELATIHAN[x].r_mastpel__tema}--></td>
           <td class=bdr align=center width=80 valign=top><!--{$CV_PELATIHAN[x].r_mastpel__tgl_awal|date_format:"%Y"}--></td>
            <td class=bdr align=center width=80 valign=top><!--{$CV_PELATIHAN[x].r_mastpel__penyelenggara}--></td>
             <td class=bdr align=center width=80 valign=top><!--{$CV_PELATIHAN[x].r_pel__nilai}--></td>
          </tr>
		<!--{/section}-->	

        </table>
      </td>
    </tr>
    <!--tutup_data-->
    <!--{sectionelse}-->
    <TR>
            <TD class=bdr align=center>Maaf, Data yang dicari tidak ditemukan</TD>
    </TR>
<!--tutup_data
<!--{/section}-->
  </table>

</center>
<div align=right>
<hr width=300><font size="1"><i><!--{$SHOW_NAMA_KARYAWAN}--> - <!--{$SHOW_NPK}--></i></font>&nbsp;&nbsp;</div>                   
<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
<IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';" onMouseOut="document.frmList.print_desc.value='';" 
onClick = "window.open('<!--{$FILES}-->');">							
</div>
                </FORM>
           <!--CLOSE_VIEW_INDEX-->

            <!--{/if}-->

	</DIV>

</BODY>
</HTML>