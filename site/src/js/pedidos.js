class PedidoController {
    constructor() {
        this.select_sab = document.querySelector('#sel_sabores');
        this.select_acom = document.querySelector('#sel_acom')
        this.sabores_container = document.querySelector('.sabores_sec');
        this.acomp_container = document.querySelector('.acomp_sec')

        this.get_sabores();

        this.select_acom.addEventListener('change', () => this.atualizar_acompanhamentos())
        this.atualizar_acompanhamentos();
        this.select_sab.addEventListener('change', () => this.atualizar_sabores());
        this.atualizar_sabores(); // Inicializar com a quantidade padrão


    }

    get_sabores(){
        fetch(this.url, {
            method: "POST",
            body: form,
        })
    }

    atualizar_acompanhamentos(){
        const quantidade = parseInt(this.select_acom.value, 10);
        this.limpar_append(this.acomp_container, '.acomp_console')

        for (let i = 0; i < quantidade; i++) {
            this.adicionar_sec(this.acomp_container, 'Selecione o acompanhamento:', 'acomp_console');
        }
    }

    atualizar_sabores() {
        const quantidade = parseInt(this.select_sab.value, 10);
        this.limpar_append(this.sabores_container ,'.sabores_console')

        for (let i = 0; i < quantidade; i++) {
            this.adicionar_sec(this.sabores_container, 'Selecione o sabor:', 'sabores_console');
        }
    }

    limpar_append(elem_container, elem_class) {
        const saborElements = elem_container.querySelectorAll(`${elem_class}`);
        saborElements.forEach(element => element.remove());
    }

    adicionar_sec(cont ,strin, group) {
        const saborDiv = document.createElement('div');
        saborDiv.classList.add(group)

        const sc_l = document.createElement('div');
        sc_l.classList.add('sc_l');

        const span = document.createElement('span');
        span.classList.add('sc_s');
        span.textContent = `${strin}`;
        
        const select = document.createElement('select');
        select.classList.add('s_sty');
        // Adicione opções ao select conforme necessário
        ['Sabor 1', 'Sabor 2', 'Sabor 3'].forEach(sabor => {
            const option = document.createElement('option');
            option.value = sabor;
            option.textContent = sabor;
            select.appendChild(option);
        });

        const sc_s = document.createElement('div');
        sc_s.classList.add('sc_s');
        sc_s.textContent = 'R$'
        const span1 = document.createElement('span');
        span1.textContent = '6,00'
        sc_s.appendChild(span1)
        
        sc_l.appendChild(span);
        sc_l.appendChild(select);
        saborDiv.appendChild(sc_l)
        saborDiv.appendChild(sc_s)
        cont.appendChild(saborDiv);
    }
}


const pedido = new PedidoController();
