<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
 
 <FORM NAME="frmCreate_"    METHOD="POST" ACTION="engine.php">
 
 <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr>
        <td class="thead">		 
			<img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0">  Form Add/Edit Tindak Lanjut Kasus
		</tr>
		<tr>
		<td colspan="2" class="alt2" style="padding:0px;"> 
 
					<TABLE id="table-add-box" width="100%" border="0" >

					

					<TR>
								<TD width="200">No Berita</TD>				 
								<TD colspan="3" >
									<INPUT TYPE="text" NAME="no_berita" size="30" value="<!--{$NO_BERITA}-->" >

					</TD>


							<TR>
								<TD width="200">Tanggal</TD>				 
								<TD colspan="3">
									<!--{if $EDIT_VAL==0}-->
											 <input type="text" name="tanggal" value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->" >
											 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate_.tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">  	
									<!--{else}-->
											 <input type="text" name="tanggal" value="<!--{$TANGGAL}-->" >
											 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate_.tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">  	
									<!--{/if}-->
					
					</TD>
							</TR>
							<TR>
								<TD width="200">Jenis Tindak Lanjut</TD>				 
								<TD colspan="3"> 
									<select name="kode_jenis_tl">
										<option value=""></option>
										<option value="1" <!--{if $KODE_JENIS_TL==1}--> selected <!--{/if}--> >Direspons secara internal</option>
										<option value="2" <!--{if $KODE_JENIS_TL==2}--> selected <!--{/if}--> > Didisposisi kepada pihak terkait</option>								 
									</select>
								</TD>
							</TR>
							<TR>
								<TD width="200">Tindak Lanjut yang dilakukan Oleh Perwakilan</TD>				 
								<TD> 
										<textarea name="tindak_lanjut" rows="7" cols="45"><!--{$TINDAK_LANJUT}--></textarea>
								<td>		
										 <font color="#3333cc">Tindak Lanjut yang dilakukan Oleh PWNI </font></TD>

									<td>		 
									
									
									 <!--{section name=y loop=$DATA_TB2}-->
											 												
									  - <!--{$DATA_TB2[y].tindak_lanjut}-->  <BR>
										 
									 <!--{/section}-->
							 
							 
							 </textarea></TD>


								 </TD>
							</TR>

							<TR>
								<TD width="200">Perkembangan</TD>
								<TD rowspan="2">	 
										<textarea name="perkembangan" rows="7" cols="45"><!--{$PERKEMBANGAN}--></textarea> </TD> 
 

								</TD>
							</TR>
 
								<TR>
								<td colspan="2">
										<input type="button" class=btn3 value="SIMPAN"  onclick="return checkFrm2(frmCreate_);" >
										<input type="button" class=btn3 value="BATAL" onclick="window.location='index.php?mod_id=<!--{$MOD_ID}-->&kode_form_pengaduan=<!--{$KODE_FORM_PENGADUAN_}-->&kode_kat_kasus=<!--{$KODE_KAT_KASUS}-->&opt=1'"  > 
										<input type="hidden" name="op" value="<!--{$OP}-->">
									   	<input type="hidden" name="kode_form_pengaduan" value="<!--{$KODE_FORM_PENGADUAN_}-->">
									    <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
									    <INPUT TYPE="hidden" name="kode_tl" value="<!--{$KODE_TL}-->">
										<INPUT TYPE="hidden" name="kode_kat_kasus" value="<!--{$KODE_KAT_KASUS}-->">

								</td>
								</tr>
					</table>
					 
		</td>
		</tr>

		</td>
	</table>



 </form>