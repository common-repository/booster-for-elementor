var iconsList = localStorage.getItem("elbIcons"); 
var objectsList = localStorage.getItem("elbObjects"); 

jQuery( window ).on( 'elementor:init', function() {
	jQuery('body').attr('data-booster-scheme',plugindir.schemeEnabled);
	elementor.hooks.addAction( 'panel/open_editor/widget/elb-pricebox-widget', function( panel, model, view ) {
	   	$("select").on("select2:select", function (evt) {
		    var element = evt.params.data.element;
		    var $element = $(element);
		    window.setTimeout(function () {  
		      if ($("select").find(":selected").length > 1) {
		        var $second = $("select").find(":selected").eq(-2);
		        $element.detach();
		        $second.after($element);
		      } 
		      else {
		        $element.detach();
		        $("select").prepend($element);
		      }

		      $("select").trigger("change");
		    }, 1);
		});
	   $("select").on("select2:unselect", function (evt) {
		    var element = evt.params.data.element;
		    $("select").append(element);
		});

	});
	

	//Icon Chooser Control
	const ControlIconChooser = elementor.modules.controls.BaseData.extend( {
		onReady: function() {
			var  self = this;
			var me = jQuery(this.ui.input);
			self.loadIconAjax(me);
		},
		saveValue: function() {
			this.setValue(this.ui.input.val());
		},
		onBeforeDestroy: function() {
			this.saveValue();
		},
		printIconChoosed : function(icon){
			var me = jQuery(this.ui.input);
			var pr = me.parents('.elb-ichs-ctn');
			var iconHTML = pr.find('.elb-ichs-list').find('.elb-ichs-icon[data-iconid="'+icon+'"]').html();
			pr.find('.elb-ichs-icon-real').html(iconHTML);
			pr.find('.elb-ichs-icon-real').attr({'title':icon});
		},
		printIconList : function(iconsList){
			var iconListHtml = '';
			iconListHtml += '<div class="elb-ichs-icon" data-iconid=""></div>';				
			Object.keys(iconsList).map(function(icon, index){
				if(icon != '' && icon != null)
					iconListHtml += '<div class="elb-ichs-icon" title="'+icon+'" data-iconid="'+icon+'" data-keywords="'+iconsList[icon]['keywords']+'"><svg width="27" height="27" viewBox="'+iconsList[icon]['viewbox']+'">'+iconsList[icon]['path']+'</svg></div>';					
			});
			return iconListHtml;
		},
		loadIconAjax : function(elem){
			var  self = this;
			if(iconsList == null || iconsList == 'null' || iconsList == undefined || iconsList == 'undefined' || iconsList == ''){
				jQuery.ajax({
					type:"POST",
					url: plugindir.ajax_handler,
					dataType : 'json',
					data:{action:'elbLoadIconsChooser'},
					success:function(iconsListResult){	
						localStorage.setItem("elbIcons",JSON.stringify(iconsListResult));
						elem.parents('.elb-ichs-ctn').find('.elb-ichs-list').html(self.printIconList(iconsListResult));			
						self.registerClickChoose(elem);		
					}
				});	
			}else{
				elem.parents('.elb-ichs-ctn').find('.elb-ichs-list').html(self.printIconList(JSON.parse(iconsList)));
				self.registerClickChoose(elem);		
			}
		},
		registerClickChoose : function(elem){
			var  self = this;
			elem.parents('.elb-ichs-ctn').find('.elb-ichs-icon').on("click",function(){
				var iconID = jQuery(this).attr('data-iconid');	
				self.ui.input.val(iconID);
				self.saveValue();
				self.printIconChoosed(iconID);
			});
			self.printIconChoosed(elem.val());
		}

	});
	elementor.addControlView('elb_icon_chooser', ControlIconChooser);


	/*
		************** OBJECTS CHOOSER CONTROLS
	*/
	const ControlObjectChooser = elementor.modules.controls.BaseData.extend({
		onReady: function() {
			var  self = this;
			var me = jQuery(this.ui.input);
			self.registerClickChoose(me);	
			self.loadObjectsAjax(me);	

		},
		saveValue: function() {
			this.setValue(this.ui.input.val());
		},
		onBeforeDestroy: function() {
			this.saveValue();
		},
		loadObjectsAjax : function(elem){
			var  self = this;
			if(objectsList == null || objectsList == 'null' || objectsList == undefined || objectsList == 'undefined' || objectsList == ''){
				jQuery.ajax({
					type:"POST",
					url: plugindir.ajax_handler,
					dataType : 'json',
					data:{action:'elbLoadObjectsChooser'},
					success:function(objectsListResult){	
						localStorage.setItem("elbObjects",JSON.stringify(objectsListResult));
					}
				});	
			}
		},
		printIconChoosed : function(icon){
			var me = jQuery(this.ui.input);
			var pr = me.parents('.elb-ichs-ctn');
			var iconHTML = pr.find('.elb-ichs-list').find('.elb-ichs-icon[data-iconid="'+icon+'"]').html();
			pr.find('.elb-ichs-icon-real').html(iconHTML);
			pr.find('.elb-ichs-icon-real').attr({'title':icon});
		},
		registerClickChoose : function(elem){
			var  self = this;
			elem.parents('.elb-ichs-ctn').find('.elb-ichs-icon').on("click",function(){
				var iconID = jQuery(this).attr('data-iconid');	
				self.ui.input.val(iconID);
				self.saveValue();				
				self.printIconChoosed(iconID);
			});
			self.printIconChoosed(elem.val());
		}
	});
	elementor.addControlView('elb_object_chooser', ControlObjectChooser);


	/*
		************** IMAGE MASK CHOOSER CONTROL
	*/
	const ImageMaskChooser = elementor.modules.controls.BaseData.extend({
		onReady: function() {
			var  self = this;
			var me = jQuery(this.ui.input);			
			self.registerClickChoose(me,self.model.attributes.multiple);
			self.activateChoosedIcons(me);			
		},
		saveValue: function() {
			this.setValue(this.ui.input.val());
		},
		onBeforeDestroy: function() {
			this.saveValue();
		},
		printIconChoosed : function(icon){
			var me = jQuery(this.ui.input);
			var pr = me.parents('.elb-ichs-ctn');
			var iconHTML = pr.find('.elb-ichs-list').find('.elb-ichs-icon[data-iconid="'+icon+'"]').html();
			pr.find('.elb-ichs-icon-real').html(iconHTML);
			pr.find('.elb-ichs-icon-real').attr({'title':icon});
		},
		registerClickChoose : function(elem,isMultiple){
			var  self = this;
			elem.parents('.elb-ichs-ctn').find('.elb-ichs-icon').on("click",function(){
				var iconID = jQuery(this).attr('data-iconid');	
				if(isMultiple == true){
					self.checkMultipleSelect(iconID);
				}else{
					self.ui.input.val(iconID);
				}				
				self.saveValue();
				self.activateChoosedIcons(elem);
			});
		},
		activateChoosedIcons : function(elem){
			var  self = this;
			var iconList = self.ui.input.val().split(',');
			elem.parents('.elb-ichs-ctn').find('.elb-ichs-icon').attr({'data-situation':'inactive'});
			iconList.forEach(function(el,ind){
				if(el != ''){
					elem.parents('.elb-ichs-ctn').find('.elb-ichs-icon[data-iconid="'+el+'"]').attr({'data-situation':'active'});
				}
			});
		},
		checkMultipleSelect : function(iconID){
			var  self = this;
			var iconList = self.ui.input.val().split(',');
			if(iconList.includes(iconID)){
				iconList.splice(iconList.indexOf(iconID), 1);
			}else{
				iconList.push(iconID);
			}			
			self.ui.input.val(iconList.join(','));
		}
	});
	elementor.addControlView('elb_imagemask_chooser', ImageMaskChooser);
});


function elb_show_iconchooser(elem){
	elem = jQuery(elem);
	var situation = elem.parents('.elb-ichs-ctn').attr('data-situation');
	if(situation == 'hidden')
		elem.parents('.elb-ichs-ctn').attr('data-situation','shown');				
	else
		elem.parents('.elb-ichs-ctn').attr('data-situation','hidden');		
}


function elb_search_iconchooser(elem){
	elem = jQuery(elem);
	var searchValue = elem.val();
	var pr = elem.parents('.elb-ichs-ctn').find('.elb-ichs-list');
	if(jQuery.trim(searchValue) != ''){
		pr.find('.elb-ichs-icon').hide();
		pr.find(".elb-ichs-icon[data-keywords*="+searchValue.toLowerCase()+"]").show();
	}else{
		pr.find('.elb-ichs-icon').show();
	}
}




