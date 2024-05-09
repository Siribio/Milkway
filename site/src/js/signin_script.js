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
    for (let [key, value] of form.entries()) {
      console.log(key, value);
    }
    this.send_form_data(form);
  }

  send_form_data(form) {
    //this.toggle_loader(true)
    fetch(this.url, {
      method: "POST",
      body: form,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          //this.toggle_loader(false);
          this.signin_sucess();
          console.log("Sucesso:", data.success); // Pode redirecionar ou fazer outras ações
        } else {
          console.log(data);
          this.add_error(data);
        }
      })
      //.then(data => this.handle_response(data))
      .catch((error) => console.log(`Erro no fetch ${error}`));
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
      if (key == "error_user" || key == "error_pass" || key == "error_email") {
        return Object.defineProperties(this.errors, {
          id: {
            value: 1,
            writable: false,
          },
          error_name: {
            value: "Preencha os campos selecionados!",
            writable: true,
          },
        });
      }

      if(key == 'error_sign'){
        return Object.defineProperties(this.errors, {
          id: {
            value: 2,
            writable: false
          },
          error_name: {
            value: value,
            writable: true
          }
        });
      }
    });
  }

  // show_error(error) {
  //   if (error.length == 0) error = "• Preencha os campos selecionados";
  //   const wr_error = document.querySelector(".wrapper_error");

  //   try {
  //     if (
  //       wr_error.children[0].textContent ==
  //         "• Preencha os campos selecionados" &&
  //       error == "• Preencha os campos selecionados"
  //     )
  //       return;
  //   } catch (error) {}

  //   wr_error.style.display = "flex";
  //   const span = document.createElement("span");
  //   span.classList.add("error_span");
  //   span.textContent = error;
  //   wr_error.appendChild(span);
  // }

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
