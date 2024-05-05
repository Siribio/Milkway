class SendSigninForm {
    constructor(form_selector, btn_selector, action_url){
        this.form = document.querySelector(form_selector);
        this.btn = document.querySelector(btn_selector);
        this.url = action_url;
        this.init_events();
    }

    init_events(){
        this.form.addEventListener("submit", (e) => {
            this.handle_submit(e);
        });
    }

    handle_submit(event){
        event.preventDefault();

        const form = new FormData(this.form);
        for (let [key, value] of form.entries()) {
            console.log(key, value);
        }
        this.send_form_data(form);
    }

    send_form_data(form){
        console.log('click')

    }
}

const loginForm = new SendSigninForm('.form_cadastro', '#btn_cadastro', 'check_signin.php');
