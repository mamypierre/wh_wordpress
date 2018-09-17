
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
        let tabTaxos = [];
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

                    taxo.taxonomy = $('.wh_taxo_display.' + i).children('p').html();
                    taxo.terms = tabTaxocheck;

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




    $('.wh_taxo_display input').change(filtre);




})
