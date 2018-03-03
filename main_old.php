<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>通識列表</title>
<style>
td {text-align:center;font-family:新細明體;font-size:10} 
input {font-family:新細明體;font-size:12} 
button {font-family:新細明體;font-size:12}
p {margin: 1px;}
</style>
</head>

<body>
<?php
date_default_timezone_set('Asia/Taipei');
$now="更新日期 ".date("Y/m/d h:i:sa");
$url_peo=array(
	"http://esquery.tku.edu.tw/acad/upload/A02_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A05_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A11_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A03_9.htm");
$url_soc=array(
	"http://esquery.tku.edu.tw/acad/upload/A09_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A08_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A12_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A07_9.htm");
$url_sci=array(
	"http://esquery.tku.edu.tw/acad/upload/A01_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A14_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A10_9.htm",
	"");
$the_html="內文";

for($i= 0;$i<4;$i++){
	$the_html=$the_html . file_get_contents($url_peo[$i]);
	
}
for($i= 0;$i<4;$i++){
	$the_html=$the_html . file_get_contents($url_soc[$i]);
	
}

for($i= 0;$i<3;$i++){
	$the_html=$the_html . file_get_contents($url_sci[$i]);
	
}
//echo file_get_contents($url_peo[0]);
$the_html= str_replace("</body>","<div></div>",$the_html);
$the_html= str_replace("</html>","<div></div>",$the_html);
$the_html= str_replace("<iframe","<<div",$the_html);
$the_html= str_replace("window.open('selec","window.open('http://esquery.tku.edu.tw/acad/selec",$the_html);
$the_html= str_replace("window.open('open_pl","window.open('http://esquery.tku.edu.tw/acad/open_pl",$the_html);
$the_html= str_replace("加入我的模擬課表!","N",$the_html);
$the_html= str_replace("學期課程表","學期課程表<br>".$now,$the_html);

//印出
//echo $the_html;

//寫入
$the_txt;$now;

$the_txt="<html><head><meta charset=\"utf-8\"><style>td {text-align:center;font-family:新細明體;font-size:10} input {font-family:新細明體;font-size:12} button {font-family:新細明體;font-size:12}p {margin: 1px;}</style></head><body>".$now.$the_html;
//注意編碼問題
$file=fopen("index.html","w");
fwrite($file,$the_txt);
fclose($file);
echo "success";
?>
</body>
</html>
