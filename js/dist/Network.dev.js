"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Network =
/*#__PURE__*/
function () {
  function Network() {
    _classCallCheck(this, Network);

    this.status = 'online';
    window.addEventListener('online', this);
    window.addEventListener('offline', this);
  }

  _createClass(Network, [{
    key: "notifyObservers",
    value: function notifyObservers() {}
  }, {
    key: "handleEvent",
    value: function handleEvent(event) {
      if (event.type == 'online' && this.status != 'online') {
        this.status = 'online';
        $('#OfflineDisplay').fadeOut(300);
        $('#OnlineDisplay').fadeIn(300);
        window.setTimeout(function () {
          $('#OnlineDisplay').fadeOut(300);
        }, 2000);
      } else if (event.type == 'offline' && this.status != 'offline') {
        this.status = 'offline';
        $('#OfflineDisplay').fadeIn(300);
      }
    }
  }]);

  return Network;
}();