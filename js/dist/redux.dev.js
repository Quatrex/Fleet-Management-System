"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Store =
/*#__PURE__*/
function () {
  function Store(type, networkManager) {
    var objId = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'RequestId';
    var sortColumn = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 'CreatedDate';

    _classCallCheck(this, Store);

    this.state = eval(type);
    this.observers = [];
    this.type = type;
    this.networkManager = networkManager;
    this.objId = objId;
    this.currentObj = {};
    this.searchObj = {
      keyword: '',
      searchColumn: 'All',
      sortColumn: sortColumn,
      order: 'DESC'
    };
    this.updated = false;
    this.lastQueryID = -1;
    this.checkForDuplicate = '';
    this.tempState = [];
    this.selectionObserver = {};
    this.notifySelectionSeparately = false;
    this.selectionSearch = false; //queriesToRun[0]=>SelectionSearch,queriesToRun[1]=>SelectionSearchLoadMore,queriesToRun[2]=>SearchObject,queriesToRun[3]=>LoadDataInRender,

    this.queriesToRun = [[], [], [], []];
  }

  _createClass(Store, [{
    key: "getObjIdType",
    value: function getObjIdType() {
      return this.objId;
    }
  }, {
    key: "getSearchObject",
    value: function getSearchObject() {
      return this.searchObj;
    }
  }, {
    key: "getType",
    value: function getType() {
      return this.type;
    }
  }, {
    key: "getObjectById",
    value: function getObjectById(id) {
      var _this = this;

      this.currentObj = this.state.find(function (obj) {
        return obj[_this.objId] == id;
      });

      if (!this.currentObj) {
        this.currentObj = this.tempState.find(function (obj) {
          return obj[_this.objId] == id;
        });
      }

      return this.currentObj;
    }
  }, {
    key: "getOffset",
    value: function getOffset() {
      return this.state.length;
    }
  }, {
    key: "processFailedRequest",
    value: function processFailedRequest(query, err) {
      console.log(this.lastQueryID);

      if (this.lastQueryID !== -1 && err == 'OFFLINE') {
        this.queriesToRun[this.lastQueryID] = query;
        this.lastQueryID = -1;
      } else if (this.lastQueryID != -1) {
        console.log('Do Nothing');
      } else if (this.lastQueryID == -1) {
        this.observers.forEach(function (observer) {
          return observer.finishLoadContent(0, 'OFFLINE');
        });
      }

      console.log(this.queriesToRun);
    }
  }, {
    key: "runConnectionAwaitingQueries",
    value: function runConnectionAwaitingQueries() {
      console.log(this.queriesToRun);

      for (var i = 0; i < 4; i++) {
        var query = this.queriesToRun[i];
        console.log(query);

        if (query.length > 0) {
          this.lastQueryID = i;
          Database.loadContent(query, this.processFailedRequest.bind(this));
          this.queriesToRun[i] = [];
        }
      }
    }
  }, {
    key: "searchAndSort",
    value: function searchAndSort(obj) {
      this.searchObj = _objectSpread({}, this.searchObj, {}, obj);
      var query = ["Load_".concat(this.type), 0, ActionCreator([this, this], 'DELETEALL&APPEND'), this.searchObj, {}];
      this.networkManager.updateStoreOrder(this);
      this.lastQueryID = 2;
      Database.loadContent(query, this.processFailedRequest.bind(this));
    }
  }, {
    key: "loadData",
    value: function loadData() {
      var trigger = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'render';
      var method = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'APPEND';

      if (!this.updated) {
        var query = ["Load_".concat(this.type), this.state.length, ActionCreator([this], method), this.searchObj, {}];
        this.lastQueryID = 3;
        this.networkManager.updateStoreOrder(this);
        Database.loadContent(query, this.processFailedRequest.bind(this));
        this.updated = true;
      } else {
        if (trigger != 'render') {
          if (method == 'UPDATE') {
            if (this.currentObj.NumOfAllocations > 0) {
              var _query = ["Load_".concat(this.type, "_assignedRequests"), 0, ActionCreator([this], method), this.searchObj, this.currentObj];
              this.lastQueryID = -1;
              this.networkManager.updateStoreOrder(this);
              Database.loadContent(_query, this.processFailedRequest.bind(this));
            }
          } else {
            var _query2 = ["Load_".concat(this.type), this.state.length, ActionCreator([this], method), this.searchObj, {}];
            this.networkManager.updateStoreOrder(this);

            if (trigger == 'selection') {
              this.lastQueryID = 2;
            } else {
              this.lastQueryID = -1;
            }

            Database.loadContent(_query2, this.processFailedRequest.bind(this));
          }
        }
      }
    }
  }, {
    key: "loadSelectedData",
    value: function loadSelectedData(id, observer) {
      this.selectionSearch = true;
      this.checkForDuplicate = id;
      this.selectionObserver = observer;
      var query = ["Load_".concat(this.type), 0, ActionCreator([this], 'ADD'), {
        keyword: id,
        searchColumn: 'RegistrationNo',
        sortColumn: 'RegistrationNo',
        order: 'DESC'
      }, {}];
      this.lastQueryID = 0;
      this.networkManager.updateStoreOrder(this);
      Database.loadContent(query, this.processFailedRequest.bind(this));
      setTimeout(this.loadData('selection'), 3000);
    }
  }, {
    key: "dispatch",
    value: function dispatch(action) {
      var _this2 = this;

      console.log(action.type);
      var selectionPayload = [];
      console.log(action.payload);

      if (action.type === 'ADD' || action.type === 'APPEND') {
        if (!Array.isArray(action.payload)) {
          if (Object.keys(action.payload).length != 0) {
            action.payload = [action.payload];
          } else {
            action.payload = [];
          }
        }

        if (action.payload.length > 0) {
          if (this.checkForDuplicate != '') {
            if (this.selectionSearch && action.type == 'ADD') {
              this.tempState = [].concat(_toConsumableArray(this.tempState), _toConsumableArray(action.payload));
            } else {
              selectionPayload = action.payload.filter(function (obj) {
                return obj[_this2.objId] != _this2.checkForDuplicate;
              });

              if (action.payload.length - selectionPayload.length > 0) {
                this.notifySelectionSeparately = true;
                this.checkForDuplicate = '';
                this.tempState = [];
              }

              this.state = [].concat(_toConsumableArray(this.state), _toConsumableArray(action.payload));
            }
          } else {
            action.type === 'ADD' ? this.state = [].concat(_toConsumableArray(action.payload), _toConsumableArray(this.state)) : this.state = [].concat(_toConsumableArray(this.state), _toConsumableArray(action.payload));
          }
        }
      } else if (action.type === 'UPDATE') {
        this.state = this.state.map(function (item) {
          return _this2.currentObj === item ? _objectSpread({}, item, {}, action.payload) : item;
        });
      } else if (action.type === 'DELETE') {
        this.state = this.state.filter(function (item) {
          return _this2.currentObj !== item;
        });
      } else if (action.type === 'DELETEALL') {
        this.state = [];
      }

      if (this.selectionSearch && action.type == 'ADD') {
        this.selectionObserver.update(action);
        this.selectionSearch = false;
      } else if (this.notifySelectionSeparately) {
        this.selectionObserver.update({
          type: action.type,
          payload: selectionPayload
        });
        this.notifyObservers(action);
      } else {
        this.notifyObservers(action);
      }
    }
  }, {
    key: "addObservers",
    value: function addObservers(observer) {
      this.observers.push(observer);
    }
  }, {
    key: "notifyObservers",
    value: function notifyObservers(update) {
      var _this3 = this;

      if (this.notifySelectionSeparately) {
        var tempObservers = this.observers.filter(function (observer) {
          return observer != _this3.selectionObserver;
        });
        tempObservers.forEach(function (observer) {
          return observer.update(update);
        });
        this.notifySelectionSeparately = false;
        this.selectionObserver = {};
      } else {
        this.observers.forEach(function (observer) {
          return observer.update(update);
        });
      }
    }
  }]);

  return Store;
}();

var NetworkManager =
/*#__PURE__*/
function () {
  function NetworkManager() {
    _classCallCheck(this, NetworkManager);

    this.status = 'online';
    window.addEventListener('online', this);
    window.addEventListener('offline', this);
    this.storesOrder = [];
  }

  _createClass(NetworkManager, [{
    key: "updateStoreOrder",
    value: function updateStoreOrder(obj) {
      this.storesOrder = this.storesOrder.filter(function (store) {
        return store !== obj;
      });
      this.storesOrder = [obj].concat(_toConsumableArray(this.storesOrder));
    }
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
        this.notifyStores();
      } else if (event.type == 'offline' && this.status != 'offline') {
        this.status = 'offline';
        $('#OfflineDisplay').fadeIn(300);
      }
    }
  }, {
    key: "notifyStores",
    value: function notifyStores() {
      this.storesOrder.forEach(function (store) {
        return store.runConnectionAwaitingQueries();
      });
    }
  }]);

  return NetworkManager;
}();

var ActionCreator = function ActionCreator(stores, actionType) {
  return {
    type: actionType,
    stores: stores,
    updateStores: function updateStores(currentObj, returnedObj) {
      var types = actionType.split('&');

      if (types.length == 1) {
        var actionObj = {
          type: actionType
        };
        actionType == 'ADD' || actionType == 'APPEND' || actionType == 'UPDATE' ? stores[0].dispatch(_objectSpread({}, actionObj, {
          payload: returnedObj
        })) : stores[0].dispatch(_objectSpread({}, actionObj, {
          payload: currentObj
        }));
      } else if (types.length > 1) {
        for (var i = 0; i < stores.length; i++) {
          var _actionObj = {
            type: types[i]
          };
          types[i] == 'DELETEALL' || types[i] == 'APPEND' ? stores[i].dispatch(_objectSpread({}, _actionObj, {
            payload: returnedObj
          })) : stores[i].dispatch({
            type: types[i],
            payload: currentObj
          });
        }
      }
    }
  };
};