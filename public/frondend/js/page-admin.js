


/* le code pour les graphes de la page admin */
// le graphe 1
const graphe1 = document.querySelector("#card-graphe1")
if(graphe1){
    const barChart = new Chart(graphe1, {
        type:"bar",
        data:{
            labels:['janvier' ,'fevrier', 'mars' ,'avril' ,'mai','juin' ,'juillet' , 'aout' , 'septempre',
                'octobre' ,'novembre' , 'decembre'
                ],
            datasets:[{
                label:'Candidats',
                data:[ 20  , 40 , 30 ,50 , 100 ,80,10,90,50,60,110,80 ],
                backgroundColor:'#3498db',

            },{
                label:'recruteurs',
                data:[ 25  , 45 , 20 ,40 , 105 ,70,30,70,40,50,112,90 ],
                backgroundColor:'#e67e22',

            }]
        },
        options:{
            scales:{
                y:{
                    suggesteMax:120,
                    ticks:{
                        font:{
                            size:18
                        }, color:"white"
                    }
                },
                x:{
                    suggesteMax:120,
                    ticks:{
                        font:{
                            size:14
                        }, color:"white"
                    }
                }
            }
        }
    })
}
// le graphe 2
const graphe2 = document.querySelector("#card-graphe2")
if(graphe2){

        const barChart2 = new Chart(graphe2, {
            type:"line",
            data:{
                labels:['janvier' ,'fevrier', 'mars' ,'avril' ,'mai','juin' ,'juillet' , 'aout' , 'septempre',
                    'octobre' ,'novembre' , 'decembre'
                    ],
                datasets:[{
                    label:'les offres',
                    data:[ 20  , 40 , 30 ,50 , 100 ,80,10,90,50,60,110,80 ],
                    backgroundColor:'white',
                    tension:0.4,
                    pointBackgroundColor:'white',
                    pointRadius:4
                }]
            },
            options:{
                scales:{
                    y:{
                        suggesteMax:120,
                        ticks:{
                            font:{
                                size:16

                            },
                            color:"white"
                        }
                    },
                    x:{
                        suggesteMax:120,
                        ticks:{
                            font:{
                                size:16
                            },
                            color:"white"
                        }
                    }
                }
            }
        })
}
const graphe3 = document.querySelector("#card-graphe3");

if(graphe3){
        const barChart3 = new Chart(graphe3, {
        type: "bar",
        data: {
            labels: ["CDI", "CDD", "Stage"],
            datasets: [{
            label: "Les contrats",
            data: [20, 40, 30],
            backgroundColor: ["#0d6efd", "#198754", "#ffc107"]
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
            x: {
                suggesteMax:120,
                ticks: {
                font: {size: 16 },
                color:"white"
                }
            },
            y: {
                ticks: {
                font: {size: 16},
                color:"white"
                }
            }
            }
          }
        });
}
/* /* autre code js pour les sous lien  la partie de la gestion des utilisateur
const liste_utilisateur =document.querySelector(".liste-candidat");
liste_utilisateur.addEventListener('click',()=>{
       document.querySelector('.div-global-section').style.display='none'
}) */

/* ce code ne concerne que la partie ajouter des utilisateur dans la partie admin */

  // Fonction pour afficher ou cacher la div selon le bouton sélectionné
  function toggleEntrepriseInfo() {
    const  info = document.querySelector('.info-entreprise')
    if(info){
            if (document.getElementById('recruteur').checked) {
                info.classList.add('visible')
            } else {
            info.classList.remove('visible')
            }
    }

    const cv_candidat = document.querySelector('.cv-candidatadmin')
      if(cv_candidat){
            if (document.getElementById('candidat').checked) {
                cv_candidat .classList.add('visible')
            } else {
            cv_candidat .classList.remove('visible')
            }
    }
  }

  // Exécuter au chargement de la page
  window.addEventListener('DOMContentLoaded', () => {
    toggleEntrepriseInfo(); // Appliquer l'affichage initial

    // Ajouter un écouteur sur tous les boutons radio "role"
    document.querySelectorAll('input[name="role"]').forEach(radio => {
      radio.addEventListener('change', toggleEntrepriseInfo);
    });
  });







// ce code concerne l'iconne de suppression pour les offre en attente
const refuserOffres_admin = document.querySelectorAll('.refuserOffres-admin');
for(offresrefuser of refuserOffres_admin){
    offresrefuser.addEventListener('click' , (event)=>{
             event.preventDefault();
             const confirmation = confirm("Es-tu sûr de vouloir supprimer ?");
              if (confirmation) {
                window.location.href =  event.currentTarget.href;
             }
    })
}

