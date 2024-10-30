var extensionsManager,loadInterval; 

extensionsManager = new Vue({
	el: '#elb-extensions-manager',
	http: {
        emulateJSON: true,
        emulateHTTP: true
    },
	data: {
		extensionsBundle : elbbc_data.extensionsBundle,
		extensionsActive : elbbc_data.extensionsActive,
		ajaxHandler : elbbc_data.ajax_handler,
		shownExtensions : [],
		//Loading Settings
		loading : {
			situation : 'inactive',
			type : 'none',
			percent : 0,
		}
	},
	mounted: function(){
		var self = this;
		self.shownExtensions = self.extensionsBundle;
		self.extensionsActive = self.extensionsActive.filter(Boolean);
	},
	methods: {		
		//Change Situation of DOM Element
		changeSituation : function(type){
			var self = this;
			var elem = window.event.currentTarget;
			if(type == 'parent') elem = elem.parentElement;
			var situation = elem.getAttribute('data-situation') == 'inactive' ? 'active' : 'inactive';
			elem.setAttribute('data-situation',situation);
		},
		
		//check if widget is enabled
		checkExtension : function(widgetID){
			var self = this;
			return (self.extensionsActive.includes(widgetID)) ? 'active' : 'inactive';
		},
		//Enable Single Extension
		enableSingleExtension : function(widgetID){
			var self = this;
			var index = self.extensionsActive.indexOf(widgetID);
			if(index > -1)
				self.extensionsActive.splice(index,1);
			else
				self.extensionsActive.push(widgetID);
		},
		//Save Changes 
		saveChangesExtensions : function(){
			var self = this;			
			self.loadingBarStart();			
			self.$http.post(self.ajaxHandler,{action: 'elbSaveActiveExtensions',extensionsActive : self.extensionsActive}).then(function(_ref) {                  
			    var data = _ref.data; 
				self.loadingBarEnd('success');
			});
		},

		//LOADING FUNCTIONS
		//Loading Bar Width Change
        loadingBarStart : function(){
            var self = this;
            self.loading.type = 'loading';
			self.loading.situation = 'active';
            var maxLoad = 30;
            loadInterval = setInterval(function(){     
                maxLoad = (self.loading.percent < 70) ? 30 : 2;            
                if( self.loading.percent <= 92)
                    self.loading.percent +=  Math.floor(Math.random() * Math.floor(maxLoad));
                else
                    clearInterval(loadInterval);
            }, 400);
        },
        loadingBarEnd : function(message){
            var self = this;
            self.loading.percent = 100;
            setTimeout(function(){ self.loading.type = message; }, 300);
            setTimeout(function(){self.loading.situation = 'inactive';},3500);
        },        
        loadingBarClose : function(){
        	this.loading.situation = 'inactive';
        },

        purchaseElementorPopup : function(){
        	var ctnPopup = document.getElementById('elbd-pprim-ctn');
        	ctnPopup.setAttribute('data-situation','active');
        	setTimeout(function(){
	        	ctnPopup.setAttribute('data-situation','inactive');
        	},15000);
        },
        purchaseElementorPopupClose : function(){
        	var ctnPopup = document.getElementById('elbd-pprim-ctn');
        	ctnPopup.setAttribute('data-situation','inactive');
        }

	}

});