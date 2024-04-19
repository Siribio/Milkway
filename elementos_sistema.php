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
        <nav class="nav">
            <input type="checkbox" id="nav-check" />
            <div class="nav-header">
                <div class="nav-title">
                    <a href="../sistemaTI.php">
                        <img id="img-logo" src="/src/imgs/LOGO AGREGA MAIS texto branco_SmartData.png" alt="" />
                    </a>
                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>

            <div class="nav-links">
                <a href="/sistema_ti/opcoes_sistema/novo_ticket.php">Abrir Ticket</a>
                <a href="/sistema_ti/opcoes_sistema/verifica_ticket.php">Verificar Tickets</a>
                <a href="/sistema_ti/opcoes_sistema/comprar_tempo.php">Comprar Tempo</a>
                <a id="perfil_navbar" href="#">Perfil</a>
                <a href="">Sair</a>
            </div>
        </nav>
        ';

        echo $nav;
    }
}

?>