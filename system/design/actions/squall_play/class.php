<?


class action_squall_play extends action_Simple {
    
    
    function getLineParams($line, $action){
        
        $k = strrpos($line,'->');
        
        $pr1 = substr($line, 0, $k);
        
        return array($pr1);
    }
    
    function getResult($command, $result, $action){
        
        return trim($result[0]) . '->play();';
    }
}