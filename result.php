<!DOCTYPE html>
<html>

<head>
<meta content="ja" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>艦娘所有一覧</title>

<link rel="stylesheet" type="text/css" href="flat-ui/jquery.mobile.flatui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

<link href="kan_style.css" rel="stylesheet" type="text/css">
<link href="image-picker/image-picker.css" rel="stylesheet" type="text/css">
<script src="image-picker/image-picker.min.js" type="text/javascript"></script>
</head>

<body>
<div data-role="page">
<div data-role="header" data-theme="f">
<h1>艦娘所有一覧</h1>
</div>
<div data-role="content">
<div data-role="collapsible" data-collapsed-icon="flat-checkround" data-expanded-icon="flat-cross" data-collapsed="false"  data-theme="f">
<h3>メニュー</h3>
<?php
	$path = "/home/vage/pear/PEAR/";
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	require_once "Services/ShortURL.php";
	// 全No
	define("MUSUNUM",200);
	// 未実装数
	define("MUSUMIJISSO",14);
	// 未実装No
	$mijissoMusumeList = array('151','154','162','167','176','177','178','183','186','192','193','198','199','200',);
	// GETで回収
	if(is_null($_GET['musuList'])){
		// 既存互換
		$form_musuList = $_GET['m'];
	}else{
		if($_GET['musuList'] == ""){
			$form_musuList = null;
		}else{
			$form_musuList = explode(",",$_GET['musuList']);
		}
	}
	// 未実装Noにチェックが入っている場合は削除
	// 要素ゼロのときはチェックしない
	if(is_array($form_musuList)){
		$form_musuList = array_diff($form_musuList,$mijissoMusumeList);
	}
	// 所有率計算
	$collectionRate = (count($form_musuList) / (MUSUNUM-MUSUMIJISSO)) * 100;

	$originalUrl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$obj = Services_ShortURL::factory('TinyURL');
	$shortUrl = $obj->shorten($originalUrl);

	echo '<a href="http://dunkel.halfmoon.jp/kancolle/" data-role="button" data-theme="f" data-inline="true" data-ajax="false">もう一度作る</a><br />';
	echo '<div>';
	echo '艦娘所有数 ' . count($form_musuList) . '/' . (MUSUNUM-MUSUMIJISSO) . ' (所有率' . floor($collectionRate) . '%)';
	echo '</div>';
	echo '<div class="menu">';
	echo '<label for="textarea-a">共有用(コピー＆ペーストでご利用ください)：</label>';
	echo '<textarea name="textarea" id="textarea-a">艦娘所有一覧を作成しました(所有率' . floor($collectionRate) . '%)：' . $shortUrl . '</textarea>';
	echo '</div>';
?>
</div>
<div data-role="collapsible" data-collapsed-icon="flat-checkround" data-expanded-icon="flat-cross" data-collapsed="false"  data-theme="f">

<h3>艦娘所有一覧</h3>
<div class="musuleResultList">
<?php
	// 整形
	$musuList = array_fill(1,MUSUNUM,"noncollect");
	// 要素ゼロのときはチェックしない
	if(is_array($form_musuList)){
		foreach($form_musuList as $musu){
			$musuList[intval($musu)] = "";
		}
	}
	// 出力
	for($j=1;$j<=MUSUNUM;$j++){
		echo '<div class="musumeResult ' . $musuList[$j] . '">';
		echo '<img src="image/' . str_pad($j,3,"0",STR_PAD_LEFT) .  '.jpg" height="150" width="109"></div>';
	}
/*
<div class="musumeResult"><img alt="戦艦 長門" height="150" src="image/001.jpg" width="109"></div>
<div class="musumeResult noncollect"><img alt="戦艦 陸奥" height="150" src="image/002.jpg" width="109"></div>
*/
?>
</div>
</div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- kancolle_result -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:15px"
     data-ad-client="ca-pub-1725571372992163"
     data-ad-slot="2634750330"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
</body>

</html>
