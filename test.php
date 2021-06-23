<pre><code>
データ一覧
</code></pre>

<?php
require_once "simple_html_dom.php";// PHP Simple HTML DOM Parser の読み込み
error_reporting(E_ALL & ~E_NOTICE); 
//realme 6
//print_r($html->find(".specs-photo-main a img",0)->src);
//print_r($html->find('img')->src);
//print_r($html->find("span[data-spec='storage-hl']",0)->plaintext);//print_r($html->find('img')->src);
$urls = [
    "https://www.gsmarena.com/xiaomi_mi_11x-10775.php",
    "https://www.gsmarena.com/acer_iconia_talk_s-8306.php",
    "https://www.gsmarena.com/asus_rog_phone_5_ultimate-10785.php",
    "https://www.gsmarena.com/xiaomi_redmi_note_10s-10769.php",
    "https://www.gsmarena.com/apple_iphone_12_pro_max-10237.php",
    "https://www.gsmarena.com/vivo_v21e-10878.php"
];
//print_r($html->find("span[data-spec='storage-hl']",0)->plaintext); 
foreach($urls as $url){
    $html = file_get_html($url); ?>

<p><?php echo $url;?></p>
<pre>
<?php
$data = [
    "sp-launch-0" => ["","メーカー"],
    "sp-launch-1" => [$html->find("span[data-spec='released-hl']",0)->plaintext,"発表日"],
    "sp-launch-3" => ["","発売日"],
    "sp-launch-4" => [$html->find(".specs-phone-name-title",0)->plaintext,"端末名"],
    "sp-launch-5" => ["","型番"],
    "sp-launch-6" => ["","追加説明"],
    "sp-design-0" => [$html->find("td[data-spec='dimensions']",0)->plaintext,"サイズ"],
    "sp-design-1" => [explode(",",($html->find("span[data-spec='body-hl']",0)->plaintext))[0],"重さ"],
    "sp-design-2" => ["","素材"],
    "sp-design-3" => [$html->find("td[data-spec='colors']",0)->plaintext,"色"],
    "sp-spec-1" => [$html->find("td[data-spec='chipset']",0)->plaintext,"SoC"],
    "sp-spec-2" => [$html->find("td[data-spec='cpu']",0)->plaintext,"CPU構成"],
    "sp-spec-3" => [$html->find("td[data-spec='gpu']",0)->plaintext,"GPU"],
    "sp-spec-4" => ["","GPU構成"],
    "sp-spec-5" => ["","詳細情報"],
    "sp-spec-6" => [$html->find("td[data-spec='internalmemory']",0)->plaintext,"メモリ種類"],
    "sp-spec-7" => ["","メモリGB"],
    "sp-spec-8" => [$html->find("td[data-spec='memoryother']",0)->plaintext,"ストレージ種類"],
    "sp-spec-9" => [$html->find("td[data-spec='internalmemory']",0)->plaintext,"ストレージGB"],
    "sp-spec-10" => ["","他のバージョン"],
    "sp-spec-11" => [$html->find("td[data-spec='memoryslot']",0)->plaintext,"SDカード"],
    "sp-spec-12" => [$html->find("td[data-spec='memoryslot']",0)->plaintext,"SDカード"],
    "sp-spec-13" => ["","Antutu"],
    "sp-screen-1" => ["","画面サイズ"],
	"sp-screen-14" => ["","画面占有率"],
    "sp-screen-2" => ["","アスペクト比"],
    "sp-screen-3" => ["","パネル種類"],
    "sp-screen-4" => ["","解像度(縦*横)"],
    "sp-screen-5" => ["","解像度"],
    "sp-screen-6" => ["","dpi"],
    "sp-screen-0" => ["","画面保護"],
    "sp-screen-7" => ["","インカメラタイプ"],
    "sp-screen-8" => ["","リフレッシュレート"],
    "sp-screen-9" => ["","タッチレート"],
    "sp-screen-10" => ["","コントラスト比"],
    "sp-screen-11" => ["","最大輝度"],
    "sp-screen-12" => ["","その他"],
    "sp-screen-13" => ["","補足情報"],
    "sp-battery-1" => ["","容量"],
    "sp-battery-8" => ["","バッテリータイプ"],
    "sp-battery-9" => ["","バッテリー取り外し"],
    "sp-battery-2" => ["","ポート規格"],
    "sp-battery-3" => ["","充電ポート"],
    "sp-battery-4" => ["","充電規格"],
    "sp-battery-5" => ["","ワイヤレス充電"],
    "sp-battery-6" => ["","ワイヤレス充電速度"],
    "sp-battery-7" => ["","補足情報"],
    "sp-camera-0" => ["","メインカメラ"],
	"sp-camera-1" => ["","フラッシュ"],
    "sp-camera-2" => ["","動画"],
    "sp-camera-3" => ["","MP"],
    "sp-camera-4" => ["","カメラ個数"],
    "sp-camera-5" => ["","カメラタイプ"],
    "sp-camera-6" => ["","ビデオ"],
    "sp-camera-7" => ["","機能"],
	"sp-camera-8" => ["","カメラ詳細"],
    "sp-camera-9" => ["","DXO"],
    "sp-camera-10" => ["","インカメラ"],
    "sp-camera-11" => ["","内カメビデオ"],
    "sp-camera-12" => ["","カメラ個数"],
    "sp-camera-13" => ["","機能"],
    "sp-camera-14" => ["","詳細"],
    "sp-camera-15" => ["","その他"],
    "sp-sensor-0" => ["","各センサー"],
    "sp-network-0" => ["","Wi-Fi"],
	"sp-network-5" => ["","Wi-Fi機能"],
    "sp-network-1" => ["","bluetooth"],
    "sp-network-6" => ["","Bluetooh機能"],
    "sp-network-2" => ["","band"],
    "sp-network-3" => ["","スロット"],
    "sp-network-4" => ["","VoLTE"],
    "sp-security-0" => ["","顔認証"],
    "sp-security-1" => ["","指紋認証"],
    "sp-security-2" => ["","虹彩認証"],
    "sp-security-3" => ["","その他の認証"],
    "sp-softwear-0" => ["","OS"],
    "sp-softwear-1" => ["","UI"],
    "sp-extra-0" => ["","NFC"],
    "sp-extra-1" => ["","おサイフケータイ"],
    "sp-extra-1" => ["","IP"],
    "sp-extra-2" => ["","付属品"],
    "sp-extra-3" => ["","イヤホンジャック"],
];
echo "\n重さ:sp-design-1\n";
echo explode(",",($html->find("span[data-spec='body-hl']",0)->plaintext))[0];
echo "\n発表:sp-launch-1\n";
print_r($html->find("span[data-spec='released-hl']",0)->plaintext);
echo "\nGSM\n";
print_r($html->find("td[data-spec='net2g']",0)->plaintext);
echo "\n名前:sp-launch-4\n";
print_r($html->find(".specs-phone-name-title",0)->plaintext);
echo "\nインチ:sp-screen-1,sp-screen-14\n";
print_r($html->find("td[data-spec='displaysize']",0)->plaintext);
echo "\npx dpi 画面占有率 アスペクト比:sp-screen-4,sp-screen-6,sp-screen-2\n";
print_r($html->find("td[data-spec='displayresolution']",0)->plaintext);
echo "\n画面種類:sp-screen-3\n";
print_r($html->find("td[data-spec='displayresolution']",0)->plaintext);
echo "\nsim\n";
print_r($html->find("td[data-spec='sim']",0)->plaintext);
echo "\n3g\n";
print_r($html->find("td[data-spec='net3g']",0)->plaintext);
echo "\n4g\n";
print_r($html->find("td[data-spec='net4g']",0)->plaintext);//
echo "\nwifi wifi機能:sp-network-0,sp-network-5\n";
print_r($html->find("td[data-spec='wlan']",0)->plaintext);//
echo "\n5g\n";
print_r($html->find("td[data-spec='net5g']",0)->plaintext);//
echo "\n速度\n";
print_r($html->find("td[data-spec='speed']",0)->plaintext);//
echo "\nサイズ:sp-design-0\n";
print_r($html->find("td[data-spec='dimensions']",0)->plaintext);//
echo "\nビルド\n";
print_r($html->find("td[data-spec='build']",0)->plaintext);//
echo "\nベンチマーク\n";
print_r($html->find("td[data-spec='tbench']",0)->plaintext);//
echo "\n画面保護 :sp-screen-0,\n";
print_r($html->find("td[data-spec='displayprotection']",0)->plaintext);//
echo "\n画面\n";
print_r($html->find("td[data-spec='displaytype']",0)->plaintext);//
echo "\nos:sp-softwear-0,sp-softwear-1\n";
print_r($html->find("td[data-spec='os']",0)->plaintext);//
echo "\nbluetooh bt機能:sp-network-1,sp-network-1\n";
print_r($html->find("td[data-spec='bluetooth']",0)->plaintext);//
echo "\nSoC:sp-spec-1\n";
print_r($html->find("td[data-spec='chipset']",0)->plaintext);//
echo "\nCPU:sp-spec-2\n";
print_r($html->find("td[data-spec='cpu']",0)->plaintext);//
echo "\nGPU:sp-spec-3\n";
print_r($html->find("td[data-spec='gpu']",0)->plaintext);//
echo "\nメモリースロット:sp-spec-11,sp-spec-12\n";
print_r($html->find("td[data-spec='memoryslot']",0)->plaintext);//
echo "\nストレージ:sp-spec-6,sp-spec-9\n";
print_r($html->find("td[data-spec='internalmemory']",0)->plaintext);//
echo "\nストレージタイプ:sp-spec-8\n";
print_r($html->find("td[data-spec='memoryother']",0)->plaintext);//
echo "\n特徴\n";
print_r($html->find("td[data-spec='cam1features']",0)->plaintext);//cam1features
echo "\nビデオ\n";
print_r($html->find("td[data-spec='cam1video']",0)->plaintext);//
echo "\n内カメラ\n";
print_r($html->find("td[data-spec='cam2modules']",0)->plaintext);//
echo "\n内カメ　特徴\n";
print_r($html->find("td[data-spec='cam2features']",0)->plaintext);//
echo "\n内カメ動画\n";
print_r($html->find("td[data-spec='cam2video']",0)->plaintext);//
echo "\nセンサー\n";
print_r($html->find("td[data-spec='sensors']",0)->plaintext);//
echo "\nバッテリー　バッテリー種類　取り外し可能か:sp-battery-1,sp-battery-8,sp-battery-9\n";
print_r($html->find("td[data-spec='batdescription1']",0)->plaintext);//
echo "\n色:>sp-design-3\n";
print_r($html->find("td[data-spec='colors']",0)->plaintext);//
echo "\n価格\n";
print_r($html->find("td[data-spec='price']",0)->plaintext);//
echo "\n\n";
?>
</pre>
<?php }?>
<?php
print_r($data);
/*for ($i = 0 ;$i <=42; $i++) {
    echo $i.":";
    print_r($html->find(".nfo", $i)->plaintext);
    echo "\n";
}*/?>

