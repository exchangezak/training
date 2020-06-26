<?php

function getConnection(){
    $dsn=("mysql:host=localhost;dbname=datas;charset=utf8");
    $user="root";
    $pw="";
    $options=[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
];
try{
$dns=new PDO($dsn,$user,$pw,$options);
// debug si la connection a  la base de donnes a etabli
// echo "connection succefuly";
}catch(PDOException $e){
    echo"connection failed".$e->getMessage();
}
return $dns;
}
function creat($tab,$sql){
    $bdd=getConnection();
    $pdo=$bdd->prepare($sql);
   return $pdo->execute($tab);
}
function update($tab,$sql){
    $bdd=getConnection();
    $pdo=$bdd->prepare($sql);
    return $pdo->execute($tab);
   
}
function delete($tab,$sql){
    $bdd=getConnection();
    $pdo=$bdd->prepare($sql);
    return $pdo->execute($tab);
    ;
}
function read(){
    $sql="SELECT * FROM `todo`";
    $pdo=getConnection()->prepare($sql);  
    $pdo->execute();
    return $resultat=$pdo->fetchAll(PDO::FETCH_ASSOC);
}
$formulaire=$_POST["formulaire"]??"";
if($formulaire=="creat"){
    if(isset($_POST["title"])&& isset($_POST["description"])&& isset($_POST["statut"])){
        $tableau=["title"=>$_POST["title"]??"",
        "description"=>$_POST["description"]??"",
        "statut"=>$_POST["statut"]??""
    ];
    $sql="INSERT INTO todo (title,description,statut) VALUES (:title,:description,:statut)";
    creat($tableau,$sql);
    }
}
if($formulaire=="update"){
    if(isset($_POST["id"]) && isset($_POST["title"])&& isset($_POST["description"])&& isset($_POST["statut"])){
        $tableau=["id"=>$_POST["id"],
                  "title"=>$_POST["title"],
                  "description"=>$_POST["description"],
                 "statut"=>$_POST["statut"]
    ];
    $sql="UPDATE todo SET title = :title, description = :description, statut = :statut WHERE id = :id"; 
    update($tableau,$sql);
    }
}
if($formulaire=="delete"){
    if(isset($_POST["id"])){
        $tab=["id"=>$_POST["id"]];
        $sql="DELETE FROM todo WHERE id=:id";
        delete($tab,$sql);
    }
}
