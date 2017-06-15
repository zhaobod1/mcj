<?php
/**
 * Created by PhpStorm.
 * User: Jason Ding
 * Date: 2017/5/9
 * Abstract:
 */

// 遍历取md5
phpinfo();

echo 'display_errors = ' . ini_get('display_errors') . "\n";
ini_set('error_log', 'd:\\wwwroot\\mcj\\wwwroot\\log.txt');

//die();
//
//
//
//// 挑出相同的
//
//$data=[];
//$oldData=[];
//$i=0;
//if (is_dir('TV-TEST')) {
//
//    if ($dh = opendir('TV-TEST')) {
//        while (($file = readdir($dh)) !== false) {
//            $data[$i]['name']=iconv("gb2312","utf-8",$file);
//            $data[$i]['md5']=md5_file('TV-TEST/'.$file);
//            $oldData[$i]['name']=$file;
//            $oldData[$i]['md5']=md5_file('TV-TEST/'.$file);
//            $i++;
//            //echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
//        }
//        closedir($dh);
//    }
//}else{
//    echo 'false';
//}
//echo '<pre>';
//
//$md5Array=array_column($data,'md5');
//$nameArray=array_column($data,'name');
//
//$new=array_combine($md5Array,$nameArray);
////var_dump(count($new));
////var_dump($new);
////var_dump(array_values($new));
//
//
//var_dump(count($new));
//var_dump(count($data));
//
//
//foreach ($data as $key=>$one)
//{
//    //var_dump($one['md5']);
//    if(!in_array($one['name'],$new))
//    {
//        var_dump($one['name']);
//          //echo 'ddd';
//        //var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].'/TV-TEST/'.$one['name']));
//      // var_dump('./TV-TEST/'.$one['name']);
//        //var_dump(is_file($_SERVER['DOCUMENT_ROOT'].'/TV-TEST/'.$one['name']));
//       $resut=unlink('TV-TEST/'.$oldData[$key]['name']);
//        var_dump($resut);
//    }
//}
