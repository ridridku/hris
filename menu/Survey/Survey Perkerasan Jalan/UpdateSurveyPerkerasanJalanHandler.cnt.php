<?
/**
 * @package Content
 */
class UpdateSurveyPerkerasanJalanHandlerContent extends ContentInterface
{
  public function UpdateSurveyPerkerasanJalanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$sql = "
		UPDATE `svy_perkerasan_jalan` SET 
				`post`='". $_POST['post'] ."',
				`offset`='". $_POST['offset'] ."',
				`id__mst_perkerasan`='". $_POST['id__mst_perkerasan'] ."',
				`id__mst_lajur`='". $_POST['id__mst_lajur'] ."',
				`lebar`='". $_POST['lebar'] ."',
				`tahun`='". $_POST['tahun'] ."'
		WHERE 
				(`id__mst_ruas_jalan`='". $p->IdRuasJalan ."' ) AND 
				(`timestamp`='". $p->TimeStamp ."') AND 
				(`post`='". $p->Post ."') AND 
				(`offset`='". $p->Offset ."') AND 
				(`id__mst_perkerasan`='".$p->IdPerkerasan ."') AND 
				(`id__mst_lajur`='".$p->IdLajur ."') 
		
		";
		$db->Execute($sql);
		$db->Execute("COMMIT;");
		$p->Next->IdRuasJalan = $p->IdRuasJalan;
		$p->Next->TimeStamp = $p->TimeStamp;
		$p->Next->Post = $_POST['post'];
		$p->Next->Offset = $_POST['offset'];
		$p->Next->IdLajur = $_POST['id__mst_lajur'];
		$p->Next->IdPerkerasan = $_POST['id__mst_perkerasan'];	
		
		$p->Next->OnSetKey(
			array(
				'id__mst_ruas_jalan' => $p->IdRuasJalan,
				'timestamp' => $p->TimeStamp,
				'post' => $_POST['Post'],
				'offset' => $_POST['Offset'],
				'id__mst_lajur' =>$_POST['id__mst_lajur'],
				'id__mst_perkerasan' =>$_POST['id__mst_perkerasan'],
				 
			)
		);	
			
		$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>