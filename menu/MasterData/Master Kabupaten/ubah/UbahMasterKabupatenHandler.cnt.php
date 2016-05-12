<?
/**
 * @package Content
 */
class UbahMasterKabupatenHandlerContent extends ContentInterface
{
  public function UbahMasterKabupatenHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();

	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$sql = "
		UPDATE mst_kabupaten_or_kodya SET 
				name = NULLIF('".$_POST['name']."',''),
				id_mst_propinsi = NULLIF('".$_POST['id_mst_propinsi']."','')
		WHERE 
			(id='".$p->IdKabupaten."')  
	";
	$db->Execute($sql);

	$db->Execute("COMMIT;");
	$p->Next->OnSetKey(
			array('id' => $p->IdKabupaten)
		);
	$p->Next->IdKabupaten = $p->IdKabupaten;
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>