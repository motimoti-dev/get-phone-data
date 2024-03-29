<?php 
//spec-sheet のテンプレです！これをベースに作ってください。　もち「はい。」
?>
<style>
	/*ul tag belong spection data.*/
	.spec-ul{list-style-type:none;margin:0;padding:0}
	.spec-color{line-height:20px;vertical-align:top;margin-right:10px;display:inline-block;height:13px;width:20px;border:1px solid gray;border-radius:8px}
    .s-box {
        width: 280px;
        margin: 10px;
        display: inline-block;
        box-shadow: 0 2px 4px 0 rgb(0 0 0 / 5%);
        padding: 15px;
        margin-top: 20px;
        background: white;
        border-radius: 12px;
    }
    .s-box h3 {
        filter: drop-shadow(10px 10px 10px rgba(28, 255, 247,0.4));
        margin: 0 0 5px 0;
        font-size: 20px;
        font-weight: 500;
    }
    .data-table th {
        width: 40%;
        font-size: 13px;
        font-weight: 400;
        color: #555;
        vertical-align: top;
    }
    .data-table {
        width: 100%;
        text-align: left;
    }
    .sp-data {
        margin-right: 10px;
        vertical-align: bottom;
        width: 18px;
        height: 18px;
        fill: gray;
    }
    .table-row{
        display:flex;
    }
    .table-column{
        width:330px;
    }
    body{
        margin:0
    }
    .table-icons {
        margin-right: 10px;
        vertical-align: bottom;
        width: 18px;
        height: 18px;
    }
    .spec-ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    p {
        font-size: 13px;
        line-height: 1.5;
        margin: 1em 0;
    }
    .data-table td {
        font-size: 13px;
    }
</style>
<?php
global $data_table,$data_table_title,$data_context;
$data_table = [];
$data_table_title = "";
$data_context = "";
function gen_table(){
    global $data_table,$data_table_title,$data_context;
    //$data_table,$data_table_title,$data_context
    $out_html = "<div class='s-box'><h3>".$data_table_title."</h3><table class='data-table'>";
    if($data_context != ""){
        $out_html .= "<p>".$data_context."</p>";
    }
    foreach($data_table as $data){
        $out_html .= "<tr><th>".$data[0]."</th><td>".$data[1]."</td></tr>";
    }
    $out_html .= "</table></div>";
    echo $out_html;
}?>

<p>url:</p>
<div class="table-row">
    <div class="table-column" style="background:#bddeff;">
        <?php
            $data_table_title = "発売日とメーカー";
            $data_table = [];
            $data_table[] = ["メーカー","Xiaomi"];
            $data_table[] = ["発表日","2019-03-25"];
            $data_table[] = ["発売日","-"];
            $data_table[] = ["端末名","Xiaomi Mi 9"];
            $data_table[] = ["モデル番号","M1902F1G"];
            $data_table[] = ["地域","中国"];
            $data_table[] = ["追加説明","-"];
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-launch-0","メーカー"];
            $data_table[] = ["sp-launch-1","発表日"];
            $data_table[] = ["sp-launch-2","発売日"];
            $data_table[] = ["sp-launch-3",""];
            $data_table[] = ["sp-launch-4","端末名"];
            $data_table[] = ["sp-launch-5","モデル番号"];
            $data_table[] = ["sp-launch-6","地域"];
            $data_table[] = ["sp-launch-7","追加説明"];
            $data_table[] = ["sp-launch-8","端末id(一意のid)"];
            $data_table[] = ["sp-launch-9","関連スマホ"];
            $data_table[] = ["sp-launch-10","メイン"];
            $data_table[] = ["sp-launch-11","leak"];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#d4c7ff;">
        <?php 
            $data_table = [];
            $data_table[] = ['<svg viewBox="0 0 512 512" class="sp-data"><path d="M276 192h152a20 20 0 0 0 20-20V52a20 20 0 0 0-20-20H276a20 20 0 0 0-20 20v120a20 20 0 0 0 20 20zm208 64H284a28 28 0 0 0-28 28v168a28 28 0 0 0 28 28h200a28 28 0 0 0 28-28V284a28 28 0 0 0-28-28zM107.31 36.69a16 16 0 0 0-22.62 0l-80 96C-5.35 142.74 1.77 160 16 160h48v304a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16V160h48c14.21 0 21.38-17.24 11.31-27.31z"></path></svg>サイズ',"157.5x74.7x7.6mm"];
            $data_table[] = ["重さ","173g"];
            $data_table[] = ["素材","全面ガラス:Gorilla Glass 6<br>背面ガラス:Gorilla Glass 5<br>フレーム:アルミニウム<br>"];
            $data_table[] = ['<svg viewBox="0 0 384 512" class="sp-data"><path d="M352 0H32C14.33 0 0 14.33 0 32v224h384V32c0-17.67-14.33-32-32-32zM0 320c0 35.35 28.66 64 64 64h64v64c0 35.35 28.66 64 64 64s64-28.65 64-64v-64h64c35.34 0 64-28.65 64-64v-32H0v32zm192 104c13.25 0 24 10.74 24 24 0 13.25-10.75 24-24 24s-24-10.75-24-24c0-13.26 10.75-24 24-24z"></path></svg>色',"<div style=\"line-height:20px;vertical-align:top;margin-right:10px;display:inline-block;height:13px;width:20px;border:1px solid gray;border-radius:8px;background:#e180ff\"></div>ラベンダーバイオレット<br><div style=\"line-height:20px;vertical-align:top;margin-right:10px;display:inline-block;height:13px;width:20px;border:1px solid gray;border-radius:8px;background:#006ef5\"></div>オーシャンブルー<br><div style=\"line-height:20px;vertical-align:top;margin-right:10px;display:inline-block;height:13px;width:20px;border:1px solid gray;border-radius:8px;background:#454545\"></div>ピアノブラック<br>"];
            $data_table_title = "デザイン";
            gen_table();?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-design-0","縦大きさ(mm)"];
            $data_table[] = ["sp-design-1","重さ(g)"];
            $data_table[] = ["sp-design-2","素材"];
            $data_table[] = ["sp-design-3","色"];
            $data_table[] = ["sp-design-4","横大きさ(mm)"];
            $data_table[] = ["sp-design-5","厚み(mm)"];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#fcffc7">
        <?php
            $data_table_title = "性能";
            $data_table = [];
            $data_table[] = ['<svg class="sp-data" viewBox="0 0 512 512"><path d="M416 48v416c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V48c0-26.51 21.49-48 48-48h224c26.51 0 48 21.49 48 48zm96 58v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42V88h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zM30 376h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6z"></path></svg>SoC',"Qualcomm SM8150 Snapdragon 855 (7 nm)"];
            $data_table[] =	['CPU構成','オクタコア(8つのコア)<br><div style="color:#676767;font-size:11px;">Kryo 485(2.84 GHz) × 1<br>Kryo 485(2.42 GHz) × 3<br>Kryo 485(1.78 GHz) × 4<br></div>'];
            $data_table[] = ["GPU",'Adreno 640'];
            $data_table[] = ["詳細情報",''];
            $data_table[] = ['<svg viewBox="0 0 640 512" class="sp-data"><path d="M640 130.94V96c0-17.67-14.33-32-32-32H32C14.33 64 0 78.33 0 96v34.94c18.6 6.61 32 24.19 32 45.06s-13.4 38.45-32 45.06V320h640v-98.94c-18.6-6.61-32-24.19-32-45.06s13.4-38.45 32-45.06zM224 256h-64V128h64v128zm128 0h-64V128h64v128zm128 0h-64V128h64v128zM0 448h64v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h64v-96H0v96z"></path></svg>メモリ種類',''];
            $data_table[] = ["メモリGB",'6GB'];
            $data_table[] = ['<svg viewBox="0 0 448 512" class="sp-data"><path d="M224 32c106 0 192 28.75 192 64v32c0 35.25-86 64-192 64S32 163.25 32 128V96c0-35.25 86-64 192-64m192 149.5V224c0 35.25-86 64-192 64S32 259.25 32 224v-42.5c41.25 29 116.75 42.5 192 42.5s150.749-13.5 192-42.5m0 96V320c0 35.25-86 64-192 64S32 355.25 32 320v-42.5c41.25 29 116.75 42.5 192 42.5s150.749-13.5 192-42.5m0 96V416c0 35.25-86 64-192 64S32 451.25 32 416v-42.5c41.25 29 116.75 42.5 192 42.5s150.749-13.5 192-42.5M224 0C145.858 0 0 18.801 0 96v320c0 77.338 146.096 96 224 96 78.142 0 224-18.801 224-96V96c0-77.338-146.096-96-224-96z"></path></svg>ストレージ種類','UFS 2.1'];
            $data_table[] = ["ストレージGB",'64GB'];
            $data_table[] = ["全てのバージョン",'64GB/6GB, 64GB/8GB, 128GB/6GB, 128GB/8GB, 256GB/8GB'];
            $data_table[] = ['<svg viewBox="0 0 384 512" class="sp-data"><path d="M320 0H128L0 128v320c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zM160 160h-48V64h48v96zm80 0h-48V64h48v96zm80 0h-48V64h48v96z"></path></svg>SDカード','非対応'];
            $data_table[] = ['<img src="https://sumahotektek.com/wp-content/uploads/2021/04/icon-2.jpg" alt="Antutuアイコン" class="table-icons">Antutu v7','372006'];
            $data_table[] = ['<img src="https://sumahotektek.com/wp-content/uploads/2021/04/icon-2.jpg" alt="Antutuアイコン" class="table-icons">Antutu v8','453421'];
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-spec-0",''];
            $data_table[] = ["sp-spec-1",'SoC名'];
            $data_table[] = ["sp-spec-2",'CPU構成'];
            $data_table[] = ["sp-spec-3",'GPU名'];
            $data_table[] = ["sp-spec-4",'GPU構成'];
            $data_table[] = ["sp-spec-5",'SoCについての詳細情報'];
            $data_table[] = ["sp-spec-6",'メモリ規格'];
            $data_table[] = ["sp-spec-7",'メモリGB(この構成のものだけ)'];
            $data_table[] = ["sp-spec-8",'ストレージ規格'];
            $data_table[] = ["sp-spec-9",'ストレージGB'];
            $data_table[] = ["sp-spec-10",'他のバージョン'];
            $data_table[] = ["sp-spec-11",'SoCのページのid'];
            $data_table[] = ["sp-spec-12",'SD microsd'];
            $data_table[] = ["sp-spec-13",'antutu v7'];
            $data_table[] = ["sp-spec-14",'SD最大容量'];
            $data_table[] = ["sp-spec-15",'CPUnum'];
            $data_table[] = ["sp-spec-16",'antutu v8'];
            $data_table[] = ["sp-spec-17",''];
            $data_table[] = ["sp-spec-18",''];
            $data_table[] = ["sp-spec-19",''];
            $data_table[] = ["sp-spec-20",'NMカード'];
            $data_table[] = ["sp-spec-21",'NMカード最大容量'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#ceffc7">
        <?php
            $data_table = [];
            $data_table_title = "スクリーン";
            $data_table[] = ['<svg viewBox="0 0 320 512" class="sp-data"><path d="M196 448h-72c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12zM320 48v416c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V48C0 21.5 21.5 0 48 0h224c26.5 0 48 21.5 48 48zm-32 0c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v416c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16V48z"></path></svg>画面サイズ','6.39インチ'];
            $data_table[] = ['画面占有率','85.2%'];
            $data_table[] = ['アスペクト比','19.5:9'];
            $data_table[] = ['<svg viewBox="0 0 512 512" class="sp-data"><path d="M352 304V48a48 48 0 0 0-48-48H48A48 48 0 0 0 0 48v256a48 48 0 0 0 48 48h256a48 48 0 0 0 48-48zM48 48h256v256H48zm416 112h-80v48h80v256H208v-80h-48v80a48 48 0 0 0 48 48h256a48 48 0 0 0 48-48V208a48 48 0 0 0-48-48zM240 416a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16V256a16 16 0 0 0-16-16h-32v144H240z"></path></svg>パネル種類','Super AMOLED, HDR10'];
            $data_table[] = ['解像度(横*縦)','1080x2340px'];
            $data_table[] = ['解像度','FHD'];
            $data_table[] = ['dpi','403dpi'];
            $data_table[] = ['画面保護','Corning Gorilla Glass 6'];
            $data_table[] = ['リフレッシュレート','60fps'];
            $data_table[] = ['その他',''];
            $data_table[] = ['補足情報',''];
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-screen-0",'画面保護'];
            $data_table[] = ["sp-screen-1",'インチ'];
            $data_table[] = ["sp-screen-2",'アスペクト比縦'];
            $data_table[] = ["sp-screen-3",'パネル種類'];
            $data_table[] = ["sp-screen-4",'解像度横px'];
            $data_table[] = ["sp-screen-5",'解像度'];
            $data_table[] = ["sp-screen-6",'DPI'];
            $data_table[] = ["sp-screen-7",'インカメラタイプ'];
            $data_table[] = ["sp-screen-8",'リフレッシュレート'];
            $data_table[] = ["sp-screen-9",'タッチレート'];
            $data_table[] = ["sp-screen-10",'コントラスト比'];
            $data_table[] = ["sp-screen-11",'最大輝度'];
            $data_table[] = ["sp-screen-12",'その他'];
            $data_table[] = ["sp-screen-13",'補足情報'];
            $data_table[] = ["sp-screen-14",'画面占有率'];
            $data_table[] = ["sp-screen-15",''];
            $data_table[] = ["sp-screen-16",'解像度縦px'];
            $data_table[] = ["sp-screen-17",'アスペクト比横'];
            $data_table[] = ["sp-screen-18",'画面タイプ'];
            $data_table[] = ["sp-screen-19",'最低輝度'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#ffdac7">
        <?php
            $data_table_title = "バッテリー";
            $data_table = [];
            $data_table[] = ['<svg viewBox="0 0 640 512" class="sp-data"><path d="M544 160v64h32v64h-32v64H64V160h480m16-64H48c-26.51 0-48 21.49-48 48v224c0 26.51 21.49 48 48 48h512c26.51 0 48-21.49 48-48v-16h8c13.255 0 24-10.745 24-24V184c0-13.255-10.745-24-24-24h-8v-16c0-26.51-21.49-48-48-48zm-144 96H96v128h320V192z"></path></svg>容量','3300mAh'];
            $data_table[] = ['バッテリータイプ','リチウムイオン'];
            $data_table[] = ['バッテリー取り外し','不可'];
            $data_table[] = ['ポート規格','USB Type-C'];
            $data_table[] = ['<svg viewBox="0 0 640 512" class="sp-data"><path d="M641.5 256c0 3.1-1.7 6.1-4.5 7.5L547.9 317c-1.4.8-2.8 1.4-4.5 1.4-1.4 0-3.1-.3-4.5-1.1-2.8-1.7-4.5-4.5-4.5-7.8v-35.6H295.7c25.3 39.6 40.5 106.9 69.6 106.9H392V354c0-5 3.9-8.9 8.9-8.9H490c5 0 8.9 3.9 8.9 8.9v89.1c0 5-3.9 8.9-8.9 8.9h-89.1c-5 0-8.9-3.9-8.9-8.9v-26.7h-26.7c-75.4 0-81.1-142.5-124.7-142.5H140.3c-8.1 30.6-35.9 53.5-69 53.5C32 327.3 0 295.3 0 256s32-71.3 71.3-71.3c33.1 0 61 22.8 69 53.5 39.1 0 43.9 9.5 74.6-60.4C255 88.7 273 95.7 323.8 95.7c7.5-20.9 27-35.6 50.4-35.6 29.5 0 53.5 23.9 53.5 53.5s-23.9 53.5-53.5 53.5c-23.4 0-42.9-14.8-50.4-35.6H294c-29.1 0-44.3 67.4-69.6 106.9h310.1v-35.6c0-3.3 1.7-6.1 4.5-7.8 2.8-1.7 6.4-1.4 8.9.3l89.1 53.5c2.8 1.1 4.5 4.1 4.5 7.2z"></path></svg>充電ポート','USB Type-C'];
            $data_table[] = ['<svg viewBox="0 0 576 512" class="sp-data"><path d="M120.57 224h42.39l-8.78 54.77c-1.28 4.74 2.86 9.23 8.34 9.23 2.98 0 5.85-1.37 7.42-3.74l66.93-99.28c3.3-4.99-.82-11.26-7.42-11.26h-41.22l8.28-36.28c1.45-4.76-2.66-9.43-8.28-9.43h-48.57c-4.3 0-7.93 2.78-8.5 6.51l-19.1 81c-.67 4.49 3.33 8.48 8.51 8.48zM560 128h-16V80c0-8.84-7.16-16-16-16s-16 7.16-16 16v48h-32V80c0-8.84-7.16-16-16-16s-16 7.16-16 16v48h-16c-8.84 0-16 7.16-16 16v48c0 35.76 23.62 65.69 56 75.93V372c0 15.44-12.56 28-28 28s-28-12.56-28-28v-28c0-48.53-39.47-88-88-88h-8V48c0-26.51-21.49-48-48-48H80C53.49 0 32 21.49 32 48v416H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h336c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8h-24V304h8c22.06 0 40 17.94 40 40v28c0 41.91 34.09 76 76 76s76-34.09 76-76V267.93c32.38-10.24 56-40.17 56-75.93v-48c0-8.84-7.16-16-16-16zM272 464H80V48h192v416zm256-272c0 17.64-14.36 32-32 32s-32-14.36-32-32v-16h64v16z"></path></svg>充電規格','Quick Charge 4+'];
            $data_table[] = ['最大充電速度','27W'];
            $data_table[] = ['ワイヤレス充電','Yes'];
            $data_table[] = ['ワイヤレス充電速度','20W'];
            $data_table[] = ['補足情報',''];
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-screen-0",'バッテリー容量'];
            $data_table[] = ["sp-screen-1",''];
            $data_table[] = ["sp-screen-2",'ポート規格'];
            $data_table[] = ["sp-screen-3",'充電ポート'];
            $data_table[] = ["sp-screen-4",'充電規格'];
            $data_table[] = ["sp-screen-5",'ワイヤレス充電'];
            $data_table[] = ["sp-screen-6",'ワイヤレス充電速度'];
            $data_table[] = ["sp-screen-7",'補足情報'];
            $data_table[] = ["sp-screen-8",'バッテリータイプ'];
            $data_table[] = ["sp-screen-9",'バッテリー取り外し'];
            $data_table[] = ["sp-screen-10",'最大充電速度'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#c7fff5">
        <?php
            $data_table = [];
            $data_table[] = ['<svg viewBox="0 0 512 512" class="sp-data"><path d="M512 144v288c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h88l12.3-32.9c7-18.7 24.9-31.1 44.9-31.1h125.5c20 0 37.9 12.4 44.9 31.1L376 96h88c26.5 0 48 21.5 48 48zM376 288c0-66.2-53.8-120-120-120s-120 53.8-120 120 53.8 120 120 120 120-53.8 120-120zm-32 0c0 48.5-39.5 88-88 88s-88-39.5-88-88 39.5-88 88-88 88 39.5 88 88z"></path></svg>メインカメラ','・広角カメラ<br><div style="color:gray;font-size:12px">48 MP, f/1.8, 27mm, 1/2.0", 0.8µm, PDAF, Laser AF</div><br>・望遠カメラ<br><div style="color:gray;font-size:12px">12 MP, f/2.2, 54mm, 1/3.6", 1.0µm, PDAF, 2x optical zoom</div><br>・超広角カメラ<br><div style="color:gray;font-size:12px">16 MP, f/2.2,  13mm, 1/3.0", 1.0µm, PDAF</div><br>'];
            $data_table[] = ['<svg class="sp-data" viewBox="0 0 576 512"><path d="M336.2 64H47.8C21.4 64 0 85.4 0 111.8v288.4C0 426.6 21.4 448 47.8 448h288.4c26.4 0 47.8-21.4 47.8-47.8V111.8c0-26.4-21.4-47.8-47.8-47.8zm189.4 37.7L416 177.3v157.4l109.6 75.5c21.2 14.6 50.4-.3 50.4-25.8V127.5c0-25.4-29.1-40.4-50.4-25.8z"></path></svg>動画','4K@30/60fps<br>1080p@30/120/240fps<br>1080p@960fps<br>'];
            $data_table[] = ['機能','・デュアルLEDフラッシュ<br>・HDR<br>・パノラマ<br>'];
            $data_table[] = ['カメラ詳細',''];
            $data_table[] = ['<svg viewBox="0 0 640 512" class="sp-data"><path d="M480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm0-160c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zM192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm0-192c44.1 0 80 35.9 80 80s-35.9 80-80 80-80-35.9-80-80 35.9-80 80-80zm80.1 212c-33.4 0-41.7 12-80.1 12-38.4 0-46.7-12-80.1-12-36.3 0-71.6 16.2-92.3 46.9C7.2 341.3 0 363.4 0 387.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-44.8c0-23.8-7.2-45.9-19.6-64.3-20.7-30.7-56-46.9-92.3-46.9zM352 432c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-44.8c0-16.6 4.9-32.7 14.1-46.4 13.8-20.5 38.4-32.8 65.7-32.8 27.4 0 37.2 12 80.2 12s52.8-12 80.1-12c27.3 0 51.9 12.3 65.7 32.8 9.2 13.7 14.1 29.8 14.1 46.4V432zm271.7-114.9C606.4 291.5 577 278 546.8 278c-27.8 0-34.8 10-66.8 10s-39-10-66.8-10c-13.2 0-26.1 3-38.1 8.1 15.2 15.4 18.5 23.6 20.2 26.6 5.7-1.6 11.6-2.6 17.9-2.6 21.8 0 30 10 66.8 10s45-10 66.8-10c21 0 39.8 9.3 50.4 25 7.1 10.5 10.9 22.9 10.9 35.7V408c0 4.4-3.6 8-8 8H416c0 17.7.3 22.5-1.6 32H600c22.1 0 40-17.9 40-40v-37.3c0-19.9-6-38.3-16.3-53.6z"></path></svg>インカメラ','・広角カメラ<br><div style="color:gray;font-size:12px">20 MP f/2.0 1/3" 0.9µm</div><br>'];
            $data_table[] = ['内カメビデオ','1080p@30fps'];
            $data_table[] = ['機能','・HDR'];
            $data_table[] = ['詳細',''];
            $data_table[] = ['その他',''];
            $data_table_title = "カメラ";
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-camera-0",'メインカメラ'];
            $data_table[] = ["sp-camera-1",''];
            $data_table[] = ["sp-camera-2",'動画'];
            $data_table[] = ["sp-camera-3",'メインカメラMP'];
            $data_table[] = ["sp-camera-4",'カメラ個数'];
            $data_table[] = ["sp-camera-5",''];
            $data_table[] = ["sp-camera-6",'ビデオ'];
            $data_table[] = ["sp-camera-7",'機能'];
            $data_table[] = ["sp-camera-8",'カメラ詳細'];
            $data_table[] = ["sp-camera-9",'DXO'];
            $data_table[] = ["sp-camera-10",'インカメラ'];
            $data_table[] = ["sp-camera-11",'内カメビデオ'];
            $data_table[] = ["sp-camera-12",'カメラ個数'];
            $data_table[] = ["sp-camera-13",'機能'];
            $data_table[] = ["sp-camera-14",'詳細'];
            $data_table[] = ["sp-camera-15",'その他'];
            $data_table[] = ["sp-camera-16",'メインカメラF値'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#c1c1c1">
        <?php
            $data_context = "同じ端末でも、発売国やキャリアの違いで対応バンドは異なる場合があります";
            $data_table_title = "ネットワーク";
            $data_table = [];
            $data_table[] = ['<svg viewBox="0 0 640 512" class="sp-data"><path d="M634.91 154.88C457.74-8.99 182.19-8.93 5.09 154.88c-6.66 6.16-6.79 16.59-.35 22.98l34.24 33.97c6.14 6.1 16.02 6.23 22.4.38 145.92-133.68 371.3-133.71 517.25 0 6.38 5.85 16.26 5.71 22.4-.38l34.24-33.97c6.43-6.39 6.3-16.82-.36-22.98zM320 352c-35.35 0-64 28.65-64 64s28.65 64 64 64 64-28.65 64-64-28.65-64-64-64zm202.67-83.59c-115.26-101.93-290.21-101.82-405.34 0-6.9 6.1-7.12 16.69-.57 23.15l34.44 33.99c6 5.92 15.66 6.32 22.05.8 83.95-72.57 209.74-72.41 293.49 0 6.39 5.52 16.05 5.13 22.05-.8l34.44-33.99c6.56-6.46 6.33-17.06-.56-23.15z"></path></svg>Wi-Fi','IEEE 802.11 a/b/g/n/ac'];
            $data_table[] = ['Wi-Fi機能','<ul class="spec-ul"><li>・デュアルバンド</li><li>・Wi-Fi Direct</li><li>・DLNA</li><li>・ホットスポット</li></ul>'];
            $data_table[] = ['<svg viewBox="0 0 320 512" class="sp-data"><path fill="black" d="M196.48 260.023l92.626-103.333L143.125 0v206.33l-86.111-86.111-31.406 31.405 108.061 108.399L25.608 368.422l31.406 31.405 86.111-86.111L145.84 512l148.552-148.644-97.912-103.333zm40.86-102.996l-49.977 49.978-.338-100.295 50.315 50.317zM187.363 313.04l49.977 49.978-50.315 50.316.338-100.294z"></path></svg>bluetooth','5.0'];
            $data_table[] = ['Bluetooh機能','A2DP, LE, aptX HD'];
            $data_table[] = ['スロット','nano SIMx2'];
            gen_table();
            $data_context = "";
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-network-0",'Wi-Fi'];
            $data_table[] = ["sp-network-1",'bluetooth'];
            $data_table[] = ["sp-network-2",'bluetooth ver'];
            $data_table[] = ["sp-network-3",'スロット'];
            $data_table[] = ["sp-network-4",'VoLTE'];
            $data_table[] = ["sp-network-5",'Wi-Fi機能'];
            $data_table[] = ["sp-network-6",'Bluetooh機能'];
            $data_table[] = ["sp-network-7",''];
            $data_table[] = ["sp-network-8",''];
            $data_table[] = ["sp-network-9",''];
            $data_table[] = ["sp-network-10",'a'];
            $data_table[] = ["sp-network-11",'b'];
            $data_table[] = ["sp-network-12",'g'];
            $data_table[] = ["sp-network-13",'n'];
            $data_table[] = ["sp-network-14",'ac'];
            $data_table[] = ["sp-network-15",'ax'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#ddffc7">
        <?php
            $data_table = [];
            $data_table[] = ['技術','GSM / CDMA / HSPA / LTE'];	
            $data_table[] = ['速度','HSPA 42.2/5.76 Mbps<br>LTE-A (5CA) Cat18 1200/150 Mbps<br>'];
            $data_table[] = ['<svg viewBox="0 0 576 512" class="sp-data"><path fill="currentColor" d="M528 288H376v-80a16 16 0 0 0-16-16h-16a16 16 0 0 0-16 16v80H48a48 48 0 0 0-48 48v128a48 48 0 0 0 48 48h480a48 48 0 0 0 48-48V336a48 48 0 0 0-48-48zm0 176H48V336h480zm-416-32a32 32 0 1 0-32-32 32 32 0 0 0 32 32zm96 0a32 32 0 1 0-32-32 32 32 0 0 0 32 32zm35.44-296.47a16.44 16.44 0 0 0-1.3 24l11.11 11.37a15.15 15.15 0 0 0 20.53 1.29 122.72 122.72 0 0 1 156.44 0 15.15 15.15 0 0 0 20.53-1.29l11.11-11.37a16.44 16.44 0 0 0-1.3-24 168.83 168.83 0 0 0-217.12 0zm-67.84-28.2c6 6.11 15.39 6.06 21.71.36a230.29 230.29 0 0 1 309.38 0c6.32 5.7 15.75 5.75 21.71-.36L539.47 96a16.41 16.41 0 0 0-1-23.56C487 25.59 421.42 0 352 0S217 25.59 165.48 72.44a16.41 16.41 0 0 0-.95 23.56z"></path></svg>バンド','・4G/LTE<br>1, 2, 3, 4, 5, 7, 8, 12, 20, 28, 38, 39, 40 - Global:1, 2, 3, 4, 5, 7, 8, 12, 17, 34, 38, 39, 40, 41 - China<br><br>・3G<br>HSDPA 850 / 900 / 1700(AWS) / 1900 / 2100<br><br>・2G<br>GSM 850 / 900 / 1800 / 1900 CDMA 800 &amp; TD-SCDMA<br><br>'];
            $data_table_title = "バンド";
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-band-",'省略'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#c7e1ff">
        <?php
            $data_table_title = "センサー";
            $data_table = [];
            $data_table[] = ["各センサー",'<ul class="spec-ul"><li>指紋認証(画面下指紋認証、光学式)</li><li>アクセラレータ</li><li>ジャイロ</li><li>接近センサー</li><li>コンパス</li></ul>'];
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-sensor-0",'各センサー'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#ffc7d4">
        <?php
            $data_table = [];
            $data_table[] = ['<svg viewBox="0 0 384 512" class="sp-data"><path d="M336 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM192 128c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H102.4C90 384 80 375.4 80 364.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z"></path></svg>顔認証','対応'];
            $data_table[] = ['<svg viewBox="0 0 512 512" class="sp-data"><path d="M256.12 245.96c-13.25 0-24 10.74-24 24 1.14 72.25-8.14 141.9-27.7 211.55-2.73 9.72 2.15 30.49 23.12 30.49 10.48 0 20.11-6.92 23.09-17.52 13.53-47.91 31.04-125.41 29.48-224.52.01-13.25-10.73-24-23.99-24zm-.86-81.73C194 164.16 151.25 211.3 152.1 265.32c.75 47.94-3.75 95.91-13.37 142.55-2.69 12.98 5.67 25.69 18.64 28.36 13.05 2.67 25.67-5.66 28.36-18.64 10.34-50.09 15.17-101.58 14.37-153.02-.41-25.95 19.92-52.49 54.45-52.34 31.31.47 57.15 25.34 57.62 55.47.77 48.05-2.81 96.33-10.61 143.55-2.17 13.06 6.69 25.42 19.76 27.58 19.97 3.33 26.81-15.1 27.58-19.77 8.28-50.03 12.06-101.21 11.27-152.11-.88-55.8-47.94-101.88-104.91-102.72zm-110.69-19.78c-10.3-8.34-25.37-6.8-33.76 3.48-25.62 31.5-39.39 71.28-38.75 112 .59 37.58-2.47 75.27-9.11 112.05-2.34 13.05 6.31 25.53 19.36 27.89 20.11 3.5 27.07-14.81 27.89-19.36 7.19-39.84 10.5-80.66 9.86-121.33-.47-29.88 9.2-57.88 28-80.97 8.35-10.28 6.79-25.39-3.49-33.76zm109.47-62.33c-15.41-.41-30.87 1.44-45.78 4.97-12.89 3.06-20.87 15.98-17.83 28.89 3.06 12.89 16 20.83 28.89 17.83 11.05-2.61 22.47-3.77 34-3.69 75.43 1.13 137.73 61.5 138.88 134.58.59 37.88-1.28 76.11-5.58 113.63-1.5 13.17 7.95 25.08 21.11 26.58 16.72 1.95 25.51-11.88 26.58-21.11a929.06 929.06 0 0 0 5.89-119.85c-1.56-98.75-85.07-180.33-186.16-181.83zm252.07 121.45c-2.86-12.92-15.51-21.2-28.61-18.27-12.94 2.86-21.12 15.66-18.26 28.61 4.71 21.41 4.91 37.41 4.7 61.6-.11 13.27 10.55 24.09 23.8 24.2h.2c13.17 0 23.89-10.61 24-23.8.18-22.18.4-44.11-5.83-72.34zm-40.12-90.72C417.29 43.46 337.6 1.29 252.81.02 183.02-.82 118.47 24.91 70.46 72.94 24.09 119.37-.9 181.04.14 246.65l-.12 21.47c-.39 13.25 10.03 24.31 23.28 24.69.23.02.48.02.72.02 12.92 0 23.59-10.3 23.97-23.3l.16-23.64c-.83-52.5 19.16-101.86 56.28-139 38.76-38.8 91.34-59.67 147.68-58.86 69.45 1.03 134.73 35.56 174.62 92.39 7.61 10.86 22.56 13.45 33.42 5.86 10.84-7.62 13.46-22.59 5.84-33.43z"></path></svg>指紋認証','対応'];
            $data_table[] = ['その他の認証','-'];
            $data_table_title = "セキュリティ";
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-security-0",'顔認証'];
            $data_table[] = ["sp-security-1",'指紋認証'];
            $data_table[] = ["sp-security-2",''];
            $data_table[] = ["sp-security-3",'その他の認証'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#ffebc7">
        <?php
            $data_table = [];
            $data_table[] = ['<svg viewBox="0 0 576 512" class="sp-data"><path d="M420.55,301.93a24,24,0,1,1,24-24,24,24,0,0,1-24,24m-265.1,0a24,24,0,1,1,24-24,24,24,0,0,1-24,24m273.7-144.48,47.94-83a10,10,0,1,0-17.27-10h0l-48.54,84.07a301.25,301.25,0,0,0-246.56,0L116.18,64.45a10,10,0,1,0-17.27,10h0l47.94,83C64.53,202.22,8.24,285.55,0,384H576c-8.24-98.45-64.54-181.78-146.85-226.55" ></path></svg><svg class="sp-data" viewBox="0 0 384 512"><path fill="currentColor" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"></path></svg>OS','Android 9.0 (Pie)<br>Android 10に更新可能<br>'];
            $data_table[] = ['<svg viewBox="0 0 512 512" class="sp-data"><path d="M128 224c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.4-32-32-32zM418.6 58.1C359.2 9.3 281.3-10 204.6 5 104.9 24.4 24.7 104.2 5.1 203.7c-16.7 84.2 8.1 168.3 67.8 230.6 47.3 49.4 109.7 77.8 167.9 77.8 8.8 0 17.5-.6 26.1-2 24.2-3.7 44.6-18.7 56.1-41.1 12.3-24 12.3-52.7.2-76.6-6.1-12-5.5-26.2 1.8-38 7-11.8 18.7-18.4 32-18.4h72.2c46.4 0 82.8-35.7 82.8-81.3-.2-76.4-34.3-148.1-93.4-196.6zM429.2 288H357c-29.9 0-57.2 15.4-73 41.3-16 26.1-17.3 57.8-3.6 84.9 5.1 10.1 5.1 22.7-.2 32.9-2.6 5-8.7 13.7-20.6 15.6-49.3 7.7-108.9-16.6-152-61.6-48.8-50.9-69-119.4-55.4-188 15.9-80.6 80.8-145.3 161.6-161 62.6-12.3 126.1 3.5 174.3 43.1 48.1 39.5 75.7 97.6 75.9 159.6 0 18.6-15.3 33.2-34.8 33.2zM160 128c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.4-32-32-32zm96-32.1c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32c0-17.6-14.3-32-32-32zm96 32.1c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32z"></path></svg>UI','MIUI 12'];
            $data_table_title = "ソフトウェア";
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-softwear-0",'OS'];
            $data_table[] = ["sp-softwear-1",'UI'];
            $data_table[] = ["sp-softwear-2",'OS id'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#f4ffc7">
        <?php
            $data_table = [];
            $data_table[] = ['NFC','対応'];
            $data_table[] = ['おサイフケータイ','非対応'];
            $data_table[] = ['<svg viewBox="0 0 640 512" class="sp-data"><path fill="black" d="M633.82 458.1L494.97 350.78c.52-5.57 1.03-11.16 1.03-16.87 0-111.76-99.79-153.34-146.78-311.82-7.94-28.78-49.44-30.12-58.44 0-15.52 52.34-36.87 91.96-58.49 125.68L45.47 3.37C38.49-2.05 28.43-.8 23.01 6.18L3.37 31.45C-2.05 38.42-.8 48.47 6.18 53.9l588.36 454.73c6.98 5.43 17.03 4.17 22.46-2.81l19.64-25.27c5.41-6.97 4.16-17.02-2.82-22.45zM144 333.91C144 432.35 222.72 512 320 512c44.71 0 85.37-16.96 116.4-44.7L162.72 255.78c-11.41 23.5-18.72 48.35-18.72 78.13z"></path></svg>防水防塵','非対応'];
            $data_table[] = ['<svg viewBox="0 0 512 512" class="sp-data"><path d="M256 32C114.52 32 0 146.497 0 288v49.714a24.001 24.001 0 0 0 12.319 20.966l19.702 10.977C32.908 430.748 82.698 480 144 480h24c13.255 0 24-10.745 24-24V280c0-13.255-10.745-24-24-24h-24c-40.744 0-76.402 21.758-96 54.287V288c0-114.691 93.309-208 208-208s208 93.309 208 208v22.287C444.402 277.758 408.744 256 368 256h-24c-13.255 0-24 10.745-24 24v176c0 13.255 10.745 24 24 24h24c61.302 0 111.092-49.252 111.979-110.344l19.702-10.977A24.001 24.001 0 0 0 512 337.713V288c0-141.48-114.497-256-256-256zM144 304v128c-35.29 0-64-28.71-64-64s28.71-64 64-64zm224 128V304c35.29 0 64 28.71 64 64s-28.71 64-64 64z"></path></svg>イヤホンジャック','非対応'];
            $data_table[] = ['技適認証','認証なし'];
            $data_table[] = ['付属品',''];
            $data_table_title = "その他";
            gen_table();
        ?>
        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-extra-0",'NFC'];
            $data_table[] = ["sp-extra-1",'おサイフケータイ'];
            $data_table[] = ["sp-extra-2",'防水防塵'];
            $data_table[] = ["sp-extra-3",'付属品'];
            $data_table[] = ["sp-extra-4",'イヤホンジャック'];
            $data_table[] = ["sp-extra-5",'技適認証'];
            $data_table[] = ["sp-extra-6",'IP-num'];
            $data_table[] = ["sp-extra-7",'IP-txt'];
            $data_table[] = ["sp-extra-8",'その他の防水防塵規格ー防滴など'];
            gen_table();
        ?>
    </div>
    <div class="table-column" style="background:#c7fff7">
        <?php gen_table();?>    
    </div>
    <div class="table-column" style="background:#f3c7ff">
        <?php gen_table();?>    
    </div>
</div>
