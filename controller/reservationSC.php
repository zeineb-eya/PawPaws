<?php

//include "../config.php";
include "../config.php";

class reservationC{

    public function ajouterReservation($Reservation, $qty, $idservice, $user)
    {
        echo('hhh');
        $db = config::getConnexion();
        $sql = "INSERT INTO reservations (idreservation,adresse,tel,email,nbn,date,rp,idservice,iduser)
			VALUES (:idreservation,:adresse,:tel,:email,:nbn,:date,:rp,:idservice,:iduser)";


        $sql1 = " UPDATE services SET qty = :qty - 1 where idservice= :idservice";


        try {
            $query = $db->prepare($sql);
            $query1 = $db->prepare($sql1);
            $query1->execute([
                'qty' => $qty,
                'idservice' => $idservice
            ]);
            $query->execute([

                /*nom de colonne*/ 'idreservation' => $Reservation->getIdreservation(),
                
                'adresse' => $Reservation->getAdresse(),
                'tel' => $Reservation->getTel(),
                'email' => $Reservation->getEmail(),
                'date' => $Reservation->getDate(),

                'nbn' => $Reservation->getNbn(),
                
                'rp' => $Reservation->getRp(),
                'idservice' => $Reservation->getIdservice(),

                'iduser' => $user


            ]);
            
            print "Your reservation was saved successfuly!";
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function afficherReservation()
    {

        $sql = "SELECT * FROM reservations ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);

            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    function afficherReservation10($idreservation)
    {

        $sql = "SELECT * FROM reservations LEFT JOIN utilisateur ON utilisateur.id=reservations.iduser LEFT JOIN services ON services.idservice=reservations.idservice WHERE idreservation = :idreservation  ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);

            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function supprimerReservation($idreservation, $idservice)
    {
        $sql = "DELETE FROM reservations WHERE idreservation= :idreservation";
        $sql1 = " UPDATE services SET qty = qty + 1 where idservice= :idservice";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req1 = $db->prepare($sql1);
        $req->bindValue(':idreservation', $idreservation);
        $req1->bindValue(':idservice', $idservice);
        try {
            $req->execute();
            $req1->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function updateReservation($Reservation, $idreservation)
    {
        try {
            echo('hhhh');
            $db = config::getConnexion();
            $query = $db->prepare(
                "UPDATE reservations SET idreservation=:idreservation, adresse=:adresse,tel=:tel,email=:email,nbn:=nbn,date=:date,rp=:rp ,idservice=:idservice,iduser=:iduser WHERE idreservation = :idreservation"
            );
            echo "pass";
            echo
                
                 $Reservation->getAdresse() . " "
                . $Reservation->getTel() . " "
                . $Reservation->getEmail() . " "
                . $Reservation->getNbn() . " "
                . $Reservation->getDate() . " "
                . $Reservation->getRp() . " "
                . $Reservation->getIdservice() . " "
                . $idreservation,
            $query->execute([

                
                'adresse' => $Reservation->getAdresse(),
                'tel' => $Reservation->getTel(),
                'email' => $Reservation->getEmail(),
                'nbn' => $Reservation->getNbn(),
                'date' => $Reservation->getDate(),
                'rp' => $Reservation->getRp(),
                'idservice' => $Reservation->getIdservice(),
                'iduser' => $Reservation->getIduser(),
                'idreservation' => $_GET["idreservation"]
            ]);
            echo "pass";
            echo $query->rowCount() . " reservation UPDATED successfully";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getReservationByFirstname($user) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'SELECT * FROM reservations LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser WHERE Prenom= :Prenom'
            );
            $query->execute([
                'Prenom' => $user
            ]);
            return $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    /*public function getReservationById($idreservation)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser LEFT JOIN services ON services.idservice=reservation.idservice WHERE idreservation = :idreservation'
            );
            $query->execute([
                'idreservation' => $idreservation
            ]);
            return $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }


    }*/
    public function getReservationById($idreservation)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'SELECT * FROM reservations WHERE idreservation = :idreservation'
            );
            $query->execute([
                'idreservation' => $idreservation
            ]);
            return $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }


    }


    public function afficherActivites($tri)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'SELECT * FROM reservations LEFT JOIN utilisateur ON utilisateur.id=reservations.iduser LEFT JOIN services ON services.idservice=reservations.idservice '
            );
            if (isset($tri)) {
                if ($tri == "DA") {
                    $query = $db->prepare(
                        'SELECT * FROM reservations LEFT JOIN utilisateur ON utilisateur.id=reservations.iduser LEFT JOIN services ON services.idservice=reservations.idservice ORDER BY date  ASC'
                    );
                }

                if ($tri == "DS") {
                    $query = $db->prepare(
                        'SELECT * FROM reservations LEFT JOIN utilisateur ON utilisateur.id=reservations.iduser LEFT JOIN services ON services.idservice=reservations.idservice ORDER BY date  DESC '
                    );
                }
                if ($tri == "ZA") {
                    $query = $db->prepare(
                        'SELECT * FROM reservations LEFT JOIN utilisateur ON utilisateur.id=reservations.iduser LEFT JOIN services ON services.idservice=reservations.idservice ORDER BY Nom  DESC '
                    );
                }
                if ($tri == "P") {
                    $query = $db->prepare(
                        'SELECT * FROM reservations LEFT JOIN utilisateur ON utilisateur.id=reservations.iduser LEFT JOIN services ON services.idservice=reservations.idservice ORDER BY Nom  ASC '
                    );
                }
            }

            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function sendmail($reservation)
    {
        $headers = "From: pawp6703@gmail.com\r\n";
        $to = $reservation->email;
        $subject = "confirmation de reservation";
        $message = "Bonjour Mr/Mme " . $reservation->user . " je vous confirme qu'on a bien reçu votre reservation pour le service le " . $reservation->date . " pour " . $reservation->nbn . " nuits. SOYEZ LA BIENVENUE";
        if (mail($to, $subject, $message, $headers))
            echo 'Success!';
        else
            echo 'UNSUCCESSFUL...';

    }



}
class serviceC
{
    function addservice($service)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'INSERT INTO services (idservice, servicetype, price,photo,qty) 
                VALUES (:idservice, :servicetype, :price,:photo,:qty)'
            );
            $query->execute([
                'idservice' => $service->getIdservice(),
                'servicetype' => $service->getservicetype(),
                'price' => $service->getPrice(),
                'photo' => $service->getPhoto(),
                'qty' => $service->getQty(),
            ]);
            echo "Posted Successfully";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}


function afficherservices($search)
{  $db = config::getConnexion();


    $sql="SELECT idservice, servicetype, price, photo,qty FROM services ORDER BY price DESC";
    $result = $db->query($sql);

    if (!isset($search) || $search===""){ ?>  <div class="row"> <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {

            ?>

            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h3 class="card-header" style="color: #23234A"><?php echo $row["servicetype"];?></h3>
                    <div class="card-body">
                        <div class="display-4" style="color: #23234A"><?php echo $row["price"];?>&nbsp;$</div>


                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
<div class="geeks">
                        <img class="card-img-top" src= <?php echo "img/".$row["photo"]." width="."750"." height="."300";?> >
</div>
    <li class="list-group-item">
                            <form method="GET" action="index1.php">

                                <input class="form-control" type="hidden"  name="idservice"  value="<?= $row["idservice"] ?>"/>
                                <input class="form-control" type="hidden"  name="qty"  value="<?= $row["qty"] ?>"/>
                                <button type="button" class="btn" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    &nbsp;  More details
                                </button>

                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    <?php echo $row["servicetype"];?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                Whether it’s a pamper day, playdate, sleepover, training class or veterinary visit, we provide the best in pet services with highly trained, passionate associates. From our pet hotel & doggie day camp as an alternative to pet sitting, to our dog training and grooming as an alternative to DIY, our services are conveniently located inside most of our PawPaws stores.
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                          <?php if($row["qty"]  > 0){  ?>
                                <button href="index1.php?idservice=<?php echo $row["idservice"]?> " name="submit" type="submit" class="btn"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    &nbsp; Book Now</button>

                                          <?php }  ?>
                                <?php if($row["qty"]  == 0){  ?>

                                    <button href="index1.php" name="submit" type="submit" onclick="disabled=true;" class="btn disabled " ><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                        &nbsp;Book Now </button>


                                    <p> Sorry, Not available For the Time being!</p>                                <?php }  ?>

                                    
                            </form>
                        </li>
                    </ul>
                </div>
            </div>



            <?php
        }
        ?> </div> <?php
    }
    if ($result->rowCount() ==0)
        echo "no result";















}

function afficherservices1($search)
{  $db = config::getConnexion();


    $sql="SELECT * FROM services WHERE idservice=$_GET[idservice]";
    $result = $db->query($sql);

    if (!isset($search) || $search===""){ ?>  <div class="row"> <?php
    ($row = $result->fetch(PDO::FETCH_ASSOC))


        ?>
        <div class="image-holder">
            <img src= <?php echo "./img/".$row["photo"]." width="."1000"." height="."400";;?>>

            <h3><?php echo $row["servicetype"];?></h3>
        </div>









        <?php
    }
    ?> </div> <?php
}

