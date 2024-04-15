const see_pass = document.querySelector('#see_pass');
const pass = document.querySelector('#pass_cred');


see_pass.addEventListener('click', () => {
    let pass = document.querySelector('#pass_cred');
    see_pass.checked ? pass.type = 'text' : pass.type = 'password';
})

class ValidaFormulario{
    constructor(){
        this.btn_submit = document.querySelector('#submit_btn');
        this.user = document.querySelector('#user_cred');
        this.pass = pass;
        this.events();
        console.log('click')

    }

    events(){
        this.btn_submit.addEventListener('click', () => {
            this.check_lenght();
            console.log('click')
        });
    }

    remove_all(){
        for(let errorText of this.formulario.querySelectorAll('.error-text')) {
            errorText.remove();
        }
    }

    check_lenght(){
        if(!this.user.value){
            this.criaErro(this.user, `O campo usuário não pode estar vazio!`)
        }
        if(!this.pass.value){
            this.criaErro(this.pass, `O campo senha não pode estar vazio!`)
        }
    }


    criaErro(campo, msg) {
        const div = document.createElement('div');
        div.innerHTML = msg;
        div.classList.add('error-text');
        campo.classList.add('error-input')
        campo.insertAdjacentElement('afterend', div);
        return;
    }
}

const valida = new ValidaFormulario();
