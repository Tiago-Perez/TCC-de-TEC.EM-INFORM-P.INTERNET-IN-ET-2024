document.getElementById('copyLinkButton').addEventListener('click', function() {
    // Obtém a URL atual do navegador
    const currentUrl = window.location.href;

    // Cria um elemento de input temporário para copiar a URL
    const tempInput = document.createElement('input');
    tempInput.value = currentUrl;
    document.body.appendChild(tempInput);

    // Seleciona o conteúdo do input
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // Para dispositivos móveis

    // Copia o texto selecionado para a área de transferência
    document.execCommand('copy');

    // Remove o input temporário da página
    document.body.removeChild(tempInput);

    // Opcional: exibir um alerta ou mensagem de confirmação
    alert('Link copiado: ' + currentUrl);
});
