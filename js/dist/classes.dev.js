"use strict";

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var DOMButton =
/*#__PURE__*/
function () {
  function DOMButton(id, popup) {
    _classCallCheck(this, DOMButton);

    this.id = id;
    this.popup = popup;
    document.getElementById(id).addEventListener('click', this);
  }

  _createClass(DOMButton, [{
    key: "handleEvent",
    value: function handleEvent(event) {
      var targetObject = {};
      this.popup.render(targetObject);
    }
  }]);

  return DOMButton;
}();

var MainTab =
/*#__PURE__*/
function () {
  function MainTab(id, mainTabButtons, defaultButton) {
    _classCallCheck(this, MainTab);

    this.id = id;
    this.mainTabButtons = mainTabButtons;
    this.defaultButton = defaultButton;
    this.activeButton = defaultButton;
    this.defaultButton.renderContent();
    document.getElementById(id).addEventListener('click', this);
  }

  _createClass(MainTab, [{
    key: "handleEvent",
    value: function handleEvent(event) {
      if (event.type == 'click') {
        var targetButton = this.mainTabButtons.find(function (button) {
          return button.id == event.target.closest('li').id;
        });

        if (targetButton != null) {
          if (targetButton.id != this.activeButton.id) {
            targetButton.renderContent();
            this.activeButton.removeFromDOM();
            this.activeButton = targetButton;
          }
        }
      }
    }
  }]);

  return MainTab;
}();

var MainTabButton =
/*#__PURE__*/
function () {
  function MainTabButton(id, containerId, secTab) {
    _classCallCheck(this, MainTabButton);

    this.secTab = secTab;
    this.containerId = containerId;
    this.id = id;
    document.getElementById(id).addEventListener('click', this);
  }

  _createClass(MainTabButton, [{
    key: "removeFromDOM",
    value: function removeFromDOM() {
      document.getElementById(this.containerId).classList.remove('active', 'show');
      document.getElementById(this.id).classList.remove('active');
      this.secTab.removeFromDOM();
    }
  }, {
    key: "renderContent",
    value: function renderContent() {
      document.getElementById(this.containerId).classList.add('active', 'show');
      document.getElementById(this.id).classList.add('active');
      this.secTab.render();
    }
  }]);

  return MainTabButton;
}();

var SecondaryTab =
/*#__PURE__*/
function () {
  function SecondaryTab(id, buttons, defaultButton) {
    _classCallCheck(this, SecondaryTab);

    this.id = id;
    this.buttons = buttons;
    this.defaultButton = defaultButton;
    this.activeButton = defaultButton;
  }

  _createClass(SecondaryTab, [{
    key: "render",
    value: function render() {
      document.getElementById(this.id).addEventListener('click', this);
      this.defaultButton.renderContent();
    }
  }, {
    key: "removeFromDOM",
    value: function removeFromDOM() {
      document.getElementById(this.id).removeEventListener('click', this);
      this.activeButton.removeFromDOM();
    }
  }, {
    key: "handleEvent",
    value: function handleEvent(event) {
      if (event.type == 'click') {
        var targetButton = this.buttons.find(function (button) {
          return button.id == event.target.id;
        });

        if (targetButton != null) {
          if (targetButton.id != this.activeButton.id) {
            this.activeButton.removeFromDOM();
            targetButton.renderContent();
            this.activeButton = targetButton;
          }
        }
      }
    }
  }]);

  return SecondaryTab;
}();

var SecondaryTabButton =
/*#__PURE__*/
function () {
  function SecondaryTabButton(id, tab) {
    _classCallCheck(this, SecondaryTabButton);

    this.id = id;
    this.tab = tab;
  }

  _createClass(SecondaryTabButton, [{
    key: "renderContent",
    value: function renderContent() {
      document.getElementById(this.id).classList.add('active');
      this.tab.render();
    }
  }, {
    key: "removeFromDOM",
    value: function removeFromDOM() {
      document.getElementById(this.id).classList.remove('active');
      this.tab.removeFromDOM();
    }
  }]);

  return SecondaryTabButton;
}();

var DOMTabContainer =
/*#__PURE__*/
function () {
  function DOMTabContainer(id) {
    var contentContainer = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    _classCallCheck(this, DOMTabContainer);

    this.id = id;
    this.contentContainer = contentContainer;
  }

  _createClass(DOMTabContainer, [{
    key: "render",
    value: function render() {
      document.getElementById(this.id).classList.add('active', 'show');
      this.contentContainer.render();
    }
  }, {
    key: "removeFromDOM",
    value: function removeFromDOM() {
      document.getElementById(this.id).classList.remove('active', 'show');
    }
  }]);

  return DOMTabContainer;
}();

var DOMContainer =
/*#__PURE__*/
function () {
  function DOMContainer(id, popup, store, templateId) {
    _classCallCheck(this, DOMContainer);

    this.id = id;
    this.cardId = this.id.substring(id.length - 9) == 'Container' ? id.substring(0, id.length - 9) + 'Card' : id;
    this.popup = popup;
    this.cardContainer = document.getElementById(id);
    this.store = store;
    this.templateId = templateId;
    this.searchButtonID = ['Search_Confirm', 'Cancel_Confirm', 'Sort_Confirm', 'Asc', 'Desc'];
    this.searchObj = this.store.getSearchObject();
    this.searchInput = document.getElementById("".concat(this.id, "_SearchInput"));
    this.loadMoreButton = document.getElementById("".concat(this.id, "_LoadMore"));
    this.ascButton = document.getElementById("Asc_".concat(this.id));
    this.descButton = document.getElementById("Desc_".concat(this.id));
    this.cancelSearchButton = this.cardContainer.querySelector('.form-clear');
    document.getElementById(id).addEventListener('click', this);
    document.getElementById(id).addEventListener('change', this);
    document.getElementById(id).addEventListener('keyup', this);
  }

  _createClass(DOMContainer, [{
    key: "render",
    value: function render() {
      this.loadContent();
    }
  }, {
    key: "update",
    value: function update(action) {
      var _this = this;

      if (action.type == 'ADD') {
        this.finishLoadContent(action.payload.length, action.type);
        action.payload.forEach(function (object) {
          return _this.insertEntry(object);
        });
      } else if (action.type == 'DELETE') {
        this.deleteEntry(action.payload);
      } else if (action.type == 'DELETEALL') {
        this.deleteAllEntries();
      } else if (action.type == 'UPDATE') {
        this.updateEntry(action.payload);
      } else if (action.type == 'APPEND') {
        action.payload.forEach(function (object) {
          return _this.appendEntry(object);
        });
        this.finishLoadContent(action.payload.length);
      }
    }
  }, {
    key: "finishLoadContent",
    value: function finishLoadContent(len) {
      var method = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'APPEND';

      if (method == 'APPEND') {
        if (this.loadMoreButton.classList.contains('active')) {
          this.loadMoreButton.classList.remove('active');
        }

        if (len < 5) {
          if (!this.loadMoreButton.classList.contains('d-none')) {
            this.loadMoreButton.classList.add('d-none');
          }

          if (len == 0) {
            if (this.store.getOffset() == 0) {
              var template = document.querySelector("#emptyPlaceholder");
              var clone = template.content.cloneNode(true);
              this.cardContainer.querySelector('.card-body').insertBefore(clone, this.cardContainer.querySelector('.card-body').firstChild);
              this.cardContainer.querySelector('.card-body').firstElementChild.id = "".concat(this.cardId, "_emptyPlaceholder");
            }
          }
        } else {
          if (this.loadMoreButton.classList.contains('d-none')) {
            this.loadMoreButton.classList.remove('d-none');
          }
        }
      } else {
        if (this.cardContainer.getElementById("".concat(this.cardId, "_emptyPlaceholder")) && this.store.getOffset() > 0) {
          document.getElementById("".concat(this.cardId, "_emptyPlaceholder")).remove();
        }
      }
    }
  }, {
    key: "loadContent",
    value: function loadContent() {
      var trigger = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'render';
      var method = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'APPEND';

      if (trigger != 'render') {
        if (!this.loadMoreButton.classList.contains('active')) {
          if (method == 'APPEND') {
            this.loadMoreButton.classList.add('active');
          }

          this.store.loadData(trigger, method);
        }
      } else {
        this.store.loadData(trigger);
      }
    }
  }, {
    key: "handleEvent",
    value: function handleEvent(event) {
      if (event.type == 'click' && (event.target.id || event.target.closest('.searchTabButton') || event.target.closest('.detail-description'))) {
        var method = 'NULL';

        for (var i = 0; i < this.searchButtonID.length; i++) {
          if (event.target.closest('.searchTabButton')) {
            if (event.target.closest('.searchTabButton').id.includes(this.searchButtonID[i])) {
              method = this.searchButtonID[i].split('_')[0].toUpperCase();
            }
          }
        }

        if (method != 'NULL') {
          switch (method) {
            case 'SEARCH':
              this.searchObj.keyword = this.searchInput.value;
              break;

            case 'CANCEL':
              if (this.searchInput.value.length > 0) {
                this.searchInput.value = '';
                this.searchObj.keyword != '' ? this.searchObj.keyword = '' : method = 'NONE';
              } else {
                method = 'NONE';
              }

              this.cancelSearchButton.classList.add('d-none');
              break;

            case 'DESC':
              if (this.searchObj.order != 'DESC') {
                this.searchObj.order = 'DESC';
                this.descButton.classList.add('selected-sort');
                this.ascButton.classList.remove('selected-sort');
                method = 'SORT';
              } else {
                method = 'NONE';
              }

              break;

            case 'ASC':
              if (this.searchObj.order != 'ASC') {
                this.searchObj.order = 'ASC';
                this.ascButton.classList.add('selected-sort');
                this.descButton.classList.remove('selected-sort');
                method = 'SORT';
              } else {
                method = 'NONE';
              }

              break;
          }

          this.store.searchAndSort(method, this.searchObj);
        } else {
          if (event.target.tagName.toLowerCase() != 'input' && event.target.tagName.toLowerCase() != 'select') {
            if (event.target.id) {
              if (event.target.id == "".concat(this.id, "_LoadMore")) {
                this.loadContent('click');
              }
            } else if (event.target.closest('.detail-description')) {
              var targetObject = this.store.getObjectById(event.target.closest('.detail-description').id.split('_')[1]);

              if (targetObject) {
                this.popup.render(targetObject);
              }
            }
          }
        }
      } else if (event.type == 'change') {
        var eventTarget = event.target;

        if (event.target.tagName.toLowerCase() == 'select') {
          var _method = event.target.dataset.field.toUpperCase(); //Select_Search/Sort_containerid


          if (this.searchObj[eventTarget.name]) {
            this.searchObj[eventTarget.name] = eventTarget.value;
            this.store.searchAndSort(_method, this.searchObj);
          }
        }
      } else if (event.type == 'keyup') {
        if (this.searchInput.value.length == 0) {
          if (!this.cancelSearchButton.classList.contains('d-none')) {
            this.cancelSearchButton.classList.add('d-none');
          }
        } else {
          this.cancelSearchButton.classList.remove('d-none');
        }
      }
    }
  }, {
    key: "assignStateColor",
    value: function assignStateColor(id) {
      if (this.store.getObjIdType() == 'RequestId') {
        var element = document.getElementById(id);
        var stateField = element.getElementsByClassName('Status');

        switch (stateField.innerHTML) {
          case 'Justified':
            stateField.color = 'darkorange';
            break;

          case 'Approved':
            stateField.color = 'green';
            break;

          case 'Denied':
            stateField.color = 'red';
            break;

          case 'Disapproved':
            stateField.color = 'red';
            break;

          case 'Completed':
            stateField.color = 'blue';
            break;

          default:
            stateField.color = 'rgba(95,99,104,0.9)';
            break;
        }
      }
    }
  }, {
    key: "insertEntry",
    value: function insertEntry(object) {
      var template = document.querySelector("#".concat(this.templateId));
      var clone = template.content.cloneNode(true);
      var objFields = Object.getOwnPropertyNames(object);
      objFields.forEach(function (field) {
        if (clone.querySelector(".".concat(field))) {
          if (field.includes('PicturePath')) {
            var path = '';
            field.includes('Vehicle') ? path = 'vehicle' : path = 'profile';
            object[field] != '' ? clone.querySelector(".".concat(field)).src = "../images/".concat(path, "Pictures/").concat(object[field]) : clone.querySelector(".".concat(field)).src = "../images/".concat(path, "Pictures/default-").concat(path, ".png");
          } else {
            clone.querySelector(".".concat(field)).innerHTML += " ".concat(object[field]);
          }
        }
      });
      this.cardContainer.querySelector('.card-body').insertBefore(clone, this.cardContainer.querySelector('.card-body').firstChild);
      this.cardContainer.querySelector('.card-body').firstElementChild.id = "".concat(this.cardId, "_").concat(object[this.store.getObjIdType()]);
      this.assignStateColor("".concat(this.cardId, "_").concat(object[this.store.getObjIdType()]));
    }
  }, {
    key: "appendEntry",
    value: function appendEntry(object) {
      var template = document.querySelector("#".concat(this.templateId));
      var clone = template.content.cloneNode(true);
      var objFields = Object.getOwnPropertyNames(object);
      objFields.forEach(function (field) {
        if (clone.querySelector(".".concat(field))) {
          if (field.includes('PicturePath')) {
            var path = '';
            field.includes('Vehicle') ? path = 'vehicle' : path = 'profile';
            object[field] != '' ? clone.querySelector(".".concat(field)).src = "../images/".concat(path, "Pictures/").concat(object[field]) : clone.querySelector(".".concat(field)).src = "../images/".concat(path, "Pictures/default-").concat(path, ".png");
          } else {
            clone.querySelector(".".concat(field)).innerHTML += " ".concat(object[field]);
          }
        }
      });
      this.cardContainer.querySelector('.card-body').appendChild(clone);
      this.cardContainer.querySelector('.card-body').lastElementChild.id = "".concat(this.cardId, "_").concat(object[this.store.getObjIdType()]);
      this.assignStateColor("".concat(this.cardId, "_").concat(object[this.store.getObjIdType()]));
    }
  }, {
    key: "deleteEntry",
    value: function deleteEntry(object) {
      var entry = document.getElementById("".concat(this.cardId, "_").concat(object[this.store.getObjIdType()])); // entry.classList.add('animate');

      if (entry != 'undefined' && entry != null) {
        this.cardContainer.querySelector('.card-body').removeChild(entry);
      }
    }
  }, {
    key: "deleteAllEntries",
    value: function deleteAllEntries() {
      var children = this.cardContainer.querySelectorAll('.detail-description');
      children.forEach(function (child) {
        // child.style.opacity = '0';
        child.remove();
      });
    }
  }, {
    key: "updateEntry",
    value: function updateEntry(object) {
      var entry = document.getElementById("".concat(this.cardId, "_").concat(object[this.store.getObjIdType()]));

      if (entry != 'undefined' && entry != null) {
        var objFields = Object.getOwnPropertyNames(object);
        objFields.forEach(function (field) {
          if (entry.querySelector(".".concat(field))) {
            if (field.includes('PicturePath')) {
              var path = '';
              field.includes('Vehicle') ? path = 'vehicle' : path = 'profile';
              object[field] != '' ? entry.querySelector(".".concat(field)).src = "../images/".concat(path, "Pictures/").concat(object[field]) : entry.querySelector(".".concat(field)).src = "../images/".concat(path, "Pictures/default-").concat(path, ".png");
            } else {
              entry.querySelector(".".concat(field)).innerHTML = object[field];
            }
          }
        });
        this.assignStateColor("".concat(this.cardId, "_").concat(object[this.store.getObjIdType()]));
      } else {
        this.insertEntry(object);
      }
    }
  }]);

  return DOMContainer;
}();

var SelectionTable =
/*#__PURE__*/
function (_DOMContainer) {
  _inherits(SelectionTable, _DOMContainer);

  function SelectionTable(id, popup, store, templateId, button, selectField) {
    var _this2;

    var nextField = arguments.length > 6 && arguments[6] !== undefined ? arguments[6] : '';
    var nextFieldId = arguments.length > 7 && arguments[7] !== undefined ? arguments[7] : '';

    _classCallCheck(this, SelectionTable);

    _this2 = _possibleConstructorReturn(this, _getPrototypeOf(SelectionTable).call(this, id, popup, store, templateId));
    _this2.selectField = selectField;
    _this2.button = button;

    _this2.cardContainer.removeEventListener('click', _assertThisInitialized(_this2));

    _this2.style = 'selected';
    _this2.nextField = nextField;
    _this2.nextFieldId = nextFieldId;
    return _this2;
  }

  _createClass(SelectionTable, [{
    key: "getId",
    value: function getId() {
      return this.id;
    }
  }, {
    key: "update",
    value: function update(action) {
      var _this3 = this;

      if (action.type == 'ADD') {
        _get(_getPrototypeOf(SelectionTable.prototype), "insertEntry", this).call(this, action.payload[0]);

        this.toggleStyle("".concat(this.id, "_").concat(action.payload[0][this.store.getObjIdType()]));
      } else if (action.type == 'DELETE') {
        _get(_getPrototypeOf(SelectionTable.prototype), "deleteEntry", this).call(this, action.payload);
      } else if (action.type == 'DELETEALL') {
        _get(_getPrototypeOf(SelectionTable.prototype), "deleteAllEntries", this).call(this);
      } else if (action.type == 'UPDATE') {
        _get(_getPrototypeOf(SelectionTable.prototype), "updateEntry", this).call(this, action.payload);
      } else if (action.type == 'APPEND') {
        action.payload.forEach(function (object) {
          return _get(_getPrototypeOf(SelectionTable.prototype), "appendEntry", _this3).call(_this3, object);
        });

        _get(_getPrototypeOf(SelectionTable.prototype), "finishLoadContent", this).call(this, action.payload.length);
      }
    }
  }, {
    key: "render",
    value: function render() {
      var object = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      if (object[this.selectField] == '') {
        _get(_getPrototypeOf(SelectionTable.prototype), "render", this).call(this, object);

        this.toggleStyle(-1);
        document.getElementById("".concat(this.selectField, "-").concat(this.id)).innerHTML = '';
      } else {
        var _obj = this.store.getObjectById(object[this.selectField]);

        if (_obj) {
          this.deleteEntry(_obj);
          this.insertEntry(_obj);
          this.toggleStyle("".concat(this.id, "_").concat(object[this.selectField]));
        } else {
          this.store.loadSelectedData(object[this.selectField], this);
        }

        this.button.removeProperty('disabled');
        document.getElementById("".concat(this.selectField, "-").concat(this.id)).innerHTML = object[this.selectField];
      }
    }
  }, {
    key: "handleEvent",
    value: function handleEvent(event) {
      var popup = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var object = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

      if (event.type == 'click') {
        if (event.target.closest('tbody')) {
          var id = event.target.closest('.detail-description').id;
          var targetObject = this.store.getObjectById(id.split('_')[1]);

          if ('field' in event.target.closest('td').dataset) {
            _get(_getPrototypeOf(SelectionTable.prototype), "loadContent", this).call(this, event.type, 'UPDATE');
          } else {
            if (this.toggleStyle(id)) {
              object[this.selectField] = targetObject[this.store.getObjIdType()];

              if (this.nextFieldId != '') {
                document.getElementById("".concat(this.selectField, "-").concat(this.id)).innerHTML = object[this.selectField];

                if (targetObject[this.nextFieldId]) {
                  object[this.nextField] = targetObject[this.nextFieldId];
                } else {
                  object[this.nextField] = '';
                }
              } else {
                document.getElementById("".concat(this.selectField, "-").concat(this.id)).innerHTML = object[this.selectField];
              }

              popup.setObject(object);
            } else {
              object[this.selectField] = '';
              document.getElementById("".concat(this.selectField, "-").concat(this.id)).innerHTML = '';

              if (object[this.nextField] != '') {
                object[this.nextField] = '';
              }

              this.button.initializeProperties({
                disabled: 'true'
              });
              popup.setObject(object);
            }
          }
        } else {
          _get(_getPrototypeOf(SelectionTable.prototype), "handleEvent", this).call(this, event);
        }
      } else {
        _get(_getPrototypeOf(SelectionTable.prototype), "handleEvent", this).call(this, event);
      }
    }
  }, {
    key: "toggleStyle",
    value: function toggleStyle(tableRowId) {
      var _this4 = this;

      var tableRow = document.getElementById(tableRowId);
      var rows = this.cardContainer.querySelectorAll('tr');
      var hasSelected = false;

      if (tableRow) {
        rows.forEach(function (element) {
          if (element === tableRow) {
            element.classList.toggle(_this4.style);

            if (element.classList.contains(_this4.style)) {
              _this4.button.removeProperty('disabled');

              hasSelected = true;
            }
          } else {
            if (element.classList.contains(_this4.style)) {
              element.classList.remove(_this4.style);
            }
          }
        });
      } else {
        rows.forEach(function (element) {
          if (element.classList.contains(_this4.style)) {
            element.classList.remove(_this4.style);
          }
        });
      }

      return hasSelected;
    }
  }]);

  return SelectionTable;
}(DOMContainer);

var Popup =
/*#__PURE__*/
function () {
  function Popup(id, eventObjects) {
    var eventTypes = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : ['click'];
    var objectFields = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};
    var selectionTable = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : {};

    _classCallCheck(this, Popup);

    this.id = id;
    this.eventObjects = eventObjects;
    this.eventTypes = eventTypes;
    this.dataType = 'innerHTML';
    this.selectionTable = selectionTable;
    this.object = {};
    this.prev = {};
    this.objectFields = objectFields;
    this.popup = document.getElementById(this.id);
  }

  _createClass(Popup, [{
    key: "setPrev",
    value: function setPrev(prev) {
      this.prev = prev;
    }
  }, {
    key: "getPrev",
    value: function getPrev() {
      return this.prev;
    }
  }, {
    key: "getObject",
    value: function getObject() {
      return this.object;
    }
  }, {
    key: "setObject",
    value: function setObject(object) {
      this.object = object;
    }
  }, {
    key: "setDataType",
    value: function setDataType(type) {
      this.dataType = type;
    }
  }, {
    key: "render",
    value: function render(object) {
      var _this5 = this;

      this.object = object; // console.log(this.object);

      var inputs = this.popup.querySelectorAll('.inputs');
      inputs.forEach(function (input) {
        input.value = '';
        input.classList.remove('invalid-details', 'warning-details');

        if (_this5.popup.querySelector("#".concat(input.name, "-error"))) {
          _this5.popup.querySelector("#".concat(input.name, "-error")).innerHTML = null;
        }
      });
      this.dataType == 'innerHTML' ? changeInnerHTML(object, this.id, this.objectFields) : changeValue(object, this.id);
      this.eventObjects.forEach(function (eventObject) {
        return eventObject.initializeProperties();
      });

      if (Object.keys(this.selectionTable).length != 0) {
        this.selectionTable.render(object);
      }

      this.eventTypes.forEach(function (type) {
        _this5.popup.addEventListener(type, _this5);
      });
      this.popup.style.display = 'block';
    }
  }, {
    key: "removeFromDOM",
    value: function removeFromDOM() {
      var _this6 = this;

      this.eventTypes.forEach(function (type) {
        _this6.popup.removeEventListener(type, _this6);
      });
      this.popup.style.display = 'none';
    }
  }, {
    key: "handleEvent",
    value: function handleEvent(event) {
      if (event.type == 'click') {
        var targetObject = this.eventObjects.find(function (obj) {
          return obj.id === event.target.id;
        });

        if (targetObject) {
          if (targetObject.id.includes('Info')) {
            var field = targetObject.id.split('_')[1];
            targetObject.handleEvent(this, this.object[field], event);
            targetObject.next.setObject(this.object);
          }

          targetObject.handleEvent(this, this.object, event);
        } else {
          if (Object.keys(this.selectionTable).length != 0) {
            this.selectionTable.handleEvent(event, this, this.object);
          }
        }
      } else if (event.type == 'keyup') {
        var _targetObject = this.eventObjects.find(function (obj) {
          return obj.id.includes('Confirm') || obj.id.includes('Submit');
        });

        _targetObject.handleEvent(this, this.object, event);
      } else if (event.type == 'change') {
        var _targetObject2 = this.eventObjects.find(function (obj) {
          return obj.id.includes('Confirm') || obj.id.includes('Submit');
        });

        _targetObject2.handleEvent(this, this.object, event);
      }
    }
  }]);

  return Popup;
}(); //******************Popup Buttons */


var PopupButton =
/*#__PURE__*/
function () {
  function PopupButton(id) {
    var next = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var properties = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    _classCallCheck(this, PopupButton);

    this.id = id;
    this.properties = properties;
    this.next = next;
    this.initializeProperties();
  }

  _createClass(PopupButton, [{
    key: "initializeProperties",
    value: function initializeProperties() {
      for (var key in this.properties) {
        document.getElementById(this.id).setAttribute(key, this.properties[key]);
      }
    }
  }, {
    key: "removeProperty",
    value: function removeProperty(property) {
      document.getElementById(this.id).removeAttribute(property);
    }
  }, {
    key: "setNext",
    value: function setNext(next) {
      this.next = next;
    }
  }]);

  return PopupButton;
}();

var DisplayNextButton =
/*#__PURE__*/
function (_PopupButton) {
  _inherits(DisplayNextButton, _PopupButton);

  function DisplayNextButton(id) {
    var _this7;

    var next = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var eventHandleHelpers = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
    var properties = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};

    _classCallCheck(this, DisplayNextButton);

    _this7 = _possibleConstructorReturn(this, _getPrototypeOf(DisplayNextButton).call(this, id, next, properties));
    _this7.eventHandleHelpers = eventHandleHelpers;
    return _this7;
  }

  _createClass(DisplayNextButton, [{
    key: "handleEvent",
    value: function handleEvent(popup) {
      var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var event = arguments.length > 2 ? arguments[2] : undefined;
      this.eventHandleHelpers.forEach(function (helper) {
        object = helper(popup, object, event);
      });

      if (event.type === 'click') {
        if (Object.keys(this.next).length == 0) {
          popup.removeFromDOM();
        } else {
          popup.removeFromDOM();
          this.next.render(object);
        }
      } else if (event.type === 'keyup') {
        if (SimilarityCheck(object, popup.getObject())) {
          document.getElementById(this.id).setAttribute('disabled', 'true');
        } else {
          document.getElementById(this.id).removeAttribute('disabled');
        }
      } else if (event.type === 'change') {
        if (SimilarityCheck(object, popup.getObject())) {
          document.getElementById(this.id).setAttribute('disabled', 'true');
        } else {
          document.getElementById(this.id).removeAttribute('disabled');
        }
      }
    }
  }]);

  return DisplayNextButton;
}(PopupButton);

var OpenNewWindowButton =
/*#__PURE__*/
function (_PopupButton2) {
  _inherits(OpenNewWindowButton, _PopupButton2);

  function OpenNewWindowButton(id) {
    var _this8;

    var next = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var eventHandleHelpers = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
    var properties = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};

    _classCallCheck(this, OpenNewWindowButton);

    _this8 = _possibleConstructorReturn(this, _getPrototypeOf(OpenNewWindowButton).call(this, id, next, properties));
    _this8.eventHandleHelpers = eventHandleHelpers;
    return _this8;
  }

  _createClass(OpenNewWindowButton, [{
    key: "handleEvent",
    value: function handleEvent(popup) {
      var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var event = arguments.length > 2 ? arguments[2] : undefined;
      this.eventHandleHelpers.forEach(function (helper) {
        object = helper(popup, object, event);
      });
      window.open('../../Fleet-Management-System/func/slip.php?id=' + object.RequestId);
    }
  }]);

  return OpenNewWindowButton;
}(PopupButton);

var DisplayAlertButton =
/*#__PURE__*/
function (_PopupButton3) {
  _inherits(DisplayAlertButton, _PopupButton3);

  function DisplayAlertButton(id) {
    var next = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var properties = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    _classCallCheck(this, DisplayAlertButton);

    return _possibleConstructorReturn(this, _getPrototypeOf(DisplayAlertButton).call(this, id, next, properties));
  }

  _createClass(DisplayAlertButton, [{
    key: "handleEvent",
    value: function handleEvent(popup) {
      var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var event = arguments.length > 2 ? arguments[2] : undefined;
      this.next.render(object);
      this.next.setPrev(popup);
    }
  }]);

  return DisplayAlertButton;
}(PopupButton);

var DisplayAlertCheckButton =
/*#__PURE__*/
function (_PopupButton4) {
  _inherits(DisplayAlertCheckButton, _PopupButton4);

  function DisplayAlertCheckButton(id) {
    var next = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var properties = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    _classCallCheck(this, DisplayAlertCheckButton);

    return _possibleConstructorReturn(this, _getPrototypeOf(DisplayAlertCheckButton).call(this, id, next, properties));
  }

  _createClass(DisplayAlertCheckButton, [{
    key: "handleEvent",
    value: function handleEvent(popup) {
      var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var event = arguments.length > 2 ? arguments[2] : undefined;
      var check = false;
      popup.popup.querySelectorAll(".inputs").forEach(function (element) {
        if (element.type == 'file') {
          obj[element.name] = element.files[0];
        } else {
          if (element.value != '') {
            check = true;
          }
        }
      });

      if (check) {
        this.next.render(object);
        this.next.setPrev(popup);
      } else {
        document.querySelectorAll('.popup').forEach(function (element) {
          return element.style.display = 'none';
        });
        popup.removeFromDOM();
      }
    }
  }]);

  return DisplayAlertCheckButton;
}(PopupButton);

var ValidatorButton =
/*#__PURE__*/
function (_PopupButton5) {
  _inherits(ValidatorButton, _PopupButton5);

  function ValidatorButton(id) {
    var _this9;

    var next = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var eventHandleHelpers = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
    var properties = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};

    _classCallCheck(this, ValidatorButton);

    _this9 = _possibleConstructorReturn(this, _getPrototypeOf(ValidatorButton).call(this, id, next, properties));
    _this9.eventHandleHelpers = eventHandleHelpers;
    return _this9;
  }

  _createClass(ValidatorButton, [{
    key: "handleEvent",
    value: function handleEvent(popup) {
      var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var event = arguments.length > 2 ? arguments[2] : undefined;
      this.eventHandleHelpers.forEach(function (helper) {
        if (object.hasOwnProperty('valid')) {
          if (object.valid) {
            object = helper(popup, object, event);
          }
        } else {
          object = helper(popup, object, event);
        }
      });
      var check = object.hasOwnProperty('valid') ? object.valid : true;

      if (check) {
        if (event.type === 'click') {
          if (Object.keys(this.next).length == 0) {
            popup.removeFromDOM();
          } else {
            popup.removeFromDOM();
            this.next.render(object);
          }
        } else if (event.type === 'keyup') {
          if (SimilarityCheck(object, popup.getObject())) {
            document.getElementById(this.id).setAttribute('disabled', 'true');
          } else {
            document.getElementById(this.id).removeAttribute('disabled');
          }
        } else if (event.type === 'change') {
          document.getElementById(this.id).removeAttribute('disabled');
        }
      }
    }
  }]);

  return ValidatorButton;
}(PopupButton);

var SearchButton =
/*#__PURE__*/
function (_PopupButton6) {
  _inherits(SearchButton, _PopupButton6);

  function SearchButton(id) {
    var _this10;

    var next = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var eventHandleHelpers = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
    var properties = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};

    _classCallCheck(this, SearchButton);

    _this10 = _possibleConstructorReturn(this, _getPrototypeOf(SearchButton).call(this, id, next, properties));
    _this10.eventHandleHelpers = eventHandleHelpers;
    return _this10;
  }

  _createClass(SearchButton, [{
    key: "handleEvent",
    value: function handleEvent(popup) {
      var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var event = arguments.length > 2 ? arguments[2] : undefined;
      this.eventHandleHelpers.forEach(function (helper) {
        object = helper(popup, object, event);
      });
      var check = object.hasOwnProperty('valid') ? object.valid : true;

      if (check) {
        if (event.type === 'click') {
          if (Object.keys(this.next).length == 0) {
            popup.removeFromDOM();
          } else {
            popup.removeFromDOM();
            this.next.render(object);
          }
        }
      }
    }
  }]);

  return SearchButton;
}(PopupButton); //************************ Decorators ****************//


var BackendAccess = function BackendAccess(method) {
  var actionCreater = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  return function (popup) {
    var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var event = arguments.length > 2 ? arguments[2] : undefined;

    if (event.type == 'click') {
      Database.writeToDatabase(object, method, actionCreater);
    }

    return object;
  };
};

var BackendAccessWithPicture = function BackendAccessWithPicture(method) {
  var actionCreater = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
  return function (popup) {
    var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var event = arguments.length > 2 ? arguments[2] : undefined;

    if (event.type == 'click') {
      Database.savePicture(object, method, actionCreater);
    }

    return object;
  };
};

var RemoveAllPopup = function RemoveAllPopup(popup) {
  var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var event = arguments.length > 2 ? arguments[2] : undefined;
  document.querySelectorAll('.popup').forEach(function (element) {
    return element.style.display = 'none';
  });
  popup.getPrev().removeFromDOM();
  return object;
};

var DateValidator = function DateValidator(popup) {
  var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var event = arguments.length > 2 ? arguments[2] : undefined;

  if (event.type == 'keyup') {
    var target = event.target;

    if (target.type == 'date') {
      if (target.value.length > 0) {
        var currentDate = new Date();
        var givenDate = new Date(target.value);

        if (givenDate < currentDate) {
          target.classList.add('warning-details');
          popup.popup.querySelector("#".concat(target.name, "-error")).innerHTML = 'Given Date is before the current date';
          popup.popup.querySelector("#".concat(target.name, "-error")).classList = '';
          popup.popup.querySelector("#".concat(target.name, "-error")).classList.add('text-warning');
        } else {
          target.classList.remove('warning-details');
          popup.popup.querySelector("#".concat(target.name, "-error")).innerHTML = null;
        }
      }
    }
  }

  return object;
};

var FormValidate = function FormValidate(popup) {
  var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var event = arguments.length > 2 ? arguments[2] : undefined;

  if (event.type == 'click') {
    var fields = popup.popup.querySelectorAll('.inputs');
    var valid = true;
    fields.forEach(function (field) {
      if (field.hasAttribute('required')) {
        if (field.value.length == 0) {
          valid = false;
          field.classList.add('invalid-details');
          popup.popup.querySelector("#".concat(field.name, "-error")).innerHTML = 'This field should be provided';
          popup.popup.querySelector("#".concat(field.name, "-error")).classList = '';
          popup.popup.querySelector("#".concat(field.name, "-error")).classList.add('text-danger');
        } else {
          field.classList.remove('invalid-details');
          popup.popup.querySelector("#".concat(field.name, "-error")).innerHTML = null;
        }
      }

      if (field.type == 'text') {
        field.value = field.value.replace(/</g, '&lt;').replace(/>/g, '&gt;');
      }
    });
    return _objectSpread({}, object, {
      valid: valid
    });
  }

  return object;
};

var ObjectCreate = function ObjectCreate(popup) {
  var object = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var event = arguments.length > 2 ? arguments[2] : undefined;
  var obj = {};
  popup.popup.querySelectorAll(".inputs").forEach(function (element) {
    if (element.type == 'file') {
      obj[element.name] = element.files[0];
      element.files.length > 0 ? obj['hasImage'] = true : obj['hasImage'] = false;
    } else {
      obj[element.name] = element.value;
    }
  });

  if (event.type == 'keyup') {
    return _objectSpread({}, object, {}, obj);
  } else {
    return _objectSpread({}, object, {}, obj);
  }
}; //********************Helper Function to compare two objects **************//


var SimilarityCheck = function SimilarityCheck(first, second) {
  if (first === second) return true;
  var firstProps = Object.getOwnPropertyNames(first);
  var secondProps = Object.getOwnPropertyNames(second);

  for (var i = 0; i < firstProps.length; i++) {
    var prop = firstProps[i];

    if (secondProps.includes(prop)) {
      if (second[prop] != first[prop]) {
        return false;
      }
    }
  }

  return true;
};

var WindowOpen = function WindowOpen() {
  windowObjectReference = window.open('http://www.domainname.ext/path/ImageFile.png', 'DescriptiveWindowName', 'resizable,scrollbars,status');
}; //************************Change Popup InnerHTML/Value Helper Function *********/


var changeValue = function changeValue(object, id) {
  var objProps = Object.getOwnPropertyNames(object);

  for (var i = 0; i < objProps.length; i++) {
    tag = document.getElementById("".concat(objProps[i], "-").concat(id));

    if (tag) {
      if (!objProps[i].includes('PicturePath')) {
        tag.value = object[objProps[i]];
      } else {
        var path = "".concat(objProps[i].split('PicturePath')[0].toLowerCase());

        if (object[objProps[i]] != '') {
          tag.src = "../images/".concat(path, "Pictures/").concat(object[objProps[i]]);
        } else {
          tag.src = "../images/".concat(path, "Pictures/default-").concat(path, ".png");
        }
      }
    }
  }
};

var changeInnerHTML = function changeInnerHTML(object, id) {
  var objectFields = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  var objProps = Object.getOwnPropertyNames(object);

  var _loop = function _loop(i) {
    document.querySelectorAll("#".concat(objProps[i], "-").concat(id)).forEach(function (tag) {
      if (_typeof(object[objProps[i]]) !== 'object') {
        if (!objProps[i].includes('PicturePath')) {
          tag.innerHTML = object[objProps[i]];
        } else {
          var path = "".concat(objProps[i].split('PicturePath')[0].toLowerCase());

          if (object[objProps[i]] != '') {
            tag.src = "../images/".concat(path, "Pictures/").concat(object[objProps[i]]);
          } else {
            tag.src = "../images/".concat(path, "Pictures/default-").concat(path, ".png");
          }
        }
      } else {
        tag.innerHTML = '';
        var fields = objectFields[objProps[i]];
        fields.forEach(function (field) {
          tag.innerHTML += object[objProps[i]][field];
        });
      }
    });
  };

  for (var i = 0; i < objProps.length; i++) {
    _loop(i);
  }
};

var Database = {
  writeToDatabase: function writeToDatabase(object, method) {
    var actionCreater = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    console.log(_objectSpread({}, object, {
      Method: method
    }));
    $.ajax({
      url: '../func/save2.php',
      type: 'POST',
      data: _objectSpread({}, object, {
        Method: method
      }),
      cache: false,
      beforeSend: function beforeSend() {
        $('#overlay').fadeIn(300);
      },
      success: function success(returnArr) {
        console.log(returnArr);
        $('#overlay').fadeOut(300);
        $("#".concat(method, "_form")).trigger('reset');

        if (Object.keys(actionCreater).length != 0) {
          actionCreater.updateStores(object, returnArr.object);
        }
      },
      error: function error() {
        $('#overlay').fadeOut(300);
      },
      timeout: 5000
    });
  },
  loadContent: function loadContent(method, offset) {
    var actionCreater = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    var searchObject = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};
    var object = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : {};

    var holder = _objectSpread({}, {
      offset: offset,
      Method: method,
      object: object
    }, {}, searchObject);

    console.log(holder);
    $.ajax({
      url: '../func/fetch.php',
      type: 'POST',
      data: holder,
      dataType: 'json',
      beforeSend: function beforeSend() {
        $('.bouncybox').fadeIn(300);
      },
      success: function success(returnArr) {
        console.log(returnArr);
        $('.bouncybox').fadeOut(300);

        if (Object.keys(actionCreater).length != 0) {
          actionCreater.updateStores({}, returnArr.object);
        }
      },
      error: function error() {
        $('.bouncybox').fadeOut(300);
      },
      timeout: 10000
    });
  },
  savePicture: function savePicture(object, method) {
    var actionCreater = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    data = new FormData();
    var objProperties = Object.getOwnPropertyNames(object);
    objProperties.forEach(function (property) {
      data.append(property, object[property]);
    });
    data.append('Method', method);
    $.ajax({
      url: '../func/save2.php',
      type: 'POST',
      data: data,
      mimeType: 'mutipart/FormData',
      contentType: false,
      processData: false,
      cache: false,
      success: function success(returnArr) {
        if (Object.keys(actionCreater).length != 0) {
          actionCreater.updateStores(object, returnArr.object[0]);
        }
      }
    });
  }
};