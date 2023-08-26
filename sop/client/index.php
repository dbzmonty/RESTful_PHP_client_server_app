<?php require("./includes/header.php"); ?>

<!--Start Container-->
<div class="container">
    <div class="col-8 mx-auto"> 
        <div class="card">
            <div class="card-body">
                <table>
                    <tr>
                        <th width="60">Id:</th>
                        <th width="200">Created:</th>
                        <th width="300">Name:</th>
                        <th width="100">Gender:</th>
                        <th width="100">Salary:</th>
                        </tr>
        
                    <?php
                        require("./includes/messages.php");
                        require("./includes/common.php");
                        
                        $curl = curl_init($serverAddress);
                        curl_setopt($curl, CURLOPT_URL, $serverAddress);
                        curl_setopt($curl, CURLOPT_HEADER, false);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                        $response = curl_exec($curl);
                        curl_close($curl);
                        $data = json_decode($response);
                    
                        if (count($data)) {
                            
                            foreach ($data as $employee)
                            {
                                echo "<tr>";
                                echo "<td>$employee->id</td>";
                                echo "<td>$employee->created</td>";                                
                                echo "<td><a href='details.php?id={$employee->id}'>{$employee->employeeName}</a></td>";                                
                                echo "<td>$employee->employeeGender</td>";
                                echo "<td>$employee->employeeSalary</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!--End Container-->

</body>

<?php require("./includes/footer.php"); ?>

</html>
