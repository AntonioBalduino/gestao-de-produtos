function invalido(i) {
    i.style.display = 'block';
    i.style.height = '10px';
    i.style.borderRadius = '6px';
    i.style.display = 'flex';
    i.style.justifyContent = 'center';
    i.style.alignItems = 'center';
    
}


function logado() {
    let mensagem = document.getElementById('mensagem');
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;

    if (email.trim() === '' || senha.trim() === '') {

        invalido(mensagem);
        mensagem.innerHTML = "PREENCHA TODOS OS CAMPOS";
        return false;
    }  

    return true;
    
}