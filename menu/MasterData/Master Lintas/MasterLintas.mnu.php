<?
class MasterLintasMenu extends CommonMasterTabelMenu{
	public function MasterLintasMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Lintas';}
	public function Tabel(){return 'mst_lintas';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>