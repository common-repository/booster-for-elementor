var aboutPlugin,loadInterval; 

aboutPlugin = new Vue({
	el: '#elb-about-plugin',
	http: {
        emulateJSON: true,
        emulateHTTP: true
    },
	data: {	
        //Ac
        activeSection : 'about',
		//Loading Settings
		loading : {
			situation : 'inactive',
			type : 'none',
			percent : 0,
		},
		//Dialog Confirm Settings
		dialog : {
			situation : 'none',
			action : null,
			dialogData : null
		}
	},
	mounted: function(){
		var self = this;
	},
	methods: {
		//Change the Active Section
        changeSection : function(sectionName){
            this.activeSection = sectionName;
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
            setTimeout(function(){self.loading.type = message;}, 300);
            setTimeout(function(){self.loading.situation = 'inactive';},3500);
        },
        loadingBarClose : function(){
        	this.loading.situation = 'inactive';
        },
        //DIALOG FUNCTIONS
    	dialogSetAction : function(situation,action,dialogData){
    		this.dialog.situation = situation;
			this.dialog.action = action;
			this.dialog.dialogData = dialogData;			
    	},
    	dialogComfirm : function(){
    		if(this.dialog.action != null){
    			if(this.dialog.action == 'removeIconSet')
    				this.removeIconSet(this.dialog.dialogData);
    			if(this.dialog.action == 'removeIconsFromSet')
    				this.removeIconsFromSet();
    		}
    		this.dialogSetAction('inactive',null,null);
    	},
	}

});