/*****
* CONFIGURATION
*/

// Active ajax page loader
$.ajaxLoad = true;

//required when $.ajaxLoad = true
$.path = window.location.href,
$.loading = true,
$.defaultPage = 'main.html';
$.subPagesDirectory = 'views/';
$.page404 = 'views/pages/404.html';
$.mainContent = $('#ui-view');
$.loadAssets = false;

//Main navigation
$.navigation = $('nav > ul.nav');

$.loadJsFiles = [];

$.panelIconOpened = 'icon-arrow-up';
$.panelIconClosed = 'icon-arrow-down';

//Default colours
$.brandPrimary =  '#20a8d8';
$.brandSuccess =  '#4dbd74';
$.brandInfo =     '#63c2de';
$.brandWarning =  '#f8cb00';
$.brandDanger =   '#f86c6b';

$.grayDark =      '#2a2c36';
$.gray =          '#55595c';
$.grayLight =     '#818a91';
$.grayLighter =   '#d1d4d7';
$.grayLightest =  '#f8f9fa';

'use strict';

/*****
* ASYNC LOAD
* Load JS files and CSS files asynchronously in ajax mode
*/
function loadJS(jsFiles, pageScript) {

  var body = document.getElementsByTagName('body')[0];

  for(var i = 0; i<jsFiles.length; i++){
    appendScript(body, jsFiles[i]);
  }

  if (pageScript) {
    appendScript(body, pageScript);
  }

  init();
}

function requestJS(jsFiles){
  Promise.each(jsFiles, function(jsObj){
    if (jsObj.state && !check_array_exist($.loadJsFiles, jsObj.link)) {
      $.loadJsFiles.push(jsObj.link);
      return $.getScript(jsObj.link);
    }
    else if (!jsObj.state) {
      return $.getScript(jsObj.link);
    }
  }).then(function(status){
    if (status.length == jsFiles.length) {
        $.loadAssets = true;
    }
  }).catch(function(error){
    console.error({error:error});
  });
}

function appendScript(element, src) {
  var async = (src.substring(0, 4) === 'http');
  var script = document.createElement('script');
  script.type = 'text/javascript';
  // script.async = async;
  script.defer = true;
  script.src = src;
  script.setAttribute('data-resource', 'once');
  async ? appendOnce(element, script, 'script') : element.appendChild(script);
}

function appendOnce(element, script, tag, before) {
  var scripts = Array.from(document.querySelectorAll(tag)).map(function(scr){
    if (tag == 'script') {
      script_attr = script.src;
      return scr.src;
    }
    else if (tag == 'link[rel="stylesheet"]') {
      script_attr = script.href;
      return scr.href;
    }
  });

  if (!scripts.includes(script_attr)) {
    if (before == '') {
      element.appendChild(script);
    }
    else{
      element.insertBefore(script, before);
    }
  }
}

function loadCSS(cssFile, end, callback) {

  var cssArray = {};

  if (!cssArray[cssFile]) {
    cssArray[cssFile] = true;

    if (end == 1) {

      $.each(cssFile, function(index, cssObj){
        var head = document.getElementsByTagName('head')[0];
        var s = document.createElement('link');
        s.setAttribute('rel', 'stylesheet');
        s.setAttribute('type', 'text/css');
        s.setAttribute('href', cssObj.link);

        if (cssObj.state == false) {
          s.setAttribute('data-resource', 'once');
        }

        s.onload = callback;
        appendOnce(head, s, 'link[rel="stylesheet"]');
      });
      /*for(var i = 0; i<cssFile.length; i++){
        head.appendChild(s);
      }*/

    } else {

      $.each(cssFile, function(index, cssObj){
        var head = document.getElementsByTagName('head')[0];
        var style = document.getElementById('main-style');

        var s = document.createElement('link');
        s.setAttribute('rel', 'stylesheet');
        s.setAttribute('type', 'text/css');
        s.setAttribute('href', cssObj.link);

        if (cssObj.state == false) {
          s.setAttribute('data-resource', 'once');
        }

        s.onload = callback;
        appendOnce(head, s, 'link[rel="stylesheet"]', style);
        /*head.insertBefore(s, style);*/
      });

      /*for(var i = 0; i<cssFile.length; i++){
        
      }*/

    }

  } else if (callback) {
    callback();
  }

}

/****
* AJAX LOAD
* Load pages asynchronously in ajax mode
*/

if ($.ajaxLoad) {

  var paceOptions = {
    elements: false,
    restartOnRequestAfter: false
  };

  var url = window.location.href;
  if (window.location.hash) {
    url = url.replace(window.location.hash, '');
  }

  if (url != '') {
    setUpUrl(url);
  } else {
    setUpUrl($.defaultPage);
  }

  $(document).on('click', '.nav a[href!="#"], a.ajax-load-page', function(e) {
    var thisNav = $(this).parent().parent();
    if ( thisNav.hasClass('nav-tabs') || thisNav.hasClass('nav-pills') ) {
      e.preventDefault();
    } else if ( $(this).attr('target') == '_top' ) {
      e.preventDefault();
      var target = $(e.currentTarget);
      window.location = (target.attr('href'));
    } else if ( $(this).attr('target') == '_blank' ) {
      e.preventDefault();
      var target = $(e.currentTarget);
      window.open(target.attr('href'));
    } else {
      e.preventDefault();
      var target = $(e.currentTarget);
      $.path = target.attr('href');
      setUpUrl(target.attr('href'));
    }
  });

  $(document).on('click', 'a[href="#"]', function(e) {
    e.preventDefault();
  });

  $(document).on('click', '.sidebar .nav a[href!="#"]', function(e) {
    if (document.body.classList.contains('sidebar-mobile-show')) {
      document.body.classList.toggle('sidebar-mobile-show');
    }
  });

}

function setUpUrl(url) {

  $('nav .nav li .nav-link').removeClass('active');
  $('nav .nav li.nav-dropdown').removeClass('open');
  $('nav .nav li:has(a[href="' + url.split('?')[0] + '"]), nav .nav li:has(a[href="' + url.split('?')[0] + '/"])').addClass('open');
  $('nav .nav a[href="' + url.split('?')[0] + '"], nav .nav a[href="' + url.split('?')[0] + '/"]').addClass('active');

  loadPage(url);
}

function rand_val(num){
  if (num == null) {
    num = 20;
  }
  var string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
  var str_length = string.length;
  var val = '';
  for (var i=1; i <= num ; i++) {
    var start = Math.floor(Math.random() * str_length);
    val += string[start];
  }
  return val;
}

function loadPage(url) {
    var rld = '?request_view=true&' + rand_val();
    $.ajax({
        type : 'GET',
        url : url + rld,
        dataType : 'json',
        data: {req_info:true},
        cache : false,
        async: true,
        beforeSend : function() {
            /*$.mainContent.css({ opacity : 0 });*/
            $.loadAssets = false;
            $('.nav a[href!="#"], a.ajax-load-page').css('pointer-events','none');
            $('.container-fluid').hide();
            if ($.loading == false) {
                $.loading = true;
                $('main.main').LoadingOverlay("show",{
                    color: "rgba(255, 255, 255, 2)",
                    zIndex: 1000,
                    image:image_overlay_path,
                    custom:$("<div>",{
                            id:"loading-overlay-text",
                            css:{
                                "font-weight":"bold",
                                "margin-top": "40px"
                            },
                        text:"Memuat Halaman",
                    }),
                });
                var loading_text = $('#loading-overlay-text').text();
                var i = 0;
                loading_interval = setInterval(function(){
                    $('#loading-overlay-text').append('. ');
                    i++;
                    if (i == 4) {
                        $('#loading-overlay-text').html(loading_text);
                        i = 0;
                    }
                },400);
            }
        },
        success : function(respons,status) {
            if (status == 'success' && respons.status_page == 'success') {
                /*Pace.restart();*/
                reBreadcrumb(respons.breadcrumb);
                $('title').text(respons.title_page);
                $('[data-resource="once"]').remove();
                $('html, body').animate({ scrollTop: 0 }, 0);
                $.mainContent.load(url + rld + '&data=true', null, function (responseText) {
                    window.history.pushState(null,null,url);
                    var waitLoadAssets = setInterval(function () {
                        if ($.loadAssets === true) {
                            $.loadAssets = false;
                            $.loading = false;
                            clearInterval(waitLoadAssets);
                            clearInterval(loading_interval);
                            $('.container-fluid').fadeIn('fast');
                            $('main.main').LoadingOverlay("hide");
                            $('.nav a[href!="#"], a.ajax-load-page').css('pointer-events','');
                        }
                    }, 1000);
                }).delay(150).animate({ opacity : 1 }, 0);
            }
            else if (status == 'success' && respons.status_page == 'page_error') {
                reBreadcrumb();
                $('title').text('Error 404 | Page Not Found');
                $('html, body').animate({ scrollTop: 0 }, 0);
                $.mainContent.load(page_not_found + rld + '&data=true&template=backend/core_ui/', null, function (responseText) {
                    window.history.pushState(null,null,url);
                    Pace.on('done', function(){
                        $('.container-fluid').fadeIn('fast');
                        $('main.main').LoadingOverlay("hide");
                        $('.nav a[href!="#"], a.ajax-load-page').css('pointer-events','');
                        $.loading = false;
                        clearInterval(loading_interval);
                    });
                }).delay(150).animate({ opacity : 1 }, 0);
            }
            else if (status == 'success' && respons.login_rld) {
                setUpUrl(url);
            }
            else{
                $('.nav a[href!="#"], a.ajax-load-page').css('pointer-events','');
            }
        },
        error : function(status) {
            if (status.status == '200') {
                var error_status = 'No Respon From Server';
            }
            else if (status.status == '500') {
                var error_status = 'Page Is Temporarily Unavailable.';
            }
            else{
                var error_status = 'Error From Server';
            }
            reBreadcrumb();
            $('title').text('Error 500 | ' + error_status);
            $('html, body').animate({ scrollTop: 0 }, 0);
            $.mainContent.load(page_error + rld + '&data=true&template=backend/core_ui/', null, function (responseText) {
                window.history.pushState(null,null,url);
                Pace.on('done', function(){
                    $('.container-fluid').fadeIn('fast');
                    $('main.main').LoadingOverlay("hide");
                    $('.nav a[href!="#"], a.ajax-load-page').css('pointer-events','');
                    $.loading = false;
                    clearInterval(loading_interval);
                });
            }).delay(150).animate({ opacity : 1 }, 0);
            /*window.location.href = $.page404;*/
        }
    });
}

function reBreadcrumb(dt){
  var first_breadcrumb = $('.first-breadcrumb-item'),
  breadcrumb_menu = $('.breadcrumb-menu');
  $('ol.breadcrumb').html(first_breadcrumb);
  if (dt) {
    $.each(dt, function(index, data){
      $('ol.breadcrumb').append(
        '<li class="breadcrumb-item dynamic-breadcrumb">'+
        '  <a href="'+data.link+'" class="ajax-load-page">'+
        '    '+data.icon+' '+data.title+
        '  </a>'+
        '</li>'
      );
    });
  }
  $('ol.breadcrumb').append(breadcrumb_menu);
}

/****
* MAIN NAVIGATION
*/

$(document).ready(function($){

  // Add class .active to current link - AJAX Mode off
  $.navigation.find('a').each(function(){

    var cUrl = String(window.location).split('?')[0];

    if (cUrl.substr(cUrl.length - 1) == '#') {
      cUrl = cUrl.slice(0,-1);
    }

    if ($($(this))[0].href==cUrl) {
      $(this).addClass('active');

      $(this).parents('ul').add(this).each(function(){
        $(this).parent().addClass('open');
      });
    }
  });

  // Dropdown Menu
  $.navigation.on('click', 'a', function(e){

    if ($.ajaxLoad) {
      e.preventDefault();
    }

    if ($(this).hasClass('nav-dropdown-toggle')) {
      $(this).parent().toggleClass('open');
      resizeBroadcast();
    }
  });

  function resizeBroadcast() {

    var timesRun = 0;
    var interval = setInterval(function(){
      timesRun += 1;
      if(timesRun === 5){
        clearInterval(interval);
      }
      if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
        var evt = document.createEvent('UIEvents');
        evt.initUIEvent('resize', true, false, window, 0);
        window.dispatchEvent(evt);
      } else {
      window.dispatchEvent(new Event('resize'));
      }
    }, 62.5);
  }

  /* ---------- Main Menu Open/Close, Min/Full ---------- */
  $('.sidebar-toggler').click(function(){
    $('body').toggleClass('sidebar-hidden');
    resizeBroadcast();
  });

  $('.sidebar-minimizer').click(function(){
    $('body').toggleClass('sidebar-minimized');
    resizeBroadcast();
  });

  $('.brand-minimizer').click(function(){
    $('body').toggleClass('brand-minimized');
  });

  $('.aside-menu-toggler').click(function(){
    $('body').toggleClass('aside-menu-hidden');
    resizeBroadcast();
  });

  $('.mobile-sidebar-toggler').click(function(){
    $('body').toggleClass('sidebar-mobile-show');
    resizeBroadcast();
  });

  $('.sidebar-close').click(function(){
    $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
  });

  /* ---------- Disable moving to top ---------- */
  $('a[href="#"][data-top!=true]').click(function(e){
    e.preventDefault();
  });

});

/****
* CARDS ACTIONS
*/

$('.card-actions').on('click', 'a, button', function(e){
  e.preventDefault();

  if ($(this).hasClass('btn-close')) {
    $(this).parent().parent().parent().fadeOut();
  } else if ($(this).hasClass('btn-minimize')) {
    // var $target = $(this).parent().parent().next('.card-body').collapse({toggle: true});
    if ($(this).hasClass('collapsed')) {
      $('i',$(this)).removeClass($.panelIconOpened).addClass($.panelIconClosed);
    } else {
      $('i',$(this)).removeClass($.panelIconClosed).addClass($.panelIconOpened);
    }
  } else if ($(this).hasClass('btn-setting')) {
    $('#myModal').modal('show');
  }

});

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function init(url) {

  /* ---------- Tooltip ---------- */
  $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});

  /* ---------- Popover ---------- */
  $('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();

}

// Production steps of ECMA-262, Edition 6, 22.1.2.1
if (!Array.from) {
  Array.from = (function () {
    var toStr = Object.prototype.toString;
    var isCallable = function (fn) {
      return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
    };
    var toInteger = function (value) {
      var number = Number(value);
      if (isNaN(number)) { return 0; }
      if (number === 0 || !isFinite(number)) { return number; }
      return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
    };
    var maxSafeInteger = Math.pow(2, 53) - 1;
    var toLength = function (value) {
      var len = toInteger(value);
      return Math.min(Math.max(len, 0), maxSafeInteger);
    };

    // The length property of the from method is 1.
    return function from(arrayLike/*, mapFn, thisArg */) {
      // 1. Let C be the this value.
      var C = this;

      // 2. Let items be ToObject(arrayLike).
      var items = Object(arrayLike);

      // 3. ReturnIfAbrupt(items).
      if (arrayLike == null) {
        throw new TypeError('Array.from requires an array-like object - not null or undefined');
      }

      // 4. If mapfn is undefined, then let mapping be false.
      var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
      var T;
      if (typeof mapFn !== 'undefined') {
        // 5. else
        // 5. a If IsCallable(mapfn) is false, throw a TypeError exception.
        if (!isCallable(mapFn)) {
          throw new TypeError('Array.from: when provided, the second argument must be a function');
        }

        // 5. b. If thisArg was supplied, let T be thisArg; else let T be undefined.
        if (arguments.length > 2) {
          T = arguments[2];
        }
      }

      // 10. Let lenValue be Get(items, "length").
      // 11. Let len be ToLength(lenValue).
      var len = toLength(items.length);

      // 13. If IsConstructor(C) is true, then
      // 13. a. Let A be the result of calling the [[Construct]] internal method
      // of C with an argument list containing the single item len.
      // 14. a. Else, Let A be ArrayCreate(len).
      var A = isCallable(C) ? Object(new C(len)) : new Array(len);

      // 16. Let k be 0.
      var k = 0;
      // 17. Repeat, while k < len… (also steps a - h)
      var kValue;
      while (k < len) {
        kValue = items[k];
        if (mapFn) {
          A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
        } else {
          A[k] = kValue;
        }
        k += 1;
      }
      // 18. Let putStatus be Put(A, "length", len, true).
      A.length = len;
      // 20. Return A.
      return A;
    };
  }());
}

// https://tc39.github.io/ecma262/#sec-array.prototype.includes
if (!Array.prototype.includes) {
  Object.defineProperty(Array.prototype, 'includes', {
    value: function(searchElement, fromIndex) {

      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }

      // 1. Let O be ? ToObject(this value).
      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. If len is 0, return false.
      if (len === 0) {
        return false;
      }

      // 4. Let n be ? ToInteger(fromIndex).
      //    (If fromIndex is undefined, this step produces the value 0.)
      var n = fromIndex | 0;

      // 5. If n ≥ 0, then
      //  a. Let k be n.
      // 6. Else n < 0,
      //  a. Let k be len + n.
      //  b. If k < 0, let k be 0.
      var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

      function sameValueZero(x, y) {
        return x === y || (typeof x === 'number' && typeof y === 'number' && isNaN(x) && isNaN(y));
      }

      // 7. Repeat, while k < len
      while (k < len) {
        // a. Let elementK be the result of ? Get(O, ! ToString(k)).
        // b. If SameValueZero(searchElement, elementK) is true, return true.
        if (sameValueZero(o[k], searchElement)) {
          return true;
        }
        // c. Increase k by 1.
        k++;
      }

      // 8. Return false
      return false;
    }
  });
}
