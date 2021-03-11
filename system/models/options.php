<?


class myOptions {
    
    static function get($section, $name, $def = null){
        
        if (!isset($GLOBALS['ALL_CONFIG'][$section][$name]))
            return $def;
        else
            return $GLOBALS['ALL_CONFIG'][$section][$name];
    }
    
    static function set($section, $name, $value){
        
        if ( is_array($value) || is_object($value) ){
            $value = base64_encode(serialize($value));
        } elseif ( is_bool($value) )
            $value = $value ? '1' : '0';
            
        $GLOBALS['ALL_CONFIG'][$section][$name] = $value;
    }
    
    static function setXYWH($section, $obj){
        
        myOptions::set($section,'x', $obj->x);
        myOptions::set($section,'y', $obj->y);
        myOptions::set($section,'w', $obj->w);
        myOptions::set($section,'h', $obj->h);
    }
    
    static function getXYWH($section, $obj, $def = false){
        
        if ($def && myOptions::get($section,'x', null)===null){
            
            if (!$def){
                $obj->x = $def[0];
                $obj->y = $def[1];
                $obj->w = $def[2];
                $obj->h = $def[3];
            }
        } else {
            
            $obj->x = myOptions::get($section,'x', $obj->x);
            $obj->y = myOptions::get($section,'y', $obj->y);
            $obj->w = myOptions::get($section,'w', $obj->w);
            $obj->h = myOptions::get($section,'h', $obj->h);
        }
    }
    
    static function setFloat($section, $obj){
        
        //self::setXYWH($section, $obj);
        myOptions::set($section,'x', control_dockleft($obj->self));
        myOptions::set($section,'y', control_docktop($obj->self));
        myOptions::set($section,'w', control_dockwidth($obj->self));
        myOptions::set($section,'h', control_dockheight($obj->self));
    }
    
    static function getFloat($section, $obj){
        
        $x = myOptions::get($section, 'x', 100);
        $y = myOptions::get($section, 'y', 100);
        $w = myOptions::get($section, 'w', $obj->w);
        $h = myOptions::get($section, 'h', $obj->h);
        
        $x = $x - GetSystemMetrics(32);
        $y = $y - GetSystemMetrics(SM_CYSMCAPTION) - GetSystemMetrics(32);
        
        $obj->manualFloat($x,$y, $x+$w, $y+$h);
    }
    
    static function PHPModules(){
        
        global $myProject, $projectFile;
        $form = c('fmPHPModules');
        $list = c('fmPHPModules->list');
        $list->clear();
        
        $modules = findFiles(SYSTEM_DIR . '/../ext/','dll');
        //unset($modules[array_search('php_bcompiler.dll',$modules)]);
        
        $list->items->setArray($modules);
        $list->checkedItems = (array)$myProject->config['modules'];   
        
            /****** event *****/
            if (!CApi::doEvent('onPHPModulesDialog',array('modules'=>(array)$myProject->config['modules']))) return;
            /****** ---- *****/
        
        if ($form->showModal()==mrOk){
            
            /****** event *****/
            if (!CApi::doEvent('onOptions',array('modules'=>(array)$myProject->config['modules']))) return;
            /****** ---- *****/
            
            $myProject->config['modules'] = $list->checkedItems;
            
            myModules::clear();
            myModules::inc();
            
            /****** event *****/
            if (!CApi::doEvent('onOptionsAfter',array('modules'=>(array)$myProject->config['modules']))) return;
            /****** ---- *****/
        }
    }
    
    static function ProjectOptions(){
        
        global $myProject, $projectFile;
        
        $list = c('fmProjectOptions->list');
        $list->clear();
        
        $modules = findFiles(SYSTEM_DIR . '/../ext/','dll');
        //unset($modules[array_search('php_bcompiler.dll',$modules)]);
        
        $list->items->setArray($modules);
        $list->checkedItems = (array)$myProject->config['modules'];   
        
        c('fmProjectOptions->c_debugmode')->checked = $myProject->config['debug']['enabled'];
        c('fmProjectOptions->c_ignorewarnings')->checked = $myProject->config['debug']['no_warnings'];
        c('fmProjectOptions->c_ignoreerrors')->checked = $myProject->config['debug']['no_errors'];
        
        c('fmProjectOptions->c_programtype')->itemIndex = (int)$myProject->config['prog_type'];
        
        c('fmProjectOptions->e_apptitle',1)->text    = $myProject->config['apptitle'];
        c('fmProjectOptions->e_programname',1)->text = basenameNoExt($projectFile);
        
            /****** event *****/
            if (!CApi::doEvent('onProjectOptionsDialog',array())) return;
            /****** ---- *****/    
        
        if (c('fmProjectOptions',1)->showModal() == mrOk){
            
            /****** event *****/
            if (!CApi::doEvent('onProjectOptions',array())) return;
            /****** ---- *****/
            
            $myProject->config['debug']['enabled'] = c('fmProjectOptions->c_debugmode')->checked;
            $myProject->config['debug']['no_warnings'] = c('fmProjectOptions->c_ignorewarnings')->checked;
            $myProject->config['debug']['no_errors'] = c('fmProjectOptions->c_ignoreerrors')->checked;
            $myProject->config['prog_type'] = c('fmProjectOptions->c_programtype')->itemIndex;
            
            $myProject->config['apptitle'] = c('fmProjectOptions->e_apptitle',1)->text;
            $projectFile = dirname($projectFile) . '/' . c('fmProjectOptions->e_programname')->text . '.msppr';
            
            $myProject->config['modules'] = $list->checkedItems;
            
            myModules::clear();
            myModules::inc();
            
            myProject::save();
            
            /****** event *****/
            if (!CApi::doEvent('onProjectOptionsAfter',array())) return;
            /****** ---- *****/
        }
    }
    
    
    static function saveExeDialog(){
        
        $dlg = new TSaveDialog;
        $dlg->filter = 'EXE File (*.exe)|*.exe';
        
        if ($dlg->execute()){
                
            $dlg->fileName = fileExt($dlg->fileName)=='exe' ? $dlg->fileName : $dlg->fileName . '.exe';
            
            if (file_exists($dlg->fileName))
                msg(t('WARNING: File %s exists!',$dlg->fileName));
            
            c('fmBuildProgram->path',1)->text = $dlg->fileName;
        }
        
        $dlg->free();
    }
    
    static function openIconDialog(){
        
        $dlg = new TOpenDialog;
        $dlg->filter = 'Icon files (*.ico)|*.ico';
        
        if ($dlg->execute()){
            
            c('fmBuildProgram->im_icon')->picture->loadFromFile($dlg->fileName);
            myVars::set($dlg->fileName, '__iconFile');
        }
    }
    
    static function saveSettings(){
        
        global $projectFile;
        
        $file = dirname($projectFile).'/build.cfg';
        $ini  = new TIniFileEx($file);
        $ini->write('main','path', c('fmBuildProgram->path')->text);
        $ini->write('main','attachphp', c('fmBuildProgram->c_attachphp')->checked);
        $ini->write('main','attachsoulengine',c('fmBuildProgram->c_attachsoulengine')->checked);
        $ini->write('main','attachdata', c('fmBuildProgram->c_attachdata')->checked);
        $ini->write('main','upx_level', c('fmBuildProgram->c_upx')->itemIndex);
        $ini->write('main','company', c('fmBuildProgram->e_companyname')->text);
        $ini->write('main','version', c('fmBuildProgram->e_version')->text);
        $ini->write('main','use_bcompiler', c('fmBuildProgram->use_bcompiler')->checked);
        
        $fileIco = SYSTEM_DIR . '/blanks/project.ico';
        if (file_exists($GLOBALS['__iconFile'])){
            
            x_copy($GLOBALS['__iconFile'], dirname($projectFile).'/build.ico');
            $ini->write('main', 'icon', dirname($projectFile).'/build.ico');
        }
        
        $ini->updateFile();
    }
    
    static function loadSettings(){
        
        global $projectFile;
        
        $file = dirname($projectFile).'/build.cfg';
        $ini  = new TIniFileEx($file);
        $path = dirname($projectFile).'/build/'.basenameNoExt($projectFile).'.exe';
        
        c('fmBuildProgram->path')->text = $ini->read('main','path', $path);
        c('fmBuildProgram->c_attachphp')->checked = $ini->read('main','attachphp', true);
        c('fmBuildProgram->c_attachsoulengine')->checked = $ini->read('main','attachsoulengine',true);
        c('fmBuildProgram->c_attachdata')->checked = $ini->read('main','attachdata', true);
        c('fmBuildProgram->c_upx')->itemIndex = $ini->read('main','upx_level', 0);
        c('fmBuildProgram->e_companyname')->text = $ini->read('main','company', '');
        c('fmBuildProgram->e_version')->text = $ini->read('main','version', '1.0.0.0');
        c('fmBuildProgram->use_bcompiler')->checked = $ini->read('main','use_bcompiler', true);
        
        $iconFile = $ini->read('main', 'icon', '');
        if ($iconFile){
            c('fmBuildProgram->im_icon')->picture->loadFromFile($iconFile);
            myVars::set($iconFile, '__iconFile');    
        }
    }
    
    static function BuildProgram(){
        
        c('fmBuildProgram->btn_path')->onClick = 'myOptions::saveExeDialog';
        c('fmBuildProgram->btn_icon')->onClick = 'myOptions::openIconDialog';
        c('fmBuildProgram->btn_savesettings')->onClick = function(){
            myOptions::saveSettings();
            message_beep(66);
        };
        
        /****** event *****/
        if (!CApi::doEvent('onBuildDialog',array())) return;
        /****** ---- *****/
        
        self::loadSettings();
        
        if (c('fmBuildProgram',1)->showModal() == mrOk){
            
            /*if (!is_writable(replaceSl(c('fmBuildProgram->path')->text))){
            
                msg(t('Please, select correct path for your program!'));
                self::BuildProgram();
                return;
            }*/
            
            self::saveSettings();
            
            /****** event *****/
            if (!CApi::doEvent('onBuild',array())) return;
            /****** ---- *****/
            
            //err_no();
            myCompile::adv_start(
                                 c('fmBuildProgram->path',1)->text,
                                 c('fmBuildProgram->c_attachphp',1)->checked,
                                 c('fmBuildProgram->c_attachsoulengine',1)->checked,
                                 c('fmBuildProgram->c_attachdata',1)->checked,
                                 c('fmBuildProgram->c_upx',1)->itemIndex,
                                 c('fmBuildProgram->e_companyname',1)->text,
                                 c('fmBuildProgram->e_version',1)->text,
                                 c('fmBuildProgram->e_filedescription',1)->text,
                                 myVars::get('__iconFile'),
				    c('fmBuildProgram->use_bcompiler',1)->checked
                                );
            
            if (false && err_msg()){
            
                msg(t('Please, select correct path for your program!'));
                self::BuildProgram();
                return;
            }
            
            /****** event *****/
            if (!CApi::doEvent('onBuildAfter',array())) return;
            /****** ---- *****/
            
            //err_yes();
            
            message_beep(66);
            c('fmBuildCompleted->e_filename',1)->text = c('fmBuildProgram->path',1)->text;
            c('fmBuildCompleted',1)->showModal();
            
            //msg(t('Your Program "%s" is build complate!',basename(c('fmBuildProgram->path',1)->text)));
        }
    }
    
    
    
    static function Options(){
        
        global $_sc;
        c('fmOptions->c_showgrid')->checked = (bool)myOptions::get('sc','showGrid',false);
        c('fmOptions->e_gridsize')->text    = myOptions::get('sc','gridSize',8);
        c('fmOptions->backup_active')->checked = (bool)myOptions::get('backup','active',true);
		c('fmOptions->backup_dir')->text = myOptions::get('backup','dir','backup');
		c('fmOptions->backup_count')->text = (int)myOptions::get('backup','count',3);
		c('fmOptions->backup_interval')->text = (int)myOptions::get('backup','interval',2);
		
            /****** event *****/
            if (!CApi::doEvent('onOptionsDialog',array())) return;
            /****** ---- *****/
        
        if (c('fmOptions')->showModal() == mrOk){
            
            /****** event *****/
            if (!CApi::doEvent('onOptions',array())) return;
            /****** ---- *****/
            
            myOptions::set('sc','showGrid', c('fmOptions->c_showgrid')->checked);
			myOptions::set('backup','active', c('fmOptions->backup_active')->checked);
			
			$dir = c('fmOptions->backup_dir')->text;
			if ( !eregi('$([.\-\_a-z�-��-�0-9]+)') )
				$dir = 'backup';
				
			myOptions::set('backup','dir', $dir);
			myOptions::set('backup','interval', (int)c('fmOptions->backup_interval')->text);
			myOptions::set('backup','count', (int)c('fmOptions->backup_count')->text);
			
			myBackup::updateSettings();
			
            $_sc->showGrid = (bool)myOptions::get('sc','showGrid',true);
            
            if ((int)c('fmOptions->e_gridsize')->text > 0){
                myOptions::set('sc','gridSize', (int)c('fmOptions->e_gridsize')->text);
                $_sc->gridSize = myOptions::get('sc','gridSize',8);
            }
            
            c('fmEdit')->repaint();
            
            /****** event *****/
            if (!CApi::doEvent('onOptionsAfter',array())) return;
            /****** ---- *****/
        }
    }
}

class myBackup {
	
	static $timer;
	static $dir;
	static $count;
	
	function doInterval(){
		
		global $projectFile;
		if ( !eregi('$([.\-\_a-z�-��-�0-9]+)') )
			self::$dir = 'backup';
		
		$dir = dirname($projectFile) .'/'. self::$dir . '/';
		
		if ( !is_dir($dir) )
			mkdir($dir,0777,true);
			
		$file = basenameNoExt($projectFile) . date('(h.i d.m.Y)');
		/*$from = 0;
		while ( is_file( $dir . $file . $from . '.dvs' ) ) $from++;   */
		
		$src = $dir . $file . $from . '.dvs';
		myCompile::setStatus('Backup', t('�������� ��������� ����� - ').'"'.self::$dir.'/'. $file . $from . '.dvs"');
		myProject::saveAsDVS($src);
		
		$check = $dir . $file .($from - self::$count - 1) . '.dvs';
		
		if ( is_file( $check ) ){
		    unlink( $check );
		}
	}
	
	static function setInterval($min){
		
		if ( $min < 1 )
			$min = 1;
		
		self::$timer->interval = $min * 60000;
	}
	
	static function setActive($active){
		self::$timer->enable = (bool)$active;
	}
	
	static function updateSettings(){
		
		self::setActive( myOptions::get('backup','active',true) );
		self::setInterval( myOptions::get('backup','interval',2) );
		self::$dir = myOptions::get('backup','dir','backup');
		self::$count = myOptions::get('backup','count',3);
		if ( myOptions::get('backup','active',true) )
			self::doInterval();
	}
	
	static function init(){
		self::$timer = Timer::setInterval('myBackup::doInterval', 60000 * 2);
                
	}
}

myBackup::init();