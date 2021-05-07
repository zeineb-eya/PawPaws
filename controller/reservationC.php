<?php

include "../config.php";



class reservationsC{

    public function ajouterReservation($Reservationh, $qty, $idroom, $user)
    {
        echo('hhh');
        $db = config::getConnexion();
        $sql = "INSERT INTO reservation ( idreservation,firstname, lastname, adresse,tel,email,nbn,date,room,rp,idroom,iduser)
            VALUES (:idreservation,:firstname,:lastname,:adresse,:tel,:email,:nbn,:date,:room,:rp,:idroom,:iduser)";


        $sql1 = " UPDATE rooms SET qty = :qty - 1 where idroom= :idroom";


        try {
            $query = $db->prepare($sql);
            $query1 = $db->prepare($sql1);
            $query1->execute([
                'qty' => $qty,
                'idroom' => $idroom
            ]);
            $query->execute([

                /*nom de colonne*/ 'idreservation' => $Reservationh->getIdreservation(),
                'firstname' => $Reservationh->getFirstname(),
                'lastname' => $Reservationh->getLastname(),
                'adresse' => $Reservationh->getAdresse(),
                'tel' => $Reservationh->getTel(),
                'email' => $Reservationh->getEmail(),
                'date' => $Reservationh->getDate(),

                'nbn' => $Reservationh->getNbn(),
                'room' => $Reservationh->getRoom(),
                'rp' => $Reservationh->getRp(),
                'idroom' => $Reservationh->getIdroom(),

                'iduser' => $user


            ]);
             echo "Votre reservation est validée";
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function afficherReservation()
    {

        $sql = "SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser LEFT JOIN rooms ON rooms.idroom=reservation.idroom ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);

            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function supprimerReservation($idreservation, $idroom)
    {
        $sql = "DELETE FROM reservation WHERE idreservation= :idreservation";
        $sql1 = " UPDATE rooms SET qty = qty + 1 where idroom= :idroom";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req1 = $db->prepare($sql1);
        $req->bindValue(':idreservation', $idreservation);
        $req1->bindValue(':idroom', $idroom);
        try {
            $req->execute();
            $req1->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function updateReservation($Reservationh, $idreservation)
    {
        try {
            echo('hhhh');
            $db = config::getConnexion();
            $query = $db->prepare(
                "UPDATE reservation SET idreservation=:idreservation, firstname=:firstname, lastname=:lastname, adresse=:adresse,tel=:tel,email=:email,nbn:=nbn,date=:date,room=:room,rp=:rp ,idroom=:idroom,iduser=:iduser WHERE idreservation = :idreservation"
            );
            echo "pass";
            echo
                $Reservationh->getFirstname() . " "
                . $Reservationh->getLastname() . " "
                . $Reservationh->getAdresse() . " "
                . $Reservationh->getTel() . " "
                . $Reservationh->getEmail() . " "
                . $Reservationh->getNbn() . " "
                . $Reservationh->getDate() . " "
                . $Reservationh->getRoom() . " "
                . $Reservationh->getRp() . " "
                . $Reservationh->getIdroom() . " "
                . $idreservation,
            $query->execute([

                'firstname' => $Reservationh->getFirstname(),
                'lastname' => $Reservationh->getLastname(),
                'adresse' => $Reservationh->getAdresse(),
                'tel' => $Reservationh->getTel(),
                'email' => $Reservationh->getEmail(),
                'nbn' => $Reservationh->getNbn(),
                'date' => $Reservationh->getDate(),
                'room' => $Reservationh->getRoom(),
                'rp' => $Reservationh->getRp(),
                'idroom' => $Reservationh->getIdroom(),
                'iduser' => $Reservationh->getIduser(),
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
                'SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser WHERE Prenom= :Prenom'
            );
            $query->execute([
                'Prenom' => $user
            ]);
            return $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function getReservationById($idreservation)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'SELECT * FROM reservation WHERE idreservation = :idreservation'
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
                'SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser LEFT JOIN rooms ON rooms.idroom=reservation.idroom '
            );
            if (isset($tri)) {
                if ($tri == "DA") {
                    $query = $db->prepare(
                        'SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser LEFT JOIN rooms ON rooms.idroom=reservation.idroom ORDER BY date  ASC'
                    );
                }

                if ($tri == "DS") {
                    $query = $db->prepare(
                        'SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser LEFT JOIN rooms ON rooms.idroom=reservation.idroom ORDER BY date  DESC '
                    );
                }
                if ($tri == "ZA") {
                    $query = $db->prepare(
                        'SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser LEFT JOIN rooms ON rooms.idroom=reservation.idroom ORDER BY Nom  DESC '
                    );
                }
                if ($tri == "P") {
                    $query = $db->prepare(
                        'SELECT * FROM reservation LEFT JOIN utilisateur ON utilisateur.id=reservation.iduser LEFT JOIN rooms ON rooms.idroom=reservation.idroom ORDER BY Nom  ASC '
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
        $headers = "From: hotelfarcha5etoile@gmail.com\r\n";
        $to = $reservation->email;
        $subject = "confirmation de reservation";
        $message = "Bonjour Mr/Mme " . $reservation->firstname . " je vous confirme qu'on a bien reçu votre reservation pour la chambre le " . $reservation->date . " pour " . $reservation->nbn . " nuits. SOYEZ LA BIENVENUE";
        if (mail($to, $subject, $message, $headers))
            echo 'Success!';
        else
            echo 'UNSUCCESSFUL...';

    }



}
class roomC
{
    function addRoom($Room)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'INSERT INTO rooms (idroom, hoteladresse, roomtype, price,photo,qty) 
                VALUES (:idroom, :hoteladresse, :roomtype, :price,:photo,:qty)'
            );
            $query->execute([
                'idroom' => $Room->getIdroom(),
                'hoteladresse' => $Room->getHoteladresse(),
                'roomtype' => $Room->getRoomtype(),
                'price' => $Room->getPrice(),
                'photo' => $Room->getPhoto(),
                'qty' => $Room->getQty(),
            ]);
            echo "Posted Successfully";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}

function afficherrooms($search)
{  $db = config::getConnexion();


    $sql="SELECT idroom, hoteladresse, roomtype, price, photo,qty FROM rooms ORDER BY price DESC";
    $result = $db->query($sql);

    if (!isset($search) || $search===""){ ?>  <div class="row"> <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {

            ?>

            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h3 class="card-header" style="color: #23234A"><?php echo $row["roomtype"];?></h3>
                    <div class="card-body">
                        <div class="display-4" style="color: #23234A"><?php echo $row["price"];?>&nbsp;$</div>


                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
<div class="geeks">
                        <img class="card-img-top" src= <?php echo "img/".$row["photo"]." width="."750"." height="."300";?> >
</div>
    <li class="list-group-item">
                            <form method="GET" action="index2.php">

                                <input class="form-control" type="hidden"  name="idroom"  value="<?= $row["idroom"] ?>"/>
                                <input class="form-control" type="hidden"  name="hoteladresse"  value="<?= $row["hoteladresse"] ?>"/>
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
                                                    <?php echo $row["roomtype"];?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                When you leave your pet somewhere overnight, you want to be sure they’re well taken care of.pawpaws Resorts Luxury Pet Hotel are award-winning, internationally recognized pet care resorts that will make your pup feel right at home. All our trained and certified staff members are true animal lovers and will care for your pet as if they were our own.
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
                                <button href="index2.php?idroom=<?php echo $row["idroom"]?> " name="submit" type="submit" class="btn"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    &nbsp; Book Now</button>

                                          <?php }  ?>
                                <?php if($row["qty"]  == 0){  ?>

                                    <button href="index2.php" name="submit" type="submit" onclick="disabled=true;" class="btn disabled " ><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
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

function afficherrooms1($search)
{  $db = config::getConnexion();


    $sql="SELECT * FROM rooms WHERE idroom=$_GET[idroom]";
    $result = $db->query($sql);

    if (!isset($search) || $search===""){ ?>  <div class="row"> <?php
    ($row = $result->fetch(PDO::FETCH_ASSOC))


        ?>
        <div class="image-holder">
            <img src= <?php echo "./img/".$row["photo"]." width="."1000"." height="."400";;?>>

            <h3><?php echo $row["roomtype"];?></h3>
        </div>









        <?php
    }
    ?> </div> <?php
}