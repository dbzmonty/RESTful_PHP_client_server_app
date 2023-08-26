<?php
    require("./includes/header.php");

    if (isset($_POST["submit"]))
    {        
        $employeeName = $_POST['employeeName'];
        $employeeGender = $_POST['employeeGender'];
        $employeeSalary = $_POST['employeeSalary'];
        
        $rawData = array("employeeName"=>$employeeName, "employeeGender"=>$employeeGender, "employeeSalary"=>$employeeSalary);
        $data = json_encode($rawData);

        require("./includes/common.php");

        $curl = curl_init($serverAddress);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);
        
        $res = json_decode($result, true);
        
        if ($res["status"] == "1")
            header("location:index.php?empaddsucc=true");
        else
            header("location:index.php?empaddfail=true");
    }
?>

<!--Start Container-->
<div class="container">
    <div class="col-6 mx-auto">
        <div class="card">
            <h4 class="card-header">Add Employee</h4>
                <div class="card-body">
                    <form action="add.php" method="POST">                                
                        <label for="employeeName" class="form-label">Name:</label>
                        <input type="text" id="employeeName" name="employeeName" class="form-control" placeholder="Name" maxlength="255" required>
                        <br />
                        <label for="employeeGender" class="form-label">Gender:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="employeeGender" value="male" id="employeeGender1" checked>
                            <label class="form-check-label" for="employeeGender1">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="employeeGender" value="female" id="employeeGender2">
                            <label class="form-check-label" for="employeeGender2">Female</label>
                        </div>
                        <br />
                        <label for="employeeSalary" class="form-label">Salary:</label>
                        <input type="number" id="employeeSalary" name="employeeSalary" class="form-control" placeholder="Salary" min="0" max="999999" required>
                        <br />                                
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add Employee</button>
                    </form>
                </div>                    
        </div>
    </div>
</div>
<!--End Container-->

</body>

<?php require("./includes/footer.php"); ?>

</html>
