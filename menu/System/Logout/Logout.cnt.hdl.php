<?

class LogoutContentHandler extends ContentInterface{
	public function LogoutContentHandler(){
		ContentInterface::ContentInterface();
	}	
	public function Show(ValidatorInterface $v){
		foreach ($_SESSION as $key => $value){
			session_unregister($key);
		}		
		$m = new SimpajatanNewLoginMenu();
		header("Location: " . $_SERVER['PHP_SELF']);
	}
	public function Path(){return __FILE__;}
}
?>