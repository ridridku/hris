<? 
class LaporanVideoSurveyMenu extends MenuInterface{
	public $IdRuasJalan =  NULL;
	public $Time = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IdMovie =  NULL;
	public $UnixTime = NULL;
	public $IdPropinsi = NULL;
	
  	public function LaporanVideoSurveyMenu(){
		MenuInterface::MenuInterface();
	} 
  	public function Name(){return ($this->Title == NULL ? 'Video Survey' : $this->Title);}
  	public function MakeFrame(){return BlankTitledFrame::Instance();}
  	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function Path(){return __FILE__;}
  	public function ClassName(){return __CLASS__;}
  	public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>