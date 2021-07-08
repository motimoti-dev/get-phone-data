# スマホデータ収集のスクリプト

自分用の取扱説明書です。

## 対応サイト
- GSMarena
- DXO(予定)

## このコードで出来ること

GSMarenaからスクレイピングでデータを抽出、sumahotektek.com用のjsonファイルに変換できます。
以下はスクレイピング時に出力されるHTMLのサンプルです。

<a href='https://motimoti-dev.github.io/get-phone-data/sample-data.html'>出力結果のサンプル</a>

この画面でデータ出力したHTMLでは、ある程度のデータがあらかじめ自動で入力されたスペック表が出てきます。

<img src='https://motimoti-dev.github.io/get-phone-data/images/sample-1.png'>

このスクレイピングでは完全にすべてのデータを捌き切れるわけでもないので、それぞれ間違っている点を修正してください。
IDはsumahotektekのドキュメントにしたがって常に一意のIDを入力してください。
同じスマホで違う構成のスマートフォンが存在する場合は一番容量の少ないモデルをメインとしてIDを入力してください。

入力したデータはJsonに変換しsumahotektek.comへAPI経由でスペック記事に変換できます。
変換後には画像データのない下書き記事が生成されるので、画像とサムネイルを入力してください。
画像の挿入方法については、sumahotektek.com管理画面のドキュメントタブ3ページ目のAPI欄に記載してあります。


