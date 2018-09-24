
let $map = document.querySelector('#wh_map');
let api_google = document.querySelector('#wh_apiGoogle').innerHTML;
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


const initMap = async function () {

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


if ($map !== null) {

    initMap();

}

function rechargeMaps() {
    $map.innerHTML = '';
    initMap();
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


let wh_lat = 46.1933209;
let wh_lng = 6.227659499999959;
let ajoutSlid = document.querySelector('#wh_filtres');

if (wh_lat !== null && wh_lng !== null && ajoutSlid !== null) {
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
    output_slide_rayon.innerHTML = 'Rayon:' ;
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
    div_slide.appendChild(output_slide_rayon) ;
    // ajout dans le templete

    ajoutSlid.appendChild(div_slide);

}



jQuery(function ($) {

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

                    $('.wh_postes.active').html('');

                    $('.wh_postes.active').append(response);
                    // recharge de la map
                    rechargeMaps();
                }
        );

    }


    let  filtre = function (e) {
        //initiation des tableau de taxonomie 
        let tabTaxos = [];

        //filtre a partir de checkbox
        if ($('.wh_taxo_display input[type=checkbox]')) {

            // recuperation du taxo parent

            let indice = $('#indiceCheck').html();

            for (var i = 1; i <= indice; i++) {

                let wh_check = $('.wh_taxo_display.' + i).find('input');
                // initialise  checked
                let tabTaxocheck = [];

                for (let i = 0; i < wh_check.length; i++) {

                    if (wh_check[i].checked) {

                        tabTaxocheck.push(wh_check[i].getAttribute('value'));

                    }
                }
                // is checked
                if (tabTaxocheck.length !== 0) {

                    let taxo = new Taxo();

                    taxo.taxonomy = $('.wh_taxo_display.' + i).find('.wh_taxonomyCheck').html();
                    taxo.terms = tabTaxocheck;

                    tabTaxos.push(taxo);
                }
            }
        }
        // filtre a partir de selection multiple

        if ($('#wh_Selects option')) {

            // recuperation nombre de fois utilisation de select
            let indiceSelects = $('#indiceSelects').html();

            for (var nbrSelect = 1; nbrSelect <= indiceSelects; nbrSelect++) {

                // recuparation les option courant
                let option = $('.wh_taxo_Selects.' + nbrSelect).find('option');

                // initialisation tableau select selecked
                let tabSelect = [];

                for (var i = 0; i < option.length; i++) {

                    if (option[i].selected) {

                        tabSelect.push(option[i].getAttribute('value'));
                    }
                }

                // is checked
                if (tabSelect.length !== 0) {

                    let taxo = new Taxo();

                    taxo.taxonomy = $('.wh_taxo_Selects.' + nbrSelect).find('.wh_taxonomySelects').html();
                    taxo.terms = tabSelect;

                    tabTaxos.push(taxo);
                }

            }
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
                // mise a jour de distance display
                $('#wh_distance').html('');               
                $('#wh_distance').html(distance + ' km');
                
                // requete ajax
                requetAjax(slugpostype, tabTaxos='', wh_lat, wh_lng, distance);

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
    if ($('#wh_Selects').attr('name')) {
        $('#wh_Selects').chosen();
    }

})



    