<?php
    $result = "";

    if ($_FILES['image']['name']) {
        if (!$_FILES['image']['error']) {
            if($_POST['action'] == 'insert') {
                $_SERVER['HTTP_REFERER'] = str_replace('/insert.php', '', $_SERVER['HTTP_REFERER']);
                $fsRoot = __DIR__;
                $webRoot = str_replace($_SERVER['PHP_SELF'], '', $_SERVER['SCRIPT_FILENAME']);
                $urlRoot = str_replace($webRoot, '', $fsRoot);
                $file_dir = $webRoot . $urlRoot . '/img/';
                $name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['image']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = $file_dir.$filename;
                $location = $_FILES["image"]["tmp_name"];
                $moved = move_uploaded_file($location, $destination);
                if($moved) {      
                    $cmd1 = "chmod  777 ".$destination;
                    shell_exec($cmd1);
                    $result = $_SERVER['HTTP_REFERER'].'/img/'.$filename;
                    echo $result;exit;
                } else {
                    $result = "Not uploaded because of error #".$_FILES['image']['error'];
                    echo $result;exit;
                }
            } else {
                $fsRoot = __DIR__;
                $webRoot = str_replace($_SERVER['PHP_SELF'], '', $_SERVER['SCRIPT_FILENAME']);
                $urlRoot = str_replace($webRoot, '', $fsRoot);
                $file_dir = $webRoot . $urlRoot . '/img/';
                $name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['image']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = $file_dir.$filename;
                $location = $_FILES["image"]["tmp_name"];
                $moved = move_uploaded_file($location, $destination);
                if($moved) {      
                    $cmd1 = "chmod  777 ".$destination;
                    shell_exec($cmd1);
                    $result = $_SERVER['HTTP_REFERER'].'/img/'.$filename;
                    echo $result;exit;
                } else {
                    $result = "Not uploaded because of error #".$_FILES['image']['error'];
                    echo $result;exit;
                }
            }
        }else{
            $result = 'Ooops! Your upload triggered the following error: '.$_FILES['image']['error'];
            echo $result;exit;
        }
    }
    $result;
?>