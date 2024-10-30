var widgetsManager,loadInterval; 

widgetsManager = new Vue({
	el: '#elb-widgets-manager',
	http: {
        emulateJSON: true,
        emulateHTTP: true
    },
	data: {
		widgetsBundle : elbbc_data.widgetsBundle,
		widgetsActive : elbbc_data.widgetsActive,
		ajaxHandler : elbbc_data.ajax_handler,
		shownWidgets : [],
		//Filter Elements
		filter : {
			categoryActive : 'all',
			categories : {
				'all' 			: 'All Widgets',
				'content' 		: 'Content Widgets',
				'media' 		: 'Media Widgets',
				'slider' 		: 'Slider Widgets',
				'promoting' 	: 'Promoting Widgets',
				'fancy' 		: 'Fancy Widgets',
			},
			typeActive : 'all',
			typesWidgets : {
				'all' 			: 'Everything',
				'freemium' 		: 'Freemium',
				'premium' 		: 'Premium',
			},
			situationActive : 'all',
			situationWidgets : {
				'all' 			: 'All Widgets',
				'active' 		: 'Active Widgets',
				'inactive' 		: 'Inactive Widgets',
			},


		},

		//Loading Settings
		loading : {
			situation : 'inactive',
			type : 'none',
			percent : 0,
		}
	},
	mounted: function(){
		var self = this;
		self.shownWidgets = self.widgetsBundle;
		self.widgetsActive = self.widgetsActive.filter(Boolean);
	},
	methods: {
		//Searching a Widget by Name
		searchWidget : function() {
			var self = this;
			var searchText = window.event.currentTarget.value;
			if(searchText == '')
				self.filterListResult();
			else{
				var newArray = [];			
				self.shownWidgets.map(function(elm, index){
					if(elm.name.toLowerCase().includes(searchText.toLowerCase()))
						newArray.push(elm);					
				});				
				self.shownWidgets = newArray;
			}
		},
		//Change Situation of DOM Element
		changeSituation : function(type){
			var self = this;
			var elem = window.event.currentTarget;
			if(type == 'parent') elem = elem.parentElement;
			var situation = elem.getAttribute('data-situation') == 'inactive' ? 'active' : 'inactive';
			elem.setAttribute('data-situation',situation);
		},
		//Filter List Elements
		filterListResult : function(){
			var self = this;
			var newArray = [];	
			self.widgetsBundle.map(function(elm, index){
				if((elm.type == self.filter.typeActive || self.filter.typeActive == 'all') && (self.filter.categoryActive == 'all' || elm.categories.includes(self.filter.categoryActive))
					&& (self.filter.situationActive == 'all' || (self.filter.situationActive == 'active' && self.widgetsActive.includes(elm.id)) || (self.filter.situationActive == 'inactive' && !self.widgetsActive.includes(elm.id)))){					
					newArray.push(elm);					
				}
			});		
			self.shownWidgets = newArray;
		},
		//Change Filter
		filterChange : function(typeFilter, name){
			var self = this;
			if(typeFilter == 'category')
				self.filter.categoryActive = name;
			else if (typeFilter == 'typewidget')
				self.filter.typeActive = name;
			else if (typeFilter == 'situation')
				self.filter.situationActive = name;
			self.filterListResult();
		},
		//check if widget is enabled
		checkWidget : function(widgetID){
			var self = this;
			return (self.widgetsActive.includes(widgetID)) ? 'active' : 'inactive';
		},
		//Enable Single Widget
		enableSingleWidget : function(widgetID){
			var self = this;
			var index = self.widgetsActive.indexOf(widgetID);
			if(index > -1)
				self.widgetsActive.splice(index,1);
			else
				self.widgetsActive.push(widgetID);
		},
		//Save Changes 
		saveChangesWidgets : function(){
			var self = this;			
			self.loadingBarStart();			
			self.$http.post(self.ajaxHandler,{action: 'elbSaveActiveWidgets',widgetsActive : self.widgetsActive}).then(function(_ref) {                  
			    var data = _ref.data; 
				self.loadingBarEnd('success');
			});
		},
		//Enable & Disable Shown
		shownListSituation : function(type){
			var self = this;
			self.shownWidgets.map(function(elm, index){
				var id = elm.id;
				if(elm.type == 'freemium'){
					if(type == 'enable'){
						if(!self.widgetsActive.includes(id))
							self.widgetsActive.push(id)
					}
					if(type == 'disable'){
						if(self.widgetsActive.includes(id))
							self.widgetsActive.splice(self.widgetsActive.indexOf(id),1);
					}	
				}
			})
			//
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