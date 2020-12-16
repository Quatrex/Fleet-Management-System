class Store {
	constructor(type, networkManager, objId = 'RequestId', sortColumn = 'CreatedDate', order = 'DESC') {
		this.state = eval(type);
		this.observers = [];
		this.type = type;
		this.networkManager = networkManager;
		this.objId = objId;
		this.currentObj = {};
		this.searchObj = {
			keyword: '',
			searchColumn: 'All',
			sortColumn: sortColumn,
			order: order,
		};
		this.updated = false;
		this.assignedRequestContainer = {}
		this.lastQueryID = -1;
		this.checkForDuplicate = '';
		this.tempState = [];
		this.selectionObserver = {};
		this.notifySelectionSeparately = false;
		this.selectionSearch = false;
		//queriesToRun[0]=>SelectionSearch,queriesToRun[1]=>SelectionSearchLoadMore,queriesToRun[2]=>SearchObject,queriesToRun[3]=>LoadDataInRender,
		this.queriesToRun = [[], [], [], []];
	}
	getObjIdType() {
		return this.objId;
	}
	getAssignedRequests(){
		
	}
	setAsssignedRequestContainer(cont){
		this.assignedRequestContainer = cont
	}
	getSearchObject() {
		return this.searchObj;
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
	processFailedRequest(query, err) {
		// console.log(this.lastQueryID);
		if (this.lastQueryID !== -1 && err == 'OFFLINE') {
			this.queriesToRun[this.lastQueryID] = query;
			this.lastQueryID = -1;
		} else if (this.lastQueryID == -1) {
			this.observers.forEach((observer) => observer.finishLoadContent(0, 'OFFLINE'));
		}
		console.log(this.queriesToRun);
	}
	runConnectionAwaitingQueries() {
		console.log(this.queriesToRun);
		for (let i = 0; i < 4; i++) {
			let query = this.queriesToRun[i];
			console.log(query);
			if (query.length > 0) {
				this.lastQueryID = i;
				Database.loadContent(query, this.processFailedRequest.bind(this));
				this.queriesToRun[i] = [];
			}
		}
	}
	searchAndSort(obj) {
		this.searchObj = { ...this.searchObj, ...obj };
		let query = [`Load_${this.type}`, 0, ActionCreator([this, this], 'DELETEALL&APPEND'), this.searchObj, {}];
		this.networkManager.updateStoreOrder(this);
		this.lastQueryID = 2;
		Database.loadContent(query, this.processFailedRequest.bind(this));
	}
	loadData(trigger = 'render', method = 'APPEND',sendSearchObj={}) {
		if (trigger =='render' && this.getOffset() ==0) {
			
			let query = [`Load_${this.type}`, this.state.length, ActionCreator([this], method), this.searchObj, {}];
			this.lastQueryID = 3;
			this.networkManager.updateStoreOrder(this);
			Database.loadContent(query, this.processFailedRequest.bind(this));
			this.updated = true;
		} else {
			if (trigger != 'render') {
				if (method == 'UPDATE') {
					if (this.currentObj.NumOfAllocations > 0) {
						let query = [
							`Load_${this.type}_assignedRequests`,
							0,
							ActionCreator([this], 'UPDATELOAD'),
							this.searchObj,
							this.currentObj,
						];
						
						this.lastQueryID = -1;
						this.networkManager.updateStoreOrder(this);
						Database.loadContent(query, this.processFailedRequest.bind(this));
					}
				} else {
					let query = [
						`Load_${this.type}`,
						this.state.length,
						ActionCreator([this], method),
						this.searchObj,
						{},
					];
					this.networkManager.updateStoreOrder(this);
					if (trigger == 'selection') {
						this.lastQueryID = 2;
					} else {
						this.lastQueryID = -1;
					}
					Database.loadContent(query, this.processFailedRequest.bind(this));
				}
			}
		}
	}
	loadSelectedData(id, observer) {
		this.selectionSearch = true;
		this.checkForDuplicate = id;
		this.selectionObserver = observer;
		let query = [
			`Load_${this.type}`,
			0,
			ActionCreator([this], 'ADD'),
			{
				keyword: id,
				searchColumn: 'RegistrationNo',
				sortColumn: 'RegistrationNo',
				order: 'DESC',
			},
			{},
		];
		this.lastQueryID = 0;
		this.networkManager.updateStoreOrder(this);
		Database.loadContent(query, this.processFailedRequest.bind(this));
		setTimeout(this.loadData('selection'), 3000);
	}
	dispatch(action) {
		console.log(action);
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
		} else if (action.type === 'UPDATE'||action.type === 'UPDATELOAD') {
			if (Array.isArray(action.payload)) {
				action.payload = action.payload[0]
			}
			this.state = this.state.map((item) => (this.currentObj === item ? { ...item, ...action.payload } : item));
			if(action.payload.hasOwnProperty(this.objId)){
				if(this.currentObj[this.objIdId] != action.payload[this.objId]){
					action.payload['BeforeID'] = this.currentObj[this.objId]
				}
			}
		} else if (action.type === 'DELETE') {
			this.state = this.state.filter((item) => this.currentObj !== item);
		} else if (action.type === 'DELETEALL') {
			this.state = [];
		}
		if (this.selectionSearch && action.type == 'ADD') {
			this.selectionObserver.update(action);
			this.selectionSearch = false;
		} else if (this.notifySelectionSeparately) {
			this.selectionObserver.update({ type: action.type, payload: selectionPayload });
			this.notifyObservers(action);
		} else {
			if(action.type == 'UPDATELOAD'){
				this.assignedRequestContainer.update({type:'DELETEALL',payload:[]});
				this.assignedRequestContainer.update({type:'APPEND',payload:action.payload.AssignedRequests});
			}else{
				this.notifyObservers(action);
			}
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

class NetworkManager {
	constructor() {
		this.status = 'online';
		window.addEventListener('online', this);
		window.addEventListener('offline', this);
		this.storesOrder = [];
	}
	updateStoreOrder(obj) {
		this.storesOrder = this.storesOrder.filter((store) => store !== obj);
		this.storesOrder = [...[obj], ...this.storesOrder];
	}
	handleEvent(event) {
		if (event.type == 'online' && this.status != 'online') {
			this.status = 'online';
			$('#OfflineDisplay').fadeOut(300);
			$('#OnlineDisplay').fadeIn(300);
			window.setTimeout(() => {
				$('#OnlineDisplay').fadeOut(300);
			}, 2000);
			this.notifyStores();
		} else if (event.type == 'offline' && this.status != 'offline') {
			this.status = 'offline';
			$('#OfflineDisplay').fadeIn(300);
		}
	}
	notifyStores() {
		this.storesOrder.forEach((store) => store.runConnectionAwaitingQueries());
	}
}

const ActionCreator = (stores, actionType) => ({
	type: actionType,
	stores: stores,
	updateStores: (currentObj, returnedObj) => {
		let types = actionType.split('&');
		if (types.length == 1) {
			let actionObj = { type: actionType };
			actionType == 'ADD' || actionType == 'APPEND' || actionType == 'UPDATE'|| actionType == 'UPDATELOAD'
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
