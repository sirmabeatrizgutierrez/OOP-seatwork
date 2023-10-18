<?php
include 'db_config.php';
include 'bank_account.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Account_ID = $_POST['Account_ID'];
  $action = $_POST['action'];
  $amount = $_POST['amount'];

  $account = new BankAccount($Account_ID, null, 0, null, null);

  if ($action === "inquire") {
    $balance = $account->inquire();
    echo "Current Balance: $balance";
  } elseif ($action === "deposit") {
    $result = $account->deposit($amount);
    echo $result;
  } elseif ($action === "withdraw") {
    $result = $account->withdraw($amount);
    echo $result;
  }
}


$sql = "SELECT Account_ID, Account_Name, Balance, Account_Type FROM bank_account";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<h3>Account Information</h3>';
  echo '<table border="1">';
  echo '<tr>
    <th>Account ID</th>
    <th>Account Name</th>
    <th>Balance</th>
    <th>Account Type</th>
  </tr>';

  while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['Account_ID'] . '</td>';
    echo '<td>' . $row['Account_Name'] . '</td>';
    echo '<td>' . $row['Balance'] . '</td>';
    echo '<td>' . $row['Account_Type'] . '</td>';
    echo '</tr>';
  }

  echo '</table>'; 

}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Bank Account Operations</title>
</head>

<body>
  <h2>Bank Account Operations</h2>
  <form action="index.php" method="post">
    <label for="Account_ID">Account ID:</label>
    <input type="text" name="Account_ID" id="Account_ID" required><br>

    <label for="action">Action:</label>
    <select name="action" id="action">
      <option value="inquire">Inquire</option>
      <option value="deposit">Deposit</option>
      <option value="withdraw">Withdraw</option>
    </select><br>

    <label for="amount">Amount:</label>
    <input type="text" name="amount" id="amount"><br>

    <input type="submit" value="Submit">
  </form>
</body>


</html>