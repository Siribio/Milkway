class FeedInfos {
    constructor(){
        this.user_object = JSON.parse(localStorage.getItem('user'))[0];
        this.init_events();
    }

    init_events(){
        console.log(this.user_object)
        if(document.querySelector("#pefil_nav_cont")){
            document.querySelector("#pefil_nav_cont").textContent = this.user_object.usuario.toUpperCase();
        }
    }
}

const feed = new FeedInfos()