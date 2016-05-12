function HttpClient() {}
  HttpClient.prototype = {
     requestType:'GET',
     isAsync:false,
     xmlhttp:false,
     callback:false,
     onSend:function(){},
     onload:function(){},
     onError:function(error) {
         alert(error);
     },
     init:function() {
       try {
            this.xmlhttp = new XMLHttpRequest();
       } catch (e) {
           var XMLHTTP_IDS = new Array('MSXML2.XMLHTTP.5.0',
                                     'MSXML2.XMLHTTP.4.0',
                                     'MSXML2.XMLHTTP.3.0',
                                     'MSXML2.XMLHTTP',
                                     'Microsoft.XMLHTTP');
           var success = false;
           for (var i=0;i < XMLHTTP_IDS.length &&
             !success; i++) {
               try {
                   this.xmlhttp = new ActiveXObject
                     (XMLHTTP_IDS[i]);
                   success = true;
               } catch (e) {}
           }
           if (!success) {
               this.onError('Unable to create XMLHttpRequest.');
           }
        }
     },
    makeRequest:function(url,payload) {
      try {
         if (!this.xmlhttp) {
             this.init();
         }
         this.xmlhttp.open(this.requestType,url,this.isAsync);
         var self = this;
         this.xmlhttp.onreadystatechange = function() {
        self._readyStateChangeCallback(); }
         this.xmlhttp.send(payload);

         if (!this.isAsync) {
             return this.xmlhttp.responseText;
         }
      }
      catch (errorInfo) {}
      finally {}		
    },
    _readyStateChangeCallback:function() {
         switch(this.xmlhttp.readyState) {
              case 2:
               this.onSend();
               break;
            case 4:
               this.onload();
               if (this.xmlhttp.status == 200) {
                   this.callback(this.xmlhttp.responseText);
               } else {
                   this.onError('HTTP Error Making Request: '+ '['+this.xmlhttp.status+']'+ this.xmlhttp.statusText);
               }
               break;
         }
    }
  }

  var gClient = new HttpClient();
function _remoteCall(server, data,callback){
  gClient.isAsync = true;
  gClient.requestType = 'POST';
  gClient.callback = callback;
  gClient.makeRequest(server, data);
 }

function SavePageToServer(server){
	var parenElm = document.body.parentNode;
	//alert(parenElm.innerHTML);
 	_remoteCall(
		server, 
		parenElm.innerHTML,
        function(str) {
			if(str != "")alert(str);
      }
    );
}  