const see_pass = document.querySelector('#see_pass');
const pass = document.querySelector('#pass_cred');
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

function errors(){
    
}

document.querySelector('#submit_btn').addEventListener('click', (e) => {
    e.preventDefault();
    let form_data = new FormData();

    const user = document.querySelector('#user_cred_in')
    const pass = document.querySelector('#pass_cred_in')

    
    form_data.append("user_input", user.value);
    form_data.append("password", pass.value);

    console.log(form_data);

    console.log('enviado')
    fetch('check_login.php', {
        method: 'POST',
        body: form_data,
    })
    .then(response => response.json()) // Processa como JSON
    .then(data => {
        if (data.error) {
            console.error('Erro: chat', data.error); // Mostra erros
            
        } else {
            console.log('Sucesso:', data.success); // Pode redirecionar ou fazer outras ações
        }
    })
    .catch(error => console.log('Erro no fetch:', error));

});







