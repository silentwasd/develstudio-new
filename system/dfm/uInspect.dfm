object fmInspect: TfmInspect
  Left = 0
  Top = 0
  Caption = '{Inspect value}'
  ClientHeight = 329
  ClientWidth = 469
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 469
    Height = 33
    Align = alTop
    TabOrder = 0
    DesignSize = (
      469
      33)
    object Label1: TLabel
      Left = 8
      Top = 8
      Width = 35
      Height = 16
      Caption = 'Name'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -13
      Font.Name = 'Tahoma'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object CheckBox1: TCheckBox
      Left = 391
      Top = 9
      Width = 73
      Height = 17
      Anchors = [akTop, akRight]
      Caption = '{Refresh}'
      TabOrder = 0
    end
  end
end
