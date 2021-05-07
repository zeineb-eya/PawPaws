<?php
include "../config.php";
class serviceC1
{
    function affiche()
    {


        $sql = "SELECT * FROM services ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);

            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function deleteservice($idservice) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'DELETE FROM services WHERE idservice= :idservice'
            );
            $query->execute([
                'idservice' => $idservice
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function updateservice($service, $idservice)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE services SET servicetype=:servicetype, price=:price,photo=:photo,qty=:qty WHERE idservice = :idservice'
            );
            $query->execute([
                'servicetype' => $service->getservicetype(),
                'price' => $service->getPrice(),
                'photo' => $service->getPhoto(),
                'qty' => $service->getQty(),
                'idservice' => $idservice
            ]);
            echo $query->rowCount() . " service UPDATED successfully";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function getservicesById($idservice)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'SELECT * FROM services WHERE idservice = :idservice'
            );
            $query->execute([
                'idservice' => $idservice
            ]);
            return $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }

    }

    ////////////////
function trierservice($tri){
            switch ($tri) {
                case 0:
                    $sql="SELECT * FROM services";
                       break;
                case 1:
                    $sql="SELECT * FROM services ORDER BY price ASC ";
                  break;
                case 2:
                    $sql="SELECT * FROM services ORDER BY servicetype ASC";
                       break ;
                case 3:
                    $sql="SELECT * FROM services ORDER BY price DESC";
                  break;
                case 4:
                    $sql="SELECT * FROM services ORDER BY servicetype DESC";
                       break ;
                case 5:
                    $sql="SELECT * FROM services ORDER BY qty ASC";
                  break;
                case 6:
                    $sql="SELECT * FROM services ORDER BY qty DESC";
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
            function searchservice2($search){
            
                $sql="SELECT * FROM services WHERE servicetype LIKE  '%$search%' OR idservice LIKE '%$search%' OR qty LIKE '%$search%' OR price LIKE '%$search%' OR qty LIKE '%$search%' ";
                $db = config::getConnexion();
                try{
                    $liste = $db->query($sql);
                    return $liste;
                }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }   
            }
            ////////////////////
///////////////////////like services///////////////////////////
/*function is_user_has_already_like_content($connec, $id, $idservice)
{
 $query = "
 SELECT * FROM user_content_like 
 WHERE $idservice = :idservice
 AND id = :id
 ";
 $statement = $connec->prepare($query);

 $statement->execute(
  array(
   ':idservice' =>  $idservice,
   ':id'  =>  $id
  )
 );
 $total_rows = $statement->rowCount();
 if($total_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }

}

function count_content_like($connec, $idservice)
{
 $query = "
 SELECT * FROM user_content_like 
 WHERE $idservice = :content_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':idservice'  => $idservice
  )
 );
 $total_rows = $statement->rowCount();
 return $total_rows;
}*/

}