<link rel="stylesheet" type="text/css" href="styles/layer-status.css" /> 
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/logger/assets/skins/sam/logger.css" />
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/treeview/assets/skins/sam/treeview.css" /> 
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/connection/connection-min.js"></script> 
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/logger/logger-min.js"></script>
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/treeview/treeview-debug.js"></script>
<!--<script type="text/javascript" src="{$YuiRelatifPath}yui/build/treeview/treeview-min.js"></script> -->
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/tabview/assets/skins/sam/tabview.css" />
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/element/element-beta-min.js"></script>
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/tabview/tabview-min.js"></script>
<script type="text/javascript" src="{$YuiRelatifPath}yui/examples/treeview/assets/js/TaskNode.js"></script>

<script type="text/javascript" src="{$YuiRelatifPath}yui/build/connection/connection-min.js"></script> 
<link rel="stylesheet" type="text/css" href="{$YuiRelatifPath}yui/build/container/assets/skins/sam/container.css" />
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/utilities/utilities.js"></script>
<script type="text/javascript" src="{$YuiRelatifPath}yui/build/container/container-min.js"></script>


{section name=idx loop=$cssfile}
	<link rel="stylesheet" type="text/css" href="{$cssfile[idx].fname}"/>
{/section}

{literal}
<style type="text/css">

/**
	style checked tree
*/
.ygtvcheck0 { background: url({/literal}{$YuiRelatifPath}{literal}yui/examples/treeview/assets/img/check/check0.gif) 0 0 no-repeat; width:16px; cursor:pointer }
.ygtvcheck1 { background: url({/literal}{$YuiRelatifPath}{literal}yui/examples/treeview/assets/img/check/check1.gif) 0 0 no-repeat; width:16px; cursor:pointer }
.ygtvcheck2 { background: url({/literal}{$YuiRelatifPath}{literal}yui/examples/treeview/assets/img/check/check2.gif) 0 0 no-repeat; width:16px; cursor:pointer }

/**
 * Map Examples Specific
 */
 body {
    font-family: "Lucida Grande", Verdana, Geneva, Lucida, Arial, Helvetica, sans-serif;
    font-size: 80%;
    color: #222;
    background: #fff;
    margin: 0em 0em;
}
.smallmap {
    width: 100%;
    height: 256px;
    border: 0px solid #ccc;
}
#tags {
    display: none;
}</style>
    <script src="ext/OpenLayers/lib/OpenLayers.js"></script>
	<style type="text/css">
		/* Information */
		.olControlNavToolbar .olControlInformationItemActive { 
		  background-image: url("images/toolbar/info-on.png");
		  background-color: orange;
		  background-repeat: no-repeat;
		}
		.olControlNavToolbar .olControlInformationItemInactive { 
		  background-image: url("images/toolbar/info-off.png");
		  background-repeat: no-repeat;
		}
	</style>

    <script src="ext/OpenLayers/lib/OpenLayers/Control/Information.js"></script>
	<script type="text/javascript">
        // making this a global variable so that it is accessible for
        // debugging/inspecting in Firebug
        var map = null;
	</script>		
    <script type="text/javascript">
		var urlWmsServer = "{/literal}{$urlMapServer}{literal}?map={/literal}{$spasialPath}{literal}/country.map&srs=EPSG:32748&";
		var layers = {/literal}{$layers}{literal};
		
		function serialize(feature) {
			var centroid = feature.geometry.getCentroid();
			var popup = new OpenLayers.Popup("chicken",
				new OpenLayers.LonLat(centroid.x, centroid.y),
				new OpenLayers.Size(370,300),
				null,
			true);
			popup.keepInMap = true;
			popup.setBackgroundColor("#f2f2f2");
			popup.setBorder("1px solid #cccccc");
			popup.setContentHTML('<iframe  style="background-color:#f2f2f2" width="100%" height="300px" src="?Menu=' + feature.popupRef  + '" frameborder=0></iframe>');
			map.addPopup(popup);
			popup.show();
        }
		
		function addMarker(layerName, lon, lat, caption, popupRef) {
			var markers = map.getLayersByName(layerName);
			if(markers.length == 0){
				var l = new OpenLayers.Layer.Markers(layerName);
				map.addLayer(l);
				markers = map.getLayersByName(layerName);
			}
			var layers = map.getLayersByName('Indonesia');
			feature = new OpenLayers.Feature(layers[0], new OpenLayers.LonLat(lon, lat));
			marker = feature.createMarker();
			markers[0].addMarker(marker);
			marker.events.register("mousedown", marker, function mousedown(evt) {
				var popup = new OpenLayers.Popup("chicken", 
					new OpenLayers.LonLat(lon,lat),
					new OpenLayers.Size(370,300),
					null,
					true);
				popup.keepInMap = true;
				popup.setBackgroundColor("#f2f2f2");
				popup.setBorder("1px solid #cccccc");
				popup.setContentHTML('<iframe  style="background-color:#f2f2f2" width="100%" height="300px" src="?Menu=' + popupRef  + '" frameborder=0></iframe>');
				popup.toggle();
				map.addPopup(popup);
				popup.toggle();
				OpenLayers.Event.stop(evt);
			});												 
		};
		
        function init(){
			var information = new OpenLayers.Control.Information("{/literal}{$RequestMapServerMenu}{literal}" );
		
			var navToolbar = new OpenLayers.Control.NavToolbar();
			navToolbar.addControls([information]);

			var vlayer = new OpenLayers.Layer.Vector( "Editable" );
			var nav = new OpenLayers.Control.NavigationHistory();
			panel = new OpenLayers.Control.Panel({'displayClass': 'olControlNavigationHistory'});
			panel.addControls([nav.next, nav.previous]);
            map = new OpenLayers.Map('map', 
                 {
                    controls: [
						new OpenLayers.Control.OverviewMap(),
						information, 
						panel,
						nav,
						new OpenLayers.Control.LayerSwitcher(),
                        navToolbar,
						new OpenLayers.Control.PanZoom(),
						new OpenLayers.Control.EditingToolbar(vlayer),
						new OpenLayers.Control.Scale(), 
						new OpenLayers.Control.ScaleLine(),
						new OpenLayers.Control.MousePosition(),
						new OpenLayers.Control.KeyboardDefaults(),
						new OpenLayers.Control.Attribution()
                    ] 
                }
			);

		 	map.addLayer(vlayer);
			map.addLayer(
				new OpenLayers.Layer.WMS(
					"Indonesia", urlWmsServer, 
					{layers: 'Negara', format: 'image/png'},
					{
					  'attribution': 'Provided by Direktorat Bina Marga',	
					  singleTile: true, 	
					  maxExtent: new OpenLayers.Bounds(101.06326, -2.96252, 104.51445, -0.69521), 
					  maxResolution: 'auto', 
					  units: "dd",
					  displayOutsideMaxExtent: false, 
					  alwaysInRange: false,
					  isBaseLayer: true
					}
				)
			);

			for(var aLayer=0; aLayer<layers.length; aLayer++){
				var server = "{/literal}{$urlMapServer}{literal}?map="+ layers[aLayer].mapFile +"&srs=EPSG:32748&";
				var l = new OpenLayers.Layer.WMS(
					layers[aLayer].description, server, 
					{layers: layers[aLayer].name, transparent: 'true', format: 'image/png'}, 
					{singleTile: true, maxResolution: 'auto', units: "dd", visibility: layers[aLayer].visibility}
				);
				l.server = "{/literal}{$urlMapServer}{literal}?map="+ layers[aLayer].mapFile;
				l.mapFile = layers[aLayer].mapFile;
				map.addLayer(l);
			}	
			
			map.zoomToMaxExtent();
        }
		
		
		var Dom = YAHOO.util.Dom;
		var Event = YAHOO.util.Event;
		function OnResize(){
			var footerHeight = parseInt(Dom.getStyle('footer', 'height'), 10);
			if(!footerHeight)footerHeight = 0;
			Dom.setStyle('map', 'height', (Dom.getViewportHeight() - Dom.getY('map') - footerHeight - 2) + 'px');

		}
		Event.on(window, 'resize', function() {OnResize();}, this, true);	
		Event.onDOMReady(function() {
			OnResize();
			init();
		});
		
		Event.onDOMReady(function(){
			YAHOO.layout.getUnitByPosition('left').on('expand', function() {
				map.updateSize();
            });
			YAHOO.layout.getUnitByPosition('left').on('collapse', function() {
                map.updateSize();
            });
		});
	{/literal}
    </script>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="map" class="smallmap"></div></td>
  </tr>
</table>	

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
		function onCheckClickChildren(nodes){
			for(var i=0, l=nodes.length; i<l; i=i+1) {
				var n = nodes[i];
				n.onCheckClick();
				onCheckClickChildren(n.children);
			}
		}
        function loadNodeData(node, fnLoadComplete)  {
		   if(node.data.requestChildsMenu == ''){
		   		fnLoadComplete();
		   		return;
		   }		
		   
           var callback = {
               success: function(oResponse) {
                    YAHOO.log("XHR transaction was successful.", "info", "Tree");
                    YAHOO.log(oResponse.responseText, "info", "Tree");
                    var oResults = eval("(" + oResponse.responseText + ")");
					for(var i=0; i<oResults.data.length; i++){
						if(oResults.data[i].isSymbology){
							var tempNode = new YAHOO.widget.TextNode(
								{
									label:oResults.data[i].description, 
									title:oResults.data[i].title
								}, 
								node, 
								false
							);
						}else{
							var tempNode = new YAHOO.widget.TaskNode(
								{
									label:oResults.data[i].description, 
									title:oResults.data[i].title,
									checked:(oResults.data[i].visibility == 1 ? true:false)
								}, 
								node, 
								false
							);
						}
						tempNode.data = oResults.data[i];
						tempNode.isLeaf = oResults.data[i].isLeaf;
						tempNode.labelStyle = oResults.data[i].statusSeverity;
						if(!oResults.data[i].isSymbology){
							tempNode.onCheckClick = function() {
								if(this.data.hasChildMap){
									onCheckClickChildren(this.children);
									return;
								}
								if(this.checkState == 2){
									var layers = map.getLayersByName(this.data.description);
									if(layers.length == 0 && this.data.menuRequestPoint){
										var request = YAHOO.util.Connect.asyncRequest(
											'POST', 
											'?Menu=' + this.data.menuRequestPoint, 
											{
												success:function(o){
													var oResults = eval("(" + o.responseText + ")");
													for(var i=0; i<oResults.length; i++){
														addMarker(
															o.argument.sender.data.description, 
															oResults[i].gps_lon, 
															oResults[i].gps_lat, 
															oResults[i].description, 
															oResults[i].popupRef
														);
													}
													
												},
												failure:function(o){},
												argument:{ sender:this } 
											}
										);
									}else if(layers.length == 0 && this.data.menuRequestGoeFormatWkt){
										var request = YAHOO.util.Connect.asyncRequest(
											'POST', 
											'?Menu=' + this.data.menuRequestGoeFormatWkt, 
											{
												success:function(o){
													var oResults = eval("(" + o.responseText + ")");

													vectors = new OpenLayers.Layer.Vector(o.argument.sender.data.description);
													wkt = new OpenLayers.Format.WKT({
														'internalProjection': map.baseLayer.projection,
														'externalProjection': map.baseLayer.projection
													});
													for(var i=0; i<oResults.length; i++){
														var features = wkt.read(oResults[i].wkt);
														alert(YAHOO.lang.dump(oResults[i].wkt));
														var style_blue = OpenLayers.Util.extend({}, OpenLayers.Feature.Vector.style['default']);
														style_blue.strokeColor = oResults[i].color;
														style_blue.fillColor = oResults[i].color;
														features.style = style_blue;
														
														features.popupRef = oResults[i].popupRef;
														vectors.addFeatures(features);
														if(features.popupRef != null){
															var options = {
																hover: false,
																onSelect: serialize
															};
															var select = new OpenLayers.Control.SelectFeature(vectors, options);
															map.addControl(select);
															select.activate();
														}
													}
													map.addLayer(vectors);
													
												},
												failure:function(o){},
												argument:{ sender:this } 
											}
										);
									}else{
										if(layers.length == 0){	
											//tidak masuk kesini
											map.addLayers([
												new OpenLayers.Layer.WMS(
													this.data.description, urlWmsServer, 
													{layers: this.data.nama, transparent: 'true'}, 
													{maxResolution: 'auto', units: "dd", visibility: true}
												)							
											]);
										}else{
											layers[0].setVisibility(true);
										}
									}
								}
								else if(this.checkState == 0){
									var layers = map.getLayersByName(this.data.description);
									if(layers.length > 0)layers[0].setVisibility(false);
								}	
							}
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

           YAHOO.util.Connect.asyncRequest('GET', "?Menu=" + node.data.requestChildsMenu, callback);

        }

        function buildTree() {
           YAHOO.telesat.tree = new YAHOO.widget.TreeView("treeDiv1");
		   YAHOO.telesat.tree.subscribe("expandComplete", function(aNode){});
		   YAHOO.telesat.tree.subscribe("collapseComplete", function(aNode){});

           YAHOO.telesat.tree.setDynamicLoad(loadNodeData, currentIconMode);
           var root = YAHOO.telesat.tree.getRoot();
           
		   var node = new YAHOO.widget.TaskNode({label:"Informasi Layer", checked:false}, root, true, false);
		   node.onCheckClick = function() {
		   		onCheckClickChildren(this.children);
		   }
		   node.data = {
{/literal}
		   		requestChildsMenu : "{$root_requestChildsMenu}", 
				nama : "Indonesia", 
				labelStyle : "{$root_statusSeverity}",
				requestStatusMenu : "{$root_requestStatusMenu}", 
				requestStatusMsInterval : "{$root_requestStatusMsInterval}"
{literal}
		   };
		   node.labelStyle = node.data.labelStyle;

           YAHOO.telesat.tree.draw();
		   setTimeout(drawTree, 10000);

        }


    return {
        init: function() {
            buildTree();
        }

    }
} ();

YAHOO.util.Event.onDOMReady(YAHOO.example.treeExample.init);
</script>
{/literal}	      <tr>
        <td></td>
        <td>
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