<?php
// 1. POSTデータ取得
$barName = $_POST['barName'];
$mapUrl  = $_POST['mapUrl'];
$rating  = $_POST['rating'];
$comment = $_POST['comment'];
$goDate = $_POST['goDate'];


// 2. DB接続
require_once('funcs.php'); //funcs.phpに記述されている関数を呼び出し
$pdo = db_conn();

// 3. SQL文を用意（データ登録：INSERT）
$stmt = $pdo->prepare(
    "INSERT INTO gs_bar_memo ( id, postDate, barName, mapUrl, rating, comment, goDate) 
    VALUES ( NULL, sysdate(), :barName, :mapUrl, $rating, :comment, :goDate)"
);


// 4. バインド変数を用意
// PDO::PARAM_STRでただの文字列に変換し、コード埋め込みによる攻撃を防ぐ
$stmt->bindValue(':barName', $barName, PDO::PARAM_STR);
$stmt->bindValue(':mapUrl', $mapUrl, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':goDate', $goDate, PDO::PARAM_STR);


// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status == false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
}else{
    // 7．リダイレクト
    header('Location: select.php');
}




?>