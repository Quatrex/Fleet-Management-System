class Store {
	constructor(type,observers = []) {
		this.state = eval(type);
		this.observers = observers;
		this.type = type;
		this.currentObj = {};
	}
	setCurrentObj(obj) {
		this.currentObj = obj;
	}
	getState() {
		return this.state;
	}
	getOffset(){
		return this.state.length;
	}
	loadData(){
		Database.loadContent(`Load_${this.type}`,this.state.length, ActionCreator([this], 'APPEND'));
	}
	dispatch(action) {
		console.log(action.type);
		if (action.type === 'ADD' || action.type === 'APPEND') {
			this.state = [...this.state, ...action.payload];
		} else if (action.type === 'UPDATE') {
			this.state = this.state.map((item) => (this.currentObj === item ? { ...item, ...action.payload } : item));
		} else if (action.type === 'DELETE') {
			this.state = this.state.filter((item) => this.currentObj !== item);
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
			actionType == 'ADD'||actionType == 'APPEND'
				? stores[0].dispatch({ ...actionObj, payload: returnedObj })
				: stores[0].dispatch({ ...actionObj, payload: currentObj });
		} else if (types.length > 1) {
			for (let i = 0; i < stores.length; i++) {
				stores[i].dispatch({ type: types[i], payload: currentObj });
			}
		}
	},
});

