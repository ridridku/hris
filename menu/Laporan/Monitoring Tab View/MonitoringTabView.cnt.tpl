<link rel="stylesheet" type="text/css" href="styles/layer-status.css" /> 
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/treeview/assets/skins/sam/treeview.css" /> 
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/connection/connection-min.js"></script> 
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/treeview/treeview-min.js"></script> 
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



<!--<div id="right1"><iframe height="{$rightMenuHeight}px" width="100%" src="?Menu={$rightMenu}" frameborder="0"></iframe></div>-->

<div id="left1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
{literal}    
<script type="text/javascript">
YAHOO.example.treeExample = function() {

    var tree, currentIconMode;

    function changeIconMode() {
        var newVal = parseInt(this.value);
        if (newVal != currentIconMode) {
            currentIconMode = newVal;
        }
        buildTree();
    }
	var drawTree = function () {		
		YAHOO.telesat.tree.draw();
		setTimeout(drawTree, 10000);
	}
	var cekStatusNode = function (aNode) {		
	   var callbackCekStatus = {
		   success: function(oResponse) {
				YAHOO.log("XHR transaction was successful.", "info", "status");
				YAHOO.log(oResponse.responseText, "info", "status");
				var oResults = eval("(" + oResponse.responseText + ")");
//				if(oResults && oResults.statusSeverity)aNode.labelStyle = oResults.statusSeverity;
				//YAHOO.telesat.tree.draw(); tidak perlu dilakukan karena sudah ada timer yg otomatis merefresh 30 second sekali
				setTimeout(step, aNode.requestStatusMsInterval);
			},
			failure: function(oResponse) {
				YAHOO.log("Failed to process XHR transaction.", "info", "status");
			},
			 argument: {
				"node": aNode
			},
			timeout: 3000000
		};
		/*var step = function () {
			YAHOO.util.Connect.asyncRequest('GET', "?Menu=" + aNode.requestStatusMenu, callbackCekStatus);
		};
		setTimeout(step, aNode.requestStatusMsInterval);*/
	}	 
        function loadNodeData(node, fnLoadComplete)  {
		   if(node.requestChildsMenu == null || node.requestChildsMenu == ''){
		   		fnLoadComplete();
		   		return;
		   }		
		/*   
           var callback = {
               success: function(oResponse) {
                    YAHOO.log("XHR transaction was successful.", "info", "Tree");
                    YAHOO.log(oResponse.responseText, "info", "Tree");
                    var oResults = eval("(" + oResponse.responseText + ")");
					
					if(oResults.nama != null){
						for(var i=0; i<oResults.nama.length; i++){
							var tempNode = new YAHOO.widget.TextNode(
								{
									label:oResults.nama[i], 
									title:oResults.title && oResults.title[i] != null ? oResults.title[i] : null
								}, 
								node, 
								false
							);

							//copy tab view
							if(oResults.tabViewMenus)tempNode.tabViewMenus = oResults.tabViewMenus[i];
								
							tempNode.nama = oResults.nama[i];
							tempNode.requestChildsMenu = 
								oResults.requestChildsMenu && 
								oResults.requestChildsMenu[i] != null ? oResults.requestChildsMenu[i] : null;
							tempNode.requestStatusMenu = 
								oResults.requestStatusMenu && 
								oResults.requestStatusMenu[i] != null ? oResults.requestStatusMenu[i] : null;
							tempNode.requestStatusMsInterval = 
								oResults.requestStatusMsInterval && 
								oResults.requestStatusMsInterval[i] != null ? oResults.requestStatusMsInterval[i] : 30000;
							tempNode.isLeaf = (oResults.requestChildsMenu == null ? true : false);
							tempNode.isLeaf = tempNode.isLeaf || (oResults.requestChildsMenu[i] == "" ? true : false);
							tempNode.isLeaf = tempNode.isLeaf || (oResults.requestChildsMenu[i] == null ? true : false);
							tempNode.labelStyle = oResults.statusSeverity != null ? oResults.statusSeverity[i] : null;

							cekStatusNode(tempNode);
						}
					}
                    oResponse.argument.fnLoadComplete();
                },
                failure: function(oResponse) {
                    YAHOO.log("Failed to process XHR transaction.", "info", "Tree");
                    oResponse.argument.fnLoadComplete();
                },
                 argument: {
                    "node": node,
                    "fnLoadComplete": fnLoadComplete
                },
                timeout: 30000000
            };

           YAHOO.util.Connect.asyncRequest('GET', "?Menu=" + node.requestChildsMenu, callback); 
		*/
        }

        function buildTree() {
           YAHOO.telesat.tree = new YAHOO.widget.TreeView("treeDiv1");
		   YAHOO.telesat.tree.subscribe("expandComplete", function(aNode) {
		   		YAHOO.telesat.tree.selectedNode = aNode;
		   });
		   YAHOO.telesat.tree.subscribe("collapseComplete", function(aNode) {
		   		YAHOO.telesat.tree.selectedNode = aNode;
		   });
		   YAHOO.telesat.tree.subscribe("labelClick", function(aNode) { 
				var elements = Dom.getElementsByClassName('iframe-center', 'iframe');
				var tabY = 0;
				for(var anEl=0; anEl<elements.length; anEl++){
					if(elements[anEl] && Dom.getY(elements[anEl]) > 0)tabY = Dom.getY(elements[anEl]);
				}

			   	var tabView = new YAHOO.widget.TabView('id_tab_view');
			   	while(aNode.tabViewMenus && tabView.getTab(0))tabView.removeTab(tabView.get('activeTab')); 

			   	for(var i=0; aNode.tabViewMenus && i<aNode.tabViewMenus.length; i++){
					var aContent = null;
					if(aNode.tabViewMenus[i].Ref.indexOf("?") == -1){
						aContent = '<iframe id="iframe-center-'+ i +'" class="iframe-center" width="100%" src="?Menu=' + aNode.tabViewMenus[i].Ref + '" frameborder=0></iframe>';
					}else{
						aContent = '<iframe id="iframe-center-'+ i +'" class="iframe-center" width="100%" src="' + aNode.tabViewMenus[i].Ref + '" frameborder=0></iframe>';
					}
					var aTab = new YAHOO.widget.Tab({
						label: aNode.tabViewMenus[i].Name,
						content: aContent,
						active: true
					});
					tabView.addTab(aTab);
			   	}

				var elements = Dom.getElementsByClassName('iframe-center', 'iframe');
				var tabY = 0;
				for(var anEl=0; anEl<elements.length; anEl++){
					if(elements[anEl] && Dom.getY(elements[anEl]) > 0)tabY = Dom.getY(elements[anEl]);
				}
				for(var anEl=0; anEl<elements.length; anEl++){
					Dom.setStyle(elements[anEl], 'height', (Dom.getDocumentHeight()- tabY - 25 - 8) + 'px');
				}

		   		YAHOO.telesat.tree.selectedNode = aNode;
		   });

           YAHOO.telesat.tree.setDynamicLoad(loadNodeData, currentIconMode);
           var root = YAHOO.telesat.tree.getRoot();
           
		   var node = new YAHOO.widget.TextNode("", root, false);
{/literal}
//		   node.requestChildsMenu = "{$root_requestChildsMenu}";
		   node.tabViewMenus ={$root_tabViewMenus};
//		   node.nama = "Indonesia";
//		   node.labelStyle = "{$root_statusSeverity}";
//		   node.requestStatusMenu = "{$root_requestStatusMenu}";
//		   node.requestStatusMsInterval = "{$root_requestStatusMsInterval}";

		   YAHOO.telesat.tree.selectedNode = node;
{literal}



           YAHOO.telesat.tree.draw();
		   setTimeout(drawTree, 10000);

		   cekStatusNode(node);

			var Dom = YAHOO.util.Dom;
			var Event = YAHOO.util.Event;
			
/*			Event.on(window, 'resize', function() {
				var elements = Dom.getElementsByClassName('iframe-center', 'iframe');
				var tabY = 0;
				for(var anEl=0; anEl<elements.length; anEl++){
					if(elements[anEl] && Dom.getY(elements[anEl]) > 0)tabY = Dom.getY(elements[anEl]);
				}
				for(var anEl=0; anEl<elements.length; anEl++){
					Dom.setStyle(elements[anEl], 'height', (Dom.getDocumentHeight()- tabY - 25 - 8) + 'px');
				}
			}, this, true);	 */
		   
		   
		   	var Dom = YAHOO.util.Dom;
		   	var tabView = new YAHOO.widget.TabView({orientation: "top"});
			for(var i=0; i<node.tabViewMenus.length; i++){
				var aContent = null;
				if(node.tabViewMenus[i].Ref.indexOf("?") == -1){
					aContent = '<iframe id="iframe-center-'+ i +'" class="iframe-center" width="100%" src="?Menu=' + node.tabViewMenus[i].Ref + '" frameborder=0></iframe>';
				}else{
					aContent = '<iframe id="iframe-center-'+ i +'" class="iframe-center" width="100%" src="' + node.tabViewMenus[i].Ref + '" frameborder=0></iframe>';
				}
				tabView.addTab( new YAHOO.widget.Tab({
        			label: node.tabViewMenus[i].Name,
        			content: aContent,
        			active: true
    			}));
		   	}
		   	tabView.appendTo('id_tab_view');

			var elements = Dom.getElementsByClassName('iframe-center', 'iframe');
			var tabY = 0;
			for(var anEl=0; anEl<elements.length; anEl++){
				if(elements[anEl] && Dom.getY(elements[anEl]) > 0)tabY = Dom.getY(elements[anEl]);
			}
			for(var anEl=0; anEl<elements.length; anEl++){
				Dom.setStyle(elements[anEl], 'height', (Dom.getDocumentHeight()- tabY - 25 - 8) + 'px');
			}
        }
	

    return {
        init: function() {
            YAHOO.util.Event.on(["mode0", "mode1"], "click", changeIconMode);
            var el = document.getElementById("mode1");
            if (el && el.checked) {
                currentIconMode = parseInt(el.value);
            } else {
                currentIconMode = 0;
            }

            buildTree();
        }

    }
} ();

YAHOO.util.Event.onDOMReady(YAHOO.example.treeExample.init);
</script>
{/literal}	      <tr>
        <td></td>
        <td>
		<!--<div class="treeNav" id="dashboardDiv">-->
		         
		<div class="yui-content">
			<div class="treeNav" id="treeDiv1" style="height:100%"></div>
		</div>
		</div>


				  
		</td>
		
        <td></td>
        </tr>
    </table>
    </td>
  </tr>
</table>

</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr valign="top" align="left">
                    <td>
						<div id="id_tab_view" class="yui-navset"></div>
					</td>
                  </tr>
                </tbody>
            </table></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
