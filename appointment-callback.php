<?php
session_start();
include_once("functions.php");

// var_dump($_SESSION["appointment"], $_SESSION["user"]);
// die();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}

if (isset($_GET["trxref"])) {
    $ref = $_GET["txref"];
    $fname = htmlspecialchars($_SESSION["appointment"]["fname"]);
    $lname = htmlspecialchars($_SESSION["appointment"]["lname"]);
    $email = htmlspecialchars($_SESSION["appointment"]["email"]);
    $phone = htmlspecialchars($_SESSION["appointment"]["phone"]);
    $service = htmlspecialchars($_SESSION["appointment"]["service"]);
    $location = htmlspecialchars($_SESSION["appointment"]["location"]);
    $date = htmlspecialchars($_SESSION["appointment"]["date"]);
    $time = htmlspecialchars($_SESSION["appointment"]["time"]);
    $price = htmlspecialchars($_SESSION["appointment"]["price"]);

    $getService = mysqli_query($conn, "SELECT * FROM `services` WHERE `id` = '$service'");
    $serv = mysqli_fetch_assoc($getService);
    $service_name = $serv["title"];

    $emailBody = '
    <!DOCTYPE html>
<html>
  <head>
    <title>Email Template</title>
    <style type="text/css">
      body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
      }
      .header {
        background-color: #02012b;
        color: white;
        padding: 10px;
        text-align: center;
        border-radius: 10px;
      }
      .content {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        margin-top: 10px;
      }
      .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #02012b;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 15px;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <h1>Appointment Booked</h1>
    </div>
    <div class="content">
      <p>Hello there,</p>
      <p>An appointment has just been booked now for - ' . $date . ", Time: $time" . '</p>
      <p>
        Appointment for <b>' . $service_name . '</b> was booked by
        <b>' . $fname . " " . $lname . '</b> with the following contact details
      </p>
      <p><b>Email:</b> ' . $email . ' & <b>Phone number:</b> ' . $phone . '</p>
      <p>To view the appointment details, please visit your dashboard</p>
      <a href="https://aestheticsbylozik.com/manager" class="button"
        >Go To Dashboard</a
      >
    </div>
  </body>
</html>

    ';

    // Check if the transaction was successful
    if (confirmTransaction($ref)) {
        // Payment was successful, proceed with appointment booking
        $query = mysqli_query($conn, "INSERT INTO `appointments` (`userid`, `fname`, `lname`, `email`, `phone`, `service_id`, `location`, `date`, `time`, `price`) VALUES ('$userid', '$fname', '$lname', '$email', '$phone', '$service', '$location', '$date', '$time', '$price')");
        if ($query) {
            sendNotification("Appointment Booked", $emailBody);
            echo "<script>location.href='booking.php'; alert('Appointment booked successfully!')</script>";
            unset($_SESSION["appointment"]);
        } else {
            echo "<script>location.href='booking.php'; alert('Appointment booking failed! contact support')</script>";
        }
    } else {
        echo "<script>location.href='booking.php'; alert('Appointment booking failed! contact support')</script>";
    }
} else {
    echo "<script>location.href='booking.php'; alert('Something went wrong!')</script>";
}
