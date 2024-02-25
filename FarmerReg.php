<?php
session_start();
include("db1.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $landArea = mysqli_real_escape_string($conn, $_POST['landArea']);
        $areaUnit = mysqli_real_escape_string($conn, $_POST['areaUnit']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $nearbyPanchayat = mysqli_real_escape_string($conn, $_POST['nearbypanchayat']);
        $panchayatPhone = mysqli_real_escape_string($conn, $_POST['panchayatph']);
        $panchayatEmail = mysqli_real_escape_string($conn, $_POST['panchayatemail']);
        $numCrops = mysqli_real_escape_string($conn, $_POST['numCrops']);

        $sql_query = "INSERT INTO farmers (name, phoneNumber, email, state, city, pincode, landArea, areaUnit, gender, nearbyPanchayat, panchayatPhone, panchayatEmail, numCrops)
                     VALUES ('$name', '$phoneNumber', '$email', '$state', '$city', '$pincode', '$landArea', '$areaUnit', '$gender', '$nearbyPanchayat', '$panchayatPhone', '$panchayatEmail', '$numCrops')";

        if (mysqli_query($conn, $sql_query)) {
            echo "New Farmer Entry inserted successfully!";
            // No need to redirect here
        } else {
            echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="css/roboto-font.css">
    <link rel="stylesheet" type="text/css" href="fonts/line-awesome/css/line-awesome.min.css">
    <!-- Jquery -->
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="style2.css"/>
    <link rel="icon" href="logo1.jpg" /> <!-- Add this line with the path to your favicon -->
</head>
<body class="form-v2">
<div class="page-content">
    <div class="form-v2-content">
        <div class="form-left">
            <img src="logo1.jpg" alt="form">
        </div>
        <div class="form-right">
            <h2>Registration Form</h2>
            <form id="farmerForm" method="post" action="signup.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <!-- Other form fields -->

                <button type="submit" name="submit">Submit</button>

            </form >
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    // jQuery Validation code here...

    $(document).ready(function() {
        // Show/hide crop name fields based on the number of crops
        $('#numCrops').on('input', function() {
            var numCrops = parseInt($(this).val());
            var cropFields = $('#cropFields');
            
            // Clear existing crop fields
            cropFields.html('');
            
            for (var i = 1; i <= numCrops; i++) {
                cropFields.append('<div class="form-group"><label for="cropName' + i + '">Crop Name ' + i + ':</label><input type="text" id="cropName' + i + '" name="cropName' + i + '" required></div>');
            }
        });
    });
</script>
</body>
</html>
