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
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
			object = helper(popup, object, event);
		});

		if (event.type === 'click') {
			if (Object.keys(this.next).length == 0) {
				popup.removeFromDOM();
			} else {
				popup.removeFromDOM();
				this.next.render(object);
			}
		} else if (event.type === 'keyup') {
			if (SimilarityCheck(object, popup.getObject())) {
				document.getElementById(this.id).setAttribute('disabled', 'true');
			} else {
				document.getElementById(this.id).removeAttribute('disabled');
			}
		}
	}
}

class OpenNewWindowButton extends PopupButton {
	constructor(id, next = {}, eventHandleHelpers = [], properties = {}) {
		super(id, next, properties);
		this.eventHandleHelpers = eventHandleHelpers;
	}
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
			object = helper(popup, object, event);
		});
		window.open('../../Fleet-Management-System/func/slip.php?id=' + object.RequestId);
	}
}
class DisplayAlertButton extends PopupButton {
	constructor(id, next = {}, properties = {}) {
		super(id, next, properties);
	}
	handleEvent(popup, object = {}, event) {
		this.next.render(object);
		this.next.setPrev(popup);
	}
}

class ValidatorButton extends PopupButton {
	constructor(id, next = {}, eventHandleHelpers = [], properties = {}) {
		super(id, next, properties);
		this.eventHandleHelpers = eventHandleHelpers;
	}
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
			object = helper(popup, object, event);
		});
		let check = object.hasOwnProperty('valid') ? object.valid : true;
		if (check) {
			if (event.type === 'click') {
				if (Object.keys(this.next).length == 0) {
					popup.removeFromDOM();
				} else {
					popup.removeFromDOM();
					this.next.render(object);
				}
			}
		}
	}
}

class SearchButton extends PopupButton {
	constructor(id, next = {}, eventHandleHelpers = [], properties = {}) {
		super(id, next, properties);
		this.eventHandleHelpers = eventHandleHelpers;
	}
	handleEvent(popup, object = {}, event) {
		this.eventHandleHelpers.forEach((helper) => {
			object = helper(popup, object, event);
		});
		let check = object.hasOwnProperty('valid') ? object.valid : true;
		if (check) {
			if (event.type === 'click') {
				if (Object.keys(this.next).length == 0) {
					popup.removeFromDOM();
				} else {
					popup.removeFromDOM();
					this.next.render(object);
				}
			}
		}
	}
}
