<?

$loader = exemod_extractstr('$PHPSOULENGINE\\loader');

if ($loader) {
    global $LOADER_BCODE;

    $loader = gzuncompress($loader);
    $LOADER_BCODE =& $loader;
}

if ($loader) {

    $loaderPath = tempnam(sys_get_temp_dir(), 'ldr');
    file_put_contents($loaderPath, $loader);

    include($loaderPath);
    unlink($loaderPath);

    global $LOADER;
    $LOADER = new DS_Loader;

} else
    die();