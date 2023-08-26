<?php

// Successful employee addition
if (isset($_GET["empaddsucc"]))
{		
    if ($_GET["empaddsucc"] == "true")
    {
    print '
        <p>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Employee Added Successfully!</strong>
            </div>   
        </p>';
    }
}

// Unsuccessful employee addition
if (isset($_GET["empaddfail"]))
{		
    if ($_GET["empaddfail"] == "true")
    {
    print '
        <p>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Employee Addition Failed!</strong>
            </div>   
        </p>';
    }
}

// Successful employee deletion
if (isset($_GET["empdelsucc"]))
{		
    if ($_GET["empdelsucc"] == "true")
    {
    print '
        <p>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Employee Deleted Successfully!</strong>
            </div>   
        </p>';
    }
}

// Unsuccessful employee deletion
if (isset($_GET["empdelfail"]))
{		
    if ($_GET["empdelfail"] == "true")
    {
    print '
        <p>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Employee Deletion Failed!</strong>
            </div>   
        </p>';
    }
}

// Successful employee edit
if (isset($_GET["empeditsucc"]))
{		
    if ($_GET["empeditsucc"] == "true")
    {
    print '
        <p>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Employee Edit Successfully!</strong>
            </div>   
        </p>';
    }
}

// Unsuccessful employee edit
if (isset($_GET["empeditfail"]))
{		
    if ($_GET["empeditfail"] == "true")
    {
    print '
        <p>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Employee Edit Failed!</strong>
            </div>   
        </p>';
    }
}

// Exployee not exists
if (isset($_GET["empnotexists"]))
{		
    if ($_GET["empnotexists"] == "true")
    {
    print '
        <p>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Exployee not exists!</strong>
            </div>   
        </p>';
    }
}

?>