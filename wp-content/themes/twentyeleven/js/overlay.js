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
(function($){$j.fn.overlay=function(options){var opts=$j.extend({},$j.fn.overlay.defaults,options);return this.each(function(evt){if(!$j(this).hasClass('overlay-trigger')){show(create($j(this),opts),opts);}});};function create($src,opts){$src.addClass('overlay-trigger');var iTop=0;if($j.browser.mozilla&&opts.container.toString()==='body'){iTop=$j('html').scrollTop();}else{iTop=$j(opts.container).scrollTop();}
var overlay=$j('<div></div>').addClass('overlay').css({background:opts.color,opacity:opts.opacity,top:opts.container.toString()==='body'?iTop:$j(opts.container).offset().top,left:$j(opts.container).offset().left,width:opts.container==='body'?'100%':$j(opts.container).width(),height:opts.container==='body'?'100%':$j(opts.container).height(),position:'absolute',zIndex:1000,display:'none',overflow:'hidden'});if(opts.glossy){applyGloss(opts,overlay);}
if(opts.closeOnClick){$j(overlay).click(function(){close(overlay,opts);$src.removeClass('overlay-trigger');});}
$j(opts.container).append(overlay);return overlay;}
function show(overlay,opts){switch(opts.effect.toString().toLowerCase()){case'fade':$j(overlay).fadeIn('fast',opts.onShow);break;case'slide':$j(overlay).slideDown('fast',opts.onShow);break;default:$j(overlay).show(opts.onShow);break;}
$j(opts.container).css('overflow','hidden');}
function close(overlay,opts){switch(opts.effect.toString().toLowerCase()){case'fade':$j(overlay).fadeOut('fast',function(){opts.onHide();$j(this).remove();});break;case'slide':$j(overlay).slideUp('fast',function(){opts.onHide();$j(this).remove();});break;default:$j(overlay).hide();if(opts.onHide){opts.onHide();}
$j(overlay).remove();break;}
$j(opts.container).css('overflow','auto');}
function applyGloss(opts,overlay){var gloss=$j('<div></div>');$j(gloss).css({background:'#fff',opacity:0.2,width:'200%',height:'100%',position:'absolute',zIndex:1001,msTransform:'rotate(45deg)',webkitTransform:'rotate(45deg)',oTransform:'rotate(45deg)'});if($j.browser.mozilla){$j(gloss).css('-moz-transform','rotate(45deg');}
$j(overlay).append(gloss);}
$j.fn.overlay.defaults={color:'#000',opacity:0.5,effect:'none',onShow:null,onHide:null,closeOnClick:false,glossy:false,container:'body'};})(jQuery);