<?php
/**
 * File :: Loader.php
 *
 * Package de fonctions de chargement de fichiers et données.
 *
 * @author    Nicolas DUPRE
 * @release   19/08/2017
 * @version   1.0.0
 * @package   Loader
 *
 * @TODO: Optimiser les différentes méthods qui ont un traitement similaire (système d'alias)
 */

namespace Loader;

/**
 * Trait Loader
 * @package Loader
 */
trait Loader
{
    /**
     * Charge le ou les fichiers CSS du ou des dossiers indiqués
     *
     * @param bool $output Affiche directement les balises links dans le stream.
     * @param string $directory Dossier(s) à parcourir. Accepte autant d'argument (string)
     * que de dossier désiré à analyser
     * @return array
     */
    static function css($output, $directory = "."){
        if(func_num_args() === 2){
            $path = Array($directory);
        } else {
            $path = func_get_args();
            array_shift($path);
        }

        $css_files = Array();

        foreach ($path as $key => $value) {
            $dir = scandir($value);

            foreach($dir as $dkey => $file){
                if(is_file("$value/$file") && !preg_match("/^\./", $file)){
                    $media = explode("_", $file);
                    $media = @explode(".", $media[1]);
                    $media = $media[0];

                    if(!$media) $media = "all";

                    if($output){
                        echo "<link rel='stylesheet' href='$value/$file' type='text/css' media='$media'>";
                    }

                    $css_files[] = Array(
                        "CSS_FILE" => "$value/$file",
                        "CSS_MEDIA" => $media,
                        "CSS_MTIME" => filemtime("$value/$file")
                    );
                }
            }
        }

        return $css_files;
    }

    /**
     * Charge le ou les fichiers LESS du ou des dossiers indiqués
     *
     * @param bool $output Affiche directement les balises links dans le stream.
     * @param string $directory Dossier(s) à parcourir. Accepte autant d'argument (string)
     * que de dossier désiré à analyser
     * @return array
     */
    static function less($output, $directory = "."){
        if(func_num_args() === 2){
            $path = Array($directory);
        } else {
            $path = func_get_args();
            array_shift($path);
        }

        $less_files = Array();

        foreach ($path as $key => $value) {
            $dir = scandir($value);

            foreach($dir as $dkey => $file){
                if(is_file("$value/$file") && !preg_match("/^\./", $file)){
                    $media = explode("_", $file);
                    $media = @explode(".", $media[1]);
                    $media = $media[0];

                    if(!$media) $media = "all";

                    if($output){
                        echo "<link rel='stylesheet/less' href='$value/$file' type='text/css' media='$media'>";
                    }

                    $less_files[] = Array(
                        "LESS_FILE" => "$value/$file",
                        "LESS_MEDIA" => $media,
                        "LESS_MTIME" => filemtime("$value/$file")
                    );
                }
            }
        }

        return $less_files;
    }

    /**
     * Charge le ou les fichiers JavaScript du ou des dossiers indiqués
     *
     * @param bool $output Affiche directement les balises links dans le stream.
     * @param string $directory Dossier(s) à parcourir. Accepte autant d'argument (string)
     * que de dossier désiré à analyser
     * @return array
     */
    static function js($output, $directory = "."){
        if(func_num_args() === 2){
            $path = Array($directory);
        } else {
            $path = func_get_args();
            array_shift($path);
        }

        $js_files = Array();

        foreach ($path as $key => $value) {
            $dir = scandir($value);

            foreach($dir as $dkey => $file){
                if(is_file("$value/$file") && !preg_match("/^\./", $file)){
                    if($output){
                        echo "<script type='text/javascript' src='$value/$file'></script>";
                    }

                    $js_files[] = Array(
                        "SCRIPT_FILE" => "$value/$file",
                        "SCRIPT_MTIME" => filemtime("$value/$file")
                    );
                }
            }
        }

        return $js_files;
    }

}
