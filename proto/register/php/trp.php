<?php
do{
    $flg = false;
    //FTPサーバとアカウント情報
    $cfg['server'] = "sv14359.xserver.jp"; //送り先のFTPサーバー名もしくはIP
    $cfg['user'] = "stoliter"; //送り先のFTPユーザ
    $cfg['pass'] = "../.key/stoliterfl.key"; //送り先のFTPパスワード
    $cfg['remoteDir'] = 'stolitor.xsrv.jp/public_html/php/imgfiles/'; //送り先のディレクトリ
    $cfg['localDir'] = './tmp/'; //ローカル側の一時アップロードディレクトリ
    $local_filename = $cfg['localDir'] . $_FILES['imgname']['name']; //アップロードするファイル
    $remotes_filename = $cfg['remoteDir'].$_FILES['imgname']['name']; //アップロード時の名前
    echo 0;
    function uploadSFTP($local_filename, $remote_filename)
    {   
        global $cfg;
        echo 1;
        //FTPサーバに接続
        $conn = ssh2_connect($cfg['server'],10022);
        echo 2;
        if( !ssh2_sutj_pubkey_file($conn,$cfg['user'],$cfg['pass'])){
            echo"login failed";
            return;
        }
        echo 3;
        //ログイン
        $sftp = ssh2_sftp($conn);
        echo 4;
        //ローカル側に一度アップロード
        if( !move_uploaded_file($_FILES['file']["tmp_name"], $cfg['localDir'] . $_FILES['file']['name']) ) ;
        echo 5;
        //アップロード
        $file_data=file_get_contents($local);
        if(file_put_contents('ssh.sftp://'.$sftp.$remote,$file_data));
        echo 6;
        //ローカル側のファイルを削除
        unlink( $cfg['localDir'] . $_FILES['file']['name'] );
        echo 7;
        //接続を閉じる
        ssh2_disconnect($conn);
        echo 8;
        $flg = true;
    }
    echo 9;
}while(0);
if( $flg ){
    //アップロード成功時の処理
}else{
    //アップロード失敗時の処理
}
?>