<?
/**
 * @package Content
 */
class BangunanBawahJembatanHandlerContent extends ContentInterface
{
  public function BangunanBawahJembatanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();	
		$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$DataCek = CommonQuery::ReadTableWithMultipleRecordOutput($db, 'mst_bridge_bangunan_bawah', array('id_mst_bridge'), array($p->IdJembatan));		
		if (is_null($DataCek)){		  
			$SQL = "INSERT INTO mst_bridge_bangunan_bawah (id_mst_bridge,peil_pondasi,jenis_pondasi,diameter,panjang,lebar) 
					VALUES ('".$p->IdJembatan."',
							NULLIF('".$_POST['peil_pondasi']."',''),
							NULLIF('".$_POST['jenis_pondasi']."',''),
							NULLIF('".$_POST['diameter']."',''),
							NULLIF('".$_POST['panjang']."',''),
							NULLIF('".$_POST['lebar']."','')
			)";		
		}else{
			$SQL = "UPDATE mst_bridge_bangunan_bawah SET 
							peil_pondasi=NULLIF('".$_POST['peil_pondasi']."',''),
							jenis_pondasi= NULLIF('".$_POST['jenis_pondasi']."',''),
							diameter=NULLIF('".$_POST['diameter']."',''),
							panjang=NULLIF('".$_POST['panjang']."',''),
							lebar=NULLIF('".$_POST['lebar']."','')
					WHERE 
							(id_mst_bridge='".$p->IdJembatan."')  ";				
		}		
		$db->Execute($SQL);
		$db->Execute("COMMIT;");
		$p->Next->IdJembatan = $p->IdJembatan;	
		$p->Next->Process($v);
	}
  public function Path(){return __FILE__;}
}
?>