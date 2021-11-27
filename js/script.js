/* **************************************** CONFIRMATION AVANT SUPPRESSION **************************************** */

    var liensSuppression = document.querySelectorAll('.suppression');
    for (let i = 0; i < liensSuppression.length; i++) {
        liensSuppression[i].addEventListener('click', function(evenement) {
            evenement.preventDefault();
            var choix = confirm('Voulez-vous vraiment supprimer cet élément ?');
            if (choix) {
                window.location.href = this.getAttribute('href');
            }
        });
    }