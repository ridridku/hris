<?
require_once FW_DIR . '/constant/ComboBox.cst.php';

class DetailMasterRuasJalanContent extends ContentInterface{
 
  public function DetailMasterRuasJalanContent(){
	ContentInterface::ContentInterface();
  }
  private function GetDataDetailRusaJalan($db, $Kode){  
	  $sql ="
				SELECT SQL_CALC_FOUND_ROWS mst_ruas_jalan.id, 
						mst_ruas_jalan.ruas,
						mst_ruas_jalan.sffx , 
						mst_ruas_jalan.kota , 
						mst_ruas_jalan.nama_ruas , 
						mst_ruas_jalan.lokasi , 
						CONCAT(mst_ruas_jalan.kp_from, ' - ', mst_ruas_jalan.kp_to)'kilometer' , 
						mst_ruas_jalan.panjang , 
						mst_ruas_jalan.panjang_kepmen , 
						mst_ruas_jalan.lebar , 
						mst_ruas_jalan.aadt , 
						mst_ruas_jalan.awal_ruas , 
						mst_ruas_jalan.akhir_ruas , 
						mst_ruas_jalan.mst , 
						( 
							SELECT 
								mst_propinsi.nama 
							FROM 
								mst_propinsi 
							WHERE 
								mst_ruas_jalan.id__mst_propinsi = mst_propinsi.id )'propinsi' , 
						( 
							SELECT 
								mst_status_jalan.nama 
							FROM 
								mst_status_jalan 
							WHERE 
								mst_ruas_jalan.id__mst_status_jalan = mst_status_jalan.id ) 'status', 
						( 
							SELECT 
								mst_fungsi.nama 
							FROM 
								mst_fungsi 
							WHERE 
								mst_ruas_jalan.id__mst_fungsi = mst_fungsi.id ) 'fungsi', 
						( 
							SELECT 
								mst_lintas.nama 
							FROM 
								mst_lintas 
							WHERE 
								mst_ruas_jalan.id__mst_lintas = mst_lintas.id ) 'lintas',
						( 
							SELECT 
								mst_tipe_jalan.nama 
							FROM 
								mst_tipe_jalan 
							WHERE 
								mst_ruas_jalan.id__mst_tipe_jalan = mst_tipe_jalan.id ) 'type', 
						mst_ruas_jalan.pos_start_bt , 
						mst_ruas_jalan.pos_start_ls , 
						mst_ruas_jalan.pos_start_h , 
						mst_ruas_jalan.pos_end_bt , 
						mst_ruas_jalan.pos_end_ls , 
						mst_ruas_jalan.pos_end_h , 
						mst_ruas_jalan.keterangan 
				 FROM 
				 		mst_ruas_jalan 
				WHERE mst_ruas_jalan.id = '". $Kode ."' AND ((True) )";
#	  echo $sql;
	  $resUraian = $db->Execute($sql);
	  return $resUraian->GetRows();
  }
  public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();	
		$adodb = $db->MakeAdoDb();
		$DetailRusaJalan = $this->GetDataDetailRusaJalan($adodb, $p->Kode);	
		
		$g = $p->MakeGuiFactory();
		$f= $g->MakeForm();
		
		$r = $g->MakeSubTitle();
		$r->TextToDisplay = 'DATA DETAIL RUAS JALAN';
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$f->AddRowElement($r);
				
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'ID Ruas Jalan ';
		$r->Value = $DetailRusaJalan[0]['id'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Ruas';
		$r->Value = $DetailRusaJalan[0]['ruas'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'SFFX';
		$r->Value = $DetailRusaJalan[0]['id'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Kota';
		$r->Value = $DetailRusaJalan[0]['kota'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Nama Ruas';
		$r->Value = $DetailRusaJalan[0]['nama_ruas'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Lokasi';
		$r->Value = $DetailRusaJalan[0]['lokasi'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Kilometer';
		$r->Value = $DetailRusaJalan[0]['kilometer'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Panjang';
		$r->Value = $DetailRusaJalan[0]['panjang'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Panjang Max	';
		$r->Value = $DetailRusaJalan[0]['panjang_kepmen'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Lebar';
		$r->Value = $DetailRusaJalan[0]['lebar'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'AADT';
		$r->Value = $DetailRusaJalan[0]['aadt'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Awal Ruas';
		$r->Value = $DetailRusaJalan[0]['awal_ruas'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir Ruas	';
		$r->Value = $DetailRusaJalan[0]['akhir_ruas'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'MST';
		$r->Value = $DetailRusaJalan[0]['mst'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Propinsi';
		$r->Value = $DetailRusaJalan[0]['propinsi'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Status';
		$r->Value = $DetailRusaJalan[0]['status'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Fungsi';
		$r->Value = $DetailRusaJalan[0]['fungsi'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Lintas';
		$r->Value = $DetailRusaJalan[0]['lintas'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Type';
		$r->Value = $DetailRusaJalan[0]['type'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Start BT';
		$r->Value = $DetailRusaJalan[0]['pos_start_bt'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Start LS';
		$r->Value = $DetailRusaJalan[0]['pos_start_ls'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Start H';
		$r->Value = $DetailRusaJalan[0]['pos_start_h'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir BT';
		$r->Value = $DetailRusaJalan[0]['pos_end_bt'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir LS';
		$r->Value = $DetailRusaJalan[0]['pos_end_ls'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir H';
		$r->Value = $DetailRusaJalan[0]['pos_end_h'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Keterangan';
		$r->Value = $DetailRusaJalan[0]['keterangan'];		
		$f->AddRowElement($r);
	
		$f->Display($p, $v);
	}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}





/*require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterRuasJalan.cnt.php';

class DetailMasterRuasJalanContent extends MasterRuasJalanContent{
	public function DetailMasterRuasJalanContent(){
		MasterRuasJalanContent::MasterRuasJalanContent();
	}
	public function Conditions(){
		$p = $this->Parent();
		return array(
			array(
				'CONDITION' => "mst_ruas_jalan.id = '". $p->Kode ."'",
				'OPERATOR' => NULL
			)
		);
  	}		  
}*/
?>