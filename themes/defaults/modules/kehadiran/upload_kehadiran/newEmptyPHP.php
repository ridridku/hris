<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<?php echo $header; ?>
<?php echo $menu; ?>
  </header>
  </div> <!-- /end #fixedheader --!>
  </div> <!-- /end #headwrapper --!>
   
  <!-- END HEADER --!>

  <!-- BLOK CONTENT --!>
  <div id="pagewrapper">
  <div id="toparrow"></div>
  <div id="content">
    
  <br><p>

      <div class="row-fluid sortable">    
    <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><span class="icon icon-blue icon-page" title="Data Master Propinsi "></span>   FORM LEDGER JALAN </h2>
        <div class="box-icon">
          <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
        </div>
    </div>

          <div class="box-content">
          <div class="well">
            <?php if(validation_errors()) { ?>
              <div class="alert alert-block">
                 <button type="button" class="close" data-dismiss="alert">?</button>
                   <h4>Terjadi Kesalahan!</h4>
                 <?php echo validation_errors(); ?>
              </div>
              <?php } ?>       
 <!-------->
<div id="content">

 <?
 	$attributes = array('class' => 'form-horizontal' ,'name' => 'lb' ,'onsubmit' =>"return validateForm()");
	echo form_open_multipart('ledger_jalan/simpan', $attributes); ?>

<table width="100%" border="1">
  <tr>
    <td width="31%">NOMER KARTU LEDGER JALAN</td>
    <td width="3%">:</td>
    <td width="66%">
	<input type="text" class="form-control" id="nokartu1" maxlength="2" size="5" name='nokartu1' value="">
	<input type="text" class="form-control" id="nokartu2" maxlength="3" size="10" name='nokartu2' value="">
	<input type="text" class="form-control" id="nokartu3" maxlength="2" size="5" name='nokartu3' value="">
	<input type="text" class="form-control" id="nokartu4" maxlength="1" size="5" name='nokartu4' value="">
	<input type="text" class="form-control" id="nokartu5" maxlength="1" size="5" name='nokartu5' value="">
	</td>
  </tr>
    <tr>
    <td>TAHUN ASAL</td>
    <td>:</td>
    <TD >	
                                             <select name="tahun" id="tahun" >
                                                <option value="">[Pilih Tahun]</option>
                                                  <?php		
                                                    for($i=date(Y); $i>date(Y)-5; $i--) {  ?>
                                                 <option value = "<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                                }?>
                                             </select>
          </TD>
  </tr>
    <tr>
    <td>RUAS JALAN </td>
    <td>:</td>

 <!-- Memanggil file .js untuk proses autocomplete -->
    <script type='text/javascript' src='<?php echo base_url();?>asset/js/jquery-1.8.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>asset/js/jquery.autocomplete.js'></script>

    <!-- Memanggil file .css untuk style saat data dicari dalam filed -->
    <link href='<?php echo base_url();?>asset/js/jquery.autocomplete.css' rel='stylesheet' />

   <!-- Memanggil file .css autocomplete_ci/assets/css/default.css -->
   <!-- <link href='<?php echo base_url();?>assets/css/latihan.css' rel='stylesheet' />-->

    <script type='text/javascript'>
        var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocomplete').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/ledger_jalan/search',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                    $('#v_lokasi').val(''+suggestion.lokasi); // membuat id 'v_nim' untuk ditampilkan
                    $('#v_ruas').val(''+suggestion.ruas); // membuat id 'v_jurusan' untuk ditampilkan
					$('#v_sffx').val(''+suggestion.sffx); 
					$('#v_nama_ruas').val(''+suggestion.nama_ruas);
					$('#v_lokasi').val(''+suggestion.lokasi);
					$('#v_kp_from').val(''+suggestion.kp_from);
					$('#v_kp_to').val(''+suggestion.kp_to);
					$('#v_awal_ruas').val(''+suggestion.awal_ruas);
					$('#v_akhir_ruas').val(''+suggestion.akhir_ruas);
					$('#v_id').val(''+suggestion.id);
					$('#v_panjang').val(''+suggestion.panjang);
					
					
                }
            });
        });
    </script>

    <td><input type="search" class='autocomplete' id="v_ruas" name="tampil_nama"  /> </td>
	<input type="hidden"  id="v_ruas" name="ruas" place/>
  </tr>
  <tr>
    <td>NO RUAS/PANJANG RUAS</td>
    <td>:</td>
    <td><input type="text" class='autocomplete' id="v_id" name="id" readonly="" />
	&nbsp;<input type="text" class='autocomplete' id="v_panjang" name="panjangruas" readonly="" /></td>
  </tr>
  <tr>
    <td>NAMA PENGENAL JALAN</td>
    <td>:</td>
    <td><input type="text" class='autocomplete' id="v_nama_ruas" name="ruas" readonly=""/></td>
  </tr>
  <tr>
    <td>TITIK AWAL RUAS JALAN</td>
    <td>:</td>
    <td><input type="text" class="form-control" id="v_kp_from" maxlength="30" size="5" name="titik_awal" readonly=""></td>
  </tr>
  <tr>
    <td>DESKRIPSI TITIK AWAL RUAS JALAN</td>
    <td>:</td>
    <td><input type="text" class="form-control" id="des_awal" maxlength="30" size="5" name="des_awal"></td>
  </tr>
    <tr>
    <td>TITIK AKHIR RUAS JALAN</td>
    <td>:</td>
    <td><input type="text" class="form-control" id="v_kp_to" maxlength="30" size="5" name="titik_akhir" readonly=""></td>
  </tr>
    <tr>
    <td>DESKRIPSI TITIK AKHIR RUAS JALAN</td>
    <td>:</td>
    <td><input type="text" class="form-control" id="des_akhir_ruas" maxlength="30" size="5" name="des_akhir"></td>
  </tr>
    <tr>
    <td>TITIK IKAT AWAL PATOK KM / LJ</td>
    <td>:</td>
    <td><input type="text" class="form-control" id="" maxlength="30" size="5" name='titik_ikat_awal'></td>
  </tr>
    <tr>
    <td>DESKRIPSI  TITIK IKAT PATOK KM / LJ</td>
    <td>:</td>
    <td><input type="text" class="form-control" id="" maxlength="30" size="5" name='des_titik_ikat_awal'></td>
  </tr>
  
     <tr>
    <td>SISTEM JARINGAN JALAN </td>
    <td>:</td>
    <td><input type="text" class="form-control" id="" maxlength="30" size="5" name='sistem_jaringan'></td>
  </tr>
  
  
    <tr>
    <td>PERAN JALAN </td>
    <td>:</td>
    <td><input type="text" class="form-control" id="" maxlength="30" size="5"  name='peran_jalan'></td>
  </tr>
  
    <tr>
    <td>STATUS JALAN </td>
    <td>:</td>
    <td><input type="text" class="form-control" id="" maxlength="30" size="5" name='status_jalan'></td>
  </tr>
  
    <tr>
    <td>KELAS JALAN </td>
    <td>:</td>
    <td><input type="text" class="form-control" id="" maxlength="30" size="5" name='kelas_jalan'></td>
  </tr>
  
    <tr>
    <td>PENYELENGGARA JALAN </td>
    <td>:</td>
    <td><input type="text" class="form-control" id="" maxlength="30" size="5" name='penyelenggara'>
	</td>
  </tr>
    <tr>
    <td>TANGGAL SELESAI DI WUJUDKAN </td>
    <td>:</td>
	<?PHP $date= date('Y-m-dd'); ?>
    <td><input  type="text" class="datepicker" data-date-format="yyyy/mm/dd" name='tanggal_selesai' ></td>
  </tr>
    <tr>
    <td>TANGGAL DI BUKA UNTUK LALU LINTAS </td>
    <td>:</td>
    <td><input type="text" class="datepicker" id="" maxlength="yyyy/mm/dd"  name='tanggal_dibuka'></td>
  </tr>
    <tr>
    <td>TANGGAL DI TUTUP UNTUK LALU LINTAS </td>
    <td>:</td>
    <td><input type="text" class="datepicker" id="" maxlength="yyyy/mm/dd"  name='tanggal_ditutup'></td>
  </tr>
 
  
</table>


<BR><BR>

    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#red" data-toggle="tab">PERWUJUDAN </a></li>
        <li><a href="#orange" data-toggle="tab">LINTAS HARIAN RATA-RATA</a></li>
        <li><a href="#yellow" data-toggle="tab">LUAS LAHAN RUMIJA</a></li>
		<li><a href="#green" data-toggle="tab">JENIS PERMUKAAN DAN PERLENGKAPAN</a></li>
		<li><a href="#purple" data-toggle="tab">LOKASI</a></li>
		
    </ul>
	
    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="red">
					 
			 <div class="control-group" >
				 <legend class="bg-header">1. PERWUJUDAN</legend>
			 </div>
			 
 <!-- TAB 1 --> 
<table width="100%" border="1" class="table">
  <tr>
    <TH width="60" rowspan="3"><div align="center">NO</div></TH>
    <TH rowspan="3"><div align="center">KEGIATAN POKOK</div></TH>
    <TH colspan="4"><div align="center">ASAL</div></TH>
  </tr>
  <tr>
    <TH width="276" rowspan="2"><div align="center">PELAKSANA</div></TH>
    <TH width="197" rowspan="2"><div align="center">CACAH</div></TH>
    <TH width="244"><div align="center">BIAYA</div></TH>
    <TH width="226"><div align="center">SUMBER</div></TH>
  </tr>
  <tr>
    <TH><div align="center">( Rp. 10³)</div></TH>
    <TH><div align="center">DANA</div></TH>
  </tr>
  <tr>
    <td>1</td>
    <td width="274">DESAIN</td>
    <td><input type="text" class="span6"  id=""   name="desain_pelaksana" /></td>
    <td><input type="text" class="span6"  id=""  name="desain_cacah" /></td>
    <td><input type="text" class="span6"  id=""  name="desain_biaya"/></td>
    <td><input type="text" class="span6" id=""   name="desain_sumber"/></td>
  </tr>
  <tr>
    <td>2</td>
    <td>PEMBEBASAN LAHAN</td>
    <td><input type="text" class="span6" name="pembebasan_pelaksana" id="provinsi2" /></td>
    <td><input type="text" class="span6" name="pembebasan_cacah" id="provinsi13" /></td>
    <td><input type="text" class="span6" name="pembebasan_biaya" id="provinsi16" /></td>
    <td><input type="text" class="span6" name="pembebasan_sumber" id="provinsi27" /></td>
  </tr>
  <tr>
    <td>3</td>
    <td>PEMBANGUNAN</td>
    <td><input type="text" class="span6" name="pembangunan_pelaksana" id="provinsi3" /></td>
    <td><input type="text" class="span6" name="pembangunan_cacah" id="provinsi12" /></td>
    <td><input type="text" class="span6" name="pembangunan_biaya" id="provinsi17" /></td>
    <td><input type="text" class="span6" name="pembangunan_sumber" id="provinsi26" /></td>
  </tr>
  <tr>
    <td>4</td>
    <td>PENINGKATAN</td>
    <td><input type="text" class="span6" name="peningkatan_pelaksana" id="provinsi4" /></td>
    <td><input type="text" class="span6" name="peningkatan_cacah" id="provinsi11" /></td>
    <td><input type="text" class="span6" name="peningkatan_biaya" id="provinsi18" /></td>
    <td><input type="text" class="span6" name="peningkatan_sumber" id="provinsi25" /></td>
  </tr>
  <tr>
    <td>5</td>
    <td>PENUNJANGAN</td>
    <td><input type="text" class="span6" name="penunjangan_pelaksana" id="provinsi5" /></td>
    <td><input type="text" class="span6" name="penunjangan_cacah" id="provinsi10" /></td>
    <td><input type="text" class="span6" name="penunjangan_biaya" id="provinsi19" /></td>
    <td><input type="text" class="span6" name="penunjangan_sumber" id="provinsi24" /></td>
  </tr>
  <tr>
    <td>6</td>
    <td>PEMELIHARAAN &amp; REHAB</td>
    <td><input type="text" class="span6" name="pemeliharaan_pelaksana" id="provinsi6" /></td>
    <td><input type="text" class="span6" name="pemeliharaan_cacah" id="provinsi9" /></td>
    <td><input type="text" class="span6" name="pemeliharaan_biaya" id="provinsi20" /></td>
    <td><input type="text" class="span6" name="pemeliharaan_sumber" id="provinsi23" /></td>
  </tr>
  <tr>
    <td>7</td>
    <td>SUPERVISI</td>
    <td><input type="text" class="span6" name="supervisi_pelaksana" id="provinsi7" /></td>
    <td><input type="text" class="span6" name="supervisi_cacah" id="provinsi8" /></td>
    <td><input type="text" class="span6" name="supervisi_biaya" id="provinsi21" /></td>
    <td><input type="text" class="span6" name="supervisi_sumber" id="provinsi22" /></td>
  </tr>
</table>						
						<!-- TAB 1 -->
		</div>
        <div class="tab-pane" id="orange">  
		
								 <div class="control-group" >
								 <legend class="bg-header">2. LINTAS HARIAN RATA-RATA</legend>
								  <legend class="bg-header">&nbsp;&nbsp;&nbsp; </legend>
								 </div>
			   
								<!-- TAB 2 -->  
										<table width="100%" border="1" class="table">
 
  <tr height="33">
    <TH colspan="5" height="66">GOLONGAN</TD>
    <TH  >ASAL </TH>
  </tr>
  
  
  <tr height="33">
    <td width="84" height="33">1</td>
    <td colspan="4">SEPEDA MOTOR/KEND BERMOTOR RODA 3</td>
    <td><input type="text" class="span8" name="lhr1" id="provinsi" ></td>
  </tr>
  <tr height="33">
    <td height="33">2</td>
    <td colspan="4">MOBIL PRIBADI</td>
    <td><input type="text" class="span8" name="lhr2" id="provinsi2" /></td>
  </tr>
  <tr height="33">
    <td height="33">3</td>
    <td colspan="4">MOBIL PENUMPANG</td>
    <td><input type="text" class="span8" name="lhr3" id="provinsi3" /></td>
  </tr>
  <tr height="33">
    <td height="33">4</td>
    <td colspan="4">MOBIL HANTARAN/BARANG</td>
    <td><input type="text" class="span8" name="lhr4" id="provinsi4" /></td>
  </tr>
  <tr height="33">
    <td height="33">5</td>
    <td colspan="2" rowspan="2">BUS:</td>
    <td colspan="2">a.Kecil</td>
    <td><input type="text" class="span8" name="lhr5a" id="lhr5a" /></td>
  </tr>
  <tr height="33">
    <td height="33"></td>
    <td colspan="2">b.Besar</td>
    <td><input type="text" class="span8" name="lhr5b" id="lhr5b" /></td>
  </tr>
  <tr height="33">
    <td height="33">6</td>
    <td colspan="3" rowspan="2">TRUK 2 SUMBU :</td>
    <td width="552">a. Kecil</td>
    <td><input type="text" class="span8" name="lhr6a" id="provinsi7" /></td>
  </tr>
  <tr height="33">
    <td height="33">&nbsp;</td>
    <td>b. Sedang</td>
    <td><input type="text" class="span8" name="lhr6b" id="provinsi8" /></td>
  </tr>
  <tr height="33">
    <td height="33">7</td>
    <td colspan="2" rowspan="3">TRUK:</td>
    <td colspan="2">a. 3 Sumbu atau Lebih</td>
    <td><input type="text" class="span8" name="lhr7a" id="provinsi9" /></td>
  </tr>
  <tr height="33">
    <td height="33">&nbsp;</td>
    <td colspan="2">b. Truk dengan Gandengan</td>
    <td><input type="text" class="span8" name="lhr7b" id="provinsi10" /></td>
  </tr>
  <tr height="33">
    <td height="33"></td>
    <td colspan="2">c. Semi Trailer</td>
    <td><input type="text" class="span8" name="lhr7c" id="provinsi11" /></td>
  </tr>
  <tr height="33">
    <td height="33">8</td>
    <td colspan="4">KENDARAAN TIDAK BERMOTOR</td>
    <td><input type="text" class="span8" name="lhr8" id="provinsi12" /></td>
  </tr>
</table>	
								 
<!-- TAB 2 -->

</div>
		
		
 <div class="tab-pane" id="yellow"> 
 
		 <div class="control-group" >
				<legend class="bg-header">3. LUAS LAHAN RUMIJA</legend>
		 </div> 	 
			<!-- TAB 3 -->  
							<input type="button"  name="tambah" value="&nbsp;&nbsp;&nbsp;+&nbsp;&nbsp;&nbsp;"   onclick="this.blur();addRowToTable();" >
							<input type="button"  name="tambah" value="&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;"   onclick="this.blur();removeRowFromTable();" >
                  
						    <table width="100%" border="1" class="table" id="tblItem2">
								<tr> 
								<th><div align="center">LUAS (M)</div></th>
								<th><div align="center">DATA PEROLEHAN</div></th>
								<th><div align="center">NJOP (Rp.10)</div></th>
								</tr> 
						    </table>   
							
							<input type="HIDDEN"  id="iterasi_spph" name="iterasi_spph"  /> 
			<!-- TAB 3 --> 
			
						
</div>


 <div class="tab-pane" id="green"> 
 
		 <div class="control-group" >
				<legend class="bg-header">4. JENIS PERMUKAAN DAN PERLENGKAPAN</legend>
		 </div> 	 
			<!-- TAB 4 -->  
						 
	        <input type="text" class="span5" name="provinsi26" id="provinsi262" />
	        <table width="100%" border="1" class="table">
 
  <tr height="23">
    <th height="23" colspan="2" align="center" width="425">URAIAN</th>
    <th colspan="2" width="169">ASAL / TH 2015</th>
  </tr>
  <tr height="20">
    <th height="20" colspan="2" align="center">JENIS PERMUKAAN JALAN</th>
    <th>(KM)</th>
    <th>( M )</th>
  </tr>
  <tr height="25">
    <td height="25">A</td>
    <td>TANAH</td>
    <td><input type="text" class="span5" name="jenispermukaan_km_a" id="provinsi" ></td>
    <td><input type="text" class="span5" name="jenispermukaan_m_a" id="provinsi2" /></td>
  </tr>
  <tr height="25">
    <td height="25">B</td>
    <td>KERIKIL</td>
    <td><input type="text" class="span5" name="jenispermukaan_km_b" id="provinsi4" /></td>
    <td><input type="text" class="span5" name="jenispermukaan_m_b" id="provinsi3" /></td>
  </tr>
  <tr height="25">
    <td height="25">C</td>
    <td>ASPAL BETON</td>
    <td><input type="text" class="span5" name="jenispermukaan_km_c" id="provinsi5" /></td>
    <td><input type="text" class="span5" name="jenispermukaan_m_c" id="provinsi6" /></td>
  </tr>
  <tr height="25">
    <td height="25">D</td>
    <td>ASPAL LAINNYA</td>
    <td><input type="text" class="span5" name="jenispermukaan_km_d" id="provinsi111" /></td>
    <td><input type="text" class="span5" name="jenispermukaan_m_d" id="provinsi112" /></td>
  </tr>
  <tr height="25">
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
  <tr height="17">
    <th height="17" colspan="2" align="center">JENIS JEMBATAN &gt; 2 ( M )</th>
    <th>(BUAH)</th>
    <th>(METER)</th>
  </tr>
  <tr height="25">
    <td height="25">A</td>
    <td>BELUM ADA</td>
    <td><input type="text" class="span5" name="jenisjembatan_bh_a" id="provinsi7" /></td>
    <td><input type="text" class="span5" name="jenisjembatan_m_a" id="provinsi16" /></td>
  </tr>
  <tr height="25">
    <td height="25">B</td>
    <td>PELAYANGAN</td>
    <td><input type="text" class="span5" name="jenisjembatan_bh_b" id="provinsi8" /></td>
    <td><input type="text" class="span5" name="jenisjembatan_m_b" id="provinsi15" /></td>
  </tr>
  <tr height="25">
    <td height="25">C</td>
    <td>SEMENTARA</td>
    <td><input type="text" class="span5" name="jenisjembatan_bh_c" id="provinsi9" /></td>
    <td><input type="text" class="span5" name="jenisjembatan_m_c" id="provinsi14" /></td>
  </tr>
  <tr height="25">
    <td height="25">D</td>
    <td>SEMI PERMANEN</td>
    <td><input type="text" class="span5" name="jenisjembatan_bh_d" id="provinsi10" /></td>
    <td><input type="text" class="span5" name="jenisjembatan_m_d" id="provinsi13" /></td>
  </tr>
  <tr height="25">
    <td height="25">E</td>
    <td>PERMANEN</td>
    <td><input type="text" class="span5" name="jenisjembatan_bh_e" id="provinsi11" /></td>
    <td><input type="text" class="span5" name="jenisjembatan_m_e" id="provinsi12" /></td>
  </tr>
  <tr height="25">
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
  <tr height="17">
    <th height="17" colspan="2" align="center">BANGUNAN PENGAMAN DAN PELENGKAP</th>
    <th>(BUAH)</th>
    <th>(METER)</th>
  </tr>
  <tr height="25">
    <td height="23">A</td>
    <td>GORONG-GORONG</td>
    <td><input type="text" class="span5" name="bangunan_bh_a" id="provinsi17" /></td>
    <td><input type="text" class="span5" name="bangunan_m_a" id="provinsi18" /></td>
  </tr>
  <tr height="25">
    <td height="25">B</td>
    <td>SALURAN SAMPING DAN    TEGAK PERMANEN</td>
    <td><input type="text" class="span5" name="bangunan_bh_b" id="provinsi20" /></td>
    <td><input type="text" class="span5" name="bangunan_m_b" id="provinsi19" /></td>
  </tr>
  <tr height="25">
    <td height="25">C</td>
    <td>DRAINASE BAWAH TANAH</td>
    <td><input type="text" class="span5" name="bangunan_bh_c" id="provinsi21" /></td>
    <td><input type="text" class="span5" name="bangunan_m_c" id="provinsi22" /></td>
  </tr>
  <tr height="25">
    <td height="25">D</td>
    <td>MAN HOLE / BAK PENAMPUNG</td>
    <td><input type="text" class="span5" name="bangunan_bh_d" id="provinsi24" /></td>
    <td><input type="text" class="span5" name="bangunan_m_d" id="provinsi23" /></td>
  </tr>
  <tr height="25">
    <td height="25">E</td>
    <td>RIOL</td>
    <td><input type="text" class="span5" name="bangunan_bh_e" id="provinsi25" /></td>
    <td><input type="text" class="span5" name="bangunan_m_e" id="provinsi26" /></td>
  </tr>
  <tr height="25">
    <td height="25">F</td>
    <td>BANGUNAN PENAHAN TANAH</td>
    <td><input type="text" class="span5" name="bangunan_bh_f" id="provinsi28" /></td>
    <td><input type="text" class="span5" name="bangunan_m_f" id="bangunan_m_e" /></td>
  </tr>
  <tr height="25">
    <td height="25">G</td>
    <td>KERB</td>
    <td><input type="text" class="span5" name="bangunan_bh_g" id="provinsi29" /></td>
    <td><input type="text" class="span5" name="bangunan_m_g" id="provinsi30" /></td>
  </tr>
  <tr height="25">
    <td height="25">H</td>
    <td>PENUTUP LERENG</td>
    <td><input type="text" class="span5" name="bangunan_bh_h" id="provinsi31" /></td>
    <td><input type="text" class="span5" name="bangunan_m_h" id="provinsi32" /></td>
  </tr>
  <tr height="25">
    <td height="25">I</td>
    <td>KRIB</td>
    <td><input type="text" class="span5" name="bangunan_bh_i" id="provinsi34" /></td>
    <td><input type="text" class="span5" name="bangunan_m_i" id="provinsi33" /></td>
  </tr>
  <tr height="25">
    <td height="25">J</td>
    <td>BANGUNAN PENGAMAN BAWAH    JEMBATAN</td>
    <td><input type="text" class="span5" name="bangunan_bh_j" id="provinsi35" /></td>
    <td><input type="text" class="span5" name="bangunan_m_j" id="provinsi36" /></td>
  </tr>
  <tr height="25">
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
  <tr height="17">
    <th height="17" colspan="2" align="center">PERLENGKAPAN JALAN</th>
    <th>(BUAH)</th>
    <th>(METER)</th>
  </tr>
  <tr height="25">
    <td height="25">A</td>
    <td>PAGAR PENGAMAN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_a" id="provinsi37" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_a" id="provinsi38" /></td>
  </tr>
  <tr height="25">
    <td height="25">B</td>
    <td>DINDING PENGAMAN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_b" id="provinsi40" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_b" id="provinsi39" /></td>
  </tr>
  <tr height="25">
    <td height="25">C</td>
    <td>PATOK PEMANDU</td>
    <td><input type="text" class="span5" name="pelengkap_bh_c" id="provinsi41" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_c" id="provinsi43" /></td>
  </tr>
  <tr height="25">
    <td height="25">D</td>
    <td>PATOK KILOMETER</td>
    <td><input type="text" class="span5" name="pelengkap_bh_d" id="provinsi42" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_d" id="provinsi44" /></td>
  </tr>
  <tr height="25">
    <td height="25">E</td>
    <td>PATOK HEKTOMETER</td>
    <td><input type="text" class="span5" name="pelengkap_bh_e" id="provinsi46" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_e" id="provinsi45" /></td>
  </tr>
  <tr height="25">
    <td height="25">F</td>
    <td>PATOK LEGER JALAN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_f" id="provinsi47" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_f" id="provinsi57" /></td>
  </tr>
  <tr height="25">
    <td height="25">G</td>
    <td>PATOK RUMIJA</td>
    <td><input type="text" class="span5" name="pelengkap_bh_g" id="provinsi48" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_g" id="provinsi58" /></td>
  </tr>
  <tr height="25">
    <td height="25">H</td>
    <td>MARKA JALAN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_h" id="provinsi49" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_h" id="provinsi59" /></td>
  </tr>
  <tr height="25">
    <td height="25">I</td>
    <td>RAMBU LALU LINTAS</td>
    <td><input type="text" class="span5" name="pelengkap_bh_i" id="provinsi50" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_i" id="provinsi60" /></td>
  </tr>
  <tr height="25">
    <td height="25">J</td>
    <td>LAMPU LALU LINTAS</td>
    <td><input type="text" class="span5" name="pelengkap_bh_j" id="provinsi51" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_j" id="provinsi61" /></td>
  </tr>
  <tr height="25">
    <td height="25">K</td>
    <td>LAMPU PENERANGAN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_k" id="provinsi52" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_k" id="provinsi62" /></td>
  </tr>
  <tr height="25">
    <td height="25">L</td>
    <td>JEMBATAN PENYEBRANGAN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_l" id="provinsi53" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_l" id="provinsi63" /></td>
  </tr>
  <tr height="25">
    <td height="25">M</td>
    <td>SHELTER BIS</td>
    <td><input type="text" class="span5" name="pelengkap_bh_m" id="provinsi54" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_m" id="provinsi64" /></td>
  </tr>
  <tr height="25">
    <td height="25">N</td>
    <td>CERMIN JALAN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_n" id="provinsi55" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_n" id="provinsi65" /></td>
  </tr>
  <tr height="25">
    <td height="25">O</td>
    <td>LAINNYA / PTK BPN</td>
    <td><input type="text" class="span5" name="pelengkap_bh_o" id="provinsi56" /></td>
    <td><input type="text" class="span5" name="pelengkap_m_o" id="provinsi66" /></td>
  </tr>
  <tr height="25">
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
  <tr height="17">
    <th height="17" colspan="2" align="center">BANGUNAN UTILITAS</th>
    <th>(BUAH)</th>
    <th>(METER)</th>
  </tr>
  <tr height="16">
    <td height="16">A</td>
    <td>PRASARANA</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>AIR</td>
    <td><input type="text" class="span5" name="bangunan_a1_bh" id="provinsi67" /></td>
    <td><input type="text" class="span5" name="bangunan_a1_m" id="provinsi68" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>LISTRIK</td>
    <td><input type="text" class="span5" name="bangunan_a2_bh" id="provinsi70" /></td>
    <td><input type="text" class="span5" name="bangunan_a2_m" id="provinsi69" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>LISTRIK DLM TNH</td>
    <td><input type="text" class="span5" name="bangunan_a3_bh" id="provinsi71" /></td>
    <td><input type="text" class="span5" name="bangunan_a3_m" id="provinsi72" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>TELPON</td>
    <td><input type="text" class="span5" name="bangunan_a4_bh" id="provinsi74" /></td>
    <td><input type="text" class="span5" name="bangunan_a4_m" id="provinsi73" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>TLP DLM TNH</td>
    <td><input type="text" class="span5" name="bangunan_a5_bh" id="provinsi75" /></td>
    <td><input type="text" class="span5" name="bangunan_a5_m" id="provinsi76" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>MINYAK</td>
    <td><input type="text" class="span5" name="bangunan_a6_bh" id="provinsi78" /></td>
    <td><input type="text" class="span5" name="bangunan_a6_m" id="provinsi77" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>GAS</td>
    <td><input type="text" class="span5" name="bangunan_a7_bh" id="provinsi79" /></td>
    <td><input type="text" class="span5" name="bangunan_a7_m" id="provinsi80" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>HIDRAN</td>
    <td><input type="text" class="span5" name="bangunan_a8_bh" id="provinsi82" /></td>
    <td><input type="text" class="span5" name="bangunan_a8_m" id="provinsi81" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>RUMAH  KABEL</td>
    <td><input type="text" class="span5" name="bangunan_a9_bh" id="provinsi83" /></td>
    <td><input type="text" class="span5" name="bangunan_a9_m" id="provinsi84" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>LAINNYA</td>
    <td><input type="text" class="span5" name="bangunan_a10_bh" id="provinsi86" /></td>
    <td><input type="text" class="span5" name="bangunan_a10_m" id="provinsi85" /></td>
  </tr>
  <tr height="25">
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
  <tr height="17">
    <td height="17">B</td>
    <td>SARANA</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>AIR</td>
    <td><input type="text" class="span5" name="bangunan_b1_bh" id="provinsi102" /></td>
    <td><input type="text" class="span5" name="bangunan_b1_m" id="provinsi89" /></td>
  </tr>
  <tr height="24">
    <td height="24">&nbsp;</td>
    <td>LISTRIK</td>
    <td><input type="text" class="span5" name="bangunan_b2_bh" id="provinsi103" /></td>
    <td><input type="text" class="span5" name="bangunan_b2_m" id="provinsi90" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>LISTRIK DLM TNH</td>
    <td><input type="text" class="span5" name="bangunan_b3_bh" id="provinsi104" /></td>
    <td><input type="text" class="span5" name="bangunan_b3_m" id="provinsi91" /></td>
  </tr>
  <tr height="21">
    <td height="21">&nbsp;</td>
    <td>TELPON</td>
    <td><input type="text" class="span5" name="bangunan_b4_bh" id="provinsi105" /></td>
    <td><input type="text" class="span5" name="bangunan_b4_m" id="provinsi92" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>TLP DLM TNH</td>
    <td><input type="text" class="span5" name="bangunan_b5_bh" id="provinsi106" /></td>
    <td><input type="text" class="span5" name="bangunan_b5_m" id="provinsi93" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>MINYAK</td>
    <td><input type="text" class="span5" name="bangunan_b6_bh" id="provinsi107" /></td>
    <td><input type="text" class="span5" name="bangunan_b6_m" id="provinsi94" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>GAS</td>
    <td><input type="text" class="span5" name="bangunan_b7_bh" id="provinsi108" /></td>
    <td><input type="text" class="span5" name="bangunan_b7_m" id="provinsi95" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>HIDRAN</td>
    <td><input type="text" class="span5" name="bangunan_b8_bh" id="provinsi109" /></td>
    <td><input type="text" class="span5" name="bangunan_b8_m" id="provinsi96" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>RUMAH KABEL</td>
    <td><input type="text" class="span5" name="bangunan_b9_bh" id="provinsi110" /></td>
    <td><input type="text" class="span5" name="bangunan_b9_m" id="provinsi97" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>LAINNYA</td>
    <td><input type="text" class="span5" name="bangunan_b10_bh" id="provinsi101" /></td>
    <td><input type="text" class="span5" name="bangunan_b10_m" id="provinsi98" /></td>
  </tr>
</table>
			<!-- TAB 4 --> 
						
</div>

    


 <div class="tab-pane" id="purple"> 
 
		 <div class="control-group" >
				<legend class="bg-header">5. LOKASI</legend>
		 </div> 	 
			<!-- TAB 4 -->  
				<table width="100%" border="1" class="table">
 
  <tbody>
  <tr height="20">
    <th height="20" colspan="2" align="center">JENIS PERMUKAAN JALAN</th>
    <th width="34">&nbsp;</th>
    <th width="546">&nbsp;</th>
  </tr>
  <tr height="25">
    <td width="18" height="39">A</td>
    <td width="466">Peta Propinsi </td>
    <td>:</td>
    <td><input name="PETA" type="file" /> <!--<input type="file" name="userfile" size="15" value="" />--></td>
  </tr>
  <tr height="25">
    <td height="25">B</td>
    <td>Sket Lokasi Ruas Jalan </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>Awal Ruas </td>
    <td>X</td>
    <td><input type="text" class="span5" name="x_ruas_awal" id="provinsi410" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>Y</td>
    <td><input type="text" class="span5" name="y_ruas_awal" id="provinsi1102" /></td>
  </tr>
  
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>Z</td>
    <td><input type="text" class="span5" name="z_ruas_awal" id="provinsi610" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>Akhir Ruas </td>
    <td>X</td>
    <td><input type="text" class="span5" name="x_ruas_akhir" id="provinsi710" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>Y</td>
    <td><input type="text" class="span5" name="y_ruas_akhir" id="provinsi810" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>Z</td>
    <td><input type="text" class="span5" name="z_ruas_akhir" id="provinsi910" /></td>
  </tr>
  <tr height="25">
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="text" class="span5" name="provinsi1010" id="provinsi1010" /></td>
  </tr>
</tbody></table>	 
	
			<!-- TAB 4 --> 
						
</div>

	
    </div>
	
	<BR>
	
	
	<table width="50%" border="1" class="table"> 
  <tr>
    <td colspan="5">DIPERSIAPKAN </td>
  </tr>
  <tr>
    <td width="20%">TEMPAT DI</td>
    <td width="4%">:</td>
    <td colspan="3"><input type="text" class="" name="tempat_dipersiapkan" id="" /></td>
  </tr>
  <tr>
    <td>TANGGAL</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="datepicker" name="tgl_dipersiapkan" id="" /></td>
  </tr>
  <tr>
    <td>OLEH</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="" name="oleh_dipersiapkan" id="" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="12%">NIP</td>
    <td width="2%">:</td>
    <td width="62%"><input type="text" class="" name="nip_dipersiapkan" id="" /></td>
  </tr>
   <tr>
    <td colspan="2"></td>
    <td>NAMA</td>
    <td>:</td>
    <td><input type="text" class="" name="nama_dipersiapkan" id="" /></td>
  </tr>
</table>
 
<br />
<table width="75%" border="1" class="table">
  <tr>
    <td colspan="5">DIUMUMKAN</td>
  </tr>
  <tr>
    <td width="20%">TEMPAT DI</td>
    <td width="4%">:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="tempat_diumumkan" /></td>
  </tr>
  <tr>
    <td>TANGGAL</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="tgl_diumumkan" /></td>
  </tr>
  <tr>
    <td>OLEH</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="oleh_diumumkan" /></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td width="12%">NIP</td>
    <td width="3%">:</td>
    <td width="61%"><input type="text" class="span6"  id=""   name="nip_diumumkan" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>NAMA</td>
    <td>:</td>
    <td><input type="text" class="span6"  id=""   name="nama_diumumkan" /></td>
  </tr>
</table>
<br />
<table width="75%" border="1" class="table">
  <tr>
    <td colspan="5">DIPERIKSA </td>
  </tr>
  <tr>
    <td width="20%">TEMPAT DI</td>
    <td width="4%">:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="tempat_diperiksa" /></td>
  </tr>
  <tr>
    <td>TANGGAL</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="tgl_diperiksa" />
      <input type="text" class="span6"  id="tempat_diperiksa"   name="oleh_dikukuhkan" /></td>
  </tr>
  <tr>
    <td>OLEH</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="oleh_diperiksa" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="12%">NIP</td>
    <td width="3%">:</td>
    <td width="61%"><input type="text" class="span6"  id=""   name="nip_diperiksa" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>NAMA</td>
    <td>:</td>
    <td><input type="text" class="span6"  id=""   name="nama_diperiksa" /></td>
  </tr>
</table>
<br/>
<table width="75%" border="1" class="table">
  <tr>
    <td width="20%">DISETUJUI</td>
    <td width="4%">:</td>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td>DI</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id="tempat_dikukuhkan"   name="tempat_disetujui" /></td>
  </tr>
  <tr>
    <td>TANGGAL</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id="tgl_dikukuhkan"   name="tgl_disetujui" /></td>
  </tr>
  <tr>
    <td>OLEH</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id="oleh_dikukuhkan"   name="oleh_disetujui" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="12%">NIP</td>
    <td width="3%">:</td>
    <td width="61%"><input type="text" class="span6"  id="nip_disetujui"   name="nip_disetujui" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>NAMA</td>
    <td>:</td>
    <td><input type="text" class="span6"  id="nama_disetujui"   name="nama_disetujui" /></td>
  </tr>
</table>
<br />
<table width="75%" border="1" class="table">
  <tr>
    <td colspan="5">DITETAPKAN/DIKUKUHKAN</td>
  </tr>
  <tr>
    <td width="20%">TEMPAT DI</td>
    <td width="4%">:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="tempat_dikukuhkan" /></td>
  </tr>
  <tr>
    <td>TANGGAL</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="tgl_dikukuhkan" /></td>
  </tr>
  <tr>
    <td>OLEH</td>
    <td>:</td>
    <td colspan="3"><input type="text" class="span6"  id=""   name="oleh_dikukuhkan" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="12%">NIP</td>
    <td width="3%">:</td>
    <td width="61%"><input type="text" class="span6"  id=""   name="nip_dikukuhkan" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>NAMA</td>
    <td>:</td>
    <td><input type="text" class="span6"  id=""   name="nama_dikukuhkan" /></td>
  </tr>
</table>
<br/>


	  <script type="text/javascript">	
function addRowToTable()
{
	var tbl = document.getElementById('tblItem2');
	var lastRow = tbl.rows.length;
	var iterasi_spph = lastRow+1;
	var row = tbl.insertRow(lastRow); 
	
	//alert(iterasi_spph);
	var no = iterasi_spph-3;
	var cell1 = row.insertCell(0);
	cell1.innerHTML = "<td class=tdatahead><input type=\"text\" size=\"25\" name=\"LUAS_" +iterasi_spph+ "\"    ></td>";
	
	var cell2 = row.insertCell(1);
	cell2.innerHTML = "<td class=tdatahead><input type=\"text\" size=\"25\" name=\"DATA_" +iterasi_spph+ "\" ></td>";
	
	var cell3 = row.insertCell(2);
	cell3.innerHTML = "<td class=tdatahead><input type=\"text\" size=\"15\" name=\"NOJP_" +iterasi_spph+ "\" ></td>";
	
 
	document.getElementById("iterasi_spph").value = iterasi_spph;

	
}
 


function removeRowFromTable() 
	{
	var tbl = document.getElementById('tblItem2');
	var lastRow2 = tbl.rows.length;	
	var iterasi_spph2 = lastRow2-1;
	if (lastRow2 > 0) {
		tbl.deleteRow(lastRow2 - 1);	
		document.getElementById("iterasi_spph").value = iterasi_spph2;
	}
   }
     
	
</script>
	
</div>
 
					<div class="control-group">
						<div class="controls"> 
					 
						

				  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="st" value="<?php echo $st; ?>"  >
	  
	   <center><button type="submit" class="btn btn-primary">Simpan Data</button>  <button type="reset" class="btn btn-primary" onClick="location.href='<?php echo base_url(); ?>ledger_jalan/index/'" class="btn">Batal
	   </button></center>
	  
    </div>
  </div>
							 
							
						</div>
						
	 
       <?php echo form_close(); ?>  
     
      </div>
            </div><!--/span--> 
  </div><!--/row--> 
                <!-- END TABLE --> 
    </div>  <!-- /end #content -->
  </div><!-- /end #pagewrapper -->
   <script type='text/javascript' src='<?php echo base_url();?>asset/js/jquery-1.8.2.min.js'></script>  
    <script type='text/javascript' src='<?php echo base_url();?>asset/js/jquery.autocomplete.js'></script>
  <div class="clearbox">&nbsp;</div>
  <?php  echo $footer; ?> 
  
  
  
 

