
//----------------------------------------------------------------

var Site = {
    build: 7823,
}

var $doc = $(document)
var $body = $('body')

//----------------------------------------------------------------

function dlog(input){ if( Site.is_local ) return console.log(input) }

function is_touch_device() { return ( 'ontouchstart' in window || navigator.msMaxTouchPoints ) }

function rand( min, max ){ return Math.floor(Math.random() * (max - min + 1)) + min }
function randFromArray(list) { return list[Math.floor((Math.random()*list.length))] }

function shuffleArray(arr) { var currentIndex = arr.length, temporaryValue, randomIndex; while (0 !== currentIndex) { randomIndex = Math.floor(Math.random() * currentIndex); currentIndex -= 1; temporaryValue = arr[currentIndex]; arr[currentIndex] = arr[randomIndex]; arr[randomIndex] = temporaryValue; } return arr; }

function setCookie(name,value,days) { var expires = ""; if (days) { var date = new Date(); date.setTime(date.getTime() + (days*24*60*60*1000)); expires = "; expires=" + date.toUTCString(); } document.cookie = name + "=" + (value || "")  + expires + "; secure; path=/"; }
function getCookie(name) { var nameEQ = name + "="; var ca = document.cookie.split(';'); for(var i=0;i < ca.length;i++) { var c = ca[i]; while (c.charAt(0)==' ') c = c.substring(1,c.length); if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length); } return null; }
function clearCookie(name) { document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;' }

function validateEmail(a){var t=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;return t.test(a)}
function validateString(s){ if( !s || !s.length || s=='' || !s.trim().length ) return false; return true }

// underscore throttle
function throttle(n,l,t){var a,u,e,r=null,i=0;t||(t={});var o=function(){i=!1===t.leading?0:Date.now(),r=null,e=n.apply(a,u),r||(a=u=null)};return function(){var c=Date.now();i||!1!==t.leading||(i=c);var p=l-(c-i);return a=this,u=arguments,p<=0||p>l?(r&&(clearTimeout(r),r=null),i=c,e=n.apply(a,u),r||(a=u=null)):r||!1===t.trailing||(r=setTimeout(o,p)),e}}

function flashClass($el,cls,timeout){ $el.addClass(cls); setTimeout(()=>{ $el.removeClass(cls) },timeout) }

function getDomain(url) { return url.replace('http://','').replace('https://','').split('/')[0] }

function getUrlVars() { var vars = {}; var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) { vars[key] = value; }); return vars; }

function unscramble_email(input) { if( !input ) return input; let output = input; output = output.split('').reverse().join(''); output = output.replace('[snabela]', '@'); output = output.split('e826').join(''); return output; }
function unscramble_phone(input) { if( !input ) return input; let output = input; output = output.split('').reverse().join(''); output = output.split('p826').join(''); return output; }

function val_min_max( val, min, max ) { return Math.max(Math.min(val, max), min) }
function val_min( val, min ) { return Math.max(val, min) }
function val_max( val, max ) { return Math.min(val, max) }

function $el2el(el){ if(!el) { return }; return ( el instanceof jQuery ) ? el[0] : el }
function el2$el(el){ if(!el) { return }; return ( el instanceof jQuery ) ? el : $(el) }

// will clone a JS object with functions and self reference intact, src: https://stackoverflow.com/questions/4459928/how-to-deep-clone-in-javascript
function deepClone(n){if(null==n||"object"!=typeof n)return n;var r=new n.constructor;for(var e in n)n.hasOwnProperty(e)&&(r[e]=deepClone(n[e]));return r}
function deepClone2(r){if(!r)return r;let e,n=Array.isArray(r)?[]:{};for(const o in r)e=r[o],n[o]="object"==typeof e?copy(e):e;return n}
function deepClone3(x){ return JSON.parse(JSON.stringify(x)) }
function deepClone4(e,n=new WeakMap){if(Object(e)!==e)return e;if(n.has(e))return n.get(e);const t=e instanceof Set?new Set(e):e instanceof Map?new Map(Array.from(e,([e,t])=>[e,deepClone(t,n)])):e instanceof Date?new Date(e):e instanceof RegExp?new RegExp(e.source,e.flags):e.constructor?new e.constructor:Object.create(null);return n.set(e,t),Object.assign(t,...Object.keys(e).map(t=>({[t]:deepClone(e[t],n)})))}

//function deepMerge(...arguments){let e={},r=r=>{for(let t in r)r.hasOwnProperty(t)&&(e[t]=r[t])};for(let e=0;e<arguments.length;e++)r(arguments[e]);return e}

function ucfirst(str){ return str.charAt(0).toUpperCase() + str.slice(1); }
function slugify(x){ x = x.toLowerCase(); x = x.split('ø').join('oe'); x = x.split('æ').join('ae'); x = x.split('å').join('aa'); x = x.split('_').join('-'); x = x.replace(/\s+/g, '-'); x = x.replace(/[^\w\-]+/g, ''); x = x.replace(/\-\-+/g, '-'); x = x.replace(/^-+/, ''); x = x.replace(/-+$/, ''); return x }
function unslugify(x){ x = x.split('-').join(' '); x = x.split('oe').join('ø'); x = x.split('ae').join('æ'); x = x.split('aa').join('å'); x = ucfirst(x); return x }

function generate_uid(){ return 'xxxxxxxx'.replace(/[xy]/g, function(c) { var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8); return v.toString(16); }) }


// shortcut for document.querySelectorAll()
function qsa(q,el){ if( !el ) { el = document }; return el.querySelectorAll(q) }
function qs(q,el){ let r = qsa(q,el); if( r && r.length && r.length > 1 ) { return r[0]; } else { return r; } }

function getActiveClassNameInArray( $el, classnames ){ for( let c of classnames ) if( $el.hasClass(c) ) return c }
function getActiveClassIndexInArray( $el, classnames ){ for( let [ i, classname ] of Object.entries(classnames) ) if( $el.hasClass(classname) ) return parseInt(i) }
function changeToNextClassInArray( $el, classnames ){ let active_i = 0; let i = 0; for( let classname of classnames ) { if( $el.hasClass(classname) ) { active_i = i } i++ } let old_classname = classnames[active_i]; let new_classname = ( classnames[active_i+1] ) ? classnames[active_i+1] : classnames[0]; $el.removeClass(old_classname).addClass(new_classname); }

function format_money_us(val,decs){ if( decs == undefined ) { decs = 2; } return Number(val).toLocaleString('en-US', { minimumFractionDigits: decs, maximumFractionDigits: decs, }) }
function format_money_dk(val,decs){ if( decs == undefined ) { decs = 2; } return Number(val).toLocaleString('da-DK', { minimumFractionDigits: decs, maximumFractionDigits: decs, }) }
function format_money(val,decs){ return format_money_dk(val,decs) }

function is_file_url(url){ if(!url) return false; for( let x of 'jpg,jpeg,png,webp,pdf,doc,docx,rtf,txt,mp4,mov,m4v,m4a,avi'.split(',') ) { if( url.includes('.'+x) ) { return true } } return false }

function removeClassesStartingWith($el,prefix){ var classes = $el[0].className.split(" ").filter(function(c) { return c.lastIndexOf(prefix, 0) !== 0 }); $el[0].className = classes.join(" ").trim() }

//----------------------------------------------------------------

// Magic - https://stackoverflow.com/questions/9811429/html5-audio-tag-on-safari-has-a-delay
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioCtx = new AudioContext();

function playAudio(sound, volume) {

  var url = '/assets/sfx/' + sound
  var audio = new Audio(url)

  if( typeof volume == "number" ) {
    audio.volume = volume;
  }

  audio.currentTime = 0
  audio.play();

}

// Works on iphone landscape
// https://developers.google.com/web/fundamentals/native-hardware/fullscreen

window.scrollTo(0,1);
 $(window).resize(function () {
    window.scrollTo(0,1);
});

//----------------------------------------------------------------
// MODALS
//----------------------------------------------------------------

Site.modalBuild = function(input){

	if( !input ) input = {}
	if( input.id && $('.modal[data-id="'+input.id+'"]').length ) return $('.modal[data-id="'+input.id+'"]').addClass('active')
	var cls = []
	if( input.type ) cls.push('type-'+input.type)
	if( input.look ) cls.push('look-'+input.look)
	if( input.active !== false ) cls.push('active')
	if( input.dimClose !== false ) cls.push('dim-closable')
	if( input.selfDestructing !== false ) cls.push('self-destructing')
	var html_closer = '<div class="closer">X</div>'; if( input.closeBtn == false ) html_closer = ''
	var html = '<div class="modal '+cls.join(' ')+'" data-id="'+input.id+'"><div class="dim"></div><div class="popup">'
	if( input.title ) html += '<div class="title">'+input.title+html_closer+'</div>'
	if( !input.title ) html += html_closer	
	input.html = input.html || input.text || input.content
	html += '<div class="inner">'+input.html+'</div></div></div>'
	$('body').append(html)
}


Site.msg = function( input ){
	if( typeof input !== 'object' ) input = { html:input }  
	input.type = 'msg'
	input.html = input.html || input.text || input.content
	if( input.dimClose == undefined ) input.dimClose = false
	if( input.closeBtn == undefined ) input.closeBtn = false
	if( input.selfDestructing == undefined ) input.selfDestructing = true
	if( !input.okText ) input.okText = 'Ok'
	input.html += '<div class="msg-ok-btn">'+input.okText+'</div>'
	Site.modalBuild(input)
  }

Site.confirm = function( input ){
	input.type = 'confirm'
	input.html = input.html || input.text || input.content
	if( input.dimClose == undefined ) input.dimClose = false
	if( input.closeBtn == undefined ) input.closeBtn = true
	if( input.selfDestructing == undefined ) input.selfDestructing = true
	if( !input.okText ) input.okText = 'Ok'
	if( !input.cancelText ) input.cancelText = 'Annullér'	  
	input.html += '<div class="confirm-btns"><div class="confirm-cancel-btn">'+input.cancelText+'</div><div class="confirm-ok-btn">'+input.okText+'</div></div>'	
	window.onConfirmOkayCallback = input.onOkay
	window.onConfirmCancelCallback = input.onCancel	
	Site.modalBuild(input)	
}

$doc.on('click', '.modal .closer, .modal.dim-closable .dim, .msg-ok-btn, .confirm-ok-btn, .confirm-cancel-btn', function(){
	var $modal = $(this).closest('.modal')
	
	if(  $modal.hasClass('self-destructing') ) $modal.remove()
	if( !$modal.hasClass('self-destructing') ) $modal.removeClass('active')

	if( $(this).hasClass('confirm-ok-btn') && window.onConfirmOkayCallback ) window.onConfirmOkayCallback()
	if( $(this).hasClass('confirm-cancel-btn') && window.onConfirmCancelCallback ) window.onConfirmCancelCallback()
})

//----------------------------------------------------------------
//----------------------------------------------------------------

//=include _admin.js
//=include _helpers.js
//=include _tv2logo.js

//=include screen/9sernavn.js
//=include screen/klaek.js
//=include screen/teleportering.js
//=include screen/puslespil.js
//=include screen/kort.js
//=include screen/kravle9sere.js
