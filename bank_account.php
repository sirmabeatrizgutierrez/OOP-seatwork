<?php
include 'db_config.php';

class BankAccount
{
  private $Account_ID;
  private $Account_Name;
  private $Balance;
  private $Account_Type;
  private $Password;

  public function __construct($Account_ID, $Account_Name, $Balance, $Account_Type, $Password)
  {
    $this->Account_ID = $Account_ID;
    $this->Account_Name = $Account_Name;
    $this->Balance = $Balance;
    $this->Account_Type = $Account_Type;
    $this->Password = password_hash($Password, PASSWORD_DEFAULT);
  }

  public function createBankAccount()
  {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO bank_account (Account_Name, Balance, Account_Type, Password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $this->Account_Name, $this->Balance, $this->Account_Type, $this->Password);

    if ($stmt->execute()) {
      return "Account created successfully.";
    } else {
      return "Error creating account: " . $stmt->error;
    }
  }

  public function inquire()
  {
    global $conn;
    $sql = "SELECT Balance FROM bank_account WHERE Account_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $this->Account_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['Balance'];
  }

  public function deposit($amount)
  {
    global $conn;
    $sql = "UPDATE bank_account SET Balance = Balance + ? WHERE Account_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $amount, $this->Account_ID);

    if ($stmt->execute()) {
      return "Deposit successful.";
    } else {
      return "Error depositing: " . $stmt->error;
    }
  }


  public function withdraw($amount)
  {
    global $conn;
    $sql = "UPDATE bank_account SET Balance = Balance - ? WHERE Account_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $amount, $this->Account_ID);

    if ($stmt->execute()) {
      return "Withdrawal successful.";
    } else {
      return "Error withdrawing: " . $stmt->error;
    }
  }

}
?>