<?php

/*

The DB.php file manages all requests to the database.
The current model is not efficient, as several connections are opened and closed in one loading of the page.
Ideally this should be mitigated.

*/

include_once 'util.php';

$servername = "127.0.0.1:3306";
$DB_username = "root";
$DB_password = "";
$DB_name = "loaning";

$conn = new mysqli($servername, $DB_username, $DB_password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);        
}
consoleLog("Connection successful");

function query($sql)
{
    global $servername, $DB_username, $DB_password, $DB_name;

    $conn = new mysqli($servername, $DB_username, $DB_password, $DB_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);        
    }
    consoleLog("Connection successful");

    $result = $conn->query($sql);

    $conn->close();
    return $result;
}


//log in a user. This creates a session with several session variables.
function user_login($username, $password)
{

    $result = query("SELECT id, username, password FROM user_data WHERE username ='$username' AND password = '$password'");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $username = $row["username"];

        $_SESSION["login"] = true;
        $_SESSION["user_id"] = $id;
        $_SESSION["username"] = $username;
    } else {
        echo "user not recognized";
        exit();
    }
}

//obtain current balance from database.
function get_balance($id)
{
    $result = query("SELECT balance FROM user_data WHERE id='$id'");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $balance = $row["balance"];
        return $balance;
    } else {
        echo "Error. something went wrong when trying to obtain account balance";
        exit();
    }
}

//When loaning money to a user, a new loan_data entry is created
//however, this also calls the process_pay function, which can reduce or delete a loan if you are giving
//money to a lender.
function process_loan($owner, $target, $amount)
{
    $result = query("SELECT amount FROM loan_data WHERE owner=$owner AND target=$target");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $total = $row["amount"] + $amount;
        query("UPDATE loan_data SET amount=$total WHERE owner=$owner AND target=$target");
    } else {
        query("INSERT INTO loan_data (owner, target, amount) VALUES ($owner, $target, $amount)");
    }

    process_pay($owner, $target, $amount);
}

//process the sending of money. Will alter loan data accordingly. It is always assumed that if you are paying 
//someone you ower, that you are repaying the loan.
function process_pay($owner, $target, $amount)
{
    //first we check if there are loans to normalize
    $result = query("SELECT amount FROM loan_data WHERE owner=$target AND target=$owner");
    if ($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
        $owed = $row["amount"];
        if ($owed>$amount)
        {
            query("UPDATE loan_data SET amount=amount - $amount WHERE owner=$target AND target=$owner");
        }
        else
        {
            query("DELETE FROM loan_data WHERE owner=$target AND target=$owner");
        }
    }

    //balance the balances of both users.
    query("UPDATE user_data SET balance=balance + $amount WHERE id=$target");
    query("UPDATE user_data SET balance=balance - $amount WHERE id=$owner");
}

//obtain user id from username
function get_user_id($username)
{
    $result = query("SELECT id FROM user_data WHERE username='$username'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        return $id;
    } else {
        die("could not find matching user"); 
    }
}

//obtain user username from id
function get_user_name($id)
{
    $result = query("SELECT username FROM user_data WHERE id='$id'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row["username"];
        return $name;
    } else {
        die("could not find matching user"); 
    }
}

//obtain and populate a list of all loans that are either made to or from user
//currently can be exploited to allow the printing of other users related loans if user id is injected in post
function get_related_loans($user_id)
{
    $result = query("SELECT * FROM loan_data WHERE owner='$user_id' OR target='$user_id'");
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            
            $amount = $row["amount"];

            if ($row["owner"] == $user_id)
            {
                $name = get_user_name($row["target"]);
                echo "<div> $name owes you $amount</div>";
            }
            if ($row["target"] == $user_id)
            {
                $name = get_user_name($row["owner"]);
                echo "<div> You owe $name $amount</div>";
            }
        }
    } else {
        echo "<div>No associated loans found</div>";
    }
}

//register a user
function process_registry($username, $password)
{
    $result = query("SELECT id FROM user_data WHERE username='$username'");
    if ($result->num_rows > 0) 
    {
        die("User with that username already exists");
    }
    else
    {
        query("INSERT INTO user_data (username, password, balance) VALUES ('$username', '$password', 100)");
    }
}

?>
