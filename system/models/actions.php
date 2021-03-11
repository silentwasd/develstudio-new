<?


class myActions {
    
    // ��������� ��������� ����� ��� ��������� ��������...
    static function init(){
        
        $dir = SYSTEM_DIR . '/design/actions/';
        $actions = findDirs($dir);
        
        /*$actionPanel = new TButtonsPanel(c('fmPHPEditor',1));
        $actionPanel->parent = c('fmPHPEditor->panelActions');
        $actionPanel->align  = alClient;*/
        $actionPanel = c('fmPHPEditor->list');
        $IMAGES = c('fmMSBCreator->imageList');
        
        //c('fmMSBCreator')->free();
        if ( c('fmMSBCreator') ){
            
            /*$actionPanel2 = new TButtonsPanel(c('fmMSBCreator',1));
            $actionPanel2->parent = c('fmMSBCreator->panelActions');
            $actionPanel2->align  = alClient;
            $actionPanel2->rows   = 4;
            myVars::set($actionPanel2, 'actionPanel2');*/
        }
        
        myVars::set($actionPanel, 'actionPanel');
        
        $result = array();
        $groups = array();
        
        $id_icon = 0;
        foreach ($actions as $id=>$action){
            
            
            /// ���� �����
            Localization::inc($dir . $action . '/lang');
            
            if (!file_exists($dir . $action . '/info.php')){
				if ( $action != '.svn' )
                msg(t('Inccorect "%s" action, file "info.php" not found!', $action));
                continue;
            }
            
            if (!eregi('([a-z0-9\_]+)',$action)){
                msg(t('Inccorect code "%s" for action!', $action));
                continue;
            }
            
            // ���������� ����� �������� ���� ����...
            if (file_exists($dir . $action . '/class.php'))
                require $dir . $action . '/class.php';
            
            $item = array();
            $item['CODE'] = $action;
            $item['ID']   = $id;
            
            $arr = include ($dir . $action . '/info.php');
            
            ////// ��������� ������.... *////
            if (file_exists($dir . $action . '/icon.bmp'))
                $item['ICON'] = $dir . $action . '/icon.bmp';
            else if (file_exists($dir . $action . '/icon.png'))
                $item['ICON'] = $dir . $action . '/icon.png';
            else if ($arr['ICON'])
                $item['ICON'] = myImages::get24($arr['ICON']);
                
            if (!$item['ICON'])
                $item['ICON'] = myImages::get24($action);
            
            
            $IMAGES->addFromFile($item['ICON']);
            
            $item['ICON_ID'] = $id_icon;
            $id_icon++;
            
            
            // ��������� �����...
            $item['TEXT'] = t('action_'.$action);
            $item['DESCRIPTION'] = $arr['TEXT'];
            $item['HINT'] = $arr['TEXT'];
            
            if ($arr['TEXT'])
                $item['TEXT'] = t($arr['TEXT']);
                
                
            if ($arr['DESCRIPTION'])
                $item['DESCRIPTION'] = t($arr['DESCRIPTION']);
                
            if ($arr['INLINE'])
                $item['INLINE'] = t($arr['INLINE']);
                    
            if ($arr['HINT'])
                $item['HINT'] = t($arr['HINT']);
            ////////////////////////////////////////////////////////////////////
            
            // �������� ������� ��� ��������
            if ($arr['EREG'])
                $item['EREG'] = $arr['EREG'];
            if ($arr['PREG'])
                $item['PREG'] = $arr['PREG'];
            
            if (!$arr['EREG'] && !$arr['PREG']) continue;    
            
            
            $item['COMMAND'] = $arr['COMMAND'];
            $item['SECTION'] = $arr['SECTION'];
            $item['NO_BRACKETS'] = $arr['NO_BRACKETS'];
            $item['NO_TSZ']  = $arr['NO_TSZ'];
            
            // ���������� ��� ����������� �� ������... 
            $item['SORT']    = $arr['SORT'] ? $arr['SORT'] : 9999999;
            $item['NO_SHOW'] = $arr['NO_SHOW'];
            
            /* ����� ������ ��������� �������� �����, ������� ������� ������� �� �������������,
              � �� ����� ���...
            $params = array();
            // ������� ����� ������, � ������ ������� ������� �����...
            $item['DIALOG'] = self::createDialog($action, $item, $params);
            // ���������� ������� ����� ����..
            $item['PARAMS_OBJS'] = $params;
                                         */
            
            $result[$action]  = $item;
        }
        
        // ��������� ���� ������ �� ���� ����
        BlockData::sortList($result, 'SORT');
        
        //$actionPanel->hide();
        
        foreach ($result as $item):
            
            // ���������� �� ������ �������� ��� ���...
            if (!$item['NO_SHOW']){    
                    if (!in_array($item['SECTION'], $groups)){
                        
                        global $actionPanel;
                        $actionPanel->addSection($item['SECTION'],t('gr_'.$item['SECTION']));
                        if ($actionPanel2)
                            $actionPanel2->addSection($item['SECTION'],t('gr_'.$item['SECTION']));
                        
                        $groups[] = $item['SECTION'];
                    }
                    
                    self::addButton($item, $actionPanel);
                    if ( $actionPanel2 )
                        self::addButton($item, $actionPanel2);
            }
            
        endforeach;
        
        $actionPanel->onButtonClicked = 'myActions::addAction';
        
        $actionPanel->selected = $groups[0];
        //$actionPanel->show();
        
        
        // ��������� ���� ������ �� ���� ���� � �������� �������...
        BlockData::sortList($result, 'SORT', 'desc');
        
        myVars::set($result, 'arrayActions');
    }
    
    // ��������� ������ �� ����� ��������...
    static function addButton($item, $actionPanel){
        
        //global $actionPanel, $actionPanel2;
        
        /*$btn = new TSpeedButton(c('fmPHPEditor',1));
        
        if (file_exists($item['ICON']))
            $btn->picture->loadFromFile($item['ICON']);
        
        $btn->showHint = true;
        $btn->hint     = t($item['HINT']);
        $btn->action   = $item['CODE'];
        $btn->onClick  = 'myActions::addAction';        
        
        $actionPanel->addButton($item['SECTION'], $btn);*/
        
        $btn = $actionPanel->addButton($item['SECTION']);
        $btn->hint = t($item['HINT']);
        $btn->imageIndex = $item['ICON_ID'];
        $btn->caption = $item['TEXT'];
        
        global $btnCodes;
        $btnCodes[$btn->self] = $item['CODE'];
    }
    
    static function addAction($self, $btn){
        
        global $btnCodes;
        $code = $btnCodes[$btn];
        
        global $arrayActions;
        
        $action = self::getActionByCODE($code);
        if ($action){

            action_Simple::openDialog($action['DIALOG'], $action, false);
            evfmPHPEditorMEMO::onMouseDown($self);
        }
    }
    
    static function getActionByCODE($code){
        
        global $arrayActions;
        return BlockData::getItem($arrayActions, $code, 'CODE');
    }
    
    static function getActionByCODE_id($code){
        
        global $arrayActions;
        foreach ($arrayActions as $i=>$action){
            if ($action['CODE']==$code)
                return $i;
        }
        
        return -1;
    }
    
    // ������� ������ (������) �� �������, ������������� ������� ��� ������� ����� � ������
    static function getAction($line){
        
        
        global $arrayActions;
        
        $line = trim($line);
        if ($line[strlen($line)-1]==';'){
            $line[strlen($line)-1] = ' ';
            $line = trim($line);
        }
        
        $x_line = PHPSyntax::clearSkobki($line);
        foreach ($arrayActions as $name=>$action){
            
            if ($action['PREG']){
                if (preg_match($action['PREG'], $x_line))
                    return $action;
            }
            
            if ($action['EREG']){
                if (eregi($action['EREG'],$x_line))
                    return $action;
            }
        }
        
        return false;
    }
    
    // params - ������ �������� ����������
    static function createDialog($code, $action, &$params){
        $dir = SYSTEM_DIR . '/design/actions/'.$code.'/dialog.php';
        
        if ( !file_exists($dir) ) return false;
        
        // ���������� ���������������� ���� ��� �����, �� ���������� ��� ��������� �����
        $data = include $dir;
        
        // ������� �����
        $frm = new TForm;
        $frm->tag = 2012;
        $frm->caption = $action['TEXT'];
        $frm->name = str_replace('.','_', $code) . '_action';
        $frm->borderStyle = bsDialog;
        $frm->position    = poScreenCenter;
        //$frm->formStyle   = fsStayOnTop;
        
        $frm->font->name = 'Tahoma';
        $frm->w = 430;
        $frm->h = 20;
        $h = 30;
        
        // ������� ��������� ��� ������������
        $gb = new TGroupBox($frm);
        $gb->parent = $frm;
        $gb->w      = $frm->w - 16;
        $gb->x      = 5;
        $gb->h      = $frm->h - 10;
        $gb->y      = 5;
        $gb->caption= $action['TEXT'];
       
        // ���������� �� ���������� ����� ���������...
        foreach ($data as $editor){
            
            $class = $editor['TYPE'] . '_editor';
            $tmp   = new $class;
        
            // ������� ��� ���������...
            $h += $tmp->create($gb, $action, $editor, $h);
            
            // ��������� ������ - ��������
            $params[] = $tmp;
            
            $h += 20;   
        }
        
        
        // ������� ������ ��
        $btn = new TBitBtn($frm);
        $btn->parent = $gb;
        $btn->w = 100;
        $btn->h = 25;
        $btn->x = $frm->w - $btn->w - 10 - $gb->x*3;
        
        $btn->modalResult = mrOk;
        $btn->caption = t('ok');
        
        // ������� ������ "������"
        $btn2 = new TBitBtn($frm);
        $btn2->parent = $gb;
        $btn2->w = $btn->w;
        $btn2->h = $btn->h;
        $btn2->x = $frm->w - $btn->w - 15 - $btn2->w - $gb->x*3;
        
        $btn2->modalResult = mrCancel;
        $btn2->caption = t('cancel');
        
        // ��������� ������� ������...
        $h += $btn->h + 60;
        
        //$gb->anchors= 'akLeft, akTop, akRight';
        $frm->h = $h;
        $gb->h  = $h - 43;
        
        // ���������� ��������� �� Y ������ �� � ������
        $btn->y  = $frm->h - $btn->h * 2 - 15 - $gb->y*2;
        $btn2->y = $btn->y;
        
        // ���������� �����
        return $frm;
    }
    
    static function getInline($action, $line = false){
        
        $inline = $action['INLINE'] ? $action['INLINE'] : $action['DESCRIPTION'];
        
        $class = 'action_Simple';
        if (class_exists('action_'.str_replace('.','_', $action['CODE'])))
            $class = 'action_'.str_replace('.','_',$action['CODE']);
        
        if (!$line)
            $line = action_Simple::getLine();
        
        $tmp = new $class;
        $params_str = $tmp->getLineParams($line,$action);
        unset($tmp);
        
        foreach ($params_str as $i=>$el)
            $arr[] = '%pr'.($i+1).'%';
        
        $inline = str_replace($arr, $params_str, $inline);
        
        return $inline;
    }
    
}


// ������������� ����� ��� ������� ���������... ^
myActions::init();



class action_Simple {
    
    function trimLine($result){
        
        $result = trim($result);
        if ($result[strlen($result)-1]==';'){
            $result[strlen($result)-1] = ' ';
            $result = trim($result);
        }
        
        return $result;
    }
    
    function getLine(){
        
        $result = c('fmPHPEditor.memo')->lineText;
        
        return self::trimLine( $result );
    }

    function replaceCommand($command){
        
        /*$command = trim($command);
        if ($command[strlen($command)-1]!=';'){
            $command = $command . ';';
        }*/
        
        $lineY = c('fmPHPEditor.memo',1)->caretY;
        c('fmPHPEditor.memo',1)->replaceLine($command);
        c('fmPHPEditor.memo',1)->caretY = $lineY;
    }
    
    function insertCommand($command){
        
        /*
        $command = trim($command);
        if ($command[strlen($command)-1]!=';'){
            $command = $command . ';';
        }
               */
        
        $lineY = c('fmPHPEditor.memo',1)->caretY;
        c('fmPHPEditor.memo',1)->insertLine($command);
        c('fmPHPEditor.memo',1)->caretY = $lineY+1;
    }
    
    function getLineParams($line, $action = false){
        
        $command = $this->getLineCommand($line, $action);
        
        if ($action['NO_BRACKETS'])
            $str = substr($line, strlen($command)+1, strlen($line)-strlen($command)-1);
        else
            $str = substr($line, strlen($command)+1, strlen($line)-strlen($command)-2);
        
        $is_str = false;
        $dd_q   = array();
        $d_q    = array();
        $skoba  = 0;
        for($i=0;$i<strlen($str);$i++){
            
            if (in_array($str[$i],array('"',"'"))){
                $is_str = !$is_str;
                continue;
            }
            
            if (!$is_str && $str[$i] == '(')
                $skoba++;
            elseif (!$is_str && $str[$i] == ')')
                $skoba--;
            
            if (!$is_str && ($skoba!=0 && $str[$i]==','))
                $dd_q[] = $i;
            elseif ($is_str && $str[$i]==',')
                $dd_q[] = $i;
        }
        
        foreach ($dd_q as $i)
            $str[$i] = chr(15);
        
        //pre($dd_q);    
        $result = explode(',',$str);
        
        foreach ($result as $i=>$el)
            $result[$i] = trim(str_replace(array(chr(15)),array(','), $el));
        
        return $result;
    }
    
    function getLineCommand($line, $action){
        
        $sym = $action['NO_BRACKETS'] ? ' ' : '(';
        for ($i=0;$i<strlen($line);$i++){
            
            if ($line[$i] == $sym){
                $k = $i;
                break;
            }
        }
        
        return substr($line, 0, $k);
    }
    
    function getResult($command, $params_str, $action){
        
        if ($action['NO_BRACKETS'])
            $res  = $command . ' ';
        else
            $res  = $command . '(';
        
        $res .= implode(', ',$params_str);
        
        $tsz = ';';
        if ($action['NO_TSZ'])
            $tsz = '';
        
        if ($action['NO_BRACKETS'])
            $res .= $tsz;
        else
            $res .= ')' . $tsz;
        
        return $res;
    }
    
    function trimQuote($value){
        
        $value = trim($value);
        if ($value[0]=='"' && $value[strlen($value)-1]=='"'){
                
            $value[0] = ' ';
            $value[strlen($value)-1] = ' ';
            $value = trim($value);
        }
        return $value;
    }
    
    function parseParam($value, $el){
        
        if ($el->use_quote){
            
            if ($value[0]=='"' && $value[strlen($value)-1]=='"'){
                
                $value[0] = ' ';
                $value[strlen($value)-1] = ' ';
                $value = trim($value);
                $el->to_quote = true;
            } else {
                $el->to_quote = false;
            }
        }
        
        return $value;
    }
    
    function parseParamGet($value, $el){
        
        if ($el->use_quote && $el->to_quote){
            
            $x = trim($value);
            if (
                eregi('^c\(', $x)             ||
                eregi('^\$([a-z0-9\_]+)', $x) ||
                eregi('^0x([ABCDF0-9]+)', $x) ||
                strtolower($value) == 'true'  ||
                strtolower($value) == 'false'
            ) {
                  
            } else
                $value = '"' . $value . '"';
        } elseif ($el->use_quote) {
            
            if ( !eregi('^([a-z0-9\_]*)$', trim($value)) ){
                if ($value[0]!='"')
                    $value = '"' . $value . '"';
            }
        }
        
        return $value;
    }
    
    function openDialog($form, $action, $edit = true){
        
        if (!$form){
            global $arrayActions;
            
            $id = myActions::getActionByCODE_id($action['CODE']);
            
            $params = array();
            $form   = myActions::createDialog($action['CODE'],$action, $params);
			
            $arrayActions[$id]['DIALOG'] =& $form;
            $arrayActions[$id]['PARAMS_OBJS'] = $params;
            $action['DIALOG'] =& $form;
            $action['PARAMS_OBJS'] = $params;
        }
        
        $class = 'action_'.$action['CODE'];
        if (!class_exists($class))
            $class = 'action_Simple';
            
        $tmp        = new $class;
        
        if ($edit){
            $params_str = $tmp->getLineParams(self::getLine(), $action);
            $command    = $tmp->getLineCommand(self::getLine(), $action);
        } else {
            $command = $action['COMMAND'];
            $params_str = array();    
        }
        
            foreach ($action['PARAMS_OBJS'] as $i=>$el){
                $value = $params_str[$i];
                
                if (method_exists($el, 'openDialog'))
                    $el->openDialog();
                
                if ($edit)
                if (method_exists($tmp,'parseParam')){
                    $value = $tmp->parseParam($value, $el);
                }
                
                $el->setValue($value);
            }
        
        
        if (!count($action['PARAMS_OBJS']) || $form->showModal() == mrOk){
            
            $result = array();
            foreach ($action['PARAMS_OBJS'] as $i=>$el){
                
                $value = $el->getValue();
                if (method_exists($tmp,'parseParamGet')){
                    
                    if (!$edit && $el->use_quote)
                        $el->to_quote  = true;
                    
                    $value = $tmp->parseParamGet($value, $el);
                }
                
                $result[] = $value;
            }
            
            if ($edit){
                if (count($action['PARAMS_OBJS'])){
                    self::replaceCommand( $tmp->getResult($command, $result, $action) );
                    if ( class_exists('myMSBCreator') ) myMSBCreator::generate(c('fmPHPEditor.memo',1)->text);
                }
            }
            else {
                if ( !self::getLine() )
                    self::replaceCommand( $tmp->getResult($command, $result, $action) );
                else
                    self::insertCommand( $tmp->getResult($command, $result, $action) );
                
                if ( class_exists('myMSBCreator') ) myMSBCreator::generate(c('fmPHPEditor.memo',1)->text);
            }
            
        } else {
            
            $tmp->cancelAction($form, $action);
        }
    }
    
    function checkDialog($form, $action){
        
        
    }
    
    function insertAction($form, $action){
        
        
    }
    
    function cancelAction($form, $action){
        
        
    }
}