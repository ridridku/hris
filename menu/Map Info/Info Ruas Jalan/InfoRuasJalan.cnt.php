<?
require_once 'Zend/Json/Encoder.php';

class InfoRuasJalanContent extends ContentInterface{
  public function InfoRuasJalanContent(){ContentInterface::ContentInterface();}
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();

	$sql = $db->Execute("
		SELECT
			msc_information_object.name 'Nama',
			msc_information_object.value 'Value'
		FROM 
			msc_information_object
		WHERE 
			id_object = '". $p->IdObject ."'
		ORDER by order_to_bottom
		");
	$Values = $db->RowCount($sql);
	for($c=0; $c<$Values; $c++){
		$ValuesField = $db->FetchObject($sql);
		$Nomor[$c] = $c + 1;
		$Nama[$c] = $ValuesField->Nama;
		$Value[$c] = $ValuesField->Value;
	}
	ContentInterface::Assign('Nomor', $Nomor);
  	ContentInterface::Assign('Name', $Nama);
  	ContentInterface::Assign('Value', $Value);
  	ContentInterface::Assign('YuiRelatifPath', YUI_RELATIF_PATH);
  	ContentInterface::Assign('width', $p->Rect['width'] - 15);
  	ContentInterface::Assign('height', $p->Rect['height']);
	ContentInterface::Show($v);
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
}
?>