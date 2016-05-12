<?php

class DeletePelaksanaKegiatanContent extends ContentInterface
{
  public function DeletePelaksanaKegiatanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    $p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
    $db->Execute("
		DELETE FROM mst_pelaksana_kegiatan
		WHERE
			id__mst_satker = '" . $p->IdSatker ."' AND
			id__mst_tahun_anggaran = '" . $p->IdTahun ."'
	");
  	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>