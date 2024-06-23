!function(e,t){"object"==typeof module&&module.exports?module.exports=t():"function"==typeof define&&define.amd?define(t):e.Spinner=t()}(this,function(){"use strict";function f(e,t){var s,i=document.createElement(e||"div");for(s in t)i[s]=t[s];return i}function g(e){for(var t=1,s=arguments.length;t<s;t++)e.appendChild(arguments[t]);return e}function i(e,t){var s,i,r=e.style;if(void 0!==r[t=t.charAt(0).toUpperCase()+t.slice(1)])return t;for(i=0;i<n.length;i++)if(void 0!==r[s=n[i]+t])return s}function v(e,t){for(var s in t)e.style[i(e,s)||s]=t[s];return e}function t(e){for(var t=1;t<arguments.length;t++){var s=arguments[t];for(var i in s)void 0===e[i]&&(e[i]=s[i])}return e}function m(e,t){return"string"==typeof e?e:e[t%e.length]}function s(e){this.opts=t(e||{},s.defaults,r)}var w,y,e,n=["webkit","Moz","ms","O"],x={},r={lines:12,length:7,width:5,radius:10,scale:1,corners:1,color:"#000",opacity:.25,rotate:0,direction:1,speed:1,trail:100,fps:20,zIndex:2e9,className:"spinner",top:"50%",left:"50%",shadow:!1,hwaccel:!1,position:"absolute"};if(s.defaults={},t(s.prototype,{spin:function(e){this.stop();var s=this,i=s.opts,r=s.el=f(null,{className:i.className});if(v(r,{position:i.position,width:0,zIndex:i.zIndex,left:i.left,top:i.top}),e&&e.insertBefore(r,e.firstChild||null),r.setAttribute("role","progressbar"),s.lines(r,s.opts),!w){var n,a=0,o=(i.lines-1)*(1-i.direction)/2,l=i.fps,c=l/i.speed,h=(1-i.opacity)/(c*i.trail/100),d=c/i.lines;!function e(){a++;for(var t=0;t<i.lines;t++)n=Math.max(1-(a+(i.lines-t)*d)%c*h,i.opacity),s.opacity(r,t*i.direction+o,n,i);s.timeout=s.el&&setTimeout(e,~~(1e3/l))}()}return s},stop:function(){var e=this.el;return e&&(clearTimeout(this.timeout),e.parentNode&&e.parentNode.removeChild(e),this.el=void 0),this},lines:function(e,s){function t(e,t){return v(f(),{position:"absolute",width:s.scale*(s.length+s.width)+"px",height:s.scale*s.width+"px",background:e,boxShadow:t,transformOrigin:"left",transform:"rotate("+~~(360/s.lines*r+s.rotate)+"deg) translate("+s.scale*s.radius+"px,0)",borderRadius:(s.corners*s.scale*s.width>>1)+"px"})}for(var i,r=0,n=(s.lines-1)*(1-s.direction)/2;r<s.lines;r++)i=v(f(),{position:"absolute",top:1+~(s.scale*s.width/2)+"px",transform:s.hwaccel?"translate3d(0,0,0)":"",opacity:s.opacity,animation:w&&(a=s.opacity,o=s.trail,l=n+r*s.direction,c=s.lines,void 0,void 0,void 0,void 0,void 0,h=["opacity",o,~~(100*a),l,c].join("-"),d=.01+l/c*100,p=Math.max(1-(1-a)/o*(100-d),a),u=w.substring(0,w.indexOf("Animation")).toLowerCase(),_=u&&"-"+u+"-"||"",x[h]||(y.insertRule("@"+_+"keyframes "+h+"{0%{opacity:"+p+"}"+d+"%{opacity:"+a+"}"+(d+.01)+"%{opacity:1}"+(d+o)%100+"%{opacity:"+a+"}100%{opacity:"+p+"}}",y.cssRules.length),x[h]=1),h+" "+1/s.speed+"s linear infinite")}),s.shadow&&g(i,v(t("#000","0 0 4px #000"),{top:"2px"})),g(e,g(i,t(m(s.color,r),"0 0 1px rgba(0,0,0,.1)")));var a,o,l,c,h,d,p,u,_;return e},opacity:function(e,t,s){t<e.childNodes.length&&(e.childNodes[t].style.opacity=s)}}),"undefined"!=typeof document){e=f("style",{type:"text/css"}),g(document.getElementsByTagName("head")[0],e),y=e.sheet||e.styleSheet;var a=v(f("group"),{behavior:"url(#default#VML)"});!i(a,"transform")&&a.adj?function(){function c(e,t){return f("<"+e+' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',t)}y.addRule(".spin-vml","behavior:url(#default#VML)"),s.prototype.lines=function(e,i){function r(){return v(c("group",{coordsize:a+" "+a,coordorigin:-n+" "+-n}),{width:a,height:a})}function t(e,t,s){g(l,g(v(r(),{rotation:360/i.lines*e+"deg",left:~~t}),g(v(c("roundrect",{arcsize:i.corners}),{width:n,height:i.scale*i.width,left:i.scale*i.radius,top:-i.scale*i.width>>1,filter:s}),c("fill",{color:m(i.color,e),opacity:i.opacity}),c("stroke",{opacity:0}))))}var s,n=i.scale*(i.length+i.width),a=2*i.scale*n,o=-(i.width+i.length)*i.scale*2+"px",l=v(r(),{position:"absolute",top:o,left:o});if(i.shadow)for(s=1;s<=i.lines;s++)t(s,-2,"progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");for(s=1;s<=i.lines;s++)t(s);return g(e,l)},s.prototype.opacity=function(e,t,s,i){var r=e.firstChild;i=i.shadow&&i.lines||0,r&&t+i<r.childNodes.length&&(r=(r=(r=r.childNodes[t+i])&&r.firstChild)&&r.firstChild)&&(r.opacity=s)}}():w=i(a,"animation")}return s}),function(h){function t(e){this.config=null,this.input_el=e,this.results_id=null,this.results_el=null,this.parent_el=null,this.results_showing=!1,this.form_el=null,this.timer=!1,this.last_string="",this.spinner=null,this.spinner_showing=!1,this.has_results=!1,this.current_request=!1,this.results_destroy_on_blur=!0,this.a11y_keys=[27,40,13,38,9],this.init()}var s="searchwp_live_search";t.prototype={init:function(){var t=this,e=this.input_el;this.form_el=e.parents("form:eq(0)"),this.results_id=this.uniqid("searchwp_live_search_results_");var s=!1,i=e.data("swpconfig");if(i&&void 0!==i)for(var r in searchwp_live_search_params.config)i===r&&(s=!0,this.config=searchwp_live_search_params.config[r]);else for(var n in searchwp_live_search_params.config)"default"===n&&(s=!0,this.config=searchwp_live_search_params.config[n]);if(s){var a=e.data("swpengine");a&&(this.config.engine=a),e.data("swpengine",this.config.engine),e.attr("autocomplete","off");var o=this.results_id+"_instructions";e.attr("aria-describedby",o),e.attr("aria-owns",this.results_id),e.attr("aria-expanded","false"),e.attr("aria-autocomplete","both"),e.attr("aria-activedescendant",""),e.after('<p class="searchwp-live-search-instructions screen-reader-text" id="'+o+'">'+searchwp_live_search_params.aria_instructions+"</p>");var l='<div class="searchwp-live-search-results" id="'+this.results_id+'" role="listbox" tabindex="0"></div>',c=e.data("swpparentel");c?(this.parent_el=h(c),this.parent_el.html(l)):this.config.parent_el?(this.parent_el=h(this.config.parent_el),this.parent_el.html(l)):h("body").append(h(l)),this.results_el=h("#"+this.results_id),this.position_results(),h(window).resize(function(){t.position_results()}),this.config.spinner&&(this.spinner=new Spinner(this.config.spinner)),void 0===this.config.abort_on_enter&&(this.config.abort_on_enter=!0),e.keyup(function(e){-1<h.inArray(e.keyCode,t.a11y_keys)||(t.current_request&&t.config.abort_on_enter&&13===e.keyCode&&t.current_request.abort(),h.trim(t.input_el.val()).length?t.results_showing||(t.position_results(),t.results_el.addClass("searchwp-live-search-results-showing"),t.show_spinner(),t.results_showing=!0):t.destroy_results(),t.has_results&&!t.spinner_showing&&t.last_string!==h.trim(t.input_el.val())&&(t.results_el.empty(),t.show_spinner()),e.currentTarget.value.length>=t.config.input.min_chars?t.results_el.removeClass("searchwp-live-search-no-min-chars"):t.results_el.addClass("searchwp-live-search-no-min-chars"))}).keyup(h.proxy(this.maybe_search,this)),(this.config.results_destroy_on_blur||void 0===this.config.results_destroy_on_blur)&&h("html").click(function(){t.destroy_results()}),e.click(function(e){e.stopPropagation()}),this.results_el.click(function(e){e.stopPropagation()})}else alert(searchwp_live_search_params.msg_no_config_found)},keyboard_navigation:function(){var i=this,r=this.input_el,n=this.results_el,a="searchwp-live-search-result--focused",o=".searchwp-live-search-result",l=this.a11y_keys;h(document).off("keyup.searchwp_a11y").on("keyup.searchwp_a11y",function(e){if(n.hasClass("searchwp-live-search-results-showing")){if(-1!==h.inArray(e.keyCode,l)){if(e.preventDefault(),27===e.keyCode&&!r.is(":focus"))return i.destroy_results(),h(document).off("keyup.searchwp_a11y"),r.focus(),void h(document).trigger("searchwp_live_escape_results");if(40===e.keyCode){console.log("down!");var t=h(n[0]).find("."+a);1===t.length&&1===t.next().length?(t.removeClass(a).attr("aria-selected","false").next().addClass(a).attr("aria-selected","true").find("a").focus(),i.aria_activedescendant(!0)):(t.removeClass(a).attr("aria-selected","false"),n.find(o+":first").addClass(a).attr("aria-selected","true").find("a").focus(),0<n.find(o+":first").length?i.aria_activedescendant(!0):i.aria_activedescendant(!1)),h(document).trigger("searchwp_live_key_arrowdown_pressed")}if(38===e.keyCode){var s=h(n[0]).find("."+a);1===s.length&&1===s.prev().length?(s.removeClass(a).attr("aria-selected","false").prev().addClass(a).attr("aria-selected","true").find("a").focus(),i.aria_activedescendant(!0)):(s.removeClass(a).attr("aria-selected","false"),n.find(o+":last").addClass(a).attr("aria-selected","true").find("a").focus(),0<n.find(o+":last").length?i.aria_activedescendant(!0):i.aria_activedescendant(!1)),h(document).trigger("searchwp_live_key_arrowup_pressed")}13===e.keyCode&&h(document).trigger("searchwp_live_key_enter_pressed"),9===e.keyCode&&h(document).trigger("searchwp_live_key_tab_pressed")}}else h(document).off("keyup.searchwp_a11y")}),h(document).trigger("searchwp_live_keyboad_navigation")},aria_expanded:function(e){var t=this.input_el;e?t.attr("aria-expanded","true"):(t.attr("aria-expanded","false"),this.aria_activedescendant(!1)),h(document).trigger("searchwp_live_aria_expanded")},aria_activedescendant:function(e){var t=this.input_el;e?t.attr("aria-activedescendant","selectedOption"):t.attr("aria-activedescendant",""),h(document).trigger("searchwp_live_aria_activedescendant")},position_results:function(){var e=this.input_el,t=e.parent().offset(),s=this.results_el,i=0;if(!e.is(":hidden")){switch(t.left+=parseInt(this.config.results.offset.x,10),t.top+=parseInt(this.config.results.offset.y,10),this.config.results.position){case"top":i=0-s.height();break;default:i=e.outerHeight()}s.css("left",t.left),s.css("top",t.top+i-5+"px"),"auto"===this.config.results.width&&s.width(e.parent().outerWidth()-parseInt(s.css("paddingRight").replace("px",""),10)-parseInt(s.css("paddingLeft").replace("px",""),10)),h(document).trigger("searchwp_live_position_results",[s.css("left"),s.css("top"),s.width()])}},destroy_results:function(e){this.hide_spinner(),this.aria_expanded(!1),this.results_el.empty().removeClass("searchwp-live-search-results-showing"),this.results_showing=!1,this.has_results=!1,h(document).trigger("searchwp_live_destroy_results")},maybe_search:function(e){-1<h.inArray(e.keyCode,this.a11y_keys)||(clearTimeout(this.timer),e.currentTarget.value.length>=this.config.input.min_chars&&(this.timer=setTimeout(h.proxy(this.search,this,e),this.config.input.delay)))},show_spinner:function(){this.config.spinner&&!this.spinner_showing&&(this.spinner.spin(document.getElementById(this.results_id)),this.spinner_showing=!0,h(document).trigger("searchwp_live_show_spinner"))},hide_spinner:function(){this.config.spinner&&(this.spinner.stop(),this.spinner_showing=!1,h(document).trigger("searchwp_live_hide_spinner"))},search:function(e){var t=this,s=this.form_el,i=s.serialize(),r=s.attr("action")?s.attr("action"):"",n=this.input_el,a=this.results_el;h(document).trigger("searchwp_live_search_start",[n,a,s,r,i]),this.aria_expanded(!1),i+="&action=searchwp_live_search&swpengine="+n.data("swpengine")+"&swpquery="+n.val(),-1!==r.indexOf("?")&&(r=r.split("?"),i+="&"+r[1]),this.last_string=n.val(),this.has_results=!0,this.current_request=h.ajax({url:searchwp_live_search_params.ajaxurl,type:"POST",data:i,complete:function(){h(document).trigger("searchwp_live_search_complete",[n,a,s,r,i]),t.spinner_showing=!1,t.hide_spinner(),this.current_request=!1},success:function(e){0===e&&(e=""),h(document).trigger("searchwp_live_search_success",[n,a,s,r,i]),t.position_results(),a.html(e),t.aria_expanded(!0),t.keyboard_navigation()}})},uniqid:function(e,t){void 0===e&&(e="");var s,i=function(e,t){return t<(e=parseInt(e,10).toString(16)).length?e.slice(e.length-t):t>e.length?new Array(t-e.length+1).join("0")+e:e};return this.php_js||(this.php_js={}),this.php_js.uniqidSeed||(this.php_js.uniqidSeed=Math.floor(123456789*Math.random())),this.php_js.uniqidSeed++,s=e,s+=i(parseInt((new Date).getTime()/1e3,10),8),s+=i(this.php_js.uniqidSeed,5),t&&(s+=(10*Math.random()).toFixed(8).toString()),s}},h.fn[s]=function(e){return this.each(function(){h.data(this,"plugin_"+s)||h.data(this,"plugin_"+s,new t(h(this),e))}),this}}(jQuery),jQuery(document).ready(function(e){e('input[data-swplive="true"]').searchwp_live_search()});