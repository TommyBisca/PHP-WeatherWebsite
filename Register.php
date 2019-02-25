<!DOCTYPE html public "-//W3C//DTD HTML 4.0 //EN">
<!--Tommy Bisca CPT 283 3/25/18 Program2.-->
<html>
<head>
  <title>BiscaTProgram2</title>
<style type="text/css">
h1 {
  color: aqua;
}


</style>
</head>

<body>
<?php
$page_title = 'Weather Wizards Registration';
include ('includes/header.html');
extract($_POST);
$membership = '';
$nameChild = '';
$nameParent = '';
$email = '';
$phone = '';
$city = '';
$workshop[] = '';



 ?>
 <h1>Weather Wizards Workshops!</h1>
 <p> Throughout the year we host weather based workshops for children<br>between the ages of 6 - 12.
 Any child who has an interest in Meteorology<br> and science or just wants to have some fun is welcome!</p>
 <p> The following workshops are free of charge for our members!</p>
  <ul>
    <li>Make a Rain Gauge!</li>
    <li>Make a Thermometer!</li>
  </ul>
  </ br>
    These are the workshops we have available!<br />
    Please check any boxes that interest you!
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="checkbox" name="workshop[]" value="Make a rain Gauge!" <?php if (in_array('Make a rain Gauge!', $workshop)) echo(' CHECKED '); ?>> Make a rain Gauge!
    <br>
    <input type="checkbox" name="workshop[]" value="Make a Thermometer!" <?php if (in_array('Make a Thermometer!', $workshop)) echo(' CHECKED '); ?>> Make a Thermometer!
    <br>
    <input type="checkbox" name="workshop[]" value="Make Lightning in your mouth!" <?php if (in_array('Make Lightning in your mouth!', $workshop)) echo(' CHECKED '); ?>> Make Lightning in your mouth!
    <br>
    <input type="checkbox" name="workshop[]" value="Make a Hygrometer!" <?php if (in_array('Make a Hygrometer!', $workshop)) echo(' CHECKED '); ?>> Make a Hygrometer!
    <br>
    <input type="checkbox" name="workshop[]" value="Make a Windsock!" <?php if (in_array('Make a Windsock!', $workshop)) echo(' CHECKED '); ?>> Make a Windsock!
    <br><br>
      <fieldset>
        <legend>Child and Parent Information:</legend>
        Your name:<br>
        <input name="childname" type="text" value="<?php if (isset($_POST['childname'])) echo $_POST['childname']; ?>" />
        <br><br><br>
        Your parent or guardian's name:<br>
        <input name="parentname" type="text" value="<?php if (isset($_POST['parentname'])) echo $_POST['parentname']; ?>" />
        <br><br><br>
        Your parent or guardian's email:<br>
        <input name="parentemail" type="email" value="<?php if (isset($_POST['parentemail'])) echo $_POST['parentemail']; ?>" />
        <br><br><br>
        Your parent or guardian's phone:<br>
        <input name="parentphone" type="number" value="<?php if (isset($_POST['parentphone'])) echo $_POST['parentphone']; ?>" />
        <br><br><br>
        <p>Please choose the weather station nearest you!</p>
            <select name="city">
              <option value="Char"<?php if (isset($_POST['city']) && ($_POST['city'] == 'Char')) echo ' selected="selected"'; ?>>Charleston</option>
              <option value="Summ"<?php if (isset($_POST['city']) && ($_POST['city'] == 'Summ')) echo ' selected="selected"'; ?>>Summerville</option>
              <option value="MtP"<?php if (isset($_POST['city']) && ($_POST['city'] == 'MtP')) echo ' selected="selected"'; ?>>Mount Pleasant</option>
            </select>
        <br><br>
        Are you a current Weather Wizard member?<br>
          <input type="radio" name="membership" value="member" <?php if (isset($_POST['membership']) && ($_POST['membership'] == 'member')) echo 'checked="checked" '; ?>> Yes<br>
          <input type="radio" name="membership" value="non member"<?php if (isset($_POST['membership']) && ($_POST['membership'] == 'non member')) echo 'checked="checked" '; ?>> No<br>
          <input type="radio" name="membership" value="incoming member"<?php if (isset($_POST['membership']) && ($_POST['membership'] == 'incoming member')) echo 'checked="checked" '; ?>> Sign me up!<br>
          <br><br>
      </fieldset>




    <input type="submit" value="Register">
    <input type="reset" value="Reset form">

    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
     {
    if (isset($membership))
    {
    if($membership == 'member'){
      echo "<p>Welcome back, Thank you for being a fantastic Weather Wizard!</p>";
    }
    else if($membership == 'non member'){
      echo "<p>Hey there, We hope one day you'll become one of our famouse Weather Wizards!</p>";
    }
    else{
      echo "<p>Hey there, Thank you for taking the first step to becomign a Weather Wizard!</p>";
    }
    }

    if (isset($nameChild))
    {
    if (!empty($_POST['childname'])){
    	$nameChild = $_POST['childname'];
      echo "<p>Thank you $nameChild</p>";
    }else{
    	$nameChild = NULL;
    	echo "<p style='color: red'>You forgot to enter your name!</P>";
    }
    }


    if (isset($nameParent))
    {
    if (!empty($_POST['parentname'])){
    	$nameParent = $_POST['parentname'];
      echo "<p>Parent's name is: $nameParent</p>";
    }else{
    	$nameParent = NULL;
    	echo "<p style='color: red'>You forgot to enter your parent's name!</P>";
    }
    }


    if (isset($email))
    {
    if (!empty($_POST['parentemail'])){
    	$email = $_POST['parentemail'];
      echo "<p>Parent's email is $email</p>";
    } else {
    	$email = NULL;
    	echo "<p style='color: red'>You forgot to enter your parent's email address!</P>";
    }
    }


    if (isset($phone))
    {
    if (!empty($_POST['parentphone'])){
    	$phone = $_POST['parentphone'];
      echo "<p>Parent's phone is: $phone</p>";
    } else {
    	$phone = NULL;
    	echo "<p style='color: red'>You forgot to enter your parent's phone number!</P>";
    }
    }

    if (isset($membership))
    {
    if (!empty($_POST['membership'])){
    	$membership = $_POST['membership'];
      echo "<p>Your membership status is: $membership</p>";
    } else {
    	$membership = NULL;
    	echo "<p style='color: red'>You forgot to enter your membership status!</P>";
    }
    }


    if (!empty($_POST['city'])){
    $city = $_POST['city'];
    // else{
    //   $city = NULL;
    // }
    if (isset($city))
    {
    if($city == 'Char'){
      echo "<p>You are nearest to our Charleston SC location, the Holy City! Go River Dogs!</p>";
    }
    else if($city == 'Summ'){
      echo "<p>You are nearest to our Summerville SC location, the Birthplace of Sweet Tea! How Refreshing!</p>";
    }
    else{
      echo "<p>You are nearest to our Mount Pleasant SC location, which has a historical and beachy vibe!</p>";
    }
    }
    // else{ $city = NULL}
    }



    if (isset($workshop))
    {
      echo "<p>You have chosen the following workshops:</p>";
      foreach ($workshop as $value)
      {
        echo "<p>$value</p>";
      }
    }
    else
    {
    // if (isset($workshop))
    //   {
      // echo "<p style='color: green'>You have not selected any workshops, but we hope you will in the future. Our workshops are barrles o'fun.</p>";
      // }
    }


    if (($nameChild == NULL)||($nameParent == NULL)||($phone == NULL)||($email == NULL)||($membership == NULL))
    {
      echo "<p style='color: orange'>Weather Wizard, we need your name and your parent or guardian's name, email, phone and your membership status to send information about our workshops. Enter required information and click the Register button again.</p>";
    }

    // 824 824
    }
     ?>
    </body>
    <?php include ('includes/footer.html'); ?>
</html>
