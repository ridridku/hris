<?

function print_header($cabang_nama,$pre_active,$end_active) {

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
    <x:Name>Data Karyawan</x:Name>
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
 
 <tr height=27 style='height:20.25pt'>
  <td colspan=33 height=27 class=xl33 style='height:20.25pt;
  width:652pt'><!--[if gte vml 1]><v:shape id="_x0000_s1027" style='position:absolute;
   margin-left:0;margin-top:0;width:832.5pt;height:156.75pt;z-index:1;
   visibility:hidden' coordsize="21600,21600" o:spt="100" o:preferrelative="t"
   adj="0,,0" path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas/>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t" selection="t"/>
   <x:ClientData ObjectType="Shape">
    <x:Anchor>
     0, 0, 0, 0, 14, 7, 10, 55</x:Anchor>
   </x:ClientData>
  </v:shape><![endif]-->LAPORAN REKAP PAYROLL</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td colspan=33 height=17 class=xl34 style='height:12.75pt'>&nbsp;</td>
 </tr>
 
EOH;

$content .= "<tr height=21 style='height:15.75pt'>
  <td colspan=33 height=21 class=xl36 style='height:15.75pt'>CABANG  : ".$cabang_nama."</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=33 height=21 class=xl36 style='height:15.75pt'>PERIODE  : ".$pre_active." s.d ".$end_active."</td>
 </tr>";

$content .= <<<EOH
 <tr height=18  style='height:13.5pt'>
  <td colspan=33 height=18 class=xl25 style='height:13.5pt'>&nbsp;</td>

 </tr>
 
<tr height=21 style='mso-height-source:userset;height:15.75pt'>
<td height=21 class=xl26 width=54 style='height:15.75pt;width:20pt'>NO</td>
<td class=xl27 width=15 style='width:30pt'>NIP</td>
<td class=xl27 width=15 style='width:30pt'>IDFINGER</td>
<td class=xl27 width=15 style='width:30pt'>NAMA</td>
<td class=xl27 width=15 style='width:30pt'>CABANG</td>
<td class=xl27 width=15 style='width:30pt'>SUBCABANG</td>
<td class=xl27 width=15 style='width:30pt'>DEPARTEMEN</td>
<td class=xl27 width=15 style='width:30pt'>COST CENTRE</td>
<td class=xl27 width=15 style='width:30pt'>LEVEL</td>
<td class=xl27 width=15 style='width:30pt'>JABATAN</td>
<td class=xl27 width=15 style='width:30pt'>TGL MASUK</td>
<td class=xl27 width=15 style='width:30pt'>LAMA KERJA (BLN)</td>
<td class=xl27 width=15 style='width:30pt'>KEHADIRAN</td>
<td class=xl27 width=15 style='width:30pt'>STATUS</td>
<td class=xl27 width=15 style='width:30pt'>GAPOK</td>
<td class=xl27 width=15 style='width:30pt'>T.JABATAN</td>
<td class=xl27 width=15 style='width:30pt'>T.TRANS</td>
<td class=xl27 width=15 style='width:30pt'>T.MAKAN</td>
<td class=xl27 width=15 style='width:30pt'>T.LAIN1</td>
<td class=xl27 width=15 style='width:30pt'>T.LAIN2</td>
<td class=xl27 width=15 style='width:30pt'>T.KEMAHALAN</td>
<td class=xl27 width=15 style='width:30pt'>DASAR BPJS</td>
<td class=xl27 width=15 style='width:30pt'>BPJS TK TMW</td>
<td class=xl27 width=15 style='width:30pt'>BPJS TK PEG</td>
<td class=xl27 width=15 style='width:30pt'>BPJS KES TMW</td>  
<td class=xl27 width=15 style='width:30pt'>BPJS KES PEG</td>
<td class=xl27 width=15 style='width:30pt'>ANGSURAN</td><!-- 27 Angsur-->
<td class=xl27 width=15 style='width:30pt'>ROUND</td><!-- 28 ROUND -->
<td class=xl27 width=15 style='width:30pt'>NO REK</td><!-- 29 REK -->
<td class=xl27 width=15 style='width:30pt'>NAMA REK</td><!-- 30 NAMA PEMILIK -->
<td class=xl27 width=15 style='width:30pt'>IDR</td>
<td class=xl27 width=15 style='width:30pt'>NOMINAL</td><!-- 28 REK -->
<td class=xl27 width=15 style='width:30pt'>NAMA BANK</td><!-- 31 BANK -->

 </tr>
EOH;

return $content;
	
}

function print_content($cols1,$cols2,$cols3,$cols4,$cols5,$cols6,$cols7,$cols8,$cols9,$cols10,
$cols11,$cols12,$cols13,$cols14,$cols15,$cols16,$cols17,$cols18,$cols19,$cols20,
$cols21,$cols22,$cols23,$cols24,$cols25,$cols26,$cols27,$cols28,$cols31,$cols30,$cols29) {

$content = " 
<tr height=18 style='height:13.5pt'>
<td class=xl28 align=right style='height:5.5pt'>".$cols1."</td>
<td class=xl29 align=right >".$cols2."</td>
<td class=xl29 align=right >".$cols3."</td>
<td class=xl29 align=right x:num>".$cols4."</td>
<td class=xl29 align=right>".$cols5."</td>
<td class=xl29 align=right>".$cols6."</td>
<td class=xl29 align=right>".$cols7."</td>
<td class=xl29 align=right>".$cols8."</td>
<td class=xl29 align=right>".$cols9."</td>
<td class=xl29 align=right>".$cols10."</td>
<td class=xl29 align=right>".$cols11."</td>
<td class=xl29 align=right>".$cols12."</td>
<td class=xl29 align=right>".$cols13."</td>
<td class=xl29 align=right>".$cols14."</td>
<td class=xl29 align=right x:num>".$cols15."</td>
<td class=xl29 align=right x:num>".$cols16."</td>
<td class=xl29 align=right x:num> ".$cols17."</td>
<td class=xl29 align=right x:num>".$cols18."</td>
<td class=xl29 align=right x:num>".$cols19."</td>
<td class=xl29 align=right x:num>".$cols20."</td>
<td class=xl29 align=right x:num>".$cols21."</td>
<td class=xl29 align=right x:num>".$cols22."</td>
<td class=xl29 align=right x:num>".$cols23."</td>
<td class=xl29 align=right x:num>".$cols24."</td>
<td class=xl29 align=right x:num>".$cols25."</td>
<td class=xl29 align=right x:num>".$cols26."</td>
<td class=xl29 align=right x:num>".$cols27."</td>
<td class=xl29 align=right x:num>".$cols28."</td>
<td class=xl29 align=right >".$cols29."</td>
<td class=xl29 align=right >".$cols30."</td>
<td class=xl29 align=right>IDR</td>
<td class=xl29 align=right x:num>".$cols28."</td>
<td class=xl29 align=right>".$cols31."</td>
     

  
 </tr>";

return $content;
	
}

function print_footer() {

$content = <<<EOH
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
 <td colspan=33 width=80 clospan= style='width:41pt'></td></tr>
 <![endif]>
</table>


</body>			
</html>



EOH;

return $content;
	
}

?>