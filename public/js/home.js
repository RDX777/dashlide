
var demostracao = document.getElementById("demonstracao")
var myCarousel = document.getElementById('carouselExampleControls')

var arquivoszero = ""
var ajson = ""
var slidenumeroa = 1
var slidenumerob = 1
var videosnumero = []

setInterval("setDemonstracao()", 30000)


myCarousel.addEventListener('slid.bs.carousel', function () {
    if (slidenumeroa == arquivoszero.length) {
        slidenumeroa = 0
    }

    for (let i = 0; i < videosnumero.length; i++) {

        if (videosnumero[i][0] == slidenumeroa) {

            clicarPlay(videosnumero[i][1], 'play')
            break
        }
    }

    slidenumeroa += 1
  })


  myCarousel.addEventListener('slide.bs.carousel', function () {
    if (slidenumerob == arquivoszero.length) {
        slidenumerob = 0
    }

    for (let i = 0; i < videosnumero.length; i++) {

        if (videosnumero[i][0] == slidenumerob) {

            clicarPlay(videosnumero[i][1], 'stop')
            break
        }
    }

    slidenumerob += 1
    
  })


function clicarPlay(id, situacao) {
    let video = document.getElementById(id)

    video.pause()
    video.currentTime = 0

    if (situacao == 'play') {
        sleep(2000).then(video.play())
    }
}


function getArquivos(){
    let xhttp = new XMLHttpRequest()

    xhttp.open('GET', './../api/arquivos', true)

    xhttp.onreadystatechange = () => {

        if (xhttp.readyState == 4) {
            getJSON(xhttp.responseText)
        }
    }

    xhttp.send()

    return ajson
}


function getJSON (dados) {

    ajson = JSON.parse(dados)
}


function houveMudanca() {
    let arquivos = getArquivos()

    if (JSON.stringify(arquivos) != JSON.stringify(arquivoszero)) {
        arquivoszero = arquivos
        return arquivos
    } else {
        return false
    }
}


function setDemonstracao() {

    let imagens = ["jpg", "png", "jpeg"]
    let video = ["mp4", "mkv"]

    let arquivos = houveMudanca()

    if (arquivos) {

        videosnumero = []

        limpaDemostracao()

        for (var i = 0; i < arquivos.length; i++) {

            if (imagens.includes(arquivos[i].extencao)) {

                if (i == 0) {
                    setImagem(arquivos[i], true)
                } else {
                    setImagem(arquivos[i], false)
                }
            } else if (video.includes(arquivos[i].extencao)) {
                if (i == 0) {
                    setVideo(arquivos[i], true)
                } else {
                    setVideo(arquivos[i], false)
                }
                
                videosnumero.push([i, arquivos[i].nomemd5, arquivos[i].tempo])

            } else {

                console.error("Arquivos Invalidos")

            }
        }        
    }
}


function setImagem(info, active) {

    let divImagem = document.createElement("div")
    if (active) {
        divImagem.className = "carousel-item active"
    } else {
        divImagem.className = "carousel-item"
    }
    divImagem.setAttribute("data-bs-interval", parseInt(info.tempo) * 1000) 

    let imagem = document.createElement("img")
    imagem.className = info.esticar
    imagem.id = info.nomemd5
    imagem.src = './img/demonstracao/' + info.nomemd5
    imagem.alt = info.nome

    divImagem.appendChild(imagem)

    demonstracao.appendChild(divImagem)

}


function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


function setVideo(info, active) {

    if (arquivoszero.length == 1) {

        setImagem({'nome':'telapreta.png',
            'nomemd5':'telapreta.png',
            'tempo':1,
            'esticar':'TelaCheia'
            }, false)

    }

    let divImagem = document.createElement("div")
    if (active) {
        divImagem.className = "carousel-item active"
    } else {
        divImagem.className = "carousel-item"
    }
    divImagem.setAttribute("data-bs-interval", parseInt(info.tempo) * 1000) 

    let video = document.createElement("video")
    video.className = info.esticar
    video.id = info.nomemd5
    video.controls = true
    video.muted = "muted"

    let origem = document.createElement("source")
    origem.src = './img/demonstracao/' + info.nomemd5
    origem.type = info.mimetype

    video.appendChild(origem)
    divImagem.appendChild(video)

    demonstracao.appendChild(divImagem)

}


function limpaDemostracao() {

    let demonstracao = document.getElementById("demonstracao")
    while (demonstracao.firstChild) {
        demonstracao.removeChild(demonstracao.firstChild);
      }

}