/** import external dependencies */
import $ from 'jquery';

export default {
  init() {
    var $siteContent = $('.site-content');
    $('.icon-two-column', $siteContent).first().attr('id', 'features');
    $('.accordion-wrapper', $siteContent).first().attr('id', 'faq');
    $('.action-bar-one-col-cta', $siteContent).first().attr('id', 'support');
  },
  finalize() {
  },
};
