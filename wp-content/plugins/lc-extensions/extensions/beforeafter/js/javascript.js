/**
 * jquery.event.move
 * 1.3.6
 * Stephen Band
 */
(function(e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(jQuery)}})(function(e,t){function l(e){function i(e){if(n){t();o(i);r=true;n=false}else{r=false}}var t=e,n=false,r=false;this.kick=function(e){n=true;if(!r){i()}};this.end=function(e){var i=t;if(!e){return}if(!r){e()}else{t=n?function(){i();e()}:e;n=true}}}function c(){return true}function h(){return false}function p(e){e.preventDefault()}function d(e){if(u[e.target.tagName.toLowerCase()]){return}e.preventDefault()}function v(e){return e.which===1&&!e.ctrlKey&&!e.altKey}function m(e,t){var n,r;if(e.identifiedTouch){return e.identifiedTouch(t)}n=-1;r=e.length;while(++n<r){if(e[n].identifier===t){return e[n]}}}function g(e,t){var n=m(e.changedTouches,t.identifier);if(!n){return}if(n.pageX===t.pageX&&n.pageY===t.pageY){return}return n}function y(e){var t;if(!v(e)){return}t={target:e.target,startX:e.pageX,startY:e.pageY,timeStamp:e.timeStamp};r(document,a.move,b,t);r(document,a.cancel,w,t)}function b(e){var t=e.data;C(e,t,e,E)}function w(e){E()}function E(){i(document,a.move,b);i(document,a.cancel,w)}function S(e){var t,n;if(u[e.target.tagName.toLowerCase()]){return}t=e.changedTouches[0];n={target:t.target,startX:t.pageX,startY:t.pageY,timeStamp:e.timeStamp,identifier:t.identifier};r(document,f.move+"."+t.identifier,x,n);r(document,f.cancel+"."+t.identifier,T,n)}function x(e){var t=e.data,n=g(e,t);if(!n){return}C(e,t,n,N)}function T(e){var t=e.data,n=m(e.changedTouches,t.identifier);if(!n){return}N(t.identifier)}function N(e){i(document,"."+e,x);i(document,"."+e,T)}function C(e,t,r,i){var s=r.pageX-t.startX,o=r.pageY-t.startY;if(s*s+o*o<n*n){return}A(e,t,r,s,o,i)}function k(){this._handled=c;return false}function L(e){e._handled()}function A(e,t,n,r,i,o){var u=t.target,a,f;a=e.targetTouches;f=e.timeStamp-t.timeStamp;t.type="movestart";t.distX=r;t.distY=i;t.deltaX=r;t.deltaY=i;t.pageX=n.pageX;t.pageY=n.pageY;t.velocityX=r/f;t.velocityY=i/f;t.targetTouches=a;t.finger=a?a.length:1;t._handled=k;t._preventTouchmoveDefault=function(){e.preventDefault()};s(t.target,t);o(t.identifier)}function O(e){var t=e.data.timer;e.data.touch=e;e.data.timeStamp=e.timeStamp;t.kick()}function M(e){var t=e.data.event,n=e.data.timer;_();j(t,n,function(){setTimeout(function(){i(t.target,"click",h)},0)})}function _(e){i(document,a.move,O);i(document,a.end,M)}function D(e){var t=e.data.event,n=e.data.timer,r=g(e,t);if(!r){return}e.preventDefault();t.targetTouches=e.targetTouches;e.data.touch=r;e.data.timeStamp=e.timeStamp;n.kick()}function P(e){var t=e.data.event,n=e.data.timer,r=m(e.changedTouches,t.identifier);if(!r){return}H(t);j(t,n)}function H(e){i(document,"."+e.identifier,D);i(document,"."+e.identifier,P)}function B(e,t,n,r){var i=n-e.timeStamp;e.type="move";e.distX=t.pageX-e.startX;e.distY=t.pageY-e.startY;e.deltaX=t.pageX-e.pageX;e.deltaY=t.pageY-e.pageY;e.velocityX=.3*e.velocityX+.7*e.deltaX/i;e.velocityY=.3*e.velocityY+.7*e.deltaY/i;e.pageX=t.pageX;e.pageY=t.pageY}function j(e,t,n){t.end(function(){e.type="moveend";s(e.target,e);return n&&n()})}function F(e,t,n){r(this,"movestart.move",L);return true}function I(e){i(this,"dragstart drag",p);i(this,"mousedown touchstart",d);i(this,"movestart",L);return true}function q(e){if(e.namespace==="move"||e.namespace==="moveend"){return}r(this,"dragstart."+e.guid+" drag."+e.guid,p,t,e.selector);r(this,"mousedown."+e.guid,d,t,e.selector)}function R(e){if(e.namespace==="move"||e.namespace==="moveend"){return}i(this,"dragstart."+e.guid+" drag."+e.guid);i(this,"mousedown."+e.guid)}var n=6,r=e.event.add,i=e.event.remove,s=function(t,n,r){e.event.trigger(n,r,t)},o=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(e,t){return window.setTimeout(function(){e()},25)}}(),u={textarea:true,input:true,select:true,button:true},a={move:"mousemove",cancel:"mouseup dragstart",end:"mouseup"},f={move:"touchmove",cancel:"touchend",end:"touchend"};e.event.special.movestart={setup:F,teardown:I,add:q,remove:R,_default:function(e){function o(t){B(n,i.touch,i.timeStamp);s(e.target,n)}var n,i;if(!e._handled()){return}n={target:e.target,startX:e.startX,startY:e.startY,pageX:e.pageX,pageY:e.pageY,distX:e.distX,distY:e.distY,deltaX:e.deltaX,deltaY:e.deltaY,velocityX:e.velocityX,velocityY:e.velocityY,timeStamp:e.timeStamp,identifier:e.identifier,targetTouches:e.targetTouches,finger:e.finger};i={event:n,timer:new l(o),touch:t,timeStamp:t};if(e.identifier===t){r(e.target,"click",h);r(document,a.move,O,i);r(document,a.end,M,i)}else{e._preventTouchmoveDefault();r(document,f.move+"."+e.identifier,D,i);r(document,f.end+"."+e.identifier,P,i)}}};e.event.special.move={setup:function(){r(this,"movestart.move",e.noop)},teardown:function(){i(this,"movestart.move",e.noop)}};e.event.special.moveend={setup:function(){r(this,"movestart.moveend",e.noop)},teardown:function(){i(this,"movestart.moveend",e.noop)}};r(document,"mousedown.move",y);r(document,"touchstart.move",S);if(typeof Array.prototype.indexOf==="function"){(function(e,t){var n=["changedTouches","targetTouches"],r=n.length;while(r--){if(e.event.props.indexOf(n[r])===-1){e.event.props.push(n[r])}}})(e)}});

/**
 * TwentyTwenty
 */
 (function(e){e.fn.twentytwenty=function(t){var t=e.extend({default_offset_pct:.5,orientation:"horizontal"},t);return this.each(function(){var n=t.default_offset_pct;var r=e(this);var i=t.orientation;var s=i==="vertical"?"down":"left";var o=i==="vertical"?"up":"right";r.wrap("<div class='twentytwenty-wrapper twentytwenty-"+i+"'></div>");r.append("<div class='twentytwenty-overlay'></div>");var u=r.find("img:first");var a=r.find("img:last");r.append("<div class='twentytwenty-handle'></div>");var f=r.find(".twentytwenty-handle");f.append("<span class='twentytwenty-"+s+"-arrow'></span>");f.append("<span class='twentytwenty-"+o+"-arrow'></span>");r.addClass("twentytwenty-container");u.addClass("twentytwenty-before");a.addClass("twentytwenty-after");var l=r.find(".twentytwenty-overlay");l.append("<div class='twentytwenty-before-label'></div>");l.append("<div class='twentytwenty-after-label'></div>");var c=function(e){var t=u.width();var n=u.height();return{w:t+"px",h:n+"px",cw:e*t+"px",ch:e*n+"px"}};var h=function(e){if(i==="vertical"){u.css("clip","rect(0,"+e.w+","+e.ch+",0)")}else{u.css("clip","rect(0,"+e.cw+","+e.h+",0)")}r.css("height",e.h)};var p=function(e){var t=c(e);f.css(i==="vertical"?"top":"left",i==="vertical"?t.ch:t.cw);h(t)};e(window).on("resize.twentytwenty",function(e){p(n)});var d=0;var v=0;f.on("movestart",function(e){if((e.distX>e.distY&&e.distX<-e.distY||e.distX<e.distY&&e.distX>-e.distY)&&i!=="vertical"){e.preventDefault()}else if((e.distX<e.distY&&e.distX<-e.distY||e.distX>e.distY&&e.distX>-e.distY)&&i==="vertical"){e.preventDefault()}r.addClass("active");d=r.offset().left;offsetY=r.offset().top;v=u.width();imgHeight=u.height()});f.on("moveend",function(e){r.removeClass("active")});f.on("move",function(e){if(r.hasClass("active")){n=i==="vertical"?(e.pageY-offsetY)/imgHeight:(e.pageX-d)/v;if(n<0){n=0}if(n>1){n=1}p(n)}});r.find("img").on("mousedown",function(e){e.preventDefault()});e(window).trigger("resize.twentytwenty")})}})(jQuery)

jQuery(document).ready( function($) {

	function init_bai() {
		
		var orientation;

		$('.spc-bai').each( function(){

			orientation = $(this).data('orientation');

			if ( ! $(this).find('.twentytwenty-wrapper').length ) {
				$('.spc-bai-wrapper', $(this)).twentytwenty({
					orientation : orientation
				});
			}

		});

		setTimeout( function(){
			$(window).resize();
		}, 100);

	}

	init_bai();

	$(document).ajaxComplete(function() {

		if ( $('body').hasClass('dslca-enabled') ) {
			init_bai();
		}

	});

	$(document).on( 'mouseup', '.dslca-change-width-modules-area-options', function(){
		setTimeout( function(){
			$(window).resize();
		}, 100);
	});

/*
	$(document).on( 'mouseup', '.dslca-container', function() {
		
		if ( $('body').hasClass('dslca-enabled') ) {

			$('.spc-bai').each( function(){
					
				alert( 'kek' );

					$('#spc-bai-wrapper', $(this)).beforeAfter({
						showFullLinks : false,
						cursor : 'move',
						dividerColor : '#fff'
					});

			});

		}

	});
*/

});