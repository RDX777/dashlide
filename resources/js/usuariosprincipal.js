const busca = document.getElementById('busca')

const nome = document.getElementById('nome')

const todos = document.getElementById('todos')

const adicionar = document.getElementById('adicionar')

busca.onclick = () => {
    if (nome.value.length > 0) {
        window.location.href = "/usuarios?busca=" + nome.value
    }
}

nome.addEventListener("keyup", (event) => {
    if (event.keyCode  == 13) {
        event.preventDefault()
        busca.click()
    }

})

todos.onclick = () => {
    window.location.href = "/usuarios"
}

adicionar.onclick = () => {
    window.location.href = "/usuarios/adicionar"
}