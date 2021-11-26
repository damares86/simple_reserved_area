	<?php
	// We need to use sessions, so you should always start sessions using the below code.
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: ../index.php');
		exit;
	}

	


	require "core/functions.php";
	//require "core/array.php";
	$conn = OpenConnection();
	

	$user=$_SESSION['name'];

	if($user=="admin"){
		header("Location: admin/");
	} else {
	?>
<?php

require "inc/header.php";




$manage=filter_input(INPUT_GET,"man");
$operation=filter_input(INPUT_GET,"op");

// $customersCount=GetAllRows($conn,"accounts");
// $productsCount=GetAllRows($conn,"products");

?>

    <body>
        <?php

        require "inc/navbar.php";

        ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php
                        require "inc/sidebar.php";
                    ?>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                        <?php
                            

                            if($manage=="users"){
                                if($operation=="show"){
                                    require "inc/func/allUser.php";
                                } else if($operation=="add"){
                                    require "inc/func/regUser.php";
                                } else if($operation=="edit"){
                                    require "inc/func/edUser.php";
                                }
                            } else if($manage=="roles"){
                                if($operation=="show"){
                                    require "inc/func/allRole.php";
                                } else if($operation=="add"){
                                    require "inc/func/regRole.php";
                                } else if($operation=="edit"){
                                    require "inc/func/regRole.php";
                                }
                            } else if($manage=="files"){
                                if($operation=="show"){
                                    require "inc/func/allFile.php";
                                } else if($operation=="add"){
                                    require "inc/func/regFile.php";
                                } 
                            } else { 
                        ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>damares86 Admin Dashboard</h3>
                                    
                                </div>
                                <div class="module-body">
                                <?php
                                require "inc/alert.php";
                                ?>
                                    <section class="docs">
                                        <p>Benvenuto nella dashboard dell'area riservata del sito XStream.</p>
                                    </section>
                                </div>
                            </div>

                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="index.php?man=users&op=show" class="btn-box big span6"><i class="icon-user"></i><b><?= $customersCount ?></b>
                                        <p class="text-muted">
                                            Clienti</p>
                                    </a><a href="index.php?man=products&op=show" class="btn-box big span6"><i class=" icon-laptop"></i><b><?= $productsCount ?></b>
                                        <p class="text-muted">
                                            Prodotti</p>
                                    </a>
                                </div>
                                <div class="module">
                                    <div class="module-head">
                                        <h3>Collegamenti Veloci</h3>
                                        
                                    </div>
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <a href="index.php?man=users&op=add" class="btn-box small span3">
                                        <i class="icon-plus"></i><b>Aggiungi Cliente</b>
                                    </a>
                                    <a href="index.php?man=users&op=show" class="btn-box small span3">
                                        <i class="icon-group"></i><b>Modifica Cliente</b>
                                    </a>
                                    <a href="index.php?man=products&op=add" class="btn-box small span3">
                                        <i class="icon-plus"></i><b>Aggiungi Prodotto</b>
                                    </a>
                                    <a href="index.php?man=products&op=show" class="btn-box small span3">
                                        <i class="icon-laptop"></i><b>Modifica Prodotto</b>
                                    </a>                                           
                                </div>
                                   
                            </div>
                            <!--/.module-->
                            <?php 
                            }
                            ?>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
            <!-- <div class="footer">
                <div class="container">
                    <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b>All rights reserved.
                </div>
            </div> -->
        <?php
        require "inc/footer.php";
        ?>
      
    </body>
</html>
<?php
}
?>