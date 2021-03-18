<?
/*
  
  SoulEngine Run-Time Design Library
  
  2009.04 ver 0.2
  
  Dim-S Software (c) 2009
  
  ��������:
    ���������� ��� �������� ����������� ���������.
    
  TSizeCtrl - �������� ����� ��� ������ � ����������.
  �� ������� �������� ������� � ������� ����������� �� �����.
  
  ����������� ��������:
    MoveOnly: True/False - ������ ��� �����������
    BtnColor: ���� - ����� ��������������
    BtnColorDisabled: ���� - ����� ��������������, ������� ���������
    GridSize: 1..100 - ������ ����� ��� ���������� � ��������� ��������
    MultiTargetResize: True/False - ��������� ��������� �������� ����� ���������� �����������
    
  �������:
    OnDuringSizeMove (self, dx, dy, state: TSCState);
    OnStartSizeMove  (self, state: TSCState);
    OnEndSizeMove    (self, state: TSCState);
    OnSizeMouseDown (self, target, x, y)
*/


global $_c;

// TSCState = (scsReady, scsMoving, scsSizing);
$_c->setConstList('scsReady', 'scsMoving', 'scsSizing', 0);
