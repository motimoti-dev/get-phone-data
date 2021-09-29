<div class="sc0">
    <div class='sc'>
        <?php 
        $info0 = '<svg viewBox="0 0 512 512" style="width:32px;height:32px;position:relative;top:6px;" onclick="openinfo([\'';
        $info1 = '<svg viewBox="0 0 512 512" style="width:17px;height:17px;position:relative;top:3px;" onclick="openinfo([\'';
        $info2 = '\'])"><path fill="gray" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path>    </svg>';
        $close2 = '\'])"><path fill="gray" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z" class=""></path></svg>';
        ?>
        <h1><?php echo $info0.".info0".$info2;?>スクレイピングの奴 </h1>
        <form method="post">
        
        <?php echo $info1.".info1".$info2;?>
        使用するURL<input type='text' name='scurl' size='full' value=''>
        <?php echo $info1.".info2".$info2;?>
        途中から入力する場合(json)<textarea name='json' style='width:100%;'></textarea>
        </form>
        <form id='form1'>
        <?php

        //繰り返したぐ生成するやつ　https://paiza.io/projects/iBS4BIH4fcK8_lyw0xAqjg?language=php
        ?>
        <div onclick='opentd("#get-info");' style='color:gray;'>詳細を表示</div>
        <div id='get-info' class='hide'>
            <div class='hidebtn' onclick='opentd("#get-data");'><a>URLパラメータを表示</a></div>
            <div id='get-data' class='hide'>
            <?php
            global $arr;
            $arr = false;
            if(count($_GET) != 0){
                $arr = [];
                foreach ( $_GET as $key => $value ) {
                    if($value != ''){
                        echo $key. "：".$value."<br>";
                        $arr[] =  [$key,$value];
                    }
                }
            }else{
                echo '<p>Getパラメータがありません</p>';
            }
            ?>
        </div>
            <div class='hidebtn' onclick='opentd("#get-data2")'><a>GETをJOSNに変換して<br>またデコードした奴</a></div>
            <div id='get-data2' class='hide'>
                <?php
                //echo json_encode($arr);
                if($arr != false){
                    foreach ( json_decode(json_encode($arr)) as $value ) {
                        if($value[1] != ''){
                            echo $value[0]. "：".$value[1]."<br>";
                        }
                    }
                }else{
                    echo '<p>Getパラメータがありません</p>';
                }
                ?>
            </div>
            <?php

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
            if(array_key_exists('scurl',$_POST)){
                if($_POST['scurl'] != ''){
                    $url = $_POST['scurl'];
                }
            }
            if(array_key_exists('sp-memo-1',$_GET)){
                if($_GET['sp-memo-1'] != ''){
                    $url = $_GET['sp-memo-1'];
                }
            }
            global $def_json;
            $def_json = false;
            if(array_key_exists('json',$_POST)){
                if($_POST['json'] != ''){
                    $def_json = json_decode($_POST['json']);
                }
            }?><div class='hidebtn' onclick='opentd("#post-json-data")'><a>初期JOSNの設定</a></div><?php
            if($def_json != false){?>
                <div id='post-json-data' class='hide'>
                    <?php print_r($def_json);?>
                </div>
            <?php }else{?>
                <div id='post-json-data' class='hide'>
                    <p>jsonは設定されていません</p>
                </div>
            <?php }?>
            <?php 
                $html = file_get_html($url);
                echo '<a style=\'color:red;\' class="gsm-link" href="'.$url.'" >元のリンク'.$html->find( '.specs-phone-name-title', 0 )->plaintext.'</a>';
            ?>
        </div>
        
        <?php //echo substr_count($html,'table');?>
        <?php
        global $data;
        $data = [];
        global $data_view;
        $data_view = [];

        $table_num = substr_count($html->find( '#specs-list', 0 ),'table')/2;
        ?>
        <h2 class="specs-phone-name-title" data-spec="modelname"><?php echo $info0.".info3".$info2;?><?php echo $html->find( '.specs-phone-name-title', 0 )->plaintext;?></h2>
        <p><?php echo $info1.".info4".$info2;?>送信されたデータをjsonに変換したテキスト</p>
        <textarea id="copyTarget" style='width:100%;' readonly>
        <?php echo json_encode($arr);?>
        </textarea>
        <div class='hidebtn' onclick='copyToClipboard()'><a>Jsonをコピーする</a></div>
        <script>
        function copyToClipboard() {
            // コピー対象をJavaScript上で変数として定義する
            var copyTarget = document.getElementById("copyTarget");

            // コピー対象のテキストを選択する
            copyTarget.select();

            // 選択しているテキストをクリップボードにコピーする
            document.execCommand("Copy");
        }
        function ckinput(a,b){
            document.getElementById(a).value = b;
        }
        </script>
        <div style='text-align:center'>
            <img src="<?php echo $html->find( '.specs-photo-main a img ', 0 )->src;?>">
        </div>
        <?php //echo $html->find( 'table', 0 );?>
        <?php //echo $html->find( 'table', 0 )->find('th', 0);?>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <style>
            /*ul tag belong spection data.*/
            h1{
                border-bottom:2px solid orange;
            }
            h2{
                padding-left: 1rem;
                border-left: solid 3px orange;
            }
            .sc2 h1{
                border-bottom:2px solid blue;
                /*margin-top:0;*/
            }
            .sc2 h2{
                padding-left: 1rem;
                border-left: solid 3px blue;
            }
            rules{
                display: block;
                font-family: monospace;
                white-space: pre;
                margin: 1em 0px;
                background: #ff9d9dba;
                border-radius: 4px;
                border: red 1px solid;
                padding-left: 10px;
            }
            pre{
                background: #f2f5ff;
                border-radius: 4px;
                border: blue 1px solid;
                padding-left: 10px;
            }
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
                /*width:100%;*/
            }
            input[size="full"],textarea{
                width:100%;
            }
            input[size="mini"],textarea{
                width:3rem;
            }
            table tr:nth-child(odd){
                background: #eee;
            }
            table[cellspacing="0"]{
                border:2px #6195ff solid;
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
            .hide{
                display:none;
            }
            .sc0{
                display:flex;
            }
            .sc{
                width:40%;
                padding:1%;
                
                background:white;
                margin:1%;
                box-shadow: 0 2px 4px 0 rgb(0 0 0 / 22%);
            }
            .sc2{
                width:40%;
                padding:1%;
                height:94%;
                position:fixed;
                left:44%;
                background:white;
                margin:1%;
                box-shadow: 0 2px 4px 0 rgb(0 0 0 / 22%);
            }
            body{
                margin:0;
            }
            .gsm-link{
                border-left:3px solid orange;
                padding-left:1em;
                text-decoration:none;
            }
        </style>
        <script>
            function opentd(target){
                $(target).toggleClass('hide');
            }
            function openinfo(target){
                const array1 = [
                    'info0',
                    'info1',
                    'info2',
                    'info3',
                    'info4',
                    'info5',
                    'info6',
                    'info7',
                    'info8',
                    'info9',
                    'info10',
                    'info11',
                    'info12',
                    'info13',
                    'info14',
                    'info15',
                    'info16',
                    'info17',
                    'info18',
                    'info19',
                    'info20',
                    'info21',
                    'info22',
                    'info23',
                    'info24',
                    'info25',
                    'info26',
                    'info27',
                    'info28',
                    'info29',
                    'info30',
                    'info31',
                    'info32',
                    'info33',
                    'info34',
                    'info35',
                    'info36',
                    'info37',
                    'info38',
                    'info39',
                    'info40',
                    'info41',
                    'info42',
                    'info43',
                    'info44',
                    'info45',
                    'info46',
                    'info47',
                    'info48',
                    'info49',
                    'info50',
                    'info51',
                    'info52',
                    'info53',
                    'info54',
                    'info55',
                    'info56',
                    'info57',
                    'info58',
                    'info59',
                    'info60',
                    'info61',
                    'info62',
                    'info63',
                    'info64',
                    'info65',
                    'info66',
                    'info67',
                    'info68',
                    'info69',
                    'info70',
                    'info71',
                    'info72',
                    'info73',
                    'info74',
                    'info75',
                    'info76',
                    'info77',
                    'info78',
                    'info79',
                    'info80',
                    'info81',
                    'info82',
                    'info83',
                    'info84',
                    'info85',
                    'info86',
                    'info87',
                    'info88',
                    'info89',
                    'info90',
                    'info91',
                    'info92',
                    'info93',
                    'info94',
                    'info95',
                    'info96',
                    'info97',
                    'info98',
                    'info99',
                    'info100',
                    'info101',
                    'info102',
                    'info103',
                    'info104',
                    'info105',
                    'info106',
                    'info107',
                    'info108',
                    'info109',
                    'info110',
                    'info111',
                    'info112',
                    'info113',
                    'info114',
                    'info115',
                    'info116',
                    'info117',
                    'info118',
                    'info119',
                    'info120',
                ];
                array1.forEach(element => $(element).addClass('hide'));
                target.forEach(target => $(target).toggleClass('hide'));
            }
        </script>
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

        .hidebtn {
        max-width: 300px;
        margin: 30px auto;
        }
        .hidebtn a {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 50px;
        position: relative;
        background: #228bc8;
        border: 1px solid #228bc8;
        border-radius: 30px;
        box-sizing: border-box;
        padding: 0 45px 0 25px;
        color: #fff;
        font-size: 16px;
        letter-spacing: 0.1em;
        line-height: 1.3;
        text-align: left;
        text-decoration: none;
        transition-duration: 0.3s;
        }
        .hidebtn a:before {
        content: '';
        width: 8px;
        height: 8px;
        border: 0;
        border-top: 2px solid #fff;
        border-right: 2px solid #fff;
        transform: rotate(45deg);
        position: absolute;
        top: 50%;
        right: 25px;
        margin-top: -6px;
        }
        .hidebtn a:hover {
        background: #fff;
        color: #228bc8;
        }
        .hidebtn a:hover:before {
        border-top: 2px solid #228bc8;
        border-right: 2px solid #228bc8;
        }
        </style>
        <?php
        global $data_view,$ot_html01,$tag_num;
        $data_view = [];
        $tag_num = 0;
        function data_viewer(){
            global $data_view,$ot_html01,$tag_num;

            echo $ot_html01;
            $out_html = "<div class='hidebtn' onclick='opentd(\"#tag".$tag_num."\")'><a>追加したキーとデータを表示</a></div>";
            $out_html .= "<div class='tagcloud hide' id='tag".$tag_num."'>";
            foreach($data_view as $data_view_ot){
                $out_html .= "<a>".$data_view_ot[0].":".$data_view_ot[1]."</a>";
            }
            $out_html .= "</div>";
            echo $out_html;
            $data_view = [];
            $tag_num++;
        }
        function add_data($add_data_1){
            global $data_view,$data;
            $data[] = $add_data_1;
            $data_view[] = $add_data_1;
        }
        function data_ref($key)
        {
            global $data,$def_json,$arr;
            if($def_json != false){
                foreach($def_json as $data_key){
                    if($data_key[0] == $key){
                        return $data_key[1];
                    }
                }
                return ''; 
            }
            if($arr != false){
                foreach($arr as $data_key){
                    if($data_key[0] == $key){
                        return $data_key[1];
                    }
                }
                return ''; 
            }
            foreach($data as $data_key){
                if($data_key[0] == $key){
                    return $data_key[1];
                }
            }
            return "";
        }
        ?>
        <br>
        <?php echo $info1.".info5".$info2;?>メモ用
        <input type='text' name='sp-memo-0' value="<?php echo data_ref('sp-memo-0');?>" size="full">
        <?php echo $info1.".info6".$info2;?>URL
        <input type='text' name='sp-memo-1' value="<?php echo data_ref('sp-memo-1');?>" size="full">
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
                    <h2><?php echo $info0.".info7".$info2;?>ネットワーク</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info8".$info2;?>技術</th>
                            <td><input type='text' name='sp-band-8' value="<?php echo data_ref('sp-band-8');?>" size="full"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info9".$info2;?>速度</th>
                            <td><input type='text' name='sp-band-9' value="<?php echo data_ref('sp-band-9');?>" size="full"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info10".$info2;?>バンド</th>
                            <td>
                            <input type="checkbox" name="sp-launch-40-4" value="Yes" class="cb1" id="sl404">
                                <div style='background:#88EAB7;'>
                                    <?php echo $info1.".info10a".$info2;?>・表示される5G<br><br>
                                    <input type='text' name='sp-band-7' value="<?php echo data_ref('sp-band-7');?>" size="full"><br><br>

                                    <?php echo $info1.".info11".$info2;?>・5G各バンド<br><br>
                                    <?php //echo '<label class="checkbox02 w1p5" for="'.$b5g[0].'"><input type="checkbox" name="'.$b5g[0].'" class="cb1" id="'.$b5g[0].'" value="Yes" checked>'.$b5g[1].'</label>';
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
                                            echo '<input type="checkbox" name="'.$b5g[0].'" class="cb1" id="5gband'.$b5g[0].'" value="Yes" checked><label class="checkbox02 w1p5" for="5gband'.$b5g[0].'">'.$b5g[1].'</label>';
                                            $out_txt .= $b5g[1].', ';
                                        }else{
                                            echo '<input type="checkbox" name="'.$b5g[0].'" class="cb1" id="5gband'.$b5g[0].'" value="Yes"><label class="checkbox02 w1p5" for="5gband'.$b5g[0].'">'.$b5g[1].'</label>';

                                        }
                                    }
                                    //echo '<br><br>';.$out_txt
                                    ?><br>
                                </div>
                                <div style='background:white;'>
                                    <?php echo $info1.".info12".$info2;?>・表示される4G<br><br>
                                    <input type='text' name='sp-band-6' value="<?php echo data_ref('sp-band-6');?>" size="full">
                                    <?php echo $info1.".info13".$info2;?>・4G各バンド<br><br>
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
                                            echo '<input type="checkbox" name="'.$bg[0].'" class="cb1" id="4gband'.$bg[0].'" value="Yes" checked><label class="checkbox02 w1p5" for="4gband'.$bg[0].'">'.$bg[1].'</label>';
                                            $out_txt .= $bg[1].', ';
                                        }else{
                                            echo '<input type="checkbox" name="'.$bg[0].'" class="cb1" id="4gband'.$bg[0].'" value="Yes"><label class="checkbox02 w1p5" for="4gband'.$bg[0].'">'.$bg[1].'</label>';
                                        }
                                    }
                                    //echo '<br><br>';.$out_txt
                                    ?><br>
                                </div>
                                <div style='background:#92E8C2;'>
                                    <?php echo $info1.".info14".$info2;?>・表示される3G<br><br>
                                    <input type='text' name='sp-band-5' value="<?php echo data_ref('sp-band-5');?>" size="full">
                                    <?php echo $info1.".info15".$info2;?>・3G各バンド<br><br>
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
                                            echo '<input type="checkbox" name="'.$bg[0].'" class="cb1" id="3gband'.$bg[0].'" value="Yes" checked><label class="checkbox02" for="3gband'.$bg[0].'">'.$bg[1][0].':'.$bg[1][1].'</label><br>';
                                            $out_txt .= $bg[1][0].':'.$bg[1][1].', ';
                                        }else{
                                            echo '<input type="checkbox" name="'.$bg[0].'" class="cb1" id="3gband'.$bg[0].'" value="Yes"><label class="checkbox02" for="3gband'.$bg[0].'">'.$bg[1][0].':'.$bg[1][1].'</label><br>';
                                        }
                                    }
                                    //echo '<br><br>';.$out_txt
                                    ?><br>
                                </div>
                                <div style='background:white;'>
                                    <?php echo $info1.".info16".$info2;?>・表示される2G<br><br>
                                    <input type='text' name='sp-band-4' value="<?php echo data_ref('sp-band-4');?>" size="full">
                                    <?php echo $info1.".info17".$info2;?>・2G各バンド<br><br>
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
                                            echo '<input type="checkbox" name="'.$bg[0].'" class="cb1" id="2gband'.$bg[0].'" value="Yes" checked><label class="checkbox02" for="2gband'.$bg[0].'">'.$bg[1][0].':'.$bg[1][1].'</label><br>';
                                            $out_txt .= $bg[1][0].':'.$bg[1][1].', ';
                                        }else{
                                            echo '<input type="checkbox" name="'.$bg[0].'" class="cb1" id="2gband'.$bg[0].'" value="Yes"><label class="checkbox02" for="2gband'.$bg[0].'">'.$bg[1][0].':'.$bg[1][1].'</label><br>';
                                        }
                                    }?>
                                </div>
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
                    add_data(["sp-launch-4",$html->find( '.specs-phone-name-title', 0 )->plaintext]);
                    ?>
                    <h2><?php echo $info0.".info18".$info2;?>概要</h2>
                    <?php data_viewer();?>
                    <p>IDは後から一斉に設定できるのでここで入力しなくても大丈夫です。</p>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info19".$info2;?>発表日</th>
                            <td><input type='text' name='sp-launch-1' value="<?php echo data_ref('sp-launch-1');?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info20".$info2;?>発売日</th>
                            <td><input type='text' name='sp-launch-2' value="<?php echo data_ref('sp-launch-2');?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info21".$info2;?>未発表の場合の期待される発表日</th>
                            <td><input type='text' name='sp-launch-13' value="<?php echo data_ref('sp-launch-13');?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info22".$info2;?>細かいやつら</th>
                            <td>
                                <input type="checkbox" name="sp-launch-15" value="Yes"<?php if(data_ref('sp-launch-15') == 'Yes')echo ' checked';?> class='cb1' id='sl15'><label for="sl15" class="checkbox02">これがメイン表示の場合</label><br>
                                <input type="checkbox" name="sp-launch-12" value="Yes"<?php if(data_ref('sp-launch-12') == 'Yes')echo ' checked';?> class='cb1' id='sl12'><label for="sl12" class="checkbox02">リーク</label><br>
                                <input type="checkbox" name="sp-launch-14" value="Yes"<?php if(data_ref('sp-launch-14') == 'Yes')echo ' checked';?> class='cb1' id='sl14'><label for="sl14" class="checkbox02">日本で発売されたやつ</label><br>
                                <input type="checkbox" name="sp-extra-5" value="Yes"<?php if(data_ref('sp-extra-5') == 'Yes')echo ' checked';?> class='cb1' id='se5'><label for="se5" class="checkbox02">技適認証</label><br>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info23".$info2;?>地域</th>
                            <td>
                                <?php
                                    $input_checks = explode(':','sp-launch-29,日本:sp-launch-30,中国:sp-launch-31,インド:sp-launch-32,韓国:sp-launch-33,アメリカ:sp-launch-34,EU:sp-launch-35,グローバル');

                                    foreach($input_checks as $input_check ){
                                        $input_check = explode(',',$input_check);
                                        echo '<input type="checkbox" name="'.$input_check[0].'" value="Yes"';
                                        if(data_ref($input_check[0]) == 'Yes')echo ' checked';
                                        echo ' class=\'cb1\' id=\''.$input_check[0].'\'><label for="'.$input_check[0].'" class="checkbox02 w1p2">'.$input_check[1].'</label>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info24".$info2;?>端末名</th>
                            <td><input type='text' name='sp-launch-4' value="<?php echo data_ref('sp-launch-4');?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info25".$info2;?>端末id(一意のid)</th>
                            <td><input type='text' name='sp-launch-9' value="<?php echo data_ref('sp-launch-9');?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info26".$info2;?>メインiD</th>
                            <td><input type='text' name='sp-launch-11' value="<?php echo data_ref('sp-launch-11');?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info27".$info2;?>同じスマホ別バージョン(,区切りでid)</th>
                            <td><input type='text' name='sp-launch-16' value="<?php echo data_ref('sp-launch-16');?>" size="full"></td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info28".$info2;?>関連スマホ</th>
                            <td><input type='text' name='sp-launch-10' value="<?php echo data_ref('sp-launch-10');?>" size="full"></td>
                        </tr>
                        <tr>
                            <th>
                                <?php echo $info1.".info29".$info2;?>
                                メーカー
                            </th>
                            <td>
                                <style>
                                    .cb1 {
    display: none;
}
.checkbox02 {
    box-sizing: border-box;
    cursor: pointer;
    display: inline-block;
    padding: 5px 30px;
    font-size:1em;
    position: relative;
    width: auto;
}
.w1p8{
    max-width: calc(100%/8);
    width: calc(100%/8);
}
.w1p7{
    max-width: calc(100%/7.1);
    width: calc(100%/7.1);
}
.w1p6{
    max-width: calc(100%/6.1);
    width: calc(100%/6.1);
}
.w1p5{
    max-width: calc(100%/5.1);
    width: calc(100%/5.1);
}
.w1p4{
    max-width: calc(100%/4.1);
    width: calc(100%/4.1);
}

.w1p3{
    max-width: 32%;
    width: 30%;
}
.w1p2{
    max-width: 48%;
    width: 48%;
}
.checkbox02::before {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 3px;
    content: '';
    display: block;
    height: 16px;
    left: 5px;
    margin-top: -8px;
    position: absolute;
    top: 50%;
    width: 16px;
}
.checkbox02::after {
    border-right: 6px solid #00cccc;
    border-bottom: 3px solid #00cccc;
    content: '';
    display: block;
    height: 20px;
    left: 7px;
    margin-top: -16px;
    opacity: 0;
    position: absolute;
    top: 50%;
    transform: rotate(45deg);
    width: 9px;
}
.cb1:checked + .checkbox02::before {
    border-color: #666;
}
.cb1:checked + .checkbox02::after {
    opacity: 1;
}

/* ラジオボタン02 */
input[type=radio] {
    display: none;
}
.radio02 {
    box-sizing: border-box;
    cursor: pointer;
    display: inline-block;
    padding: 5px 30px;
    position: relative;
    max-width: 32%;
    width: 30%;
}
.radio02::before {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 50%;
    content: '';
    display: block;
    height: 16px;
    left: 5px;
    margin-top: -8px;
    position: absolute;
    top: 50%;
    width: 16px;
}
.radio02::after {
    background: #00cccc;
    border-radius: 50%;
    content: '';
    display: block;
    height: 8px;
    left: 10px;
    margin-top: -3px;
    opacity: 0;
    position: absolute;
    top: 50%;
    width: 8px;
}
input[type=radio]:checked + .radio02::before {
    border-color: #666;
}
input[type=radio]:checked + .radio02::after {
    opacity: 1;
}
.sech{
    margin:2px 0 2px 5px ;border-left: 3px solid orange;padding-left: 1em;text-decoration: none;
}
                                </style>
                                
                                <p class='sech'>Xiaomi</p>
                                <input type="checkbox" name="sp-launch-40-3" value="Yes"<?php if(data_ref('sp-launch-40-3') == 'Yes')echo ' checked';?> class='cb1' id='sl403'><label for="sl403" class="checkbox02 w1p3">xiaomi</label>
                                <input type="checkbox" name="sp-launch-40-4" value="Yes"<?php if(data_ref('sp-launch-40-4') == 'Yes')echo ' checked';?> class='cb1' id='sl404'><label for="sl404" class="checkbox02 w1p3">poco</label>
                                <input type="checkbox" name="sp-launch-40-5" value="Yes"<?php if(data_ref('sp-launch-40-5') == 'Yes')echo ' checked';?> class='cb1' id='sl405'><label for="sl405" class="checkbox02 w1p3">blackshark</label>
                                <input type="checkbox" name="sp-launch-40-6" value="Yes"<?php if(data_ref('sp-launch-40-6') == 'Yes')echo ' checked';?> class='cb1' id='sl406'><label for="sl406" class="checkbox02 w1p3">redmi</label>
                                <p class='sech'>HUAWEI</p>
                                <input type="checkbox" name="sp-launch-40-8" value="Yes"<?php if(data_ref('sp-launch-40-8') == 'Yes')echo ' checked';?> class='cb1' id='sl408'><label for="sl408" class="checkbox02 w1p3">huawei</label>
                                <input type="checkbox" name="sp-launch-40-9" value="Yes"<?php if(data_ref('sp-launch-40-9') == 'Yes')echo ' checked';?> class='cb1' id='sl409'><label for="sl409" class="checkbox02 w1p3">honor</label>
                                <p class='sech'>BBK</p>
                                <input type="checkbox" name="sp-launch-40-7" value="Yes"<?php if(data_ref('sp-launch-40-7') == 'Yes')echo ' checked';?> class='cb1' id='sl407'><label for="sl407" class="checkbox02 w1p3">vivo</label>
                                <input type="checkbox" name="sp-launch-40-10" value="Yes"<?php if(data_ref('sp-launch-40-10') == 'Yes')echo ' checked';?> class='cb1' id='sl4010'><label for="sl4010" class="checkbox02 w1p3">oppo</label>
                                <input type="checkbox" name="sp-launch-40-11" value="Yes"<?php if(data_ref('sp-launch-40-11') == 'Yes')echo ' checked';?> class='cb1' id='sl4011'><label for="sl4011" class="checkbox02 w1p3">oneplus</label>
                                <input type="checkbox" name="sp-launch-40-12" value="Yes"<?php if(data_ref('sp-launch-40-12') == 'Yes')echo ' checked';?> class='cb1' id='sl4012'><label for="sl4012" class="checkbox02 w1p3">raalme</label>
                                
                                <p class='sech'>国産</p>
                                <input type="checkbox" name="sp-launch-40-17" value="Yes"<?php if(data_ref('sp-launch-40-17') == 'Yes')echo ' checked';?> class='cb1' id='sl4017'><label for="sl4017" class="checkbox02 w1p3">sharp</label>
                                <input type="checkbox" name="sp-launch-40-15" value="Yes"<?php if(data_ref('sp-launch-40-15') == 'Yes')echo ' checked';?> class='cb1' id='sl4015'><label for="sl4015" class="checkbox02 w1p3">sony</label>
                                <input type="checkbox" name="sp-launch-40-25" value="Yes"<?php if(data_ref('sp-launch-40-25') == 'Yes')echo ' checked';?> class='cb1' id='sl4025'><label for="sl4025" class="checkbox02 w1p3">rakuten</label>
                                <p class='sech'>ASUS</p>
                                <input type="checkbox" name="sp-launch-40-19" value="Yes"<?php if(data_ref('sp-launch-40-19') == 'Yes')echo ' checked';?> class='cb1' id='sl4019'><label for="sl4019" class="checkbox02 w1p3">ASUS</label>
                                <input type="checkbox" name="sp-launch-40-26" value="Yes"<?php if(data_ref('sp-launch-40-26') == 'Yes')echo ' checked';?> class='cb1' id='sl4026'><label for="sl4026" class="checkbox02 w1p3">ROG</label>
                                <p class='sech'>その他</p>
                                <input type="checkbox" name="sp-launch-40-16" value="Yes"<?php if(data_ref('sp-launch-40-16') == 'Yes')echo ' checked';?> class='cb1' id='sl4016'><label for="sl4016" class="checkbox02 w1p3">samsung</label>
                                <input type="checkbox" name="sp-launch-40-18" value="Yes"<?php if(data_ref('sp-launch-40-18') == 'Yes')echo ' checked';?> class='cb1' id='sl4018'><label for="sl4018" class="checkbox02 w1p3">leica</label>
                                <input type="checkbox" name="sp-launch-40-1" value="Yes"<?php if(data_ref('sp-launch-40-1') == 'Yes')echo ' checked';?> class='cb1' id='sl401'><label for="sl401" class="checkbox02 w1p3">Apple</label>
                                <input type="checkbox" name="sp-launch-40-2" value="Yes"<?php if(data_ref('sp-launch-40-2') == 'Yes')echo ' checked';?> class='cb1' id='sl402'><label for="sl402" class="checkbox02 w1p3">google</label>
                                <input type="checkbox" name="sp-launch-40-20" value="Yes"<?php if(data_ref('sp-launch-40-20') == 'Yes')echo ' checked';?> class='cb1' id='sl4020'><label for="sl4020" class="checkbox02 w1p3">motolora</label>
                                <input type="checkbox" name="sp-launch-40-21" value="Yes"<?php if(data_ref('sp-launch-40-21') == 'Yes')echo ' checked';?> class='cb1' id='sl4021'><label for="sl4021" class="checkbox02 w1p3">lenovo</label>
                                <input type="checkbox" name="sp-launch-40-22" value="Yes"<?php if(data_ref('sp-launch-40-22') == 'Yes')echo ' checked';?> class='cb1' id='sl4022'><label for="sl4022" class="checkbox02 w1p3">meizu</label>
                                <input type="checkbox" name="sp-launch-40-23" value="Yes"<?php if(data_ref('sp-launch-40-23') == 'Yes')echo ' checked';?> class='cb1' id='sl4023'><label for="sl4023" class="checkbox02 w1p3">tcl</label>
                                <input type="checkbox" name="sp-launch-40-24" value="Yes"<?php if(data_ref('sp-launch-40-24') == 'Yes')echo ' checked';?> class='cb1' id='sl4024'><label for="sl4024" class="checkbox02 w1p3">zte</label>
                                <input type="checkbox" name="sp-launch-40-13" value="Yes"<?php if(data_ref('sp-launch-40-13') == 'Yes')echo ' checked';?> class='cb1' id='sl4013'><label for="sl4013" class="checkbox02 w1p3">umidigi</label>
                                <input type="checkbox" name="sp-launch-40-14" value="Yes"<?php if(data_ref('sp-launch-40-14') == 'Yes')echo ' checked';?> class='cb1' id='sl4014'><label for="sl4014" class="checkbox02 w1p3">ouktel</label>
                                
                            </td>
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
                                add_data(['sp-design-14',$ot_html01->find('.nfo', $i)->plaintext]);
                                //手動で変更が必要
                                break;

                            case 'SIM'://sp-network-3スロット
                                //3スロット(nano sim × 2 sdカード)
                                //sp-network-7 dual stand by
                                $before_ttl = 'SIM';
                                $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                                add_data(["sp-network-3",$plaintext]);
                                add_data(["sp-network-9",$plaintext]);
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
                                //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }
                    ?>
                    <h2><?php echo $info0.".info30".$info2;?>サイズ</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info31".$info2;?>サイズ<br><span style='color:red;'>(フォルダブルスマホの場合は展開時)</span></th>
                            <td>
                                縦
                                <input type='text' name='sp-design-0' value="<?php echo data_ref('sp-design-0');?>" size="mini">mm&nbsp;
                                横
                                <input type='text' name='sp-design-4' value="<?php echo data_ref('sp-design-4');?>" size="mini">mm&nbsp;
                                厚み
                                <input type='text' name='sp-design-5' value="<?php echo data_ref('sp-design-5');?>" size="mini">mm<br>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info31a".$info2;?>折りたたみ時のサイズ<br><span style='color:red;'>(フォルダブルスマホの場合)</span></th>
                            <td>
                                <input type="checkbox" name="sp-design-6" value="Yes"<?php if(data_ref('sp-design-6') == 'Yes')echo ' checked';?>>折り畳みができる場合<br>
                                縦
                                <input type='text' name='sp-design-7' value="<?php echo data_ref('sp-design-7');?>" size="mini">mm&nbsp;
                                横
                                <input type='text' name='sp-design-8' value="<?php echo data_ref('sp-design-8');?>" size="mini">mm&nbsp;
                                厚み
                                <input type='text' name='sp-design-9' value="<?php echo data_ref('sp-design-9');?>" size="mini">mm<br>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info32".$info2;?>重さ</th>
                            <td>
                                <input type='text' name='sp-design-1' value="<?php echo data_ref('sp-design-1');?>" size="mini">g
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info32a".$info2;?>重さカスタムテキスト</th>
                            <td>
                                <input type='text' name='sp-design-15' value="<?php echo data_ref('sp-design-15');?>" size="full">
                            </td>
                        </tr> 
                        <tr>
                            <th><?php echo $info1.".info33".$info2;?>素材</th>
                            <td>
                                日本語訳(,区切りで入力)
                                <input type='text' name='sp-design-2' value="<?php echo data_ref('sp-design-2');?>" size="full">
                                英語版(,区切りで入力、スペース削除)
                                <input type='text' name='sp-design-14' value="<?php echo data_ref('sp-design-14');?>" size="full">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info34".$info2;?>SIM</th>
                            <td>
                                日本語版
                                <input type='text' name='sp-network-3' value="<?php echo data_ref('sp-network-3');?>" size="full">
                                英語版
                                <input type='text' name='sp-network-9' value="<?php echo data_ref('sp-network-9');?>" size="full">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info35".$info2;?>SIMスロット追加情報</th>
                            <td>
                                スロットに関する細かい情報やeSIMモデルがあるなど(日本語)
                                <input type='text' name='sp-network-8' value="<?php echo data_ref('sp-network-8');?>" size="full">
                                英語版
                                <input type='text' name='sp-network-18' value="<?php echo data_ref('sp-network-18');?>" size="full">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info36".$info2;?>Dual stand by</th>
                            <td>
                                <input type="checkbox" name="sp-network-7" class="cb1" id="sp-network-7" value="Yes"<?php if(data_ref('sp-network-7') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02" for="sp-network-7">Dual stand byに対応</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info37".$info2;?>防水防塵</th>
                            <td>
                                <input type="checkbox" name="sp-extra-6" value="Yes"<?php if(data_ref('sp-extra-6') == 'Yes')echo ' checked';?> class='cb1' id='se6'><label for="se6" class="checkbox02">防水防塵対応</label>
                                <p class='sech'>IP ?X</p>
                                <input type="checkbox" name="sp-extra-11" value="Yes"<?php if(data_ref('sp-extra-11') == 'Yes')echo ' checked';?>>IP 6X
                                <input type="checkbox" name="sp-extra-12" value="Yes"<?php if(data_ref('sp-extra-12') == 'Yes')echo ' checked';?>>IP 5X
                                <input type="checkbox" name="sp-extra-13" value="Yes"<?php if(data_ref('sp-extra-13') == 'Yes')echo ' checked';?>>IP 4X
                                <input type="checkbox" name="sp-extra-14" value="Yes"<?php if(data_ref('sp-extra-14') == 'Yes')echo ' checked';?>>IP 3X
                                <input type="checkbox" name="sp-extra-15" value="Yes"<?php if(data_ref('sp-extra-15') == 'Yes')echo ' checked';?>>IP 2X
                                <input type="checkbox" name="sp-extra-16" value="Yes"<?php if(data_ref('sp-extra-16') == 'Yes')echo ' checked';?>>IP 1X
                                <input type="checkbox" name="sp-extra-17" value="Yes"<?php if(data_ref('sp-extra-17') == 'Yes')echo ' checked';?>>IP 0X
                                <p class='sech'>IP X?</p>
                                <input type="checkbox" name="sp-extra-18" value="Yes"<?php if(data_ref('sp-extra-18') == 'Yes')echo ' checked';?>>IP X0
                                <input type="checkbox" name="sp-extra-19" value="Yes"<?php if(data_ref('sp-extra-19') == 'Yes')echo ' checked';?>>IP X1
                                <input type="checkbox" name="sp-extra-20" value="Yes"<?php if(data_ref('sp-extra-20') == 'Yes')echo ' checked';?>>IP X2
                                <input type="checkbox" name="sp-extra-21" value="Yes"<?php if(data_ref('sp-extra-21') == 'Yes')echo ' checked';?>>IP X3
                                <input type="checkbox" name="sp-extra-22" value="Yes"<?php if(data_ref('sp-extra-22') == 'Yes')echo ' checked';?>>IP X4
                                <input type="checkbox" name="sp-extra-23" value="Yes"<?php if(data_ref('sp-extra-23') == 'Yes')echo ' checked';?>>IP X5
                                <input type="checkbox" name="sp-extra-24" value="Yes"<?php if(data_ref('sp-extra-24') == 'Yes')echo ' checked';?>>IP X6
                                <input type="checkbox" name="sp-extra-25" value="Yes"<?php if(data_ref('sp-extra-25') == 'Yes')echo ' checked';?>>IP X7
                                <input type="checkbox" name="sp-extra-26" value="Yes"<?php if(data_ref('sp-extra-26') == 'Yes')echo ' checked';?>>IP X8
                                <p class='sech'>MIL規格</p>
                                <input type="checkbox" name="sp-extra-27" value="Yes"<?php if(data_ref('sp-extra-27') == 'Yes')echo ' checked';?>>MIL-STD-810G
                                <input type="checkbox" name="sp-extra-29" value="Yes"<?php if(data_ref('sp-extra-29') == 'Yes')echo ' checked';?>>MIL-STD-810F
                                <input type="checkbox" name="sp-extra-30" value="Yes"<?php if(data_ref('sp-extra-30') == 'Yes')echo ' checked';?>>MIL-STD-810D
                                <p class='sech'>撥水</p>
                                <input type="checkbox" name="sp-extra-10" value="Yes"<?php if(data_ref('sp-extra-10') == 'Yes')echo ' checked';?>>P2i撥水
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info38".$info2;?>IPカスタムtxt</th>
                            <td>
                                <input type='text' name='sp-extra-7' value="<?php echo data_ref('sp-extra-7');?>">	IP68/IP65みたいな感じにかいてある場合
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info39".$info2;?>その他のやつ</th>
                            <td>
                                <input type="checkbox" name="sp-extra-28" class="cb1" id="sp-extra-28" value="Yes"<?php if(data_ref('sp-extra-28') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02" for="sp-extra-28">Apple Pay</label><br>
                                <input type="checkbox" name="sp-extra-31" class="cb1" id="sp-extra-31" value="Yes"<?php if(data_ref('sp-extra-31') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02" for="sp-extra-31">ポップアップゲーミングボタン</label><br>
                                <input type="checkbox" name="sp-extra-32" class="cb1" id="sp-extra-32" value="Yes"<?php if(data_ref('sp-extra-32') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02" for="sp-extra-32">スタイラスペン対応</label><br>
                                <input type="checkbox" name="sp-extra-33" class="cb1" id="sp-extra-33" value="Yes"<?php if(data_ref('sp-extra-33') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02" for="sp-extra-33">プロ・ショルダー・トリガー3.0(400Hz)</label><br>
                                <input type="checkbox" name="sp-extra-33" class="cb1" id="sp-extra-33" value="Yes"<?php if(data_ref('sp-extra-33') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02" for="sp-extra-33">内蔵冷却ファン</label><br>
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
                                $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                                if(strpos($plaintext,', ') !== false){//Super AMOLED, 120Hz, HDR10+, 700 nits (HBM), 1100 nits (peak)
                                    if(explode(', ',$plaintext)[0] != '-'){//
                                        add_data(["sp-screen-3",explode(', ',$plaintext)[0]]);
                                    }
                                }
                                if(strpos($plaintext,'HBM') !== false){//Super AMOLED, 120Hz, HDR10+, 700 nits (HBM), 1100 nits (peak)
                                    //echo end(explode(", ",explode(' nits (HBM)',$plaintext)[0]));
                                    if(is_numeric(end(explode(", ",explode(' nits (HBM)',$plaintext)[0])))){//
                                        add_data(["sp-screen-43",end(explode(", ",explode(' nits (HBM)',$plaintext)[0]))]);
                                    }
                                }
                                if(strpos($plaintext,'peak') !== false){//Super AMOLED, 120Hz, HDR10+, 700 nits (HBM), 1100 nits (peak)
                                    //echo end(explode(", ",explode(' nits (peak)',$plaintext)[0]));
                                    if(is_numeric(end(explode(", ",explode(' nits (peak)',$plaintext)[0])))){//
                                        add_data(["sp-screen-11",end(explode(", ",explode(' nits (peak)',$plaintext)[0]))]);
                                    }
                                }
                                if(strpos($plaintext,'typ') !== false){//Super AMOLED, 120Hz, HDR10+, 700 nits (HBM), 1100 nits (peak)
                                    //echo end(explode(", ",explode(' nits (typ)',$plaintext)[0]));
                                    if(is_numeric(end(explode(", ",explode(' nits (typ)',$plaintext)[0])))){//
                                        add_data(["sp-screen-15",end(explode(", ",explode(' nits (typ)',$plaintext)[0]))]);
                                    }
                                }
                                if(strpos($plaintext,'Hz') !== false){//Super AMOLED, 120Hz, HDR10+, 700 nits (HBM), 1100 nits (peak)
                                    if(is_numeric(end(explode(", ",explode('Hz',$plaintext)[0])))){//
                                        add_data(["sp-screen-8",end(explode(", ",explode('Hz',$plaintext)[0]))]);
                                    }
                                }
                                if(strpos($plaintext,'HDR10') !== false){//Super AMOLED, 120Hz, HDR10+, 700 nits (HBM), 1100 nits (peak)
                                    if(strpos($plaintext,'HDR10+') !== false){
                                        add_data(["sp-screen-27",'Yes']);
                                    }else{
                                        add_data(["sp-screen-28",'Yes']);
                                    }
                                }
                                break;

                            case 'Size':
                                $plaintext = $ot_html01->find('.nfo', $i)->plaintext;

                                //inches
                                if(strpos($plaintext,'inches') !== false){//	5.9 inches, 84.0 cm2 (~82.9% screen-to-body ratio)
                                    if(is_numeric(explode(' inches, ',$plaintext)[0])){//
                                        add_data(["sp-screen-1",explode(' inches, ',$plaintext)[0]]);
                                    }
                                }

                                //ratio
                                if(strpos($plaintext,'screen-to-body ratio') !== false){//	5.9 inches, 84.0 cm2 (~82.9% screen-to-body ratio)
                                    if(is_numeric(explode('~',explode('% screen-to-body ratio)',$plaintext)[0])[1])){//
                                        add_data(["sp-screen-14",explode('~',explode('% screen-to-body ratio)',$plaintext)[0])[1]]);
                                    }
                                }

                                break;

                            case 'Resolution':
                                $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                                if(strpos($plaintext,'pixels') !== false){//	5.9 inches, 84.0 cm2 (~82.9% screen-to-body ratio)
                                    if(is_numeric(explode(' x ',explode(' pixels',$plaintext)[0])[0]) && is_numeric(explode(' x ',explode(' pixels',$plaintext)[0])[1])){//
                                        add_data(["sp-screen-16",explode(' x ',explode(' pixels',$plaintext)[0])[1]]);
                                        add_data(["sp-screen-4",explode(' x ',explode(' pixels',$plaintext)[0])[0]]);
                                    }
                                }
                                if(strpos($plaintext,'ratio') !== false){//	5.9 inches, 84.0 cm2 (~82.9% screen-to-body ratio)
                                    //echo "aaa".end(explode(', ',explode(' ratio',$plaintext)[0]));
                                    if(is_numeric( explode(':',end(explode(', ',explode(' ratio',$plaintext)[0])))[0] ) && is_numeric(explode(':',end(explode(', ',explode(' ratio',$plaintext)[0])))[1])){//1080 x 2400 pixels, 20:9
                                        add_data(["sp-screen-2",explode(':',end(explode(', ',explode(' ratio',$plaintext)[0])))[0]]);
                                        add_data(["sp-screen-17",explode(':',end(explode(', ',explode(' ratio',$plaintext)[0])))[1]]);//pixelと縦横反転
                                    }
                                }

                                //ppi
                                if(strpos($plaintext,'ppi density') !== false){//	5.9 inches, 84.0 cm2 (~82.9% screen-to-body ratio)
                                    if(is_numeric(explode('~',explode(' ppi density',$plaintext)[0])[1])){//
                                        add_data(["sp-screen-6",explode('~',explode(' ppi density',$plaintext)[0])[1]]);
                                    }
                                }
                                break;

                            case 'Protection':
                                $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                                add_data(["sp-screen-0",$plaintext]);
                                add_data(["sp-screen-41",$plaintext]);
                                break;

                            default:
                                $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                                if(strpos($plaintext,'Always-on display') !== false){//default
                                    add_data(["sp-screen-20",'Yes']);
                                }
                                break;
                        }
                    }
                    ?>
                    <h2><?php echo $info0.".info40".$info2;?>スクリーン</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info41".$info2;?>パネル種類（カスタムテキスト）</th>
                            <td>
                                <input type='text' name='sp-screen-3' value="<?php echo data_ref('sp-screen-3');?>">Super AMOLEDや、Retina IPS、Dot Displayなど
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info42".$info2;?>画面補足情報（セカンドディスプレイなど）</th>
                            <td>
                                日本語
                                <input type='text' name='sp-screen-13' value="<?php echo data_ref('sp-screen-13');?>" size='full'>
                                補足情報-英語
                                <input type='text' name='sp-screen-42' value="<?php echo data_ref('sp-screen-42');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info43".$info2;?>画面保護</th>
                            <td>
                                日本語版(:区切りで入力)
                                <input type='text' name='sp-screen-0' value="<?php echo data_ref('sp-screen-0');?>" size='full'>
                                画面保護-英語(:区切りで入力)
                                <input type='text' name='sp-screen-41' value="<?php echo data_ref('sp-screen-41');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info44".$info2;?>インチ</th>
                            <td>
                                <input type='text' name='sp-screen-1' value="<?php echo data_ref('sp-screen-1');?>" size='mini'>inch
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info45".$info2;?>リフレッシュレート</th>
                            <td>
                                <input type='text' name='sp-screen-8' value="<?php echo data_ref('sp-screen-8');?>" size='mini'>Hz
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info46".$info2;?>タッチレート</th>
                            <td>
                                <input type='text' name='sp-screen-9' value="<?php echo data_ref('sp-screen-9');?>" size='mini'>Hz
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info47".$info2;?>輝度</th>
                            <td>
                                typ<input type='text' name='sp-screen-15' value="<?php echo data_ref('sp-screen-15');?>" size='mini'>nits&nbsp;
                                HBM<input type='text' name='sp-screen-43' value="<?php echo data_ref('sp-screen-43');?>" size='mini'>nits&nbsp;
                                peak<input type='text' name='sp-screen-11' value="<?php echo data_ref('sp-screen-11');?>" size='mini'>nits
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info48".$info2;?>画面占有率</th>
                            <td>
                                <input type='text' name='sp-screen-14' value="<?php echo data_ref('sp-screen-14');?>" size='mini'>%
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info49".$info2;?>pixel</th>
                            <td>
                                縦<input type='text' name='sp-screen-16' value="<?php echo data_ref('sp-screen-16');?>" size='mini'>px&nbsp;
                                横<input type='text' name='sp-screen-4' value="<?php echo data_ref('sp-screen-4');?>" size='mini'>px
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info50".$info2;?>アスペクト比</th>
                            <td>
                                縦<input type='text' name='sp-screen-2' value="<?php echo data_ref('sp-screen-2');?>" size='mini'>:&nbsp;&nbsp;&nbsp;
                                横<input type='text' name='sp-screen-17' value="<?php echo data_ref('sp-screen-17');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info51".$info2;?>DPI</th>
                            <td>
                                <input type='text' name='sp-screen-6' value="<?php echo data_ref('sp-screen-6');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info52".$info2;?>表示色</th>
                            <td>
                                <input type='text' name='sp-screen-21' value="<?php echo data_ref('sp-screen-21');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info53".$info2;?>コントラスト比</th>
                            <td>
                                <input type='text' name='sp-screen-10' value="<?php echo data_ref('sp-screen-10');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info54".$info2;?>湾曲ディスプレイの場合の角度</th>
                            <td>
                                <input type='text' name='sp-screen-40' value="<?php echo data_ref('sp-screen-40');?>" size='mini'>°
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info55".$info2;?>インカメラタイプ</th>
                            <td>
                                <input type="checkbox" name="sp-screen-29" class="cb1" id="sp-screen-29" value="Yes"<?php if(data_ref('sp-screen-29') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-29">水滴ノッチ</label>
                                <input type="checkbox" name="sp-screen-30" class="cb1" id="sp-screen-30" value="Yes"<?php if(data_ref('sp-screen-30') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-30">スライドカメラ</label>
                                <input type="checkbox" name="sp-screen-31" class="cb1" id="sp-screen-31" value="Yes"<?php if(data_ref('sp-screen-31') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-31">フリップカメラ</label>
                                <input type="checkbox" name="sp-screen-32" class="cb1" id="sp-screen-32" value="Yes"<?php if(data_ref('sp-screen-32') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-32">中央パンチホール</label>
                                <input type="checkbox" name="sp-screen-33" class="cb1" id="sp-screen-33" value="Yes"<?php if(data_ref('sp-screen-33') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-33">左上パンチホール</label>
                                <input type="checkbox" name="sp-screen-34" class="cb1" id="sp-screen-34" value="Yes"<?php if(data_ref('sp-screen-34') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-34">右上パンチホール</label>
                                <input type="checkbox" name="sp-screen-35" class="cb1" id="sp-screen-35" value="Yes"<?php if(data_ref('sp-screen-35') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-35">ディスプレイ下</label>
                                <input type="checkbox" name="sp-screen-36" class="cb1" id="sp-screen-36" value="Yes"<?php if(data_ref('sp-screen-36') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-36">ベゼル内</label>
                                <input type="checkbox" name="sp-screen-37" class="cb1" id="sp-screen-37" value="Yes"<?php if(data_ref('sp-screen-37') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-37">カメラなし</label>
                                <input type="checkbox" name="sp-screen-38" class="cb1" id="sp-screen-38" value="Yes"<?php if(data_ref('sp-screen-38') == 'Yes')echo ' checked';?>>
                                <label class="checkbox02 w1p2" for="sp-screen-38">ポップアップ</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info56".$info2;?>画面タイプ</th>
                            <td>
                                <input type="checkbox" name="sp-screen-23" class="cb1" id="sp-screen-23" value="Yes"<?php if(data_ref('sp-screen-23') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p4" for="sp-screen-23">有機EL</label>
                                <input type="checkbox" name="sp-screen-24" class="cb1" id="sp-screen-24" value="Yes"<?php if(data_ref('sp-screen-24') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p4" for="sp-screen-24">IPS</label>
                                <input type="checkbox" name="sp-screen-25" class="cb1" id="sp-screen-25" value="Yes"<?php if(data_ref('sp-screen-25') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p4" for="sp-screen-25">TFT</label>
                                <input type="checkbox" name="sp-screen-26" class="cb1" id="sp-screen-26" value="Yes"<?php if(data_ref('sp-screen-26') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p4" for="sp-screen-26">TN</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info57".$info2;?>細かいやつら</th>
                            <td>
                                <input type="checkbox" name="sp-screen-39" class="cb1" id="sp-screen-39" value="Yes"<?php if(data_ref('sp-screen-39') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p2" for="sp-screen-39">湾曲ディスプレイ</label>
                                <input type="checkbox" name="sp-screen-27" class="cb1" id="sp-screen-27" value="Yes"<?php if(data_ref('sp-screen-27') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p2" for="sp-screen-27">HDR10+</label>
                                <input type="checkbox" name="sp-screen-28" class="cb1" id="sp-screen-28" value="Yes"<?php if(data_ref('sp-screen-28') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p2" for="sp-screen-28">HDR10</label>
                                <input type="checkbox" name="sp-screen-22" class="cb1" id="sp-screen-22" value="Yes"<?php if(data_ref('sp-screen-22') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p2" for="sp-screen-22">Dolby Vision</label>
                                <input type="checkbox" name="sp-screen-20" class="cb1" id="sp-screen-20" value="Yes"<?php if(data_ref('sp-screen-20') == 'Yes')echo ' checked';?>><label class="checkbox02 w1p2" for="sp-screen-20">Always-on display</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info57a".$info2;?>第二ディスプレイ</th>
                            <td>
                                二枚目のディスプレイがある場合　<a onclick="opentd('#display2');">この文字をクリック</a>
                                <div id="display2" class='hide'>
                                    ディスプレイの名前 例:サブディスプレイ、カバーディスプレイ、
                                    <input type='text' name='sp-screen-46' value="<?php echo data_ref('sp-screen-46');?>" size='full'>
sp-screen-47 インチ
sp-screen-54 リフレッシュレート
sp-screen-55 タッチレート

sp-screen-65 最低輝度　sp-screen-61 輝度typ　sp-screen-79　輝度HBM　sp-screen-57 最大輝度
sp-screen-60 画面占有率

sp-screen-62 解像度縦px　sp-screen-50 解像度横px

sp-screen-48 アスペクト比縦　sp-screen-63 アスペクト比横

sp-screen-52 DPI
sp-screen-67 表示色
sp-screen-56 コントラスト比
sp-screen-76 湾曲角度

sp-screen-49 パネル種類
sp-screen-51 解像度

sp-screen-59 補足情報
sp-screen-78 補足情報-英語

sp-screen-80 画面保護
sp-screen-77 画面保護-英語
sp-screen-64 画面タイプ　sp-screen-69 有機EL　sp-screen-70 IPS　sp-screen-71 TFT　sp-screen-72 TN

細かいやつら　sp-screen-73 HDR10+　sp-screen-74 HDR10　sp-screen-75 湾曲ディスプレイ　sp-screen-68 Dolby Vision　sp-screen-66 Always-on display


                                </div>
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
                    }?>
                    <h2><?php echo $info0.".info58".$info2;?>ソフトウェア</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info59".$info2;?>OS</th>
                            <td>
                                <input type="checkbox" name="sp-softwear-0" value="Yes"<?php if(data_ref('sp-softwear-0') == 'Yes')echo ' checked';?>>Android
                                <input type="checkbox" name="sp-softwear-1" value="Yes"<?php if(data_ref('sp-softwear-1') == 'Yes')echo ' checked';?>>Harmony
                                <input type="checkbox" name="sp-softwear-2" value="Yes"<?php if(data_ref('sp-softwear-2') == 'Yes')echo ' checked';?>>iOS
                                <input type="checkbox" name="sp-softwear-3" value="Yes"<?php if(data_ref('sp-softwear-3') == 'Yes')echo ' checked';?>>Microsoft Windows 10
                                <input type="checkbox" name="sp-softwear-4" value="Yes"<?php if(data_ref('sp-softwear-4') == 'Yes')echo ' checked';?>>Android Go
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info60".$info2;?>OS ver</th>
                            <td>
                                <input type='text' name='sp-softwear-7' value="<?php echo data_ref('sp-softwear-7');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info61".$info2;?>GMS非対応</th>
                            <td>
                                <input type="checkbox" name="sp-softwear-6" value="Yes"<?php if(data_ref('sp-softwear-6') == 'Yes')echo ' checked';?>>非対応
                            </td>
                        </tr>	
                        <tr>
                            <th><?php echo $info1.".info62".$info2;?>OS更新可能なバージョン</th>
                            <td>
                                <input type='text' name='sp-softwear-9' value="<?php echo data_ref('sp-softwear-9');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info63".$info2;?>UI</th>
                            <td>
                                <input type="checkbox" name="sp-softwear-13" value="Yes"<?php if(data_ref('sp-softwear-13') == 'Yes')echo ' checked';?>>MIUI
                                <input type="checkbox" name="sp-softwear-32" value="Yes"<?php if(data_ref('sp-softwear-32') == 'Yes')echo ' checked';?>>MIUI For POCO
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
                            <th><?php echo $info1.".info64".$info2;?>UI ver</th>
                            <td>
                                <input type='text' name='sp-softwear-8' value="<?php echo data_ref('sp-softwear-8');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info65".$info2;?>UI更新可能なバージョン</th>
                            <td>
                                <input type='text' name='sp-softwear-10' value="<?php echo data_ref('sp-softwear-10');?>" size='mini'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info66".$info2;?>OS追加説明</th>
                            <td>
                                日本語
                                <input type='text' name='sp-softwear-11' value="<?php echo data_ref('sp-softwear-11');?>" size='full'>
                                英語
                                <input type='text' name='sp-softwear-35' value="<?php echo data_ref('sp-softwear-35');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info67".$info2;?>UI追加説明</th>
                            <td>
                                日本語
                                <input type='text' name='sp-softwear-12' value="<?php echo data_ref('sp-softwear-12');?>" size='full'>
                                英語
                                <input type='text' name='sp-softwear-36' value="<?php echo data_ref('sp-softwear-36');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <style>
                                .socida{
                                    background:gray;
                                    display: inline-block;
                                    font-weight:800;
                                    color:white;
                                    margin:2px;
                                    padding:0 4px;
                                    border-radius:4px;
                                }
                            </style>
                            <th><?php echo $info1.".info68".$info2;?>SoC ID</th>
                            <td>
                                <input type='text' name='sp-spec-11' value="<?php echo data_ref('sp-spec-11');?>" size='mini' id='socid'>
                                <p>Q押したら自動入力されます(SoC iD)</p>
                                <h2>Snapdragon 2xx</h2>
                                <a class='socida' onclick="ckinput('socid',0)">215</a>
                                <h2>Snapdragon 4xx</h2>
                                <a class='socida' onclick="ckinput('socid',1)">425</a>
                                <a class='socida' onclick="ckinput('socid',2)">429</a>
                                <a class='socida' onclick="ckinput('socid',3)">430</a>
                                <a class='socida' onclick="ckinput('socid',4)">435</a>
                                <a class='socida' onclick="ckinput('socid',5)">439</a>
                                <a class='socida' onclick="ckinput('socid',6)">450</a>
                                <a class='socida' onclick="ckinput('socid',7)">460</a>
                                <a class='socida' onclick="ckinput('socid',8)">480</a>
                                <h2>Snapdragon 6xx</h2>
                                <a class='socida' onclick="ckinput('socid',9)">617</a>
                                <a class='socida' onclick="ckinput('socid',10)">625</a>
                                <a class='socida' onclick="ckinput('socid',11)">626</a>
                                <a class='socida' onclick="ckinput('socid',12)">630</a>
                                <a class='socida' onclick="ckinput('socid',13)">632</a>
                                <a class='socida' onclick="ckinput('socid',14)">636</a>
                                <a class='socida' onclick="ckinput('socid',15)">650</a>
                                <a class='socida' onclick="ckinput('socid',16)">660</a>
                                <a class='socida' onclick="ckinput('socid',17)">662</a>
                                <a class='socida' onclick="ckinput('socid',18)">665</a>
                                <a class='socida' onclick="ckinput('socid',19)">670</a>
                                <a class='socida' onclick="ckinput('socid',20)">675</a>
                                <a class='socida' onclick="ckinput('socid',21)">678</a>
                                <a class='socida' onclick="ckinput('socid',22)">690</a>
                                <h2>Snapdragon 7xx</h2>
                                <a class='socida' onclick="ckinput('socid',23)">710</a>
                                <a class='socida' onclick="ckinput('socid',24)">712</a>
                                <a class='socida' onclick="ckinput('socid',25)">720G</a>
                                <a class='socida' onclick="ckinput('socid',26)">730</a>
                                <a class='socida' onclick="ckinput('socid',27)">730G</a>
                                <a class='socida' onclick="ckinput('socid',28)">732G</a>
                                <a class='socida' onclick="ckinput('socid',29)">750G</a>
                                <a class='socida' onclick="ckinput('socid',30)">765</a>
                                <a class='socida' onclick="ckinput('socid',31)">765G</a>
                                <a class='socida' onclick="ckinput('socid',32)">768G</a>
                                <a class='socida' onclick="ckinput('socid',33)">778G</a>
                                <a class='socida' onclick="ckinput('socid',34)">780G</a>
                                <h2>Snapdragon 8xx</h2>
                                <a class='socida' onclick="ckinput('socid',35)">810</a>
                                <a class='socida' onclick="ckinput('socid',36)">820</a>
                                <a class='socida' onclick="ckinput('socid',37)">835</a>
                                <a class='socida' onclick="ckinput('socid',38)">845</a>
                                <a class='socida' onclick="ckinput('socid',39)">855</a>
                                <a class='socida' onclick="ckinput('socid',40)">855+</a>
                                <a class='socida' onclick="ckinput('socid',41)">860</a>
                                <a class='socida' onclick="ckinput('socid',42)">865</a>
                                <a class='socida' onclick="ckinput('socid',43)">865+</a>
                                <a class='socida' onclick="ckinput('socid',44)">870</a>
                                <a class='socida' onclick="ckinput('socid',45)">888</a>

                                <h2>MediaTek MT</h2>
                                <a class='socida' onclick="ckinput('socid',81)">MT6737</a>
                                <a class='socida' onclick="ckinput('socid',82)">MT6750</a>
                                <h2>MediaTek P</h2>
                                <a class='socida' onclick="ckinput('socid',83)">P10</a>
                                <a class='socida' onclick="ckinput('socid',84)">P18</a>
                                <a class='socida' onclick="ckinput('socid',85)">P20</a>
                                <a class='socida' onclick="ckinput('socid',87)">P22</a>
                                <a class='socida' onclick="ckinput('socid',88)">P23</a>
                                <a class='socida' onclick="ckinput('socid',90)">P35</a>
                                <a class='socida' onclick="ckinput('socid',92)">P60</a>
                                <a class='socida' onclick="ckinput('socid',93)">P65</a>
                                <a class='socida' onclick="ckinput('socid',94)">P70</a>
                                <a class='socida' onclick="ckinput('socid',98)">P90</a>
                                <a class='socida' onclick="ckinput('socid',99)">P95</a>
                                <h2>MediaTek G</h2>
                                <a class='socida' onclick="ckinput('socid',91)">G35</a>
                                <a class='socida' onclick="ckinput('socid',89)">G25</a>
                                <a class='socida' onclick="ckinput('socid',95)">G70</a>
                                <a class='socida' onclick="ckinput('socid',96)">G80</a>
                                <a class='socida' onclick="ckinput('socid',97)">G85</a>
                                <a class='socida' onclick="ckinput('socid',100)">G90</a>
                                <a class='socida' onclick="ckinput('socid',101)">G90T</a>
                                <a class='socida' onclick="ckinput('socid',102)">G95</a>
                                <h2>MediaTek A</h2>
                                <a class='socida' onclick="ckinput('socid',86)">A22</a>
                                <h2>MediaTek Dimensity</h2>
                                <a class='socida' onclick="ckinput('socid',103)">700</a>
                                <a class='socida' onclick="ckinput('socid',104)">720</a>
                                <a class='socida' onclick="ckinput('socid',105)">800U</a>
                                <a class='socida' onclick="ckinput('socid',106)">800</a>
                                <a class='socida' onclick="ckinput('socid',107)">820</a>
                                <a class='socida' onclick="ckinput('socid',108)">900</a>
                                <a class='socida' onclick="ckinput('socid',109)">1000C</a>
                                <a class='socida' onclick="ckinput('socid',110)">1000L</a>
                                <a class='socida' onclick="ckinput('socid',111)">1000</a>
                                <a class='socida' onclick="ckinput('socid',112)">1000+</a>
                                <a class='socida' onclick="ckinput('socid',113)">1100</a>
                                <a class='socida' onclick="ckinput('socid',114)">1200</a>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info69".$info2;?>CPU構成(本来の構成と異なる場合)</th>
                            <td>
                                core名(GHz):数,core名(GHz):数,core名(GHz):数<br>
                                ex.Kryo 485(2.84 GHz):1,Kryo 485(2.42 GHz):3,Kryo 485(1.78 GHz):4
                                <input type='text' name='sp-spec-2' value="<?php echo data_ref('sp-spec-2');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info70".$info2;?>GPU構成(本来の構成と異なる場合)</th>
                            <td>
                                <input type='text' name='sp-spec-4' value="<?php echo data_ref('sp-spec-4');?>" size='full'>
                            </td>
                        </tr>
                    </table>
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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'Card slot':
                                if(strpos($plaintext,'Unspecified') !== false){
                                    add_data(["sp-spec-10",'Unknown']);
                                }
                                break;

                            case 'Internal':
                                add_data(["sp-spec-10",$plaintext]);
                                break;
                            
                            default:
                                add_data(["sp-spec-8",$plaintext]);
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info71".$info2;?>RAM/ストレージ</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info72".$info2;?>Micro SDカード</th>
                            <td>
                                <input type="checkbox" name="sp-spec-12" value="Unknown"<?php if(data_ref('sp-spec-12') == 'Unknown')echo ' checked';?>>詳細不明な場合
                                <input type="checkbox" name="sp-spec-12" value="Yes"<?php if(data_ref('sp-spec-12') == 'Yes')echo ' checked';?>>対応&nbsp;
                                <input type='text' name='sp-spec-14' value="<?php echo data_ref('sp-spec-14');?>" size='mini'>GB Micro SD最大容量
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info73".$info2;?>NMカード</th>
                            <td>
                                <input type="checkbox" name="sp-spec-20" value="Yes"<?php if(data_ref('sp-spec-20') == 'Yes')echo ' checked';?>>対応&nbsp;
                                <input type='text' name='sp-spec-21' value="<?php echo data_ref('sp-spec-21');?>" size='mini'>GB NMカード最大容量
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info74".$info2;?>メモリGB(この構成のものだけ)</th>
                            <td>
                                <input type='text' id="storage0" name='sp-spec-7' value="<?php echo data_ref('sp-spec-7');?>" size='mini'>GB<br>
                                <a class='socida' onclick="ckinput('storage0',1)">1GB</a>
                                <a class='socida' onclick="ckinput('storage0',2)">2GB</a>
                                <a class='socida' onclick="ckinput('storage0',3)">3GB</a>
                                <a class='socida' onclick="ckinput('storage0',4)">4GB</a>
                                <a class='socida' onclick="ckinput('storage0',5)">5GB</a>
                                <a class='socida' onclick="ckinput('storage0',6)">6GB</a>
                                <a class='socida' onclick="ckinput('storage0',7)">7GB</a>
                                <a class='socida' onclick="ckinput('storage0',8)">8GB</a>
                                <a class='socida' onclick="ckinput('storage0',9)">9GB</a>
                                <a class='socida' onclick="ckinput('storage0',10)">10GB</a>
                                <a class='socida' onclick="ckinput('storage0',11)">11GB</a>
                                <a class='socida' onclick="ckinput('storage0',12)">12GB</a>
                                <a class='socida' onclick="ckinput('storage0',13)">13GB</a>
                                <a class='socida' onclick="ckinput('storage0',14)">14GB</a>
                                <a class='socida' onclick="ckinput('storage0',15)">15GB</a>
                                <a class='socida' onclick="ckinput('storage0',16)">16GB</a>
                                <a class='socida' onclick="ckinput('storage0',17)">17GB</a>
                                <a class='socida' onclick="ckinput('storage0',18)">18GB</a>
                                <a class='socida' onclick="ckinput('storage0',19)">19GB</a>
                                <a class='socida' onclick="ckinput('storage0',20)">20GB</a>
                                <a class='socida' onclick="ckinput('storage0',21)">21GB</a>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info75".$info2;?>メモリ規格(この構成のものだけ)</th>
                            <td>
                                <input type='text' name='sp-spec-6' value="<?php echo data_ref('sp-spec-6');?>">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info76".$info2;?>ストレージ規格(この構成のものだけ)</th>
                            <td>
                                <input type='text' name='sp-spec-8' value="<?php echo data_ref('sp-spec-8');?>">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info77".$info2;?>ストレージGB(この構成のものだけ)</th>
                            <td>
                                <input id="storage1" type='text' name='sp-spec-9' value="<?php echo data_ref('sp-spec-9');?>" size='mini'>GB<br>
                                <a class='socida' onclick="ckinput('storage1',1)">1GB</a>
                                <a class='socida' onclick="ckinput('storage1',2)">2GB</a>
                                <a class='socida' onclick="ckinput('storage1',3)">3GB</a>
                                <a class='socida' onclick="ckinput('storage1',4)">4GB</a>
                                <a class='socida' onclick="ckinput('storage1',8)">8GB</a>
                                <a class='socida' onclick="ckinput('storage1',16)">16GB</a>
                                <a class='socida' onclick="ckinput('storage1',32)">32GB</a>
                                <a class='socida' onclick="ckinput('storage1',64)">64GB</a>
                                <a class='socida' onclick="ckinput('storage1',128)">128GB</a>
                                <a class='socida' onclick="ckinput('storage1',256)">256GB</a>
                                <a class='socida' onclick="ckinput('storage1',512)">512GB</a>
                                <a class='socida' onclick="ckinput('storage1',1000)">1000GB</a>
                                <a class='socida' onclick="ckinput('storage1',1024)">1024GB</a>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info78".$info2;?>他のバージョン</th>
                            <td>
                                使用しない項目(入力はしてください。)
                                <input type='text' name='sp-spec-10' value="<?php echo data_ref('sp-spec-10');?>" size='full'>
                            </td>
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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'Single':
                                add_data(["sp-camera-4",1]);
                                break;

                            case 'Dual':
                                add_data(["sp-camera-4",2]);
                                break;

                            case 'Triple':
                                add_data(["sp-camera-4",3]);
                                break;

                            case 'Quad':
                                add_data(["sp-camera-4",4]);
                                break;

                            case 'Five':
                                add_data(["sp-camera-4",5]);
                                break;

                            case 'Six':
                                add_data(["sp-camera-4",6]);
                                break;

                            case 'Features'://	LED flash, HDR, panorama
                                $Features = [
                                    ['sp-camera-100','LED flash'],
                                    ['sp-camera-101','Dual LED flash'],
                                    ['sp-camera-111','Dual-LED dual-tone flash'],
                                    ['sp-camera-102','Triple-LED flash'],
                                    ['sp-camera-103','triple-LED RGB flash'],
                                    ['sp-camera-104','Quad-LED flash'],
                                    ['sp-camera-105','panorama'],
                                    ['sp-camera-106','auto panorama (motorized rotation)'],
                                    ['sp-camera-107','HDR'],
                                    ['sp-camera-108','auto-HDR'],
                                    ['sp-camera-109','Leica optics'],
                                    ['sp-camera-110','Zeiss optics']
                                ];
                                foreach(explode(', ',$plaintext) as $feature){
                                    foreach($Features as $Feature_array){
                                        if($feature == $Feature_array[1]){
                                            add_data([$Feature_array[0],'Yes']);
                                        }
                                    }
                                }
                                
                                break;

                            case 'Video':
                                add_data(['sp-camera-2',$plaintext]);
                                add_data(['sp-camera-5',$plaintext]);
                                break;
                            
                            default:
                                //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info79".$info2;?>アウトカメラ</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info80".$info2;?>カメラ数</th>
                            <td>
                                カメラ数<input type='text' name='sp-camera-4' value="<?php echo data_ref('sp-camera-4');?>" size='mini'><br>
                                メインカメラとして表示するカメラ<input type='text' name='sp-camera-16' value="<?php echo data_ref('sp-camera-16');?>" size='mini'><br>
                                カメラの補足説明
                                <input type='text' name='sp-camera-14' value="<?php echo data_ref('sp-camera-14');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ1</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera1");'>表示非表示</div>
                                <div id='camera1'>
                                    画素数<input type='text' name='sp-camera-19' value="<?php echo data_ref('sp-camera-19');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-20' value="<?php echo data_ref('sp-camera-20');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-21' value="<?php echo data_ref('sp-camera-21');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-22' value="<?php echo data_ref('sp-camera-22');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-23' value="<?php echo data_ref('sp-camera-23');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='maincamera1' type='text' name='sp-camera-24' value="<?php echo data_ref('sp-camera-24');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera1',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera1',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera1',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera1',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera1',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera1',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera1',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera1',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera1',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera1',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera1',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera1',13)">13(深度)</a>
                                    </div>
                                    <br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-25' value="<?php echo data_ref('sp-camera-25');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-26' value="<?php echo data_ref('sp-camera-26');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ2</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera2");'>表示非表示</div>
                                <div id='camera2' class='hide'>
                                    画素数<input type='text' name='sp-camera-29' value="<?php echo data_ref('sp-camera-29');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-30' value="<?php echo data_ref('sp-camera-30');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-31' value="<?php echo data_ref('sp-camera-31');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-32' value="<?php echo data_ref('sp-camera-32');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-33' value="<?php echo data_ref('sp-camera-33');?>" size='mini'>µm&nbsp;
                                    カメラ<input  id='maincamera2' type='text' name='sp-camera-34' value="<?php echo data_ref('sp-camera-34');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera2',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera2',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera2',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera2',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera2',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera2',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera2',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera2',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera2',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera2',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera2',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera2',13)">13(深度)</a>
                                    </div><br>
                                    <input type='text' name='sp-camera-35' value="<?php echo data_ref('sp-camera-35');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-36' value="<?php echo data_ref('sp-camera-36');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ3</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera3");'>表示非表示</div>
                                <div id='camera3' class='hide'>
                                    画素数<input type='text' name='sp-camera-39' value="<?php echo data_ref('sp-camera-39');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-40' value="<?php echo data_ref('sp-camera-40');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-41' value="<?php echo data_ref('sp-camera-41');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-42' value="<?php echo data_ref('sp-camera-42');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-43' value="<?php echo data_ref('sp-camera-43');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='maincamera3' type='text' name='sp-camera-44' value="<?php echo data_ref('sp-camera-44');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera3',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera3',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera3',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera3',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera3',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera3',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera3',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera3',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera3',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera3',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera3',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera3',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-45' value="<?php echo data_ref('sp-camera-45');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-46' value="<?php echo data_ref('sp-camera-46');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ4</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera4");'>表示非表示</div>
                                <div id='camera4' class='hide'>
                                    画素数<input type='text' name='sp-camera-49' value="<?php echo data_ref('sp-camera-49');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-50' value="<?php echo data_ref('sp-camera-50');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-51' value="<?php echo data_ref('sp-camera-51');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-52' value="<?php echo data_ref('sp-camera-52');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-53' value="<?php echo data_ref('sp-camera-53');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='maincamera4' type='text' name='sp-camera-54' value="<?php echo data_ref('sp-camera-54');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera4',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera4',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera4',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera4',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera4',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera4',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera4',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera4',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera4',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera4',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera4',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera4',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-55' value="<?php echo data_ref('sp-camera-55');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-56' value="<?php echo data_ref('sp-camera-56');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ5</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera5");'>表示非表示</div>
                                <div id='camera5' class='hide'>
                                    画素数<input type='text' name='sp-camera-59' value="<?php echo data_ref('sp-camera-59');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-60' value="<?php echo data_ref('sp-camera-60');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-61' value="<?php echo data_ref('sp-camera-61');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-62' value="<?php echo data_ref('sp-camera-62');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-63' value="<?php echo data_ref('sp-camera-63');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='maincamera5' type='text' name='sp-camera-64' value="<?php echo data_ref('sp-camera-64');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera5',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera5',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera5',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera5',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera5',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera5',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera5',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera5',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera5',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera5',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera5',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera5',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-65' value="<?php echo data_ref('sp-camera-65');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-66' value="<?php echo data_ref('sp-camera-66');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ6</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera6");'>表示非表示</div>
                                <div id='camera6' class='hide'>
                                    画素数<input type='text' name='sp-camera-69' value="<?php echo data_ref('sp-camera-69');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-70' value="<?php echo data_ref('sp-camera-70');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-71' value="<?php echo data_ref('sp-camera-71');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-72' value="<?php echo data_ref('sp-camera-72');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-73' value="<?php echo data_ref('sp-camera-73');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='maincamera6'type='text' name='sp-camera-74' value="<?php echo data_ref('sp-camera-74');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera6',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera6',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera6',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera6',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera6',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera6',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera6',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera6',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera6',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera6',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera6',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera6',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-75' value="<?php echo data_ref('sp-camera-75');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-76' value="<?php echo data_ref('sp-camera-76');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ7</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera7");'>表示非表示</div>
                                <div id='camera7' class='hide'>
                                    画素数<input type='text' name='sp-camera-79' value="<?php echo data_ref('sp-camera-79');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-80' value="<?php echo data_ref('sp-camera-80');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-81' value="<?php echo data_ref('sp-camera-81');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-82' value="<?php echo data_ref('sp-camera-82');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-83' value="<?php echo data_ref('sp-camera-83');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='maincamera7' type='text' name='sp-camera-84' value="<?php echo data_ref('sp-camera-84');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera7',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera7',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera7',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera7',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera7',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera7',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera7',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera7',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera7',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera7',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera7',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera7',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-85' value="<?php echo data_ref('sp-camera-85');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-86' value="<?php echo data_ref('sp-camera-86');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info81".$info2;?>カメラ8</th>
                            <td>
                                <div class='socida' onclick='opentd("#camera8");'>表示非表示</div>
                                <div id='camera8' class='hide'>
                                    画素数<input type='text' name='sp-camera-89' value="<?php echo data_ref('sp-camera-89');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-90' value="<?php echo data_ref('sp-camera-90');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-91' value="<?php echo data_ref('sp-camera-91');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-92' value="<?php echo data_ref('sp-camera-92');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-93' value="<?php echo data_ref('sp-camera-93');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='maincamera8' type='text' name='sp-camera-94' value="<?php echo data_ref('sp-camera-94');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('maincamera8',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('maincamera8',2)">2(望遠)</a>
                                        <a onclick="ckinput('maincamera8',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('maincamera8',5)">5(ズーム)</a>
                                        <a onclick="ckinput('maincamera8',6)">6(広角)</a>
                                        <a onclick="ckinput('maincamera8',7)">7(超広角)</a>
                                        <a onclick="ckinput('maincamera8',8)">8(ToF)</a>
                                        <a onclick="ckinput('maincamera8',9)">9(赤外線)</a>
                                        <a onclick="ckinput('maincamera8',10)">10(マクロ)</a>
                                        <a onclick="ckinput('maincamera8',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('maincamera8',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('maincamera8',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-95' value="<?php echo data_ref('sp-camera-95');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-96' value="<?php echo data_ref('sp-camera-96');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info82".$info2;?>特徴(Features)</th>
                            <td>
                                <?php
                                    $input_checks = explode(':','sp-camera-100,LED flash(LEDフラッシュ):sp-camera-111,dual-tone flash(デュアルトーンLEDフラッシュ):sp-camera-101,Dual LED flash(デュアルLEDフラッシュ):sp-camera-102,Triple-LED flash(トリプルLEDフラッシュ):sp-camera-103,triple-LED RGB flash(トリプルRGBLEDフラッシュ):sp-camera-104,Quad-LED flash(クアッドLEDフラッシュ):sp-camera-105,panorama(パノラマ):sp-camera-106,auto panorama (motorized rotation)(自動パノラマ撮影(電動回転)):sp-camera-107,HDR(HDR):sp-camera-108,auto-HDR(auto-HDR):sp-camera-109,Leica optics(Leicaカメラ):sp-camera-110,Zeiss optics(Zeissカメラ)');

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
                            <th><?php echo $info1.".info83".$info2;?>動画</th>
                            <td>
                                動画-日本語版
                                <input type='text' name='sp-camera-5' value="<?php echo data_ref('sp-camera-5');?>" size='full'>
                                動画-英語
                                <input type='text' name='sp-camera-2' value="<?php echo data_ref('sp-camera-2');?>" size='full'>
                                <?php
                                    $input_checks = explode(':','sp-camera-113,HDR10+:sp-camera-114,OIS:sp-camera-115,gyro-EIS:sp-camera-116,stereo sound rec:sp-camera-117,HDR');

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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'Single':
                                add_data(["sp-camera-12",1]);
                                break;

                            case 'Dual':
                                add_data(["sp-camera-12",2]);
                                break;

                            case 'Triple':
                                add_data(["sp-camera-12",3]);
                                break;

                            case 'Quad':
                                add_data(["sp-camera-12",4]);
                                break;

                            case 'Five':
                                add_data(["sp-camera-12",5]);
                                break;

                            case 'Six':
                                add_data(["sp-camera-12",6]);
                                break;

                            case 'Features':
                                $Features = [
                                    ['sp-camera-113','HDR10+'],
                                    ['sp-camera-114','OIS'],
                                    ['sp-camera-115','gyro-EIS'],
                                    ['sp-camera-116','stereo sound rec'],
                                    ['sp-camera-117','HDR']
                                ];
                                foreach(explode(', ',$plaintext) as $feature){
                                    foreach($Features as $Feature_array){
                                        if($feature == $Feature_array[1]){
                                            add_data([$Feature_array[0],'Yes']);
                                        }
                                    }
                                }
                                break;

                            case 'Video':
                                add_data(['sp-camera-201',$plaintext]);
                                add_data(['sp-camera-202',$plaintext]);
                                break;
                            
                            default:
                                //echo 'Speed';
                                echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info84".$info2;?>インカメラ</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info85".$info2;?>インカメラ数</th>
                            <td>
                                インカメラ数<input type='text' name='sp-camera-12' value="<?php echo data_ref('sp-camera-12');?>" size='mini'><br>
                                メインカメラとして表示するインカメラ<input type='text' name='sp-camera-17' value="<?php echo data_ref('sp-camera-17');?>" size='mini'><br>
                                インカメラの補足説明
                                <input type='text' name='sp-camera-18' value="<?php echo data_ref('sp-camera-18');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info86".$info2;?>カメラ1</th>
                            <td>
                                <div onclick='opentd("#incamera1");'>表示非表示</div>
                                <div id='incamera1'>
                                    画素数<input type='text' name='sp-camera-121' value="<?php echo data_ref('sp-camera-121');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-122' value="<?php echo data_ref('sp-camera-122');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-123' value="<?php echo data_ref('sp-camera-123');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-124' value="<?php echo data_ref('sp-camera-124');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-125' value="<?php echo data_ref('sp-camera-125');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='in1' type='text' name='sp-camera-126' value="<?php echo data_ref('sp-camera-126');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('in1',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('in1',2)">2(望遠)</a>
                                        <a onclick="ckinput('in1',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('in1',5)">5(ズーム)</a>
                                        <a onclick="ckinput('in1',6)">6(広角)</a>
                                        <a onclick="ckinput('in1',7)">7(超広角)</a>
                                        <a onclick="ckinput('in1',8)">8(ToF)</a>
                                        <a onclick="ckinput('in1',9)">9(赤外線)</a>
                                        <a onclick="ckinput('in1',10)">10(マクロ)</a>
                                        <a onclick="ckinput('in1',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('in1',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('in1',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-127' value="<?php echo data_ref('sp-camera-127');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-128' value="<?php echo data_ref('sp-camera-128');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info86".$info2;?>カメラ2</th>
                            <td>
                                <div onclick='opentd("#incamera2");'>表示非表示</div>
                                <div id='incamera2' class='hide'>
                                    画素数<input type='text' name='sp-camera-131' value="<?php echo data_ref('sp-camera-131');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-132' value="<?php echo data_ref('sp-camera-132');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-133' value="<?php echo data_ref('sp-camera-133');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-134' value="<?php echo data_ref('sp-camera-134');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-135' value="<?php echo data_ref('sp-camera-135');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='in2' type='text' name='sp-camera-136' value="<?php echo data_ref('sp-camera-136');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('in2',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('in2',2)">2(望遠)</a>
                                        <a onclick="ckinput('in2',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('in2',5)">5(ズーム)</a>
                                        <a onclick="ckinput('in2',6)">6(広角)</a>
                                        <a onclick="ckinput('in2',7)">7(超広角)</a>
                                        <a onclick="ckinput('in2',8)">8(ToF)</a>
                                        <a onclick="ckinput('in2',9)">9(赤外線)</a>
                                        <a onclick="ckinput('in2',10)">10(マクロ)</a>
                                        <a onclick="ckinput('in2',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('in2',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('in2',13)">13(深度)</a>
                                    </div><br>
                                    <input type='text' name='sp-camera-137' value="<?php echo data_ref('sp-camera-137');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-138' value="<?php echo data_ref('sp-camera-138');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info86".$info2;?>カメラ3</th>
                            <td>
                                <div onclick='opentd("#incamera3");'>表示非表示</div>
                                <div id='incamera3' class='hide'>
                                    画素数<input type='text' name='sp-camera-141' value="<?php echo data_ref('sp-camera-141');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-142' value="<?php echo data_ref('sp-camera-142');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-143' value="<?php echo data_ref('sp-camera-143');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-144' value="<?php echo data_ref('sp-camera-144');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-145' value="<?php echo data_ref('sp-camera-145');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='in3' type='text' name='sp-camera-146' value="<?php echo data_ref('sp-camera-146');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('in3',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('in3',2)">2(望遠)</a>
                                        <a onclick="ckinput('in3',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('in3',5)">5(ズーム)</a>
                                        <a onclick="ckinput('in3',6)">6(広角)</a>
                                        <a onclick="ckinput('in3',7)">7(超広角)</a>
                                        <a onclick="ckinput('in3',8)">8(ToF)</a>
                                        <a onclick="ckinput('in3',9)">9(赤外線)</a>
                                        <a onclick="ckinput('in3',10)">10(マクロ)</a>
                                        <a onclick="ckinput('in3',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('in3',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('in3',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-147' value="<?php echo data_ref('sp-camera-147');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-148' value="<?php echo data_ref('sp-camera-148');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info86".$info2;?>カメラ4</th>
                            <td>
                                <div onclick='opentd("#incamera4");'>表示非表示</div>
                                <div id='incamera4' class='hide'>
                                    画素数<input type='text' name='sp-camera-151' value="<?php echo data_ref('sp-camera-151');?>" size='mini'>MP&nbsp;
                                    F値 f/<input type='text' name='sp-camera-152' value="<?php echo data_ref('sp-camera-152');?>" size='mini'>&nbsp;
                                    焦点距離<input type='text' name='sp-camera-153' value="<?php echo data_ref('sp-camera-153');?>" size='mini'>mm&nbsp;
                                    センサーサイズ<input type='text' name='sp-camera-154' value="<?php echo data_ref('sp-camera-154');?>" size='mini'>"&nbsp;
                                    ピクセルサイズ<input type='text' name='sp-camera-155' value="<?php echo data_ref('sp-camera-155');?>" size='mini'>µm&nbsp;
                                    カメラ<input id='in4' type='text' name='sp-camera-156' value="<?php echo data_ref('sp-camera-156');?>" size='mini'><br>
                                    複数兼ねてる場合は,で入力<br>
                                    <div class="tagcloud2">
                                        <a onclick="ckinput('in4',1)">1(メインカメラ)</a>
                                        <a onclick="ckinput('in4',2)">2(望遠)</a>
                                        <a onclick="ckinput('in4',3)">3(ペリスコープ)</a>
                                        <a onclick="ckinput('in4',5)">5(ズーム)</a>
                                        <a onclick="ckinput('in4',6)">6(広角)</a>
                                        <a onclick="ckinput('in4',7)">7(超広角)</a>
                                        <a onclick="ckinput('in4',8)">8(ToF)</a>
                                        <a onclick="ckinput('in4',9)">9(赤外線)</a>
                                        <a onclick="ckinput('in4',10)">10(マクロ)</a>
                                        <a onclick="ckinput('in4',11)">11(モノクロ)</a>
                                        <a onclick="ckinput('in4',12)">12(ポートレート)</a>
                                        <a onclick="ckinput('in4',13)">13(深度)</a>
                                    </div><br>
                                    機能(,区切りで定義)PDAF, OIS<br>
                                    <input type='text' name='sp-camera-157' value="<?php echo data_ref('sp-camera-157');?>" size='full'>
                                    機能-英語<br>
                                    <input type='text' name='sp-camera-158' value="<?php echo data_ref('sp-camera-158');?>" size='full'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info87".$info2;?>特徴(Features)</th>
                            <td>

                                <?php
                                    $input_checks = explode(':','sp-camera-204,デュアルビデオ通話(Dual video call):sp-camera-205,Auto-HDR(Auto-HDR):sp-camera-206,パノラマ(panorama):sp-camera-207,デュアルLEDフラッシュ(Dual-LED flash):sp-camera-208,HDR(HDR)');

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
                            <th><?php echo $info1.".info88".$info2;?>インカメラ動画</th>
                            <td>
                                インカメラ動画-日本語版
                                <input type='text' name='sp-camera-202' value="<?php echo data_ref('sp-camera-202');?>" size='full'>
                                インカメラ動画
                                <input type='text' name='sp-camera-201' value="<?php echo data_ref('sp-camera-201');?>" size='full'>
                                <?php
                                    $input_checks = explode(':','sp-camera-210,HDR10+:sp-camera-211,OIS:sp-camera-212,gyro-EIS:sp-camera-213,stereo sound rec:sp-camera-214,HDR');

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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'Loudspeaker ':
                                if(strpos($plaintext,'Yes') !== false){
                                    add_data(["sp-extra-37",'Yes']);
                                }
                                if(strpos($plaintext,'Unspecified') !== false){
                                    add_data(["sp-extra-37",'Unknwon']);
                                }
                                break;

                            case '3.5mm jack ':
                                if(strpos($plaintext,'Yes') !== false){
                                    add_data(["sp-extra-4",'Yes']);
                                }
                                if(strpos($plaintext,'Unspecified') !== false){
                                    add_data(["sp-extra-4",'Unknwon']);
                                }
                                break;
                            
                            default:
                                if(strpos($plaintext,'24-bit/192kHz') !== false){
                                    add_data(["sp-extra-44",'Yes']);
                                }
                                if(strpos($plaintext,'32-bit/384kHz') !== false){
                                    add_data(["sp-extra-45",'Yes']);
                                }
                                if(strpos($plaintext,'Tuned by Harman Kardon') !== false){
                                    add_data(["sp-extra-47",'Yes']);
                                }
                                if(strpos($plaintext,'Tuned by JBL') !== false){
                                    add_data(["sp-extra-48",'Yes']);
                                }
                                if(strpos($plaintext,'Tuned by AKG') !== false){
                                    add_data(["sp-extra-49",'Yes']);
                                }
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info89".$info2;?>オーディオ</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info90".$info2;?>3.5mmイヤホンジャック</th>
                            <td>
                                <input type="checkbox" name="sp-extra-4" value="Yes"<?php if(data_ref('sp-extra-4') == 'Yes')echo ' checked';?>>対応
                                <input type="checkbox" name="sp-extra-4" value="Unknown"<?php if(data_ref('sp-extra-37') == 'Unknown')echo ' checked';?>>不明
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info91".$info2;?>通話用スピーカー(Loudspeaker)</th>
                            <td>
                                <input type="checkbox" name="sp-extra-37" value="Yes"<?php if(data_ref('sp-extra-37') == 'Yes')echo ' checked';?>>対応
                                <input type="checkbox" name="sp-extra-37" value="Unknown"<?php if(data_ref('sp-extra-37') == 'Unknown')echo ' checked';?>>不明
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info92".$info2;?>デュアルスピーカー</th>
                            <td>
                                <input type="checkbox" name="sp-extra-38" value="Yes"<?php if(data_ref('sp-extra-38') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-38'><label for="sp-extra-38" class="checkbox02">対応</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info93".$info2;?>ステレオスピーカー</th>
                            <td>
                                <input type="checkbox" name="sp-extra-42" value="Yes"<?php if(data_ref('sp-extra-42') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-42'><label for="sp-extra-42" class="checkbox02">対応</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info94".$info2;?>デュアルスピーカー（ステレオ）</th>
                            <td>
                                <input type="checkbox" name="sp-extra-39" value="Yes"<?php if(data_ref('sp-extra-39') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-39'><label for="sp-extra-39" class="checkbox02">対応</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info95".$info2;?>トリプルスピーカー（ステレオ）</th>
                            <td>
                                <input type="checkbox" name="sp-extra-40" value="Yes"<?php if(data_ref('sp-extra-40') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-40'><label for="sp-extra-40" class="checkbox02">対応</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info96".$info2;?>クアッドスピーカー(ステレオ)</th>
                            <td>
                                <input type="checkbox" name="sp-extra-41" value="Yes"<?php if(data_ref('sp-extra-41') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-41'><label for="sp-extra-41" class="checkbox02">対応</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info97".$info2;?>その他</th>
                            <td>
                                <input type="checkbox" name="sp-extra-44" value="Yes"<?php if(data_ref('sp-extra-44') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-44'><label for="sp-extra-44" class="checkbox02">24-bit/192kHz</label><br>
                                <input type="checkbox" name="sp-extra-45" value="Yes"<?php if(data_ref('sp-extra-45') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-45'><label for="sp-extra-45" class="checkbox02">32-bit/384kHz</label><br>
                                <input type="checkbox" name="sp-extra-49" value="Yes"<?php if(data_ref('sp-extra-49') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-49'><label for="sp-extra-49" class="checkbox02">Tuned by AKG</label><br>
                                <input type="checkbox" name="sp-extra-48" value="Yes"<?php if(data_ref('sp-extra-48') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-48'><label for="sp-extra-48" class="checkbox02">Tuned by JBL</label><br>
                                <input type="checkbox" name="sp-extra-47" value="Yes"<?php if(data_ref('sp-extra-47') == 'Yes')echo ' checked';?> class='cb1' id='sp-extra-47'><label for="sp-extra-47" class="checkbox02">Tuned by Harman Kardon</label>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info102".$info2;?>オーディオ追加説明</th>
                            <td>
                                日本語    
                                <input type='text' name='sp-extra-52' value="<?php echo data_ref('sp-extra-52');?>" size='full'>
                                英語
                                <input type='text' name='sp-extra-53' value="<?php echo data_ref('sp-extra-53');?>" size='full'>
                            </td>
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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'WLAN':
                                //Unspecified
                                if(str_replace(" ","",$plaintext) == 'Unspecified'){
                                    add_data(["sp-network-0",'Unknown']);
                                    break;
                                }
                                
                                //yes
                                if(str_replace(" ","",$plaintext) == 'Yes'){
                                    add_data(["sp-network-0",'Yes']);
                                    break;
                                }
                                
                                foreach(explode(', ',$plaintext) as $wlan){
                                    switch($wlan){
                                        case 'dual-band':
                                            add_data(["sp-network-38",'Yes']);
                                            break;

                                        case 'Wi-Fi Direct':
                                            add_data(["sp-network-39",'Yes']);
                                            break;

                                        case 'hotspot':
                                            add_data(["sp-network-40",'Yes']);
                                            break;

                                        case 'DLNA':
                                            add_data(["sp-network-41",'Yes']);
                                            break;

                                        default:
                                            if(strpos($wlan,'Wi-Fi 802.11 ') !== false){
                                                add_data(["sp-network-0",'Yes']);
                                                foreach(explode('/',str_replace("Wi-Fi 802.11 ","",$wlan)) as $ieee){
                                                    switch($ieee){
                                                        case 'a':
                                                            add_data(["sp-network-10",'Yes']);
                                                            break;
                                                        
                                                        case 'b':
                                                            add_data(["sp-network-11",'Yes']);
                                                            break;

                                                        case 'g':
                                                            add_data(["sp-network-12",'Yes']);
                                                            break;

                                                        case 'n':
                                                            add_data(["sp-network-13",'Yes']);
                                                            break;

                                                        case 'ac':
                                                            add_data(["sp-network-14",'Yes']);
                                                            break;

                                                        case '6':
                                                            add_data(["sp-network-15",'Yes']);
                                                            break;

                                                        case '6e':
                                                            add_data(["sp-network-16",'Yes']);
                                                            break;

                                                        default:
                                                            error_repo('WLAN',$ieee);
                                                            break;
                                                    }
                                                }
                                            }
                                            break;
                                    }
                                }
                                break;

                            case 'Bluetooth':
                                if(str_replace(" ","",$plaintext) == 'Unspecified'){
                                    add_data(["sp-network-1",'Unknown']);
                                }elseif(str_replace(" ","",$plaintext) == 'Yes'){
                                    add_data(["sp-network-1",'Yes']);
                                }else{//5.2, A2DP, LE, aptX HD, aptX Adaptive
                                    add_data(["sp-network-1",'Yes']);
                                    if(is_numeric(explode(', ',$plaintext)[0])){
                                        add_data(["sp-network-2",explode(', ',$plaintext)[0]]);
                                    }
                                    
                                    foreach(explode(', ',$plaintext) as $bt){
                                        switch($bt){
                                            case 'A2DP':
                                                add_data(["sp-network-19",'Yes']);
                                                break;

                                            case 'aptX HD':
                                                add_data(["sp-network-21",'Yes']);
                                                break;

                                            case 'LE':
                                                add_data(["sp-network-20",'Yes']);
                                                break;

                                            case 'aptX Adaptive':
                                                add_data(["sp-network-22",'Yes']);
                                                break;

                                            default:
                                                if(is_numeric($bt)){
                                                    //array 0
                                                }else{
                                                    error_repo('Bluetooth',$bt);
                                                }
                                                break;
                                        }
                                    }
                                }
                                break;
                            
                            case 'GPS':
                                if(str_replace(" ","",$plaintext) == 'Unspecified'){
                                    add_data(["sp-network-29",'Unknown']);
                                }elseif(str_replace(" ","",$plaintext) == 'Yes'){
                                    add_data(["sp-network-29",'Yes']);
                                }else{// with dual-band A-GPS, GLONASS, GALILEO, BDS, QZSS, NavIC
                                    add_data(["sp-network-29",'Yes']);
                                    
                                    foreach(explode(', ',str_replace("Yes, with ","",$plaintext)) as $gps){
                                        switch($gps){

                                            case 'dual-band A-GPS':
                                                add_data(["sp-network-37",'Yes']);
                                                break;

                                            case 'A-GPS':
                                                add_data(["sp-network-30",'Yes']);
                                                break;
                                                
                                            case 'GLONASS':
                                                add_data(["sp-network-31",'Yes']);
                                                break;

                                            case 'BDS':
                                                add_data(["sp-network-32",'Yes']);
                                                break;

                                            case '':
                                                add_data(["sp-network-",'Yes']);
                                                break;

                                            case 'BDS (tri-band)':
                                                add_data(["sp-network-33",'Yes']);
                                                break;

                                            case 'GALILEO':
                                                add_data(["sp-network-34",'Yes']);
                                                break;

                                            case 'QZSS':
                                                add_data(["sp-network-35",'Yes']);
                                                break;

                                            case 'NavIC':
                                                add_data(["sp-network-36",'Yes']);
                                                break;

                                            default:
                                                error_repo('GPS',$gps);
                                                break;
                                        }
                                    }
                                }
                                break;
                            
                            case 'NFC':
                                if(str_replace(" ","",$plaintext) == 'Unspecified'){
                                    add_data(["sp-extra-0",'Unknown']);
                                    break;
                                }elseif(str_replace(" ","",$plaintext) == 'Yes'){
                                    add_data(["sp-extra-0",'Yes']);
                                    break;
                                }else{
                                    error_repo('NFC',$ieee);
                                }
                                break;

                            case 'Infrared port':
                                //yes
                                if(str_replace(" ","",$plaintext) == 'Yes'){
                                    add_data(["sp-extra-9",'Yes']);
                                    break;
                                }
                                break;
                            
                            case 'Radio':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;

                            case 'USB':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                            
                            default:
                                //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info103".$info2;?>ネットワーク</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info104".$info2;?>Wi-Fi</th>
                            <td>
                                <input type="checkbox" name="sp-network-0" value="Yes"<?php if(data_ref('sp-network-0') == 'Yes')echo ' checked';?>>Wi-Fi対応
                                <input type="checkbox" name="sp-network-0" value="Unknown"<?php if(data_ref('sp-network-0') == 'Unknown')echo ' checked';?>>Wi-Fi不明
                                <br>
                                <?php
                                    $input_checks = explode(':','sp-network-10,a:sp-network-11,b:sp-network-12,g:sp-network-13,n:sp-network-14,ac:sp-network-15,ax:sp-network-16,6e');

                                    foreach($input_checks as $input_check ){
                                        $input_check = explode(',',$input_check);
                                        echo '<input type="checkbox" name="'.$input_check[0].'" value="Yes"';
                                        if(data_ref($input_check[0]) == 'Yes')echo ' checked';
                                        echo '>'.$input_check[1];
                                    }
                                ?><br>
                                <?php
                                    $input_checks = explode(':','sp-network-38,Wi-Fi-dual-band:sp-network-39,Wi-Fi-Wi-Fi Direct:sp-network-40,Wi-Fi-hotspot:sp-network-41,Wi-Fi-DLNA');

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
                            <th><?php echo $info1.".info105".$info2;?>ポート情報</th>
                            <td>
                                ポート形状<br>
                                <input type="checkbox" name="sp-extra-62" value="Yes"<?php if(data_ref('sp-extra-62') == 'Yes')echo ' checked';?>>USB Type-C
                                <input type="checkbox" name="sp-extra-63" value="Yes"<?php if(data_ref('sp-extra-63') == 'Yes')echo ' checked';?>>USB Micro-b<br>
                                ポート補足情報[mini hdmiがあるとかそういうやつ]
                                <input type='text' name='' value="<?php echo data_ref('');?>"><br>
                                <?php
                                    $input_checks = explode(':','sp-extra-66,USB Type-C 2.0:sp-extra-67,USB Type-C 2.1:sp-extra-68,USB Type-C 2.2:sp-extra-69,USB Type-C 3.0:sp-extra-70,USB Type-C 3.1:sp-extra-71,USB Type-C 3.2:sp-extra-72,USB Type-C 3.3');

                                    foreach($input_checks as $input_check ){
                                        $input_check = explode(',',$input_check);
                                        echo '<input type="checkbox" name="'.$input_check[0].'" value="Yes"';
                                        if(data_ref($input_check[0]) == 'Yes')echo ' checked';
                                        echo '>'.$input_check[1];
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info106".$info2;?>USB On-The-Go</th>
                            <td>
                                <input type="checkbox" name="sp-extra-74" value="Yes"<?php if(data_ref('sp-extra-74') == 'Yes')echo ' checked';?>>対応
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info107".$info2;?>bluetooth</th>
                            <td>
                                <input type="checkbox" name="sp-network-1" value="Yes"<?php if(data_ref('sp-network-1') == 'Yes')echo ' checked';?>>bluetooth対応
                                <input type="checkbox" name="sp-network-1" value="Unknown"<?php if(data_ref('sp-network-1') == 'Unknown')echo ' checked';?>>bluetooth不明
                                <br>
                                bluetooth ver<br>
                                <input type='text' name='sp-network-2' value="<?php echo data_ref('sp-network-2');?>"><br>
                                <?php
                                    $input_checks = explode(':','sp-network-19,bluetooth-A2DP:sp-network-20,bluetooth-LE:sp-network-21,bluetooth-aptX HD:sp-network-22,bluetooth-aptX Adaptive');

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
                            <th><?php echo $info1.".info108".$info2;?>NFC</th>
                            <td>
                                <input type="checkbox" name="sp-extra-0" value="Yes"<?php if(data_ref('sp-extra-0') == 'Yes')echo ' checked';?>>対応
                                <input type="checkbox" name="sp-extra-0" value="Unknown"<?php if(data_ref('sp-extra-0') == 'Unknown')echo ' checked';?>>不明
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info109".$info2;?>赤外線ポート[Infrared port]</th>
                            <td>
                                <input type="checkbox" name="sp-extra-9" value="Yes"<?php if(data_ref('sp-extra-9') == 'Yes')echo ' checked';?>>対応
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info110".$info2;?>ラジオ</th>
                            <td>
                                <input type="checkbox" name="sp-network-26" value="Yes"<?php if(data_ref('sp-network-26') == 'Yes')echo ' checked';?>>ラジオ対応
                                <input type="checkbox" name="sp-network-26" value="Unknown"<?php if(data_ref('sp-network-26') == 'Unknown')echo ' checked';?>>ラジオ不明
                                <input type="checkbox" name="sp-network-27" value="Yes"<?php if(data_ref('sp-network-27') == 'Yes')echo ' checked';?>>FM radio対応<br>
                                ラジオ説明<br>
                                <input type='text' name='sp-network-28' value="<?php echo data_ref('sp-network-28');?>">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info111".$info2;?>GPS</th>
                            <td>
                                <input type="checkbox" name="sp-network-29" value="Yes"<?php if(data_ref('sp-network-29') == 'Yes')echo ' checked';?>>GPS対応
                                <input type="checkbox" name="sp-network-29" value="Unknown"<?php if(data_ref('sp-network-29') == 'Unknown')echo ' checked';?>>GPS不明
                                <br>
                                ・GPS機能<br>
                                <?php
                                    $input_checks = explode(':','sp-network-37,dual-band A-GPS:sp-network-30,GPS-A-GPS:sp-network-31,GPS-GLONASS:sp-network-32,GPS-BDS:sp-network-33,GPS-BDS (tri-band):sp-network-34,GPS-GALILEO:sp-network-35,GPS-QZSS:sp-network-36,GPS-NavIC');

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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'Sensors':
                                if(strpos($plaintext,'Fingerprint') !== false){
                                    add_data(["sp-sensor-14",'Yes']);
                                }
                                foreach(explode(', ',$plaintext) as $Sensor){
                                    switch($Sensor){
                                        case 'compass':
                                            add_data(["sp-sensor-1",'Yes']);
                                            break;

                                        case 'proximity':
                                            add_data(["sp-sensor-2",'Yes']);
                                            break;

                                        case 'accelerometer':
                                            add_data(["sp-sensor-3",'Yes']);
                                            break;

                                        case 'gyro':
                                            add_data(["sp-sensor-4",'Yes']);
                                            break;

                                        case 'barometer':
                                            add_data(["sp-sensor-5",'Yes']);
                                            break;

                                        case 'Iris scanner':
                                            add_data(["sp-sensor-6",'Yes']);
                                            break;

                                        case 'color spectrum':
                                            add_data(["sp-sensor-10",'Yes']);
                                            break;

                                        default:
                                            error_repo('Sensors',$Sensor);
                                            break;
                                    }
                                }
                                break;

                            default:
                                //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info112".$info2;?>センサー</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info113".$info2;?>センサー類</th>
                            <td>
                                <?php
                                    $input_checks = explode(':','sp-sensor-11,仮想接近センサー(Virtual proximity sensing):sp-sensor-1,コンパス(compass):sp-sensor-2,接近センサー(proximity):sp-sensor-3,加速度センサー(accelerometer):sp-sensor-4,ジャイロセンサー(gyro):sp-sensor-5,気圧センサー(barometer):sp-sensor-6,虹彩センサー(Iris scanner):sp-sensor-7,sensor core:sp-sensor-8,サーモグラフィー:sp-sensor-9,IRセンサー:sp-sensor-10,カラースペクトル(color spectrum)');

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
                            <th><?php echo $info1.".info113a".$info2;?>指紋センサー</th>
                            <td>
                                <?php
                                    $input_checks = explode(':','sp-sensor-14,指紋センサー:sp-sensor-15,指紋センサー-背面:sp-sensor-16,指紋センサー-側面:sp-sensor-17,指紋センサー-右側面:sp-sensor-18,指紋センサー-左側面:sp-sensor-19,指紋センサー-カメラユニットに付属:sp-sensor-20,指紋センサー-画面内:sp-sensor-21,紋センサー-画面内光学式:sp-sensor-22,指紋センサー-画面内超音波式:sp-sensor-23,指紋センサー-ToutchID');

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
                        BATTERY	    Type	    WLi-Po 4000 mAh, non-removable
                                    Charging	Fast charging 30W, 60% in 25 min, 100% in 80 min (advertised)
                                    USB Power   Delivery 3.0
                                    Reverse     charging

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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'Type':
                                if(strpos($plaintext,'Li-Po') !== false){
                                    add_data(["sp-battery-17",'Yes']);
                                }
                                if(strpos($plaintext,'non-removable') !== false){
                                    add_data(["sp-battery-9",'No']);
                                }elseif(strpos($plaintext,'removable') !== false){
                                    add_data(["sp-battery-9",'Yes']);
                                }
                                if(strpos($plaintext,'mAh') !== false){
                                    if(is_numeric(end(explode(' ',explode(' mAh',$plaintext)[0])))){
                                        add_data(["sp-battery-0",end(explode(' ',explode(' mAh',$plaintext)[0]))]);
                                    }
                                }
                                break;

                            case 'Charging':
                                if(strpos($plaintext,'W') !== false){
                                    if(is_numeric(end(explode(' ',explode('W',$plaintext)[0])))){
                                        add_data(["sp-battery-10",end(explode(' ',explode('W',$plaintext)[0]))]);
                                    }
                                }
                                break;
                            
                            default:
                                //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info114".$info2;?>バッテリー</h2>
                    <?php data_viewer();?>
                    <table class='data-table'>            
                        <tr>
                            <th><?php echo $info1.".info115".$info2;?>バッテリー容量</th>
                            <td>
                                <input type='text' name='sp-battery-0' value="<?php echo data_ref('sp-battery-0');?>" size='mini'>mAh
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info116".$info2;?>バッテリーについての補足情報</th>
                            <td>
                                日本語
                                <input type='text' name='sp-battery-1' value="<?php echo data_ref('sp-battery-1');?>" size='full'>
                                英語
                                <input type='text' name='sp-battery-11' value="<?php echo data_ref('sp-battery-11');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info117".$info2;?>バッテリー取り外し可能</th>
                            <td>
                                <input type="checkbox" name="sp-battery-9" value="Yes"<?php if(data_ref('sp-battery-9') == 'Yes')echo ' checked';?>>可能
                                <input type="checkbox" name="sp-battery-9" value="No"<?php if(data_ref('sp-battery-9') == 'No')echo ' checked';?>>不可能
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info118".$info2;?>ワイヤレス規格</th>
                            <td>
                                <input type="checkbox" name="sp-battery-23" value="Yes"<?php if(data_ref('sp-battery-23') == 'Yes')echo ' checked';?>>Qi
                                <input type="checkbox" name="sp-battery-24" value="Yes"<?php if(data_ref('sp-battery-24') == 'Yes')echo ' checked';?>>PMA
                                <input type="checkbox" name="sp-battery-25" value="Yes"<?php if(data_ref('sp-battery-25') == 'Yes')echo ' checked';?>>A4WP
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info119".$info2;?>ワイヤレス充電</th>
                            <td>
                                <input type="checkbox" name="sp-battery-5" value="Yes"<?php if(data_ref('sp-battery-5') == 'Yes')echo ' checked';?>>対応
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info120".$info2;?>ワイヤレス充電速度</th>
                            <td>
                                <input type='text' name='sp-battery-6' value="<?php echo data_ref('sp-battery-6');?>" size='mini'>w
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info121".$info2;?>ワイヤレス逆充電</th>
                            <td>
                                <input type="checkbox" name="sp-battery-20" value="Yes"<?php if(data_ref('sp-battery-20') == 'Yes')echo ' checked';?>>対応
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info122".$info2;?>ワイヤレス逆充電速度</th>
                            <td>
                                <input type='text' name='sp-battery-21' value="<?php echo data_ref('sp-battery-21');?>" size='mini'>w
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info123".$info2;?>充電に関する補足情報</th>
                            <td>
                                <input type='text' name='sp-battery-7' value="<?php echo data_ref('sp-battery-7');?>">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info124".$info2;?>最大充電速度w</th>
                            <td>
                                <input type='text' name='sp-battery-10' value="<?php echo data_ref('sp-battery-10');?>" size='mini'>w
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info125".$info2;?>リチウムイオン電池</th>
                            <td>
                                <input type="checkbox" name="sp-battery-17" value="Yes"<?php if(data_ref('sp-battery-17') == 'Yes')echo ' checked';?>>バッテリーがリチウムイオン電池の場合チェック
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info126".$info2;?>給電</th>
                            <td>
                                <input type='text' name='sp-battery-18' value="<?php echo data_ref('sp-battery-18');?>">5V/4Aなど 
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info127".$info2;?>充電規格</th>
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
                        $plaintext = $ot_html01->find('.nfo', $i)->plaintext;
                        switch($ot_html01->find('.ttl', $i)->plaintext){
                            
                            case 'Colors':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;

                            case 'Models':
                                add_data(["sp-launch-5",$plaintext]);
                                break;
                            
                            case 'SAR':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                            
                            case 'SAR EU':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;

                            case 'Price':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                            
                            default:
                                //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info128".$info2;?>カラー/金額</h2>
                    <?php data_viewer();?>
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
                                <?php echo $info1.".info129".$info2;?>色[カラー名:カラーコード,カラー名:カラーコード,のように入力するわからない場合は-]
                            </th>
                            <td>
                                <input type='text' name='sp-design-3' value="<?php echo data_ref('sp-design-3');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info130".$info2;?>モデル番号</th>
                            <td>
                                複数ある場合は,で区切る
                                <input type='text' name='sp-launch-5' value="<?php echo data_ref('sp-launch-5');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info131".$info2;?>価格</th>
                            <td>
                                価格(このモデルのみ)
                                <input type='text' name='sp-launch-17' value="<?php echo data_ref('sp-launch-17');?>" size='full'>
                                現地価格 このモデルの価格、単位ナシ
                                <input type='text' name='sp-launch-20' value="<?php echo data_ref('sp-launch-20');?>" size='full'>
                                単位
                                <input type="checkbox" name="sp-launch-21" value="Yes"<?php if(data_ref('sp-launch-21') == 'Yes')echo ' checked';?>>USD$
                                <input type="checkbox" name="sp-launch-22" value="Yes"<?php if(data_ref('sp-launch-22') == 'Yes')echo ' checked';?>>ユーロ€
                                <input type="checkbox" name="sp-launch-23" value="Yes"<?php if(data_ref('sp-launch-23') == 'Yes')echo ' checked';?>>ポンド£
                                <input type="checkbox" name="sp-launch-24" value="Yes"<?php if(data_ref('sp-launch-24') == 'Yes')echo ' checked';?>>円¥
                                <input type="checkbox" name="sp-launch-25" value="Yes"<?php if(data_ref('sp-launch-25') == 'Yes')echo ' checked';?>>香港ドル
                                <input type="checkbox" name="sp-launch-26" value="Yes"<?php if(data_ref('sp-launch-26') == 'Yes')echo ' checked';?>>中国元
                                <input type="checkbox" name="sp-launch-27" value="Yes"<?php if(data_ref('sp-launch-27') == 'Yes')echo ' checked';?>>ルピー₹<br>
                                価格テキスト[$ 719.99 / £ 623.44みたいな感じに]
                                <input type='text' name='sp-launch-19' value="<?php echo data_ref('sp-launch-19');?>" size='full'>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info132".$info2;?>SAR</th>
                            <td>
                                SAR head<input type='text' name='sp-extra-57' value="<?php echo data_ref('sp-extra-57');?>"><br>
                                SAR body<input type='text' name='sp-extra-58' value="<?php echo data_ref('sp-extra-58');?>"><br>
                                SAR EU head<input type='text' name='sp-extra-59' value="<?php echo data_ref('sp-extra-59');?>"><br>
                                SAR EU body<input type='text' name='sp-extra-60' value="<?php echo data_ref('sp-extra-60');?>">
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
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;

                            case 'Display':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                            
                            case 'Camera':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                            
                            case 'Loudspeaker':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;

                            case 'Battery life':
                                //echo "<p>".$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                            
                            default:
                                //echo "<p>".'out of index(('.$ot_html01->find('.nfo', $i)->plaintext."</p>";
                                break;
                        }
                    }?>
                    <h2><?php echo $info0.".info133".$info2;?>テスト</h2>
                    <?php data_viewer();?>
                    <p><b>MISCが表示されている場合はこの項目はスルーしても大丈夫です！</b></p>
                    <table class='data-table'>
                        <tr>
                            <th><?php echo $info1.".info134".$info2;?>Antutu</th>
                            <td>
                                <?php
                                    $input_checks = explode(':','sp-test-0,AnTuTu v6:sp-test-1,AnTuTu v7:sp-test-2,AnTuTu v8:sp-test-3,AnTuTu v9:sp-test-4,AnTuTu v10:sp-test-5,AnTuTu v11:sp-test-6,AnTuTu v12');

                                    foreach($input_checks as $input_check ){
                                        $input_check = explode(',',$input_check);
                                        echo $input_check[1]."<input type='text' name='".$input_check[0]."' value='".data_ref($input_check[0])."'>".'<br>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $info1.".info135".$info2;?>その他のベンチマークスコア</th>
                            <td>
                                <?php
                                    $input_checks = explode(';','sp-test-8,Endurance rating(h);sp-test-9,Loudspeaker ( LUFS);sp-test-10,Loudspeaker: Voice (dB);sp-test-11,Loudspeaker: Noise (dB);sp-test-12,Loudspeaker: Ring (dB);sp-test-13,GeekBench: (v4.4);sp-test-14,GeekBench: (v5.1);sp-test-16,GFXBench:ES 3.1 onscreen(fps);sp-test-18,Audio quality:Noise(dB);sp-test-19,Audio quality:Crosstalk(dB);sp-test-21,Basemark X;sp-test-22,Basemark OS II 2.0;sp-test-25,Display Contrast ratio');

                                    foreach($input_checks as $input_check ){
                                        $input_check = explode(',',$input_check);
                                        echo $input_check[1]."<input type='text' name='".$input_check[0]."' value='".data_ref($input_check[0])."'>".'<br>';
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                    
        </form>
        <p>url:<?php echo $url;?></p>
        <div class="hidebtn" onclick="opentd('#table-row')"><a>スペック表(未実装)</a></div>
        <div class="table-row hide" id='table-row'>
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
        <div class="hidebtn" onclick="opentd('.errors')"><a style='background:red;border: 1px solid #ffc5c5;'>エラー表示</a></div>
        <div style='background:#bddeff' class='errors hide'>
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
        <div class="hidebtn" onclick="opentd('.data-tab')"><a>データ表示</a></div>
        <div class="tabs data-tab hide">
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
            color:#d50000
        }
        .sc2 img{
            width:100%;
            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 22%);
            border-radius:14px;
            margin-bottom:20px;
        }
        </style>
        </form>
    </div>
    <div class="sc2" style='overflow-y:scroll;'>
        <div class="info0 hide">
            <h1>スクレイピングの奴について<?php echo $info0.".info0".$close2;?></h1>
            <p>スクレイピング用のフォームです。</p>
            <p><?php echo $info1.$info2;?>を押すと入力のヘルプが出てきます、それぞれの項目一度は目を通して間違えないように入力お願いします。</p>
            <p>ここでの、<b>スクレイピング</b>とはデータを収集した上で利用しやすく加工することです。</p>
            <p>このフォーム(スクリプト)では、GSMarenaのページから、json形式に変換します。</p>
            <p style='color:red;'>スマホでも入力できますが、PCの方が明らかに入力しやすいので非推奨です。</p>
            <h2>入力ルール</h2>
            <p>入力にはいくつかルールがあるので説明していきます。</p>
            <p>下の画像のような青枠で囲われている表はスクレイピング前の表を切り抜いて再現したものです。</p>
            <small>元の表</small>
            <img src='images/3.png'>
            <small>再現</small>
            <img src='images/2.png'>
            <p>この再現の表をもとに下の表に入力していきます。</p>
            <p>左に入力する項目が書いてありますので、右に入力してください。</p>
            <img src='images/1.png'>
            <p>
                ・入力するものがない時は空白のままで大丈夫です、「-」などを入力するとエラーになります。<br>
                ・数字、アルファベット、スペースは半角で入力してください。<br>
                ・明らかに入力する項目が足りない場合やイレギュラーがあった場合はもちに連絡ください。<br>
                ・同じ端末でもRAM、ストレージのGB、グローバル版、EU版ごとにそれぞれ入力します。
            </p>
        </div>
        <div class="info1 hide">
            <h1>使用するURL<?php echo $info0.".info1".$close2;?></h1>
            <p>スクレイピングに使用するGSMarenaのURLを貼り付ける工程です。<br>一番初めに行ってください。</p>
            <p>途中から入力する場合はこの部分は空白で下の途中から入力する場合(json)にjsonをテキストで入力してください！</p>
            <h2>URLを取得する</h2>
            <p>URLがあらかじめわかっていない場合はGSMarenaから取得してください、下の画像がスペックページの階層です。<br>このページのURLをコピーして下さい。</p>
            <img src='images/4.png'>
            <p>スプレッドシートをあらかじめ渡されている場合は該当するURLをコピーしてください。</p>
            <img src='images/5.png'>
            <h2>URLを入力する</h2>
            入力欄に先程コピーしたURLを貼り付けてください、下の入力欄は例です。
            入力したらエンターを押して送信してください。
            <?php echo $info1.$info2;?>使用するURL
            <input type="text" size="full" value="https://www.gsmarena.com/google_pixel_4a_5g-10385.php" disabled="disabled">
            <p>エンターを押すとリロードされるので、入力したリンクの端末と同じ端末画像が表示されているか確認してください。<br>今回は例としてGoogle Pixel 4a 5Gを入力しているのでGoogle Pixel 4a 5Gが表示されています。</p>
            <img src='images/6.png'>
        </div>
        <div class="info2 hide">
            <h1>途中から入力する場合(json)<?php echo $info0.".info2".$close2;?></h1>
            <p style='color:red;'>この項目は途中から入力する場合に使用します、最初から入力する場合はここは空白で大丈夫です。</p>
            <p>途中から入力する場合はここにJsonを入力します、下のフォームは例です。</p>
            <p></p>
            <?php echo $info1.$info2;?>途中から入力する場合(json)
            <input type="text" size="full" value='[["sp-memo-0","International(\u30b0\u30ed\u30fc\u30d0\u30eb\u7248)\t8GB\t128GB"],["sp-memo-1","https:\/\/www.gsmarena.com\/xiaomi_poco_x3_gt-10949.php"],["sp-band-8","GSM \/ HSPA \/ LTE \/ 5G"],["sp-band-9","HSPA 42.2\/5.76 Mbps, LTE-A (CA), 5G"],["sp-band-7","1, 3, 28, 41, 77, 78 SA\/NSA"],["sp-band-5g-n1","Yes"],["sp-band-5g-n3","Yes"],["sp-band-5g-n28","Yes"],["sp-band-5g-n41","Yes"],["sp-band-5g-n77","Yes"],["sp-band-5g-n78","Yes"],["sp-band-6","1, 2, 3, 4, 5, 7, 8, 18, 19, 26, 28, 38, 40, 41, 42"],["sp-band-4g-1","Yes"],["sp-band-4g-2","Yes"],["sp-band-4g-3","Yes"],["sp-band-4g-4","Yes"],["sp-band-4g-5","Yes"],["sp-band-4g-7","Yes"],["sp-band-4g-8","Yes"],["sp-band-4g-18","Yes"],["sp-band-4g-19","Yes"],["sp-band-4g-26","Yes"],["sp-band-4g-28","Yes"],["sp-band-4g-38","Yes"],["sp-band-4g-40","Yes"],["sp-band-4g-41","Yes"],["sp-band-4g-42","Yes"],["sp-band-5","HSDPA 850 \/ 900 \/ 1700(AWS) \/ 1900 \/ 2100 "],["sp-band-3g-hsdpa-850","Yes"],["sp-band-3g-hsdpa-900","Yes"],["sp-band-3g-hsdpa-1700-aws","Yes"],["sp-band-3g-hsdpa-1900","Yes"],["sp-band-3g-hsdpa-2100","Yes"],["sp-band-4","GSM 850 \/ 900 \/ 1800 \/ 1900 - SIM 1 & SIM 2"],["sp-band-2g-gsm-850","Yes"],["sp-band-2g-gsm-900","Yes"],["sp-band-2g-gsm-1800","Yes"],["sp-band-2g-gsm-1900","Yes"],["sp-launch-1","2021-7-28"],["sp-launch-35","Yes"],["sp-launch-4","Xiaomi Poco X3 GT"],["sp-design-0","163.3"],["sp-design-4","75.9"],["sp-design-5","8.9 "],["sp-design-1","193"],["sp-network-3","\u30c7\u30e5\u30a2\u30ebSIM (Nano-SIM, dual stand-by)"],["sp-network-9","Dual SIM (Nano-SIM, dual stand-by)"],["sp-network-7","Yes"],["sp-extra-6","Yes"],["sp-extra-7"," IP68\/IP65"],["sp-screen-3","IPS LCD"],["sp-screen-0","Gorilla Glass Victus\u3067\u4fdd\u8b77"],["sp-screen-41","Corning Gorilla Glass Victus"],["sp-screen-1","6.6"],["sp-screen-8","120"],["sp-screen-15","450"],["sp-screen-14","84.9"],["sp-screen-16","2400"],["sp-screen-4","1080"],["sp-screen-2","20"],["sp-screen-17","9"],["sp-screen-6","399"],["sp-screen-32","Yes"],["sp-screen-24","Yes"],["sp-screen-28","Yes"],["sp-softwear-0","Yes"],["sp-softwear-7","11"],["sp-softwear-13","Yes"],["sp-softwear-8","12.5"],["sp-softwear-12","MIUI for POCO"],["sp-spec-11","113"],["sp-spec-7","8"],["sp-spec-8","UFS 3.1"],["sp-spec-9","128"],["sp-spec-10","128GB 8GB RAM, 256GB 8GB RAM"],["sp-camera-4","3"],["sp-camera-16","1"],["sp-camera-19","64"],["sp-camera-20","1.8"],["sp-camera-21","26"],["sp-camera-22","1\/1.97"],["sp-camera-23","0.7"],["sp-camera-24","6"],["sp-camera-25","PDAF"],["sp-camera-26","PDAF"],["sp-camera-29","8"],["sp-camera-30","2.2"],["sp-camera-32","1\/4.0"],["sp-camera-33","1.12"],["sp-camera-34","7"],["sp-camera-35","120\u02da"],["sp-camera-36","120\u02da"],["sp-camera-39","2"],["sp-camera-40","2.4"],["sp-camera-44","10"],["sp-camera-100","Yes"],["sp-camera-105","Yes"],["sp-camera-107","Yes"],["sp-camera-2","4K@30fps, 1080p@30\/60\/120fps"],["sp-camera-5","4K@30fps, 1080p@30\/60\/120fps"],["sp-camera-12","1"],["sp-camera-17","1"],["sp-camera-121","16"],["sp-camera-122","2,5"],["sp-camera-124","1\/3.06"],["sp-camera-125","1.0"],["sp-camera-126","6"],["sp-camera-201","1080p@30fps, 720p@120fps, 960fps"],["sp-camera-202","1080p@30fps, 720p@120fps, 960fps"],["sp-extra-37","Yes"],["sp-extra-44","Yes"],["sp-extra-48","Yes"],["sp-network-0","Yes"],["sp-network-10","Yes"],["sp-network-11","Yes"],["sp-network-12","Yes"],["sp-network-13","Yes"],["sp-network-14","Yes"],["sp-network-15","Yes"],["sp-network-38","Yes"],["sp-network-39","Yes"],["sp-network-40","Yes"],["sp-extra-62","Yes"],["sp-extra-66","Yes"],["sp-network-1","Yes"],["sp-network-2","5.2"],["sp-network-19","Yes"],["sp-network-20","Yes"],["sp-extra-0","Yes"],["sp-extra-9","Yes"],["sp-network-29","Yes"],["sp-network-30","Yes"],["sp-network-31","Yes"],["sp-network-32","Yes"],["sp-network-34","Yes"],["sp-network-35","Yes"],["sp-sensor-11","Yes"],["sp-sensor-1","Yes"],["sp-sensor-3","Yes"],["sp-sensor-4","Yes"],["sp-sensor-10","Yes"],["sp-sensor-14","Yes"],["sp-sensor-17","Yes"],["sp-battery-0","5000"],["sp-battery-9","No"],["sp-battery-7","100% in 42 min (advertised)"],["sp-battery-10","67"],["sp-battery-17","Yes"],["sp-battery-26","Yes"],["sp-design-3","Stargaze Black:#2e2f39, Wave Blue:#48bbd0, Cloud White:#e3f0f8"],["sp-launch-17","About 260 EUR"],["sp-launch-20","260"],["sp-launch-22","Yes"],["sp-launch-19","About 260 EUR"]]' disabled="disabled">
            <h2>入力を中断する方法</h2>
            <p>途中まで入力して一度終了したい場合は、入力したところまででエンターを押して下さい。</p>
            <p>エンターを押すとその時点までのJsonを生成できます、端末名の下に</p>
            <p><?php echo $info1.$info2;?>送信されたデータをjsonに変換したテキスト</p>
            <p>という項目があります、その下のCopy textを押すとjsonがコピーされます。</p>
            <p>下の画像のようにエンターを押す前の状態だとfalseとなっています、もし最初から入力されている場合はURLをリセットしてください。</p>
            <p>入力を初めから行う場合は<br>http://localhost/sc3/spec-sheet-generator.php<br>のように初期状態のURLになっている状態から始めてください。</p>
            <img src='images/7.png'>
            <p>正しく送信がされている場合はURLの後に?sp-memo-0=とかなり長い文字列が続き、下の画像のようにJsonが入力された状態になります。</p>
            <img src='images/8.png'>
            <h3>URLの初期化</h3>
            <p>初めから入力する場合はURLをリセットする必要があります。<br>途中からの入力ではない場合画像の?を含めはてな以降のもじを消してからエンターを押して始めてください。</p>
            <img src='images/9.png'>
            <p>jsonの例です。</p>
            <p style='color:red;'>[["sp-memo-0","International(\u30b0\u30ed\u30fc\u30d0\u30eb\u7248)\t8GB\t128GB"],["sp-memo-1","https:\/\/www.gsmarena.com\/xiaomi_poco_x3_gt-10949.php"],["sp-band-8","GSM \/ HSPA \/ LTE \/ 5G"],["sp-band-9","HSPA 42.2\/5.76 Mbps, LTE-A (CA), 5G"],["sp-band-7","1, 3, 28, 41, 77, 78 SA\/NSA"],["sp-band-5g-n1","Yes"],["sp-band-5g-n3","Yes"],["sp-band-5g-n28","Yes"],["sp-band-5g-n41","Yes"],["sp-band-5g-n77","Yes"],["sp-band-5g-n78","Yes"],["sp-band-6","1, 2, 3, 4, 5, 7, 8, 18, 19, 26, 28, 38, 40, 41, 42"],["sp-band-4g-1","Yes"],["sp-band-4g-2","Yes"],["sp-band-4g-3","Yes"],["sp-band-4g-4","Yes"],["sp-band-4g-5","Yes"],["sp-band-4g-7","Yes"],["sp-band-4g-8","Yes"],["sp-band-4g-18","Yes"],["sp-band-4g-19","Yes"],["sp-band-4g-26","Yes"],["sp-band-4g-28","Yes"],["sp-band-4g-38","Yes"],["sp-band-4g-40","Yes"],["sp-band-4g-41","Yes"],["sp-band-4g-42","Yes"],["sp-band-5","HSDPA 850 \/ 900 \/ 1700(AWS) \/ 1900 \/ 2100 "],["sp-band-3g-hsdpa-850","Yes"],["sp-band-3g-hsdpa-900","Yes"],["sp-band-3g-hsdpa-1700-aws","Yes"],["sp-band-3g-hsdpa-1900","Yes"],["sp-band-3g-hsdpa-2100","Yes"],["sp-band-4","GSM 850 \/ 900 \/ 1800 \/ 1900 - SIM 1 & SIM 2"],["sp-band-2g-gsm-850","Yes"],["sp-band-2g-gsm-900","Yes"],["sp-band-2g-gsm-1800","Yes"],["sp-band-2g-gsm-1900","Yes"],["sp-launch-1","2021-7-28"],["sp-launch-35","Yes"],["sp-launch-4","Xiaomi Poco X3 GT"],["sp-design-0","163.3"],["sp-design-4","75.9"],["sp-design-5","8.9 "],["sp-design-1","193"],["sp-network-3","\u30c7\u30e5\u30a2\u30ebSIM (Nano-SIM, dual stand-by)"],["sp-network-9","Dual SIM (Nano-SIM, dual stand-by)"],["sp-network-7","Yes"],["sp-extra-6","Yes"],["sp-extra-7"," IP68\/IP65"],["sp-screen-3","IPS LCD"],["sp-screen-0","Gorilla Glass Victus\u3067\u4fdd\u8b77"],["sp-screen-41","Corning Gorilla Glass Victus"],["sp-screen-1","6.6"],["sp-screen-8","120"],["sp-screen-15","450"],["sp-screen-14","84.9"],["sp-screen-16","2400"],["sp-screen-4","1080"],["sp-screen-2","20"],["sp-screen-17","9"],["sp-screen-6","399"],["sp-screen-32","Yes"],["sp-screen-24","Yes"],["sp-screen-28","Yes"],["sp-softwear-0","Yes"],["sp-softwear-7","11"],["sp-softwear-13","Yes"],["sp-softwear-8","12.5"],["sp-softwear-12","MIUI for POCO"],["sp-spec-11","113"],["sp-spec-7","8"],["sp-spec-8","UFS 3.1"],["sp-spec-9","128"],["sp-spec-10","128GB 8GB RAM, 256GB 8GB RAM"],["sp-camera-4","3"],["sp-camera-16","1"],["sp-camera-19","64"],["sp-camera-20","1.8"],["sp-camera-21","26"],["sp-camera-22","1\/1.97"],["sp-camera-23","0.7"],["sp-camera-24","6"],["sp-camera-25","PDAF"],["sp-camera-26","PDAF"],["sp-camera-29","8"],["sp-camera-30","2.2"],["sp-camera-32","1\/4.0"],["sp-camera-33","1.12"],["sp-camera-34","7"],["sp-camera-35","120\u02da"],["sp-camera-36","120\u02da"],["sp-camera-39","2"],["sp-camera-40","2.4"],["sp-camera-44","10"],["sp-camera-100","Yes"],["sp-camera-105","Yes"],["sp-camera-107","Yes"],["sp-camera-2","4K@30fps, 1080p@30\/60\/120fps"],["sp-camera-5","4K@30fps, 1080p@30\/60\/120fps"],["sp-camera-12","1"],["sp-camera-17","1"],["sp-camera-121","16"],["sp-camera-122","2,5"],["sp-camera-124","1\/3.06"],["sp-camera-125","1.0"],["sp-camera-126","6"],["sp-camera-201","1080p@30fps, 720p@120fps, 960fps"],["sp-camera-202","1080p@30fps, 720p@120fps, 960fps"],["sp-extra-37","Yes"],["sp-extra-44","Yes"],["sp-extra-48","Yes"],["sp-network-0","Yes"],["sp-network-10","Yes"],["sp-network-11","Yes"],["sp-network-12","Yes"],["sp-network-13","Yes"],["sp-network-14","Yes"],["sp-network-15","Yes"],["sp-network-38","Yes"],["sp-network-39","Yes"],["sp-network-40","Yes"],["sp-extra-62","Yes"],["sp-extra-66","Yes"],["sp-network-1","Yes"],["sp-network-2","5.2"],["sp-network-19","Yes"],["sp-network-20","Yes"],["sp-extra-0","Yes"],["sp-extra-9","Yes"],["sp-network-29","Yes"],["sp-network-30","Yes"],["sp-network-31","Yes"],["sp-network-32","Yes"],["sp-network-34","Yes"],["sp-network-35","Yes"],["sp-sensor-11","Yes"],["sp-sensor-1","Yes"],["sp-sensor-3","Yes"],["sp-sensor-4","Yes"],["sp-sensor-10","Yes"],["sp-sensor-14","Yes"],["sp-sensor-17","Yes"],["sp-battery-0","5000"],["sp-battery-9","No"],["sp-battery-7","100% in 42 min (advertised)"],["sp-battery-10","67"],["sp-battery-17","Yes"],["sp-battery-26","Yes"],["sp-design-3","Stargaze Black:#2e2f39, Wave Blue:#48bbd0, Cloud White:#e3f0f8"],["sp-launch-17","About 260 EUR"],["sp-launch-20","260"],["sp-launch-22","Yes"],["sp-launch-19","About 260 EUR"]]</p>
        </div>
        <div class="info3 hide">
            <h1>端末名・メモ・URL<?php echo $info0.".info3".$close2;?></h1>
            <p>URL・メモを入力するセクションです、完成したJsonをコピーすることもできます。<br>途中まで入力して中断する場合もここのJsonをコピーしてください。</p>
            <h2>端末名</h2>
            <p>URLに合わせて端末名と画像が自動で表示されています、入力する端末と異なる画像と端末名が表示されている場合は入力したURLが間違っている場合がありますので再確認してください。</p>
            <img src='images/10.png'>
            <h2>メモ用</h2>
            <p>下のフォームは例です、このメモにはこれから入力する端末のバージョンを入力してください。</p>
            <p>日本版 Docomo版 4GB 64GB</p>
            <p>中国版 6GB 64GB</p>
            <p>不明版 6GB 128GB</p>
            <p>入力は上の三つのように○○版　□GB △GB、下のフォームは例です。</p>
            <?php echo $info1.$info2;?>メモ用
            <input type="text" size="full" value="グローバル版　6GB 128GB" disabled="disabled">
            <img src='images/11.png'>
            <h2>URL</h2>
            <p>最初に入力したURLをここに入力してください。</p>
            <?php echo $info1.$info2;?>URL
            <input type="text" size="full" value="https://www.gsmarena.com/google_pixel_4a_5g-10385.php" disabled="disabled">
            <img src='images/12.png'>
        </div>
        <div class="info4 hide">
            <h1>送信されたデータをjsonに変換したテキスト<?php echo $info0.".info4".$close2;?></h1>
            <p>初期状態ではここの項目はfalseになっています、エンターを押して送信するとjsonが埋め込まれます、中断する場合や入力が終わりJsonをコピーするのに使用します。</p>
        </div>
        <div class="info5 hide">
            <h1>メモ用<?php echo $info0.".info5".$close2;?></h1>
            <p>下のフォームは例です、このメモにはこれから入力する端末のバージョンを入力してください。</p>
            <p>日本版 Docomo版 4GB 64GB</p>
            <p>中国版 6GB 64GB</p>
            <p>不明版 6GB 128GB</p>
            <p>入力は上の三つのように○○版　□GB △GB、下のフォームは例です。</p>
            <?php echo $info1.$info2;?>メモ用
            <input type="text" size="full" value="グローバル版　6GB 128GB" disabled="disabled">
            <img src='images/11.png'>
        </div>
        <div class="info6 hide">
            <h1>URL<?php echo $info0.".info6".$close2;?></h1>
            <p>最初に入力したURLをここに入力してください。</p>
            <?php echo $info1.$info2;?>URL
            <input type="text" size="full" value="https://www.gsmarena.com/google_pixel_4a_5g-10385.php" disabled="disabled">
            <img src='images/12.png'>
        </div>
        <div class="info7 hide">
            <h1>ネットワーク<?php echo $info0.".info7".$close2;?></h1>
            <p>ネットワークのセクションです、ここではバンド情報や通信速度等を入力します。</p>
            <h2>技術</h2>
            <p>元の表のTechnology部分を技術に入力します、それぞれ利用可能な通信技術を「 / 」区切りで入力してあります。</p>
            <img src='images/13.png'>
            <img src='images/14.png'>
            <p>基本的に自動入力されていて書き換える必要はありませんが、たまにイレギュラーがある場合がありますのでその場合は修正してください。</p>
            <p>具体的にはtechnology部分が</p>
            <pre>GSM / HSPA / LTE / 5G - global
GSM / HSPA / LTE - china</pre>   
            <p>のように複数行あり、複数バージョン存在する場合です。<br>入力欄は</p>
            <pre>GSM / HSPA / LTE / 5G - global GSM / HSPA / LTE - china</pre>
            <p>のように改行がなくなって入力されていたり、</p>
            <pre>GSM / HSPA / LTE / 5G - global</pre>
            <p>のように片方だけ入力される場合があります。<br>これをもし入力している端末がグローバル版であれば「 - global」を取り除き</p>
            <pre>GSM / HSPA / LTE / 5G</pre>
            <p>と入力し、中国版であれば</p>
            <pre>GSM / HSPA / LTE</pre>
            <p>と入力してください。</p>
            <p>また、以下のような不明な場合やハイフンが入力されている場合は空白にしてください。</p>
            <pre>Unspecified</pre>
            <pre>Rumored</pre>
            <pre>-</pre>

            <h2>速度</h2>
            <p>速度は元の表のSPEEDの部分に該当します、以下の三つの場合は空白で、それ以外の場合はSPEEDと同じ物を入力してください。</p>
            <pre>Unspecified</pre>
            <pre>Rumored</pre>
            <pre>-</pre>
            <img src='images/15.png'>
            <img src='images/16.png'>
            <h2>バンド</h2>
            <p>各バンド情報を入力します、非対応のものがある場合は空白の状態にしてください、チェックボタンもすべて外してください。</p>
            <p>複数バージョンある場合があります、例として入力しているバージョンが中国の場合、中国以外の項目は消去してください。</p>
            <img src='images/17.png'>
            <img src='images/18.png'>
            <h3>表示される5G</h3>
            <p>ここでは5Gのバンドを入力します、もし元の表に5Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>最後に書いてある「 - International」や、「- USA」は消して入力してください。</p>
            <p>画像では5G bandsの欄が2行ありますが、USA版を入力している場合はInternational版(グローバル版)は関係ないので消してください。</p>
            <img src='images/19.png'>
            <img src='images/20.png'>
            <img src='images/21.png'>
            <p>例として、International版(グローバル版)を入力しているときに下のように表の文字が表示されていたら</p>
<pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA - International
1, 2, 3, 5, 7, 8, 12, 20, 25, 38, 40, 66, 71, 77, 78 SA/NSA - USA</pre>
            <p>まず、USAの項目がいらないので</p>
            <pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA - International</pre>
            <p>このようにUSAの行を消し、 - Internationalのような何版かを説明したテキストは省いてください</p>
            <pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA</pre>
            <p>最終的にはこのようになりましたのでこの文字列を入力します。<br>入力しているバージョンに合わせてこの作業を行ってください。<br>下のフォームは例です。</p>
            <?php echo $info1.$info2;?>・表示される5G
            <input type="text" size="full" value="1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA" disabled="disabled">
            <h3>5G各バンド</h3>
            <p>表示される5Gに入力したバンドをチェックします。5Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/22.png'>
            <h3>表示される4G</h3>
            <p>ここでは4Gのバンドを入力します、もし元の表に4Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>最後に書いてある「 - International」や、「- USA」は消して入力してください。</p>
            <p>画像では4G bandsの欄が2行ありますが、USA版を入力している場合はInternational版(グローバル版)は関係ないので消してください。</p>
            <img src='images/23.png'>
            <img src='images/24.png'>
            <img src='images/25.png'>
            <p>例として、International版(グローバル版)を入力しているときに下のように表の文字が表示されていたら</p>
<pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42 - International
1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 25, 26, 30, 34, 38, 39, 40, 41, 42, 66, 71 - USA</pre>
            <p>まず、USAの項目がいらないので</p>
            <pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42 - International</pre>
            <p>このようにUSAの行を消し、 - Internationalのような何版かを説明したテキストは省いてください</p>
            <pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42</pre>
            <p>最終的にはこのようになりましたのでこの文字列を入力します。<br>入力しているバージョンに合わせてこの作業を行ってください。<br>下のフォームは例です。</p>
            <?php echo $info1.$info2;?>・表示される4G
            <input type="text" size="full" value="1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42" disabled="disabled">
            <h3>4G各バンド</h3>
            <p>表示される4Gに入力したバンドをチェックします。4Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/26.png'>
            <h3>表示される3G</h3>
            <p>ここでは3Gのバンドを入力します、もし元の表に3Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>画像では3G bandsの欄が1行ですが、4Gや5Gの解説のように複数行ある場合は該当する物だけ入力してください。</p>
            <img src='images/27.png'>
            <img src='images/28.png'>
            <h3>3G各バンド</h3>
            <p>表示される3Gに入力したバンドをチェックします。3Gに対応していない場合はすべてチェックを外してください。</p>
            <p>HSDPA 1700とHSDPA 1700(aws)は別物ですので区別して入力してください。</p>
            <p>HSDPA 1700(aws)に対応している場合HSDPA 1700にもチェックが付いてしまう場合がありますが、これは間違いです。<br>HSDPA 1700(aws)だけにチェックをつけてください。</p>
            <img src='images/29.png'>
            <h3>表示される2G</h3>
            <p>ここでは2Gのバンドを入力します、もし元の表に2Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>画像では2G bandsの欄が1行ですが、4Gや5Gの解説のように複数行ある場合は該当する物だけ入力してください。</p>
            <img src='images/30.png'>
            <img src='images/31.png'>
            <h3>2G各バンド</h3>
            <p>表示される2Gに入力したバンドをチェックします。<br>2Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/32.png'>
        </div>
        <div class="info8 hide">
            <h1>技術<?php echo $info0.".info8".$close2;?></h1>
            <p>元の表のTechnology部分を技術に入力します、それぞれ利用可能な通信技術を「 / 」区切りで入力してあります。</p>
            <img src='images/13.png'>
            <img src='images/14.png'>
            <p>基本的に自動入力されていて書き換える必要はありませんが、たまにイレギュラーがある場合がありますのでその場合は修正してください。</p>
            <p>具体的にはtechnology部分が</p>
            <pre>GSM / HSPA / LTE / 5G - global
GSM / HSPA / LTE - china</pre>   
            <p>のように複数行あり、複数バージョン存在する場合です。<br>入力欄は</p>
            <pre>GSM / HSPA / LTE / 5G - global GSM / HSPA / LTE - china</pre>
            <p>のように改行がなくなって入力されていたり、</p>
            <pre>GSM / HSPA / LTE / 5G - global</pre>
            <p>のように片方だけ入力される場合があります。<br>これをもし入力している端末がグローバル版であれば「 - global」を取り除き</p>
            <pre>GSM / HSPA / LTE / 5G</pre>
            <p>と入力し、中国版であれば</p>
            <pre>GSM / HSPA / LTE</pre>
            <p>と入力してください。</p>
            <p>また、以下のような不明な場合やハイフンが入力されている場合は空白にしてください。</p>
            <pre>Unspecified</pre>
            <pre>Rumored</pre>
            <pre>-</pre>
        </div>
        <div class="info9 hide">
            <h1>速度<?php echo $info0.".info9".$close2;?></h1>
            <p>速度は元の表のSPEEDの部分に該当します、以下の三つの場合は空白で、それ以外の場合はSPEEDと同じ物を入力してください。</p>
            <pre>Unspecified</pre>
            <pre>Rumored</pre>
            <pre>-</pre>
            <img src='images/15.png'>
            <img src='images/16.png'>
        </div>
        <div class="info10 hide">
            <h1>バンド<?php echo $info0.".info10".$close2;?></h1>
            <p>各バンド情報を入力します、非対応のものがある場合は空白の状態にしてください、チェックボタンもすべて外してください。</p>
            <p>複数バージョンある場合があります、例として入力しているバージョンが中国の場合、中国以外の項目は消去してください。</p>
            <img src='images/17.png'>
            <img src='images/18.png'>
            <h2>表示される5G</h2>
            <p>ここでは5Gのバンドを入力します、もし元の表に5Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>最後に書いてある「 - International」や、「- USA」は消して入力してください。</p>
            <p>画像では5G bandsの欄が2行ありますが、USA版を入力している場合はInternational版(グローバル版)は関係ないので消してください。</p>
            <img src='images/19.png'>
            <img src='images/20.png'>
            <img src='images/21.png'>
            <p>例として、International版(グローバル版)を入力しているときに下のように表の文字が表示されていたら</p>
<pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA - International
1, 2, 3, 5, 7, 8, 12, 20, 25, 38, 40, 66, 71, 77, 78 SA/NSA - USA</pre>
            <p>まず、USAの項目がいらないので</p>
            <pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA - International</pre>
            <p>このようにUSAの行を消し、 - Internationalのような何版かを説明したテキストは省いてください</p>
            <pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA</pre>
            <p>最終的にはこのようになりましたのでこの文字列を入力します。<br>入力しているバージョンに合わせてこの作業を行ってください。<br>下のフォームは例です。</p>
            <?php echo $info1.$info2;?>・表示される5G
            <input type="text" size="full" value="1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA" disabled="disabled">
            <h2>5G各バンド</h2>
            <p>表示される5Gに入力したバンドをチェックします。5Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/22.png'>
            <h2>表示される4G</h2>
            <p>ここでは4Gのバンドを入力します、もし元の表に4Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>最後に書いてある「 - International」や、「- USA」は消して入力してください。</p>
            <p>画像では4G bandsの欄が2行ありますが、USA版を入力している場合はInternational版(グローバル版)は関係ないので消してください。</p>
            <img src='images/23.png'>
            <img src='images/24.png'>
            <img src='images/25.png'>
            <p>例として、International版(グローバル版)を入力しているときに下のように表の文字が表示されていたら</p>
<pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42 - International
1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 25, 26, 30, 34, 38, 39, 40, 41, 42, 66, 71 - USA</pre>
            <p>まず、USAの項目がいらないので</p>
            <pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42 - International</pre>
            <p>このようにUSAの行を消し、 - Internationalのような何版かを説明したテキストは省いてください</p>
            <pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42</pre>
            <p>最終的にはこのようになりましたのでこの文字列を入力します。<br>入力しているバージョンに合わせてこの作業を行ってください。<br>下のフォームは例です。</p>
            <?php echo $info1.$info2;?>・表示される4G
            <input type="text" size="full" value="1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42" disabled="disabled">
            <h2>4G各バンド</h2>
            <p>表示される4Gに入力したバンドをチェックします。4Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/26.png'>
            <h2>表示される3G</h2>
            <p>ここでは3Gのバンドを入力します、もし元の表に3Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>画像では3G bandsの欄が1行ですが、4Gや5Gの解説のように複数行ある場合は該当する物だけ入力してください。</p>
            <img src='images/27.png'>
            <img src='images/28.png'>
            <h2>3G各バンド</h2>
            <p>表示される3Gに入力したバンドをチェックします。3Gに対応していない場合はすべてチェックを外してください。</p>
            <p>HSDPA 1700とHSDPA 1700(aws)は別物ですので区別して入力してください。</p>
            <p>HSDPA 1700(aws)に対応している場合HSDPA 1700にもチェックが付いてしまう場合がありますが、これは間違いです。<br>HSDPA 1700(aws)だけにチェックをつけてください。</p>
            <img src='images/29.png'>
            <h2>表示される2G</h2>
            <p>ここでは2Gのバンドを入力します、もし元の表に2Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>画像では2G bandsの欄が1行ですが、4Gや5Gの解説のように複数行ある場合は該当する物だけ入力してください。</p>
            <img src='images/30.png'>
            <img src='images/31.png'>
            <h2>2G各バンド</h2>
            <p>表示される2Gに入力したバンドをチェックします。<br>2Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/32.png'>
        </div>
        <div class="info10a hide">
        　  <h1>表示される5G<?php echo $info0.".info10a".$close2;?></h1>
            <p>ここでは5Gのバンドを入力します、もし元の表に5Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>最後に書いてある「 - International」や、「- USA」は消して入力してください。</p>
            <p>画像では5G bandsの欄が2行ありますが、USA版を入力している場合はInternational版(グローバル版)は関係ないので消してください。</p>
            <img src='images/19.png'>
            <img src='images/20.png'>
            <img src='images/21.png'>
            <p>例として、International版(グローバル版)を入力しているときに下のように表の文字が表示されていたら</p>
<pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA - International
1, 2, 3, 5, 7, 8, 12, 20, 25, 38, 40, 66, 71, 77, 78 SA/NSA - USA</pre>
            <p>まず、USAの項目がいらないので</p>
            <pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA - International</pre>
            <p>このようにUSAの行を消し、 - Internationalのような何版かを説明したテキストは省いてください</p>
            <pre>1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA</pre>
            <p>最終的にはこのようになりましたのでこの文字列を入力します。<br>入力しているバージョンに合わせてこの作業を行ってください。<br>下のフォームは例です。</p>
            <?php echo $info1.$info2;?>・表示される5G
            <input type="text" size="full" value="1, 2, 3, 5, 7, 8, 12, 20, 28, 38, 77, 78 SA/NSA" disabled="disabled">
        </div>
        <div class="info11 hide">
            <h1>5G各バンド<?php echo $info0.".info11".$close2;?></h1>
            <p>表示される5Gに入力したバンドをチェックします。5Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/22.png'>
        </div>
        <div class="info12 hide">
        　  <h1>表示される4G<?php echo $info0.".info12".$close2;?></h1>
            <p>ここでは4Gのバンドを入力します、もし元の表に4Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>最後に書いてある「 - International」や、「- USA」は消して入力してください。</p>
            <p>画像では4G bandsの欄が2行ありますが、USA版を入力している場合はInternational版(グローバル版)は関係ないので消してください。</p>
            <img src='images/23.png'>
            <img src='images/24.png'>
            <img src='images/25.png'>
            <p>例として、International版(グローバル版)を入力しているときに下のように表の文字が表示されていたら</p>
<pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42 - International
1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 25, 26, 30, 34, 38, 39, 40, 41, 42, 66, 71 - USA</pre>
            <p>まず、USAの項目がいらないので</p>
            <pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42 - International</pre>
            <p>このようにUSAの行を消し、 - Internationalのような何版かを説明したテキストは省いてください</p>
            <pre>1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42</pre>
            <p>最終的にはこのようになりましたのでこの文字列を入力します。<br>入力しているバージョンに合わせてこの作業を行ってください。<br>下のフォームは例です。</p>
            <?php echo $info1.$info2;?>・表示される4G
            <input type="text" size="full" value="1, 2, 3, 4, 5, 7, 8, 12, 17, 18, 19, 20, 26, 28, 34, 38, 39, 40, 41, 42" disabled="disabled">
        </div>
        <div class="info13 hide">
            <h1>4G各バンド<?php echo $info0.".info13".$close2;?></h1>
            <p>表示される4Gに入力したバンドをチェックします。4Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/26.png'>
        </div>
        <div class="info14 hide">
            <h1>表示される3G<?php echo $info0.".info14".$close2;?></h1>
            <p>ここでは3Gのバンドを入力します、もし元の表に3Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>画像では3G bandsの欄が1行ですが、4Gや5Gの解説のように複数行ある場合は該当する物だけ入力してください。</p>
            <img src='images/27.png'>
            <img src='images/28.png'>
        </div>
        <div class="info15 hide">
            <h1>3G各バンド<?php echo $info0.".info15".$close2;?></h1>
            <p>表示される3Gに入力したバンドをチェックします。3Gに対応していない場合はすべてチェックを外してください。</p>
            <p>HSDPA 1700とHSDPA 1700(aws)は別物ですので区別して入力してください。</p>
            <p>HSDPA 1700(aws)に対応している場合HSDPA 1700にもチェックが付いてしまう場合がありますが、これは間違いです。<br>HSDPA 1700(aws)だけにチェックをつけてください。</p>
            <img src='images/29.png'>
        </div>
        <div class="info16 hide">
            <h1>表示される2G<?php echo $info0.".info16".$close2;?></h1>
            <p>ここでは2Gのバンドを入力します、もし元の表に2Gの項目がなかったりUnspecified、-だった場合は空白にしてください。</p>
            <p>画像では2G bandsの欄が1行ですが、4Gや5Gの解説のように複数行ある場合は該当する物だけ入力してください。</p>
            <img src='images/30.png'>
            <img src='images/31.png'>
        </div>
        <div class="info17 hide">
            <h1>2G各バンド<?php echo $info0.".info17".$close2;?></h1>
            <p>表示される2Gに入力したバンドをチェックします。<br>2Gに対応していない場合はすべてチェックを外してください。</p>
            <img src='images/32.png'>
        </div>
        <div class="info18 hide">
            <h1>概要<?php echo $info0.".info18".$close2;?></h1>
            <p>ここでは</p>
            <p>・発売日<br>・発表日<br>・未発表の場合の期待される発表日<br>・細かいやつら<br>・地域<br>・端末名<br>・メーカー</p>
            <p>を入力します、そして</p>
            <p>・端末id(一意のid)<br>・メインiD	<br>・同じスマホ別バージョン(,区切りでid)<br>・関連スマホ</p>
            <p>は入力しなくて大丈夫です。</p>
            <p>もとの表は複数パターンあります、	英単語が分からないと少し厳しいかもしれないので簡易訳を置いておきます。</p>
<pre>
Rumoredはリーク情報
Exp. releasは期待される発売日
Releasedは発売済み
Announcedは発表済み
Discontinuedは製造中止
</pre>
            <img src='images/33.png'>
            <img src='images/34.png'>
            <img src='images/35.png'>
            <img src='images/36.png'>
            <img src='images/37.png'>
            <img src='images/38.png'>
            <h2>発表日</h2>
            <p>発売日が不明な場合は、この項目は空白にして下さい。</p>
            <p>日にちを入力しますが、ルールがあります。</p>
            <rules>
・不明な場合は空白
・yyyy-mm-ddの形式で入力
・もし月までしかわかっていない場合は2021-01のように日にちは省略可
・月も分からない場合は2021のように数字だけ入力
・アルファベットや数字などはNG

</rules>
            <p>このように自動入力されている場合がありますが、間違いです。</p>
            <img src='images/39.png'>
            <p>このように-区切りで-と数字のみが入力されている状態が正しいです。</p>
            <img src='images/40.png'>
            <h2>発売日</h2>
            <p>発売日が不明な場合は、この項目は空白にして下さい。</p>
            <p>日にちを入力しますが、ルールがあります。</p>
            <rules>
・不明な場合は空白
・yyyy-mm-ddの形式で入力
・もし月までしかわかっていない場合は2021-01のように日にちは省略可
・月も分からない場合は2021のように数字だけ入力
・アルファベットや数字などはNG

</rules>
            <img src='images/41.png'>
            <h2>未発表の場合の期待される発表日</h2>
            <p>未発表の場合に期待される発表日があれば入力してください。<br>不明な場合や既に発表してる場合は、この項目は空白にして下さい。</p>
            <pre>Exp. announcement 2021-8-11</pre>
            <p>のように発表日が補完されている場合はその日にちを入力してください。Expは期待されるという意味です。</p>
            <p>日にちを入力しますが、ルールがあります。</p>
            <rules>
・不明な場合は空白
・yyyy-mm-ddの形式で入力
・もし月までしかわかっていない場合は2021-01のように日にちは省略可
・月も分からない場合は2021のように数字だけ入力
・アルファベットや数字などはNG

</rules>    
            <img src='images/42.png'>
            <h2>細かいやつら</h2>
            <p>ここでは</p>
            <p>・これがメイン表示の場合<br>・リーク<br>・日本で発売されたやつ<br>・技適認証</p>
            <p>を入力します選択します。</p>
            <h2>これがメイン表示の場合</h2>
            <p>スプレッドシートで入力している場合、スプレッドシートのメインにチェックが付いている場合はチェックをつけてください。</p>
            <img src='images/43.png'>
            <h2>リーク</h2>
            <p>元の表にRumoredがある場合はリーク情報をまとめたスペックです、この項目にチェックをつけてください。</p>
            <h2>日本で発売されたやつ</h2>
            <p>日本でも売られている端末の場合はチェックをつけてください、ただしこの項目は日本版に限ります。同じ端末でも韓国版やグローバル版では技適がなかったり日本では発売していない場合があるので注意してください。</p>
            <h2>技適認証</h2>
            <p>技適認証がある場合はチェックして下さい。</p>
            <h2>地域</h2>
            <p>入力している端末が何版なのかを選択します。<br>不明な場合はチェックをしなくて大丈夫です。<br>必ずチェックは一つまでにしてください。</p>
            <p>・日本<br>・中国<br>・インド<br>・韓国<br>・アメリカ<br>・EU<br>・グローバル</p>
            <p>不明以外の場合で該当するものがない場合はもちに連絡をください。</p>
            <h2>端末名</h2>
            <p>端末名を入力してください。<br>この項目は基本的にほぼ正確に自動で入力されています。</p>
            <h2>端末id(一意のid)</h2>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
            <h2>メインiD</h2>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
            <h2>同じスマホ別バージョン(,区切りでid)</h2>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
            <h2>関連スマホ</h2>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
            <h2>メーカー</h2>
            <p>メーターを選択してください、この項目で選択するメーカーは一つまでです。</p>
            <p>メーカーのサブブランドのスマートフォンだった場合はredmiやhonorなどサブブランドを選択してください。</p>
            <p>たとえばXiaomi POCO F1だった場合はXiaomiではなくPOCOにチェックをつけてください。</p>
        </div>
        <div class="info19 hide">
            <h1>発表日<?php echo $info0.".info19".$close2;?></h1>
            <p>発売日が不明な場合は、この項目は空白にして下さい。</p>
            <p>日にちを入力しますが、ルールがあります。</p>
            <rules>
・不明な場合は空白
・yyyy-mm-ddの形式で入力
・もし月までしかわかっていない場合は2021-01のように日にちは省略可
・月も分からない場合は2021のように数字だけ入力
・アルファベットや数字などはNG

</rules>
            <p>このように自動入力されている場合がありますが、間違いです。</p>
            <img src='images/39.png'>
            <p>このように-区切りで-と数字のみが入力されている状態が正しいです。</p>
            <img src='images/40.png'>
        </div>
        <div class="info20 hide">
            <h1>発売日<?php echo $info0.".info20".$close2;?></h1>
            <p>発売日が不明な場合は、この項目は空白にして下さい。</p>
            <p>日にちを入力しますが、ルールがあります。</p>
            <rules>
・不明な場合は空白
・yyyy-mm-ddの形式で入力
・もし月までしかわかっていない場合は2021-01のように日にちは省略可
・月も分からない場合は2021のように数字だけ入力
・アルファベットや数字などはNG

</rules>
            <img src='images/41.png'>
        </div>
        <div class="info21 hide">
            <h1>未発表の場合の期待される発表日<?php echo $info0.".info21".$close2;?></h1>
            <p>未発表の場合に期待される発表日があれば入力してください。<br>不明な場合や既に発表してる場合は、この項目は空白にして下さい。</p>
            <pre>Exp. announcement 2021-8-11</pre>
            <p>のように発表日が補完されている場合はその日にちを入力してください。Expは期待されるという意味です。</p>
            <p>日にちを入力しますが、ルールがあります。</p>
            <rules>
・不明な場合は空白
・yyyy-mm-ddの形式で入力
・もし月までしかわかっていない場合は2021-01のように日にちは省略可
・月も分からない場合は2021のように数字だけ入力
・アルファベットや数字などはNG

</rules>    
            <img src='images/42.png'>
        </div>
        <div class="info22 hide">
            <h1>細かいやつら<?php echo $info0.".info22".$close2;?></h1>
            <p>ここでは</p>
            <p>・これがメイン表示の場合<br>・リーク<br>・日本で発売されたやつ<br>・技適認証</p>
            <p>を入力します選択します。</p>
            <h2>これがメイン表示の場合</h2>
            <p>スプレッドシートで入力している場合、スプレッドシートのメインにチェックが付いている場合はチェックをつけてください。</p>
            <img src='images/43.png'>
            <h2>リーク</h2>
            <p>元の表にRumoredがある場合はリーク情報をまとめたスペックです、この項目にチェックをつけてください。</p>
            <h2>日本で発売されたやつ</h2>
            <p>日本でも売られている端末の場合はチェックをつけてください、ただしこの項目は日本版に限ります。同じ端末でも韓国版やグローバル版では技適がなかったり日本では発売していない場合があるので注意してください。</p>
            <h2>技適認証</h2>
            <p>技適認証がある場合はチェックして下さい。</p>
        </div>
        <div class="info23 hide">
            <h1>地域<?php echo $info0.".info23".$close2;?></h1>
            <p>入力している端末が何版なのかを選択します。<br>不明な場合はチェックをしなくて大丈夫です。<br>必ずチェックは一つまでにしてください。</p>
            <p>・日本<br>・中国<br>・インド<br>・韓国<br>・アメリカ<br>・EU<br>・グローバル</p>
            <p>不明以外の場合で該当するものがない場合はもちに連絡をください。</p>
        </div>
        <div class="info24 hide">
            <h1>端末名<?php echo $info0.".info24".$close2;?></h1>
            <p>端末名を入力してください。<br>この項目は基本的にほぼ正確に自動で入力されています。</p>
        </div>
        <div class="info25 hide">
            <h1>端末id(一意のid)<?php echo $info0.".info25".$close2;?></h1>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
        </div>
        <div class="info26 hide">
            <h1>メインiD<?php echo $info0.".info26".$close2;?></h1>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
        </div>
        <div class="info27 hide">
            <h1>同じスマホ別バージョン(,区切りでid)<?php echo $info0.".info27".$close2;?></h1>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
        </div>
        <div class="info28 hide">
            <h1>関連スマホ<?php echo $info0.".info28".$close2;?></h1>
            <p style='color:red;'>この項目は管理者用の項目です。<br>入力しなくて大丈夫です</p>
        </div>
        <div class="info29 hide">
            <h1>メーカー<?php echo $info0.".info29".$close2;?></h1>
            <p>メーターを選択してください、この項目で選択するメーカーは一つまでです。</p>
            <p>メーカーのサブブランドのスマートフォンだった場合はredmiやhonorなどサブブランドを選択してください。</p>
            <p>たとえばXiaomi POCO F1だった場合はXiaomiではなくPOCOにチェックをつけてください。</p>
        </div>
        <div class="info30 hide">
            <h1>サイズ</h1>
            <p>ここでは</p>
            <p>・サイズ<br>・重さ<br>・素材<br>・SIM<br>・SIMスロット追加情報<br>・Dual stand by<br>・防水防塵<br>・IPカスタムtxt<br>・その他のやつ</p>
            <p>を入力します</p>
            <img src='images/50.png'>
            <img src='images/51.png'>
            <img src='images/52.png'>
        </div>
        <div class="info31 hide">
            <h1>サイズ<?php echo $info0.".info31".$close2;?></h1>
            <p>元の表のDimensionsの部分です、基本的に自動で入力されます</p>
            <rules>
・数字のみで入力してください。
・アルファベットは入力しないでください。
・-は入力しないでください
・分からない場合は空のままにしてください
・小数点以下4桁より下のデータは省略して大丈夫です。
・単位はmmです、元の表にあるinはインチですので無視してください
            </rules>
            <img src='images/44.png'>
            <img src='images/45.png'>
            <img src='images/46.png'>
            <img src='images/47.png'>
        </div>
        <div class="info31a hide">
            <h1>折りたたみ時<?php echo $info0.".info31a".$close2;?></h1>
            <p>フォルダブルスマホの場合のみ入力をしてください、チェックしてからの入力になります。</p>
            <p>	Unfoldedは展開時、Foldedは折りたたみ時のサイズです。</p>
            <rules>
・数字のみで入力してください。
・アルファベットは入力しないでください。
・-は入力しないでください
・分からない場合は空のままにしてください
・小数点以下4桁より下のデータは省略して大丈夫です。
・単位はmmです、元の表にあるinはインチですので無視してください
            </rules>
            <img src='images/69.png'>
        </div>
        <div class="info32 hide">
            <h1>重さ<?php echo $info0.".info33".$close2;?></h1>
            <p>元の表のWeightの部分です、基本的に自動で入力されます</p>
            <rules>
・数字のみで入力してください。
・アルファベットは入力しないでください。
・-は入力しないでください
・分からない場合は空のままにしてください
・小数点以下4桁より下のデータは省略して大丈夫です。
・単位はmmです、元の表にあるozはオンスですので無視してください
            </rules>
            <img src='images/48.png'>
            <img src='images/49.png'>
        </div>
        <div class="info32a hide">
            <h1>重さ<?php echo $info0.".info33".$close2;?></h1>
            <p>元の表のweightが複数ある場合はこの項目に入力してください</p>
            <p>入力はg:内容1,g:内容2,g:内容3...の形式でしてください。</p>
            <pre>317 g (Glass)
332 g (Ceramic)</pre>
            <p>だった場合は</p>
            <pre>317:Glass,332:Ceramic</pre>
            <p>のようになります。</p>
            <img src='images/70.png'>
        </div>
        <div class="info33 hide">
            <h1>素材<?php echo $info0.".info33".$close2;?></h1>
            <p>元の表のbuildの部分を入力します、日本語版と英語版両方とも「,」区切りでそれぞれ入力してください。</p>
            <p>元の表が英語なので、英語版は基本的にbuildのままで大丈夫ですが、日本語版の部分は英語を日本語に変換してください。</p>
            <p>下にある程度参考の英単語と日本語訳を用意しておきます。正式名称が英語のものは翻訳しなくて大丈夫です(例:Gorilla Glass 5など)</p>
            <p>二行ある場合に自動で英語版が補完されていない場合がありますので注意してください。</p>
            <p>glass back (Gorilla Glass 5) or ceramic backのようにorなどを含む場合orは「または」と変換して下さい</p>
            <img src='images/53.png'>
            <img src='images/54.png'>
            <table>
                <tr>
                    <th>Aluminum frame</th>
                    <td>アルミニウムフレーム</td>
                </tr>
                <tr>
                    <th>Glass front</th>
                    <td>フロントガラス</td>
                </tr>
                <tr>
                    <th>ceramic back</th>
                    <td>ブラックセラミック</td>
                </tr>
                <tr>
                    <th>Glass front (Gorilla Glass Victus)</th>
                    <td>フロントガラス(Gorilla Glass Victus)</td>
                </tr>
                <tr>
                    <th>plastic back</th>
                    <td>背面プラスチック</td>
                </tr>
                <tr>
                    <th>plastic frame</th>
                    <td>プラスチックフレーム</td>
                </tr>
                <tr>
                    <th>Glass front (Gorilla Glass 5)</th>
                    <td>フロントガラス(Gorilla Glass 5)</td>
                </tr>
                <tr>
                    <th>glass back (Gorilla Glass 5)</th>
                    <td>背面ガラス(Gorilla Glass 5)</td>
                </tr>
                <tr>
                    <th>glass back (Gorilla Glass 5) or ceramic back</th>
                    <td>フロントガラス(Gorilla Glass 5)またはブラックセラミック</td>
                </tr>
                <tr>
                    <th>plastic front (unfolded)</th>
                    <td>フロントプラスチック (展開時)</td>
                </tr>
                <tr>
                    <th>Glass front (Asahi Dragontrail)</th>
                    <td>フロントガラス(Asahi Dragontrail)</td>
                </tr>
                <tr>
                    <th>stainless steel frame</th>
                    <td>スチール ステンレスフレーム</td>
                </tr>
            </table>
        </div>
        <div class="info34 hide">
            <h1>SIM<?php echo $info0.".info34".$close2;?></h1>
            Single SIM (Nano-SIM and/or eSIM) or Dual SIM (Nano-SIM and/or eSIM, dual stand-by)
            //TODO
            <img src='images/55.png'>
            <img src='images/56.png'>
        </div>
        <div class="info35 hide">
            <h1>SIMスロット追加情報<?php echo $info0.".info35".$close2;?></h1>
            <p>この項目は基本入力しなくて大丈夫です、SIMの項目にSIMスロット以外の説明があったときだけ入力して下さい。</p>
            <p>日本語、英語版があります、元の文を英語部分に翻訳したものを日本語部分に入力してください。<br>できるだけ違和感のない日本語にしてください。</p>
        </div>
        <div class="info36 hide">
            <h1>Dual stand by<?php echo $info0.".info37".$close2;?></h1>
            <p>デュアルスタンバイに対応している場合チェックしてください。</p>
            <p>SIMの項目にDual stand byが含まれている場合は対応しています。</p>
            <img src='images/57.png'>
            <img src='images/58.png'>
        </div>
        <div class="info37 hide">
            <h1>防水防塵<?php echo $info0.".info37".$close2;?></h1>
            <p>元の表のSIMの項目の2行目以降に防水防塵に関する表記がある場合は入力してください。<br>稀に他の部分に書いてある場合がありますがどうしていいかわからない場合はもちまで連絡をください。</p>
            <p>防水防塵に対応している場合は防水防塵対応にチェックを入れ対応している等級にチェックを入れます。<br>仮にIP68に対応している場合は、防水防塵対応、IP X6、IP X8にチェックを入れることになります。 <br>MIL規格に対応している場合にも防水防塵対応にチェックを入れてください。<br>P2iのみに対応している場合はP2i撥水のみにチェックをつけて防水防塵対応にはチェックを付けないでください。</p>
            <p>IP68/IP65のように表示されている場合は、防水防塵対応、IP X6、IP X8、IP X5のようにチェックを入れてください。</p>
            <img src='images/59.png'>
            <img src='images/60.png'>
        </div>
        <div class="info38 hide">
            <h1>IPカスタムtxt<?php echo $info0.".info38".$close2;?></h1>
            <p>防水防塵に関する等級がIP68/IP65のように複数ある場合にそれぞれを/区切りで入力してください</p>
            <img src='images/61.png'>
            <img src='images/62.png'>
        </div>
        <div class="info39 hide">
            <h1>その他のやつ<?php echo $info0.".info39".$close2;?></h1>
            <p>SIMの項目の2行目以降にある項目と対応しています、この部分にstyle supportと書いてあった場合はスタイラスペン対応のようにチェックをつけてください。</p>
            <p>それぞれの英語と日本語訳を以下に置いておきます。</p>
            <table>
                <tr>
                    <th>Apple Pay (Visa, MasterCard, AMEX certified)</th>
                    <td>Apple Pay</td>
                </tr>
                <tr>
                    <th>Physical pop-up gaming triggers</th>
                    <td>ポップアップゲーミングボタン</td>
                </tr>
                <tr>
                    <th>style support</th>
                    <td>スタイラスペン対応</td>
                </tr>
                <tr>
                    <th>Pressure sensitive zones (400Hz touch-sensing)</th>
                    <td>プロ・ショルダー・トリガー3.0(400Hz)</td>
                </tr>
                <tr>
                    <th>stainless steel frame</th>
                    <td>スチール ステンレスフレーム</td>
                </tr>
                <tr>
                    <th>Built-in cooling fan</th>
                    <td>内蔵冷却ファン</td>
                </tr>
            </table>
            <img src='images/63.png'>
            <img src='images/64.png'>
        </div>
        <div class="info40 hide">
            <h1>スクリーン<?php echo $info0.".info40".$close2;?></h1>
            <p>画面に関する情報の入力についてです。</p>
        </div>
        <div class="info41 hide">
            <h1>パネル種類（カスタムテキスト）<?php echo $info0.".info41".$close2;?></h1>
            <p>この項目は基本自動で補完されます、ディスプレイの種類を入力してください、Super AMOLEDや、Retina IPS、Dot Displayなどです。</p>
            <p>ディスプレイが分からない場合は入力しないでください。</p>
            <p>ディスプレイじゃない文字が補完される場合がありますが、間違いです、入力をしなおしてください。</p>
            <img src='images/65.png'>
            <img src='images/66.png'>
        </div>
        <div class="info42 hide">
            <h1>画面補足情報（セカンドディスプレイなど）<?php echo $info0.".info42".$close2;?></h1>
            <p>この項目は基本入力しません、Z Filpのように複数画面がある場合はその画面の情報を入力してください。
                <br>例は後述します。
            </p>
        </div>
        <div class="info43 hide">
            <h1>画面保護<?php echo $info0.".info43".$close2;?></h1>
            <p>元の表のProtection部分です、日本語版と英語版両方とも「,」区切りでそれぞれ入力してください。</p>
            <p>元の表が英語なので、英語版は基本的にProtectionのままで大丈夫ですが、日本語版の部分は英語を日本語に変換してください。</p>
            <p>下にある程度参考の英単語と日本語訳を用意しておきます。正式名称が英語のものは翻訳しなくて大丈夫です(例:Gorilla Glass 5など)</p>
            <p>二行ある場合に自動で英語版が補完されていない場合がありますので注意してください。</p>
            <p>glass back (Gorilla Glass 5) or ceramic backのようにorなどを含む場合orは「または」と変換して下さい</p>
            <table>
                <tr>
                    <th>Aluminum frame</th>
                    <td>アルミニウムフレーム</td>
                </tr>
                <tr>
                    <th>Glass front</th>
                    <td>フロントガラス</td>
                </tr>
                <tr>
                    <th>ceramic back</th>
                    <td>ブラックセラミック</td>
                </tr>
                <tr>
                    <th>Glass front (Gorilla Glass Victus)</th>
                    <td>フロントガラス(Gorilla Glass Victus)</td>
                </tr>
                <tr>
                    <th>plastic back</th>
                    <td>背面プラスチック</td>
                </tr>
                <tr>
                    <th>plastic frame</th>
                    <td>プラスチックフレーム</td>
                </tr>
                <tr>
                    <th>Glass front (Gorilla Glass 5)</th>
                    <td>フロントガラス(Gorilla Glass 5)</td>
                </tr>
                <tr>
                    <th>glass back (Gorilla Glass 5)</th>
                    <td>背面ガラス(Gorilla Glass 5)</td>
                </tr>
                <tr>
                    <th>glass back (Gorilla Glass 5) or ceramic back</th>
                    <td>フロントガラス(Gorilla Glass 5)またはブラックセラミック</td>
                </tr>
                <tr>
                    <th>plastic front (unfolded)</th>
                    <td>フロントプラスチック (展開時)</td>
                </tr>
                <tr>
                    <th>Glass front (Asahi Dragontrail)</th>
                    <td>フロントガラス(Asahi Dragontrail)</td>
                </tr>
                <tr>
                    <th>stainless steel frame</th>
                    <td>スチール ステンレスフレーム</td>
                </tr>
            </table>
        </div>
        <div class="info44 hide">
            <h1>インチ<?php echo $info0.".info44".$close2;?></h1>
            <p>元の表のSizeのinhesの部分です、半角数字で入力してください。</p>
        </div>
        <div class="info45 hide">
            <h1>リフレッシュレート<?php echo $info0.".info45".$close2;?></h1>
            <p>元の表のTypeのHzが単位になっている部分です、半角数字で入力してください。</p>
            <p>同じようにタッチレートもHzで表示されている場合があります。<br>基本的には小さい方がリフレッシュレートです。</p>
            <p>書いていない場合はおそらく60Hzですが、記載されてない情報は入力しないでください。</p>
        </div>
        <div class="info46 hide">
            <h1>タッチレート<?php echo $info0.".info46".$close2;?></h1>
            <p>元の表のTypeのHzが単位になっている部分です、半角数字で入力してください。</p>
            <p>同じようにタッチレートもHzで表示されている場合があります。</p>
        </div>
        <div class="info47 hide">
            <h1>輝度<?php echo $info0.".info47".$close2;?></h1>
            <p>元の表のTypeのnitsが単位になっている部分です、半角数字で入力してください。</p>
            <p>typ、HBM、peakの3つがありそれぞれ同じ輝度ですが別の値が設定されています、一部ない場合もありますが書いてあるものだけ入力をしてください。</p>
        </div>
        <div class="info48 hide">
            <h1>画面占有率<?php echo $info0.".info48".$close2;?></h1>
            <p>Sizeの (~数字% screen-to-body ratio)部分です。数字の部分を半角数字で入力してください。</p>
        </div>
        <div class="info49 hide">
            <h1>pixel<?php echo $info0.".info49".$close2;?></h1>
        </div>
        <div class="info50 hide">
            <h1>アスペクト比<?php echo $info0.".info50".$close2;?></h1>
            
        </div>
        <div class="info51 hide">
            <h1>DPI<?php echo $info0.".info51".$close2;?></h1>
        </div>
        <div class="info52 hide">
            <h1>表示色<?php echo $info0.".info52".$close2;?></h1>
        </div>
        <div class="info53 hide">
            <h1>コントラスト比<?php echo $info0.".info53".$close2;?></h1>
            <p>500:1のようにコントラストが分かっている場合入力してください、必ず白:黒のようになるよう入力してください。</p>
            <img src='images/67.png'>
            <img src='images/68.png'>
        </div>
        <div class="info54 hide">
            <h1>湾曲ディスプレイの場合の角度<?php echo $info0.".info54".$close2;?></h1>
        </div>
        <div class="info55 hide">
            <h1>インカメラタイプ<?php echo $info0.".info55".$close2;?></h1>
        </div>
        <div class="info56 hide">
            <h1>画面タイプ<?php echo $info0.".info56".$close2;?></h1>
        </div>
        <div class="info57 hide">
            <h1>細かいやつら<?php echo $info0.".info57".$close2;?></h1>
        </div>
        <div class="info58 hide">
            <h1>ソフトウェア<?php echo $info0.".info58".$close2;?></h1>

        </div>
        <div class="info59 hide">
            <h1>OS<?php echo $info0.".info59".$close2;?></h1>
            <p>該当するOSをクリックして入力してください、基本的にこの項目は自動補完されませんのでご注意ください。</p>
        </div>
        <div class="info60 hide">
            <h1>OS ver<?php echo $info0.".info60".$close2;?></h1>
            <p>OSのバージョンを数字で入力してください、バージョン識別番号が数字以外の形式である場合はもちまで連絡をください。</p>
            <p>仮にOSがAndroid　8.1 Oreoだった場合は8.1の数字部分を入力してください<br>Oreoの部分は必要ないので入力しないでください。</p>
        </div>
        <div class="info61 hide">
            <h1>GMS非対応<?php echo $info0.".info61".$close2;?></h1>
            <p>一部中国モデルや、HMS搭載モデルにはGMSを搭載していない場合があります、搭載していないモデルのみチェックをつけてください</p>
        </div>
        <div class="info62 hide">
            <h1>OS更新可能なバージョン<?php echo $info0.".info62".$close2;?></h1>
            <p>available upgrade to Android 10 MIUI 11のように元の表に更新可能なバージョンが明記されている場合は更新可能なバージョンを入力してください。<br>OS verと同じく数字のみです、System UI のバージョンについても書かれている場合がありますが、こちらはこの項目ではなくUI更新可能verで入力してください。<br>この例の場合だと10になります。</p>
        </div>
        <div class="info63 hide">
            <h1>UI<?php echo $info0.".info63".$close2;?></h1>
            <p>system uiが元の表に明記されている場合、そのUI名を入力してください。<br>MIUI For POCOやMIUI、Origin OSとFuntouchOSは別物ですので気を付けて入力して下さい。</p>
        </div>
        <div class="info64 hide">
            <h1>UI ver<?php echo $info0.".info64".$close2;?></h1>
        </div>
        <div class="info65 hide">
            <h1>UI更新可能なバージョン<?php echo $info0.".info65".$close2;?></h1>
        </div>
        <div class="info66 hide">
            <h1>OS追加説明<?php echo $info0.".info66".$close2;?></h1>
        </div>
        <div class="info67 hide">
            <h1>UI追加説明<?php echo $info0.".info67".$close2;?></h1>
        </div>
        <div class="info68 hide">
            <h1>SoC ID<?php echo $info0.".info68".$close2;?></h1>
            <p>下にあるSoCの短縮名と番号が書かれたsocidボタンがあるので、該当するSoCをクリックしてください。<br>クリックすると自動で入力されます、もしsocidボタンに該当するSoCがない場合はもちまで連絡をください。</p>
        </div>
        <div class="info69 hide">
            <h1>CPU構成(本来の構成と異なる場合)<?php echo $info0.".info69".$close2;?></h1>
        </div>
        <div class="info70 hide">
            <h1>GPU構成(本来の構成と異なる場合)<?php echo $info0.".info70".$close2;?></h1>
        </div>
        <div class="info71 hide">
            <h1>RAM/ストレージ<?php echo $info0.".info71".$close2;?></h1>
        </div>
        <div class="info72 hide">
            <h1>Micro SDカード<?php echo $info0.".info72".$close2;?></h1>
        </div>
        <div class="info73 hide">
            <h1>NMカード<?php echo $info0.".info73".$close2;?></h1>
        </div>
        <div class="info74 hide">
            <h1>メモリGB(この構成のものだけ)<?php echo $info0.".info74".$close2;?></h1>
        </div>
        <div class="info75 hide">
            <h1>メモリ規格(この構成のものだけ)<?php echo $info0.".info75".$close2;?></h1>
        </div>
        <div class="info76 hide">
            <h1>ストレージ規格(この構成のものだけ)<?php echo $info0.".info76".$close2;?></h1>
        </div>
        <div class="info77 hide">
            <h1>ストレージGB(この構成のものだけ)<?php echo $info0.".info77".$close2;?></h1>
        </div>
        <div class="info78 hide">
            <h1>他のバージョン<?php echo $info0.".info78".$close2;?></h1>
        </div>
        <div class="info79 hide">
            <h1>アウトカメラ<?php echo $info0.".info79".$close2;?></h1>
        </div>
        <div class="info80 hide">
            <h1>カメラ数<?php echo $info0.".info80".$close2;?></h1>
        </div>
        <div class="info81 hide">
            <h1>カメラ<?php echo $info0.".info81".$close2;?></h1>
        </div>
        <div class="info82 hide">
            <h1>特徴(Features)<?php echo $info0.".info82".$close2;?></h1>
        </div>
        <div class="info83 hide">
            <h1>動画<?php echo $info0.".info83".$close2;?></h1>
        </div>
        <div class="info84 hide">
            <h1>インカメラ<?php echo $info0.".info84".$close2;?></h1>
        </div>
        <div class="info85 hide">
            <h1>インカメラ数<?php echo $info0.".info85".$close2;?></h1>
        </div>
        <div class="info86 hide">
            <h1>カメラ<?php echo $info0.".info86".$close2;?></h1>
        </div>
        <div class="info87 hide">
            <h1>特徴(Features)<?php echo $info0.".info87".$close2;?></h1>
        </div>
        <div class="info88 hide">
            <h1>インカメラ動画<?php echo $info0.".info88".$close2;?></h1>
        </div>
        <div class="info89 hide">
            <h1>オーディオ<?php echo $info0.".info89".$close2;?></h1>
        </div>
        <div class="info90 hide">
            <h1>3.5mmイヤホンジャック<?php echo $info0.".info90".$close2;?></h1>
        </div>
        <div class="info91 hide">
            <h1>通話用スピーカー(Loudspeaker)<?php echo $info0.".info91".$close2;?></h1>
        </div>
        <div class="info92 hide">
            <h1>デュアルスピーカー<?php echo $info0.".info92".$close2;?></h1>
        </div>
        <div class="info93 hide">
            <h1>ステレオスピーカー<?php echo $info0.".info93".$close2;?></h1>
        </div>
        <div class="info94 hide">
            <h1>デュアルスピーカー（ステレオ）<?php echo $info0.".info94".$close2;?></h1>
        </div>
        <div class="info95 hide">
            <h1>トリプルスピーカー（ステレオ）<?php echo $info0.".info95".$close2;?></h1>
        </div>
        <div class="info96 hide">
            <h1>クアッドスピーカー(ステレオ)<?php echo $info0.".info96".$close2;?></h1>
        </div>
        <div class="info97 hide">
            <h1>24-bit/192kHz<?php echo $info0.".info97".$close2;?></h1>
        </div>
        <div class="info98 hide">
            <h1>32-bit/384kHz<?php echo $info0.".info98".$close2;?></h1>
        </div>
        <div class="info99 hide">
            <h1>Tuned by AKG<?php echo $info0.".info99".$close2;?></h1>
        </div>
        <div class="info100 hide">
            <h1>Tuned by JBL<?php echo $info0.".info100".$close2;?></h1>	
        </div>
        <div class="info101 hide">
            <h1>Tuned by Harman Kardon<?php echo $info0.".info101".$close2;?></h1>	
        </div>
        <div class="info102 hide">
            <h1>オーディオ追加説明<?php echo $info0.".info102".$close2;?></h1>
        </div>
        <div class="info103 hide">
            <h1>ネットワーク<?php echo $info0.".info103".$close2;?></h1>
        </div>
        <div class="info104 hide">
            <h1>Wi-Fi<?php echo $info0.".info104".$close2;?></h1>
        </div>
        <div class="info105 hide">
            <h1>ポート情報<?php echo $info0.".info105".$close2;?></h1>
        </div>
        <div class="info106 hide">
            <h1>USB On-The-Go<?php echo $info0.".info106".$close2;?></h1>
        </div>
        <div class="info107 hide">
            <h1>bluetooth<?php echo $info0.".info107".$close2;?></h1>
        </div>
        <div class="info108 hide">
            <h1>NFC<?php echo $info0.".info108".$close2;?></h1>
        </div>
        <div class="info109 hide">
            <h1>赤外線ポート[Infrared port]<?php echo $info0.".info109".$close2;?></h1>
        </div>
        <div class="info110 hide">
            <h1>ラジオ<?php echo $info0.".info110".$close2;?></h1>
        </div>
        <div class="info111 hide">
            <h1>GPS<?php echo $info0.".info111".$close2;?></h1>
        </div>
        <div class="info112 hide">
            <h1>センサー<?php echo $info0.".info112".$close2;?></h1>
        </div>
        <div class="info113 hide">
            <h1>センサー類<?php echo $info0.".info113".$close2;?></h1>
        </div>
        <div class="info113a hide">
            <h1>指紋センサー<?php echo $info0.".info113a".$close2;?></h1>
        </div>
        <div class="info114 hide">
            <h1>バッテリー<?php echo $info0.".info114".$close2;?></h1>
        </div>
        <div class="info115 hide">
            <h1>バッテリー容量<?php echo $info0.".info115".$close2;?></h1>
        </div>
        <div class="info116 hide">
            <h1>バッテリーについての補足情報<?php echo $info0.".info116".$close2;?></h1>	
        </div>
        <div class="info117 hide">
            <h1>バッテリー取り外し可能<?php echo $info0.".info117".$close2;?></h1>
        </div>
        <div class="info118 hide">
            <h1>ワイヤレス規格<?php echo $info0.".info118".$close2;?></h1>
        </div>
        <div class="info119 hide">
            <h1>ワイヤレス充電<?php echo $info0.".info119".$close2;?></h1>
        </div>
        <div class="info120 hide">
            <h1>ワイヤレス充電速度<?php echo $info0.".info120".$close2;?></h1>
        </div>
        <div class="info121 hide">
            <h1>ワイヤレス逆充電<?php echo $info0.".info121".$close2;?></h1>
        </div>
        <div class="info122 hide">
            <h1>ワイヤレス逆充電速度<?php echo $info0.".info122".$close2;?></h1>
        </div>
        <div class="info123 hide">
            <h1>充電に関する補足情報<?php echo $info0.".info123".$close2;?></h1>
        </div>
        <div class="info124 hide">
            <h1>最大充電速度<?php echo $info0.".info124".$close2;?></h1>
        </div>
        <div class="info125 hide">
            <h1>リチウムイオン電池<?php echo $info0.".info125".$close2;?></h1>
        </div>
        <div class="info126 hide">
            <h1>給電<?php echo $info0.".info126".$close2;?></h1>
        </div>
        <div class="info127 hide">
            <h1>充電規格<?php echo $info0.".info127".$close2;?></h1>
        </div>
        <div class="info128 hide">
            <h1>カラー/金額<?php echo $info0.".info128".$close2;?></h1>
        </div>
        <div class="info129 hide">
            <h1>色[カラー名:カラーコード,カラー名:カラーコード,のように入力するわからない場合は-]<?php echo $info0.".info129".$close2;?></h1>
        </div>
        <div class="info130 hide">
            <h1>モデル番号<?php echo $info0.".info130".$close2;?></h1>
        </div>
        <div class="info131 hide">
            <h1>価格<?php echo $info0.".info131".$close2;?></h1>
        </div>
        <div class="info132 hide">
            <h1>SAR<?php echo $info0.".info132".$close2;?></h1>
        </div>
        <div class="info133 hide">
            <h1>テスト<?php echo $info0.".info133".$close2;?></h1>
        </div>
        <div class="info134 hide">
            <h1>Antutu<?php echo $info0.".info134".$close2;?></h1>
            <p>Antutuのスコアが分かる場合は入力して下さい。「,」は入れずに数字のみで入力してください。</p>
        </div>
        <div class="info135 hide">
            <h1>その他のベンチマークスコア<?php echo $info0.".info135".$close2;?></h1>
            <p>ベンチマークスコアを入力してください、半角英数字のみで入力してください、不明な部分は空白にしてください。<br>入力欄のないベンチマークに対応していた場合もちまで連絡をください</p>
        </div>
        <div class="info136 hide">

        </div>
        <div class="info137 hide">

        </div>
        <div class="info138 hide">

        </div>
        <div class="info139 hide">

        </div>
        <div class="info130 hide">

        </div>
    </div>
</div>


スクリーン
USB On-The-Go
リチウムポリマー