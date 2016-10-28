<?php /* Smarty version 2.6.18, created on 2016-10-19 08:47:53
         compiled from D:/xampp/htdocs//hris/themes/defaults/log.engine.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/common.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<BODY onLoad="javascript:document.frmAuth.submit();">
<FORM NAME="frmAuth" METHOD="<?php echo $this->_tpl_vars['METHOD']; ?>
" ACTION="<?php echo $this->_tpl_vars['ACTION']; ?>
" TARGET="<?php echo $this->_tpl_vars['TARGET']; ?>
">
<CENTER>
<H3 CLASS="TextIntro2"><?php echo $this->_tpl_vars['AUTHCOMPLETE']; ?>
</H3>
<DIV style="position:absolute; width:100%; height:100%; z-index:1; left: 0px; top: 75px;">
<TABLE ALIGN="CENTER" WIDTH="100%">
<TR>
	<TD ALIGN="CENTER" CLASS="TextIntro">
	<?php if ($this->_tpl_vars['SUCCEED'] == '0' || $this->_tpl_vars['ERRVALUE'] != ''): ?>
	<INPUT TYPE="hidden" NAME="ALERT" VALUE="<?php echo $this->_tpl_vars['ERRVALUE']; ?>
">
	<?php endif; ?>
	<?php if ($this->_tpl_vars['ERRVALUE'] == '6'): ?>
	<INPUT TYPE="hidden" NAME="IN" VALUE="<?php echo $this->_tpl_vars['LOGIN']; ?>
">
	<INPUT TYPE="hidden" NAME="IP" VALUE="<?php echo $this->_tpl_vars['IP']; ?>
">
	<?php endif; ?>
	<?php if ($this->_tpl_vars['CHECKER'] != ''): ?>
	<INPUT TYPE="hidden" NAME="CHECK" VALUE="<?php echo $this->_tpl_vars['CHECKER']; ?>
">
	<?php endif; ?>
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