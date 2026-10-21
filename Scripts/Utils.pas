{..............................................................................}
{ Utils.pas                                                                    }
{ Helper functions untuk scripting Altium - PixelForge                         }
{..............................................................................}

{ Mengembalikan workspace aktif }
Function GetActiveWorkspace : IWorkspace;
Begin
    Result := GetWorkspace;
End;

{ Validasi apakah ada project yang sedang aktif }
Function ValidateProjectActive : Boolean;
Var
    WS : IWorkspace;
Begin
    Result := False;
    WS := GetWorkspace;
    If WS = Nil Then Exit;
    If WS.DM_FocusedProject = Nil Then Exit;
    Result := True;
End;

{ Mendapatkan PCB Board yang sedang aktif, nil jika tidak ada }
Function GetActivePCBBoard : IPCB_Board;
Begin
    Result := Nil;
    If PCBServer = Nil Then Exit;
    Result := PCBServer.GetCurrentPCBBoard;
End;

{ Mendapatkan Schematic Document yang sedang aktif, nil jika tidak ada }
Function GetActiveSchDocument : ISch_Document;
Begin
    Result := Nil;
    If SCHServer = Nil Then Exit;
    Result := SCHServer.GetCurrentSchDocument;
End;

{ Logging sederhana ke panel output / message box }
Procedure LogToOutput(Const Msg : String);
Begin
    ShowMessage('[PixelForge] ' + Msg);
End;
