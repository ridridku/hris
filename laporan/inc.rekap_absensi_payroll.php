<?PHP

function print_header($nm_perwakilan,$date_awal,$date_akhir){

$content = <<<EOH
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
				

<head>
<meta http-equiv=Content-Type content="text/html; charset=us-ascii">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 11">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:LastAuthor>ALS</o:LastAuthor>
  <o:LastPrinted>2008-01-12T03:10:37Z</o:LastPrinted>
  <o:LastSaved>2008-01-21T04:47:07Z</o:LastSaved>
  <o:Version>11.5606</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->
<style>
<!--table
	{mso-displayed-decimal-separator:"\,";
	mso-displayed-thousand-separator:"\.";}
@page
	{mso-header-data:"&LSistem Informasi Kepegawaian TMW";
	mso-footer-data:"&LTanggal \: &D&RHalaman &P \: &N";
	margin:.77in .75in .62in .75in;
	mso-header-margin:.32in;
	mso-footer-margin:.27in;
	mso-page-orientation:landscape;}
tr
	{mso-height-source:auto;}
col
	{mso-width-source:auto;}
br
	{mso-data-placement:same-cell;}
.style0
	{mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	white-space:nowrap;
	mso-rotate:0;
	mso-background-source:auto;
	mso-pattern:auto;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	border:none;
	mso-protection:locked visible;
	mso-style-name:Normal;
	mso-style-id:0;}
td
	{mso-style-parent:style0;
	padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:none;
	mso-background-source:auto;
	mso-pattern:auto;
	mso-protection:locked visible;
	white-space:nowrap;
	mso-rotate:0;}
.xl24
	{mso-style-parent:style0;
	background:white;
	mso-pattern:auto none;}
.xl25
	{mso-style-parent:style0;
	border-top:none;
	border-right:none;
	border-bottom:2.0pt double windowtext;
	border-left:none;
	background:white;
	mso-pattern:auto none;}
.xl26
	{mso-style-parent:style0;
	font-weight:700;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:2.0pt double windowtext;
	border-left:.5pt solid windowtext;
	background:#FFCC99;
	mso-pattern:auto none;
	white-space:normal;}
.xl27
	{mso-style-parent:style0;
	font-weight:700;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:2.0pt double windowtext;
	border-left:none;
	background:#FFCC99;
	mso-pattern:auto none;
	white-space:normal;}
.xl28
	{mso-style-parent:style0;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:auto none;}
.xl29
	{mso-style-parent:style0;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:white;
	mso-pattern:auto none;}
.xl30
	{mso-style-parent:style0;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:2.0pt double windowtext;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:auto none;}
.xl31
	{mso-style-parent:style0;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:2.0pt double windowtext;
	border-left:none;
	background:white;
	mso-pattern:auto none;}
.xl32
	{mso-style-parent:style0;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:auto none;}
.xl33
	{mso-style-parent:style0;
	font-size:16.0pt;
	font-weight:700;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	text-align:center;
	background:white;
	mso-pattern:auto none;}
.xl34
	{mso-style-parent:style0;
	font-weight:700;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	text-align:center;
	background:white;
	mso-pattern:auto none;}
.xl35
	{mso-style-parent:style0;
	font-size:12.0pt;
	font-weight:700;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	text-align:center;
	background:white;
	mso-pattern:auto none;}
.xl36
	{mso-style-parent:style0;
	font-weight:700;
	font-style:italic;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	text-align:center;
	background:white;
	mso-pattern:auto none;}
.xl37
	{mso-style-parent:style0;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:white;
	mso-pattern:auto none;}
.xl38
	{mso-style-parent:style0;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:auto none;}
.xl39
	{mso-style-parent:style0;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:white;
	mso-pattern:auto none;}
-->
</style>
<!--[if gte mso 9]><xml>
 <x:ExcelWorkbook>
  <x:ExcelWorksheets>
   <x:ExcelWorksheet>
    <x:Name>Rekap Terlambat</x:Name>
    <x:WorksheetOptions>
     <x:Print>
      <x:ValidPrinterInfo/>
      <x:HorizontalResolution>300</x:HorizontalResolution>
      <x:VerticalResolution>300</x:VerticalResolution>
     </x:Print>
     <x:ShowPageBreakZoom/>
     <x:PageBreakZoom>100</x:PageBreakZoom>
     <x:Selected/>
     <x:Panes>
      <x:Pane>
       <x:Number>3</x:Number>
       <x:ActiveRow>20</x:ActiveRow>
       <x:ActiveCol>6</x:ActiveCol>
      </x:Pane>
     </x:Panes>
     <x:ProtectContents>False</x:ProtectContents>
     <x:ProtectObjects>False</x:ProtectObjects>
     <x:ProtectScenarios>False</x:ProtectScenarios>
    </x:WorksheetOptions>
   </x:ExcelWorksheet>
  </x:ExcelWorksheets>
  <x:WindowHeight>10005</x:WindowHeight>
  <x:WindowWidth>10005</x:WindowWidth>
  <x:WindowTopX>120</x:WindowTopX>
  <x:WindowTopY>135</x:WindowTopY>
  <x:ProtectStructure>False</x:ProtectStructure>
  <x:ProtectWindows>False</x:ProtectWindows>
 </x:ExcelWorkbook>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1028"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

				

<body link=blue vlink=purple class=xl24>

<table x:str border=0 cellpadding=0 cellspacing=0 width=975 style='border-collapse:
 collapse;table-layout:fixed;width:736pt'>
 <col class=xl24 width=387 style='mso-width-source:userset;mso-width-alt:14153;
 width:290pt'>
 <col class=xl24 width=100 style='mso-width-source:userset;mso-width-alt:3816;
 width:78pt'
 <col class=xl24  width=387 style='mso-width-source:userset;mso-width-alt:14153;
 width:290pt'>
 <col class=xl24 width=100 style='mso-width-source:userset;mso-width-alt:3816;
 width:78pt'>
 <col class=xl24 width=387 style='mso-width-source:userset;mso-width-alt:14153;
 width:290pt'>
  <col class=xl24 width=387 style='mso-width-source:userset;mso-width-alt:14153;
 width:290pt'>
  <col class=xl24 width=387 style='mso-width-source:userset;mso-width-alt:14153;
 width:290pt'>
  <col class=xl24 width=387 style='mso-width-source:userset;mso-width-alt:14153;
 width:290pt'>
   <col class=xl24 width=387 style='mso-width-source:userset;mso-width-alt:14153;
 width:290pt'>
 
 
 
EOH;

if($nm_perwakilan!='')
{    $label_perwakilan=$nm_perwakilan;}  else {$label_perwakilan='ALL CABANG';}
$content .= "<tr height=21 style='height:15.75pt'>
  <td colspan=11 height=21 class=xl36 style='height:15.75pt'>CABANG  : ".$label_perwakilan."</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
 <td colspan=11 height=21 class=xl36 style='height:15.75pt'>Periode : ".$date_awal." S/D: ".$date_akhir."</td>
 </tr>";



$content .= <<<EOH

 
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
    <td height=21 class=xl26 width=54 style='height:15.75pt;width:20pt'>ID FINGER</td>
    <td class=xl27 width=15 style='width:30pt'>NAMA</td>
    <td class=xl27 width=100 style='width:30pt'>CABANG</td>
    <td class=xl27 width=100 style='width:30pt'>STATUS</td>
    <td class=xl27 width=82 style='width:25pt'>HADIR</td>
    <td class=xl27 width=109 style='width:50pt'>SAKIT</td>
    <td class=xl27 width=98 style='width:50pt'>IZIN</td> 
    <td class=xl27 width=57 style='width:25pt'>ALPA</td>
    <td class=xl27 width=57 style='width:25pt'>DINAS LUAR</td>
    <td class=xl27 width=57 style='width:25pt'>CUTI</td>
    <td class=xl27 width=74 style='width:30pt'>KETERANGAN</td>
    
        
         
     
 </tr>
EOH;

return $content;
	
}

function print_content($cols1,$cols2,$cols3,$cols4,$cols5,$cols6,$cols7,$cols8,$cols9,$cols10,$cols11) {

$content = " <tr height=18 style='height:13.5pt'>
  <td height=18 class=xl28 align=right style='height:13.5pt'>".$cols1."</td>
  <td class=xl29>".$cols2."</td>
  <td class=xl29 align=right x:num>".$cols3."</td>
  <td class=xl29 align=right x:num>".$cols4."</td>
  <td class=xl29 align=right >".$cols5."</td>
  <td class=xl29 align=right >".$cols6."</td>
  <td class=xl29 align=right x:num>".$cols7."</td>
  <td class=xl29 align=right >".$cols8."</td>
  <td class=xl29 align=right >".$cols9."</td>
  <td class=xl29 align=right >".$cols10."</td>
  <td class=xl29 align=right >".$cols11."</td>
    

 </tr>";

return $content;
	
}

function print_footer() {

$content = <<<EOH
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
    <td colspan=11 width=74 style='width:34pt'></td>
  

 </tr>
 <![endif]>
</table>


</body>
			
</html>



EOH;

return $content;
	
}

?>