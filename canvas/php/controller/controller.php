<?php 
function filtrer($name="id"){
    $resultat=$_POST[$name]??"";
    return $resultat;
}
 $identifiantFormulaire=filtrer("identifiantFormulaire");
if($identifiantFormulaire=="creat"){
$tab=["title"=>filtrer("title"),
"description"=>filtrer("description")
];
extract($tab);
if($title!=""&& $description!=""){

$sql="INSERT INTO todo (title,description)VALUES(:title,:description)";
require "php/model/model.php";
}}

if($formulaire=="update") {
            $tab=["id"=>filtrer("id")
            ,"title"=>filtrer("title"),
            "description"=>filtrer("description")
            ];
            extract($tab);
          if($id!=""&&$title!=""&& $description!=""){
            $sql="UPDATE todo SET 
            id =:id,
            title =:title,
            description =:description
            WHERE id=:id";
            require "php/model/model.php";
            
    }
}
if($formulaire=="delete"){
    $tab=["id"=>filtrer("id")];
    extract($tab);
    if($id!=""){
    $sql="DELETE FROM todo WHERE id=:id";
    require "php/model/model.php";
}}