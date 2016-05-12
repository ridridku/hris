<html>
<head>
<title><!--{$TITLE}--></title>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/common.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<BODY onLoad="javascript:document.frmAuth.submit();">
<FORM NAME="frmAuth" METHOD="<!--{$METHOD}-->" ACTION="<!--{$ACTION}-->" TARGET="<!--{$TARGET}-->">
<CENTER>
<H3 CLASS="TextIntro2"><!--{$AUTHCOMPLETE}--></H3>
<DIV style="position:absolute; width:100%; height:100%; z-index:1; left: 0px; top: 75px;">
<TABLE ALIGN="CENTER" WIDTH="100%">
<TR>
	<TD ALIGN="CENTER" CLASS="TextIntro">
	<!--{if $SUCCEED == '0' || $ERRVALUE != ''}-->
	<INPUT TYPE="hidden" NAME="ALERT" VALUE="<!--{$ERRVALUE}-->">
	<!--{/if}-->
	<!--{if $ERRVALUE == '6'}-->
	<INPUT TYPE="hidden" NAME="IN" VALUE="<!--{$LOGIN}-->">
	<INPUT TYPE="hidden" NAME="IP" VALUE="<!--{$IP}-->">
	<!--{/if}-->
	<!--{if $CHECKER != '' }-->
	<INPUT TYPE="hidden" NAME="CHECK" VALUE="<!--{$CHECKER}-->">
	<!--{/if}-->
</TD>
</TR>
</TABLE>
</DIV>
</CENTER>
</FORM>
</body>
</html>

<!--<I>It seems like you have entered invalid data login, or you don't have enough privilege to run this module</I><BR>Please Contact the Administrator for this problem </I><BR><HR>
Press OK To Continue<BR>-->