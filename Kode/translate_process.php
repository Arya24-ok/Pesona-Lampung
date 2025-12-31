<?php

function translateAI($text, $target_lang = 'id') {

    $api_url = "https://api.penerjemah-lampung.com/v1/translate"; // Contoh endpoint
    
 
    global $dictionary;
    return isset($dictionary[strtolower($text)]) ? $dictionary[strtolower($text)] : "Maaf, AI sedang mempelajari kata '$text'";
}
?>