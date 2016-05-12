	var enableCache = false;
	var jsCache = new Array();
	var AjaxObjects = new Array();

	function ShowContent(divId,ajaxIndex,url)
	{
		document.getElementById(divId).innerHTML = AjaxObjects[ajaxIndex].response;
		if(enableCache){
			jsCache[url] = 	AjaxObjects[ajaxIndex].response;
		}
		AjaxObjects[ajaxIndex] = false;
	}

	function Ajax(divId,url)
	{
		if(enableCache && jsCache[url]){
			document.getElementById(divId).innerHTML = jsCache[url];
			return;
		}	
		var ajaxIndex = AjaxObjects.length;
		document.getElementById(divId).innerHTML = 'Processing ...  ';
		AjaxObjects[ajaxIndex] = new sack();
		AjaxObjects[ajaxIndex].requestFile = url;
		AjaxObjects[ajaxIndex].onCompletion = function(){ ShowContent(divId,ajaxIndex,url); };
		AjaxObjects[ajaxIndex].runAJAX();
	}
