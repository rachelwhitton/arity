/** import external dependencies */
import $ from 'jquery';

export default {
  init() {
    var $siteContent = $('.site-content');
    $('.action-bar', $siteContent).last().attr('id', 'press');
  },
  finalize() {
  },
};
