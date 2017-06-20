<?php /* Smarty version 2.6.18, created on 2017-06-02 09:11:07
         compiled from defaults/modules/menu.frame.tpl */ ?>
<html>
<head>
	<title><?php echo $this->_tpl_vars['_TITLE']; ?>
</title>
<style type="text/css">
img.pngfix { behavior: url("<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/iepngfix.htc") }
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
	<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/common.css" type="text/css">
</head>
<body>


<script type="text/javascript" src="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/accordion.js"></script>
<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/jquery.countdown.js"></script>-->

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
	<?php unset($this->_sections['y']);
$this->_sections['y']['name'] = 'y';
$this->_sections['y']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_MENU_CHILD']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['y']['show'] = true;
$this->_sections['y']['max'] = $this->_sections['y']['loop'];
$this->_sections['y']['step'] = 1;
$this->_sections['y']['start'] = $this->_sections['y']['step'] > 0 ? 0 : $this->_sections['y']['loop']-1;
if ($this->_sections['y']['show']) {
    $this->_sections['y']['total'] = $this->_sections['y']['loop'];
    if ($this->_sections['y']['total'] == 0)
        $this->_sections['y']['show'] = false;
} else
    $this->_sections['y']['total'] = 0;
if ($this->_sections['y']['show']):

            for ($this->_sections['y']['index'] = $this->_sections['y']['start'], $this->_sections['y']['iteration'] = 1;
                 $this->_sections['y']['iteration'] <= $this->_sections['y']['total'];
                 $this->_sections['y']['index'] += $this->_sections['y']['step'], $this->_sections['y']['iteration']++):
$this->_sections['y']['rownum'] = $this->_sections['y']['iteration'];
$this->_sections['y']['index_prev'] = $this->_sections['y']['index'] - $this->_sections['y']['step'];
$this->_sections['y']['index_next'] = $this->_sections['y']['index'] + $this->_sections['y']['step'];
$this->_sections['y']['first']      = ($this->_sections['y']['iteration'] == 1);
$this->_sections['y']['last']       = ($this->_sections['y']['iteration'] == $this->_sections['y']['total']);
?>
	<?php if ($this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['sum_child'] > 0): ?>
	jQuery('#xtraMenu<?php echo $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
').Accordion({
		active: 'h4.selected',
		header: 'h4.head',
		alwaysOpen: false,
		animated: true,
		showSpeed: 400,
		hideSpeed: 800
	});
	<?php endif; ?>
	<?php endfor; endif; ?>



	 <?php unset($this->_sections['z']);
$this->_sections['z']['name'] = 'z';
$this->_sections['z']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_MENU_SUB_CHILD']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['z']['show'] = true;
$this->_sections['z']['max'] = $this->_sections['z']['loop'];
$this->_sections['z']['step'] = 1;
$this->_sections['z']['start'] = $this->_sections['z']['step'] > 0 ? 0 : $this->_sections['z']['loop']-1;
if ($this->_sections['z']['show']) {
    $this->_sections['z']['total'] = $this->_sections['z']['loop'];
    if ($this->_sections['z']['total'] == 0)
        $this->_sections['z']['show'] = false;
} else
    $this->_sections['z']['total'] = 0;
if ($this->_sections['z']['show']):

            for ($this->_sections['z']['index'] = $this->_sections['z']['start'], $this->_sections['z']['iteration'] = 1;
                 $this->_sections['z']['iteration'] <= $this->_sections['z']['total'];
                 $this->_sections['z']['index'] += $this->_sections['z']['step'], $this->_sections['z']['iteration']++):
$this->_sections['z']['rownum'] = $this->_sections['z']['iteration'];
$this->_sections['z']['index_prev'] = $this->_sections['z']['index'] - $this->_sections['z']['step'];
$this->_sections['z']['index_next'] = $this->_sections['z']['index'] + $this->_sections['z']['step'];
$this->_sections['z']['first']      = ($this->_sections['z']['iteration'] == 1);
$this->_sections['z']['last']       = ($this->_sections['z']['iteration'] == $this->_sections['z']['total']);
?>
	<?php if ($this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['z']['index']]['sum_child2'] > 0): ?>
	jQuery('#xtraMenu2<?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['z']['index']]['menu_id']; ?>
').Accordion({
		active: 'h4.selected',
		header: 'h4.head',
		alwaysOpen: false,
		animated: true,
		showSpeed: 400,
		hideSpeed: 800
	});
	<?php endif; ?>
	<?php endfor; endif; ?>




});


</script>
<h3>&nbsp;SISTEM NAVIGASI MENU</h3>
<!--<span id="countdown" style="color:red;">TimeOut # <b class=countdown secs="300">00:00:00</b></span>-->
<ul>
	<li><a class="menu-tree" href="main.frame.php" target="mainFrame" title="Home"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/home.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> Halaman Utama</A></li>
	<li><a class="menu-tree" href="edit.profile.php?user_id=<?php echo $this->_tpl_vars['USER_ID']; ?>
" target="mainFrame" title="Edit Your Profile"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> Ubah Password</A></li>
</ul>

<ul id="theMenu">
	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_MENU_PARENT']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>

	<li>
		<?php if ($this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] == '92'): ?>
		<h3 class="head" style="height:30px;">
		<!--
		<form name="frmMenuShowGis" method="post" action="show.gis.php" target="_parent">
		<a class="menu-tree" href="javascript:document.frmMenuShowGis.submit();">
		<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/<?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_normal_icon']; ?>
" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"><?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_label']; ?>

		</a></form>
		-->

		<form name="frmMenuShowGis" method="post" action="show.gis.php" target="_parent">
		<a class="menu-tree" HREF="javascript:document.frmMenuShowGis.submit();">
		<IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/<?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_normal_icon']; ?>
" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"><?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_label']; ?>
</a></form>

		<!--
		<a class="menu-tree" HREF="./Aplikasi/GIS_PUM.exe">
		<IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/<?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_normal_icon']; ?>
" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"><?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_label']; ?>
</a>
		-->
		</h3>
		<?php else: ?>
		<h3 class="head" style="height:30px;"><a href="javascript:;"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/<?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_normal_icon']; ?>
" border="0" class="pngfix" align="absmiddle" style="margin-right:4px;"><?php echo $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_label']; ?>
</a></h3>
		<?php endif; ?>
		<?php unset($this->_sections['y']);
$this->_sections['y']['name'] = 'y';
$this->_sections['y']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_MENU_CHILD']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['y']['show'] = true;
$this->_sections['y']['max'] = $this->_sections['y']['loop'];
$this->_sections['y']['step'] = 1;
$this->_sections['y']['start'] = $this->_sections['y']['step'] > 0 ? 0 : $this->_sections['y']['loop']-1;
if ($this->_sections['y']['show']) {
    $this->_sections['y']['total'] = $this->_sections['y']['loop'];
    if ($this->_sections['y']['total'] == 0)
        $this->_sections['y']['show'] = false;
} else
    $this->_sections['y']['total'] = 0;
if ($this->_sections['y']['show']):

            for ($this->_sections['y']['index'] = $this->_sections['y']['start'], $this->_sections['y']['iteration'] = 1;
                 $this->_sections['y']['iteration'] <= $this->_sections['y']['total'];
                 $this->_sections['y']['index'] += $this->_sections['y']['step'], $this->_sections['y']['iteration']++):
$this->_sections['y']['rownum'] = $this->_sections['y']['iteration'];
$this->_sections['y']['index_prev'] = $this->_sections['y']['index'] - $this->_sections['y']['step'];
$this->_sections['y']['index_next'] = $this->_sections['y']['index'] + $this->_sections['y']['step'];
$this->_sections['y']['first']      = ($this->_sections['y']['iteration'] == 1);
$this->_sections['y']['last']       = ($this->_sections['y']['iteration'] == $this->_sections['y']['total']);
?>

				<?php if ($this->_sections['y']['first']): ?>
				<ul>
				<?php endif; ?>

					<?php if ($this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_parent'] == $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_level'] == '1'): ?>



						<li>
						<?php if ($this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['sum_child'] > 0): ?>

								 <ul id="xtraMenu<?php echo $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
">
								<li>
								<h4 class="head"><a href="javascript:;"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/<?php echo $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_normal_icon']; ?>
" border="0" class="pngfix" align="absmiddle" style="margin-right:4px;"><?php echo $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_label']; ?>
</a></h4>
								<?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_MENU_SUB_CHILD']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>
															<?php if ($this->_sections['q']['first']): ?>
															<ul>
															<?php endif; ?>

															<?php if ($this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_parent'] == $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_level'] == '2' && $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_parent'] == $this->_tpl_vars['DATA_MENU_PARENT'][$this->_sections['x']['index']]['menu_id']): ?>


																    	 <?php if ($this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['sum_child2'] > 0): ?>


																				<h4 class="head"> <li id="xtraMenu2<?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_id']; ?>
">  <a href="javascript:;"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/<?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_normal_icon']; ?>
" border="0" class="pngfix" align="absmiddle" style="margin-right:4px;"><?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_label']; ?>
</a></li></h4>


																				  <?php unset($this->_sections['z']);
$this->_sections['z']['name'] = 'z';
$this->_sections['z']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_MENU_SUB_CHILD2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['z']['show'] = true;
$this->_sections['z']['max'] = $this->_sections['z']['loop'];
$this->_sections['z']['step'] = 1;
$this->_sections['z']['start'] = $this->_sections['z']['step'] > 0 ? 0 : $this->_sections['z']['loop']-1;
if ($this->_sections['z']['show']) {
    $this->_sections['z']['total'] = $this->_sections['z']['loop'];
    if ($this->_sections['z']['total'] == 0)
        $this->_sections['z']['show'] = false;
} else
    $this->_sections['z']['total'] = 0;
if ($this->_sections['z']['show']):

            for ($this->_sections['z']['index'] = $this->_sections['z']['start'], $this->_sections['z']['iteration'] = 1;
                 $this->_sections['z']['iteration'] <= $this->_sections['z']['total'];
                 $this->_sections['z']['index'] += $this->_sections['z']['step'], $this->_sections['z']['iteration']++):
$this->_sections['z']['rownum'] = $this->_sections['z']['iteration'];
$this->_sections['z']['index_prev'] = $this->_sections['z']['index'] - $this->_sections['z']['step'];
$this->_sections['z']['index_next'] = $this->_sections['z']['index'] + $this->_sections['z']['step'];
$this->_sections['z']['first']      = ($this->_sections['z']['iteration'] == 1);
$this->_sections['z']['last']       = ($this->_sections['z']['iteration'] == $this->_sections['z']['total']);
?>

																						<?php if ($this->_tpl_vars['DATA_MENU_SUB_CHILD2'][$this->_sections['z']['index']]['menu_parent'] == $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_id'] && $this->_tpl_vars['DATA_MENU_SUB_CHILD2'][$this->_sections['z']['index']]['menu_level'] == '3' && $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_parent'] == $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_id']): ?>
																						<li> <a href="<?php echo $this->_tpl_vars['DATA_MODULE']; ?>
<?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD2'][$this->_sections['z']['index']]['menu_link']; ?>
?mod_id=<?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD2'][$this->_sections['z']['index']]['menu_id']; ?>
" target="mainFrame"> <?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD2'][$this->_sections['z']['index']]['menu_label']; ?>
  </a></li>

																						<?php endif; ?>
																				<?php endfor; endif; ?>

																	   <?php else: ?>

																			<li><a href="<?php if ($this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_link'] != ''): ?><?php echo $this->_tpl_vars['DATA_MODULE']; ?>
<?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_link']; ?>
?mod_id=<?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_id']; ?>
<?php endif; ?>" target="mainFrame"><?php echo $this->_tpl_vars['DATA_MENU_SUB_CHILD'][$this->_sections['q']['index']]['menu_label']; ?>
</a></li>



																	 <?php endif; ?>


															 <?php endif; ?>

															<?php if ($this->_sections['q']['last']): ?>
															</ul>
															<?php endif; ?>
									<?php endfor; endif; ?>
								 </li>
								</ul>

						<?php else: ?>

										<a href="<?php if ($this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_link'] != ''): ?><?php echo $this->_tpl_vars['DATA_MODULE']; ?>
<?php echo $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_link']; ?>
?mod_id=<?php echo $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
<?php endif; ?>" target="mainFrame"><?php echo $this->_tpl_vars['DATA_MENU_CHILD'][$this->_sections['y']['index']]['menu_label']; ?>
</a>

						<?php endif; ?>

						</li>



					<?php endif; ?>
				<?php if ($this->_sections['y']['last']): ?>
				</ul>
				<?php endif; ?>
		<?php endfor; endif; ?>

	</li>
	<?php endfor; endif; ?>

</ul>

<ul>

	<li><FORM  NAME="frmMenu" METHOD=POST ACTION="logout.php" target="_parent"><a class="menu-tree" HREF="javascript:document.frmMenu.submit();"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/lock.png" WIDTH="16" HEIGHT="16" BORDER="0" align="absmiddle" class="pngfix"> Keluar</A></FORM></li>
</ul>

</body>
</html>