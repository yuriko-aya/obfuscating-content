var consonant = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z',];
var vocals = ['a', 'i', 'u', 'e', 'o',];
var double_consonant = consonant.concat(consonant);
var double_vocals = vocals.concat(vocals);
var encrypted_status = localStorage.getItem("encrypted");

function start_decrypt() {
        var content_area = document.getElementsByTagName("encrypted");
        var encrypted_content = content_area[0].innerHTML
        encrypt_parsed = encrypted_content.replace(/&amp;/g, '&')
        var decrypted_content = decrypt_content(encrypt_parsed)
        content_area[0].innerHTML = decrypted_content
}

function decrypt_content(contents) {
    results = "";
    contents = contents.toString();
    splitted_content = contents.split("");
    for (i = 0; i < splitted_content.length; i++) {
        index_now = splitted_content[i];
        if (consonant.includes(index_now)) {
            results += double_consonant[consonant.indexOf(index_now)+consonant.length-7];
        } else if (vocals.includes(index_now)) {
            results += double_vocals[vocals.indexOf(index_now)+vocals.length-3];
        } else {
            results += index_now;
        }
    }
    result = results.replace(/&fskg;/g, "&nbsp;")
    return result
}

function start_decryption() {
    jQuery(document).ready(function($){
        start_decrypt()
    })
}