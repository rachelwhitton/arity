/* global analytics */

/** import external dependencies */
import $ from 'jquery';
import cookieBanner from '../components/cookie-banner';

export default {
  init() {
    // JavaScript to be fired on the home page
  },
  finalize() {
    cookieBanner.init();

    /**
     * Analytics
     */

    $('.app__home__section#contact .address__marker').on('click', function() {
      analytics.globalEvent('event', 'Link', 'event_GoogleMaps', 'Google Maps Link');
    });

    $('.app__home__section .card').on('click', function(evt) {
      var title = $(evt.currentTarget).find('.card__title').text();
      analytics.globalEvent('event', 'Link', 'event_productcategory', title);
    });
  },
};
