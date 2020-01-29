<?php

add_action( 'admin_menu', 'obfuscating_menu' );
function obfuscating_menu() {
    add_options_page('Obfuscating Content', 'Obfuscate Content', 'manage_options', 'content-obfuscation.php', 'obfus_content');
}

function obfus_content() {
    if ( !current_user_can('manage_options') ) {
        wp_die( __('You do not have persmission'));
    }
    ?>
    <div class="wrap">
        <h1>Obfuscating Content Options</h1>
    </div>
    <hr>
<?php
    if ( isset($_POST['precheck']) && $_POST['precheck'] == "confirmed" ) {
        $new_ads1 = $_POST['ads1'];
        update_option('obfuscate_ads1', $new_ads1);
        echo '<div class="updated notice"><p>Ads saved</p></div>';
    }
    $ads1 = stripslashes(get_option('obfuscate_ads1'));
?>
    <div><p>Ads that you want to put (optional)</p></div>
    <form name="obfus-options" method="post" action="">
        <div><p>Top and bottom ads:</p></div>
        <textarea name="ads1" rows="10" cols="60"><?php echo $ads1; ?></textarea><br>
        <input type="hidden" name="precheck" value="confirmed"><br>
        <button type="submit">Save</button>
    <?php
}
