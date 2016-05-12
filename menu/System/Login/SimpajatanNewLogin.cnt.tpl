<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>.: Sistem Informasi Manajemen Jalan dan Jembatan :.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="images/favicon.png" />
{literal}
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;	
	background-color: #898989;
	#background-color: #d6d6d6;
}
.inputbox {
        color: blue;
        background: #fff799;
        font-family: Arial, Helvetica, sans-serif;
        z-index: -3;
        font-size: 12px;
		width:200px;
		height:20px;
}
.button {
	border-top : solid 1px #d5d5d5;
	border-right : solid 1px #808080;
	border-bottom : solid 1px #808080;
	border-left : solid 1px #d5d5d5;
	color : #004618;
	background-color:#92c3e3;
	height:22px;
	font-family:Tahoma;
	font-size:14px;
}
.hurup
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#FFFFFF;
}

.style9 {
	#color: #363636;
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style13 {
	color: #FFFFFF
}
.style14 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
</style>
{/literal}
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" onLoad="document.loginForm.user.focus();
	document.getElementById('window_outerWidth').value = (window.innerWidth);
	document.getElementById('window_outerHeight').value = (window.innerHeight);
">
<form name="loginForm" action="" method="post" onSubmit="SetCookie()">
<input type="hidden" id="window_outerWidth" name="window_outerWidth" value="1000">
<input type="hidden" id="window_outerHeight" name="window_outerHeight" value="700">
<input type="hidden" name="Menu" value="{$ACTION_PAGE}">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td align="center" valign="top" background="images/bg_top.jpg" style="background-repeat:repeat-x">
	<table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="599" height="258" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td background="images/header-Login_03.jpg" height="91" colspan="4" >&nbsp;</td>
          </tr>
          <tr>
            <td background="images/header-Login_05.jpg" height="39" colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td background="images/header-Login_06.gif" height="175" colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td background="images/header-Login_07.jpg" height="80" colspan="4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="211">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="157">&nbsp;</td>
              </tr>
              <tr>
                <td align="right"><span class="style9">Username</span></td>
                <td>&nbsp;</td>
                <td align="right"><input type="text" name="user" class="inputbox" id="user"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="25" align="right" valign="top"><span class="style9">Password</span></td>
                <td valign="top">&nbsp;</td>
                <td align="right" valign="top"><input type="password" name="pass" class="inputbox" id="pass"></td>
                <td valign="top">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td background="images/header-Login_07.jpg" colspan="2" width="385" height="31">&nbsp;</td>
            <td background="images/header-Login_08.jpg"  width="57" height="31">
              <input name="Submit" value="Login" type="image" src="images/header-Login_09.jpg"></td>
            <td  width="157" height="31" background="images/header-Login_10.jpg" >&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" background="images/header-Login_11.jpg" height="40">&nbsp;</td>
          </tr>
          <tr>
            <td width="599" height="30" colspan="4" align="center" background="images/header-Login_12.jpg">
            <span class="style9">
            Copyright @ 2009, Departemen Pekerjaan Umum Direktorat Bina Marga</span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
