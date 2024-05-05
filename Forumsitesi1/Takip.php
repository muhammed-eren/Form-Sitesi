<?php
    include 'datebase.php';

    $islem = @$_POST["islem"];
    $id = @$_POST["id"];
    $my = @$_POST["my"];
    $sql = @$db->query("SELECT * FROM kayitbilgi WHERE id = '$id'");
    $kayit = @$sql->fetch(PDO::FETCH_ASSOC);
    $takici = @$kayit["takipci"];

    switch ($islem) {
        case 'takip':
            $sql = $db->query("INSERT INTO follows (follower_id, following_id) VALUES ('$my', '$id')");
            $sql = $db->query("UPDATE kayitbilgi SET takipci = $takici + 1 WHERE id = '$id'");
            
            $sql = @$db->query("SELECT * FROM kayitbilgi WHERE id = '$id'");
            $kayit = @$sql->fetch(PDO::FETCH_ASSOC);
            $takici = @$kayit["takipci"];

            $query = $db->query("SELECT * FROM follows WHERE follower_id = '$my' AND following_id = '$id'");
            if($query)
            {
                echo json_encode(array("takipci" => $takici,"button" => '<button id="btn" class="btn btn-warning me-1 flex-grow-1 w-100" data-my="'.$my.'" data-id="'.$id.'" data-islem="bırak">Takiptesin</button>'));
            }
            break;
        case 'bırak':
            $sql = $db->query("DELETE FROM follows WHERE follower_id='$my' AND following_id='$id'");
            $sql = $db->query("UPDATE kayitbilgi SET takipci = $takici - 1 WHERE id = '$id'");$sql = $db->query("DELETE FROM follows WHERE follower_id='$my' AND following_id='$id'");
            
            $sql = @$db->query("SELECT * FROM kayitbilgi WHERE id = '$id'");
            $kayit = @$sql->fetch(PDO::FETCH_ASSOC);
            $takici = @$kayit["takipci"];

            $query = $db->query("SELECT * FROM follows WHERE follower_id = '$my' AND following_id = '$id'");
            if($query)
            {
                echo json_encode(array("takipci" => $takici,"button" => '<button id="btn" class="btn btn-outline-warning me-1 flex-grow-1 w-100" data-my="'.$my.'" data-id="'.$id.'" data-islem="takip">Takip Et</button>'));
            }
            break;
        default:
            echo "Hatalı islem";
            break;
    }
?>