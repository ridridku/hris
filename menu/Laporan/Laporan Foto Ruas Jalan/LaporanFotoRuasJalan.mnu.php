<? 
class LaporanFotoRuasJalanMenu extends MenuInterface{
	public $IdRuasJalan =  NULL;
	public $Time = NULL;
	public $Post = NULL;
	public $OffSet = NULL;
	public $ImgId =  NULL;
	public $UnixTime = NULL;
	public $IdPropinsi = NULL;
  	public function LaporanFotoRuasJalanMenu(){MenuInterface::MenuInterface();} 
  	public function Name(){return 'Foto ' . $this->ImgId;}
  	public function MakeFrame(){return BlankTitledFrame::Instance();}
  	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function Path(){return __FILE__;}
  	public function ClassName(){return __CLASS__;}
  	public function MakeApplication(){return SimpajatanApplication::Instance();}
  	
}  
?>