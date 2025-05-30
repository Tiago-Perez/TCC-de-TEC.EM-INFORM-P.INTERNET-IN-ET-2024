// Seleciona os botões de visualização de senha
let btn = document.querySelector('#verSenha')
let btnConfirm = document.querySelector('#verConfirmSenha')


// Event listener para alternar a visibilidade da senha
btn.addEventListener('click', () => {
  let inputSenha = document.querySelector('#senha')

  if (inputSenha.getAttribute('type') == 'password') {
    inputSenha.setAttribute('type', 'text')
  } else {
    inputSenha.setAttribute('type', 'password')
  }
})

// Event listener para alternar a visibilidade da confirmação de senha
btnConfirm.addEventListener('click', () => {
  let inputConfirmSenha = document.querySelector('#confirmSenha')

  if (inputConfirmSenha.getAttribute('type') == 'password') {
    inputConfirmSenha.setAttribute('type', 'text')
  } else {
    inputConfirmSenha.setAttribute('type', 'password')
  }
})

// Função para redirecionar o usuário para a página anterior
function voltar() {
  window.location.href = '../index.php'
}

/*=============== NOME DA PÁGINA ===============*/

// Armazena o título original da página
let docTitle = document.title

// Event listener para alterar o título da página quando a janela perde foco
window.addEventListener('blur', () => {
  document.title = 'Não vai se cadastrar não? 😠'
})

// Event listener para restaurar o título original da página quando a janela ganha foco
window.addEventListener('focus', () => {
  document.title = docTitle
})


