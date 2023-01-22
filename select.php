<?php
//1.  DB接続
require_once('funcs.php');
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bar_memo");

//3. 実行
$status = $stmt->execute();


//4．データ表示
$view="";
if($status == false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= "<tr>";
        $view .= "<td>".$result['postDate']."</td>";
        $view .= "<td>".$result['barName']."</td>";
        $view .= "<td>".$result['mapUrl']."</td>";
        $view .= "<td>".$result['rating']."</td>";
        $view .= "<td>".$result['comment']."</td>";
        $view .= "<td style='white-space:nowrap;'>".$result['goDate']."</td>";
        $view .= "</tr>";

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>@media (max-width:1000px) {.table {width: 1000px}}</style>

    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">Bar メモ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="select.php">List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./search.php">Search</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <!-- 検索欄 -->



    <!-- データ表示テーブル -->
    <div style="width: 100vw; overflow:scroll;">
        <table class="table">
        <thead>
            <tr>
            <th scope="col" style="width: 110px;">投稿日</th>
            <th scope="col">Bar</th>
            <th scope="col">場所URL</th>
            <th scope="col" style="white-space:nowrap;">評価</th>
            <th scope="col">コメント</th>
            <th scope="col" style="white-space:nowrap;">訪問日</th>

            </tr>
        </thead>
        <tbody>
            <?= $view?>
        </tbody>
        </table> 
    </div>


    <!-- style="white-space:nowrap;" -->

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <script>

    </script>

</body>
</html>