class Store {
	constructor(type, objId = 'RequestId',searchColumn='',sortColumn='CreatedDate') {
		this.state = eval(type);
		this.observers = [];
		this.type = type;
		this.objId = objId;
		this.currentObj = {};
		this.searchObj = {
			keyword: '',
			searchColumn: searchColumn,
			sortColumn: sortColumn,
			order: 'DESC',
		};
	}
	getObjIdType() {
		return this.objId;
	}
	setCurrentObj(obj) {
		this.currentObj = obj;
	}
	getState() {
		return this.state;
	}
	getObjectById(id) {
		return this.state.find((obj) => obj[this.objId] == id);
	}
	getOffset() {
		return this.state.length;
	}
	searchAndSort(method, obj) {
		console.log(method);
		if (method == 'SEARCH') {
			this.searchObj = { ...this.searchObj, ...obj };
			if (this.searchObj.keyword != '') {
				Database.loadContent(
					`Load_${this.type}`,
					this.state.length,
					ActionCreator([this, this], 'DELETEALL&APPEND'),
					this.searchObj
				);
			}
		} else if (method == 'SORT') {
			if (obj.keyword != '') {
				this.searchObj = { ...this.searchObj, ...obj };

				Database.loadContent(
					`Load_${this.type}`,
					this.state.length,
					ActionCreator([this, this], 'DELETEALL&APPEND'),
					this.searchObj
				);
			} else {
				this.searchObj = { ...this.searchObj, ...obj };

				Database.loadContent(
					`Load_${this.type}`,
					this.state.length,
					ActionCreator([this, this], 'DELETEALL&APPEND'),
					this.searchObj
				);
			}
		} else if (method == 'CANCEL') {
			this.searchObj = { ...this.searchObj, ...obj };

			Database.loadContent(
				`Load_${this.type}`,
				this.state.length,
				ActionCreator([this], 'APPEND'),
				this.searchObj
			);
		}
	}

	loadData() {
		Database.loadContent(`Load_${this.type}`, this.state.length, ActionCreator([this], 'APPEND'), this.searchObj);
	}
	dispatch(action) {
		console.log(action.type);
		if (action.type === 'ADD' || action.type === 'APPEND') {
			if (!Array.isArray(action.payload)) {
				action.payload = [action.payload];
			}
			this.state = [...this.state, ...action.payload];
		} else if (action.type === 'UPDATE') {
			this.state = this.state.map((item) => (this.currentObj === item ? { ...item, ...action.payload } : item));
		} else if (action.type === 'DELETE') {
			console.log('Delete called');
			this.state = this.state.filter((item) => this.currentObj !== item);
		} else if (action.type === 'DELETEALL') {
			console.log('Delete all called');
			this.state = [];
		}
		console.log(this.state);
		this.notifyObservers(action);
	}
	addObservers(observer) {
		this.observers.push(observer);
	}
	notifyObservers(update) {
		this.observers.forEach((observer) => observer.update(update));
	}
}

const ActionCreator = (stores, actionType) => ({
	type: actionType,
	stores: stores,
	updateStores: (currentObj, returnedObj) => {
		let types = actionType.split('&');
		if (types.length == 1) {
			let actionObj = { type: actionType };
			actionType == 'ADD' || actionType == 'APPEND'
				? stores[0].dispatch({ ...actionObj, payload: returnedObj })
				: stores[0].dispatch({ ...actionObj, payload: currentObj });
		} else if (types.length > 1) {
			for (let i = 0; i < stores.length; i++) {
				actionType == 'DELETEALL' || actionType == 'APPEND'
					? stores[0].dispatch({ ...actionObj, payload: returnedObj })
					: stores[i].dispatch({ type: types[i], payload: currentObj });
			}
		}
	},
});
