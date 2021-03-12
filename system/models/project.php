<?

class myProject
{

    public $formsInfo;
    public $config;
    public $add_info;

    static function registerFileType()
    {

        $_e = err_status(false);
        registerFileType('dvs', dirname(EXE_NAME) . '/DevelStudio.exe');
        registerFileType('msppr', dirname(EXE_NAME) . '/DevelStudio.exe');
        registerFileType('dspak', dirname(EXE_NAME) . '/DevelStudio.exe');
        registerFileType('zipdspak', dirname(EXE_NAME) . '/DevelStudio.exe');
        registerFileType('dvsexe', dirname(EXE_NAME) . '/DevelStudio.exe');
        err_status($_e);
    }

    static function openLsProject()
    {

        global $_PARAMS;
        global $projectFile;

        //delay(200);
        setTimeout(10000, 'myProject::registerFileType()');

        $fileName = replaceSl($_PARAMS[2]);
        //pre($fileName);
        if (file_exists($fileName)) {

            if (fileExt($fileName) == 'dvs') {
                if (!self::openFromDVS($fileName)) {
                    myProject::open($projectFile);
                }
            } elseif (fileExt($fileName) == 'msppr')
                self::open($fileName);
            elseif (fileExt($fileName) == 'dspak' || fileExt($fileName) == 'zipdspak') {

                if (class_exists('master_Pakages'))
                    master_Pakages::installPak($fileName);

                myProject::open($projectFile);
            }

        } elseif (is_file($projectFile)) {

            myProject::open($projectFile);

        } else {

        }
    }

    static function openFromDVS($file, $dir = false)
    {

        $file = replaceSl($file);
        $dir = replaceSl($dir);
        $file = str_replace('\\\\', '\\', $file);
        if (!is_readable($file))
            return false;

        if (!file_exists($dir) && $dir)
            mkdir($dir, 0777, true);

        global $projectFile, $_FORMS, $myProject, $formSelected;
        $last_project = $projectFile;

        if ($dir) {
            $projectFile = $dir . '/' . basenameNoExt($file) . '.msppr';
        } else {

            $path = self::projectDialog(replaceSr(dirname($file)) . '\\' . basenameNoExt($file) . '\project.msppr');

            if ($path) {

                self::clearProject();
                $projectFile = replaceSl($path['PATH']);
                self::initLastFiles($projectFile);

                if (!is_dir(dirname($projectFile)))
                    mkdir(dirname($projectFile), 0777, true);

                if ($path['DEL_ALL_FILES'])
                    deleteDir(dirname($projectFile), false);

            } else
                return false;
        }

        $_e = err_status(false);

        $result = file_get_contents($file);
        $x = unserialize(base64_decode(gzuncompress($result)));

        if (!$x)
            $result = unserialize(base64_decode($result));
        else
            $result = $x;

        unset($x);

        err_status($_e);

        $myProject->config = $result['CONFIG'];
        $myProject->formsInfo = $result['formsInfo'];
        $myProject->add_info = $result['add_info'];
        eventEngine::$DATA = $result['eventDATA'];


        foreach ((array)$result['scripts'] as $x_file => $data)
            file_p_contents(dirname($projectFile) . '/scripts/' . $x_file, $data);

        foreach ((array)$result['data'] as $x_file => $x_data) {

            $x_file = dirname($projectFile) . '/' . $myProject->config['data_dir'] . '/' . $x_file;

            if (!is_dir(dirname($x_file)))
                mkdir(dirname($x_file), 0777, true);

            file_put_contents($x_file, gzuncompress($x_data));
        }

        $_FORMS = array();

        foreach ($result['DFM'] as $form => $data) {

            $dfm_file = dirname($projectFile) . '/' . $form . '.dfm';
            //($dfm_file)){
            $_FORMS[] = $form;
            file_put_contents($dfm_file, $data);
            //}
        }

        if (!self::checkOldFormat()) {
            self::open($last_project);
            return;
        }

        self::genTabs();
        $formSelected = 0;
        myUtils::loadForm($_FORMS[0], true);
        myUtils::saveProject();
        return true;
    }

    static function projectDialog($text = '')
    {

        $dlg = c('fmNewProject');
        c('fmNewProject->path')->text = str_replace('\\\\', '\\', $text);
        c('fmNewProject->btn_dlg')->onClick = 'myProject::projectDialogBtn';
        c('fmNewProject->path')->onKeyDown = 'myProject::projectDialogKeyDown';
        c('fmNewProject->lastProjects')->onDblClick = 'myProject::projectLastProjects';

        global $lastFiles;

        foreach ($lastFiles as $file) {
            $arr[] = replaceSr(
                str_replace(replaceSl(winLocalPath(CSIDL_PERSONAL)), '%MyDocuments%', $file)
            );
        }

        c('fmNewProject->lastProjects')->items->setArray($arr);

        $res = $dlg->showModal();

        if ($res == mrOk || $GLOBALS['__newproject_modalresult'] == mrOk) {

            $result['PATH'] = replaceSl(c('fmNewProject->path')->text);
            if (fileExt($result['PATH']) != 'msppr') {

                msg(t('Project file must have a ".msppr" extension'));
                return false;
            }

            $result['DEL_ALL_FILES'] = c('fmNewProject->c_alldelete')->checked;
        } else
            $result = false;

        return $result;
    }

    static function clearProject()
    {

        global $_sc;
        foreach (myUtils::$forms as $form)
            $form->free();

        $_sc = false;
        myUtils::$forms = array();
    }

    static function initLastFiles($file = false)
    {

        global $lastFiles;

        if ($file) {
            $lastFiles = array_reverse($lastFiles);

            $file = str_replace('//', '/', $file);

            if (array_search($file, $lastFiles) !== false)
                unset($lastFiles[array_search($file, $lastFiles)]);
            $lastFiles = array_values($lastFiles);

            $lastFiles[] = $file;

            if (count($lastFiles) > 7) {
                unset($lastFiles[0]);
                $lastFiles = array_values($lastFiles);
            }

            $lastFiles = array_reverse($lastFiles);
        }

        foreach ($lastFiles as $i => $xfile)
            if (!is_file($xfile)) {

                unset($lastFiles[$i]);
            }

        $lastFiles = array_values($lastFiles);
        file_put_contents(DS_USERDIR . 'last.lst', serialize($lastFiles));

        /*
         * ���������� ������� "��������� �������" � "���� �������" � ���� "����".
         */
        $objLast = c('fmMain->it_lastprojects');

        $objLast->clear();

        $it = new TMenuItem($objLast);
        $it->caption = t('clear_list');
        $it->onClick = 'myProject::lastClearClick';
        styleMenu::addItem($it);
        $objLast->addItem($it);

        $it = new TMenuItem($objLast);
        $it->caption = '-';
        styleMenu::addItem($it);
        $objLast->addItem($it);


        foreach ($lastFiles as $xfile) {
            $it = new TMenuItem($objLast);
            $it->caption = $xfile;
            $it->onClick = 'myProject::lastFileClick';
            styleMenu::addItem($it);
            $objLast->addItem($it);
        }


        global $demoLoad;

        if ($demoLoad) return;

        $demoLoad = true;
        $objLast = c('fmMain->it_demoprojects');

        $demos = findFiles(dirname(EXE_NAME) . '/demos/', 'dvs');
        foreach ($demos as $xfile) {

            $it = new TMenuItem($objLast);
            $it->caption = basenameNoExt($xfile);
            $it->onClick = 'myProject::demosClick';
            styleMenu::addItem($it);
            $objLast->addItem($it);
        }
    }

    static function checkOldFormat()
    {

        $GLOBALS['IS_OLD_PROJECT'] = false;
        if (self::cfg('DV_VERSION') == '' || self::cfg('DV_VERSION') == '2.0.0.0') {
            //if (true){
            //$GLOBALS['IS_OLD_PROJECT'] = true;
            // ������������ ������ ������ �������...
            alert(t("�� ��������� ��������� ������ ������� �������. ������ ������ ������ �� ��������������"));
            return false;

            global $_FORMS, $fmEdit;

            foreach ($_FORMS as $form) {
                myUtils::loadForm($form);
                $del_objs = array();

                $components = $fmEdit->componentList;
                foreach ($components as $el) {

                    if ($el instanceof __TNoVisual) {

                        self::convertOldNoVisual($el);
                        $del_objs[] = $el;

                    } elseif ($el instanceof TEvents) {
                        $obj_name = $el->component_name;

                        if ($obj_name === '')
                            $obj_name = '--fmedit';

                        if ($obj_name) {

                            $obj_ind = $fmEdit->findComponent($obj_name)->componentIndex;
                            if (($obj_ind + 1) || $obj_name == '--fmedit') {
                                $events = $el->list;
                                eventEngine::$DATA[strtolower($form)][strtolower($obj_name)] = $events;
                            }
                        }

                        $del_objs[] = $el;
                    }
                }


                foreach ($del_objs as $el) {
                    $el->free();
                }


                myUtils::saveForm();
            }

            eventEngine::dataToLower();
            myUtils::saveProject();
            return true;
        }

        $GLOBALS['IS_OLD_PROJECT'] = false;
        return true;
    }

    static function cfg($name, $value = null)
    {

        global $myProject;
        if ($value === null) {
            return $myProject->add_info[$name];
        } elseif ($value === false)
            unset($myProject->add_info[$name]);
        else
            $myProject->add_info[$name] = $value;
    }

    static function convertOldNoVisual($obj)
    {

        global $fmEdit;
        $obj_name = $obj->name;
        $obj->name = '';
        $props = TComponent::__getPropExArray($obj->self);
        $class = rtii_class($obj->self);


        $result = new $class($fmEdit);
        $result->parent = $fmEdit;

        $result->name = $obj_name;
        $result->x = $obj->x;
        $result->y = $obj->y;


        foreach ($props as $key => $value)
            $result->$key = $value;

        return $result;
    }

    static function open($file, $init = true)
    {

        $file = replaceSl($file);

        if (!file_exists($file)) return false;

        global $_FORMS, $myProject, $projectFile;

        $last_project = $projectFile;

        self::initLastFiles($projectFile);

        $forms = explode(_BR_, file_get_contents($file));
        $file_ex = dirname($file) . '/' . basenameNoExt($file);

        if ($init)
            if (file_exists($file_ex . '.inf')) {

                $info = unserialize(file_get_contents($file_ex . '.inf')); // fix bug
                $myProject->config = $info['config'];
                $myProject->formsInfo = $info['formsInfo'];
            }

        if (file_exists($file_ex . '.cfg')) {
            $myProject->add_info = unserialize(file_get_contents($file_ex . '.cfg'));
        }

        if (file_exists($file_ex . '.events')) {

            eventEngine::$DATA = unserialize(file_get_contents($file_ex . '.events'));

        } else {

        }

        self::clearProject();

        myVars::set($file, 'projectFile');
        myVars::set($forms, '_FORMS');
        myVars::set(0, 'formSelected');

        myUtils::loadForm($forms[0], true);

        self::genTabs();

        if (!self::checkOldFormat()) {
            self::open($last_project);
            return;
        }

        self::showIncorrect();
    }

    static function genTabs()
    {

        global $_FORMS;

        c('fmMain->tabForms')->tabs->clear();

        foreach ($_FORMS as $form) {
            c('fmMain->tabForms')->addPage($form);
        }
    }

    static function showIncorrect()
    {

        $classes = array();
        foreach ($myProject->formsInfo as $form => $data) {

            $objs = $data['objects'];
            foreach ($objs as $o) {

                if (!class_exists($o['CLASS'])) {
                    $classes[] = $o['CLASS'];
                }
            }
        }

        array_unique($classes);

        if (count($classes) > 0) {

            message(t('� ������� ������������ ��������� �������������� ������:') . "\n\r\n\r" .
                implode(',', $classes));
        }
    }

    static function setStatus($text, $progress)
    {


    }

    static function getFormsObjects($classes = false)
    {

        global $myProject, $_FORMS, $formSelected, $fmEdit;

        $result = array();
        for ($i = 0; $i < count($_FORMS); $i++) {

            $result[$_FORMS[$i]] = array();
            $result[$_FORMS[$i]] = $myProject->formsInfo[$_FORMS[$i]]['objects'];
        }

        $result[$_FORMS[$formSelected]] = array();
        $components = $fmEdit->componentList;
        foreach ($components as $el) {
            if ($el->name) {

                $arr = array('NAME' => $el->name, 'CLASS' => rtii_class($el->self));

                if (method_exists($el, '__inspectProperties')) {
                    $i_props = $el->__inspectProperties();
                    foreach ((array)$i_props as $x_prop) {
                        $arr[$x_prop] = $el->$x_prop;
                    }
                }

                $result[$_FORMS[$formSelected]][] = $arr;
            }
        }

        if ($classes) {
            foreach ($result as $form => $objects) {

                $tmp[$form] = array();
                foreach ($objects as $el) {

                    if (in_array($el['CLASS'], $classes))
                        $tmp[$form][] = $el;
                }
            }
            $result = $tmp;
        }

        return (array)$result;
    }

    static function saveFormInfo()
    {

        global $fmEdit, $myProject, $formSelected, $_FORMS;

        $info =& $myProject->formsInfo[$_FORMS[$formSelected]];

        $info['maxwidth'] = $fmEdit->constraints->maxwidth;
        $info['minwidth'] = $fmEdit->constraints->minwidth;
        $info['maxheight'] = $fmEdit->constraints->maxheight;
        $info['minheight'] = $fmEdit->constraints->minheight;

        $props = array('autoScroll', 'autoSize', 'alphaBlend', 'alphaBlendValue', 'screenSnap', 'clientWidth', 'clientHeight',
            'snapBuffer', 'transparentColor', 'transparentColorValue', 'borderWidth');
        foreach ($props as $p) {
            $info[$p] = $fmEdit->$p;
        }

        $info['objects'] = array();
        $components = $fmEdit->componentList;
        foreach ($components as $el) {

            if ($el->name) {

                $arr = array('NAME' => $el->name, 'CLASS' => rtii_class($el->self));

                if (method_exists($el, '__inspectProperties')) {
                    $i_props = $el->__inspectProperties();
                    foreach ((array)$i_props as $x_prop) {
                        $arr[$x_prop] = $el->$x_prop;
                    }
                }

                $info['objects'][] = $arr;

            }
        }

        self::save();
    }

    static function save($file = false)
    {

        global $projectFile, $_FORMS, $myProject;

        // � ������� ���������� ����������� $self �������� ����, ��-�� ���� � ���� ������������ $self - �������������
        if (is_numeric($file)) $file = false; // fix bug _empty() when compile


        if ($file)
            $projectFile = replaceSl($file);

        if (!file_exists(dirname($projectFile)))
            mkdir(dirname($projectFile), 0777, true);

        if (!file_exists(dirname($projectFile) . '/' . basenameNoExt($projectFile) . '.inf')) {

            $myProject->config['debug'] = array();
            $myProject->config['debug']['enabled'] = true;
            $myProject->config['data_dir'] = 'data';
        }

        myProject::cfg('DV_VERSION', DV_VERSION);
        myProject::cfg('DV_PREFIX', DV_PREFIX);

        $info['formsInfo'] = $myProject->formsInfo;
        $info['config'] = $myProject->config;

        file_put_contents(dirname($projectFile) . '/' . basenameNoExt($projectFile) . '.inf', serialize($info));
        file_put_contents(dirname($projectFile) . '/' . basenameNoExt($projectFile) . '.cfg', serialize($myProject->add_info));
        file_put_contents(dirname($projectFile) . '/' . basenameNoExt($projectFile) . '.events', serialize((array)eventEngine::$DATA));


        file_put_contents($projectFile, implode(_BR_, $_FORMS));

        /*if (class_exists('myCompile'))
            myCompile::generateIncFile();*/

        //pre(c('fmMain->statusBar'));
    }

    static function loadFormInfo()
    {

        global $fmEdit, $myProject, $formSelected, $_FORMS;

        $info = $myProject->formsInfo[$_FORMS[$formSelected]];

        $props = array('autoScroll', 'autoSize', 'alphaBlend', 'alphaBlendValue', 'screenSnap', 'clientWidth', 'clientHeight',
            'snapBuffer', 'transparentColor', 'transparentColorValue', 'borderWidth');

        $fmEdit->constraints->maxwidth = $info['maxwidth'];
        $fmEdit->constraints->minwidth = $info['minwidth'];
        $fmEdit->constraints->maxheight = $info['maxheight'];
        $fmEdit->constraints->minheight = $info['minheight'];

        foreach ($props as $p) {
            $fmEdit->$p = $info[$p];
        }
    }

    static function setPropForm($prop, $value)
    {

        global $fmEdit, $myProject, $formSelected, $_FORMS;

        $myProject->formsInfo[$_FORMS[$formSelected]][$prop] = $value;
    }

    static function getPropForm($prop, $def = false)
    {

        global $fmEdit, $myProject, $formSelected, $_FORMS;

        if (!isset($myProject->formsInfo[$_FORMS[$formSelected]][$prop]))
            return $def;
        else
            return $myProject->formsInfo[$_FORMS[$formSelected]][$prop];
    }

    // ��������� ������ � ������� .DVS - Devel Studio Format

    static function lastFileClick($self)
    {

        $xfile = _c($self)->caption;
        $xfile = trim($xfile);
        $xfile = str_replace("&", '', $xfile);

        if (file_exists($xfile)) {

            if (confirm(t('Are you shure to open "%s" ?', $xfile)))
                self::open($xfile);
        }
    }

    static function demosClick($self)
    {

        $xfile = _c($self)->caption;
        $xfile = trim($xfile);
        $xfile = str_replace("&", '', $xfile);

        $xfile = dirname(EXE_NAME) . '/demos/' . $xfile . '.dvs';

        if (file_exists($xfile)) {

            if (confirm(t('Are you shure to open "%s" ?', $xfile)))
                self::openFromDVS($xfile);
        }
    }

    // ������� ���� ������� ������� DVS...

    static function lastClearClick($self)
    {

        global $lastFiles;
        $lastFiles = array();
        self::initLastFiles();
    }

    static function projectDialogKeyDown($self, $key)
    {

        if ($key == VK_RETURN) {
            $GLOBALS['__newproject_modalresult'] = mrOk;
        } elseif ($key == VK_ESCAPE) {
            $GLOBALS['__newproject_modalresult'] = mrCancel;
            c('fmNewProject')->close();
        }
    }

    static function projectDialogBtn()
    {

        $dlg = new TSaveDialog;
        $dlg->filter = 'DevelStudio Project (*.msppr)|*.msppr';

        if ($dlg->execute()) {


            $dlg->fileName = fileExt($dlg->fileName) == 'msppr' ? $dlg->fileName : $dlg->fileName . '.msppr';
            c('fmNewProject->path')->text = $dlg->fileName;
        }

        $dlg->free();
    }

    static function projectLastProjects($self)
    {

        $file = replaceSl(
            str_replace('%MyDocuments%', replaceSr(winLocalPath(CSIDL_PERSONAL)), _c($self)->items->selected)
        );

        if (file_exists($file)) {

            if (confirm(t('Are you shure to open "%s" ?', $file)))
                self::open($file);
        }

        c('fmNewProject')->close();
    }

    static function newProjectDialog()
    {

        global $projectFile, $_FORMS, $myProject;

        $dir = replaceSr(DS_USERDIR);
        //(winLocalPath(CSIDL_PERSONAL)).'\\DevelStudio';

        $i = 1;
        while (is_dir($dir . '\Project' . $i)) $i++;

        /****** event *****/
        if (!CApi::doEvent('onProjectDialog', array('dir' => $dir, 'index' => $i))) return;
        /****** ---- *****/

        $result = self::projectDialog($dir . '\Project' . $i . '\Project.msppr');

        if ($result) {

            /****** event *****/
            if (!CApi::doEvent('onNewProject', array('filename' => $result['PATH']))) return;
            /****** ---- *****/

            $_FORMS = array();
            c('fmMain->tabForms')->tabs->clear();
            $projectFile = $result['PATH'];

            if (file_exists($projectFile))
                unlink($projectFile);

            $myProject->config['modules'] = array();

            $myProject->config['debug'] = array();
            $myProject->config['debug']['enabled'] = true;
            $myProject->config['data_dir'] = 'data';

            $myProject->config['debug']['no_warnings'] = false;
            $myProject->config['debug']['no_errors'] = false;
            $myProject->config['prog_type'] = 0;


            if (file_exists(dirname($projectFile) . '/' . basenameNoExt($projectFile) . '.events'))
                unlink(dirname($projectFile) . '/' . basenameNoExt($projectFile) . '.events');


            $myProject->config['apptitle'] = 'Project' . $i;
            eventEngine::$DATA = array();

            myUtils::saveProject();
            myUtils::createForm('Form1');
            self::open($projectFile, false);


            /****** event *****/
            if (!CApi::doEvent('onNewProjectAfter', array('filename' => $result['PATH']))) return;
            /****** ---- *****/
        }
    }

    static function saveAsDVSDialog()
    {

        $dlg = new TSaveDialog;
        $dlg->filter = 'DevelStudio Pack Project (*.dvs)|*.dvs|DFM Form (*.dfm)|*.dfm';

        if ($dlg->execute()) {

            $dlg->fileName = replaceSl($dlg->fileName);
            if (file_exists($dlg->fileName)
                && !confirm(t('File "%s" already exists! You want to replace this file?', basename($dlg->fileName)))) return false;

            $index = $dlg->filterIndex;

            /****** event *****/
            if (!CApi::doEvent('onSaveProject', array('filename' => $dlg->fileName, 'ext' => $index === 1 ? 'dvs' : 'dfm'))) return;
            /****** ---- *****/

            switch ($index) {

                case 1:
                    $dlg->fileName = fileExt($dlg->fileName) == 'dvs' ? $dlg->fileName : $dlg->fileName . '.dvs';
                    self::saveAsDVS($dlg->fileName);
                    break;
                case 2:
                    $dlg->fileName = fileExt($dlg->fileName) == 'dfm' ? $dlg->fileName : $dlg->fileName . '.dfm';
                    self::saveAsDFM($dlg->fileName);
                    break;
            }

            /****** event *****/
            if (!CApi::doEvent('onSaveProjectAfter', array('filename' => $dlg->fileName, 'ext' => $index === 1 ? 'dvs' : 'dfm'))) return;
            /****** ---- *****/

            return true;
        } else
            return false;

        $dlg->free();
    }

    static function saveAsDVS($file)
    {

        $file = replaceSl($file);

        if (!is_writable(dirname($file)))
            return false;


        myUtils::saveForm();

        global $projectFile, $_FORMS, $myProject;

        $dir = dirname($projectFile);
        $data = array(); // ����� ������ ��������� �����...
        $data['CONFIG'] = $myProject->config;
        $data['formsInfo'] = $myProject->formsInfo;
        $data['add_info'] = $myProject->add_info;
        $data['eventDATA'] = eventEngine::$DATA;

        /* ������ �������� */
        $scripts = findFiles($dir . '/scripts/', 'php');
        foreach ($scripts as $x_file)
            $data['scripts'][$x_file] = file_get_contents($dir . '/scripts/' . $x_file);
        /****************/


        /* ������ �������� */
        if (trim($myProject->config['data_dir'])) {
            $data_dir = $dir . '/' . $myProject->config['data_dir'] . '/';
            $files = findFiles($data_dir, null, true, true);
            foreach ($files as $x_file) {
                $data['data'][str_replace($data_dir, '/', $x_file)] = gzcompress(file_get_contents($x_file), 9);
            }
        }

        foreach ($_FORMS as $form) {

            $dfm_file = $dir . '/' . $form . '.dfm';
            if (file_exists($dfm_file)) {

                $str = file_get_contents($dfm_file);
                $data['DFM'][$form] = $str;
            }
        }

        $result = gzcompress(base64_encode(serialize($data)), 9);

        file_put_contents($file, $result);
    }

    static function saveAsDFM($file)
    {

        myUtils::saveFormDFM($file);
    }

    static function openFromFileDialog()
    {


        $dlg = new TOpenDialog;
        $dlg->filter =
            'DevelStudio Files (*.dvs, *.msppr, *.dfm)|*.dvs;*.msppr;*.dfm|DevelStudio Pack Project (*.dvs)|*.dvs|DevelStudio Open Project (*.msppr)|*.msppr' .
            '|DFM Forms (*.dfm)|*.dfm';

        if ($dlg->execute()) {

            $dlg->fileName = replaceSl($dlg->fileName);

            $ext = fileExt($dlg->fileName);
            $filename = $dlg->fileName;

            /****** event *****/
            if (!CApi::doEvent('onOpenProject', array('filename' => $filename, 'ext' => $ext))) return;
            /****** ---- *****/

            switch ($ext) {

                case 'dvs':
                    self::openFromDVS($filename);
                    break;
                case 'msppr':
                    self::open($filename);
                    break;
                case 'dfm':
                    self::openAsDFM($filename);
                    break;
            }

            /****** event *****/
            if (!CApi::doEvent('onOpenProjectAfter', array('filename' => $filename, 'ext' => $ext))) return;
            /****** ---- *****/
        }
    }

    static function openAsDFM($file)
    {

        global $_FORMS, $formSelected, $fmEdit, $myInspect;
        myUtils::loadFormDFM($file);

        $myInspect->generate($fmEdit);
        myDesign::formProps();
    }
}

$GLOBALS['myProject'] = new myProject;