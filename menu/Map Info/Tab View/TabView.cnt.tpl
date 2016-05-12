<script type="text/javascript" src="{$YuiRelatifPath}yui/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/connection/connection-min.js"></script> 
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/tabview/assets/skins/sam/tabview.css" />
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/element/element-beta-min.js"></script>
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/tabview/tabview-min.js"></script>
{literal}
<style type="text/css">
/* .yui-navset defaults to .yui-navset-top */
.yui-skin-sam .yui-navset .yui-nav,
.yui-skin-sam .yui-navset .yui-navset-top .yui-nav { /* protect nested tabviews from other orientations */
    border:solid #008837; /* color between tab list and content */
    border-width:0 0 5px;
    Xposition:relative;
    zoom:1;
}


.yui-skin-sam .yui-navset .yui-nav .selected a,
.yui-skin-sam .yui-navset .yui-nav .selected a:focus, /* no focus effect for selected */
.yui-skin-sam .yui-navset .yui-nav .selected a:hover { /* no hover effect for selected */
    background:#008837 url(images/sprite2.png) repeat-x left -1930px; /* selected tab background */
    color:#fff;
}

.yui-skin-sam .yui-navset .yui-content,
.yui-skin-sam .yui-navset .yui-navset-top .yui-content {
    border:1px solid #808080; /* content border */
    border-top-color:#243356; /* different border color */
    padding:0.25em 0.5em; /* content padding */
}

</style>
{/literal}

<div id="id_tab_view" class="yui-navset"></div>

{literal}    
<script type="text/javascript">
YAHOO.util.Event.onDOMReady(function (){
	var tabView = new YAHOO.widget.TabView('id_tab_view');
	var tabViewMenus = {/literal}{$popupTabViewMenus}{literal};

	for(var i=0; tabViewMenus && i<tabViewMenus.length; i++){
		var aContent = null;
		if(tabViewMenus[i].Ref.indexOf("?") == -1){
			aContent = '<iframe height="{/literal}{$height}{literal}px" id="iframe-center-'+ i +'" class="iframe-center" width="100%" src="?Menu=' + tabViewMenus[i].Ref + '" frameborder=0></iframe>';
		}else{
			aContent = '<iframe height="{/literal}{$height}{literal}px" id="iframe-center-'+ i +'" class="iframe-center" width="100%" src="' + tabViewMenus[i].Ref + '" frameborder=0></iframe>';
		}
		var aTab = new YAHOO.widget.Tab({
			label: tabViewMenus[i].Name,
			content: aContent,
			active: true
		});
		tabView.addTab(aTab);
	}
});				
</script>
{/literal}