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
}

?>