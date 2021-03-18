<?
/*
    SoulEngine ConfigIni library
    
    2009.04 v0.1
    
    Dim-S Software (c) 2009
*/

function iniConfiger(TConfig $cfg = null){
    $result = new TConfigIni;
    if ($cfg != null){
        $result->setArray($cfg->toArray());
    }
    
    return $result;
}