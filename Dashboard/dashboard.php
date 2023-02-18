<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include database configuration
require_once "config.php";

// Define variables and initialize with empty values
$savings_balance = $loan_balance = $total_members = "";
$savings_balance_err = $loan_balance_err = $total_members_err = "";

// Prepare SQL statement to retrieve savings balance from database
$sql = "SELECT SUM(amount) AS savings_balance FROM savings";
if($stmt = $mysqli->prepare($sql)){
    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $savings_balance = $row["savings_balance"];
        } else {
            $savings_balance_err = "Unable to retrieve savings balance.";
        }
    } else {
        $savings_balance_err = "Unable to execute SQL statement.";
    }
    $stmt->close();
}

// Prepare SQL statement to retrieve loan balance from database
$sql = "SELECT SUM(amount) AS loan_balance FROM loans";
if($stmt = $mysqli->prepare($sql)){
    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $loan_balance = $row["loan_balance"];
        } else {
            $loan_balance_err = "Unable to retrieve loan balance.";
        }
    } else {
        $loan_balance_err = "Unable to execute SQL statement.";
    }
    $stmt->close();
}

// Prepare SQL statement to retrieve total number of members from database
$sql = "SELECT COUNT(*) AS total_members FROM members";
if($stmt = $mysqli->prepare($sql)){
    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $total_members = $row["total_members"];
        } else {
            $total_members_err = "Unable to retrieve total number of members.";
        }
    } else {
        $total_members_err = "Unable to execute SQL statement.";
    }
    $stmt->close();
}

// Close database connection
$mysqli->close();
?>

