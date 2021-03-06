<?
/**
 * @package Content
 */
class DownloadToViewMovieHandlerContent extends ContentInterface
{
  public function DownloadToViewMovieHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->Makedatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$Query = "
	  SELECT
	  	file_type,
		file_size,
		file_name
	  FROM svy_drp_ruas_jalan_movie
	  WHERE 
		 id__mst_ruas_jalan = '". $p->IdRuasJalan ."' AND
		 time_stamp = '".$p->Time."' AND
		 post = '".$p->Post."' AND
		 offset = '".$p->OffSet."' AND
		 mov_id =  '".$p->IdMovie."'
	";
	$rsl = $db->Execute($Query);
	$R = $db->FetchObject($rsl);
	
	header("Content-type: ". $R->file_type ."");
	header("Content-Disposition: attachment; filename=". str_replace( ' ', '%20', $R->file_name) ."" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
	$filename = UPLOAD_DIR . 'movie/' .$p->IdRuasJalan.'-'. $p->UnixTime.'-'. $p->Post.'-'. $p->OffSet.'-'.$p->IdMovie;
	if(file_exists($filename)){
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		echo $contents;
	}
	  
	$db->Execute("COMMIT;");
	ContentInterface::Show($v);  
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>