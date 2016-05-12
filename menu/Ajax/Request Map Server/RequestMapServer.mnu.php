<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestMapServerMenu extends AbstractHandlerMenu
{
	public $Map = NULL; 
	public $Mode = NULL;
	public $ImgX = NULL;
	public $ImgY = NULL;
	public $ImgExtLeft = NULL;
	public $ImgExtRight = NULL;
	public $ImgExtTop = NULL;
	public $ImgExtBottom = NULL;
	public $Layers = NULL;
	public $ImgSizeW = NULL;
	public $ImgSizeH = NULL;

	public function RequestMapServerMenu(){AbstractHandlerMenu::AbstractHandlerMenu();}
	public function Name(){return 'Request Map Server';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function OnSetKey($key = array()){
		if(
			$key['map'] != NULL && 
			$key['mode'] != NULL && 
			$key['imgX'] != NULL && 
			$key['imgY'] != NULL && 
			$key['imgextLeft'] != NULL && 
			$key['imgextRight'] != NULL && 
			$key['imgextBottom'] != NULL && 
			$key['imgextTop'] != NULL && 
			$key['layers'] != NULL && 
			$key['imgsizeW'] != NULL &&  
			$key['imgsizeH'] != NULL  
		){
			$this->Map = $key['map'];
			$this->Mode = $key['mode'];
			$this->ImgX = $key['imgX'];
			$this->ImgY = $key['imgY'];
			$this->ImgExtLeft = $key['imgextLeft'];
			$this->ImgExtRight = $key['imgextRight'];
			$this->ImgExtBottom = $key['imgextBottom'];
			$this->ImgExtTop = $key['imgextTop'];
			$this->Layers = $key['layers'];
			$this->ImgSizeW = $key['imgsizeW'];
			$this->ImgSizeH = $key['imgsizeH'];
		}	
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
}
?>