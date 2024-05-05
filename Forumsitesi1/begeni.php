<?php
    include 'datebase.php';

    $islem = $_POST["islem"];
    $id = $_POST["id"];
    $my = $_POST["my"];
    $sql = $db->query("SELECT * FROM tartisma WHERE id = '$id'");
    $kayit = $sql->fetch(PDO::FETCH_ASSOC);
    $begen = $kayit["begeni"];
    switch ($islem) {
        case 'begen':
            $sql = $db->query("INSERT INTO begeni (k_id, makale_id) VALUES ('$my', '$id')");
            
            $sql = $db->query("UPDATE kayitbilgi SET begeni = $begen + 1 WHERE kullaniciadi = '$kayit[kadi]'");
            $sql = $db->query("UPDATE tartisma SET begeni = $begen + 1 WHERE id = '$id'");

            $sql = $db->query("SELECT * FROM tartisma WHERE id = '$id'");
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $begenbtn = $db->query("SELECT * FROM begeni WHERE k_id = '$my' AND makale_id = '$id'");
            if($begenbtn)
            {
                echo json_encode(array(
                    "begeni" => $row["begeni"],
                    "button" => '<button id="btn" class="btn btn-warning me-1 d-flex flex-grow-1 w-100" data-my="'.$my.'" data-id="'.$id.'" data-islem="begenme">Beğenme<p class="text-black" style="margin: 0px 10px;" id="begeniSayisi">'.$row['begeni'].'</p></button>'
                ));                
            }
            break;
        case 'begenme':
            $sql = $db->query("DELETE FROM begeni WHERE k_id ='$my' AND makale_id='$id'");

            $sql = $db->query("UPDATE kayitbilgi SET begeni = $begen - 1 WHERE kullaniciadi = '$kayit[kadi]'");
            $sql = $db->query("UPDATE tartisma SET begeni = $begen - 1 WHERE id = '$id'");

            $sql = $db->query("SELECT * FROM tartisma WHERE id = '$id'");
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $begenbtn = $db->query("SELECT * FROM begeni WHERE k_id = '$my' AND makale_id = '$id'");
            if($begenbtn)
            {
                echo json_encode(array(
                    "begeni" => $row["begeni"],
                    "button" => '<button id="btn" class="btn btn-outline-warning me-1 d-flex flex-grow-1 w-100" data-my="'.$my.'" data-id="'.$id.'" data-islem="begen">Beğen<p class="text-black" style="margin: 0px 10px;" id="begeniSayisi">'.$row['begeni'].'</p></button>'
                ));
            }
            break;
        default:
            echo "Hatalı islem";
            break;
    }
?>