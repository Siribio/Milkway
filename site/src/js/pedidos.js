class PedidoController {
    constructor() {
        this.id = 1;

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

    async get_sabores(){
        try {
            const response = await fetch("get_pedido.php");
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const sabores = await response.json();
            localStorage.setItem('sabores', JSON.stringify(sabores));
            this.populateSaboresSelect(sabores);
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
        }
    }

    atualizar_acompanhamentos(){
        const quantidade = parseInt(this.select_acom.value, 10);
        this.limpar_append(this.acomp_container, '.acomp_console')

        for (let i = 0; i < quantidade; i++) {
            this.adicionar_sec(this.acomp_container, 'Selecione o acompanhamento:', 'acomp_console', "ACOM");
        }
        this.change_value(document.querySelector('.dd1'))
        this.atualizar_total()
    }

    atualizar_sabores() {
        const quantidade = parseInt(this.select_sab.value, 10);
        this.limpar_append(this.sabores_container ,'.sabores_console')

        for (let i = 0; i < quantidade; i++) {
            this.adicionar_sec(this.sabores_container, 'Selecione o sabor:', 'sabores_console', "SAB");
        }
        this.change_value(document.querySelector('.dd2'))
        this.atualizar_total()
    }

    atualizar_total(){
        const elementos = document.querySelectorAll('.calcula');
        let total = 0;
    
        elementos.forEach(elemento => {
            const valor = parseFloat(elemento.textContent.replace(',', '.')) || 0;
            total += valor;
        });
    
        document.querySelector('#total_pedido').textContent = total + ',00';
    }

    limpar_append(elem_container, elem_class) {
        const saborElements = elem_container.querySelectorAll(`${elem_class}`);
        saborElements.forEach(element => element.remove());
    }

    change_value(select){
        const value = select.value;
        const sabores = JSON.parse(localStorage.getItem('sabores')) || [];
        const saborSelecionado = sabores.find(sabor => sabor.nome === value);
        const id = select.classList[1].split('dd')[1]
        console.log(`document.querySelector(dd${id}).parentNode
        .parentNode.querySelector(.valor${id}).textContent = ${saborSelecionado.valor},00`)
        document.querySelector(`.dd${id}`).parentNode
        .parentNode.querySelector(`.valor${id}`).textContent = `${saborSelecionado.valor},00`
        this.atualizar_total()
    }

    adicionar_sec(cont ,strin, group, tipo) {
        const saborDiv = document.createElement('div');
        saborDiv.classList.add(group)

        const sc_l = document.createElement('div');
        sc_l.classList.add('sc_l');

        const span = document.createElement('span');
        span.classList.add('sc_s');
        span.textContent = `${strin}`;
        
        const select = document.createElement('select');
        select.classList.add('s_sty');
        select.classList.add(`dd${this.id}`);
        // Adicione opções ao select conforme necessário
        const sabores = JSON.parse(localStorage.getItem('sabores')) || [];
        console.log(sabores)
        sabores
            .filter(sabor => sabor.tipo === `${tipo}`)
            .forEach(sabor => {
                const option = document.createElement('option');
                option.value = sabor.nome;
                option.textContent = sabor.nome;
                select.appendChild(option);
            });
            select.addEventListener('change', () => {
                this.change_value(select)
            })
        // ['Sabor 1', 'Sabor 2', 'Sabor 3'].forEach(sabor => {
        //     const option = document.createElement('option');
        //     option.value = sabor;
        //     option.textContent = sabor;
        //     select.appendChild(option);
        // });

        const sc_s = document.createElement('div');
        sc_s.classList.add('sc_s');
        sc_s.textContent = 'R$'
        const span1 = document.createElement('span');
        console.log(`valor${this.id}`)
        span1.classList.add(`valor${this.id}`);
        span1.classList.add('calcula')
        span1.textContent = '6,00'
        sc_s.appendChild(span1)
        
        sc_l.appendChild(span);
        sc_l.appendChild(select);
        saborDiv.appendChild(sc_l)
        saborDiv.appendChild(sc_s)
        cont.appendChild(saborDiv);

        this.atualizar_total()
        this.id += 1; // Atualiza o id para o próximo elemento
    }
}


const pedido = new PedidoController();

