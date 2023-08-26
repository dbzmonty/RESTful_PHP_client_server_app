<?php

class dbObj
{
    private $serverName = "localhost";
    private $username = "dbz";
    private $password = "root";
    private $database = "sop";

    function getConnString()
    {
        $con = mysqli_connect($this->serverName, $this->username, $this->password, $this->database)
            or die("Connection failed: ".mysqli_connect_error());

        if (mysqli_connect_errno())
        {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        else
        {
            mysqli_set_charset($con, "utf8");
            return $con;
        }
    }
}

?>