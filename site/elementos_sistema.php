<?php
/**
 * @author Eduardo Souza Gomes
 * email: eduardo.gomes.072020@gmail.com
 */


class elementos_sistema
{


    public function imprimir_nav_bar()
    {
        $nav = '
        <header>
        <nav>
            
            <div class="wrapper_nav">
                <div class="logo_nav">
                    <img src="./src/img/logo_milkway.webp" alt="">
    
                </div>
                <div class="nome_nav">
                    MILKWAY GELATO
                </div>
            </div>


            <div class="mobile_menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="list_nav">
                <li>HOME</li>
                <li>SOBRE NÓS</li>
                <li>LOCALIZAÇÃO</li>
                <li>PEDIDO</li>
                <li id="perfil_nav">EDUARDO</li>
            </ul>
        </nav>
    </header>
        ';

        echo $nav;
    }

    public function imprimir_footer()
    {
        $footer = '
        <footer>
        <div class="wrapper_footer">
            <section class="address">
                <span id="ft_city"> <i class="bx bx-circle" style="color:#ffffff"></i>São Paulo</span>
                <span class="ft_locale">Shopping SP Plaza, Torre A <br> Sala 1305 - Liberdade</span>
            </section>

            <span>© 2024 Milkway. Todos os direitos reservados.</span>
        </div>
        </footer>
        ';

        echo $footer;
    }
}

?>