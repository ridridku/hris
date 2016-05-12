<?
/**
 * @package Content
 */
class DeleteMasterKabupatenHandlerContent extends ContentInterface
{
  public function DeleteMasterKabupatenHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$sql = "
			DELETE FROM mst_kabupaten_or_kodya
			WHERE
				id = '". $Par->IdKabupaten ."' 
		";
		$Conn->Execute($sql);
		$Conn->Execute("COMMIT;");
		$Par->Next->Process($v);
	}
  public function Path(){return __FILE__;}
}
?>