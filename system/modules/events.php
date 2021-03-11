<?

class TEvents extends TComponent
{

    public $class_name = __CLASS__;

    #list[event_name] = script
    #component_link = <number link>

    static function listEvents($obj, $form)
    {
        $event = self::searchEvent($obj, $form);
        $arr = $event->list;
        return array_keys((array)$arr);
    }

    function get_list()
    {
        return unserialize(base64_decode($this->get_text()));
    }

    public function get_text()
    {
        return tevent_text($this->self, null);
    }

    function set_list($arr)
    {
        $this->set_text(base64_encode(serialize($arr)));
    }

    public function set_text($v)
    {
        tevent_text($this->self, $v);
    }

    function getEvent($name)
    {
        $name = strtolower($name);
        $arr = $this->list;
        return $arr[$name];
    }

    function eventList()
    {
        $arr = $this->list;
        return array_keys((array)$arr);
    }
}

class eventEngine
{

    static $DATA;
    static $form;

    static function dataToLower()
    {

        foreach (self::$DATA as $form => $obj) {

            if (strtolower($form) != $form) {

                self::$DATA[strtolower($form)] = self::$DATA[$form];
                unset(self::$DATA[$form]);
            }
        }

        foreach (self::$DATA as $form => $objs) {

            foreach ($objs as $obj => $list) {

                if (strtolower($obj) != $obj) {

                    self::$DATA[$form][strtolower($obj)] = self::$DATA[$form][$obj];

                    unset(self::$DATA[$form][$obj]);
                } elseif (strtolower($obj) == 'fmedit') {

                    self::$DATA[$form]['--fmedit'] = self::$DATA[$form][$obj];
                    unset(self::$DATA[$form][$obj]);
                }
            }
        }
    }

    static function setForm($form = false)
    {

        global $_FORMS, $formSelected;

        if ($form)
            self::$form = strtolower($form);
        else
            self::$form = strtolower($_FORMS[$formSelected]);
    }

    static function getEvent($object, $type)
    {
        $type = strtolower($type);
        return self::$DATA[strtolower(self::$form)][strtolower($object)][strtolower($type)];
    }

    static function setEvent($object, $type, $value)
    {
        $type = strtolower($type);
        self::$DATA[strtolower(self::$form)][strtolower($object)][strtolower($type)] = $value;
    }

    static function changeEvent($object, $type, $new)
    {

        $type = strtolower($type);
        $new = strtolower($new);
        $object = strtolower($object);
        self::$DATA[(self::$form)][($object)][$new] =
            self::$DATA[(self::$form)][($object)][$type];
        unset(self::$DATA[(self::$form)][$object][$type]);
    }

    static function changeName($object, $new)
    {

        if ($object == $new) return;
        self::copyEvent($object, $new);
        self::delEvent($object);
    }

    static function copyEvent($original, $new, $type = false)
    {

        $type = strtolower($type);
        $new = strtolower($new);
        $original = strtolower($original);
        if ($type)
            self::$DATA[self::$form][$new][$type] = self::$DATA[(self::$form)][($original)][$type];
        else
            self::$DATA[self::$form][$new] = self::$DATA[(self::$form)][($original)];
    }

    static function delEvent($object, $type = false)
    {

        $type = strtolower($type);
        $object = strtolower($object);
        if ($type)
            unset(self::$DATA[self::$form][$object][$type]);
        else
            unset(self::$DATA[self::$form][$object]);
    }

    static function listEventsEx($obj)
    {

        $result = array();
        $events = self::listEvents($obj);
        foreach ($events as $i => $ev)
            $result[] = t($ev);

        return $result;
    }

    static function listEvents($obj)
    {

        return self::eventList($obj);
    }

    static function eventList($object)
    {

        return array_keys((array)self::$DATA[strtolower(self::$form)][strtolower($object)]);
    }

    static function updateIndexes()
    {

        global $fmEdit;

        self::$DATA['--indexes'][self::$form] = array();
        foreach ((array)self::$DATA[self::$form] as $obj_name => $code) {

            if ($obj_name == '--fmedit')
                self::$DATA['--indexes'][self::$form][$obj_name] = -1;
            else
                self::$DATA['--indexes'][self::$form][$obj_name] = $fmEdit->findComponent($obj_name)->componentIndex;
        }
    }

    static function updateIndex($obj)
    {

        self::$DATA['--indexes'][_c($obj->owner)->name][$obj->name] = $obj->componentIndex;
    }
}


$GLOBALS['__exEvents'] = array();
function setEchoController($obj_or_func)
{
    DSApi::echoController($obj_or_func);
}

DSApi::echoController('pre');

function setEvetFromFunction($obj, $event, $function)
{

    if (function_exists($function))
        $obj->$event = $function;
    else
        $obj->$event = '__callFunction("' . $function . '",' . $obj->self . '); _empty';
}

class __exEvents
{

    static function setEchoController($obj_or_func)
    {

        $GLOBALS['__echoController'] = $obj_or_func;
    }

    static function addGlobalVar($name)
    {

        if ($name[0] != '$')
            $name = '$' . $name;

        if ($GLOBALS['__addIncCode']) {
            $last_str = 'global ' . implode(', ', (array)$GLOBALS['__addIncCode']);
            $GLOBALS['__addIncCode'][] = $name;
            $GLOBALS['__addIncCode'] = array_unique($GLOBALS['__addIncCode']);
            $str = 'global ' . implode(', ', $GLOBALS['__addIncCode']) . ';';
            enc_setValue('__incCode', str_replace($last_str, $str, enc_getValue('__incCode')));
        } else {

            $GLOBALS['__addIncCode'][] = $name;
            $GLOBALS['__addIncCode'] = array_unique($GLOBALS['__addIncCode']);
            $str = 'global ' . implode(', ', $GLOBALS['__addIncCode']) . ';';

            enc_setValue('__incCode', enc_getValue('__incCode') . $str);
        }

    }

    static function getEventInfo($self)
    {

        return $GLOBALS['__exEvents'][$self]['obj_name'];
    }

    static function runCode($code, $self)
    {

        // $mode = $GLOBALS['__config']['config']['debug_mode'];

        /*if (defined('DEBUG_OWNER_WINDOW')){
            $file = $GLOBALS['__exEvents'][$self]['obj_name'].'.'.$GLOBALS['__eventInfo']['name'];
            $file = str_replace('->','.',$file);
            $dir  = dirname(replaceSl(EXE_NAME));
            $file = $dir . '/debug/' . $file . '.php';

            if (!is_dir(dirname($file)))
                mkdir(dirname($file), 0777, true);

            if (!file_exists($file) ||
                (md5('<?php ' . $code)!=md5_file($file))){
                file_put_contents($file, ('<?php '.enc_getValue('__incCode'). $code));
            }
            return include($file);
        } else {*/
        return eval(enc_getValue('__incCode') . $code);
        //}
    }

    static function runCodeEx($script)
    {

        eval($script);
    }

    static function callEventEx($_self, $_params, $_eventName)
    {

        foreach ($_params as $_x_name => $_value) {
            $$_x_name = $_value;
        }

        $self = _c($_self);
        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));
        self::freeEventInfo();
    }

    static function setEventInfo($self, $event)
    {

        global $__eventInfo;

        $__eventInfo['obj_name'] = $GLOBALS['__exEvents'][$self]['obj_name'];
        $__eventInfo['name'] = $event;
        $__eventInfo['self'] = $self;

        $GLOBALS['__ownerComponent_last'][] = $GLOBALS['__ownerComponent'];

        if (gui_is($self, 'TForm'))
            $GLOBALS['__ownerComponent'] = $self;
        else
            $GLOBALS['__ownerComponent'] = gui_owner($self);

        ob_start();
    }

    static function callFileName($_self, $_eventName)
    {

        //pre($_eventName);

        $_file = $GLOBALS['__exEvents'][$_self]['obj_name'] . '.' . $_eventName;
        $_file = str_replace('->', '.', $_file);
        $_file = dirname(replaceSl(EXE_NAME)) . '/debug/' . $_file . '.php';

        if (!is_dir(dirname($_file)))
            mkdir(dirname($_file), 0777, true);

        if (!file_exists($_file) ||
            (md5('<?php ' . self::getEvent($_self, $_eventName)) != md5_file($_file))) {
            file_put_contents($_file, ('<?php ' . self::getEvent($_self, $_eventName) . "\n"));
        }

        return $_file;
    }

    static function getEvent($self, $name)
    {


        if ((defined('EMULATE_DVS_EXE') && EMULATE_DVS_EXE === true) || defined('APP_DESIGN_MODE')) {
            return $GLOBALS['__exEvents'][$self]['events'][strtolower($name)];
        } else {
            return ___getEvent($self, strtolower($name));
        }
    }

    static function freeEventInfo()
    {

        $controller = $GLOBALS['__echoController'];
        $str = ob_get_contents();
        ob_end_clean();

        if (is_numeric($controller)) $controller = c($controller);

        if ($controller)
            if (is_object($controller)) {

                if ($controller instanceof TChromium)
                    $controller->html = $str;
                else
                    $controller->text = $str;

            } elseif (is_string($controller) && function_exists($controller)) {

                if ($str)
                    $controller($str);
            }

        $GLOBALS['__ownerComponent'] = $GLOBALS['__ownerComponent_last'][count($GLOBALS['__ownerComponent_last']) - 1];
        unset($GLOBALS['__ownerComponent_last'][count($GLOBALS['__ownerComponent_last']) - 1]);
        $GLOBALS['__ownerComponent_last'] = array_values($GLOBALS['__ownerComponent_last']);

        unset($GLOBALS['__eventInfo']);
    }

    static function callEventVars($_self, &$_params, $_eventName)
    {

        foreach ($_params as $_x_name => &$_value) {
            $$_x_name =& $_value;
        }

        $self = _c($_self);
        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));
        self::freeEventInfo();
    }

    static function OnExecute($__self, $__names)
    {

        $__args = func_get_args();

        unset($__names[0], $__names[1], $__args[0], $__args[1]);

        $__names = array_values($__names);
        $__args = array_values($__args);

        foreach ($__names as $__i => $__var) {
            $__var = str_replace('$', '', $__var);

            $$__var = $__args[$__i];
        }

        $__script = self::getEvent($__self, 'OnExecute');

        self::setEventInfo($__self, $__name);

        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, $_eventName);
        else
            $res = eval(self::getEvent($_self, $_eventName));

        self::freeEventInfo();

        return $res;
    }

    static function OnActivate($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function callCode($_self, $_eventName)
    {

        $self = c($_self);

        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));


        self::freeEventInfo();
    }

    static function OnDeactivate($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnChromiumLibLoad($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnStartTrack($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnEndTrack($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnTimer($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnStart($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnClick($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnChange($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnCreate($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnDblClick($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnClose($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnPaint($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnResize($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnShow($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnSetCursor($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnSelect($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnFocus($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnBlur($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnCloseQuery($self, &$canClose)
    {
        self::callCodeCloseQuery($self, $canClose, __FUNCTION__);
    }

    static function callCodeCloseQuery($_self, &$canClose, $_eventName)
    {

        $self = c($_self);

        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));
        self::freeEventInfo();
    }

    static function OnScroll($self, $scrollCode, &$scrollPos)
    {
        self::callCodeScroll($self, $scrollCode, $scrollPos, __FUNCTION__);
    }

    static function callCodeScroll($self, $scrollCode, &$scrollPos, $_eventName)
    {

        $self = c($_self);

        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));
        self::freeEventInfo();
    }

    static function OnSelectDialog($self, $value)
    {
        self::callCodeSelect($self, $value, __FUNCTION__);
    }

    static function callCodeSelect($self, $value, $_eventName)
    {

        $self = c($_self);

        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));
        self::freeEventInfo();
    }

    static function OnMouseEnter($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnMouseLeave($self)
    {
        self::callCode($self, __FUNCTION__);
    }

    static function OnKeyDown($self, &$key, $shift)
    {
        self::callCodeKey($self, $key, $shift, __FUNCTION__);
    }

    static function callCodeKey($_self, &$key, $shift, $_eventName)
    {

        $self = c($_self);
        $shift = explode(',', $shift);

        self::setEventInfo($_self, $_eventName);

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));

        self::freeEventInfo();
    }

    static function OnKeyUp($self, &$key, $shift)
    {
        self::callCodeKey($self, $key, $shift, __FUNCTION__);
    }

    static function OnKeyPress($self, &$key)
    {
        self::callCodeKeyPress($self, $key, 0, __FUNCTION__);
    }

    static function callCodeKeyPress($_self, &$key, $shift, $_eventName)
    {

        $self = c($_self);
        $shift = explode(',', $shift);

        self::setEventInfo($_self, $_eventName);

        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));

        self::freeEventInfo();
    }

    static function OnMouseDown($self, $button, $shift, $x, $y)
    {
        self::callCodeMouse($self, $button, $shift, $x, $y, __FUNCTION__);
    }

    static function callCodeMouse($_self, $button, $shift, $x, $y, $_eventName)
    {

        $self = c($_self);
        $shift = explode(',', $shift);

        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));
        self::freeEventInfo();
    }

    static function OnMouseUp($self, $button, $shift, $x, $y)
    {
        self::callCodeMouse($self, $button, $shift, $x, $y, __FUNCTION__);
    }

    static function OnMouseMove($self, $shift, $x, $y)
    {
        self::callCodeMouseMove($self, $shift, $x, $y, __FUNCTION__);
    }

    static function callCodeMouseMove($_self, $shift, $x, $y, $_eventName)
    {

        $self = c($_self);
        $shift = explode(',', $shift);

        self::setEventInfo($_self, $_eventName);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            include self::callFileName($_self, $_eventName);
        else
            eval(self::getEvent($_self, $_eventName));
        self::freeEventInfo();
    }

    static function OnBeforeBrowse($_self, $url, $method, $navType, $isRedirect, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnBeforePopup($_self, $url, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnBeforeMenu($_self, $x, $y, $linkUrl, $imageUrl, $pageUrl, $frameUrl, $selectText, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));

        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnAuthCredentials($_self, $isProxy, $port, $host, $realm, $scheme, $username, $password, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnGetDownloadHandler($_self, $url, $mimeType, $fileName, $contentLength, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnConsoleMessage($_self, $message, $source, $line, &$continue)
    {

        $self = c($_self);
        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnLoadStart($_self)
    {

        self::callCode($_self, __FUNCTION__);
    }

    static function OnLoadEnd($_self, $httpStatus, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnLoadError($_self, $errorCode, $failedUrl, $errorText, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnStatusMessage($_self, $value, $status, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnAddressChange($_self, $url)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnTitleChange($_self, $title, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnTooltip($_self, $text, &$continue)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnContentsSizeChange($_self, $width, $height)
    {

        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }

    static function OnDropFiles($_self, $files, $x, $y)
    {

        $files = explode(chr(10), $files);
        $self = c($_self);

        self::setEventInfo($_self, __FUNCTION__);
        eval(enc_getValue('__incCode'));
        if (defined('DEBUG_OWNER_WINDOW'))
            $res = include self::callFileName($_self, __FUNCTION__);
        else
            $res = eval(self::getEvent($_self, __FUNCTION__));
        self::freeEventInfo();
    }
}

function ___getEvent($self, $name)
{


    $name = strtolower($name);
    /*$crc = $GLOBALS['__exEvents'][$self]['crc'][$name];
    $len = $GLOBALS['__exEvents'][$self]['len'][$name];

    if ($len === strlen($GLOBALS['__exEvents'][$self]['events'][$name])
        && crc32($GLOBALS['__exEvents'][$self]['events'][$name]) == $crc)*/
    $result = ($GLOBALS['__exEvents'][$self]['events'][$name]);
    /*else
        $result = '';*/
    return $result;
}


DSApi::reg_eventParams('onKeyUp', array('self', '&key', 'shift'));
DSApi::reg_eventParams('onKeyDown', array('self', '&key', 'shift'));
DSApi::reg_eventParams('onKeyPress', array('self', '&key'));
DSApi::reg_eventParams('onMouseDown', array('self', 'button', 'shift', 'x', 'y'));
DSApi::reg_eventParams('onMouseUp', array('self', 'button', 'shift', 'x', 'y'));
DSApi::reg_eventParams('onMouseMove', array('self', 'shift', 'x', 'y'));
DSApi::reg_eventParams('onMouseWheel', array('self', 'shift', 'wheelDelta', 'x', 'y', '&handled'));
DSApi::reg_eventParams('onCloseQuery', array('self', '&canClose'));
DSApi::reg_eventParams('onScroll', array('self', 'scrollCode', '&scrollPos'));


DSApi::reg_eventParams('onBeforePopup', array('self', 'url', '&continue'));
DSApi::reg_eventParams('onBeforeBrowse', array('self', 'url', 'method', 'navType', 'isRedirect', '&continue'));
DSApi::reg_eventParams('onBeforeMenu', array('self', 'x', 'y', 'linkUrl', 'imageUrl', 'pageUrl', 'frameUrl', 'selectText', '&continue'));

DSApi::reg_eventParams('OnAuthCredentials',
    array('isProxy', 'port', 'host', 'realm', 'scheme', 'username', 'password', '&continue'));

DSApi::reg_eventParams('OnGetDownloadHandler',
    array('url', 'mimeType', 'fileName', 'contentLength', '&continue'));

DSApi::reg_eventParams('OnConsoleMessage',
    array('message', 'source', 'line', '&continue'));

DSApi::reg_eventParams('OnLoadStart', array());
DSApi::reg_eventParams('OnLoadEnd', array('httpStatus', '&continue'));
DSApi::reg_eventParams('OnLoadError', array('errorCode', 'failedUrl', 'errorText', '&continue'));
DSApi::reg_eventParams('OnStatusMessage', array('value', 'status', '&continue'));

DSApi::reg_eventParams('OnAddressChange', array('url'));
DSApi::reg_eventParams('OnTitleChange', array('title', '&continue'));
DSApi::reg_eventParams('OnTooltip', array('text', '&continue'));

DSApi::reg_eventParams('OnContentsSizeChange', array('width', 'height'));

DSApi::reg_eventParams('onDropFiles', array('self', 'files', 'x', 'y'));
?>