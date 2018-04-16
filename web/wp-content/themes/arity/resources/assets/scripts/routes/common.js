/* global analytics */

/** import external dependencies */
import $ from 'jquery';

export default {
  init() {

  },
  finalize() {

    /**
     * Site Footer Analytics
     */

     /**
      * NOTE Analytics have been moved to GTM
      */

    // $('.site-footer a[rel="home"]').on('click', function() {
    //   analytics.globalEvent('event', 'Link', 'event_footerID', 'Footer Logo');
    // });

    // $('.site-footer a[href*="mailto"]').on('click', function() {
    //   analytics.globalEvent('event', 'MailTo', 'event_footerPressMailto', 'Footer Press Mailto');
    // });

    // $('.site-footer a[href*="/privacy"]').on('click', function() {
    //   analytics.globalEvent('event', 'Link', 'event_footerPrivacyPolicy', 'Footer Privacy Policy');
    // });

    // $('.site-footer a[href*="//developer.arity.com"]').on('click', function() {
    //   analytics.globalEvent('event', 'Link', 'event_footerDevPortal', 'Footer Developer Portal');
    // });

    // $('.site-footer .social-nav__list a').each(function(i, el) {
    //   var $el = $(el);
    //
    //   $el.on('click', function(evt) {
    //     var label = $(evt.currentTarget).attr('aria-label') || "";
    //     analytics.globalEvent('event', 'Link', 'event_footer' + label, 'Footer ' + label);
    //   });
    // });

    /**
     * Content Container Analytics
     */

    // $('.site-content a[href*="//developer.arity.com"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'Developer Portal clickthrough');
    // });
    //
    // $('.site-content a[href*="instagram.com"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'Careers Instagram clickthrough');
    // });
    //
    // $('.site-content a[href*="google.com/maps"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'Google Maps clickthrough');
    // });
    //
    // $('.site-content a[href*="shared-mobility.allstate.com"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'Dashboard Login clickthrough');
    // });
    //
    // $('.site-content a[href*="adtrk.tw/7nKLw"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'San Francisco Ordinance clickthrough');
    // });
    //
    // $('.site-content a[href*="bca.lacity.org"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'Los Angeles Ordinance clickthrough');
    // });
    //
    // $('.site-content a[href*="los-angeles-ordinance.pdf"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'Los Angeles Ordinance clickthrough');
    // });
    //
    // $('.site-content a[href*="iottechexpo.com"]').on('click', function() {
    //   analytics.globalEvent('event', 'Body - Link', 'event_ClickedLink', 'Events Pill - 2017 IoT Expo Link clickthrough');
    // });
  },
};
