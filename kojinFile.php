<?php
define('UPLOADPASS', 'kojin/');
$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "member";  // ユーザー名
$db['pass'] = "member9999";  // ユーザー名のパスワード
$db['dbname'] = "web_learn";  // データベース名
$username2=$_COOKIE['username'];
    $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
    
    
    if($_SERVER['REQUEST_METHOD']==='POST'){
    print $_FILES['pdf']['name'].'<br>';
    print $_FILES['pdf']['type'].'<br>';
    print $_FILES['pdf']['size'].'<br>';
    print $_FILES['pdf']['tmp_name'].'<br>';
    print $_FILES['pdf']['error'].'<br>';
    
    $name2=$_FILES['pdf']['name'];
    
    $target=UPLOADPASS.$name2;
    
    if(move_uploaded_file($_FILES['pdf']['tmp_name'], $target)){
        
         //アップロードされたファイルをデータベースに登録
         $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
         $sql2 = "INSERT INTO kojinF(username, filename) VALUES('$username2', '$name2')";
         $stmt2 = $pdo->query($sql2);
         print'OK';
        
    }else{
        print'down';
    }
    
}
      
    try{
    //データベースに接続
     $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    //usernameを取得
     $sql2 = "SELECT filename FROM kojinF WHERE username = '$username2'";
     $stmt2 = $pdo->query($sql2);
    /*
     foreach ($stmt2 as $value){
         echo "$value[filename]<br>";
     }
     */
  
    //filenameの数だけ1行表示とiframeを表示
    foreach ($stmt2 as $value) {
                $htmllink = htmlspecialchars($value[filename]);
                print'<ul><li>';
                print $value[filename];
                print '<a href=kojin/';
                print $htmllink;
                print ' target="Example"></li></ul>';
                print '<iframe id="Example" name="Example"  width="400" height="600" src=kojin/'; 
                print $htmllink;
                print '></iframe>';
                 
                 
            
    }
   

    }
    catch(PDOException $e) {
	echo $e->getMessage();
	die();
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>個人の秘密PDF</title>
       
    </head>
    <body>
        <form enctype="multipart/form-data" action="#" method="POST">
            <input type="file" name="pdf">
            <input type="submit" name="UPLOAD" value="upload">
        </form>
       
        
         
       
    </body>
</html>
