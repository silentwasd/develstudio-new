<?

// установка языка
//Localization::setLocale();
function t($text)
{
    if (func_num_args() == 1) {
        return Localization::getMsg($text);
    }

    $arg = array();
    for ($i = 1; $i < func_num_args(); $i++) {
        $arg[] = func_get_arg($i);
    }
    return vsprintf(Localization::getMsg($text), $arg);
}

function tr($text)
{

    $params[] = $text;
    $params = array_merge($params, func_get_args());

    return call_user_func_array('t', $params);
}

/**
 * Перевод с использованием языковой карты.
 * @param string $path Путь к значению с разделением через точку (например: components.methods.loadFromFile).
 * @return string|null
 */
function tm($path)
{
    $map = Localization::getMap();
    if (!$map)
        return null;

    $parts = explode('.', $path);
    $cur = null;
    foreach ($parts as $part) {
        if (!$cur) {
            if (!isset($map[$part]))
                return null;

            $cur = $map[$part];
            continue;
        }

        if (!isset($cur[$part]))
            break;

        $cur = $cur[$part];
    }

    if (!$cur || is_array($cur))
        $cur = $path;

    if (func_num_args() == 1) {
        return $cur;
    }

    $arg = array();
    for ($i = 1; $i < func_num_args(); $i++) {
        $arg[] = func_get_arg($i);
    }

    return vsprintf($cur, $arg);
}