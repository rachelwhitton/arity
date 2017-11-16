/* global transitionEvent */

/** import external dependencies */
import $ from 'jquery';

export default {
  init() {
    debug('cookie-banner Init');

    this.rendered = false;
    this.closed = false;
    this.el = this.template();

    if(!this.hasAgreed()) {
      this.render();

      setTimeout(function() {
        this.open();
      }.bind(this), 300);
    }
  },
  render() {
    this.$el = $(this.el);
    $('body').append(this.$el);
    this.$close = $('.close', this.$el);

    this.eventListeners();
  },
  hasAgreed() {
    return false;
  },
  agree() {
    debug('cookie-banner agree:');
  },
  open() {
    debug('cookie-banner open: start');
    this.$el.removeClass('animate-out');
    this.$el.one(transitionEvent, function() {
      this.rendered = true;
      debug('cookie-banner open: finish');
      this.$el.addClass('active');
    }.bind(this));
  },
  close() {
    debug('cookie-banner close: start');
    this.$el.addClass('animate-out');
    this.$el.one(transitionEvent, function() {
      this.closed = true;
      debug('cookie-banner close: finish');
      this.remove();
    }.bind(this));
  },
  remove() {
    debug('cookie-banner remove:');
    this.$el.remove();
  },
  agreeAndClose() {
    debug('cookie-banner agreeAndClose:');
    this.agree();
    this.close();
  },
  template() {
    let baseUrl = window.location.origin;
    var html = '' +
'<div class="cookie-banner animate-out">' +
'  <div class="cookie-banner__close close" role="button">&#10006;</div>' +
'  <div class="cookie-banner__message">Arity.com uses cookies to improve your site experience. If you would like to know more, please read our <a href="' + baseUrl + '/privacy/">privacy policy</a>.</div>' +
'</div>';

return html;
  },
  eventListeners() {
    this.$close.on('click', this.onCloseTrigger.bind(this));
  },
  onCloseTrigger(evt) {
    evt.preventDefault();
    this.agreeAndClose();
  },
}
