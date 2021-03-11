<?

class Loader {


    static function file($file, $add_thread = true){

        $ext = fileExt($file);
            if (!$ext){
                
                if ( file_exists(SYSTEM_DIR . $file.'.phz') )
                    $ext = 'phz';
                elseif ( file_exists(SYSTEM_DIR . $file.'.phb') )
                    $ext = 'phb';
                elseif ( file_exists(SYSTEM_DIR . $file.'.phpe') )
                    $ext = 'phpe';
                elseif ( file_exists(SYSTEM_DIR . $file.'.php') )
                    $ext = 'php';
                        
                $file .= '.'.$ext;
            }
            
        if ($ext){
            
            if (class_exists('Thread') && $add_thread){
                
                if ( $file!='modules/animation.php' )
                Thread::addFile(SYSTEM_DIR . $file);
            }            
            
            if ($ext=='phz' || $ext=='phb')
                bcompiler_load(SYSTEM_DIR . $file);
            elseif ($ext=='phpe')
                include_ex(SYSTEM_DIR . $file);
            else
                include SYSTEM_DIR . $file;
                
            return true;
        }
        
        return false;
    }

    static function events(TForm &$form, $file = false){
           if ($file)
                self::file('forms/'.$file);
           loadFormEvents($form);
    }

    static function lib($file){
            return self::file('libs/'.$file);
    }
    
    static function inc($file){
        
        if ( fileExt($file)=='phpe2')
            include_ex2($file);
        elseif ( fileExt($file)=='phpe' )
            include_ex($file);
        elseif ( fileExt($file)=='phb')
            bcompiler_load($file);
        else
            include $file;
    }
    
    static function model($file){
        
        if (file_exists(SYSTEM_DIR . 'models/'.$file.'.phpe'))
            include_ex(SYSTEM_DIR . 'models/'.$file.'.phpe');
        elseif (file_exists(SYSTEM_DIR . 'models/'.$file.'.phz')){
            bcompiler_load(SYSTEM_DIR .'/models/'.$file.'.phz');
        }
        elseif (file_exists(SYSTEM_DIR . 'models/'.$file.'.phb')){
            bcompiler_load(SYSTEM_DIR .'/models/'.$file.'.phb');
        }
        else {
            self::file('models/'.$file, false);
        }
        
        $class = 'my'.$file;
        if (class_exists($class))
            if (method_exists($class, 'afterLoad')){
                
                $tmp = new $class;
                $tmp->afterLoad();
                unset($tmp);
            }
    }
    
    static function module($file){
            self::file('modules/'.$file);
    }
    
    static function modules($dir){
        
        $files = findFiles(SYSTEM_DIR . $dir, 'php');
        foreach ($files as $file)
            self::file('modules/'. basenameNoExt($file));
    }

    static function helper($helper){

            if (self::file('helpers/'.$helper.'.php')){
                $helper[0] = strtoupper($helper[0]);
                $class = 'Helper' . $helper;
                return new $class;
            } else {
                return false;
            }
    }

}