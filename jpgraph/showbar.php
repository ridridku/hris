<?php
// $Id: groupbarex1.php,v 1.2 2002/07/11 23:27:28 aditus Exp $
include ("jpgraph.php");
include ("jpgraph_bar.php");

$kdlok = $_GET[kdlok];
$jnslap = $_GET[jnslap];
$fname = $kdlok.".".$jnslap;

function getDataArray($fname='data',$arr_num='0') {

		$handle = fopen("data/".$fname.".txt", "rb");
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

$datay1 = getDataArray($fname.".data",0);
$datay2 = getDataArray($fname.".data",1);
$legend = getDataArray($fname.".legend",0);

$graph = new Graph(550,250,'auto');	
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->img->SetMargin(90,30,40,80);
$graph->xaxis->SetTickLabels($legend);
$graph->xaxis->SetLabelAngle(90);

$graph->xaxis->title->Set('Kode Perkiraan');
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetTitleSide(SIDE_RIGHT);
$graph->xaxis->SetTitleMargin(35);

$graph->yaxis->title->Align('right');

$graph->yaxis->title->Set('Nilai');
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->SetTitleSide(SIDE_RIGHT);
$graph->yaxis->SetTitleMargin(-70);
$graph->xaxis->title->Align('left');

$graph->title->Set('Perkembangan Data Kelompok Barang');
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$bplot1 = new BarPlot($datay1);
$bplot2 = new BarPlot($datay2);

$bplot1->SetFillColor("orange");
$bplot2->SetFillColor("darkgreen");

$bplot1->SetShadow();
$bplot2->SetShadow();

$bplot1->SetShadow();
$bplot2->SetShadow();

$gbarplot = new GroupBarPlot(array($bplot1,$bplot2));
$gbarplot->SetWidth(0.8);
$graph->Add($gbarplot);

$graph->Stroke();
?>

