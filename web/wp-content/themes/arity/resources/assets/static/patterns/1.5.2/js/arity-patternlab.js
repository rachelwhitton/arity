;(function($, window, document) {


  // Add environment class for dev or localhost
  var winHost = window.location.hostname;
  var winPrefix = winHost.substring(0, winHost.indexOf('.'));

  if (winHost === "localhost" || winPrefix === "dev") {
    $('body').addClass('env--development');
  }
})(jQuery, window, document);
