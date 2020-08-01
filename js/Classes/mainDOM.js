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
	constructor(id, fields, popup, dataID, store, templateId, validStates = []) {
		this.id = id;
		this.fields = fields;
		this.popup = popup;
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
		this.cardContainer.firstElementChild.id = `${this.id}_${object[this.dataID]}`;
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