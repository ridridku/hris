<html>
<head>
	<title><!--{$_TITLE}--></title>
<style type="text/css">
img.pngfix { behavior: url("<!--{$HREF_CSS_PATH}-->/iepngfix.htc") }
</style>
	
<style type="text/css">
		/* A few IE bug fixes */
		* { margin: 0; padding: 0; }
		* html ul ul li a { height: 100%; }
		* html ul li a { height: 100%; }
		* html ul ul li { margin-bottom: -1px; }
		
		body { padding-left: 0px; font-family: Arial, Helvetica, sans-serif; }
		#theMenu { width: 228px; margin: 0px; padding: 0; }
		
		/* Some list and link styling */
		ul li { width: 228px; }
		ul ul li { margin:1px; padding: 1px; width: 225px; margin-bottom: 0; }
		ul ul li a { display:block; border: 1px solid #ccc; color: #000; padding: 3px 6px; font-size: small; text-decoration: none;}
		ul ul li a:hover { display:block; color: #000; background: url(../themes/defaults/images/layout/grid-hro-red.gif) repeat-x;
		background-position:0 -7px; padding: 3px 6px; font-size: small; border:1px solid #F2A4A4; text-decoration: none;}
		/* For the xtra menu */
		ul ul ul li { border-left: none; border-bottom: 1px solid #eee; padding: 0; width: 224px; margin-bottom: 1; }
		ul ul ul li a { display:block; color: #000; padding: 3px 6px; font-size: small; }
		ul ul ul li a:hover { display:block; color: #369; padding: 3px 6px; font-size: small; }
		
		li { list-style-type: none; }
		h2 { margin-top: 1.5em; }
		
		a.menu-tree {
		display:block; 
		border: 1px solid #cccccc;
		background: url(../themes/defaults/images/layout/grid-hro-gray.gif) repeat-x;		
		background-position:0 -7px;
		padding: 3px 6px;
		margin-left:1px;
		margin-right:1px;
		margin-top:2px;
		margin-bottom:0px;
		height:21px;
		}
		
		a.menu-tree:hover{
		background: url(../themes/defaults/images/layout/grid-hro-gray-light.gif) repeat-x;		
		background-position:0 -7px;
		color: #36a;
		}
		* h3 {
			font-size:12px;
			font-face:arial verdana;
		}
		* h4 {
			font-size:12px;
			font-face:arial verdana;
		}
		* li {
			font-size:12px;
			font-face:arial verdana;
		}
		/* Header links styling */
		h3.head a { 
		text-decoration: none;
		display:block; 
		border: 1px solid #ACDBAE;		
		background: url(../themes/defaults/images/layout/grid-hro.gif) repeat-x;
		color: #083772;
		background-position:0 -7px;
		padding: 3px 6px;
		margin:1px;
		}
		h3.head a:hover { 
		color: #000;
		border:1px solid #ACDBAE;
		background: url(../themes/defaults/images/layout/grid-hro-light.gif) repeat-x;
		background-position:0 -7px;
		}
		h3.selected a { 
		background: url(../themes/defaults/images/layout/grid-hro-dark.gif) repeat-x;
		background-position:0 -7px;
		color: #fff;
		padding: 3px 6px;
		}
		h3.selected a:hover { 
		background: url(../themes/defaults/images/layout/grid-hro-light.gif) repeat-x;
		background-position:0 -7px;
		color: #36a;
		}
		
		/* Xtra Header links styling */
		h4.head a { 
		display:block; 
		background: url(../themes/defaults/images/layout/grid-hro-gray.gif) repeat-x;		
		background-position:0 -7px;
		padding: 3px 6px;
		}
		h4.head a:hover { 
		color: #000;
		background: url(../themes/defaults/images/layout/grid-hro-red.gif) repeat-x;
		background-position:0 -7px;
		}
		h4.selected a { 
		color: #000;
		background: url(../themes/defaults/images/layout/grid-hro-gray-light.gif) repeat-x;		
		background-position:0 -7px;
		padding: 3px 6px;
		}
		h4.selected a:hover { 
		background: url(../themes/defaults/images/layout/grid-hro-gray-light.gif) repeat-x;		
		background-position:0 -7px;
		color: #36a;
		}
		img.icon {
			float:left;margin-top:5px;margin-left:5px;padding-right:5px;
		}
</style>
	<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/common.css" type="text/css">
</head>
<body>


<script type="text/javascript" src="<!--{$HREF_JS_PATH}-->/jquery.js"></script>
<script type="text/javascript" src="<!--{$HREF_JS_PATH}-->/accordion.js"></script>
<!--<script type="text/javascript" src="<!--{$HREF_JS_PATH}-->/jquery.countdown.js"></script>-->

<script type="text/javascript">
jQuery().ready(function(){	
	// applying the settings
	jQuery('#theMenu').Accordion({
		active: 'h3.selected',
		header: 'h3.head',
		alwaysOpen: false,
		animated: true,
		showSpeed: 400,
		hideSpeed: 800
	});
	<!--{section name=y loop=$DATA_MENU_CHILD}-->
	<!--{if $DATA_MENU_CHILD[y].sum_child>0}-->
	jQuery('#xtraMenu<!--{$DATA_MENU_CHILD[y].menu_id}-->').Accordion({
		active: 'h4.selected',
		header: 'h4.head',
		alwaysOpen: false,
		animated: true,
		showSpeed: 400,
		hideSpeed: 800
	});
	<!--{/if}-->
	<!--{/section}-->
	
});	


</script>
<h3>&nbsp;SISTEM NAVIGASI MENU</h3> 
<!--<span id="countdown" style="color:red;">TimeOut # <b class=countdown secs="300">00:00:00</b></span>-->
<ul>
	<li><a class="menu-tree" href="main.frame.php" target="mainFrame" title="Home"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/home.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> Home</A></li>
	<li><a class="menu-tree" href="edit.profile.php?user_id=<!--{$USER_ID}-->" target="mainFrame" title="Edit Your Profile"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> Edit Your Profile</A></li>				
</ul>

<ul id="theMenu">
	<!--{section name=x loop=$DATA_MENU_PARENT}-->
	<li>
		<!--{if $DATA_MENU_PARENT[x].menu_id=='92'}-->
		<h3 class="head" style="height:0px;">
		<!--
		<form name="frmMenuShowGis" method="post" action="show.gis.php" target="_parent">
		<a class="menu-tree" href="javascript:document.frmMenuShowGis.submit();">
		<img src="<!--{$HREF_IMG_PATH}-->/<!--{$DATA_MENU_PARENT[x].menu_normal_icon}-->" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"><!--{$DATA_MENU_PARENT[x].menu_label}-->
		</a></form>
		-->
		
		
		<!--
		<a class="menu-tree" HREF="./Aplikasi/GIS_PUM.exe">
		<IMG SRC="<!--{$HREF_IMG_PATH}-->/<!--{$DATA_MENU_PARENT[x].menu_normal_icon}-->" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"><!--{$DATA_MENU_PARENT[x].menu_label}--></a>
		-->
		</h3>
		<!--{else}-->
		<h3 class="head" style="height:30px;"><a href="javascript:;"><img src="<!--{$HREF_IMG_PATH}-->/<!--{$DATA_MENU_PARENT[x].menu_normal_icon}-->" border="0" class="pngfix" align="absmiddle" style="margin-right:4px;"><!--{$DATA_MENU_PARENT[x].menu_label}--></a></h3>
		<!--{/if}-->
		<!--{section name=y loop=$DATA_MENU_CHILD}-->

				<!--{if $smarty.section.y.first}-->
				<ul>
				<!--{/if}-->
						
					<!--{if $DATA_MENU_CHILD[y].menu_parent == $DATA_MENU_PARENT[x].menu_id && $DATA_MENU_CHILD[y].menu_level == '1' }-->
				

					
						<li>
						<!--{if $DATA_MENU_CHILD[y].sum_child>0}-->
						
							<ul id="xtraMenu<!--{$DATA_MENU_CHILD[y].menu_id}-->">
                	<li>
                        <h4 class="head"><a href="javascript:;"><img src="<!--{$HREF_IMG_PATH}-->/<!--{$DATA_MENU_CHILD[y].menu_normal_icon}-->" border="0" class="pngfix" align="absmiddle" style="margin-right:4px;"><!--{$DATA_MENU_CHILD[y].menu_label}--></a></h4>
                        <!--{section name=q loop=$DATA_MENU_SUB_CHILD}-->
	                        <!--{if $smarty.section.q.first}-->
													<ul>
													<!--{/if}-->
													
													<!--{if $DATA_MENU_SUB_CHILD[q].menu_parent == $DATA_MENU_CHILD[y].menu_id && $DATA_MENU_SUB_CHILD[q].menu_level == '2'  && $DATA_MENU_CHILD[y].menu_parent == $DATA_MENU_PARENT[x].menu_id }-->
													
                            <li><a href="<!--{if $DATA_MENU_SUB_CHILD[q].menu_link != ''}--><!--{$DATA_MODULE}--><!--{$DATA_MENU_SUB_CHILD[q].menu_link}-->?mod_id=<!--{$DATA_MENU_SUB_CHILD[q].menu_id}--><!--{/if}-->" target="mainFrame"><!--{$DATA_MENU_SUB_CHILD[q].menu_label}--></a></li>
                        	
                        	<!--{/if}-->
                        	
                        	<!--{if $smarty.section.q.last}-->
													</ul>
													<!--{/if}-->
                        <!--{/section}-->
                    </li>
                </ul>
						
						<!--{else}-->
						
								<a href="<!--{if $DATA_MENU_CHILD[y].menu_link != ''}--><!--{$DATA_MODULE}--><!--{$DATA_MENU_CHILD[y].menu_link}-->?mod_id=<!--{$DATA_MENU_CHILD[y].menu_id}--><!--{/if}-->" target="mainFrame"><!--{$DATA_MENU_CHILD[y].menu_label}--></a>
						
						<!--{/if}-->
						
						</li>
					
				
				
					<!--{/if}-->
				<!--{if $smarty.section.y.last}-->
				</ul>
				<!--{/if}-->
		<!--{/section}-->
		
	</li>
	<!--{/section}-->

</ul>

<ul>
	<li><a class="menu-tree" href="javascript:openPopUp_('<!--{$HREF_HOME_PATH}-->/about.php','PopUp');" target="mainFrame" title="About"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/about.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> About</A></li>
	<li><a class="menu-tree" href="<!--{$HREF_HOME_PATH}-->/help/manual.doc" target="_blank" title="Help"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/help.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> Help</A></li>	
	<li><FORM  NAME="frmMenu" METHOD=POST ACTION="logout.php" target="_parent"><a class="menu-tree" HREF="javascript:document.frmMenu.submit();"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/lock.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> Logout</A></FORM></li>
</ul>

</body>
</html>