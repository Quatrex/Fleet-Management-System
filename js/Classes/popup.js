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
				if (targetObject.id.includes('Info')) {
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