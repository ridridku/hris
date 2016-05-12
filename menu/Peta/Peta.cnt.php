<?
/**
 * @package Content
 */
class PetaContent extends ContentInterface
{
  public function PetaContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    ContentInterface::Show($v);  
  
  }
  public function Path(){return __FILE__;}
}
?>