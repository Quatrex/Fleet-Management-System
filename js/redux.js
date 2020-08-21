class Store {
	constructor(type, objId = 'RequestId', sortColumn = 'CreatedDate') {
		this.state = eval(type);
		this.observers = [];
		this.type = type;
		this.objId = objId;
		this.currentObj = {};
		this.searchObj = {
			keyword: '',
			searchColumn: sortColumn,
			sortColumn: sortColumn,
			order: 'DESC',
		};
		this.updated = false;
		this.checkForDuplicate = '';
		this.tempState = [];
		this.selectionObserver = {};
		this.notifySelectionSeparately = false;
		this.selectionSearch = false;
	}
	getObjIdType() {
		return this.objId;
	}
	setCurrentObj(obj) {
		this.currentObj = obj;
	}
	getSearchObject() {
		return this.searchObj;
	}
	getState() {
		return this.state;
	}
	getType() {
		return this.type;
	}
	getObjectById(id) {
		this.currentObj = this.state.find((obj) => obj[this.objId] == id);
		if (!this.currentObj) {
			this.currentObj = this.tempState.find((obj) => obj[this.objId] == id);
		}
		return this.currentObj;
	}
	getOffset() {
		return this.state.length;
	}
	searchAndSort(method, obj) {
		if (method == 'SEARCH') {
			this.searchObj = { ...this.searchObj, ...obj };
			if (this.searchObj.keyword != '') {
				Database.loadContent(
					`Load_${this.type}`,
					0,
					ActionCreator([this, this], 'DELETEALL&APPEND'),
					this.searchObj
				);
			}
		} else if (method == 'SORT') {
			if (obj.keyword != '') {
				this.searchObj = { ...this.searchObj, ...obj };

				Database.loadContent(
					`Load_${this.type}`,
					0,
					ActionCreator([this, this], 'DELETEALL&APPEND'),
					this.searchObj
				);
			} else {
				this.searchObj = { ...this.searchObj, ...obj };

				Database.loadContent(
					`Load_${this.type}`,
					0,
					ActionCreator([this, this], 'DELETEALL&APPEND'),
					this.searchObj
				);
			}
		} else if (method == 'CANCEL') {
			this.searchObj = { ...this.searchObj, ...obj };

			Database.loadContent(
				`Load_${this.type}`,
				0,
				ActionCreator([this, this], 'DELETEALL&APPEND'),
				this.searchObj
			);
		}
	}
	loadData(trigger = 'render', method = 'APPEND') {
		if (!this.updated) {
			Database.loadContent(`Load_${this.type}`, this.state.length, ActionCreator([this], method), this.searchObj);
			this.updated = true;
		} else {
			if (trigger != 'render') {
				if (method == 'UPDATE') {
					if (this.currentObj.NumOfAllocations > 0) {
						Database.loadContent(
							`Load_${this.type}_assignedRequests`,
							0,
							ActionCreator([this], method),
							this.searchObj,
							this.currentObj
						);
					}
				} else {
					Database.loadContent(
						`Load_${this.type}`,
						this.state.length,
						ActionCreator([this], method),
						this.searchObj
					);
				}
			}
		}
	}
	loadSelectedData(id, observer) {
		this.selectionSearch = true;
		this.checkForDuplicate = id;
		this.selectionObserver = observer;
		Database.loadContent(`Load_${this.type}`, 0, ActionCreator([this], 'ADD'), {
			keyword: id,
			searchColumn: 'RegistrationNo',
			sortColumn: 'RegistrationNo',
			order: 'DESC',
		});
		setTimeout(this.loadData('selection'), 3000);
	}
	dispatch(action) {
		console.log(action.type);
		let selectionPayload = [];
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
						this.tempState = [...this.tempState, ...action.payload];
					} else {
						selectionPayload = action.payload.filter((obj) => obj[this.objId] != this.checkForDuplicate);
						if (action.payload.length - selectionPayload.length > 0) {
							this.notifySelectionSeparately = true;
							this.checkForDuplicate = '';
							this.tempState = [];
						}
						this.state = [...this.state, ...action.payload];
					}
				} else {
					action.type === 'ADD'
						? (this.state = [...action.payload, ...this.state])
						: (this.state = [...this.state, ...action.payload]);
				}
			}
		} else if (action.type === 'UPDATE') {
			this.state = this.state.map((item) => (this.currentObj === item ? { ...item, ...action.payload } : item));
		} else if (action.type === 'DELETE') {
			this.state = this.state.filter((item) => this.currentObj !== item);
		} else if (action.type === 'DELETEALL') {
			this.state = [];
		}
		console.log(this.state);
		if (this.selectionSearch && action.type == 'ADD') {
			this.selectionObserver.update(action);
			this.selectionSearch = false;
		} else if (this.notifySelectionSeparately) {
			this.selectionObserver.update({ type: action.type, payload: selectionPayload });
			this.notifyObservers(action);
		} else {
			this.notifyObservers(action);
		}
	}
	addObservers(observer) {
		this.observers.push(observer);
	}
	notifyObservers(update) {
		if (this.notifySelectionSeparately) {
			let tempObservers = this.observers.filter((observer) => observer != this.selectionObserver);
			tempObservers.forEach((observer) => observer.update(update));
			this.notifySelectionSeparately = false;
			this.selectionObserver = {};
		} else {
			this.observers.forEach((observer) => observer.update(update));
		}
	}
}

const ActionCreator = (stores, actionType) => ({
	type: actionType,
	stores: stores,
	updateStores: (currentObj, returnedObj) => {
		let types = actionType.split('&');
		if (types.length == 1) {
			let actionObj = { type: actionType };
			actionType == 'ADD' || actionType == 'APPEND' || actionType == 'UPDATE'
				? stores[0].dispatch({ ...actionObj, payload: returnedObj })
				: stores[0].dispatch({ ...actionObj, payload: currentObj });
		} else if (types.length > 1) {
			for (let i = 0; i < stores.length; i++) {
				let actionObj = { type: types[i] };
				types[i] == 'DELETEALL' || types[i] == 'APPEND'
					? stores[i].dispatch({ ...actionObj, payload: returnedObj })
					: stores[i].dispatch({ type: types[i], payload: currentObj });
			}
		}
	},
});
