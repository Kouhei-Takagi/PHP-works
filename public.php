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
        <title>みんなのPDF</title>
       
    </head>
    <body>
        <form enctype="multipart/form-data" action="#" method="POST">
            <input type="file" name="pdf">
            <input type="submit" value="upload">
        </form>
        <?php
        foreach (glob('publicpdf/*') as $file){
            if (is_file($file)){
                $htmllink = htmlspecialchars($file);
                print'<ul><li>';
                print $htmllink;
                print '<a href=';
                print $htmllink;
                print ' target="Example"></li></ul>';
                print '<iframe id="Example" name="Example"  width="400" height="600" src='; 
                print $htmllink;
                print '></iframe>';
            }
        }
        
       ?>
        
         
       
    </body>
</html>

