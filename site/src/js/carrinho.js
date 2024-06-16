document.querySelectorAll('.bx.bxs-x-circle').forEach(function(icon) {
    icon.addEventListener('click', function() {
        var id = this.getAttribute('data-id');
    
    
        if (confirm('Tem certeza que deseja excluir este pedido?')) {
            fetch('delete_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_carrinho: id })
            })
            .then(response => response.text())
            .then(responseText => {
                if (responseText === 'success') {
                    alert('Pedido excluido!');
                    location.replace(location.href);
    
                } else {
                    alert('Erro ao excluir o pedido. Tente novamente.');
                }
            })
            .catch(error => {
                alert('Erro na requisição. Tente novamente.');
            });
        }
    });
});

document.querySelector('.btn_finalizar').addEventListener('click', e => {
    var id = document.querySelector('.btn_finalizar').getAttribute('data-id');
    console.log(id)
    if (confirm('Seguir com a compra de todos os pedidos no carrinho?')) {
        fetch('confirma_pedido.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_carrinho: id })
        })
        .then(response => response.text())
        .then(responseText => {
            console.log(responseText)
            if (responseText === 'Entrou') {
                const mensagem = document.getElementById('mensagem');
                mensagem.classList.add('mostrar');
            
                // Remove a classe 'ocultar' se estiver presente
                mensagem.classList.remove('ocultar');
            
                // Remove a mensagem após 3 segundos
                setTimeout(() => {
                    mensagem.classList.add('ocultar');
                    // Espera a transição de opacidade antes de ocultar completamente
                    setTimeout(() => {
                        mensagem.classList.remove('mostrar');
                        location.replace(location.href);
                    }, 500);
                }, 3000);

            } else {
                alert('Erro ao excluir o pedido. Tente novamente.');
            }
        })
        .catch(error => {
            alert('Erro na requisição. Tente novamente.');
        });
    }
})