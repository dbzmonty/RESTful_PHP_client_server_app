<?php
    require("./includes/header.php");

    if (isset($_GET["id"]))
    {        
        require("./includes/common.php");
        $id = $_GET["id"];
        $empLink = $serverAddress."?id=".$id;
        
        $curl = curl_init($empLink);
        curl_setopt($curl, CURLOPT_URL, $empLink);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
    }
    else
    {
        header("location:index.php?empnotexists=true");
    }
?>

<!--Start Container-->
<div class="container">
    <div class="col-6 mx-auto">
        <div class="card">
            <h4 class="card-header">Employee details</h4>
                <div class="card-body">                                                    
                    <label for="employeeName" class="form-label">Name:</label>
                    <input type="text" id="employeeName" name="employeeName" class="form-control" value="<?php echo reset($data)->employeeName ?>" disabled>
                    <br />
                    <label for="employeeGender" class="form-label">Gender:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="employeeGender" value="male" id="employeeGender1" <?php if (reset($data)->employeeGender == 'male') echo 'checked' ?> disabled>
                        <label class="form-check-label" for="employeeGender1">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="employeeGender" value="female" id="employeeGender2" <?php if (reset($data)->employeeGender == 'female') echo 'checked' ?> disabled>
                        <label class="form-check-label" for="employeeGender2">Female</label>
                    </div>
                    <br />
                    <label for="employeeSalary" class="form-label">Salary:</label>
                    <input type="number" id="employeeSalary" name="employeeSalary" class="form-control" value="<?php echo reset($data)->employeeSalary ?>" disabled>
                    <br />                                
                    <div class="row">
                        <div class="col-md-6"> 
                            <form action="edit.php" method="POST">
                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Edit</button>
                                <input type="hidden" name="id" value="<?php echo reset($data)->id ?>" />
                                <input type="hidden" name="edit" value="false" />
                            </form>
                        </div>
                        <div class="col-md-6"> 
                            <form action="delete.php" method="POST">
                                <button class="btn btn-lg btn-danger btn-block" type="submit" name="submit">Delete</button>
                                <input type="hidden" name="id" value="<?php echo reset($data)->id ?>" />
                            </form>
                        </div>
                    </div>
                </div>                    
        </div>
    </div>
</div>
<!--End Container-->

</body>

<?php require("./includes/footer.php"); ?>

</html>
