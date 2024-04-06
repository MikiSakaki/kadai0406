<?php
//1. POSTデータ取得
//[name,email,age,naiyou]
$name   = $_POST["name"];
$url  = $_POST["url"];
$comment    = $_POST["comment"];
// $naiyou = $_POST["naiyou"];


//2. DB接続します
try {
  //Password:MAMP='root',XAMPP='' 
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONECT:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql ="INSERT INTO gs_bm_table(name,url,comment,indate)VALUES(:name,:url,:comment,sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',  $url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',    $comment,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //true or false

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト

  header("Location: index.php");
  exit();

}
?>
