<?php
if(!isset($_SERVER['PHP_AUTH_USER'])|| !isset($_SERVER['PHP_AUTH_PW'])){
    header("WWW-Authenticate: Basic realm=\"Member Only\"");
    header("HTTP/1.0 401 Unauthorized");

?>

<HTML>
    <HEAD>
        <TITLE>Basic認証のテスト</TITLE>
        <META http-equiv="Content-Type" content="text/html;charset=utf-8">
    </HEAD>
    <BODY>
        Basic認証のテスト<BR>
        <BR>
        キャンセルされました。
    </BODY>
</HTML>
<?php    
} else {
    if($_SERVER['PHP_AUTH_USER'] == "sample" && $_SERVER['PHP_AUTH_PW'] == "password"){
   ?>
<HTML>
    <HEAD>
        <TITLE>Basic認証のテスト</TITLE>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    </HEAD>
    <BODY>
        Basic認証のテスト<BR>
        <BR>
        <?php print "こんにちは、{$_SERVER['PHP_AUTH_USER']}さん"; ?>
    </BODY>
</HTML>
    <?php
    } else {
    ?>
<HTML>
    <HEAD> 
        <TITLE>Basic認証のテスト</TITLE>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    </HEAD>
    <BODY>
        Basic認証のテスト<BR>
        <BR>
        ユーザーID、またはパスワードが違います。
    
    </BODY>
</HTML>
<?php
    }
}
?>

<?php
define('UPLOADPASS', 'publicpdf/');
if($_SERVER['REQUEST_METHOD']==='POST'){
    print $_FILES['pdf']['name'].'<br>';
    print $_FILES['pdf']['type'].'<br>';
    print $_FILES['pdf']['size'].'<br>';
    print $_FILES['pdf']['tmp_name'].'<br>';
    print $_FILES['pdf']['error'].'<br>';
    
    $name=$_FILES['pdf']['name'];
    
    $target=UPLOADPASS.$name;
    
    if(move_uploaded_file($_FILES['pdf']['tmp_name'], $target)){
        print'OK';
    }else{
        print'down';
    }
    
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>個人のPDF</title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="#" method="POST">
            <input type="file" name="pdf">
            <input type="submit" value="upload">
        </form>
       
       
       <iframe id="Example"  width="400" height="500"src="publicpdf/" >
</iframe>
    </body>
</html>