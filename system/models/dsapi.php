<?
/*
   �����, ������� ���������� ��� ����������� ������������� DS Api 
*/

define('API_EVENT_EXIT', 1);
define('API_EVENT_ABORT', 2);


class CApi extends DSApi
{

    static function installPak($info)
    {

        if (!is_array($info)) $info = self::readDSPak($info);

        if (!$info['name']) return;

        $err = err_status(0);
        $result = array();
        $dir = dirname($info['file']);

        if (is_dir($dir . '/components/'))
            $result['components'] = dir_copy($dir . '/components/', DOC_ROOT . '/design/components/');

        if (is_dir($dir . '/utils/'))
            $result['utils'] = dir_copy($dir . '/utils/', DOC_ROOT . '/utils/');

        if (is_dir($dir . '/actions/'))
            $result['actions'] = dir_copy($dir . '/actions/', DOC_ROOT . '/design/actions/');

        if (is_dir($dir . '/editor_types/'))
            $result['editor_types'] = dir_copy($dir . '/editor_types/', DOC_ROOT . '/design/editor_types/');

        if (is_dir($dir . '/complete/'))
            $result['complete'] = dir_copy($dir . '/complete/', DOC_ROOT . '/design/complete/');

        if (is_dir($dir . '/modules/'))
            $result['modules'] = dir_copy($dir . '/modules/', DOC_ROOT . '/modules/');

        if (is_dir($dir . '/images/'))
            $result['images'] = dir_copy($dir . '/images/', DOC_ROOT . '/images/');

        if (is_dir($dir . '/prog/')) {
            $result['prog'] = dir_copy($dir . '/prog/', DOC_ROOT . '/../');
        }

        if (is_dir($dir . '/php_modules/')) {
            $result['php_modules'] = dir_copy($dir . '/php_modules/', DOC_ROOT . '/../ext/');
        }

        $ds_name = basenameNoExt($info['file']);

        file_p_contents(DOC_ROOT . '/ext/' . $ds_name . '.info', serialize($result));
        x_copy($info['file'], DOC_ROOT . '/ext/' . $ds_name . '.dspak');

        err_status($err);
    }

    // ���������� ��������� �� ����� .dscomponent

    static function readDSPak($file)
    {

        $info = parse_ini_file($file, true);

        $params = array();
        $params['name'] = $info['main']['name'];
        $params['ver'] = $info['main']['ver'];
        $params['author'] = $info['main']['author'];
        $params['desc'] = $info['main']['desc'];

        if (isset($info[LANG_ID])) {
            $params['desc'] = isset($info[LANG_ID]['desc']) ? $info[LANG_ID]['desc'] : $params['desc'];
        }

        $params['file'] = $file;

        return $params;
    }

    static function unInstallPak($name)
    {

        $file = DOC_ROOT . '/ext/' . $name . '.dspak';
        $params = CApi::readDSPak($file);

        $files = file_get_contents(DOC_ROOT . '/ext/' . $name . '.info');
        $files = unserialize($files);

        file_delete(DOC_ROOT . '/ext/' . $name . '.info');
        file_delete(DOC_ROOT . '/ext/' . $name . '.dspak');

        if ($files['components'])
            foreach ($files['components'] as $file)
                file_delete(DOC_ROOT . '/design/components/' . $file);

        if ($files['images'])
            foreach ($files['images'] as $file)
                file_delete(DOC_ROOT . '/images/' . $file);

        if ($files['utils'])
            foreach ($files['utils'] as $file)
                file_delete(DOC_ROOT . '/utils/' . $file);

        if ($files['modules'])
            foreach ($files['modules'] as $file)
                file_delete(DOC_ROOT . '/modules/' . $file);

        if ($files['actions'])
            foreach ($files['actions'] as $file)
                file_delete(DOC_ROOT . '/design/actions/' . $file);

        if ($files['editor_types'])
            foreach ($files['editor_types'] as $file)
                file_delete(DOC_ROOT . '/design/editor_types/' . $file);

        if ($files['prog'])
            foreach ($files['prog'] as $file)
                file_delete(DOC_ROOT . '/../' . $file);

        if ($files['php_modules'])
            foreach ($files['php_modules'] as $file)
                file_delete(DOC_ROOT . '/../ext/' . $file);

        if ($files['complete'])
            foreach ($files['complete'] as $file)
                file_delete(DOC_ROOT . '/design/complete/' . $file);

    }

    static function pakageExists($name)
    {

        return in_array($name, self::pakagesList());
    }

    static function pakagesList()
    {

        $dir = DOC_ROOT . '/ext/';
        $files = findFiles($dir, 'dspak', false);

        foreach ($files as $i => $file)
            $files[$i] = basenameNoExt($file);

        return $files;
    }

    static function pakageVer($name)
    {

        $file = DOC_ROOT . '/ext/' . $name . '.dspak';
        $params = CApi::readDSPak($file);
        return $params['ver'];
    }

    static function addEvent($event, $code)
    {

        $GLOBALS[__CLASS__]['events'][$event][] = $code;
    }

    static function delEvent($event, $code)
    {

        $codes = (array)$GLOBALS[__CLASS__]['events'][$event];
        $k = array_search($code, $codes);
        if (is_int($k)) {
            unset($codes[$k]);
            $GLOBALS[__CLASS__]['events'][$event] = array_values($codes);
        }
    }

    static function doEvent($event, $params = array())
    {

        $is_def = false;
        $codes = (array)$GLOBALS[__CLASS__]['events'][$event];
        foreach ($codes as $code) {

            if ($is_def)
                $x_result = $code($event, $params);
            else
                $result = $code($event, $params);

            if ($result == API_EVENT_ABORT || $x_result == API_EVENT_ABORT) {
                return false;
            } elseif ($result == API_EVENT_EXIT) {
                $is_def = true;
            }
        }

        return $result !== API_EVENT_EXIT;
    }

    static function getStringEventInfo($event, $class = false)
    {

        global $myEvents;

        $event = strtolower($event);
        $event[2] = strtoupper($event[2]);

        $base = self::getEventParams($event, $class);
        $add = '';
        if ($myEvents->selObj instanceof TFunction) {

            $prms = $myEvents->selObj->parameters;
            $prms = str_replace(' ', '', $prms);
            if (strpos($prms, ',') === false) {
                $prms = explode(_BR_, $prms);
            } else {
                $prms = explode(',', $prms);
            }

            array_map('trim', $prms);
            if (count($prms) > 0)
                $add = ', ' . implode(', ', $prms);
        }

        return 'event ' . $event . '( ' . str_ireplace('&', '&&', $base . $add) . ' ) {';
    }

}