
let $map = document.querySelector('#wh_map');

let teest = '';
// chargement  google map
const initMap_whith_api = async function () {
    // chargement d'api google
    let api_google = '';
    await   jQuery.post(wh_ajaxurl,
            {
                'action': 'front_api_google'
            },
            function (response) {

                api_google = response;

            }
    );

    initMap(api_google);

}

class GoogleMaps {
    /*
     * charge la carte
     * @param {html element}
     */

    constructor() {
        this.map = null;
        this.bounds = null;
        this.texMarker = null;
    }

    async  load(element, api = '') {
        return new Promise((resolve, reject) => {
            $script('https://maps.googleapis.com/maps/api/js?key=' + api, () => {

                this.texMarker = class TextMarker extends google.maps.OverlayView {

                    constructor(pos, map, text) {
                        super()
                        this.div = null
                        this.pos = pos
                        this.text = text
                        this.setMap(map)
                    }

                    onAdd() {
                        this.div = document.createElement('div')
                        this.div.classList.add('marker')
                        this.div.style.position = 'absolute'
                        this.div.innerHTML = this.text
                        this.getPanes().overlayImage.appendChild(this.div)
                    }

                    draw() {
                        let position = this.getProjection().fromLatLngToDivPixel(this.pos)
                        this.div.style.left = position.x + "px"
                        this.div.style.top = position.y + "px"
                    }

                    onRemove() {
                        this.div.parentNode.removeChild(this.div)
                    }
                    actived() {
                        if (this.div !== null) {
                            this.div.classList.add('is-active');
                        }

                    }

                    desactived() {
                        if (this.div !== null) {
                            this.div.classList.remove('is-active');
                        }

                    }

                }

                this.map = new google.maps.Map(element);
                this.bounds = new google.maps.LatLngBounds();
                resolve();
            });
        })

    }
    /*
     * @param {string} lat
     * @param {string} log
     */
    addMarkereur(lat, log, marTex = '') {

        let myLatLng = new google.maps.LatLng(lat, log);


        let marker = new this.texMarker(myLatLng, this.map, marTex);

        this.bounds.extend(myLatLng);

        return marker;
    }

    centerMaps() {
        this.map.panToBounds(this.bounds);
        this.map.fitBounds(this.bounds);
    }
}

/*
 * initiation du map
 * @returns {undefined}
 */

const initMap = async function (api_google = '') {

    let map = new GoogleMaps();

    let activeMarker = null;

    await  map.load($map, api_google);

    Array.from(document.querySelectorAll('.wh_poste')).forEach(function (item) {

        let marTex = item.getElementsByTagName("p")[0].innerHTML;

        let marker = map.addMarkereur(item.dataset.lat, item.dataset.log, marTex);

        item.addEventListener('mouseover', () => {

            marker.actived();

            if (activeMarker !== null) {

                activeMarker.desactived();
            }

            activeMarker = marker;
        })

        item.addEventListener('mouseleave', () => {

            if (activeMarker === marker) {
                marker.desactived();
                activeMarker = null;
            }

        });

    });

    map.centerMaps();
}

/*
 * savoir lancer la map ou pas
 */

function isMap() {
    let result = false;
    Array.from(document.querySelectorAll('.wh_poste')).forEach(function (item) {

        let lat = item.dataset.lat;
        let lng = item.dataset.log;
        if (lat && lng) {
            result = true;
            return result;

        }

    });
    return result;
}

/*
 * initialisation de la map
 */
if ($map !== null && isMap()) {

    initMap_whith_api();

} else {// supresion de l'emplacement de la map
    // supression de l'emplacement de du map
    if ($map !== null) {
        let div_map = document.querySelector('.wh_map');
        div_map.parentNode.removeChild(div_map);

    }

}


function rechargeMaps() {
    initMap_whith_api();
}



// creation ajax et filtre

class Taxo {

    constructor() {
        this.taxonomy;
        this.field = 'slug';
        this.terms;
        this.operator = 'IN';
    }

}

// pour la geolocalisation

let wh_lat = null;
let wh_lng = null;
let ajoutSlid = document.querySelector('#wh_filtres');

// generation du slider
function creation_slider() {
    // creation de  slidecontainer
    let div_slide = document.createElement("DIV");
    let attr_class = document.createAttribute("class");
    attr_class.value = "wh_silde_content";
    div_slide.setAttributeNode(attr_class);
    // creation de slide
    let input_slide = document.createElement("INPUT");

    let attr_type = document.createAttribute("type");
    attr_type.value = "range";

    let attr_min = document.createAttribute("min");
    attr_min.value = "1";

    let attr_max = document.createAttribute("max");
    attr_max.value = "140";

    let attr_value = document.createAttribute("value");
    attr_value.value = "20";

    let attr_class_slide = document.createAttribute("class");
    attr_class_slide.value = "wh_silder";

    let attr_id_slide = document.createAttribute("id");
    attr_id_slide.value = "wh_Range";

    // creation de value affichage de span
    let output_slide_id = document.createAttribute("id");
    output_slide_id.value = "wh_distance";

    let output_slide_span = document.createElement("SPAN");
    output_slide_span.setAttributeNode(output_slide_id);
    output_slide_span.innerHTML = attr_value.value + 'km';

    // ajout de Rayon
    let output_slide_rayon = document.createElement("P");
    output_slide_rayon.innerHTML = 'Rayon:';
    output_slide_rayon.appendChild(output_slide_span);


    // ajout des attribu
    input_slide.setAttributeNode(attr_type);
    input_slide.setAttributeNode(attr_min);
    input_slide.setAttributeNode(attr_max);
    input_slide.setAttributeNode(attr_value);
    input_slide.setAttributeNode(attr_class_slide);
    input_slide.setAttributeNode(attr_id_slide);
    // ajout dan contener
    div_slide.appendChild(input_slide);
    div_slide.appendChild(output_slide_rayon);
    // ajout dans le templete

    ajoutSlid.appendChild(div_slide);
}
// option geolocalisation
var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};
//erreur geoloc
function error(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
}
// recuparation de la position
function maPosition(position) {

    if (isMap()) {

        wh_lat = position.coords.latitude;
        wh_lng = position.coords.longitude;
        creation_slider();
        // mise a jour du valeur du slide
        jQuery(function ($) {
            $('#wh_Range').change(function () {
                $('#wh_distance').html('');
                $('#wh_distance').html($(this).attr('value') + ' km');
            });
        });
    }

}
// geolocalisation de position courent
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(maPosition, error, options);
}



jQuery(function ($) {

    // posistion .sticky
    if ($("#wh_map_sticky").length) {
        var yourNavigation = $("#wh_map_sticky");
        let stickyDiv = "wh_sticky";
        let yourHeader = yourNavigation.offset().top;
        $(window).scroll(function () {
            if ($(this).scrollTop() >= yourHeader) {

                yourNavigation.addClass(stickyDiv);
            } else {
                yourNavigation.removeClass(stickyDiv);
            }
        });
    }

    // filtre
    let slugpostype = $('.postetype_slug').html();
    let distance = $('#wh_Range').attr('value');

    function requetAjax(slugPost, tabTaxos = '', lnt = '', lng = '', distance = '') {


        $.post(wh_ajaxurl,
                {
                    'action': 'filtre_post',
                    'slugPost': slugPost,
                    'tabTaxos': tabTaxos,
                    'lnt': lnt,
                    'lng': lng,
                    'distance': distance
                },
                function (response) {

                    if (!response) {
                        $('.wh_postes.active').html('');

                        $('.wh_postes.active').append('Désolé, aucun résultat n\'a été trouvé');
                    } else {

                        $('.wh_postes.active').html('');

                        $('.wh_postes.active').append(response);
                        // recharge de la map
                        if ($map !== null && isMap()) {
                            rechargeMaps();
                        }

                    }

                }
        );

    }


    let  filtre = function () {
        //initiation des tableau de taxonomie
        let tabTaxos = [];

        //filtre a partir de checkbox
        if ($('.wh_taxo_display input[type=checkbox]')) {

            //recuperation des checked
            $(".wh_taxo_display").each(function (index1) {
                // initialisation tu tableau checkbox checked
                let tabTaxocheck = [];

                $(this).find('input').each(function (index2) {

                    if ($(this).attr("checked")) {

                        tabTaxocheck.push($(this).attr('value'));
                    }

                });

                if (tabTaxocheck.length !== 0) {

                    let taxo = new Taxo();

                    taxo.taxonomy = $(this).attr('wh_taxonomy');
                    taxo.terms = tabTaxocheck;

                    tabTaxos.push(taxo);
                }
            });
        }
        // filtre a partir de selection multiple

        if ($('.wh_Selects option')) {

            //// recuperation nombre de fois utilisation de select
            $(".wh_taxo_Selects").each(function (index1) {
                // initialisation tu tableau checkbox checked
                let tabSelect = [];

                $(this).find('option').each(function (index2) {

                    if ($(this).attr("selected")) {

                        tabSelect.push($(this).attr('value'));
                    }

                });

                if (tabSelect.length !== 0) {

                    let taxo = new Taxo();

                    taxo.taxonomy = $(this).attr('wh_taxonomySelects');
                    taxo.terms = tabSelect;

                    tabTaxos.push(taxo);
                }
            });



        }

        if (slugpostype !== null) {

            if (tabTaxos.length !== 0 && distance !== null) {

                distance = $("#wh_Range").attr('value');

                // appel requete ajax
                requetAjax(slugpostype, tabTaxos, wh_lat, wh_lng, distance);

            } else if (tabTaxos.length !== 0) {


                requetAjax(slugpostype, tabTaxos);

            } else if (distance !== null) {

                distance = $("#wh_Range").attr('value');

                // requete ajax
                requetAjax(slugpostype, tabTaxos = '', wh_lat, wh_lng, distance);

            } else {

                requetAjax(slugpostype);

            }
        }


    }


    if ($('#wh_filtres').html()) {
        // chargment de filtre
        $('#wh_filtres').change(filtre);
    }
    // mise en form
    if ($('.wh_Selects').attr('name')) {
        $('.wh_Selects').each(function () {
            $(this).chosen();
        });
    }

    if (wh_lat !== null && wh_lng !== null && isMap()) {

        filtre();

    }

})
