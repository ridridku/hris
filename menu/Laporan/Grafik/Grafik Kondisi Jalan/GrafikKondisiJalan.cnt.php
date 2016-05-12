<? 
/**
 * @package Content
 */
 require_once 'menu/Graph Code Generator/MakeGraphGenerator.mnu.php';
 require_once 'constant/Kondisi.cst.php';
 require_once 'constant/Lajur.cst.php';
class GrafikKondisiJalanContent extends ContentInterface
{
  public function GrafikKondisiJalanContent(){
	ContentInterface::ContentInterface();
  }
 
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$this->dbs = $db->MakeAdoDb();
	
	$rs = $db->Execute("
		SELECT 
			panjang AS panjang
		FROM 
			mst_ruas_jalan
		WHERE
			id = '".$p->IdRuasJalan."'
		
	");
	$Field = $db->FetchArray($rs);
	ContentInterface::Assign('jumlah',ceil(($Field['panjang'] + 1)/10));

	$m  = new GrafikKondisiJalanHandlerMenu();
	$m->IdPropinsi = $p->IdPropinsi;
	$m->IdRuasJalan = $p->IdRuasJalan;
	$m->Waktu =  $p->Waktu;
	$m->Next = clone($p);
	
	
	ContentInterface::Assign('Action',$m->Ref());
	if($p->Km_Ke == NULL)	$p->Km_Ke =1;	
	$Ket = 2;
	$GraphKeterangan = new MakeGraphKeteranganGeneratorMenu($p->IdRuasJalan, $p->Waktu, $Ket );
	ContentInterface::Assign('ImgGraphKeterangan', $GraphKeterangan->Ref());

	
	$GraphJalan = new MakeGraphKondisiRuasJalanGeneratorMenu($p->IdRuasJalan, $p->Waktu);
	ContentInterface::Assign('ImgGraphJalan', $GraphJalan->Ref());
	
	
	$GraphKmPer10 = new MakeGraphKmKe10GeneratorMenu($p->IdRuasJalan, $p->Km_Ke);
	ContentInterface::Assign('ImgGraphKmPer10', $GraphKmPer10->Ref());

	$GraphJalanKe = new MakeGraphKondisiRuasJalanKmKeGeneratorMenu($p->IdRuasJalan, $p->Waktu, $p->Km_Ke);
	ContentInterface::Assign('ImgGraphJalanKe', $GraphJalanKe->Ref());
	
	ContentInterface::Assign('Km_Ke',$p->Km_Ke);
	
	
	
	ContentInterface::Assign("Cetak",$p->Cetak);
	ContentInterface::Assign("Data",$this->DataPenjelasan($db, $p->IdRuasJalan, $p->Waktu ));    
	
	
	#jumlah % kondisi jalan
	$DataAwal = self::JumlahKondisiPersen($db, $p->IdRuasJalan, $p->Waktu);

	ContentInterface::Assign('DataAwal', $DataAwal);
	ContentInterface::Show($v);
	ContentInterface::Display();	
  }
  
  public function Path(){return __FILE__;} 
  private function DataPenjelasan(DatabaseInterface $db, $IdRuasJalan, $Waktu){
  	$sql = "
		SELECT 
				CONCAT(mst_ruas_jalan.id,' / ',mst_ruas_jalan.nama_ruas)'NamaRuas',
				(  SELECT 
						nama
					FROM
						mst_propinsi
					WHERE
					mst_ruas_jalan.id__mst_propinsi = mst_propinsi.id
				)'Propinsi',
				
				DT_IndonesiaDateTime(svy_kondisi_ruas_jalan.timestamp)'Waktu'
		FROM 
				svy_kondisi_ruas_jalan,
				mst_ruas_jalan
		WHERE 
			svy_kondisi_ruas_jalan.id__mst_ruas_jalan = mst_ruas_jalan.id AND
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."' 
			
		GROUP BY mst_ruas_jalan.id";
	$rsl = $db->Execute($sql);
	return $Field = $db->FetchArray($rsl);
  }
  
  private function JumlahKondisiPersen($db, $IdRuasJalan, $Waktu){
  	$Baik2KI=0;
	$Baik1KI=0;
	$Baik1KA=0;
	$Baik2KA=0;
	$baiktotal=0;
	$baikpersen=0;
	
	$sedang2KI=0;
	$sedang1KI=0;
	$sedang1KA=0;
	$sedang2KA=0;
	$sedangtotal=0;
	$sedangpersen=0;
	
	$RskRingan2KI=0;
	$RskRingan1KI=0;
	$RskRingan1KA=0;
	$RskRingan2KA=0;
	$rrtotal=0;
	$rrpersen=0;
	
	$RskBerat2KI=0;
	$RskBerat1KI=0;
	$RskBerat1KA=0;
	$RskBerat2KA=0;
	$rbtotal=0;
	$rbpersen=0;
	
	$query="
			SELECT 
				svy_kondisi_ruas_jalan.id__mst_ruas_jalan,
				svy_kondisi_ruas_jalan.timestamp,
				svy_kondisi_ruas_jalan.post AS post,
				svy_kondisi_ruas_jalan.offset AS offset,
				svy_kondisi_ruas_jalan.id__mst_lajur AS lajur,
				svy_kondisi_ruas_jalan.id__mst_kondisi_jalan AS kondisi
			FROM 
				svy_kondisi_ruas_jalan 
			WHERE 
				id__mst_ruas_jalan='".$IdRuasJalan."' AND 
				timestamp like '".$Waktu."%'"; 
	$rs  = $db->Execute($query);
		while($row2= $db->FetchArray($rs)){
			$awal=  (float)$row2['post'] *1000/1000;
			$akhir = (float)$row2['offset'] * 1000/1000;		
			$panjang = $akhir-$awal;
			$kondisi=$row2['kondisi'];
			$lajur=$row2['lajur'];
			if($kondisi== KondisiConstant::Baik){
				if($lajur== LajurConstant::KI2) $Baik2KI+= $panjang;
				elseif ($lajur== LajurConstant::KI1) $Baik1KI+=$panjang;
				elseif ($lajur== LajurConstant::KA1) $Baik1KA+=$panjang;
				elseif ($lajur== LajurConstant::KA2) $Baik2KA+=$panjang;
			}elseif($kondisi== KondisiConstant::Sedang){
				if($lajur== LajurConstant::KI2) $sedang2KI+= $panjang;
				elseif ($lajur== LajurConstant::KI1) $sedang1KI+=$panjang;
				elseif ($lajur== LajurConstant::KA1) $sedang1KA+=$panjang;
				elseif ($lajur== LajurConstant::KA2) $sedang2KA+=$panjang;
			}elseif($kondisi== KondisiConstant::RusakRingan){			
				if($lajur== LajurConstant::KI2) $RskRingan2KI+= $panjang;
				elseif ($lajur== LajurConstant::KI1) $RskRingan1KI+=$panjang;
				elseif ($lajur== LajurConstant::KA1) $RskRingan1KA+=$panjang;
				elseif ($lajur== LajurConstant::KA2) $RskRingan2KA+=$panjang;
			}elseif($kondisi== KondisiConstant::RusakBerat){	
				if($lajur== LajurConstant::KI2) $RskBerat2KI+= $panjang;
				elseif ($lajur== LajurConstant::KI1) $RskBerat1KI+=$panjang;
				elseif ($lajur== LajurConstant::KA1) $RskBerat1KA+=$panjang;
				elseif ($lajur== LajurConstant::KA2) $RskBerat2KA+=$panjang;
			}
		}
		
		$baiktotal=$Baik2KI+$Baik1KI+$Baik1KA+$Baik2KA;
		$sedangtotal=$sedang1KI+$sedang2KI+$sedang1KA+$sedang2KA;
		$rrtotal=$RskRingan1KI+$RskRingan2KI+$RskRingan1KA+$RskRingan2KA;
		$rbtotal=$RskBerat1KI+$RskBerat2KI+$RskBerat1KA+$RskBerat2KA;
		$semua = $baiktotal + $sedangtotal + $rrtotal+ $rbtotal;
		
		if($semua!=0){
			$baikpersen = number_format(($baiktotal / $semua * 100),1,',','.');
			$sedangpersen = number_format(($sedangtotal / $semua * 100),1,',','.');
			$rrpersen = number_format(($rrtotal/$semua * 100),1,',','.');
			$rbpersen = number_format(($rbtotal/$semua * 100),1,',','.');
		}else{
			$baikpersen = 0;
			$sedangpersen = 0;
			$rrpersen = 0;
			$rbpersen = 0;
		}
	$dataAwal = array(
		$Baik1KI, # 0
		$Baik2KI, # 1
		$Baik1KA, # 2
		$Baik2KA, # 3
		
		$sedang1KI, # 4
		$sedang2KI, # 5
		$sedang1KA, # 6
		$sedang2KA, # 7
		
		$RskRingan1KI, # 8
		$RskRingan2KI, # 9
		$RskRingan2KA, # 10
		$RskRingan1KA, # 11
		
		$RskBerat1KI, # 12
		$RskBerat2KI, # 13
		$RskBerat2KA, # 14
		$RskBerat1KA, # 15		 
		
		$baiktotal, # 16
		$sedangtotal, # 17
		$rrtotal, # 18
		$rbtotal, # 19
		
		$baikpersen, # 20
		$sedangpersen, # 21
		$rrpersen,  # 22
		$rbpersen  # 23
		);
	return $dataAwal;
  
  }
  
}
?>