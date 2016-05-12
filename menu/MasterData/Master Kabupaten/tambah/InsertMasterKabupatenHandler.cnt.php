<?
/**
 * @package Content
 */
class InsertMasterKabupatenHandlerContent extends ContentInterface
{
  public function InsertMasterKabupatenHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$m = $p->MakeApplication()->GetRequest('id_group');
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$RecordId = CommonQuery::GetId($db, 'mst_kabupaten_or_kodya', 'id');
	$sql = " INSERT INTO mst_kabupaten_or_kodya
				(id,
				 name,
				 id_mst_propinsi) 
			 VALUES (
			 	'".$RecordId."',
				NULLIF('".$_POST['name']."',''),
				NULLIF('".$_POST['id_mst_propinsi']."','')
			 )
	
	";
	$db->Execute($sql);		
	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>