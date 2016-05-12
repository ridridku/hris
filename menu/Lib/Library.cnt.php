<?
/**
 * @package Content
 */
class LibraryContent extends ContentInterface
{
  public function LibraryContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    ContentInterface::Show($v);  
  
  }
  public function Path(){return __FILE__;}
}
?>