/** global helper methods */
const methods = {
  getWindowWidth: function() {
    return Math.max(document.documentElement.clientWidth, window.innerWidth || 0);  
  },
  getWindowHeight: function() {
    return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);  
  },
}
module.exports = methods;