<?php
session_start();
if (isset($_SESSION["e"])&& isset($_SESSION["role"]))
{
  if ($_SESSION["role"]=="admin" || $_SESSION["role"]=="ServiceProvider" )
  {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Service</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets3/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="../assets3/css/style.css" rel="stylesheet">
    <link href="../assets3/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="acceuil.php" class="logo"><b>Paw Paws</b></a>
            <!--logo end-->
             <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../disconnect.php">Logout</a></li>
              </ul>
            </div>
                                
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="../assets3/img/<?php echo $_SESSION["Picture"];?>" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION["Nom"]." ".$_SESSION["Prenom"]; ?></h5>
                  <h6 class="centered"><?php echo $_SESSION["role"]?></h6>
              	  	
                  <li class="mt">
                      <a href="DashboardAdmin.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                 
                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-book"></i>
                          <span>Rooms</span>
                      </a>
                       <ul class="sub">
                          <li ><a  href="Reservation_Gestion.php">Gérer Les Reservations</a></li>
                          <li class="active"><a  href="Ajouter_Room.php">Ajouter Une Chambre</a></li>
                          <li><a  href="Room_Gestion.php">Gérer Les Chambres</a></li>
                          <li><a  href="sendemail">Send Email</a></li>
                          <li><a  href="create-dynamic-pdf-send-as-attachment-with-email-in-php-demo">Reservation Details</a></li>
                      </ul>
                  </li>
                                    <li class="sub-menu">
                      <a href="javascript:;"  class="active">
                          <i class="fa fa-book"></i>
                          <span>Services</span>
                      </a>
                      <ul class="sub">
                          <li ><a  href="ReservationS_Gestion.php">Gérer Les Reservations</a></li>
                          <li class="active"><a  href="Ajouter_Service.php">Ajouter Un Service</a></li>
                          <li><a  href="Services_Gestion.php">Gérer Les Services</a></li>
                          <li><a  href="sendemail">Send Email</a></li>
                          <li><a  href="create-dynamic-pdf-send">Rendez-vous Details</a></li>
                      </ul>
                  </li>
                   

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<?php include_once 'addservice.php'; ?>
          		</div>
          	</div>
			
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets3/js/jquery.js"></script>
    <script src="../assets3/js/bootstrap.min.js"></script>
    <script src="../assets3/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../assets3/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="../assets3/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets3/js/jquery.scrollTo.min.js"></script>
    <script src="../assets3/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../assets3/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
<?php }
else echo "Access denied to non admins";
}
else   echo("<script>location.href = 'signin.php';</script>");
?>