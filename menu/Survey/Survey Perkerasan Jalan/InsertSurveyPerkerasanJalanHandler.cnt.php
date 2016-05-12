<?
/**
 * @package Content
 */
class InsertSurveyPerkerasanJalanHandlerContent extends ContentInterface
{
  public function InsertSurveyPerkerasanJalanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$CekQuery = $Conn->Execute("
			SELECT * FROM `svy_perkerasan_jalan`
			WHERE
				`id__mst_ruas_jalan` = '" . $Par->SearchIDRuas ."'  AND
				`timestamp` = '". $Par->SearchTimeStamp ."' AND
				`post` = '" . $_POST['post'] ."'  AND
				`offset` = '" . $_POST['offset'] ."'  AND
				`id__mst_lajur` = '" . $_POST['id__mst_lajur'] ."'	 AND
				`id__mst_perkerasan` = '" . $_POST['id__mst_perkerasan'] ."'
							
		");		
		if ($Conn->RowCount($CekQuery) == 0) {
			$Conn->Execute("
				INSERT INTO `svy_perkerasan_jalan` (
					`id__mst_ruas_jalan`,
					`timestamp`,
					`post`,
					`offset`,
					`id__mst_lajur`,
					`lebar`,
					`id__mst_perkerasan`,
					`tahun`
				) VALUES (
					'" . $Par->SearchIDRuas ."',
					'" . $Par->SearchTimeStamp ."',
					'" . $_POST['post'] ."',
					'" . $_POST['offset'] ."',
					'" . $_POST['id__mst_lajur'] ."',
					NULLIF('" . $_POST['lebar'] ."', ''),
					NULLIF('" . $_POST['id__mst_perkerasan'] ."', ''),
					NULLIF('" . $_POST['tahun'] ."', '')
				)						 
			");
		}
		$Conn->Execute("COMMIT;");
		
		$Par->Next->OnSetKey(
			array(
				'id__mst_ruas_jalan'=>$Par->SearchIDRuas,
				'timestamp'=>$Par->SearchTimeStamp,
				'post'=>$_POST['post'],
				'offset'=>$_POST['offset'],
				'id__mst_lajur'=>$_POST['id__mst_lajur'],
				'id__mst_perkerasan'=>$_POST['id__mst_perkerasan']
			)
		);
		$Par->Next->Process($v);
	}
  public function Path(){return __FILE__;}
}
?>