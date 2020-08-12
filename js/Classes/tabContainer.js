class DOMTabContainer {
	constructor(id, contentContainer = {}) {
		this.id = id;
		this.contentContainer = contentContainer;
		this.lastTime = 0;
	}
	render() {
		document.getElementById(this.id).classList.add('active', 'show');
		window.addEventListener('scroll', this);
		this.contentContainer.render();
	}

	removeFromDOM() {
		document.getElementById(this.id).classList.remove('active', 'show');
		window.removeEventListener('scroll', this);
	}
	handleEvent(event) {
		if (event.type == 'scroll') {
			if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
				let currentTime = Date.now();
				if (this.lastTime == 0) {
					this.contentContainer.loadContent();
					this.lastTime = currentTime;
				} else if (currentTime - this.lastTime > 8000) {
					this.contentContainer.loadContent();
					this.lastTime = currentTime;
				}
			}
		}
	}
}