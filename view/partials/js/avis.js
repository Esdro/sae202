document.addEventListener('DOMContentLoaded', () => {


    // vérifie si on est sur la page /avis/add 

    if (window.location.pathname !== '/avis/add') {
        return; // Ne pas exécuter le script si on n'est pas sur la page
    }


    const starsContainer = document.querySelector('.stars');
    const stars = document.querySelectorAll('.star');

    let currentRating = parseInt(starsContainer.dataset.rating); // Récupère le rating par défaut (3)
    let hoveredRating = 0; // Pour stocker le nombre d'étoiles survolées

    // Fonction pour mettre à jour l'affichage des étoiles
    function updateStarsDisplay(ratingToDisplay) {
        stars.forEach((star, index) => {
            if (index < ratingToDisplay) {
                star.classList.add('filled');
            } else {
                star.classList.remove('filled');
            }
            star.classList.remove('hovered'); // Supprime le style de survol
            star.classList.remove('hovered-prev'); // Supprime le style de survol précédent
        });
    }

    // Initialise l'affichage avec le nombre d'étoiles par défaut
    updateStarsDisplay(currentRating);

    // Gère le survol des étoiles
    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            hoveredRating = parseInt(star.dataset.value);
            stars.forEach((s, index) => {
                if (index < hoveredRating) {
                    s.classList.add('hovered'); // Applique le style de survol
                    s.classList.add('hovered-prev'); // Applique le style pour les étoiles précédentes
                } else {
                    s.classList.remove('hovered');
                    s.classList.remove('hovered-prev');
                }
            });
          });

        star.addEventListener('mouseout', () => {
            // Réinitialise l'affichage au rating actuel lorsque la souris quitte les étoiles
            updateStarsDisplay(currentRating);
           
        });

        star.addEventListener('click', () => {
            currentRating = parseInt(star.dataset.value); // Met à jour le rating au clic
            starsContainer.dataset.rating = currentRating; // Met à jour l'attribut data-rating
            updateStarsDisplay(currentRating); 


            document.getElementById('rate').value = currentRating; // Met à jour le champ caché avec la nouvelle valeur

        });
    });

});