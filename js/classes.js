class DOMButton {
	constructor(id, popup, sessionVar = '') {
		this.id = id;
		this.popup = popup;
		this.sessionVar = sessionVar;
		document.getElementById(id).addEventListener('click', this);
	}
	handleEvent(event) {
		let targetObject = {};
		if (this.sessionVar !== '') {
		}
		this.popup.render(targetObject);
	}
}

class DOMContainer {
	constructor(id, fields, popup, data, dataID, store, validStates = [], templateId) {
		this.id = id;
		this.fields = fields;
		this.popup = popup;
		this.data = data;
		this.cardContainer = document.getElementById(id);
		this.dataID = dataID;
		this.store = store;
		this.validStates = validStates;
		this.templateId = templateId;
		document.getElementById(id).addEventListener('click', this);
	}
	update(action) {
		if (action.type == 'ADD') {
			if (this.validStates.length != 0) {
				if (this.validStates.includes(action.payload['Status'])) {
					this.insertEntry(action.payload);
				}
			} else {
				this.insertEntry(action.payload);
			}
		} else if (action.type == 'DELETE') {
			this.deleteEntry(action.payload);
		} else if (action.type == 'UPDATE') {
			if (this.validStates.length != 0) {
				if (this.validStates.includes(action.payload['Status'])) {
					this.updateEntry(action.payload);
				} else {
					this.deleteEntry(action.payload);
				}
			} else {
				this.updateEntry(action.payload);
			}
		}
	}

	handleEvent(event) {
		let targetObject = eval(this.data).find(
			(obj) => obj[this.dataID] == event.target.closest('.detail-description').id.split('_')[1]
		);
		if (targetObject) {
			this.store.setCurrentObj(targetObject);
			this.popup.render(targetObject);
		}
	}

	insertEntry(object) {
		// if ('content' in document.createElement('template')) {
		let template = document.querySelector(`#${this.templateId}`);
		let clone = template.content.cloneNode(true);
		this.fields.forEach((field) => {
			if (clone.querySelector(`.${field}`)) {
				clone.querySelector(`.${field}`).innerHTML += object[field];
			}
		});
		// template.querySelector('.card').id =  `${this.id}_${object[this.dataID]}`
		this.cardContainer.insertBefore(clone, this.cardContainer.firstChild);
		// }
		// else{
		// 	console.log("Error");
		// }
	}

	deleteEntry(object) {
		let entry = document.getElementById(`${this.id}_${object[this.dataID]}`);
		console.log(entry);
		if (entry != 'undefined' && entry != null) {
			this.cardContainer.removeChild(entry);
		}
	}
	updateEntry(object) {
		let entry = document.getElementById(`${this.id}_${object[this.dataID]}`);
		if (entry != 'undefined' && entry != null) {
			this.fields.forEach((field) => {
				console.log(field);
				entry.querySelector(`.${field}`).innerHTML = object[field];
			});
		} else {
			this.insertEntry(object);
		}
	}
	// handleEvent(event) {
	// 	let targetObject = eval(this.data).find(
	// 		(obj) => obj[this.dataID] == event.target.parentElement.id.split('_')[1]
	// 	);
	// 	if (targetObject) {
	// 		this.store.setCurrentObj(targetObject);
	// 		this.popup.render(targetObject);
	// 	}
	// }
}

// class Table {
// 	constructor(id, fields, popup, data, dataID, store, validStates = []) {
// 		this.id = id;
// 		this.fields = fields;
// 		this.popup = popup;
// 		this.data = data;
// 		this.table = document.getElementById(id);
// 		this.dataID = dataID;
// 		this.store = store;
// 		this.validStates = validStates;
// 		this.table.addEventListener('click', this);
// 	}
// 	update(action) {
// 		if (action.type == 'ADD') {
// 			if (this.validStates.length != 0) {
// 				if (this.validStates.includes(action.payload['Status'])) {
// 					this.insertRow(action.payload);
// 				}
// 			} else {
// 				this.insertRow(action.payload);
// 			}
// 		} else if (action.type == 'DELETE') {
// 			this.delete(action.payload);
// 		} else if (action.type == 'UPDATE') {
// 			if (this.validStates.length != 0) {
// 				if (this.validStates.includes(action.payload['Status'])) {
// 					console.log('Update called in table');
// 					this.updateRow(action.payload);
// 				} else {
// 					this.delete(action.payload);
// 				}
// 			} else {
// 				this.updateRow(action.payload);
// 			}
// 		}
// 	}
// 	handleEvent(event) {
// 		let targetObject = eval(this.data).find(
// 			(obj) => obj[this.dataID] == event.target.parentElement.id.split('_')[1]
// 		);
// 		if (targetObject) {
// 			this.store.setCurrentObj(targetObject);
// 			this.popup.render(targetObject);
// 		}
// 	}
// 	insertRow(object) {
// 		let newRow = this.table.insertRow(1);
// 		let cellValue;
// 		for (let i = 0; i < this.fields.length; i++) {
// 			cellValue = newRow.insertCell(i);
// 			cellValue.innerHTML = object[this.fields[i]];
// 		}
// 		newRow.id = `${this.id}_${object[this.dataID]}`;
// 		console.log('Came to add');
// 	}
// 	delete(object) {
// 		let row = document.getElementById(`${this.id}_${object[this.dataID]}`);
// 		if (row != 'undefined' && row != null) {
// 			row.remove();
// 		}
// 	}
// 	updateRow(object) {
// 		//complete the update Row
// 		let row = document.getElementById(`${this.id}_${object[this.dataID]}`);
// 		if (row != 'undefined' && row != null) {
// 			for (let i = 0; i < row.cells.length; i++) {
// 				cells[i].innerHTML = object[this.fields[i]];
// 			}
// 		} else {
// 			this.insertRow(object);
// 		}
// 	}
// }

class SelectionTable extends DOMContainer {
	constructor(
		id,
		fields,
		popup,
		data,
		dataID,
		store,
		templateId,
		button,
		selectField,
		nextField = '',
		nextFieldId = ''
	) {
		super(id, fields, popup, data, dataID, store, [], templateId);
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
		let targetObject = eval(this.data).find((obj) => obj[this.dataID] == id.split('_')[1]);
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
	constructor(id, eventObjects, eventTypes = ['click'], selectionTable = {}) {
		this.id = id;
		this.eventObjects = eventObjects;
		this.eventTypes = eventTypes;
		this.dataType = 'innerHTML';
		this.selectionTable = selectionTable;
		this.object = {};
		this.prev = {};
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
		this.dataType == 'innerHTML' ? changeInnerHTML(object, this.id) : changeValue(object, this.id);
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
				targetObject.handleEvent(this, this.object, event.type);
			} else {
				if (Object.keys(this.selectionTable).length != 0) {
					event.target.parentElement.id.includes(this.selectionTable.getId());
					this.selectionTable.handleEvent(this, this.object, event.target.parentElement.id);
				}
			}
		} else if (event.type == 'keyup') {
			let targetObject = this.eventObjects.find((obj) => obj.id.includes('Confirm') || obj.id.includes('Submit'));
			targetObject.handleEvent(this, this.object, event.type);
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
	handleEvent(popup, object = {}, type) {
		this.eventHandleHelpers.forEach((helper) => {
			object = helper(popup, object, type);
		});
		if (type === 'click') {
			if (Object.keys(this.next).length == 0) {
				popup.removeFromDOM();
			} else {
				popup.removeFromDOM();
				this.next.render(object);
			}
		} else if (type === 'keyup') {
			console.log(object);
			console.log(popup.getObject());

			if (SimilarityCheck(object, popup.getObject())) {
				document.getElementById(this.id).setAttribute('disabled', 'true');
			} else {
				document.getElementById(this.id).removeAttribute('disabled');
			}
		}
	}
}

class DisplayAlertButton extends PopupButton {
	constructor(id, next = {}, properties = {}) {
		super(id, next, properties);
	}
	handleEvent(popup, object = {}, type) {
		this.next.render(object);
		this.next.setPrev(popup);
	}
}
//************************ Decorators ****************//

const BackendAccess = (method, actionCreater = []) => (popup, object = {}, type) => {
	if (type == 'click') {
		Database.writeToDatabase(object, method, actionCreater);
	}
	return object;
};

const RemoveAllPopup = (popup, object = {}, type) => {
	document.querySelectorAll('.popup').forEach((element) => (element.style.display = 'none'));
	popup.getPrev().removeFromDOM();
	return object;
};

const ObjectCreate = (popup, object = {}, type) => {
	let obj = {};
	popup.popup.querySelectorAll(`.inputs`).forEach((element) => {
		obj[element.name] = element.value;
	});
	if (type == 'keyup') {
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

//************************Change Popup InnerHTML/Value Helper Function *********/
const changeValue = (object, id) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			tag.value = object[objProps[i]];
		});
	}
};

const changeInnerHTML = (object, id) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			tag.innerHTML = object[objProps[i]];
		});
	}
};

const Database = {
	writeToDatabase: (object, method, actionCreaters = []) => {
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
				if (actionCreaters.length != 0) {
					actionCreaters.forEach((actionCreator) =>
						actionCreator.type == 'ADD'
							? actionCreator.store.dispatch({ type: actionCreator.type, payload: returnArr.object })
							: actionCreator.store.dispatch({ type: actionCreator.type, payload: object })
					);
				}
			},
		});
	},
};
