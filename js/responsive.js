

class MainTabButton {
    constructor(id, containerId, secTab) {
        this.secTab = secTab;
        this.containerId = containerId;
        this.id = id;
        document.getElementById(`${id}Responsive`).addEventListener('click', this);
    }
    removeFromDOM() {
        document.getElementById(this.containerId).classList.remove('active', 'show');
        document.getElementById(`${this.id}Responsive`).classList.remove('active');
        document.getElementById(`${this.id.replace('MainLink','SecList')}`).style.display = 'none';
        this.secTab.removeFromDOM();
    }
    renderContent() {
        document.getElementById(this.containerId).classList.add('active', 'show');
        document.getElementById(this.id).classList.add('active');
        document.getElementById(`${this.id}Responsive`).classList.add('active');
        document.getElementById(`${this.id.replace('MainLink','SecList')}`).style.display = 'flex';
        this.secTab.render();
    }
    handleEvent(event){
        if(event.type == 'click'){
            this.renderContent();
        }

    }
}

class SecondaryTab {
    constructor(id, buttons, defaultButton) {
        this.id = id;
        this.buttons = buttons;
        this.defaultButton = defaultButton;
        this.activeButton = defaultButton;
        document.getElementById(`${this.id}Responsive`).addEventListener('click', this);
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
            let targetButton = this.buttons.find((button) => button.id == event.target.id.replace("Responsive",''));
            if (targetButton != null) {
                if (targetButton.id != this.activeButton.id) {
                    console.log("Event triggered");
                    this.activeButton.removeFromDOM();
                    targetButton.renderContent();
                    this.activeButton = targetButton;
                }
            }
        }
    }
}

class SecondaryTabButton {
    constructor(id, tab) {
        this.id = id;
        this.tab = tab;
    }
    renderContent() {
        document.getElementById(this.id).classList.add('active');
        if(document.querySelector('.psd').classList.contains("psd-animate")){
            document.getElementById(`${this.id}Responsive`).classList.add('resactive');
            document.querySelector('.psd').classList.remove("psd-animate");
        }
        this.tab.render();
    }
    removeFromDOM() {
        document.getElementById(this.id).classList.remove('active');
        document.getElementById(`${this.id}Responsive`).classList.remove('resactive');
        this.tab.removeFromDOM();
    }
}
