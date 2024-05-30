<?php 
global $wpchatbot_pro_professional_init,$wpchatbot_pro_master_init;
if((isset($wpchatbot_pro_master_init) && $wpchatbot_pro_master_init->is_valid()) || (isset($wpchatbot_pro_professional_init) && $wpchatbot_pro_professional_init->is_valid()) || (function_exists('get_openaiaddon_valid_license') && get_openaiaddon_valid_license())){
?>
<style>
    .image-grid {
        display: flex;
        flex-wrap: wrap;
    }

    .image-item {
        margin: 10px;
        width: 256;
        height: 256;
        background-size: cover;
        box-shadow: 0px 0px 10px #ccc;
    }

    .select-element {
        margin: 10px;
    }

    .button-element {
        background-color: #4169E1;
        /* this is the blue color */
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .button-element:hover {
        background-color: #6495ED;
        /* this is a slightly lighter blue color on hover */
        box-shadow: 0px 0px 10px #B0C4DE;
        /* this is a subtle shadow on hover */
        transform: translateY(-2px);
        /* this is a subtle upward movement on hover */
    }


    textarea {
        width: 100%;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        resize: none;
    }
.qcld_seo_grid_form{
    grid-template-columns: repeat(3,1fr);
    grid-column-gap: 20px;
    grid-row-gap: 20px;
    display: grid;
    grid-template-rows: auto auto;
    margin-top: 20px;

}
.qcld_seo_grid_form #wpai_preview_title{
    font-size: 20px;
    padding: 1px 12px;
}
.qcld_seo_grid_form_1{
    grid-column: span 1/span 1;
}
.qcld_seo_grid_form_2{
    grid-column: span 2/span 1;
}
.qcld_seo-collapse{}
.qcld_seo-collapse:last-of-type{
    border-bottom: 1px solid #ccc;
}
.qcld_seo-collapse-title span{
    display: inline-block;
    margin-right: 5px;
}
.qcld_seo-collapse-title{
    padding: 10px;
    background: #fff;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    font-size: 14px;
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: bold;
}
.qcld_seo-collapse-active .qcld_seo-collapse-title{}
.qcld_seo-collapse-content{
    display: none;
    background: #f1f1f1;
    padding: 10px;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}
.qcld_seo-collapse-active .qcld_seo-collapse-content{
    display: block;
}
.qcld_seo-collapse-content .qcld_seo-form-label{
    display: inline-block;
    width: 50%;
}
.qcld_seo-collapse-content select,.qcld_seo-collapse-content input[type=text],.qcld_seo-collapse-content input[type=url]{
    display: inline-block!important;
    width: 48%!important;
}
@media(max-width: 480px){
    .qcld_seo-grid{
        grid-template-columns: repeat(1,1fr);
        grid-column-gap: 10px;
        grid-row-gap: 10px;
    }
    .qcld_seo-grid-1{}
    .qcld_seo-grid-2{
        grid-column: span 1/span 1;
    }
    .qcld_seo-grid-5{
        grid-column: span 1/span 1;
    }
    .qcld_seo-grid-6{
        grid-column: span 1/span 1;
    }
}
</style>

<div class="wrap fs-section">
    
    <div id="poststuff">
        <div id="fs_account">
            
            <div class="qcld_seo_grid_form" id="qcld_seo-post-form">
                <div class="qcld_seo_grid_form_2">
                    <form class="qcld_seo-single-content-form" method="post">

                    
                    <div class="mb-5">
                        <label for="prompt"><?php esc_html_e('Prompt'); ?>:</label>
                        <textarea name="prompt" id="prompt" rows="2" cols="50"></textarea>
                        <button class="button-element qcld_botopenai_generate_image" name="generate"><?php esc_html_e( 'Generate', 'qcld-seo-help' ); ?></button>
                    
                    </div>
                    <div class="mb-5">
                        <div id="qcld_seo-tab-generated-text">
                        </div>
                    </div>
                </div>
                <div class="qcld_seo_grid_form_1">
                    <div class="qcld_seo-collapse qcld_seo-collapse-active">
                        <div class="qcld_seo-collapse-title"><span>-</span><?php esc_html_e('Settings', 'qcld-seo-help'); ?></div>
                        <div class="qcld_seo-collapse-content">
                            <div class="mb-5">
                                <label for="artist" class="qcld_seo-form-label"><?php esc_html_e('Artist:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="artist" id="artist">
                                    <option value="Salvador Dalí" selected=""><?php esc_html_e('Salvador Dalí', 'qcld-seo-help'); ?></option>
                                    <option value="Leonardo da Vinci"><?php esc_html_e('Leonardo da Vinci', 'qcld-seo-help'); ?></option>
                                    <option value="Michelangelo"><?php esc_html_e('Michelangelo', 'qcld-seo-help'); ?></option>
                                    <option value="Rembrandt"><?php esc_html_e('Rembrandt', 'qcld-seo-help'); ?></option>
                                    <option value="Van Gogh"><?php esc_html_e('Van Gogh', 'qcld-seo-help'); ?></option>
                                    <option value="Monet"><?php esc_html_e('Monet', 'qcld-seo-help'); ?></option>
                                    <option value="Vermeer"><?php esc_html_e('Vermeer', 'qcld-seo-help'); ?></option>
                                    <option value="Johannes Vermeer"><?php esc_html_e('Johannes Vermeer', 'qcld-seo-help'); ?></option>
                                    <option value="Raphael"><?php esc_html_e('Raphael', 'qcld-seo-help'); ?></option>
                                    <option value="Titian"><?php esc_html_e('Titian', 'qcld-seo-help'); ?></option>
                                    <option value="Degas"><?php esc_html_e('Degas', 'qcld-seo-help'); ?></option>
                                    <option value="Edgar Degas"><?php esc_html_e('Edgar Degas', 'qcld-seo-help'); ?></option>
                                    <option value="El Greco"><?php esc_html_e('El Greco', 'qcld-seo-help'); ?></option>
                                    <option value="Cézanne"><?php esc_html_e('Cézanne', 'qcld-seo-help'); ?></option>
                                    <option value="Paul Cézanne"><?php esc_html_e('Paul Cézanne', 'qcld-seo-help'); ?></option>
                                    <option value="Caravaggio"><?php esc_html_e('Caravaggio', 'qcld-seo-help'); ?></option>
                                    <option value="Gustav Klimt"><?php esc_html_e('Gustav Klimt', 'qcld-seo-help'); ?></option>
                                    <option value="Henri Matisse"><?php esc_html_e('Henri Matisse', 'qcld-seo-help'); ?></option>
                                    <option value="Pablo Picasso"><?php esc_html_e('Pablo Picasso', 'qcld-seo-help'); ?></option>
                                    <option value="Diego Velázquez"><?php esc_html_e('Diego Velázquez', 'qcld-seo-help'); ?></option>
                                    <option value="Sandro Botticelli"><?php esc_html_e('Sandro Botticelli', 'qcld-seo-help'); ?></option>
                                    <option value="Jan van Eyck"><?php esc_html_e('Jan van Eyck', 'qcld-seo-help'); ?></option>
                                    <option value="Albrecht Dürer"><?php esc_html_e('Albrecht Dürer', 'qcld-seo-help'); ?></option>
                                    <option value="Canaletto"><?php esc_html_e('Canaletto', 'qcld-seo-help'); ?></option>
                                    <option value="Frida Kahlo"><?php esc_html_e('Frida Kahlo', 'qcld-seo-help'); ?></option>
                                    <option value="Eugene Delacroix"><?php esc_html_e('Eugene Delacroix', 'qcld-seo-help'); ?></option>
                                    <option value="Gustav Courbet"><?php esc_html_e('Gustav Courbet', 'qcld-seo-help'); ?></option>
                                    <option value="John Singer Sargent"><?php esc_html_e('John Singer Sargent', 'qcld-seo-help'); ?></option>
                                    <option value="Georges Seurat"><?php esc_html_e('Georges Seurat', 'qcld-seo-help'); ?></option>
                                    <option value="Alfred Sisley"><?php esc_html_e('Alfred Sisley', 'qcld-seo-help'); ?></option>
                                    <option value="Pierre-Auguste Renoir"><?php esc_html_e('Pierre-Auguste Renoir', 'qcld-seo-help'); ?></option>
                                    <option value="Tintoretto"><?php esc_html_e('Tintoretto', 'qcld-seo-help'); ?></option>
                                    <option value="Frederic Edwin Church"><?php esc_html_e('Frederic Edwin Church', 'qcld-seo-help'); ?></option>
                                    <option value="John Everett Millais"><?php esc_html_e('John Everett Millais', 'qcld-seo-help'); ?></option>
                                    <option value="JMW Turner"><?php esc_html_e('JMW Turner', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="art_style" class="qcld_seo-form-label"><?php esc_html_e('Style:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="art_style" id="art_style">
                                    <option value="Surrealism" selected=""><?php esc_html_e('Surrealism', 'qcld-seo-help'); ?></option>
                                    <option value="Early Renaissance"><?php esc_html_e('Early Renaissance', 'qcld-seo-help'); ?></option>
                                    <option value="Abstract"><?php esc_html_e('Abstract', 'qcld-seo-help'); ?></option>
                                    <option value="Abstract Expressionism"><?php esc_html_e('Abstract Expressionism', 'qcld-seo-help'); ?></option>
                                    <option value="Action Painting"><?php esc_html_e('Action Painting', 'qcld-seo-help'); ?></option>
                                    <option value="Art Deco"><?php esc_html_e('Art Deco', 'qcld-seo-help'); ?></option>
                                    <option value="Art Nouveau"><?php esc_html_e('Art Nouveau', 'qcld-seo-help'); ?></option>
                                    <option value="Baroque"><?php esc_html_e('Baroque', 'qcld-seo-help'); ?></option>
                                    <option value="Cubism"><?php esc_html_e('Cubism', 'qcld-seo-help'); ?></option>
                                    <option value="Digital Art"><?php esc_html_e('Digital Art', 'qcld-seo-help'); ?></option>
                                    <option value="Expressionism"><?php esc_html_e('Expressionism', 'qcld-seo-help'); ?></option>
                                    <option value="Fauvism"><?php esc_html_e('Fauvism', 'qcld-seo-help'); ?></option>
                                    <option value="High Renaissance"><?php esc_html_e('High Renaissance', 'qcld-seo-help'); ?></option>
                                    <option value="Impressionism"><?php esc_html_e('Impressionism', 'qcld-seo-help'); ?></option>
                                    <option value="Mannerism"><?php esc_html_e('Mannerism', 'qcld-seo-help'); ?></option>
                                    <option value="Minimalism"><?php esc_html_e('Minimalism', 'qcld-seo-help'); ?></option>
                                    <option value="Naïve Art"><?php esc_html_e('Naïve Art', 'qcld-seo-help'); ?></option>
                                    <option value="Northern Renaissance"><?php esc_html_e('Northern Renaissance', 'qcld-seo-help'); ?></option>
                                    <option value="Pop Art"><?php esc_html_e('Pop Art', 'qcld-seo-help'); ?></option>
                                    <option value="Post-Impressionism"><?php esc_html_e('Post-Impressionism', 'qcld-seo-help'); ?></option>
                                    <option value="Realism"><?php esc_html_e('Realism', 'qcld-seo-help'); ?></option>
                                    <option value="Rococo"><?php esc_html_e('Rococo', 'qcld-seo-help'); ?></option>
                                    <option value="Romanticism"><?php esc_html_e('Romanticism', 'qcld-seo-help'); ?></option>
                                    <option value="Symbolism"><?php esc_html_e('Symbolism', 'qcld-seo-help'); ?></option>
                                    <option value="Ukiyo-e"><?php esc_html_e('Ukiyo-e', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="photography_style" class="qcld_seo-form-label"><?php esc_html_e('Photography:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="photography_style" id="photography_style">
                                    <option value="Portrait" selected=""><?php esc_html_e('Portrait', 'qcld-seo-help'); ?></option>
                                    <option value="Landscape"><?php esc_html_e('Landscape', 'qcld-seo-help'); ?></option>
                                    <option value="Street"><?php esc_html_e('Street', 'qcld-seo-help'); ?></option>
                                    <option value="Macro"><?php esc_html_e('Macro', 'qcld-seo-help'); ?></option>
                                    <option value="Abstract"><?php esc_html_e('Abstract', 'qcld-seo-help'); ?></option>
                                    <option value="Fine art"><?php esc_html_e('Fine art', 'qcld-seo-help'); ?></option>
                                    <option value="Black and white"><?php esc_html_e('Black and white', 'qcld-seo-help'); ?></option>
                                    <option value="Night"><?php esc_html_e('Night', 'qcld-seo-help'); ?></option>
                                    <option value="Sports"><?php esc_html_e('Sports', 'qcld-seo-help'); ?></option>
                                    <option value="Fashion"><?php esc_html_e('Fashion', 'qcld-seo-help'); ?></option>
                                    <option value="Wildlife"><?php esc_html_e('Wildlife', 'qcld-seo-help'); ?></option>
                                    <option value="Nature"><?php esc_html_e('Nature', 'qcld-seo-help'); ?></option>
                                    <option value="Travel"><?php esc_html_e('Travel', 'qcld-seo-help'); ?></option>
                                    <option value="Documentary"><?php esc_html_e('Documentary', 'qcld-seo-help'); ?></option>
                                    <option value="Food"><?php esc_html_e('Food', 'qcld-seo-help'); ?></option>
                                    <option value="Architecture"><?php esc_html_e('Architecture', 'qcld-seo-help'); ?></option>
                                    <option value="Industrial"><?php esc_html_e('Industrial', 'qcld-seo-help'); ?></option>
                                    <option value="Conceptual"><?php esc_html_e('Conceptual', 'qcld-seo-help'); ?></option>
                                    <option value="Candid"><?php esc_html_e('Candid', 'qcld-seo-help'); ?></option>
                                    <option value="Underwater"><?php esc_html_e('Underwater', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="lighting" class="qcld_seo-form-label"><?php esc_html_e('Lighting:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="lighting" id="lighting">
                                    <option value="Ambient" selected><?php esc_html_e('Ambient', 'qcld-seo-help'); ?></option>
                                    <option value="Artificial light"><?php esc_html_e('Artificial light', 'qcld-seo-help'); ?></option>
                                    <option value="Backlight"><?php esc_html_e('Backlight', 'qcld-seo-help'); ?></option>
                                    <option value="Black light"><?php esc_html_e('Black light', 'qcld-seo-help'); ?></option>
                                    <option value="Blue hour"><?php esc_html_e('Blue hour', 'qcld-seo-help'); ?></option>
                                    <option value="Candle light"><?php esc_html_e('Candle light', 'qcld-seo-help'); ?></option>
                                    <option value="Chiaroscuro"><?php esc_html_e('Chiaroscuro', 'qcld-seo-help'); ?></option>
                                    <option value="Cloudy"><?php esc_html_e('Cloudy', 'qcld-seo-help'); ?></option>
                                    <option value="Color gels"><?php esc_html_e('Color gels', 'qcld-seo-help'); ?></option>
                                    <option value="Continuous light"><?php esc_html_e('Continuous light', 'qcld-seo-help'); ?></option>
                                    <option value="Contre-jour"><?php esc_html_e('Contre-jour', 'qcld-seo-help'); ?></option>
                                    <option value="Direct light"><?php esc_html_e('Direct light', 'qcld-seo-help'); ?></option>
                                    <option value="Direct sunlight"><?php esc_html_e('Direct sunlight', 'qcld-seo-help'); ?></option>
                                    <option value="Diffused light"><?php esc_html_e('Diffused light', 'qcld-seo-help'); ?></option>
                                    <option value="Firelight"><?php esc_html_e('Firelight', 'qcld-seo-help'); ?></option>
                                    <option value="Flash"><?php esc_html_e('Flash', 'qcld-seo-help'); ?></option>
                                    <option value="Flat light"><?php esc_html_e('Flat light', 'qcld-seo-help'); ?></option>
                                    <option value="Fluorescent"><?php esc_html_e('Fluorescent', 'qcld-seo-help'); ?></option>
                                    <option value="Fog"><?php esc_html_e('Fog', 'qcld-seo-help'); ?></option>
                                    <option value="Front light"><?php esc_html_e('Front light', 'qcld-seo-help'); ?></option>
                                    <option value="Golden hour"><?php esc_html_e('Golden hour', 'qcld-seo-help'); ?></option>
                                    <option value="Hard light"><?php esc_html_e('Hard light', 'qcld-seo-help'); ?></option>
                                    <option value="Soft light"><?php esc_html_e('Soft light', 'qcld-seo-help'); ?></option>
                                    <option value="Rim light"><?php esc_html_e('Rim light', 'qcld-seo-help'); ?></option>
                                    <option value="Backlight"><?php esc_html_e('Backlight', 'qcld-seo-help'); ?></option>
                                    <option value="Silhouette"><?php esc_html_e('Silhouette', 'qcld-seo-help'); ?></option>
                                    <option value="Natural light"><?php esc_html_e('Natural light', 'qcld-seo-help'); ?></option>
                                    <option value="Studio light"><?php esc_html_e('Studio light', 'qcld-seo-help'); ?></option>
                                    <option value="Flash"><?php esc_html_e('Flash', 'qcld-seo-help'); ?></option>
                                    <option value="Continuous light"><?php esc_html_e('Continuous light', 'qcld-seo-help'); ?></option>
                                    <option value="High key"><?php esc_html_e('High key', 'qcld-seo-help'); ?></option>
                                    <option value="Low key"><?php esc_html_e('Low key', 'qcld-seo-help'); ?></option>
                                    <option value="Golden hour"><?php esc_html_e('Golden hour', 'qcld-seo-help'); ?></option>
                                    <option value="Blue hour"><?php esc_html_e('Blue hour', 'qcld-seo-help'); ?></option>
                                    <option value="Diffused light"><?php esc_html_e('Diffused light', 'qcld-seo-help'); ?></option>
                                    <option value="Reflected light"><?php esc_html_e('Reflected light', 'qcld-seo-help'); ?></option>
                                    <option value="Shaded light"><?php esc_html_e('Shaded light', 'qcld-seo-help'); ?></option>
                                    <option value="Side light"><?php esc_html_e('Side light', 'qcld-seo-help'); ?></option>
                                    <option value="Direct light"><?php esc_html_e('Direct light', 'qcld-seo-help'); ?></option>
                                    <option value="Artificial light"><?php esc_html_e('Artificial light', 'qcld-seo-help'); ?></option>
                                    <option value="Moonlight"><?php esc_html_e('Moonlight', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>

                            </div>
                            <div class="mb-5">
                                <label for="subject" class="qcld_seo-form-label"><?php esc_html_e('Subject:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="subject" id="subject">
                                    <option value="Landscapes" selected><?php esc_html_e('Landscapes', 'qcld-seo-help'); ?></option>
                                    <option value="People"><?php esc_html_e('People', 'qcld-seo-help'); ?></option>
                                    <option value="Animals"><?php esc_html_e('Animals', 'qcld-seo-help'); ?></option>
                                    <option value="Food"><?php esc_html_e('Food', 'qcld-seo-help'); ?></option>
                                    <option value="Cars"><?php esc_html_e('Cars', 'qcld-seo-help'); ?></option>
                                    <option value="Architecture"><?php esc_html_e('Architecture', 'qcld-seo-help'); ?></option>
                                    <option value="Flowers"><?php esc_html_e('Flowers', 'qcld-seo-help'); ?></option>
                                    <option value="Still life"><?php esc_html_e('Still life', 'qcld-seo-help'); ?></option>
                                    <option value="Portrait"><?php esc_html_e('Portrait', 'qcld-seo-help'); ?></option>
                                    <option value="Cityscapes"><?php esc_html_e('Cityscapes', 'qcld-seo-help'); ?></option>
                                    <option value="Seascapes"><?php esc_html_e('Seascapes', 'qcld-seo-help'); ?></option>
                                    <option value="Nature"><?php esc_html_e('Nature', 'qcld-seo-help'); ?></option>
                                    <option value="Action"><?php esc_html_e('Action', 'qcld-seo-help'); ?></option>
                                    <option value="Events"><?php esc_html_e('Events', 'qcld-seo-help'); ?></option>
                                    <option value="Street"><?php esc_html_e('Street', 'qcld-seo-help'); ?></option>
                                    <option value="Abstract"><?php esc_html_e('Abstract', 'qcld-seo-help'); ?></option>
                                    <option value="Candid"><?php esc_html_e('Candid', 'qcld-seo-help'); ?></option>
                                    <option value="Underwater"><?php esc_html_e('Underwater', 'qcld-seo-help'); ?></option>
                                    <option value="Night"><?php esc_html_e('Night', 'qcld-seo-help'); ?></option>
                                    <option value="Wildlife"><?php esc_html_e('Wildlife', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="camera_settings" class="qcld_seo-form-label"><?php esc_html_e('Camera:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="camera_settings" id="camera_settings">
                                    <option value="Aperture" selected><?php esc_html_e('Aperture', 'qcld-seo-help'); ?></option>
                                    <option value="Shutter speed"><?php esc_html_e('Shutter speed', 'qcld-seo-help'); ?></option>
                                    <option value="ISO"><?php esc_html_e('ISO', 'qcld-seo-help'); ?></option>
                                    <option value="White balance"><?php esc_html_e('White balance', 'qcld-seo-help'); ?></option>
                                    <option value="Exposure compensation"><?php esc_html_e('Exposure compensation', 'qcld-seo-help'); ?></option>
                                    <option value="Focus mode"><?php esc_html_e('Focus mode', 'qcld-seo-help'); ?></option>
                                    <option value="Metering mode"><?php esc_html_e('Metering mode', 'qcld-seo-help'); ?></option>
                                    <option value="Drive mode"><?php esc_html_e('Drive mode', 'qcld-seo-help'); ?></option>
                                    <option value="Image stabilization"><?php esc_html_e('Image stabilization', 'qcld-seo-help'); ?></option>
                                    <option value="Auto-Focus point"><?php esc_html_e('Auto-Focus point', 'qcld-seo-help'); ?></option>
                                    <option value="Flash mode"><?php esc_html_e('Flash mode', 'qcld-seo-help'); ?></option>
                                    <option value="Flash compensation"><?php esc_html_e('Flash compensation', 'qcld-seo-help'); ?></option>
                                    <option value="Picture style/picture control"><?php esc_html_e('Picture style/picture control', 'qcld-seo-help'); ?></option>
                                    <option value="Long exposure"><?php esc_html_e('Long exposure', 'qcld-seo-help'); ?></option>
                                    <option value="High-speed sync"><?php esc_html_e('High-speed sync', 'qcld-seo-help'); ?></option>
                                    <option value="Mirror lock-up"><?php esc_html_e('Mirror lock-up', 'qcld-seo-help'); ?></option>
                                    <option value="Bracketing"><?php esc_html_e('Bracketing', 'qcld-seo-help'); ?></option>
                                    <option value="Noise reduction"><?php esc_html_e('Noise reduction', 'qcld-seo-help'); ?></option>
                                    <option value="Image format"><?php esc_html_e('Image format', 'qcld-seo-help'); ?></option>
                                    <option value="Time-lapse"><?php esc_html_e('Time-lapse', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="composition" class="qcld_seo-form-label"><?php esc_html_e('Composition:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="composition" id="composition">
                                    <option value="Rule of thirds" selected><?php esc_html_e('Rule of thirds', 'qcld-seo-help'); ?></option>
                                    <option value="Symmetry"><?php esc_html_e('Symmetry', 'qcld-seo-help'); ?></option>
                                    <option value="Leading lines"><?php esc_html_e('Leading lines', 'qcld-seo-help'); ?></option>
                                    <option value="Negative space"><?php esc_html_e('Negative space', 'qcld-seo-help'); ?></option>
                                    <option value="Frame within a frame"><?php esc_html_e('Frame within a frame', 'qcld-seo-help'); ?></option>
                                    <option value="Diagonal lines"><?php esc_html_e('Diagonal lines', 'qcld-seo-help'); ?></option>
                                    <option value="Triangles"><?php esc_html_e('Triangles', 'qcld-seo-help'); ?></option>
                                    <option value="S-curves"><?php esc_html_e('S-curves', 'qcld-seo-help'); ?></option>
                                    <option value="Golden ratio"><?php esc_html_e('Golden ratio', 'qcld-seo-help'); ?></option>
                                    <option value="Radial balance"><?php esc_html_e('Radial balance', 'qcld-seo-help'); ?></option>
                                    <option value="Contrast"><?php esc_html_e('Contrast', 'qcld-seo-help'); ?></option>
                                    <option value="Repetition"><?php esc_html_e('Repetition', 'qcld-seo-help'); ?></option>
                                    <option value="Simplicity"><?php esc_html_e('Simplicity', 'qcld-seo-help'); ?></option>
                                    <option value="Viewpoint"><?php esc_html_e('Viewpoint', 'qcld-seo-help'); ?></option>
                                    <option value="Foreground, middle ground, background"><?php esc_html_e('Foreground, middle ground, background', 'qcld-seo-help'); ?></option>
                                    <option value="Patterns"><?php esc_html_e('Patterns', 'qcld-seo-help'); ?></option>
                                    <option value="Texture"><?php esc_html_e('Texture', 'qcld-seo-help'); ?></option>
                                    <option value="Balance"><?php esc_html_e('Balance', 'qcld-seo-help'); ?></option>
                                    <option value="Color theory"><?php esc_html_e('Color theory', 'qcld-seo-help'); ?></option>
                                    <option value="Proportion"><?php esc_html_e('Proportion', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="resolution" class="qcld_seo-form-label"><?php esc_html_e('Resolution:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="resolution" id="resolution">
                                    <option value="4K (3840x2160)" selected><?php esc_html_e('4K (3840x2160)', 'qcld-seo-help'); ?></option>
                                    <option value="1080p (1920x1080)"><?php esc_html_e('1080p (1920x1080)', 'qcld-seo-help'); ?></option>
                                    <option value="720p (1280x720)"><?php esc_html_e('720p (1280x720)', 'qcld-seo-help'); ?></option>
                                    <option value="480p (854x480)"><?php esc_html_e('480p (854x480)', 'qcld-seo-help'); ?></option>
                                    <option value="2K (2560x1440)"><?php esc_html_e('2K (2560x1440)', 'qcld-seo-help'); ?></option>
                                    <option value="1080i (1920x1080)"><?php esc_html_e('1080i (1920x1080)', 'qcld-seo-help'); ?></option>
                                    <option value="720i (1280x720)"><?php esc_html_e('720i (1280x720)', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="color" class="qcld_seo-form-label"><?php esc_html_e('Color:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="color" id="color">
                                    <option value="RGB" selected><?php esc_html_e('RGB', 'qcld-seo-help'); ?></option>
                                    <option value="CMYK"><?php esc_html_e('CMYK', 'qcld-seo-help'); ?></option>
                                    <option value="Grayscale"><?php esc_html_e('Grayscale', 'qcld-seo-help'); ?></option>
                                    <option value="HEX"><?php esc_html_e('HEX', 'qcld-seo-help'); ?></option>
                                    <option value="Pantone"><?php esc_html_e('Pantone', 'qcld-seo-help'); ?></option>
                                    <option value="CMY"><?php esc_html_e('CMY', 'qcld-seo-help'); ?></option>
                                    <option value="HSL"><?php esc_html_e('HSL', 'qcld-seo-help'); ?></option>
                                    <option value="HSV"><?php esc_html_e('HSV', 'qcld-seo-help'); ?></option>
                                    <option value="LAB"><?php esc_html_e('LAB', 'qcld-seo-help'); ?></option>
                                    <option value="LCH"><?php esc_html_e('LCH', 'qcld-seo-help'); ?></option>
                                    <option value="LUV"><?php esc_html_e('LUV', 'qcld-seo-help'); ?></option>
                                    <option value="XYZ"><?php esc_html_e('XYZ', 'qcld-seo-help'); ?></option>
                                    <option value="YUV"><?php esc_html_e('YUV', 'qcld-seo-help'); ?></option>
                                    <option value="YIQ"><?php esc_html_e('YIQ', 'qcld-seo-help'); ?></option>
                                    <option value="YCbCr"><?php esc_html_e('YCbCr', 'qcld-seo-help'); ?></option>
                                    <option value="YPbPr"><?php esc_html_e('YPbPr', 'qcld-seo-help'); ?></option>
                                    <option value="YDbDr"><?php esc_html_e('YDbDr', 'qcld-seo-help'); ?></option>
                                    <option value="YCoCg"><?php esc_html_e('YCoCg', 'qcld-seo-help'); ?></option>
                                    <option value="YCgCo"><?php esc_html_e('YCgCo', 'qcld-seo-help'); ?></option>
                                    <option value="YCC"><?php esc_html_e('YCC', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="special_effects" class="qcld_seo-form-label"><?php esc_html_e('Special Effects:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="special_effects" id="special_effects">
                                    <option value="Cinemagraph" selected><?php esc_html_e('Cinemagraph', 'qcld-seo-help'); ?></option>
                                    <option value="Bokeh"><?php esc_html_e('Bokeh', 'qcld-seo-help'); ?></option>
                                    <option value="Panorama"><?php esc_html_e('Panorama', 'qcld-seo-help'); ?></option>
                                    <option value="HDR"><?php esc_html_e('HDR', 'qcld-seo-help'); ?></option>
                                    <option value="Long exposure"><?php esc_html_e('Long exposure', 'qcld-seo-help'); ?></option>
                                    <option value="Timelapse"><?php esc_html_e('Timelapse', 'qcld-seo-help'); ?></option>
                                    <option value="Slow motion"><?php esc_html_e('Slow motion', 'qcld-seo-help'); ?></option>
                                    <option value="Stop-motion"><?php esc_html_e('Stop-motion', 'qcld-seo-help'); ?></option>
                                    <option value="Tilt-shift"><?php esc_html_e('Tilt-shift', 'qcld-seo-help'); ?></option>
                                    <option value="Zoom blur"><?php esc_html_e('Zoom blur', 'qcld-seo-help'); ?></option>
                                    <option value="Motion blur"><?php esc_html_e('Motion blur', 'qcld-seo-help'); ?></option>
                                    <option value="Lens flare"><?php esc_html_e('Lens flare', 'qcld-seo-help'); ?></option>
                                    <option value="Sunburst"><?php esc_html_e('Sunburst', 'qcld-seo-help'); ?></option>
                                    <option value="Starburst"><?php esc_html_e('Starburst', 'qcld-seo-help'); ?></option>
                                    <option value="Double exposure"><?php esc_html_e('Double exposure', 'qcld-seo-help'); ?></option>
                                    <option value="Cross processing"><?php esc_html_e('Cross processing', 'qcld-seo-help'); ?></option>
                                    <option value="Fish-eye"><?php esc_html_e('Fish-eye', 'qcld-seo-help'); ?></option>
                                    <option value="Vignette"><?php esc_html_e('Vignette', 'qcld-seo-help'); ?></option>
                                    <option value="Infrared"><?php esc_html_e('Infrared', 'qcld-seo-help'); ?></option>
                                    <option value="3D"><?php esc_html_e('3D', 'qcld-seo-help'); ?></option>
                                    <option value="None"><?php esc_html_e('None', 'qcld-seo-help'); ?></option>
                                </select>
                            </div>
                            <div class="mb-5">
                                
                                <label for="img_size" class="qcld_seo-form-label"><?php esc_html_e('Size:', 'qcld-seo-help'); ?></label>
                                <select class="qcld_seo-input" name="img_size" id="img_size">
                                    <option value="256x256"><?php esc_html_e('256x256', 'qcld-seo-help'); ?></option>
                                    <option value="512x512" selected><?php esc_html_e('512x512', 'qcld-seo-help'); ?></option>
                                    <option value="1024x1024"><?php esc_html_e('1024x1024', 'qcld-seo-help'); ?></option>
                                </select>
                                
                            </div>
                            <div class="mb-5">
                                
                                <label for="num_images" class="qcld_seo-form-label"><?php esc_html_e('# of:', 'qcld-seo-help'); ?></label>
                                <select name="num_images" id="num_images" class="qcld_seo-input">
                                    <option value="1"><?php esc_html_e('1', 'qcld-seo-help'); ?></option>
                                    <option value="2"><?php esc_html_e('2', 'qcld-seo-help'); ?></option>
                                    <option value="3"><?php esc_html_e('3', 'qcld-seo-help'); ?></option>
                                    <option value="4" selected><?php esc_html_e('4', 'qcld-seo-help'); ?></option>
                                    <option value="5"><?php esc_html_e('5', 'qcld-seo-help'); ?></option>
                                    <option value="6"><?php esc_html_e('6', 'qcld-seo-help'); ?></option>
                                    <option value="7"><?php esc_html_e('7', 'qcld-seo-help'); ?></option>
                                    <option value="8"><?php esc_html_e('8', 'qcld-seo-help'); ?></option>
                                </select>
                             
                            </div>
                        </div>
                    </div>
              
                </div>
            </div>
            <script>
                jQuery(document).ready(function ($) {
                    $('.qcld_seo-collapse-title').click(function () {
                        if (!$(this).hasClass('qcld_seo-collapse-active')) {
                            $('.qcld_seo-collapse').removeClass('qcld_seo-collapse-active');
                            $('.qcld_seo-collapse-title span').html('+');
                            $(this).find('span').html('-');
                            $(this).parent().addClass('qcld_seo-collapse-active');
                        }
                    })
                })
            </script>
           </form>
        </div>
    </div>
</div>

<?php
 } else { ?>
<div class="row my-4">
    <div  class="col-md-12">
        <?php esc_html_e('Fine tuning and training is available with the ');?>
        <a href="https://www.wpbot.pro/pricing/"><?php esc_html_e('WPBot Pro Professional'); ?></a>
        <?php esc_html_e(' and '); ?>
        <a href="https://www.wpbot.pro/pricing/"><?php esc_html_e('Master'); ?></a>
        <?php esc_html_e(' Licenses'); ?>
    </div>
</div>
<?php } ?>