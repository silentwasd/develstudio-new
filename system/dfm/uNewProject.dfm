object fmNewProject: TfmNewProject
  Left = 10
  Top = 10
  HelpType = htKeyword
  HelpKeyword =
    'AAAAAhQCEQVDTEFTUxEFVEZvcm0RBlBBUkFNUxQFEQhhdmlzaWJsZQURAXgGChEB' +
    'eQYKEQF3CAKgEQFoCAG4'
  BorderStyle = bsDialog
  Caption = '{New Project}'
  ClientHeight = 440
  ClientWidth = 672
  Color = clWhite
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -15
  Font.Name = 'Segoe UI'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  Visible = False
  PixelsPerInch = 96
  TextHeight = 20
  object label1: TLabel
    Left = 16
    Top = 16
    Width = 640
    Height = 24
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUBhEIYXZpc2libGUFEQhhZW5h' +
      'YmxlZAURAXcMQFQAAAAAAAARAWgMQDgAAAAAAAARBnBhcmVudBcFVEZvcm0UBhEK' +
      'Y2xhc3NfbmFtZQ4IEQ8AKgBfY29uc3RyYWludHMXEFRTaXplQ29uc3RyYWludHMU' +
      'Aw4JDgsRBHNlbGYKAmg+uBEIACoAcHJvcHMUABEHACoAaWNvbgARCAAqAF9mb250' +
      'FwVURm9udBQDDgwKAmCrcA4NFAARDQAqAGNsYXNzX25hbWURB19PYmplY3QODAoC' +
      'YKtwDg0UAg4DBREKcG9zaXRpb25leBEKcG9EZXNpZ25lZBEEdGV4dBEG0uXq8fIx'
    AutoSize = False
    Caption = '{Path to file project *.msppr}'
  end
  object label2: TLabel
    Left = 16
    Top = 80
    Width = 640
    Height = 24
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUBhEIYXZpc2libGUFEQhhZW5h' +
      'YmxlZAURAXcMQFQAAAAAAAARAWgMQDgAAAAAAAARBnBhcmVudBcFVEZvcm0UBhEK' +
      'Y2xhc3NfbmFtZQ4IEQ8AKgBfY29uc3RyYWludHMXEFRTaXplQ29uc3RyYWludHMU' +
      'Aw4JDgsRBHNlbGYKAmg+uBEIACoAcHJvcHMUABEHACoAaWNvbgARCAAqAF9mb250' +
      'FwVURm9udBQDDgwKAmCrcA4NFAARDQAqAGNsYXNzX25hbWURB19PYmplY3QODAoC' +
      'YKtwDg0UAg4DBREKcG9zaXRpb25leBEKcG9EZXNpZ25lZBEEdGV4dBEG0uXq8fIy'
    AutoSize = False
    Caption = '{Open Last project:}'
  end
  object path: TEdit
    Left = 16
    Top = 40
    Width = 608
    Height = 28
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEFVEVkaXQRBlBBUkFNUxQFEQhhdmlzaWJsZQURCGFlbmFi' +
      'bGVkBREBdwxAWgAAAAAAABEBaAwAAAAAAAAAABEGcGFyZW50FwVURm9ybRQGEQpj' +
      'bGFzc19uYW1lDggRDwAqAF9jb25zdHJhaW50cxcQVFNpemVDb25zdHJhaW50cxQD' +
      'DgkOCxEEc2VsZgoCaD64EQgAKgBwcm9wcxQAEQcAKgBpY29uABEIACoAX2ZvbnQX' +
      'BVRGb250FAMODAoCYKtwDg0UABENACoAY2xhc3NfbmFtZREHX09iamVjdA4MCgJg' +
      'q3AODRQCDgMFEQpwb3NpdGlvbmV4EQpwb0Rlc2lnbmVk'
    TabOrder = 0
    Alignment = taLeftJustify
    ColorOnEnter = clNone
    FontColorOnEnter = clNone
    TabOnEnter = False
    MarginLeft = 0
    MarginRight = 0
  end
  object lastProjects: TListBox
    Left = 16
    Top = 104
    Width = 640
    Height = 200
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEIVExpc3RCb3gRBlBBUkFNUxQHEQhhdmlzaWJsZQURCGFl' +
      'bmFibGVkBREBdwxAYgAAAAAAABEBaAxAYgAAAAAAABEGcGFyZW50FwVURm9ybRQG' +
      'EQpjbGFzc19uYW1lDggRDwAqAF9jb25zdHJhaW50cxcQVFNpemVDb25zdHJhaW50' +
      'cxQDDgkOCxEEc2VsZgoCaD64EQgAKgBwcm9wcxQAEQcAKgBpY29uABEIACoAX2Zv' +
      'bnQXBVRGb250FAMODAoCYKtwDg0UABENACoAY2xhc3NfbmFtZREHX09iamVjdA4M' +
      'CgJgq3AODRQCDgMFEQpwb3NpdGlvbmV4EQpwb0Rlc2lnbmVkEQR0ZXh0DREJaXRl' +
      'bWluZGV4EQItMQ=='
    Style = lbOwnerDrawFixed
    Ctl3D = True
    ItemHeight = 28
    ParentCtl3D = False
    TabOrder = 1
    Alignment = taLeftJustify
    BorderSelected = False
    TwoColor = clNone
    TwoFontColor = clNone
    MarginLeft = 6
    ReadOnly = False
  end
  object btn_dlg: TBitBtn
    Left = 627
    Top = 39
    Width = 30
    Height = 30
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEHVEJpdEJ0bhEGUEFSQU1TFAgRCGF2aXNpYmxlBREIYWVu' +
      'YWJsZWQFEQF3EQIzMBEBaA4GEQZwYXJlbnQXBVRGb3JtFAYRCmNsYXNzX25hbWUO' +
      'CREPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0cmFpbnRzFAMOCg4MEQRzZWxm' +
      'CgJoPrgRCAAqAHByb3BzFAARBwAqAGljb24AEQgAKgBfZm9udBcFVEZvbnQUAw4N' +
      'CgJgq3AODhQAEQ0AKgBjbGFzc19uYW1lEQdfT2JqZWN0Dg0KAmCrcA4OFAIOAwUR' +
      'CnBvc2l0aW9uZXgRCnBvRGVzaWduZWQRBHRleHQRB8rt7u/q4DERAXgRAzYyNxEB' +
      'eRECMzk='
    Caption = '...'
    TabOrder = 2
  end
  object c_alldelete: TCheckBox
    Left = 16
    Top = 320
    Width = 368
    Height = 24
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEJVENoZWNrQm94EQZQQVJBTVMUBhEIYXZpc2libGUFEQhh' +
      'ZW5hYmxlZAURAXcMQGIAAAAAAAARAWgMQDgAAAAAAAARBnBhcmVudBcFVEZvcm0U' +
      'BhEKY2xhc3NfbmFtZQ4IEQ8AKgBfY29uc3RyYWludHMXEFRTaXplQ29uc3RyYWlu' +
      'dHMUAw4JDgsRBHNlbGYKAmg+uBEIACoAcHJvcHMUABEHACoAaWNvbgARCAAqAF9m' +
      'b250FwVURm9udBQDDgwKAmCrcA4NFAARDQAqAGNsYXNzX25hbWURB19PYmplY3QO' +
      'DAoCYKtwDg0UAg4DBREKcG9zaXRpb25leBEKcG9EZXNpZ25lZBEEdGV4dBEqe0Rl' +
      'bGV0ZSBhbGwgZmlsZXMgYW5kIGZvbGRlciBpbiB0aGlzIHBhdGh9'
    Caption = '{Delete all files and folder in this path}'
    TabOrder = 3
  end
  object startup: TCheckBox
    Left = 16
    Top = 344
    Width = 272
    Height = 24
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEJVENoZWNrQm94EQZQQVJBTVMUCBEIYXZpc2libGUFEQhh' +
      'ZW5hYmxlZAURAXcMQGIAAAAAAAARAWgMQDgAAAAAAAARBnBhcmVudBcFVEZvcm0U' +
      'BhEKY2xhc3NfbmFtZQ4IEQ8AKgBfY29uc3RyYWludHMXEFRTaXplQ29uc3RyYWlu' +
      'dHMUAw4JDgsRBHNlbGYKAmg+uBEIACoAcHJvcHMUABEHACoAaWNvbgARCAAqAF9m' +
      'b250FwVURm9udBQDDgwKAmCrcA4NFAARDQAqAGNsYXNzX25hbWURB19PYmplY3QO' +
      'DAoCYKtwDg0UAg4DBREKcG9zaXRpb25leBEKcG9EZXNpZ25lZBEEdGV4dBEde1No' +
      'b3cgb24gc3RhcnR1cCBEZXZlbFN0dWRpb30RAXgGGBEBeQgBQA=='
    Caption = '{Show on startup DevelStudio}'
    TabOrder = 4
  end
  object BitBtn1: TBitBtn
    Left = 16
    Top = 384
    Width = 144
    Height = 40
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEHVEJpdEJ0bhEGUEFSQU1TFAYRCGF2aXNpYmxlBREIYWVu' +
      'YWJsZWQFEQF3DEBiAAAAAAAAEQFoDEBAAAAAAAAAEQZwYXJlbnQXBVRGb3JtFAYR' +
      'CmNsYXNzX25hbWUOCBEPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0cmFpbnRz' +
      'FAMOCQ4LEQRzZWxmCgJoPrgRCAAqAHByb3BzFAARBwAqAGljb24AEQgAKgBfZm9u' +
      'dBcFVEZvbnQUAw4MCgJgq3AODRQAEQ0AKgBjbGFzc19uYW1lEQdfT2JqZWN0DgwK' +
      'AmCrcA4NFAIOAwURCnBvc2l0aW9uZXgRCnBvRGVzaWduZWQRBHRleHQRB8rt7u/q' +
      '4DI='
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 5
  end
  object BitBtn2: TBitBtn
    Left = 176
    Top = 384
    Width = 144
    Height = 40
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEHVEJpdEJ0bhEGUEFSQU1TFAgRCGF2aXNpYmxlBREIYWVu' +
      'YWJsZWQFEQF3DEBiAAAAAAAAEQFoDEBAAAAAAAAAEQZwYXJlbnQXBVRGb3JtFAYR' +
      'CmNsYXNzX25hbWUOCBEPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0cmFpbnRz' +
      'FAMOCQ4LEQRzZWxmCgJoPrgRCAAqAHByb3BzFAARBwAqAGljb24AEQgAKgBfZm9u' +
      'dBcFVEZvbnQUAw4MCgJgq3AODRQAEQ0AKgBjbGFzc19uYW1lEQdfT2JqZWN0DgwK' +
      'AmCrcA4NFAIOAwURCnBvc2l0aW9uZXgRCnBvRGVzaWduZWQRBHRleHQRB8rt7u/q' +
      '4DIRAXgGGBEBeQgBiA=='
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 6
  end
  object btn_demos: TBitBtn
    Left = 512
    Top = 384
    Width = 144
    Height = 40
    Hint = '{Open demos project directory}'
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEHVEJpdEJ0bhEGUEFSQU1TFAgRCGF2aXNpYmxlBREIYWVu' +
      'YWJsZWQFEQF3DEBiAAAAAAAAEQFoDEBAAAAAAAAAEQZwYXJlbnQXBVRGb3JtFAYR' +
      'CmNsYXNzX25hbWUOCBEPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0cmFpbnRz' +
      'FAMOCQ4LEQRzZWxmCgJoPrgRCAAqAHByb3BzFAARBwAqAGljb24AEQgAKgBfZm9u' +
      'dBcFVEZvbnQUAw4MCgJgq3AODRQAEQ0AKgBjbGFzc19uYW1lEQdfT2JqZWN0DgwK' +
      'AmCrcA4NFAIOAwURCnBvc2l0aW9uZXgRCnBvRGVzaWduZWQRBHRleHQRB8rt7u/q' +
      '4DIRAXgGuBEBeQgBiA=='
    Caption = '{Demos projects}'
    ParentShowHint = False
    ShowHint = True
    TabOrder = 7
  end
end
