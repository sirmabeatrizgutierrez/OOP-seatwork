<?php
include 'bank_account.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Account_Name = $_POST['Account_Name'];
  $Balance = $_POST['Balance'];
  $Account_Type = $_POST['Account_Type'];
  $Password = $_POST['Password'];

  $newAccount = new BankAccount(null, $Account_Name, $Balance, $Account_Type, $Password);
  $result = $newAccount->createBankAccount();
  echo $result; 

}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Bank Account Registration</title>
</head>

<body>
  <h2>Bank Account Registration</h2>
  <form action="registration.php" method="post">
  
    <label for="Account_Name">Account Name:</label>
    <input type="text" name="Account_Name" id="Account_Name" required><br>

    <label for="Balance">Balance:</label>
    <input type="text" name="Balance" id="Balance" required><br>

    <label for="Account_Type">Account Type:</label>
    <input type="text" name="Account_Type" id="Account_Type" required><br>

    <label for="Password">Password:</label>
    <input type="password" name="Password" id="Password" required><br>

    <input type="submit" value="Register">
  </form>
</body>

</html>