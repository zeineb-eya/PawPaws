<?php
include "../config.php";
class roomC1
{
    function affiche()
    {


        $sql = "SELECT * FROM rooms ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);

            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    
    public function deleteroom($idroom) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'DELETE FROM rooms WHERE idroom= :idroom'
            );
            $query->execute([
                'idroom' => $idroom
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function updateroom($Room, $idroom)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE rooms SET hoteladresse=:hoteladresse, roomtype=:roomtype, price=:price, photo=:photo, qty=:qty WHERE idroom=:idroom'
            );
            $query->execute([
                'hoteladresse' => $Room->getHoteladresse(),
                'roomtype' => $Room->getRoomtype(),
                'price' => $Room->getPrice(),
                'photo' => $Room->getPhoto(),
                'qty' => $Room->getQty(),
                'idroom' => $idroom
            ]);
            echo $query->rowCount() . " room UPDATED successfully";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

   public function getRoomsById($idroom)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'SELECT * FROM rooms WHERE idroom = :idroom'
            );
            $query->execute([
                'idroom' => $idroom
            ]);
            return $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }

    }
     ////////////////
function trierrooms($tri){
            switch ($tri) {
                case 0:
                    $sql="SELECT * FROM rooms";
                       break;
                case 1:
                    $sql="SELECT * FROM rooms ORDER BY price ASC ";
                  break;
                case 2:
                    $sql="SELECT * FROM rooms ORDER BY roomtype ASC";
                       break ;
                case 3:
                    $sql="SELECT * FROM rooms ORDER BY price DESC";
                  break;
                case 4:
                    $sql="SELECT * FROM rooms ORDER BY roomtype DESC";
                       break ;
                case 5:
                    $sql="SELECT * FROM rooms ORDER BY qty ASC";
                  break;
                case 6:
                    $sql="SELECT * FROM rooms ORDER BY qty DESC";
                       break ;
            
                  }
        
                $db = config::getConnexion();
                try{
                    $liste = $db->query($sql);
                    return $liste;
                }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }   
        
            }
            function searchrooms2($search){
            
                $sql="SELECT * FROM rooms WHERE roomtype LIKE  '%$search%' OR idroom LIKE '%$search%' OR qty LIKE '%$search%' OR price LIKE '%$search%' OR qty LIKE '%$search%' ";
                $db = config::getConnexion();
                try{
                    $liste = $db->query($sql);
                    return $liste;
                }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }   
            }
}

    ?>