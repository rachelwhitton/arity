/* global analytics */

/** import external dependencies */
import $ from 'jquery';

export default {
  init() {

  },
  finalize() {

    /**
     * Site Header Analytics
     */

    $('.site-header a[rel="home"]').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_headerID', 'Header Logo');
    });

    /**
     * Site Footer Analytics
     */

    $('.site-footer a[rel="home"]').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_footerID', 'Footer Logo');
    });

    $('.site-footer a[href*="mailto"]').on('click', function() {
      analytics.globalEvent('event', 'MailTo', 'event_footerPressMailto', 'Footer Press Mailto');
    });

    $('.site-footer a[href*="/privacy"]').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_footerPrivacyPolicy', 'Footer Privacy Policy');
    });

    $('.site-footer a[href*="//developer.arity.com"]').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_footerDevPortal', 'Footer Developer Portal');
    });

    $('.site-footer .social-nav__list a').each(function(i, el) {
      var $el = $(el);

      $el.on('click', function(evt) {
        var label = $(evt.currentTarget).attr('aria-label') || "";
        analytics.globalEvent('event', 'Link', 'event_footer' + label, 'Footer ' + label);
      });
    });

    /**
     * Content Container Analytics
     */

    $('.site-content a[href*="//developer.arity.com"]').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_DevPortal', 'Developer Portal Link');
    });

    $('.site-content a[href*="instagram.com"]').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_Instagram', 'Careers Instagram Link');
    });

    $('.site-content a[href*="shared-mobility.allstate.com"]').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_DashboardLogin', 'Dashboard Login');
    });
  },
};
