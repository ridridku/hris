<?
require_once 'Zend/Json/Encoder.php';

class MonitoringTabViewContent extends ContentInterface
{
  public function MonitoringTabViewContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
  	
	$spasialPath = str_replace( '\\', '/', dirname($_SERVER["SCRIPT_FILENAME"])) . '/assets';
	// parameter kanan

	$rsl_tab_view = $db->Execute(" 
			SELECT
				sys_menu.object AS o_menu_serialized  
			FROM 
				lyr_tab_ruas_jalan,
				sys_menu
			WHERE
				lyr_tab_ruas_jalan.id_menu_tab= sys_menu.id
			ORDER BY lyr_tab_ruas_jalan.order_to_right  
	");	
	$root_tabViewMenus = array();
	$aTab = 0;
	while($rec_tab_view = $db->FetchObject($rsl_tab_view)){
		$m = unserialize($rec_tab_view->o_menu_serialized);
		if(!is_null($p->IdPropinsi)) $m->IdPropinsi = $p->IdPropinsi;
		if(!is_null($p->IdRuasJalan)) $m->IdRuasJalan = $p->IdRuasJalan;
		$root_tabViewMenus[$aTab]->Name = $m->Name();
		$root_tabViewMenus[$aTab]->Ref = $m->Ref();
		$aTab++;
	}
	ContentInterface::Assign('root_tabViewMenus', Zend_Json_Encoder::encode($root_tabViewMenus));

	ContentInterface::Assign('YuiRelatifPath', YUI_RELATIF_PATH);
	
	ContentInterface::Show($v);  
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
}







































































/*
	$dashboardViewMenus = array();
	$m = new JumlahRuasJalanMenu();
	$dashboardViewMenus[0]->Name = $m->Name();
	$dashboardViewMenus[0]->Ref = $m->Ref();

	$m = new VideoSurveyMenu($param = array(
		'title' => 'Video Survey [Front]',
		'rect.width' => 330,
		'rect.height' => 220,
		'obj_list.id_object' => 0
	));
	$dashboardViewMenus[1]->Name = $m->Name();
	$dashboardViewMenus[1]->Ref = $m->Ref();

	$m = new VideoSurveyMenu($param = array(
		'title' => 'Video Survey [R-Side]',
		'rect.width' => 330,
		'rect.height' => 220,
		'obj_list.id_object' => 1
	));
	$dashboardViewMenus[2]->Name = $m->Name();
	$dashboardViewMenus[2]->Ref = $m->Ref();

	$m = new VideoSurveyMenu($param = array(
		'title' => 'Video Survey [L-Side]',
		'rect.width' => 330,
		'rect.height' => 220,
		'obj_list.id_object' => 2
	));
	$dashboardViewMenus[3]->Name = $m->Name();
	$dashboardViewMenus[3]->Ref = $m->Ref();

	$m = new VideoSurveyMenu($param = array(
		'title' => 'Video Survey [Back]',
		'rect.width' => 330,
		'rect.height' => 220,
		'obj_list.id_object' => 0
	));
	$dashboardViewMenus[4]->Name = $m->Name();
	$dashboardViewMenus[4]->Ref = $m->Ref();

	ContentInterface::Assign('dashboardViewMenus', Zend_Json_Encoder::encode($dashboardViewMenus));
	ContentInterface::Assign('tabHeight', $_SESSION[FrameworkSessionConstant::WindowOuterHeight] - 150);


	$m = new HistoryMenu();
	ContentInterface::Assign('rightMenu', $m->Ref());
	ContentInterface::Assign('rightMenuHeight', $_SESSION[FrameworkSessionConstant::WindowOuterHeight] - 50);
	*/
?>















