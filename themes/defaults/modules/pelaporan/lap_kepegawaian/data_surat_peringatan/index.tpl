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

<a class="button" href="#" onClick = "window.open('<!--{$FILES}-->');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/print.gif" align="absmiddle"> &nbsp;Cetak</span></a>

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

                                                                                           <select name="kode_cabang_cari" > 
                                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <!--{section name=x loop=$DATA_CABANG}-->

                                                                                           <!--{if ($OPT==1)}-->

                                                                                                   <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_R_CABANG__ID}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{/if}-->

                                                                                           <!--{else}-->

                                                                                                   <!--{if  ($DATA_CABANG[x].kode_cabang) == $KODE_PW_SES}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
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
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->"  disabled> <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{/if}-->

                                                                                           <!--{else}-->

                                                                                                   <!--{if  trim($DATA_CABANG[x].r_cabang__id) == trim($KODE_PW_SES)}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id|base64_encode}-->"  disabled> <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{/if}-->

                                                                                           <!--{/if}-->

                                                                                           <!--{/section}-->
                                                                                           </SELECT>

                                                                           <!--{/if}-->
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
                              
                                
                               
                            </TD>

                    </TR>
                    <TR>
                         <TD >Jenis Surat Peringatan<font color="#ff0000" >*</font> </TD>
                            <TD>
                                 <INPUT TYPE="hidden" NAME="t_sp__no_cari" readonly id="sp_no" size="35" value="<!--{$EDIT_T_LEMBUR__NIP}-->" >
                                <INPUT TYPE="text" NAME="jenis_cari" readonly id="jenis_sp" size="35" value="<!--{$EDIT_T_LEMBUR__NIP}-->" >
                                 <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                               
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
                    <center>
                   <style type="text/css">
<!--
.style3 {font-size: 12px}
-->
</style>
<table width='73%' border="0">
  <tr>
    <td>&nbsp;</td>
    <td rowspan="3"><img src="http://hris.tmw.co.id/hris/images/logo_tmw.jpg" width=125 height=110 border=0 alt=""></td>
    <td>&nbsp;</td>
    <td colspan="4"><div align="center">
      <h2>PT.TRITUNGGAL MULIA WISESA </h2>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><div align="center"><span class="style3">Jl.Kopo Jaya I No.8 Telp (022) 5416678 Fax.(022) 5415888 </span></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5" class="style3"><div align="center">Kompleks Perkantoran Kopo Cirangrang - Bandung 40224 </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7"><hr></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;<!--{section name=x loop=$DATA_TB}--></td>
    <td>&nbsp;</td>
    <td colspan="5"><div align="center">SURAT KEPUTUSAN </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td>
    <td>&nbsp;</td>
    <td colspan="5"><div align="center">No.<!--{$DATA_TB[x].t_sp__no}-->/TMW/HRD/<!--{$BLN_ROMAWI}-->/2016</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td width="4">&nbsp;</td>
    <td colspan="4"><STRONG>MENIMBANG : </STRONG></td>
    <td width="113">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="47">&nbsp;</td>
  </tr>
  <tr>
    <td height="29">&nbsp;</td>
    <td colspan="7" rowspan="2"><div align="justify">Bahwa perusahaan Memandang perlu menegakkan peraturan dan tata tertib kerja, serta </div>      <div align="justify">ketentuan-ketentuan lain yang berlaku bagi karyawan PT.TRITUNGGAL MULIA WISESA </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7"><STRONG>MENGINGAT : </STRONG></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="3"><div align="justify"><!--{$DATA_TB[x].t_sp__pelanggaran}--></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7">Maka dengan ini <STRONG>MEMUTUSKAN</STRONG> : </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7">Memberikan sanksi <strong>SURAT PERINGATAN</strong> <strong>
        
             <!--{if ($DATA_TB[x].t_sp__jenis)==1}-->
            <font color="#000000">KE-1 </font>              
                   <!--{elseif ($DATA_TB[x].t_sp__jenis) ==2}-->  
                            <font color="#000000">KE-2</font>     
                    <!--{else ($DATA_TB[x].t_sp__jenis) ==3}-->  
                              <font color="#000000">KE-3</font>     
                   <!--{/if}--> 
            
            
        </strong> Kepada karyawan dibawah ini </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="113">Nama</td>
    <td width="33">:</td>
    <td colspan="3" ><!--{$DATA_TB[x].r_pegawai__nama}--></td>
    <td colspan="2"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Posisi</td>
    <td>:</td>
    <td colspan="3"><!--{$DATA_TB[x].r_jabatan__ket}--></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Cabang</td>
    <td>:</td>
    <td colspan="3"><!--{$DATA_TB[x].r_cabang__nama}--></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="2"><div align="justify">karena telah melakukan kelalaian dan pelanggaran SOP yang telah diarahkan secara tertulis, terkait eksekusi sub D dan P3B . </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="3"><div align="justify">Apabila dalam waktu <!--{$LAMA_SP}-->  bulan sejak tanggal dibuatnya surat keputusan ini karyawan Melakukan kesalahan yang sama atau lain maka perusahaan akan memberikan sanksi lebih lanjut. </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="2"><div align="justify">Demikian keputusan ini dibuat dan diberikan kepada Bapak / Ibu / Saudara agar dikemudian hari dapat lebih hati-hati dan tidak melakukan kesalahan lagi. </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Dibuat di </td>
    <td width="57">:</td>
    <td colspan="2">Bandung</td>
    <td width="175">&nbsp;</td>
    <td width="84">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Tanggal Dibuat </td>
    <td>:</td>
    <td colspan="2"><!--{$DATA_TB[x].t_sp__tgl|date_format:"%d-%B-%Y"}--></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">Tanggal Berakhir </td>
    <td>:</td>
    <td colspan="2"><!--{$DATA_TB[x].t_sp__tgl_expired|date_format:"%d-%B-%Y"}--></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="133">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center">Yang Membuat </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center">Penerima Sanksi </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><em><strong><!--{$DATA_TB[x].t_sp__hglm}--></strong></em></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><em><!--{$DATA_TB[x].r_pegawai__nama}--></em></strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><font size="1"><!--{$DATA_TB[x].t_sp__hglm_mutasi}--></font></strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><font size="1"><!--{$DATA_TB[x].r_jabatan__ket}--></font></strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center">Mengetahui</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><em><strong><!--{$DATA_TB[x].t_sp__atasan}--> </strong></em></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><font size="1"><!--{$DATA_TB[x].t_sp__atasan_jabatan}--></font> </strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <!--tutup_data-->
    <!--{sectionelse}-->
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td colspan="8">Maaf, Data yang dicari tidak ditemukan</td>
  </tr>
    <!--{/section}-->
</table>

                    </center>		





<div align=right>
<hr width=300><font size="1"><i><!--{$SHOW_NAMA_KARYAWAN}--> - <!--{$SHOW_NPK}--></i></font>&nbsp;&nbsp;</div>

                    
                <div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
                <IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Download';" onMouseOut="document.frmList.print_desc.value='';" 
                onClick = "window.open('<!--{$FILES}-->');">							
                </div>
                </FORM>
           <!--CLOSE_VIEW_INDEX-->

            <!--{/if}-->

	</DIV>

</BODY>
</HTML>