<?


class master_scriptsMaster {
    
    static function open(){
        
        $project = evalProject::open(dirname(__FILE__).'/scriptsMaster.dvs');
        $project->showModal();
    }
}

// ��������� ����� ����
c('fmMain->itProject')->insertAfter( c('fmMain->it_buildproject'),
            menuItem(t('Scripts of project'), true, 'itScriptsMaster','master_scriptsMaster::open',
                     false, dirname(__FILE__).'/icon.bmp')
            );