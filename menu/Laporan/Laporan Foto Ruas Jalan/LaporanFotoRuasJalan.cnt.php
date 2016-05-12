<? 
require_once 'Zend/Json/Encoder.php';

class LaporanFotoRuasJalanContent extends ContentInterface{
  public function LaporanFotoRuasJalanContent(){ContentInterface::ContentInterface();}
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
  	$db = $this->Parent()->MakeDatabase();
	$this->dbs = $db->MakeAdoDb();
	
	$rsl= $db->Execute("
		SELECT
			*
		FROM
			svy_drp_ruas_jalan_image
		WHERE
			(id__mst_ruas_jalan = '".$p->IdRuasJalan."') AND
			(time_stamp = '".$p->Time."') AND
			(post = '".$p->Post."') AND
			(offset = '".$p->OffSet."') 
		
	");
	$rec_jum  = $db->RowCount($rsl);
	ContentInterface::Assign('rec_jum', $rec_jum);	
	
	for($i=1;$i<=$rec_jum;$i++){
		$Photo = new DownloadToViewImageHandlerMenu();
		$Photo->IdRuasJalan = $p->IdRuasJalan; 
		$photo->Time = $p->Time;
		$Photo->UnixTime = $p->UnixTime;
		$Photo->Post = $p->Post;
		$Photo->OffSet = $p->OffSet;
		$Photo->IdImg = $i;
		ContentInterface::Assign('PhotoImage'.$i, $Photo->Ref());	
	}
	
	
	$m = new GridDataFotoRuasJalanMenu();
	$m->IdPropinsi = $p->IdPropinsi;
	$m->IdRuasJalan = $p->IdRuasJalan;
	$m->Time = $p->Time;
	$m->Post = $p->Post;
	$m->OffSet = $p->OffSet;
	
	ContentInterface::Assign('Selesai', $m->Ref());	
	ContentInterface::Show($v);
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
 
  
}
?>