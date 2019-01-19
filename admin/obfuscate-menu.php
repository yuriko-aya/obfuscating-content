<?php

add_action( 'admin_menu', 'obfuscating_menu' );
function obfuscating_menu() {
    add_options_page('Obfuscating Content', 'Obfuscate Content', 'manage_options', 'content-obfuscation.php', 'obfus_content');
}

function obfus_content() {
    if ( !current_user_can('manage_options') ) {
        wp_die( __('You do not have persmission'));
    } 
    $ads1 = get_option('obfuscate_ads1');
    $ads2 = get_option('obfuscate_ads2');
    ?>
    <div class="wrap">
        <h1>Obfuscating Content Options</h1>
    </div>
    <hr>
<?php
    if ( isset($_POST['precheck']) && $_POST['precheck'] == "confirmed" ) {
        $new_ads1 = $_POST['ads1'];
        $new_ads2 = $_POST['ads2'];
        update_option('obfuscate_ads1', $new_ads1);
        update_option('obfuscate_ads2', $new_ads2);
        echo '<div class="updated notice"><p>Ads saved</p></div>';
    }
?>
    <div><p>Ads taht you want to put (optional)</p></div>
    <form name="obfus-options" method="post" action="">
        <div><p>Top and bottom ads:</p></div>
        <textarea name="ads1" rows="10" cols="60"><?php echo $ads1; ?></textarea><br>
        <div><p>Center ads:</p></div>
        <textarea name="ads2" rows="10" cols="60"><?php echo $ads2; ?></textarea><br>
        <input type="hidden" name="precheck" value="confirmed"><br>
        <button type="submit">Save</button>
    <?php
}
