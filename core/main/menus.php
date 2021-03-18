<?
/*
  
  SoulEngine Menu Library
  
  2009 ver 1.0
  
  Dim-S Software (c) 2009
  
*/

function menuDinamicSetText($menu, $text){
	
	$arr = explode($text);
	
	foreach ($arr as $el){
		
		$item = explode('|', $el);
		$caption = $item[0];
		$x = new TMenuItem($menu);
		$x->caption = $caption;
		if ($item[1]){
			$x->loadPicture($item[1]);
		}
		if ($item[2]){
			$x->onClick = $item[2];
		}
		$menu->addItem($x);
	}
}

function menuItem($caption, $styled = false, $name = '', $onClick = '', $sc = false, $img = false){
	
	$result = new TMenuItem;
	if ($name)
		$result->name = $name;
	
	if ($onClick)
		$result->onClick = $onClick;
	
	$result->caption = $caption;
	if ($sc)
		$result->shortCut = $sc;
	if ($img){
		
		if (file_exists( replaceSl($img) ))
			$result->picture->loadFromFile( replaceSr($img) );
		else
			if (file_exists( replaceSl(DOC_ROOT.'/'.$img) ))	
			$result->picture->loadFromFile( replaceSr(DOC_ROOT.'/'.$img) );
	}
		
	if ($styled)
		styleMenu::addItem($result);
		
	return $result;
}