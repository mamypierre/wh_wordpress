<div class="wh_creat_post"> 

    <div class="wh_tittle_post" >
        <h6> entre les information du spost type </h6> 
    </div>
    <input type="hidden" name="creation" value="post"/>
    <div class="wh_parameter_post" >

        <div class="wh_label_nom_post" > 
            <label for="nom_post" >nom :</label> </div>
            <div class="wh_nom_post" > 
                <input id="nom_post" type="text" name="nom_post" value=""/> </div>
                
        <div class="wh_description_post" >
            <label for="description_post" >description :</label> </div>
            <div class="wh_label_description_post" >
                <input type="text" name="description_post" value=""/> </div>
        
    </div>
    <div class="wh_checkbox_post_option">
        <div class="wh_label_meta" >
            <label for="wh_meta">ajout de metabox</label>
        </div>
            <div class="wh_meta" >
                <input id="wh_meta" name="wh_meta" type="checkbox"/>
            </div>
        <div class="wh_label_taxo" >
            <label for="wh_taxo">ajout de taxonomie</label>
        </div>
            <div class="wh_taxo" >
                <input id="wh_taxo" name="wh_taxo" type="checkbox"/>
            </div>
        
    </div>
    <div class="wh_button_valid" > <?php submit_button('valider'); ?> </div>
</div>