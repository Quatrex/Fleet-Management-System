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
	}
	render() {
		document.getElementById(this.id).classList.add('active', 'show');
		this.contentContainer.render();
	}

	removeFromDOM() {
		document.getElementById(this.id).classList.remove('active', 'show');
	}
}

class DOMContainer {
	constructor(id, popup, store, templateId) {
		this.id = id;
		this.cardId = this.id.substring(id.length-9)=='Container'? id.substring(0,id.length-9)+'Card':id
		this.popup = popup;
		this.cardContainer = document.getElementById(id);
		this.store = store;
		this.templateId = templateId;
		this.searchButtonID = ['Search_Confirm', 'Cancel_Confirm', 'Sort_Confirm', 'Asc', 'Desc'];
		this.searchObj = this.store.getSearchObject();
		this.searchInput = document.getElementById(`${this.id}_SearchInput`);
		this.loadMoreButton = document.getElementById(`${this.id}_LoadMore`);
		this.ascButton = document.getElementById(`Asc_${this.id}`);
		this.descButton = document.getElementById(`Desc_${this.id}`);
		this.cancelSearchButton = this.cardContainer.querySelector('.form-clear');
		document.getElementById(id).addEventListener('click', this);
		document.getElementById(id).addEventListener('change', this);
		document.getElementById(id).addEventListener('keyup', this);
	}
	render() {
		this.loadContent();
	}
	update(action) {
		if (action.type == 'ADD') {
			if (action.hasOwnProperty('end')) {
			}
			action.payload.forEach((object) => this.insertEntry(object));
		} else if (action.type == 'DELETE') {
			this.deleteEntry(action.payload);
		} else if (action.type == 'DELETEALL') {
			this.deleteAllEntries();
		} else if (action.type == 'UPDATE') {
			this.updateEntry(action.payload);
		} else if (action.type == 'APPEND') {
			action.payload.forEach((object) => this.appendEntry(object));
			this.finishLoadContent(action.payload.length);
		}
	}

	finishLoadContent(len) {
		this.loadMoreButton.classList.contains('active')
			? this.loadMoreButton.classList.remove('active') // : this.cardContainer.removeChild(document.getElementById(`${this.id}_Loader`));
			: $('bouncybox').fadeOut(300);

		if (len < 5) {
			if (!this.loadMoreButton.classList.contains('d-none')) {
				this.loadMoreButton.classList.add('d-none');
			}
		} else {
			if (this.loadMoreButton.classList.contains('d-none')) {
				this.loadMoreButton.classList.remove('d-none');
			}
		}
	}

	loadContent(trigger = 'render', method = 'APPEND') {
		if (trigger != 'render') {
			if (!this.loadMoreButton.classList.contains('active')) {
				if (method == 'APPEND') {
					this.loadMoreButton.classList.add('active');
				}
				this.store.loadData(trigger, method);
			}
		} else {
			// let template = document.querySelector('#loaderTemplate');
			// let clone = template.content.cloneNode(true);
			// this.cardContainer.insertBefore(clone, this.cardContainer.firstChild);
			// this.cardContainer.firstElementChild.id = `${this.id}_Loader`;
			$('bouncybox').fadeIn(300);
			this.store.loadData(trigger);
		}
	}

	handleEvent(event) {
		if (
			event.type == 'click' &&
			(event.target.id || event.target.closest('.searchTabButton') || event.target.closest('.detail-description'))
		) {
			let method = 'NULL';
			for (let i = 0; i < this.searchButtonID.length; i++) {
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
							this.searchObj.keyword != '' ? (this.searchObj.keyword = '') : (method = 'NONE');
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
						if (event.target.id == `${this.id}_LoadMore`) {
							this.loadContent('click');
						}
					} else if (event.target.closest('.detail-description')) {
						let targetObject = this.store.getObjectById(
							event.target.closest('.detail-description').id.split('_')[1]
						);
						if (targetObject) {
							this.popup.render(targetObject);
						}
					}
				}
			}
		} else if (event.type == 'change') {
			let eventTarget = event.target;
			if (event.target.tagName.toLowerCase() == 'select') {
				let method = event.target.dataset.field.toUpperCase(); //Select_Search/Sort_containerid
				if (this.searchObj[eventTarget.name]) {
					this.searchObj[eventTarget.name] = eventTarget.value;
					this.store.searchAndSort(method, this.searchObj);
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

	insertEntry(object) {
		let template = document.querySelector(`#${this.templateId}`);
		let clone = template.content.cloneNode(true);
		let objFields = Object.getOwnPropertyNames(object);
		objFields.forEach((field) => {
			if (clone.querySelector(`.${field}`)) {
				if (field.includes('PicturePath')) {
					let path = '';
					field.includes('Vehicle') ? (path = 'vehicle') : (path = 'profile');
					object[field] != ''
						? (clone.querySelector(`.${field}`).src = `../images/${path}Pictures/${object[field]}`)
						: (clone.querySelector(`.${field}`).src = `../images/${path}Pictures/default-${path}.png`);
				} else {
					clone.querySelector(`.${field}`).innerHTML += ` ${object[field]}`;
				}
			}
		});
		this.cardContainer
			.querySelector('.card-body')
			.insertBefore(clone, this.cardContainer.querySelector('.card-body').firstChild);
		this.cardContainer.querySelector('.card-body').firstElementChild.id = `${this.cardId}_${
			object[this.store.getObjIdType()]
		}`;
	}

	appendEntry(object) {
		let template = document.querySelector(`#${this.templateId}`);
		let clone = template.content.cloneNode(true);
		let objFields = Object.getOwnPropertyNames(object);
		objFields.forEach((field) => {
			if (clone.querySelector(`.${field}`)) {
				if (field.includes('PicturePath')) {
					let path = '';
					field.includes('Vehicle') ? (path = 'vehicle') : (path = 'profile');
					object[field] != ''
						? (clone.querySelector(`.${field}`).src = `../images/${path}Pictures/${object[field]}`)
						: (clone.querySelector(`.${field}`).src = `../images/${path}Pictures/default-${path}.png`);
				} else {
					clone.querySelector(`.${field}`).innerHTML += ` ${object[field]}`;
				}
			}
		});
		this.cardContainer.querySelector('.card-body').appendChild(clone);
		this.cardContainer.querySelector('.card-body').lastElementChild.id = `${this.cardId}_${
			object[this.store.getObjIdType()]
		}`;
	}

	deleteEntry(object) {
		let entry = document.getElementById(`${this.cardId}_${object[this.store.getObjIdType()]}`);
		if (entry != 'undefined' && entry != null) {
			this.cardContainer.querySelector('.card-body').removeChild(entry);
		}
	}
	deleteAllEntries() {
		let children = this.cardContainer.querySelectorAll('.detail-description');
		children.forEach((child) => {
			child.remove();
		});
	}
	updateEntry(object) {
		let entry = document.getElementById(`${this.cardId}_${object[this.store.getObjIdType()]}`);
		if (entry != 'undefined' && entry != null) {
			let objFields = Object.getOwnPropertyNames(object);
			objFields.forEach((field) => {
				if (entry.querySelector(`.${field}`)) {
					entry.querySelector(`.${field}`).innerHTML = object[field];
				}
			});
		} else {
			this.insertEntry(object);
		}
	}
}

class SelectionTable extends DOMContainer {
	constructor(id, popup, store, templateId, button, selectField, nextField = '', nextFieldId = '') {
		super(id, popup, store, templateId);
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
	update(action) {
		if (action.type == 'ADD') {
			console.log(action.payload);
			super.insertEntry(action.payload[0]);
			this.toggleStyle(`${this.id}_${action.payload[0][this.store.getObjIdType()]}`);
		} else if (action.type == 'DELETE') {
			super.deleteEntry(action.payload);
		} else if (action.type == 'DELETEALL') {
			super.deleteAllEntries();
		} else if (action.type == 'UPDATE') {
			super.updateEntry(action.payload);
		} else if (action.type == 'APPEND') {
			action.payload.forEach((object) => super.appendEntry(object));
			super.finishLoadContent(action.payload.length);
		}
	}

	render(object = {}) {
		console.log(object[this.selectField]);
		if (object[this.selectField] === '') {
			super.render(object);
			this.toggleStyle(-1);
			document.getElementById(`${this.selectField}-${this.id}`).innerHTML = '';
		} else {
			let obj = this.store.getObjectById(object[this.selectField]);
			if (obj) {
				this.deleteEntry(obj);
				this.insertEntry(obj);
				this.toggleStyle(`${this.id}_${object[this.selectField]}`);
			} else {
				this.store.loadSelectedData(object[this.selectField], this);
			}
			this.button.removeProperty('disabled');
			document.getElementById(`${this.selectField}-${this.id}`).innerHTML = object[this.selectField];
		}
	}
	handleEvent(event, popup = {}, object = {}) {
		if (event.type == 'click') {
			if (event.target.closest('tbody')) {
				let id = event.target.closest('.detail-description').id;
				let targetObject = this.store.getObjectById(id.split('_')[1]);
				if ('field' in event.target.closest('td').dataset) {
					super.loadContent(event.type, 'UPDATE');
				} else {
					if (this.toggleStyle(id)) {
						object[this.selectField] = targetObject[this.store.getObjIdType()];
						if (this.nextFieldId != '') {
							document.getElementById(`${this.selectField}-${this.id}`).innerHTML =
								object[this.selectField];
							if (targetObject[this.nextFieldId]) {
								object[this.nextField] = targetObject[this.nextFieldId];
							} else {
								object[this.nextField] = '';
							}
						} else {
							document.getElementById(`${this.selectField}-${this.id}`).innerHTML =
								object[this.selectField];
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
			} else {
				super.handleEvent(event);
			}
		} else {
			super.handleEvent(event);
		}
	}

	toggleStyle(tableRowId) {
		let tableRow = document.getElementById(tableRowId);
		let rows = this.cardContainer.querySelectorAll('tr');
		let hasSelected = false;
		if (tableRow) {
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
		} else {
			rows.forEach((element) => {
				if (element.classList.contains(this.style)) {
					element.classList.remove(this.style);
				}
			});
		}

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
		// console.log(this.object);
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
				if (targetObject.id.includes('Info')) {
					let field = targetObject.id.split('_')[1];
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
			let targetObject = this.eventObjects.find((obj) => obj.id.includes('Confirm') || obj.id.includes('Submit'));
			console.log(targetObject);
			targetObject.handleEvent(this, this.object, event);
		} else if (event.type == 'change') {
			console.log('Change');
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
			console.log(SimilarityCheck(object, popup.getObject()));
			console.log(object);
			console.log(popup.getObject());
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

class DisplayAlertCheckButton extends PopupButton {
	constructor(id, next = {}, properties = {}) {
		super(id, next, properties);
	}
	handleEvent(popup, object = {}, event) {
		let check = false;
		popup.popup.querySelectorAll(`.inputs`).forEach((element) => {
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
			document.querySelectorAll('.popup').forEach((element) => (element.style.display = 'none'));
			popup.removeFromDOM();
		}
	}
}
class ValidatorButton extends PopupButton {
	constructor(id, next = {}, eventHandleHelpers = [], properties = {}) {
		super(id, next, properties);
		this.eventHandleHelpers = eventHandleHelpers;
	}
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
			if (object.hasOwnProperty('valid')) {
				if (object.valid) {
					object = helper(popup, object, event);
				}
			} else {
				object = helper(popup, object, event);
			}
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
			} else if (event.type === 'keyup') {
				if (SimilarityCheck(object, popup.getObject())) {
					document.getElementById(this.id).setAttribute('disabled', 'true');
				} else {
					document.getElementById(this.id).removeAttribute('disabled');
				}
			} else if (event.type === 'change') {
				console.log(object);
				document.getElementById(this.id).removeAttribute('disabled');
				// if (SimilarityCheck(object, popup.getObject())) {
				//     document.getElementById(this.id).setAttribute('disabled', 'true');
				// } else {
				//     document.getElementById(this.id).removeAttribute('disabled');
				// }
			}
		}
	}
}

class SearchButton extends PopupButton {
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

const BackendAccessForPicture = (method, id = [], actionCreater = []) => (popup, object = {}, event) => {
	if (event.type == 'click') {
		Database.savePicture(object, method, id, actionCreater);
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
		tag = document.getElementById(`${objProps[i]}-${id}`);
		if (tag) {
			if (!objProps[i].includes('PicturePath')) {
				tag.value = object[objProps[i]];
			} else {
				let path = `${objProps[i].split('PicturePath')[0].toLowerCase()}`;
				if (object[objProps[i]] != '') {
					tag.src = `../images/${path}Pictures/${object[objProps[i]]}`;
				} else {
					tag.src = `../images/${path}Pictures/${path}.png`;
				}
			}
		}
	}
	// for (let i = 0; i < objProps.length; i++) {
	//     document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
	//         if (!(objProps[i].includes('ImagePath'))) {
	//             tag.value = object[objProps[i]];
	//         } else {
	//             if (object[objProps[i]] != '') {
	//                 tag.src = `../images/${objProps[i].split('ImagePath')[0]}Pictures/${object[objProps[i]]}`;
	//             }
	//         }
	//     });
	// }
};

const changeInnerHTML = (object, id, objectFields = {}) => {
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
			error: function () {
				$('#overlay').fadeOut(300);
			},
			timeout: 5000,
		});
	},
	loadContent(method, offset, actionCreater = {}, searchObject = {}, object = {}) {
		var holder = { ...{ offset: offset, Method: method, object: object }, ...searchObject };
		console.log(holder);
		$.ajax({
			url: '../func/fetch.php',
			type: 'POST',
			data: holder,
			dataType: 'json',
			beforeSend: function () {
				// $('#overlay').fadeIn(300);
			},
			success: function (returnArr) {
				console.log(returnArr);
				// $('#overlay').fadeOut(300);
				if (Object.keys(actionCreater).length != 0) {
					actionCreater.updateStores({}, returnArr.object);
				}
			},
			error: function () {
				// $('#overlay').fadeOut(300);
			},
			timeout: 10000,
		});
	},
	savePicture(object, method, ids = [], actionCreater = {}) {
		data = new FormData();
		data.append('Image', $(`#${method}`)[0].files[0]);
		data.append('Method', method);
		ids.forEach(function (id) {
			data.append(id.split('-')[0], $(`#${id}`).val());
		});
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
				if (returnArr.includes('false')) {
					path = returnArr.split(',')[1].split(':')[1].replace(/\\/g, '');
					$(`.${method.substring(6)}`).prop('src', path);
				}
			},
		});
	},
};
