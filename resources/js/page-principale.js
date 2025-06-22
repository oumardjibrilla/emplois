const input_type_contrat = document.querySelector("#input-type-contrat")
console.log(input_type_contrat)
input_type_contrat.addEventListener("click" ,(e)=>{
    document.querySelector(".div-liste-contrat").style.display="block"
    document.querySelector(".div-liste-contrat-titre i").addEventListener("click" ,()=>{
           document.querySelector(".div-liste-contrat").style.display="none"

    })
})







// cette partie du code ne concerne que la page admin de mon site


