<?php
    require("./includes/header.php");

    if (isset($_POST["submit"]) && isset($_POST["id"]))
    {    
        require("./includes/common.php");
        $id = $_POST["id"];
        $empLink = $serverAddress."?id=".$id;
        
        if (isset($_POST["edit"]) && $_POST["edit"] == "false")
        {    
            $curl = curl_init($empLink);
            curl_setopt($curl, CURLOPT_URL, $empLink);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response);
        }
        else if (isset($_POST["edit"]) && $_POST["edit"] == "true")
        {
            $employeeName = $_POST['employeeName'];
            $employeeGender = $_POST['employeeGender'];
            $employeeSalary = $_POST['employeeSalary'];
            
            $rawData = array("employeeName"=>$employeeName, "employeeGender"=>$employeeGender, "employeeSalary"=>$employeeSalary);
            $data = json_encode($rawData);
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $empLink);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($data)));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curl);
            curl_close($curl);

            $res = json_decode($result, true);

            if ($res["status"] == "1")
                header("location:index.php?empeditsucc=true");
            else
                header("location:index.php?empeditfail=true");
        }
    }
    else
    {
        //header("location:index.php?empnotexists=true");
        echo "nincs submit és id";
    }
?>

<!--Start Container-->
<div class="container">
    <div class="col-6 mx-auto">
        <div class="card">
            <h4 class="card-header">Employee details</h4>
                <div class="card-body">                                                    
                    <form action="edit.php" method="POST">    
                        <label for="employeeName" class="form-label">Name:</label>
                        <input type="text" id="employeeName" name="employeeName" class="form-control" value="<?php echo reset($data)->employeeName ?>">
                        <br />
                        <label for="employeeGender" class="form-label">Gender:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="employeeGender" value="male" id="employeeGender1" <?php if (reset($data)->employeeGender == 'male') echo 'checked' ?>>
                            <label class="form-check-label" for="employeeGender1">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="employeeGender" value="female" id="employeeGender2" <?php if (reset($data)->employeeGender == 'female') echo 'checked' ?>>
                            <label class="form-check-label" for="employeeGender2">Female</label>
                        </div>
                        <br />
                        <label for="employeeSalary" class="form-label">Salary:</label>
                        <input type="number" id="employeeSalary" name="employeeSalary" class="form-control" value="<?php echo reset($data)->employeeSalary ?>">
                        <br />                                
                        <input type="hidden" name="id" value="<?php echo reset($data)->id ?>" />
                        <input type="hidden" name="edit" value="true" />
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Save</button>
                    </form>
                </div>                    
        </div>
    </div>
</div>
<!--End Container-->

</body>

<?php require("./includes/footer.php"); ?>

</html>
