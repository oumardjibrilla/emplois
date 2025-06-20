// la partie du code pour ajouter des offres merci


const boutton_suivant=document.querySelector('.boutton-suivant')
if(boutton_suivant){
    boutton_suivant.addEventListener('click',()=>{
        document.querySelector('.div-forme-etap1').classList.add('hidden');
        document.querySelector('.div-forme-etap2').classList.remove('hidden');
    })
}
const boutton_precedent= document.querySelector('.boutton-precedent')
if(boutton_precedent){
    boutton_precedent.addEventListener('click',()=>{
        document.querySelector('.div-forme-etap1').classList.remove('hidden');
        document.querySelector('.div-forme-etap2').classList.add('hidden');
    })
}
const conf_sup1 =document.querySelector('.supprimerOffres-recruteur')
if(conf_sup1){
    conf_sup1.addEventListener('click' , (event)=>{
                event.preventDefault();
                const confirmation = confirm("Es-tu sûr de vouloir ajouter a la corbeille ?");
                if (confirmation) {
                    window.location.href =  event.currentTarget.href;
                }
        })
}

const conf_sup2 =document.querySelector('.supprimervalider')
if(conf_sup2){
    conf_sup2.addEventListener('click' , (event)=>{
                event.preventDefault();
                const confirmation = confirm("Es-tu sûr de vouloir ajouter a la corbeille ?");
                if (confirmation) {
                    window.location.href =  event.currentTarget.href;
                }
        })
}

const conf_sup3=document.querySelector('.supprimerdefinitive')
if(conf_sup3){
    conf_sup3.addEventListener('click' , (event)=>{
                event.preventDefault();
                const confirmation = confirm("Es-tu sûr de vouloir supprimer ?");
                if (confirmation) {
                    window.location.href =  event.currentTarget.href;
                }
        })
}

