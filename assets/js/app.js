//Parallax JS CertainDev Rellax 
!function(e,t){"function"==typeof define&&define.amd?define([],t):"object"==typeof module&&module.exports?module.exports=t():e.CertainDevRellax=t()}("undefined"!=typeof window?window:global,function(){var x=function(e,t){"use strict";var Y=Object.create(x.prototype),l=0,O=0,p=0,d=[],o=!0,n=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame||window.oRequestAnimationFrame||function(e){return setTimeout(e,1e3/60)},r=null,i=!1;try{var a=Object.defineProperty({},"passive",{get:function(){i=!0}});window.addEventListener("testPassive",null,a),window.removeEventListener("testPassive",null,a)}catch(e){}var s=window.cancelAnimationFrame||window.mozCancelAnimationFrame||clearTimeout,c=window.transformProp||function(){var e=document.createElement("div");if(null===e.style.transform){var t=["Webkit","Moz","ms"];for(var o in t)if(void 0!==e.style[t[o]+"Transform"])return t[o]+"Transform"}return"transform"}();Y.options={speedX:-2,speedY:-2,center:!1,wrapper:null,relativeToWrapper:!1,round:!0,vertical:!1,horizontal:!1,callback:function(){}},t&&Object.keys(t).forEach(function(e){Y.options[e]=t[e]}),e||(e=".rellax");var u="string"==typeof e?document.querySelectorAll(e):[e];if(0<u.length){if(Y.elems=u,Y.options.wrapper&&!Y.options.wrapper.nodeType){var m=document.querySelector(Y.options.wrapper);if(!m)return;Y.options.wrapper=m}var w=function(){for(var e=0;e<d.length;e++)Y.elems[e].style.cssText=d[e].style;d=[],O=window.innerHeight,window.innerWidth,v(),function(){for(var e=0;e<Y.elems.length;e++){var t=f(Y.elems[e]);d.push(t)}}(),y(),o&&(window.addEventListener("resize",w),o=!1,h())},f=function(e){var t=e.getAttribute("data-rellax-percentage"),o=e.getAttribute("data-rellax-speed-x"),n=e.getAttribute("data-rellax-speed-y"),r=e.getAttribute("data-rellax-zindex")||0,i=e.getAttribute("data-rellax-min"),a=e.getAttribute("data-rellax-max"),s="yes"==e.getAttribute("data-rellax-vertical"),l="yes"==e.getAttribute("data-rellax-horizontal"),p=Y.options.wrapper?Y.options.wrapper.scrollTop:window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop;Y.options.relativeToWrapper&&(p=(window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop)-Y.options.wrapper.offsetTop);var d=s?t||Y.options.center?p:0:2120,c=l&&(t||Y.options.center)?Y.options.wrapper?Y.options.wrapper.scrollTop:window.pageXOffset||document.documentElement.scrollTop||document.body.scrollTop:0,u=d+e.getBoundingClientRect().top,m=e.clientHeight||e.offsetHeight||e.scrollHeight,w=c+e.getBoundingClientRect().left,f=e.clientHeight||e.offsetHeight||e.scrollHeight,v=t||(d-u+O)/(m+O),g=t||(c-w+O)/(f+O);Y.options.center&&(v=g=.5);var h=o||Y.options.speedX,y=n||Y.options.speedY,x=q(g,v,h,y),b=e.style.cssText,T="",E=/transform\s*:/i.exec(b);if(E){var z=E.index,A=b.slice(z),L=A.indexOf(";");T=L?" "+A.slice(11,L).replace(/\s/g,""):" "+A.slice(11).replace(/\s/g,"")}return{baseX:x.x,baseY:x.y,top:u,left:w,height:m,width:f,speedX:h,speedY:y,style:b,transform:T,zindex:r,min:i,max:a,vertical:s,horizontal:l}},v=function(){var e=l,t=p;if(l=Y.options.wrapper?Y.options.wrapper.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop||window.pageYOffset,p=Y.options.wrapper?Y.options.wrapper.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop||window.pageYOffset,Y.options.relativeToWrapper){var o=(document.documentElement||document.body.parentNode||document.body).scrollTop||window.pageYOffset;l=o-Y.options.wrapper.offsetTop}return e!=l||t!=p},q=function(e,t,o,n){var r={},i=o*(100*(1-e)),a=n*(100*(1-t));return r.x=Y.options.round?Math.round(i):Math.round(100*i)/100,r.y=Y.options.round?Math.round(a):Math.round(100*a)/100,r},g=function(){window.removeEventListener("resize",g),window.removeEventListener("orientationchange",g),(Y.options.wrapper?Y.options.wrapper:window).removeEventListener("scroll",g),(Y.options.wrapper?Y.options.wrapper:document).removeEventListener("touchmove",g),r=n(h)},h=function(){v()&&!1===o?(y(),r=n(h)):(r=null,window.addEventListener("resize",g),window.addEventListener("orientationchange",g),(Y.options.wrapper?Y.options.wrapper:window).addEventListener("scroll",g,!!i&&{passive:!0}),(Y.options.wrapper?Y.options.wrapper:document).addEventListener("touchmove",g,!!i&&{passive:!0}))},y=function(){for(var e,t=0;t<Y.elems.length;t++){var o=(l-d[t].top+O)/(d[t].height+O),n=(p-d[t].left+O)/(d[t].width+O),r=(e=q(n,o,d[t].speedX,d[t].speedY)).y-d[t].baseY,i=e.x-d[t].baseX;null!==d[t].min&&(d[t].vertical&&!d[t].horizontal&&(r=r<=d[t].min?d[t].min:r),d[t].horizontal&&!d[t].vertical&&(i=i<=d[t].min?d[t].min:i)),null!==d[t].max&&(d[t].vertical&&!d[t].horizontal&&(r=r>=d[t].max?d[t].max:r),d[t].horizontal&&!d[t].vertical&&(i=i>=d[t].max?d[t].max:i));var a=d[t].zindex,s="translate3d("+(d[t].horizontal?i:"0")+"px,"+(d[t].vertical?r:"0")+"px,"+a+"px) "+d[t].transform;Y.elems[t].style[c]=s}Y.options.callback(e)};return Y.destroy=function(){for(var e=0;e<Y.elems.length;e++)Y.elems[e].style.cssText=d[e].style;o||(window.removeEventListener("resize",w),o=!0),s(r),r=null},w(),Y.refresh=w,Y}};return x});
//CSS VAR GETTER
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports?module.exports=t:t(jQuery)}(function(t){if(!(window.CSS&&window.CSS.supports&&window.CSS.supports("--css-var",0)))throw new Error("This browser doesn't have enough CSS support to use CSS variables.");t.cssVar=function(t,e){let o=t;if(/^\w+(?:\w|-)*$/.test(o)&&(o=`--${o}`),/^--\w+(?:\w|-)*$/.test(o)){if("string"!=typeof e&&"number"!=typeof e||e!=e)return window.getComputedStyle(document.body).getPropertyValue(o);document.body.style.setProperty(o,e)}return this},t.fn.cssVar=function(t,e){let o=t;if(/^\w+(?:\w|-)*$/.test(o)&&(o=`--${o}`),/^--\w+(?:\w|-)*$/.test(o)&&this[0]){if("string"!=typeof e&&"number"!=typeof e||e!=e)return window.getComputedStyle(this[0]).getPropertyValue(o);this.each((t,r)=>{r.style.setProperty(o,e)})}return this}});
//Visible
!function(t){var i=t(window);t.fn.visible=function(t,e,o){if(!(this.length<1)){var r=this.length>1?this.eq(0):this,n=r.get(0),f=i.width(),h=i.height(),o=o?o:"both",l=e===!0?n.offsetWidth*n.offsetHeight:!0;if("function"==typeof n.getBoundingClientRect){var g=n.getBoundingClientRect(),u=g.top>=0&&g.top<h,s=g.bottom>0&&g.bottom<=h,c=g.left>=0&&g.left<f,a=g.right>0&&g.right<=f,v=t?u||s:u&&s,b=t?c||a:c&&a;if("both"===o)return l&&v&&b;if("vertical"===o)return l&&v;if("horizontal"===o)return l&&b}else{var d=i.scrollTop(),p=d+h,w=i.scrollLeft(),m=w+f,y=r.offset(),z=y.top,B=z+r.height(),C=y.left,R=C+r.width(),j=t===!0?B:z,q=t===!0?z:B,H=t===!0?R:C,L=t===!0?C:R;if("both"===o)return!!l&&p>=q&&j>=d&&m>=L&&H>=w;if("vertical"===o)return!!l&&p>=q&&j>=d;if("horizontal"===o)return!!l&&m>=L&&H>=w}}}}(jQuery);

(function ($) {	
	var elb_parallax_move_mouse = function($scope, $){
		$('.elb-parallaxf-ctn,.elb-parallax-section-yes').each(function(){
			var container = $(this);
			container.on('mousemove',function(e){				
				var parentOffset = container.offset();
			 	var left = ((e.pageX - parentOffset.left) * 100) / container.width();
	        	var top = ((e.pageY - parentOffset.top) * 100) / container.height();            		  					
	            var parallaxItems = container.find('.elb-parallaxf-item[data-parallax-move="enabled"]');
	            parallaxItems.each(function(index, item){
	            	var item = $(item); var parallaxSensitive = item.attr('data-parallax-sensitive');	
	            	if($.trim(parallaxSensitive) == undefined || $.trim(parallaxSensitive) == '')	parallaxSensitive = 1;
	            		item.css({'-webkit-transform':'translate('+(left * -parallaxSensitive)+'px, '+(top * -parallaxSensitive)+'px)', 'transform':'translate('+(left * -parallaxSensitive)+'px, '+(top * -parallaxSensitive)+'px)'});
	           	});
			});
			container.on('mouseout',function(e){
				container.find('.elb-parallaxf-item[data-parallax-move="enabled"]').css({'-webkit-transform':'translate(0px,0px)','transform':'translate(0px,0px)'});
			});
		});
	};

	$(document).ready(function(){
		$('.elb-rveal-el-yes').prepend('<div class="elb-elementback-reveal"></div>');
		$('.elb-rveal-el-yes').attr({'data-content-animated':'no'}); 	
		
		elb_section_rellax_init();
		$("a").on('click', function(event) {
		    if (this.hash !== "") {
		      	event.preventDefault();
		      	var hash = this.hash;
		      	$('html, body').animate({ scrollTop: $(hash).offset().top}, 600, function(){window.location.hash = hash;});
		    } 
		});		
		//Scroll Window
		$(window).on('scroll', function(){
			elb_scroll_window();
		});
	});

	var elb_section_visible = function ($scope, $) {
		$('.elb-masonry-item').on('inview', function(isInView) {
			if (isInView)
				$(this).attr({'data-isotope-situation':'shown'})
			else
				$(this).unbind('inview');                              
		});
	};

	$(".elb-crtcsld-ctn[data-play],.elb-ctcrdsld-ctn[data-play]").each(function(){
		var elm = $(this);
		elb_crtcsld_interval(elm);
	});


	$(window).on('elementor/frontend/init', function () {
		var editMode = elementorFrontend.isEditMode();
		elementorFrontend.hooks.addAction('frontend/element_ready/section', elb_parallax_move_mouse);			
		elementorFrontend.hooks.addAction('frontend/element_ready/section', elb_section_visible);

	});

		


	$(window).keydown(function(ev){
    	if(ev.keyCode == 27)
	    	elb_escape_clicked(event);
	});
})(jQuery);	


//Create the CertainDev Rellax for Sections
/*
*/
function elb_section_rellax_init() {
	jQuery('.elb-parallax-section-elem').each(function(){
		var elem = jQuery(this); 		
	 	var verticalValue = elem.cssVar('--elb-section-vertical-parallax'); 
	 	var horizontalValue = elem.cssVar('--elb-section-horizontal-parallax');
 		elem.addClass('elb-parallax-elem');
	 	if(verticalValue != 0 && verticalValue != '0')
	 		elem.attr({'data-rellax-vertical':'yes','data-rellax-speed-y' : verticalValue});
	 	if(horizontalValue != 0 && horizontalValue != '0')
	 		elem.attr({'data-rellax-horizontal':'yes','data-rellax-speed-x' : horizontalValue});
	});
	var certaindevRellax = new CertainDevRellax('.elb-parallax-elem');
}


function elb_escape_clicked(event){
	jQuery('.elb-mdl-ctn,.sy-fs-elem,.elb-fs-elem').attr({'data-situation':'inactive'}); 
	jQuery('.elb-vd-modal').each(function(){
		var iframe = jQuery(this).find('iframe');
		var iframeSrc = iframe.attr('src');
		iframe.attr('src',iframeSrc);
	})
}

function elb_toggle_content_widget(elem){
	elem = jQuery(elem).parents('.elb-tgc-ctn');
	var new_area = (elem.attr('data-activated') == 'area_1') ? 'area_2' : 'area_1';
	elem.attr('data-activated',new_area)
}


function elb_play_video(elem){
	elem = jQuery(elem);
	var par = elem.parents('.elb-video-el-ctn'); 
	var sourceVideo = par.find('iframe').attr('src');
	sourceVideo += (sourceVideo.includes('?')) ? '&autoplay=1' : '?autoplay=1';	
	par.find('iframe').attr('src',sourceVideo );
	par.attr('data-situation','playing');
}

function elb_change_situation(elem,situation, type, parent_name){
	elem = (type == 'parent') ? jQuery(elem).parents(parent_name) : jQuery(elem);
	var new_situation = '';
	if(situation == 'toogle')
		new_situation = (elem.attr('data-situation') == 'active') ? 'inactive' : 'active';
	else 
		new_situation = situation;
	elem.attr('data-situation',new_situation)
}


function elb_social_share(elem){
	elem = jQuery(elem);
	var urltoShare = elem.attr('data-url');
	elb_social_share_popup(urltoShare);
}

function elb_social_share_lightbox(elem){
	var urltoShare = jQuery(elem).attr('data-link') +''+ jQuery(elem).parents('.elb-lightb-gal').find('.slick-current').find('img').attr('src');
	elb_social_share_popup(urltoShare);
}

function elb_social_share_popup(urltoShare){
	var popupWidth = 640, popupHeight = 320;
	var left = window.screenLeft || window.screenX;
	var top = window.screenTop || window.screenY;
	var width = window.innerWidth || document.documentElement.clientWidth;
	var height = window.innerHeight || document.documentElement.clientHeight;
	var popupLeft = left + width / 2 - popupWidth / 2;
	var popupTop = top + height / 2 - popupHeight / 2;
	window.open(urltoShare,'Social Share','scrollbars=yes, width='+popupWidth+', height='+popupHeight+', top='+popupTop+', left='+popupLeft);
}

function elb_cards_gallery(elem){
	elem = jQuery(elem);
	var parent = elem.parent('.elb-imcgal-insider');
	var firstChild = parent.children('.elb-imcgal-item:first-of-type');
	var secondChild = parent.children('.elb-imcgal-item:nth-of-type(2)');
	if(!elem.is(':first-child')){
		parent.addClass('changed');
		setTimeout(function(){				
			firstChild.remove(); 
			parent.append(firstChild);							
			parent.removeClass('changed');
		},400);				
	}
}

//Scroll Window 
function elb_scroll_window(){
	var scrollTopWindow = jQuery(window).scrollTop();
	var heightBody = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	var scrolledBody = (scrollTopWindow / heightBody) * 100;
	jQuery(".elb-prgrs-bar-inside").css({width: scrolledBody + "%"});
	elb_reading_progress_radial(scrolledBody);
}

var progressPath = document.querySelector('.elb-prgrs-circle path');
if(progressPath != null && progressPath != undefined){
	var pathLength = progressPath.getTotalLength();
	progressPath.style.transition = progressPath.style.WebkitTransition ='none';
	progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
	progressPath.style.strokeDashoffset = pathLength;
	progressPath.getBoundingClientRect();
	progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 300ms linear';
}

function elb_reading_progress_radial() {
	// calculate values
	if(progressPath != null && progressPath != undefined){
		var scroll = jQuery(window).scrollTop();
		var height = jQuery(document).height() - jQuery(window).height();
		var percent = Math.round(scroll * 100 / height);
		var progress = pathLength - (scroll * pathLength / height);
		progressPath.style.strokeDashoffset = progress;
		jQuery('.elb-prgrs-radial-txt span').html(parseInt(percent));
	}
}









function elb_change_event_situation(elem){
	elem = jQuery(elem)
	var elem_ch = elem.find('.elb-hotspot-contentanim');
	if(jQuery.trim(elem_ch.attr('data-situation')) == 'inactive'){
		elem.attr({'data-situation':'active'});
		elem_ch.attr({'data-situation':'active'});
	}
	else if(jQuery.trim(elem_ch.attr('data-situation')) == 'active'){
		elem.attr({'data-situation':'inactive'});
		elem_ch.attr({'data-situation':'inactive'});
	}
};


function elb_close_alert_box(elem){
	elem = jQuery(elem).parents('.elb-albx-ctn');
	elem.fadeOut(400);
}


function elb_woolist_slider_init(elem){
	elem = jQuery(elem);
	var wooLightBox = elem.parents('.elb-masonry-boss').find('.elb-woo-sld-ctn');
	var imageList = elem.attr('data-slider');
	wooLightBox.attr({'data-slider':imageList});
	imageList = JSON.parse(imageList);
	wooLightBox.find('.elb-woo-sld-prev').attr({'data-situation':'inactive'});
	wooLightBox.find('.elb-woo-sld-imgs-list').html("");
	if(imageList.indexOf(0) === -1){
		wooLightBox.attr({'data-situation':'active'});
		wooLightBox.find('.elb-woo-sld-thim').html('<img src="'+imageList[0]+'">');
		if(imageList.length > 1)
			wooLightBox.find('.elb-woo-sld-nxt').attr({'data-situation':'active'});
		else
			wooLightBox.find('.elb-woo-sld-nxt').attr({'data-situation':'inactive'});
		
		imageList.forEach(function(imgSrc, index) {
			wooLightBox.find('.elb-woo-sld-imgs-list').append('<img onclick="elb_woolist_slider_move_index(this,'+index+')" src="'+imgSrc+'">');
		});

	}
}

function elb_woolist_slider_move_index(elem, slide){
	elem = jQuery(elem);
	var wooLightBox = elem.parents('.elb-masonry-boss').find('.elb-woo-sld-ctn');
	var imageList = JSON.parse(wooLightBox.attr('data-slider'));
	wooLightBox.attr({'data-slide':slide});
	wooLightBox.find('.elb-woo-sld-thim').html('<img src="'+imageList[slide]+'">');
}


function elb_woolist_slider_move(elem,direction){
	elem = jQuery(elem);
	var wooLightBox = elem.parents('.elb-masonry-boss').find('.elb-woo-sld-ctn');
	var imageList = JSON.parse(wooLightBox.attr('data-slider'));
	var slide = parseInt(wooLightBox.attr('data-slide'));
	if(direction == 'next' && imageList.length >= slide+1)
		slide +=1;
	if(direction == 'prev' && 0 <= slide-1)
		slide -=1;	
	wooLightBox.attr({'data-slide':slide});
	wooLightBox.find('.elb-woo-sld-thim').html('<img src="'+imageList[slide]+'">');
	var nxtSituation = (imageList.length > slide+1) ? 'active' : 'inactive',
		prevSituation = (0 <= slide-1)  ? 'active' : 'inactive';
	wooLightBox.find('.elb-woo-sld-nxt').attr({'data-situation':nxtSituation});
	wooLightBox.find('.elb-woo-sld-prev').attr({'data-situation':prevSituation});		
}


function elb_crtcsld_interval(elm){
	var playHolder = parseInt(elm.attr('data-play')) * 1000;
	setTimeout(function(){
		elb_crtcsld_interval(elm);
		elm.find('.elb-crtcsld-btn-nxt').click();
		elm.find('.elb-ctcrdsld-nav-nxt').click();
	},playHolder + 200);
}

function elb_crtcsld_trigger(elm, type){
	var index = jQuery(elm).attr('data-index');
	var ctn = jQuery(elm).parents('.elb-crtcsld-ctn');
	var currentIndex = parseInt(ctn.attr('data-current'));
	var lengthIndex = parseInt(ctn.attr('data-length'));
	if(ctn.attr('data-play')){
		ctn.attr({'data-loading':'done'});
		setTimeout(function(){
			ctn.attr({'data-loading':'loading'});
		},200);
	}
	if(type == "previous")
		index = (1 < currentIndex) ? (currentIndex - 1) : lengthIndex;
	if(type == "next")
		index = (lengthIndex > currentIndex) ? (currentIndex + 1) : 1;
	ctn.find('.elb-crtcsld-itm').attr({'data-situation':'inactive'});
	ctn.find('.elb-crtcsld-itm[data-index="'+index+'"]').attr({'data-situation':'active'});
	ctn.find('.elb-crtcsld-cnt-itm-img').attr({'data-hidden':'true'});
	ctn.find('.elb-crtcsld-cnt-itm-img[data-index="'+currentIndex+'"],.elb-crtcsld-cnt-itm-img[data-index="'+index+'"]').attr({'data-hidden':'false'});
	ctn.attr({'data-current':index});
}