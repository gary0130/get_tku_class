<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>通識列表v3</title>
<style>
td {text-align:center;font-family:新細明體;font-size:10} 
input {font-family:新細明體;font-size:12} 
button {font-family:新細明體;font-size:12}
p {margin: 1px;}
.fi{position: fixed;}
tr:hover{background-color: #DFE7F2;color: #000000;}
</style>
</head>

<body>
<?php
//v3.0b by gary 2018/09/16
date_default_timezone_set('Asia/Taipei');
$now="更新日期 ".date("Y/m/d h:i:sa");
$data_info= '<div style="background-color:	#00BBFF;position: fixed;">' . $now . '</div>';

$source_url=array(
	"http://esquery.tku.edu.tw/acad/upload/A02_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A05_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A11_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A03_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A09_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A08_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A12_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A07_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A01_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A14_9.htm",
	"http://esquery.tku.edu.tw/acad/upload/A10_9.htm"
	);

$table_set='<div style="height:20px;"></div><table  border="1" width="100%" bgcolor="#FFFFFF" bordercolorlight="#0080FF" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0"><tbody><tr bgcolor="#CCDDFF"><td width="3%" rowspan="2" height="41">選擇</td><td width="2%" rowspan="2">年級</td><td width="5%">開課<br>序號</td><td width="5%">科目<br>編號</td><td width="3%" rowspan="2">專<br>業<br>別</td><td width="2%" rowspan="2">學<br>期<br>序</td><td width="3%" rowspan="2">班<br>別</td><td width="3%" rowspan="2">分<br>組<br>別</td><td width="2%" rowspan="2">必<br>選<br>修</td><td width="2%" rowspan="2">學<br>分</td><td width="3%" rowspan="2">群<br>別</td><td width="20%" rowspan="2">科　目　名　稱<br><font color="blue">(Courses)</font></td><td width="5%" rowspan="2">人數<br>設限</td><td width="13%" rowspan="2">授 課 教 師<br><font color="blue">(教師歷程查詢)</font></td><td width="30%" colspan="2" height="13">上 課 時 間</td></tr><tr bgcolor="#CCDDFF"><td width="9%" height="13" colspan="2"><p align="left"><font color="blue">(教學計畫表)</font></p></td><td width="15%" height="13">星期 / 節次 / 教室</td><td width="15%" height="13">星期 / 節次 / 教室</td></tr>';


$source_html;

for($i=0;$i<count($source_url);$i++){
	$source_html[$i]=file_get_contents($source_url[$i]);//取得資料
}

$data_main="";//初始化資料區
for($i=0;$i<count($source_url);$i++){
	$resource=$source_html[$i];//整理

	$match_rule="/<tr><td(.*?)<\/tr>/i";//規則
	$result;
	preg_match_all($match_rule, $resource , $result );
	$data_head= $table_set."\n";

	for($li=2;$li<count($result[0]);$li++){//從2開始，前面兩列沒有用
		$fix=$result[0][$li];//取得列
		//去除無用的資訊
		$fix= preg_replace("/<!-- sp.*?->/i","",$fix);
		$fix= preg_replace("/<img.*?>/i","",$fix);
		$fix= preg_replace("/<span title=\"老師的.*?span>/i","",$fix);
		//重定連結
		$fix= str_replace("window.open('","window.open('http://esquery.tku.edu.tw/acad/",$fix);
		//學群背景色
		$col='2</td><td style="background-color:';
		$fix= str_replace("2</td><td>L</td>",$col.'#FF8D30">L</td>',$fix);
		$fix= str_replace("2</td><td>P</td>",$col.'#FF5B3C">P</td>',$fix);
		$fix= str_replace("2</td><td>V</td>",$col.'#E82E2B">V</td>',$fix);
		$fix= str_replace("2</td><td>M</td>",$col.'#FF308E">M</td>',$fix);
		
		$fix= str_replace("2</td><td>T</td>",$col.'#25F5A6">T</td>',$fix);
		$fix= str_replace("2</td><td>R</td>",$col.'#2FE839">R</td>',$fix);
		$fix= str_replace("2</td><td>W</td>",$col.'#63FF27">W</td>',$fix);
		$fix= str_replace("2</td><td>S</td>",$col.'#A8F525">S</td>',$fix);
		
		$fix= str_replace("2</td><td>O</td>",$col.'#314BE8">O</td>',$fix);
		$fix= str_replace("2</td><td>Z</td>",$col.'#7A28F5">Z</td>',$fix);
		$fix= str_replace("2</td><td>U</td>",$col.'#28B1F5">U</td>',$fix);
		
		//echo $fix."\n";
		$data_main=$data_main . $fix . "\n";
	
	}
}

$data_end= "</table>";
//印出
echo $data_info.$data_head.$data_main.$data_end;

?>
</body>
</html>