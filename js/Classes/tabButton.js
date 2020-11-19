class MainTabButton {
	constructor(id, containerId, secTab) {
		this.secTab = secTab;
		this.containerId = containerId;
		this.id = id;
		document.getElementById(id).addEventListener('click', this);
	}
	removeFromDOM() {
		document.getElementById(this.containerId).classList.remove('active', 'show');
		document.getElementById(this.id).classList.remove('active');
		this.secTab.removeFromDOM();
	}
	renderContent() {
		document.getElementById(this.containerId).classList.add('active', 'show');
		document.getElementById(this.id).classList.add('active');
		this.secTab.render();
	}
}

class SecondaryTabButton {
	constructor(id, tab) {
		this.id = id;
		this.tab = tab;
	}
	renderContent() {
		document.getElementById(this.id).classList.add('active');
		this.tab.render();
	}
	removeFromDOM() {
		document.getElementById(this.id).classList.remove('active');
		this.tab.removeFromDOM();
	}
}