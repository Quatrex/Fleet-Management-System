class SelectionTable extends DOMContainer {
	constructor(id, fields, popup, store, templateId, button, selectField, nextField = '', nextFieldId = '') {
		super(id, fields, popup, store, templateId);
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
			document.getElementById(`${this.selectField}-${this.id}`).innerHTML = '';
		} else {
			this.button.removeProperty('disabled');
			document.getElementById(`${this.selectField}-${this.id}`).innerHTML = object[this.selectField];
			this.toggleStyle(`${this.id}_${object[this.selectField]}`);
		}
	}
	handleEvent(popup, object, id) {
		let data = this.store.getState();
		let targetObject = this.store.getObjectById(id.split('_')[1]);
		if (this.toggleStyle(id)) {
			object[this.selectField] = targetObject[this.store.getObjIdType()];
			if (this.nextFieldId != '') {
				document.getElementById(`${this.selectField}-${this.id}`).innerHTML = object[this.selectField];
				if (targetObject[this.nextFieldId]) {
					object[this.nextField] = targetObject[this.nextFieldId];
				} else {
					object[this.nextField] = '';
				}
			} else {
				document.getElementById(`${this.selectField}-${this.id}`).innerHTML = object[this.selectField];
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
		console.log(object);
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