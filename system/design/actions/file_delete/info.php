<?

/*
    SoulEngine actions

    Dim-S Software (c) 2009
*/

$n = array();
        
  $n['PREG'] = '%file_delete\((.*)\)[\;]?%i';   
 
  $n['COMMAND'] = 'file_delete';  
  
  $n['TEXT'] = 'Delete file'; 
   
  $n['DESCRIPTION'] = 'To delete a file'; 
   
  $n['INLINE'] = 'To delete %pr1% file'; 
   
  $n['SECTION'] = 'files';

  $n['SORT'] = 5030;
       
return $n;
