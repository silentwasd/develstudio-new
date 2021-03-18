<?


class TChromium extends TControl
{

    public $class_name = __CLASS__;
    public $_options;

    public function free()
    {
        chromium_free($this->self);
    }

    public function reload()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_RELOAD, 0);
    }

    public function goBack()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_GOBACK, 0);
    }

    public function canGoBack()
    {
        return chromium_exec($this->self, CHROMIUM_EXEC_CANGOBACK, 0);
    }

    public function goForward()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_GOFORWARD, 0);
    }

    public function canGoForward()
    {
        return chromium_exec($this->self, CHROMIUM_EXEC_CANGOFORWARD, 0);
    }

    public function showDevTools()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_SHOWDEVTOOLS, 0);
    }

    public function hideDevTools()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_HIDEDEVTOOLS, 0);
    }

    public function hidePopup()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_HIDEPOPUP, 0);
    }

    public function setFocus($enable = true)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_SETFOCUS, array((bool)$enable));
    }

    public function reloadIgnoreCache()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_RELOADIGNORECACHE, 0);
    }

    public function stopLoad()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_STOPLOAD, 0);
    }

    public function sendFocusEvent($event)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_SETFOCUSEVENT, array((int)$event));
    }

    public function sendKeyEvent($type, $key, $modifers, $sysChar, $imeChar)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_SETEVENTKEY, array((int)$type, (int)$key, (int)$modifers, (int)$sysChar, (int)$imeChar));
    }

    public function sendMouseClickEvent($x, $y, $type, $mouseUp, $clickCount)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_MOUSECLICKEVENT, array((int)$x, (int)$y, (int)$type, (int)$mouseUp, (int)$clickCount));
    }

    public function load($url)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_LOAD, array((string)$url));
    }

    public function scrollBy($x, $y)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_SCROLLBY, array((int)$x, (int)$y));
    }

    public function undo()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_UNDO, 0);
    }

    public function redo()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_REDO, 0);
    }

    public function cut()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_CUT, 0);
    }

    public function copy()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_COPY, 0);
    }

    public function paste()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_PASTE, 0);
    }

    public function del()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_DEL, 0);
    }

    public function selectAll()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_SELECTALL, 0);
    }

    public function showPrint()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_PRINT, 0);
    }

    public function viewSource()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_VIEWSOURCE, 0);
    }

    public function clearHistory()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_CLEARHISTORY, 0);
    }

    public function loadFile($file, $url = 'about:blank')
    {
        chromium_exec($this->self, CHROMIUM_EXEC_LOADFILE, array((string)$file, (string)$url));
    }

    public function callJs($call, $args, $aThis = null, $jsUrl = 'about:blank')
    {

        $this->executeJs($call . '.call(' . ($aThis ? (string)$aThis : 'null') . ', ' . json_encode($args) . ');');
    }

    public function executeJs($js, $jsUrl = 'about:blank', $startLine = 0)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_EXECUTEJS, array((string)$js, (string)$jsUrl, (int)$startLine));
    }

    public function get_Zoom()
    {
        return chromium_prop($this->self, CHROMIUM_EXEC_ZOOM, null);
    }

    public function set_Zoom($level)
    {
        chromium_prop($this->self, CHROMIUM_EXEC_ZOOM, (double)$level);
    }

    public function set_url($url)
    {
        $this->loadUrl($url);
        //chromium_prop($this->self, CHROMIUM_EXEC_URL, (string)$url);
    }

    /* properties */

    public function loadUrl($url)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_LOADURL, array((string)$url));
    }

    public function get_url()
    {
        return $this->getAddress();
    }

    public function getAddress()
    {
        chromium_exec($this->self, CHROMIUM_EXEC_ADDRESS, 0);
    }

    public function get_defaultEncoding()
    {
        return chromium_exec($this->self, CHROMIUM_EXEC_DEFENCODING, 0);
    }

    public function set_defaultEncoding($str)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_DEFENCODING, array($str));
    }

    public function get_defaultCSSPath()
    {
        return chromium_exec($this->self, CHROMIUM_EXEC_DEFCSSPATH, 0);
    }

    public function set_defaultCSSPath($str)
    {
        chromium_exec($this->self, CHROMIUM_EXEC_DEFCSSPATH, array($str));
    }

    public function set_Html($str)
    {
        $this->set_Source($str);
    }

    public function set_Source($str)
    {
        $this->loadString($str);
    }

    public function loadString($str, $url = false)
    {
        if (!$url)
            $url = 'file:///' . DOC_ROOT;

        chromium_exec($this->self, CHROMIUM_EXEC_LOADSTRING, array((string)$str, (string)$url));
    }

    public function get_Html()
    {
        return $this->get_Source();
    }

    public function get_Source()
    {

        return chromium_exec($this->self, CHROMIUM_EXEC_SOURCE, 0);
    }


    /* options */

    public function get_Options()
    {

        if (!isset($this->_options)) {
            $this->_options = new TChromiumOptions(nil, false);
            $this->_options->self = gui_propGet($this->self, 'options');
        }
        return $this->_options;
    }
}