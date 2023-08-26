<?php

include("./connection.php");
$db = new dbObj();
$connection = $db->getConnString();
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method)
{
    case 'GET':
        if (!empty($_GET["id"]))
        {
            $id = intval($_GET["id"]);
            // Employee with ID
            getEmployee($id);
        }
        else
        {
            // All employees
            getEmployees();
        }
        break;

    case 'POST':
        // Add new employee
        addEmployee();
        break;

    case 'PUT':
        // Update an employee
        $id = intval($_GET["id"]);
        updateEmployee($id);
        break;

    case 'DELETE':
        // Delete an employee
        $id = intval($_GET["id"]);
        deleteEmployee($id);
        break;

    default:
        // Invalid request method
        header("HTTP/1.1 405 Method Not Allowed");
        break;
}

function getEmployee($id = 0)
{
    global $connection;
    $query = "SELECT * FROM employees";
    if ($id != 0)
    {
        $query.=" WHERE id =".$id." LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result))
    {
        $response[] = $row;
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function getEmployees()
{
    global $connection;
    $query = "SELECT * FROM employees";
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result))
    {
        $response[] = $row;
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function addEmployee()
{
    global $connection;
    $data = json_decode(file_get_contents('php://input'), true);
    $employeeName = $data["employeeName"];
    $employeeGender = $data["employeeGender"];
    $employeeSalary = $data["employeeSalary"];
    $query = "INSERT INTO employees SET employeeName = '".$employeeName."', employeeGender = '".$employeeGender."', employeeSalary = '".$employeeSalary."'";

    if (mysqli_query($connection, $query))
    {
        $response = array('status' => 1, 'status_message' => 'Employee Added Successfully');
    }
    else
    {
        $response = array('status' => 0, 'status_message' => 'Employee Addition Failed');
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function updateEmployee($id)
{
    global $connection;
    $data = json_decode(file_get_contents('php://input'), true);
    $employeeName = $data["employeeName"];
    $employeeGender = $data["employeeGender"];
    $employeeSalary = $data["employeeSalary"];
    $query = "UPDATE employees SET employeeName = '".$employeeName."', employeeGender = '".$employeeGender."', employeeSalary = '".$employeeSalary."' WHERE id =".$id;

    if (mysqli_query($connection, $query))
    {
        $response = array('status' => 1, 'status_message' => 'Employee Added Successfully');
    }
    else
    {
        $response = array('status' => 0, 'status_message' => 'Employee Addition Failed');
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function deleteEmployee($id)
{
    global $connection;
    $query = "DELETE FROM employees WHERE id = ".$id;

    if (mysqli_query($connection, $query))
    {
        $response = array('status' => 1, 'status_message' => 'Employee Deleted Successfully');
    }
    else
    {
        $response = array('status' => 0, 'status_message' => 'Employee Deletion Failed');
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

?>
