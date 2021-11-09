const getclick = document.getElementById("executando")

getclick.addEventListener("click", (event) => {
    if (event.target.tagName == 'BUTTON') {
        
        if (event.target.innerHTML == "+") {
            let dateNow = Date.now()

            //Cria Div principal dos elementos
            var divPrincipal = document.createElement("div")
            divPrincipal.className = "container row g-4 mb-3"
            divPrincipal.id = dateNow


            //Cria Div do botão de arquivo
            var divArquivo = document.createElement("div")
            divArquivo.className = "col-md-6"

            //Cria o input dos arquivos
            var file = document.createElement("input")
            file.type = "file"
            file.className = "form-control"
            file.name = "arquivo[]"
            file.autocomplete = "off"
            file.accept = ".jpg, .jpeg, .png, .mp4, .mkv"
            file.required = true

            //vincula o input de aquivo na div do botão de arquivo
            divArquivo.appendChild(file)
            divPrincipal.appendChild(divArquivo)


            var divTempo = document.createElement("div")
            divTempo.className = "col-md-1"

            var tempo = document.createElement("input")
            tempo.type = "text"
            tempo.className = "form-control"
            tempo.name = "tempo[]"
            tempo.autocomplete = "off"
            tempo.required = true

            divTempo.appendChild(tempo)
            divPrincipal.appendChild(divTempo)


            var divOrdem = document.createElement("div")
            divOrdem.className = "col-md-1"

            var ordem = document.createElement("input")
            ordem.type = "text"
            ordem.className = "form-control"
            ordem.name = "ordem[]"
            ordem.autocomplete = "off"
            ordem.required = true

            divOrdem.appendChild(ordem)
            divPrincipal.appendChild(divOrdem)


            var divEsticar = document.createElement("div")
            divEsticar.className = "col-md-2"

            var esticar = document.createElement("select")
            var esticarOpcao = document.createElement("option")
            var esticarOpcaoSim = document.createElement("option")
            var esticarOpcaoNao = document.createElement("option")
            esticar.className = "form-select"
            esticar.name = "esticar[]"
            esticar.autocomplete = "off"
            esticar.required = true

            esticarOpcao.text = ""
            esticarOpcao.value = ""
            esticarOpcaoSim.text = "Sim"
            esticarOpcaoSim.value = "1"
            esticarOpcaoNao.text = "Não"
            esticarOpcaoNao.value = "0"

            esticar.add(esticarOpcao)
            esticar.add(esticarOpcaoSim)
            esticar.add(esticarOpcaoNao)

            divEsticar.appendChild(esticar)
            divPrincipal.appendChild(divEsticar)


            var divBotaoAdd = document.createElement("div")
            divBotaoAdd.className = "col-md-1"

            var BotaoAdd = document.createElement("button")
            BotaoAdd.type = "button"
            BotaoAdd.className = "form-control btn btn-outline-primary"
            BotaoAdd.textContent = "+"
            BotaoAdd.id = dateNow

            divBotaoAdd.appendChild(BotaoAdd)
            divPrincipal.appendChild(divBotaoAdd)


            var divBotaoDel = document.createElement("div")
            divBotaoDel.className = "col-md-1"

            var BotaoDel = document.createElement("button")
            BotaoDel.type = "button"
            BotaoDel.className = "form-control btn btn-outline-danger"
            BotaoDel.textContent = "-"
            BotaoDel.id = dateNow

            divBotaoDel.appendChild(BotaoDel)
            divPrincipal.appendChild(divBotaoDel)

            var adicionais = document.getElementById("adicionais")
            adicionais.appendChild(divPrincipal)
                    
        } else if (event.target.innerHTML == "-") {
            const remove = document.getElementById(event.target.getAttribute("id"))
            remove.remove()
        }
    }
})
