class SendSigninForm {
  constructor(form_selector, btn_selector, section_sign, action_url) {
    this.form = document.querySelector(form_selector);
    this.btn = document.querySelector(btn_selector);
    this.section = document.querySelector(section_sign);
    this.url = action_url;
    this.init_events();
    this.errors = new Object();
  }

  init_events() {
    this.form.addEventListener("submit", (e) => {
      this.handle_submit(e);
    });
  }

  handle_submit(event) {
    event.preventDefault();

    const form = new FormData(this.form);
    this.send_form_data(form);
    this.form.addEventListener("click", (e) => {
      this.clean_error()
    })
  }

  send_form_data(form) {
    const pass_cred_cad = document.querySelector('#pass_cred_cad').value
    const con_pass_cred = document.querySelector('#con_pass_cred').value
    if(pass_cred_cad !== con_pass_cred){
      this.add_error({senhas: 'As senhas devem ser iguais!'})
      return;
    }

    //this.toggle_loader(true)
    fetch(this.url, {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          this.toggle_loader(false);
          this.signin_sucess();
          console.log("Sucesso:", data.success); // Pode redirecionar ou fazer outras ações
        } else {
          console.log(data);
          this.add_error(data);
        }
      })
      //.catch((error) => console.log(`Erro no fetch ${error}`));
  }

  toggle_loader(bool) {
    const loader = document.createElement("div");
    loader.classList.add("loader");
    this.section.innerHTML = "";
    if (bool) {
      loader.style.display = "grid";
    } else {
      loader.style.display = "none";
    }

    this.section.appendChild(loader);
  }

  add_error(errors) {
    Object.entries(errors).forEach(([key, value]) => {
      this.errors[`${key}`] = {
        error: `• ${value}`
      };
      this.show_error(key)
    });
    this.show_wrapper_error()

  }

  show_error(error) {
    
    if(error == 'error_user') this.change_input('user_cred');
    if(error == 'error_email') this.change_input('email_cred');
    if(error == 'error_pass') this.change_input('pass_cred_cad');


    // wr_error.style.display = "flex";
    // 
  }

  change_input(id){
    document.querySelector(`#${id}`).classList.add("error_color")
  }

  clean_error(){
    const wr_error = document.querySelector('.wrapper_error');
    wr_error.style.display = 'none';
    wr_error.innerHTML = '';
    const user_cred = document.querySelector('#user_cred')
    const email_cred = document.querySelector('#email_cred')
    const pass_cred_cad = document.querySelector('#pass_cred_cad')
    const con_pass_cred = document.querySelector('#con_pass_cred')

    if (Array.from(user_cred.classList).includes('error_color')) this.remove_class(user_cred)
    if (Array.from(email_cred.classList).includes('error_color')) this.remove_class(email_cred)
    if (Array.from(pass_cred_cad.classList).includes('error_color')) this.remove_class(pass_cred_cad)

    this.errors = new Object();

  }

  remove_class(el){
    el.classList.remove('error_color')
  }

  show_wrapper_error(){
    const wr_error = document.querySelector('.wrapper_error');
    wr_error.style.display = 'flex';
  
    // Limpa mensagens de erro anteriores para evitar duplicação
    wr_error.innerHTML = '';
  
    const general_error_types = ['error_user', 'error_email', 'error_pass'];
    let errors_displayed = false;
  
    Object.keys(this.errors).forEach(err => {
      const error_message = this.errors[err].error;
  
      // Verifica se o erro é um dos erros gerais
      if (general_error_types.includes(err) && !errors_displayed) {
        const span = document.createElement("span");
        span.classList.add("error_set");
        span.textContent = '• Preencha todos os campos marcados';
        wr_error.appendChild(span);
        errors_displayed = true; // Marca que a mensagem genérica foi adicionada
      } else if (!general_error_types.includes(err)) {
        // Para erros específicos não relacionados aos erros gerais
        const span = document.createElement("span");
        span.classList.add("error_span");
        span.textContent = error_message;
        wr_error.appendChild(span);
      }
    });
  
    // Caso nenhum erro seja do tipo geral e ainda houver erros
    // if (!errors_displayed && Object.keys(this.errors).length > 0) {
    //   const span = document.createElement("span");
    //   span.classList.add("error_set");
    //   span.textContent = '• Verifique os detalhes do erro';
    //   wr_error.appendChild(span);
    // }
  }

  visual_error(element) {
    document.querySelector(element).classList.add("error_color");
    this.show_error("");
  }

  signin_sucess() {
    this.section.innerHTML = "";
    this.section.appendChild(this.create_sucess_element());
  }

  create_sucess_element() {
    // Primeiro, crie o wrapper principal
    const wrapper_sucess = document.createElement("div");
    wrapper_sucess.className = "wrapper_sucess";

    // Crie a div para o ícone e adicione o ícone
    const wrapper_icon = document.createElement("div");
    wrapper_icon.className = "wrapper_s_icon";
    const icon = document.createElement("i");
    icon.className = "bx bx-check-circle"; // Supondo que você está usando a biblioteca Boxicons
    wrapper_icon.appendChild(icon);

    // Crie a div para a mensagem
    const wrapper_message = document.createElement("div");
    wrapper_message.className = "wrapper_s_msg";
    wrapper_message.textContent = "O cadastro foi realizado com sucesso!";

    // Crie a div para o botão e configure o texto
    const brn_login = document.createElement("div");
    brn_login.className = "btn_s_login";
    brn_login.textContent = "Fazer login";

    brn_login.addEventListener("click", e => {
      location.reload()
    })

    // Agora, adicione todas as divs criadas ao wrapper principal
    wrapper_sucess.appendChild(wrapper_icon);
    wrapper_sucess.appendChild(wrapper_message);
    wrapper_sucess.appendChild(brn_login);
    return wrapper_sucess;
  }
}

const login_form = new SendSigninForm(
  ".form_cadastro",
  "#btn_cadastro",
  ".cadastro_sec",
  "register.php"
);
