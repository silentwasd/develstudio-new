<?php

class myCompile
{
    static 	public $codes;

    static public function loadRegisterMenu($self, $x, $y, $url, $iurl, $purl, $furl, $text, &$resume)
    {
        $resume = false;
    }

    static public function loadRegisterError($self, $x, $y, $url, $iurl, $purl, $furl, $text, &$resume)
    {
        c($self)->loadFile(DOC_ROOT . "../registration/error.html");
        $resume = false;
    }

    static public function loadRegister($form)
    {
        $browser = new TChromium($form);
        $browser->parent = $form;
        $browser->align = alClient;
        $browser->url = "http://develstudio.ru/register/";
        $browser->onLoadError = "myCompile::loadRegisterError";
        $browser->onBeforeMenu = "myCompile::loadRegisterMenu";
        $panel = new TPanel($form);
        $panel->parent = $form;
        $panel->text = "Загрузка, подождите...";
        $panel->x = 50;
        $panel->y = 50;
    }

    static public function toRegister($data)
    {
        $data = unserialize(gzuncompress(base64_decode($data)));
        pre($data);
    }

    static public function setStatus($type, $text)
    {
        $list = c("fmMain->debugList");

        if ($text === false) {
            $list->text = "";
            return NULL;
        }

        if ($type) {
            $list->text .= "[" . $type . "] " . $text . _BR_;
        }
        else {
            $list->text .= $text . _BR_;
        }

        $list->itemIndex = $list->items->count - 1;
    }

    static public function compilePHZ($file, $base64 = true, $code = false)
    {
        DS_bCompiler::clear();

        if (is_file($file)) {
            DS_bCompiler::addFromBC($file);
        }
        else {
            foreach ($file as $class ) {
                DS_bCompiler::addClass($class);
            }

            $file = TEMP_DIR . "/" . rand() . ".php";
            file_put_contents($file, "<? " . $code);
        }

        $real_file = dirname($file) . "/" . basenameNoExt($file);
        $ofile = $real_file . ".php";
        $cfile = $real_file . ".phb";

        if (file_exists($cfile)) {
            unlink($cfile);
        }

        if (DS_DEBUG_MODE) {
            myCompile::setStatus("Debug", t("Компилируем файл bcompier-ом ") . $ofile);
        }

        $err = DS_bCompiler::compile($ofile, $cfile);

        if (DS_DEBUG_MODE) {
            myCompile::setStatus("Debug", $err);
        }

        if ($code && is_file($file)) {
            unlink($file);
        }

        return $real_file . ".phb";
    }

    public function compilePHB($file, $base64 = true, $code = false)
    {
        $result = self::compilePHZ($file, $base64, $code);
        $result = dirname($result) . "/" . basenameNoExt($result) . ".phb";
        return $result;
    }

    static public function afterLoad()
    {
        define("DS_DEBUG_MODE", false);
    }

    static public function addCompileCode($code)
    {
        self::$codes[] = $code;
    }

    static public function callModifers($check = false)
    {
        global $projectFile;
        $arr = myProject::getFormsObjects();

        foreach ($arr as $form => $objs ) {
            foreach ($objs as $obj ) {
                $class = "modifer_" . $obj["CLASS"];

                if (class_exists($class)) {
                    if ($check) {
                        if (method_exists($class, "listEvent")) {
                            $tmp = new $class();
                            $listEvent = $tmp->listEvent();

                            foreach (eventEngine::$DATA[strtolower($form)][strtolower($obj["NAME"])] as $event => $code ) {
                                if (!in_array($event, $listEvent)) {
                                    unset(eventEngine::$DATA[strtolower($form)][strtolower($obj["NAME"])]);
                                }
                            }

                            unset($tmp);
                        }
                    }
                    else if (method_exists($class, "toResult")) {
                        $tmp = new $class();
                        $tmp->toResult($form, $obj["NAME"], $obj, eventEngine::$DATA[strtolower($form)][strtolower($obj["NAME"])]);
                        unset($tmp);
                    }
                }
            }
        }
    }

    static public function generateIncFile()
    {
        $file = SYSTEM_DIR . "/blanks/inc.php";
        $inc = file_get_contents($file);
        if (file_exists($file) && (DS_DEBUG_MODE === true)) {
            self::compilePHZ(SYSTEM_DIR . "/blanks/loader.bc", false);
        }

        $hash = md5("%*(" . $inc . "@#78");
        exemod_addstr("\$PHPSOULENGINE\inc.php", $inc);
        exemod_addstr("\$PHPSOULENGINE\inc.php.hash", $hash);
        $loader = file_get_contents(SYSTEM_DIR . "/blanks/loader.php");
        exemod_addstr("\$PHPSOULENGINE\loader", gzcompress($loader, 5));
        exemod_addstr("\$PHPSOULENGINE\loader.hash", md5("%*(" . $loader . "@#78"));
        
        global $myProject;
        $modules = array();

        foreach ((array) $myProject->config["modules"] as $mod ) {
            if (file_exists(dirname(EXE_NAME) . "/ext/" . $mod)) {
                $modules[] = $mod;
            }
        }

        exemod_addstr("\$PHPSOULENGINE\mods", implode(",", $modules));
        exemod_addstr("\$PHPSOULENGINE\mods.hash", md5("%*(" . implode(",", $modules) . "@#78"));
        $md5s = array();

        foreach ($modules as $mod ) {
            $md5s[] = md5_file(dirname(EXE_NAME) . "/ext/" . $mod);
        }

        exemod_addstr("\$PHPSOULENGINE\mods_m", implode(",", $md5s));
    }

    static public function generatePHP_Ini()
    {
        myCompile::setStatus("Info", t("Генерируем конфигурацию PHP.ini") . "...");
        global $myProject;
        $php_ini = file_get_contents(dirname(EXE_NAME) . "/core/c_php.ini");
        $myProject->config["modules"] = array_unique($myProject->config["modules"]);
        $str = "";
        $md5s = array();

        foreach ((array) $myProject->config["modules"] as $mod ) {
            if (file_exists(dirname(EXE_NAME) . "/ext/" . $mod)) {
                $str .= "extension=" . $mod . "\n";
            }
        }

        $php_ini = str_ireplace("; %_modules_% ;", $str, $php_ini);
        return $php_ini;
    }

    static public function attachPHPEngine($path = false, $attach_ini = false)
    {
        global $projectFile;

        if (!$path) {
            $path = dirname($projectFile);
        }

        $ini = self::generatePHP_Ini();
        $ini_hash = md5("%*(" . $ini . "@#78");

        if ($attach_ini) {
            exemod_addstr("\$PHPSOULENGINE\phpini", $ini);
        }
        else {
            file_put_contents($path . "/php.ini", $ini);
        }

        exemod_addstr("\$PHPSOULENGINE\phpini.hash", $ini_hash);
        $php5ts = self::copyPHPts(false);
        $php_hash = md5("%*(" . file_get_contents($php5ts) . "@#78");
        exemod_addstr("\$PHPSOULENGINE\phpts.hash", $php_hash);
        exemod_addstr("\$PHPSOULENGINE\phpts.size", intval(filesize($php5ts) * 3) / 4);
    }

    static public function getVersion()
    {
        return "3.0beta1";
    }

    static public function getUID()
    {
        $obj = new COM("winmgmts://localhost/root/CIMV2");
        $wmi = $obj->ExecQuery("SELECT * FROM Win32_ComputerSystemProduct");

        foreach ($wmi as $objj ) {
            $uid = $UUID;
        }

        $uid = md5(self::getVersion() . $uid . "DS3");
        return strtoupper($uid);
    }

    static public function attachSignature()
    {
        $obj = new COM("winmgmts://localhost/root/CIMV2");
        $wmi = $obj->ExecQuery("SELECT * FROM Win32_ComputerSystemProduct");

        foreach ($wmi as $objj) {
            $uid = $objj->uuid;
        }

        $uid = strtoupper(md5(self::getVersion() . $uid . "DS3"));
        $check_uid = substr(md5("DS3" . $uid), 0, -3);
        $str = "\r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    WARNING!!! WARNING!!! WARNING!!!\r\n\t\t    WARNING!!! WARNING!!! WARNING!!!\r\n\t\t    WARNING!!! WARNING!!! WARNING!!!\r\n\t\t    WARNING!!! WARNING!!! WARNING!!!\r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    \r\n\t\t    ----------------- FOR ANTI-VIRUS Analysts ----------------\r\n\t\t    \r\n\t\t\tThis application consists of several parts - it is done\r\n\t\t\twith the help of technology php2exe (analog py2exe).\r\n\t\t\tThese real source code (bcompiler byte-code + php code)\r\n\t\t\tattached to the end of this exe file and start with a line:\r\n\t\t\t\r\n\t\t\t\"\$loader = exemod_extractstr('\$PHPSOULENGINE\\\\loader'); ....\"\r\n\t\t\t\r\n\t\t    ----------------- FOR ANTI-VIRUS Analysts END ----------------\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t    ";
        exemod_addstr("\$FOR_ANTIVIRUS_START", $str);
        exemod_addstr("\$PHPSOULENGINE\sign", $uid);
        exemod_addstr("\$PHPSOULENGINE\sign.check", $check_uid);
        exemod_addstr("\$PHPSOULENGINE\warning.check", sha1($str . "DS3"));
    }

    static public function attachPHPSoulEngine($attach = true)
    {
        global $projectFile;
        $build = new DS_BuildSoulEngine(dirname(EXE_NAME) . "/core/");

        if ($attach) {
            $str = $build->SaveToFile(false);
            exemod_addstr("\$soulEngine", $str);
        }
        else {
            $str = $build->SaveToFile(dirname($projectFile) . "/soulEngine.pak");
        }

        exemod_addstr("\$soulEngine.h", gzcompress(md5(crc32($str . "$#"))));
    }

    static public function attachResources($dir = false)
    {
        global $projectFile;

        if (!$dir) {
            $dir = dirname($projectFile) . "/data/";
        }

        myCompile::setStatus("Info", t("Добавляем ресурсы") . "...");
        $files = findFiles($dir, NULL, true, true);
        $aliases = array();

        foreach ($files as $file ) {
            $file = str_replace($dir . "/", "", $file);
            $alias = str_replace("//", "/", "\$RES\$" . replaceSl($file));
            $aliases[] = $alias;
            exemod_addfile($alias, $dir . "/" . $file);
        }

        exemod_addstr("\$RESLIST\$", serialize($aliases));
    }

    static public function attachModules($attach_dll = false)
    {
        self::callModifers();
        myCompile::setStatus("Info", t("Добавляем PHP Модули") . "...");
        $dir = SYSTEM_DIR . "/modules/";
        $files = findFiles($dir, "php", false, true);

        if ($GLOBALS["DEBUG_MODE"]) {
            $files = array_merge($files, findFiles($dir . "debug/", "php", false, true));
        }

        $str = "";
        $modules = myModules::getInc();

        foreach ($modules as $mod ) {
            $mod = str_replace(".dll", "", $mod);

            if (file_exists(dirname(EXE_NAME) . "/ext/" . $mod . ".php")) {
                $files[] = dirname(EXE_NAME) . "/ext/" . $mod . ".php";
            }

            if (file_exists(dirname(EXE_NAME) . "/ext/" . $mod . ".phpe2")) {
                $files[] = dirname(dirname(EXE_NAME) . "/ext/" . $mod . ".phpe2");
            }
        }

        $files = array_merge($files, myModules::getPHPModules());

        foreach ($files as $i => $file ) {
            if (fileExt($file) == "phpe2") {
                $str .= myXVer::unPack(file_get_contents($file));
            }
            else {
                $str .= trim(file_get_contents($file));
            }

            if (($str[strlen($str) - 2] . $str[strlen($str) - 1]) != "?>") {
                $str .= "?>";
            }
        }

        foreach ((array) self::$codes as $code ) {
            $str .= "<? " . $code . " ?>";
        }

        $str = php_strip_whitespace_ex($str);
        exemod_addstr("\$X_MODULES", gzcompress($str, 5));
        self::$codes = array();
    }

    static public function attachForms($attachData = false, $with_bcompiler = false)
    {
        global $_FORMS;
        global $projectFile;
        global $myProject;
        exemod_addstr("\$X_FORMS", implode(_BR_, $_FORMS));
        myCompile::setStatus("Info", t("Сохраняем конфигурацию проекта") . "...");
        $info["formsInfo"] = $myProject->formsInfo;
        $myProject->config["attachData"] = $attachData;
        $info["config"] = $myProject->config;
        $info["config"]["use_bcompiler"] = $with_bcompiler;
        exemod_addstr("\$X_CONFIG", base64_encode(serialize($info)));
        myCompile::setStatus("Info", t("Генерируем формы") . "...");

        foreach ($_FORMS as $name ) {
            $str = file_get_contents(dirname($projectFile) . "/" . $name . ".dfm");
            $str = str_replace("fsMDIChild", "fsNormal", $str);
            $data[$name] = $str;
        }

        myCompile::setStatus("Info", t("Генерируем основной модуль") . "...");
        self::callModifers(true);

        if (!$with_bcompiler) {
            $compileDATA = eventEngine::$DATA;
        }
        else {
            myCompile::setStatus("Info", t("Генерируем код для событий") . "...");
            $code = myCodegen::doAllEvents(eventEngine::$DATA, myProject::getFormsObjects());
            myCompile::setStatus("Info", t("Модифицируем события для BCompiler'a") . "...");
            $compileDATA = myCodegen::doCompileEventDATA(eventEngine::$DATA, myProject::getFormsObjects(), $classes);
            myCompile::setStatus("Info", t("Компилируем исходники BCompiler'ом") . "...");
            $phz_file = gzcompress(file_get_contents(self::compilePHZ($classes, false, $code)), 5);
            exemod_addstr("\$_exEvFILE", $phz_file);
        }

        myCompile::setStatus("Info", t("Сохраняем основной модуль") . "...");
        exemod_addstr("\$_EVENTS", gzcompress(serialize($compileDATA), 9));
        exemod_addstr("\$F\Xforms", gzcompress(serialize($data), 9));
    }

    static public function getExeModule()
    {
        return EXE_NAME;

        if (DS_DEBUG_MODE === true) {
            return EXE_NAME;
        }

        if (file_exists(EXE_NAME . ".small")) {
            $result = EXE_NAME . ".small";
        }
        else {
            $result = EXE_NAME;
        }

        return $result;
    }

    static public function _start($check = true, $use_bcompiler = false)
    {
        $_e = err_status(false);
        global $projectFile;
        global $myProject;
        myUtils::saveForm();
        myCompile::setStatus("", false);
        myCompile::setStatus("", t("Компиляция проекта") . "...");

        if ($use_bcompiler) {
            myCompile::setStatus("Warning", t("Используем BCompiler!") . "...");
        }

        $php_dir = dirname(replaceSl(EXE_NAME)) . "/php/";
        $p_dir = dirname($projectFile) . "/php/";
        $exeFile = dirname($projectFile) . "/" . basenameNoExt($projectFile) . ".exe";

        if (file_exists($exeFile)) {
            kill_task(basename($exeFile));
            delay(100);
            $s_err = err_status(false);
            $id = unlink($exeFile);

            for ($q = 0; $q < 20; $q++) {
                if (file_exists($exeFile)) {
                    unlink($exeFile);
                }
            }

            err_status($s_err);
            if (file_exists($exeFile) && $check) {
                myCompile::setStatus("Warning", t("Файл программы занят, пробуем снова") . "...");
                sleep(1);
                return self::_start(false);
            }

            if (file_exists($exeFile)) {
                myCompile::setStatus("Ошибка компиляции", t("Попробуйте запустить среду с правами администратора") . "!");
                message_beep(MB_ICONERROR);
                return false;
            }
        }

        x_copy(self::getExeModule(), $exeFile);
        exemod_start(self::getExeModule());
        self::generateIncFile();
        myModules::inc();
        self::attachPHPEngine(false, false);
        self::attachSignature();
        self::attachPHPSoulEngine(false);
        self::attachForms(false, $use_bcompiler);
        self::attachModules();
        exemod_saveexe($exeFile);
        exemod_finish();
        myCompile::setStatus("", t("Запускаем программу") . "...");
        shell_execute(0, "open", replaceSr($exeFile), " -c " . receiver_handle(), replaceSr(dirname($exeFile)), SW_SHOW);
        err_status($_e);
    }

    static public function copyPHPts($to)
    {
        global $projectFile;
        $php_dir = dirname(replaceSl(EXE_NAME)) . "/";

        if (!$to) {
            $p_dir = dirname($projectFile) . "/";
        }
        else {
            $p_dir = $to . "/";
        }

        if (!is_dir($p_dir)) {
            mkdir($p_dir, 511, true);
        }

        $m = 0;

        if (file_exists($p_dir . "php5ts.dll")) {
            while (!unlink($p_dir . "php5ts.dll")) {
                $m += 1;

                if (30 < $m) {
                    break;
                }
            }
        }

        copy($php_dir . "php5ts.dll", $p_dir . "php5ts.dll");
        return $p_dir . "php5ts.dll";
    }

    static public function start($back = true, $debug = false)
    {
        global $DEBUG_MODE;
        global $myProject;
        $DEBUG_MODE = $debug;

        if (!mySyntaxCheck::checkProject()) {
            $exit = true;
        }

        mySyntaxCheck::showErrors();

        if ($exit) {
            return NULL;
        }

        if ($back) {
            $GLOBALS["APPLICATION"]->processMessages();
            self::_start(false, !$myProject->config["debug"]["enabled"]);
        }
        else {
            self::_start(false, !$myProject->config["debug"]["enabled"]);
        }
    }

    static public function adv_start($fileExe, $attachPHP = true, $attachSE = true, $attachData = true, $UPXLevel = 0, $companyName = "", $version = "", $desc = "", $fileIco = "", $with_bcompiler = false)
    {
        global $myProject;
        myCompile::setStatus("", false);
        myCompile::setStatus("", t("Сборка программы") . "...");
        $debug_enabled = $myProject->config["debug"]["enabled"];
        $myProject->config["debug"]["enabled"] = false;
        myUtils::saveForm();
        $fileExe = replaceSl($fileExe);

        if (file_exists($fileExe)) {
            unlink($fileExe);
        }

        if (!is_dir(dirname($fileExe))) {
            mkdir(dirname($fileExe), 511, true);
        }

        $_e = err_status(false);
        x_copy(self::getExeModule(), $fileExe);

        if (err_msg()) {
            pre(err_msg());
            error_message(t("Нет доступа для записи к выбранной папке!"));
            return false;
        }

        if (!file_exists($fileIco)) {
            $fileIco = SYSTEM_DIR . "/blanks/project.ico";
        }

        if (file_exists($fileIco)) {
            while (!is_writable($fileExe)) {
            }

            winRes::changeIcon($fileExe, $fileIco);
        }

        winRes::changeVersion($fileExe, $version);
        winRes::changeFileVersion($fileExe, $version);
        winRes::changeFileDescription($fileExe, $companyName);
        myUPX::compress($fileExe, $UPXLevel);
        $p_dir = false;
        self::copyPHPts(dirname($fileExe));

        if (0 < $UPXLevel) {
        }

        exemod_start($fileExe);
        exemod_addstr("\$PHPSOULENGINE\inc.php", self::generateIncFile());
        self::attachPHPEngine($p_dir, true);
        myModules::inc($fileExe);
        self::attachSignature();

        if ($attachSE) {
            self::attachPHPSoulEngine($attachSE);

            while (!is_writable($fileExe)) {
            }
        }
        else {
            x_copy(DOC_ROOT . "/blanks/soulEngine.pak", dirname($fileExe) . "/soulEngine.pak");
        }

        self::attachForms($attachData, $with_bcompiler);
        self::attachModules();

        if ($attachData) {
            self::attachResources();
        }

        myModules::inc($fileExe, $attachPHP);
        $x = 0;

        while (!file_exists($fileExe . ".$\$\$")) {
            exemod_saveexe($fileExe . ".$\$\$");
            $x++;

            if (50 < $x) {
                break;
            }
        }

        exemod_finish();
        unlink($fileExe);

        if (file_exists($fileExe . ".$\$\$")) {
            while (!rename($fileExe . ".$\$\$", $fileExe)) {
            }
        }

        if ($attachPHP) {
            unlink($p_dir . "php5ts.dll");
            unlink($p_dir . "php.ini");
            rmdir($p_dir);
        }

        err_status($_e);
        $myProject->config["debug"]["enabled"] = $debug_enabled;
    }

    public function generateEventsMD5($DATA)
    {
        foreach ($DATA as $form => $objs ) {
            if ($form[0] == "-") {
                continue;
            }

            foreach ($objs as $name => $eventList ) {
                if (count($eventList)) {
                    foreach ($eventList as $event => $icode ) {
                        if (trim($icode)) {
                        }
                        else {
                            unset(eventEngine::$DATA[strtolower($form)][strtolower($name)][strtolower($event)]);
                        }
                    }
                }
            }
        }
    }

    public function generateEventsClasses($DATA)
    {
        $code = "<? /* autocode from DS Compiler */" . _BR_ . _BR_ . _BR_;
        $rDATA = array();
        $classes = array();

        foreach ($DATA as $form => $objs ) {
            if ($form[0] == "-") {
                continue;
            }

            foreach ($objs as $name => $eventList ) {
                if (count($eventList)) {
                    foreach ($eventList as $event => $icode ) {
                        if (trim($icode)) {
                            if (!in_array("__ev_" . $form . "_" . $name, $classes)) {
                                $code .= "class __ev_" . $form . "_" . $name . "{" . _BR_;
                            }

                            $rDATA[$form][$name][$event] = "__ev_" . $form . "_" . $name . "::" . $event;
                            $code .= "  static function " . $event . "(" . DSApi::getEventParams($event) . "){" . _BR_;
                            $code .= "    eval(\$GLOBALS[\"__incCode\"]); \$self = c(\$self);" . _BR_;
                            $code .= "    " . $icode . _BR_;
                            $code .= "  }" . _BR_;

                            if (!in_array("__ev_" . $form . "_" . $name, $classes)) {
                                $code .= "}" . _BR_ . _BR_;
                            }

                            $classes[] = "__ev_" . $form . "_" . $name;
                        }
                    }
                }
            }
        }

        array_unique($classes);
        return array("code" => $code, "rDATA" => $rDATA, "classes" => $classes);
    }
}

return true;
return NULL;

?>
