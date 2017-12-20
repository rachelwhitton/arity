/** import external dependencies */
import $ from 'jquery';

export default {
  init() {
    var $siteContent = $('.site-content');
    $('.action-bar', $siteContent).last().attr('id', 'press');

    $('.hero-b', $siteContent).find('.hero-block__right-col').wrapInner('<div class="align-vertical-middle"></div>');
  },
  finalize() {
  },
};
