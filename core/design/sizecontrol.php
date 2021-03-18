<?
/*
  
  SoulEngine Run-Time Design Library
  
  2009.04 ver 0.2
  
  Dim-S Software (c) 2009
  
  Описание:
    Библиотека для создания визуального редактора.
    
  TSizeCtrl - основной класс для работы с редактором.
  Он поможет изменять размеры и позиции компонентов на форме.
  
  Неописанные свойства:
    MoveOnly: True/False - только для перемещения
    BtnColor: цвет - точек редактирования
    BtnColorDisabled: цвет - точек редактирования, которые неактивны
    GridSize: 1..100 - размер сетки для пермещения и изменения размеров
    MultiTargetResize: True/False - разрешить изменение размеров сразу нескольких компонентов
    
  События:
    OnDuringSizeMove (self, dx, dy, state: TSCState);
    OnStartSizeMove  (self, state: TSCState);
    OnEndSizeMove    (self, state: TSCState);
    OnSizeMouseDown (self, target, x, y)
*/


global $_c;

// TSCState = (scsReady, scsMoving, scsSizing);
$_c->setConstList('scsReady', 'scsMoving', 'scsSizing', 0);
