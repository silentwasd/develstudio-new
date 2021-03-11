<?

complete_Funcs::initF();

class complete_Funcs {
    
    static $sourceDirs;
    static $sourceFiles;
    
    function initF(){
        
        $engineDir = replaceSl( realpath(dirname(EXE_FILE)).'/core/' );
        self::$sourceFiles[] = $engineDir . '/main/utils.php';
        self::$sourceFiles[] = $engineDir . '/main/messages.php';
        self::$sourceFiles[] = $engineDir . '/main/osapi.php';
        self::$sourceFiles[] = $engineDir . '/main/threading.php';
        self::$sourceFiles[] = $engineDir . '/main/mci.php';
        self::$sourceFiles[] = $engineDir . '/main/synedit.php';
        self::$sourceFiles[] = $engineDir . '/main/registry.php';
        self::$sourceFiles[] = $engineDir . '/main/localization.php';
        self::$sourceFiles[] = $engineDir . '/main/dfmreader.php';
        self::$sourceFiles[] = $engineDir . '/main/keyboard.php';
        self::$sourceFiles[] = $engineDir . '/main/imagelist.php';
        self::$sourceFiles[] = $engineDir . '/files/file.php';
        self::$sourceFiles[] = $engineDir . '/files/ini.php';
        self::$sourceFiles[] = $engineDir . '/files/ini_ex.php';
        
        self::$sourceFiles[] = $engineDir . '/design/buttonspanel.php';
        self::$sourceFiles[] = $engineDir . '/design/componentpanel.php';
        self::$sourceFiles[] = $engineDir . '/design/propcomponents.php';
        self::$sourceFiles[] = $engineDir . '/design/sizecontrol.php';
        
        self::$sourceFiles[] = $engineDir . '/debug/errors.php';
        self::$sourceFiles[] = $engineDir . '/game/OMEGA.php';
    }
    
    function getInline($params, $defaults = false){
        
        $inline = '';
        
        if (count($params)==0) return 'void';
        
        foreach($params as $x=>$param){
            
            if ($defaults[$x])
                $params[$x] = $param .' = '.$defaults[$x];   
        }
        
        if (count($params)!=0){
                        
            $inline .= implode(', ', $params);
        } else {
            $inline .= 'void';
        }
        
        return $inline;
    }
    
    
    function getScriptsFunctions($sort = false){
        
        global $projectFile;
        $funcs = array();
        
        $files = findFiles(dirname($projectFile).'/scripts/','php',false,true);
        $files = array_merge($files, self::$sourceFiles, findFiles(DOC_ROOT.'/modules/',array('php','inc'),false,true));
        
        foreach($files as $file){
            
            $info = PHPSyntax::analizFile( $file, dirname($projectFile) );
            
            foreach($info['functions'] as $func){
                
                $inline = 'mixed '.$func['name'] .' ( '. self::getInline($func['params'],$func['defaults']) .' )';
                $funcs[$func['name']] = array('NAME'=>$func['name'],
                                              'INLINE'=>$inline,
                                              'DESC'=>$func['desc']);
            }
            
            foreach($info['classes'] as $class){
                
                $inline = 'class '.$class['name'].' ';
                if ($class['construct']){
                    $inline .= '( ' . self::getInline($class['construct']['params'],$class['construct']['defaults']) . ' )';
                }
                
                $funcs[$class['name']] = array('NAME'=>$class['name'], 'INLINE'=>$inline, 'info'=>$class);
            }
        }
        
        return $funcs;
    }
    
    function getFormFunctions($sort = false){
        
        global $dynamicFuncs;
        
        if ($dynamicFuncs) return $dynamicFuncs;
        
        $funcs = array();
        $forms = myProject::getFormsObjects();
        foreach($forms as $form)
            foreach($form as $obj)
                if ($obj['CLASS']=='TFunction'){
                    
                    $params = explode(_BR_, $obj['parameters']);
                    $inline = 'mixed '.$obj['NAME'].' ( ';
                    
                    if (count($params)!=0){
                        
                        $inline .= implode(', ', $params);
                    } else {
                        $inline .= 'void';
                    }
                    
                    $inline .= ' )';
                    
                    $funcs[$obj['NAME']] = array('NAME'=>$obj['NAME'],
                                                'INLINE'=>$inline,
                                                'DESC'=>$obj['description']);
                }
        
        if ($sort)
            BlockData::sortList($funcs, 'NAME');
            
        $funcs = array_merge($funcs, self::getScriptsFunctions());    
        
        $dynamicFuncs = $funcs;
        
        return $funcs;
    }
    
    function getFunctions($sort = false){
        
        global $addFuncs;
        
        $funcs = unserialize(file_get_contents(dirname(__FILE__).'/func_infos.db'));
        $files = findFiles(dirname(__FILE__).'/funcs/','php');
        foreach ($files as $file){
            
            $info = include dirname(__FILE__).'/funcs/'.$file;
            $info['NAME'] = basenameNoExt($file);
            $funcs[basenameNoExt($file)] = $info;
        }
        
        if ($sort)
            BlockData::sortList($funcs, 'NAME');
        
        return $funcs;
    }
    
    function init(){
        
        global $funcsArr;
        
        $arr['item']   = array();
        $arr['insert'] = array();
        
        $funcs = unserialize(file_get_contents(dirname(__FILE__).'/func_infos.db'));
        
        $files = findFiles(dirname(__FILE__).'/funcs/','php');
        foreach ($files as $file){
            
            $info = include dirname(__FILE__).'/funcs/'.$file;
            $info['NAME'] = basenameNoExt($file);
            $funcs[basenameNoExt($file)] = $info;
        }
        
        if (file_exists(DOC_ROOT . '/design/complete/classes.php')){
            $classes = include DOC_ROOT . '/design/complete/classes.php';
            
            foreach ($classes as $class)
                $funcs[] = array('NAME'=>$class, 'INLINE'=>'class '.$class.' ');
        }
        
        BlockData::sortList($funcs, 'NAME');
        
        global $_c;
        foreach ($_c->defines as $const=>$value){
            $funcs[] = array('NAME'=>$const,'INLINE'=>'constant '.$const.' ');
        }
        
        $funcsArr = self::generateBB( $funcs );
    }
    
    function generateBB($funcs){
        
        $arr = array('insert'=>array(),'item'=>array());
        foreach ($funcs as $i=>$info){
            
            $func = $info['NAME'];
            
            $arr['insert'][] = $func;
            
            if ($info['INLINE'])
                $text = $info['INLINE'];
            else
                $text = $func;
            
            //$text.= '[$b]';
            $text = str_replace(array($func.' ','nubmer ','float ','mixed ','string ','array ','bool ','void ','int ','resource ','object ',
                                      'constant ','class '),
                                array('[b]'.$func.'[/b] ','[$r]number[$b] ','[$r]float[$b] ','[$r]mixed[$b] ','[$r]string[$b] ','[$r]array [$b]',
                                      '[$r]bool[$b] ','[$r]void[$b] ','[$r]int[$b] ','[$r]resource[$b] ','[$r]object[$b] ','[$s]constant[$b] ',
                                      '[$g]class[$b] '),
                                      $text); 
            //$arr['item'][] = $text;
            $arr['item'][] = myComplete::fromBB($text);
            //pre($text);
        }
        
        return $arr;
    }
    
    
    function dynamicFuncs($funcsArr){
        
        $funcs = complete_Funcs::getFormFunctions(true);
        
        $funcs = self::generateBB($funcs);
        $funcsArr['insert'] = array_merge($funcs['insert'], $funcsArr['insert']);
        $funcsArr['item']   = array_merge($funcs['item'],   $funcsArr['item']);
        
        return $funcsArr;
    }
    
    // ���������� ������ ��� �������
    function getList($lineText){
        
        global $_FORMS, $formSelected, $funcsArr;
        
        if ($funcsArr){
            
            return self::dynamicFuncs( $funcsArr );
        }
        
        $arr['item']   = array();
        $arr['insert'] = array();
        
        $funcs = unserialize(file_get_contents(dirname(__FILE__).'/func_infos.db'));
        
        $files = findFiles(dirname(__FILE__).'/funcs/','php');
        foreach ($files as $file){
            
            $info = include dirname(__FILE__).'/funcs/'.$file;
            $info['NAME'] = basenameNoExt($file);
            $funcs[basenameNoExt($file)] = $info;
        }
        
        if (file_exists(DOC_ROOT . '/design/complete/classes.php')){
            $classes = include DOC_ROOT . '/design/complete/classes.php';
            
            foreach ($classes as $class)
                $funcs[] = array('NAME'=>$class, 'INLINE'=>'class '.$class.' ');
        }
        
        BlockData::sortList($funcs, 'NAME');
        
        global $_c;
        foreach ($_c->defines as $const=>$value){
            $funcs[] = array('NAME'=>$const,'INLINE'=>'constant '.$const.' ');
        }
        
        foreach ($funcs as $i=>$info){
            
            $func = $info['NAME'];
            
            $arr['insert'][] = $func;
            
            if ($info['INLINE'])
                $text = $info['INLINE'];
            else
                $text = $func;
            
            //$text.= '[$b]';
            $text = str_replace($func.' ', '[b]'.$func.'[/b] ', $text);
            $text = str_replace('nubmer ', '[$r]number[$b] ',$text);
            $text = str_replace('float ', '[$r]float[$b] ', $text);
            $text = str_replace('mixed ', '[$r]mixed[$b] ', $text);
            $text = str_replace('string ', '[$r]string[$b] ', $text);
            $text = str_replace('array ', '[$r]array [$b]', $text);
            $text = str_replace('bool ', '[$r]bool[$b] ', $text);
            $text = str_replace('void ', '[$r]void[$b] ', $text);
            $text = str_replace('int ', '[$r]int[$b] ', $text);
            $text = str_replace('resource ', '[$r]resource[$b] ', $text);
            $text = str_replace('object ', '[$r]object[$b] ', $text);
            $text = str_replace('constant ', '[$s]constant[$b] ', $text);
            $text = str_replace('class ', '[$g]class[$b] ', $text);
            
            //$arr['item'][] = $text;
            $arr['item'][] = myComplete::fromBB($text);
            //pre($text);
        }
        
        $funcsArr = $arr;
        return $arr;
    }
}