class Network{
    constructor(){
        this.status = 'online';
        window.addEventListener('online',this);
        window.addEventListener('offline',this);
    }
    notifyObservers(){
        
    }
    handleEvent(event){
        if(event.type=='online'&& this.status !='online'){
            this.status = 'online';
            $('#OfflineDisplay').fadeOut(300);
            $('#OnlineDisplay').fadeIn(300);
            window.setTimeout(()=>{
                $('#OnlineDisplay').fadeOut(300);
            },2000)
        }
        else if(event.type=='offline'&& this.status !='offline'){
            this.status = 'offline';
            $('#OfflineDisplay').fadeIn(300);
        }
    }
}