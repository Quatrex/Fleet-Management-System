class MainTab {
	constructor(id, mainTabButtons, defaultButton) {
		this.id = id;
		this.mainTabButtons = mainTabButtons;
		this.defaultButton = defaultButton;
		this.activeButton = defaultButton;
		this.defaultButton.renderContent();
		document.getElementById(id).addEventListener('click', this);
	}
	handleEvent(event) {
		if (event.type == 'click') {
			let targetButton = this.mainTabButtons.find((button) => button.id == event.target.closest('li').id);
			if (targetButton != null) {
				if (targetButton.id != this.activeButton.id) {
					targetButton.renderContent();
					this.activeButton.removeFromDOM();
					this.activeButton = targetButton;
				}
			}
		}
	}
}

class SecondaryTab {
	constructor(id, buttons, defaultButton) {
		this.id = id;
		this.buttons = buttons;
		this.defaultButton = defaultButton;
		this.activeButton = defaultButton;
	}
	render() {
		document.getElementById(this.id).addEventListener('click', this);
		this.defaultButton.renderContent();
	}
	removeFromDOM() {
		document.getElementById(this.id).removeEventListener('click', this);
		this.activeButton.removeFromDOM();
	}
	handleEvent(event) {
		if (event.type == 'click') {
			let targetButton = this.buttons.find((button) => button.id == event.target.id);
			if (targetButton != null) {
				if (targetButton.id != this.activeButton.id) {
					this.activeButton.removeFromDOM();
					targetButton.renderContent();
					this.activeButton = targetButton;
				}
			}
		}
	}
}