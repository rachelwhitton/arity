'use strict';

var _typeof2 = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*

    countUp.js
    by @inorganik

*/

// target = id of html element or var of previously selected html element where counting occurs
// startVal = the value you want to begin at
// endVal = the value you want to arrive at
// decimals = number of decimal places, default 0
// duration = duration of animation in seconds, default 2
// options = optional object of options (see below)

var CountUp = function CountUp(target, startVal, endVal, decimals, duration, options) {

  // make sure requestAnimationFrame and cancelAnimationFrame are defined
  // polyfill for browsers without native support
  // by Opera engineer Erik Möller
  var lastTime = 0;
  var vendors = ['webkit', 'moz', 'ms', 'o'];
  for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
    window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
    window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
  }
  if (!window.requestAnimationFrame) {
    window.requestAnimationFrame = function (callback, element) {
      var currTime = new Date().getTime();
      var timeToCall = Math.max(0, 16 - (currTime - lastTime));
      var id = window.setTimeout(function () {
        callback(currTime + timeToCall);
      }, timeToCall);
      lastTime = currTime + timeToCall;
      return id;
    };
  }
  if (!window.cancelAnimationFrame) {
    window.cancelAnimationFrame = function (id) {
      clearTimeout(id);
    };
  }

  var self = this;

  // default options
  self.options = {
    useEasing: true, // toggle easing
    useGrouping: true, // 1,000,000 vs 1000000
    separator: ',', // character to use as a separator
    decimal: '.', // character to use as a decimal
    easingFn: null, // optional custom easing closure function, default is Robert Penner's easeOutExpo
    formattingFn: null // optional custom formatting function, default is self.formatNumber below
  };
  // extend default options with passed options object
  for (var key in options) {
    if (options.hasOwnProperty(key)) {
      self.options[key] = options[key];
    }
  }
  if (self.options.separator === '') {
    self.options.useGrouping = false;
  }
  if (!self.options.prefix) self.options.prefix = '';
  if (!self.options.suffix) self.options.suffix = '';

  self.d = typeof target === 'string' ? document.getElementById(target) : target;
  self.startVal = Number(startVal);
  self.endVal = Number(endVal);
  self.countDown = self.startVal > self.endVal;
  self.frameVal = self.startVal;
  self.decimals = Math.max(0, decimals || 0);
  self.dec = Math.pow(10, self.decimals);
  self.duration = Number(duration) * 1000 || 2000;

  self.formatNumber = function (nStr) {
    nStr = nStr.toFixed(self.decimals);
    nStr += '';
    var x, x1, x2, rgx;
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? self.options.decimal + x[1] : '';
    rgx = /(\d+)(\d{3})/;
    if (self.options.useGrouping) {
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + self.options.separator + '$2');
      }
    }
    return self.options.prefix + x1 + x2 + self.options.suffix;
  };
  // Robert Penner's easeOutExpo
  self.easeOutExpo = function (t, b, c, d) {
    return c * (-Math.pow(2, -10 * t / d) + 1) * 1024 / 1023 + b;
  };

  self.easingFn = self.options.easingFn ? self.options.easingFn : self.easeOutExpo;
  self.formattingFn = self.options.formattingFn ? self.options.formattingFn : self.formatNumber;

  self.version = function () {
    return '1.7.1';
  };

  // Print value to target
  self.printValue = function (value) {
    var result = self.formattingFn(value);

    if (self.d.tagName === 'INPUT') {
      this.d.value = result;
    } else if (self.d.tagName === 'text' || self.d.tagName === 'tspan') {
      this.d.textContent = result;
    } else {
      this.d.innerHTML = result;
    }
  };

  self.count = function (timestamp) {

    if (!self.startTime) {
      self.startTime = timestamp;
    }

    self.timestamp = timestamp;
    var progress = timestamp - self.startTime;
    self.remaining = self.duration - progress;

    // to ease or not to ease
    if (self.options.useEasing) {
      if (self.countDown) {
        self.frameVal = self.startVal - self.easingFn(progress, 0, self.startVal - self.endVal, self.duration);
      } else {
        self.frameVal = self.easingFn(progress, self.startVal, self.endVal - self.startVal, self.duration);
      }
    } else {
      if (self.countDown) {
        self.frameVal = self.startVal - (self.startVal - self.endVal) * (progress / self.duration);
      } else {
        self.frameVal = self.startVal + (self.endVal - self.startVal) * (progress / self.duration);
      }
    }

    // don't go past endVal since progress can exceed duration in the last frame
    if (self.countDown) {
      self.frameVal = self.frameVal < self.endVal ? self.endVal : self.frameVal;
    } else {
      self.frameVal = self.frameVal > self.endVal ? self.endVal : self.frameVal;
    }

    // decimal
    self.frameVal = Math.round(self.frameVal * self.dec) / self.dec;

    // format and print value
    self.printValue(self.frameVal);

    // whether to continue
    if (progress < self.duration) {
      self.rAF = requestAnimationFrame(self.count);
    } else {
      if (self.callback) {
        self.callback();
      }
    }
  };
  // start your animation
  self.start = function (callback) {
    self.callback = callback;
    self.rAF = requestAnimationFrame(self.count);
    return false;
  };
  // toggles pause/resume animation
  self.pauseResume = function () {
    if (!self.paused) {
      self.paused = true;
      cancelAnimationFrame(self.rAF);
    } else {
      self.paused = false;
      delete self.startTime;
      self.duration = self.remaining;
      self.startVal = self.frameVal;
      requestAnimationFrame(self.count);
    }
  };
  // reset to startVal so animation can be run again
  self.reset = function () {
    self.paused = false;
    delete self.startTime;
    self.startVal = startVal;
    cancelAnimationFrame(self.rAF);
    self.printValue(self.startVal);
  };
  // pass a new endVal and start animation
  self.update = function (newEndVal) {
    cancelAnimationFrame(self.rAF);
    self.paused = false;
    delete self.startTime;
    self.startVal = self.frameVal;
    self.endVal = Number(newEndVal);
    self.countDown = self.startVal > self.endVal;
    self.rAF = requestAnimationFrame(self.count);
  };

  // format startVal on initialization
  self.printValue(self.startVal);
};

;(function ($, window, document) {

  var disableScroll = function disableScroll(disable, context) {
    if (disable !== false) {
      debug('disableScroll: disable', disable);

      $('body').on('scroll.disableScroll mousewheel.disableScroll touchmove.disableScroll', function (evt) {

        if (context && $(evt.currentTarget, $(context)).length) {
          return;
        }

        evt.preventDefault();
        evt.stopPropagation();
        return false;
      });
    } else {
      debug('disableScroll: enable', disable);

      $('body').off('scroll.disableScroll mousewheel.disableScroll touchmove.disableScroll');
    }
  };

  window.disableScroll = disableScroll;
})(jQuery, window, document);

;(function ($, window, document) {

  var log = {
    init: function init() {
      window.debug = function (a) {
        if (!log.shouldDebug()) {
          return function () {};
        }
        var context = "%cdebug:";
        return Function.prototype.bind.call(console.log, console, context, 'color:blue');
      }();
    },
    shouldDebug: function shouldDebug() {
      if (app.env('production')) {
        return false;
      }

      if (localStorage.getItem("debug")) {
        return localStorage.getItem("debug");
      }

      if (app.env('development')) {
        return true;
      }

      return false;
    }
  };

  window.log = log;
})(jQuery, window, document);

(function ($, sr) {

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function debounce(func, threshold, execAsap) {
    var timeout;

    return function debounced() {
      var obj = this,
          args = arguments;
      function delayed() {
        if (!execAsap) func.apply(obj, args);
        timeout = null;
      };

      if (timeout) clearTimeout(timeout);else if (execAsap) func.apply(obj, args);

      timeout = setTimeout(delayed, threshold || 100);
    };
  };
  // onResize
  $.fn[sr] = function (fn) {
    return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
  };

  $(window).onResize(function () {
    $(window).trigger("onResize");
  });
})(jQuery, 'onResize');

// usage:
// $(window).onResize(function(){
//   // code that takes it easy...
// });

(function ($, window) {

  var smartOutline = {
    defaults: {
      debug: false,
      domId: 'smartOutline',
      hideFocusCSS: '*:focus {outline:0 !important;}::-moz-focus-inner{border:0;}',
      keycodes: [{ name: 'tab', code: 9 }, { name: 'space', code: 32 }, { name: 'left', code: 37 }, { name: 'up', code: 38 }, { name: 'right', code: 39 }, { name: 'down', code: 40 }]
    },
    init: function init(opts) {
      this._ = {};
      this._options = jQuery.extend(this.defaults, opts);

      debug('smartOutline.init: start', this._options);

      // Bind mouse detection
      window.addEventListener('mouseover', smartOutline.mouseListener);

      // Build <style> tag in HEAD
      var head = document.head || document.getElementsByTagName('head')[0];
      var style = document.createElement('style');
      style.id = this._options.domId;
      style.type = 'text/css';

      // Maybe there's no head
      if (!head) return false;

      return head.appendChild(style);
    },
    mouseListener: function mouseListener() {
      debug('smartOutline.mouseListener: Triggered');

      smartOutline.setCSS(smartOutline._options.hideFocusCSS);
      $('html').removeClass('outline-enabled').addClass('outline-disabled');
      window.removeEventListener('mouseover', smartOutline.mouseListener, false);
      window.addEventListener('keydown', smartOutline.keyboardListener); // eslint-disable-line
    },
    keyboardListener: function keyboardListener(evt) {
      debug('smartOutline.keyboardListener: Triggered');

      // only remove the outline if the user is using one of the keyboard
      // navigation keys
      if (smartOutline._options.keycodes.findIndex(function (obj) {
        return obj.code === evt.keyCode;
      }) === -1) {
        return;
      }

      smartOutline.setCSS('');
      $('html').removeClass('outline-disabled').addClass('outline-enabled');
      window.removeEventListener('keydown', smartOutline.keyboardListener, false);
      window.addEventListener('mouseover', smartOutline.mouseListener);
    },
    getStyleEl: function getStyleEl() {
      return document.getElementById(this._options.domId);
    },
    setCSS: function setCSS(css) {
      this.getStyleEl().innerHTML = css;
    },
    destroy: function destroy() {
      debug('smartOutline.destroy: Triggered');

      var el = this.getStyleEl();
      if (el) {
        var head = document.head || document.getElementsByTagName('head')[0];
        head.removeChild(el);

        window.removeEventListener('keydown', smartOutline.keyboardListener, false);
        window.removeEventListener('mouseover', smartOutline.mouseListener, false);
      }
    }
  };

  window.smartOutline = smartOutline;
})(jQuery, window);

// For accordion module - from Bootstrap's collapse.js

;(function ($, window, document) {

  var accordion = {
    init: function init() {
      // Bootstrap methods
      $('.item').on('show.bs.collapse', function (e) {
        $(this).parent().children('.accordion-item').children('.item-row').children('.item-row-header').children('.ar-element').children('svg').addClass('minus');

        // Toggle aria-hidden attribute
        $(this).attr('aria-hidden', 'false');
      }).on('hide.bs.collapse', function (e) {
        $(this).parent().children('.accordion-item').children('.item-row').children('.item-row-header').children('.ar-element').children('svg').removeClass('minus');

        // Toggle aria-hidden attribute
        $(this).attr('aria-hidden', 'true');
      });
    }
  };

  window.accordion = accordion;
})(jQuery, window, document);

(function ($, window, document) {
  var actionBar = {
    init: function init() {
      $(document).ready(function () {
        changeRulePosition();
      });

      $(window).resize(function () {
        changeRulePosition();
      });

      function changeRulePosition() {
        var nwidth = $(".container").css("width").replace("px", "");

        $(".action-bar").each(function (i) {
          if (nwidth <= 540) {
            $(this).addClass("action-bar_" + i);
            var h = $(this).find(".action-bar__left").height() + 40 + 50;
            var nHeight = h + "px";
            addStylesheetRules([[".action-bar_" + i + ":before", ["top", nHeight, true]]], true);
          }
        });
      }

      /*
      addStylesheetRules([
        ['h2', // Also accepts a second argument as an array of arrays instead
          ['color', 'red'],
          ['background-color', 'green', true] // 'true' for !important rules 
        ], 
        ['.myClass', 
          ['background-color', 'yellow']
        ]
      ]);
      */
      function addStylesheetRules(rules, isMobile) {
        var styleEl = document.createElement("style");
        var isMobilePre = "";
        var isMobilePost = "";

        if (isMobile) {
          isMobilePre = "@media only screen and (max-width: 768px) {";
          isMobilePost = "}";
        }

        // Append <style> element to <head>
        document.head.appendChild(styleEl);

        // Grab style element's sheet
        var styleSheet = styleEl.sheet;

        for (var i = 0; i < rules.length; i++) {
          var j = 1,
              rule = rules[i],
              selector = rule[0],
              propStr = "";
          // If the second argument of a rule is an array of arrays, correct our variables.
          if (Array.isArray(rule[1][0])) {
            rule = rule[1];
            j = 0;
          }

          for (var pl = rule.length; j < pl; j++) {
            var prop = rule[j];
            propStr += prop[0] + ": " + prop[1] + (prop[2] ? " !important" : "") + ";\n";
          }

          // Insert CSS Rule
          styleSheet.insertRule(isMobilePre + selector + "{" + propStr + "}" + isMobilePost, styleSheet.cssRules.length);
        }
      }
    }
  };
  window.actionBar = actionBar;
})(jQuery, window, document);

;(function ($, window, document) {

  var analytics = {
    init: function init() {},

    /**
    * Function that calls both the Google Analytics & Omniture event code
    */
    globalEvent: function globalEvent(hitType, eventCategory, eventAction, eventLabel) {
      // NOTE tracking has been moved to GTM
      // debug("---------------------------");
      // debug("analytics.globalEvent()");
      // debug('hitType: ', hitType);
      // debug('eventCategory: ', eventCategory);
      // debug('eventAction: ', eventAction);
      // debug('eventLabel: ', eventLabel);
      // debug("---------------------------");
      //
      // if(!app.env('production') || typeof ga == 'undefined') {
      //   return;
      // }
      //
      // ga('send', {
      // 	hitType: hitType,
      // 	eventCategory: eventCategory,
      // 	eventAction: eventAction,
      // 	eventLabel: eventLabel
      // });
      return;
    }
  };

  window.analytics = analytics;
})(jQuery, window, document);

;(function ($, window, document) {

  var astronaut = {
    init: function init() {
      if ($('#emailform_modal').length) {
        if (window.location.hash && window.location.hash == '#thank-you') {
          $('#emailform_modal').modal("show");
        }
      }
    }
  };

  window.astronaut = astronaut;
})(jQuery, window, document);

;(function ($, window, document) {

  var blogNav = {
    init: function init() {
      $(function () {
        $('#blog-pagination').change(function () {
          window.location = $('#blog-pagination').val();
        });
      });
    }
  };

  window.blogNav = blogNav;
})(jQuery, window, document);

;(function ($, window, document) {

  var careers = {
    modalHasBeenShown: false,
    triggers: '',
    offset: '',
    init: function init() {

      if ($('.careers-table__error').length) {
        $('.careers-table__error a[target=_blank]').on('click', function (ev) {
          if (!careers.modalHasBeenShown) {
            ev.preventDefault();
            var currLink = $(this).attr('href');
            var btnHtml = $('#careers_modal #listing_href').html().replace("View position", "View positions");
            $('#careers_modal #listing_href').html(btnHtml);
            $('#careers_modal').modal("show");
            $('#listing_href').attr('href', currLink).focus();
            careers.modalHasBeenShown = true;
          }
        });
        $(document).keydown(function (event) {
          if (event.keyCode == 27) {
            $('#careers_modal').modal('hide');
          }
        });
      }

      if (!$('#careers_feed').length || _typeof2($('#careers_feed').attr('data-disable-feed')) !== undefined || $('#careers_feed').find('.career-link').length) {
        careers.onLoad();
        return;
      }

      debug("careers.init Triggered");

      var ajaxUrl = app._settings.baseUrl + "/php/readrss.php";
      if (window.location.hostname.indexOf('localhost') !== -1) {
        // Local development url
        ajaxUrl = "https://dev.patterns.arity.vsadev.com/php/readrss.php";
      }

      var setError = util.getParameterByName('error');

      if (setError) {
        ajaxUrl = "/xml/jobsearh.xml";
      }

      $.ajax({
        type: "GET",
        url: ajaxUrl,
        cache: false,
        dataType: "xml",
        success: function success(xml) {
          var sortedXML = [];

          ////////////////////////////////////////////////////////////////////////////////
          // WITHOUT LOCATION AND CATEGORY
          ////////////////////////////////////////////////////////////////////////////////
          // sorting
          $(xml).find('item').each(function () {
            var title = $(this).find('title').text().replace(/-/g, " ").replace(/Arity /g, "");

            title = title.replaceLastOccurrence('Arity', '');

            sortedXML.push({
              title: title,
              link: $(this).find('link').text()
            });
          });

          function SortByName(a, b) {
            var aTitle = a.title.toLowerCase();
            var bTitle = b.title.toLowerCase();
            return aTitle < bTitle ? -1 : aTitle > bTitle ? 1 : 0;
          }

          sortedXML.sort(SortByName);

          var appendText = [];
          var jobCount = 0;

          $.each(sortedXML, function () {
            jobCount++;

            var jobTitle = this.title;
            var jobLink = this.link.replace(/ /g, "");

            appendText.push('<a class="career-link" href=" ' + jobLink + '" target="_blank" >');
            appendText.push('<div class="careers-table__row">');
            appendText.push('<div class="careers-table__cell careers-table__job-title">' + jobTitle + '</div>');
            appendText.push('<div class="careers-table__cell careers-table__link-button"><div href="#" class="ar-element button button--circle blue-button--"><svg class="icon-svg" title="" role="img"><use xlink:href="#external"></use></svg></div></div>');
            appendText.push('</div></a>');
            appendText.push('<div class="careers-table__border"></div>');
          });
          $('#careers_feed').append(appendText.join(''));
          $('#job_count').text(jobCount);
        },
        error: function error(_error) {
          $('.careers-table__error').css('display', 'block');
          $('.block_jobCount').css('display', 'none');
        }
      }).done(function () {
        careers.onLoad();
      });
    },
    onLoad: function onLoad() {
      var careerPositionTitle = false;

      if ($('#careers_modal #listing_href').length) {
        $('#careers_modal #listing_href').on('click', function (ev) {
          //analytics.globalEvent('event', 'Link', 'event_careersLink', 'Link to Allstate Career: ' + careerPositionTitle);
          $('#careers_modal').modal('hide');
        });
      }

      if ($('.career-link').length) {
        $('.career-link').on('click', function (ev) {
          careerPositionTitle = $(ev.currentTarget).find('.careers-table__job-title').text();
          if (!careers.modalHasBeenShown) {
            ev.preventDefault();
            var currLink = $(this).attr('href');
            $('#careers_modal').modal("show");
            $('#listing_href').attr('href', currLink).focus();
            careers.modalHasBeenShown = true;
          } else {
            //analytics.globalEvent('event', 'Link', 'event_careersLink', 'Link to Allstate Career: ' + careerPositionTitle);
            $('#careers_modal').modal('hide');
          }
        });
        $(document).keydown(function (event) {
          if (event.keyCode == 27) {
            $('#careers_modal').modal('hide');
          }
        });
      }
    }
  };

  window.careers = careers;
})(jQuery, window, document);

/* global transitionEvent */

(function ($, window, document) {
  var checkGDPR = {
    defaults: {
      debug: false // Dont leave this as true
    },
    init: function init(opts) {
      $(document).ready(function () {
        console.log("checkGDPR init");

        //page--contact
        if (!$(".page--contact").length) {
          return;
        }

        var that = this;
        var url = "/geoip/";
        //var url = "https://dev.arity/geoip/";
        $.ajax({
          url: url
        }).done(function (data) {
          var countryList = ["AT", "BE", "BG", "HR", "CY", "CZ", "DK", "EE", "FI", "FR", "DE", "GR", "HU", "IE", "LV", "LT", "LU", "MT", "NL", "PL", "PT", "RO", "SK", "SI", "ES", "SE", "GB"];
          console.log("GDPR done", data);

          var currentCountry = data.trim();
          // console.log('Header found country: ' + currentCountry);
          if (countryList.indexOf(currentCountry) !== -1) {
            console.log("GDPR COUNTRY");

            var element = document.getElementById("00Nf400000RFoMR");
            if (typeof element != "undefined" && element != null) {
              document.getElementById("00Nf400000RFoMR").checked = false;
            }
          }
        });
      });
    }
  };

  window.checkGDPR = checkGDPR;
})(jQuery, window, document);

/* global transitionEvent */

(function ($, window, document) {
  var checkPopup = {
    defaults: {
      debug: false // Dont leave this as true
    },
    init: function init(opts) {
      console.log("checkPopup init");
      if (!$("div").hasClass("blogPopup1")) {
        console.log("checkPopup init stop");
        return;
      }
      console.log("checkPopup init Start");
      var popupTrigger = 1;

      if ($(location).attr("href") == $("#HTTP_REFERER").val()) {
        console.log("SHOW Conformation and do not trigger scroll thing.");
        showPopupBox1();
        popupTrigger = 0;
      }

      function updatePopupStatus() {
        console.log("Update POPUP status");
        var cookieCheck = getCookie("cookieBanner-agreed") ? 1 : 0;
        if (cookieCheck) {
          console.log("COOKIE IS AVAILABLE set new status");
          setCookie("cookie-showPopup", "0");
          if (!popupTrigger) {
            showPopupBox1();
          } else {
            showPopupBox();
          }
        } else {
          var url = "popup/?a=update&showPopup=0";
          $.ajax({
            url: url,
            success: function success(result) {
              if (!popupTrigger) {
                showPopupBox1();
              } else {
                showPopupBox();
              }
            }
          });
        }
      }

      function showPopupBox() {
        console.log("showPopupBox Clicked");
        var hidden = $(".blogPopup");
        var screenWidth = $(window).width();
        if (hidden.hasClass("visible")) {
          if (screenWidth > 479) {
            hidden.animate({ right: "-100%" }, "slow").removeClass("visible");
          } else {
            hidden.animate({ bottom: "-150%" }, "slow").removeClass("visible");
          }
        } else {
          if (screenWidth > 479) {
            hidden.animate({ right: "0" }, "slow").addClass("visible");
          } else {
            hidden.animate({ bottom: "0" }, "slow").addClass("visible");
          }
        }
      }

      function showPopupBox1() {
        console.log("Me Clicked");
        var hidden = $(".blogPopup1");
        var screenWidth = $(window).width();
        if (hidden.hasClass("visible")) {
          if (screenWidth > 479) {
            hidden.animate({ right: "-100%" }, "slow").removeClass("visible");
          } else {
            hidden.animate({ bottom: "-100%" }, "slow").removeClass("visible");
          }
        } else {
          if (screenWidth > 479) {
            hidden.animate({ right: "0" }, "slow").addClass("visible");
          } else {
            hidden.animate({ bottom: "0" }, "slow").addClass("visible");
          }
        }
      }

      function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
      }

      function setCookie(name, value, days) {
        var expires = "";
        if (days) {
          var date = new Date();
          date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
          expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
      }

      $(".btnClose").click(function () {
        updatePopupStatus();
      });

      var scrollTrigger = 0;
      $(document).scroll(function () {
        if (!popupTrigger) {
          console.log("Disable scroll");
          return;
        }
        if (!scrollTrigger) {
          console.log("SCROLL TRIGGER");
          scrollTrigger = 1;
          var showPopupTime = $(".popupTime").attr("data-time");
          console.log("showPopupTime: ", showPopupTime);
          if (showPopupTime == 0) {
            console.log("Stop Timer for showPopupTime: ", showPopupTime);
            return;
          }
          console.log("Start Timer for showPopupTime: ", showPopupTime);
          setTimeout(function () {
            //Step 1: Checks Cookie is enabled or not
            var cookieCheck = getCookie("cookieBanner-agreed") ? 1 : 0;
            if (cookieCheck) {
              console.log("COOKIE IS AVAILABLE");

              if (typeof getCookie("cookie-showPopup") == "undefined") {
                console.log("cookie-showPopup not defined");
                setCookie("cookie-showPopup", "1");
              }

              var showPopup = getCookie("cookie-showPopup");
              console.log("showPopup", showPopup, getCookie("cookie-showPopup"));

              if (showPopup == 1) {
                console.log("SHOW POPUP and HANDLE IT in COOKIES");
                showPopupBox();
              } else {
                console.log("DO NOT SHOW POPUP and HANDLE IT in COOKIES");
              }
            } else {
              // Cookie is not avaiable handle in PHP Session
              console.log("COOKIE IS NOT AVAILABLE HANDLE in PHP");
              var url = "popup/";
              $.ajax({
                url: url,
                success: function success(result) {
                  console.log(result);
                  var data = JSON.parse(result);
                  console.log(data.showPopup);
                  if (data.showPopup == 1) {
                    console.log("LAUNCH POPUP");
                    showPopupBox();
                  } else {
                    console.log("STOP POPUP");
                  }
                }
              });
            }
          }, showPopupTime * 1000); // 20 Second
        }
      });
    }
  };

  window.checkPopup = checkPopup;
})(jQuery, window, document);

;(function ($, window, document) {

  var contact = {
    init: function init() {
      if ($('#thankyou_modal').length) {
        if (window.location.hash && window.location.hash == '#thank-you') {
          $('#thankyou_modal').modal("show");
        }
      }
    }
  };

  window.contact = contact;
})(jQuery, window, document);

/* global transitionEvent */

(function ($, window, document) {
  var cookieBanner = {
    defaults: {
      debug: false, // Dont leave this as true
      cookiePath: "/",
      cookieDomain: null,
      cookieSecure: false,
      expires: Infinity,
      message: ""
    },
    init: function init(opts) {
      /*  Commented to show on every page
        if (!$(".page--home-v2").length) {
          return;
        }
      */
      this._options = jQuery.extend(this.defaults, opts);

      if (app.env(["development", "staging"]) && getParam("debug")) {
        this._options.debug = true;
      }

      // SET THIS TO NULL WHEN DEPLOYING TO LIVE
      this._options.devRegion = null;

      debug("cookieBanner.init: start", this._options);

      var default_text = "We use cookies to enhance your experience. " + "By continuing to visit this site you agree to our use of cookies.";

      this._ = {};
      this.cookie = window.cookies;
      this._.cookies = [];
      this._.rendered = false;
      this._.closed = false;
      this._.el = this.template();
      this._.elGDPR = this.templateGDPR();
      this._.isGDPR = false;

      console.log('this._.cookies["agreed"]: ' + this._.cookies["agreed"]);
      console.log('cookieBanner-agreed: ' + this.cookie.get("cookieBanner-agreed") || null);
      console.log('this._.cookies["optout"]: ' + this._.cookies["optout"]);
      console.log('cookieBanner-optout: ' + this.cookie.get("cookieBanner-optout") || null);

      if (!this.getAgreed()) {
        var that = this;
        var url = "/geoip/";
        //var url = "https://dev.arity/geoip/";
        $.ajax({
          url: url
        }).done(function (data) {
          var countryList = ["AT", "BE", "BG", "HR", "CY", "CZ", "DK", "EE", "FI", "FR", "DE", "GR", "HU", "IE", "LV", "LT", "LU", "MT", "NL", "PL", "PT", "RO", "SK", "SI", "ES", "SE", "GB"];
          console.log("done", data);

          var currentCountry = data.trim();
          // console.log('Header found country: ' + currentCountry);
          if (countryList.indexOf(currentCountry) !== -1 || that._options.devRegion == 'GDPR') {
            console.log("GDPR COUNTRY");
            that._.isGDPR = true;

            var element = document.getElementById("00Nf400000RFoMR");
            if (typeof element != "undefined" && element != null) {
              document.getElementById("00Nf400000RFoMR").checked = false;
            }
            if (!that.getOptOut()) {
              that.render();
            } else {
              console.log("GDPR USER HAS OPTED OUT OF COOKIE TRACKING");
              return;
            }
          } else {
            // console.log('Not in array');
            console.log("NOT A GDPR COUNTRY");
            console.log('init() → initGTag()');
            that.initGTag();
            that.render();
          }

          setTimeout(function () {
            that.open();
          }.bind(that), 450);
        }).fail(function () {
          that.render();
          setTimeout(function () {
            that.open();
          }.bind(that), 450);
        });
      }

      debug("cookieBanner.init: complete", this);
    },
    render: function render() {
      //console.log(this._.isGDPR);
      //this.$el = $(this._.el);

      if (this._.isGDPR) {
        this.$el = $(this._.elGDPR);
      } else {
        this.$el = $(this._.el);
      }

      $("body").append(this.$el);
      this.$close = $(".close", this.$el);

      if (this._.isGDPR) {
        this.$optOut = $(".opt-out", this.$el);
      }

      this.eventListeners();
    },
    loadScript: function loadScript(url, callback) {
      var script = document.createElement("script");
      script.type = "text/javascript";

      if (script.readyState) {
        //IE
        script.onreadystatechange = function () {
          if (script.readyState == "loaded" || script.readyState == "complete") {
            script.onreadystatechange = null;
            callback();
          }
        };
      } else {
        //Others
        script.onload = function () {
          callback();
        };
      }

      script.src = url;
      document.getElementsByTagName("head")[0].appendChild(script);
    },
    initGTag: function initGTag() {
      if (this._.cookies["agreed"]) {
        console.log("initGTag");
        (function (w, d, s, l, i) {
          w[l] = w[l] || [];
          w[l].push({
            "gtm.start": new Date().getTime(),
            event: "gtm.js"
          });
          var f = d.getElementsByTagName(s)[0],
              j = d.createElement(s),
              dl = l != "dataLayer" ? "&l=" + l : "";
          j.async = true;
          j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
          f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-KH6GQ88");
        console.log("Adobe DTM Header Start");
        // old script => "//assets.adobedtm.com/b46e318d845250834eda10c5a20827c045a4d76f/satelliteLib-0893390c40d93db48cc0d98a10c4fe9f90b72e2c.js"
        var prodUrl = "//assets.adobedtm.com/b46e318d845250834eda10c5a20827c045a4d76f/satelliteLib-0893390c40d93db48cc0d98a10c4fe9f90b72e2c.js";
        var url = "//assets.adobedtm.com/launch-ENc4322642c62a433b8800953e029d68b6-staging.min.js"; // non Prod URL;

        if ($("#main").hasClass("live")) {
          console.log("Prod URL");
          url = prodUrl;
        } else {
          console.log("non-Prod URL");
        }

        this.loadScript(url, function () {
          //initialization code
          var my_awesome_script1 = document.createElement("script");
          my_awesome_script1.innerHTML = "_satellite.pageBottom();";
          document.body.appendChild(my_awesome_script1);
          console.log("Adobe DTM Footer Stop", document.body);
        });

        var my_awesome_script = document.createElement("noscript");
        var iframe = document.createElement("iframe");
        iframe.setAttribute("src", "https://www.googletagmanager.com/ns.html?id=GTM-KH6GQ88");
        iframe.setAttribute("height", 0);
        iframe.setAttribute("width", 0);
        iframe.setAttribute("style", "display:none;visibility:hidden");
        my_awesome_script.appendChild(iframe);
        document.body.appendChild(my_awesome_script);
      } else {
        console.log("initGTag → GDPR opted out of GTM cookie tracking");
      }
    },
    getOptOut: function getOptOut() {
      if (this._options.debug) {
        return false;
      }
      if (!this._.cookies["optout"]) {
        this._.cookies["optout"] = this.cookie.get("cookieBanner-optout") || false;
      }

      if (this._.cookies["optout"]) {
        console.log("GDPR opted out of tracking cookies");
      }

      return this._.cookies["optout"];
    },
    setOptOut: function setOptOut(bool) {
      if (!bool) {
        bool = true;
      }
      var boolNum = bool ? 1 : 0;

      debug("cookieBanner.setOptOut:", bool);

      this._.cookies["optout"] = bool;
      this.cookie.set("cookieBanner-optout", boolNum, this._options.expires, this._options.cookiePath, this._options.cookieDomain !== "" ? this._options.cookieDomain : "", this._options.cookieSecure ? true : false);
      this.setAgree(false);
    },
    getAgreed: function getAgreed() {
      if (this._options.debug) {
        return false;
      }

      if (!this.cookie.get("cookieBanner-agreed") || this.cookie.get("cookieBanner-agreed") == 0) {
        this._.cookies["agreed"] = false;
      }
      console.log('EVAL this.cookie.get("cookieBanner-agreed"): ' + this.cookie.get("cookieBanner-agreed"));
      if (this.cookie.get("cookieBanner-agreed") == 1) {
        this._.cookies["agreed"] = true;
        console.log('getAgreed() → initGTag()');
        this.initGTag();
      }

      return this._.cookies["agreed"];
    },
    setAgree: function setAgree(bool) {
      // if (!bool) {
      //   bool = true;
      // }
      var boolNum = bool ? 1 : 0;

      debug("cookieBanner.setAgree:", bool);

      this._.cookies["agreed"] = bool;
      this.cookie.set("cookieBanner-agreed", boolNum, this._options.expires, this._options.cookiePath, this._options.cookieDomain !== "" ? this._options.cookieDomain : "", this._options.cookieSecure ? true : false);
      if (bool) {
        console.log('setAgree() → initGTag()');
        this.initGTag();
      }
    },
    getSeen: function getSeen() {
      if (!this._.cookies["seen"]) {
        this._.cookies["seen"] = this.cookie.get("cookieBanner-seen") || false;
      }

      return this._.cookies["seen"];
    },
    setSeen: function setSeen(bool) {
      if (!bool) {
        bool = true;
      }
      var boolNum = bool ? 1 : 0;

      debug("cookieBanner.setSeen:", bool);

      this._.cookies["seen"] = bool;
      this.cookie.set("cookieBanner-seen", boolNum, this._options.expires, this._options.cookiePath, this._options.cookieDomain !== "" ? this._options.cookieDomain : "", this._options.cookieSecure ? true : false);
    },
    open: function open() {
      debug("cookieBanner.open: start");
      this.$el.removeClass("animate-out");
      this.$el.one(transitionEvent, function () {
        this._.rendered = true;
        debug("cookieBanner.open: complete");
        this.$el.addClass("active");
        // this.setSeen();  // Updated to disable placing cookies before accepting it
      }.bind(this));
    },
    close: function close() {
      debug("cookieBanner.close: start");
      this.$el.addClass("animate-out");
      this.$el.one(transitionEvent, function () {
        this._.closed = true;
        debug("cookieBanner.close: complete");
        this.remove();
      }.bind(this));
    },
    remove: function remove() {
      debug("cookieBanner.remove:");
      this.$el.remove();
      window.cookieBanner = undefined;
    },
    agreeAndClose: function agreeAndClose() {
      debug("cookieBanner.agreeAndClose:");
      this.setAgree(true);
      this.close();
    },
    optOutAndClose: function optOutAndClose() {
      debug("cookieBanner.optOutAndClose:");
      this.setOptOut(true);
      this.close();
    },
    template: function template() {
      var baseUrl = window.location.origin;
      var html = "" + '<div class="cookie-banner animate-out"> ' + '  <div class="cookie-banner__close close" role="button"><svg class="icon-svg" title="" role="img"><use xlink:href="#close"></use></svg></div> ' + '  <div class="cookie-banner__message">Arity.com uses cookies to improve your site experience. If you would like to know more, please read our <a href="' + baseUrl + '/privacy/">privacy statement</a>.</div> ' + "</div> ";

      return html;
    },
    templateGDPR: function templateGDPR() {
      var baseUrl = window.location.origin;
      var html = "" + '<div class="cookie-banner animate-out">' + '  <div class="cookie-banner__gdpr-optout opt-out" role="button"><svg class="icon-svg" title="" role="img"><use xlink:href="#close"></use></svg></div>' + '  <div class="cookie-banner__message GDPR">' + '      <div class="container">' + '          <div class="row">' + '               <div class="col-md-8">' + "                   <strong>Arity.com uses cookies to improve your site experience. </strong><br/><br/>" + '                We use cookies to improve your experience on the Arity website. If you want to learn more about how we use cookies and how you can control them, read our <a href="' + baseUrl + '/cookies/">Cookie Statement</a>. If you accept the terms and conditions of the Cookie Statement, please click the button to continue to arity.com' + "                </div>" + '               <div class="col-md-4">' + '                  <div class="close" role="button"><br/><br/><button type="button" class="button button--primary">I accept cookies</button></div>' + "                </div>" + "          </div>" + "      </div>" + "  </div>" + "</div>";

      return html;
    },
    eventListeners: function eventListeners() {
      this.$close.on("click", this.onCloseTrigger.bind(this));
      if (this.$optOut) {
        this.$optOut.on("click", this.onOptOutTrigger.bind(this));
      }
    },
    onCloseTrigger: function onCloseTrigger(evt) {
      evt.preventDefault();
      this.agreeAndClose();
    },
    onOptOutTrigger: function onOptOutTrigger(evt) {
      evt.preventDefault();
      this.optOutAndClose();
    }
  };

  window.cookieBanner = cookieBanner;
})(jQuery, window, document);

;(function ($, window, document) {

  var cookies = {
    get: function get(key) {
      return decodeURIComponent(document.cookie.replace(new RegExp('(?:(?:^|.*;)\\s*' + encodeURIComponent(key).replace(/[-.+*]/g, '\\$&') + '\\s*\\=\\s*([^;]*).*$)|^.*$'), '$1')) || null;
    },
    set: function set(key, val, end, path, domain, secure) {
      if (!key || /^(?:expires|max-age|path|domain|secure)$/i.test(key)) {
        return false;
      }
      var expires = '';
      if (end) {
        switch (end.constructor) {
          case Number:
            expires = end === Infinity ? '; expires=Fri, 31 Dec 9999 23:59:59 GMT' : '; max-age=' + end;
            break;
          case String:
            expires = '; expires=' + end;
            break;
          case Date:
            expires = '; expires=' + end.toUTCString();
            break;
        }
      }
      document.cookie = encodeURIComponent(key) + '=' + encodeURIComponent(val) + expires + (domain ? '; domain=' + domain : '') + (path ? '; path=' + path : '') + (secure ? '; secure' : '');
      return true;
    },
    has: function has(key) {
      return new RegExp('(?:^|;\\s*)' + encodeURIComponent(key).replace(/[-.+*]/g, '\\$&') + '\\s*\\=').test(document.cookie);
    },
    remove: function remove(key, path, domain) {
      if (!key || !this.has(key)) {
        return false;
      }
      document.cookie = encodeURIComponent(key) + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT' + (domain ? '; domain=' + domain : '') + (path ? '; path=' + path : '');
      return true;
    }
  };

  window.cookies = cookies;
})(jQuery, window, document);

//requires GSAP
//requires ScrollMagic
//requires ScrollMagic GSAP plugin
//= require jquery/dist/jquery.min.js

;(function ($, window, document) {

  var counter = {
    init: function init() {

      var linear = function linear(t, b, c, d) {
        return c * t / d + b;
      };

      var options = {
        easingFn: linear
      };

      counter.counterField = document.querySelectorAll('[data-animvalue]');

      for (var i = 0; i < counter.counterField.length; i++) {
        counter.animValue = counter.counterField[i].dataset.animvalue;

        if (counter.counterField[i].dataset.animstart) {
          counter.animStart = counter.counterField[i].dataset.animstart;
        } else {
          counter.animStart = counter.animValue * .75;
        }

        counter.animDecimal = counter.counterField[i].dataset.animdecimal || '0';
        counter.animElement = counter.counterField[i].id;
        counter.animDuration = counter.counterField[i].dataset.animduration || 0.75;

        counter.id = "#" + counter.counterField[i].getAttribute('id');

        var numAnim = new CountUp(counter.animElement, counter.animStart, counter.animValue, counter.animDecimal, counter.animDuration, options);
        // numAnim.start();

        counter.startAnim(numAnim, counter.id);
      }
    },

    startAnim: function startAnim(obj, trigger) {
      var anim_speed = 0.75;

      var winWidth = jQuery(window).width();
      var offset = -(Math.max(document.documentElement.clientHeight, window.innerHeight || 0) / 3);

      if (winWidth < 900) {
        offset = -(Math.max(document.documentElement.clientHeight, window.innerHeight || 0) / 2);
      }

      var scene = new ScrollMagic.Scene({
        triggerElement: trigger,
        offset: offset,
        duration: 20 + 300 * anim_speed
      }).on('start', function () {
        obj.start();
      }).addTo(controller);

      var testAnim = util.getParameterByName('debug');
      if (testAnim === 'true') {
        scene.addIndicators();
      }
    }

  };

  window.counter = counter;
})(jQuery, window, document);

/* global transitionEvent */

(function ($, window, document) {
  var dataVis = {
    defaults: {
      debug: false // Dont leave this as true
    },
    init: function init(opts) {
      $(window).resize(function () {
        changeIframeWidth();
      });
      function changeIframeWidth() {
        var nwidth = $(".container").css("width").replace("px", "");

        $(".dataVis").each(function (index) {
          if (nwidth >= 1140) {
            console.log("xlarge");
            $(this).css("height", $(this).attr("data-height-xlarge"));
          } else if (nwidth >= 960) {
            console.log("large");
            $(this).css("height", $(this).attr("data-height-large"));
          } else if (nwidth >= 720) {
            console.log("medium");
            $(this).css("height", $(this).attr("data-height-medium"));
          } else if (nwidth >= 540) {
            console.log("small");
            $(this).css("height", $(this).attr("data-height-small"));
          } else {
            console.log("xsmall");
            $(this).css("height", $(this).attr("data-height-small"));
          }
        });
      }
      $(document).ready(function () {
        changeIframeWidth();
      });
    },
    render: function render() {
      console.log("DataVis");
    }
  };

  window.dataVis = dataVis;
})(jQuery, window, document);

;(function ($, window, document) {

  window.animationEvent = function whichAnimationEvent() {
    var t,
        el = document.createElement("fakeelement");

    var animations = {
      "animation": "animationend",
      "OAnimation": "oAnimationEnd",
      "MozAnimation": "animationend",
      "WebkitAnimation": "webkitAnimationEnd"
    };

    for (t in animations) {
      if (el.style[t] !== undefined) {
        return animations[t];
      }
    }
  }();

  window.transitionEvent = function whichTransitionEvent() {
    var t,
        el = document.createElement("fakeelement");

    var transitions = {
      "transition": "transitionend",
      "OTransition": "oTransitionEnd",
      "MozTransition": "transitionend",
      "WebkitTransition": "webkitTransitionEnd"
    };

    for (t in transitions) {
      if (el.style[t] !== undefined) {
        return transitions[t];
      }
    }
  }();
})(jQuery, window, document);

;(function ($, window, document) {

  var form = {
    defaults: {
      sitekey: "6LemsC8UAAAAABhmM91zrsD0Paw7Uxa2MFChpoKY"
    },
    init: function init(opts) {
      this.$forms = $('form');

      if (!this.$forms.length) {
        return false;
      }

      this._ = {};
      this._options = jQuery.extend(this.defaults, opts);

      debug('form.init', this);

      this.$forms.each(function (i, el) {
        this.initForm(el);
      }.bind(this));
    },
    initForm: function initForm(el) {
      var $el = $(el),
          uniqueId = new Date().getTime().toString();

      // Keep backwards compatibility
      var disallowForms = ['form__sms', 'app__form__form'];
      if (disallowForms.indexOf(el.id) !== -1) {
        return;
      }

      debug('form.initForm', $el);

      $el.attr('novalidate', true);
      $el.data('form-id', uniqueId);
      $el.attr('data-form-id', $el.data('form-id'));
      this.loadRecaptcha(el);
      this.initInputMasks(el);
      this.initSelectChange(el);
      this.initConditionals(el);
      $el.on('submit', this.onFormSubmit.bind(this));
      $('input,select,textarea', $el).on('blur', this.onFieldBlur.bind(this));
    },
    onFormSubmit: function onFormSubmit(evt) {
      debug('form.onFormSubmit', evt);

      // Define form
      var form = evt.currentTarget,
          $form = $(form),
          valid = this.validateForm(form);

      // Reset Errors
      this.resetErrors($form);

      // If validation is success
      if (valid.success) {
        debug('form.onFormSubmit: Validation Success');

        // if (evt.originalEvent === undefined) {
        //   debug('form.onFormSubmit: Success', evt);
        //   return;
        // }

        if (this.reCaptchaSubmit(form)) {
          // Prevent form submission since captcha callback will be used
          evt.preventDefault();
          // $form.submit();
        }
      } else {
        evt.preventDefault();
        if (valid.fields && valid.fields.length) {
          $(valid.fields).each(function (i, field) {
            this.displayError(field.el, field.error);
          }.bind(this));
          scroll.to($(valid.fields[0].el)[0].id);
        }
      }
    },
    reCaptchaSubmit: function reCaptchaSubmit(form) {
      var $form = $(form),
          $recaptcha = $('.g-recaptcha', $form);

      if ($recaptcha.length && typeof grecaptcha !== 'undefined') {
        if (!$recaptcha.attr('data-token')) {
          grecaptcha.execute();
          // Return true since captcha has been performed
          return true;
        }
      }

      return false;
    },
    onReCaptchaSucess: function onReCaptchaSucess(token, formId) {
      if (typeof grecaptcha === 'undefined') {
        return false;
      }

      debug('form.onReCaptchaSucess: token formId', token, formId);

      var $form = $('form[data-form-id=' + formId + ']');

      if (!$form.length) {
        grecaptcha.reset();
        return;
      }

      var $captcha = $('.g-recaptcha', $form),
          captcha = $captcha.val(),
          $settings = $('[name=captcha_settings]', $form);

      $captcha.attr('data-token', token);
      if ($settings.length) {
        var settings = JSON.parse($settings.val());
        settings.ts = JSON.stringify(new Date().getTime());
        $settings.val(JSON.stringify(settings));
      }

      grecaptcha.reset();

      if (app.env('development')) {
        var retURL = $('[name=retURL]');
        if ($('[name=retURL]').length) {
          retURL = retURL.val();
        } else {
          retURL = window.location;
        }
        window.location.href = retURL;
        window.location.reload();
      } else {
        $form.submit();
      }
    },
    resetErrors: function resetErrors(form) {
      var $form = $(form);
      $('.form-group.has-error--', $form).removeClass('has-error--').removeAttr('data-error');
    },
    resetError: function resetError(field) {
      var $field = $(field);
      $field.parent('.form-group.has-error--').removeClass('has-error--').removeAttr('data-error');
    },
    onFieldBlur: function onFieldBlur(evt) {
      var valid = this.validateField(evt.currentTarget),
          $form = $(evt.currentTarget).parents('form');

      if (!valid.success) {
        this.displayError(valid.el, valid.error);
      } else {
        this.resetError(valid.el);
      }
    },
    validateForm: function validateForm(form) {
      var $form = $(form),
          status = {
        success: true,
        fields: []
      };

      $('input,select,textarea', $form).each(function (i, el) {
        var validateField = this.validateField(el);
        if (!validateField.success) {
          status.fields.push(validateField);
          status.success = false;
        }
      }.bind(this));

      debug('form.validateForm: status', status);
      return status;
    },
    validateField: function validateField(field) {
      var $field = $(field),
          val = $field.val(),
          valid = {
        success: true,
        el: $field[0]
      };

      if (val.length && typeof val === 'string') {
        val = val.trim();
      }

      // Validate Required
      if ($field.attr('required') || $field.hasClass('required')) {
        if (!val.length) {
          valid.success = false;
          valid.error = 'required';
          return valid;
        }
      }

      // Validate First Name
      if ($field.attr('name') === 'first_name' || $field.attr('name') === 'firstname' || $field.attr('name') === 'fname') {
        if (val.length && !this.validateName(val)) {
          valid.success = false;
          valid.error = 'invalid';
          return valid;
        }
      }

      // Validate Last Name
      if ($field.attr('name') === 'last_name' || $field.attr('name') === 'lastname' || $field.attr('name') === 'lname') {
        if (val.length && !this.validateName(val)) {
          valid.success = false;
          valid.error = 'invalid';
          return valid;
        }
      }

      // Validate Email
      if ($field.attr('name') === 'email' || $field.attr('type') === 'email') {
        if (val.length && !this.validateEmail(val)) {
          valid.success = false;
          valid.error = 'invalid';
          return valid;
        }
      }

      // Validate Phone
      if ($field.attr('name') === 'phone' || $field.attr('type') === 'tel') {
        if (val.length && !this.validatePhone(val)) {
          valid.success = false;
          valid.error = 'invalid';
          return valid;
        }
      }

      return valid;
    },
    validateName: function validateName(name) {
      var re = /^[a-zA-Z\-\_]*$/;
      if (name.length < 2) {
        return false;
      }
      return re.test(name);
    },
    validateEmail: function validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    validatePhone: function validatePhone(phone) {

      // Detect if number starts with plus sign. Must be international.
      if (phone.charAt(0) === '+') {
        phone = phone.substring(1);
        var re = /^[\+]?[0-9]{1,3}?[\ ]?[0-9]{1,16}$/im; // @todo Might be a better way to validate international number
        return re.test(phone);
      }

      phone = phone.split('x')[0];
      phone = phone.trim();

      var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
      return re.test(phone);
    },
    validateSelect: function validateSelect(el) {
      var $el = $(el),
          val = $el.val();

      if (val.length && typeof val === 'string') {
        val = val.trim();
      }
      // This could be a string or an array
      if (!val.length) {
        $el.addClass('invalid');
      } else {
        $el.removeClass('invalid');
      }
    },
    displayError: function displayError(field, errorType) {
      var $field = $(field);

      $field.parent('.form-group').addClass('has-error--');
      $field.parent('.form-group').attr('data-error', errorType);
    },
    clearForm: function clearForm(form) {
      var $form = $(form);
      $form[0].reset();
    },
    loadRecaptcha: function loadRecaptcha(form) {
      debug('form.loadRecaptcha');

      var $form = $(form),
          $recaptcha = $('.g-recaptcha', $form);

      if ($recaptcha.length) {
        $recaptcha.attr('data-callback', 'onRecaptchaSuccess' + $form.data('form-id'));
        $recaptcha.attr('data-sitekey', this._options.sitekey);
        $form.append('<script>var onRecaptchaSuccess' + $form.data('form-id') + ' = function(token) {form.onReCaptchaSucess(token,"' + $form.data('form-id') + '");};</script>');
        util.asyncLoadScript('https://www.google.com/recaptcha/api.js');
      }
    },
    initInputMasks: function initInputMasks(form) {
      var $form = $(form);

      $(":input[data-inputmask]", $form).inputmask();
      $(":input[type=tel]", $form).inputmask({
        // mask: ["999-999-9999 [x99999]", "+099 99 99 9999[9]-9999"],
        mask: ["999-999-9999 [x9999999]", "+9{0,3} [*{1,14}]"], // @todo Might be a better way to mask international numbers
        greedy: false,
        showMaskOnHover: false
      });
    },
    initSelectChange: function initSelectChange(form) {
      var $form = $(form);
      $('select', $form).each(function (i, el) {
        this.validateSelect(el);
        $(el).on('change', function (evt) {
          this.validateSelect(evt.currentTarget);
        }.bind(this));
      }.bind(this));
    },
    initConditionals: function initConditionals(form) {
      var $form = $(form);
      $('.form-conditional', $form).each(function (i, el) {

        var $el = $(el),
            target = $el.attr('data-conditional'),
            $target = $('[name=' + target + ']', $form);

        this.checkConditional(el, form);

        $target.on('change', function (evt) {
          this.checkConditional(el, form);
        }.bind(this));
      }.bind(this));
    },
    checkConditional: function checkConditional(el, form) {
      var $form = $(form),
          $el = $(el),
          target = $el.attr('data-conditional'),
          logic = $el.attr('data-conditional-logic'),
          $target = $('[name=' + target + ']', $form);

      switch (logic) {
        case 'not-empty':

          if ($target.val().trim().length) {
            // Not Empty
            this.changeConditionalStatus(el, true);
            $('.conditional-check-when-not-empty', $el).prop("checked", true);
            $('.conditional-select-when-not-empty', $el).prop("selected", true);
          } else {
            // Empty
            this.changeConditionalStatus(el, false);
            $('.conditional-check-when-empty', $el).prop("checked", true);
            $('.conditional-select-when-empty', $el).prop("selected", true);
          }

          break;

        case 'empty':

          if (!$target.val().trim().length) {
            // Empty
            this.changeConditionalStatus(el, true);
            $('.conditional-check-when-not-empty', $el).prop("checked", true);
            $('.conditional-select-when-not-empty', $el).prop("selected", true);
          } else {
            // Not Empty
            this.changeConditionalStatus(el, false);
            $('.conditional-check-when-empty', $el).prop("checked", true);
            $('.conditional-select-when-empty', $el).prop("selected", true);
          }

          break;

        default:
      }
    },
    changeConditionalStatus: function changeConditionalStatus(el, show) {
      var $el = $(el);

      if (show != false) {
        if ($el.attr('aria-hidden') === 'false') {
          return;
        }

        $el.css({ 'position': 'absolute', 'visibility': 'hidden', 'display': 'block', 'height': 'auto' });
        var height = $el.height() + 'px';
        $el.removeAttr('style');

        $el.data('height', height);
        $el.css({ 'height': '0' });

        setTimeout(function () {
          $el.css({ 'height': height });
          $el.attr('aria-hidden', false);
        }, 30);
      } else {
        if ($el.attr('aria-hidden') === 'true') {
          return;
        }

        $el.css({ 'height': $el.data('height') });

        setTimeout(function () {
          $el.css({ 'height': '0px' });
          $el.attr('aria-hidden', true);

          $el.one(window.transitionEvent, function () {
            $el.removeAttr('style');
          });
        }, 30);
      }
    }
  };

  window.form = form;
})(jQuery, window, document);

;(function ($, window, document) {

  var formValidator = {
    navlinks: [],
    control: '',
    formValidated: false,
    init: function init() {
      var form = $(".leadgen-form form").add('.lite-form form');

      if (!form.length) {
        return;
      }

      debug('formValidator.init', form);

      formValidator.loadRecaptcha();
      formValidator.clearForm(form);
      form.on('submit', formValidator.onSubmit);
    },

    applyRules: function applyRules() {
      if (formValidator.byId('r1') || formValidator.byId('r2') || formValidator.byId('r3')) {
        if (formValidator.byId('email').value.trim() != '') {
          if (formValidator.byId('phone').value.trim() == '') formValidator.byId('r1').checked = true;else formValidator.byId('r3').checked = true;
        }
      }
    },

    validateForm: function validateForm() {
      try {
        var validated = {};
        validated.valid = true;
        validated.el = [];

        if (!formValidator.byId('first_name').value || formValidator.byId('first_name').value.trim() == '') {
          formValidator.byId('first_name_required').style.display = 'inline';
          formValidator.byId('first_name').style.border = '1px solid #FF0000';
          validated.valid = false;
          validated.el.push(formValidator.byId('first_name'));
        } else {
          formValidator.byId('first_name_required').style.display = 'none';
          formValidator.byId('first_name').style.border = '0px';

          var validName = formValidator.validateName(formValidator.byId('first_name').value.trim());

          if (validName) {
            formValidator.byId('first_name_valid').style.display = 'none';
            formValidator.byId('first_name').style.border = '0px';
          } else {
            formValidator.byId('first_name_valid').style.display = 'inline';
            formValidator.byId('first_name').style.border = '1px solid #FF0000';
            validated.valid = false;
            validated.el.push(formValidator.byId('first_name'));
          }
        }

        if (!formValidator.byId('last_name').value || formValidator.byId('last_name').value.trim() == '') {
          formValidator.byId('last_name_required').style.display = 'inline';
          formValidator.byId('last_name').style.border = '1px solid #FF0000';
          validated.valid = false;
          validated.el.push(formValidator.byId('last_name'));
        } else {
          formValidator.byId('last_name_required').style.display = 'none';
          formValidator.byId('last_name').style.border = '0px';

          var validName = formValidator.validateName(formValidator.byId('last_name').value.trim());

          if (validName) {
            formValidator.byId('last_name_valid').style.display = 'none';
            formValidator.byId('last_name').style.border = '0px';
          } else {
            formValidator.byId('last_name_valid').style.display = 'inline';
            formValidator.byId('last_name').style.border = '1px solid #FF0000';
            validated.valid = false;
            validated.el.push(formValidator.byId('last_name'));
          }
        }

        console.log(formValidator.byId('email'));
        if (!formValidator.byId('email').value || formValidator.byId('email').value.trim() == '') {
          formValidator.byId('email_required').style.display = 'inline';
          formValidator.byId('email').style.border = '1px solid #FF0000';
          validated.valid = false;
          validated.el.push(formValidator.byId('email'));
        } else {
          formValidator.byId('email_required').style.display = 'none';
          formValidator.byId('email').style.border = '0px';

          var validEmail = formValidator.validateEmail(formValidator.byId('email').value.trim());

          if (validEmail) {
            formValidator.byId('email_valid').style.display = 'none';
            formValidator.byId('email').style.border = '0px';
          } else {
            formValidator.byId('email_valid').style.display = 'inline';
            formValidator.byId('email').style.border = '1px solid #FF0000';
            validated.valid = false;
            validated.el.push(formValidator.byId('email'));
          }
        }

        if (formValidator.byId('r2')) {
          if (formValidator.byId('r2').checked && formValidator.byId('phone').value.trim() == '') {
            formValidator.byId('phone_required').style.display = 'inline';
            formValidator.byId('phone').style.border = '1px solid #FF0000';
            validated.valid = false;
            validated.el.push(formValidator.byId('phone'));
          } else {
            formValidator.byId('phone_required').style.display = 'none';
            formValidator.byId('phone').style.border = '0px';
          }
        }

        if (formValidator.byId('phone').value && formValidator.byId('phone').value.trim() !== '') {
          var validPhone = formValidator.validatePhone(formValidator.byId('phone').value);

          if (validPhone) {
            formValidator.byId('phone_valid').style.display = 'none';
            formValidator.byId('phone').style.border = '0px';
          } else {
            formValidator.byId('phone_valid').style.display = 'inline';
            formValidator.byId('phone').style.border = '1px solid #FF0000';
            validated.valid = false;
            validated.el.push(formValidator.byId('phone'));
          }
        }

        return validated;
      } catch (ex) {
        // alert(ex)
        console.log("--FORM ERROR-------------------------");
        console.log(ex);
        console.log("---------------------------");
      }
    },

    validateName: function validateName(name) {
      var re = /^[a-zA-Z]*$/;
      if (name.length < 2) {
        return false;
      }
      return re.test(name);
    },

    validateEmail: function validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },

    validatePhone: function validatePhone(phone) {
      var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
      return re.test(phone);
    },

    byId: function byId(c) {
      return $('#' + c, $('form'))[0];
    },

    clearForm: function clearForm(form) {
      form = $(form);
      form[0].reset();
    },

    onChange: function onChange(e) {
      // formValidator.validateForm();
    },

    onSubmit: function onSubmit(e) {
      debug('formValidator.onSubmit', e);

      if (!formValidator.formValidated) {
        e.preventDefault();

        var valid = formValidator.validateForm();

        if (valid && valid.valid) {
          debug('formValidator.onSubmit: validateForm success', valid);
          debug('formValidator.onSubmit: Should excecute captcha');
          grecaptcha.execute();
        } else {
          debug('formValidator.onSubmit: validateForm failure', valid);
          if (valid && valid.el && valid.el[0]) {
            scroll.to(valid.el[0].id);
          }
        }
      } else {
        formValidator.clearForm(e.currentTarget);
        if (app.env('development')) {
          return false;
        }
      }
    },

    loadRecaptcha: function loadRecaptcha() {
      var recaptcha = document.getElementById('recaptcha');
      if (recaptcha) {
        util.asyncLoadScript('https://www.google.com/recaptcha/api.js');
      }
    },

    onSuccess: function onSuccess(token) {
      formValidator.formValidated = true;
      debug('formValidator.onSubmit: Success');
      var form = $(".leadgen-form form").add('.lite-form form');
      var leadSource = $('input[name="lead_source"]', form) ? $('input[name="lead_source"]', form).attr('value') : "";
      //analytics.globalEvent('event', 'Form', 'form_submit', leadSource + "Form Submit");
      form.submit();
    }
  };

  window.formValidator = formValidator;
})(jQuery, window, document);

//= require scroll.js
// Accessibility Guidelines: https://www.w3.org/TR/wai-aria-practices/examples/menubar/menubar-1/menubar-1.html

;(function ($, window, document) {

  var mainNavigation = {
    defaults: {
      debug: false
    },
    init: function init(opts) {
      this._ = {};
      this._options = jQuery.extend(this.defaults, opts);
      this.$el = $('.site-header');
      this.$toggle = $('.navbar__toggle', this.$el);
      this._.toggleClass = this.$toggle.attr('data-toggle');
      this._.toggleTarget = this.$toggle.attr('data-target');
      this.$toggleTarget = $(this._.toggleTarget);
      this.$menuItemsParents = $('.navbar__nav .menu-item-has-children > a', this.$el);
      this.$menuItems = $('.navbar__nav a', this.$el);
      this.$dropmenus = $('.dropmenu', this.$el);

      if (!this.$el.length) {
        return;
      }

      debug('mainNavigation.init: start', this._options);

      this.render();

      debug('mainNavigation.init: complete', this);
    },
    render: function render() {
      this.eventListeners();
      this.initScrollAnimation();
      this.initDropmenus();
      this.navbarInit();
      this.addBackdrop();
      //this.analytics();
    },
    eventListeners: function eventListeners() {
      $('a', this.$el).on('click.siteHeaderLink', this.onLinkClick.bind(this));
    },
    initScrollAnimation: function initScrollAnimation() {
      if (!controller) {
        return;
      }

      var is_home = $('body').hasClass('page--home');

      // Calculate the offset based on window size
      var offset = function offset() {
        if ($(window).width() < 960) {
          return 10;
        }

        if (is_home) {
          return 120;
        }

        return 50;
      };

      // Define Scene
      var scene = new ScrollMagic.Scene({
        offset: offset()
      }).setClassToggle(this.$el[0], "animate-in").addTo(controller);

      // Resize offset when the screen size changes
      $(window).onResize(function () {
        scene.offset(offset());
      });
    },
    onLinkClick: function onLinkClick(evt) {
      var $el = $(evt.currentTarget),
          target = $el.attr('href');

      // Handle menu links that contain an #
      if (target && target.indexOf('#') !== -1) {
        target = target.split('#');
        target = target[target.length - 1];

        if (target && target.length) {
          target = '#' + target;
          if (!$(target).length) {
            return;
          }

          evt.preventDefault();

          var scrollOffset = scroll.options.scrollOffset;

          // Homepage is weird
          if ($('body.page--home').length) {
            scroll.options.scrollOffset = scroll.options.fixedHeaderHeight * -1;
          }

          if (this.isNavbarOpen()) {
            this.navbarClose(function () {
              scroll.to(target);
              scroll.options.scrollOffset = scrollOffset;
            });
          } else {
            scroll.to(target);
            scroll.options.scrollOffset = scrollOffset;
          }
        }
      }
    },
    onToggleClick: function onToggleClick(evt) {
      evt.preventDefault();
      this.navbarToggle();
    },
    navbarInit: function navbarInit() {
      this.navbarOverviewLinks();
      this.navbarParentArrowIcon();
      this.$toggle.on('click.siteHeader', this.onToggleClick.bind(this));
    },
    navbarOverviewLinks: function navbarOverviewLinks() {
      if (!this.$menuItemsParents.length) {
        return;
      }

      this.$menuItemsParents.each(function (i, el) {
        var $el = $(el),
            elAttrs = $el.prop("attributes"),
            linkHtml = '',
            attrs = '',
            $submenu = $el.parent().find('.sub-menu');

        // Copy allowed attributes to link el
        var allowedAttrs = ['href', 'title', 'role'];
        $.each(elAttrs, function () {
          if (allowedAttrs.indexOf(this.name) !== -1) {
            attrs += ' ' + this.name + '="' + this.value + '"';
          }
        });

        // Add Tabindex
        attrs += ' tabindex="-1"';

        // Build link el
        linkHtml = '<a' + attrs + '>Overview</a<>';

        $submenu.prepend('<li class="menu-item menu-overview">' + linkHtml + '</li>');
      });

      // This need to be redone now. Jerk.
      this.$menuItems = $('.navbar__nav a', this.$el);
    },
    navbarParentArrowIcon: function navbarParentArrowIcon() {
      if (!this.$menuItemsParents.length) {
        return;
      }

      this.$menuItemsParents.each(function (i, el) {
        var $el = $(el);
        $el.html($el.html() + util.svgIcon('caret'));
      });
    },
    navbarToggle: function navbarToggle() {
      if (this.isNavbarOpen()) {
        this.navbarClose();
      } else {
        this.navbarOpen();
      }
    },
    navbarClose: function navbarClose(cb) {
      if (!this.isNavbarOpen()) {
        return false;
      }

      $(window).trigger('navbarClose');
      disableScroll(false);
      debug('mainNavigation.navbarClose: Start');

      this.$toggleTarget.off(window.transitionEvent + '.navbarOpen');
      this.$toggleTarget.off(window.transitionEvent + '.navbarClose');
      this.$menuItems.off('click.navbarOpen');

      if (this.$menuItemsParents.length) {
        this.$menuItemsParents.off('click.siteHeader');
      }
      this.$backdrop.off('click.siteHeader');
      $(window).off('onResize.navbarOpen');

      this.$toggle.attr('aria-expanded', false);
      this.$toggle.removeClass('is-active');
      this.$toggleTarget.addClass('collapsing');

      // Animation Start
      setTimeout(function () {
        this.$toggleTarget.addClass(this._.toggleClass);
        this.$backdrop.removeClass('animate-in');

        this.$toggleTarget.on(window.transitionEvent + '.navbarClose', function () {
          this.$toggleTarget.off(window.transitionEvent + '.navbarClose');
          debug('mainNavigation.navbarClose: End');
          this.$toggleTarget.removeClass('collapsing');
          this.$backdrop.addClass('hidden');
          this.resetParents();
          if (cb && typeof cb === 'function') {
            cb();
          }
        }.bind(this));
      }.bind(this), 10);
    },
    navbarOpen: function navbarOpen(cb) {
      if (this.isNavbarOpen()) {
        return false;
      }

      $(window).trigger('navbarOpen');
      disableScroll(true, this.$toggleTarget);
      debug('mainNavigation.navbarOpen: Start');

      this.$toggleTarget.off(window.transitionEvent + '.navbarClose');
      this.$toggleTarget.off(window.transitionEvent + '.navbarOpen');

      this.$menuItems.on('click.navbarOpen', function (evt) {
        var $el = $(evt.currentTarget);
        if (!$el.closest('li').hasClass('menu-item-has-children')) {
          this.navbarClose();
        }
      }.bind(this));

      // Close the nav when user resizes screen
      $(window).on('onResize.navbarOpen', function () {
        if ($(window).width() > 960) {
          this.navbarClose();
        }
      }.bind(this));

      // Open the first parent. @DD#287
      if (this.$menuItemsParents.length) {
        this.parentOpen(this.$menuItemsParents.first()[0], true);
      }

      if (this.$menuItemsParents.length) {
        this.$menuItemsParents.on('click.siteHeader', this.onParentClick.bind(this));
      }
      this.$backdrop.on('click.siteHeader', this.onBackdropClick.bind(this));

      // Animation Start
      this.$toggle.addClass('is-active');
      this.$backdrop.removeClass('hidden');
      this.$toggleTarget.addClass('collapsing');

      this.$toggle.attr('aria-expanded', true);

      setTimeout(function () {

        // Backdrop start
        this.$backdrop.addClass('animate-in');
        this.$toggleTarget.removeClass(this._.toggleClass);

        // Animation Start
        this.$toggleTarget.on(window.transitionEvent + '.navbarOpen', function () {
          this.$toggleTarget.off(window.transitionEvent + '.navbarOpen');

          this.$toggleTarget.removeClass('collapsing');
          debug('mainNavigation.navbarOpen: End');

          if (cb && typeof cb === 'function') {
            cb();
          }
        }.bind(this));
      }.bind(this), 10);
    },
    isNavbarOpen: function isNavbarOpen() {
      return this.$toggle.attr('aria-expanded') === 'true';
    },
    addBackdrop: function addBackdrop() {
      if (this.$backdrop) {
        return this.$backdrop;
      }

      this.$backdrop = $('<div class="navbar__backdrop hidden"></div>');
      $('body').append(this.$backdrop);
    },
    onBackdropClick: function onBackdropClick() {
      this.navbarClose();
    },
    onParentClick: function onParentClick(evt) {
      debug('mainNavigation.onParentClick: Toggle Child Submenu');
      evt.preventDefault();
      this.parentToggle(evt.currentTarget);
    },
    parentToggle: function parentToggle(el) {
      var $el = $(el);

      if ($el.attr('aria-expanded') === 'true') {
        this.parentClose(el);
      } else {
        this.parentOpen(el);
      }
    },
    parentOpen: function parentOpen(el, skipAnimation) {
      var $el = $(el),
          $target = $el.parent().find('.sub-menu'),
          toggleClass = $el.attr('data-toggle');

      if (!$target.length) {
        return false;
      }

      if ($el.hasClass('is-active')) {
        return false;
      }

      $el.attr('aria-expanded', true);
      $el.addClass('is-active');

      $target.css({ 'position': 'absolute', 'visibility': 'hidden', 'display': 'block', 'height': 'auto' });
      var height = $target.height();
      $target.removeAttr('style');

      debug('mainNavigation.parentOpen: height', height);

      if (skipAnimation) {
        $target.css({ 'height': height });
        $target.removeClass(toggleClass);
        debug('mainNavigation.parentOpen: Transition End');
        return;
      }

      $target.addClass('collapsing');
      setTimeout(function () {
        $target.css({ 'height': height });

        $target.one(window.transitionEvent, function () {
          $target.removeClass('collapsing');
          $target.removeClass(toggleClass);
          debug('mainNavigation.parentOpen: Transition End');
        });
      }, 30);
    },
    parentClose: function parentClose(el, skipAnimation) {
      var $el = $(el),
          $target = $el.parent().find('.sub-menu'),
          toggleClass = $el.attr('data-toggle');

      if (!$target.length) {
        return false;
      }

      if (!$el.hasClass('is-active')) {
        return false;
      }

      $el.attr('aria-expanded', false);
      $el.removeClass('is-active');

      var height = '0';
      debug('mainNavigation.parentClose: height', height);

      if (skipAnimation) {
        $target.addClass(toggleClass);
        $target.removeAttr('style');
        debug('mainNavigation.parentClose: Transition End');
        return;
      }

      $target.addClass('collapsing');
      setTimeout(function () {
        $target.css({ 'height': height });

        $target.one(window.transitionEvent, function () {
          $target.removeClass('collapsing');
          $target.addClass(toggleClass);
          $target.removeAttr('style');
          debug('mainNavigation.parentClose: Transition End');
        });
      }, 30);
    },
    resetParents: function resetParents() {
      if (!this.$menuItemsParents.length) {
        return;
      }

      this.$menuItemsParents.each(function (i, el) {
        var $el = $(el);
        if ($el.hasClass('is-active')) {
          debug('mainNavigation.resetParents: el', el);
          this.parentClose(el, true);
        }
      }.bind(this));
    },
    initDropmenus: function initDropmenus() {
      var _this10 = this;

      if (!this.$dropmenus.length) {
        return;
      }

      this.$dropmenus.each(function (i, el) {
        _this10.initDropmenu(el);
      });
    },
    initDropmenu: function initDropmenu(el) {
      var $el = $(el),
          menuItem = $el.attr('data-menu-item'),
          $menuItemLi = $('.menu-' + menuItem, this.$el),
          $menuItem = $('.menu-' + menuItem + ' > a', this.$el);

      if (!$menuItemLi.length || !$menuItemLi.hasClass('menu-item-has-children')) {
        return;
      }

      // Move the dropmenu in the dom
      $menuItemLi.append($el);

      this.dropmenuArrowPosition($menuItemLi, $el);

      // Hover Listener
      $menuItemLi.on('mouseenter.siteHeader', function () {
        this.dropmenuOpen($menuItemLi, $el);
      }.bind(this));
    },
    dropmenuOpen: function dropmenuOpen(el, dropmenu) {
      if (this.isNavbarOpen()) {
        return false;
      }

      var $el = $(el);
      $el.trigger('dropmenuOpen');
      debug('mainNavigation.dropmenuOpen: Start');

      this.$backdrop.off(window.transitionEvent + '.dropmenuClose');

      // Hover out listener
      $el.off('mouseenter.siteHeader');
      $el.on('mouseleave.siteHeader', function () {
        this.dropmenuClose(el);
      }.bind(this));

      this.dropmenuArrowPosition(el, dropmenu);

      // Animation Start
      this.$backdrop.removeClass('hidden');
      $el.addClass('hover');

      setTimeout(function () {
        this.$backdrop.addClass('animate-in');
        this.$el.addClass('drop-open');

        this.$backdrop.on(window.transitionEvent + '.dropmenuOpen', function () {
          this.$backdrop.off(window.transitionEvent + '.dropmenuOpen');
          debug('mainNavigation.dropmenuOpen: Transition End');
          if (!$el.hasClass('hover')) {
            this.$backdrop.removeClass('animate-in');
            this.$el.removeClass('drop-open');
          }
        }.bind(this));
      }.bind(this), 30);
    },
    dropmenuClose: function dropmenuClose(el) {
      var $el = $(el);
      $el.trigger('dropmenuClose');
      debug('mainNavigation.dropmenuClose: Start');

      this.$backdrop.off(window.transitionEvent + '.dropmenuOpen');

      $el.off('mouseleave.siteHeader');
      $el.on('mouseenter.siteHeader', function () {
        this.dropmenuOpen(el);
      }.bind(this));

      $el.removeClass('hover');
      this.$backdrop.removeClass('animate-in');
      this.$el.removeClass('drop-open');

      // Animation Start
      this.$backdrop.on(window.transitionEvent + '.dropmenuClose', function () {
        this.$backdrop.off(window.transitionEvent + '.dropmenuClose');
        debug('mainNavigation.dropmenuClose: Transition End');
        this.$backdrop.addClass('hidden');
      }.bind(this));
    },
    dropmenuArrowPosition: function dropmenuArrowPosition(el, dropmenu) {

      var $el = $(el),
          $dropmenu = $(dropmenu),
          $dropmenu = $el.find('.dropmenu'),
          $dropmenuArrow = $('.dropmenu__arrow', $dropmenu);

      // Determine Arrow positioning
      var settings = {
        windowWidth: $(window).width(),
        elWidth: $el.width(),
        elOffset: $el.offset(),
        dropmenuWidth: $dropmenu.width(),
        arrowWidth: 18 // $dropmenuArrow.width()
      };

      var start = (settings.windowWidth - settings.dropmenuWidth) / 2;

      // Calculate Arrow positioning
      settings.left = settings.elOffset.left - start - settings.arrowWidth / 2 + settings.elWidth / 2 - 10;

      debug('mainNavigation.dropmenuArrowPosition: Update arrow position', settings);

      // Move Arrow
      $dropmenuArrow.css({ left: settings.left + "px" });
    },
    analytics: function analytics() {
      // NOTE moving to GTM
      // var linkClicked = false;
      // 
      //  // Logo
      // $('a[rel="home"]', this.$el).on('click', function() {
      //   analytics.globalEvent('event', 'Navigation', 'event_headerID', 'Header Logo');
      // });
      //
      // $('.navbar__nav a', this.$el).each(function(i, el) {
      //   var $el = $(el);
      //   $el.on('click', function(evt) {
      //
      //     var $el = $(evt.currentTarget),
      //       label = $el.attr('aria-label') || $el.text(),
      //       parentLabel = '';
      //
      //     // Menu Links
      //     var $parent = $el.parent('li');
      //     if($parent.length && $parent.is('.menu-item-has-children')) {
      //       if(!this.isNavbarOpen()) {
      //         linkClicked = true;
      //         analytics.globalEvent('event', 'Navigation', 'event_ClickedNavLink', label + ' Dropdown -  Label clickthrough');
      //       }
      //     } else if($parent.length && $parent.parent().is('.sub-menu')) {
      //       parentLabel = $el.parents('.menu-item-has-children').find('a').first().text();
      //       if(label === parentLabel) {
      //         label = 'Overview';
      //       }
      //       linkClicked = true;
      //       analytics.globalEvent('event', 'Navigation', 'event_ClickedNavLink', parentLabel + ' Dropdown - ' + label + ' clickthrough');
      //     } else if($parent.length && $parent.is('.menu-item:last-child')) {
      //       linkClicked = true;
      //       analytics.globalEvent('event', 'Navigation', 'event_ClickCTA', 'Navigation - ' + label + ' CTA clickthrough');
      //     } else if($parent.length && $parent.is('.menu-item')) {
      //       linkClicked = true;
      //       analytics.globalEvent('event', 'Navigation', 'event_ClickedNavLink', 'Navigation - ' + label + ' Clickthrough');
      //     }
      //
      //     // Dropdown
      //     var $dropdown = $el.parents('.dropmenu');
      //     if($dropdown.length) {
      //       parentLabel = $el.parents('.menu-item-has-children').find('a').first().text();
      //       if(label === parentLabel) {
      //         label = 'Overview';
      //       }
      //       linkClicked = true;
      //       analytics.globalEvent('event', 'Navigation', 'event_ClickedNavLink', parentLabel + ' Dropdown - ' + label + ' clickthrough');
      //     }
      //   }.bind(this));
      // }.bind(this));
      //
      // $('.navbar__toolbar-bottom a', this.$el).each(function(i, el) {
      //   var $el = $(el);
      //   $el.on('click', function(evt) {
      //
      //     var $el = $(evt.currentTarget),
      //       label = $el.attr('aria-label') || $el.text();
      //
      //     linkClicked = true;
      //     analytics.globalEvent('event', 'Navigation', 'event_ClickCTA', 'Navigation - ' + label + ' CTA clickthrough');
      //   });
      // });
      //
      // $('.navbar__nav .menu-item-has-children', this.$el).each(function(i, el) {
      //   var $el = $(el);
      //   $el.on('dropmenuOpen', function(evt) {
      //
      //     var $el = $(evt.currentTarget),
      //       label = $el.find('a').first().attr('aria-label') || $el.find('a').first().text();
      //
      //     if(!linkClicked) {
      //       analytics.globalEvent( 'event', 'Navigation', 'event_HoverNavLabel', label + ' Nav Label - hover' );
      //     }
      //   });
      // });
      //
      // $(window).on('navbarOpen', function() {
      //   analytics.globalEvent( 'event', 'Navigation', 'event_ExposedNav', 'Open Menu' );
      // });
      //
      // $(window).on('navbarClose', function() {
      //   if(!linkClicked) {
      //     analytics.globalEvent( 'event', 'Navigation', 'event_ExposedNav', 'Close Menu' );
      //   }
      // });
    }
  };

  window.mainNavigation = mainNavigation;
})(jQuery, window, document);

;(function ($, window, document) {

  var matchHeight = {
    init: function init() {
      // cmmenting this out for now
      // $(function() {
      //   $('.card__inner').matchHeight();
      //
      //   // fire again on delay just to be sure
      //   setTimeout(function() {
      //     $('.card__inner').matchHeight();
      //   }.bind(this), 2000);
      // });
    }
  };

  window.matchHeight = matchHeight;
})(jQuery, window, document);

/* global transitionEvent */

(function ($, window, document) {
  var optIn = {
    defaults: {
      debug: false // Dont leave this as true
    },
    init: function init(opts) {
      $(document).ready(function () {
        console.log("optIn init");
        $(".optIn").on("click", function (e) {
          e.preventDefault();
          console.log("optIn click");
        });
      });
    },
    render: function render() {
      console.log("optIn");
    }
  };

  window.optIn = optIn;
})(jQuery, window, document);

;(function ($, window, document) {

  var scrim = {
    triggers: '',
    panels: '',
    init: function init() {

      var scrimEl = document.getElementById('scrim');
      if (!scrimEl) {
        return;
      }

      var vh = scrim.getViewportHeight() / 2;

      //trigger elements (tweens begin when these enter the screen)
      scrim.triggers = document.querySelectorAll('[data-scrim-trigger]');

      //scrims contain background gradients
      scrim.panels = document.querySelectorAll('[data-scrim-panel]');

      //assign scene to each trigger block
      for (var i = 0; i < scrim.triggers.length; i++) {
        var block = scrim.triggers[i];

        //tweens (move current offscreen and next onscreen)
        var offtween = TweenMax.to(scrim.panels[i], 1, { opacity: 0 });
        var ontween = TweenMax.fromTo(scrim.panels[i + 1], 1, { opacity: 1 }, { top: 0 });

        //scene
        var scene = new ScrollMagic.Scene({
          triggerElement: block,
          duration: vh,
          offset: vh,
          triggerHook: 1
        }).setTween([ontween, offtween]);

        //add to controller
        controller.addScene(scene);
      }
    },

    //helpers
    getViewportHeight: function getViewportHeight() {
      return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    }
  };

  window.scrim = scrim;
})(jQuery, window, document);

//= require jquery/dist/jquery.min.js

;(function ($, window, document) {

  var scroll = {
    options: {
      speed: 250,
      fixedHeaderHeight: 90,
      scrollOffset: 40
    },
    init: function init() {
      //maybe some auto binding based on data attrs

    },
    to: function to(targetId) {
      var targetEl = void 0;
      var _isTop = targetId === 0;

      if (_isTop) {
        targetEl = document.querySelector('body');
      } else {
        var _id = targetId;
        if (_id.indexOf('#') === 0) {
          _id = _id.slice(1);
        }
        targetEl = document.getElementById(_id);
      }

      $("html, body").animate({
        scrollTop: $(targetEl).offset().top - scroll.options.scrollOffset - scroll.options.fixedHeaderHeight
      }, scroll.options.speed);
      return false;
    },
    _getScrollTopElement: function _getScrollTopElement(e) {
      var top = 0;
      while (e.offsetParent != undefined && e.offsetParent != null) {
        top += e.offsetTop + (e.clientTop != null ? e.clientTop : 0);
        e = e.offsetParent;
      }
      return top;
    },
    _getScrollTopDocument: function _getScrollTopDocument() {
      return document.documentElement.scrollTop + document.body.scrollTop;
    }
  };

  window.scroll = scroll;
})(jQuery, window, document);

;(function ($, window, document) {

  var scrollAnimation = {
    init: function init() {
      scrollAnimation.startAnim(0);

      $(window).scroll(function () {
        scrollAnimation.startAnim(120);
      });
    },
    startAnim: function startAnim(offset) {
      var height;

      if ($(window).width() > 800) {
        height = $(window).height() - offset;
      } else {
        height = $(window).height();
      }

      $(".anim-ready").each(function () {
        var top = $(this).offset().top;

        if ($(window).scrollTop() > top - height) {
          $(this).addClass("animate");
        }
      });

      $(".dots-anim-ready").each(function () {
        var top = $(this).offset().top;

        if ($(window).scrollTop() > top - height) {
          $(this).addClass("dots-animate");
        }
      });

      $(".anim-reverse").each(function () {
        var top = $(this).offset().top;

        if ($(window).scrollTop() > top - height) {
          $(this).removeClass("dots-reverse");
        }

        if (top < $(window).scrollTop()) {
          $(this).addClass("dots-reverse");
        }
      });
    }
  };

  window.scrollAnimation = scrollAnimation;
})(jQuery, window, document);

;(function ($, window, document) {

  var scrollDepth = {
    init: function init() {
      $(function () {
        $.scrollDepth({
          elements: ['.site-footer'],
          eventHandler: function eventHandler(data) {
            debug(data);
          }
        });
      });
    }
  };

  window.scrollDepth = scrollDepth;
})(jQuery, window, document);

//= require scroll.js

;(function ($, window, document) {

  var sidenav = {
    navlinks: [],
    init: function init() {

      var nav = document.getElementById('page-menu');
      if (!nav) {
        return;
      }
      //assign links
      sidenav.navlinks = nav.querySelectorAll('[aria-selected]');

      var navlinks = sidenav.navlinks;
      //set behaviors
      for (var i = 0; i < navlinks.length; i++) {
        sidenav.addClickListener(navlinks[i]);
        sidenav.addScene(navlinks[i]);
      }
    },
    setSelected: function setSelected(el) {
      el.setAttribute('aria-selected', true);
    },
    unsetSelected: function unsetSelected(el) {
      el.setAttribute('aria-selected', false);
    },
    resetAll: function resetAll(el) {
      //reset all
      var links = sidenav.navlinks;
      for (var i = 0; i < links.length; i++) {
        links[i].setAttribute('aria-selected', false);
      }
    },
    getContainerHeight: function getContainerHeight(el) {
      return el.offsetHeight;
    },
    addClickListener: function addClickListener(el) {
      el.addEventListener('click', function (event) {
        //sidenav.resetAll();
        //sidenav.setSelected(this);
        var scrollOffset = scroll.options.scrollOffset;
        scroll.options.scrollOffset = scroll.options.fixedHeaderHeight * -1;
        var _isFirst = this === sidenav.navlinks[0];
        scroll.to(_isFirst ? 0 : el.getAttribute('href'));
        scroll.options.scrollOffset = scrollOffset;
        event.preventDefault();

        // NOTE tracking has been moved to GTM
        // var linkTargetTitle = $(el).text();
        // analytics.globalEvent('event', 'Side Navigation', 'navDots', linkTargetTitle);
      });
    },
    addScene: function addScene(el) {
      var mainMenuID = "primary-navigation__link___" + el.getAttribute('data-menuTarget');
      //duration is the container height
      var triggerElement = document.getElementById(el.getAttribute('href').slice(1));
      var duration = sidenav.getContainerHeight(triggerElement);

      new ScrollMagic.Scene({
        triggerElement: triggerElement,
        duration: duration
      }).setClassToggle(el, "is-selected").addTo(controller);

      // This scene sets the Main Menu in the hamburger menu.
      // new ScrollMagic.Scene({
      //     triggerElement: triggerElement,
      //     duration: duration
      // })
      // .setClassToggle(document.getElementById(mainMenuID), "is-selected")
      // .addTo(controller);
    }
  };

  window.sidenav = sidenav;
})(jQuery, window, document);

var urlParams;
(window.onpopstate = function () {
  var match,
      pl = /\+/g,
      // Regex for replacing addition symbol with a space
  search = /([^&=]+)=?([^&]*)/g,
      decode = function decode(s) {
    return decodeURIComponent(s.replace(pl, " "));
  },
      query = window.location.search.substring(1);

  urlParams = {};
  while (match = search.exec(query)) {
    urlParams[decode(match[1])] = decode(match[2]);
  }
})();

function getParam(name) {
  return urlParams[name];
}

;(function ($, window, document) {

  var util = {

    hasClass: function hasClass(el, className) {
      if (el.classList) return el.classList.contains(className);else {
        return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
      }
    },
    addClass: function addClass(el, className) {
      if (el.classList) {
        el.classList.add(className);
      } else if (!hasClass(el, className)) {
        el.className += " " + className;
      }
    },
    removeClass: function removeClass(el, className) {
      if (el.classList) {
        el.classList.remove(className);
      } else if (hasClass(el, className)) {
        var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
        el.className = el.className.replace(reg, ' ');
      }
    },
    toggleClass: function toggleClass(el, className) {
      if (util.hasClass(el, className)) {
        util.removeClass(el, className);
      } else {
        util.addClass(el, className);
      }
    },
    attrBool: function attrBool(attrStr) {
      return attrStr === 'true';
    },

    getParameterByName: function getParameterByName(name, url) {
      if (!url) {
        url = window.location.href;
      }
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    },

    asyncLoadScript: function asyncLoadScript(src) {
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = src;
      var x = document.getElementsByTagName('script')[0];
      x.parentNode.insertBefore(s, x);
    },

    svgIcon: function svgIcon(name, role, cssClass, title) {
      role = role || 'img';
      cssClass = cssClass || 'icon-svg';
      title = title || '';
      return '<svg class="' + cssClass + '" title="' + title + '" role="' + role + '"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#' + name + '"></use></svg>';
    }
  };

  window.util = util;

  String.prototype.replaceLastOccurrence = function (find, replace) {
    var str = this;

    if (!find || !find.length) {
      return str;
    }

    if (!replace || !replace.length) {
      replace = '';
    }

    var index = str.lastIndexOf(find);
    if (index >= 0 && index + find.length >= str.length) {
      str = str.substring(0, index) + replace;
    }

    return str;
  };
})(jQuery, window, document);

// @see - https://css-tricks.com/NetMag/FluidWidthVideo/demo.php

;(function ($, window, document) {

  var video = {
    init: function init() {
      this.$videos = $('.video-wrapper');

      this.$videos.each(function (i, el) {
        this.initVideo(el);
      }.bind(this));
    },
    initVideo: function initVideo(el) {
      var $el = $(el),
          $video = $('iframe, object, embed', $el),
          aspectRatio = $video[0].height / $video[0].width;

      $video.removeAttr('height').removeAttr('width');

      $(window).resize(function () {

        var newWidth = $el.width(),
            newHeight = newWidth * aspectRatio;

        $video.width(newWidth).height(newHeight);
      }).resize();
    }
  };

  window.video = video;
})(jQuery, window, document);

var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
  return typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
} : function (obj) {
  return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
};

var _createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);
    }
  }return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;
  };
}();

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0-alpha.6): carousel.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */

var Carousel = function ($) {

  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */

  var NAME = 'carousel';
  var VERSION = '4.0.0-alpha.6';
  var DATA_KEY = 'bs.carousel';
  var EVENT_KEY = '.' + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 1000;
  var ARROW_LEFT_KEYCODE = 37; // KeyboardEvent.which value for left arrow key
  var ARROW_RIGHT_KEYCODE = 39; // KeyboardEvent.which value for right arrow key

  var Default = {
    interval: 5000,
    keyboard: true,
    slide: false,
    pause: 'hover',
    wrap: true
  };

  var DefaultType = {
    interval: '(number|boolean)',
    keyboard: 'boolean',
    slide: '(boolean|string)',
    pause: '(string|boolean)',
    wrap: 'boolean'
  };

  var Direction = {
    NEXT: 'next',
    PREV: 'prev',
    LEFT: 'left',
    RIGHT: 'right'
  };

  var Event = {
    SLIDE: 'slide' + EVENT_KEY,
    SLID: 'slid' + EVENT_KEY,
    KEYDOWN: 'keydown' + EVENT_KEY,
    MOUSEENTER: 'mouseenter' + EVENT_KEY,
    MOUSELEAVE: 'mouseleave' + EVENT_KEY,
    LOAD_DATA_API: 'load' + EVENT_KEY + DATA_API_KEY,
    CLICK_DATA_API: 'click' + EVENT_KEY + DATA_API_KEY
  };

  var ClassName = {
    CAROUSEL: 'carousel',
    ACTIVE: 'active',
    SLIDE: 'slide',
    RIGHT: 'carousel-item-right',
    LEFT: 'carousel-item-left',
    NEXT: 'carousel-item-next',
    PREV: 'carousel-item-prev',
    ITEM: 'carousel-item'
  };

  var Selector = {
    ACTIVE: '.active',
    ACTIVE_ITEM: '.active.carousel-item',
    ITEM: '.carousel-item',
    NEXT_PREV: '.carousel-item-next, .carousel-item-prev',
    INDICATORS: '.carousel-indicators',
    DATA_SLIDE: '[data-slide], [data-slide-to]',
    DATA_RIDE: '[data-ride="carousel"]'
  };

  /**
   * ------------------------------------------------------------------------
   * Class Definition
   * ------------------------------------------------------------------------
   */

  var Carousel = function () {
    function Carousel(element, config) {
      _classCallCheck(this, Carousel);

      this._items = null;
      this._interval = null;
      this._activeElement = null;

      this._isPaused = false;
      this._isSliding = false;

      this._config = this._getConfig(config);
      this._element = $(element)[0];
      this._indicatorsElement = $(this._element).find(Selector.INDICATORS)[0];

      this._addEventListeners();
    }

    // getters

    // public

    Carousel.prototype.next = function next() {
      if (this._isSliding) {
        throw new Error('Carousel is sliding');
      }
      this._slide(Direction.NEXT);
    };

    Carousel.prototype.nextWhenVisible = function nextWhenVisible() {
      // Don't call next when the page isn't visible
      if (!document.hidden) {
        this.next();
      }
    };

    Carousel.prototype.prev = function prev() {
      if (this._isSliding) {
        throw new Error('Carousel is sliding');
      }
      this._slide(Direction.PREVIOUS);
    };

    Carousel.prototype.pause = function pause(event) {
      if (!event) {
        this._isPaused = true;
      }

      if ($(this._element).find(Selector.NEXT_PREV)[0] && Util.supportsTransitionEnd()) {
        Util.triggerTransitionEnd(this._element);
        this.cycle(true);
      }

      clearInterval(this._interval);
      this._interval = null;
    };

    Carousel.prototype.cycle = function cycle(event) {
      if (!event) {
        this._isPaused = false;
      }

      if (this._interval) {
        clearInterval(this._interval);
        this._interval = null;
      }

      if (this._config.interval && !this._isPaused) {
        this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval);
      }
    };

    Carousel.prototype.to = function to(index) {
      var _this = this;

      this._activeElement = $(this._element).find(Selector.ACTIVE_ITEM)[0];

      var activeIndex = this._getItemIndex(this._activeElement);

      if (index > this._items.length - 1 || index < 0) {
        return;
      }

      if (this._isSliding) {
        $(this._element).one(Event.SLID, function () {
          return _this.to(index);
        });
        return;
      }

      if (activeIndex === index) {
        this.pause();
        this.cycle();
        return;
      }

      var direction = index > activeIndex ? Direction.NEXT : Direction.PREVIOUS;

      this._slide(direction, this._items[index]);
    };

    Carousel.prototype.dispose = function dispose() {
      $(this._element).off(EVENT_KEY);
      $.removeData(this._element, DATA_KEY);

      this._items = null;
      this._config = null;
      this._element = null;
      this._interval = null;
      this._isPaused = null;
      this._isSliding = null;
      this._activeElement = null;
      this._indicatorsElement = null;
    };

    // private

    Carousel.prototype._getConfig = function _getConfig(config) {
      config = $.extend({}, Default, config);
      Util.typeCheckConfig(NAME, config, DefaultType);
      return config;
    };

    Carousel.prototype._addEventListeners = function _addEventListeners() {
      var _this2 = this;

      if (this._config.keyboard) {
        $(this._element).on(Event.KEYDOWN, function (event) {
          return _this2._keydown(event);
        });
      }

      if (this._config.pause === 'hover' && !('ontouchstart' in document.documentElement)) {
        $(this._element).on(Event.MOUSEENTER, function (event) {
          return _this2.pause(event);
        }).on(Event.MOUSELEAVE, function (event) {
          return _this2.cycle(event);
        });
      }
    };

    Carousel.prototype._keydown = function _keydown(event) {
      if (/input|textarea/i.test(event.target.tagName)) {
        return;
      }

      switch (event.which) {
        case ARROW_LEFT_KEYCODE:
          event.preventDefault();
          this.prev();
          break;
        case ARROW_RIGHT_KEYCODE:
          event.preventDefault();
          this.next();
          break;
        default:
          return;
      }
    };

    Carousel.prototype._getItemIndex = function _getItemIndex(element) {
      this._items = $.makeArray($(element).parent().find(Selector.ITEM));
      return this._items.indexOf(element);
    };

    Carousel.prototype._getItemByDirection = function _getItemByDirection(direction, activeElement) {
      var isNextDirection = direction === Direction.NEXT;
      var isPrevDirection = direction === Direction.PREVIOUS;
      var activeIndex = this._getItemIndex(activeElement);
      var lastItemIndex = this._items.length - 1;
      var isGoingToWrap = isPrevDirection && activeIndex === 0 || isNextDirection && activeIndex === lastItemIndex;

      if (isGoingToWrap && !this._config.wrap) {
        return activeElement;
      }

      var delta = direction === Direction.PREVIOUS ? -1 : 1;
      var itemIndex = (activeIndex + delta) % this._items.length;

      return itemIndex === -1 ? this._items[this._items.length - 1] : this._items[itemIndex];
    };

    Carousel.prototype._triggerSlideEvent = function _triggerSlideEvent(relatedTarget, eventDirectionName) {
      var slideEvent = $.Event(Event.SLIDE, {
        relatedTarget: relatedTarget,
        direction: eventDirectionName
      });

      $(this._element).trigger(slideEvent);

      return slideEvent;
    };

    Carousel.prototype._setActiveIndicatorElement = function _setActiveIndicatorElement(element) {
      if (this._indicatorsElement) {
        $(this._indicatorsElement).find(Selector.ACTIVE).removeClass(ClassName.ACTIVE);

        var nextIndicator = this._indicatorsElement.children[this._getItemIndex(element)];

        if (nextIndicator) {
          $(nextIndicator).addClass(ClassName.ACTIVE);
        }
      }
    };

    Carousel.prototype._slide = function _slide(direction, element) {
      var _this3 = this;

      var activeElement = $(this._element).find(Selector.ACTIVE_ITEM)[0];
      var nextElement = element || activeElement && this._getItemByDirection(direction, activeElement);

      var isCycling = Boolean(this._interval);

      var directionalClassName = void 0;
      var orderClassName = void 0;
      var eventDirectionName = void 0;

      if (direction === Direction.NEXT) {
        directionalClassName = ClassName.LEFT;
        orderClassName = ClassName.NEXT;
        eventDirectionName = Direction.LEFT;
      } else {
        directionalClassName = ClassName.RIGHT;
        orderClassName = ClassName.PREV;
        eventDirectionName = Direction.RIGHT;
      }

      if (nextElement && $(nextElement).hasClass(ClassName.ACTIVE)) {
        this._isSliding = false;
        return;
      }

      var slideEvent = this._triggerSlideEvent(nextElement, eventDirectionName);
      if (slideEvent.isDefaultPrevented()) {
        return;
      }

      if (!activeElement || !nextElement) {
        // some weirdness is happening, so we bail
        return;
      }

      this._isSliding = true;

      if (isCycling) {
        this.pause();
      }

      this._setActiveIndicatorElement(nextElement);

      var slidEvent = $.Event(Event.SLID, {
        relatedTarget: nextElement,
        direction: eventDirectionName
      });

      if (Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.SLIDE)) {

        $(nextElement).addClass(orderClassName);

        Util.reflow(nextElement);

        $(activeElement).addClass(directionalClassName);
        $(nextElement).addClass(directionalClassName);

        $(activeElement).one(Util.TRANSITION_END, function () {
          $(nextElement).removeClass(directionalClassName + ' ' + orderClassName).addClass(ClassName.ACTIVE);

          $(activeElement).removeClass(ClassName.ACTIVE + ' ' + orderClassName + ' ' + directionalClassName);

          _this3._isSliding = false;

          setTimeout(function () {
            return $(_this3._element).trigger(slidEvent);
          }, 0);
        }).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        $(activeElement).removeClass(ClassName.ACTIVE);
        $(nextElement).addClass(ClassName.ACTIVE);

        this._isSliding = false;
        $(this._element).trigger(slidEvent);
      }

      if (isCycling) {
        this.cycle();
      }
    };

    // static

    Carousel._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);
        var _config = $.extend({}, Default, $(this).data());

        if ((typeof config === 'undefined' ? 'undefined' : _typeof(config)) === 'object') {
          $.extend(_config, config);
        }

        var action = typeof config === 'string' ? config : _config.slide;

        if (!data) {
          data = new Carousel(this, _config);
          $(this).data(DATA_KEY, data);
        }

        if (typeof config === 'number') {
          data.to(config);
        } else if (typeof action === 'string') {
          if (data[action] === undefined) {
            throw new Error('No method named "' + action + '"');
          }
          data[action]();
        } else if (_config.interval) {
          data.pause();
          data.cycle();
        }
      });
    };

    Carousel._dataApiClickHandler = function _dataApiClickHandler(event) {
      var selector = Util.getSelectorFromElement(this);

      if (!selector) {
        return;
      }

      var target = $(selector)[0];

      if (!target || !$(target).hasClass(ClassName.CAROUSEL)) {
        return;
      }

      var config = $.extend({}, $(target).data(), $(this).data());
      var slideIndex = this.getAttribute('data-slide-to');

      if (slideIndex) {
        config.interval = false;
      }

      Carousel._jQueryInterface.call($(target), config);

      if (slideIndex) {
        $(target).data(DATA_KEY).to(slideIndex);
      }

      event.preventDefault();
    };

    _createClass(Carousel, null, [{
      key: 'VERSION',
      get: function get() {
        return VERSION;
      }
    }, {
      key: 'Default',
      get: function get() {
        return Default;
      }
    }]);

    return Carousel;
  }();

  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */

  $(document).on(Event.CLICK_DATA_API, Selector.DATA_SLIDE, Carousel._dataApiClickHandler);

  $(window).on(Event.LOAD_DATA_API, function () {
    $(Selector.DATA_RIDE).each(function () {
      var $carousel = $(this);
      Carousel._jQueryInterface.call($carousel, $carousel.data());
    });
  });

  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Carousel._jQueryInterface;
  $.fn[NAME].Constructor = Carousel;
  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Carousel._jQueryInterface;
  };

  return Carousel;
}(jQuery);
//# sourceMappingURL=carousel.js.map

var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
  return typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
} : function (obj) {
  return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
};

var _createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);
    }
  }return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;
  };
}();

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0-alpha.6): collapse.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */

var Collapse = function ($) {

  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */

  var NAME = 'collapse';
  var VERSION = '4.0.0-alpha.6';
  var DATA_KEY = 'bs.collapse';
  var EVENT_KEY = '.' + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 600;

  var Default = {
    toggle: true,
    parent: ''
  };

  var DefaultType = {
    toggle: 'boolean',
    parent: 'string'
  };

  var Event = {
    SHOW: 'show' + EVENT_KEY,
    SHOWN: 'shown' + EVENT_KEY,
    HIDE: 'hide' + EVENT_KEY,
    HIDDEN: 'hidden' + EVENT_KEY,
    CLICK_DATA_API: 'click' + EVENT_KEY + DATA_API_KEY
  };

  var ClassName = {
    SHOW: 'show',
    COLLAPSE: 'collapse',
    COLLAPSING: 'collapsing',
    COLLAPSED: 'collapsed'
  };

  var Dimension = {
    WIDTH: 'width',
    HEIGHT: 'height'
  };

  var Selector = {
    ACTIVES: '.card > .show, .card > .collapsing',
    DATA_TOGGLE: '[data-toggle="collapse"]'
  };

  /**
   * ------------------------------------------------------------------------
   * Class Definition
   * ------------------------------------------------------------------------
   */

  var Collapse = function () {
    function Collapse(element, config) {
      _classCallCheck(this, Collapse);

      this._isTransitioning = false;
      this._element = element;
      this._config = this._getConfig(config);
      this._triggerArray = $.makeArray($('[data-toggle="collapse"][href="#' + element.id + '"],' + ('[data-toggle="collapse"][data-target="#' + element.id + '"]')));

      this._parent = this._config.parent ? this._getParent() : null;

      if (!this._config.parent) {
        this._addAriaAndCollapsedClass(this._element, this._triggerArray);
      }

      if (this._config.toggle) {
        this.toggle();
      }
    }

    // getters

    // public

    Collapse.prototype.toggle = function toggle() {
      if ($(this._element).hasClass(ClassName.SHOW)) {
        this.hide();
      } else {
        this.show();
      }
    };

    Collapse.prototype.show = function show() {
      var _this = this;

      if (this._isTransitioning) {
        throw new Error('Collapse is transitioning');
      }

      if ($(this._element).hasClass(ClassName.SHOW)) {
        return;
      }

      var actives = void 0;
      var activesData = void 0;

      if (this._parent) {
        actives = $.makeArray($(this._parent).find(Selector.ACTIVES));
        if (!actives.length) {
          actives = null;
        }
      }

      if (actives) {
        activesData = $(actives).data(DATA_KEY);
        if (activesData && activesData._isTransitioning) {
          return;
        }
      }

      var startEvent = $.Event(Event.SHOW);
      $(this._element).trigger(startEvent);
      if (startEvent.isDefaultPrevented()) {
        return;
      }

      if (actives) {
        Collapse._jQueryInterface.call($(actives), 'hide');
        if (!activesData) {
          $(actives).data(DATA_KEY, null);
        }
      }

      var dimension = this._getDimension();

      $(this._element).removeClass(ClassName.COLLAPSE).addClass(ClassName.COLLAPSING);

      this._element.style[dimension] = 0;
      this._element.setAttribute('aria-expanded', true);

      if (this._triggerArray.length) {
        $(this._triggerArray).removeClass(ClassName.COLLAPSED).attr('aria-expanded', true);
      }

      this.setTransitioning(true);

      var complete = function complete() {
        $(_this._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).addClass(ClassName.SHOW);

        _this._element.style[dimension] = '';

        _this.setTransitioning(false);

        $(_this._element).trigger(Event.SHOWN);
      };

      if (!Util.supportsTransitionEnd()) {
        complete();
        return;
      }

      var capitalizedDimension = dimension[0].toUpperCase() + dimension.slice(1);
      var scrollSize = 'scroll' + capitalizedDimension;

      $(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(TRANSITION_DURATION);

      this._element.style[dimension] = this._element[scrollSize] + 'px';
    };

    Collapse.prototype.hide = function hide() {
      var _this2 = this;

      if (this._isTransitioning) {
        throw new Error('Collapse is transitioning');
      }

      if (!$(this._element).hasClass(ClassName.SHOW)) {
        return;
      }

      var startEvent = $.Event(Event.HIDE);
      $(this._element).trigger(startEvent);
      if (startEvent.isDefaultPrevented()) {
        return;
      }

      var dimension = this._getDimension();
      var offsetDimension = dimension === Dimension.WIDTH ? 'offsetWidth' : 'offsetHeight';

      this._element.style[dimension] = this._element[offsetDimension] + 'px';

      Util.reflow(this._element);

      $(this._element).addClass(ClassName.COLLAPSING).removeClass(ClassName.COLLAPSE).removeClass(ClassName.SHOW);

      this._element.setAttribute('aria-expanded', false);

      if (this._triggerArray.length) {
        $(this._triggerArray).addClass(ClassName.COLLAPSED).attr('aria-expanded', false);
      }

      this.setTransitioning(true);

      var complete = function complete() {
        _this2.setTransitioning(false);
        $(_this2._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).trigger(Event.HIDDEN);
      };

      this._element.style[dimension] = '';

      if (!Util.supportsTransitionEnd()) {
        complete();
        return;
      }

      $(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(TRANSITION_DURATION);
    };

    Collapse.prototype.setTransitioning = function setTransitioning(isTransitioning) {
      this._isTransitioning = isTransitioning;
    };

    Collapse.prototype.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);

      this._config = null;
      this._parent = null;
      this._element = null;
      this._triggerArray = null;
      this._isTransitioning = null;
    };

    // private

    Collapse.prototype._getConfig = function _getConfig(config) {
      config = $.extend({}, Default, config);
      config.toggle = Boolean(config.toggle); // coerce string values
      Util.typeCheckConfig(NAME, config, DefaultType);
      return config;
    };

    Collapse.prototype._getDimension = function _getDimension() {
      var hasWidth = $(this._element).hasClass(Dimension.WIDTH);
      return hasWidth ? Dimension.WIDTH : Dimension.HEIGHT;
    };

    Collapse.prototype._getParent = function _getParent() {
      var _this3 = this;

      var parent = $(this._config.parent)[0];
      var selector = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]';

      $(parent).find(selector).each(function (i, element) {
        _this3._addAriaAndCollapsedClass(Collapse._getTargetFromElement(element), [element]);
      });

      return parent;
    };

    Collapse.prototype._addAriaAndCollapsedClass = function _addAriaAndCollapsedClass(element, triggerArray) {
      if (element) {
        var isOpen = $(element).hasClass(ClassName.SHOW);
        element.setAttribute('aria-expanded', isOpen);

        if (triggerArray.length) {
          $(triggerArray).toggleClass(ClassName.COLLAPSED, !isOpen).attr('aria-expanded', isOpen);
        }
      }
    };

    // static

    Collapse._getTargetFromElement = function _getTargetFromElement(element) {
      var selector = Util.getSelectorFromElement(element);
      return selector ? $(selector)[0] : null;
    };

    Collapse._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var $this = $(this);
        var data = $this.data(DATA_KEY);
        var _config = $.extend({}, Default, $this.data(), (typeof config === 'undefined' ? 'undefined' : _typeof(config)) === 'object' && config);

        if (!data && _config.toggle && /show|hide/.test(config)) {
          _config.toggle = false;
        }

        if (!data) {
          data = new Collapse(this, _config);
          $this.data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (data[config] === undefined) {
            throw new Error('No method named "' + config + '"');
          }
          data[config]();
        }
      });
    };

    _createClass(Collapse, null, [{
      key: 'VERSION',
      get: function get() {
        return VERSION;
      }
    }, {
      key: 'Default',
      get: function get() {
        return Default;
      }
    }]);

    return Collapse;
  }();

  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */

  $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
    event.preventDefault();

    var target = Collapse._getTargetFromElement(this);
    var data = $(target).data(DATA_KEY);
    var config = data ? 'toggle' : $(this).data();

    Collapse._jQueryInterface.call($(target), config);
  });

  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Collapse._jQueryInterface;
  $.fn[NAME].Constructor = Collapse;
  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Collapse._jQueryInterface;
  };

  return Collapse;
}(jQuery);
//# sourceMappingURL=collapse.js.map

var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
  return typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
} : function (obj) {
  return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
};

var _createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);
    }
  }return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;
  };
}();

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0-alpha.6): modal.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */

var Modal = function ($) {

  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */

  var NAME = 'modal';
  var VERSION = '4.0.0-alpha.6';
  var DATA_KEY = 'bs.modal';
  var EVENT_KEY = '.' + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 300;
  var BACKDROP_TRANSITION_DURATION = 150;
  var ESCAPE_KEYCODE = 27; // KeyboardEvent.which value for Escape (Esc) key

  var Default = {
    backdrop: true,
    keyboard: true,
    focus: true,
    show: true
  };

  var DefaultType = {
    backdrop: '(boolean|string)',
    keyboard: 'boolean',
    focus: 'boolean',
    show: 'boolean'
  };

  var Event = {
    HIDE: 'hide' + EVENT_KEY,
    HIDDEN: 'hidden' + EVENT_KEY,
    SHOW: 'show' + EVENT_KEY,
    SHOWN: 'shown' + EVENT_KEY,
    FOCUSIN: 'focusin' + EVENT_KEY,
    RESIZE: 'resize' + EVENT_KEY,
    CLICK_DISMISS: 'click.dismiss' + EVENT_KEY,
    KEYDOWN_DISMISS: 'keydown.dismiss' + EVENT_KEY,
    MOUSEUP_DISMISS: 'mouseup.dismiss' + EVENT_KEY,
    MOUSEDOWN_DISMISS: 'mousedown.dismiss' + EVENT_KEY,
    CLICK_DATA_API: 'click' + EVENT_KEY + DATA_API_KEY
  };

  var ClassName = {
    SCROLLBAR_MEASURER: 'modal-scrollbar-measure',
    BACKDROP: 'modal-backdrop',
    OPEN: 'modal-open',
    FADE: 'fade',
    SHOW: 'show'
  };

  var Selector = {
    DIALOG: '.modal-dialog',
    DATA_TOGGLE: '[data-toggle="modal"]',
    DATA_DISMISS: '[data-dismiss="modal"]',
    FIXED_CONTENT: '.fixed-top, .fixed-bottom, .is-fixed, .sticky-top'
  };

  /**
   * ------------------------------------------------------------------------
   * Class Definition
   * ------------------------------------------------------------------------
   */

  var Modal = function () {
    function Modal(element, config) {
      _classCallCheck(this, Modal);

      this._config = this._getConfig(config);
      this._element = element;
      this._dialog = $(element).find(Selector.DIALOG)[0];
      this._backdrop = null;
      this._isShown = false;
      this._isBodyOverflowing = false;
      this._ignoreBackdropClick = false;
      this._isTransitioning = false;
      this._originalBodyPadding = 0;
      this._scrollbarWidth = 0;
    }

    // getters

    // public

    Modal.prototype.toggle = function toggle(relatedTarget) {
      return this._isShown ? this.hide() : this.show(relatedTarget);
    };

    Modal.prototype.show = function show(relatedTarget) {
      var _this = this;

      if (this._isTransitioning) {
        throw new Error('Modal is transitioning');
      }

      if (Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE)) {
        this._isTransitioning = true;
      }
      var showEvent = $.Event(Event.SHOW, {
        relatedTarget: relatedTarget
      });

      $(this._element).trigger(showEvent);

      if (this._isShown || showEvent.isDefaultPrevented()) {
        return;
      }

      this._isShown = true;

      this._checkScrollbar();
      this._setScrollbar();

      $(document.body).addClass(ClassName.OPEN);

      this._setEscapeEvent();
      this._setResizeEvent();

      $(this._element).on(Event.CLICK_DISMISS, Selector.DATA_DISMISS, function (event) {
        return _this.hide(event);
      });

      $(this._dialog).on(Event.MOUSEDOWN_DISMISS, function () {
        $(_this._element).one(Event.MOUSEUP_DISMISS, function (event) {
          if ($(event.target).is(_this._element)) {
            _this._ignoreBackdropClick = true;
          }
        });
      });

      this._showBackdrop(function () {
        return _this._showElement(relatedTarget);
      });
    };

    Modal.prototype.hide = function hide(event) {
      var _this2 = this;

      if (event) {
        event.preventDefault();
      }

      if (this._isTransitioning) {
        throw new Error('Modal is transitioning');
      }

      var transition = Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE);
      if (transition) {
        this._isTransitioning = true;
      }

      var hideEvent = $.Event(Event.HIDE);
      $(this._element).trigger(hideEvent);

      if (!this._isShown || hideEvent.isDefaultPrevented()) {
        return;
      }

      this._isShown = false;

      this._setEscapeEvent();
      this._setResizeEvent();

      $(document).off(Event.FOCUSIN);

      $(this._element).removeClass(ClassName.SHOW);

      $(this._element).off(Event.CLICK_DISMISS);
      $(this._dialog).off(Event.MOUSEDOWN_DISMISS);

      if (transition) {
        $(this._element).one(Util.TRANSITION_END, function (event) {
          return _this2._hideModal(event);
        }).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        this._hideModal();
      }
    };

    Modal.prototype.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);

      $(window, document, this._element, this._backdrop).off(EVENT_KEY);

      this._config = null;
      this._element = null;
      this._dialog = null;
      this._backdrop = null;
      this._isShown = null;
      this._isBodyOverflowing = null;
      this._ignoreBackdropClick = null;
      this._originalBodyPadding = null;
      this._scrollbarWidth = null;
    };

    // private

    Modal.prototype._getConfig = function _getConfig(config) {
      config = $.extend({}, Default, config);
      Util.typeCheckConfig(NAME, config, DefaultType);
      return config;
    };

    Modal.prototype._showElement = function _showElement(relatedTarget) {
      var _this3 = this;

      var transition = Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE);

      if (!this._element.parentNode || this._element.parentNode.nodeType !== Node.ELEMENT_NODE) {
        // don't move modals dom position
        document.body.appendChild(this._element);
      }

      this._element.style.display = 'block';
      this._element.removeAttribute('aria-hidden');
      this._element.scrollTop = 0;

      if (transition) {
        Util.reflow(this._element);
      }

      $(this._element).addClass(ClassName.SHOW);

      if (this._config.focus) {
        this._enforceFocus();
      }

      var shownEvent = $.Event(Event.SHOWN, {
        relatedTarget: relatedTarget
      });

      var transitionComplete = function transitionComplete() {
        if (_this3._config.focus) {
          _this3._element.focus();
        }
        _this3._isTransitioning = false;
        $(_this3._element).trigger(shownEvent);
      };

      if (transition) {
        $(this._dialog).one(Util.TRANSITION_END, transitionComplete).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        transitionComplete();
      }
    };

    Modal.prototype._enforceFocus = function _enforceFocus() {
      var _this4 = this;

      $(document).off(Event.FOCUSIN) // guard against infinite focus loop
      .on(Event.FOCUSIN, function (event) {
        if (document !== event.target && _this4._element !== event.target && !$(_this4._element).has(event.target).length) {
          _this4._element.focus();
        }
      });
    };

    Modal.prototype._setEscapeEvent = function _setEscapeEvent() {
      var _this5 = this;

      if (this._isShown && this._config.keyboard) {
        $(this._element).on(Event.KEYDOWN_DISMISS, function (event) {
          if (event.which === ESCAPE_KEYCODE) {
            _this5.hide();
          }
        });
      } else if (!this._isShown) {
        $(this._element).off(Event.KEYDOWN_DISMISS);
      }
    };

    Modal.prototype._setResizeEvent = function _setResizeEvent() {
      var _this6 = this;

      if (this._isShown) {
        $(window).on(Event.RESIZE, function (event) {
          return _this6._handleUpdate(event);
        });
      } else {
        $(window).off(Event.RESIZE);
      }
    };

    Modal.prototype._hideModal = function _hideModal() {
      var _this7 = this;

      this._element.style.display = 'none';
      this._element.setAttribute('aria-hidden', 'true');
      this._isTransitioning = false;
      this._showBackdrop(function () {
        $(document.body).removeClass(ClassName.OPEN);
        _this7._resetAdjustments();
        _this7._resetScrollbar();
        $(_this7._element).trigger(Event.HIDDEN);
      });
    };

    Modal.prototype._removeBackdrop = function _removeBackdrop() {
      if (this._backdrop) {
        $(this._backdrop).remove();
        this._backdrop = null;
      }
    };

    Modal.prototype._showBackdrop = function _showBackdrop(callback) {
      var _this8 = this;

      var animate = $(this._element).hasClass(ClassName.FADE) ? ClassName.FADE : '';

      if (this._isShown && this._config.backdrop) {
        var doAnimate = Util.supportsTransitionEnd() && animate;

        this._backdrop = document.createElement('div');
        this._backdrop.className = ClassName.BACKDROP;

        if (animate) {
          $(this._backdrop).addClass(animate);
        }

        $(this._backdrop).appendTo(document.body);

        $(this._element).on(Event.CLICK_DISMISS, function (event) {
          if (_this8._ignoreBackdropClick) {
            _this8._ignoreBackdropClick = false;
            return;
          }
          if (event.target !== event.currentTarget) {
            return;
          }
          if (_this8._config.backdrop === 'static') {
            _this8._element.focus();
          } else {
            _this8.hide();
          }
        });

        if (doAnimate) {
          Util.reflow(this._backdrop);
        }

        $(this._backdrop).addClass(ClassName.SHOW);

        if (!callback) {
          return;
        }

        if (!doAnimate) {
          callback();
          return;
        }

        $(this._backdrop).one(Util.TRANSITION_END, callback).emulateTransitionEnd(BACKDROP_TRANSITION_DURATION);
      } else if (!this._isShown && this._backdrop) {
        $(this._backdrop).removeClass(ClassName.SHOW);

        var callbackRemove = function callbackRemove() {
          _this8._removeBackdrop();
          if (callback) {
            callback();
          }
        };

        if (Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE)) {
          $(this._backdrop).one(Util.TRANSITION_END, callbackRemove).emulateTransitionEnd(BACKDROP_TRANSITION_DURATION);
        } else {
          callbackRemove();
        }
      } else if (callback) {
        callback();
      }
    };

    // ----------------------------------------------------------------------
    // the following methods are used to handle overflowing modals
    // todo (fat): these should probably be refactored out of modal.js
    // ----------------------------------------------------------------------

    Modal.prototype._handleUpdate = function _handleUpdate() {
      this._adjustDialog();
    };

    Modal.prototype._adjustDialog = function _adjustDialog() {
      var isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight;

      if (!this._isBodyOverflowing && isModalOverflowing) {
        this._element.style.paddingLeft = this._scrollbarWidth + 'px';
      }

      if (this._isBodyOverflowing && !isModalOverflowing) {
        this._element.style.paddingRight = this._scrollbarWidth + 'px';
      }
    };

    Modal.prototype._resetAdjustments = function _resetAdjustments() {
      this._element.style.paddingLeft = '';
      this._element.style.paddingRight = '';
    };

    Modal.prototype._checkScrollbar = function _checkScrollbar() {
      this._isBodyOverflowing = document.body.clientWidth < window.innerWidth;
      this._scrollbarWidth = this._getScrollbarWidth();
    };

    Modal.prototype._setScrollbar = function _setScrollbar() {
      var bodyPadding = parseInt($(Selector.FIXED_CONTENT).css('padding-right') || 0, 10);

      this._originalBodyPadding = document.body.style.paddingRight || '';

      if (this._isBodyOverflowing) {
        document.body.style.paddingRight = bodyPadding + this._scrollbarWidth + 'px';
      }
    };

    Modal.prototype._resetScrollbar = function _resetScrollbar() {
      document.body.style.paddingRight = this._originalBodyPadding;
    };

    Modal.prototype._getScrollbarWidth = function _getScrollbarWidth() {
      // thx d.walsh
      var scrollDiv = document.createElement('div');
      scrollDiv.className = ClassName.SCROLLBAR_MEASURER;
      document.body.appendChild(scrollDiv);
      var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
      document.body.removeChild(scrollDiv);
      return scrollbarWidth;
    };

    // static

    Modal._jQueryInterface = function _jQueryInterface(config, relatedTarget) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);
        var _config = $.extend({}, Modal.Default, $(this).data(), (typeof config === 'undefined' ? 'undefined' : _typeof(config)) === 'object' && config);

        if (!data) {
          data = new Modal(this, _config);
          $(this).data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (data[config] === undefined) {
            throw new Error('No method named "' + config + '"');
          }
          data[config](relatedTarget);
        } else if (_config.show) {
          data.show(relatedTarget);
        }
      });
    };

    _createClass(Modal, null, [{
      key: 'VERSION',
      get: function get() {
        return VERSION;
      }
    }, {
      key: 'Default',
      get: function get() {
        return Default;
      }
    }]);

    return Modal;
  }();

  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */

  $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
    var _this9 = this;

    var target = void 0;
    var selector = Util.getSelectorFromElement(this);

    if (selector) {
      target = $(selector)[0];
    }

    var config = $(target).data(DATA_KEY) ? 'toggle' : $.extend({}, $(target).data(), $(this).data());

    if (this.tagName === 'A' || this.tagName === 'AREA') {
      event.preventDefault();
    }

    var $target = $(target).one(Event.SHOW, function (showEvent) {
      if (showEvent.isDefaultPrevented()) {
        // only register focus restorer if modal will actually get shown
        return;
      }

      $target.one(Event.HIDDEN, function () {
        if ($(_this9).is(':visible')) {
          _this9.focus();
        }
      });
    });

    Modal._jQueryInterface.call($(target), config, this);
  });

  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Modal._jQueryInterface;
  $.fn[NAME].Constructor = Modal;
  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Modal._jQueryInterface;
  };

  return Modal;
}(jQuery);
//# sourceMappingURL=modal.js.map

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0-alpha.6): util.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */

var Util = function ($) {

  /**
   * ------------------------------------------------------------------------
   * Private TransitionEnd Helpers
   * ------------------------------------------------------------------------
   */

  var transition = false;

  var MAX_UID = 1000000;

  var TransitionEndEvent = {
    WebkitTransition: 'webkitTransitionEnd',
    MozTransition: 'transitionend',
    OTransition: 'oTransitionEnd otransitionend',
    transition: 'transitionend'
  };

  // shoutout AngusCroll (https://goo.gl/pxwQGp)
  function toType(obj) {
    return {}.toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase();
  }

  function isElement(obj) {
    return (obj[0] || obj).nodeType;
  }

  function getSpecialTransitionEndEvent() {
    return {
      bindType: transition.end,
      delegateType: transition.end,
      handle: function handle(event) {
        if ($(event.target).is(this)) {
          return event.handleObj.handler.apply(this, arguments); // eslint-disable-line prefer-rest-params
        }
        return undefined;
      }
    };
  }

  function transitionEndTest() {
    if (window.QUnit) {
      return false;
    }

    var el = document.createElement('bootstrap');

    for (var name in TransitionEndEvent) {
      if (el.style[name] !== undefined) {
        return {
          end: TransitionEndEvent[name]
        };
      }
    }

    return false;
  }

  function transitionEndEmulator(duration) {
    var _this = this;

    var called = false;

    $(this).one(Util.TRANSITION_END, function () {
      called = true;
    });

    setTimeout(function () {
      if (!called) {
        Util.triggerTransitionEnd(_this);
      }
    }, duration);

    return this;
  }

  function setTransitionEndSupport() {
    transition = transitionEndTest();

    $.fn.emulateTransitionEnd = transitionEndEmulator;

    if (Util.supportsTransitionEnd()) {
      $.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent();
    }
  }

  /**
   * --------------------------------------------------------------------------
   * Public Util Api
   * --------------------------------------------------------------------------
   */

  var Util = {

    TRANSITION_END: 'bsTransitionEnd',

    getUID: function getUID(prefix) {
      do {
        // eslint-disable-next-line no-bitwise
        prefix += ~~(Math.random() * MAX_UID); // "~~" acts like a faster Math.floor() here
      } while (document.getElementById(prefix));
      return prefix;
    },
    getSelectorFromElement: function getSelectorFromElement(element) {
      var selector = element.getAttribute('data-target');

      if (!selector) {
        selector = element.getAttribute('href') || '';
        selector = /^#[a-z]/i.test(selector) ? selector : null;
      }

      return selector;
    },
    reflow: function reflow(element) {
      return element.offsetHeight;
    },
    triggerTransitionEnd: function triggerTransitionEnd(element) {
      $(element).trigger(transition.end);
    },
    supportsTransitionEnd: function supportsTransitionEnd() {
      return Boolean(transition);
    },
    typeCheckConfig: function typeCheckConfig(componentName, config, configTypes) {
      for (var property in configTypes) {
        if (configTypes.hasOwnProperty(property)) {
          var expectedTypes = configTypes[property];
          var value = config[property];
          var valueType = value && isElement(value) ? 'element' : toType(value);

          if (!new RegExp(expectedTypes).test(valueType)) {
            throw new Error(componentName.toUpperCase() + ': ' + ('Option "' + property + '" provided type "' + valueType + '" ') + ('but expected type "' + expectedTypes + '".'));
          }
        }
      }
    }
  };

  setTransitionEndSupport();

  return Util;
}(jQuery);
//# sourceMappingURL=util.js.map

/*!
* jquery.inputmask.bundle.js
* https://github.com/RobinHerbots/Inputmask
* Copyright (c) 2010 - 2017 Robin Herbots
* Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
* Version: 3.3.11
*/

!function (e) {
  function t(a) {
    if (n[a]) return n[a].exports;var i = n[a] = { i: a, l: !1, exports: {} };return e[a].call(i.exports, i, i.exports, t), i.l = !0, i.exports;
  }var n = {};t.m = e, t.c = n, t.d = function (e, n, a) {
    t.o(e, n) || Object.defineProperty(e, n, { configurable: !1, enumerable: !0, get: a });
  }, t.n = function (e) {
    var n = e && e.__esModule ? function () {
      return e.default;
    } : function () {
      return e;
    };return t.d(n, "a", n), n;
  }, t.o = function (e, t) {
    return Object.prototype.hasOwnProperty.call(e, t);
  }, t.p = "", t(t.s = 3);
}([function (e, t, n) {
  "use strict";
  var a, i, r;"function" == typeof Symbol && Symbol.iterator;!function (o) {
    i = [n(2)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e) {
    return e;
  });
}, function (e, t, n) {
  "use strict";
  var a,
      i,
      r,
      o = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function (e) {
    return typeof e === 'undefined' ? 'undefined' : _typeof2(e);
  } : function (e) {
    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e === 'undefined' ? 'undefined' : _typeof2(e);
  };!function (o) {
    i = [n(0), n(10), n(11)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e, t, n, a) {
    function i(t, n, o) {
      if (!(this instanceof i)) return new i(t, n, o);this.el = a, this.events = {}, this.maskset = a, this.refreshValue = !1, !0 !== o && (e.isPlainObject(t) ? n = t : (n = n || {}).alias = t, this.opts = e.extend(!0, {}, this.defaults, n), this.noMasksCache = n && n.definitions !== a, this.userOptions = n || {}, this.isRTL = this.opts.numericInput, r(this.opts.alias, n, this.opts));
    }function r(t, n, o) {
      var s = i.prototype.aliases[t];return s ? (s.alias && r(s.alias, a, o), e.extend(!0, o, s), e.extend(!0, o, n), !0) : (null === o.mask && (o.mask = t), !1);
    }function s(t, n) {
      function r(t, r, o) {
        var s = !1;if (null !== t && "" !== t || ((s = null !== o.regex) ? t = (t = o.regex).replace(/^(\^)(.*)(\$)$/, "$2") : (s = !0, t = ".*")), 1 === t.length && !1 === o.greedy && 0 !== o.repeat && (o.placeholder = ""), o.repeat > 0 || "*" === o.repeat || "+" === o.repeat) {
          var l = "*" === o.repeat ? 0 : "+" === o.repeat ? 1 : o.repeat;t = o.groupmarker.start + t + o.groupmarker.end + o.quantifiermarker.start + l + "," + o.repeat + o.quantifiermarker.end;
        }var c,
            u = s ? "regex_" + o.regex : o.numericInput ? t.split("").reverse().join("") : t;return i.prototype.masksCache[u] === a || !0 === n ? (c = { mask: t, maskToken: i.prototype.analyseMask(t, s, o), validPositions: {}, _buffer: a, buffer: a, tests: {}, metadata: r, maskLength: a }, !0 !== n && (i.prototype.masksCache[u] = c, c = e.extend(!0, {}, i.prototype.masksCache[u]))) : c = e.extend(!0, {}, i.prototype.masksCache[u]), c;
      }if (e.isFunction(t.mask) && (t.mask = t.mask(t)), e.isArray(t.mask)) {
        if (t.mask.length > 1) {
          t.keepStatic = null === t.keepStatic || t.keepStatic;var o = t.groupmarker.start;return e.each(t.numericInput ? t.mask.reverse() : t.mask, function (n, i) {
            o.length > 1 && (o += t.groupmarker.end + t.alternatormarker + t.groupmarker.start), i.mask === a || e.isFunction(i.mask) ? o += i : o += i.mask;
          }), o += t.groupmarker.end, r(o, t.mask, t);
        }t.mask = t.mask.pop();
      }return t.mask && t.mask.mask !== a && !e.isFunction(t.mask.mask) ? r(t.mask.mask, t.mask, t) : r(t.mask, t.mask, t);
    }function l(r, s, c) {
      function m(e, t, n) {
        t = t || 0;var i,
            r,
            o,
            s = [],
            l = 0,
            u = v();do {
          !0 === e && h().validPositions[l] ? (r = (o = h().validPositions[l]).match, i = o.locator.slice(), s.push(!0 === n ? o.input : !1 === n ? r.nativeDef : I(l, r))) : (r = (o = b(l, i, l - 1)).match, i = o.locator.slice(), (!1 === c.jitMasking || l < u || "number" == typeof c.jitMasking && isFinite(c.jitMasking) && c.jitMasking > l) && s.push(!1 === n ? r.nativeDef : I(l, r))), l++;
        } while ((Q === a || l < Q) && (null !== r.fn || "" !== r.def) || t > l);return "" === s[s.length - 1] && s.pop(), h().maskLength = l + 1, s;
      }function h() {
        return s;
      }function g(e) {
        var t = h();t.buffer = a, !0 !== e && (t.validPositions = {}, t.p = 0);
      }function v(e, t, n) {
        var i = -1,
            r = -1,
            o = n || h().validPositions;e === a && (e = -1);for (var s in o) {
          var l = parseInt(s);o[l] && (t || !0 !== o[l].generatedInput) && (l <= e && (i = l), l >= e && (r = l));
        }return -1 !== i && e - i > 1 || r < e ? i : r;
      }function y(t, n, i, r) {
        var o,
            s = t,
            l = e.extend(!0, {}, h().validPositions),
            u = !1;for (h().p = t, o = n - 1; o >= s; o--) {
          h().validPositions[o] !== a && (!0 !== i && (!h().validPositions[o].match.optionality && function (e) {
            var t = h().validPositions[e];if (t !== a && null === t.match.fn) {
              var n = h().validPositions[e - 1],
                  i = h().validPositions[e + 1];return n !== a && i !== a;
            }return !1;
          }(o) || !1 === c.canClearPosition(h(), o, v(), r, c)) || delete h().validPositions[o]);
        }for (g(!0), o = s + 1; o <= v();) {
          for (; h().validPositions[s] !== a;) {
            s++;
          }if (o < s && (o = s + 1), h().validPositions[o] === a && M(o)) o++;else {
            var p = b(o);!1 === u && l[s] && l[s].match.def === p.match.def ? (h().validPositions[s] = e.extend(!0, {}, l[s]), h().validPositions[s].input = p.input, delete h().validPositions[o], o++) : P(s, p.match.def) ? !1 !== R(s, p.input || I(o), !0) && (delete h().validPositions[o], o++, u = !0) : M(o) || (o++, s--), s++;
          }
        }g(!0);
      }function k(e, t) {
        for (var n, i = e, r = v(), o = h().validPositions[r] || S(0)[0], s = o.alternation !== a ? o.locator[o.alternation].toString().split(",") : [], l = 0; l < i.length && (!((n = i[l]).match && (c.greedy && !0 !== n.match.optionalQuantifier || (!1 === n.match.optionality || !1 === n.match.newBlockMarker) && !0 !== n.match.optionalQuantifier) && (o.alternation === a || o.alternation !== n.alternation || n.locator[o.alternation] !== a && O(n.locator[o.alternation].toString().split(","), s))) || !0 === t && (null !== n.match.fn || /[0-9a-bA-Z]/.test(n.match.def))); l++) {}return n;
      }function b(e, t, n) {
        return h().validPositions[e] || k(S(e, t ? t.slice() : t, n));
      }function x(e) {
        return h().validPositions[e] ? h().validPositions[e] : S(e)[0];
      }function P(e, t) {
        for (var n = !1, a = S(e), i = 0; i < a.length; i++) {
          if (a[i].match && a[i].match.def === t) {
            n = !0;break;
          }
        }return n;
      }function S(t, n, i) {
        function r(n, i, o, l) {
          function p(o, l, g) {
            function v(t, n) {
              var a = 0 === e.inArray(t, n.matches);return a || e.each(n.matches, function (e, i) {
                if (!0 === i.isQuantifier && (a = v(t, n.matches[e - 1]))) return !1;
              }), a;
            }function y(t, n, i) {
              var r, o;if (h().validPositions[t - 1] && i && h().tests[t]) for (var s = h().validPositions[t - 1].locator, l = h().tests[t][0].locator, c = 0; c < i; c++) {
                if (s[c] !== l[c]) return s.slice(i + 1);
              }return (h().tests[t] || h().validPositions[t]) && e.each(h().tests[t] || [h().validPositions[t]], function (e, t) {
                var s = i !== a ? i : t.alternation,
                    l = t.locator[s] !== a ? t.locator[s].toString().indexOf(n) : -1;(o === a || l < o) && -1 !== l && (r = t, o = l);
              }), r ? r.locator.slice((i !== a ? i : r.alternation) + 1) : i !== a ? y(t, n) : a;
            }if (u > 1e4) throw "Inputmask: There is probably an error in your mask definition or in the code. Create an issue on github with an example of the mask you are using. " + h().mask;if (u === t && o.matches === a) return f.push({ match: o, locator: l.reverse(), cd: m }), !0;if (o.matches !== a) {
              if (o.isGroup && g !== o) {
                if (o = p(n.matches[e.inArray(o, n.matches) + 1], l)) return !0;
              } else if (o.isOptional) {
                var k = o;if (o = r(o, i, l, g)) {
                  if (s = f[f.length - 1].match, !v(s, k)) return !0;d = !0, u = t;
                }
              } else if (o.isAlternator) {
                var b,
                    x = o,
                    P = [],
                    S = f.slice(),
                    w = l.length,
                    A = i.length > 0 ? i.shift() : -1;if (-1 === A || "string" == typeof A) {
                  var E,
                      C = u,
                      O = i.slice(),
                      R = [];if ("string" == typeof A) R = A.split(",");else for (E = 0; E < x.matches.length; E++) {
                    R.push(E);
                  }for (var M = 0; M < R.length; M++) {
                    if (E = parseInt(R[M]), f = [], i = y(u, E, w) || O.slice(), !0 !== (o = p(x.matches[E] || n.matches[E], [E].concat(l), g) || o) && o !== a && R[R.length - 1] < x.matches.length) {
                      var _ = e.inArray(o, n.matches) + 1;n.matches.length > _ && (o = p(n.matches[_], [_].concat(l.slice(1, l.length)), g)) && (R.push(_.toString()), e.each(f, function (e, t) {
                        t.alternation = l.length - 1;
                      }));
                    }b = f.slice(), u = C, f = [];for (var D = 0; D < b.length; D++) {
                      var j = b[D],
                          N = !1;j.alternation = j.alternation || w;for (var I = 0; I < P.length; I++) {
                        var F = P[I];if ("string" != typeof A || -1 !== e.inArray(j.locator[j.alternation].toString(), R)) {
                          if (function (e, t) {
                            return e.match.nativeDef === t.match.nativeDef || e.match.def === t.match.nativeDef || e.match.nativeDef === t.match.def;
                          }(j, F)) {
                            N = !0, j.alternation === F.alternation && -1 === F.locator[F.alternation].toString().indexOf(j.locator[j.alternation]) && (F.locator[F.alternation] = F.locator[F.alternation] + "," + j.locator[j.alternation], F.alternation = j.alternation), j.match.nativeDef === F.match.def && (j.locator[j.alternation] = F.locator[F.alternation], P.splice(P.indexOf(F), 1, j));break;
                          }if (j.match.def === F.match.def) {
                            N = !1;break;
                          }if (function (e, n) {
                            return null === e.match.fn && null !== n.match.fn && n.match.fn.test(e.match.def, h(), t, !1, c, !1);
                          }(j, F) || function (e, n) {
                            return null !== e.match.fn && null !== n.match.fn && n.match.fn.test(e.match.def.replace(/[\[\]]/g, ""), h(), t, !1, c, !1);
                          }(j, F)) {
                            j.alternation === F.alternation && -1 === j.locator[j.alternation].toString().indexOf(F.locator[F.alternation].toString().split("")[0]) && (j.na = j.na || j.locator[j.alternation].toString(), -1 === j.na.indexOf(j.locator[j.alternation].toString().split("")[0]) && (j.na = j.na + "," + j.locator[F.alternation].toString().split("")[0]), N = !0, j.locator[j.alternation] = F.locator[F.alternation].toString().split("")[0] + "," + j.locator[j.alternation], P.splice(P.indexOf(F), 0, j));break;
                          }
                        }
                      }N || P.push(j);
                    }
                  }"string" == typeof A && (P = e.map(P, function (t, n) {
                    if (isFinite(n)) {
                      var i = t.alternation,
                          r = t.locator[i].toString().split(",");t.locator[i] = a, t.alternation = a;for (var o = 0; o < r.length; o++) {
                        -1 !== e.inArray(r[o], R) && (t.locator[i] !== a ? (t.locator[i] += ",", t.locator[i] += r[o]) : t.locator[i] = parseInt(r[o]), t.alternation = i);
                      }if (t.locator[i] !== a) return t;
                    }
                  })), f = S.concat(P), u = t, d = f.length > 0, o = P.length > 0, i = O.slice();
                } else o = p(x.matches[A] || n.matches[A], [A].concat(l), g);if (o) return !0;
              } else if (o.isQuantifier && g !== n.matches[e.inArray(o, n.matches) - 1]) for (var T = o, G = i.length > 0 ? i.shift() : 0; G < (isNaN(T.quantifier.max) ? G + 1 : T.quantifier.max) && u <= t; G++) {
                var B = n.matches[e.inArray(T, n.matches) - 1];if (o = p(B, [G].concat(l), B)) {
                  if (s = f[f.length - 1].match, s.optionalQuantifier = G > T.quantifier.min - 1, v(s, B)) {
                    if (G > T.quantifier.min - 1) {
                      d = !0, u = t;break;
                    }return !0;
                  }return !0;
                }
              } else if (o = r(o, i, l, g)) return !0;
            } else u++;
          }for (var g = i.length > 0 ? i.shift() : 0; g < n.matches.length; g++) {
            if (!0 !== n.matches[g].isQuantifier) {
              var v = p(n.matches[g], [g].concat(o), l);if (v && u === t) return v;if (u > t) break;
            }
          }
        }function o(e) {
          if (c.keepStatic && t > 0 && e.length > 1 + ("" === e[e.length - 1].match.def ? 1 : 0) && !0 !== e[0].match.optionality && !0 !== e[0].match.optionalQuantifier && null === e[0].match.fn && !/[0-9a-bA-Z]/.test(e[0].match.def)) {
            if (h().validPositions[t - 1] === a) return [k(e)];if (h().validPositions[t - 1].alternation === e[0].alternation) return [k(e)];if (h().validPositions[t - 1]) return [k(e)];
          }return e;
        }var s,
            l = h().maskToken,
            u = n ? i : 0,
            p = n ? n.slice() : [0],
            f = [],
            d = !1,
            m = n ? n.join("") : "";if (t > -1) {
          if (n === a) {
            for (var g, v = t - 1; (g = h().validPositions[v] || h().tests[v]) === a && v > -1;) {
              v--;
            }g !== a && v > -1 && (p = function (t) {
              var n = [];return e.isArray(t) || (t = [t]), t.length > 0 && (t[0].alternation === a ? 0 === (n = k(t.slice()).locator.slice()).length && (n = t[0].locator.slice()) : e.each(t, function (e, t) {
                if ("" !== t.def) if (0 === n.length) n = t.locator.slice();else for (var a = 0; a < n.length; a++) {
                  t.locator[a] && -1 === n[a].toString().indexOf(t.locator[a]) && (n[a] += "," + t.locator[a]);
                }
              })), n;
            }(g), m = p.join(""), u = v);
          }if (h().tests[t] && h().tests[t][0].cd === m) return o(h().tests[t]);for (var y = p.shift(); y < l.length && !(r(l[y], p, [y]) && u === t || u > t); y++) {}
        }return (0 === f.length || d) && f.push({ match: { fn: null, cardinality: 0, optionality: !0, casing: null, def: "", placeholder: "" }, locator: [], cd: m }), n !== a && h().tests[t] ? o(e.extend(!0, [], f)) : (h().tests[t] = e.extend(!0, [], f), o(h().tests[t]));
      }function w() {
        return h()._buffer === a && (h()._buffer = m(!1, 1), h().buffer === a && (h().buffer = h()._buffer.slice())), h()._buffer;
      }function A(e) {
        return h().buffer !== a && !0 !== e || (h().buffer = m(!0, v(), !0)), h().buffer;
      }function E(e, t, n) {
        var i, r;if (!0 === e) g(), e = 0, t = n.length;else for (i = e; i < t; i++) {
          delete h().validPositions[i];
        }for (r = e, i = e; i < t; i++) {
          if (g(!0), n[i] !== c.skipOptionalPartCharacter) {
            var o = R(r, n[i], !0, !0);!1 !== o && (g(!0), r = o.caret !== a ? o.caret : o.pos + 1);
          }
        }
      }function C(t, n, a) {
        switch (c.casing || n.casing) {case "upper":
            t = t.toUpperCase();break;case "lower":
            t = t.toLowerCase();break;case "title":
            var r = h().validPositions[a - 1];t = 0 === a || r && r.input === String.fromCharCode(i.keyCode.SPACE) ? t.toUpperCase() : t.toLowerCase();break;default:
            if (e.isFunction(c.casing)) {
              var o = Array.prototype.slice.call(arguments);o.push(h().validPositions), t = c.casing.apply(this, o);
            }}return t;
      }function O(t, n, i) {
        for (var r, o = c.greedy ? n : n.slice(0, 1), s = !1, l = i !== a ? i.split(",") : [], u = 0; u < l.length; u++) {
          -1 !== (r = t.indexOf(l[u])) && t.splice(r, 1);
        }for (var p = 0; p < t.length; p++) {
          if (-1 !== e.inArray(t[p], o)) {
            s = !0;break;
          }
        }return s;
      }function R(t, n, r, o, s, l) {
        function u(e) {
          var t = Z ? e.begin - e.end > 1 || e.begin - e.end == 1 : e.end - e.begin > 1 || e.end - e.begin == 1;return t && 0 === e.begin && e.end === h().maskLength ? "full" : t;
        }function p(n, i, r) {
          var s = !1;return e.each(S(n), function (l, p) {
            for (var d = p.match, m = i ? 1 : 0, k = "", b = d.cardinality; b > m; b--) {
              k += j(n - (b - 1));
            }if (i && (k += i), A(!0), !1 !== (s = null != d.fn ? d.fn.test(k, h(), n, r, c, u(t)) : (i === d.def || i === c.skipOptionalPartCharacter) && "" !== d.def && { c: I(n, d, !0) || d.def, pos: n })) {
              var x = s.c !== a ? s.c : i;x = x === c.skipOptionalPartCharacter && null === d.fn ? I(n, d, !0) || d.def : x;var P = n,
                  S = A();if (s.remove !== a && (e.isArray(s.remove) || (s.remove = [s.remove]), e.each(s.remove.sort(function (e, t) {
                return t - e;
              }), function (e, t) {
                y(t, t + 1, !0);
              })), s.insert !== a && (e.isArray(s.insert) || (s.insert = [s.insert]), e.each(s.insert.sort(function (e, t) {
                return e - t;
              }), function (e, t) {
                R(t.pos, t.c, !0, o);
              })), s.refreshFromBuffer) {
                var w = s.refreshFromBuffer;if (E(!0 === w ? w : w.start, w.end, S), s.pos === a && s.c === a) return s.pos = v(), !1;if ((P = s.pos !== a ? s.pos : n) !== n) return s = e.extend(s, R(P, x, !0, o)), !1;
              } else if (!0 !== s && s.pos !== a && s.pos !== n && (P = s.pos, E(n, P, A().slice()), P !== n)) return s = e.extend(s, R(P, x, !0)), !1;return (!0 === s || s.pos !== a || s.c !== a) && (l > 0 && g(!0), f(P, e.extend({}, p, { input: C(x, d, P) }), o, u(t)) || (s = !1), !1);
            }
          }), s;
        }function f(t, n, i, r) {
          if (r || c.insertMode && h().validPositions[t] !== a && i === a) {
            var o,
                s = e.extend(!0, {}, h().validPositions),
                l = v(a, !0);for (o = t; o <= l; o++) {
              delete h().validPositions[o];
            }h().validPositions[t] = e.extend(!0, {}, n);var u,
                p = !0,
                f = h().validPositions,
                m = !1,
                y = h().maskLength;for (o = u = t; o <= l; o++) {
              var k = s[o];if (k !== a) for (var b = u; b < h().maskLength && (null === k.match.fn && f[o] && (!0 === f[o].match.optionalQuantifier || !0 === f[o].match.optionality) || null != k.match.fn);) {
                if (b++, !1 === m && s[b] && s[b].match.def === k.match.def) h().validPositions[b] = e.extend(!0, {}, s[b]), h().validPositions[b].input = k.input, d(b), u = b, p = !0;else if (P(b, k.match.def)) {
                  var x = R(b, k.input, !0, !0);p = !1 !== x, u = x.caret || x.insert ? v() : b, m = !0;
                } else if (!(p = !0 === k.generatedInput) && b >= h().maskLength - 1) break;if (h().maskLength < y && (h().maskLength = y), p) break;
              }if (!p) break;
            }if (!p) return h().validPositions = e.extend(!0, {}, s), g(!0), !1;
          } else h().validPositions[t] = e.extend(!0, {}, n);return g(!0), !0;
        }function d(t) {
          for (var n = t - 1; n > -1 && !h().validPositions[n]; n--) {}var i, r;for (n++; n < t; n++) {
            h().validPositions[n] === a && (!1 === c.jitMasking || c.jitMasking > n) && ("" === (r = S(n, b(n - 1).locator, n - 1).slice())[r.length - 1].match.def && r.pop(), (i = k(r)) && (i.match.def === c.radixPointDefinitionSymbol || !M(n, !0) || e.inArray(c.radixPoint, A()) < n && i.match.fn && i.match.fn.test(I(n), h(), n, !1, c)) && !1 !== (x = p(n, I(n, i.match, !0) || (null == i.match.fn ? i.match.def : "" !== I(n) ? I(n) : A()[n]), !0)) && (h().validPositions[x.pos || n].generatedInput = !0));
          }
        }r = !0 === r;var m = t;t.begin !== a && (m = Z && !u(t) ? t.end : t.begin);var x = !0,
            w = e.extend(!0, {}, h().validPositions);if (e.isFunction(c.preValidation) && !r && !0 !== o && !0 !== l && (x = c.preValidation(A(), m, n, u(t), c)), !0 === x) {
          if (d(m), u(t) && (V(a, i.keyCode.DELETE, t, !0, !0), m = h().p), m < h().maskLength && (Q === a || m < Q) && (x = p(m, n, r), (!r || !0 === o) && !1 === x && !0 !== l)) {
            var D = h().validPositions[m];if (!D || null !== D.match.fn || D.match.def !== n && n !== c.skipOptionalPartCharacter) {
              if ((c.insertMode || h().validPositions[_(m)] === a) && !M(m, !0)) for (var N = m + 1, F = _(m); N <= F; N++) {
                if (!1 !== (x = p(N, n, r))) {
                  !function (t, n) {
                    var i = h().validPositions[n];if (i) for (var r = i.locator, o = r.length, s = t; s < n; s++) {
                      if (h().validPositions[s] === a && !M(s, !0)) {
                        var l = S(s).slice(),
                            c = k(l, !0),
                            u = -1;"" === l[l.length - 1].match.def && l.pop(), e.each(l, function (e, t) {
                          for (var n = 0; n < o; n++) {
                            if (t.locator[n] === a || !O(t.locator[n].toString().split(","), r[n].toString().split(","), t.na)) {
                              var i = r[n],
                                  s = c.locator[n],
                                  l = t.locator[n];i - s > Math.abs(i - l) && (c = t);break;
                            }u < n && (u = n, c = t);
                          }
                        }), (c = e.extend({}, c, { input: I(s, c.match, !0) || c.match.def })).generatedInput = !0, f(s, c, !0), h().validPositions[n] = a, p(n, i.input, !0);
                      }
                    }
                  }(m, x.pos !== a ? x.pos : N), m = N;break;
                }
              }
            } else x = { caret: _(m) };
          }!1 === x && c.keepStatic && !r && !0 !== s && (x = function (t, n, i) {
            var r,
                s,
                l,
                u,
                p,
                f,
                d,
                m,
                y = e.extend(!0, {}, h().validPositions),
                k = !1,
                b = v();for (u = h().validPositions[b]; b >= 0; b--) {
              if ((l = h().validPositions[b]) && l.alternation !== a) {
                if (r = b, s = h().validPositions[r].alternation, u.locator[l.alternation] !== l.locator[l.alternation]) break;u = l;
              }
            }if (s !== a) {
              m = parseInt(r);var x = u.locator[u.alternation || s] !== a ? u.locator[u.alternation || s] : d[0];x.length > 0 && (x = x.split(",")[0]);var P = h().validPositions[m],
                  w = h().validPositions[m - 1];e.each(S(m, w ? w.locator : a, m - 1), function (r, l) {
                d = l.locator[s] ? l.locator[s].toString().split(",") : [];for (var u = 0; u < d.length; u++) {
                  var b = [],
                      S = 0,
                      w = 0,
                      A = !1;if (x < d[u] && (l.na === a || -1 === e.inArray(d[u], l.na.split(",")) || -1 === e.inArray(x.toString(), d))) {
                    h().validPositions[m] = e.extend(!0, {}, l);var E = h().validPositions[m].locator;for (h().validPositions[m].locator[s] = parseInt(d[u]), null == l.match.fn ? (P.input !== l.match.def && (A = !0, !0 !== P.generatedInput && b.push(P.input)), w++, h().validPositions[m].generatedInput = !/[0-9a-bA-Z]/.test(l.match.def), h().validPositions[m].input = l.match.def) : h().validPositions[m].input = P.input, p = m + 1; p < v(a, !0) + 1; p++) {
                      (f = h().validPositions[p]) && !0 !== f.generatedInput && /[0-9a-bA-Z]/.test(f.input) ? b.push(f.input) : p < t && S++, delete h().validPositions[p];
                    }for (A && b[0] === l.match.def && b.shift(), g(!0), k = !0; b.length > 0;) {
                      var C = b.shift();if (C !== c.skipOptionalPartCharacter && !(k = R(v(a, !0) + 1, C, !1, o, !0))) break;
                    }if (k) {
                      h().validPositions[m].locator = E;var O = v(t) + 1;for (p = m + 1; p < v() + 1; p++) {
                        ((f = h().validPositions[p]) === a || null == f.match.fn) && p < t + (w - S) && w++;
                      }k = R((t += w - S) > O ? O : t, n, i, o, !0);
                    }if (k) return !1;g(), h().validPositions = e.extend(!0, {}, y);
                  }
                }
              });
            }return k;
          }(m, n, r)), !0 === x && (x = { pos: m });
        }if (e.isFunction(c.postValidation) && !1 !== x && !r && !0 !== o && !0 !== l) {
          var T = c.postValidation(A(!0), x, c);if (T.refreshFromBuffer && T.buffer) {
            var G = T.refreshFromBuffer;E(!0 === G ? G : G.start, G.end, T.buffer);
          }x = !0 === T ? x : T;
        }return x && x.pos === a && (x.pos = m), !1 !== x && !0 !== l || (g(!0), h().validPositions = e.extend(!0, {}, w)), x;
      }function M(e, t) {
        var n = b(e).match;if ("" === n.def && (n = x(e).match), null != n.fn) return n.fn;if (!0 !== t && e > -1) {
          var a = S(e);return a.length > 1 + ("" === a[a.length - 1].match.def ? 1 : 0);
        }return !1;
      }function _(e, t) {
        var n = h().maskLength;if (e >= n) return n;var a = e;for (S(n + 1).length > 1 && (m(!0, n + 1, !0), n = h().maskLength); ++a < n && (!0 === t && (!0 !== x(a).match.newBlockMarker || !M(a)) || !0 !== t && !M(a));) {}return a;
      }function D(e, t) {
        var n,
            a = e;if (a <= 0) return 0;for (; --a > 0 && (!0 === t && !0 !== x(a).match.newBlockMarker || !0 !== t && !M(a) && ((n = S(a)).length < 2 || 2 === n.length && "" === n[1].match.def));) {}return a;
      }function j(e) {
        return h().validPositions[e] === a ? I(e) : h().validPositions[e].input;
      }function N(t, n, i, r, o) {
        if (r && e.isFunction(c.onBeforeWrite)) {
          var s = c.onBeforeWrite.call(W, r, n, i, c);if (s) {
            if (s.refreshFromBuffer) {
              var l = s.refreshFromBuffer;E(!0 === l ? l : l.start, l.end, s.buffer || n), n = A(!0);
            }i !== a && (i = s.caret !== a ? s.caret : i);
          }
        }t !== a && (t.inputmask._valueSet(n.join("")), i === a || r !== a && "blur" === r.type ? H(t, i, 0 === n.length) : d && r && "input" === r.type ? setTimeout(function () {
          G(t, i);
        }, 0) : G(t, i), !0 === o && (X = !0, e(t).trigger("input")));
      }function I(t, n, i) {
        if ((n = n || x(t).match).placeholder !== a || !0 === i) return e.isFunction(n.placeholder) ? n.placeholder(c) : n.placeholder;if (null === n.fn) {
          if (t > -1 && h().validPositions[t] === a) {
            var r,
                o = S(t),
                s = [];if (o.length > 1 + ("" === o[o.length - 1].match.def ? 1 : 0)) for (var l = 0; l < o.length; l++) {
              if (!0 !== o[l].match.optionality && !0 !== o[l].match.optionalQuantifier && (null === o[l].match.fn || r === a || !1 !== o[l].match.fn.test(r.match.def, h(), t, !0, c)) && (s.push(o[l]), null === o[l].match.fn && (r = o[l]), s.length > 1 && /[0-9a-bA-Z]/.test(s[0].match.def))) return c.placeholder.charAt(t % c.placeholder.length);
            }
          }return n.def;
        }return c.placeholder.charAt(t % c.placeholder.length);
      }function F(t, r, o, s, l) {
        function u(e, t) {
          return -1 !== w().slice(e, _(e)).join("").indexOf(t) && !M(e) && x(e).match.nativeDef === t.charAt(t.length - 1);
        }var p = s.slice(),
            f = "",
            d = -1,
            m = a;if (g(), o || !0 === c.autoUnmask) d = _(d);else {
          var y = w().slice(0, _(-1)).join(""),
              k = p.join("").match(new RegExp("^" + i.escapeRegex(y), "g"));k && k.length > 0 && (p.splice(0, k.length * y.length), d = _(d));
        }if (-1 === d ? (h().p = _(d), d = 0) : h().p = d, e.each(p, function (n, i) {
          if (i !== a) if (h().validPositions[n] === a && p[n] === I(n) && M(n, !0) && !1 === R(n, p[n], !0, a, a, !0)) h().p++;else {
            var r = new e.Event("_checkval");r.which = i.charCodeAt(0), f += i;var s = v(a, !0),
                l = h().validPositions[s],
                y = b(s + 1, l ? l.locator.slice() : a, s);if (!u(d, f) || o || c.autoUnmask) {
              var k = o ? n : null == y.match.fn && y.match.optionality && s + 1 < h().p ? s + 1 : h().p;m = ae.keypressEvent.call(t, r, !0, !1, o, k), d = k + 1, f = "";
            } else m = ae.keypressEvent.call(t, r, !0, !1, !0, s + 1);if (!1 !== m && !o && e.isFunction(c.onBeforeWrite)) {
              var x = m;if (m = c.onBeforeWrite.call(W, r, A(), m.forwardPosition, c), (m = e.extend(x, m)) && m.refreshFromBuffer) {
                var P = m.refreshFromBuffer;E(!0 === P ? P : P.start, P.end, m.buffer), g(!0), m.caret && (h().p = m.caret, m.forwardPosition = m.caret);
              }
            }
          }
        }), r) {
          var P = a;n.activeElement === t && m && (P = c.numericInput ? D(m.forwardPosition) : m.forwardPosition), N(t, A(), P, l || new e.Event("checkval"), l && "input" === l.type);
        }
      }function T(t) {
        if (t) {
          if (t.inputmask === a) return t.value;t.inputmask && t.inputmask.refreshValue && ae.setValueEvent.call(t);
        }var n = [],
            i = h().validPositions;for (var r in i) {
          i[r].match && null != i[r].match.fn && n.push(i[r].input);
        }var o = 0 === n.length ? "" : (Z ? n.reverse() : n).join("");if (e.isFunction(c.onUnMask)) {
          var s = (Z ? A().slice().reverse() : A()).join("");o = c.onUnMask.call(W, s, o, c);
        }return o;
      }function G(e, i, r, o) {
        function s(e) {
          return !0 === o || !Z || "number" != typeof e || c.greedy && "" === c.placeholder || (e = A().join("").length - e), e;
        }var l;if (i === a) return e.setSelectionRange ? (i = e.selectionStart, r = e.selectionEnd) : t.getSelection ? (l = t.getSelection().getRangeAt(0)).commonAncestorContainer.parentNode !== e && l.commonAncestorContainer !== e || (i = l.startOffset, r = l.endOffset) : n.selection && n.selection.createRange && (r = (i = 0 - (l = n.selection.createRange()).duplicate().moveStart("character", -e.inputmask._valueGet().length)) + l.text.length), { begin: s(i), end: s(r) };if (i.begin !== a && (r = i.end, i = i.begin), "number" == typeof i) {
          i = s(i), r = "number" == typeof (r = s(r)) ? r : i;var p = parseInt(((e.ownerDocument.defaultView || t).getComputedStyle ? (e.ownerDocument.defaultView || t).getComputedStyle(e, null) : e.currentStyle).fontSize) * r;if (e.scrollLeft = p > e.scrollWidth ? p : 0, u || !1 !== c.insertMode || i !== r || r++, e.setSelectionRange) e.selectionStart = i, e.selectionEnd = r;else if (t.getSelection) {
            if (l = n.createRange(), e.firstChild === a || null === e.firstChild) {
              var f = n.createTextNode("");e.appendChild(f);
            }l.setStart(e.firstChild, i < e.inputmask._valueGet().length ? i : e.inputmask._valueGet().length), l.setEnd(e.firstChild, r < e.inputmask._valueGet().length ? r : e.inputmask._valueGet().length), l.collapse(!0);var d = t.getSelection();d.removeAllRanges(), d.addRange(l);
          } else e.createTextRange && ((l = e.createTextRange()).collapse(!0), l.moveEnd("character", r), l.moveStart("character", i), l.select());H(e, { begin: i, end: r });
        }
      }function B(t) {
        var n,
            i,
            r = A(),
            o = r.length,
            s = v(),
            l = {},
            c = h().validPositions[s],
            u = c !== a ? c.locator.slice() : a;for (n = s + 1; n < r.length; n++) {
          u = (i = b(n, u, n - 1)).locator.slice(), l[n] = e.extend(!0, {}, i);
        }var p = c && c.alternation !== a ? c.locator[c.alternation] : a;for (n = o - 1; n > s && ((i = l[n]).match.optionality || i.match.optionalQuantifier && i.match.newBlockMarker || p && (p !== l[n].locator[c.alternation] && null != i.match.fn || null === i.match.fn && i.locator[c.alternation] && O(i.locator[c.alternation].toString().split(","), p.toString().split(",")) && "" !== S(n)[0].def)) && r[n] === I(n, i.match); n--) {
          o--;
        }return t ? { l: o, def: l[o] ? l[o].match : a } : o;
      }function L(e) {
        for (var t, n = B(), i = e.length, r = h().validPositions[v()]; n < i && !M(n, !0) && (t = r !== a ? b(n, r.locator.slice(""), r) : x(n)) && !0 !== t.match.optionality && (!0 !== t.match.optionalQuantifier && !0 !== t.match.newBlockMarker || n + 1 === i && "" === (r !== a ? b(n + 1, r.locator.slice(""), r) : x(n + 1)).match.def);) {
          n++;
        }for (; (t = h().validPositions[n - 1]) && t && t.match.optionality && t.input === c.skipOptionalPartCharacter;) {
          n--;
        }return e.splice(n), e;
      }function U(t) {
        if (e.isFunction(c.isComplete)) return c.isComplete(t, c);if ("*" === c.repeat) return a;var n = !1,
            i = B(!0),
            r = D(i.l);if (i.def === a || i.def.newBlockMarker || i.def.optionality || i.def.optionalQuantifier) {
          n = !0;for (var o = 0; o <= r; o++) {
            var s = b(o).match;if (null !== s.fn && h().validPositions[o] === a && !0 !== s.optionality && !0 !== s.optionalQuantifier || null === s.fn && t[o] !== I(o, s)) {
              n = !1;break;
            }
          }
        }return n;
      }function V(t, n, r, o, s) {
        if ((c.numericInput || Z) && (n === i.keyCode.BACKSPACE ? n = i.keyCode.DELETE : n === i.keyCode.DELETE && (n = i.keyCode.BACKSPACE), Z)) {
          var l = r.end;r.end = r.begin, r.begin = l;
        }n === i.keyCode.BACKSPACE && (r.end - r.begin < 1 || !1 === c.insertMode) ? (r.begin = D(r.begin), h().validPositions[r.begin] !== a && h().validPositions[r.begin].input === c.groupSeparator && r.begin--) : n === i.keyCode.DELETE && r.begin === r.end && (r.end = M(r.end, !0) && h().validPositions[r.end] && h().validPositions[r.end].input !== c.radixPoint ? r.end + 1 : _(r.end) + 1, h().validPositions[r.begin] !== a && h().validPositions[r.begin].input === c.groupSeparator && r.end++), y(r.begin, r.end, !1, o), !0 !== o && function () {
          if (c.keepStatic) {
            for (var n = [], i = v(-1, !0), r = e.extend(!0, {}, h().validPositions), o = h().validPositions[i]; i >= 0; i--) {
              var s = h().validPositions[i];if (s) {
                if (!0 !== s.generatedInput && /[0-9a-bA-Z]/.test(s.input) && n.push(s.input), delete h().validPositions[i], s.alternation !== a && s.locator[s.alternation] !== o.locator[s.alternation]) break;o = s;
              }
            }if (i > -1) for (h().p = _(v(-1, !0)); n.length > 0;) {
              var l = new e.Event("keypress");l.which = n.pop().charCodeAt(0), ae.keypressEvent.call(t, l, !0, !1, !1, h().p);
            } else h().validPositions = e.extend(!0, {}, r);
          }
        }();var u = v(r.begin, !0);if (u < r.begin) h().p = _(u);else if (!0 !== o && (h().p = r.begin, !0 !== s)) for (; h().p < u && h().validPositions[h().p] === a;) {
          h().p++;
        }
      }function K(a) {
        function i(e) {
          var t,
              i = n.createElement("span");for (var o in r) {
            isNaN(o) && -1 !== o.indexOf("font") && (i.style[o] = r[o]);
          }i.style.textTransform = r.textTransform, i.style.letterSpacing = r.letterSpacing, i.style.position = "absolute", i.style.height = "auto", i.style.width = "auto", i.style.visibility = "hidden", i.style.whiteSpace = "nowrap", n.body.appendChild(i);var s,
              l = a.inputmask._valueGet(),
              c = 0;for (t = 0, s = l.length; t <= s; t++) {
            if (i.innerHTML += l.charAt(t) || "_", i.offsetWidth >= e) {
              var u = e - c,
                  p = i.offsetWidth - e;i.innerHTML = l.charAt(t), t = (u -= i.offsetWidth / 3) < p ? t - 1 : t;break;
            }c = i.offsetWidth;
          }return n.body.removeChild(i), t;
        }var r = (a.ownerDocument.defaultView || t).getComputedStyle(a, null),
            o = n.createElement("div");o.style.width = r.width, o.style.textAlign = r.textAlign, ($ = n.createElement("div")).className = "im-colormask", a.parentNode.insertBefore($, a), a.parentNode.removeChild(a), $.appendChild(o), $.appendChild(a), a.style.left = o.offsetLeft + "px", e(a).on("click", function (e) {
          return G(a, i(e.clientX)), ae.clickEvent.call(a, [e]);
        }), e(a).on("keydown", function (e) {
          e.shiftKey || !1 === c.insertMode || setTimeout(function () {
            H(a);
          }, 0);
        });
      }function H(e, t, i) {
        function r() {
          f || null !== s.fn && l.input !== a ? f && (null !== s.fn && l.input !== a || "" === s.def) && (f = !1, p += "</span>") : (f = !0, p += "<span class='im-static'>");
        }function o(a) {
          !0 !== a && d !== t.begin || n.activeElement !== e || (p += "<span class='im-caret' style='border-right-width: 1px;border-right-style: solid;'></span>");
        }var s,
            l,
            u,
            p = "",
            f = !1,
            d = 0;if ($ !== a) {
          var m = A();if (t === a ? t = G(e) : t.begin === a && (t = { begin: t, end: t }), !0 !== i) {
            var g = v();do {
              o(), h().validPositions[d] ? (l = h().validPositions[d], s = l.match, u = l.locator.slice(), r(), p += m[d]) : (l = b(d, u, d - 1), s = l.match, u = l.locator.slice(), (!1 === c.jitMasking || d < g || "number" == typeof c.jitMasking && isFinite(c.jitMasking) && c.jitMasking > d) && (r(), p += I(d, s))), d++;
            } while ((Q === a || d < Q) && (null !== s.fn || "" !== s.def) || g > d || f);-1 === p.indexOf("im-caret") && o(!0), f && r();
          }var y = $.getElementsByTagName("div")[0];y.innerHTML = p, e.inputmask.positionColorMask(e, y);
        }
      }s = s || this.maskset, c = c || this.opts;var z,
          q,
          Q,
          $,
          W = this,
          Y = this.el,
          Z = this.isRTL,
          J = !1,
          X = !1,
          ee = !1,
          te = !1,
          ne = { on: function on(t, n, r) {
          var o = function o(t) {
            if (this.inputmask === a && "FORM" !== this.nodeName) {
              var n = e.data(this, "_inputmask_opts");n ? new i(n).mask(this) : ne.off(this);
            } else {
              if ("setvalue" === t.type || "FORM" === this.nodeName || !(this.disabled || this.readOnly && !("keydown" === t.type && t.ctrlKey && 67 === t.keyCode || !1 === c.tabThrough && t.keyCode === i.keyCode.TAB))) {
                switch (t.type) {case "input":
                    if (!0 === X) return X = !1, t.preventDefault();break;case "keydown":
                    J = !1, X = !1;break;case "keypress":
                    if (!0 === J) return t.preventDefault();J = !0;break;case "click":
                    if (p || f) {
                      var o = this,
                          s = arguments;return setTimeout(function () {
                        r.apply(o, s);
                      }, 0), !1;
                    }}var l = r.apply(this, arguments);return !1 === l && (t.preventDefault(), t.stopPropagation()), l;
              }t.preventDefault();
            }
          };t.inputmask.events[n] = t.inputmask.events[n] || [], t.inputmask.events[n].push(o), -1 !== e.inArray(n, ["submit", "reset"]) ? null !== t.form && e(t.form).on(n, o) : e(t).on(n, o);
        }, off: function off(t, n) {
          if (t.inputmask && t.inputmask.events) {
            var a;n ? (a = [])[n] = t.inputmask.events[n] : a = t.inputmask.events, e.each(a, function (n, a) {
              for (; a.length > 0;) {
                var i = a.pop();-1 !== e.inArray(n, ["submit", "reset"]) ? null !== t.form && e(t.form).off(n, i) : e(t).off(n, i);
              }delete t.inputmask.events[n];
            });
          }
        } },
          ae = { keydownEvent: function keydownEvent(t) {
          var a = this,
              r = e(a),
              o = t.keyCode,
              s = G(a);if (o === i.keyCode.BACKSPACE || o === i.keyCode.DELETE || f && o === i.keyCode.BACKSPACE_SAFARI || t.ctrlKey && o === i.keyCode.X && !function (e) {
            var t = n.createElement("input"),
                a = "on" + e,
                i = a in t;return i || (t.setAttribute(a, "return;"), i = "function" == typeof t[a]), t = null, i;
          }("cut")) t.preventDefault(), V(a, o, s), N(a, A(!0), h().p, t, a.inputmask._valueGet() !== A().join("")), a.inputmask._valueGet() === w().join("") ? r.trigger("cleared") : !0 === U(A()) && r.trigger("complete");else if (o === i.keyCode.END || o === i.keyCode.PAGE_DOWN) {
            t.preventDefault();var l = _(v());c.insertMode || l !== h().maskLength || t.shiftKey || l--, G(a, t.shiftKey ? s.begin : l, l, !0);
          } else o === i.keyCode.HOME && !t.shiftKey || o === i.keyCode.PAGE_UP ? (t.preventDefault(), G(a, 0, t.shiftKey ? s.begin : 0, !0)) : (c.undoOnEscape && o === i.keyCode.ESCAPE || 90 === o && t.ctrlKey) && !0 !== t.altKey ? (F(a, !0, !1, z.split("")), r.trigger("click")) : o !== i.keyCode.INSERT || t.shiftKey || t.ctrlKey ? !0 === c.tabThrough && o === i.keyCode.TAB ? (!0 === t.shiftKey ? (null === x(s.begin).match.fn && (s.begin = _(s.begin)), s.end = D(s.begin, !0), s.begin = D(s.end, !0)) : (s.begin = _(s.begin, !0), s.end = _(s.begin, !0), s.end < h().maskLength && s.end--), s.begin < h().maskLength && (t.preventDefault(), G(a, s.begin, s.end))) : t.shiftKey || !1 === c.insertMode && (o === i.keyCode.RIGHT ? setTimeout(function () {
            var e = G(a);G(a, e.begin);
          }, 0) : o === i.keyCode.LEFT && setTimeout(function () {
            var e = G(a);G(a, Z ? e.begin + 1 : e.begin - 1);
          }, 0)) : (c.insertMode = !c.insertMode, G(a, c.insertMode || s.begin !== h().maskLength ? s.begin : s.begin - 1));c.onKeyDown.call(this, t, A(), G(a).begin, c), ee = -1 !== e.inArray(o, c.ignorables);
        }, keypressEvent: function keypressEvent(t, n, r, o, s) {
          var l = this,
              u = e(l),
              p = t.which || t.charCode || t.keyCode;if (!(!0 === n || t.ctrlKey && t.altKey) && (t.ctrlKey || t.metaKey || ee)) return p === i.keyCode.ENTER && z !== A().join("") && (z = A().join(""), setTimeout(function () {
            u.trigger("change");
          }, 0)), !0;if (p) {
            46 === p && !1 === t.shiftKey && "" !== c.radixPoint && (p = c.radixPoint.charCodeAt(0));var f,
                d = n ? { begin: s, end: s } : G(l),
                m = String.fromCharCode(p);h().writeOutBuffer = !0;var v = R(d, m, o);if (!1 !== v && (g(!0), f = v.caret !== a ? v.caret : n ? v.pos + 1 : _(v.pos), h().p = f), !1 !== r && (setTimeout(function () {
              c.onKeyValidation.call(l, p, v, c);
            }, 0), h().writeOutBuffer && !1 !== v)) {
              var y = A();N(l, y, c.numericInput && v.caret === a ? D(f) : f, t, !0 !== n), !0 !== n && setTimeout(function () {
                !0 === U(y) && u.trigger("complete");
              }, 0);
            }if (t.preventDefault(), n) return !1 !== v && (v.forwardPosition = f), v;
          }
        }, pasteEvent: function pasteEvent(n) {
          var a,
              i = this,
              r = n.originalEvent || n,
              o = e(i),
              s = i.inputmask._valueGet(!0),
              l = G(i);Z && (a = l.end, l.end = l.begin, l.begin = a);var u = s.substr(0, l.begin),
              p = s.substr(l.end, s.length);if (u === (Z ? w().reverse() : w()).slice(0, l.begin).join("") && (u = ""), p === (Z ? w().reverse() : w()).slice(l.end).join("") && (p = ""), Z && (a = u, u = p, p = a), t.clipboardData && t.clipboardData.getData) s = u + t.clipboardData.getData("Text") + p;else {
            if (!r.clipboardData || !r.clipboardData.getData) return !0;s = u + r.clipboardData.getData("text/plain") + p;
          }var f = s;if (e.isFunction(c.onBeforePaste)) {
            if (!1 === (f = c.onBeforePaste.call(W, s, c))) return n.preventDefault();f || (f = s);
          }return F(i, !1, !1, Z ? f.split("").reverse() : f.toString().split("")), N(i, A(), _(v()), n, z !== A().join("")), !0 === U(A()) && o.trigger("complete"), n.preventDefault();
        }, inputFallBackEvent: function inputFallBackEvent(t) {
          var n = this,
              a = n.inputmask._valueGet();if (A().join("") !== a) {
            var r = G(n);if (!1 === function (t, n, a) {
              if ("." === n.charAt(a.begin - 1) && "" !== c.radixPoint && ((n = n.split(""))[a.begin - 1] = c.radixPoint.charAt(0), n = n.join("")), n.charAt(a.begin - 1) === c.radixPoint && n.length > A().length) {
                var i = new e.Event("keypress");return i.which = c.radixPoint.charCodeAt(0), ae.keypressEvent.call(t, i, !0, !0, !1, a.begin - 1), !1;
              }
            }(n, a, r)) return !1;if (a = a.replace(new RegExp("(" + i.escapeRegex(w().join("")) + ")*"), ""), !1 === function (t, n, a) {
              if (p) {
                var i = n.replace(A().join(""), "");if (1 === i.length) {
                  var r = new e.Event("keypress");return r.which = i.charCodeAt(0), ae.keypressEvent.call(t, r, !0, !0, !1, h().validPositions[a.begin - 1] ? a.begin : a.begin - 1), !1;
                }
              }
            }(n, a, r)) return !1;r.begin > a.length && (G(n, a.length), r = G(n));var o = A().join(""),
                s = a.substr(0, r.begin),
                l = a.substr(r.begin),
                u = o.substr(0, r.begin),
                f = o.substr(r.begin),
                d = r,
                m = "",
                g = !1;if (s !== u) {
              d.begin = 0;for (var v = (g = s.length >= u.length) ? s.length : u.length, y = 0; s.charAt(y) === u.charAt(y) && y < v; y++) {
                d.begin++;
              }g && (m += s.slice(d.begin, d.end));
            }l !== f && (l.length > f.length ? g && (d.end = d.begin) : l.length < f.length ? d.end += f.length - l.length : l.charAt(0) !== f.charAt(0) && d.end++), N(n, A(), d), m.length > 0 ? e.each(m.split(""), function (t, a) {
              var i = new e.Event("keypress");i.which = a.charCodeAt(0), ee = !1, ae.keypressEvent.call(n, i);
            }) : (d.begin === d.end - 1 && G(n, D(d.begin + 1), d.end), t.keyCode = i.keyCode.DELETE, ae.keydownEvent.call(n, t)), t.preventDefault();
          }
        }, setValueEvent: function setValueEvent(t) {
          this.inputmask.refreshValue = !1;var n = this,
              a = n.inputmask._valueGet(!0);e.isFunction(c.onBeforeMask) && (a = c.onBeforeMask.call(W, a, c) || a), a = a.split(""), F(n, !0, !1, Z ? a.reverse() : a), z = A().join(""), (c.clearMaskOnLostFocus || c.clearIncomplete) && n.inputmask._valueGet() === w().join("") && n.inputmask._valueSet("");
        }, focusEvent: function focusEvent(e) {
          var t = this,
              n = t.inputmask._valueGet();c.showMaskOnFocus && (!c.showMaskOnHover || c.showMaskOnHover && "" === n) && (t.inputmask._valueGet() !== A().join("") ? N(t, A(), _(v())) : !1 === te && G(t, _(v()))), !0 === c.positionCaretOnTab && !1 === te && "" !== n && (N(t, A(), G(t)), ae.clickEvent.apply(t, [e, !0])), z = A().join("");
        }, mouseleaveEvent: function mouseleaveEvent(e) {
          var t = this;if (te = !1, c.clearMaskOnLostFocus && n.activeElement !== t) {
            var a = A().slice(),
                i = t.inputmask._valueGet();i !== t.getAttribute("placeholder") && "" !== i && (-1 === v() && i === w().join("") ? a = [] : L(a), N(t, a));
          }
        }, clickEvent: function clickEvent(t, i) {
          function r(t) {
            if ("" !== c.radixPoint) {
              var n = h().validPositions;if (n[t] === a || n[t].input === I(t)) {
                if (t < _(-1)) return !0;var i = e.inArray(c.radixPoint, A());if (-1 !== i) {
                  for (var r in n) {
                    if (i < r && n[r].input !== I(r)) return !1;
                  }return !0;
                }
              }
            }return !1;
          }var o = this;setTimeout(function () {
            if (n.activeElement === o) {
              var e = G(o);if (i && (Z ? e.end = e.begin : e.begin = e.end), e.begin === e.end) switch (c.positionCaretOnClick) {case "none":
                  break;case "radixFocus":
                  if (r(e.begin)) {
                    var t = A().join("").indexOf(c.radixPoint);G(o, c.numericInput ? _(t) : t);break;
                  }default:
                  var s = e.begin,
                      l = v(s, !0),
                      u = _(l);if (s < u) G(o, M(s, !0) || M(s - 1, !0) ? s : _(s));else {
                    var p = h().validPositions[l],
                        f = b(u, p ? p.match.locator : a, p),
                        d = I(u, f.match);if ("" !== d && A()[u] !== d && !0 !== f.match.optionalQuantifier && !0 !== f.match.newBlockMarker || !M(u, !0) && f.match.def === d) {
                      var m = _(u);(s >= m || s === u) && (u = m);
                    }G(o, u);
                  }}
            }
          }, 0);
        }, dblclickEvent: function dblclickEvent(e) {
          var t = this;setTimeout(function () {
            G(t, 0, _(v()));
          }, 0);
        }, cutEvent: function cutEvent(a) {
          var r = this,
              o = e(r),
              s = G(r),
              l = a.originalEvent || a,
              c = t.clipboardData || l.clipboardData,
              u = Z ? A().slice(s.end, s.begin) : A().slice(s.begin, s.end);c.setData("text", Z ? u.reverse().join("") : u.join("")), n.execCommand && n.execCommand("copy"), V(r, i.keyCode.DELETE, s), N(r, A(), h().p, a, z !== A().join("")), r.inputmask._valueGet() === w().join("") && o.trigger("cleared");
        }, blurEvent: function blurEvent(t) {
          var n = e(this),
              i = this;if (i.inputmask) {
            var r = i.inputmask._valueGet(),
                o = A().slice();"" !== r && (c.clearMaskOnLostFocus && (-1 === v() && r === w().join("") ? o = [] : L(o)), !1 === U(o) && (setTimeout(function () {
              n.trigger("incomplete");
            }, 0), c.clearIncomplete && (g(), o = c.clearMaskOnLostFocus ? [] : w().slice())), N(i, o, a, t)), z !== A().join("") && (z = o.join(""), n.trigger("change"));
          }
        }, mouseenterEvent: function mouseenterEvent(e) {
          var t = this;te = !0, n.activeElement !== t && c.showMaskOnHover && t.inputmask._valueGet() !== A().join("") && N(t, A());
        }, submitEvent: function submitEvent(e) {
          z !== A().join("") && q.trigger("change"), c.clearMaskOnLostFocus && -1 === v() && Y.inputmask._valueGet && Y.inputmask._valueGet() === w().join("") && Y.inputmask._valueSet(""), c.removeMaskOnSubmit && (Y.inputmask._valueSet(Y.inputmask.unmaskedvalue(), !0), setTimeout(function () {
            N(Y, A());
          }, 0));
        }, resetEvent: function resetEvent(e) {
          Y.inputmask.refreshValue = !0, setTimeout(function () {
            q.trigger("setvalue");
          }, 0);
        } };i.prototype.positionColorMask = function (e, t) {
        e.style.left = t.offsetLeft + "px";
      };var ie;if (r !== a) switch (r.action) {case "isComplete":
          return Y = r.el, U(A());case "unmaskedvalue":
          return Y !== a && r.value === a || (ie = r.value, ie = (e.isFunction(c.onBeforeMask) ? c.onBeforeMask.call(W, ie, c) || ie : ie).split(""), F(a, !1, !1, Z ? ie.reverse() : ie), e.isFunction(c.onBeforeWrite) && c.onBeforeWrite.call(W, a, A(), 0, c)), T(Y);case "mask":
          !function (t) {
            ne.off(t);var i = function (t, i) {
              var r = t.getAttribute("type"),
                  s = "INPUT" === t.tagName && -1 !== e.inArray(r, i.supportsInputType) || t.isContentEditable || "TEXTAREA" === t.tagName;if (!s) if ("INPUT" === t.tagName) {
                var l = n.createElement("input");l.setAttribute("type", r), s = "text" === l.type, l = null;
              } else s = "partial";return !1 !== s ? function (t) {
                function r() {
                  return this.inputmask ? this.inputmask.opts.autoUnmask ? this.inputmask.unmaskedvalue() : -1 !== v() || !0 !== i.nullable ? n.activeElement === this && i.clearMaskOnLostFocus ? (Z ? L(A().slice()).reverse() : L(A().slice())).join("") : l.call(this) : "" : l.call(this);
                }function s(t) {
                  c.call(this, t), this.inputmask && e(this).trigger("setvalue");
                }var l, c;if (!t.inputmask.__valueGet) {
                  if (!0 !== i.noValuePatching) {
                    if (Object.getOwnPropertyDescriptor) {
                      "function" != typeof Object.getPrototypeOf && (Object.getPrototypeOf = "object" === o("test".__proto__) ? function (e) {
                        return e.__proto__;
                      } : function (e) {
                        return e.constructor.prototype;
                      });var u = Object.getPrototypeOf ? Object.getOwnPropertyDescriptor(Object.getPrototypeOf(t), "value") : a;u && u.get && u.set ? (l = u.get, c = u.set, Object.defineProperty(t, "value", { get: r, set: s, configurable: !0 })) : "INPUT" !== t.tagName && (l = function l() {
                        return this.textContent;
                      }, c = function c(e) {
                        this.textContent = e;
                      }, Object.defineProperty(t, "value", { get: r, set: s, configurable: !0 }));
                    } else n.__lookupGetter__ && t.__lookupGetter__("value") && (l = t.__lookupGetter__("value"), c = t.__lookupSetter__("value"), t.__defineGetter__("value", r), t.__defineSetter__("value", s));t.inputmask.__valueGet = l, t.inputmask.__valueSet = c;
                  }t.inputmask._valueGet = function (e) {
                    return Z && !0 !== e ? l.call(this.el).split("").reverse().join("") : l.call(this.el);
                  }, t.inputmask._valueSet = function (e, t) {
                    c.call(this.el, null === e || e === a ? "" : !0 !== t && Z ? e.split("").reverse().join("") : e);
                  }, l === a && (l = function l() {
                    return this.value;
                  }, c = function c(e) {
                    this.value = e;
                  }, function (t) {
                    if (e.valHooks && (e.valHooks[t] === a || !0 !== e.valHooks[t].inputmaskpatch)) {
                      var n = e.valHooks[t] && e.valHooks[t].get ? e.valHooks[t].get : function (e) {
                        return e.value;
                      },
                          r = e.valHooks[t] && e.valHooks[t].set ? e.valHooks[t].set : function (e, t) {
                        return e.value = t, e;
                      };e.valHooks[t] = { get: function get(e) {
                          if (e.inputmask) {
                            if (e.inputmask.opts.autoUnmask) return e.inputmask.unmaskedvalue();var t = n(e);return -1 !== v(a, a, e.inputmask.maskset.validPositions) || !0 !== i.nullable ? t : "";
                          }return n(e);
                        }, set: function set(t, n) {
                          var a,
                              i = e(t);return a = r(t, n), t.inputmask && i.trigger("setvalue"), a;
                        }, inputmaskpatch: !0 };
                    }
                  }(t.type), function (t) {
                    ne.on(t, "mouseenter", function (t) {
                      var n = e(this);this.inputmask._valueGet() !== A().join("") && n.trigger("setvalue");
                    });
                  }(t));
                }
              }(t) : t.inputmask = a, s;
            }(t, c);if (!1 !== i && (Y = t, q = e(Y), -1 === (Q = Y !== a ? Y.maxLength : a) && (Q = a), !0 === c.colorMask && K(Y), d && (Y.hasOwnProperty("inputmode") && (Y.inputmode = c.inputmode, Y.setAttribute("inputmode", c.inputmode)), "rtfm" === c.androidHack && (!0 !== c.colorMask && K(Y), Y.type = "password")), !0 === i && (ne.on(Y, "submit", ae.submitEvent), ne.on(Y, "reset", ae.resetEvent), ne.on(Y, "mouseenter", ae.mouseenterEvent), ne.on(Y, "blur", ae.blurEvent), ne.on(Y, "focus", ae.focusEvent), ne.on(Y, "mouseleave", ae.mouseleaveEvent), !0 !== c.colorMask && ne.on(Y, "click", ae.clickEvent), ne.on(Y, "dblclick", ae.dblclickEvent), ne.on(Y, "paste", ae.pasteEvent), ne.on(Y, "dragdrop", ae.pasteEvent), ne.on(Y, "drop", ae.pasteEvent), ne.on(Y, "cut", ae.cutEvent), ne.on(Y, "complete", c.oncomplete), ne.on(Y, "incomplete", c.onincomplete), ne.on(Y, "cleared", c.oncleared), d || !0 === c.inputEventOnly ? Y.removeAttribute("maxLength") : (ne.on(Y, "keydown", ae.keydownEvent), ne.on(Y, "keypress", ae.keypressEvent)), ne.on(Y, "compositionstart", e.noop), ne.on(Y, "compositionupdate", e.noop), ne.on(Y, "compositionend", e.noop), ne.on(Y, "keyup", e.noop), ne.on(Y, "input", ae.inputFallBackEvent), ne.on(Y, "beforeinput", e.noop)), ne.on(Y, "setvalue", ae.setValueEvent), z = w().join(""), "" !== Y.inputmask._valueGet(!0) || !1 === c.clearMaskOnLostFocus || n.activeElement === Y)) {
              var r = e.isFunction(c.onBeforeMask) ? c.onBeforeMask.call(W, Y.inputmask._valueGet(!0), c) || Y.inputmask._valueGet(!0) : Y.inputmask._valueGet(!0);"" !== r && F(Y, !0, !1, Z ? r.split("").reverse() : r.split(""));var s = A().slice();z = s.join(""), !1 === U(s) && c.clearIncomplete && g(), c.clearMaskOnLostFocus && n.activeElement !== Y && (-1 === v() ? s = [] : L(s)), N(Y, s), n.activeElement === Y && G(Y, _(v()));
            }
          }(Y);break;case "format":
          return ie = (e.isFunction(c.onBeforeMask) ? c.onBeforeMask.call(W, r.value, c) || r.value : r.value).split(""), F(a, !0, !1, Z ? ie.reverse() : ie), r.metadata ? { value: Z ? A().slice().reverse().join("") : A().join(""), metadata: l.call(this, { action: "getmetadata" }, s, c) } : Z ? A().slice().reverse().join("") : A().join("");case "isValid":
          r.value ? (ie = r.value.split(""), F(a, !0, !0, Z ? ie.reverse() : ie)) : r.value = A().join("");for (var re = A(), oe = B(), se = re.length - 1; se > oe && !M(se); se--) {}return re.splice(oe, se + 1 - oe), U(re) && r.value === A().join("");case "getemptymask":
          return w().join("");case "remove":
          if (Y && Y.inputmask) {
            q = e(Y), Y.inputmask._valueSet(c.autoUnmask ? T(Y) : Y.inputmask._valueGet(!0)), ne.off(Y);Object.getOwnPropertyDescriptor && Object.getPrototypeOf ? Object.getOwnPropertyDescriptor(Object.getPrototypeOf(Y), "value") && Y.inputmask.__valueGet && Object.defineProperty(Y, "value", { get: Y.inputmask.__valueGet, set: Y.inputmask.__valueSet, configurable: !0 }) : n.__lookupGetter__ && Y.__lookupGetter__("value") && Y.inputmask.__valueGet && (Y.__defineGetter__("value", Y.inputmask.__valueGet), Y.__defineSetter__("value", Y.inputmask.__valueSet)), Y.inputmask = a;
          }return Y;case "getmetadata":
          if (e.isArray(s.metadata)) {
            var le = m(!0, 0, !1).join("");return e.each(s.metadata, function (e, t) {
              if (t.mask === le) return le = t, !1;
            }), le;
          }return s.metadata;}
    }var c = navigator.userAgent,
        u = /mobile/i.test(c),
        p = /iemobile/i.test(c),
        f = /iphone/i.test(c) && !p,
        d = /android/i.test(c) && !p;return i.prototype = { dataAttribute: "data-inputmask", defaults: { placeholder: "_", optionalmarker: { start: "[", end: "]" }, quantifiermarker: { start: "{", end: "}" }, groupmarker: { start: "(", end: ")" }, alternatormarker: "|", escapeChar: "\\", mask: null, regex: null, oncomplete: e.noop, onincomplete: e.noop, oncleared: e.noop, repeat: 0, greedy: !0, autoUnmask: !1, removeMaskOnSubmit: !1, clearMaskOnLostFocus: !0, insertMode: !0, clearIncomplete: !1, alias: null, onKeyDown: e.noop, onBeforeMask: null, onBeforePaste: function onBeforePaste(t, n) {
          return e.isFunction(n.onBeforeMask) ? n.onBeforeMask.call(this, t, n) : t;
        }, onBeforeWrite: null, onUnMask: null, showMaskOnFocus: !0, showMaskOnHover: !0, onKeyValidation: e.noop, skipOptionalPartCharacter: " ", numericInput: !1, rightAlign: !1, undoOnEscape: !0, radixPoint: "", radixPointDefinitionSymbol: a, groupSeparator: "", keepStatic: null, positionCaretOnTab: !0, tabThrough: !1, supportsInputType: ["text", "tel", "password"], ignorables: [8, 9, 13, 19, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 93, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 0, 229], isComplete: null, canClearPosition: e.noop, preValidation: null, postValidation: null, staticDefinitionSymbol: a, jitMasking: !1, nullable: !0, inputEventOnly: !1, noValuePatching: !1, positionCaretOnClick: "lvp", casing: null, inputmode: "verbatim", colorMask: !1, androidHack: !1, importDataAttributes: !0 }, definitions: { 9: { validator: "[0-9１-９]", cardinality: 1, definitionSymbol: "*" }, a: { validator: "[A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1, definitionSymbol: "*" }, "*": { validator: "[0-9１-９A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1 } }, aliases: {}, masksCache: {}, mask: function mask(o) {
        function c(n, i, o, s) {
          if (!0 === i.importDataAttributes) {
            var l,
                c,
                u,
                p,
                f = function f(e, i) {
              null !== (i = i !== a ? i : n.getAttribute(s + "-" + e)) && ("string" == typeof i && (0 === e.indexOf("on") ? i = t[i] : "false" === i ? i = !1 : "true" === i && (i = !0)), o[e] = i);
            },
                d = n.getAttribute(s);if (d && "" !== d && (d = d.replace(new RegExp("'", "g"), '"'), c = JSON.parse("{" + d + "}")), c) {
              u = a;for (p in c) {
                if ("alias" === p.toLowerCase()) {
                  u = c[p];break;
                }
              }
            }f("alias", u), o.alias && r(o.alias, o, i);for (l in i) {
              if (c) {
                u = a;for (p in c) {
                  if (p.toLowerCase() === l.toLowerCase()) {
                    u = c[p];break;
                  }
                }
              }f(l, u);
            }
          }return e.extend(!0, i, o), ("rtl" === n.dir || i.rightAlign) && (n.style.textAlign = "right"), ("rtl" === n.dir || i.numericInput) && (n.dir = "ltr", n.removeAttribute("dir"), i.isRTL = !0), i;
        }var u = this;return "string" == typeof o && (o = n.getElementById(o) || n.querySelectorAll(o)), o = o.nodeName ? [o] : o, e.each(o, function (t, n) {
          var r = e.extend(!0, {}, u.opts);c(n, r, e.extend(!0, {}, u.userOptions), u.dataAttribute);var o = s(r, u.noMasksCache);o !== a && (n.inputmask !== a && (n.inputmask.opts.autoUnmask = !0, n.inputmask.remove()), n.inputmask = new i(a, a, !0), n.inputmask.opts = r, n.inputmask.noMasksCache = u.noMasksCache, n.inputmask.userOptions = e.extend(!0, {}, u.userOptions), n.inputmask.isRTL = r.isRTL || r.numericInput, n.inputmask.el = n, n.inputmask.maskset = o, e.data(n, "_inputmask_opts", r), l.call(n.inputmask, { action: "mask" }));
        }), o && o[0] ? o[0].inputmask || this : this;
      }, option: function option(t, n) {
        return "string" == typeof t ? this.opts[t] : "object" === (void 0 === t ? "undefined" : o(t)) ? (e.extend(this.userOptions, t), this.el && !0 !== n && this.mask(this.el), this) : void 0;
      }, unmaskedvalue: function unmaskedvalue(e) {
        return this.maskset = this.maskset || s(this.opts, this.noMasksCache), l.call(this, { action: "unmaskedvalue", value: e });
      }, remove: function remove() {
        return l.call(this, { action: "remove" });
      }, getemptymask: function getemptymask() {
        return this.maskset = this.maskset || s(this.opts, this.noMasksCache), l.call(this, { action: "getemptymask" });
      }, hasMaskedValue: function hasMaskedValue() {
        return !this.opts.autoUnmask;
      }, isComplete: function isComplete() {
        return this.maskset = this.maskset || s(this.opts, this.noMasksCache), l.call(this, { action: "isComplete" });
      }, getmetadata: function getmetadata() {
        return this.maskset = this.maskset || s(this.opts, this.noMasksCache), l.call(this, { action: "getmetadata" });
      }, isValid: function isValid(e) {
        return this.maskset = this.maskset || s(this.opts, this.noMasksCache), l.call(this, { action: "isValid", value: e });
      }, format: function format(e, t) {
        return this.maskset = this.maskset || s(this.opts, this.noMasksCache), l.call(this, { action: "format", value: e, metadata: t });
      }, analyseMask: function analyseMask(t, n, r) {
        function o(e, t, n, a) {
          this.matches = [], this.openGroup = e || !1, this.alternatorGroup = !1, this.isGroup = e || !1, this.isOptional = t || !1, this.isQuantifier = n || !1, this.isAlternator = a || !1, this.quantifier = { min: 1, max: 1 };
        }function s(t, o, s) {
          s = s !== a ? s : t.matches.length;var l = t.matches[s - 1];if (n) 0 === o.indexOf("[") || b && /\\d|\\s|\\w]/i.test(o) || "." === o ? t.matches.splice(s++, 0, { fn: new RegExp(o, r.casing ? "i" : ""), cardinality: 1, optionality: t.isOptional, newBlockMarker: l === a || l.def !== o, casing: null, def: o, placeholder: a, nativeDef: o }) : (b && (o = o[o.length - 1]), e.each(o.split(""), function (e, n) {
            l = t.matches[s - 1], t.matches.splice(s++, 0, { fn: null, cardinality: 0, optionality: t.isOptional, newBlockMarker: l === a || l.def !== n && null !== l.fn, casing: null, def: r.staticDefinitionSymbol || n, placeholder: r.staticDefinitionSymbol !== a ? n : a, nativeDef: n });
          })), b = !1;else {
            var c = (r.definitions ? r.definitions[o] : a) || i.prototype.definitions[o];if (c && !b) {
              for (var u = c.prevalidator, p = u ? u.length : 0, f = 1; f < c.cardinality; f++) {
                var d = p >= f ? u[f - 1] : [],
                    m = d.validator,
                    h = d.cardinality;t.matches.splice(s++, 0, { fn: m ? "string" == typeof m ? new RegExp(m, r.casing ? "i" : "") : new function () {
                    this.test = m;
                  }() : new RegExp("."), cardinality: h || 1, optionality: t.isOptional, newBlockMarker: l === a || l.def !== (c.definitionSymbol || o), casing: c.casing, def: c.definitionSymbol || o, placeholder: c.placeholder, nativeDef: o }), l = t.matches[s - 1];
              }t.matches.splice(s++, 0, { fn: c.validator ? "string" == typeof c.validator ? new RegExp(c.validator, r.casing ? "i" : "") : new function () {
                  this.test = c.validator;
                }() : new RegExp("."), cardinality: c.cardinality, optionality: t.isOptional, newBlockMarker: l === a || l.def !== (c.definitionSymbol || o), casing: c.casing, def: c.definitionSymbol || o, placeholder: c.placeholder, nativeDef: o });
            } else t.matches.splice(s++, 0, { fn: null, cardinality: 0, optionality: t.isOptional, newBlockMarker: l === a || l.def !== o && null !== l.fn, casing: null, def: r.staticDefinitionSymbol || o, placeholder: r.staticDefinitionSymbol !== a ? o : a, nativeDef: o }), b = !1;
          }
        }function l(t) {
          t && t.matches && e.each(t.matches, function (e, i) {
            var o = t.matches[e + 1];(o === a || o.matches === a || !1 === o.isQuantifier) && i && i.isGroup && (i.isGroup = !1, n || (s(i, r.groupmarker.start, 0), !0 !== i.openGroup && s(i, r.groupmarker.end))), l(i);
          });
        }function c() {
          if (P.length > 0) {
            if (m = P[P.length - 1], s(m, f), m.isAlternator) {
              h = P.pop();for (var e = 0; e < h.matches.length; e++) {
                h.matches[e].isGroup = !1;
              }P.length > 0 ? (m = P[P.length - 1]).matches.push(h) : x.matches.push(h);
            }
          } else s(x, f);
        }function u(e) {
          e.matches = e.matches.reverse();for (var t in e.matches) {
            if (e.matches.hasOwnProperty(t)) {
              var n = parseInt(t);if (e.matches[t].isQuantifier && e.matches[n + 1] && e.matches[n + 1].isGroup) {
                var i = e.matches[t];e.matches.splice(t, 1), e.matches.splice(n + 1, 0, i);
              }e.matches[t].matches !== a ? e.matches[t] = u(e.matches[t]) : e.matches[t] = function (e) {
                return e === r.optionalmarker.start ? e = r.optionalmarker.end : e === r.optionalmarker.end ? e = r.optionalmarker.start : e === r.groupmarker.start ? e = r.groupmarker.end : e === r.groupmarker.end && (e = r.groupmarker.start), e;
              }(e.matches[t]);
            }
          }return e;
        }var p,
            f,
            d,
            m,
            h,
            g,
            v,
            y = /(?:[?*+]|\{[0-9\+\*]+(?:,[0-9\+\*]*)?\})|[^.?*+^${[]()|\\]+|./g,
            k = /\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,
            b = !1,
            x = new o(),
            P = [],
            S = [];for (n && (r.optionalmarker.start = a, r.optionalmarker.end = a); p = n ? k.exec(t) : y.exec(t);) {
          if (f = p[0], n) switch (f.charAt(0)) {case "?":
              f = "{0,1}";break;case "+":case "*":
              f = "{" + f + "}";}if (b) c();else switch (f.charAt(0)) {case r.escapeChar:
              b = !0, n && c();break;case r.optionalmarker.end:case r.groupmarker.end:
              if (d = P.pop(), d.openGroup = !1, d !== a) {
                if (P.length > 0) {
                  if ((m = P[P.length - 1]).matches.push(d), m.isAlternator) {
                    h = P.pop();for (var w = 0; w < h.matches.length; w++) {
                      h.matches[w].isGroup = !1, h.matches[w].alternatorGroup = !1;
                    }P.length > 0 ? (m = P[P.length - 1]).matches.push(h) : x.matches.push(h);
                  }
                } else x.matches.push(d);
              } else c();break;case r.optionalmarker.start:
              P.push(new o(!1, !0));break;case r.groupmarker.start:
              P.push(new o(!0));break;case r.quantifiermarker.start:
              var A = new o(!1, !1, !0),
                  E = (f = f.replace(/[{}]/g, "")).split(","),
                  C = isNaN(E[0]) ? E[0] : parseInt(E[0]),
                  O = 1 === E.length ? C : isNaN(E[1]) ? E[1] : parseInt(E[1]);if ("*" !== O && "+" !== O || (C = "*" === O ? 0 : 1), A.quantifier = { min: C, max: O }, P.length > 0) {
                var R = P[P.length - 1].matches;(p = R.pop()).isGroup || ((v = new o(!0)).matches.push(p), p = v), R.push(p), R.push(A);
              } else (p = x.matches.pop()).isGroup || (n && null === p.fn && "." === p.def && (p.fn = new RegExp(p.def, r.casing ? "i" : "")), (v = new o(!0)).matches.push(p), p = v), x.matches.push(p), x.matches.push(A);break;case r.alternatormarker:
              if (P.length > 0) {
                var M = (m = P[P.length - 1]).matches[m.matches.length - 1];g = m.openGroup && (M.matches === a || !1 === M.isGroup && !1 === M.isAlternator) ? P.pop() : m.matches.pop();
              } else g = x.matches.pop();if (g.isAlternator) P.push(g);else if (g.alternatorGroup ? (h = P.pop(), g.alternatorGroup = !1) : h = new o(!1, !1, !1, !0), h.matches.push(g), P.push(h), g.openGroup) {
                g.openGroup = !1;var _ = new o(!0);_.alternatorGroup = !0, P.push(_);
              }break;default:
              c();}
        }for (; P.length > 0;) {
          d = P.pop(), x.matches.push(d);
        }return x.matches.length > 0 && (l(x), S.push(x)), (r.numericInput || r.isRTL) && u(S[0]), S;
      } }, i.extendDefaults = function (t) {
      e.extend(!0, i.prototype.defaults, t);
    }, i.extendDefinitions = function (t) {
      e.extend(!0, i.prototype.definitions, t);
    }, i.extendAliases = function (t) {
      e.extend(!0, i.prototype.aliases, t);
    }, i.format = function (e, t, n) {
      return i(t).format(e, n);
    }, i.unmask = function (e, t) {
      return i(t).unmaskedvalue(e);
    }, i.isValid = function (e, t) {
      return i(t).isValid(e);
    }, i.remove = function (t) {
      e.each(t, function (e, t) {
        t.inputmask && t.inputmask.remove();
      });
    }, i.escapeRegex = function (e) {
      var t = ["/", ".", "*", "+", "?", "|", "(", ")", "[", "]", "{", "}", "\\", "$", "^"];return e.replace(new RegExp("(\\" + t.join("|\\") + ")", "gim"), "\\$1");
    }, i.keyCode = { ALT: 18, BACKSPACE: 8, BACKSPACE_SAFARI: 127, CAPS_LOCK: 20, COMMA: 188, COMMAND: 91, COMMAND_LEFT: 91, COMMAND_RIGHT: 93, CONTROL: 17, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, INSERT: 45, LEFT: 37, MENU: 93, NUMPAD_ADD: 107, NUMPAD_DECIMAL: 110, NUMPAD_DIVIDE: 111, NUMPAD_ENTER: 108, NUMPAD_MULTIPLY: 106, NUMPAD_SUBTRACT: 109, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SHIFT: 16, SPACE: 32, TAB: 9, UP: 38, WINDOWS: 91, X: 88 }, i;
  });
}, function (e, t) {
  e.exports = jQuery;
}, function (e, t, n) {
  "use strict";
  function a(e) {
    return e && e.__esModule ? e : { default: e };
  }n(4), n(9), n(12), n(13), n(14), n(15);var i = a(n(1)),
      r = a(n(0)),
      o = a(n(2));r.default === o.default && n(16), window.Inputmask = i.default;
}, function (e, t, n) {
  var a = n(5);"string" == typeof a && (a = [[e.i, a, ""]]);var i = { hmr: !0 };i.transform = void 0;n(7)(a, i);a.locals && (e.exports = a.locals);
}, function (e, t, n) {
  (e.exports = n(6)(void 0)).push([e.i, "span.im-caret {\r\n    -webkit-animation: 1s blink step-end infinite;\r\n    animation: 1s blink step-end infinite;\r\n}\r\n\r\n@keyframes blink {\r\n    from, to {\r\n        border-right-color: black;\r\n    }\r\n    50% {\r\n        border-right-color: transparent;\r\n    }\r\n}\r\n\r\n@-webkit-keyframes blink {\r\n    from, to {\r\n        border-right-color: black;\r\n    }\r\n    50% {\r\n        border-right-color: transparent;\r\n    }\r\n}\r\n\r\nspan.im-static {\r\n    color: grey;\r\n}\r\n\r\ndiv.im-colormask {\r\n    display: inline-block;\r\n    border-style: inset;\r\n    border-width: 2px;\r\n    -webkit-appearance: textfield;\r\n    -moz-appearance: textfield;\r\n    appearance: textfield;\r\n}\r\n\r\ndiv.im-colormask > input {\r\n    position: absolute;\r\n    display: inline-block;\r\n    background-color: transparent;\r\n    color: transparent;\r\n    -webkit-appearance: caret;\r\n    -moz-appearance: caret;\r\n    appearance: caret;\r\n    border-style: none;\r\n    left: 0; /*calculated*/\r\n}\r\n\r\ndiv.im-colormask > input:focus {\r\n    outline: none;\r\n}\r\n\r\ndiv.im-colormask > input::-moz-selection{\r\n    background: none;\r\n}\r\n\r\ndiv.im-colormask > input::selection{\r\n    background: none;\r\n}\r\ndiv.im-colormask > input::-moz-selection{\r\n    background: none;\r\n}\r\n\r\ndiv.im-colormask > div {\r\n    color: black;\r\n    display: inline-block;\r\n    width: 100px; /*calculated*/\r\n}", ""]);
}, function (e, t) {
  function n(e, t) {
    var n = e[1] || "",
        i = e[3];if (!i) return n;if (t && "function" == typeof btoa) {
      var r = a(i),
          o = i.sources.map(function (e) {
        return "/*# sourceURL=" + i.sourceRoot + e + " */";
      });return [n].concat(o).concat([r]).join("\n");
    }return [n].join("\n");
  }function a(e) {
    return "/*# " + ("sourceMappingURL=data:application/json;charset=utf-8;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(e))))) + " */";
  }e.exports = function (e) {
    var t = [];return t.toString = function () {
      return this.map(function (t) {
        var a = n(t, e);return t[2] ? "@media " + t[2] + "{" + a + "}" : a;
      }).join("");
    }, t.i = function (e, n) {
      "string" == typeof e && (e = [[null, e, ""]]);for (var a = {}, i = 0; i < this.length; i++) {
        var r = this[i][0];"number" == typeof r && (a[r] = !0);
      }for (i = 0; i < e.length; i++) {
        var o = e[i];"number" == typeof o[0] && a[o[0]] || (n && !o[2] ? o[2] = n : n && (o[2] = "(" + o[2] + ") and (" + n + ")"), t.push(o));
      }
    }, t;
  };
}, function (e, t, n) {
  function a(e, t) {
    for (var n = 0; n < e.length; n++) {
      var a = e[n],
          i = m[a.id];if (i) {
        i.refs++;for (o = 0; o < i.parts.length; o++) {
          i.parts[o](a.parts[o]);
        }for (; o < a.parts.length; o++) {
          i.parts.push(u(a.parts[o], t));
        }
      } else {
        for (var r = [], o = 0; o < a.parts.length; o++) {
          r.push(u(a.parts[o], t));
        }m[a.id] = { id: a.id, refs: 1, parts: r };
      }
    }
  }function i(e, t) {
    for (var n = [], a = {}, i = 0; i < e.length; i++) {
      var r = e[i],
          o = t.base ? r[0] + t.base : r[0],
          s = { css: r[1], media: r[2], sourceMap: r[3] };a[o] ? a[o].parts.push(s) : n.push(a[o] = { id: o, parts: [s] });
    }return n;
  }function r(e, t) {
    var n = g(e.insertInto);if (!n) throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");var a = k[k.length - 1];if ("top" === e.insertAt) a ? a.nextSibling ? n.insertBefore(t, a.nextSibling) : n.appendChild(t) : n.insertBefore(t, n.firstChild), k.push(t);else if ("bottom" === e.insertAt) n.appendChild(t);else {
      if ("object" != _typeof2(e.insertAt) || !e.insertAt.before) throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");var i = g(e.insertInto + " " + e.insertAt.before);n.insertBefore(t, i);
    }
  }function o(e) {
    if (null === e.parentNode) return !1;e.parentNode.removeChild(e);var t = k.indexOf(e);t >= 0 && k.splice(t, 1);
  }function s(e) {
    var t = document.createElement("style");return e.attrs.type = "text/css", c(t, e.attrs), r(e, t), t;
  }function l(e) {
    var t = document.createElement("link");return e.attrs.type = "text/css", e.attrs.rel = "stylesheet", c(t, e.attrs), r(e, t), t;
  }function c(e, t) {
    Object.keys(t).forEach(function (n) {
      e.setAttribute(n, t[n]);
    });
  }function u(e, t) {
    var n, a, i, r;if (t.transform && e.css) {
      if (!(r = t.transform(e.css))) return function () {};e.css = r;
    }if (t.singleton) {
      var c = y++;n = v || (v = s(t)), a = p.bind(null, n, c, !1), i = p.bind(null, n, c, !0);
    } else e.sourceMap && "function" == typeof URL && "function" == typeof URL.createObjectURL && "function" == typeof URL.revokeObjectURL && "function" == typeof Blob && "function" == typeof btoa ? (n = l(t), a = d.bind(null, n, t), i = function i() {
      o(n), n.href && URL.revokeObjectURL(n.href);
    }) : (n = s(t), a = f.bind(null, n), i = function i() {
      o(n);
    });return a(e), function (t) {
      if (t) {
        if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;a(e = t);
      } else i();
    };
  }function p(e, t, n, a) {
    var i = n ? "" : a.css;if (e.styleSheet) e.styleSheet.cssText = x(t, i);else {
      var r = document.createTextNode(i),
          o = e.childNodes;o[t] && e.removeChild(o[t]), o.length ? e.insertBefore(r, o[t]) : e.appendChild(r);
    }
  }function f(e, t) {
    var n = t.css,
        a = t.media;if (a && e.setAttribute("media", a), e.styleSheet) e.styleSheet.cssText = n;else {
      for (; e.firstChild;) {
        e.removeChild(e.firstChild);
      }e.appendChild(document.createTextNode(n));
    }
  }function d(e, t, n) {
    var a = n.css,
        i = n.sourceMap,
        r = void 0 === t.convertToAbsoluteUrls && i;(t.convertToAbsoluteUrls || r) && (a = b(a)), i && (a += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(i)))) + " */");var o = new Blob([a], { type: "text/css" }),
        s = e.href;e.href = URL.createObjectURL(o), s && URL.revokeObjectURL(s);
  }var m = {},
      h = function (e) {
    var t;return function () {
      return void 0 === t && (t = e.apply(this, arguments)), t;
    };
  }(function () {
    return window && document && document.all && !window.atob;
  }),
      g = function (e) {
    var t = {};return function (n) {
      if (void 0 === t[n]) {
        var a = e.call(this, n);if (a instanceof window.HTMLIFrameElement) try {
          a = a.contentDocument.head;
        } catch (e) {
          a = null;
        }t[n] = a;
      }return t[n];
    };
  }(function (e) {
    return document.querySelector(e);
  }),
      v = null,
      y = 0,
      k = [],
      b = n(8);e.exports = function (e, t) {
    if ("undefined" != typeof DEBUG && DEBUG && "object" != (typeof document === 'undefined' ? 'undefined' : _typeof2(document))) throw new Error("The style-loader cannot be used in a non-browser environment");(t = t || {}).attrs = "object" == _typeof2(t.attrs) ? t.attrs : {}, t.singleton || (t.singleton = h()), t.insertInto || (t.insertInto = "head"), t.insertAt || (t.insertAt = "bottom");var n = i(e, t);return a(n, t), function (e) {
      for (var r = [], o = 0; o < n.length; o++) {
        var s = n[o];(l = m[s.id]).refs--, r.push(l);
      }e && a(i(e, t), t);for (o = 0; o < r.length; o++) {
        var l = r[o];if (0 === l.refs) {
          for (var c = 0; c < l.parts.length; c++) {
            l.parts[c]();
          }delete m[l.id];
        }
      }
    };
  };var x = function () {
    var e = [];return function (t, n) {
      return e[t] = n, e.filter(Boolean).join("\n");
    };
  }();
}, function (e, t) {
  e.exports = function (e) {
    var t = "undefined" != typeof window && window.location;if (!t) throw new Error("fixUrls requires window.location");if (!e || "string" != typeof e) return e;var n = t.protocol + "//" + t.host,
        a = n + t.pathname.replace(/\/[^\/]*$/, "/");return e.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function (e, t) {
      var i = t.trim().replace(/^"(.*)"$/, function (e, t) {
        return t;
      }).replace(/^'(.*)'$/, function (e, t) {
        return t;
      });if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/)/i.test(i)) return e;var r;return r = 0 === i.indexOf("//") ? i : 0 === i.indexOf("/") ? n + i : a + i.replace(/^\.\//, ""), "url(" + JSON.stringify(r) + ")";
    });
  };
}, function (e, t, n) {
  "use strict";
  var a, i, r;"function" == typeof Symbol && Symbol.iterator;!function (o) {
    i = [n(0), n(1)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e, t) {
    function n(e) {
      return isNaN(e) || 29 === new Date(e, 2, 0).getDate();
    }return t.extendAliases({ "dd/mm/yyyy": { mask: "1/2/y", placeholder: "dd/mm/yyyy", regex: { val1pre: new RegExp("[0-3]"), val1: new RegExp("0[1-9]|[12][0-9]|3[01]"), val2pre: function val2pre(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[1-9]|[12][0-9]|3[01])" + n + "[01])");
          }, val2: function val2(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[1-9]|[12][0-9])" + n + "(0[1-9]|1[012]))|(30" + n + "(0[13-9]|1[012]))|(31" + n + "(0[13578]|1[02]))");
          } }, leapday: "29/02/", separator: "/", yearrange: { minyear: 1900, maxyear: 2099 }, isInYearRange: function isInYearRange(e, t, n) {
          if (isNaN(e)) return !1;var a = parseInt(e.concat(t.toString().slice(e.length))),
              i = parseInt(e.concat(n.toString().slice(e.length)));return !isNaN(a) && t <= a && a <= n || !isNaN(i) && t <= i && i <= n;
        }, determinebaseyear: function determinebaseyear(e, t, n) {
          var a = new Date().getFullYear();if (e > a) return e;if (t < a) {
            for (var i = t.toString().slice(0, 2), r = t.toString().slice(2, 4); t < i + n;) {
              i--;
            }var o = i + r;return e > o ? e : o;
          }if (e <= a && a <= t) {
            for (var s = a.toString().slice(0, 2); t < s + n;) {
              s--;
            }var l = s + n;return l < e ? e : l;
          }return a;
        }, onKeyDown: function onKeyDown(n, a, i, r) {
          var o = e(this);if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
            var s = new Date();o.val(s.getDate().toString() + (s.getMonth() + 1).toString() + s.getFullYear().toString()), o.trigger("setvalue");
          }
        }, getFrontValue: function getFrontValue(e, t, n) {
          for (var a = 0, i = 0, r = 0; r < e.length && "2" !== e.charAt(r); r++) {
            var o = n.definitions[e.charAt(r)];o ? (a += i, i = o.cardinality) : i++;
          }return t.join("").substr(a, i);
        }, postValidation: function postValidation(e, t, a) {
          var i,
              r,
              o = e.join("");return 0 === a.mask.indexOf("y") ? (r = o.substr(0, 4), i = o.substring(4, 10)) : (r = o.substring(6, 10), i = o.substr(0, 6)), t && (i !== a.leapday || n(r));
        }, definitions: { 1: { validator: function validator(e, t, n, a, i) {
              var r = i.regex.val1.test(e);return a || r || e.charAt(1) !== i.separator && -1 === "-./".indexOf(e.charAt(1)) || !(r = i.regex.val1.test("0" + e.charAt(0))) ? r : (t.buffer[n - 1] = "0", { refreshFromBuffer: { start: n - 1, end: n }, pos: n, c: e.charAt(0) });
            }, cardinality: 2, prevalidator: [{ validator: function validator(e, t, n, a, i) {
                var r = e;isNaN(t.buffer[n + 1]) || (r += t.buffer[n + 1]);var o = 1 === r.length ? i.regex.val1pre.test(r) : i.regex.val1.test(r);if (o && t.validPositions[n] && (i.regex.val2(i.separator).test(e + t.validPositions[n].input) || (t.validPositions[n].input = "0" === e ? "1" : "0")), !a && !o) {
                  if (o = i.regex.val1.test(e + "0")) return t.buffer[n] = e, t.buffer[++n] = "0", { pos: n, c: "0" };if (o = i.regex.val1.test("0" + e)) return t.buffer[n] = "0", n++, { pos: n };
                }return o;
              }, cardinality: 1 }] }, 2: { validator: function validator(e, t, n, a, i) {
              var r = i.getFrontValue(t.mask, t.buffer, i);-1 !== r.indexOf(i.placeholder[0]) && (r = "01" + i.separator);var o = i.regex.val2(i.separator).test(r + e);return a || o || e.charAt(1) !== i.separator && -1 === "-./".indexOf(e.charAt(1)) || !(o = i.regex.val2(i.separator).test(r + "0" + e.charAt(0))) ? o : (t.buffer[n - 1] = "0", { refreshFromBuffer: { start: n - 1, end: n }, pos: n, c: e.charAt(0) });
            }, cardinality: 2, prevalidator: [{ validator: function validator(e, t, n, a, i) {
                isNaN(t.buffer[n + 1]) || (e += t.buffer[n + 1]);var r = i.getFrontValue(t.mask, t.buffer, i);-1 !== r.indexOf(i.placeholder[0]) && (r = "01" + i.separator);var o = 1 === e.length ? i.regex.val2pre(i.separator).test(r + e) : i.regex.val2(i.separator).test(r + e);return o && t.validPositions[n] && (i.regex.val2(i.separator).test(e + t.validPositions[n].input) || (t.validPositions[n].input = "0" === e ? "1" : "0")), a || o || !(o = i.regex.val2(i.separator).test(r + "0" + e)) ? o : (t.buffer[n] = "0", n++, { pos: n });
              }, cardinality: 1 }] }, y: { validator: function validator(e, t, n, a, i) {
              return i.isInYearRange(e, i.yearrange.minyear, i.yearrange.maxyear);
            }, cardinality: 4, prevalidator: [{ validator: function validator(e, t, n, a, i) {
                var r = i.isInYearRange(e, i.yearrange.minyear, i.yearrange.maxyear);if (!a && !r) {
                  var o = i.determinebaseyear(i.yearrange.minyear, i.yearrange.maxyear, e + "0").toString().slice(0, 1);if (r = i.isInYearRange(o + e, i.yearrange.minyear, i.yearrange.maxyear)) return t.buffer[n++] = o.charAt(0), { pos: n };if (o = i.determinebaseyear(i.yearrange.minyear, i.yearrange.maxyear, e + "0").toString().slice(0, 2), r = i.isInYearRange(o + e, i.yearrange.minyear, i.yearrange.maxyear)) return t.buffer[n++] = o.charAt(0), t.buffer[n++] = o.charAt(1), { pos: n };
                }return r;
              }, cardinality: 1 }, { validator: function validator(e, t, n, a, i) {
                var r = i.isInYearRange(e, i.yearrange.minyear, i.yearrange.maxyear);if (!a && !r) {
                  var o = i.determinebaseyear(i.yearrange.minyear, i.yearrange.maxyear, e).toString().slice(0, 2);if (r = i.isInYearRange(e[0] + o[1] + e[1], i.yearrange.minyear, i.yearrange.maxyear)) return t.buffer[n++] = o.charAt(1), { pos: n };if (o = i.determinebaseyear(i.yearrange.minyear, i.yearrange.maxyear, e).toString().slice(0, 2), r = i.isInYearRange(o + e, i.yearrange.minyear, i.yearrange.maxyear)) return t.buffer[n - 1] = o.charAt(0), t.buffer[n++] = o.charAt(1), t.buffer[n++] = e.charAt(0), { refreshFromBuffer: { start: n - 3, end: n }, pos: n };
                }return r;
              }, cardinality: 2 }, { validator: function validator(e, t, n, a, i) {
                return i.isInYearRange(e, i.yearrange.minyear, i.yearrange.maxyear);
              }, cardinality: 3 }] } }, insertMode: !1, autoUnmask: !1 }, "mm/dd/yyyy": { placeholder: "mm/dd/yyyy", alias: "dd/mm/yyyy", regex: { val2pre: function val2pre(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[13-9]|1[012])" + n + "[0-3])|(02" + n + "[0-2])");
          }, val2: function val2(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[1-9]|1[012])" + n + "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" + n + "30)|((0[13578]|1[02])" + n + "31)");
          }, val1pre: new RegExp("[01]"), val1: new RegExp("0[1-9]|1[012]") }, leapday: "02/29/", onKeyDown: function onKeyDown(n, a, i, r) {
          var o = e(this);if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
            var s = new Date();o.val((s.getMonth() + 1).toString() + s.getDate().toString() + s.getFullYear().toString()), o.trigger("setvalue");
          }
        } }, "yyyy/mm/dd": { mask: "y/1/2", placeholder: "yyyy/mm/dd", alias: "mm/dd/yyyy", leapday: "/02/29", onKeyDown: function onKeyDown(n, a, i, r) {
          var o = e(this);if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
            var s = new Date();o.val(s.getFullYear().toString() + (s.getMonth() + 1).toString() + s.getDate().toString()), o.trigger("setvalue");
          }
        } }, "dd.mm.yyyy": { mask: "1.2.y", placeholder: "dd.mm.yyyy", leapday: "29.02.", separator: ".", alias: "dd/mm/yyyy" }, "dd-mm-yyyy": { mask: "1-2-y", placeholder: "dd-mm-yyyy", leapday: "29-02-", separator: "-", alias: "dd/mm/yyyy" }, "mm.dd.yyyy": { mask: "1.2.y", placeholder: "mm.dd.yyyy", leapday: "02.29.", separator: ".", alias: "mm/dd/yyyy" }, "mm-dd-yyyy": { mask: "1-2-y", placeholder: "mm-dd-yyyy", leapday: "02-29-", separator: "-", alias: "mm/dd/yyyy" }, "yyyy.mm.dd": { mask: "y.1.2", placeholder: "yyyy.mm.dd", leapday: ".02.29", separator: ".", alias: "yyyy/mm/dd" }, "yyyy-mm-dd": { mask: "y-1-2", placeholder: "yyyy-mm-dd", leapday: "-02-29", separator: "-", alias: "yyyy/mm/dd" }, datetime: { mask: "1/2/y h:s", placeholder: "dd/mm/yyyy hh:mm", alias: "dd/mm/yyyy", regex: { hrspre: new RegExp("[012]"), hrs24: new RegExp("2[0-4]|1[3-9]"), hrs: new RegExp("[01][0-9]|2[0-4]"), ampm: new RegExp("^[a|p|A|P][m|M]"), mspre: new RegExp("[0-5]"), ms: new RegExp("[0-5][0-9]") }, timeseparator: ":", hourFormat: "24", definitions: { h: { validator: function validator(e, t, n, a, i) {
              if ("24" === i.hourFormat && 24 === parseInt(e, 10)) return t.buffer[n - 1] = "0", t.buffer[n] = "0", { refreshFromBuffer: { start: n - 1, end: n }, c: "0" };var r = i.regex.hrs.test(e);if (!a && !r && (e.charAt(1) === i.timeseparator || -1 !== "-.:".indexOf(e.charAt(1))) && (r = i.regex.hrs.test("0" + e.charAt(0)))) return t.buffer[n - 1] = "0", t.buffer[n] = e.charAt(0), n++, { refreshFromBuffer: { start: n - 2, end: n }, pos: n, c: i.timeseparator };if (r && "24" !== i.hourFormat && i.regex.hrs24.test(e)) {
                var o = parseInt(e, 10);return 24 === o ? (t.buffer[n + 5] = "a", t.buffer[n + 6] = "m") : (t.buffer[n + 5] = "p", t.buffer[n + 6] = "m"), (o -= 12) < 10 ? (t.buffer[n] = o.toString(), t.buffer[n - 1] = "0") : (t.buffer[n] = o.toString().charAt(1), t.buffer[n - 1] = o.toString().charAt(0)), { refreshFromBuffer: { start: n - 1, end: n + 6 }, c: t.buffer[n] };
              }return r;
            }, cardinality: 2, prevalidator: [{ validator: function validator(e, t, n, a, i) {
                var r = i.regex.hrspre.test(e);return a || r || !(r = i.regex.hrs.test("0" + e)) ? r : (t.buffer[n] = "0", n++, { pos: n });
              }, cardinality: 1 }] }, s: { validator: "[0-5][0-9]", cardinality: 2, prevalidator: [{ validator: function validator(e, t, n, a, i) {
                var r = i.regex.mspre.test(e);return a || r || !(r = i.regex.ms.test("0" + e)) ? r : (t.buffer[n] = "0", n++, { pos: n });
              }, cardinality: 1 }] }, t: { validator: function validator(e, t, n, a, i) {
              return i.regex.ampm.test(e + "m");
            }, casing: "lower", cardinality: 1 } }, insertMode: !1, autoUnmask: !1 }, datetime12: { mask: "1/2/y h:s t\\m", placeholder: "dd/mm/yyyy hh:mm xm", alias: "datetime", hourFormat: "12" }, "mm/dd/yyyy hh:mm xm": { mask: "1/2/y h:s t\\m", placeholder: "mm/dd/yyyy hh:mm xm", alias: "datetime12", regex: { val2pre: function val2pre(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[13-9]|1[012])" + n + "[0-3])|(02" + n + "[0-2])");
          }, val2: function val2(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[1-9]|1[012])" + n + "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" + n + "30)|((0[13578]|1[02])" + n + "31)");
          }, val1pre: new RegExp("[01]"), val1: new RegExp("0[1-9]|1[012]") }, leapday: "02/29/", onKeyDown: function onKeyDown(n, a, i, r) {
          var o = e(this);if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
            var s = new Date();o.val((s.getMonth() + 1).toString() + s.getDate().toString() + s.getFullYear().toString()), o.trigger("setvalue");
          }
        } }, "hh:mm t": { mask: "h:s t\\m", placeholder: "hh:mm xm", alias: "datetime", hourFormat: "12" }, "h:s t": { mask: "h:s t\\m", placeholder: "hh:mm xm", alias: "datetime", hourFormat: "12" }, "hh:mm:ss": { mask: "h:s:s", placeholder: "hh:mm:ss", alias: "datetime", autoUnmask: !1 }, "hh:mm": { mask: "h:s", placeholder: "hh:mm", alias: "datetime", autoUnmask: !1 }, date: { alias: "dd/mm/yyyy" }, "mm/yyyy": { mask: "1/y", placeholder: "mm/yyyy", leapday: "donotuse", separator: "/", alias: "mm/dd/yyyy" }, shamsi: { regex: { val2pre: function val2pre(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[1-9]|1[012])" + n + "[0-3])");
          }, val2: function val2(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[1-9]|1[012])" + n + "(0[1-9]|[12][0-9]))|((0[1-9]|1[012])" + n + "30)|((0[1-6])" + n + "31)");
          }, val1pre: new RegExp("[01]"), val1: new RegExp("0[1-9]|1[012]") }, yearrange: { minyear: 1300, maxyear: 1499 }, mask: "y/1/2", leapday: "/12/30", placeholder: "yyyy/mm/dd", alias: "mm/dd/yyyy", clearIncomplete: !0 }, "yyyy-mm-dd hh:mm:ss": { mask: "y-1-2 h:s:s", placeholder: "yyyy-mm-dd hh:mm:ss", alias: "datetime", separator: "-", leapday: "-02-29", regex: { val2pre: function val2pre(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[13-9]|1[012])" + n + "[0-3])|(02" + n + "[0-2])");
          }, val2: function val2(e) {
            var n = t.escapeRegex.call(this, e);return new RegExp("((0[1-9]|1[012])" + n + "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" + n + "30)|((0[13578]|1[02])" + n + "31)");
          }, val1pre: new RegExp("[01]"), val1: new RegExp("0[1-9]|1[012]") }, onKeyDown: function onKeyDown(e, t, n, a) {} } }), t;
  });
}, function (e, t, n) {
  "use strict";
  var a;"function" == typeof Symbol && Symbol.iterator;void 0 !== (a = function () {
    return window;
  }.call(t, n, t, e)) && (e.exports = a);
}, function (e, t, n) {
  "use strict";
  var a;"function" == typeof Symbol && Symbol.iterator;void 0 !== (a = function () {
    return document;
  }.call(t, n, t, e)) && (e.exports = a);
}, function (e, t, n) {
  "use strict";
  var a, i, r;"function" == typeof Symbol && Symbol.iterator;!function (o) {
    i = [n(0), n(1)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e, t) {
    return t.extendDefinitions({ A: { validator: "[A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1, casing: "upper" }, "&": { validator: "[0-9A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1, casing: "upper" }, "#": { validator: "[0-9A-Fa-f]", cardinality: 1, casing: "upper" } }), t.extendAliases({ url: { definitions: { i: { validator: ".", cardinality: 1 } }, mask: "(\\http://)|(\\http\\s://)|(ftp://)|(ftp\\s://)i{+}", insertMode: !1, autoUnmask: !1, inputmode: "url" }, ip: { mask: "i[i[i]].i[i[i]].i[i[i]].i[i[i]]", definitions: { i: { validator: function validator(e, t, n, a, i) {
              return n - 1 > -1 && "." !== t.buffer[n - 1] ? (e = t.buffer[n - 1] + e, e = n - 2 > -1 && "." !== t.buffer[n - 2] ? t.buffer[n - 2] + e : "0" + e) : e = "00" + e, new RegExp("25[0-5]|2[0-4][0-9]|[01][0-9][0-9]").test(e);
            }, cardinality: 1 } }, onUnMask: function onUnMask(e, t, n) {
          return e;
        }, inputmode: "numeric" }, email: { mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]@-{1,63}.-{1,63}[.-{1,63}][.-{1,63}]", greedy: !1, onBeforePaste: function onBeforePaste(e, t) {
          return (e = e.toLowerCase()).replace("mailto:", "");
        }, definitions: { "*": { validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]", cardinality: 1, casing: "lower" }, "-": { validator: "[0-9A-Za-z-]", cardinality: 1, casing: "lower" } }, onUnMask: function onUnMask(e, t, n) {
          return e;
        }, inputmode: "email" }, mac: { mask: "##:##:##:##:##:##" }, vin: { mask: "V{13}9{4}", definitions: { V: { validator: "[A-HJ-NPR-Za-hj-npr-z\\d]", cardinality: 1, casing: "upper" } }, clearIncomplete: !0, autoUnmask: !0 } }), t;
  });
}, function (e, t, n) {
  "use strict";
  var a, i, r;"function" == typeof Symbol && Symbol.iterator;!function (o) {
    i = [n(0), n(1)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e, t, n) {
    function a(e, n) {
      for (var a = "", i = 0; i < e.length; i++) {
        t.prototype.definitions[e.charAt(i)] || n.definitions[e.charAt(i)] || n.optionalmarker.start === e.charAt(i) || n.optionalmarker.end === e.charAt(i) || n.quantifiermarker.start === e.charAt(i) || n.quantifiermarker.end === e.charAt(i) || n.groupmarker.start === e.charAt(i) || n.groupmarker.end === e.charAt(i) || n.alternatormarker === e.charAt(i) ? a += "\\" + e.charAt(i) : a += e.charAt(i);
      }return a;
    }return t.extendAliases({ numeric: { mask: function mask(e) {
          if (0 !== e.repeat && isNaN(e.integerDigits) && (e.integerDigits = e.repeat), e.repeat = 0, e.groupSeparator === e.radixPoint && ("." === e.radixPoint ? e.groupSeparator = "," : "," === e.radixPoint ? e.groupSeparator = "." : e.groupSeparator = ""), " " === e.groupSeparator && (e.skipOptionalPartCharacter = n), e.autoGroup = e.autoGroup && "" !== e.groupSeparator, e.autoGroup && ("string" == typeof e.groupSize && isFinite(e.groupSize) && (e.groupSize = parseInt(e.groupSize)), isFinite(e.integerDigits))) {
            var t = Math.floor(e.integerDigits / e.groupSize),
                i = e.integerDigits % e.groupSize;e.integerDigits = parseInt(e.integerDigits) + (0 === i ? t - 1 : t), e.integerDigits < 1 && (e.integerDigits = "*");
          }e.placeholder.length > 1 && (e.placeholder = e.placeholder.charAt(0)), "radixFocus" === e.positionCaretOnClick && "" === e.placeholder && !1 === e.integerOptional && (e.positionCaretOnClick = "lvp"), e.definitions[";"] = e.definitions["~"], e.definitions[";"].definitionSymbol = "~", !0 === e.numericInput && (e.positionCaretOnClick = "radixFocus" === e.positionCaretOnClick ? "lvp" : e.positionCaretOnClick, e.digitsOptional = !1, isNaN(e.digits) && (e.digits = 2), e.decimalProtect = !1);var r = "[+]";if (r += a(e.prefix, e), !0 === e.integerOptional ? r += "~{1," + e.integerDigits + "}" : r += "~{" + e.integerDigits + "}", e.digits !== n) {
            e.radixPointDefinitionSymbol = e.decimalProtect ? ":" : e.radixPoint;var o = e.digits.toString().split(",");isFinite(o[0] && o[1] && isFinite(o[1])) ? r += e.radixPointDefinitionSymbol + ";{" + e.digits + "}" : (isNaN(e.digits) || parseInt(e.digits) > 0) && (e.digitsOptional ? r += "[" + e.radixPointDefinitionSymbol + ";{1," + e.digits + "}]" : r += e.radixPointDefinitionSymbol + ";{" + e.digits + "}");
          }return r += a(e.suffix, e), r += "[-]", e.greedy = !1, r;
        }, placeholder: "", greedy: !1, digits: "*", digitsOptional: !0, enforceDigitsOnBlur: !1, radixPoint: ".", positionCaretOnClick: "radixFocus", groupSize: 3, groupSeparator: "", autoGroup: !1, allowMinus: !0, negationSymbol: { front: "-", back: "" }, integerDigits: "+", integerOptional: !0, prefix: "", suffix: "", rightAlign: !0, decimalProtect: !0, min: null, max: null, step: 1, insertMode: !0, autoUnmask: !1, unmaskAsNumber: !1, inputmode: "numeric", preValidation: function preValidation(t, a, i, r, o) {
          if ("-" === i || i === o.negationSymbol.front) return !0 === o.allowMinus && (o.isNegative = o.isNegative === n || !o.isNegative, "" === t.join("") || { caret: a, dopost: !0 });if (!1 === r && i === o.radixPoint && o.digits !== n && (isNaN(o.digits) || parseInt(o.digits) > 0)) {
            var s = e.inArray(o.radixPoint, t);if (-1 !== s) return !0 === o.numericInput ? a === s : { caret: s + 1 };
          }return !0;
        }, postValidation: function postValidation(a, i, r) {
          var o = r.suffix.split(""),
              s = r.prefix.split("");if (i.pos === n && i.caret !== n && !0 !== i.dopost) return i;var l = i.caret !== n ? i.caret : i.pos,
              c = a.slice();r.numericInput && (l = c.length - l - 1, c = c.reverse());var u = c[l];if (u === r.groupSeparator && (u = c[l += 1]), l === c.length - r.suffix.length - 1 && u === r.radixPoint) return i;u !== n && u !== r.radixPoint && u !== r.negationSymbol.front && u !== r.negationSymbol.back && (c[l] = "?", r.prefix.length > 0 && l >= (!1 === r.isNegative ? 1 : 0) && l < r.prefix.length - 1 + (!1 === r.isNegative ? 1 : 0) ? s[l - (!1 === r.isNegative ? 1 : 0)] = "?" : r.suffix.length > 0 && l >= c.length - r.suffix.length - (!1 === r.isNegative ? 1 : 0) && (o[l - (c.length - r.suffix.length - (!1 === r.isNegative ? 1 : 0))] = "?")), s = s.join(""), o = o.join("");var p = c.join("").replace(s, "");if (p = p.replace(o, ""), p = p.replace(new RegExp(t.escapeRegex(r.groupSeparator), "g"), ""), p = p.replace(new RegExp("[-" + t.escapeRegex(r.negationSymbol.front) + "]", "g"), ""), p = p.replace(new RegExp(t.escapeRegex(r.negationSymbol.back) + "$"), ""), isNaN(r.placeholder) && (p = p.replace(new RegExp(t.escapeRegex(r.placeholder), "g"), "")), p.length > 1 && 1 !== p.indexOf(r.radixPoint) && ("0" === u && (p = p.replace(/^\?/g, "")), p = p.replace(/^0/g, "")), p.charAt(0) === r.radixPoint && "" !== r.radixPoint && !0 !== r.numericInput && (p = "0" + p), "" !== p) {
            if (p = p.split(""), (!r.digitsOptional || r.enforceDigitsOnBlur && "blur" === i.event) && isFinite(r.digits)) {
              var f = e.inArray(r.radixPoint, p),
                  d = e.inArray(r.radixPoint, c);-1 === f && (p.push(r.radixPoint), f = p.length - 1);for (var m = 1; m <= r.digits; m++) {
                r.digitsOptional && (!r.enforceDigitsOnBlur || "blur" !== i.event) || p[f + m] !== n && p[f + m] !== r.placeholder.charAt(0) ? -1 !== d && c[d + m] !== n && (p[f + m] = p[f + m] || c[d + m]) : p[f + m] = i.placeholder || r.placeholder.charAt(0);
              }
            }if (!0 !== r.autoGroup || "" === r.groupSeparator || u === r.radixPoint && i.pos === n && !i.dopost) p = p.join("");else {
              var h = p[p.length - 1] === r.radixPoint && i.c === r.radixPoint;p = t(function (e, t) {
                var n = "";if (n += "(" + t.groupSeparator + "*{" + t.groupSize + "}){*}", "" !== t.radixPoint) {
                  var a = e.join("").split(t.radixPoint);a[1] && (n += t.radixPoint + "*{" + a[1].match(/^\d*\??\d*/)[0].length + "}");
                }return n;
              }(p, r), { numericInput: !0, jitMasking: !0, definitions: { "*": { validator: "[0-9?]", cardinality: 1 } } }).format(p.join("")), h && (p += r.radixPoint), p.charAt(0) === r.groupSeparator && p.substr(1);
            }
          }if (r.isNegative && "blur" === i.event && (r.isNegative = "0" !== p), p = s + p, p += o, r.isNegative && (p = r.negationSymbol.front + p, p += r.negationSymbol.back), p = p.split(""), u !== n) if (u !== r.radixPoint && u !== r.negationSymbol.front && u !== r.negationSymbol.back) (l = e.inArray("?", p)) > -1 ? p[l] = u : l = i.caret || 0;else if (u === r.radixPoint || u === r.negationSymbol.front || u === r.negationSymbol.back) {
            var g = e.inArray(u, p);-1 !== g && (l = g);
          }r.numericInput && (l = p.length - l - 1, p = p.reverse());var v = { caret: u === n || i.pos !== n ? l + (r.numericInput ? -1 : 1) : l, buffer: p, refreshFromBuffer: i.dopost || a.join("") !== p.join("") };return v.refreshFromBuffer ? v : i;
        }, onBeforeWrite: function onBeforeWrite(a, i, r, o) {
          if (a) switch (a.type) {case "keydown":
              return o.postValidation(i, { caret: r, dopost: !0 }, o);case "blur":case "checkval":
              var s;if (function (e) {
                e.parseMinMaxOptions === n && (null !== e.min && (e.min = e.min.toString().replace(new RegExp(t.escapeRegex(e.groupSeparator), "g"), ""), "," === e.radixPoint && (e.min = e.min.replace(e.radixPoint, ".")), e.min = isFinite(e.min) ? parseFloat(e.min) : NaN, isNaN(e.min) && (e.min = Number.MIN_VALUE)), null !== e.max && (e.max = e.max.toString().replace(new RegExp(t.escapeRegex(e.groupSeparator), "g"), ""), "," === e.radixPoint && (e.max = e.max.replace(e.radixPoint, ".")), e.max = isFinite(e.max) ? parseFloat(e.max) : NaN, isNaN(e.max) && (e.max = Number.MAX_VALUE)), e.parseMinMaxOptions = "done");
              }(o), null !== o.min || null !== o.max) {
                if (s = o.onUnMask(i.join(""), n, e.extend({}, o, { unmaskAsNumber: !0 })), null !== o.min && s < o.min) return o.isNegative = o.min < 0, o.postValidation(o.min.toString().replace(".", o.radixPoint).split(""), { caret: r, dopost: !0, placeholder: "0" }, o);if (null !== o.max && s > o.max) return o.isNegative = o.max < 0, o.postValidation(o.max.toString().replace(".", o.radixPoint).split(""), { caret: r, dopost: !0, placeholder: "0" }, o);
              }return o.postValidation(i, { caret: r, placeholder: "0", event: "blur" }, o);case "_checkval":
              return { caret: r };}
        }, regex: { integerPart: function integerPart(e, n) {
            return n ? new RegExp("[" + t.escapeRegex(e.negationSymbol.front) + "+]?") : new RegExp("[" + t.escapeRegex(e.negationSymbol.front) + "+]?\\d+");
          }, integerNPart: function integerNPart(e) {
            return new RegExp("[\\d" + t.escapeRegex(e.groupSeparator) + t.escapeRegex(e.placeholder.charAt(0)) + "]+");
          } }, definitions: { "~": { validator: function validator(e, a, i, r, o, s) {
              var l = r ? new RegExp("[0-9" + t.escapeRegex(o.groupSeparator) + "]").test(e) : new RegExp("[0-9]").test(e);if (!0 === l) {
                if (!0 !== o.numericInput && a.validPositions[i] !== n && "~" === a.validPositions[i].match.def && !s) {
                  var c = a.buffer.join(""),
                      u = (c = (c = c.replace(new RegExp("[-" + t.escapeRegex(o.negationSymbol.front) + "]", "g"), "")).replace(new RegExp(t.escapeRegex(o.negationSymbol.back) + "$"), "")).split(o.radixPoint);u.length > 1 && (u[1] = u[1].replace(/0/g, o.placeholder.charAt(0))), "0" === u[0] && (u[0] = u[0].replace(/0/g, o.placeholder.charAt(0))), c = u[0] + o.radixPoint + u[1] || "";var p = a._buffer.join("");for (c === o.radixPoint && (c = p); null === c.match(t.escapeRegex(p) + "$");) {
                    p = p.slice(1);
                  }l = (c = (c = c.replace(p, "")).split(""))[i] === n ? { pos: i, remove: i } : { pos: i };
                }
              } else r || e !== o.radixPoint || a.validPositions[i - 1] !== n || (a.buffer[i] = "0", l = { pos: i + 1 });return l;
            }, cardinality: 1 }, "+": { validator: function validator(e, t, n, a, i) {
              return i.allowMinus && ("-" === e || e === i.negationSymbol.front);
            }, cardinality: 1, placeholder: "" }, "-": { validator: function validator(e, t, n, a, i) {
              return i.allowMinus && e === i.negationSymbol.back;
            }, cardinality: 1, placeholder: "" }, ":": { validator: function validator(e, n, a, i, r) {
              var o = "[" + t.escapeRegex(r.radixPoint) + "]",
                  s = new RegExp(o).test(e);return s && n.validPositions[a] && n.validPositions[a].match.placeholder === r.radixPoint && (s = { caret: a + 1 }), s;
            }, cardinality: 1, placeholder: function placeholder(e) {
              return e.radixPoint;
            } } }, onUnMask: function onUnMask(e, n, a) {
          if ("" === n && !0 === a.nullable) return n;var i = e.replace(a.prefix, "");return i = i.replace(a.suffix, ""), i = i.replace(new RegExp(t.escapeRegex(a.groupSeparator), "g"), ""), "" !== a.placeholder.charAt(0) && (i = i.replace(new RegExp(a.placeholder.charAt(0), "g"), "0")), a.unmaskAsNumber ? ("" !== a.radixPoint && -1 !== i.indexOf(a.radixPoint) && (i = i.replace(t.escapeRegex.call(this, a.radixPoint), ".")), i = i.replace(new RegExp("^" + t.escapeRegex(a.negationSymbol.front)), "-"), i = i.replace(new RegExp(t.escapeRegex(a.negationSymbol.back) + "$"), ""), Number(i)) : i;
        }, isComplete: function isComplete(e, n) {
          var a = e.join("");if (e.slice().join("") !== a) return !1;var i = a.replace(n.prefix, "");return i = i.replace(n.suffix, ""), i = i.replace(new RegExp(t.escapeRegex(n.groupSeparator), "g"), ""), "," === n.radixPoint && (i = i.replace(t.escapeRegex(n.radixPoint), ".")), isFinite(i);
        }, onBeforeMask: function onBeforeMask(e, a) {
          if (a.isNegative = n, e = e.toString().charAt(e.length - 1) === a.radixPoint ? e.toString().substr(0, e.length - 1) : e.toString(), "" !== a.radixPoint && isFinite(e)) {
            var i = e.split("."),
                r = "" !== a.groupSeparator ? parseInt(a.groupSize) : 0;2 === i.length && (i[0].length > r || i[1].length > r || i[0].length <= r && i[1].length < r) && (e = e.replace(".", a.radixPoint));
          }var o = e.match(/,/g),
              s = e.match(/\./g);if (e = s && o ? s.length > o.length ? (e = e.replace(/\./g, "")).replace(",", a.radixPoint) : o.length > s.length ? (e = e.replace(/,/g, "")).replace(".", a.radixPoint) : e.indexOf(".") < e.indexOf(",") ? e.replace(/\./g, "") : e.replace(/,/g, "") : e.replace(new RegExp(t.escapeRegex(a.groupSeparator), "g"), ""), 0 === a.digits && (-1 !== e.indexOf(".") ? e = e.substring(0, e.indexOf(".")) : -1 !== e.indexOf(",") && (e = e.substring(0, e.indexOf(",")))), "" !== a.radixPoint && isFinite(a.digits) && -1 !== e.indexOf(a.radixPoint)) {
            var l = e.split(a.radixPoint)[1].match(new RegExp("\\d*"))[0];if (parseInt(a.digits) < l.toString().length) {
              var c = Math.pow(10, parseInt(a.digits));e = e.replace(t.escapeRegex(a.radixPoint), "."), e = (e = Math.round(parseFloat(e) * c) / c).toString().replace(".", a.radixPoint);
            }
          }return e;
        }, canClearPosition: function canClearPosition(e, t, n, a, i) {
          var r = e.validPositions[t],
              o = r.input !== i.radixPoint || null !== e.validPositions[t].match.fn && !1 === i.decimalProtect || r.input === i.radixPoint && e.validPositions[t + 1] && null === e.validPositions[t + 1].match.fn || isFinite(r.input) || t === n || r.input === i.groupSeparator || r.input === i.negationSymbol.front || r.input === i.negationSymbol.back;return !o || "+" !== r.match.nativeDef && "-" !== r.match.nativeDef || (i.isNegative = !1), o;
        }, onKeyDown: function onKeyDown(n, a, i, r) {
          var o = e(this);if (n.ctrlKey) switch (n.keyCode) {case t.keyCode.UP:
              o.val(parseFloat(this.inputmask.unmaskedvalue()) + parseInt(r.step)), o.trigger("setvalue");break;case t.keyCode.DOWN:
              o.val(parseFloat(this.inputmask.unmaskedvalue()) - parseInt(r.step)), o.trigger("setvalue");}
        } }, currency: { prefix: "$ ", groupSeparator: ",", alias: "numeric", placeholder: "0", autoGroup: !0, digits: 2, digitsOptional: !1, clearMaskOnLostFocus: !1 }, decimal: { alias: "numeric" }, integer: { alias: "numeric", digits: 0, radixPoint: "" }, percentage: { alias: "numeric", digits: 2, digitsOptional: !0, radixPoint: ".", placeholder: "0", autoGroup: !1, min: 0, max: 100, suffix: " %", allowMinus: !1 } }), t;
  });
}, function (e, t, n) {
  "use strict";
  var a, i, r;"function" == typeof Symbol && Symbol.iterator;!function (o) {
    i = [n(0), n(1)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e, t) {
    function n(e, t) {
      var n = (e.mask || e).replace(/#/g, "9").replace(/\)/, "9").replace(/[+()#-]/g, ""),
          a = (t.mask || t).replace(/#/g, "9").replace(/\)/, "9").replace(/[+()#-]/g, ""),
          i = (e.mask || e).split("#")[0],
          r = (t.mask || t).split("#")[0];return 0 === r.indexOf(i) ? -1 : 0 === i.indexOf(r) ? 1 : n.localeCompare(a);
    }var a = t.prototype.analyseMask;return t.prototype.analyseMask = function (t, n, i) {
      function r(e, n, a) {
        n = n || "", a = a || s, "" !== n && (a[n] = {});for (var i = "", o = a[n] || a, l = e.length - 1; l >= 0; l--) {
          o[i = (t = e[l].mask || e[l]).substr(0, 1)] = o[i] || [], o[i].unshift(t.substr(1)), e.splice(l, 1);
        }for (var c in o) {
          o[c].length > 500 && r(o[c].slice(), c, o);
        }
      }function o(t) {
        var n = "",
            a = [];for (var r in t) {
          e.isArray(t[r]) ? 1 === t[r].length ? a.push(r + t[r]) : a.push(r + i.groupmarker.start + t[r].join(i.groupmarker.end + i.alternatormarker + i.groupmarker.start) + i.groupmarker.end) : a.push(r + o(t[r]));
        }return 1 === a.length ? n += a[0] : n += i.groupmarker.start + a.join(i.groupmarker.end + i.alternatormarker + i.groupmarker.start) + i.groupmarker.end, n;
      }var s = {};return i.phoneCodes && (i.phoneCodes && i.phoneCodes.length > 1e3 && (r((t = t.substr(1, t.length - 2)).split(i.groupmarker.end + i.alternatormarker + i.groupmarker.start)), t = o(s)), t = t.replace(/9/g, "\\9")), a.call(this, t, n, i);
    }, t.extendAliases({ abstractphone: { groupmarker: { start: "<", end: ">" }, countrycode: "", phoneCodes: [], mask: function mask(e) {
          return e.definitions = { "#": t.prototype.definitions[9] }, e.phoneCodes.sort(n);
        }, keepStatic: !0, onBeforeMask: function onBeforeMask(e, t) {
          var n = e.replace(/^0{1,2}/, "").replace(/[\s]/g, "");return (n.indexOf(t.countrycode) > 1 || -1 === n.indexOf(t.countrycode)) && (n = "+" + t.countrycode + n), n;
        }, onUnMask: function onUnMask(e, t, n) {
          return e.replace(/[()#-]/g, "");
        }, inputmode: "tel" } }), t;
  });
}, function (e, t, n) {
  "use strict";
  var a, i, r;"function" == typeof Symbol && Symbol.iterator;!function (o) {
    i = [n(0), n(1)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e, t) {
    return t.extendAliases({ Regex: { mask: "r", greedy: !1, repeat: "*", regex: null, regexTokens: null, tokenizer: /\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g, quantifierFilter: /[0-9]+[^,]/, isComplete: function isComplete(e, t) {
          return new RegExp(t.regex, t.casing ? "i" : "").test(e.join(""));
        }, definitions: { r: { validator: function validator(t, n, a, i, r) {
              function o(e, t) {
                this.matches = [], this.isGroup = e || !1, this.isQuantifier = t || !1, this.quantifier = { min: 1, max: 1 }, this.repeaterPart = void 0;
              }function s(t, n) {
                var a = !1;n && (p += "(", d++);for (var i = 0; i < t.matches.length; i++) {
                  var o = t.matches[i];if (!0 === o.isGroup) a = s(o, !0);else if (!0 === o.isQuantifier) {
                    var c = e.inArray(o, t.matches),
                        u = t.matches[c - 1],
                        f = p;if (isNaN(o.quantifier.max)) {
                      for (; o.repeaterPart && o.repeaterPart !== p && o.repeaterPart.length > p.length && !(a = s(u, !0));) {}(a = a || s(u, !0)) && (o.repeaterPart = p), p = f + o.quantifier.max;
                    } else {
                      for (var m = 0, h = o.quantifier.max - 1; m < h && !(a = s(u, !0)); m++) {}p = f + "{" + o.quantifier.min + "," + o.quantifier.max + "}";
                    }
                  } else if (void 0 !== o.matches) for (var g = 0; g < o.length && !(a = s(o[g], n)); g++) {} else {
                    var v;if ("[" == o.charAt(0)) {
                      v = p, v += o;for (b = 0; b < d; b++) {
                        v += ")";
                      }a = (x = new RegExp("^(" + v + ")$", r.casing ? "i" : "")).test(l);
                    } else for (var y = 0, k = o.length; y < k; y++) {
                      if ("\\" !== o.charAt(y)) {
                        v = p, v = (v += o.substr(0, y + 1)).replace(/\|$/, "");for (var b = 0; b < d; b++) {
                          v += ")";
                        }var x = new RegExp("^(" + v + ")$", r.casing ? "i" : "");if (a = x.test(l)) break;
                      }
                    }p += o;
                  }if (a) break;
                }return n && (p += ")", d--), a;
              }var l,
                  c,
                  u = n.buffer.slice(),
                  p = "",
                  f = !1,
                  d = 0;null === r.regexTokens && function () {
                var e,
                    t,
                    n = new o(),
                    a = [];for (r.regexTokens = []; e = r.tokenizer.exec(r.regex);) {
                  switch ((t = e[0]).charAt(0)) {case "(":
                      a.push(new o(!0));break;case ")":
                      c = a.pop(), a.length > 0 ? a[a.length - 1].matches.push(c) : n.matches.push(c);break;case "{":case "+":case "*":
                      var i = new o(!1, !0),
                          s = (t = t.replace(/[{}]/g, "")).split(","),
                          l = isNaN(s[0]) ? s[0] : parseInt(s[0]),
                          u = 1 === s.length ? l : isNaN(s[1]) ? s[1] : parseInt(s[1]);if (i.quantifier = { min: l, max: u }, a.length > 0) {
                        var p = a[a.length - 1].matches;(e = p.pop()).isGroup || ((c = new o(!0)).matches.push(e), e = c), p.push(e), p.push(i);
                      } else (e = n.matches.pop()).isGroup || ((c = new o(!0)).matches.push(e), e = c), n.matches.push(e), n.matches.push(i);break;default:
                      a.length > 0 ? a[a.length - 1].matches.push(t) : n.matches.push(t);}
                }n.matches.length > 0 && r.regexTokens.push(n);
              }(), u.splice(a, 0, t), l = u.join("");for (var m = 0; m < r.regexTokens.length; m++) {
                var h = r.regexTokens[m];if (f = s(h, h.isGroup)) break;
              }return f;
            }, cardinality: 1 } } } }), t;
  });
}, function (e, t, n) {
  "use strict";
  var a,
      i,
      r,
      o = "function" == typeof Symbol && "symbol" == _typeof2(Symbol.iterator) ? function (e) {
    return typeof e === 'undefined' ? 'undefined' : _typeof2(e);
  } : function (e) {
    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e === 'undefined' ? 'undefined' : _typeof2(e);
  };!function (o) {
    i = [n(2), n(1)], void 0 !== (r = "function" == typeof (a = o) ? a.apply(t, i) : a) && (e.exports = r);
  }(function (e, t) {
    return void 0 === e.fn.inputmask && (e.fn.inputmask = function (n, a) {
      var i,
          r = this[0];if (void 0 === a && (a = {}), "string" == typeof n) switch (n) {case "unmaskedvalue":
          return r && r.inputmask ? r.inputmask.unmaskedvalue() : e(r).val();case "remove":
          return this.each(function () {
            this.inputmask && this.inputmask.remove();
          });case "getemptymask":
          return r && r.inputmask ? r.inputmask.getemptymask() : "";case "hasMaskedValue":
          return !(!r || !r.inputmask) && r.inputmask.hasMaskedValue();case "isComplete":
          return !r || !r.inputmask || r.inputmask.isComplete();case "getmetadata":
          return r && r.inputmask ? r.inputmask.getmetadata() : void 0;case "setvalue":
          e(r).val(a), r && void 0 === r.inputmask && e(r).triggerHandler("setvalue");break;case "option":
          if ("string" != typeof a) return this.each(function () {
            if (void 0 !== this.inputmask) return this.inputmask.option(a);
          });if (r && void 0 !== r.inputmask) return r.inputmask.option(a);break;default:
          return a.alias = n, i = new t(a), this.each(function () {
            i.mask(this);
          });} else {
        if ("object" == (void 0 === n ? "undefined" : o(n))) return i = new t(n), void 0 === n.mask && void 0 === n.alias ? this.each(function () {
          if (void 0 !== this.inputmask) return this.inputmask.option(n);i.mask(this);
        }) : this.each(function () {
          i.mask(this);
        });if (void 0 === n) return this.each(function () {
          (i = new t(a)).mask(this);
        });
      }
    }), e.fn.inputmask;
  });
}]);
/**
 * jquery-match-height master by @liabru
 * http://brm.io/jquery-match-height/
 * License: MIT
 */

;(function (factory) {
  // eslint-disable-line no-extra-semi
  'use strict';

  if (typeof define === 'function' && define.amd) {
    // AMD
    define(['jquery'], factory);
  } else if (typeof module !== 'undefined' && module.exports) {
    // CommonJS
    module.exports = factory(require('jquery'));
  } else {
    // Global
    factory(jQuery);
  }
})(function ($) {
  /*
  *  internal
  */

  var _previousResizeWidth = -1,
      _updateTimeout = -1;

  /*
  *  _parse
  *  value parse utility function
  */

  var _parse = function _parse(value) {
    // parse value and convert NaN to 0
    return parseFloat(value) || 0;
  };

  /*
  *  _rows
  *  utility function returns array of jQuery selections representing each row
  *  (as displayed after float wrapping applied by browser)
  */

  var _rows = function _rows(elements) {
    var tolerance = 1,
        $elements = $(elements),
        lastTop = null,
        rows = [];

    // group elements by their top position
    $elements.each(function () {
      var $that = $(this),
          top = $that.offset().top - _parse($that.css('margin-top')),
          lastRow = rows.length > 0 ? rows[rows.length - 1] : null;

      if (lastRow === null) {
        // first item on the row, so just push it
        rows.push($that);
      } else {
        // if the row top is the same, add to the row group
        if (Math.floor(Math.abs(lastTop - top)) <= tolerance) {
          rows[rows.length - 1] = lastRow.add($that);
        } else {
          // otherwise start a new row group
          rows.push($that);
        }
      }

      // keep track of the last row top
      lastTop = top;
    });

    return rows;
  };

  /*
  *  _parseOptions
  *  handle plugin options
  */

  var _parseOptions = function _parseOptions(options) {
    var opts = {
      byRow: true,
      property: 'height',
      target: null,
      remove: false
    };

    if ((typeof options === 'undefined' ? 'undefined' : _typeof2(options)) === 'object') {
      return $.extend(opts, options);
    }

    if (typeof options === 'boolean') {
      opts.byRow = options;
    } else if (options === 'remove') {
      opts.remove = true;
    }

    return opts;
  };

  /*
  *  matchHeight
  *  plugin definition
  */

  var matchHeight = $.fn.matchHeight = function (options) {
    var opts = _parseOptions(options);

    // handle remove
    if (opts.remove) {
      var that = this;

      // remove fixed height from all selected elements
      this.css(opts.property, '');

      // remove selected elements from all groups
      $.each(matchHeight._groups, function (key, group) {
        group.elements = group.elements.not(that);
      });

      // TODO: cleanup empty groups

      return this;
    }

    if (this.length <= 1 && !opts.target) {
      return this;
    }

    // keep track of this group so we can re-apply later on load and resize events
    matchHeight._groups.push({
      elements: this,
      options: opts
    });

    // match each element's height to the tallest element in the selection
    matchHeight._apply(this, opts);

    return this;
  };

  /*
  *  plugin global options
  */

  matchHeight.version = 'master';
  matchHeight._groups = [];
  matchHeight._throttle = 80;
  matchHeight._maintainScroll = false;
  matchHeight._beforeUpdate = null;
  matchHeight._afterUpdate = null;
  matchHeight._rows = _rows;
  matchHeight._parse = _parse;
  matchHeight._parseOptions = _parseOptions;

  /*
  *  matchHeight._apply
  *  apply matchHeight to given elements
  */

  matchHeight._apply = function (elements, options) {
    var opts = _parseOptions(options),
        $elements = $(elements),
        rows = [$elements];

    // take note of scroll position
    var scrollTop = $(window).scrollTop(),
        htmlHeight = $('html').outerHeight(true);

    // get hidden parents
    var $hiddenParents = $elements.parents().filter(':hidden');

    // cache the original inline style
    $hiddenParents.each(function () {
      var $that = $(this);
      $that.data('style-cache', $that.attr('style'));
    });

    // temporarily must force hidden parents visible
    $hiddenParents.css('display', 'block');

    // get rows if using byRow, otherwise assume one row
    if (opts.byRow && !opts.target) {

      // must first force an arbitrary equal height so floating elements break evenly
      $elements.each(function () {
        var $that = $(this),
            display = $that.css('display');

        // temporarily force a usable display value
        if (display !== 'inline-block' && display !== 'flex' && display !== 'inline-flex') {
          display = 'block';
        }

        // cache the original inline style
        $that.data('style-cache', $that.attr('style'));

        $that.css({
          'display': display,
          'padding-top': '0',
          'padding-bottom': '0',
          'margin-top': '0',
          'margin-bottom': '0',
          'border-top-width': '0',
          'border-bottom-width': '0',
          'height': '100px',
          'overflow': 'hidden'
        });
      });

      // get the array of rows (based on element top position)
      rows = _rows($elements);

      // revert original inline styles
      $elements.each(function () {
        var $that = $(this);
        $that.attr('style', $that.data('style-cache') || '');
      });
    }

    $.each(rows, function (key, row) {
      var $row = $(row),
          targetHeight = 0;

      if (!opts.target) {
        // skip apply to rows with only one item
        if (opts.byRow && $row.length <= 1) {
          $row.css(opts.property, '');
          return;
        }

        // iterate the row and find the max height
        $row.each(function () {
          var $that = $(this),
              style = $that.attr('style'),
              display = $that.css('display');

          // temporarily force a usable display value
          if (display !== 'inline-block' && display !== 'flex' && display !== 'inline-flex') {
            display = 'block';
          }

          // ensure we get the correct actual height (and not a previously set height value)
          var css = { 'display': display };
          css[opts.property] = '';
          $that.css(css);

          // find the max height (including padding, but not margin)
          if ($that.outerHeight(false) > targetHeight) {
            targetHeight = $that.outerHeight(false);
          }

          // revert styles
          if (style) {
            $that.attr('style', style);
          } else {
            $that.css('display', '');
          }
        });
      } else {
        // if target set, use the height of the target element
        targetHeight = opts.target.outerHeight(false);
      }

      // iterate the row and apply the height to all elements
      $row.each(function () {
        var $that = $(this),
            verticalPadding = 0;

        // don't apply to a target
        if (opts.target && $that.is(opts.target)) {
          return;
        }

        // handle padding and border correctly (required when not using border-box)
        if ($that.css('box-sizing') !== 'border-box') {
          verticalPadding += _parse($that.css('border-top-width')) + _parse($that.css('border-bottom-width'));
          verticalPadding += _parse($that.css('padding-top')) + _parse($that.css('padding-bottom'));
        }

        // set the height (accounting for padding and border)
        $that.css(opts.property, targetHeight - verticalPadding + 'px');
      });
    });

    // revert hidden parents
    $hiddenParents.each(function () {
      var $that = $(this);
      $that.attr('style', $that.data('style-cache') || null);
    });

    // restore scroll position if enabled
    if (matchHeight._maintainScroll) {
      $(window).scrollTop(scrollTop / htmlHeight * $('html').outerHeight(true));
    }

    return this;
  };

  /*
  *  matchHeight._applyDataApi
  *  applies matchHeight to all elements with a data-match-height attribute
  */

  matchHeight._applyDataApi = function () {
    var groups = {};

    // generate groups by their groupId set by elements using data-match-height
    $('[data-match-height], [data-mh]').each(function () {
      var $this = $(this),
          groupId = $this.attr('data-mh') || $this.attr('data-match-height');

      if (groupId in groups) {
        groups[groupId] = groups[groupId].add($this);
      } else {
        groups[groupId] = $this;
      }
    });

    // apply matchHeight to each group
    $.each(groups, function () {
      this.matchHeight(true);
    });
  };

  /*
  *  matchHeight._update
  *  updates matchHeight on all current groups with their correct options
  */

  var _update = function _update(event) {
    if (matchHeight._beforeUpdate) {
      matchHeight._beforeUpdate(event, matchHeight._groups);
    }

    $.each(matchHeight._groups, function () {
      matchHeight._apply(this.elements, this.options);
    });

    if (matchHeight._afterUpdate) {
      matchHeight._afterUpdate(event, matchHeight._groups);
    }
  };

  matchHeight._update = function (throttle, event) {
    // prevent update if fired from a resize event
    // where the viewport width hasn't actually changed
    // fixes an event looping bug in IE8
    if (event && event.type === 'resize') {
      var windowWidth = $(window).width();
      if (windowWidth === _previousResizeWidth) {
        return;
      }
      _previousResizeWidth = windowWidth;
    }

    // throttle updates
    if (!throttle) {
      _update(event);
    } else if (_updateTimeout === -1) {
      _updateTimeout = setTimeout(function () {
        _update(event);
        _updateTimeout = -1;
      }, matchHeight._throttle);
    }
  };

  /*
  *  bind events
  */

  // apply on DOM ready event
  $(matchHeight._applyDataApi);

  // use on or bind where supported
  var on = $.fn.on ? 'on' : 'bind';

  // update heights on load and resize events
  $(window)[on]('load', function (event) {
    matchHeight._update(false, event);
  });

  // throttled update heights on resize events
  $(window)[on]('resize orientationchange', function (event) {
    matchHeight._update(true, event);
  });
});

/*!
 * @preserve
 * jquery.scrolldepth.js | v1.0
 * Copyright (c) 2016 Rob Flaherty (@robflaherty)
 * Licensed under the MIT and GPL licenses.
 */
!function (e) {
  "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == (typeof module === 'undefined' ? 'undefined' : _typeof2(module)) && module.exports ? module.exports = e(require("jquery")) : e(jQuery);
}(function (e) {
  "use strict";
  var n,
      t,
      r,
      o,
      i = { minHeight: 0, elements: [], percentage: !0, userTiming: !0, pixelDepth: !0, nonInteraction: !0, gaGlobal: !1, gtmOverride: !1, trackerName: !1, dataLayer: "dataLayer" },
      a = e(window),
      l = [],
      c = !1,
      u = 0;return e.scrollDepth = function (p) {
    function s(e, i, a, l) {
      var c = p.trackerName ? p.trackerName + ".send" : "send";o ? (o({ event: "ScrollDistance", eventCategory: "Scroll Depth", eventAction: e, eventLabel: i, eventValue: 1, eventNonInteraction: p.nonInteraction }), p.pixelDepth && arguments.length > 2 && a > u && (u = a, o({ event: "ScrollDistance", eventCategory: "Scroll Depth", eventAction: "Pixel Depth", eventLabel: d(a), eventValue: 1, eventNonInteraction: p.nonInteraction })), p.userTiming && arguments.length > 3 && o({ event: "ScrollTiming", eventCategory: "Scroll Depth", eventAction: e, eventLabel: i, eventTiming: l })) : (n && (window[r](c, "event", "Scroll Depth", e, i, 1, { nonInteraction: p.nonInteraction }), p.pixelDepth && arguments.length > 2 && a > u && (u = a, window[r](c, "event", "Scroll Depth", "Pixel Depth", d(a), 1, { nonInteraction: p.nonInteraction })), p.userTiming && arguments.length > 3 && window[r](c, "timing", "Scroll Depth", e, l, i)), t && (_gaq.push(["_trackEvent", "Scroll Depth", e, i, 1, p.nonInteraction]), p.pixelDepth && arguments.length > 2 && a > u && (u = a, _gaq.push(["_trackEvent", "Scroll Depth", "Pixel Depth", d(a), 1, p.nonInteraction])), p.userTiming && arguments.length > 3 && _gaq.push(["_trackTiming", "Scroll Depth", e, l, i, 100])));
    }function h(e) {
      return { "25%": parseInt(.25 * e, 10), "50%": parseInt(.5 * e, 10), "75%": parseInt(.75 * e, 10), "100%": e - 5 };
    }function g(n, t, r) {
      e.each(n, function (n, o) {
        -1 === e.inArray(n, l) && t >= o && (s("Percentage", n, t, r), l.push(n));
      });
    }function f(n, t, r) {
      e.each(n, function (n, o) {
        -1 === e.inArray(o, l) && e(o).length && t >= e(o).offset().top && (s("Elements", o, t, r), l.push(o));
      });
    }function d(e) {
      return (250 * Math.floor(e / 250)).toString();
    }function m() {
      y();
    }function v(e, n) {
      var t,
          r,
          o,
          i = null,
          a = 0,
          l = function l() {
        a = new Date(), i = null, o = e.apply(t, r);
      };return function () {
        var c = new Date();a || (a = c);var u = n - (c - a);return t = this, r = arguments, 0 >= u ? (clearTimeout(i), i = null, a = c, o = e.apply(t, r)) : i || (i = setTimeout(l, u)), o;
      };
    }function y() {
      c = !0, a.on("scroll.scrollDepth", v(function () {
        var n = e(document).height(),
            t = window.innerHeight ? window.innerHeight : a.height(),
            r = a.scrollTop() + t,
            o = h(n),
            i = +new Date() - D;return l.length >= p.elements.length + (p.percentage ? 4 : 0) ? (a.off("scroll.scrollDepth"), void (c = !1)) : (p.elements && f(p.elements, r, i), void (p.percentage && g(o, r, i)));
      }, 500));
    }var D = +new Date();p = e.extend({}, i, p), e(document).height() < p.minHeight || (p.gaGlobal ? (n = !0, r = p.gaGlobal) : "function" == typeof ga ? (n = !0, r = "ga") : "function" == typeof __gaTracker && (n = !0, r = "__gaTracker"), "undefined" != typeof _gaq && "function" == typeof _gaq.push && (t = !0), "function" == typeof p.eventHandler ? o = p.eventHandler : "undefined" == typeof window[p.dataLayer] || "function" != typeof window[p.dataLayer].push || p.gtmOverride || (o = function o(e) {
      window[p.dataLayer].push(e);
    }), e.scrollDepth.reset = function () {
      l = [], u = 0, a.off("scroll.scrollDepth"), y();
    }, e.scrollDepth.addElements = function (n) {
      "undefined" != typeof n && e.isArray(n) && (e.merge(p.elements, n), c || y());
    }, e.scrollDepth.removeElements = function (n) {
      "undefined" != typeof n && e.isArray(n) && e.each(n, function (n, t) {
        var r = e.inArray(t, p.elements),
            o = e.inArray(t, l);-1 != r && p.elements.splice(r, 1), -1 != o && l.splice(o, 1);
      });
    }, m());
  }, e.scrollDepth;
});

/*!
* phone-codes/phone.min.js
* https://github.com/RobinHerbots/Inputmask
* Copyright (c) 2010 - 2017 Robin Herbots
* Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
* Version: 3.3.11
*/

!function (c) {
  "function" == typeof define && define.amd ? define(["../inputmask"], c) : "object" == (typeof exports === 'undefined' ? 'undefined' : _typeof2(exports)) ? module.exports = c(require("../inputmask")) : c(window.Inputmask);
}(function (c) {
  return c.extendAliases({ phone: { alias: "abstractphone", phoneCodes: [{ mask: "+247-####", cc: "AC", cd: "Ascension", desc_en: "", name_ru: "Остров Вознесения", desc_ru: "" }, { mask: "+376-###-###", cc: "AD", cd: "Andorra", desc_en: "", name_ru: "Андорра", desc_ru: "" }, { mask: "+971-5#-###-####", cc: "AE", cd: "United Arab Emirates", desc_en: "mobile", name_ru: "Объединенные Арабские Эмираты", desc_ru: "мобильные" }, { mask: "+971-#-###-####", cc: "AE", cd: "United Arab Emirates", desc_en: "", name_ru: "Объединенные Арабские Эмираты", desc_ru: "" }, { mask: "+93-##-###-####", cc: "AF", cd: "Afghanistan", desc_en: "", name_ru: "Афганистан", desc_ru: "" }, { mask: "+1(268)###-####", cc: "AG", cd: "Antigua & Barbuda", desc_en: "", name_ru: "Антигуа и Барбуда", desc_ru: "" }, { mask: "+1(264)###-####", cc: "AI", cd: "Anguilla", desc_en: "", name_ru: "Ангилья", desc_ru: "" }, { mask: "+355(###)###-###", cc: "AL", cd: "Albania", desc_en: "", name_ru: "Албания", desc_ru: "" }, { mask: "+374-##-###-###", cc: "AM", cd: "Armenia", desc_en: "", name_ru: "Армения", desc_ru: "" }, { mask: "+599-###-####", cc: "AN", cd: "Caribbean Netherlands", desc_en: "", name_ru: "Карибские Нидерланды", desc_ru: "" }, { mask: "+599-###-####", cc: "AN", cd: "Netherlands Antilles", desc_en: "", name_ru: "Нидерландские Антильские острова", desc_ru: "" }, { mask: "+599-9###-####", cc: "AN", cd: "Netherlands Antilles", desc_en: "Curacao", name_ru: "Нидерландские Антильские острова", desc_ru: "Кюрасао" }, { mask: "+244(###)###-###", cc: "AO", cd: "Angola", desc_en: "", name_ru: "Ангола", desc_ru: "" }, { mask: "+672-1##-###", cc: "AQ", cd: "Australian bases in Antarctica", desc_en: "", name_ru: "Австралийская антарктическая база", desc_ru: "" }, { mask: "+54(###)###-####", cc: "AR", cd: "Argentina", desc_en: "", name_ru: "Аргентина", desc_ru: "" }, { mask: "+1(684)###-####", cc: "AS", cd: "American Samoa", desc_en: "", name_ru: "Американское Самоа", desc_ru: "" }, { mask: "+43(###)###-####", cc: "AT", cd: "Austria", desc_en: "", name_ru: "Австрия", desc_ru: "" }, { mask: "+61-#-####-####", cc: "AU", cd: "Australia", desc_en: "", name_ru: "Австралия", desc_ru: "" }, { mask: "+297-###-####", cc: "AW", cd: "Aruba", desc_en: "", name_ru: "Аруба", desc_ru: "" }, { mask: "+994-##-###-##-##", cc: "AZ", cd: "Azerbaijan", desc_en: "", name_ru: "Азербайджан", desc_ru: "" }, { mask: "+387-##-#####", cc: "BA", cd: "Bosnia and Herzegovina", desc_en: "", name_ru: "Босния и Герцеговина", desc_ru: "" }, { mask: "+387-##-####", cc: "BA", cd: "Bosnia and Herzegovina", desc_en: "", name_ru: "Босния и Герцеговина", desc_ru: "" }, { mask: "+1(246)###-####", cc: "BB", cd: "Barbados", desc_en: "", name_ru: "Барбадос", desc_ru: "" }, { mask: "+880-##-###-###", cc: "BD", cd: "Bangladesh", desc_en: "", name_ru: "Бангладеш", desc_ru: "" }, { mask: "+32(###)###-###", cc: "BE", cd: "Belgium", desc_en: "", name_ru: "Бельгия", desc_ru: "" }, { mask: "+226-##-##-####", cc: "BF", cd: "Burkina Faso", desc_en: "", name_ru: "Буркина Фасо", desc_ru: "" }, { mask: "+359(###)###-###", cc: "BG", cd: "Bulgaria", desc_en: "", name_ru: "Болгария", desc_ru: "" }, { mask: "+973-####-####", cc: "BH", cd: "Bahrain", desc_en: "", name_ru: "Бахрейн", desc_ru: "" }, { mask: "+257-##-##-####", cc: "BI", cd: "Burundi", desc_en: "", name_ru: "Бурунди", desc_ru: "" }, { mask: "+229-##-##-####", cc: "BJ", cd: "Benin", desc_en: "", name_ru: "Бенин", desc_ru: "" }, { mask: "+1(441)###-####", cc: "BM", cd: "Bermuda", desc_en: "", name_ru: "Бермудские острова", desc_ru: "" }, { mask: "+673-###-####", cc: "BN", cd: "Brunei Darussalam", desc_en: "", name_ru: "Бруней-Даруссалам", desc_ru: "" }, { mask: "+591-#-###-####", cc: "BO", cd: "Bolivia", desc_en: "", name_ru: "Боливия", desc_ru: "" }, { mask: "+55-##-####-####", cc: "BR", cd: "Brazil", desc_en: "", name_ru: "Бразилия", desc_ru: "" }, { mask: "+55-##-#####-####", cc: "BR", cd: "Brazil", desc_en: "", name_ru: "Бразилия", desc_ru: "" }, { mask: "+1(242)###-####", cc: "BS", cd: "Bahamas", desc_en: "", name_ru: "Багамские Острова", desc_ru: "" }, { mask: "+975-17-###-###", cc: "BT", cd: "Bhutan", desc_en: "", name_ru: "Бутан", desc_ru: "" }, { mask: "+975-#-###-###", cc: "BT", cd: "Bhutan", desc_en: "", name_ru: "Бутан", desc_ru: "" }, { mask: "+267-##-###-###", cc: "BW", cd: "Botswana", desc_en: "", name_ru: "Ботсвана", desc_ru: "" }, { mask: "+375(##)###-##-##", cc: "BY", cd: "Belarus", desc_en: "", name_ru: "Беларусь (Белоруссия)", desc_ru: "" }, { mask: "+501-###-####", cc: "BZ", cd: "Belize", desc_en: "", name_ru: "Белиз", desc_ru: "" }, { mask: "+243(###)###-###", cc: "CD", cd: "Dem. Rep. Congo", desc_en: "", name_ru: "Дем. Респ. Конго (Киншаса)", desc_ru: "" }, { mask: "+236-##-##-####", cc: "CF", cd: "Central African Republic", desc_en: "", name_ru: "Центральноафриканская Республика", desc_ru: "" }, { mask: "+242-##-###-####", cc: "CG", cd: "Congo (Brazzaville)", desc_en: "", name_ru: "Конго (Браззавиль)", desc_ru: "" }, { mask: "+41-##-###-####", cc: "CH", cd: "Switzerland", desc_en: "", name_ru: "Швейцария", desc_ru: "" }, { mask: "+225-##-###-###", cc: "CI", cd: "Cote d’Ivoire (Ivory Coast)", desc_en: "", name_ru: "Кот-д’Ивуар", desc_ru: "" }, { mask: "+682-##-###", cc: "CK", cd: "Cook Islands", desc_en: "", name_ru: "Острова Кука", desc_ru: "" }, { mask: "+56-#-####-####", cc: "CL", cd: "Chile", desc_en: "", name_ru: "Чили", desc_ru: "" }, { mask: "+237-####-####", cc: "CM", cd: "Cameroon", desc_en: "", name_ru: "Камерун", desc_ru: "" }, { mask: "+86(###)####-####", cc: "CN", cd: "China (PRC)", desc_en: "", name_ru: "Китайская Н.Р.", desc_ru: "" }, { mask: "+86(###)####-###", cc: "CN", cd: "China (PRC)", desc_en: "", name_ru: "Китайская Н.Р.", desc_ru: "" }, { mask: "+86-##-#####-#####", cc: "CN", cd: "China (PRC)", desc_en: "", name_ru: "Китайская Н.Р.", desc_ru: "" }, { mask: "+57(###)###-####", cc: "CO", cd: "Colombia", desc_en: "", name_ru: "Колумбия", desc_ru: "" }, { mask: "+506-####-####", cc: "CR", cd: "Costa Rica", desc_en: "", name_ru: "Коста-Рика", desc_ru: "" }, { mask: "+53-#-###-####", cc: "CU", cd: "Cuba", desc_en: "", name_ru: "Куба", desc_ru: "" }, { mask: "+238(###)##-##", cc: "CV", cd: "Cape Verde", desc_en: "", name_ru: "Кабо-Верде", desc_ru: "" }, { mask: "+599-###-####", cc: "CW", cd: "Curacao", desc_en: "", name_ru: "Кюрасао", desc_ru: "" }, { mask: "+357-##-###-###", cc: "CY", cd: "Cyprus", desc_en: "", name_ru: "Кипр", desc_ru: "" }, { mask: "+420(###)###-###", cc: "CZ", cd: "Czech Republic", desc_en: "", name_ru: "Чехия", desc_ru: "" }, { mask: "+49(####)###-####", cc: "DE", cd: "Germany", desc_en: "", name_ru: "Германия", desc_ru: "" }, { mask: "+49(###)###-####", cc: "DE", cd: "Germany", desc_en: "", name_ru: "Германия", desc_ru: "" }, { mask: "+49(###)##-####", cc: "DE", cd: "Germany", desc_en: "", name_ru: "Германия", desc_ru: "" }, { mask: "+49(###)##-###", cc: "DE", cd: "Germany", desc_en: "", name_ru: "Германия", desc_ru: "" }, { mask: "+49(###)##-##", cc: "DE", cd: "Germany", desc_en: "", name_ru: "Германия", desc_ru: "" }, { mask: "+49-###-###", cc: "DE", cd: "Germany", desc_en: "", name_ru: "Германия", desc_ru: "" }, { mask: "+253-##-##-##-##", cc: "DJ", cd: "Djibouti", desc_en: "", name_ru: "Джибути", desc_ru: "" }, { mask: "+45-##-##-##-##", cc: "DK", cd: "Denmark", desc_en: "", name_ru: "Дания", desc_ru: "" }, { mask: "+1(767)###-####", cc: "DM", cd: "Dominica", desc_en: "", name_ru: "Доминика", desc_ru: "" }, { mask: "+1(809)###-####", cc: "DO", cd: "Dominican Republic", desc_en: "", name_ru: "Доминиканская Республика", desc_ru: "" }, { mask: "+1(829)###-####", cc: "DO", cd: "Dominican Republic", desc_en: "", name_ru: "Доминиканская Республика", desc_ru: "" }, { mask: "+1(849)###-####", cc: "DO", cd: "Dominican Republic", desc_en: "", name_ru: "Доминиканская Республика", desc_ru: "" }, { mask: "+213-##-###-####", cc: "DZ", cd: "Algeria", desc_en: "", name_ru: "Алжир", desc_ru: "" }, { mask: "+593-##-###-####", cc: "EC", cd: "Ecuador ", desc_en: "mobile", name_ru: "Эквадор ", desc_ru: "мобильные" }, { mask: "+593-#-###-####", cc: "EC", cd: "Ecuador", desc_en: "", name_ru: "Эквадор", desc_ru: "" }, { mask: "+372-####-####", cc: "EE", cd: "Estonia ", desc_en: "mobile", name_ru: "Эстония ", desc_ru: "мобильные" }, { mask: "+372-###-####", cc: "EE", cd: "Estonia", desc_en: "", name_ru: "Эстония", desc_ru: "" }, { mask: "+20(###)###-####", cc: "EG", cd: "Egypt", desc_en: "", name_ru: "Египет", desc_ru: "" }, { mask: "+291-#-###-###", cc: "ER", cd: "Eritrea", desc_en: "", name_ru: "Эритрея", desc_ru: "" }, { mask: "+34(###)###-###", cc: "ES", cd: "Spain", desc_en: "", name_ru: "Испания", desc_ru: "" }, { mask: "+251-##-###-####", cc: "ET", cd: "Ethiopia", desc_en: "", name_ru: "Эфиопия", desc_ru: "" }, { mask: "+358(###)###-##-##", cc: "FI", cd: "Finland", desc_en: "", name_ru: "Финляндия", desc_ru: "" }, { mask: "+679-##-#####", cc: "FJ", cd: "Fiji", desc_en: "", name_ru: "Фиджи", desc_ru: "" }, { mask: "+500-#####", cc: "FK", cd: "Falkland Islands", desc_en: "", name_ru: "Фолклендские острова", desc_ru: "" }, { mask: "+691-###-####", cc: "FM", cd: "F.S. Micronesia", desc_en: "", name_ru: "Ф.Ш. Микронезии", desc_ru: "" }, { mask: "+298-###-###", cc: "FO", cd: "Faroe Islands", desc_en: "", name_ru: "Фарерские острова", desc_ru: "" }, { mask: "+262-#####-####", cc: "FR", cd: "Mayotte", desc_en: "", name_ru: "Майотта", desc_ru: "" }, { mask: "+33(###)###-###", cc: "FR", cd: "France", desc_en: "", name_ru: "Франция", desc_ru: "" }, { mask: "+508-##-####", cc: "FR", cd: "St Pierre & Miquelon", desc_en: "", name_ru: "Сен-Пьер и Микелон", desc_ru: "" }, { mask: "+590(###)###-###", cc: "FR", cd: "Guadeloupe", desc_en: "", name_ru: "Гваделупа", desc_ru: "" }, { mask: "+241-#-##-##-##", cc: "GA", cd: "Gabon", desc_en: "", name_ru: "Габон", desc_ru: "" }, { mask: "+1(473)###-####", cc: "GD", cd: "Grenada", desc_en: "", name_ru: "Гренада", desc_ru: "" }, { mask: "+995(###)###-###", cc: "GE", cd: "Rep. of Georgia", desc_en: "", name_ru: "Грузия", desc_ru: "" }, { mask: "+594-#####-####", cc: "GF", cd: "Guiana (French)", desc_en: "", name_ru: "Фр. Гвиана", desc_ru: "" }, { mask: "+233(###)###-###", cc: "GH", cd: "Ghana", desc_en: "", name_ru: "Гана", desc_ru: "" }, { mask: "+350-###-#####", cc: "GI", cd: "Gibraltar", desc_en: "", name_ru: "Гибралтар", desc_ru: "" }, { mask: "+299-##-##-##", cc: "GL", cd: "Greenland", desc_en: "", name_ru: "Гренландия", desc_ru: "" }, { mask: "+220(###)##-##", cc: "GM", cd: "Gambia", desc_en: "", name_ru: "Гамбия", desc_ru: "" }, { mask: "+224-##-###-###", cc: "GN", cd: "Guinea", desc_en: "", name_ru: "Гвинея", desc_ru: "" }, { mask: "+240-##-###-####", cc: "GQ", cd: "Equatorial Guinea", desc_en: "", name_ru: "Экваториальная Гвинея", desc_ru: "" }, { mask: "+30(###)###-####", cc: "GR", cd: "Greece", desc_en: "", name_ru: "Греция", desc_ru: "" }, { mask: "+502-#-###-####", cc: "GT", cd: "Guatemala", desc_en: "", name_ru: "Гватемала", desc_ru: "" }, { mask: "+1(671)###-####", cc: "GU", cd: "Guam", desc_en: "", name_ru: "Гуам", desc_ru: "" }, { mask: "+245-#-######", cc: "GW", cd: "Guinea-Bissau", desc_en: "", name_ru: "Гвинея-Бисау", desc_ru: "" }, { mask: "+592-###-####", cc: "GY", cd: "Guyana", desc_en: "", name_ru: "Гайана", desc_ru: "" }, { mask: "+852-####-####", cc: "HK", cd: "Hong Kong", desc_en: "", name_ru: "Гонконг", desc_ru: "" }, { mask: "+504-####-####", cc: "HN", cd: "Honduras", desc_en: "", name_ru: "Гондурас", desc_ru: "" }, { mask: "+385-(##)-###-###", cc: "HR", cd: "Croatia", desc_en: "", name_ru: "Хорватия", desc_ru: "" }, { mask: "+385-(##)-###-####", cc: "HR", cd: "Croatia", desc_en: "", name_ru: "Хорватия", desc_ru: "" }, { mask: "+385-1-####-###", cc: "HR", cd: "Croatia", desc_en: "", name_ru: "Хорватия", desc_ru: "" }, { mask: "+509-##-##-####", cc: "HT", cd: "Haiti", desc_en: "", name_ru: "Гаити", desc_ru: "" }, { mask: "+36(###)###-###", cc: "HU", cd: "Hungary", desc_en: "", name_ru: "Венгрия", desc_ru: "" }, { mask: "+62(8##)###-####", cc: "ID", cd: "Indonesia ", desc_en: "mobile", name_ru: "Индонезия ", desc_ru: "мобильные" }, { mask: "+62-##-###-##", cc: "ID", cd: "Indonesia", desc_en: "", name_ru: "Индонезия", desc_ru: "" }, { mask: "+62-##-###-###", cc: "ID", cd: "Indonesia", desc_en: "", name_ru: "Индонезия", desc_ru: "" }, { mask: "+62-##-###-####", cc: "ID", cd: "Indonesia", desc_en: "", name_ru: "Индонезия", desc_ru: "" }, { mask: "+62(8##)###-###", cc: "ID", cd: "Indonesia ", desc_en: "mobile", name_ru: "Индонезия ", desc_ru: "мобильные" }, { mask: "+62(8##)###-##-###", cc: "ID", cd: "Indonesia ", desc_en: "mobile", name_ru: "Индонезия ", desc_ru: "мобильные" }, { mask: "+353(###)###-###", cc: "IE", cd: "Ireland", desc_en: "", name_ru: "Ирландия", desc_ru: "" }, { mask: "+972-5#-###-####", cc: "IL", cd: "Israel ", desc_en: "mobile", name_ru: "Израиль ", desc_ru: "мобильные" }, { mask: "+972-#-###-####", cc: "IL", cd: "Israel", desc_en: "", name_ru: "Израиль", desc_ru: "" }, { mask: "+91(####)###-###", cc: "IN", cd: "India", desc_en: "", name_ru: "Индия", desc_ru: "" }, { mask: "+246-###-####", cc: "IO", cd: "Diego Garcia", desc_en: "", name_ru: "Диего-Гарсия", desc_ru: "" }, { mask: "+964(###)###-####", cc: "IQ", cd: "Iraq", desc_en: "", name_ru: "Ирак", desc_ru: "" }, { mask: "+98(###)###-####", cc: "IR", cd: "Iran", desc_en: "", name_ru: "Иран", desc_ru: "" }, { mask: "+354-###-####", cc: "IS", cd: "Iceland", desc_en: "", name_ru: "Исландия", desc_ru: "" }, { mask: "+39(###)####-###", cc: "IT", cd: "Italy", desc_en: "", name_ru: "Италия", desc_ru: "" }, { mask: "+1(876)###-####", cc: "JM", cd: "Jamaica", desc_en: "", name_ru: "Ямайка", desc_ru: "" }, { mask: "+962-#-####-####", cc: "JO", cd: "Jordan", desc_en: "", name_ru: "Иордания", desc_ru: "" }, { mask: "+81-##-####-####", cc: "JP", cd: "Japan ", desc_en: "mobile", name_ru: "Япония ", desc_ru: "мобильные" }, { mask: "+81(###)###-###", cc: "JP", cd: "Japan", desc_en: "", name_ru: "Япония", desc_ru: "" }, { mask: "+254-###-######", cc: "KE", cd: "Kenya", desc_en: "", name_ru: "Кения", desc_ru: "" }, { mask: "+996(###)###-###", cc: "KG", cd: "Kyrgyzstan", desc_en: "", name_ru: "Киргизия", desc_ru: "" }, { mask: "+855-##-###-###", cc: "KH", cd: "Cambodia", desc_en: "", name_ru: "Камбоджа", desc_ru: "" }, { mask: "+686-##-###", cc: "KI", cd: "Kiribati", desc_en: "", name_ru: "Кирибати", desc_ru: "" }, { mask: "+269-##-#####", cc: "KM", cd: "Comoros", desc_en: "", name_ru: "Коморы", desc_ru: "" }, { mask: "+1(869)###-####", cc: "KN", cd: "Saint Kitts & Nevis", desc_en: "", name_ru: "Сент-Китс и Невис", desc_ru: "" }, { mask: "+850-191-###-####", cc: "KP", cd: "DPR Korea (North) ", desc_en: "mobile", name_ru: "Корейская НДР ", desc_ru: "мобильные" }, { mask: "+850-##-###-###", cc: "KP", cd: "DPR Korea (North)", desc_en: "", name_ru: "Корейская НДР", desc_ru: "" }, { mask: "+850-###-####-###", cc: "KP", cd: "DPR Korea (North)", desc_en: "", name_ru: "Корейская НДР", desc_ru: "" }, { mask: "+850-###-###", cc: "KP", cd: "DPR Korea (North)", desc_en: "", name_ru: "Корейская НДР", desc_ru: "" }, { mask: "+850-####-####", cc: "KP", cd: "DPR Korea (North)", desc_en: "", name_ru: "Корейская НДР", desc_ru: "" }, { mask: "+850-####-#############", cc: "KP", cd: "DPR Korea (North)", desc_en: "", name_ru: "Корейская НДР", desc_ru: "" }, { mask: "+82-##-###-####", cc: "KR", cd: "Korea (South)", desc_en: "", name_ru: "Респ. Корея", desc_ru: "" }, { mask: "+965-####-####", cc: "KW", cd: "Kuwait", desc_en: "", name_ru: "Кувейт", desc_ru: "" }, { mask: "+1(345)###-####", cc: "KY", cd: "Cayman Islands", desc_en: "", name_ru: "Каймановы острова", desc_ru: "" }, { mask: "+7(6##)###-##-##", cc: "KZ", cd: "Kazakhstan", desc_en: "", name_ru: "Казахстан", desc_ru: "" }, { mask: "+7(7##)###-##-##", cc: "KZ", cd: "Kazakhstan", desc_en: "", name_ru: "Казахстан", desc_ru: "" }, { mask: "+856(20##)###-###", cc: "LA", cd: "Laos ", desc_en: "mobile", name_ru: "Лаос ", desc_ru: "мобильные" }, { mask: "+856-##-###-###", cc: "LA", cd: "Laos", desc_en: "", name_ru: "Лаос", desc_ru: "" }, { mask: "+961-##-###-###", cc: "LB", cd: "Lebanon ", desc_en: "mobile", name_ru: "Ливан ", desc_ru: "мобильные" }, { mask: "+961-#-###-###", cc: "LB", cd: "Lebanon", desc_en: "", name_ru: "Ливан", desc_ru: "" }, { mask: "+1(758)###-####", cc: "LC", cd: "Saint Lucia", desc_en: "", name_ru: "Сент-Люсия", desc_ru: "" }, { mask: "+423(###)###-####", cc: "LI", cd: "Liechtenstein", desc_en: "", name_ru: "Лихтенштейн", desc_ru: "" }, { mask: "+94-##-###-####", cc: "LK", cd: "Sri Lanka", desc_en: "", name_ru: "Шри-Ланка", desc_ru: "" }, { mask: "+231-##-###-###", cc: "LR", cd: "Liberia", desc_en: "", name_ru: "Либерия", desc_ru: "" }, { mask: "+266-#-###-####", cc: "LS", cd: "Lesotho", desc_en: "", name_ru: "Лесото", desc_ru: "" }, { mask: "+370(###)##-###", cc: "LT", cd: "Lithuania", desc_en: "", name_ru: "Литва", desc_ru: "" }, { mask: "+352-###-###", cc: "LU", cd: "Luxembourg", desc_en: "", name_ru: "Люксембург", desc_ru: "" }, { mask: "+352-####-###", cc: "LU", cd: "Luxembourg", desc_en: "", name_ru: "Люксембург", desc_ru: "" }, { mask: "+352-#####-###", cc: "LU", cd: "Luxembourg", desc_en: "", name_ru: "Люксембург", desc_ru: "" }, { mask: "+352-######-###", cc: "LU", cd: "Luxembourg", desc_en: "", name_ru: "Люксембург", desc_ru: "" }, { mask: "+371-##-###-###", cc: "LV", cd: "Latvia", desc_en: "", name_ru: "Латвия", desc_ru: "" }, { mask: "+218-##-###-###", cc: "LY", cd: "Libya", desc_en: "", name_ru: "Ливия", desc_ru: "" }, { mask: "+218-21-###-####", cc: "LY", cd: "Libya", desc_en: "Tripoli", name_ru: "Ливия", desc_ru: "Триполи" }, { mask: "+212-##-####-###", cc: "MA", cd: "Morocco", desc_en: "", name_ru: "Марокко", desc_ru: "" }, { mask: "+377(###)###-###", cc: "MC", cd: "Monaco", desc_en: "", name_ru: "Монако", desc_ru: "" }, { mask: "+377-##-###-###", cc: "MC", cd: "Monaco", desc_en: "", name_ru: "Монако", desc_ru: "" }, { mask: "+373-####-####", cc: "MD", cd: "Moldova", desc_en: "", name_ru: "Молдова", desc_ru: "" }, { mask: "+382-##-###-###", cc: "ME", cd: "Montenegro", desc_en: "", name_ru: "Черногория", desc_ru: "" }, { mask: "+261-##-##-#####", cc: "MG", cd: "Madagascar", desc_en: "", name_ru: "Мадагаскар", desc_ru: "" }, { mask: "+692-###-####", cc: "MH", cd: "Marshall Islands", desc_en: "", name_ru: "Маршалловы Острова", desc_ru: "" }, { mask: "+389-##-###-###", cc: "MK", cd: "Republic of Macedonia", desc_en: "", name_ru: "Респ. Македония", desc_ru: "" }, { mask: "+223-##-##-####", cc: "ML", cd: "Mali", desc_en: "", name_ru: "Мали", desc_ru: "" }, { mask: "+95-##-###-###", cc: "MM", cd: "Burma (Myanmar)", desc_en: "", name_ru: "Бирма (Мьянма)", desc_ru: "" }, { mask: "+95-#-###-###", cc: "MM", cd: "Burma (Myanmar)", desc_en: "", name_ru: "Бирма (Мьянма)", desc_ru: "" }, { mask: "+95-###-###", cc: "MM", cd: "Burma (Myanmar)", desc_en: "", name_ru: "Бирма (Мьянма)", desc_ru: "" }, { mask: "+976-##-##-####", cc: "MN", cd: "Mongolia", desc_en: "", name_ru: "Монголия", desc_ru: "" }, { mask: "+853-####-####", cc: "MO", cd: "Macau", desc_en: "", name_ru: "Макао", desc_ru: "" }, { mask: "+1(670)###-####", cc: "MP", cd: "Northern Mariana Islands", desc_en: "", name_ru: "Северные Марианские острова Сайпан", desc_ru: "" }, { mask: "+596(###)##-##-##", cc: "MQ", cd: "Martinique", desc_en: "", name_ru: "Мартиника", desc_ru: "" }, { mask: "+222-##-##-####", cc: "MR", cd: "Mauritania", desc_en: "", name_ru: "Мавритания", desc_ru: "" }, { mask: "+1(664)###-####", cc: "MS", cd: "Montserrat", desc_en: "", name_ru: "Монтсеррат", desc_ru: "" }, { mask: "+356-####-####", cc: "MT", cd: "Malta", desc_en: "", name_ru: "Мальта", desc_ru: "" }, { mask: "+230-###-####", cc: "MU", cd: "Mauritius", desc_en: "", name_ru: "Маврикий", desc_ru: "" }, { mask: "+960-###-####", cc: "MV", cd: "Maldives", desc_en: "", name_ru: "Мальдивские острова", desc_ru: "" }, { mask: "+265-1-###-###", cc: "MW", cd: "Malawi", desc_en: "Telecom Ltd", name_ru: "Малави", desc_ru: "Telecom Ltd" }, { mask: "+265-#-####-####", cc: "MW", cd: "Malawi", desc_en: "", name_ru: "Малави", desc_ru: "" }, { mask: "+52(###)###-####", cc: "MX", cd: "Mexico", desc_en: "", name_ru: "Мексика", desc_ru: "" }, { mask: "+52-##-##-####", cc: "MX", cd: "Mexico", desc_en: "", name_ru: "Мексика", desc_ru: "" }, { mask: "+60-##-###-####", cc: "MY", cd: "Malaysia ", desc_en: "mobile", name_ru: "Малайзия ", desc_ru: "мобильные" }, { mask: "+60-11-####-####", cc: "MY", cd: "Malaysia ", desc_en: "mobile", name_ru: "Малайзия ", desc_ru: "мобильные" }, { mask: "+60(###)###-###", cc: "MY", cd: "Malaysia", desc_en: "", name_ru: "Малайзия", desc_ru: "" }, { mask: "+60-##-###-###", cc: "MY", cd: "Malaysia", desc_en: "", name_ru: "Малайзия", desc_ru: "" }, { mask: "+60-#-###-###", cc: "MY", cd: "Malaysia", desc_en: "", name_ru: "Малайзия", desc_ru: "" }, { mask: "+258-##-###-###", cc: "MZ", cd: "Mozambique", desc_en: "", name_ru: "Мозамбик", desc_ru: "" }, { mask: "+264-##-###-####", cc: "NA", cd: "Namibia", desc_en: "", name_ru: "Намибия", desc_ru: "" }, { mask: "+687-##-####", cc: "NC", cd: "New Caledonia", desc_en: "", name_ru: "Новая Каледония", desc_ru: "" }, { mask: "+227-##-##-####", cc: "NE", cd: "Niger", desc_en: "", name_ru: "Нигер", desc_ru: "" }, { mask: "+672-3##-###", cc: "NF", cd: "Norfolk Island", desc_en: "", name_ru: "Норфолк (остров)", desc_ru: "" }, { mask: "+234(###)###-####", cc: "NG", cd: "Nigeria", desc_en: "", name_ru: "Нигерия", desc_ru: "" }, { mask: "+234-##-###-###", cc: "NG", cd: "Nigeria", desc_en: "", name_ru: "Нигерия", desc_ru: "" }, { mask: "+234-##-###-##", cc: "NG", cd: "Nigeria", desc_en: "", name_ru: "Нигерия", desc_ru: "" }, { mask: "+234(###)###-####", cc: "NG", cd: "Nigeria ", desc_en: "mobile", name_ru: "Нигерия ", desc_ru: "мобильные" }, { mask: "+505-####-####", cc: "NI", cd: "Nicaragua", desc_en: "", name_ru: "Никарагуа", desc_ru: "" }, { mask: "+31-##-###-####", cc: "NL", cd: "Netherlands", desc_en: "", name_ru: "Нидерланды", desc_ru: "" }, { mask: "+47(###)##-###", cc: "NO", cd: "Norway", desc_en: "", name_ru: "Норвегия", desc_ru: "" }, { mask: "+977-##-###-###", cc: "NP", cd: "Nepal", desc_en: "", name_ru: "Непал", desc_ru: "" }, { mask: "+674-###-####", cc: "NR", cd: "Nauru", desc_en: "", name_ru: "Науру", desc_ru: "" }, { mask: "+683-####", cc: "NU", cd: "Niue", desc_en: "", name_ru: "Ниуэ", desc_ru: "" }, { mask: "+64(###)###-###", cc: "NZ", cd: "New Zealand", desc_en: "", name_ru: "Новая Зеландия", desc_ru: "" }, { mask: "+64-##-###-###", cc: "NZ", cd: "New Zealand", desc_en: "", name_ru: "Новая Зеландия", desc_ru: "" }, { mask: "+64(###)###-####", cc: "NZ", cd: "New Zealand", desc_en: "", name_ru: "Новая Зеландия", desc_ru: "" }, { mask: "+968-##-###-###", cc: "OM", cd: "Oman", desc_en: "", name_ru: "Оман", desc_ru: "" }, { mask: "+507-###-####", cc: "PA", cd: "Panama", desc_en: "", name_ru: "Панама", desc_ru: "" }, { mask: "+51(###)###-###", cc: "PE", cd: "Peru", desc_en: "", name_ru: "Перу", desc_ru: "" }, { mask: "+689-##-##-##", cc: "PF", cd: "French Polynesia", desc_en: "", name_ru: "Французская Полинезия (Таити)", desc_ru: "" }, { mask: "+675(###)##-###", cc: "PG", cd: "Papua New Guinea", desc_en: "", name_ru: "Папуа-Новая Гвинея", desc_ru: "" }, { mask: "+63(###)###-####", cc: "PH", cd: "Philippines", desc_en: "", name_ru: "Филиппины", desc_ru: "" }, { mask: "+92(###)###-####", cc: "PK", cd: "Pakistan", desc_en: "", name_ru: "Пакистан", desc_ru: "" }, { mask: "+48(###)###-###", cc: "PL", cd: "Poland", desc_en: "", name_ru: "Польша", desc_ru: "" }, { mask: "+970-##-###-####", cc: "PS", cd: "Palestine", desc_en: "", name_ru: "Палестина", desc_ru: "" }, { mask: "+351-##-###-####", cc: "PT", cd: "Portugal", desc_en: "", name_ru: "Португалия", desc_ru: "" }, { mask: "+680-###-####", cc: "PW", cd: "Palau", desc_en: "", name_ru: "Палау", desc_ru: "" }, { mask: "+595(###)###-###", cc: "PY", cd: "Paraguay", desc_en: "", name_ru: "Парагвай", desc_ru: "" }, { mask: "+974-####-####", cc: "QA", cd: "Qatar", desc_en: "", name_ru: "Катар", desc_ru: "" }, { mask: "+262-#####-####", cc: "RE", cd: "Reunion", desc_en: "", name_ru: "Реюньон", desc_ru: "" }, { mask: "+40-##-###-####", cc: "RO", cd: "Romania", desc_en: "", name_ru: "Румыния", desc_ru: "" }, { mask: "+381-##-###-####", cc: "RS", cd: "Serbia", desc_en: "", name_ru: "Сербия", desc_ru: "" }, { mask: "+7(###)###-##-##", cc: "RU", cd: "Russia", desc_en: "", name_ru: "Россия", desc_ru: "" }, { mask: "+250(###)###-###", cc: "RW", cd: "Rwanda", desc_en: "", name_ru: "Руанда", desc_ru: "" }, { mask: "+966-5-####-####", cc: "SA", cd: "Saudi Arabia ", desc_en: "mobile", name_ru: "Саудовская Аравия ", desc_ru: "мобильные" }, { mask: "+966-#-###-####", cc: "SA", cd: "Saudi Arabia", desc_en: "", name_ru: "Саудовская Аравия", desc_ru: "" }, { mask: "+677-###-####", cc: "SB", cd: "Solomon Islands ", desc_en: "mobile", name_ru: "Соломоновы Острова ", desc_ru: "мобильные" }, { mask: "+677-#####", cc: "SB", cd: "Solomon Islands", desc_en: "", name_ru: "Соломоновы Острова", desc_ru: "" }, { mask: "+248-#-###-###", cc: "SC", cd: "Seychelles", desc_en: "", name_ru: "Сейшелы", desc_ru: "" }, { mask: "+249-##-###-####", cc: "SD", cd: "Sudan", desc_en: "", name_ru: "Судан", desc_ru: "" }, { mask: "+46-##-###-####", cc: "SE", cd: "Sweden", desc_en: "", name_ru: "Швеция", desc_ru: "" }, { mask: "+65-####-####", cc: "SG", cd: "Singapore", desc_en: "", name_ru: "Сингапур", desc_ru: "" }, { mask: "+290-####", cc: "SH", cd: "Saint Helena", desc_en: "", name_ru: "Остров Святой Елены", desc_ru: "" }, { mask: "+290-####", cc: "SH", cd: "Tristan da Cunha", desc_en: "", name_ru: "Тристан-да-Кунья", desc_ru: "" }, { mask: "+386-##-###-###", cc: "SI", cd: "Slovenia", desc_en: "", name_ru: "Словения", desc_ru: "" }, { mask: "+421(###)###-###", cc: "SK", cd: "Slovakia", desc_en: "", name_ru: "Словакия", desc_ru: "" }, { mask: "+232-##-######", cc: "SL", cd: "Sierra Leone", desc_en: "", name_ru: "Сьерра-Леоне", desc_ru: "" }, { mask: "+378-####-######", cc: "SM", cd: "San Marino", desc_en: "", name_ru: "Сан-Марино", desc_ru: "" }, { mask: "+221-##-###-####", cc: "SN", cd: "Senegal", desc_en: "", name_ru: "Сенегал", desc_ru: "" }, { mask: "+252-##-###-###", cc: "SO", cd: "Somalia", desc_en: "", name_ru: "Сомали", desc_ru: "" }, { mask: "+252-#-###-###", cc: "SO", cd: "Somalia", desc_en: "", name_ru: "Сомали", desc_ru: "" }, { mask: "+252-#-###-###", cc: "SO", cd: "Somalia ", desc_en: "mobile", name_ru: "Сомали ", desc_ru: "мобильные" }, { mask: "+597-###-####", cc: "SR", cd: "Suriname ", desc_en: "mobile", name_ru: "Суринам ", desc_ru: "мобильные" }, { mask: "+597-###-###", cc: "SR", cd: "Suriname", desc_en: "", name_ru: "Суринам", desc_ru: "" }, { mask: "+211-##-###-####", cc: "SS", cd: "South Sudan", desc_en: "", name_ru: "Южный Судан", desc_ru: "" }, { mask: "+239-##-#####", cc: "ST", cd: "Sao Tome and Principe", desc_en: "", name_ru: "Сан-Томе и Принсипи", desc_ru: "" }, { mask: "+503-##-##-####", cc: "SV", cd: "El Salvador", desc_en: "", name_ru: "Сальвадор", desc_ru: "" }, { mask: "+1(721)###-####", cc: "SX", cd: "Sint Maarten", desc_en: "", name_ru: "Синт-Маартен", desc_ru: "" }, { mask: "+963-##-####-###", cc: "SY", cd: "Syrian Arab Republic", desc_en: "", name_ru: "Сирийская арабская республика", desc_ru: "" }, { mask: "+268-##-##-####", cc: "SZ", cd: "Swaziland", desc_en: "", name_ru: "Свазиленд", desc_ru: "" }, { mask: "+1(649)###-####", cc: "TC", cd: "Turks & Caicos", desc_en: "", name_ru: "Тёркс и Кайкос", desc_ru: "" }, { mask: "+235-##-##-##-##", cc: "TD", cd: "Chad", desc_en: "", name_ru: "Чад", desc_ru: "" }, { mask: "+228-##-###-###", cc: "TG", cd: "Togo", desc_en: "", name_ru: "Того", desc_ru: "" }, { mask: "+66-##-###-####", cc: "TH", cd: "Thailand ", desc_en: "mobile", name_ru: "Таиланд ", desc_ru: "мобильные" }, { mask: "+66-##-###-###", cc: "TH", cd: "Thailand", desc_en: "", name_ru: "Таиланд", desc_ru: "" }, { mask: "+992-##-###-####", cc: "TJ", cd: "Tajikistan", desc_en: "", name_ru: "Таджикистан", desc_ru: "" }, { mask: "+690-####", cc: "TK", cd: "Tokelau", desc_en: "", name_ru: "Токелау", desc_ru: "" }, { mask: "+670-###-####", cc: "TL", cd: "East Timor", desc_en: "", name_ru: "Восточный Тимор", desc_ru: "" }, { mask: "+670-77#-#####", cc: "TL", cd: "East Timor", desc_en: "Timor Telecom", name_ru: "Восточный Тимор", desc_ru: "Timor Telecom" }, { mask: "+670-78#-#####", cc: "TL", cd: "East Timor", desc_en: "Timor Telecom", name_ru: "Восточный Тимор", desc_ru: "Timor Telecom" }, { mask: "+993-#-###-####", cc: "TM", cd: "Turkmenistan", desc_en: "", name_ru: "Туркменистан", desc_ru: "" }, { mask: "+216-##-###-###", cc: "TN", cd: "Tunisia", desc_en: "", name_ru: "Тунис", desc_ru: "" }, { mask: "+676-#####", cc: "TO", cd: "Tonga", desc_en: "", name_ru: "Тонга", desc_ru: "" }, { mask: "+90(###)###-####", cc: "TR", cd: "Turkey", desc_en: "", name_ru: "Турция", desc_ru: "" }, { mask: "+1(868)###-####", cc: "TT", cd: "Trinidad & Tobago", desc_en: "", name_ru: "Тринидад и Тобаго", desc_ru: "" }, { mask: "+688-90####", cc: "TV", cd: "Tuvalu ", desc_en: "mobile", name_ru: "Тувалу ", desc_ru: "мобильные" }, { mask: "+688-2####", cc: "TV", cd: "Tuvalu", desc_en: "", name_ru: "Тувалу", desc_ru: "" }, { mask: "+886-#-####-####", cc: "TW", cd: "Taiwan", desc_en: "", name_ru: "Тайвань", desc_ru: "" }, { mask: "+886-####-####", cc: "TW", cd: "Taiwan", desc_en: "", name_ru: "Тайвань", desc_ru: "" }, { mask: "+255-##-###-####", cc: "TZ", cd: "Tanzania", desc_en: "", name_ru: "Танзания", desc_ru: "" }, { mask: "+380(##)###-##-##", cc: "UA", cd: "Ukraine", desc_en: "", name_ru: "Украина", desc_ru: "" }, { mask: "+256(###)###-###", cc: "UG", cd: "Uganda", desc_en: "", name_ru: "Уганда", desc_ru: "" }, { mask: "+44-##-####-####", cc: "UK", cd: "United Kingdom", desc_en: "", name_ru: "Великобритания", desc_ru: "" }, { mask: "+598-#-###-##-##", cc: "UY", cd: "Uruguay", desc_en: "", name_ru: "Уругвай", desc_ru: "" }, { mask: "+998-##-###-####", cc: "UZ", cd: "Uzbekistan", desc_en: "", name_ru: "Узбекистан", desc_ru: "" }, { mask: "+39-6-698-#####", cc: "VA", cd: "Vatican City", desc_en: "", name_ru: "Ватикан", desc_ru: "" }, { mask: "+1(784)###-####", cc: "VC", cd: "Saint Vincent & the Grenadines", desc_en: "", name_ru: "Сент-Винсент и Гренадины", desc_ru: "" }, { mask: "+58(###)###-####", cc: "VE", cd: "Venezuela", desc_en: "", name_ru: "Венесуэла", desc_ru: "" }, { mask: "+1(284)###-####", cc: "VG", cd: "British Virgin Islands", desc_en: "", name_ru: "Британские Виргинские острова", desc_ru: "" }, { mask: "+1(340)###-####", cc: "VI", cd: "US Virgin Islands", desc_en: "", name_ru: "Американские Виргинские острова", desc_ru: "" }, { mask: "+84-##-####-###", cc: "VN", cd: "Vietnam", desc_en: "", name_ru: "Вьетнам", desc_ru: "" }, { mask: "+84(###)####-###", cc: "VN", cd: "Vietnam", desc_en: "", name_ru: "Вьетнам", desc_ru: "" }, { mask: "+678-##-#####", cc: "VU", cd: "Vanuatu ", desc_en: "mobile", name_ru: "Вануату ", desc_ru: "мобильные" }, { mask: "+678-#####", cc: "VU", cd: "Vanuatu", desc_en: "", name_ru: "Вануату", desc_ru: "" }, { mask: "+681-##-####", cc: "WF", cd: "Wallis and Futuna", desc_en: "", name_ru: "Уоллис и Футуна", desc_ru: "" }, { mask: "+685-##-####", cc: "WS", cd: "Samoa", desc_en: "", name_ru: "Самоа", desc_ru: "" }, { mask: "+967-###-###-###", cc: "YE", cd: "Yemen ", desc_en: "mobile", name_ru: "Йемен ", desc_ru: "мобильные" }, { mask: "+967-#-###-###", cc: "YE", cd: "Yemen", desc_en: "", name_ru: "Йемен", desc_ru: "" }, { mask: "+967-##-###-###", cc: "YE", cd: "Yemen", desc_en: "", name_ru: "Йемен", desc_ru: "" }, { mask: "+27-##-###-####", cc: "ZA", cd: "South Africa", desc_en: "", name_ru: "Южно-Африканская Респ.", desc_ru: "" }, { mask: "+260-##-###-####", cc: "ZM", cd: "Zambia", desc_en: "", name_ru: "Замбия", desc_ru: "" }, { mask: "+263-#-######", cc: "ZW", cd: "Zimbabwe", desc_en: "", name_ru: "Зимбабве", desc_ru: "" }, { mask: "+1(###)###-####", cc: ["US", "CA"], cd: "USA and Canada", desc_en: "", name_ru: "США и Канада", desc_ru: "" }] } }), c;
});
(function ($, window, document) {
  var app = {
    init: function init() {
      app.initConfigs();
      log.init();

      debug("App Init");
      debug("app._settings", app._settings);

      app.loadSVGIcons();
      app.initScrollToButtons();
      app.initScrollMagic();

      dataVis.init();
      checkGDPR.init();
      checkPopup.init();

      smartOutline.init();
      mainNavigation.init();
      counter.init();
      scrim.init();
      sidenav.init();
      form.init();
      video.init();
      formValidator.init();
      careers.init();
      contact.init();
      astronaut.init();
      analytics.init();
      cookieBanner.init();
      scrollDepth.init();
      scrollAnimation.init();
      matchHeight.init();
      blogNav.init();
      accordion.init();
      actionBar.init();
      // arityCarousel.init();
      optIn.init();
    },
    initConfigs: function initConfigs() {
      app._settings = {};

      app._settings.baseUrl = app.getBaseUrl();
      app._settings.env = app.getEnv();
    },
    env: function env(_env) {
      if (_env) {
        if (Array.isArray(_env)) {
          return _env.indexOf(app.getEnv()) !== -1;
        } else {
          return app.getEnv() === _env;
        }
      }
      return app.getEnv();
    },
    getEnv: function getEnv() {
      if (app._settings.env) return app._settings.env;

      if (window.location.hostname.indexOf("localhost") !== -1) {
        return "development";
      }

      if (app.getBaseUrl().indexOf(".patterns.arity.vsadev.com") !== -1) {
        return "staging";
      }

      return "production";
    },
    getBaseUrl: function getBaseUrl() {
      if (app._settings.baseUrl) return app._settings.baseUrl;

      // Return empty if localhost for local development
      if (window.location.hostname === "localhost") {
        return window.location.origin;
      }

      // Return empty if localhost for local development
      if (window.location.hostname.indexOf(".patterns.arity.vsadev.com") !== -1) {
        return window.location.origin;
      }

      // Return empty if script is not loaded onpage
      var currentScript = $('script[src*="/js/arity.js"]');
      if (!currentScript.length) {
        var base = window.location.origin;
        var path = window.location.pathname;
        path = path.substr(1); // Strip first character, which should be slash
        path = path.substr(0, path.indexOf("/") + 1);
        base = base + "/" + path;
        base = base.substr(0, base.length - 1); // Strip last character, which should be slash
        return base;
      }

      var script = {};
      script.path = currentScript.attr("src");
      script.parent = script.path.substr(0, script.path.lastIndexOf("/") + 1); // Strip filename
      script.base = script.parent.replace(/([^\/]*\/)$/, "");
      script.base = script.base.substr(0, script.base.length - 1); // Strip last character, which should be slash

      return script.base;
    },
    initScrollToButtons: function initScrollToButtons() {
      // Scroll to form handler ---
      $(".scroll-to-form--", $(".ar-module")).on("click", function (e) {
        e.preventDefault();
        var target = "app__form__form";
        if ($(this).data("target")) {
          target = $(this).data("target");
        }
        app.scrollToForm(target);
      });

      $('a[href^="#"]', $(".ar-module")).on("click", function (e) {
        e.preventDefault();

        app.scrollToForm($(e.currentTarget).attr("href").replace("#", ""));
      });
    },
    initScrollMagic: function initScrollMagic() {
      window.controller = new ScrollMagic.Controller();
    },
    scrollToForm: function scrollToForm(target) {
      if (document.getElementById(target)) {
        var scrollOffset = scroll.options.scrollOffset;
        scroll.options.scrollOffset = 110;
        scroll.to("#" + target);
        scroll.options.scrollOffset = scrollOffset;
      }
    },
    loadSVGIcons: function loadSVGIcons() {
      var svg = app._settings.baseUrl + "/images/svg/sprite.svg";

      $.get(svg, function (data) {
        var div = document.createElement("div");
        div.className = "svg-sprite no-display";
        div.innerHTML = new XMLSerializer().serializeToString(data.documentElement);
        document.body.insertBefore(div, document.body.childNodes[0]);
      });
    }
  };

  window.app = app;

  document.documentElement.className = "js";

  /** Load Events */
  jQuery(document).ready(function () {
    return app.init();
  });
})(jQuery, window, document);