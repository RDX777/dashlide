const getclick = document.getElementById("demostracao")

getclick.addEventListener("click", (event) => {
    if (event.target.tagName == 'I') {
        const tr = document.getElementById(event.target.id)
        tr.remove()
    }
})