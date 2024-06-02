class PedidoController {
    constructor() {
        this.selectElement = document.querySelector('#sel_sabores');
        this.saboresContainer = document.querySelector('.sabores_sec');
        
        this.selectElement.addEventListener('change', () => this.atualizar_sabores());
        this.atualizar_sabores(); // Inicializar com a quantidade padrão
    }


    atualizar_sabores() {
        const quantidade = parseInt(this.selectElement.value, 10);
        this.limpar_sabores()

        for (let i = 0; i < quantidade; i++) {
            this.adiciona_sec_sabor();
        }
    }

    limpar_sabores() {
        const saborElements = this.saboresContainer.querySelectorAll('.sabores_console');
        saborElements.forEach(element => element.remove());
    }

//     <!-- <div class="sabores_console">
//     <div class="sc_l">
//         <span class="sc_s">selecione o sabor:</span>
//         <select class="s_sty" name="" id=""></select>
//     </div>
//      <div class="sc_s" id="valor">R$ <span>6,00</span></div>
//     </div> -->

    adiciona_sec_sabor() {
        const saborDiv = document.createElement('div');
        saborDiv.classList.add('sabores_console');
        
        const sc_l = document.createElement('div');
        sc_l.classList.add('sc_l');

        const span = document.createElement('span');
        span.classList.add('sc_s');
        span.textContent = 'Selecione o sabor:';
        
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
        this.saboresContainer.appendChild(saborDiv);
    }
}


document.addEventListener('DOMContentLoaded', () => {
    new PedidoController();
});