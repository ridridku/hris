<?
/**
 * @package Content
 */
class LaporanSelectorContent extends ContentInterface
{
  public function LaporanSelectorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$Gui = $p->MakeGuiFactory();
	$f = $Gui->MakeForm();
		
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Filter';
	$f->AddRowElement($r);
	
	if($p->IdPropinsi == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==1 )$p->IdPropinsi = '4';//RIAU
	if($p->IdRuasJalan == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==1)$p->IdRuasJalan = '090171';
	
	if($p->IdPropinsi == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==2 )$p->IdPropinsi = '3';//SUMBAR
	if($p->IdRuasJalan == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==2)$p->IdRuasJalan = '0600112K';
	
	if($p->IdPropinsi == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==3 )$p->IdPropinsi = '5';//JAMBI
	if($p->IdRuasJalan == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==3)$p->IdRuasJalan = '11028';
	
	if($p->IdPropinsi == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==4 )$p->IdPropinsi = '10';//JABAR
	if($p->IdRuasJalan == NULL && $_SESSION[FrameworkSessionConstant::IdBidang]==4)$p->IdRuasJalan = '2200621K';
	
	
	$sql ="
			SELECT * 
			FROM mst_propinsi
			WHERE
				mst_propinsi.id = (
					SELECT mst_ruas_jalan.id__mst_propinsi
					FROM mst_ruas_jalan
					WHERE
						mst_ruas_jalan.id = '". $p->IdRuasJalan ."'
				) 
		";
	$Query = $db->Execute($sql);
	$Result_Prop = $db->FetchObject($Query);


	$r = $Gui->MakeComboBox();
	$r->Name = 'id_propinsi';
	$r->Mandatory = true;
	$r->TextToDisplay = 'Propinsi';
	$r->ItemSelected = $Result_Prop->id;
	$r->OnChange = "
			  for(var i=0; i<this.childNodes.length; i++){
				 oneChild = this.childNodes[i];
				 if(oneChild.selected){
					var request = YAHOO.util.Connect.asyncRequest(
						'POST', 
						'?Menu=' + oneChild.value, 
						{
							success:function(o){
								var oResults = eval('(' + o.responseText + ')');
								var sender = YAHOO.util.Dom.get('id_ruas_jalan');

								if(oResults.Id == 'RequestCandidatePilihanPropinsiLebarRuasMenu'){
									while(sender.length > 0)sender.remove(0);									
									for(var i=0; i<oResults.nama.length; i++){
										var elm_select = document.createElement('option');
										elm_select.label = oResults.nama[i];
										elm_select.value = oResults.id_mst_ruas_jalan[i];
										elm_select.text = oResults.nama[i]; 
										sender.add(elm_select, null);
									}
								}
							},
							failure:function(o){},
							argument:{} 
						}
					);
					
					return;
				 }
			  }";
	$rsl = $db->Execute("
		SELECT 
			id AS id, 
			nama AS nama 
		FROM mst_propinsi
		WHERE
			id__mst_balaibesar = ".$_SESSION[FrameworkSessionConstant::IdBidang]."
		ORDER BY nama
	");

	$selected_menu = new RequestCandidatePilihanPropinsiLebarRuasMenu();
	$selected_menu->IdPropinsi = (int) $Result_Prop->id;
	$selected_menu->IsMandatory = false;
	$r->ItemSelected = $selected_menu->Ref();
	$i = 0;
	while($R = $db->FetchObject($rsl)){
		$m = new RequestCandidatePilihanPropinsiLebarRuasMenu();
		$m->IdPropinsi = (int) $R->id;
		$m->IsMandatory = false;
		$r->Result[$i][ComboBoxConstant::Value] = $m->Ref();
		$r->Result[$i][ComboBoxConstant::Label] = $R->nama;
		$r->Result[$i][ComboBoxConstant::Output] = $R->nama;
		$i++;
	}
	$r->AddValidator(new ComboBoxValidator($r));
	$f->AddRowElement($r);

    $r = $Gui->MakeComboBox();
	$r->Name = 'id_ruas_jalan';
	$r->TextToDisplay = 'Ruas Jalan';
	$r->ItemSelected = $p->IdRuasJalan;
	$r->FromQuery($db, "
		SELECT 
			`mst_ruas_jalan`.`id` AS id,
			CONCAT(`mst_ruas_jalan`.`id`,' | ',`mst_ruas_jalan`.`nama_ruas`) AS name
		FROM `mst_ruas_jalan`
		WHERE mst_ruas_jalan.id__mst_propinsi = '".(int) $Result_Prop->id."'
		ORDER BY name
	");
	$r->AddValidator(new DefaultValidator());
	$f->AddRowElement($r);
	
	if(!is_null($p->IdRuasJalan)){
		$r = $Gui->MakeLabel();
		$r->TextToDisplay = 'Koordinat Awal';
		$r->FromQuery($db, "
			SELECT
				CONCAT(pos_start_bt,' : ',pos_start_ls) AS Value
			FROM
				`mst_ruas_jalan`
			WHERE
				id = '". $p->IdRuasJalan ."'
		");
		$f->AddRowElement($r);
	}
	
	if(!is_null($p->IdRuasJalan)){
		$r = $Gui->MakeLabel();
		$r->TextToDisplay = 'Koordinat Akhir';
		$r->FromQuery($db, "
			SELECT
				CONCAT(pos_end_bt,' : ',pos_end_ls) AS Value
			FROM
				`mst_ruas_jalan`
			WHERE
				id = '". $p->IdRuasJalan ."'
		");
		$f->AddRowElement($r);
	}
	
	
	$r = $Gui->MakeBottomButton();
	$f->AddRowElement($r);
	
	$f->Action = new LaporanSelectorHandlerMenu();
	$f->Display($p, $v);
  }
  public function Path(){return __FILE__;}
}

?>