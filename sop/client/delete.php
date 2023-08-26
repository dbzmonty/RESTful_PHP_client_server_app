<?php
    if (isset($_POST["submit"]) && isset($_POST["id"]))
    {   
        require("./includes/common.php");
        $id = $_POST["id"];
        $empLink = $serverAddress."?id=".$id;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $empLink);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($curl);
        curl_close($curl);    
        $res = json_decode($result, true);

        if ($res["status"] == "1")
            header("location:index.php?empdelsucc=true");
        else
            header("location:index.php?empdelfail=true");
    }
    else
    {
        header("location:index.php");
    }
?>