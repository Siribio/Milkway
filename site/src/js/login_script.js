const see_pass = document.querySelector('#see_pass');
const pass = document.querySelector('#pass_cred');
const cadastro_se = document.querySelector('.sign_btn');
const login_sec = document.querySelector('.login_sec');
const cadastro = document.querySelector('.cadastro_sec')

cadastro_se.addEventListener('click', () => {
    console.log('click')
    login_sec.style.display = 'none';
    cadastro.style.display = 'flex';
});

see_pass.addEventListener('click', () => {
    let pass = document.querySelector('#pass_cred');
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








// class ValidaFormulario{
//     constructor(){
//         this.btn_submit = document.querySelector('#submit_btn');
//         this.user = document.querySelector('#user_cred');
//         this.pass = pass;
//         this.events();
//         console.log('click')

//     }

//     events(){
//         this.btn_submit.addEventListener('click', () => {
//             this.check_lenght();
//             console.log('click')
//         });
//     }

//     remove_all(){
//         for(let errorText of this.formulario.querySelectorAll('.error-text')) {
//             errorText.remove();
//         }
//     }

//     check_lenght(){
//         if(!this.user.value){
//             this.criaErro(this.user, `O campo usuário não pode estar vazio!`)
//         }
//         if(!this.pass.value){
//             this.criaErro(this.pass, `O campo senha não pode estar vazio!`)
//         }
//     }


//     criaErro(campo, msg) {
//         const div = document.createElement('div');
//         div.innerHTML = msg;
//         div.classList.add('error-text');
//         campo.classList.add('error-input')
//         campo.insertAdjacentElement('afterend', div);
//         return;
//     }
// }

// const valida = new ValidaFormulario();
