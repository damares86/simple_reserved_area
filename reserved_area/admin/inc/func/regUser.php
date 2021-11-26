<?php

require_once "../core/functions.php";
$conn = OpenConnection();


?> 

<div class="module">
    <div class="module-head">
        <h3>Add User</h3>
    </div>
    <div class="module-body">

        <form class="form-horizontal row-fluid" action="core/mngUser.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="operation" value="add" />

            <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" id="username" name="username" placeholder="Choose the username" class="span8">
                     
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="text" id="password" name="password" placeholder="Choose the password" class="span8">
                     
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input type="text" id="email" name="email" placeholder="sample@mail.com" class="span8">
                     
                </div>
            </div>

           
            <div class="control-group">
                <label class="control-label">Role</label>
                <div class="controls">
                <?php

                    $roles=GetAllRecords($conn,"roles");

                    foreach($roles as $row){

                    ?>      

                    <label class="radio">
                        <input type="radio" name="rolename[]" value="<?=$row["id"]?>" checked="">
                        <?=$row["rolename"]?>
                    </label> 

                   <?php

                    }

                    ?>
                   
                </div>
            </div>

          
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subReg" value="Submit">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>

    </div>
</div>
