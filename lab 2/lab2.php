<!DOCTYPE html>
<html>
<head>
  <title>Form Validation</title>
  <style>.error{color: #FF0000;}</style>
</head>
<body>
  <?php
  // Define variables
  $name = $email = $dob = $gender = $degree = $blood_group = "";

  // Define error variables
  $nameErr = $emailErr = $dobErr = $degreeErr = $bloodGroupErr = $genderErr ="";

  // Validate form data on submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name field
    if (empty($_POST["name"])) {
        $nameErr = "Name is required.";
      } else {
        $name = test_input($_POST["name"]);
      
        // Perform regex validation for name
        if (!preg_match("/^[a-zA-Z.-]+$/", $name)) {
          $nameErr = "Invalid name format. Name can only include letters, period, and dash.";
        }

        if(strlen($name)<2)
        {
          $nameErr = "Name must contain at least two (2) characters";
        }

        if(!preg_match("/^[a-zA-Z]/", $name[0]))
        {
          $nameErr = "Name must start with a letter";
        }
      }
      
      

    // Validate email field
    if (empty($_POST["email"])) {
      $emailErr = "Email is .";
    } else {
      $email = test_input($_POST["email"]);
      // Check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
      }
    }

    // Validate date of birth
    if (empty($_POST["dob"])) {
      $dobErr = "Date of birth is .";
    } else {
      $dob = $_POST["dob"];
      $year = substr($dob,0,4);
      if($year>1998 || $year<1953)
      {
        $dobErr = "Invalid date of birth.";
      }
      // Additional validation if needed
      // ...
    }

    // Validate degree checkboxes
    if (empty($_POST["degree"])) {
        $degreeErr = "At least two degrees must be selected.";
      } else {
        $degree = $_POST["degree"];
        
        // Additional validation if needed
        // ...
        
        if (count($degree) < 2) {
          $degreeErr = "At least two degrees must be selected.";
        }
      }

      if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
      } else {
        $gender = test_input($_POST["gender"]);
      }
      

    // Validate blood group selection
    if (empty($_POST["blood_group"])) {
      $bloodGroupErr = "Blood group is .";
    } else {
      $blood_group = $_POST["blood_group"];
      // Additional validation if needed
      // ...
    }

    // If all validations pass, process the form data
    if (empty($nameErr) && empty($emailErr) && empty($dobErr) && empty($degreeErr) && empty($bloodGroupErr)) {
      // Process the data or perform any additional validation
      // ...

      // Display success message
      echo "Form submitted successfully!";
    }
  }

  // Helper function to sanitize form input
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <fieldset>
      <legend>Name</legend>
      <input type="text" name="name" value="<?php echo $name; ?>">
      <span class="error"><?php echo $nameErr; ?></span>
    </fieldset>

    <fieldset>
      <legend>Email</legend>
      <input type="email" name="email" value="<?php echo $email; ?>" >
      <span class="error"><?php echo $emailErr; ?></span>
    </fieldset>

    <fieldset>
      <legend>Date of Birth</legend>
      <input type="date" name="dob" value="<?php echo $dob; ?>" >
      <span class="error"><?php echo $dobErr; ?></span>
    </fieldset>

    <fieldset>
      <legend>Gender</legend>
      <input type="radio" name="gender" value="male" <?php if ($gender == "male") echo "checked"; ?> > Male
      <input type="radio" name="gender" value="female" <?php if ($gender == "female") echo "checked"; ?> > Female
      <input type="radio" name="gender" value="other" <?php if ($gender == "other") echo "checked"; ?> > Other
      <span class="error"><?php echo $genderErr; ?></span>
    </fieldset>

    <fieldset>
  <legend>Degree</legend>
  <input type="checkbox" name="degree[]" value="SSC" <?php if (is_array($degree) && in_array("SSC", $degree)) echo "checked"; ?>> SSC
  <input type="checkbox" name="degree[]" value="HSC" <?php if (is_array($degree) && in_array("HSC", $degree)) echo "checked"; ?>> HSC
  <input type="checkbox" name="degree[]" value="BSC" <?php if (is_array($degree) && in_array("BSC", $degree)) echo "checked"; ?>> BSC
  <input type="checkbox" name="degree[]" value="MSc" <?php if (is_array($degree) && in_array("MSc", $degree)) echo "checked"; ?>> MSc
  <span class="error"><?php echo $degreeErr; ?></span>
</fieldset>


    <fieldset>
      <legend>Blood Group</legend>
      <select name="blood_group" >
        <option value="" disabled selected>Select</option>
        <option value="A+" <?php if ($blood_group == "A+") echo "selected"; ?>>A+</option>
        <option value="A-" <?php if ($blood_group == "A-") echo "selected"; ?>>A-</option>
        <option value="B+" <?php if ($blood_group == "B+") echo "selected"; ?>>B+</option>
        <option value="B-" <?php if ($blood_group == "B-") echo "selected"; ?>>B-</option>
        <option value="O+" <?php if ($blood_group == "O+") echo "selected"; ?>>O+</option>
        <option value="O-" <?php if ($blood_group == "O-") echo "selected"; ?>>O-</option>
        <option value="AB+" <?php if ($blood_group == "AB+") echo "selected"; ?>>AB+</option>
        <option value="AB-" <?php if ($blood_group == "AB-") echo "selected"; ?>>AB-</option>
      </select>
      <span class="error"><?php echo $bloodGroupErr; ?></span>
    </fieldset>

    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>