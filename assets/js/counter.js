var ElbCounter=function(a,b,c,d,e,f){for(var g=0,h=["webkit","moz","ms","o"],i=0;i<h.length&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[h[i]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[h[i]+"CancelAnimationFrame"]||window[h[i]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(a,b){var c=(new Date).getTime(),d=Math.max(0,16-(c-g)),e=window.setTimeout(function(){a(c+d)},d);return g=c+d,e}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)});var j=this;j.options={useEasing:!0,useGrouping:!0,separator:",",decimal:".",easingFn:null,formattingFn:null};for(var k in f)f.hasOwnProperty(k)&&(j.options[k]=f[k]);""===j.options.separator&&(j.options.useGrouping=!1),j.options.prefix||(j.options.prefix=""),j.options.suffix||(j.options.suffix=""),j.d="string"==typeof a?document.getElementById(a):a,j.startVal=Number(b),j.endVal=Number(c),j.countDown=j.startVal>j.endVal,j.frameVal=j.startVal,j.decimals=Math.max(0,d||0),j.dec=Math.pow(10,j.decimals),j.duration=1e3*Number(e)||2e3,j.formatNumber=function(a){a=a.toFixed(j.decimals),a+="";var b,c,d,e;if(b=a.split("."),c=b[0],d=b.length>1?j.options.decimal+b[1]:"",e=/(\d+)(\d{3})/,j.options.useGrouping)for(;e.test(c);)c=c.replace(e,"$1"+j.options.separator+"$2");return j.options.prefix+c+d+j.options.suffix},j.easeOutExpo=function(a,b,c,d){return c*(-Math.pow(2,-10*a/d)+1)*1024/1023+b},j.easingFn=j.options.easingFn?j.options.easingFn:j.easeOutExpo,j.formattingFn=j.options.formattingFn?j.options.formattingFn:j.formatNumber,j.version=function(){return"1.7.1"},j.printValue=function(a){var b=j.formattingFn(a);"INPUT"===j.d.tagName?this.d.value=b:"text"===j.d.tagName||"tspan"===j.d.tagName?this.d.textContent=b:this.d.innerHTML=b},j.count=function(a){j.startTime||(j.startTime=a),j.timestamp=a;var b=a-j.startTime;j.remaining=j.duration-b,j.options.useEasing?j.countDown?j.frameVal=j.startVal-j.easingFn(b,0,j.startVal-j.endVal,j.duration):j.frameVal=j.easingFn(b,j.startVal,j.endVal-j.startVal,j.duration):j.countDown?j.frameVal=j.startVal-(j.startVal-j.endVal)*(b/j.duration):j.frameVal=j.startVal+(j.endVal-j.startVal)*(b/j.duration),j.countDown?j.frameVal=j.frameVal<j.endVal?j.endVal:j.frameVal:j.frameVal=j.frameVal>j.endVal?j.endVal:j.frameVal,j.frameVal=Math.round(j.frameVal*j.dec)/j.dec,j.printValue(j.frameVal),b<j.duration?j.rAF=requestAnimationFrame(j.count):j.callback&&j.callback()},j.start=function(a){return j.callback=a,j.rAF=requestAnimationFrame(j.count),!1},j.pauseResume=function(){j.paused?(j.paused=!1,delete j.startTime,j.duration=j.remaining,j.startVal=j.frameVal,requestAnimationFrame(j.count)):(j.paused=!0,cancelAnimationFrame(j.rAF))},j.reset=function(){j.paused=!1,delete j.startTime,j.startVal=b,cancelAnimationFrame(j.rAF),j.printValue(j.startVal)},j.update=function(a){cancelAnimationFrame(j.rAF),j.paused=!1,delete j.startTime,j.startVal=j.frameVal,j.endVal=Number(a),j.countDown=j.startVal>j.endVal,j.rAF=requestAnimationFrame(j.count)},j.printValue(j.startVal)};!function(a){a.fn.ElbCounter=function(b){var c={startVal:0,decimals:0,duration:2};if("number"==typeof b)c.endVal=b;else{if("object"!=typeof b)return;a.extend(c,b)}return this.each(function(a,b){var d=new ElbCounter(b,c.startVal,c.endVal,c.decimals,c.duration,c.options);d.start()}),this}}(jQuery);