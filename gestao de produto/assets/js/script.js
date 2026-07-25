
function validarFormulario() {
   
    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmar').value;

    let mensagem = document.getElementById('mensagem');
    mensagem.style.display = 'block';

    if (nome.trim() === ''){
        
        mensagem.innerHTML = "PREENCHA O CAMPO NOME";
        return false;

    } else if (email.trim() === '') {
        
        mensagem.innerHTML = "PREENCHA O CAMPO EMAIL";
        return false;

    } else if (senha.trim() === '') {
        
        mensagem.innerHTML = "PREENCHA O CAMPO SENHA";
        return false;

    } else if (confirmarSenha.trim() === '') {
        
        mensagem.innerHTML = "PREENCHA O CAMPO DE CONFIRMAR SENHA";
        return false;
    } else {
        return true;
    }

}
