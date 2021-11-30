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
                                    <h3>User Dashboard</h3>
                                    
                                </div>
                                <div class="module-body">
                                    <p>Here you can find all your file, just click on the button to download them.</p>
                                    <hr>

                                    <table class="table">
                                        <thead>
                                            <th>File Title</th>
                                            <th>File Name</th>
                                            <th>Download</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Title</td>
                                                <td>Name</td>
                                                <td>  
                                                    <a href="#">
                                                        <button type="button" class="btn btn-success btn-sm">Download</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

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