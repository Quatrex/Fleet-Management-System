class DOMContainer {
	constructor(id, fields, popup, store, templateId) {
		this.id = id;
		this.fields = fields;
		this.popup = popup;
		this.cardContainer = document.getElementById(id);
		this.store = store;
		this.templateId = templateId;
		this.searchButtonID = ['Search_Confirm','Cancel_Confirm','Sort_Confirm','Asc','Desc'];
		this.searchObj = {
			keyword: '',
			searchColumn: 'DEFAULT',
			sortColumn: 'DEFAULT',
			order: 'DESC',
		};
		document.getElementById(id).addEventListener('click', this);
		document.getElementById(id).addEventListener('change', this);
	}
	render() {
		if (this.store.getOffset() <= 5) {
			this.loadContent();
		}
	}
	update(action) {
		if (action.type == 'ADD') {
			action.payload.forEach((object) => this.insertEntry(object));
		} else if (action.type == 'DELETE') {
			this.deleteEntry(action.payload);
		} else if (action.type == 'DELETEALL') {
			this.deleteAllEntries();
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
		if (event.type == 'click' && event.target.id) {
			let method = 'NULL';
			for(let i =0;i<this.searchButtonID.length;i++){
				if(event.target.id.includes(this.searchButtonID[i])){
					method = this.searchButtonID[i].split("_")[0].toUpperCase();
				}
			}
			if (method != 'NULL' ) {
				switch (method) {
					case 'SEARCH':
						this.searchObj.keyword = document.getElementById(`${id}_SearchInput`).value;
						break;
					case 'CANCEL':
						this.searchObj.keyword = '';
						document.getElementById(`${id}_SearchInput`).value = '';
						break;
					case 'DESC':
						if(this.searchObj.order != 'DESC'){
							this.searchObj.order = 'DESC';
						}else{
							method ='NONE';
						}
						break;
					case 'ASC':
						if(this.searchObj.order != 'ASC'){
							this.searchObj.order = 'ASC';
						}else{
							method ='NONE';
						}
						break;
				}
				this.store.searchAndSort(method,searchButtons[event.target.id], this.searchObj);

			} else {
				let targetObject = this.store.getObjectById(
					event.target.closest('.detail-description').id.split('_')[1]
				);
				if (targetObject) {
					this.store.setCurrentObj(targetObject);
					this.popup.render(targetObject);
				}
			}
		} else if (event.type == 'change') {
			let eventTarget = document.getElementById(event.target.id);
			let method = event.target.id.split("_")[1];//Select_Search/Sort_containerid
			if (this.searchObj[eventTarget.name]) {
				console.log(method);
				this.searchObj[eventTarget.name] = eventTarget.value;
				this.store.searchAndSort(method,searchButtons[event.target.id], this.searchObj);

			}
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
		this.cardContainer.firstElementChild.id = `${this.id}_${object[this.store.getObjIdType()]}`;
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
		this.cardContainer.lastElementChild.id = `${this.id}_${object[this.store.getObjIdType()]}`;
	}

	deleteEntry(object) {
		let entry = document.getElementById(`${this.id}_${object[this.store.getObjIdType()]}`);
		if (entry != 'undefined' && entry != null) {
			this.cardContainer.removeChild(entry);
		}
	}
	deleteAllEntries() {
		let child = this.cardContainer.lastElementChild;
		while (child) {
			this.cardContainer.removeChild(child);
			child = this.cardContainer.lastElementChild;
		}
	}
	updateEntry(object) {
		let entry = document.getElementById(`${this.id}_${object[this.store.getObjIdType()]}`);
		if (entry != 'undefined' && entry != null) {
			this.fields.forEach((field) => {
				entry.querySelector(`.${field}`).innerHTML = object[field];
			});
		} else {
			this.insertEntry(object);
		}
	}
}

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