<?php
require_once 'constant/Bahu.cst.php';
require_once 'constant/Lajur.cst.php';
require_once 'constant/Kondisi.cst.php';
require_once 'constant/JenisBahu.cst.php';
require_once 'constant/Perkerasan.cst.php';
class Jalan{


public static function gambar_km_meter(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl, $panjang_image){
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";		
		$rs  = $db->Execute($sql);
		
	
		$im = @imagecreatetruecolor($panjang_image, 30)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		
		
		
		if($db->RowCount($rs) == 0){
		}else{

		$row = $db->FetchArray($rs);
		$panjang = (float)$row['Panjang'];
		$sk_length = $panjang;
	
		if($sk_length>=10){
			$per_px_panjang=$panjang_image / $sk_length;
			$flag_print=5;
			$tambah_angka=1;
		}elseif($sk_length>=5 && $sk_length<10){
			$per_px_panjang=(0.5 / $sk_length) * $panjang_image;
			$flag_print=2;
			$tambah_angka=0.5;
		}elseif($sk_length>=3 && $sk_length<5){
			$per_px_panjang=(0.25 / $sk_length) * $panjang_image;
			$flag_print=2;
			$tambah_angka=0.25;
		}elseif($sk_length<3){
			$per_px_panjang=(0.1 / $sk_length) * $panjang_image;
			$flag_print=2;
			$tambah_angka=0.1;
		}
			
		
		//-------------- gambar km ------------------------------
			$line_color = imagecolorallocate($im, 0, 0, 255);
	
			$x=0;
			$y=0;
			$flag_angka=0;
			$flag=0;
			$tipis=0;
			
			$rsl = $db->Execute("
				SELECT
					svy_deskripsi.post AS post,
					svy_deskripsi.offset AS offset
					
				FROM 
					svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
				WHERE
					svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
					id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
					timestamp = '".$Waktu."'
				ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
				LIMIT 1	
			");
			$rowT = $db->FetchArray($rsl);
			
	
			$kp_from = (float)$rowT['post'];
			$flag_angka= (float)$rowT['post'] * 1000/1000;
			$awal=$flag_angka;
			
			$AngkaAtas = -3;	//penempatan km
			
			while($flag<$panjang_image){				
				if($flag_angka==$awal){
					imagestring($im,3,1,$AngkaAtas,$flag_angka." Km",$line_color);
				}else{
					if($tipis==$flag_print){					
						imagestring($im,3,$x,$AngkaAtas,$flag_angka,$line_color);
						$tipis=0;
					}else{
						
					}
				}
				$x = $x + $per_px_panjang;
				$flag=$x;			
				$flag_angka+=$tambah_angka;
				$tipis=$tipis+1;
			
			}
			imagestring($im,3,890,$AngkaAtas,$sk_length+$kp_from,$line_color);
		//---------------END gambar km --------------------------------		
			
		
		
		}
		imagepng($im);
		imagedestroy($im);
	}

public static function gambar_keterangan_kondisi_tepi(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl, $panjang_image){
				
		$im = @imagecreatetruecolor(20, 200)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		//------------gambar garis batas tiap bidang DAN PENAMAAN----------
		$x1= 0;
		$x2= 10;
		
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,15,'TKI',$rec);
		
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,30,'DKI',$rec);
	
				
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,45,'BKI',$rec);
	
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,65,'2K1',$rec);
	
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,85,'1KI',$rec);
		
		
		
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,100,'1KA',$rec);
		
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,120,'2KA',$rec);
				
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,140,'BKA',$rec);		
		
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,158,'DKA',$rec);		
	
	
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,170,'TKA',$rec);
	
		
		imagepng($im);	
		imagedestroy($im);
	}
	
public static function gambar_keterangan_kondisi_jalan(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl, $panjang_image){
				
		$im = @imagecreatetruecolor(20, 200)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		//------------gambar garis batas tiap bidang DAN PENAMAAN----------
		$x1= 0;
		$x2= 10;
		
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,35,'2K1',$rec);
	
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,55,'1KI',$rec);

		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,70,'1KA',$rec);
		
		$rec = imagecolorallocate($im, 0, 0, 0);
		imagestring($im,2,0,90,'2KA',$rec);
	
			
		imagepng($im);	
		imagedestroy($im);
	}
	
public static function gambar_keterangan_perkerasan_jalan(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl, $panjang_image){
				
		$im = @imagecreatetruecolor(110, 260)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		//------------gambar garis batas tiap bidang DAN PENAMAAN----------
			$x1=0;
			$x2=900;
			$rec_merah = imagecolorallocate($im, 255, 0, 0);
			$rec_hijau = imagecolorallocate($im, 0, 255, 0);			
			$rec_biru = imagecolorallocate($im, 0, 0, 255);	
			$rec_kuning = imagecolorallocate($im, 205, 208, 0);		
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,10,$x2,10,$rec);
			imagestring($im,2,0,10,'AC-WC',$rec_hijau);

			imagefilledrectangle($im,$x1,30,$x2,30,$rec);			
			imagestring($im,2,0,30,'HRS-WC',$rec_hijau);

			imagefilledrectangle($im,$x1,50,$x2,50,$rec);
			imagestring($im,2,0,50,'AC-BC',$rec_hijau);
			
			imagefilledrectangle($im,$x1,70,$x2,70,$rec);
			imagestring($im,2,0,70,'Concrate',$rec_hijau);	
					
			imagefilledrectangle($im,$x1,90,$x2,90,$rec);
			imagestring($im,2,0,90,'ATB',$rec_merah);		
				
			imagefilledrectangle($im,$x1,110,$x2,110,$rec);			
			imagestring($im,2,0,110,'Lean Concrate',$rec_merah);	
					
			imagefilledrectangle($im,$x1,130,$x2,130,$rec);
			imagestring($im,2,0,130,'CTB',$rec_merah);			
			
			imagefilledrectangle($im,$x1,150,$x2,150,$rec);
			imagestring($im,2,0,150,'Agregat Kelas A',$rec_merah);		
				
			imagefilledrectangle($im,$x1,170,$x2,170,$rec);
			imagestring($im,2,0,170,'CTSB',$rec_kuning);	
					
			imagefilledrectangle($im,$x1,190,$x2,190,$rec);
			imagestring($im,2,0,190,'Agregat Kelas B',$rec_kuning);	
					
			imagefilledrectangle($im,$x1,210,$x2,210,$rec);
			imagestring($im,2,0,210,'Selected Materials',$rec);		
				
			imagefilledrectangle($im,$x1,230,$x2,230,$rec);
			imagestring($im,2,0,230,'Soil Cements',$rec);		
				
			imagefilledrectangle($im,$x1,250,$x2,250,$rec);
	
			
		imagepng($im);	
		imagedestroy($im);
	}	

public static function Posisi_Jembatan(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl,$panjang_image){		
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";		
		$rs  = $db->Execute($sql);
		
	
		$im = @imagecreatetruecolor($panjang_image+18, 200)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		
		
		if($db->RowCount($rs) == 0){
		}else{
			$row = $db->FetchArray($rs);

			$sk_length = (float)$row['Panjang'];
			$per_px_panjang= $panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$query= "
					  SELECT
						
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset,
						svy_deskripsi.id__mst_lajur AS lajur
						
					FROM 
						svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
			 ";
			$rs2  = $db->Execute($query);	
			
			
			
			$sql=  "
					  SELECT
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset
						
					FROM 
						svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
					LIMIT 1
			";
			$rsl  = $db->Execute($sql);	
			$rowT = $db->FetchArray($rsl);				
			$patokan= (float)$rowT['post'] + $rowT['offset']/1000;
	
						
			//-----------------gambar daerah jalan-----------------------
			 while($row2 = $db->FetchArray($rs2)){
				$lajur= $row2['lajur'];
				$awal=  (float)$row2['post'] * 1000/1000;
				$akhir = (float)$row2['offset'] * 1000/1000;
				$awal = $awal - $patokan;
				$akhir = $akhir - $patokan;

				
				
				if($lajur == LajurConstant::KI1){ 
					$x1 = (float)$awal * $per_px_panjang;
					$x2 = (float)$akhir * $per_px_panjang;
					$y1 = 100;
					$y2 = (float)100 - $per_px_lebar * 4;
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					$rec = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im,$x1,$y2,$x2,$y2-1,$rec);
					
				}elseif($lajur== LajurConstant::KA1){
					$x1 = (float)$awal * $per_px_panjang;
					$x2 = (float)$akhir * $per_px_panjang;
					$y1 = 100;
					$y2 = (float)100 + $per_px_lebar* 4;
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					$rec = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im,$x1,$y2,$x2,$y2+1,$rec);
				}
			}//---------------------------------------------
			
			//------------gambar garis tengah----------------
			$line_tgh = imagecolorallocate($im, 10, 10, 10);
			imageline($im,0,100,$panjang_image,100,$line_tgh);
			//-----------------------------------------------
			
			//-------------gambar garis km--------------
			$x=0;		
			$flag=0;
			$tipis=0;
			
			if($sk_length>=10){
				$per_px_panjang2=$panjang_image / $sk_length;
				$flag_print=5;
				$tambah_angka=1;
			}elseif($sk_length>=5 && $sk_length<10){
				$per_px_panjang2=(0.5 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.5;
			}elseif($sk_length>=3 && $sk_length<5){
				$per_px_panjang2=(0.25 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.25;
			}elseif($sk_length<3){
				$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.1;
			}
			
			
			$sql=  "
					  SELECT
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset
						
					FROM 
						svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
					LIMIT 1
			";
			$rsl  = $db->Execute($sql);	
			$rowT = $db->FetchArray($rsl);				
			$flag_angka= (float)$rowT['post'] + $rowT['offset']/1000;
			$awal=$flag_angka;
			
			
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 190, 190, 190);
				}
				imageline($im,$x,10,$x,190,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//---------------------------------------------------
			//----------------gambar posisi jembatan-------------
			$query="SELECT CONCAT(post,'.',offset)'km_lokasi'
					FROM 
						svy_posisi_jembatan 
					WHERE 
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'";
			$rs_jembatan = $db->Execute($query);
			
			$tinggi_garis_merah_naik = 20;
			$tinggi_garis_merah_turun = 190;	
			$tebal_garis = 2;		
			while($rowJemb = $db->FetchArray($rs_jembatan)){
				$lokasi=(float)($rowJemb['km_lokasi'] * $per_px_panjang)-($awal * $per_px_panjang);
				$color_jemb=imagecolorallocate($im, 255, 0, 0);	
#				imagefilledrectangle($im,$lokasi-1,$tinggi_garis_merah_naik,$lokasi,$tinggi_garis_merah_turun,$color_jemb);
				imagefilledrectangle($im,$lokasi-$tebal_garis,12,$lokasi,188,$color_jemb);				
				
			}
			
		
			
			//---------------END gambar posisi jembatan -----------------------------
			
			//-------------- gambar km ------------------------------
				$line_color = imagecolorallocate($im, 0, 0, 255);

				$x=0;
				$y=0;
				$flag_angka=0;
				$flag=0;
				$tipis=0;
				
				$rsl = $db->Execute("
					SELECT
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset
						
					FROM 
						svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
					LIMIT 1	
				");
				$rowT = $db->FetchArray($rsl);
				

				$kp_from = (float)$rowT['post'];
				$flag_angka= (float)$rowT['post'] * 1000/1000;
				$awal=$flag_angka;
				
				$AngkaAtas = -3;	//penempatan km
				
				while($flag<$panjang_image){				
					if($flag_angka==$awal){
						imagestring($im,3,1,$AngkaAtas,$flag_angka." Km",$line_color);
					}else{
						if($tipis==$flag_print){					
							imagestring($im,3,$x,$AngkaAtas,$flag_angka,$line_color);
							$tipis=0;
						}else{
							
						}
					}
					$x = $x + $per_px_panjang;
					$flag=$x;			
					$flag_angka+=$tambah_angka;
					$tipis=$tipis+1;
				
				}
				imagestring($im,3,890,$AngkaAtas,$sk_length+$kp_from,$line_color);
			//---------------END gambar km --------------------------------				
		} //tutup else

		imagepng($im);	
		imagedestroy($im);
	}
	
public static function gambar_diagram_lebar_ruas_jalan(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl, $panjang_image){		
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";		
		$rs  = $db->Execute($sql);
		
	
		$im = @imagecreatetruecolor($panjang_image+18, 200)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		
		
		
		if($db->RowCount($rs) == 0){
		}else{
			$nilai_array=0;
			$row = $db->FetchArray($rs);
			$panjang = (float)$row['Panjang'];
			$sk_length = $panjang;
			$per_px_panjang= $panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$query= "
					  SELECT
						svy_deskripsi.id__mst_ruas_jalan,
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset,
						svy_deskripsi.id__mst_lajur AS lajur,
						ROUND(svy_deskripsi.lebar,1) AS svy_deskripsi_lebar,
						mst_jalan.lebar AS mst_lebar,
						mst_jalan.kp_from AS mst_kpfrom,
						mst_jalan.kp_to AS mst_kp_to,
						mst_jalan.panjang AS mst__panjang
						
					FROM 
						svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'";
			$rs2  = $db->Execute($query);	
			
			
			$sql=  "
					  SELECT
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset
						
					FROM 
						svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
					LIMIT 1
			";
			$rsl  = $db->Execute($sql);	
			$rowT = $db->FetchArray($rsl);				
			$patokan= (float)$rowT['post'] + $rowT['offset']/1000;
	
						
			//-----------------gambar daerah jalan-----------------------
			 while($row2 = $db->FetchArray($rs2)){
				$lajur= $row2['lajur'];
				$lebar= $row2['svy_deskripsi_lebar'];
				
				$awal=  (float)$row2['post'] * 1000/1000;
				$akhir = (float)$row2['offset'] * 1000/1000;
				$awal = $awal - $patokan;
				$akhir = $akhir - $patokan;


				if($lebar == 0)$lebar = 2;
				
				if($lajur == LajurConstant::KI1){ 
					$x1 = (float)$awal * $per_px_panjang;
					$x2 = (float)$akhir * $per_px_panjang;
					$y1 = 100;
					$y2 = (float)100 - $per_px_lebar * $lebar;
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
				
				
					$rec = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im,$x1,$y2,$x2,$y2-1,$rec);
					
					
					$angka_x[$nilai_array]= $x1 + ((($x2-$x1) / 2))-15;
					$angka_y[$nilai_array]= $y2 + (($per_px_lebar * $lebar)/2) - 10 ;
					$angka_lebar[$nilai_array] = (float)$lebar;				
					
					$nilai_array+=1;
					
					
				}elseif($lajur== LajurConstant::KA1){
					$x1 = (float)$awal * $per_px_panjang;
					$x2 = (float)$akhir * $per_px_panjang;
					$y1 = 100;
					$y2 = (float)100 + $per_px_lebar * $lebar;
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					$rec = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im,$x1,$y2,$x2,$y2+1,$rec);
					
					$angka_x[$nilai_array]= $x1 + ((($x2-$x1) / 2))-15;
					$angka_y[$nilai_array]= $y2 - (($per_px_lebar * $lebar)/2) - 8 ;
					$angka_lebar[$nilai_array] = (float)$lebar;				
					
					$nilai_array+=1;
				}
				elseif($lajur==LajurConstant::KI2){
					$x1 = $awal * $per_px_panjang;
					$x2 = $akhir * $per_px_panjang;
					
					$query= "
							  SELECT
								ROUND(svy_deskripsi.lebar,1) AS lebar
								
							FROM 
								svy_deskripsi_ruas_jalan As svy_deskripsi
							WHERE
								id__mst_ruas_jalan ='".$IdRuasJalan."'  AND 
								timestamp = '".$Waktu."' AND
								post <= '".$row2['post']."' AND
								offset >= '".$row2['offset']."' AND
								svy_deskripsi.id__mst_lajur ='".LajurConstant::KI1."'
								
					"; 
					$result_lebar  = $db->Execute($query);	
					$row1 = $db->FetchArray($result_lebar);

					$rs1 = mysql_query($query)or die(mysql_error());					
					$row1 = mysql_fetch_array($rs1);
					
					$y1 = 98 - $per_px_lebar * $row1['lebar'] ;
					$y2 = $y1 - $per_px_lebar * $lebar;
					
					$rec = imagecolorallocate($im, 100, 245, 100);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					$rec = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im,$x1,$y2,$x2,$y2+1,$rec);
					
					$angka_x[$nilai_array]= $x1 + ((($x2-$x1) / 2))-15;
					$angka_y[$nilai_array]= $y2 + (($per_px_lebar * $lebar)/2) - 8 ;
					$angka_lebar[$nilai_array] = $lebar;				
					
					$nilai_array+=1;
				
				}elseif($lajur==LajurConstant::KA2){
					$x1 = $awal * $per_px_panjang;
					$x2 = $akhir * $per_px_panjang;
					$query= "
							  SELECT
								ROUND(svy_deskripsi.lebar,1) AS lebar
								
							FROM 
								svy_deskripsi_ruas_jalan As svy_deskripsi
							WHERE
								id__mst_ruas_jalan ='".$IdRuasJalan."'  AND 
								timestamp = '".$Waktu."' AND
								post <= '".$row2['post']."' AND
								offset >= '".$row2['offset']."' AND
								svy_deskripsi.id__mst_lajur ='".LajurConstant::KA1."'
								
					"; 
					$result_lebar  = $db->Execute($query);	
					$row1 = $db->FetchArray($result_lebar);
					$y1 = 102 + $per_px_lebar * $row1['lebar'] ;
					$y2 = $y1 + $per_px_lebar * $lebar;
					
					$rec = imagecolorallocate($im, 100, 245, 100);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					$rec = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im,$x1,$y2,$x2,$y2+1,$rec);
					
					$angka_x[$nilai_array]= $x1 + ((($x2-$x1) / 2))-15;
					$angka_y[$nilai_array]= $y2 - (($per_px_lebar * $lebar)/2) - 8 ;
					$angka_lebar[$nilai_array] = $lebar;				
					
					$nilai_array+=1;
				}
			}//---------------------------------------------
			
			//------------gambar garis tengah----------------
			$line_tgh = imagecolorallocate($im, 10, 10, 10);
			imageline($im,0,100,$panjang_image,100,$line_tgh);
			//-----------------------------------------------
			
			//-------------gambar garis km--------------
			$x=0;		
			$flag=0;
			$tipis=0;
			
			if($sk_length>=10){
				$per_px_panjang2=$panjang_image / $sk_length;
				$flag_print=5;
				$tambah_angka=1;
			}elseif($sk_length>=5 && $sk_length<10){
				$per_px_panjang2=(0.5 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.5;
			}elseif($sk_length>=3 && $sk_length<5){
				$per_px_panjang2=(0.25 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.25;
			}elseif($sk_length<3){
				$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.1;
			}
			
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 190, 190, 190);
				}
				imageline($im,$x,10,$x,190,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//--------------------------------------------
			
			//--------------gambar angka lebar--------------
			for($i=0;$i<$nilai_array;$i++){
				$rec = imagecolorallocate($im, 255, 255, 255);
				imagefilledrectangle($im,$angka_x[$i],$angka_y[$i],$angka_x[$i]+30,$angka_y[$i]+16,$rec);
				$rec2 = imagecolorallocate($im, 0, 0, 0);
				if(strlen($angka_lebar[$i])==1){
					imagestring($im,2,$angka_x[$i]+12,$angka_y[$i]+2,$angka_lebar[$i],$rec2);
				}else{
					imagestring($im,2,$angka_x[$i]+8,$angka_y[$i]+2,$angka_lebar[$i],$rec2);
				}
			}
			
			//-------------- gambar km ------------------------------
				$line_color = imagecolorallocate($im, 0, 0, 255);

				$x=0;
				$y=0;
				$flag_angka=0;
				$flag=0;
				$tipis=0;
				
				$rsl = $db->Execute("
					SELECT
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset
						
					FROM 
						svy_deskripsi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
					LIMIT 1	
				");
				$rowT = $db->FetchArray($rsl);
				
				$kp_from = (float)$rowT['post'];
				$flag_angka= (float)$rowT['post'] * 1000/1000;
				$awal=$flag_angka;
				
				$AngkaAtas = -3;	//penempatan km
				
				while($flag<$panjang_image){				
					if($flag_angka==$awal){
						imagestring($im,3,1,$AngkaAtas,$flag_angka." Km",$line_color);
					}else{
						if($tipis==$flag_print){					
							imagestring($im,3,$x,$AngkaAtas,$flag_angka,$line_color);
							$tipis=0;
						}else{
							
						}
					}
					$x = $x + $per_px_panjang;
					$flag=$x;			
					$flag_angka+=$tambah_angka;
					$tipis=$tipis+1;
				
				}
				imagestring($im,3,890,$AngkaAtas,$sk_length+$kp_from,$line_color);
					
			
			
			
			//-----------------------------------------------			
		} //tutup else

		imagepng($im);	
		imagedestroy($im);
	}
	
	
public static function gambar_diagram_kondisi_tepi(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl, $panjang_image, $cek = 0){
		
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";			
	
		$rs  = $db->Execute($sql);
		
		$im = @imagecreatetruecolor($panjang_image+18, 200)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		
		if($db->RowCount($rs) == 0){
		}else{
		
			$row = $db->FetchArray($rs);
			$sk_length = $row['Panjang'];
			$per_px_panjang=$panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$query= "
					SELECT
						svy_tepi_jalan.id__mst_ruas_jalan,
						svy_tepi_jalan.post AS post,
						svy_tepi_jalan.offset AS offset,
						svy_tepi_jalan.id__mst_lajur AS lajur,
						svy_tepi_jalan.lebar AS svy_deskripsi_lebar,
						mst_jalan.lebar AS mst_lebar,
						mst_jalan.kp_from AS mst_kpfrom,
						mst_jalan.kp_to AS mst_kp_to,
						mst_jalan.panjang AS mst__panjang,
											
						svy_tepi_jalan.id__mst_jenis_bahu AS bahu_id
						
					FROM 
						svy_kondisi_tepi_jalan As svy_tepi_jalan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_tepi_jalan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'";
			$rs2  = $db->Execute($query);	
			
			$sql=  "
					  SELECT
						svy_tepi_jalan.post AS post,
						svy_tepi_jalan.offset AS offset						
					FROM 
						svy_kondisi_tepi_jalan As svy_tepi_jalan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_tepi_jalan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_tepi_jalan.post,svy_tepi_jalan.offset ASC
					LIMIT 1
			";
			$rsl  = $db->Execute($sql);	
			$rowT = $db->FetchArray($rsl);				
			$patokan= (float)$rowT['post'] + $rowT['offset']/1000;
			
									
			//-----------------gambar daerah jalan-----------------------
			while($row2 = $db->FetchArray($rs2)){
				$lajur= $row2['lajur'];
				$lebar= $row2['svy_deskripsi_lebar'];
				$bahu = $row2['bahu_id'];
					
				$awal=  (float)$row2['post'] * 1000/1000;
				$akhir = (float)$row2['offset'] * 1000/1000;
				$awal = $awal - $patokan;
				$akhir = $akhir - $patokan;
				$x1 = ($awal * $per_px_panjang);
				$x2 = ($akhir * $per_px_panjang);
				
				
				if($lajur==LajurConstant::KI1){
					
					$y1 = 100;
					$y2 = 80;
					
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
					
				}elseif($lajur==LajurConstant::KA1){
					
					$y1 = 100;
					$y2 = 120;
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
										
					
				}elseif($lajur==LajurConstant::KA2){
									
							
					$y1 = 79 ;
					$y2 = 60;
					
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				
				}elseif($lajur==LajurConstant::KI2){
									
					$y1 = 121;
					$y2 = 140;
					
					$rec = imagecolorallocate($im, 74, 245, 235);
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
									
				}elseif($lajur == LajurConstant::BKI){
					$y1 = 59;
					$y2 = 45;
					
					if($bahu==""){	//------------buka if----------
						$rec = imagecolorallocate($im, 255, 255, 255);
					}else{
						$query="
								SELECT id AS bahu_jenis
								FROM mst_jenis_bahu 
								WHERE id='".$bahu."' AND 
								id__mst_bahu_group='".BahuConstant::Bahu."'";
						$rs_bahu = $db->Execute($query);
						if($db->RowCount($rs_bahu) == 0){
							$rec = imagecolorallocate($im, 255, 255, 255);
						}else{
							$rowBahu = $db->FetchArray($rs_bahu);
							switch($rowBahu['bahu_jenis']){
								case JenisBahuConstant::BahuTanah : $rec = imagecolorallocate($im, 255, 128, 0); break;
								case JenisBahuConstant::BahuAgregat : $rec = imagecolorallocate($im, 255, 255, 0); break;
								case JenisBahuConstant::BahuAspal : $rec = imagecolorallocate($im, 128, 128, 128); break;
							}
						}						
					}	//---------------------tutup if---------
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
					
				}elseif($lajur== LajurConstant::DKI){
					$y1 = 44;
					$y2 = 30;
					
					if($bahu==""){	//------------buka if----------
						$rec = imagecolorallocate($im, 255, 255, 255);
					}else{
						$query="
								SELECT id AS bahu_jenis 
								FROM mst_jenis_bahu 
								WHERE id='".$bahu."' AND 
								id__mst_bahu_group='".BahuConstant::Drainase."'";
						$rs_bahu = $db->Execute($query);
						if($db->RowCount($rs_bahu) == 0){
							$rec = imagecolorallocate($im, 255, 255, 255);
						}else{
							$rowBahu = $db->FetchArray($rs_bahu);
							switch($rowBahu['bahu_jenis']){
								case JenisBahuConstant::DrainaseAspal : $rec = imagecolorallocate($im, 128, 128, 128); break;
								case JenisBahuConstant::DrainasePasanganBatu : $rec = imagecolorallocate($im, 0, 0, 255); break;
								case JenisBahuConstant::DrainaseBeton : $rec = imagecolorallocate($im, 255, 0, 255); break;
								case JenisBahuConstant::DrainaseTanah : $rec = imagecolorallocate($im, 255, 128, 0); break;
							}
						}						
					}	//---------------------tutup if---------
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				}elseif($lajur == LajurConstant::TKI){
					$y1 = 29;
					$y2 = 15;
					
					if($bahu==""){	//------------buka if----------
						$rec = imagecolorallocate($im, 255, 255, 255);
					}else{
						$query="
								SELECT id AS bahu_jenis 
								FROM mst_jenis_bahu 
								WHERE id='".$bahu."' AND 
								id__mst_bahu_group='".BahuConstant::Tebing."'";
						$rs_bahu = $db->Execute($query);
						if($db->RowCount($rs_bahu) == 0){
							$rec = imagecolorallocate($im, 255, 255, 255);
						}else{
							$rowBahu = $db->FetchArray($rs_bahu);
							switch($rowBahu['bahu_jenis']){
								case JenisBahuConstant::TebingTanah : $rec = imagecolorallocate($im, 255, 128, 0); break;
								case JenisBahuConstant::TebingPasanganBatu : $rec = imagecolorallocate($im, 0, 0, 255); break;
								case JenisBahuConstant::TebingBeton : $rec = imagecolorallocate($im, 255, 0, 255); break;
								case JenisBahuConstant::TebingPancangBesi : $rec = imagecolorallocate($im, 255, 0, 0); break;
								case JenisBahuConstant::TebingBronjong : $rec = imagecolorallocate($im, 0, 255, 0); break;
							}
						}						
					}	//---------------------tutup if---------
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				}elseif($lajur== LajurConstant::BKA){
					$y1 = 141;
					$y2 = 155;
					
					if($bahu==""){	//------------buka if----------
						$rec = imagecolorallocate($im, 255, 255, 255);
					}else{
						$query="
								SELECT id AS bahu_jenis 
								FROM mst_jenis_bahu 
								WHERE id='".$bahu."' AND 
								id__mst_bahu_group='".BahuConstant::Bahu."'";
						$rs_bahu = $db->Execute($query);
						if($db->RowCount($rs_bahu) == 0){
							$rec = imagecolorallocate($im, 255, 255, 255);
						}else{
							$rowBahu = $db->FetchArray($rs_bahu);
							switch($rowBahu['bahu_jenis']){
								case JenisBahuConstant::BahuTanah  : $rec = imagecolorallocate($im, 255, 128, 0); break;
								case JenisBahuConstant::BahuAgregat  : $rec = imagecolorallocate($im, 255, 255, 0); break;
								case JenisBahuConstant::BahuAspal : $rec = imagecolorallocate($im, 128, 128, 128); break;
							}
						}						
					}	//---------------------tutup if---------
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				}elseif($lajur== LajurConstant::DKA){
					$y1 = 156;
					$y2 = 170;
					
					if($bahu==""){	//------------buka if----------
						$rec = imagecolorallocate($im, 255, 255, 255);
					}else{
						$query="
								SELECT id AS bahu_jenis 
								FROM mst_jenis_bahu 
								WHERE id='".$bahu."' AND 
								id__mst_bahu_group='".BahuConstant::Drainase."'";
						$rs_bahu = $db->Execute($query);
						if($db->RowCount($rs_bahu) == 0){
							$rec = imagecolorallocate($im, 255, 255, 255);
						}else{
							$rowBahu = $db->FetchArray($rs_bahu);

							switch($rowBahu['bahu_jenis']){
								case JenisBahuConstant::DrainaseAspal : $rec = imagecolorallocate($im, 128, 128, 128); break;
								case JenisBahuConstant::DrainasePasanganBatu : $rec = imagecolorallocate($im, 0, 0, 255); break;
								case JenisBahuConstant::DrainaseBeton : $rec = imagecolorallocate($im, 255, 0, 255); break;
								case JenisBahuConstant::DrainaseTanah : $rec = imagecolorallocate($im, 255, 128, 0); break;
							}
						}						
					}	//---------------------tutup if---------
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				}elseif($lajur== LajurConstant::TKA){
					$y1 = 171;
					$y2 = 185;
					
					if($bahu==""){	//------------buka if----------
						$rec = imagecolorallocate($im, 255, 255, 255);
					}else{
						$query="
								SELECT id AS bahu_jenis 
								FROM mst_jenis_bahu 
								WHERE id='".$bahu."' AND 
								id__mst_bahu_group='".BahuConstant::Tebing."'";
						$rs_bahu = $db->Execute($query);
						if($db->RowCount($rs_bahu) == 0){
							$rec = imagecolorallocate($im, 255, 255, 255);
						}else{
							$rowBahu = $db->FetchArray($rs_bahu);

							switch($rowBahu['bahu_jenis']){
								case JenisBahuConstant::TebingTanah : $rec = imagecolorallocate($im, 255, 128, 0); break;
								case JenisBahuConstant::TebingPasanganBatu : $rec = imagecolorallocate($im, 0, 0, 255); break;
								case JenisBahuConstant::TebingBeton : $rec = imagecolorallocate($im, 255, 0, 255); break;
								case JenisBahuConstant::TebingPancangBesi : $rec = imagecolorallocate($im, 255, 0, 0); break;
								case JenisBahuConstant::TebingBronjong : $rec = imagecolorallocate($im, 0, 255, 0); break;
							}
						}						
					}	//---------------------tutup if---------
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				}
			}
			//----------END gambar daerah jalan--------------------------
			
			//------------gambar garis tengah----------------
			$line_tgh = imagecolorallocate($im, 10, 10, 10);
			imageline($im,0,100,$panjang_image,100,$line_tgh);
			//-----------------------------------------------
			
			//------------gambar garis batas tiap bidang DAN PENAMAAN----------
			$x1= 0;
			$x2= 900;
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,15,$x2,15,$rec);
#			imagestring($im,2,0,15,'TKI',$rec);
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,30,$x2,30,$rec);
#			imagestring($im,2,0,30,'DKI',$rec);
		
					
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,45,$x2,45,$rec);
#			imagestring($im,2,0,45,'BKI',$rec);
		
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,60,$x2,60,$rec);
#			imagestring($im,2,0,60,'2K1',$rec);
		
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,80,$x2,80,$rec);
#			imagestring($im,2,0,85,'1KI',$rec);
			
			
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,120,$x2,120,$rec);
#			imagestring($im,2,0,105,'1KA',$rec);
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,140,$x2,140,$rec);	
#			imagestring($im,2,0,125,'2KA',$rec);
					
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,155,$x2,155,$rec);
#			imagestring($im,2,0,140,'BKA',$rec);		
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,170,$x2,170,$rec);
#			imagestring($im,2,0,158,'DKA',$rec);		
		
		
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,185,$x2,185,$rec);		
#			imagestring($im,2,0,170,'TKA',$rec);
			//-------------END gambar garis batas tiap bidang DAN PENAMAAN-------------
			
			//-------------gambar garis km--------------
			$x=0;		
			$flag=0;
			$tipis=0;
			
			if($sk_length>=10){
				$per_px_panjang2=$panjang_image / $sk_length;
				$flag_print=5;
				$tambah_angka=1;
			}elseif($sk_length>=5 && $sk_length<10){
				$per_px_panjang2=(0.5 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.5;
			}elseif($sk_length>=3 && $sk_length<5){
				$per_px_panjang2=(0.25 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.25;
			}elseif($sk_length<3){

				$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.1;
			}
			
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 190, 190, 190);
				}
				$x__atas = 15;
				$x__bawah = 185;
				imageline($im,$x,$x__atas,$x,$x__bawah,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//---------------end gambar garis km-------------------------
			
			//-------------- gambar km ----------------------------------
			$line_color = imagecolorallocate($im, 0, 0, 255);

				$x=0;
				$y=0;
				$flag_angka=0;
				$flag=0;
				$tipis=0;
				
				$rsl = $db->Execute("
					SELECT
						svy_tepi_jalan.post AS post,
						svy_tepi_jalan.offset AS offset
						
					FROM 
						svy_kondisi_tepi_jalan As svy_tepi_jalan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_tepi_jalan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_tepi_jalan.post,svy_tepi_jalan.offset ASC
					LIMIT 1	
				");
				$rowT = $db->FetchArray($rsl);
				
#				$flag_angka= (float)$rowT['kp_from'] * 1000/1000;
				$kp_from = (float)$rowT['post'];
				$flag_angka= (float)$rowT['post'] * 1000/1000;
				$awal=$flag_angka;
				
				$AngkaAtas = -3;	//penempatan km
				
				while($flag<$panjang_image){				
					if($flag_angka==$awal){
						imagestring($im,3,1,$AngkaAtas,$flag_angka." Km",$line_color);
					}else{
						if($tipis==$flag_print){					
							imagestring($im,3,$x,$AngkaAtas,$flag_angka,$line_color);
							$tipis=0;
						}else{
							
						}
					}
					$x = $x + $per_px_panjang;
					$flag=$x;			
					$flag_angka+=$tambah_angka;
					$tipis=$tipis+1;
				
				}
				imagestring($im,3,890,$AngkaAtas,$sk_length+$kp_from,$line_color);
			//-------------- end gambar km ------------------------------
			} //tutup else

		imagepng($im);	
		imagedestroy($im);
	}	
		
public static function gambar_diagram_perkerasan_jalan(DatabaseInterface $db, $IdRuasJalan, $Waktu, $IdLajur,  $lbl, $panjang_image){
	
	
		
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";			
	
		$rs  = $db->Execute($sql);
		
		$im = @imagecreatetruecolor($panjang_image, 260)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		
		if($db->RowCount($rs) == 0){
		}else{
			
			$row = $db->FetchArray($rs);
			$sk_length=$row['Panjang'];
			$per_px_panjang=$panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$query="
					SELECT 
							svy_perkerasan_jalan.timestamp,
							svy_perkerasan_jalan.post,
							svy_perkerasan_jalan.offset,
							svy_perkerasan_jalan.id__mst_perkerasan AS lyr_id,
							svy_perkerasan_jalan.lebar AS lebar,
							svy_perkerasan_jalan.tahun AS tahun

					FROM 
						svy_perkerasan_jalan As svy_perkerasan_jalan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_perkerasan_jalan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						id__mst_lajur = '".$IdLajur."' AND
						timestamp = '".$Waktu."'";
			$rs2 = $db->Execute($query);	
			
			
			
			
			$sql=  "
					  SELECT
						svy_deskripsi.post AS post
						
					FROM 
						svy_perkerasan_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
					LIMIT 1
			";
			$rsl  = $db->Execute($sql);	
			$rowT = $db->FetchArray($rsl);		
			$flag_angka=(float)$rowT['post'] * 1000/1000;
			$awal_ruas=$flag_angka;
											
			$thn_skr =(integer) date("Y");
			//-----------------gambar daerah jalan-----------------------
			while($row2 = $db->FetchArray($rs2)){				
				$layer=$row2['lyr_id'];		
				$tahun=$row2['tahun'];
				$awal=(float)$row2['post'] * 1000 /1000;
				$akhir = (float)$row2['offset'] *1000 /1000;

				$x1 = ($awal * $per_px_panjang)-($awal_ruas * $per_px_panjang);;
				$x2 = ($akhir * $per_px_panjang)-($awal_ruas * $per_px_panjang);;
				
				
				if($tahun==$thn_skr){
					$rec = imagecolorallocate($im, 0, 255, 255);
				}elseif($tahun==$thn_skr-1){
					$rec = imagecolorallocate($im, 0, 255, 1);
				}elseif($tahun==$thn_skr-2){
					$rec = imagecolorallocate($im, 255, 255, 0);
				}elseif($tahun==$thn_skr-3){
					$rec = imagecolorallocate($im, 255, 127, 0);
				}elseif($tahun==$thn_skr-4){
					$rec = imagecolorallocate($im, 255, 0, 0);
				}else{
					$rec = imagecolorallocate($im, 255, 0, 254);
				}
							
				$query="SELECT id AS lyr_nama FROM mst_perkerasan WHERE id='".$layer."'";
				$rslayer = $db->Execute($query);
				$lyr = $db->FetchArray($rslayer);
				
				if($lyr['lyr_nama']== PerkerasanConstant::ACWC){
					
					$y1 = 11;
					$y2 = 30;										
				}elseif($lyr['lyr_nama']== PerkerasanConstant::HRSWC){
					
					$y1 = 31;
					$y2 = 50;										
				}elseif($lyr['lyr_nama']== PerkerasanConstant::ACBC){
									
							
					$y1 = 51;
					$y2 = 70;									
				
				}elseif($lyr['lyr_nama']== PerkerasanConstant::Concrate){
									
					$y1 = 71;
					$y2 = 90;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::ATB){
									
					$y1 = 91;
					$y2 = 110;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::LeanConcrate){
									
					$y1 = 111;
					$y2 = 130;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::CTB){
									
					$y1 = 131;
					$y2 = 150;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::AgregatKelasA){
									
					$y1 = 151;
					$y2 = 170;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::CTSB){
									
					$y1 = 171;
					$y2 = 190;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::AgregatKelasB){
									
					$y1 = 191;
					$y2 = 210;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::SelectedMaterials){
									
					$y1 = 211;
					$y2 = 230;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::SoilCements){
									
					$y1 = 231;
					$y2 = 250;				
									
				}
				
				imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);	
					
			}//---------------------------------------------
			
			#------------gambar garis tengah----------------
			#$line_tgh = imagecolorallocate($im, 10, 10, 10);
			#imageline($im,0,130,$panjang_image,130,$line_tgh);
			#-----------------------------------------------
			
			//------------gambar garis batas  horizontal tiap bidang DAN PENAMAAN----------
			$x1=0;
			$x2=900;
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,10,$x2,10,$rec);
			imagefilledrectangle($im,$x1,30,$x2,30,$rec);			
			imagefilledrectangle($im,$x1,50,$x2,50,$rec);
			imagefilledrectangle($im,$x1,70,$x2,70,$rec);
			imagefilledrectangle($im,$x1,90,$x2,90,$rec);
			imagefilledrectangle($im,$x1,110,$x2,110,$rec);			
			imagefilledrectangle($im,$x1,130,$x2,130,$rec);
			imagefilledrectangle($im,$x1,150,$x2,150,$rec);
			imagefilledrectangle($im,$x1,170,$x2,170,$rec);
			imagefilledrectangle($im,$x1,190,$x2,190,$rec);
			imagefilledrectangle($im,$x1,210,$x2,210,$rec);
			imagefilledrectangle($im,$x1,230,$x2,230,$rec);
			imagefilledrectangle($im,$x1,250,$x2,250,$rec);
			
			//----------------------------------------------------
			
			//-------------gambar garis km--------------
			$x=0;		
			$flag=0;
			$tipis=0;
			
			if($sk_length>=10){
				$per_px_panjang2=$panjang_image / $sk_length;
				$flag_print=5;
				$tambah_angka=1;
			}elseif($sk_length>=5 && $sk_length<10){
				$per_px_panjang2=(0.5 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.5;
			}elseif($sk_length>=3 && $sk_length<5){
				$per_px_panjang2=(0.25 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.25;
			}elseif($sk_length<3){
				$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.1;
			}
			
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 180, 180, 180);
				}
				imageline($im,$x,10,$x,250,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//--------------------------------------------------------
			//-------------- gambar km ------------------------------
				$line_color = imagecolorallocate($im, 0, 0, 255);

				$x=0;
				$y=0;
				$flag_angka=0;
				$flag=0;
				$tipis=0;
				
				$rsl = $db->Execute("
					SELECT
						svy_perkerasan.post AS post,
						svy_perkerasan.offset AS offset
						
					FROM 
						svy_perkerasan_jalan As svy_perkerasan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_perkerasan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_perkerasan.post,svy_perkerasan.offset ASC
					LIMIT 1	
				");
				$rowT = $db->FetchArray($rsl);
				

				$kp_from = (float)$rowT['post'];
				$flag_angka= (float)$rowT['post'] * 1000/1000;
				$awal=$flag_angka;
				
				$AngkaAtas = -3;	//penempatan km
				
				while($flag<$panjang_image){				
					if($flag_angka==$awal){
						imagestring($im,3,-1,$AngkaAtas,$flag_angka." Km",$line_color);
					}else{
						if($tipis==$flag_print){					
							imagestring($im,3,$x,$AngkaAtas,$flag_angka,$line_color);
							$tipis=0;
						}else{
							
						}
					}
					$x = $x + $per_px_panjang;
					$flag=$x;			
					$flag_angka+=$tambah_angka;
					$tipis=$tipis+1;
				
				}
				imagestring($im,3,880,$AngkaAtas,$sk_length+$kp_from,$line_color);
			//---------------END gambar km --------------------------------		
			
			
		} //tutup else

		imagepng($im);	
		imagedestroy($im);
	
	
	
	
 }	
 
 
public static function gambar_diagram_kondisi_ruas_jalan(DatabaseInterface $db, $IdRuasJalan, $Waktu, $lbl, $panjang_image){
		
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";			
	
		$rs  = $db->Execute($sql);
		
		$im = @imagecreatetruecolor($panjang_image+18, 200)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		
		if($db->RowCount($rs) == 0){
		}else{
		
			$row = $db->FetchArray($rs);
			$sk_length = $row['Panjang']; // panjang Jalan 
			$per_px_panjang=$panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$query= "
					SELECT
							mst_jalan.lebar AS mst_lebar,
							mst_jalan.kp_from AS mst_kpfrom,
							mst_jalan.kp_to AS mst_kp_to,
							mst_jalan.panjang AS mst__panjang,
							svy_ruas_jalan.id__mst_ruas_jalan,
							svy_ruas_jalan.timestamp,
							svy_ruas_jalan.post AS post,
							svy_ruas_jalan.offset AS offset,
							svy_ruas_jalan.id__mst_lajur AS lajur,
							svy_ruas_jalan.id__mst_kondisi_jalan AS kondisi
						
					FROM 
						svy_kondisi_ruas_jalan As svy_ruas_jalan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_ruas_jalan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'";
			$rs2  = $db->Execute($query);	
			$sql= "
					SELECT
							
							svy_ruas_jalan.post AS post,
							svy_ruas_jalan.offset AS offset,
							svy_ruas_jalan.id__mst_lajur AS lajur,
							svy_ruas_jalan.id__mst_kondisi_jalan AS kondisi
						
					FROM 
						svy_kondisi_ruas_jalan As svy_ruas_jalan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_ruas_jalan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					LIMIT 1 ";
			$rsl  = $db->Execute($query);	
			$rowT = $db->FetchArray($rsl);				
			$patokan= $patokan= (float)$rowT['post'] + $rowT['offset']/1000;
	
									
			//-----------------gambar daerah jalan-----------------------
		while($row2 = $db->FetchArray($rs2)){
			$lajur= $row2['lajur'];
			$lebar=$row2['mst_lebar'];
			$awal=  (float)$row2['post'] *1000/1000;
			$akhir = (float)$row2['offset'] * 1000/1000;
			$kondisi = $row2['kondisi'];
			$awal = $awal - $patokan;
			$akhir = $akhir - $patokan;
			$x1 = $awal * $per_px_panjang;
			$x2 = $akhir * $per_px_panjang;
			

			if($kondisi==""){	//------------buka if----------
					$rec = imagecolorallocate($im, 255, 255, 255);
			}else{
				$query="
						SELECT id AS id_kondisi 
						FROM mst_kondisi_jalan 
						WHERE id='".$kondisi."'
				";
				$rsKondisi = $db->Execute($query);
				if($db->RowCount($rs) == 0){
					$rec = imagecolorallocate($im, 255, 255, 255);
				}else{
					$rowKondisi = $db->FetchArray($rsKondisi);
					switch($rowKondisi['id_kondisi']){
						case KondisiConstant::Baik : $rec = imagecolorallocate($im, 0, 255, 255); break;
						case KondisiConstant::Sedang : $rec = imagecolorallocate($im, 0, 255, 64); break;
						case KondisiConstant::RusakRingan : $rec = imagecolorallocate($im, 255, 255, 0); break;						
						case KondisiConstant::RusakBerat : $rec = imagecolorallocate($im, 255, 0, 0); break;
						}
					}						
			}	//---------------------tutup if---------
				
				if($lajur== LajurConstant::KI1){
					
					$y1 = 70;
					$y2 = 50;				
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
					
				}elseif($lajur== LajurConstant::KI2){
									
							
					$y1 = 50 ;
					$y2 = 10;
					
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				
				}elseif($lajur== LajurConstant::KA1){
					
					$y1 = 70;
					$y2 = 90;	
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
										
					
				}elseif($lajur== LajurConstant::KA2){
									
					$y1 = 71;
					$y2 = 90;
					
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
									
				}
			}
			//---------------------------------------------			
			//------------gambar garis tengah----------------
			$line_tgh = imagecolorallocate($im, 0, 0, 0);
			imageline($im,0,70,$panjang_image,70,$line_tgh);
			//-----------------------------------------------
			
			//------------gambar garis batas  horizontal tiap bidang DAN PENAMAAN----------
			$x1= 0;
			$x2= 900;
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,30,$x2,30,$rec);
#			imagestring($im,2,0,30,'2K1',$rec);
		
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,50,$x2,50,$rec);
#			imagestring($im,2,0,50,'1KI',$rec);
			
			
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,90,$x2,90,$rec);
#			imagestring($im,2,0,75,'1KA',$rec);
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,110,$x2,110,$rec);	
#			imagestring($im,2,0,95,'2KA',$rec);
					
			//----------------------------------------------------
			
			//-------------gambar garis km--------------
			$x=0;		
			$flag=0;
			$tipis=0;
			
			if($sk_length>=10){
				$per_px_panjang2=$panjang_image / $sk_length;
				$flag_print=5;
				$tambah_angka=1;
			}elseif($sk_length>=5 && $sk_length<10){
				$per_px_panjang2=(0.5 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.5;
			}elseif($sk_length>=3 && $sk_length<5){
				$per_px_panjang2=(0.25 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.25;
			}elseif($sk_length<3){
				$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.1;
			}
			$x_y = 10;
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 140, 140, 140);
				}
				imageline($im,$x,$x_y,$x,140,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//--------------------------------------------
			
			
			
			
			
			//-------------- gambar km ------------------------------
				$line_color = imagecolorallocate($im, 0, 0, 255);

				$x=0;
				$y=0;
				$flag_angka=0;
				$flag=0;
				$tipis=0;
				
				$rsl = $db->Execute("
					SELECT
						svy_deskripsi.post AS post,
						svy_deskripsi.offset AS offset,
						mst_jalan.kp_from AS kp_from,
						mst_jalan.kp_from AS kp_to
						
					FROM 
						svy_kondisi_ruas_jalan As svy_deskripsi,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_deskripsi.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						timestamp = '".$Waktu."'
					ORDER BY svy_deskripsi.post,svy_deskripsi.offset ASC
					LIMIT 1	
				");
				$rowT = $db->FetchArray($rsl);
				
				$kp_from = (float)$rowT['post'];
				$flag_angka= (float)$rowT['post'] * 1000/1000;
				$awal=$flag_angka;
				
				$AngkaAtas = -3;	
				
				while($flag<$panjang_image){				
					if($flag_angka==$awal){
						imagestring($im,3,1,$AngkaAtas,$flag_angka." Km",$line_color);
					}else{
						if($tipis==$flag_print){					
							imagestring($im,3,$x,$AngkaAtas,$flag_angka,$line_color);
							$tipis=0;
						}else{
							
						}
					}
					$x = $x + $per_px_panjang;
					$flag=$x;			
					$flag_angka+=$tambah_angka;
					$tipis=$tipis+1;
				
				}
				imagestring($im,3,889,$AngkaAtas,$sk_length+$kp_from,$line_color);
					
			//-------------- END gambar km ------------------------------	
		} //tutup else

		imagepng($im);	
		imagedestroy($im);
	}	
 
 
# detail kondisi jalan 
public static function gambar_kondisi_jalan_per_10km(DatabaseInterface $db, $IdRuasJalan, $Waktu,$Km_Ke ,$lbl ,$panjang_image){
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";	
		$rs  = $db->Execute($sql);
		
		$im = @imagecreatetruecolor($panjang_image, 100)
		 or die("Cannot Initialize new GD image stream"); //create new file image		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 

		$awal_km = ($Km_Ke-1) * 10;
		$akhir_km = $Km_Ke * 10;
		
		
		
		if($db->RowCount($rs) == 0){
		}else{
			$row = $db->FetchArray($rs);
			$sk_length=10;
			$per_px_panjang=$panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$query="
				SELECT 
						svy_kondisi_ruas_jalan.id__mst_ruas_jalan,
						svy_kondisi_ruas_jalan.timestamp,
						svy_kondisi_ruas_jalan.post'post',
						svy_kondisi_ruas_jalan.offset'offset',
						svy_kondisi_ruas_jalan.id__mst_lajur 'lajur',
						svy_kondisi_ruas_jalan.id__mst_kondisi_jalan'kondisi'

				FROM 
					svy_kondisi_ruas_jalan 
				WHERE 
					id__mst_ruas_jalan='".$IdRuasJalan."' AND 
					timestamp = '".$Waktu."' AND 
					(
						(post <= ".$awal_km." AND offset >= ".$akhir_km." ) OR 
						(post >= ".$awal_km." AND post < ".$akhir_km." ) OR 
						(post <= ".$awal_km." AND (offset <= ".$akhir_km." AND offset >= ".$awal_km.") ) 
					)";

			$rs2 = $db->Execute($query);	
			
									
			//-----------------gambar daerah jalan-----------------------
			while($row2 = $db->FetchArray($rs2) ){
				$lajur=$row2['lajur'];
				$awal=(float)$row2['post'] * 1000 /1000;
				$akhir = (float)$row2['offset'] * 1000 /1000;
				$kondisi=$row2['kondisi'];
				

				
				if($awal <= $awal_km){
					$jeda = $awal_km - $awal;
					$px_jeda = $jeda * $per_px_panjang;
					$x1 = 0 - $px_jeda;
				}else{
					$jeda = $awal - $awal_km;
					$px_jeda = $jeda * $per_px_panjang;
					$x1 = $px_jeda;
				}
				
				if($akhir >= $akhir_km){
					$jeda = $akhir - $akhir_km;
					$px_jeda = $jeda * $per_px_panjang;
					$x2 = 900 + $px_jeda;
				}else{
					$jeda = (float)$akhir - $awal_km;
					$px_jeda = (float)$jeda * $per_px_panjang;
					$x2 = $px_jeda;
					
				}
				
		
				
				if($kondisi==""){	//------------buka if----------
						$rec = imagecolorallocate($im, 255, 255, 255);
				}else{
				
				$query="
						SELECT id AS id_kondisi 
						FROM mst_kondisi_jalan 
						WHERE id='".$kondisi."'
				";
				$rsKondisi = $db->Execute($query);
				if($db->RowCount($rs) == 0){
					$rec = imagecolorallocate($im, 255, 255, 255);
				}else{
					$rowKondisi = $db->FetchArray($rsKondisi);
					switch($rowKondisi['id_kondisi']){
						case KondisiConstant::Baik : $rec = imagecolorallocate($im, 0, 255, 255); break;
						case KondisiConstant::Sedang : $rec = imagecolorallocate($im, 0, 255, 64); break;
						case KondisiConstant::RusakRingan : $rec = imagecolorallocate($im, 255, 255, 0); break;						
						case KondisiConstant::RusakBerat : $rec = imagecolorallocate($im, 255, 0, 0); break;
						}
					}					
				}	//---------------------tutup if---------
				
				if($lajur==LajurConstant::KI1){ //"1KI"
					
					$y1 = 50;
					$y2 = 31;					
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
					
				}elseif($lajur==LajurConstant::KA1){//"1KA"
					
					$y1 = 51;
					$y2 = 70;
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
										
					
				}elseif($lajur==LajurConstant::KI2){//"2KI"
									
							
					$y1 = 30 ;
					$y2 = 11;
					
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
					
				
				}elseif($lajur==LajurConstant::KA2){//"2KA"
									
					$y1 = 71;
					$y2 = 90;
					
					
					imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);
					
									
				}						
					
			}//---------------------------------------------
			
			//------------gambar garis tengah----------------
			$line_tgh = imagecolorallocate($im, 10, 10, 10);
			imageline($im,0,50,$panjang_image,50,$line_tgh);
			//-----------------------------------------------
			
			//------------gambar garis batas tiap bidang----------
			$x1=0;
			$x2=900;
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,30,$x2,30,$rec);
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,70,$x2,70,$rec);
			
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,10,$x2,10,$rec);
			
			$rec = imagecolorallocate($im, 0, 0, 0);
					imagefilledrectangle($im,$x1,90,$x2,90,$rec);	
			
			//----------------------------------------------------
			
			//-------------gambar garis km--------------
			$x=0;		
			$flag=0;
			$tipis=0;
			
			$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
			$flag_print=10;
			$tambah_angka=0.1;
			
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 190, 190, 190);
				}
				imageline($im,$x,0,$x,200,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//--------------------------------------------
			
			
			
				
		} //tutup else

		imagepng($im);	
		imagedestroy($im);
		
	}
	
public static function gambar_meter_per_10km(DatabaseInterface $db, $IdRuasJalan, $Km_Ke, $lbl, $panjang_image){
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";	
		$rs  = $db->Execute($sql);

		$im = @imagecreatetruecolor($panjang_image+18, 30)
		 or die("Cannot Initialize new GD image stream"); //create new file image
			
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		$awal_km = ($Km_Ke-1) * 10; 
		$akhir_km = $Km_Ke * 10 ;
		
		if($db->RowCount($rs) == 0){
		}else{
			$row = $db->FetchArray($rs);
			$sk_length=10;
			$per_px_panjang=(0.1 / $sk_length) * $panjang_image;
			$flag_print=10;
			$tambah_angka=0.1;
			
			
			$line_color = imagecolorallocate($im, 0, 0, 0);
			
			$x=0;
			$y=0;
			$flag_angka=$awal_km;
			$flag=0;
			$tipis=0;
			
			while($flag<$panjang_image){				
				if($flag_angka==$awal_km){
					imagestring($im,2,1,12,$awal_km." Km",$line_color);
				}else{
					if($tipis==$flag_print){					
						imagestring($im,2,$x-3,12,$flag_angka,$line_color);
						$tipis=0;
					}else{
											
					}
				}
				$x = $x + $per_px_panjang;
				$flag=$x;			
				$flag_angka+=$tambah_angka;
				$tipis=$tipis+1;
			
			}
			imagestring($im,2,895,12,$akhir_km,$line_color);
			
		}
		imagepng($im);
		imagedestroy($im);
	}
	
 
 
#detail Perkerasan
public static function  gambar_meter_perkerasan_jalan_per_10km(DatabaseInterface $db, $IdRuasJalan, $Km_Ke, $lbl, $panjang_image){
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";	
		$rs  = $db->Execute($sql);

		$im = @imagecreatetruecolor($panjang_image+10, 30)
		 or die("Cannot Initialize new GD image stream"); //create new file image
			
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		$awal_km = ($Km_Ke-1) * 10; 
		$akhir_km = $Km_Ke * 10 ;
		
		if($db->RowCount($rs) == 0){
		}else{

			$row = $db->FetchArray($rs);
			$sk_length=10;
			$per_px_panjang=(0.1 / $sk_length) * $panjang_image;
			$flag_print=10;
			$tambah_angka=0.1;
				
			$line_color = imagecolorallocate($im, 0, 0, 0);
			
			$x=0;
			$y=0;
			$flag_angka=$awal_km;
			$flag=0;
			$tipis=0;
			
			while($flag<$panjang_image){				
				if($flag_angka==$awal_km){
					imagestring($im,2,1,12,$awal_km." Km",$line_color);
				}else{
					if($tipis==$flag_print){					
						imagestring($im,2,$x-3,12,$flag_angka,$line_color);
						$tipis=0;
					}else{
											
					}
				}
				$x = $x + $per_px_panjang;
				$flag=$x;			
				$flag_angka+=$tambah_angka;
				$tipis=$tipis+1;
			
			}
			imagestring($im,2,895,12,$akhir_km,$line_color);
			
		}
		imagepng($im);
		imagedestroy($im);
	}
public static function  gambar_kondisi_perkerasan_jalan_per_10km(DatabaseInterface $db, $IdRuasJalan, $Waktu,$Km_Ke , $Lajur, $lbl ,$panjang_image){
		
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";
		$rs  = $db->Execute($sql);
		
		$im = @imagecreatetruecolor($panjang_image, 260)
		 or die("Cannot Initialize new GD image stream"); //create new file image		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 

		$awal_km = ($Km_Ke-1) * 10;
		$akhir_km = $Km_Ke * 10;
	
		if($db->RowCount($rs) == 0){
		}else{
			$row = $db->FetchArray($rs);
			$sk_length=10;
			$per_px_panjang=$panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$Query="
				SELECT 
						svy_perkerasan_jalan.id__mst_ruas_jalan,
						svy_perkerasan_jalan.timestamp,
						svy_perkerasan_jalan.post,
						svy_perkerasan_jalan.offset,
						svy_perkerasan_jalan.id__mst_perkerasan'lyr_id',
						svy_perkerasan_jalan.id__mst_lajur,
						svy_perkerasan_jalan.lebar,
						svy_perkerasan_jalan.tahun


				FROM 
					svy_perkerasan_jalan 
				WHERE 
					id__mst_ruas_jalan='".$IdRuasJalan."' AND 
					timestamp = '".$Waktu."' AND 
					id__mst_lajur = '".$Lajur."' AND
					(
						(post <= ".$awal_km." AND offset >= ".$akhir_km." ) OR 
						(post >= ".$awal_km." AND post < ".$akhir_km." ) OR 
						(post <= ".$awal_km." AND (offset <= ".$akhir_km." AND offset >= ".$awal_km.") ) 
					)";
					
			$rs2 = $db->Execute($Query);
			$thn_skr =(integer) date("Y");	
			//-----------------gambar daerah jalan-----------------------
			while($row2 = $db->FetchArray($rs2)){
				$layer=$row2['lyr_id'];		
				$tahun=$row2['tahun'];
				$awal=(float)$row2['post'] *1000/1000;
				$akhir = (float)$row2['offset'] * 1000/1000;
				
				if($awal <= $awal_km){
					$jeda = $awal_km - $awal;
					$px_jeda = $jeda * $per_px_panjang;
					$x1 = 0 - $px_jeda;
				}else{
					$jeda = $awal - $awal_km;
					$px_jeda = $jeda * $per_px_panjang;
					$x1 = $px_jeda;
				}
				
				if($akhir >= $akhir_km){
					$jeda = $akhir - $akhir_km;
					$px_jeda = $jeda * $per_px_panjang;
					$x2 = 900 + $px_jeda;
				}else{
					$jeda = (float)$akhir - $awal_km;
					$px_jeda = (float)$jeda * $per_px_panjang;
					$x2 = $px_jeda;
					
				}
							
								
				if($tahun==$thn_skr){
					$rec = imagecolorallocate($im, 0, 255, 255);
				}elseif($tahun==$thn_skr-1){
					$rec = imagecolorallocate($im, 0, 255, 1);
				}elseif($tahun==$thn_skr-2){
					$rec = imagecolorallocate($im, 255, 255, 0);
				}elseif($tahun==$thn_skr-3){
					$rec = imagecolorallocate($im, 255, 127, 0);
				}elseif($tahun==$thn_skr-4){
					$rec = imagecolorallocate($im, 255, 0, 0);
				}else{
					$rec = imagecolorallocate($im, 255, 0, 254);
				}
							
				$query="SELECT id AS lyr_nama FROM mst_perkerasan WHERE id='".$layer."'";
				$rslayer = $db->Execute($query);
				$lyr = $db->FetchArray($rslayer);
				
				if($lyr['lyr_nama']== PerkerasanConstant::ACWC){
					
					$y1 = 11;
					$y2 = 30;										
				}elseif($lyr['lyr_nama']== PerkerasanConstant::HRSWC){
					
					$y1 = 31;
					$y2 = 50;										
				}elseif($lyr['lyr_nama']== PerkerasanConstant::ACBC){
									
							
					$y1 = 51;
					$y2 = 70;									
				
				}elseif($lyr['lyr_nama']== PerkerasanConstant::Concrate){
									
					$y1 = 71;
					$y2 = 90;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::ATB){
									
					$y1 = 91;
					$y2 = 110;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::LeanConcrate){
									
					$y1 = 111;
					$y2 = 130;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::CTB){
									
					$y1 = 131;
					$y2 = 150;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::AgregatKelasA){
									
					$y1 = 151;
					$y2 = 170;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::CTSB){
									
					$y1 = 171;
					$y2 = 190;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::AgregatKelasB){
									
					$y1 = 191;
					$y2 = 210;				
									
				}elseif($lyr['lyr_nama']== PerkerasanConstant::SelectedMaterials){
									
					$y1 = 211;
					$y2 = 230;				
									
				}elseif($lyr['lyr_nama']==PerkerasanConstant::SoilCements){
									
					$y1 = 231;
					$y2 = 250;				
									
				}
				
				imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);	
					
			
			
			
			}//---------------------------------------------
			
		
			
			//------------gambar garis batas tiap bidang----------
			$x1=0;
			$x2=900;
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,10,$x2,10,$rec);
			imagefilledrectangle($im,$x1,30,$x2,30,$rec);			
			imagefilledrectangle($im,$x1,50,$x2,50,$rec);
			imagefilledrectangle($im,$x1,70,$x2,70,$rec);
			imagefilledrectangle($im,$x1,90,$x2,90,$rec);
			imagefilledrectangle($im,$x1,110,$x2,110,$rec);			
			imagefilledrectangle($im,$x1,130,$x2,130,$rec);
			imagefilledrectangle($im,$x1,150,$x2,150,$rec);
			imagefilledrectangle($im,$x1,170,$x2,170,$rec);
			imagefilledrectangle($im,$x1,190,$x2,190,$rec);
			imagefilledrectangle($im,$x1,210,$x2,210,$rec);
			imagefilledrectangle($im,$x1,230,$x2,230,$rec);
			imagefilledrectangle($im,$x1,250,$x2,250,$rec);
			
			//----------------------------------------------------
			
			//-------------gambar garis km--------------
			
			$x=0;		
			$flag=0;
			$tipis=0;
			
			$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
			$flag_print=10;
			$tambah_angka=0.1;
		/*	
			if($sk_length>=10){
				$per_px_panjang2=$panjang_image / $sk_length;
				$flag_print=5;
				$tambah_angka=1;
			}elseif($sk_length>=5 && $sk_length<10){
				$per_px_panjang2=(0.5 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.5;
			}elseif($sk_length>=3 && $sk_length<5){
				$per_px_panjang2=(0.25 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.25;
			}elseif($sk_length<3){
				$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.1;
			}
			*/
			
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 190, 190, 190);
				}
				imageline($im,$x,10,$x,250,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//--------------------------------------------			
			

			
				
		} //tutup else

		imagepng($im);	
		imagedestroy($im);
		
	}	




#perbaikan perkerasan 1 tahun 2 X
public static function gambar_diagram_perkerasan_jalan_persemester(DatabaseInterface $db, $IdRuasJalan, $Waktu, $IdLajur,  $lbl, $panjang_image){
	
	
		
		$sql = "SELECT abs(panjang) AS Panjang FROM mst_ruas_jalan WHERE id ='".$IdRuasJalan."'";			
	
		$rs  = $db->Execute($sql);
		
		$im = @imagecreatetruecolor($panjang_image, 260)
		 or die("Cannot Initialize new GD image stream"); //create new file image
		 
		
		// sets background to white
		$background = imagecolorallocate($im, 255, 255, 255);
		imagefill($im,0,0,$background); 
		
		
		if($db->RowCount($rs) == 0){
		}else{
			
			$row = $db->FetchArray($rs);
			$sk_length=$row['Panjang'];
			$per_px_panjang=$panjang_image / $sk_length;
			$per_px_lebar = 10;
			
			$query="
					SELECT 
							svy_perkerasan_jalan.timestamp,
							svy_perkerasan_jalan.post,
							svy_perkerasan_jalan.offset,
							svy_perkerasan_jalan.id__mst_perkerasan AS lyr_id,
							svy_perkerasan_jalan.lebar AS lebar,
							svy_perkerasan_jalan.tahun AS tahun

					FROM 
						svy_perkerasan_jalan As svy_perkerasan_jalan,  mst_ruas_jalan As mst_jalan
					WHERE
						svy_perkerasan_jalan.id__mst_ruas_jalan =  mst_jalan.id AND
						id__mst_ruas_jalan ='".$IdRuasJalan."'  AND
						id__mst_lajur = '".$IdLajur."' AND
						timestamp = '".$Waktu."'";//timestamp LIKE '".$Waktu."%'"
			$rs2 = $db->Execute($query);										
			$thn_skr =(integer) date("Y");
			//-----------------gambar daerah jalan-----------------------
			while($row2 = $db->FetchArray($rs2)){				
				$layer=$row2['lyr_id'];		
				$tahun=$row2['tahun'];
/*
				$awal=(float)$row2['post'] + $row2['offsetfr']/1000;
				$akhir = (float)$row2['kmpostto'] + $row2['offsetto']/1000;
				
*/				

				$awal=(float)$row2['post'] * 1000 /1000;
				$akhir = (float)$row2['offset'] *1000 /1000;

				$x1 = $awal * $per_px_panjang;
				$x2 = $akhir * $per_px_panjang;
				
				
				if($tahun=='I-'.$thn_skr){//semester I =>Jan-juni
					$rec = imagecolorallocate($im, 0, 255, 255);
				}elseif($tahun=='II-'.$thn_skr){//semester II => juli-Des
					$rec = imagecolorallocate($im, 0, 250, 255);
				}elseif($tahun=='I-'.$thn_skr-1){
					$rec = imagecolorallocate($im, 0, 255, 1);
				}elseif($tahun=='II-'.$thn_skr-1){
					$rec = imagecolorallocate($im, 0, 250, 1);
				}elseif($tahun=='I-'.$thn_skr-2){
					$rec = imagecolorallocate($im, 255, 255, 0);
				}elseif($tahun=='II-'.$thn_skr-2){
					$rec = imagecolorallocate($im, 255, 250, 0);
				}elseif($tahun=='I-'.$thn_skr-3){
					$rec = imagecolorallocate($im, 255, 127, 0);
				}elseif($tahun=='II-'.$thn_skr-3){
					$rec = imagecolorallocate($im, 250, 127, 0);
				}elseif($tahun=='I-'.$thn_skr-4){
					$rec = imagecolorallocate($im, 255, 0, 0);
				}elseif($tahun=='II-'.$thn_skr-4){
					$rec = imagecolorallocate($im, 250, 0, 0);
				}else{
					$rec = imagecolorallocate($im, 255, 0, 254);
				}
							
				$query="SELECT nama AS lyr_nama FROM mst_perkerasan WHERE id='".$layer."'";
				$rslayer = $db->Execute($query);
				$lyr = $db->FetchArray($rslayer);
				
				if($lyr['lyr_nama']=="AC-WC"){
					
					$y1 = 11;
					$y2 = 30;										
				}elseif($lyr['lyr_nama']=="HRS-WC"){
					
					$y1 = 31;
					$y2 = 50;										
				}elseif($lyr['lyr_nama']=="AC-BC"){
									
							
					$y1 = 51;
					$y2 = 70;									
				
				}elseif($lyr['lyr_nama']=="Concrate"){
									
					$y1 = 71;
					$y2 = 90;				
									
				}elseif($lyr['lyr_nama']=="ATB"){
									
					$y1 = 91;
					$y2 = 110;				
									
				}elseif($lyr['lyr_nama']=="Lean Concrate"){
									
					$y1 = 111;
					$y2 = 130;				
									
				}elseif($lyr['lyr_nama']=="CTB"){
									
					$y1 = 131;
					$y2 = 150;				
									
				}elseif($lyr['lyr_nama']=="Agregat Kelas A"){
									
					$y1 = 151;
					$y2 = 170;				
									
				}elseif($lyr['lyr_nama']=="CTSB"){
									
					$y1 = 171;
					$y2 = 190;				
									
				}elseif($lyr['lyr_nama']=="Agregat Kelas B"){
									
					$y1 = 191;
					$y2 = 210;				
									
				}elseif($lyr['lyr_nama']=="Selected Materials"){
									
					$y1 = 211;
					$y2 = 230;				
									
				}elseif($lyr['lyr_nama']=="Soil Cements"){
									
					$y1 = 231;
					$y2 = 250;				
									
				}
				
				imagefilledrectangle($im,$x1,$y1,$x2,$y2,$rec);	
					
			}//---------------------------------------------
			
			#------------gambar garis tengah----------------
			#$line_tgh = imagecolorallocate($im, 10, 10, 10);
			#imageline($im,0,130,$panjang_image,130,$line_tgh);
			#-----------------------------------------------
			
			//------------gambar garis batas  horizontal tiap bidang DAN PENAMAAN----------
			$x1=0;
			$x2=900;
			$rec = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im,$x1,10,$x2,10,$rec);
			imagefilledrectangle($im,$x1,30,$x2,30,$rec);			
			imagefilledrectangle($im,$x1,50,$x2,50,$rec);
			imagefilledrectangle($im,$x1,70,$x2,70,$rec);
			imagefilledrectangle($im,$x1,90,$x2,90,$rec);
			imagefilledrectangle($im,$x1,110,$x2,110,$rec);			
			imagefilledrectangle($im,$x1,130,$x2,130,$rec);
			imagefilledrectangle($im,$x1,150,$x2,150,$rec);
			imagefilledrectangle($im,$x1,170,$x2,170,$rec);
			imagefilledrectangle($im,$x1,190,$x2,190,$rec);
			imagefilledrectangle($im,$x1,210,$x2,210,$rec);
			imagefilledrectangle($im,$x1,230,$x2,230,$rec);
			imagefilledrectangle($im,$x1,250,$x2,250,$rec);
			
			//----------------------------------------------------
			
			//-------------gambar garis km--------------
			$x=0;		
			$flag=0;
			$tipis=0;
			
			if($sk_length>=10){
				$per_px_panjang2=$panjang_image / $sk_length;
				$flag_print=5;
				$tambah_angka=1;
			}elseif($sk_length>=5 && $sk_length<10){
				$per_px_panjang2=(0.5 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.5;
			}elseif($sk_length>=3 && $sk_length<5){
				$per_px_panjang2=(0.25 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.25;
			}elseif($sk_length<3){
				$per_px_panjang2=(0.1 / $sk_length) * $panjang_image;
				$flag_print=2;
				$tambah_angka=0.1;
			}
			
			while($flag<$panjang_image){
				if($tipis==$flag_print){
					$line_color = imagecolorallocate($im, 0, 0, 0);
					$tipis=0;
				}else{
					$line_color = imagecolorallocate($im, 190, 190, 190);
				}
				imageline($im,$x,0,$x,260,$line_color);
				$x = $x + $per_px_panjang2;
				$flag=$x;
				
				$tipis=$tipis+1;
			
			}
			//--------------------------------------------
			
			
			
				
		} //tutup else

		imagepng($im);	
		imagedestroy($im);
	
	
	
	
 }	
	
	
}

?>