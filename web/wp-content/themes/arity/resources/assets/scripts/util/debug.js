// debug
export default {
  init() {
    window.debug = function() {
      if(!this.shouldDebug()) {
        return function() {};
      }
      var context = "%cdebug:";
      return Function.prototype.bind.call(console.log, console, context, 'color:blue');
    }.bind(this)();
  },
  shouldDebug: () => {
    if(localStorage.getItem("debug")) {
      return localStorage.getItem("debug");
    }

    return false;
  },
}
