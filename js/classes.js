class DOMButton {
	constructor(id, popup) {
		this.id = id;
		this.popup = popup;
		document.getElementById(id).addEventListener('click', this);
	}
	handleEvent(event) {
		let targetObject = {};
		this.popup.render(targetObject);
	}
}

class MainTab {
	constructor(id, mainTabButtons, defaultButton) {
		this.id = id;
		this.mainTabButtons = mainTabButtons;
		this.defaultButton = defaultButton;
		this.activeButton = defaultButton;
		this.defaultButton.renderContent();
		document.getElementById(id).addEventListener('click', this);
	}
	handleEvent(event) {
		if (event.type == 'click') {
			let targetButton = this.mainTabButtons.find((button) => button.id == event.target.closest('li').id);
			if (targetButton != null) {
				if (targetButton.id != this.activeButton.id) {
					targetButton.renderContent();
					this.activeButton.removeFromDOM();
					this.activeButton = targetButton;
				}
			}
		}
	}
}

class MainTabButton {
	constructor(id, containerId, secTab) {
		this.secTab = secTab;
		this.containerId = containerId;
		this.id = id;
		document.getElementById(id).addEventListener('click', this);
	}
	removeFromDOM() {
		document.getElementById(this.containerId).classList.remove('active', 'show');
		document.getElementById(this.id).classList.remove('active');
		this.secTab.removeFromDOM();
	}
	renderContent() {
		document.getElementById(this.containerId).classList.add('active', 'show');
		document.getElementById(this.id).classList.add('active');
		this.secTab.render();
	}
}

class SecondaryTab {
	constructor(id, buttons, defaultButton) {
		this.id = id;
		this.buttons = buttons;
		this.defaultButton = defaultButton;
		this.activeButton = defaultButton;
	}
	render() {
		document.getElementById(this.id).addEventListener('click', this);
		this.defaultButton.renderContent();
	}
	removeFromDOM() {
		document.getElementById(this.id).removeEventListener('click', this);
		this.activeButton.removeFromDOM();
	}
	handleEvent(event) {
		if (event.type == 'click') {
			let targetButton = this.buttons.find((button) => button.id == event.target.id);
			if (targetButton != null) {
				if (targetButton.id != this.activeButton.id) {
					this.activeButton.removeFromDOM();
					targetButton.renderContent();
					this.activeButton = targetButton;
				}
			}
		}
	}
}

class SecondaryTabButton {
	constructor(id, tab) {
		this.id = id;
		this.tab = tab;
	}
	renderContent() {
		document.getElementById(this.id).classList.add('active');
		this.tab.render();
	}
	removeFromDOM() {
		document.getElementById(this.id).classList.remove('active');
		this.tab.removeFromDOM();
	}
}

class DOMTabContainer {
	constructor(id, contentContainer = {}) {
		this.id = id;
		this.contentContainer = contentContainer;
		this.lastTime = 0;
	}
	render() {
		document.getElementById(this.id).classList.add('active', 'show');
		window.addEventListener('scroll', this);
		this.contentContainer.render();
	}

	removeFromDOM() {
		document.getElementById(this.id).classList.remove('active', 'show');
		window.removeEventListener('scroll', this);
	}
	handleEvent(event) {
		if (event.type == 'scroll') {
			if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
				let currentTime = Date.now();
				if (this.lastTime == 0) {
					this.contentContainer.loadContent();
					this.lastTime = currentTime;
				} else if (currentTime - this.lastTime > 8000) {
					this.contentContainer.loadContent();
					this.lastTime = currentTime;
				}
			}
		}
	}
}

class DOMContainer {
	constructor(id, fields, popup, dataID, store, templateId) {
		this.id = id;
		this.fields = fields;
		this.popup = popup;
		this.cardContainer = document.getElementById(id);
		this.dataID = dataID;
		this.store = store;
		this.templateId = templateId;
		document.getElementById(id).addEventListener('click', this);
	}
	render() {
		if (this.store.getOffset() == 0) {
			this.loadContent();
		}
	}
	update(action) {
		if (action.type == 'ADD') {
			action.payload.forEach((object) => this.insertEntry(object));
		} else if (action.type == 'DELETE') {
			this.deleteEntry(action.payload);
		} else if (action.type == 'UPDATE') {
			this.updateEntry(action.payload);
		} else if (action.type == 'APPEND') {
			action.payload.forEach((object) => this.appendEntry(object));
		}
	}

	loadContent() {
		this.store.loadData();
	}

	handleEvent(event) {
		let data = this.store.getState();
		let targetObject = data.find(
			(obj) => obj[this.dataID] == event.target.closest('.detail-description').id.split('_')[1]
		);
		if (targetObject) {
			this.store.setCurrentObj(targetObject);
			this.popup.render(targetObject);
		}
	}

	insertEntry(object) {
		let template = document.querySelector(`#${this.templateId}`);
		let clone = template.content.cloneNode(true);
		this.fields.forEach((field) => {
			if (clone.querySelector(`.${field}`)) {
				clone.querySelector(`.${field}`).innerHTML += ` ${object[field]}`;
			}
		});
		this.cardContainer.insertBefore(clone, this.cardContainer.firstChild);
		this.cardContainer.firstElementChild.id = `${this.id}_${object[this.dataID]}`;
	}

	appendEntry(object) {
		let template = document.querySelector(`#${this.templateId}`);
		let clone = template.content.cloneNode(true);
		this.fields.forEach((field) => {
			if (clone.querySelector(`.${field}`)) {
				clone.querySelector(`.${field}`).innerHTML += ` ${object[field]}`;
			}
		});
		this.cardContainer.appendChild(clone);
		this.cardContainer.lastElementChild.id = `${this.id}_${object[this.dataID]}`;
	}

	deleteEntry(object) {
		let entry = document.getElementById(`${this.id}_${object[this.dataID]}`);
		if (entry != 'undefined' && entry != null) {
			this.cardContainer.removeChild(entry);
		}
	}
	updateEntry(object) {
		let entry = document.getElementById(`${this.id}_${object[this.dataID]}`);
		if (entry != 'undefined' && entry != null) {
			this.fields.forEach((field) => {
				entry.querySelector(`.${field}`).innerHTML = object[field];
			});
		} else {
			this.insertEntry(object);
		}
	}
}

class SelectionTable extends DOMContainer {
	constructor(id, fields, popup, dataID, store, templateId, button, selectField, nextField = '', nextFieldId = '') {
		super(id, fields, popup, dataID, store, templateId);
		this.selectField = selectField;
		this.button = button;
		this.cardContainer.removeEventListener('click', this);
		this.style = 'selected';
		this.nextField = nextField;
		this.nextFieldId = nextFieldId;
	}
	getId() {
		return this.id;
	}
	render(object = {}) {
		super.render(object);

		if (object[this.selectField] === '') {
			this.toggleStyle(-1);
			console.log(`${this.selectField}-${this.id}`);
			document.getElementById(`${this.selectField}-${this.id}`).innerHTML = '';
		} else {
			this.button.removeProperty('disabled');
			document.getElementById(`${this.selectField}-${this.id}`).innerHTML = object[this.selectField];
			this.toggleStyle(`${this.id}_${object[this.selectField]}`);
		}
	}
	handleEvent(popup, object, id) {
		let data = this.store.getState();
		let targetObject = data.find((obj) => obj[this.dataID] == id.split('_')[1]);
		if (this.toggleStyle(id)) {
			object[this.selectField] = targetObject[this.dataID];
			if (this.nextFieldId != '') {
				document.getElementById(`${this.selectField}-${this.id}`).innerHTML = object[this.selectField];
				if (targetObject[this.nextFieldId]) {
					object[this.nextField] = targetObject[this.nextFieldId];
				}
			}
			popup.setObject(object);
		} else {
			object[this.selectField] = '';
			document.getElementById(`${this.selectField}-${this.id}`).innerHTML = '';
			if (object[this.nextField] != '') {
				object[this.nextField] = '';
			}
			this.button.initializeProperties({ disabled: 'true' });
			popup.setObject(object);
		}
	}

	toggleStyle(tableRowId) {
		let tableRow = document.getElementById(tableRowId);
		let rows = this.cardContainer.querySelectorAll('tr');
		let hasSelected = false;
		rows.forEach((element) => {
			if (element === tableRow) {
				element.classList.toggle(this.style);
				if (element.classList.contains(this.style)) {
					this.button.removeProperty('disabled');
					hasSelected = true;
				}
			} else {
				if (element.classList.contains(this.style)) {
					element.classList.remove(this.style);
				}
			}
		});
		return hasSelected;
	}
}

class Popup {
	constructor(id, eventObjects, eventTypes = ['click'], objectFields = {}, selectionTable = {}) {
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
	setPrev(prev) {
		this.prev = prev;
	}
	getPrev() {
		return this.prev;
	}
	getObject() {
		return this.object;
	}
	setObject(object) {
		this.object = object;
	}
	setDataType(type) {
		this.dataType = type;
	}
	render(object) {
		this.object = object;
		console.log(this.object);
		let inputs = this.popup.querySelectorAll('.inputs');
		inputs.forEach((input) => {
			input.value = '';
			input.classList.remove('invalid-details', 'warning-details');
			if (this.popup.querySelector(`#${input.name}-error`)) {
				this.popup.querySelector(`#${input.name}-error`).innerHTML = null;
			}
		});
		this.dataType == 'innerHTML'
			? changeInnerHTML(object, this.id, this.objectFields)
			: changeValue(object, this.id);
		this.eventObjects.forEach((eventObject) => eventObject.initializeProperties());

		if (Object.keys(this.selectionTable).length != 0) {
			this.selectionTable.render(object);
		}
		this.eventTypes.forEach((type) => {
			this.popup.addEventListener(type, this);
		});
		this.popup.style.display = 'block';
	}
	removeFromDOM() {
		this.eventTypes.forEach((type) => {
			this.popup.removeEventListener(type, this);
		});
		this.popup.style.display = 'none';
	}

	handleEvent(event) {
		if (event.type == 'click') {
			let targetObject = this.eventObjects.find((obj) => obj.id === event.target.id);
			if (targetObject) {
				if (targetObject.id.includes('Details')) {
					let field = targetObject.id.split('_')[1];
					targetObject.handleEvent(this, this.object[field], event);
					targetObject.next.setObject(this.object);
				}
				targetObject.handleEvent(this, this.object, event);
			} else {
				if (Object.keys(this.selectionTable).length != 0) {
					event.target.parentElement.id.includes(this.selectionTable.getId());
					this.selectionTable.handleEvent(this, this.object, event.target.parentElement.id);
				}
			}
		} else if (event.type == 'keyup') {
			let targetObject = this.eventObjects.find((obj) => obj.id.includes('Confirm') || obj.id.includes('Submit'));
			targetObject.handleEvent(this, this.object, event);
		}
	}
}

//******************Popup Buttons */
class PopupButton {
	constructor(id, next = {}, properties = {}) {
		this.id = id;
		this.properties = properties;
		this.next = next;
		this.initializeProperties();
	}
	initializeProperties() {
		for (let key in this.properties) {
			document.getElementById(this.id).setAttribute(key, this.properties[key]);
		}
	}
	removeProperty(property) {
		document.getElementById(this.id).removeAttribute(property);
	}
	setNext(next) {
		this.next = next;
	}
}

class DisplayNextButton extends PopupButton {
	constructor(id, next = {}, eventHandleHelpers = [], properties = {}) {
		super(id, next, properties);
		this.eventHandleHelpers = eventHandleHelpers;
	}
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
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
		}
	}
}

class OpenNewWindowButton extends PopupButton {
	constructor(id, next = {}, eventHandleHelpers = [], properties = {}) {
		super(id, next, properties);
		this.eventHandleHelpers = eventHandleHelpers;
	}
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
			object = helper(popup, object, event);
		});
		window.open('../../Fleet-Management-System/func/slip.php?id=' + object.RequestId);
	}
}
class DisplayAlertButton extends PopupButton {
	constructor(id, next = {}, properties = {}) {
		super(id, next, properties);
	}
	handleEvent(popup, object = {}, event) {
		this.next.render(object);
		this.next.setPrev(popup);
	}
}

class ValidatorButton extends PopupButton {
	constructor(id, next = {}, eventHandleHelpers = [], properties = {}) {
		super(id, next, properties);
		this.eventHandleHelpers = eventHandleHelpers;
	}
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
			object = helper(popup, object, event);
		});
		let check = object.hasOwnProperty('valid') ? object.valid : true;
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
}

//************************ Decorators ****************//

const BackendAccess = (method, actionCreater = {}) => (popup, object = {}, event) => {
	if (event.type == 'click') {
		Database.writeToDatabase(object, method, actionCreater);
	}
	return object;
};

const BackendAccessForPicture = (method, actionCreater = []) => (popup, object = {}, event) => {
	if (event.type == 'click') {
		data = new FormData();
		data.append('profileImage', $('#profile-pic')[0].files[0]);
		data.append('Method', method);
		$.ajax({
			url: '../func/save2.php',
			type: 'POST',
			data: data,
			mimeType: 'mutipart/FormData',
			contentType: false,
			processData: false,
			cache: false,
			success: function (returnArr) {
				console.log(returnArr);
			},
		});
	}
	return object;
};

const RemoveAllPopup = (popup, object = {}, event) => {
	document.querySelectorAll('.popup').forEach((element) => (element.style.display = 'none'));
	popup.getPrev().removeFromDOM();
	return object;
};

const DateValidator = (popup, object = {}, event) => {
	if (event.type == 'keyup') {
		let target = event.target;
		if (target.type == 'date') {
			if (target.value.length > 0) {
				let currentDate = new Date();
				let givenDate = new Date(target.value);
				if (givenDate < currentDate) {
					target.classList.add('warning-details');
					popup.popup.querySelector(`#${target.name}-error`).innerHTML =
						'Given Date is before the current date';
					popup.popup.querySelector(`#${target.name}-error`).classList = '';
					popup.popup.querySelector(`#${target.name}-error`).classList.add('text-warning');
				} else {
					target.classList.remove('warning-details');
					popup.popup.querySelector(`#${target.name}-error`).innerHTML = null;
				}
			}
		}
	}
	return object;
};
const FormValidate = (popup, object = {}, event) => {
	if (event.type == 'click') {
		let fields = popup.popup.querySelectorAll('.inputs');
		let valid = true;
		fields.forEach((field) => {
			if (field.hasAttribute('required')) {
				if (field.value.length == 0) {
					valid = false;
					field.classList.add('invalid-details');
					popup.popup.querySelector(`#${field.name}-error`).innerHTML = 'This field should be provided';
					popup.popup.querySelector(`#${field.name}-error`).classList = '';
					popup.popup.querySelector(`#${field.name}-error`).classList.add('text-danger');
				} else {
					field.classList.remove('invalid-details');
					popup.popup.querySelector(`#${field.name}-error`).innerHTML = null;
				}
			}
			if (field.type == 'text') {
				field.value = field.value.replace(/</g, '&lt;').replace(/>/g, '&gt;');
			}
		});

		return { ...object, valid: valid };
	}
	return object;
};

const ObjectCreate = (popup, object = {}, event) => {
	let obj = {};
	popup.popup.querySelectorAll(`.inputs`).forEach((element) => {
		if (element.type == 'file') {
			obj[element.name] = element.files[0];
		} else {
			obj[element.name] = element.value;
		}
	});
	if (event.type == 'keyup') {
		return { ...object, ...obj };
	} else {
		return { ...object, ...obj };
	}
};

//********************Helper Function to compare two objects **************//
const SimilarityCheck = (first, second) => {
	if (first === second) return true;
	let firstProps = Object.getOwnPropertyNames(first);
	let secondProps = Object.getOwnPropertyNames(second);
	for (var i = 0; i < firstProps.length; i++) {
		let prop = firstProps[i];
		if (secondProps.includes(prop)) {
			if (second[prop] != first[prop]) {
				return false;
			}
		}
	}
	return true;
};

const WindowOpen = () => {
	windowObjectReference = window.open(
		'http://www.domainname.ext/path/ImageFile.png',
		'DescriptiveWindowName',
		'resizable,scrollbars,status'
	);
};
//************************Change Popup InnerHTML/Value Helper Function *********/
const changeValue = (object, id) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			tag.value = object[objProps[i]];
		});
	}
};

const changeInnerHTML = (object, id, objectFields) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			if (typeof object[objProps[i]] !== 'object') {
				tag.innerHTML = object[objProps[i]];
			} else {
				tag.innerHTML = '';
				let fields = objectFields[objProps[i]];
				fields.forEach((field) => {
					tag.innerHTML += object[objProps[i]][field];
				});
			}
		});
	}
};

const Database = {
	writeToDatabase: (object, method, actionCreater = {}) => {
		console.log('Data:');
		console.log({ ...object, Method: method });
		$.ajax({
			url: '../func/save2.php',
			type: 'POST',
			data: { ...object, Method: method },
			cache: false,
			beforeSend: function () {
				$('#overlay').fadeIn(300);
			},
			success: function (returnArr) {
				console.log(returnArr);
				$('#overlay').fadeOut(300);
				$(`#${method}_form`).trigger('reset');
				if (Object.keys(actionCreater).length != 0) {
					actionCreater.updateStores(object, returnArr.object);
				}
			},
		});
	},
	loadContent(method, offset, actionCreater = {}) {
		var holder = {
			offset: offset,
			Method: method,
		};
		console.log(holder);
		$.ajax({
			url: '../func/fetch.php',
			type: 'POST',
			data: holder,
			dataType: 'json',
			beforeSend: function () {
				$('#overlay').fadeIn(300);
			},
			success: function (returnArr) {
				console.log(returnArr);
				$('#overlay').fadeOut(300);
				if (Object.keys(actionCreater).length != 0) {
					actionCreater.updateStores({}, returnArr.object);
				}
			},
			error: function () {
				$('#overlay').fadeOut(300);
			},
			// timeout:5000,
		});
	},
};
