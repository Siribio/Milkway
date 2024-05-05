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
        fetch(this.url, {
            method: "POST",
            body: form,
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Erro: chat', data.error); // Mostra erros
                
            } else {
                console.log('Sucesso:', data.success); // Pode redirecionar ou fazer outras ações
            }
        })
        //.then(data => this.handle_response(data))
        .catch(error => console.log(`Erro no fetch ${error}`));

    }
}

const loginForm = new SendSigninForm('.form_cadastro', '#btn_cadastro', 'register.php');
