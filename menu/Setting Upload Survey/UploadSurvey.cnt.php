<?
class UploadSurveyContent extends ContentInterface{
	public function UploadSurveyContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>