class Store {
	constructor(initialState, observers = []) {
		this.state = initialState;
		this.observers = observers;
        this.currentObj = {};
	}
	setCurrentObj(obj) {
		this.currentObj = obj;
	}
	getState() {
		return this.state;
	}
	dispatch(action) {
        console.log(action.type);
		if (action.type === 'ADD') {
			this.state.push(action.payload);
		} else if (action.type === 'UPDATE') {
			this.state = this.state.map((item) => (this.currentObj === item ? { ...item, ...action.payload } : item));
		} else if (action.type === 'DELETE') {
			this.state = this.state.filter((item) => this.currentObj !== item);
        }
		this.notifyObservers(action);
	}
	addObservers(observers) {
		this.observers = [...this.observers, ...observers];
	}
	notifyObservers(update) {
		this.observers.forEach((observer) => observer.update(update));
	}
}

const ActionCreator = (store, actionType) => ({
	type: actionType,
	store: store,
});
