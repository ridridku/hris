<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
<STYLE>
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
		<tr><td class="tcat"> Data Pegawai</td></tr>
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



				<TR>
					<TD>Cabang <font color="#ff0000">*</font></TD>
					<TD>



					<!--{if ($JENIS_USER_SES==1)}-->

								<select name="kode_cabang" >
								<option value=""> Pilih Cabang </option>
								<!--{section name=x loop=$DATA_PWK}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_PWK[x].kode_cabang) == $EDIT_KODE_CABANG}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->" selected > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->"  > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{/if}-->

								<!--{else}-->

									<!--{if  ($DATA_PWK[x].kode_cabang) == $KODE_PW_SES}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->" selected > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->"  > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{/if}-->
								<!--{/if}-->

								<!--{/section}-->
								</SELECT>

						<!--{else}-->

					<select name="kode_cabang" >
						<option value=""> Pilih Cabang </option>
								<!--{section name=x loop=$DATA_PWK}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_PWK[x].kode_cabang) == $EDIT_KODE_CABANG}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->" selected > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->"  disabled> <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{/if}-->

								<!--{else}-->

									<!--{if  trim($DATA_PWK[x].kode_cabang) == trim($KODE_PW_SES)}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->" selected > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->"  disabled> <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{/if}-->

								<!--{/if}-->

								<!--{/section}-->
								</SELECT>

						<!--{/if}-->


					</TD>
				</TR>


                               <TR>
					<TD>Departemen</TD>
					<TD>
						<select name="kode_departemen">
						<option value=""> Pilih Departemen </option>
						<!--{section name=x loop=$DATA_DEP}-->
						<!--{if trim($DATA_DEP[x].kode_departemen) == $EDIT_KODE_DEPARTEMEN}-->
						<option value="<!--{$DATA_DEP[x].kode_departemen}-->" selected > <!--{$DATA_DEP[x].departemen}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_DEP[x].kode_departemen}-->"  > <!--{$DATA_DEP[x].departemen}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>

					</TD>
				</TR>
                                <TR>
					<TD>Jabatan</TD>
					<TD>
						<select name="kode_jabatan"  >
						<option value=""> Pilih Jabatan </option>
						<!--{section name=x loop=$DATA_JABATAN}-->
						<!--{if trim($DATA_JABATAN[x].kode_jabatan) == $EDIT_KODE_JABATAN}-->
						<option value="<!--{$DATA_JABATAN[x].kode_jabatan}-->" selected > <!--{$DATA_JABATAN[x].jabatan}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_JABATAN[x].kode_jabatan}-->"  > <!--{$DATA_JABATAN[x].jabatan}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>
					</TD>
				</TR>

                                <TR>
					<TD>Level Jabatan</TD>
					<TD>
						<select name="kode_level"  >
						<option value=""> Pilih Level </option>
						<!--{section name=x loop=$DATA_LEVEL}-->
						<!--{if trim($DATA_LEVEL[x].kode_level) == $EDIT_KODE_LEVEL}-->
						<option value="<!--{$DATA_LEVEL[x].kode_level}-->" selected > <!--{$DATA_LEVEL[x].nama_level}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_LEVEL[x].kode_level}-->"  > <!--{$DATA_LEVEL[x].nama_level}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>
					</TD>
				</TR>

                                <TR>
					<TD>Kode Absensi</TD>
					<TD><INPUT TYPE="text" NAME="kode_absensi" value="<!--{$EDIT_KODE_ABSENSI}-->" size="35"></TD>
				</TR>

                                <TR>
					<TD>Nama Lengkap</TD>
					<TD><INPUT TYPE="text" NAME="nama" value="<!--{$EDIT_NAMA}-->" size="35"></TD>
				</TR>

                                 <TR>
					<TD>Pendidikan Terakhir</TD>
					<TD><INPUT TYPE="text" NAME="pendidikan_akhir" value="<!--{$EDIT_NAMA}-->" size="35"></TD>
				</TR>

				<TR>
					<TD>Tempat Lahir</TD>
					<TD><INPUT TYPE="text" NAME="tempat_lahir" value="<!--{$EDIT_TEMPAT_LAHIR}-->" size="35"></TD>
				</TR>

				<TR>
					<TD>Tanggal Lahir</TD>
					<TD>
					<!--{if $EDIT_VAL==0}-->

							 <input type="text" NAME="tgl_lahir"   >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_lahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="tgl_lahir" value="<!--{$EDIT_TGL_LAHIR}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_lahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
					</TD>
				</TR>

<TR>
					<TD>Jenis Kelamin <font color="#ff0000">*</font></TD>
					<TD>

					<select name="jk"  >
						<option value="">[Pilih Jenis Kelamin]</option>

						<option value="1"   <!--{if  ($EDIT_JK  == 1)}--> selected <!--{/if}--> > Perempuan </option>
						<option value="2"   <!--{if  ($EDIT_JK  == 2)}--> selected <!--{/if}-->   > Laki-Laki </option>

						</select>
					 </TD>
				</TR>
                                <TR>
					<TD>Agama</TD>
					<TD>
						<select Name="kode_agama"  >
						<option value=""> Pilih Agama </option>
						<!--{section name=x loop=$DATA_AGAMA}-->
						<!--{if trim($DATA_AGAMA[x].kode_agama) == $EDIT_KODE_AGAMA}-->
						<option value="<!--{$DATA_AGAMA[x].kode_agama}-->" selected > <!--{$DATA_AGAMA[x].nama_agama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_AGAMA[x].kode_agama}-->"  > <!--{$DATA_AGAMA[x].nama_agama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>
					</TD>
				</TR>


					<TR>
					<TD colspan="2"><u>Alamat KTP</u></TD>
				</TR>





                                  <TR>
					<TD>No KTP /SIM</TD>
					<TD><INPUT TYPE="text" NAME="no_ktp_sim" value="<!--{$EDIT_TLP}-->" size="35"></TD>
				</TR>
				<TR>
					<TD>Alamat KTP</TD>
					<TD><INPUT TYPE="text" NAME="alamat_ktp" value="<!--{$EDIT_ALAMAT}-->" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kode Pos KTP</TD>
					<TD><INPUT TYPE="text" NAME="kode_pos_ktp" value="<!--{$EDIT_ALAMAT}-->" size="35"></TD>
				</TR>

                                 <TR>
					<TD>RT/RW KTP</TD>
					<TD><INPUT TYPE="text" NAME="alamat" value="<!--{$EDIT_ALAMAT}-->" size="35"></TD>
				</TR>
                                <TR>
					<TD>Propinsi</TD>
					<TD>
						<select name="no_propinsi" onchange="cari_kab(this.value);">
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI}-->
						<!--{if trim($DATA_PROPINSI[x].no_propinsi) == $EDIT_NO_PROP}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>
					</TD>
				</TR>
                                <TR>
					<TD>kota / Kabupaten </TD>
					<TD>
					<div id="ajax_kabupaten">
					<select name="id_kab" >
						<option value="">[Pilih Kabupaten]</option>
						<!--{section name=x loop=$DATA_KABUPATEN}-->
						<!--{if trim($DATA_KABUPATEN[x].id_kabupaten) == $EDIT_ID_KAB}-->
						<option value="<!--{$DATA_KABUPATEN[x].id_kabupaten}-->" selected > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KABUPATEN[x].id_kabupaten}-->"  > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>
					</div></TD>
				</TR>
                                <TR>
					<TD colspan="2"><u>Alamat Domisili</u></TD>
				</TR>
                                <TR>
					<TD>Alamat Domisili</TD>
					<TD><INPUT TYPE="text" NAME="alamat_domisil" value="<!--{$EDIT_ALAMAT}-->" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kode Pos Domisili</TD>
					<TD><INPUT TYPE="text" NAME="kode_pos_domisil" value="<!--{$EDIT_KODEPOS_DOM}-->" size="35"></TD>
				</TR>

                                 <TR>
					<TD>RT/RW Domisili</TD>
					<TD><INPUT TYPE="text" NAME="rt_rw_domisil" value="<!--{$EDIT_RTRW_DOM}-->" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kota/Kabupaten</TD>
					<TD><INPUT TYPE="text" NAME="kota_domisil" value="<!--{$EDIT_RTRW_DOM}-->" size="35"></TD>
				</TR>
                                 <TR>
					<TD>Golongan Darah</TD>
					<TD><INPUT TYPE="text" NAME="kode_gol_darah" value="<!--{$EDIT_GOL_DARAH}-->" size="35"></TD>
				</TR>

			<TR>
					<TD>No Telp</TD>
					<TD><INPUT TYPE="text" NAME="telp_rmh" value="<!--{$EDIT_TLP}-->" size="35"></TD>
				</TR>

                                <TR>
					<TD>No Hp</TD>
					<TD><INPUT TYPE="text" NAME="hp" value="<!--{$EDIT_HP}-->" size="35"></TD>
				</TR>

                                <TR>
					<TD>No Hp Inventaris</TD>
					<TD><INPUT TYPE="text" NAME="telp_inventaris" value="<!--{$EDIT_HP_INVENTARIS}-->" size="35"></TD>
				</TR>

                               <TR>
					<TD>Tanggal Masuk</TD>
					<TD>
					<!--{if $EDIT_VAL==0}-->

							 <input type="text" name="tgl_masuk"   >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_masuk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="tgl_masuk" value="<!--{$EDIT_TGL_LAHIR}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_masuk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
					</TD>
				</TR>



                                 <TR>
					<TD>Tanggal Kontrak Awal</TD>
					<TD>
					<!--{if $EDIT_VAL==0}-->

							 <input type="text" name="tgl_kontrak_awal"   >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="tgl_kontrak_awal" value="<!--{$EDIT_TGL_LAHIR}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
					</TD>
				</TR>

                                <TR>
					<TD>Tanggal Kontrak Akhir</TD>
					<TD>
					<!--{if $EDIT_VAL==0}-->

							 <input type="text" name="tgl_kontrak_akhir"   >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="tgl_kontrak_akhir" value="<!--{$EDIT_TGL_LAHIR}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
					</TD>
				</TR>
                                 <TR>
					<TD>Kontrak Ke</TD>
					<TD><INPUT TYPE="text" NAME="kontrak_ke" value="<!--{$EDIT_KONTRAK_KE}-->" size="35"></TD>
				</TR>
                                 <TR>
					<TD>Status karyawan</TD>
					<TD>
						<select name="kode_status"  >
						<option value=""> Pilih  </option>
						<!--{section name=x loop=$DATA_STATUS}-->
						<!--{if trim($DATA_STATUS[x].kode_status) == $EDIT_KODE_STATUS}-->
						<option value="<!--{$DATA_STATUS[x].kode_status}-->" selected > <!--{$DATA_STATUS[x].nama_status}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_STATUS[x].kode_status}-->"  > <!--{$DATA_STATUS[x].nama_status}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>
					</TD>
				</TR>
                                <TR>
					<TD>NO NPWP</TD>
					<TD><INPUT TYPE="text" NAME="no_npwp" value="<!--{$EDIT_NO_NPWP}-->" size="35"></TD>
				</TR>
                                <TR>
					<TD>No BPJS Ketenagakerjaan</TD>
					<TD><INPUT TYPE="text" NAME="no_bpjs_kt" value="<!--{$EDIT_NO_BPJS_KT}-->" size="35"></TD>
				</TR>
                                <TR>
					<TD>No BPJS Kesehatan</TD>
					<TD><INPUT TYPE="text" NAME="no_bpjs_kt" value="<!--{$EDIT_NO_BPJS_KES}-->" size="35"></TD>
				</TR>
                                <TR>
					<TD>No Inhealth</TD>
					<TD><INPUT TYPE="text" NAME="no_inhealth" value="<!--{$EDIT_INHEALTH}-->" size="35"></TD>
				</TR>
                                <TR>
					<TD>Kode Bank</TD>
					<TD>
						<select name="kode_bank"  >
						<option value=""> Pilih Nama Bank </option>
						<!--{section name=x loop=$DATA_BANK}-->
						<!--{if trim($DATA_BANK[x].kode_bank) == $EDIT_KODE_BANK}-->
						<option value="<!--{$DATA_BANK[x].kode_bank}-->" selected > <!--{$DATA_BANK[x].nama_bank}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_BANK[x].kode_bank}-->"  > <!--{$DATA_BANK[x].nama_bank}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>
					</TD>
				</TR>
				<TR>
					<TD>Alamat Buka Bank</TD>
					<TD><INPUT TYPE="text" NAME="alamat_buka_bank" value="<!--{$EDIT_ALAMAT_BK_BANK}-->" size="35"></TD>
				</TR>
                                <TR>
					<TD>No Rek Bank</TD>
					<TD><INPUT TYPE="text" NAME="rek_bank_baru" value="<!--{$EDIT_NO_REK_BANK}-->" size="35"></TD>
				</TR>

                                 <TR>
					<TD>Nama Pemilik Rekening Bank</TD>
					<TD><INPUT TYPE="text" NAME="nama_rek_bank" value="<!--{$EDIT_NO_REK_BANK}-->" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kota Bank</TD>
					<TD><INPUT TYPE="text" NAME="kota_bank" value="<!--{$EDIT_NO_REK_BANK}-->" size="35"></TD>
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


					<TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>

					</tr>

			</TABLE>
		</FORM>
		</td></tr>
		</table>
		</DIV>

<!--form_tambah-->


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
								<TD>Pilih Cabang</TD>
								<TD><select name="kode_perwakilan_cari" >
									<option value=""> [Pilih Perwakilan] </option>
									<!--{section name=x loop=$DATA_PWK}-->
									<!--{if trim($DATA_PWK[x].kode_cabang) == $EDIT_KODE_CABANG}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->" selected > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_cabang}-->"  > <!--{$DATA_PWK[x].nama_cabang}--> </option>
									<!--{/if}-->
									<!--{/section}-->
									</select>		</TD>
							</TR>
					<!--{/if}-->

							<TR>
								<TD>Nama Karyawan </TD>
								<TD><INPUT TYPE="text" NAME="nama_pegawai_cari" size="30"></TD>
							</TR>
                                                        <TR>
					<TD>Jabatan</TD>
					<TD>
						<select name="jabatan_pegawai_cari"  >
						<option value=""> Pilih Jabatan </option>
						<!--{section name=x loop=$DATA_JABATAN}-->
						<!--{if trim($DATA_JABATAN[x].kode_jabatan) == $EDIT_KODE_JABATAN}-->
						<option value="<!--{$DATA_JABATAN[x].kode_jabatan}-->" selected > <!--{$DATA_JABATAN[x].jabatan}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_JABATAN[x].kode_jabatan}-->"  > <!--{$DATA_JABATAN[x].jabatan}--> </option>
						<!--{/if}-->
						<!--{/section}-->
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



<!--form_cari-->
		</DIV>

		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Daftar Pegawai</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Daftar Pegawai</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
											<th class="tdatahead" align="left">NO</TH>
											<th class="tdatahead" align="left" width="10%">NAMA</TH>
											<th class="tdatahead" align="left">DEPARTEMEN</TH>
											<th class="tdatahead" align="left" >JABATAN</TH>
                                                                                        <th class="tdatahead" align="left" >CABANG</TH>
											<th class="tdatahead" align="left">STATUS KARYAWAN</TH>
                                                                                        <th class="tdatahead" align="left">MULAI MASUK</TH>
											<th class="tdatahead" align="left" >AWAL KONTRAK</TH>
											<th class="tdatahead" align="left">AKHIR KONTRAK</TH>
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
			</tr>
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent"  > <!--{$DATA_TB[x].nama}--> </TD>
											<TD class="tdatacontent"  > <!--{$DATA_TB[x].departemen}-->  </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].jabatan}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].nama_cabang}--> </TD>
											<TD class="tdatacontent"  > <!--{$DATA_TB[x].nama_status}--> </TD>
											<TD class="tdatacontent"  >  <!--{$DATA_TB[x].tgl_masuk}--></TD>
											<TD class="tdatacontent"  > <!--{$DATA_TB[x].tgl_kontrak_awal}--> </TD>
                                                                                        <TD class="tdatacontent"  > <!--{$DATA_TB[x].tgl_kontrak_akhir}--> </TD>

											<TD class="tdatacontent"  >




											</TD>




											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="10" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<!--{/section}-->
			</tbody>
		</table>
<div id="panel-footer">
    <!--halaman -->

    <!--halaman -->
</div>
		</td></tr>
		</table>

		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>
