{..............................................................................}
{ MainUnit.pas                                                                 }
{ Entry point scripting Altium Designer - PixelForge                           }
{..............................................................................}

Const
    SCRIPT_NAME    = 'PixelForge Altium Script';
    SCRIPT_VERSION = '1.0.0';

{ Menampilkan banner informasi script }
Procedure ShowBanner;
Begin
    ShowMessage(SCRIPT_NAME + ' v' + SCRIPT_VERSION + #13#10 +
                'Jalankan melalui menu: DXP > Run Script...');
End;

{ Menampilkan pesan error standar }
Procedure FailMessage(Const Msg : String);
Begin
    ShowMessage('[ERROR] ' + Msg);
End;

{ Entry point utama yang dipanggil dari DXP > Run Script }
Procedure Run;
Var
    Board  : IPCB_Board;
    SchDoc : ISch_Document;
Begin
    ShowBanner;

    If Not ValidateProjectActive Then
    Begin
        FailMessage('Tidak ada project aktif. Buka project terlebih dahulu.');
        Exit;
    End;

    Board := GetActivePCBBoard;
    If Board <> Nil Then
        LogToOutput('PCB Board aktif: ' + Board.FileName)
    Else
        LogToOutput('Tidak ada PCB Board aktif.');

    SchDoc := GetActiveSchDocument;
    If SchDoc <> Nil Then
        LogToOutput('Schematic aktif: ' + SchDoc.DocumentName)
    Else
        LogToOutput('Tidak ada Schematic aktif.');

    LogToOutput('Script selesai dijalankan.');
End;

{ Alias agar bisa dipanggil dengan nama lain bila diperlukan }
Procedure RunPixelForge;
Begin
    Run;
End;
