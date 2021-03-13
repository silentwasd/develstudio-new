<?

$loader = exemod_extractstr('$PHPSOULENGINE\\loader');

if ($loader) {
    global $LOADER_BCODE;

    $loader = gzuncompress($loader);
    $LOADER_BCODE =& $loader;
}

if ($loader) {

    /*
    $fh = fopen("php://memory", "w+");
    fwrite($fh, $loader);
    fseek($fh, 0);
    bcompiler_read($fh);
    fclose($fh);
    */

    file_put_contents("loader.php", $loader);
    include("loader.php");

    global $LOADER;
    $LOADER = new DS_Loader;

} else
    die();