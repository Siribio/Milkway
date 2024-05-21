const see_pass = document.querySelector('#see_pass');
const pass = document.querySelector('#pass_cred_in');
const cadastro_se = document.querySelector('.sign_btn');
const login_sec = document.querySelector('.login_sec');
const cadastro = document.querySelector('.cadastro_sec')
const login_return = document.querySelector('.login_return');

cadastro_se.addEventListener('click', () => {change_view(false)});
login_return.addEventListener('click', () => {change_view(true)});

function change_view(bool){
    if(bool){
        login_sec.style.display = 'block';
        cadastro.style.display = 'none';
    }else{
        login_sec.style.display = 'none';
        cadastro.style.display = 'flex';
    }
}

see_pass.addEventListener('click', () => {
    let pass = document.querySelector('#pass_cred_in');
    see_pass.checked ? pass.type = 'text' : pass.type = 'password';
})

class CheckLogin {
    constructor(user, pass, btn, url){
        this.user = document.querySelector(user);
        this.pass = document.querySelector(pass);;
        this.submit_btn = document.querySelector(btn)
        this.init_events();
        this.url = url;
        this.errors = new Object();
    }

    init_events(){
        this.submit_btn.addEventListener('click', e => {
            this.handle_submit(e);            
        })
    }

    handle_submit(event){
        event.preventDefault();
        let form_data = new FormData();
   
        form_data.append("user_input", this.user.value);
        form_data.append("password", this.pass.value);
        this.send_form(form_data);
    }

    send_form(form_data){
        fetch(this.url, {
            method: 'POST',
            body: form_data,
        })
        .then(response => response.json()) // Processa como JSON
        .then(data => {
            if (data.success) {
                console.log('Sucesso:', data.success); // Pode redirecionar ou fazer outras ações
                localStorage.setItem('user', JSON.stringify(data.success));
                window.location.href = 'http://localhost/milkway/site/home.php';

            } else {
                console.log('Erro: chat', data); // Mostra erros
            }
        })
        //.catch(error => console.log('Erro no fetch:', error));  
    }
}

const login_form = new CheckLogin(
    "#user_cred_in",
    '#pass_cred_in',
    "#submit_btn",
    "login.php"
  );
  


