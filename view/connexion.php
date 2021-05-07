

 <?php
 include "config.php";





 function connexion($post) {
            try {
                $pdo = getConnexion();
                $query = $pdo->prepare(
                    'INSERT INTO reservations (idreservation,adresse,tel,email,nbn,date,rp,idservice,iduser)
			VALUES (:idreservation,:adresse,:tel,:email,:nbn,:date,:rp,:idservice,:iduser)'
                );
                $query->execute([
                 'idreservation' => $post->idreservation,
                
                'adresse' => $post->adresse,
                'tel' => $post->tel,
                'email' => $post->email,
                'date' => $post->date,

                'nbn' => $post->nbn,
                
                'rp' => $post->rp,
                'idservice' => $post->idservice,

                'iduser' => $post->iduser
                ]);
                echo "Posted Successfully";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
$post=new reservation ();
//$post=new reservationC();
$post->idreservation= $_POST["idreservation"];
$post->adresse= $_POST["adresse"];
$post->tel= $_POST["tel"];
$post->email= $_POST["email"];
$post->date = $_POST["date"];
$post->nbn= $_POST["nbn"];
$post->rp= $_POST["rp"];
$post->idservice= $_POST["idservice"];
$post->iduser= $_POST["iduser"];


connexion($post);

$reservation ->sendmail($post);
?>
