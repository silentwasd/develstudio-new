<?


class HotKey
{

    static function event($modifer, $key)
    {

        global $__hotkey_funcs;

        foreach ((array)$__hotkey_funcs as $el) {
            if (!($el['MODIFER'] == $modifer && $el['KEY'] == $key)) continue;

            $func = eval($el['FUNC'] . '();');
        }
    }

    static function add($modifer, $key, $func_name)
    {

        global $__hotkey_funcs;

        reg_hot_key(rand(), $modifer, $key);

        $__hotkey_funcs[] = array(
            'FUNC' => $func_name,
            'MODIFER' => $modifer,
            'KEY' => $key,
        );
    }
}