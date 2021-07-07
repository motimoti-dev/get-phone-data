<h1>スクレイピングの奴</h1>
<form id='form1'>
<?php 

//繰り返したぐ生成するやつ　https://paiza.io/projects/iBS4BIH4fcK8_lyw0xAqjg?language=php
foreach ( $_GET as $key => $value ) {
    echo $key. "：".$value."<br>";
}
//spec-sheetのジェネレーター、スクレイピングしたデータを出力
require_once "simple_html_dom.php";// PHP Simple HTML DOM Parser の読み込み
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(0);
//$url = 'https://www.gsmarena.com/xiaomi_mi_11x-10775.php';
//$url = 'https://www.gsmarena.com/xiaomi_mi_9-9507.php';
//$url = 'https://www.gsmarena.com/plum_optimax_10-8089.php';
//$url = 'https://www.gsmarena.com/huawei_p30_lite-9545.php';
//$url = 'https://www.gsmarena.com/samsung_galaxy_s21_ultra_5g-10596.php';
$url = 'https://www.gsmarena.com/asus_zenfone_8-10893.php';

$html = file_get_html($url);
?>
<?php //echo substr_count($html,'table');?>
<?php
global $data;
$data = [];
global $data_view;
$data_view = [];

$table_num = substr_count($html->find( '#specs-list', 0 ),'table')/2;
?>
<?php //echo $html->find( 'table', 0 );?>
<?php //echo $html->find( 'table', 0 )->find('th', 0);?>
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
        margin:20px
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
    input[type="text"],textarea{
        width:100%;
    }
    table tr:nth-child(odd){
	    background: #eee;
    }
    table[cellspacing="0"]{
        border:2px gray solid;
        border-radius:5px;
    }
    td span:nth-child(odd){
        color:red;
    }
    td span{
        border:1px gray solid;
        margin:5px;
        border-radius:4px;
    }
    
</style>
<?php /**//*
$ot_t = 'sp-band-4g-1,sp-band-4g-2,sp-band-4g-3,sp-band-4g-4,sp-band-4g-5,sp-band-4g-6,sp-band-4g-7,sp-band-4g-8,sp-band-4g-10,sp-band-4g-11,sp-band-4g-12,sp-band-4g-13,sp-band-4g-14,sp-band-4g-17,sp-band-4g-18,sp-band-4g-19,sp-band-4g-20,sp-band-4g-21,sp-band-4g-22,sp-band-4g-23,sp-band-4g-24,sp-band-4g-25,sp-band-4g-26,sp-band-4g-27,sp-band-4g-28,sp-band-4g-29,sp-band-4g-30,sp-band-4g-31,sp-band-4g-32,sp-band-4g-33,sp-band-4g-34,sp-band-4g-35,sp-band-4g-36,sp-band-4g-37,sp-band-4g-38,sp-band-4g-39,sp-band-4g-40,sp-band-4g-41,sp-band-4g-42,sp-band-4g-43,sp-band-4g-44,sp-band-4g-45,sp-band-4g-46,sp-band-4g-47,sp-band-4g-48,sp-band-4g-49,sp-band-4g-50,sp-band-4g-51,sp-band-4g-52,sp-band-4g-65,sp-band-4g-66,sp-band-4g-67,sp-band-4g-68,sp-band-4g-69,sp-band-4g-70,sp-band-4g-71,sp-band-4g-72,sp-band-4g-73,sp-band-4g-74,sp-band-4g-75,sp-band-4g-76,sp-band-4g-85,sp-band-4g-252,sp-band-4g-255';
$ot_t = explode(',',$ot_t);
foreach($ot_t as $ot_t1){
echo "['$ot_t1',],"."<br>";
}*//**/?>
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
}
function month_str_to_num($month_str){
    switch($month_str){
        case "January":
            return 1;

        case "February":
            return 2;

        case "March":
            return 3;
                
        case "April":
            return 4;

        case "May":
            return 5;

        case "June":
            return 6;
                
        case "July":
            return 7;

        case "August":
            return 8;

        case "September":
            return 9;
                
        case "October":
            return 10;

        case "November":
            return 11;
                
        case "December":
            return 12;
        
        default:
            return false;
    }
}
function is_data_key($key){
    foreach($data as $data_in){
        if($data_in[0] == $key){
            return true;
        }
    }
    return false;
}
function flag($flag_num){
    echo "<h2>$flag_num</h2>";
}
global $before_ttl;
global $errors;
$errors = [];
function error_repo($error_pos,$txt){
    global $errors;
    $add_new_error = false;
    $error_add_num = 0;
    foreach($errors as $errors_in){
        if($errors_in[0] == $error_pos){
            $add_new_error = true;
            continue;
        }
        $error_add_num ++;
    }
    if($add_new_error){
        //echo 'error repo';
        $errors[$error_add_num] = [$errors[$error_add_num][0],$errors[$error_add_num][1]+1,$errors[$error_add_num][2].":".$txt];
    }else{
        $errors[] = [$error_pos,1,$txt];
    }
}
function tab_table($tab_txt){?>
    <div class="tab_content" id="<?php echo $tab_txt;?>_content">
        <div class="s-box">
            <table class='data-table'>
                <?php
                global $data;
                foreach($data as $data_ot){
                    if(strpos($data_ot[0],$tab_txt) !== false){
                        echo "<tr><th>".$data_ot[0]."</th><td>".$data_ot[1]."</td></tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div><?php
}
global $after_set;
$after_set = [];
function after_setting(){

}
?>
<style>
.tagcloud a {
    font-size: 1rem !important;
    line-height: 1em;
    color: #5f6ab5;
    display: inline-block;
    white-space: nowrap;
    padding: 8px 8px;
    border: 1px solid #5f6ab5;
    margin: 3px 3px 0 0;
    border-radius: 4px;
    text-decoration: none;
}
.tagcloud2 a {
    font-size: .8rem !important;
    line-height: .8em;
    color: green;
    display: inline-block;
    white-space: nowrap;
    padding: 8px 8px;
    border: 1px solid green;
    margin: 3px 3px 0 0;
    border-radius: 10px;
    text-decoration: none;
}
</style>
<?php
global $data_view,$ot_html01;
$data_view = [];
function data_viewer(){
    global $data_view,$ot_html01;
    echo $ot_html01;
    $out_html = "<div class='tagcloud'>";
    foreach($data_view as $data_view_ot){
        $out_html .= "<a>".$data_view_ot[0].":".$data_view_ot[1]."</a>";
    }
    $out_html .= "</div>";
    echo $out_html;
    $data_view = [];
}
function add_data($add_data_1){
    global $data_view,$data;
    $data[] = $add_data_1;
    $data_view[] = $add_data_1;
}
function data_ref($key)
{
    global $data;
    foreach($data as $data_key){
        if($data_key[0] == $key){
            return $data_key[1];
        }
    }
    return "";
}
?>
<?php
            //発売日とメーカーのデータ
            //$data[] = ["sp-launch-0",''];
            $table_forcus_num = 0;
            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Network'){
                    $table_forcus_num = $i;
                }
            }
            
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            $before_ttl = '';
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Technology':
                        //通信技術
                        if($ot_html01->find('.nfo', $i)->plaintext != "N/A"){
                            add_data(["sp-band-8",$ot_html01->find('.nfo', $i)->plaintext]);
                        }
                        $before_ttl = 'Technology';
                        break;

                    case '2G bands':
                        //状態
                        $before_ttl = '2G bands';
                        if(!strpos($ot_html01->find('.nfo', $i)->plaintext,'N/A')){
                            //2Gテキスト
                            add_data(["sp-band-4",$ot_html01->find('.nfo', $i)->plaintext]);
                            //2G対応
                            add_data(["sp-band-0","Yes"]);
                            $ot = explode(" ",$ot_html01->find('.nfo', $i)->plaintext);
                            //HSDPA 850 / 900 / 1700(AWS) / 1900 / 2100
                            $forcus_ot_2g = [
                                ["sp-band-2g-gsm-400",["GSM",400]],
                                ["sp-band-2g-gsm-700",["GSM",700]],
                                ["sp-band-2g-gsm-800",["GSM",800]],
                                ["sp-band-2g-gsm-850",["GSM",850]],
                                ["sp-band-2g-gsm-900",["GSM",900]],
                                ["sp-band-2g-gsm-1700",["GSM",1700]],
                                ["sp-band-2g-gsm-1800",["GSM",1800]],
                                ["sp-band-2g-gsm-1900",["GSM",1900]],
                                ["sp-band-2g-gsm-2000",["GSM",2000]],
                                ["sp-band-2g-cdma-800",["CDMA",800]],
                                ["sp-band-2g-cdma-2000",["CDMA",2000]],
                                ["sp-band-2g-TD-SCDMA",["TD SCDMA",0]],
                            ];
                            if(count($ot) != 0){
                                $counter = count($ot);
                                if($ot[0] == "GSM"){
                                    for($n = 1 ;$n <= $counter; $n ++){//hsdpaをスキップ
                                    
                                        $ot[$n] = str_replace(',', '', $ot[$n]);
                                        if($ot[$n] != "/" && $ot[$n] != ''){//!is_numeric($ot[$n]) && $ot[$n] != 'Sub6' && $ot[$n] != "SA/NSA"
                                            $s = false;
                                            foreach($forcus_ot_2g as $data_ot){
                                                if($data_ot[1][0] == "GSM"){//hsdpa
                                                    if($data_ot[1][1] == $ot[$n]){
                                                        add_data([$data_ot[0],"Yes"]);
                                                        $s = true;
                                                        continue;
                                                    }                                                
                                                }
                                            }
                                            if(!$s)//一度も該当しなかった場合
                                                error_repo('2G bands',"2G band error".$ot[$n]);

                                        }else{
                                            //スラッシュの場合
                                        }    
                                    }
                                }else{
                                    error_repo('2G bands','一行目がGSMじゃないので認識できていません。');
                                }
                            }
                        }else{
                            //2G非対応
                            add_data(["sp-band-0","No"]);
                        }
                        break;

                    case '3G bands':
                        //状態
                        $before_ttl = '3G bands';
                        //example
                        /*
                        N/A
                        GSM 1800
                        GSM 850 / 900 / 1800 / 1900 - SIM 1 & SIM 2
                        GSM 850 / 900 / 1800 / 1900 - SIM 1 & SIM 2
                        CDMA 800
                        */
                        if(!strpos($ot_html01->find('.nfo', $i)->plaintext,'N/A')){
                            //3Gテキスト
                            add_data(["sp-band-5",$ot_html01->find('.nfo', $i)->plaintext]);
                            //3G対応
                            add_data(["sp-band-1","Yes"]);
                            $ot = explode(" ",$ot_html01->find('.nfo', $i)->plaintext);
                            //HSDPA 850 / 900 / 1700(AWS) / 1900 / 2100
                            $forcus_ot_3g = [
                                ["sp-band-3g-hsdpa-800",["HSDPA",800]],
                                ["sp-band-3g-hsdpa-850",["HSDPA",850]],
                                ["sp-band-3g-hsdpa-900",["HSDPA",900]],
                                ["sp-band-3g-hsdpa-1000",["HSDPA",1000]],
                                ["sp-band-3g-hsdpa-1700",["HSDPA",1700]],
                                ["sp-band-3g-hsdpa-1700-aws",["HSDPA",'1700(AWS)']],
                                ["sp-band-3g-hsdpa-1500",["HSDPA",1500]],
                                ["sp-band-3g-hsdpa-1900",["HSDPA",1900]],
                                ["sp-band-3g-hsdpa-2100",["HSDPA",2100]],
                                ["sp-band-3g-cdma2000-1xev-do",["CDMA2000",'1xEV-DO']],
                            ];
                            if(count($ot) != 0){
                                $counter = count($ot);
                                if($ot[0] == "HSDPA"){
                                    for($n = 1 ;$n <= $counter; $n ++){//hsdpaをスキップ
                                    
                                        $ot[$n] = str_replace(',', '', $ot[$n]);
                                        if($ot[$n] != "/" && $ot[$n] != ''){//!is_numeric($ot[$n]) && $ot[$n] != 'Sub6' && $ot[$n] != "SA/NSA"
                                            $s = false;
                                            foreach($forcus_ot_3g as $data_ot){
                                                if($data_ot[1][0] == "HSDPA"){//hsdpa
                                                    if($data_ot[1][1] == $ot[$n]){
                                                        add_data([$data_ot[0],"Yes"]);
                                                        $s = true;
                                                        continue;
                                                    }                                                
                                                }
                                            }
                                            if(!$s)//一度も該当しなかった場合
                                                error_repo('3G bands',"3G band error".$ot[$n]);
                                                
                                        }else{
                                            //スラッシュの場合
                                        }    
                                    }
                                }else{
                                    error_repo('3G bands','一行目がHSDPAじゃないので認識できていません。');
                                }
                            }
                        }else{
                            //3G非対応
                            add_data(["sp-band-1","No"]);
                        }
                        break;

                    case '4G bands':
                        //4Gのバンド
                        //ex.1, 3, 28, 41, 78, 79 SA/NSA
                        $before_ttl = '4G bands';
                        //N/Sじゃない場合は保存、各バンドごとに対応していればYesを格納していく
                        if(!strpos($ot_html01->find('.nfo', $i)->plaintext,'N/A')){
                            //4Gテキスト
                            add_data(["sp-band-6",$ot_html01->find('.nfo', $i)->plaintext]);
                            //4G対応
                            add_data(["sp-band-6",$ot_html01->find('.nfo', $i)->plaintext]);
                            $ot = explode(" ",$ot_html01->find('.nfo', $i)->plaintext);
                            $forcus_ot_4g = [
                                ['sp-band-4g-1',1],['sp-band-4g-2',2],['sp-band-4g-3',3],
                                ['sp-band-4g-4',4],['sp-band-4g-5',5],['sp-band-4g-6',6],
                                ['sp-band-4g-7',7],['sp-band-4g-8',8],['sp-band-4g-10',10],
                                ['sp-band-4g-11',11],['sp-band-4g-12',12],['sp-band-4g-13',13],
                                ['sp-band-4g-14',14],['sp-band-4g-17',17],['sp-band-4g-18',18],
                                ['sp-band-4g-19',19],['sp-band-4g-20',20],['sp-band-4g-21',21],
                                ['sp-band-4g-22',22],['sp-band-4g-23',23],['sp-band-4g-24',24],
                                ['sp-band-4g-25',25],['sp-band-4g-26',26],['sp-band-4g-27',27],
                                ['sp-band-4g-28',28],['sp-band-4g-29',29],['sp-band-4g-30',30],
                                ['sp-band-4g-31',31],['sp-band-4g-32',32],['sp-band-4g-33',33],
                                ['sp-band-4g-34',34],['sp-band-4g-35',35],['sp-band-4g-36',36],
                                ['sp-band-4g-37',37],['sp-band-4g-38',38],['sp-band-4g-39',39],
                                ['sp-band-4g-40',40],['sp-band-4g-41',41],['sp-band-4g-42',42],
                                ['sp-band-4g-43',43],['sp-band-4g-44',44],['sp-band-4g-45',45],
                                ['sp-band-4g-46',46],['sp-band-4g-47',47],['sp-band-4g-48',48],
                                ['sp-band-4g-49',49],['sp-band-4g-50',50],['sp-band-4g-51',51],
                                ['sp-band-4g-52',52],['sp-band-4g-65',65],['sp-band-4g-66',66],
                                ['sp-band-4g-67',67],['sp-band-4g-68',68],['sp-band-4g-69',69],
                                ['sp-band-4g-70',70],['sp-band-4g-71',71],['sp-band-4g-72',72],
                                ['sp-band-4g-73',73],['sp-band-4g-74',74],['sp-band-4g-75',75],
                                ['sp-band-4g-76',76],['sp-band-4g-85',85],['sp-band-4g-252',252],
                                ['sp-band-4g-255',255]
                            ];
                            if(count($ot) != 0){
                                $counter = count($ot);
                                for($n = 0 ;$n <= $counter; $n ++){//count($ot)
                                    $ot[$n] = str_replace(',', '', $ot[$n]);
                                    if(!is_numeric($ot[$n]) && $ot[$n] != 'Sub6' && $ot[$n] != "SA/NSA")
                                        error_repo('4G bands',"4G band error".$ot[$n]);
                                        
                                    //$forcus_counter = count($forcus_ot);
                                    foreach($forcus_ot_4g as $data_ot){
                                        if($data_ot[1] == $ot[$n]){
                                            $data[] = [$data_ot[0],"Yes"];
                                            $data_view[] = [$data_ot[0],"Yes"];
                                            continue;
                                        }
                                    }
                                }
                            }
                        }else{
                            //4G非対応
                            add_data(["sp-band-2","No"]);
                        }
                        break;

                    case '5G bands':
                        //5Gのバンド
                        $before_ttl = '5G bands';
                        //ex.1, 3, 28, 41, 78, 79 SA/NSA
                        //N/Sじゃない場合は保存、各バンドごとに対応していればYesを格納していく
                        if(strpos($ot_html01->find('.nfo', $i)->plaintext,'N/A') === false){
                            //5Gテキスト
                            add_data(["sp-band-7",$ot_html01->find('.nfo', $i)->plaintext]);
                            //5G対応
                            add_data(["sp-band-3","Yes"]);
                            $ot = explode(" ",$ot_html01->find('.nfo', $i)->plaintext);
                            $forcus_ot_5g = [
                                ['sp-band-5g-n1',1],['sp-band-5g-n2',2],['sp-band-5g-n3',3],
                                ['sp-band-5g-n5',5],['sp-band-5g-n7',7],['sp-band-5g-n8',8],
                                ['sp-band-5g-n12',12],['sp-band-5g-n14',14],['sp-band-5g-n18',18],
                                ['sp-band-5g-n20',20],['sp-band-5g-n25',25],['sp-band-5g-n28',28],
                                ['sp-band-5g-n29',29],['sp-band-5g-n30',30],['sp-band-5g-n34',34],
                                ['sp-band-5g-n38',38],['sp-band-5g-n39',39],['sp-band-5g-n40',40],
                                ['sp-band-5g-n41',41],['sp-band-5g-n48',48],['sp-band-5g-n50',50],
                                ['sp-band-5g-n51',51],['sp-band-5g-n65',65],['sp-band-5g-n66',66],
                                ['sp-band-5g-n70',70],['sp-band-5g-n71',71],['sp-band-5g-n74',74],
                                ['sp-band-5g-n75',75],['sp-band-5g-n76',76],['sp-band-5g-n77',77],
                                ['sp-band-5g-n78',78],['sp-band-5g-n79',79],['sp-band-5g-n80',80],
                                ['sp-band-5g-n81',81],['sp-band-5g-n82',82],['sp-band-5g-n83',83],
                                ['sp-band-5g-n84',84],['sp-band-5g-n86',86],['sp-band-5g-n89',89],
                                ['sp-band-5g-n90',90],['sp-band-5g-n257',257],['sp-band-5g-n258',258],
                                ['sp-band-5g-n260',260],['sp-band-5g-n261',261]
                            ];
                            if(count($ot) != 0){
                                $counter = count($ot);
                                for($n = 0 ;$n <= $counter; $n ++){//count($ot)
                                    $ot[$n] = str_replace(',', '', $ot[$n]);
                                    if(!is_numeric($ot[$n]) && $ot[$n] != 'Sub6' && $ot[$n] != "SA/NSA")
                                        error_repo('5G bands',"5G band error".$ot[$n]);
                                        
                                    foreach($forcus_ot_5g as $data_ot){
                                        if($data_ot[1] == $ot[$n]){
                                            if(!in_array ([$data_ot[0],"Yes"] , $data)){
                                                add_data([$data_ot[0],"Yes"]);
                                            }
                                            continue;
                                        }
                                    }
                                }
                            }
                        }else{
                            //5G非対応
                            add_data(["sp-band-3","No"]);
                        }
                        
                        break;

                    case 'Speed':
                        //速度
                        //N/Aじゃなければ保存、そもそもSpeedがない場合は保存されない。
                        $before_ttl = 'Speed';
                        if(!strpos($ot_html01->find('.nfo', $i)->plaintext,'N/A')){
                            //速度テキスト
                            add_data(["sp-band-9",$ot_html01->find('.nfo', $i)->plaintext]);
                        }
                        break;

                    case '&nbsp;':
                        //二行目の場合
                        switch($before_ttl){
                            case "2G bands":
                                $overwrite = "";
                                $overwrite_num = 0;
                                if($ot_html01->find('.nfo', $i)->plaintext != ""){
                                    foreach($data as $data_ot){
                                        if($data_ot[0] == "sp-band-4"){
                                            $data[$overwrite_num] = ['sp-band-4',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            $data_view[] = ['sp-band-4',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            continue;
                                        }else{
                                            $overwrite_num++;
                                        }
                                    }
                                }else{
                                    //二行目以降が空の場合
                                }
                                break;

                            case "3G bands":
                                $overwrite = "";
                                $overwrite_num = 0;
                                if($ot_html01->find('.nfo', $i)->plaintext != ""){
                                    foreach($data as $data_ot){
                                        if($data_ot[0] == "sp-band-5"){
                                            $data[$overwrite_num] = ['sp-band-5',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            $data_view[] = ['sp-band-5',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            continue;
                                        }else{
                                            $overwrite_num++;
                                        }
                                    }
                                }else{
                                    //二行目以降が空の場合
                                }
                                break;

                            case "4G bands":
                                $overwrite = "";
                                $overwrite_num = 0;
                                if($ot_html01->find('.nfo', $i)->plaintext != ""){
                                    foreach($data as $data_ot){
                                        if($data_ot[0] == "sp-band-6"){
                                            $data[$overwrite_num] = ['sp-band-6',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            $data_view[] = ['sp-band-6',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            continue;
                                        }else{
                                            $overwrite_num++;
                                        }
                                    }
                                }else{
                                    //二行目以降が空の場合
                                }
                                break;

                            case "5G bands":
                                $overwrite = "";
                                $overwrite_num = 0;
                                if($ot_html01->find('.nfo', $i)->plaintext != ""){
                                    foreach($data as $data_ot){
                                        if($data_ot[0] == "sp-band-7"){
                                            $data[$overwrite_num] = ['sp-band-7',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            $data_view[] = ['sp-band-7',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            continue;
                                        }else{
                                            $overwrite_num++;
                                        }
                                    }
                                }else{
                                    //二行目以降が空の場合
                                }
                                break;
                            
                            case "Technology":
                                break;
                            
                            case "Speed":
                                break;
                                
                            default:
                                break;
                        }
                        break;

                    default:
                        error_repo('Network','out of index(('.$ot_html01->find('.nfo', $i)->plaintext);
                        echo $before_ttl;
                        if($before_ttl == ''){
                            echo 'empty 2nd line';
                        }
                        break;
                }
            }
            ?>
            <h2>ネットワーク</h2>            
            <h3>元の表</h3>
            <?php data_viewer();?>
            <h3>自動設定された表</h3>
            <table class='data-table'>
                <tr>
                    <th>技術</th>
                    <td><input type='text' name='sp-band-8' value="<?php echo data_ref('sp-band-8');?>"></td>
                </tr>
                <tr>
                    <th>速度</th>
                    <td><input type='text' name='sp-band-9' value="<?php echo data_ref('sp-band-9');?>"></td>
                </tr>
                <tr>
                    <th>バンド</th>
                    <td>
                        ・表示される5G<br><br>
                        <input type='text' name='sp-band-7' value="<?php echo data_ref('sp-band-7');?>"><br><br>

                        ・5G各バンド<br><br>
                        <?php 
                        $b5gs = [ 
                            ['sp-band-5g-n1',1],['sp-band-5g-n2',2],['sp-band-5g-n3',3],
                            ['sp-band-5g-n5',5],['sp-band-5g-n7',7],['sp-band-5g-n8',8],
                            ['sp-band-5g-n12',12],['sp-band-5g-n14',14],['sp-band-5g-n18',18],
                            ['sp-band-5g-n20',20],['sp-band-5g-n25',25],['sp-band-5g-n28',28],
                            ['sp-band-5g-n29',29],['sp-band-5g-n30',30],['sp-band-5g-n34',34],
                            ['sp-band-5g-n38',38],['sp-band-5g-n39',39],['sp-band-5g-n40',40],
                            ['sp-band-5g-n41',41],['sp-band-5g-n48',48],['sp-band-5g-n50',50],
                            ['sp-band-5g-n51',51],['sp-band-5g-n65',65],['sp-band-5g-n66',66],
                            ['sp-band-5g-n70',70],['sp-band-5g-n71',71],['sp-band-5g-n74',74],
                            ['sp-band-5g-n75',75],['sp-band-5g-n76',76],['sp-band-5g-n77',77],
                            ['sp-band-5g-n78',78],['sp-band-5g-n79',79],['sp-band-5g-n80',80],
                            ['sp-band-5g-n81',81],['sp-band-5g-n82',82],['sp-band-5g-n83',83],
                            ['sp-band-5g-n84',84],['sp-band-5g-n86',86],['sp-band-5g-n89',89],
                            ['sp-band-5g-n90',90],['sp-band-5g-n257',257],['sp-band-5g-n258',258],
                            ['sp-band-5g-n260',260],['sp-band-5g-n261',261]
                        ];
                        $out_txt = '';
                        foreach($b5gs as $b5g){
                            if(data_ref($b5g[0]) == 'Yes'){
                                echo '<input type="checkbox" name="'.$b5g[0].'" value="Yes" checked>'.$b5g[1];
                                $out_txt .= $b5g[1].', ';
                            }else{
                                echo '<input type="checkbox" name="'.$b5g[0].'" value="Yes">'.$b5g[1];
                            }
                        }
                        echo '<br><br>'.$out_txt;
                        ?><br><br>
                        ・表示される4G<br><br>
                        <input type='text' name='sp-band-6' value="<?php echo data_ref('sp-band-6');?>">
                        ・4G各バンド<br><br>
                        <?php
                        $b4gs = [
                            ['sp-band-4g-1',1],['sp-band-4g-2',2],['sp-band-4g-3',3],
                            ['sp-band-4g-4',4],['sp-band-4g-5',5],['sp-band-4g-6',6],
                            ['sp-band-4g-7',7],['sp-band-4g-8',8],['sp-band-4g-10',10],
                            ['sp-band-4g-11',11],['sp-band-4g-12',12],['sp-band-4g-13',13],
                            ['sp-band-4g-14',14],['sp-band-4g-17',17],['sp-band-4g-18',18],
                            ['sp-band-4g-19',19],['sp-band-4g-20',20],['sp-band-4g-21',21],
                            ['sp-band-4g-22',22],['sp-band-4g-23',23],['sp-band-4g-24',24],
                            ['sp-band-4g-25',25],['sp-band-4g-26',26],['sp-band-4g-27',27],
                            ['sp-band-4g-28',28],['sp-band-4g-29',29],['sp-band-4g-30',30],
                            ['sp-band-4g-31',31],['sp-band-4g-32',32],['sp-band-4g-33',33],
                            ['sp-band-4g-34',34],['sp-band-4g-35',35],['sp-band-4g-36',36],
                            ['sp-band-4g-37',37],['sp-band-4g-38',38],['sp-band-4g-39',39],
                            ['sp-band-4g-40',40],['sp-band-4g-41',41],['sp-band-4g-42',42],
                            ['sp-band-4g-43',43],['sp-band-4g-44',44],['sp-band-4g-45',45],
                            ['sp-band-4g-46',46],['sp-band-4g-47',47],['sp-band-4g-48',48],
                            ['sp-band-4g-49',49],['sp-band-4g-50',50],['sp-band-4g-51',51],
                            ['sp-band-4g-52',52],['sp-band-4g-65',65],['sp-band-4g-66',66],
                            ['sp-band-4g-67',67],['sp-band-4g-68',68],['sp-band-4g-69',69],
                            ['sp-band-4g-70',70],['sp-band-4g-71',71],['sp-band-4g-72',72],
                            ['sp-band-4g-73',73],['sp-band-4g-74',74],['sp-band-4g-75',75],
                            ['sp-band-4g-76',76],['sp-band-4g-85',85],['sp-band-4g-252',252],
                            ['sp-band-4g-255',255]
                        ];
                        $out_txt = '';
                        foreach($b4gs as $bg){
                            if(data_ref($bg[0]) == 'Yes'){
                                echo '<input type="checkbox" name="'.$bg[0].'" value="Yes" checked>'.$bg[1];
                                $out_txt .= $bg[1].', ';
                            }else{
                                echo '<input type="checkbox" name="'.$bg[0].'" value="Yes">'.$bg[1];
                            }
                        }
                        echo '<br><br>'.$out_txt;
                        ?><br><br>
                        ・表示される3G<br><br>
                        <input type='text' name='sp-band-5' value="<?php echo data_ref('sp-band-5');?>">
                        ・3G各バンド<br><br>
                        <?php
                        $b3gs = [
                            ["sp-band-3g-hsdpa-800",["HSDPA",800]],
                            ["sp-band-3g-hsdpa-850",["HSDPA",850]],
                            ["sp-band-3g-hsdpa-900",["HSDPA",900]],
                            ["sp-band-3g-hsdpa-1000",["HSDPA",1000]],
                            ["sp-band-3g-hsdpa-1700",["HSDPA",1700]],
                            ["sp-band-3g-hsdpa-1700-aws",["HSDPA",'1700(AWS)']],
                            ["sp-band-3g-hsdpa-1500",["HSDPA",1500]],
                            ["sp-band-3g-hsdpa-1900",["HSDPA",1900]],
                            ["sp-band-3g-hsdpa-2100",["HSDPA",2100]],
                            ["sp-band-3g-cdma2000-1xev-do",["CDMA2000",'1xEV-DO']],
                        ];
                        $out_txt = '';
                        foreach($b3gs as $bg){
                            if(data_ref($bg[0]) == 'Yes'){
                                echo '<input type="checkbox" name="'.$bg[0].'" value="Yes" checked>'.$bg[1][0].':'.$bg[1][1];
                                $out_txt .= $bg[1][0].':'.$bg[1][1].', ';
                            }else{
                                echo '<input type="checkbox" name="'.$bg[0].'" value="Yes">'.$bg[1][0].':'.$bg[1][1];
                            }
                        }
                        echo '<br><br>'.$out_txt;
                        ?><br><br>
                        ・表示される2G<br><br>
                        <input type='text' name='sp-band-4' value="<?php echo data_ref('sp-band-4');?>">
                        ・2G各バンド<br><br>
                        <?php
                        $b2gs = [
                            ["sp-band-2g-gsm-400",["GSM",400]],
                            ["sp-band-2g-gsm-700",["GSM",700]],
                            ["sp-band-2g-gsm-800",["GSM",800]],
                            ["sp-band-2g-gsm-850",["GSM",850]],
                            ["sp-band-2g-gsm-900",["GSM",900]],
                            ["sp-band-2g-gsm-1700",["GSM",1700]],
                            ["sp-band-2g-gsm-1800",["GSM",1800]],
                            ["sp-band-2g-gsm-1900",["GSM",1900]],
                            ["sp-band-2g-gsm-2000",["GSM",2000]],
                            ["sp-band-2g-cdma-800",["CDMA",800]],
                            ["sp-band-2g-cdma-2000",["CDMA",2000]],
                            ["sp-band-2g-TD-SCDMA",["TD SCDMA",0]],
                        ];
                        $out_txt = '';
                        foreach($b2gs as $bg){
                            if(data_ref($bg[0]) == 'Yes'){
                                echo '<input type="checkbox" name="'.$bg[0].'" value="Yes" checked>'.$bg[1][0].':'.$bg[1][1];
                                $out_txt .= $bg[1][0].':'.$bg[1][1].', ';
                            }else{
                                echo '<input type="checkbox" name="'.$bg[0].'" value="Yes">'.$bg[1][0].':'.$bg[1][1];
                            }
                        }
                        echo '<br><br>'.$out_txt;
                        ?><br><br>
                    </td>
                </tr>
            </table>    
            
<input type="submit" value="送信">
<div id="output_message"></div>
  <script language="javascript" type="text/javascript">
    function func1() {
      var formData = new FormData(document.forms.form1);
      formData.append("key1", "value1");
      for (item of formData) {
        console.log(item);
      }
      return false;
    }
  </script>
            <?php
            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Launch'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Announced':
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        $month = "";
                        $day = "";
                        $year = "";
                        $month_r = "";
                        $day_r = "";
                        $year_r = "";
                        if(strpos($plaintext,'Released') !== false){//Released [2016, March. Released 2016, April][2016, March 11. Released 2016, April 11]
                            if(mb_strpos($plaintext,"Released") != 0){
                                $ot = explode("Released ",$plaintext);
                                $conter = count($ot);
                                for($n = 0 ;$n <= $counter; $n ++){//.を取り除く
                                    $ot[$n] = str_replace('.', '', $ot[$n]);
                                }
                                $ot2 = explode(', ',$ot[0]);//$ot[0] = [2016, March ][2016, March 11 ]
                                if(array_key_exists(1, $ot2)){
                                    if($ot2[1] != " " && $ot2[1] != ""){
                                        $month = str_replace(' ', '', $ot2[1]);//$ot2 = ['2016','March '],['2016','March ','11 ']
                                    }
                                }
                                if(array_key_exists(2, $ot2)){
                                    if($ot2[2] != " " && $ot2[2] != ""){
                                        $day = str_replace(' ', '', $ot2[2]);//$ot2 = ['2016','March '],['2016','March ','11 ']
                                    }
                                }
                                $year = $ot2[0];//$ot2 = ['2016','March '],['2016','March ','11 ']
                                //$Released = $ot[1]
                                $Released = $ot[1];
                                $ot3 = explode(", ",$Released);
                                $year_r = $ot3[0];
                                if(strpos($ot3[1],' ') !== false){
                                    $ot4 = explode(" ",$ot3[1]);//['April']['April 11']
                                    $day_r = $ot4[1];
                                    $month_r = $ot4[0];
                                }else{
                                    $month_r = $ot3[1];
                                }
                            }else{
                                //Releasedから始まった場合
                                $Released = str_replace('Released ', '', $plaintext);//$Released['2016, April']['2016, April 11']
                                $ot3 = explode(", ",$Released);
                                $year_r = $ot3[0];
                                if(strpos($ot3[1],' ') !== false){
                                    $ot4 = explode(" ",$ot3[1]);//['April']['April 11']
                                    $day_r = $ot4[1];
                                    $month_r = $ot4[0];
                                }else{
                                    $month_r = $ot3[1];
                                }
                            }
                        }elseif($plaintext == "Not announced yet"){
                            //未発表
                            break;
                        }else{//通常時["2019, February 20"]["2019, February"]

                            $ot5 = explode(", ",$plaintext);
                            $year = $ot5[0];
                            if(strpos($ot5[1],' ') !== false){
                                $ot6 = explode(" ",$ot5[1]);//['February 20']['February']
                                $day = $ot6[1];
                                $month = $ot6[0];
                            }else{
                                $month = $ot5[1];
                            }                            
                        }
                        //発表~sp-launch-1~
                        //2019, February 20
                        //Not announced yet
                        $month = month_str_to_num($month);
                        $month_r = month_str_to_num($month_r);
                        if($month == false)
                            $month = "";

                        if($month_r == false)
                            $month_r = "";

                        if($month != "" && $day != "" && $year != ""){
                            //年月日
                            add_data(["sp-launch-1",$year."-".$month."-".$day]);
                        }elseif($month != "" && $day == "" && $year != ""){
                            //年月
                            add_data(["sp-launch-1",$year."-".$month]);
                        }elseif($month == "" && $day == "" && $year != ""){
                            //年のみ
                            add_data(["sp-launch-1",$year]);
                        }else{
                            //全部ない場合
                        }
                        
                        if($month_r != "" && $day_r != "" && $year_r != ""){
                            //年月日
                            add_data(["sp-launch-2",$year_r."-".$month_r."-".$day_r]);
                        }elseif($month_r != "" && $day_r == "" && $year_r != ""){
                            //年月
                            add_data(["sp-launch-2",$year_r."-".$month_r]);
                        }elseif($month_r == "" && $day_r == "" && $year_r != ""){
                            //年のみ
                            add_data(["sp-launch-2",$year_r]);
                        }else{
                            //全部ない場合
                        }
                        break;

                    case 'Status':
                        //状態
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        //Discontinued
                        //既にRelesedがある場合は発表日はスキップ
                        //Rumored
                        //Available. Released 2021, January 29
                        if($plaintext == "Discontinued"){//生産終了の場合はそのまま終了
                            echo 'Discontinued';
                            break;
                        }
                        if($plaintext == 'Rumored'){//噂というか、リークの場合
                            echo 'Rumored';
                            add_data(["sp-launch-12",'Yes']);
                            break;
                        }
                        if(strpos($plaintext,'Coming soon') !== false){//Coming soon. Exp. release 2021, July 
                            echo 'Coming soon';
                            if(strpos($plaintext,'Exp') !== false){//Expp[release 2021, Q2]
                                add_data(["sp-launch-12",explode("release ",$plaintext)[1]]);
                            }
                            break;
                        }
                        if(strpos($plaintext,'Available') !== false){//Available. Released 2021, January 29
                            if(strpos($plaintext,'Released') !== false){//Released 2021, January 29
                                
                                if(is_data_key("sp-launch-2")){
                                    echo "sp-launch-2 is exists";
                                    break;
                                }else{
                                    $plaintext = str_replace('Available. Released ','',$plaintext);//2021, January 29
                                    $ot1 = explode(", ",$plaintext);
                                    $month = "";
                                    $year = $ot1[0];
                                    $day = '';
                                    
                                    if(array_key_exists(1, $ot1)){
                                        if(strpos($ot1[1],' ') !== false){
                                            
                                            $ot2 = explode(" ",$ot1[1]);
                                            if(is_numeric(month_str_to_num($ot2[0]))){
                                                $month = month_str_to_num($ot2[0]);
                                            }
                                            if(is_numeric($ot2[1])){
                                                $day = $ot2[1];
                                            }
                                        }else{
                                            if(is_numeric(month_str_to_num($ot1[0]))){
                                                $month = month_str_to_num($ot1[0]);
                                            } 
                                        }
                                    }
                                    if($month != "" && $day != ""){
                                        //年月日
                                        add_data(["sp-launch-2",$year."-".$month."-".$day]);
                                    }elseif($month != "" && $day == ""){
                                        //年月
                                        add_data(["sp-launch-2",$year."-".$month]);
                                    }else{
                                        //年のみ
                                        add_data(["sp-launch-2",$year]);
                                    }
                                }
                            }//Releasedがあるばあい
                            break;
                        }
                        error_repo('Status',$plaintext);
                        break;
                    
                    default:
                        //echo 'Speed';
                        error_repo('LAUNCH','out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>");
                        echo 'empty 2nd line';
                        break;
                }
            }
            data_viewer();
            ?>
            
            <table class='data-table'>
                <tr>
                    <th>発表日</th>
                    <td><input type='text' name='sp-launch-1' value="<?php echo data_ref('sp-launch-1');?>"></td>
                </tr>
                <tr>
                    <th>発売日</th>
                    <td><input type='text' name='sp-launch-2' value="<?php echo data_ref('sp-launch-2');?>"></td>
                </tr>
                <tr>
                    <th>未発表の場合の期待される発表日</th>
                    <td><input type='text' name='sp-launch-13' value=""></td>
                </tr>
                <tr>
                    <th>細かいやつら</th>
                    <td>
                        <input type="checkbox" name="sp-launch-15" value="Yes">これがメイン表示の場合
                        <input type="checkbox" name="sp-launch-12" value="Yes">リーク
                        <input type="checkbox" name="sp-launch-14" value="Yes" <?php if(data_ref('sp-launch-2') == 'Yes')echo 'checked';?>>日本で発売されたやつ
                    </td>
                </tr>
                <tr>
                    <th>端末id(一意のid)</th>
                    <td><input type='text' name='sp-launch-9' value=""></td>
                </tr>
                <tr>
                    <th>メインiD</th>
                    <td><input type='text' name='sp-launch-11' value=""></td>
                </tr>
                <tr>
                    <th>関連スマホ</th>
                    <td><input type='text' name='sp-launch-10' value=""></td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Body'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            $before_ttl = '';
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Dimensions'://-
                        //サイズ
                        $before_ttl = 'Dimensions';
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        if($plaintext !=  "-"){
                            if(strpos($plaintext,'mm') !== false){//mmな場合 https://paiza.io/projects/fCSe7yXp79DD8Pvu1KYdUg?language=php
                                $plaintext = substr($plaintext, 0, strcspn($plaintext,'mm'));//165.1 x 75.6 x 8.9ここ以降を消す mm (6.5 x 2.98 x 0.35 in)
                                $ot = explode(" x ",$plaintext);
                                $counter =count($ot);
                                for($n ;$n <= $counter; $n++){
                                    $ot[$n] = str_replace(' ','',$ot[$n]);
                                    if(is_numeric($ot_ot)){
                                        //seijou
                                    }else{
                                        error_repo('Dimensions','Flag 3');
                                        break;
                                    }
                                }
                                add_data(['sp-design-0',$ot[0]]);//tate
                                add_data(['sp-design-4',$ot[1]]);//yoko
                                add_data(['sp-design-5',$ot[2]]);//atumi
                            }
                        }else{
                            //空の場合終わる
                            break;
                        }
                        break;

                    case 'Weight':
                        //重さ
                        $before_ttl = 'Weight';
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        if($plaintext !=  "-"){
                            if(strpos($plaintext,'g') !== false){//mmな場合 https://paiza.io/projects/fCSe7yXp79DD8Pvu1KYdUg?language=php
                                $plaintext = substr($plaintext, 0, strcspn($plaintext,'g'));//165.1 x 75.6 x 8.9ここ以降を消す mm (6.5 x 2.98 x 0.35 in)
                                $plaintext = str_replace(' ','',$plaintext);
                                if(is_numeric($plaintext)){
                                    //seijou
                                    add_data(['sp-design-1',$plaintext]);
                                }else{
                                    error_repo('Weight',$plaintext);
                                    break;
                                }
                            }else{
                                error_repo('Weight',$plaintext);
                            }
                        }else{
                            //空の場合終わる
                            break;
                        }
                        
                        break;

                    case 'Build':
                        //素材とか
                        $before_ttl = 'Build';
                        add_data(['sp-design-2',$ot_html01->find('.nfo', $i)->plaintext]);
                        //手動で変更が必要
                        break;

                    case 'SIM'://sp-network-3スロット
                        //3スロット(nano sim × 2 sdカード)
                        //sp-network-7 dual stand by
                        $before_ttl = 'SIM';
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        add_data(["sp-network-3",$plaintext]);
                        if(strpos($plaintext,'dual stand-by') !== false){
                            add_data(["sp-network-7",'Yes']);
                        }
                        break;
                    
                    default:
                        switch($before_ttl){
                            case 'Dimensions'://-
                                //サイズ
                                error_repo('Dimensions','2nd and subsequent lines');
                                break;
    
                            case 'Weight':
                                //重さ
                                error_repo('Weight','2nd and subsequent lines');
                                break;
    
                            case 'Build':
                                //素材とか
                                $overwrite_num = 0;
                                if($ot_html01->find('.nfo', $i)->plaintext != ""){
                                    foreach($data as $data_ot){
                                        if($data_ot[0] == "sp-design-2"){
                                            $data[$overwrite_num] = ['sp-design-2',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            $data_view[] = ['sp-design-2',$data_ot[1].':'.$ot_html01->find('.nfo', $i)->plaintext];
                                            continue;
                                        }else{
                                            $overwrite_num++;
                                        }
                                    }
                                }else{
                                    //二行目以降が空の場合
                                }
                                break;
    
                            case 'SIM':
                                //状態
                                error_repo('SIM','2nd and subsequent lines');
                                $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                                if(strpos($plaintext,'IP') !== false){
                                    add_data(["sp-extra-6",'Yes']);
                                    //53 68 67 65 68
                                    $after_set[] = "防水防塵";
                                }
                                break;
                        
                            default:
                            echo 'empty 2nd line';
                                break;
                        }
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();
            ?>
            <table class='data-table'>
                <tr>
                    <th>重さ</th>
                    <td><input type='text' name='sp-design-1' value="<?php echo data_ref('sp-design-1');?>"></td>
                </tr>
                <tr>
                    <th>縦</th>
                    <td><input type='text' name='sp-design-0' value="<?php echo data_ref('sp-design-0');?>"></td>
                </tr>
                <tr>
                    <th>横</th>
                    <td><input type='text' name='sp-design-4' value="<?php echo data_ref('sp-design-4');?>"></td>
                </tr>
                <tr>
                    <th>厚み</th>
                    <td><input type='text' name='sp-design-5' value="<?php echo data_ref('sp-design-5');?>"></td>
                </tr>
                <tr>
                    <th>素材</th>
                    <td><input type='text' name='sp-design-2' value="<?php echo data_ref('sp-design-2');?>"></td>
                </tr>
                <tr>
                    <th>SIM</th>
                    <td><input type='text' name='sp-network-3' value="<?php echo data_ref('sp-network-3');?>"></td>
                </tr>
                <tr>
                    <th>SIMカスタムtxt</th>
                    <td><input type='text' name='sp-network-8' value="<?php echo data_ref('sp-network-8');?>"></td>
                </tr>
                <tr>
                    <th>Dual stand by</th>
                    <td><input type="checkbox" name="sp-network-7" value="Yes"<?php if(data_ref('sp-network-7') == 'Yes')echo ' checked';?>>対応</td>
                </tr>
                <tr>
                    <th>防水防塵</th>
                    <td>
                        <input type="checkbox" name="sp-extra-6" value="Yes"<?php if(data_ref('sp-extra-6') == 'Yes')echo ' checked';?>>防水防塵対応
                        <input type="checkbox" name="sp-extra-11" value="Yes"<?php if(data_ref('sp-extra-11') == 'Yes')echo ' checked';?>>IP 6X
                        <input type="checkbox" name="sp-extra-12" value="Yes"<?php if(data_ref('sp-extra-12') == 'Yes')echo ' checked';?>>IP 5X
                        <input type="checkbox" name="sp-extra-13" value="Yes"<?php if(data_ref('sp-extra-13') == 'Yes')echo ' checked';?>>IP 4X
                        <input type="checkbox" name="sp-extra-14" value="Yes"<?php if(data_ref('sp-extra-14') == 'Yes')echo ' checked';?>>IP 3X
                        <input type="checkbox" name="sp-extra-15" value="Yes"<?php if(data_ref('sp-extra-15') == 'Yes')echo ' checked';?>>IP 2X
                        <input type="checkbox" name="sp-extra-16" value="Yes"<?php if(data_ref('sp-extra-16') == 'Yes')echo ' checked';?>>IP 1X
                        <input type="checkbox" name="sp-extra-17" value="Yes"<?php if(data_ref('sp-extra-17') == 'Yes')echo ' checked';?>>IP 0X
                        <input type="checkbox" name="sp-extra-18" value="Yes"<?php if(data_ref('sp-extra-18') == 'Yes')echo ' checked';?>>IP X0
                        <input type="checkbox" name="sp-extra-19" value="Yes"<?php if(data_ref('sp-extra-19') == 'Yes')echo ' checked';?>>IP X1
                        <input type="checkbox" name="sp-extra-20" value="Yes"<?php if(data_ref('sp-extra-20') == 'Yes')echo ' checked';?>>IP X2
                        <input type="checkbox" name="sp-extra-21" value="Yes"<?php if(data_ref('sp-extra-21') == 'Yes')echo ' checked';?>>IP X3
                        <input type="checkbox" name="sp-extra-22" value="Yes"<?php if(data_ref('sp-extra-22') == 'Yes')echo ' checked';?>>IP X4
                        <input type="checkbox" name="sp-extra-23" value="Yes"<?php if(data_ref('sp-extra-23') == 'Yes')echo ' checked';?>>IP X5
                        <input type="checkbox" name="sp-extra-24" value="Yes"<?php if(data_ref('sp-extra-24') == 'Yes')echo ' checked';?>>IP X6
                        <input type="checkbox" name="sp-extra-25" value="Yes"<?php if(data_ref('sp-extra-25') == 'Yes')echo ' checked';?>>IP X7
                        <input type="checkbox" name="sp-extra-26" value="Yes"<?php if(data_ref('sp-extra-26') == 'Yes')echo ' checked';?>>IP X8
                        <input type="checkbox" name="sp-extra-27" value="Yes"<?php if(data_ref('sp-extra-27') == 'Yes')echo ' checked';?>>MIL-STD-810G
                        <input type="checkbox" name="sp-extra-29" value="Yes"<?php if(data_ref('sp-extra-29') == 'Yes')echo ' checked';?>>MIL-STD-810F
                        <input type="checkbox" name="sp-extra-30" value="Yes"<?php if(data_ref('sp-extra-30') == 'Yes')echo ' checked';?>>MIL-STD-810D
                        
                    </td>
                </tr>
                <tr>
                    <th>IPカスタムtxt</th>
                    <td><input type='text' name='sp-extra-7' value="<?php echo data_ref('sp-extra-7');?>"></td>
                </tr>
                <tr>
                    <th>P2i撥水</th>
                    <td><input type="checkbox" name="sp-extra-10" value="Yes"<?php if(data_ref('sp-extra-10') == 'Yes')echo ' checked';?>></td>
                </tr>
                <tr>
                    <th>その他のやつ</th>
                    <td>
                        <input type="checkbox" name="sp-extra-28" value="Yes"<?php if(data_ref('sp-extra-28') == 'Yes')echo ' checked';?>>Apple Pay
                        <input type="checkbox" name="sp-extra-31" value="Yes"<?php if(data_ref('sp-extra-31') == 'Yes')echo ' checked';?>>ポップアップゲーミングボタン
                        <input type="checkbox" name="sp-extra-32" value="Yes"<?php if(data_ref('sp-extra-32') == 'Yes')echo ' checked';?>>スタイラスペン対応
                        <input type="checkbox" name="sp-extra-33" value="Yes"<?php if(data_ref('sp-extra-33') == 'Yes')echo ' checked';?>>プロ・ショルダー・トリガー3.0(400Hz)
                    </td>
                </tr>
            </table>
            <?php
            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Display'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                DISPLAY	    Type	    Super AMOLED, 120Hz, HDR10+, 700 nits (HBM), 1100 nits (peak)
                            Size	    5.9 inches, 84.0 cm2 (~82.9% screen-to-body ratio)
                            Resolution	1080 x 2400 pixels, 20:9 ratio (~446 ppi density)
                            Protection	Corning Gorilla Glass Victus
                                        Always-on display

                DISPLAY	    Type	    Dynamic AMOLED 2X, 120Hz, HDR10+
                            Size    	6.9 inches, 116.7 cm2 (~91.7% screen-to-body ratio)
                            Resolution	1440 x 3088 pixels (~496 ppi density)
                            Protection	Corning Gorilla Glass Victus
                                        Always-on display
                                        120Hz@FHD/60Hz@QHD refresh rate

                DISPLAY	    Type	    OLED, 1B colors, 240Hz, HDR10, Dolby Vision
                            Size	    6.4 inches, 100.5 cm2 (~86.0% screen-to-body ratio)
                            Resolution	1080 x 2340 pixels, 19.5:9 ratio (~403 ppi density)
                            Protection	Corning Gorilla Glass 6

                DISPLAY	    Type	    AMOLED, 90Hz
                            Size	    6.67 inches, 105.6 cm2
                            Resolution	1080 x 2460 pixels (~403 ppi density)

                DISPLAY	    Type	    IPS LCD
                            Size	    6.82 inches, 112.3 cm2 (~83.4% screen-to-body ratio)
                            Resolution	720 x 1640 pixels, 20:9 ratio (~257 ppi density)

                DISPLAY	    Type	    Foldable OLED, 90Hz
                            Size	    8.0 inches, 205.0 cm2 (~86.9% screen-to-body ratio)
                            Resolution	2200 x 2480 pixels (~414 ppi density)
                                        Cover display:
                                        OLED, 90Hz, 6.45 inches, 1160 x 2700 pixels

                DISPLAY	    Type	    AMOLED, 1B colors, 120Hz, HDR10+, Dolby Vision, 900 nits (HBM), 1700 nits (peak)
                            Size	    6.81 inches, 112.0 cm2 (~91.4% screen-to-body ratio)
                            Resolution	1440 x 3200 pixels, 20:9 ratio (~515 ppi density)
                            Protection	Corning Gorilla Glass Victus

                DISPLAY	    Type	    Foldable AMOLED, 1B colors, HDR10+, Dolby Vision, 600 nits (typ), 900 nits (peak)
                            Size	    8.01 inches, 198.7 cm2 (~85.9% screen-to-body ratio)
                            Resolution	1860 x 2480 pixels, 4:3 ratio (~387 ppi density)
                                        Cover display:
                                        AMOLED, 90Hz, HDR10+, Dolby Vision, 650 nits (typ), 900 nits (peak)
                                        6.52 inches, 840 x 2520 pixels, 27:9 ratio
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Type':
                        //
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        $plaintexts = explode(', ',$plaintext);
                        break;

                    case 'Size':
                        //
                        
                        break;

                    case 'Resolution':
                        //
                        
                        break;

                    case 'Protection':
                        //
                        
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();
            ?>
            <table class='data-table'>
                <tr>
                    <th>パネル種類（カスタムテキスト）</th>
                    <td><input type='text' name='sp-screen-3' value="<?php echo data_ref('sp-screen-3');?>"></td>
                </tr>
                <tr>
                    <th>画面補足情報（セカンドディスプレイなど）</th>
                    <td><input type='text' name='sp-screen-13' value="<?php echo data_ref('sp-screen-13');?>"></td>
                </tr>
                <tr>
                    <th>画面保護</th>
                    <td><input type='text' name='sp-screen-0' value="<?php echo data_ref('sp-screen-0');?>"></td>
                </tr>
                <tr>
                    <th>インチ</th>
                    <td><input type='text' name='sp-screen-1' value="<?php echo data_ref('sp-screen-1');?>"></td>
                </tr>
                <tr>
                    <th>リフレッシュレート</th>
                    <td><input type='text' name='sp-screen-8' value="<?php echo data_ref('sp-screen-8');?>"></td>
                </tr>
                <tr>
                    <th>タッチレート</th>
                    <td><input type='text' name='sp-screen-9' value="<?php echo data_ref('sp-screen-9');?>"></td>
                </tr>
                <tr>
                    <th>輝度typ</th>
                    <td><input type='text' name='sp-screen-15' value="<?php echo data_ref('sp-screen-15');?>"></td>
                </tr>
                <tr>
                    <th>最大輝度peak</th>
                    <td><input type='text' name='sp-screen-11' value="<?php echo data_ref('sp-screen-11');?>"></td>
                </tr>
                <tr>
                    <th>画面占有率</th>
                    <td><input type='text' name='sp-screen-14' value="<?php echo data_ref('sp-screen-14');?>"></td>
                </tr>
                <tr>
                    <th>縦px</th>
                    <td><input type='text' name='sp-screen-16' value="<?php echo data_ref('sp-screen-16');?>"></td>
                </tr>
                <tr>
                    <th>横px</th>
                    <td><input type='text' name='sp-screen-4' value="<?php echo data_ref('sp-screen-4');?>"></td>
                </tr>
                <tr>
                    <th>アスペクト比縦</th>
                    <td><input type='text' name='sp-screen-2' value="<?php echo data_ref('sp-screen-2');?>"></td>
                </tr>
                <tr>
                    <th>アスペクト比横</th>
                    <td><input type='text' name='sp-screen-17' value="<?php echo data_ref('sp-screen-17');?>"></td>
                </tr>
                <tr>
                    <th>DPI</th>
                    <td><input type='text' name='sp-screen-6' value="<?php echo data_ref('sp-screen-6');?>"></td>
                </tr>
                <tr>
                    <th>表示色</th>
                    <td><input type='text' name='sp-screen-21' value="<?php echo data_ref('sp-screen-21');?>"></td>
                </tr>
                <tr>
                    <th>コントラスト比</th>
                    <td><input type='text' name='sp-screen-10' value="<?php echo data_ref('sp-screen-10');?>"></td>
                </tr>
                <tr>
                    <th>湾曲ディスプレイの場合の角度</th>
                    <td><input type='text' name='sp-screen-40' value="<?php echo data_ref('sp-screen-40');?>"></td>
                </tr>
                <tr>
                    <th>インカメラタイプ</th>
                    <td>
                        <input type="checkbox" name="sp-screen-29" value="Yes"<?php if(data_ref('sp-screen-29') == 'Yes')echo ' checked';?>>ノッチ
                        <input type="checkbox" name="sp-screen-30" value="Yes"<?php if(data_ref('sp-screen-30') == 'Yes')echo ' checked';?>>スライドカメラ
                        <input type="checkbox" name="sp-screen-31" value="Yes"<?php if(data_ref('sp-screen-31') == 'Yes')echo ' checked';?>>フリップカメラ
                        <input type="checkbox" name="sp-screen-32" value="Yes"<?php if(data_ref('sp-screen-32') == 'Yes')echo ' checked';?>>中央パンチホール
                        <input type="checkbox" name="sp-screen-33" value="Yes"<?php if(data_ref('sp-screen-33') == 'Yes')echo ' checked';?>>左上パンチホール
                        <input type="checkbox" name="sp-screen-34" value="Yes"<?php if(data_ref('sp-screen-34') == 'Yes')echo ' checked';?>>右上パンチホール
                        <input type="checkbox" name="sp-screen-35" value="Yes"<?php if(data_ref('sp-screen-35') == 'Yes')echo ' checked';?>>ディスプレイ下
                        <input type="checkbox" name="sp-screen-36" value="Yes"<?php if(data_ref('sp-screen-36') == 'Yes')echo ' checked';?>>ベゼル内
                        <input type="checkbox" name="sp-screen-37" value="Yes"<?php if(data_ref('sp-screen-37') == 'Yes')echo ' checked';?>>カメラなし
                        <input type="checkbox" name="sp-screen-38" value="Yes"<?php if(data_ref('sp-screen-38') == 'Yes')echo ' checked';?>>ポップアップ
                    </td>
                </tr>
                <tr>
                    <th>画面タイプ</th>
                    <td>
                        <input type="checkbox" name="sp-screen-23" value="Yes"<?php if(data_ref('sp-screen-23') == 'Yes')echo ' checked';?>>有機EL
                        <input type="checkbox" name="sp-screen-24" value="Yes"<?php if(data_ref('sp-screen-24') == 'Yes')echo ' checked';?>>IPS
                        <input type="checkbox" name="sp-screen-25" value="Yes"<?php if(data_ref('sp-screen-25') == 'Yes')echo ' checked';?>>TFT
                        <input type="checkbox" name="sp-screen-26" value="Yes"<?php if(data_ref('sp-screen-26') == 'Yes')echo ' checked';?>>TN
                    </td>
                </tr>
                <tr>
                    <th>細かいやつら</th>
                    <td>
                        <input type="checkbox" name="sp-screen-39" value="Yes"<?php if(data_ref('sp-screen-39') == 'Yes')echo ' checked';?>>湾曲ディスプレイ    
                        <input type="checkbox" name="sp-screen-27" value="Yes"<?php if(data_ref('sp-screen-27') == 'Yes')echo ' checked';?>>HDR10+
                        <input type="checkbox" name="sp-screen-28" value="Yes"<?php if(data_ref('sp-screen-28') == 'Yes')echo ' checked';?>>HDR10
                        <input type="checkbox" name="sp-screen-22" value="Yes"<?php if(data_ref('sp-screen-22') == 'Yes')echo ' checked';?>>Dolby Vision
                        <input type="checkbox" name="sp-screen-20" value="Yes"<?php if(data_ref('sp-screen-20') == 'Yes')echo ' checked';?>>Always-on display    
                    </td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Platform'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                PLATFORM	    OS  	    Android 10, MIUI 12
                                Chipset	    Qualcomm SM8350 Snapdragon 888 5G (5 nm)
                                CPU	        Octa-core (1x2.84 GHz Kryo 680 & 3x2.42 GHz Kryo 680 & 4x1.80 GHz Kryo 680)
                                GPU         Adreno 660

                PLATFORM	    OS	        Android 11, ZenUI 8
                                Chipset	    Qualcomm SM8350 Snapdragon 888 5G (5 nm)
                                CPU 	    Octa-core (1x2.84 GHz Kryo 680 & 3x2.42 GHz Kryo 680 & 4x1.80 GHz Kryo 680)
                                GPU	        Adreno 660

                PLATFORM	    OS	        Android 10, upgradable to Android 11, One UI 3.0
                                Chipset	    Exynos 990 (7 nm+) - Global
                                Qualcomm    SM8250 Snapdragon 865 5G+ (7 nm+) - USA
                                CPU 	    Octa-core (2x2.73 GHz Mongoose M5 & 2x2.50 GHz Cortex-A76 & 4x2.0 GHz Cortex-A55) - Global
                                            Octa-core (1x3.0 GHz Kryo 585 & 3x2.42 GHz Kryo 585 & 4x1.8 GHz Kryo 585) - USA
                                GPU	        Mali-G77 MP11 - Global
                                            Adreno 650 - USA

                PLATFORM	    OS	        Android 11, XOS 7.6
                                Chipset	    Mediatek Helio G95 (12 nm)
                                CPU	        Octa-core (2x2.05 GHz Cortex-A76 & 6x2.0 GHz Cortex-A55)
                                GPU	        Mali-G76 MC4

                PLATFORM	    OS	        Android 11, HIOS 7.6
                                Chipset	    Mediatek Helio G95 (12 nm)
                                CPU	        Octa-core (2x2.05 GHz Cortex-A76 & 6x2.0 GHz Cortex-A55)
                                GPU	        Mali-G76 MC4
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'OS':
                        //$ot_html01->find('.nfo', $i)->plaintext
                        break;

                    case 'Chipset':
                        break;

                    case 'CPU':
                        break;

                    case 'GPU':
                        break;
                    
                    default:
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>
                <tr>
                    <th>OS</th>
                    <td>
                        <input type="checkbox" name="sp-softwear-0" value="Yes"<?php if(data_ref('sp-softwear-0') == 'Yes')echo ' checked';?>>Android
                        <input type="checkbox" name="sp-softwear-1" value="Yes"<?php if(data_ref('sp-softwear-1') == 'Yes')echo ' checked';?>>Harmony
                        <input type="checkbox" name="sp-softwear-2" value="Yes"<?php if(data_ref('sp-softwear-2') == 'Yes')echo ' checked';?>>iOS
                        <input type="checkbox" name="sp-softwear-3" value="Yes"<?php if(data_ref('sp-softwear-3') == 'Yes')echo ' checked';?>>Microsoft Windows 10
                        <input type="checkbox" name="sp-softwear-4" value="Yes"<?php if(data_ref('sp-softwear-4') == 'Yes')echo ' checked';?>>Android Go
                    </td>
                </tr>
                <tr>
                    <th>OS ver</th>
                    <td><input type='text' name='sp-softwear-7' value="<?php echo data_ref('sp-softwear-7');?>"></td>
                </tr>
                <tr>
                    <th>GMS</th>
                    <td><input type="checkbox" name="sp-softwear-6" value="Yes"<?php if(data_ref('sp-softwear-6') == 'Yes')echo ' checked';?>>非対応</td>
                </tr>	
                <tr>
                    <th>OS更新可能なバージョン</th>
                    <td><input type='text' name='sp-softwear-9' value="<?php echo data_ref('sp-softwear-9');?>"></td>
                </tr>
                <tr>
                    <th>UI</th>
                    <td>
                        <input type="checkbox" name="sp-softwear-13" value="Yes"<?php if(data_ref('sp-softwear-13') == 'Yes')echo ' checked';?>>MIUI
                        <input type="checkbox" name="sp-softwear-14" value="Yes"<?php if(data_ref('sp-softwear-14') == 'Yes')echo ' checked';?>>color OS
                        <input type="checkbox" name="sp-softwear-15" value="Yes"<?php if(data_ref('sp-softwear-15') == 'Yes')echo ' checked';?>>Magic UI
                        <input type="checkbox" name="sp-softwear-16" value="Yes"<?php if(data_ref('sp-softwear-16') == 'Yes')echo ' checked';?>>ZenUI
                        <input type="checkbox" name="sp-softwear-17" value="Yes"<?php if(data_ref('sp-softwear-17') == 'Yes')echo ' checked';?>>One UI
                        <input type="checkbox" name="sp-softwear-18" value="Yes"<?php if(data_ref('sp-softwear-18') == 'Yes')echo ' checked';?>>XOS
                        <input type="checkbox" name="sp-softwear-19" value="Yes"<?php if(data_ref('sp-softwear-19') == 'Yes')echo ' checked';?>>Android One
                        <input type="checkbox" name="sp-softwear-20" value="Yes"<?php if(data_ref('sp-softwear-20') == 'Yes')echo ' checked';?>>AOSP
                        <input type="checkbox" name="sp-softwear-21" value="Yes"<?php if(data_ref('sp-softwear-21') == 'Yes')echo ' checked';?>>EMUI
                        <input type="checkbox" name="sp-softwear-22" value="Yes"<?php if(data_ref('sp-softwear-22') == 'Yes')echo ' checked';?>>Redmagic
                        <input type="checkbox" name="sp-softwear-23" value="Yes"<?php if(data_ref('sp-softwear-23') == 'Yes')echo ' checked';?>>Joy UI
                        <input type="checkbox" name="sp-softwear-24" value="Yes"<?php if(data_ref('sp-softwear-24') == 'Yes')echo ' checked';?>>HIOS
                        <input type="checkbox" name="sp-softwear-25" value="Yes"<?php if(data_ref('sp-softwear-25') == 'Yes')echo ' checked';?>>realme UI
                        <input type="checkbox" name="sp-softwear-26" value="Yes"<?php if(data_ref('sp-softwear-26') == 'Yes')echo ' checked';?>>OxygenOS
                        <input type="checkbox" name="sp-softwear-27" value="Yes"<?php if(data_ref('sp-softwear-27') == 'Yes')echo ' checked';?>>OriginOS
                        <input type="checkbox" name="sp-softwear-28" value="Yes"<?php if(data_ref('sp-softwear-28') == 'Yes')echo ' checked';?>>Funtouch
                        <input type="checkbox" name="sp-softwear-29" value="Yes"<?php if(data_ref('sp-softwear-29') == 'Yes')echo ' checked';?>>Flyme
                        <input type="checkbox" name="sp-softwear-30" value="Yes"<?php if(data_ref('sp-softwear-30') == 'Yes')echo ' checked';?>>ZUI
                        <input type="checkbox" name="sp-softwear-31" value="Yes"<?php if(data_ref('sp-softwear-31') == 'Yes')echo ' checked';?>>ROG UI
                    </td>
                </tr>
                <tr>
                    <th>UI ver</th>
                    <td><input type='text' name='sp-softwear-8' value="<?php echo data_ref('sp-softwear-8');?>"></td>
                </tr>
                <tr>
                    <th>UI更新可能なバージョン</th>
                    <td><input type='text' name='sp-softwear-10' value="<?php echo data_ref('sp-softwear-10');?>"></td>
                </tr>
                <tr>
                    <th>OS追加説明</th>
                    <td><input type='text' name='sp-softwear-11' value="<?php echo data_ref('sp-softwear-11');?>"></td>
                </tr>
                <tr>
                    <th>UI追加説明</th>
                    <td><input type='text' name='sp-softwear-12' value="<?php echo data_ref('sp-softwear-12');?>"></td>
                </tr>
                <tr>
                    <th>SoC ID</th>
                    <td><input type='text' name='sp-spec-11' value="<?php echo data_ref('sp-spec-11');?>"></td>
                </tr>
                <tr>
                    <th>CPU構成(本来の構成と異なる場合)</th>
                    <td><input type='text' name='sp-spec-2' value="<?php echo data_ref('sp-spec-2');?>"></td>
                </tr>
                <tr>
                    <th>GPU構成(本来の構成と異なる場合)</th>
                    <td><input type='text' name='sp-spec-4' value="<?php echo data_ref('sp-spec-4');?>"></td>
                </tr>
            </table>
            <h4>QualComm</h4>
            <div class="tagcloud2">
                <a>(0)SD215</a><a>(1)SD425</a>
                <a>(2)SD429</a><a>(3)SD430</a>
                <a>(4)SD435</a><a>(5)SD439</a>
                <a>(6)SD450</a><a>(7)SD460</a>
                <a>(8)SD480</a><a>(9)SD617</a>
                <a>(10)SD625</a><a>(11)SD626</a>
                <a>(12)SD630</a><a>(13)SD632</a>
                <a>(14)SD636</a><a>(15)SD650</a>
                <a>(16)SD660</a><a>(17)SD662</a>
                <a>(18)SD665</a><a>(19)SD670</a>
                <a>(20)SD675</a><a>(21)SD678</a>
                <a>(22)SD690</a><a>(23)SD710</a>
                <a>(24)SD712</a><a>(25)SD720G</a>
                <a>(26)SD730</a><a>(27)SD730G</a>
                <a>(28)SD732G</a><a>(29)SD750G</a>
                <a>(30)SD765</a><a>(31)SD765G</a>
                <a>(32)SD768G</a><a>(33)SD778G</a>
                <a>(34)SD780G</a><a>(35)SD810</a>
                <a>(36)SD820</a><a>(37)SD835</a>
                <a>(38)SD845</a><a>(39)SD855</a>
                <a>(40)SD855+</a><a>(41)SD860</a>
                <a>(42)SD865</a><a>(43)SD865+</a>
                <a>(44)SD870</a><a>(45)SD888</a>
            </div>
            <h4>MediaTek</h4>
            <div class="tagcloud2">
                <a>(81)MT6737</a><a>(82)MT6750</a>
                <a>(83)P10</a><a>(84)P18</a>
                <a>(85)P20</a><a>(86)A22</a>
                <a>(87)P22</a><a>(88)P23</a>
                <a>(89)G25</a><a>(90)P35</a>
                <a>(91)G35</a><a>(92)P60</a>
                <a>(93)P65</a><a>(94)P70</a>
                <a>(95)G70</a><a>(96)G80</a>
                <a>(97)G85</a><a>(98)P90</a>
                <a>(99)P95</a><a>(100)G90</a>
                <a>(101)G90T</a><a>(102)G95</a>
                <a>(103)Dim.700</a><a>(104)Dim.720</a>
                <a>(105)Dim.800U</a><a>(106)Dim.800</a>
                <a>(107)Dim.820</a><a>(108)Dim.900</a>
                <a>(109)Dim.1000C</a><a>(110)Dim.1000L</a>
                <a>(111)Dim.1000</a><a>(112)Dim.1000+</a>
                <a>(113)Dim.1100</a><a>(114)Dim.1200</a>
            </div>
            <?php
            
            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Memory'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                MEMORY	Card slot	microSDXC (dedicated slot)
                Internal	128GB 6GB RAM, 256GB 8GB RAM

                MEMORY	Card slot	microSDXC (dedicated slot)
                Internal	256GB 8GB RAM

                MEMORY	Card slot	Unspecified
                Internal	64GB 4GB RAM

                MEMORY	Card slot	No
                Internal	64GB 6GB RAM, 64GB 8GB RAM, 128GB 6GB RAM, 128GB 8GB RAM, 256GB 8GB RAM
                &nbsp;	UFS 2.1

                MEMORY	Card slot	microSDXC (dedicated slot)
                Internal	32GB 3GB RAM
                &nbsp;	eMMC 5.0

                MEMORY	Card slot	NM (Nano Memory), up to 256GB (uses shared SIM slot)
                Internal	128GB 6GB RAM, 128GB 8GB RAM, 256GB 8GB RAM, 512GB 8GB RAM
                &nbsp; 	UFS 2.1
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Card slot':
                        break;

                    case 'Internal':
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>
                <tr>
                    <th>Micro SDカード対応</th>
                    <td><input type="checkbox" name="sp-spec-12" value="Yes"<?php if(data_ref('sp-spec-12') == 'Yes')echo ' checked';?>></td>
                </tr>
                <tr>
                    <th>Micro SD最大容量</th>
                    <td><input type='text' name='sp-spec-14' value="<?php echo data_ref('sp-spec-14');?>"></td>
                </tr>
                <tr>
                    <th>NMカード対応</th>
                    <td><input type="checkbox" name="sp-spec-20" value="Yes"<?php if(data_ref('sp-spec-20') == 'Yes')echo ' checked';?>></td>
                </tr>
                <tr>
                    <th>NMカード最大容量</th>
                    <td><input type='text' name='sp-spec-21' value="<?php echo data_ref('sp-spec-21');?>"></td>
                </tr>
                <tr>
                    <th>メモリGB(この構成のものだけ)</th>
                    <td><input type='text' name='sp-spec-7' value="<?php echo data_ref('sp-spec-7');?>"></td>
                </tr>
                <tr>
                    <th>メモリ規格(この構成のものだけ)</th>
                    <td><input type='text' name='sp-spec-6' value="<?php echo data_ref('sp-spec-6');?>"></td>
                </tr>
                <tr>
                    <th>ストレージ規格(この構成のものだけ)</th>
                    <td><input type='text' name='sp-spec-8' value="<?php echo data_ref('sp-spec-8');?>"></td>
                </tr>
                <tr>
                    <th>ストレージGB(この構成のものだけ)</th>
                    <td><input type='text' name='sp-spec-9' value="<?php echo data_ref('sp-spec-9');?>"></td>
                </tr>
                <tr>
                    <th>他のバージョン</th>
                    <td><input type='text' name='sp-spec-10' value="<?php echo data_ref('sp-spec-10');?>"></td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Main Camera'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                MAIN CAMERA	Dual	64 MP, f/1.8, 26mm (wide), 1/1.73", 0.8µm, PDAF, OIS
                12 MP, f/2.2, 112˚, 14mm (ultrawide), 1/2.55", 1.4µm, dual pixel PDAF
                Features	LED flash, HDR, panorama
                Video	8K@24fps, 4K@30/60/120fps, 1080p@30/60/240fps, 720p@480fps; gyro-EIS, HDR

                MAIN CAMERA	Triple	64 MP, f/1.8, 25mm (wide), 1/1.72", 0.8µm, PDAF, OIS
                13 MP, f/1.9, 117˚, (ultrawide), 1/3.4", 1.0µm
                12 MP, f/2.2, 120˚, (ultrawide), 1/2.55", 1.4µm
                Features	LED flash, panorama, HDR
                Video	4K@30/60fps, 1080p@30/60fps, gyro-EIS

                MAIN CAMERA	Triple	64 MP, f/1.8, 26mm (wide), 1/1.72", 0.8µm, PDAF, OIS
                8 MP, f/2.4, 80mm (telephoto), PDAF, OIS, 3x optical zoom
                12 MP, f/2.2, 113˚, 17mm (ultrawide), 1/2.55", 1.4µm, dual pixel PDAF
                Features	Dual-LED flash, HDR, auto panorama (motorized rotation)
                Video	8K@30fps, 4K@30/60/120fps, 1080p@30/60/240fps, 720p@480fps; gyro-EIS, HDR

                MAIN CAMERA	Triple	108 MP, (wide), 1/1.72", 0.8µm, PDAF
                8 MP, f/3.4, 135mm (periscope telephoto), 1/4.0", PDAF, 5x optical zoom
                8 MP, 120˚ (ultrawide), 1/4.0", 1.12µm
                Features	Quad-LED flash, HDR, panorama
                Video	4K@30fps, 1080p@30fps

                MAIN CAMERA	Triple	50 MP, f/1.9, (wide), 1/1.3", 1.2µm, Dual Pixel PDAF, Laser AF
                13 MP, f/2.4, 50mm (telephoto), PDAF, 2x optical zoom
                8 MP, f/2.3, 120˚ (ultrawide), 1/4.0", 1.12µm, AF
                Features	Quad-LED flash, panorama, HDR
                Video	4K@30/60fps, 1080p@30fps

                MAIN CAMERA	Triple	16 MP, (wide), AF
                5 MP, (ultrawide)
                2 MP
                Features	LED flash, HDR, panorama
                Video	1080p@30fps

                MAIN CAMERA	Triple	48 MP, f/1.8, 27mm (wide), 1/2.0", 0.8µm, PDAF, Laser AF
                12 MP, f/2.2, 54mm (telephoto), 1/3.6", 1.0µm, PDAF, 2x optical zoom
                16 MP, f/2.2, 13mm (ultrawide), 1/3.0", 1.0µm, PDAF
                Features	Dual-LED flash, HDR, panorama
                Video	4K@30/60fps, 1080p@30/120/240fps, 1080p@960fps

                MAIN CAMERA	Single	20 MP, f/1.9, 26mm (wide), 1/2.4", 1.12µm, AF, OIS
                Features	Zeiss optics, triple-LED RGB flash, panorama, HDR
                Video	4K@30fps, stereo sound rec., 1080p@30/60fps (after SW update)

                MAIN CAMERA	Triple	108 MP, f/1.8, (wide), 1/1.52", 0.7µm, dual pixel PDAF
                8 MP, 80mm (telephoto/macro), liquid lens, PDAF, 3x optical zoom
                13 MP, f/2.4, 123˚ (ultrawide), 1.12µm
                Features	Dual LED flash, HDR, panorama
                Video	8K@24/30fps, 4K@30/60fps, 1080p@30/60fps, gyro-EIS

                MAIN CAMERA	Quad	40 MP, f/1.6, 27mm (wide), 1/1.7", PDAF, OIS
                8 MP, f/3.4, 125mm (periscope telephoto), 1/4.0", PDAF, OIS, 5x optical zoom
                20 MP, f/2.2, 16mm (ultrawide), 1/2.7", PDAF
                TOF 3D, (depth)
                Features	Leica optics, dual-LED dual-tone flash, panorama, HDR
                Video	4K@30fps, 1080p@60fps, 1080p@30fps (gyro-EIS), 720p@960fps

                MAIN CAMERA	Triple	108 MP, f/1.8, 26mm (wide), 1/1.33", 0.8µm, PDAF, Laser AF, OIS
                12 MP, f/3.0, 120mm (periscope telephoto), 1.0µm, PDAF, OIS, 5x optical zoom, 50x hybrid zoom
                12 MP, f/2.2, 120˚, 13mm (ultrawide), 1/2.55", 1.4µm
                Features	LED flash, auto-HDR, panorama
                Video	8K@24fps, 4K@30/60fps, 1080p@30/60/240fps, 720p@960fps, HDR10+, stereo sound rec., gyro-EIS & OIS
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Single':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Dual':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Triple':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Quad':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Five':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Six':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Features':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Video':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>
            <input type="checkbox" name="" value="Yes"<?php if(data_ref('') == 'Yes')echo ' checked';?>>
            <input type='text' name='' value="<?php echo data_ref('');?>">
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Selfie camera'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                SELFIE CAMERA	Single	12 MP, f/2.5, 28mm (standard), 1/2.93", 1.22µm, dual pixel PDAF
                Video	4K@30fps, 1080p@30/60fps

                SELFIE CAMERA	Single	Motorized pop-up 32 MP, f/1.9, 26mm (wide), 1/2.8", 0.8µm
                Features	HDR
                Video	1080p@30fps

                SELFIE CAMERA	Triple	Motorized flip-up main camera module
                Features	Dual-LED flash, HDR, auto panorama (motorized rotation)
                Video	8K@30fps, 4K@30/60/120fps, 1080p@30/60/240fps, 720p@480fps; gyro-EIS, HDR

                SELFIE CAMERA	Single	48 MP, (wide)
                Video	1080p@30fps

                SELFIE CAMERA	Dual	48 MP, f/2.2, (wide), 1/2.0", 0.8µm
                8 MP, f/2.2, 105˚ (ultrawide), 1/4.0", 1.12µm
                Features	Dual-LED flash
                Video	1080p@30fps

                SELFIE CAMERA	Single	16 MP
                Video	1080p@30fps

                SELFIE CAMERA	Single	20 MP, f/2.0, (wide), 1/3", 0.9µm
                Features	HDR
                Video	1080p@30fps

                SELFIE CAMERA	Single	5 MP, f/2.4
                Video	1080p@30fps

                SELFIE CAMERA	Single	20 MP, 27mm (wide), 1/3.4", 0.8µm
                Features	HDR, panorama
                Video	1080p@30/60fps, 720p@120fps

                SELFIE CAMERA	Single	32 MP, f/2.0, 26mm (wide), 1/2.8", 0.8µm
                Features	HDR
                Video	1080p@30fps

                SELFIE CAMERA	Single	10 MP, f/2.2, 26mm (wide), 1/3.2", 1.22µm, Dual Pixel PDAF
                Features	Dual video call, Auto-HDR
                Video	4K@30/60fps, 1080p@30fps
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Single':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Dual':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Triple':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Quad':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Five':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Six':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Features':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Video':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>
            <input type="checkbox" name="" value="Yes"<?php if(data_ref('') == 'Yes')echo ' checked';?>>
            <input type='text' name='' value="<?php echo data_ref('');?>">
                <tr>
                    <th>重さ</th>
                    <td></td>
                </tr>
                <tr>
                    <th>縦</th>
                    <td></td>
                </tr>
                <tr>
                    <th>横</th>
                    <td></td>
                </tr>
                <tr>
                    <th>厚み</th>
                    <td></td>
                </tr>
                <tr>
                    <th>素材</th>
                    <td></td>
                </tr>
                <tr>
                    <th>SIM</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Dual stand by</th>
                    <td></td>
                </tr>
                <tr>
                    <th>防水防塵</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Apple Pay</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Samsung Aay</th>
                    <td></td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Sound'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                SOUND	Loudspeaker	    Yes, with stereo speakers
                        3.5mm jack	    Yes
                                        32-bit/384kHz audio

                SOUND	Loudspeaker	    Yes
                        3.5mm jack	    No
                                
                SOUND	Loudspeaker	    Yes, with stereo speakers
                        3.5mm jack	    No
                                        24-bit/192kHz audio

                SOUND	Loudspeaker	    Yes, with dual speakers
                        3.5mm jack	    Unspecified

                SOUND	Loudspeaker 	Yes
                        3.5mm jack	    Yes

                SOUND	Loudspeaker	    Yes, with stereo speakers
                        3.5mm jack	    No
                                        24-bit/192kHz audio
                        &nbsp;          Tuned by JBL

                SOUND	Loudspeaker	    Yes, dual speakers
                        3.5mm jack	    No
                                        32-bit/384kHz audio

                SOUND	Loudspeaker	    Yes, with stereo speakers
                        3.5mm jack	    No
                                        32-bit/384kHz audio
                                        Tuned by AKG

                                        
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Loudspeaker':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case '3.5mm jack':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();
            ?>
            <table class='data-table'>
                <tr>
                    <th>3.5mmイヤホンジャック</th>
                    <td>
                        <input type="checkbox" name="sp-extra-4" value="Yes"<?php if(data_ref('sp-extra-4') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>通話用スピーカー(Loudspeaker)</th>
                    <td>
                        <input type="checkbox" name="sp-extra-37" value="Yes"<?php if(data_ref('sp-extra-37') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>デュアルスピーカー</th>
                    <td>
                        <input type="checkbox" name="sp-extra-38" value="Yes"<?php if(data_ref('sp-extra-38') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>デュアルスピーカー（ステレオ）</th>
                    <td>
                        <input type="checkbox" name="sp-extra-39" value="Yes"<?php if(data_ref('sp-extra-39') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>トリプルスピーカー（ステレオ）</th>
                    <td>
                        <input type="checkbox" name="sp-extra-40" value="Yes"<?php if(data_ref('sp-extra-40') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>クアッドスピーカー(ステレオ)</th>
                    <td>
                        <input type="checkbox" name="sp-extra-41" value="Yes"<?php if(data_ref('sp-extra-41') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>24-bit/192kHz</th>
                    <td>
                        <input type="checkbox" name="sp-extra-44" value="Yes"<?php if(data_ref('sp-extra-44') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>32-bit/384kHz</th>
                    <td>
                        <input type="checkbox" name="sp-extra-45" value="Yes"<?php if(data_ref('sp-extra-45') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>Tuned by AKG</th>
                    <td>
                        <input type="checkbox" name="sp-extra-49" value="Yes"<?php if(data_ref('sp-extra-49') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>Tuned by JBL</th>
                    <td>
                        <input type="checkbox" name="sp-extra-48" value="Yes"<?php if(data_ref('sp-extra-48') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>Tuned by Harman Kardon</th>
                    <td>
                        <input type="checkbox" name="sp-extra-47" value="Yes"<?php if(data_ref('sp-extra-47') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>オーディオ追加説明</th>
                    <td><input type='text' name='sp-extra-52' value="<?php echo data_ref('sp-extra-52');?>"></td>
                </tr>
            </table>
            
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Comms'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac/6e, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.2, A2DP, LE, aptX HD, aptX Adaptive
                        GPS	Yes, with dual-band A-GPS, GLONASS, GALILEO, BDS, QZSS, NavIC
                        NFC	Yes
                        Radio	FM radio (market/region dependent)
                        USB	USB Type-C 2.0, USB On-The-Go

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct, DLNA, hotspot
                        Bluetooth	5.1, A2DP, LE, aptX
                        GPS	Yes, with dual-band A-GPS, GLONASS, BDS, GALILEO
                        NFC	Yes
                        Radio	FM radio
                        USB	USB Type-C 3.1, USB On-The-Go

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac/6, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.0, A2DP, LE, aptX Adaptive
                        GPS	Yes, with dual-band A-GPS, GLONASS, GALILEO, BDS, QZSS, NavIC
                        NFC	Yes
                        Radio	No
                        USB	USB Type-C

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.0, A2DP, LE
                        GPS	Yes, with A-GPS
                        NFC	Unspecified
                        Radio	FM radio
                        USB	USB Type-C 2.0, USB On-The-Go

                COMMS	WLAN	Wi-Fi 802.11 b/g/n/ac, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.0, A2DP, LE
                        GPS	Yes, with A-GPS
                        NFC	No
                        Radio	FM radio
                        USB	USB Type-C 2.0, USB On-The-Go

                COMMS	WLAN	Yes
                        Bluetooth	Yes
                        GPS	Yes, with A-GPS
                        NFC	Yes
                        Radio	No
                        USB	Yes

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac/6, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.2, A2DP, LE
                        GPS	Yes, with dual-band A-GPS, GLONASS, BDS, GALILEO, QZSS, NavIC
                        NFC	Yes
                        Infrared port	Yes
                        Radio	No
                        USB	USB Type-C 2.0, USB On-The-Go

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac, dual-band, hotspot
                        Bluetooth	4.1, A2DP
                        GPS	Yes, with A-GPS, GLONASS, BDS
                        NFC	Yes
                        Radio	FM radio
                        USB	USB Type-C 3.1

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac/6e, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.2, A2DP, LE
                        GPS	Yes, with dual-band A-GPS, GLONASS, GALILEO, QZSS, NavIC, BDS (tri-band)
                        NFC	Yes
                        Infrared port	Yes
                        Radio	No
                        USB	USB Type-C

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.0, A2DP, aptX HD, LE
                        GPS	Yes, with dual-band A-GPS, GLONASS, BDS, GALILEO, QZSS
                        NFC	Yes
                        Infrared port	Yes
                        Radio	No
                        USB	USB Type-C 3.1

                COMMS	WLAN	Wi-Fi 802.11 a/b/g/n/ac/6, dual-band, Wi-Fi Direct, hotspot
                        Bluetooth	5.0, A2DP, LE, aptX
                        GPS	Yes, with A-GPS, GLONASS, BDS, GALILEO
                        NFC	Yes
                        Radio	FM radio (Snapdragon model only; market/operator dependent)
                        USB	USB Type-C 3.2, USB On-The-Go
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'WLAN':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Bluetooth':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    case 'Bluetooth':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    case 'NFC':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Infrared port':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    case 'Radio':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'USB':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>
            <input type="checkbox" name="" value="Yes"<?php if(data_ref('') == 'Yes')echo ' checked';?>>
            <input type='text' name='' value="<?php echo data_ref('');?>">
                <tr>
                    <th>重さ</th>
                    <td></td>
                </tr>
                <tr>
                    <th>縦</th>
                    <td></td>
                </tr>
                <tr>
                    <th>横</th>
                    <td></td>
                </tr>
                <tr>
                    <th>厚み</th>
                    <td></td>
                </tr>
                <tr>
                    <th>素材</th>
                    <td></td>
                </tr>
                <tr>
                    <th>SIM</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Dual stand by</th>
                    <td></td>
                </tr>
                <tr>
                    <th>防水防塵</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Apple Pay</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Samsung Aay</th>
                    <td></td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Features'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                FEATURES	Sensors	Fingerprint (under display, optical), accelerometer, gyro, proximity, compass

                FEATURES	Sensors	Fingerprint (under display, optical), accelerometer, gyro, proximity, compass

                FEATURES	Sensors	Fingerprint (side-mounted), accelerometer, gyro, proximity, compass

                FEATURES	Sensors	Fingerprint (under display, optical), accelerometer, gyro, proximity, compass

                FEATURES	Sensors	Fingerprint (side-mounted), accelerometer, proximity

                FEATURES	Sensors	Fingerprint (side-mounted), accelerometer, gyro, proximity, compass, barometer, color spectrum

                FEATURES	Sensors	Iris scanner, accelerometer, gyro, proximity, compass, barometer, sensor core
                            Microsoft Continuum support

                FEATURES	Sensors	Fingerprint (side-mounted), accelerometer, gyro, proximity, compass, color spectrum, barometer

                FEATURES	Sensors	Fingerprint (under display, optical), accelerometer, gyro, proximity, compass, color spectrum

                FEATURES	Sensors	Fingerprint (under display, ultrasonic), accelerometer, gyro, proximity, compass, barometer
                            Samsung Wireless DeX (desktop experience support)
                            ANT+
                            Bixby natural language commands and dictation
                            Samsung Pay (Visa, MasterCard certified)
                            Ultra Wideband (UWB) support
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Sensors':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>
                <tr>
                    <th>センサー類</th>
                    <td>
                        <?php
                            $input_checks = explode(':',
                            'sp-sensor-0,各センサー:
                            sp-sensor-1,コンパス:
                            sp-sensor-2,接近センサー:
                            sp-sensor-3,加速度センサー:
                            sp-sensor-4,ジャイロセンサー:
                            sp-sensor-5,気圧センサー:
                            sp-sensor-6,虹彩センサー:
                            sp-sensor-7,sensor core:
                            sp-sensor-8,サーモグラフィー:
                            sp-sensor-9,IRセンサー');

                            foreach($input_checks as $input_check ){
                                $input_check = explode(',',$input_check);
                                echo '<input type="checkbox" name="'.$input_check[0].'" value="Yes"';
                                if(data_ref($input_check[0]) == 'Yes')echo ' checked';
                                echo '>'.$input_check[1].'<br>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>指紋センサー</th>
                    <td>
                        <?php
                            $input_checks = explode(':',
                            'sp-sensor-14,指紋センサー:
                            sp-sensor-15,指紋センサー-背面:
                            sp-sensor-16,指紋センサー-側面:
                            sp-sensor-17,紋センサー-右側面:
                            sp-sensor-18,指紋センサー-左側面:
                            sp-sensor-19,指紋センサー-カメラユニットに付属:
                            sp-sensor-20,指紋センサー-画面内:
                            sp-sensor-21,紋センサー-光学式:
                            sp-sensor-22,指紋センサー-超音波式:
                            sp-sensor-23,指紋センサー-ToutchID');

                            foreach($input_checks as $input_check ){
                                $input_check = explode(',',$input_check);
                                echo '<input type="checkbox" name="'.$input_check[0].'" value="Yes"';
                                if(data_ref($input_check[0]) == 'Yes')echo ' checked';
                                echo '>'.$input_check[1].'<br>';
                            }
                        ?>
                    </td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Battery'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                BATTERY	Type	Li-Po 4000 mAh, non-removable
                Charging	Fast charging 30W, 60% in 25 min, 100% in 80 min (advertised)
                USB Power Delivery 3.0
                Reverse charging

                BATTERY	Type	Li-Po 4000 mAh, non-removable
                Charging	Fast charging
                Fast wireless charging 13W
                Quick Charge 4.0+

                BATTERY	Type	Li-Po 5000 mAh, non-removable
                Charging	Fast charging 30W, 60% in 34 min, 100% in 93 min (advertised)
                USB Power Delivery 3.0
                Reverse charging

                BATTERY	Type	Li-Po 4000 mAh, non-removable
                Charging	Fast Charging 160W, 100% in 10 min (advertised)
                Fast wireless charging 50W

                BATTERY	Type	Li-Po 4700 mAh, non-removable
                Charging	Fast charging 33W, 70% in 30 min (advertised)

                BATTERY	Type	Li-Po 5000 mAh, non-removable
                Charging	Fast charging 18W

                BATTERY	Type	Li-Po 5065 mAh, non-removable
                Charging	Fast charging 67W, 100% in 42 min (advertised)
                Power Delivery 3.0
                Quick Charge 3+

                BATTERY	Type	Li-Ion 3340 mAh, removable
                Charging	Fast charging 18W
                Qi wireless charging - market dependent
                Stand-by	Up to 288 h (2G) / Up to 288 h (3G)
                Talk time	Up to 25 h (2G) / Up to 19 h (3G)
                Music play	Up to 75 h

                BATTERY	Type	Li-Po 5020 mAh, non-removable
                Charging	Fast charging 67W, 100% in 37 min (advertised)
                Power Delivery 3.0
                Quick Charge 4+

                BATTERY	Type	Li-Po 4200 mAh, non-removable
                Charging	Fast charging 40W, 70% in 30 min (advertised)
                Fast wireless charging 15W
                Reverse wireless charging 2.5W

                BATTERY	Type	Li-Ion 4500 mAh, non-removable
                Charging	Fast charging 25W
                USB Power Delivery 3.0
                Fast Qi/PMA wireless charging 15W
                Reverse wireless charging 4.5W
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Type':
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Charging':
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>            
                <tr>
                    <th>バッテリー容量</th>
                    <td><input type='text' name='sp-battery-0' value="<?php echo data_ref('sp-battery-0');?>"></td>
                </tr>
                <tr>
                    <th>バッテリーについての補足情報</th>
                    <td><input type='text' name='sp-battery-1' value="<?php echo data_ref('sp-battery-1');?>"></td>
                </tr>
                <tr>
                    <th>バッテリー取り外し可能</th>
                    <td>
                    <input type="checkbox" name="sp-battery-9" value="Yes"<?php if(data_ref('sp-battery-9') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>ワイヤレス規格</th>
                    <td>
                        <input type="checkbox" name="sp-battery-23" value="Yes"<?php if(data_ref('sp-battery-23') == 'Yes')echo ' checked';?>>Qi
                        <input type="checkbox" name="sp-battery-24" value="Yes"<?php if(data_ref('sp-battery-24') == 'Yes')echo ' checked';?>>PMA
                        <input type="checkbox" name="sp-battery-25" value="Yes"<?php if(data_ref('sp-battery-25') == 'Yes')echo ' checked';?>>A4WP
                    </td>
                </tr>
                <tr>
                    <th>ワイヤレス充電</th>
                    <td>
                        <input type="checkbox" name="sp-battery-5" value="Yes"<?php if(data_ref('sp-battery-5') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>ワイヤレス充電速度</th>
                    <td>
                        <input type='text' name='sp-battery-6' value="<?php echo data_ref('sp-battery-6');?>">
                    </td>
                </tr>
                <tr>
                    <th>ワイヤレス逆充電
                </th>
                    <td>
                        <input type="checkbox" name="sp-battery-20" value="Yes"<?php if(data_ref('sp-battery-20') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>ワイヤレス逆充電速度</th>
                    <td>
                        <input type='text' name='sp-battery-21' value="<?php echo data_ref('sp-battery-21');?>">
                    </td>
                </tr>
                <tr>
                    <th>充電に関する補足情報</th>
                    <td>
                        <input type='text' name='sp-battery-7' value="<?php echo data_ref('sp-battery-7');?>">
                    </td>
                </tr>
                <tr>
                    <th>充電に関する補足情報</th>
                    <td>
                        <input type='text' name='sp-battery-9' value="<?php echo data_ref('sp-battery-9');?>">
                    </td>
                </tr>
                <tr>
                    <th>最大充電速度w</th>
                    <td>
                        <input type='text' name='sp-battery-10' value="<?php echo data_ref('sp-battery-10');?>">
                    </td>
                </tr>
                <tr>
                    <th>USB Type-C</th>
                    <td>
                        <input type="checkbox" name="sp-battery-13" value="Yes"<?php if(data_ref('sp-battery-13') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>USB Micro-b</th>
                    <td>
                        <input type="checkbox" name="sp-battery-14" value="Yes"<?php if(data_ref('sp-battery-14') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>ポート補足情報</th>
                    <td>
                        <input type='text' name='sp-battery-14' value="<?php echo data_ref('sp-battery-14');?>">
                    </td>
                </tr>
                <tr>
                    <th>リチウムイオン電池</th>
                    <td>
                        <input type="checkbox" name="sp-battery-17" value="Yes"<?php if(data_ref('sp-battery-17') == 'Yes')echo ' checked';?>>
                    </td>
                </tr>
                <tr>
                    <th>給電</th>
                    <td>
                        <input type='text' name='sp-battery-18' value="<?php echo data_ref('sp-battery-18');?>">
                    </td>
                </tr>

                <tr>
                    <th>充電規格</th>
                    <td>
                        <input type="checkbox" name="sp-battery-26" value="Yes"<?php if(data_ref('sp-battery-26') == 'Yes')echo ' checked';?>>Power Delivery 3.0
                        <input type="checkbox" name="sp-battery-29" value="Yes"<?php if(data_ref('sp-battery-29') == 'Yes')echo ' checked';?>>QuickCharge 4+
                        <input type="checkbox" name="sp-battery-30" value="Yes"<?php if(data_ref('sp-battery-30') == 'Yes')echo ' checked';?>>QuickCharge 4
                        <input type="checkbox" name="sp-battery-31" value="Yes"<?php if(data_ref('sp-battery-31') == 'Yes')echo ' checked';?>>Quick Charge 3+
                        <input type="checkbox" name="sp-battery-32" value="Yes"<?php if(data_ref('sp-battery-32') == 'Yes')echo ' checked';?>>Quick Charge 3
                        <input type="checkbox" name="sp-battery-33" value="Yes"<?php if(data_ref('sp-battery-33') == 'Yes')echo ' checked';?>>Quick Charge 2+
                        <input type="checkbox" name="sp-battery-34" value="Yes"<?php if(data_ref('sp-battery-34') == 'Yes')echo ' checked';?>>Quick Charge 2
                        <input type="checkbox" name="sp-battery-36" value="Yes"<?php if(data_ref('sp-battery-36') == 'Yes')echo ' checked';?>>Pump Express+ 2.0
                        <input type="checkbox" name="sp-battery-37" value="Yes"<?php if(data_ref('sp-battery-37') == 'Yes')echo ' checked';?>>PumpExpress 3.0
                        <input type="checkbox" name="sp-battery-39" value="Yes"<?php if(data_ref('sp-battery-39') == 'Yes')echo ' checked';?>>VOOC Flash charge
                        <input type="checkbox" name="sp-battery-40" value="Yes"<?php if(data_ref('sp-battery-40') == 'Yes')echo ' checked';?>>Dual-Engine Fast Charge
                        <input type="checkbox" name="sp-battery-41" value="Yes"<?php if(data_ref('sp-battery-41') == 'Yes')echo ' checked';?>>Super VOOC Flash charge
                        <input type="checkbox" name="sp-battery-42" value="Yes"<?php if(data_ref('sp-battery-42') == 'Yes')echo ' checked';?>>Dash charge
                        <input type="checkbox" name="sp-battery-43" value="Yes"<?php if(data_ref('sp-battery-43') == 'Yes')echo ' checked';?>>SuperCharge
                        <input type="checkbox" name="sp-battery-44" value="Yes"<?php if(data_ref('sp-battery-44') == 'Yes')echo ' checked';?>>mCharge
                    </td>
                </tr>

            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Misc'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                MISC	Colors	Obsidian Black, Horizon Silver
                        Models	ZS590KS, ZS590KS-2A007EU
                        Price	$ 719.99 / £ 636.99
                                
                MISC	Colors	Aurora Gray, Illusion Sky
                        Models	LMF100N, LM-F100N, LM-F100V, LM-F100
                        SAR	1.13 W/kg (head)     1.06 W/kg (body)    
                        Price	About 850 EUR

                MISC	Colors	Aurora Black, Pastel White
                        Models	ZS671KS, ASUS_I002DD
                        Price	$ 699.99 / € 799.00 / £ 756.21

                MISC	Colors	White; other colours
                        Models	X6810

                MISC	Colors	Starry Night Blue, Monet Summer
                        Models	AC8

                MISC	Colors	Nebula Black
                        Price	About 170 EUR

                MISC	Colors	Black, Gray, Silver, Bruce Lee Yellow
                        Price	$ 469.99

                MISC	Colors	Black, White
                        Price	About 350 EUR

                MISC	Colors	Aurora, Amber Sunrise, Breathing Crystal, Black, Pearl White, Misty Lavender, Mystic Blue
                        Models	VOG-L29, VOG-L09, VOG-AL00, VOG-TL00, VOG-L04, VOG-AL10, HW-02L
                        Price	$ 374.99 / € 499.00 / £ 400.00 / ₹ 51,790

                MISC	Colors	Mystic Bronze, Mystic Black, Mystic White
                        Models	SM-N986B, SM-N986B/DS, SM-N986U, SM-N986U1, SM-N986W, SM-N9860, SM-N986N
                        SAR	0.71 W/kg (head)     1.18 W/kg (body)    
                        SAR EU	0.34 W/kg (head)     1.47 W/kg (body)    
                        Price	$ 980.99 / € 889.00 / £ 724.99
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Colors':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Models':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    case 'SAR':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    case 'SAR EU':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Price':
                        //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    default:
                        //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <div id="check">color</div>
            <input type="color" id='inputForm' value="#e66465" onchange="inputCheck()">
            <script>
                function inputCheck() {
                    var inputValue = document.getElementById( "inputForm" ).value;
                    document.getElementById( "check" ).innerHTML =  inputValue;
                }
            </script>
            <table class='data-table'>
                <tr>
                    <th>
                        色[カラー名:カラーコード,カラー名:カラーコード,のように入力するわからない場合は-]
                    </th>
                    <td>
                        <input type='text' name='sp-design-3' value="<?php echo data_ref('sp-design-3');?>">
                    </td>
                </tr>
                <tr>
                    <th>モデル番号</th>
                    <td>
                        <input type='text' name='sp-launch-5' value="<?php echo data_ref('sp-launch-5');?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        SAR
                    </th>
                    <td>
                        SAR head<br>
                        <input type='text' name='sp-extra-57' value="<?php echo data_ref('sp-extra-57');?>">
                        SAR body<br>
                        <input type='text' name='sp-extra-58' value="<?php echo data_ref('sp-extra-58');?>">
                        SAR EU head<br>
                        <input type='text' name='sp-extra-59' value="<?php echo data_ref('sp-extra-59');?>">
                        SAR EU body<br>
                        <input type='text' name='sp-extra-60' value="<?php echo data_ref('sp-extra-60');?>">
                    </td>
                </tr>
            </table>
            <?php

            for($i = 0 ; $i <= $table_num - 1 ; $i++){
                /**/
                if($html->find( 'table', $i )->find('th', 0)->plaintext == 'Tests'){
                    $table_forcus_num = $i;
                }
            }
            $ot_html01 = $html->find( 'table', $table_forcus_num );
            $ot_td_num = substr_count($ot_html01,'<tr');
            for($i = 0 ; $i <= $ot_td_num - 1 ; $i++){
                //echo $ot_html01->find('.ttl', 0);
                /*
                TESTS	Performance	AnTuTu: 676001 (v8) | 799738 (v9)
                    GeekBench: 3604 (v5.1)
                    GFXBench: 61fps (ES 3.1 onscreen)
                    Display	Contrast ratio: Infinite (nominal)
                    Camera	Photo / Video
                    Loudspeaker	-27.9 LUFS (Good)
                    Battery life	
                    Endurance rating 88h

                TESTS	Performance	AnTuTu: 315688 (v8)
                    GeekBench: 7898 (v4.4), 1952 (v5.1)
                    GFXBench: 17fps (ES 3.1 onscreen)
                    Display	Contrast ratio: Infinite (nominal)
                    Camera	Photo / Video
                    Loudspeaker	-30.9 LUFS (Below average)
                    Battery life	
                    Endurance rating 87h

                TESTS	Performance	AnTuTu: 602934 (v8)
                    GeekBench: 3302 (v5.1)
                    GFXBench: 46fps (ES 3.1 onscreen)
                    Display	Contrast ratio: Infinite (nominal)
                    Camera	Photo / Video
                    Loudspeaker	-26.6 LUFS (Good)
                    Battery life	
                    Endurance rating 99h

                TESTS	Performance	AnTuTu: 309055 (v8)
                    GeekBench: 1670 (v5.1)
                    GFXBench: 17fps (ES 3.1 onscreen)
                    Display	Contrast ratio: Infinite (nominal)
                    Camera	Photo / Video
                    Loudspeaker	-26.7 LUFS (Good)
                    Battery life	
                    Endurance rating 122h

                TESTS	Performance	Basemark OS II 2.0: 1472
                    Basemark X: 32178
                    Display	Contrast ratio: Infinite (nominal), 3.837 (sunlight)
                    Camera	Photo / Video
                    Loudspeaker	Voice 74dB / Noise 75dB / Ring 84dB
                    Audio quality	Noise -91.6dB / Crosstalk -89.3dB
                    Battery life	
                    Endurance rating 62h

                TESTS	Performance	AnTuTu: 316156 (v7), 401208 (v8)
                    GeekBench: 10014 (v4.4), 2521 (v5.1)
                    GFXBench: 29fps (ES 3.1 onscreen)
                    Display	Contrast ratio: Infinite (nominal), 5.119 (sunlight)
                    Camera	Photo / Video
                    Loudspeaker	-28.1 LUFS (Average)
                    Audio quality	Noise -90.5dB / Crosstalk -93.0dB
                    Battery life	
                    Endurance rating 100h

                TESTS	Performance	AnTuTu: 508760 (v8)
                    GeekBench: 2603 (v5.1)
                    GFXBench: 42fps (ES 3.1 onscreen)
                    Display	Contrast ratio: Infinite (nominal)
                    Camera	Photo / Video
                    Loudspeaker	-27.8 LUFS (Good)
                    Battery life	
                    Endurance rating 88h
                */
                switch($ot_html01->find('.ttl', $i)->plaintext){
                    
                    case 'Performance':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Display':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    case 'Camera':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    case 'Loudspeaker':
                        //発表
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;

                    case 'Battery life':
                        //状態
                        echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                    
                    default:
                        //echo 'Speed';
                        echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                        break;
                }
            }
            data_viewer();?>
            <table class='data-table'>
            <input type="checkbox" name="" value="Yes"<?php if(data_ref('') == 'Yes')echo ' checked';?>>
            <input type='text' name='' value="<?php echo data_ref('');?>">
                <tr>
                    <th>重さ</th>
                    <td></td>
                </tr>
                <tr>
                    <th>縦</th>
                    <td></td>
                </tr>
                <tr>
                    <th>横</th>
                    <td></td>
                </tr>
                <tr>
                    <th>厚み</th>
                    <td></td>
                </tr>
                <tr>
                    <th>素材</th>
                    <td></td>
                </tr>
                <tr>
                    <th>SIM</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Dual stand by</th>
                    <td></td>
                </tr>
                <tr>
                    <th>防水防塵</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Apple Pay</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Samsung Aay</th>
                    <td></td>
                </tr>
            </table>
            
</form>
<p>url:<?php echo $url;?></p>
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
            $data_table_title = "発売日とメーカー";
            $data_table = [];
            $data_table[] = ["メーカー",''];
            $data_table[] = ["発表日",$html->find("span[data-spec='released-hl']",0)->plaintext];
            $data_table[] = ["発売日",""];
            $data_table[] = ["端末名",$html->find(".specs-phone-name-title",0)->plaintext];
            $data_table[] = ["モデル番号","M1902F1G"];
            $data_table[] = ["地域","中国"];
            $data_table[] = ["追加説明","-"];
            gen_table();
        ?>
        

        <?php
            $data_table_title = "data";
            $data_table = [];
            $data_table[] = ["sp-launch-0","メーカー"];
            $data_table[] = ["取得","手打ち"];
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
<div style='background:#bddeff'>
    <h2>ERRORS</h2>
    <div class="s-box">
        <table class='data-table'>
            <?php
            foreach($errors as $errors_ot){
                $ot = explode(':',$errors_ot[2]);
                $ot2 = "";
                foreach($ot as $ot3){
                    $ot2 .= '・'.$ot3.'<br>';
                }
                echo "<tr><th>".$errors_ot[0]."(".$errors_ot[1].")</th><td>".$ot2."</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<style>

.tabs {
    margin-top: 50px;
    padding-bottom: 40px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width:95%;
    margin: 0 auto;
}

.tab_item {
    width: calc(100%/13);
    height: 50px;
    border-bottom: 3px solid #5ab4bd;
    background-color: #d9d9d9;
    line-height: 50px;
    font-size: 16px;
    text-align: center;
    color: #565656;
    display: block;
    float: left;
    text-align: center;
    font-weight: bold;
    transition: all 0.2s ease;
}
.tab_item:hover {
    opacity: 0.75;
}

/*ラジオボタンを全て消す*/
input[name="tab_item"] {
    display: none;
}

/*タブ切り替えの中身のスタイル*/
.tab_content {
    display: none;
    padding: 40px 40px 0;
    clear: both;
    overflow: hidden;
}


/*選択されているタブのコンテンツのみを表示*/
#all:checked ~ #all_content,
#launch:checked ~ #launch_content,
#design:checked ~ #design_content, 
#spec:checked ~ #spec_content,
#screen:checked ~ #screen_content,
#battery:checked ~ #battery_content,
#camera:checked ~ #camera_content,
#network:checked ~ #network_content,
#band:checked ~ #band_content,
#sensor:checked ~ #sensor_content,
#security:checked ~ #security_content,
#softwear:checked ~ #softwear_content,
#extra:checked ~ #extra_content
{
    display: block;
}

/*選択されているタブのスタイルを変える*/
.tabs input:checked + .tab_item {
    background-color: #5ab4bd;
    color: #fff;
}
</style>
<div class="tabs">
    <input id="all" type="radio" name="tab_item" checked>
    <label class="tab_item" for="all">概要</label>
    <input id="launch" type="radio" name="tab_item">
    <label class="tab_item" for="launch">発売日とメーカー</label>
    <input id="design" type="radio" name="tab_item">
    <label class="tab_item" for="design">デザイン</label>
    <input id="spec" type="radio" name="tab_item">
    <label class="tab_item" for="spec">性能</label>
    <input id="screen" type="radio" name="tab_item">
    <label class="tab_item" for="screen">スクリーン</label>
    <input id="battery" type="radio" name="tab_item">
    <label class="tab_item" for="battery">バッテリー</label>
    <input id="camera" type="radio" name="tab_item">
    <label class="tab_item" for="camera">カメラ</label>
    <input id="network" type="radio" name="tab_item">
    <label class="tab_item" for="network">ネットワーク</label>
    <input id="band" type="radio" name="tab_item">
    <label class="tab_item" for="band">バンド</label>
    <input id="sensor" type="radio" name="tab_item">
    <label class="tab_item" for="sensor">センサー</label>
    <input id="security" type="radio" name="tab_item">
    <label class="tab_item" for="security">セキュリティ</label>
    <input id="softwear" type="radio" name="tab_item">
    <label class="tab_item" for="softwear">ソフトウェア</label>
    <input id="extra" type="radio" name="tab_item">
    <label class="tab_item" for="extra">その他</label>
    <?php
    $table_txts = ['all','design','launch','spec','screen','battery','camera','network','band','sensor','security','softwear','extra'];
    foreach($table_txts as $table_txt){
        tab_table($table_txt);
    }
    ?>
</div>
<p>デバッグエリア</p>
<style>
#specs-list th {
    border-right: medium none;
    font: 16px Google-Oswald,Arial;
    text-transform: uppercase;
    width: 86px;
}
#specs-list td.nfo a, #specs-list th {
    color: #d50000;
}
</style>
<div id="specs-list">
<table cellspacing="0" style="max-height: 111px;">
<tbody><tr class="tr-hover">
<th rowspan="15" scope="row">Network</th>
<td class="ttl"><a href="network-bands.php3">Technology</a></td>
<td class="nfo"><a href="#" class="link-network-detail" data-spec="nettech">GSM / HSPA / LTE</a></td>
</tr>
<tr class="tr-toggle">
<td class="ttl"><a href="network-bands.php3">2G bands</a></td>
<td class="nfo" data-spec="net2g">GSM 850 / 900 / 1800 / 1900 - SIM 1 &amp; SIM 2</td>
</tr><tr class="tr-toggle">
<td class="ttl"><a href="network-bands.php3">3G bands</a></td>
<td class="nfo" data-spec="net3g">HSDPA 850 / 900 / 2100 </td>
</tr>
<tr class="tr-toggle">
<td class="ttl"><a href="network-bands.php3">4G bands</a></td>
<td class="nfo" data-spec="net4g">1, 3, 5, 8, 20, 38, 40, 41</td>
</tr>
<tr class="tr-toggle">
<td class="ttl"><a href="glossary.php3?term=3g">Speed</a></td>
<td class="nfo" data-spec="speed">HSPA 42.2/5.76 Mbps, LTE-A</td>
</tr>
	

	


</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="2" scope="row">Launch</th>
<td class="ttl"><a href="glossary.php3?term=phone-life-cycle">Announced</a></td>
<td class="nfo" data-spec="year">2021, June 21</td>
</tr>	
<tr>
<td class="ttl"><a href="glossary.php3?term=phone-life-cycle">Status</a></td>
<td class="nfo" data-spec="status">Available. Released 2021, June 28</td>
</tr>
</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="6" scope="row">Body</th>
<td class="ttl"><a href="#" onclick="helpW('h_dimens.htm');">Dimensions</a></td>
<td class="nfo" data-spec="dimensions">159.3 x 74 x 9.3 mm (6.27 x 2.91 x 0.37 in)</td>
</tr><tr>
<td class="ttl"><a href="#" onclick="helpW('h_weight.htm');">Weight</a></td>
<td class="nfo" data-spec="weight">196 g (6.91 oz)</td>
</tr>
<tr>
<td class="ttl"><a href="glossary.php3?term=build">Build</a></td>
<td class="nfo" data-spec="build">Glass front, plastic frame, plastic back</td>
</tr>
<tr>
<td class="ttl"><a href="glossary.php3?term=sim">SIM</a></td>
<td class="nfo" data-spec="sim">Dual SIM (Nano-SIM, dual stand-by)</td>
</tr>
		
</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="5" scope="row">Display</th>
<td class="ttl"><a href="glossary.php3?term=display-type">Type</a></td>
<td class="nfo" data-spec="displaytype">Super AMOLED, 90Hz, 800 nits (HBM)</td>
</tr>
<tr>
<td class="ttl"><a href="#" onclick="helpW('h_dsize.htm');">Size</a></td>
<td class="nfo" data-spec="displaysize">6.4 inches, 98.9 cm<sup>2</sup> (~83.9% screen-to-body ratio)</td>
</tr>
<tr>
<td class="ttl"><a href="glossary.php3?term=resolution">Resolution</a></td>
<td class="nfo" data-spec="displayresolution">1080 x 2400 pixels, 20:9 ratio (~411 ppi density)</td>
</tr>
		
</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="4" scope="row">Platform</th>
<td class="ttl"><a href="glossary.php3?term=os">OS</a></td>
<td class="nfo" data-spec="os">Android 11, One UI 3.1</td>
</tr>
<tr><td class="ttl"><a href="glossary.php3?term=chipset">Chipset</a></td>
<td class="nfo" data-spec="chipset">Mediatek Helio G80 (12 nm)</td>
</tr>
<tr><td class="ttl"><a href="glossary.php3?term=cpu">CPU</a></td>
<td class="nfo" data-spec="cpu">Octa-core (2x2.0 GHz Cortex-A75 &amp; 6x1.8 GHz Cortex-A55)</td>
</tr>
<tr><td class="ttl"><a href="glossary.php3?term=gpu">GPU</a></td>
<td class="nfo" data-spec="gpu">Mali-G52 MC2</td>
</tr>
</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="5" scope="row">Memory</th>
<td class="ttl"><a href="glossary.php3?term=memory-card-slot">Card slot</a></td>


<td class="nfo" data-spec="memoryslot">microSDXC (dedicated slot)</td></tr>

	

<tr>
<td class="ttl"><a href="glossary.php3?term=dynamic-memory">Internal</a></td>
<td class="nfo" data-spec="internalmemory">64GB 4GB RAM, 128GB 6GB RAM</td>
</tr>
	

<tr><td class="ttl">&nbsp;</td><td class="nfo" data-spec="memoryother">eMMC 5.1</td></tr>
			


</tbody></table>


	<table cellspacing="0">
	<tbody><tr>
	<th rowspan="4" scope="row" class="small-line-height">Main Camera</th>
		<td class="ttl"><a href="glossary.php3?term=camera">Quad</a></td>
	<td class="nfo" data-spec="cam1modules">64 MP, f/1.8, 26mm (wide), 1/1.97", 0.7µm, PDAF<br>
8 MP, f/2.2, 123˚, (ultrawide), 1/4.0", 1.12µm<br>
2 MP, f/2.4, (macro)<br>
2 MP, f/2.4, (depth)</td>
	</tr>
		<tr>
	<td class="ttl"><a href="glossary.php3?term=camera">Features</a></td>
	<td class="nfo" data-spec="cam1features">LED flash, panorama, HDR</td>
	</tr>
		<tr>
	<td class="ttl"><a href="glossary.php3?term=camera">Video</a></td>
	<td class="nfo" data-spec="cam1video">1080p@30fps</td>
	</tr>
		</tbody></table>


	<table cellspacing="0">
	<tbody><tr>
	<th rowspan="4" scope="row" class="small-line-height">Selfie camera</th>
		<td class="ttl"><a href="glossary.php3?term=secondary-camera">Single</a></td>
	<td class="nfo" data-spec="cam2modules">20 MP, f/2.2, (wide)</td>
	</tr>
		<tr>
	<td class="ttl"><a href="glossary.php3?term=secondary-camera">Video</a></td>
	<td class="nfo" data-spec="cam2video">1080p@30fps</td>
	</tr>
		</tbody></table>



<table cellspacing="0">
<tbody><tr>
<th rowspan="3" scope="row">Sound</th>
<td class="ttl"><a href="glossary.php3?term=loudspeaker">Loudspeaker</a> </td>
<td class="nfo">Yes</td>
</tr>

	

<tr>
<td class="ttl"><a href="glossary.php3?term=audio-jack">3.5mm jack</a> </td>
<td class="nfo">Yes</td>
</tr>
	

	
</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="9" scope="row">Comms</th>
<td class="ttl"><a href="glossary.php3?term=wi-fi">WLAN</a></td>
<td class="nfo" data-spec="wlan">Wi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct, hotspot</td>
</tr>
<tr>
<td class="ttl"><a href="glossary.php3?term=bluetooth">Bluetooth</a></td>
<td class="nfo" data-spec="bluetooth">5.0, A2DP, LE</td>
</tr>
<tr>
<td class="ttl"><a href="glossary.php3?term=gps">GPS</a></td>
<td class="nfo" data-spec="gps">Yes, with A-GPS, GLONASS, BDS, GALILEO</td>
</tr>  
<tr>
<td class="ttl"><a href="glossary.php3?term=nfc">NFC</a></td>
<td class="nfo" data-spec="nfc">No</td>
</tr>
	
	
<tr>
<td class="ttl"><a href="glossary.php3?term=fm-radio">Radio</a></td>
<td class="nfo" data-spec="radio">Unspecified</td>
</tr>
   
<tr>
<td class="ttl"><a href="glossary.php3?term=usb">USB</a></td>
<td class="nfo" data-spec="usb">USB Type-C 2.0, USB On-The-Go</td>
</tr>
</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="9" scope="row">Features</th>
<td class="ttl"><a href="glossary.php3?term=sensors">Sensors</a></td>
<td class="nfo" data-spec="sensors">Fingerprint (side-mounted), accelerometer, gyro, proximity, compass</td>
</tr>
 	
	
</tbody></table>


<table cellspacing="0">
<tbody><tr>
<th rowspan="7" scope="row">Battery</th>
<td class="ttl"><a href="glossary.php3?term=rechargeable-battery-types">Type</a></td>
<td class="nfo" data-spec="batdescription1">Li-Ion 6000 mAh, non-removable</td>
</tr>
<tr>
<td class="ttl"><a href="glossary.php3?term=battery-charging">Charging</a></td>
<td class="nfo">Fast charging 15W</td>
</tr>


</tbody></table>
<table cellspacing="0">
<tbody><tr>
<th rowspan="6" scope="row">Misc</th>
<td class="ttl"><a href="glossary.php3?term=build">Colors</a></td>
<td class="nfo" data-spec="colors">Black, Light Blue</td>
</tr>

<tr>
<td class="ttl"><a href="glossary.php3?term=models">Models</a></td>
<td class="nfo" data-spec="models">SM-M325FV, SM-M325FV/DS, SM-M325F/DS, SM-M325F</td>
</tr>

<tr>
<td class="ttl"><a href="glossary.php3?term=sar">SAR</a></td>
<td class="nfo" data-spec="sar-us">0.64 W/kg (head) &nbsp; &nbsp; </td>
</tr>
<tr>
<td class="ttl"><a href="glossary.php3?term=sar">SAR EU</a></td>
<td class="nfo" data-spec="sar-eu">0.56 W/kg (head) &nbsp; &nbsp; 1.57 W/kg (body) &nbsp; &nbsp; </td>
</tr>


<tr>
<td class="ttl"><a href="glossary.php3?term=price">Price</a></td>
<td class="nfo" data-spec="price"><a href="samsung_galaxy_m32-price-10887.php">£&thinsp;269.00 / ₹&thinsp;14,999</a></td>
</tr>
</tbody></table>
</div>
</form>