
class Taxo {

    constructor() {
        this.taxonomy;
        this.field = 'slug';
        this.terms;
        this.operator = 'IN';
    }

}

jQuery(function ($) {

    let slugpostype = $('.postetype_slug').html();

    function requetAjax(slugPost, tabTaxos = '') {


        $.post(wh_ajaxurl,
                {
                    'action': 'filtre_post',
                    'slugPost': slugPost,
                    'tabTaxos': tabTaxos,
                },
                function (response) {

                    $('.wh_postes.active').html('');

                    $('.wh_postes.active').append(response);
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

        if (tabTaxos.length !== 0 && slugpostype !== null) {

            // console.log(tabTaxo);

            requetAjax(slugpostype, tabTaxos);

        } else {

            requetAjax(slugpostype);

        }


    }


    if ($('#wh_filtres')) {
        // chargment de filtre
        $('#wh_filtres').change(filtre);
    }
    // mise en form
    if ($('#wh_Selects')) {
        $('#wh_Selects').chosen();
       // console.log('coucou');
    }

})
