jQuery(document).ready(function ($) {
    // VARIABLES A MODIFIER EN FONCTION DE CHAQUES SITE
    var hauteur_du_menu = 112;
    var url_image_par_defaut = "https://alf.waouh.cool/wp-content/uploads/2018/10/pin-map-alf-1.png";
    // /////////////////////////////////////////////////
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
        addNewMarker(lat, log, marText = '') {

            let myLatLng = new google.maps.LatLng(lat, log);


            let marker = new this.texMarker(myLatLng, this.map, marText);

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

        var markers = [];

        let activeMarker = null;

        await  map.load($map, api_google);
        var latlngbounds = new google.maps.LatLngBounds();

        Array.from(document.querySelectorAll('.wh_poste')).forEach(function (item) {


            if (item.dataset.lat && item.dataset.log) {

                // let marTex = item.getElementsByTagName("p")[0].innerHTML;
                let marTex = '<div class=marker><?xml version="1.0" encoding="utf-8"?><!-- Generator: Adobe Illustrator 22.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --><svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"     viewBox="0 0 48 67.2" style="enable-background:new 0 0 48 67.2;" xml:space="preserve"><style type="text/css">    .st0{fill:#2A3D4B;}</style><path class="st0" d="M0,0v48.1h24.5v19L48,48V0H0zM34.9,34.9H13.2V13.2h21.7V34.9z"/></svg></div>';

                // let marker = map.addNewMarker(item.dataset.lat, item.dataset.log,marTex);
                let latitude = item.dataset.lat;
                let longitude = item.dataset.log;


                var myLatlng = new google.maps.LatLng(latitude, longitude);
                var mapOptions = {
                    zoom: 4,
                    center: myLatlng
                }

                var contentString = '<div class="wh_temporary_container"><div class="wh_temporary" width="60px" height="60px" style="background:url(' + $(item).prev().find('.wh_image').attr('src') + ')"></div></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString,

                });

                infowindow.setOptions("maxWidth", 60);

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    animation: google.maps.Animation.DROP,
                    icon: url_image_par_defaut
                });

                infowindow.open(map, marker);


                // To add the marker to the map, call setMap();
                marker.setMap(map.map);

                //Extend each marker's position in LatLngBounds object.
                latlngbounds.extend(marker.position);


                markers.push(marker);

            }

        });

        map.centerMaps();
        //Get the boundaries of the Map.
        var bounds = new google.maps.LatLngBounds();

        //Center map and adjust Zoom based on the position of all markers.
        map.map.setCenter(latlngbounds.getCenter());
        map.map.fitBounds(latlngbounds);

        var markerCluster = new MarkerClusterer(map.map, markers,
                {
                    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
                });

        let current_map = document.querySelector('.wh_map');
        current_map.setAttribute("style", "width: " + current_map.offsetWidth + "px;");
        // Ici on créer nos box custom sur la map

        var checkExist = setInterval(function () {
            if ($(".wh_temporary_container").length) {
                clearInterval(checkExist);
                $('.wh_temporary_container').each(function (index, el) {
                    $(el).closest('.gm-style-iw').parent().html($(el).closest('.gm-style-iw'))

                });
            }
        }, 100);



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
        $('.wh_cont').addClass('is-8');
    } else {// supresion de l'emplacement de la map
        // supression de l'emplacement de du map


        let div_map = document.querySelector('.wh_map.column.is-4');
        div_map.parentNode.removeChild(div_map);

        if ($('.wh_annuaire_element.is-half').length) {
            $('.wh_annuaire_element').removeClass('is-half');
            $('.wh_annuaire_element').addClass('is-3');
        }


    }


    function rechargeMaps() {
        initMap_whith_api();
    }



    // creation class double slide

    class wh_slides2 {

        constructor() {
            this.key;
            this.value;
            this.compare;
        }

    }
    //  creation ajax et filtre

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

            // mise a jour du valeur du slide

            // creation_slider
            $('.wh_silde_content').addClass('column is-12');

            // mise a jour du valeur du slide
            $('#wh_Range').change(function () {
                $('#wh_distance').html('');
                $('#wh_distance').html($(this).attr('value') + ' km');
            });

        }

    }
    // geolocalisation de position courent
    if ($('.wh_map').length) {
        // geolocalisation de position courent
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(maPosition, error, options);
        }
    }





    // posistion .sticky

    if ($(".wh_map").length && $(window).width() > 768) {
        var yourNavigation = $(".wh_map");
        let stickyDiv = "wh_sticky";
        let yourHeader = yourNavigation.offset().top - hauteur_du_menu;
        var normal_map_width = $(".wh_map").width();
        var stickywidth = $(window).width() - $(".wh_map").offset().left;
        var normal_map_height = $(".wh_map").height();

        $(window).scroll(function () {

            if ($(this).scrollTop() >= yourHeader) {
                yourNavigation.addClass(stickyDiv);
                yourNavigation.width(stickywidth);
            } else {
                yourNavigation.removeClass(stickyDiv);
                yourNavigation.width(normal_map_width)
            }
            var distance_btwn = ($('.wh_map').offset().top + $('.wh_map').height()) - $('footer').offset().top;
            if (distance_btwn >= 0) {
                $('#wh_map').height($('.wh_map').height() - distance_btwn)
            } else {
                $('#wh_map').height($(window).height() - hauteur_du_menu);
            }
        });
    }

    // filtre
    let slugpostype = $('.postetype_slug').html();
    let distance = $('#wh_Range').attr('value');

    function requetAjax(slugPost, tabTaxos = '', lnt = '', lng = '', distance = '', tabSlide2 = '') {


        $.post(wh_ajaxurl,
                {
                    'action': 'filtre_post',
                    'slugPost': slugPost,
                    'tabTaxos': tabTaxos,
                    'lnt': lnt,
                    'lng': lng,
                    'distance': distance,
                    'tabSlide2': tabSlide2
                },
                function (response) {

                    if (response != 0) {

                        if ($('.wh_map_sup').length) {

                            $('.wh_map').removeClass('wh_map_sup');

                        }
                        $('.wh_postes.active').html('');

                        $('.wh_postes.active').append(response);
                        // recharge de la map
                        if ($map !== null && isMap()) {
                            rechargeMaps();

                        } else {

                            if ($('.wh_annuaire_element.is-half').length) {
                                $('.wh_annuaire_element').removeClass('is-half');
                                $('.wh_annuaire_element').addClass('is-3');
                            }

                        }

                    } else {

                        if ($('.wh_map').length) {

                            $('.wh_map').addClass('wh_map_sup');

                        }

                        $('.wh_postes.active').html('Désolé, aucun résultat n\'a été trouvé');

                    }
                }
        );

    }


    let  filtre = function () {

        //initiation des tableau de taxonomie
        let tabTaxos = [];
        // initialisation des tableau du double slide
        let tabSlide2 = [];
        //filtre a partir de checkbox
        if ($('.wh_taxo_display input[type=checkbox]')) {

            //recuperation des checked
            $(".wh_taxo_display").each(function (index1) {
                // initialisation tu tableau checkbox checked
                
                let taxonomy = $(this).attr('wh_taxonomy');

                $(this).find('input').each(function (index2) {

                    if ($(this).attr("checked")) {

                       
                        let taxo = new Taxo();

                        taxo.taxonomy = taxonomy;
                        taxo.terms = $(this).attr('value');

                        tabTaxos.push(taxo);

                    }

                });

            });
        }
        // filtre a partir de selection multiple

        if ($('.wh_Selects option').length) {

            //// recuperation nombre de fois utilisation de select
            $(".wh_taxo_Selects").each(function (index1) {
                // initialisation tu tableau checkbox checked
                
                let taxonomy = $(this).attr('wh_taxonomySelects');
                $(this).find('option').each(function (index2) {

                    if ($(this).attr("selected")) {

                        let taxo = new Taxo();

                        taxo.taxonomy = taxonomy;
                        taxo.terms = $(this).attr('value');

                        tabTaxos.push(taxo);

                    }

                });

            });

        }
        // recuperation des information de double slide
        if ($('.wh_filtre_range').length) {

            $('.wh_filtre_range').each(function () {
                // recuperation d u keys meta_query
                let slug = $(this).attr('slug');

                if ($(this).find('.wh_value_min').attr('value') !== $(this).find('.wh_value_min').attr('min') ||
                        $(this).find('.wh_value_max').attr('value') !== $(this).find('.wh_value_max').attr('max')) {

                    $(this).find('.wh_value_min').each(function () {

                        let slideMim = new wh_slides2();

                        slideMim.key = slug;
                        slideMim.value = $(this).attr('value');
                        slideMim.compare = '>';
                        tabSlide2.push(slideMim);
                    })
                    $(this).find('.wh_value_max').each(function () {

                        let slideMax = new wh_slides2();

                        slideMax.key = slug;
                        slideMax.value = $(this).attr('value');
                        slideMax.compare = '<';
                        tabSlide2.push(slideMax);
                    })

                }

            })


        }
        // recuperation des information de meta select
        if ($('.wh_metas_select').length) {

            $('.wh_metas_select').each(function () {
                // recuperation d u keys meta_query
                let slug = $(this).attr('wh_key_meta');

                $(this).find('option').each(function () {

                    if ($(this).attr("selected")) {

                        let slideMax = new wh_slides2();

                        slideMax.key = slug;
                        slideMax.value = $(this).attr('value');
                        slideMax.compare = '=';
                        tabSlide2.push(slideMax);
                    }

                });

            })

        }
        // recuperation des information de meta checbox
        if ($('.wh_metas_checkbox').length) {

            $('.wh_metas_checkbox').each(function () {
                // recuperation d u keys meta_query
                let slug = $(this).attr('wh_key_meta');

                $(this).find('input').each(function () {

                    if ($(this).attr("checked")) {

                        let slideMax = new wh_slides2();

                        slideMax.key = slug;
                        slideMax.value = $(this).attr('value');
                        slideMax.compare = '=';
                        tabSlide2.push(slideMax);
                    }

                });

            })

        }
        // recuperation des information de meta radio
        if ($('.wh_metas_radio').length) {

            $('.wh_metas_radio').each(function () {
                // recuperation d u keys meta_query
                let slug = $(this).attr('wh_key_meta');

                $(this).find('input').each(function () {

                    if ($(this).attr("checked")) {

                        let slideMax = new wh_slides2();

                        slideMax.key = slug;
                        slideMax.value = $(this).attr('value');
                        slideMax.compare = '=';
                        tabSlide2.push(slideMax);
                    }

                });

            })

        }
        if (slugpostype !== null) {

            if (tabTaxos.length !== 0 && distance !== null && tabSlide2.length !== 0 && $("#wh_Range").attr('value') > 0) {
                distance = $("#wh_Range").attr('value');

                // appel requete ajax
                requetAjax(slugpostype, tabTaxos, wh_lat, wh_lng, distance, tabSlide2);

            } else if (tabTaxos.length !== 0 && tabSlide2.length !== 0) {

                // appel requete ajax
                requetAjax(slugpostype, tabTaxos, lnt = '', lng = '', distance = '', tabSlide2);

            } else if (distance !== null && tabSlide2.length !== 0 && $("#wh_Range").attr('value') > 0) {
                distance = $("#wh_Range").attr('value');
                // appel requete ajax
                requetAjax(slugpostype, tabTaxos = '', wh_lat, wh_lng, distance, tabSlide2);

            } else if (tabTaxos.length !== 0 && distance !== null && $("#wh_Range").attr('value') > 0) {

                distance = $("#wh_Range").attr('value');

                // appel requete ajax
                requetAjax(slugpostype, tabTaxos, wh_lat, wh_lng, distance);

            } else if (tabTaxos.length !== 0) {


                requetAjax(slugpostype, tabTaxos);

            } else if (distance !== null && $("#wh_Range").attr('value') > 0) {

                distance = $("#wh_Range").attr('value');

                // requete ajax
                requetAjax(slugpostype, tabTaxos = '', wh_lat, wh_lng, distance);

            } else if (tabSlide2.length !== 0) {

                // appel requete ajax
                requetAjax(slugpostype, tabTaxos = '', lnt = '', lng = '', distance = '', tabSlide2);

            } else {

                requetAjax(slugpostype);

            }



        }



    }

    // mise en form
    if ($('.wh_Selects').attr('name')) {
        $('.wh_Selects').each(function () {
            $(this).chosen();
        });
    }
    // mise en form
    if ($('.wh_meta').length) {
        $('.wh_meta').each(function () {
            $(this).chosen();
        });
    }
    //double slider
    if ($('.wh_filtre_range').length) {

        $(".slider-range").each(function () {
            //valeur initial
            let wh_min = $(this).attr('min');
            let wh_max = $(this).attr('max');
            let symbole = $(this).attr('symbole');
            wh_min = parseInt(wh_min);
            wh_max = parseInt(wh_max);

            let wh_symbole = symbole;
            // valeur a mettre a jour
            let amount = $(this).parent('.wh_filtre_range').find('.amount');
            let val_min = $(this).parent('.wh_filtre_range').find('.wh_value_min');
            let val_max = $(this).parent('.wh_filtre_range').find('.wh_value_max');
            //console.log(parseInt(wh_min));
            $(this).slider({
                range: true,
                min: wh_min,
                max: wh_max,
                values: [wh_min, wh_max],
                slide: function (event, ui) {
                    amount.val(ui.values[ 0 ] + ' ' + wh_symbole + " - " + ui.values[ 1 ] + ' ' + wh_symbole);

                    val_min.val(ui.values[ 0 ]);
                    val_max.val(ui.values[ 1 ]);
                    // recharge de filtre
                    filtre();

                }
            });

            amount.val($(this).slider("values", 0) + ' ' + wh_symbole +
                    " - " + $(this).slider("values", 1) + ' ' + wh_symbole);
            val_min.val($(this).slider("values", 0));
            val_max.val($(this).slider("values", 1));

        })

    }



    if ($('#wh_filtres').length) {
        // chargment de filtre
        $('#wh_filtres').change(filtre);
    }

    if (wh_lat !== null && wh_lng !== null && isMap()) {

        filtre();

    }
    // reinitialisation
    $('#wh_reinit').click(function () {

        //reinitialisation des checkebox
        if ($('.wh_taxo_display input[type=checkbox]').length) {

            $(".wh_taxo_display").each(function () {


                $(this).find('input').each(function () {

                    if ($(this).attr("checked")) {

                        $(this).prop("checked", false);
                    }

                });

            });
        }
        //reinitialisation des checkebox metabox
        if ($('.wh_metas_checkbox input[type=checkbox]').length) {

            $(".wh_metas_checkbox").each(function () {


                $(this).find('input').each(function () {

                    if ($(this).attr("checked")) {

                        $(this).prop("checked", false);
                    }

                });

            });
        }
        //reinitialisation des radio metabox
        if ($('.wh_metas_radio input[type=radio]').length) {

            $(".wh_metas_radio").each(function () {


                $(this).find('input').each(function () {

                    if ($(this).attr("checked")) {

                        $(this).prop("checked", false);
                    }

                });

            });
        }
        //reinitialisation des select
        if ($('.wh_Selects option')) {

            $(".wh_taxo_Selects").each(function () {
                $(this).find('option').each(function () {

                    if ($(this).attr("selected")) {
                        $(this).prop("selected", false);
                        $(this).val('').trigger('chosen:updated');
                    }

                });
            });

            $(".wh_meta").each(function () {
                $(this).find('option').each(function () {

                    if ($(this).attr("selected")) {
                        $(this).prop("selected", false);
                        $(this).val('').trigger('chosen:updated');
                    }

                });
            });

        }
        if ($('.wh_check.ex').length) {

            $('.wh_check.ex').each(function () {


                $(this).prop("checked", true);


            });
        }
        if (distance !== null && $("#wh_Range").attr('value') > 0) {
            $('#wh_Range').val(0);
            $('#wh_distance').html('0 km');

        }

        filtre();
    })



});
