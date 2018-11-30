let wh_inpute_adresse = document.getElementById('wh_adresse');

function initMap() {
    let autocomplete = new google.maps.places.Autocomplete(wh_inpute_adresse);
    google.maps.event.addListener(autocomplete, 'place_changed', codeAddress);
}

/* Fonction de géocodage déclenchée en cliquant surle bouton "Geocoder"  */
function codeAddress() {
    geocoder = new google.maps.Geocoder();
    /* Récupération de la valeur de l'adresse saisie */
    var address = wh_inpute_adresse.value;
    /* Appel au service de geocodage avec l'adresse en paramètre */
    geocoder.geocode({'address': address}, function (results, status) {
        /* Si l'adresse a pu être géolocalisée */
        if (status == google.maps.GeocoderStatus.OK) {
            /* Récupération de sa latitude et de sa longitude */
            document.getElementById('wh_lat').value = results[0].geometry.location.lat();
            document.getElementById('wh_lng').value = results[0].geometry.location.lng();

        } else {
            alert("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
        }
    });
}

const initplace_whith_api = async function () {

    var geocoder;
    // chargement d'api google
    let api_google = '';

    await   jQuery.post(wh_ajax_place,
            {
                'action': 'back_api_google'
            },
            function (response) {

                api_google = response;

            }
    );

    if (wh_inpute_adresse !== null) {
        var script = document.createElement('script');

        script.src = "https://maps.googleapis.com/maps/api/js?key=" + api_google + "&libraries=places&callback=initMap";
        document.head.appendChild(script);

        //  wh_inpute_adresse.addEventListener('click', codeAddress);
    }
}



initplace_whith_api();
