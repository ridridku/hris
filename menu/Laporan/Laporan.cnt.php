<?
/**
 * @package Content
 */
class LaporanContent extends ContentInterface
{
  public function LaporanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    ContentInterface::Show($v);  
  
  }
  public function Path(){return __FILE__;}
}
?>