<?php
function tambah_shortcode_form(){
    ob_start();
    include('views/for_shortcode.php');
    return ob_get_clean();    
}
add_shortcode('smt_contact_form', 'tambah_shortcode_form');
?>