<?
class SimpajatanLoginContent extends AbstractGovermentalLoginContent{
	public function SimpajatanLoginContent(){
		AbstractGovermentalLoginContent::AbstractGovermentalLoginContent();
	}
	protected function AppDescriptionQuery(){
		return "
			SELECT 
				'Aplikasi Simpajatan Dokumen Perizinan' AS Name, 
				'Simpajatan' AS SimpleName, 
				'Simpajatan Aplication' AS Developer, 
				'images/header.bmp' AS HeaderImage, 
				'images/bg-header.jpg' AS BgHeaderImage, 
				'images/favicon.ico' AS Icon,
				'#66CCFF' AS FooterColor,
				'images/login.jpg' AS LoginImage 
		";
	}
	protected function MakeMenuHandler(){
		return new SimpajatanLoginHandlerMenu();
	}
}
?>