<?

include ("jpgraph.php");
include ("jpgraph_pie.php");
include ("jpgraph_pie3d.php");

$fname = $_GET[fname];

function getDataArray($fname='data',$arr_num='0') {

		if (file_exists("data/".$fname.".txt")) {
			
			$filename = "data/".$fname.".txt";
		
		} else {
			$filename = 'data/default.txt';

		}

		$handle = fopen($filename, "rb");
		$contents = '';
		while (!feof($handle)) {
		 $contents .= fread($handle, 8192);
		}
		fclose($handle);
		
		$arr_contents = explode("||",$contents);
		$arr_contents_end = array();
		
		for ($i=0;$i<count($arr_contents);$i++) {
			
				$arr_contents2 = explode("::",$arr_contents[$i]);
				array_push($arr_contents_end,$arr_contents2[$arr_num]);
		}	
		
		return $arr_contents_end;
}

$data = getDataArray($fname.".data",0);

$graph = new PieGraph(350,200,"auto");
$graph->SetShadow();
$graph->legend->Pos(0.03,0.01);
$graph->title->Pos(0.5,0.5);
$graph->SetMargin(100,20,60,20); 

$graph->title->Set("Ratio Chart");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot3D($data);
$p1->SetAngle(45);
$p1->SetStartAngle(30);
$p1->ExplodeSlice(1);
$p1->SetCenter(0.3);


$legend = getDataArray($fname.".legend",0);

$p1->SetLegends($legend);

$graph->Add($p1);
$graph->Stroke();

?>