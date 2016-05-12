<?
/**
 * @package Content
 */
class CommonFilterLaporanContent extends ContentInterface
{
  public function CommonFilterLaporanContent(){
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
	
	$r = $Gui->MakeComboBox();
    $r->Name = 'id_propinsi';
	$r->TextToDisplay = 'Propinsi';
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
										elm_select.value = oResults.id[i];
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
		SELECT id AS id, nama AS nama
		FROM mst_propinsi
		ORDER BY nama
	");

	$selected_menu = new RequestCandidatePilihanPropinsiLebarRuasMenu();
	$selected_menu->IdPropinsi = 5;
	$r->ItemSelected = $selected_menu->Ref();
	$i = 0;
    while($R = $db->FetchObject($rsl)){
		$m = new RequestCandidatePilihanPropinsiLebarRuasMenu();
		$m->IdPropinsi = $R->id;
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
	$r->FromQuery($db, "
		SELECT 
			`mst_ruas_jalan`.`id` AS id,
			CONCAT(`mst_ruas_jalan`.`id`,' | ',`mst_ruas_jalan`.`nama_ruas`) AS name
		FROM `mst_ruas_jalan`
		WHERE mst_ruas_jalan.id__mst_propinsi = (
			SELECT id 
			FROM mst_propinsi 
			LIMIT 0, 1
		)
		ORDER BY name
	");
	$r->AddValidator(new DefaultValidator());
	$f->AddRowElement($r);
	
	if(!is_null($p->IdPropinsi)){
		$r = $Gui->MakeLabel();
		$r->TextToDisplay = 'Propinsi Terpilih';
		$r->FromQuery($db, "
			SELECT
				id AS id,
				nama AS Value
			FROM
				`mst_propinsi`
			WHERE
				id = '". $p->IdPropinsi ."'
		");
		$f->AddRowElement($r);
	}
	
	if(!is_null($p->IdRuasJalan)){
		$r = $Gui->MakeLabel();
		$r->TextToDisplay = 'Ruas Jalan Terpilih';
		$r->FromQuery($db, "
			SELECT
				id AS id,
				nama_ruas AS Value
			FROM
				`mst_ruas_jalan`
			WHERE
				id = '". $p->IdRuasJalan ."'
		");
		$f->AddRowElement($r);
	}
	
	$r = $Gui->MakeBottomButton();
	$f->AddRowElement($r);
	
	$f->Action = new CommonFilterLaporanHandlerMenu();
	$f->Action->IdPropinsi = $p->IdPropinsi;
	$f->Action->IdRuasJalan =$p->IdRuasJalan;
	$f->Action->Next = clone($p);
	$f->Display($p, $v);
  }
  public function Path(){return __FILE__;}
}
?>