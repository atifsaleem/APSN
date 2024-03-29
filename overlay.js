/*
 * jQuery Simple Overlay
 * A jQuery Plugin for creating a simple, customizable overlay. Supports multiple instances,
 * custom callbacks, hide on click, glossy effect, and more.
 *
 * Copyright 2011 Tom McFarlin, http://tommcfarlin.com, @moretom
 * Released under the MIT License
 *
 * http://moreco.de/simple-overlay
 */
(function($){$.fn.overlay=function(options){var opts=$.extend({},$.fn.overlay.defaults,options);return this.each(function(evt){if(!$(this).hasClass('overlay-trigger')){show(create($(this),opts),opts);}});};function create($src,opts){$src.addClass('overlay-trigger');var iTop=0;if($.browser.mozilla&&opts.container.toString()==='body'){iTop=$('html').scrollTop();}else{iTop=$(opts.container).scrollTop();}
var overlay=$('<div></div>').addClass('overlay').css({background:opts.color,opacity:opts.opacity,top:opts.container.toString()==='body'?iTop:$(opts.container).offset().top,left:$(opts.container).offset().left,width:opts.container==='body'?'100%':$(opts.container).width(),height:opts.container==='body'?'100%':$(opts.container).height(),position:'absolute',zIndex:1000,display:'none',overflow:'hidden'});if(opts.glossy){applyGloss(opts,overlay);}
if(opts.closeOnClick){$(overlay).click(function(){close(overlay,opts);$src.removeClass('overlay-trigger');});}
$(opts.container).append(overlay);return overlay;}
function show(overlay,opts){switch(opts.effect.toString().toLowerCase()){case'fade':$(overlay).fadeIn('fast',opts.onShow);break;case'slide':$(overlay).slideDown('fast',opts.onShow);break;default:$(overlay).show(opts.onShow);break;}
$(opts.container).css('overflow','hidden');}
function close(overlay,opts){switch(opts.effect.toString().toLowerCase()){case'fade':$(overlay).fadeOut('fast',function(){opts.onHide();$(this).remove();});break;case'slide':$(overlay).slideUp('fast',function(){opts.onHide();$(this).remove();});break;default:$(overlay).hide();if(opts.onHide){opts.onHide();}
$(overlay).remove();break;}
$(opts.container).css('overflow','auto');}
function applyGloss(opts,overlay){var gloss=$('<div></div>');$(gloss).css({background:'#fff',opacity:0.2,width:'200%',height:'100%',position:'absolute',zIndex:1001,msTransform:'rotate(45deg)',webkitTransform:'rotate(45deg)',oTransform:'rotate(45deg)'});if($.browser.mozilla){$(gloss).css('-moz-transform','rotate(45deg');}
$(overlay).append(gloss);}
$.fn.overlay.defaults={color:'#000',opacity:0.5,effect:'none',onShow:null,onHide:null,closeOnClick:false,glossy:false,container:'body'};})(jQuery);