<?


class Localization
{

    static function inc($file)
    {

        $file = replaceSl($file);
        $dir = dirname($file);

        $lang_dir = defined('USER_LANG_DIR') ? USER_LANG_DIR : 'lang';
        $lang_file = $dir . '/' . $lang_dir . '/' . $GLOBALS['__LOCALE_LANG'] . '/messages.php';

        if (file_exists($lang_file)) {

            require_once $lang_file;

            global $__M;
            Localization::setMsgArr($__M);
            unset ($__M);
        }
    }

    //

    static function setMsgArr($MSG)
    {

        if (is_array($MSG))
            $GLOBALS['__LANG_MESSAGES'] = array_merge($MSG, (array)$GLOBALS['__LANG_MESSAGES']);
    }

    static function incXml($dir, $lang = false)
    {

        if (!$lang)
            $lang = $GLOBALS['__LOCALE_LANG'];

        $lang_file = DOC_ROOT . $dir . '/' . $lang . '.xml';

        // %root%/lang/ru.xml
        if (!file_exists($lang_file)) return;


        $xml = simplexml_load_file($lang_file);

        foreach ($xml as $item) {

            $__M[(string)$item->n] = iconv('utf-8', 'windows-1251', (string)$item->v);
        }


        Localization::setMsgArr($__M);
        unset ($__M);
        unset($xml);
    }

    /**
     * �������� �������� �����.
     * @return array|null
     */
    static function getMap()
    {
        return $GLOBALS['__LANG_MAP'] ? $GLOBALS['__LANG_MAP'] : null;
    }

    static function setLocale($lang = 'ru')
    {

        $GLOBALS['__LOCALE_LANG'] = $lang;
        Localization::init();
    }

    static function init()
    {
        $lang_dir = defined('USER_LANG_DIR') ? USER_LANG_DIR : 'lang';
        $lang_file = DOC_ROOT . '/' . $lang_dir . '/' . $GLOBALS['__LOCALE_LANG'] . '/messages.php';

        if (isset($GLOBALS['__LANG_MESSAGES']))
            unset($GLOBALS['__LANG_MESSAGES']);

        if (isset($GLOBALS['__LANG_MAP']))
            unset($GLOBALS['__LANG_MAP']);

        $map = array(
            'components' => array()
        );

        $GLOBALS['__LANG_MESSAGES'] = array();
        $GLOBALS['__LANG_MAP'] =& $map;

        if (!file_exists($lang_file))
            return;

        require_once $lang_file;
        global $__M;
        Localization::setMsgArr($__M);
        unset ($__M);
        setlocale(LC_ALL, strtolower($GLOBALS['__LOCALE_LANG']) . '_' . strtoupper($GLOBALS['__LOCALE_LANG']));

        $localeDir = DOC_ROOT . '/' . $lang_dir . '/' . $GLOBALS['__LOCALE_LANG'];
        foreach ($map as $section => &$data) {
            $sectionFile = $localeDir . '/' . $section . '.php';
            if (!file_exists($sectionFile))
                continue;
            $data = include_once($sectionFile);
        }
    }

    static function localApplication()
    {
        global $SCREEN;

        $forms = $SCREEN->forms;


        foreach ($forms as $form) {

            self::localForm($form);
        }

        unset($forms);
    }

    static function localForm($form)
    {

        global $SCREEN;

        if ($form->tag == 2012) return;

        if (defined('LANG_CHARSET'))
            $form->font->charset = LANG_CHARSET;

        $name = $form->name;

        $c = $form->componentCount();
        for ($i = 0; $i < $c; $i++) {

            $s_obj = component_by_id($form->self, $i);

            $caption = control_text($s_obj, null);

            if (strpos($caption, _BR_)) {
                $tmp = explode(_BR_, $caption);
                foreach ($tmp as $q => $x) {
                    if (ereg('^{(.+)}$', $x)) {
                        $x[0] = ' ';
                        $x[strlen($x) - 1] = ' ';
                        $tmp[$q] = self::getMsg(trim($x));
                    }
                }

                $caption = implode(_BR_, $tmp);
                $ind = tstrings_item_index($s_obj, null);
                control_text($s_obj, $caption);
                tstrings_item_index($s_obj, $ind);

            } elseif ($caption && ereg('^{(.+)}$', $caption)) {
                $caption[0] = ' ';
                $caption[strlen($caption) - 1] = ' ';

                control_text($s_obj, self::getMsg(trim($caption)));
            }

            $hint = __rtii_get($s_obj, 'hint');

            if ($hint && ereg('^{(.+)}$', $hint)) {
                $hint[0] = ' ';
                $hint[strlen($hint) - 1] = ' ';
                __rtii_set($s_obj, 'hint', self::getMsg(trim($hint)));
            }

        }

        $s_obj = $form->self;

        $caption = __rtii_get($s_obj, 'caption');

        if ($caption && ereg('^{(.+)}$', $caption)) {
            $caption[0] = ' ';
            $caption[strlen($caption) - 1] = ' ';
            __rtii_set($s_obj, 'caption', self::getMsg(trim($caption)));
        }

        $hint = __rtii_get($s_obj, 'hint');

        if ($hint && ereg('^{(.+)}$', $hint)) {
            $hint[0] = ' ';
            $hint[strlen($hint) - 1] = ' ';
            __rtii_set($s_obj, 'hint', self::getMsg(trim($hint)));
        }


        unset($objs);
    }

    static function getMsg($name)
    {

        if (empty($name)) return '';

        if ($name[0] == '&') {
            $name[0] = ' ';
            $name = ltrim($name);
        }

        $name = (string)$name;
        $s1 = isset($GLOBALS['__LANG_MESSAGES'][$name]);
        $s2 = isset($GLOBALS['__LANG_MESSAGES'][$name . '.']);

        if (!$s1 and !$s2)
            return $name;
        else {
            if ($s1) return $GLOBALS['__LANG_MESSAGES'][$name];
            if ($s2) return $GLOBALS['__LANG_MESSAGES'][$name . '.'] . '.';
        }
    }

    static function toEncoding($str)
    {

        $encoding = self::detectLocale($str);
        return $encoding = 'windows-1251' ? $str : iconv($encoding, 'windows-1251', $str);
    }

    static function detectLocale($str)
    {

        $charsets = array(
            'koi8-r' => 0,
            'windows-1251' => 0,
            'cp866' => 0,
            'utf-8' => 0,
            'mac' => 0
        );

        for ($i = 0, $length = strlen($str); $i < $length; $i++) {
            $char = ord($str[$i]);

            //non-russian characters
            if ($char < 128 || $char > 256) continue;

            //CP866
            if (($char > 159 && $char < 176) || ($char > 223 && $char < 242)) $charsets['cp866'] += 3;
            if (($char > 127 && $char < 160)) $charsets['cp866'] += 1;
            //KOI8-R
            if (($char > 191 && $char < 223)) $charsets['koi8-r'] += 3;
            if (($char > 222 && $char < 256)) $charsets['koi8-r'] += 1;
            //WIN-1251
            if ($char > 223 && $char < 256) $charsets['windows-1251'] += 3;
            if ($char > 191 && $char < 224) $charsets['windows-1251'] += 1;
            //MAC
            if ($char > 221 && $char < 255) $charsets['mac'] += 3;
            if ($char > 127 && $char < 160) $charsets['mac'] += 1;
            //ISO-8859-5
            if ($char > 207 && $char < 240) $charsets['utf-8'] += 3;
            if ($char > 175 && $char < 208) $charsets['utf-8'] += 1;
        }
        arsort($charsets);
        return key($charsets);
    }

}