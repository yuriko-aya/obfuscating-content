<?php
/*
Plugin Name:  Obfuscating Content
Plugin URI:   https://aya.sanusi.id
Description:  Obfuscate the content so only human can read!
Version:      20190119
Author:       Yuriko Aya
Author URI:   https://aya.sanusi.id
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

require( dirname(__FILE__) . '/' . 'admin/obfuscate-menu.php');

$timelaps = time()-get_post_time('U', true, $post->ID);

add_action('get_header','make_encrypt', 10);

function make_encrypt() {
    $the_date = date("Ynj.G.i");
    // add the css
    wp_enqueue_script('jquery');
    wp_enqueue_script('encrypt_contents', plugins_url( 'js/mxl.js', __FILE__ ), array(), $the_date);
}

function encrypt_engine($content) {
    $consonant = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'];
    $vocals = ['a', 'i', 'u', 'e', 'o',];
    $double_consonant = array_fill(0, 2, $consonant);
    $double_vocals = array_fill(0, 2, $vocals);
    $real_consonant = array_merge($double_consonant[0],$double_consonant[1]);
    $real_vocals = array_merge($double_vocals[0],$double_vocals[1]);
    $result = '';
    $text = $content;
    $splitted_text = str_split($text);
    $text_length = count($splitted_text);
    for ($i = 0; $i < $text_length; $i++) {
            $index_now = $splitted_text[$i];
            if (in_array($index_now,$consonant)) {
                    $result .= $real_consonant[array_search($index_now,$consonant)+7];
            } elseif (in_array($index_now,$vocals)) {
                    $result .= $real_vocals[array_search($index_now,$vocals)+3];
            } else {
                    $result .= $index_now;
            }
    }
    return $result;
}

add_action('get_footer', 'check_the_encryption',100);
function check_the_encryption() {
    if (is_single()) {
    ?>
        <script>
            start_decryption();
        </script>
    <?php
    }
}

add_filter('the_content', 'start_encrypt',10);

function start_encrypt($content) {
    $ads = stripslashes(get_option('obfuscate_ads1'));
    $ads2 = stripslashes(get_option('obfuscate_ads2'));

    if(is_single()){
        $result = encrypt_engine($content);
        return '<encrypted>'.$result.'</encrypted>';
    } else {
        return $content;
    }
}
