<?
class SimpajatanLoginHandlerContent extends AbstractGovermentalLoginContentHandler{
	public function SimpajatanLoginHandlerContent(){
		AbstractGovermentalLoginContentHandler::AbstractGovermentalLoginContentHandler();
	}
	protected function MakeLoginMenu(AppLoginRecord $r){
		return new SimpajatanNewLoginMenu();
	}
	protected function LoginQuery(AppLoginRecord $r){
		return new QueryFilter(
			"
				SELECT 
					sys_login.user_name AS UserName, 
					sys_login.id__sys_operator AS NipPegawai,
					NULL AS IdDinas, 
					sys_login.password AS 'Password',
					sys_operator.name AS Name,
					sys_group.id AS GroupId,
					sys_group.nama AS GroupName, 
					sys_group.o_home_menu AS ObjectHomeMenu ,
					sys_operator.id_mst_balaibesar AS IdBidang
				FROM 
					sys_login,
					sys_group,
					sys_operator  
				WHERE 	
					sys_login.user_name = '". $r->UserName ."' AND 
					sys_login.password = '". md5($r->Password) ."' AND 
					sys_login.id__sys_operator = sys_operator.id AND 
					sys_login.id_group = sys_group.id			 		 			
			", 
			new ColModifierResultInflector(
				$Child = new NoResultInflector(),
				new UnserializeColModifier(
					'ObjectHomeMenu',
					$Child = new NoColModifier()
				)
			)				
		);
	}
	protected function OnLoginPassed(DatabaseInterface $db, AppLoginRecord $r){
		$_SESSION[SessionConstant::NipPegawai] = $r->NipPegawai;
		$_SESSION[SessionConstant::Nama] = $r->Name;
		$_SESSION[SessionConstant::IdGroup] = $r->GroupId;
		$_SESSION[SessionConstant::NamaGroup] = $r->GroupName;
		$_SESSION[SessionConstant::IdBidang] = $r->IdBidang;
	}
}
?>