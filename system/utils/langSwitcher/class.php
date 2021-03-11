<?


function langSwitcher($lang){
    myOptions::set('main','lang',$lang);
}

$langs = findFiles(DOC_ROOT.'/lang/','lng',false,true);
//pre($langs);

    foreach ($langs as $lang){
        
        $info = parse_ini_file($lang);
        $info['lang'] = basenameNoExt($lang);
        $infos[basenameNoExt($lang)] = $info;
    }
    
    BlockData::sortList($infos, 'sort');
    
    foreach ($infos as $id=>$info){
        
        $item = menuItem($info['title'], true, false,
                         function() use ($info){
                            langSwitcher($info['lang']);
                         },
                     false, DOC_ROOT.'/lang/'.$info['lang'].'/icon.png');

        c('fmMain->MainMenu',1)->addItem($item, c('fmMain->itLanguage',1));
    }
    
// ��������� ����� ����
/*c('fmMain->itProject')->insertAfter( c('fmMain->it_buildproject'),
            menuItem(t('Scripts of project'), true, 'itScriptsMaster','master_scriptsMaster::open',
                     false, dirname(__FILE__).'/icon.bmp')
            );*/