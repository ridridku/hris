
/**
   BogoTabs is a rudimentary tabbed panels implementation for
   jQuery. It is "feature-lite" but also quite simple to use.

   ACHTUNG: this UI element does not degrade gracefully when JS is not
   available.

   It was inspired by the idTabs plugin, but i had problems with that
   plugin in the Konqueror browser and i find its overall technique a
   bit iffy because it uses implied tab identifiers instead of
   explicit ones, making the code more difficult to understand (IMO).

   BogoTabs is used like this:

   $(selector).initBogoTabs( { TAB_DEFINITIONS (see below) }, {options} );

   The $(selector) should resolve to a single element which is
   (ideally) empty. That element will become the parent element of the
   tabbed "panels".


   A tab definition looks like:

   '#TabID' : { label:'Tab Label' ...optional fields... }

   The .label field may contain HTML, but adding an A element to catch
   a click might interfere with the tab selection click handling. It
   is legal to use, e.g., an IMG element. If the label is not set (or evaluates
   to false) then no button is generated for navigating to this tab! This
   can be useful when you want to have certain tabs that are only activated
   via custom UI components.


   Optional fields for a tab definition:

   .selected = boolean. If this is set to a true value, that tab will
   be the one which gets initially selected. If multiple tabs define
   this, only the last one to define it is selected. If no tabs define
   it, the first tab is selected by default.

   .onhide = function(tabJQObject) is called just AFTER a tab is hidden,
   and is passed a jQuery object wrapping the tab.

   .onshow = function(tabJQObject) is called just AFTER a tab is shown,
   and is passed a jQuery object wrapping the tab.

   .onselect = function(tabJQObject) is called just before .onshow is
   (or would be) called, and it is passed the tab jQuery object which
   is about to be shown.

   Some care is taken to ensure that the .onXXX functions are not
   fired when re-selecting the currently active tab.

   The general options (2nd argument) are all optional:

   {

   activeLabelClass:'CSSClassNameForActiveLabel', // default='bogoTabsActiveLabel'

   inactiveLabelClass:'CSSClassNameForInactiveLabel' // default='bogoTabsInactiveLabel'

   }

   An example:
   ======================================================================

   $('#TabMarker1').initBogoTabs({
	'#Tab1': {
		label:'First Tab'
	},
	'#Tab2': {
		label:'Second Tab'
	},
	'#Tab3': {
		label:'Third Tab',
		onselect: function(tab){ tab.append("added by onselect() handler<br/>"); }
	}
    },{
        activeLabelClass:'activeTabLabel',
        inactiveLabelClass:'inactiveTabLabel'
    });

    ...

    <div id='#Tab1'>The first tab.</div>
    <div id='#Tab2'>The second tab.</div>
    <div id='#Tab3'>The third tab.</div>

   ======================================================================

   It is possible to programmatically activate a tab by doing:

   $('#MyTabID')[0].activateTab()


   That can be added to, e.g., an A or BUTTON element:

   <a href='#' onclick="$('#MyTab')[0].activateTab()">My tab</a>

   This is functionally equivalent to clicking on the tab header
   associated with the tab.

   When tabs are initialized, the following happens, in no specific
   order:

   a) Each tab label is added inside a new SPAN element directly
   BEFORE the tab container. Each SPAN gets a click handler installed
   which will trigger the tab switching process. The look/feel of
   these SPAN elements can be customized via the activeLabelClass and
   inactiveLabelClass options. If a tab's label is null then no SPAN
   is created, so the client is responsible for creating a button-like
   element for switching to the tab (unless the tab should always stay
   hidden).

   b) All tabs associated with the given IDs (from the tab
   definitions) are hidden and then appended, in the order of their
   definition, to the tab container. This means they can be defined
   anywhere in the HTML code, and they will be relocated during
   initialization.

   When a tab is selected ("activated"), the following happens:

   1) If tab is already selected, no side effects happen and
   processing stops here.

   2) Active tab is hidden, then onhide callback (if any) is called.

   3) The label associated with the selected tab has the
   options.activeLabelClass class added to it and the
   options.inactiveLabelClass class removed from it.

   4) The labels NOT associated with the selected tab have the
   options.activeLabelClass class removed from them and the
   options.inactiveLabelClass class added to them.

   5) The onselect callback, if any, is called for the new active
   tab.

   6) New tab is shown, then the onshow callback, if any, is called
   for the new active tab.


   BogoTabs home page:

   http://wanderinghorse.net/computing/javascript/jquery/bogotabs/

   License: Public Domain

   Author: stephan beal (http://wanderinghorse.net/home/stephan/)

   Terse revision history (newest at the top):

   20070725:
   - Fixed: returns 'this' to avoid breaking the call chain.
   - Fixed: plugin no longer attaches new properties to 'this' object,
   to avoid potential collisions with jQuery properties. It does
   add an activateTab() function to the *generated* DOM elements for
   the tab buttons, but not to their jQuery objects.

   20070716:
   - Removed .suppressButton option: that is now done by simply setting
     .label to null.

   20070715:
   - Added .suppressButton option.

   20070714:
   - Lots of internal refactoring/cleanups.
   - Added .onshow/.onhide support.
   - Can now programmatically activate a tab via tabElement.activateTab().
   - First release via the official JQ plugin repository.

   20070712: initial release
  ======================================================================
  TODO:

  - Consider re-doing the way the links are created, so that it will
  degrade gracefully. This probably isn't gonna happen, though.

  - CONSIDER (but not too seriously) calling the onhide handler for
  non-shown tabs at initialization-time. A reader in the jQuery group
  requested this feature in the Klaus Tabs, but i find it philosophically
  highly questionable.

  - Figure out how best to support nested tabs. Currently the tabs
  buttons of nested tabs are always visible.

*/

jQuery.fn.initBogoTabs = function( tabdefs, props ) {
	props = jQuery.extend({
		activeLabelClass:'bogoTabsActiveLabel',
		inactiveLabelClass:'bogoTabsInactiveLabel',
		debuggering:false
	}, props ? props : {});

	var dbgdiv = null;
	/** Internal debuggering function. */
	function dbg(msg) { if( dbgdiv ) dbgdiv.append("BogoTabs: "+msg+"<br/>"); };
	if( props.debuggering ) {
		this.after("<div id='bogoTabsDebugDiv'>BogoTabs debugging area<br/></div>");
		dbgdiv = jQuery('#bogoTabsDebugDiv');
		dbgdiv.css('border','1px dashed #000');
		dbg("debugging activated.");
	}

	/** Internal holder type to keep our scoping straight. */
	function TabsInnerHolder() {
		var self = this;
		self.buttons = []; // map: #TabID => jQ_tab_label_obj
		self.funcs = {}; // map: #TabID => { onselect:func,onshow:func,onhide:func}
		self.tabs = {}; // map: #TabID => jqTabObject
		self.currentTab = null; // tab jQ object
	};
	var holder = new TabsInnerHolder();
	/** Perform tab switch. tab='#TabIdentifier'. Always returns false. */
	holder.switchTabs = function(tabID) {
		if( tabID[0] != '#' ) tabID = '#'+tabID; // kludge
		var tab2show = holder.tabs[tabID];
		if( ! tab2show ) {
			throw new Error("bogotabs: internal error: could not find tab '"+tabID+"'.");
			// throwing is reportedly "Not the jQuery Way", but i really want to throw here.
		}
		dbg('switchTabs('+tabID+')');
		if( holder.currentTab )
		{
			var oldid = holder.currentTab.attr('id');
			if( '#'+oldid == tabID )
			{
				dbg("Skipping tab activation: tab '"+tabID+"' already active.");
				return false;
			}
			holder.currentTab.hide();
			var oh = holder.funcs['#'+oldid];
			if( oh.onhide ) {
				dbg("Calling onhide handler for tab "+ oldid+".");
				(oh.onhide)( holder.currentTab );
			}
		}
		for( var key in holder.buttons ) {
			var span = holder.buttons[key];
			if( ! span ) continue; // no label = no generated button
			if( key == tabID ) {
				span.removeClass(props.inactiveLabelClass)
				    .addClass(props.activeLabelClass);
			} else {
				span.removeClass(props.activeLabelClass)
				    .addClass(props.inactiveLabelClass);
			}
		}
		var funcs = holder.funcs[tabID];
		if( funcs.onselect ) {
			(funcs.onselect)(tab2show);
		}
		tab2show.show();
		if( funcs.onshow ) {
			dbg("Calling onshow handler for tab "+tabID+".");
			(funcs.onshow)(tab2show);
		}
		holder.currentTab = tab2show;
		return false;
	}; // switchTabs()

	var tab2select = null;
	for( var key in tabdefs ) {
		if( ! tab2select ) tab2select=key;
		var tab = jQuery(key);
		holder.tabs[key] = tab;
		var tabdef = tabdefs[key];
		if( tabdef['selected'] ) tab2select = key;
		tab.hide();
		this.append(tab);
		holder.funcs[key] = {
			'onselect': tabdef.onselect,
			'onshow': tabdef.onshow,
			'onhide': tabdef.onhide
		};
		tab[0].activateTab = function(){
 			dbg(key+": activateTab(): "+this.id);
 			return holder.switchTabs( this.id );
		};
		if( !tabdef['label'] ) { // create no button
			continue;
		}
		var lbl = jQuery("<span/>");
		holder.buttons[key] = lbl;
		lbl[0].tabElem = tab[0];
		lbl.html( tabdef['label'] ? tabdef['label'] : key )
			.css('cursor','pointer')
			.click(function(){
				return this.tabElem.activateTab();
			});
		this.before(lbl);
	}
	holder.switchTabs(tab2select);
	return this;
}; /* initBogoTabs() */
