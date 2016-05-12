<?
/**
 * @package Content
 */
class SurveyContent extends ContentInterface
{
  public function SurveyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
    ContentInterface::Show($v);  
  
  }
  public function Path(){return __FILE__;}
}
?>