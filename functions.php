<br>
<form method="get" action="/logout.php">
    <button type="submit">Log out</button>
</form>
<br>
<div>account balance: <?php echo get_balance($_SESSION["user_id"])?> </div>
<br>
<form method="get" action="/index.php">
    <input type="hidden" name="action" value="loan"><br>
    <button type="submit">Loan money</button>
</form>
<form method="get" action="/index.php">
    <input type="hidden" name="action" value="pay"><br>
    <button type="submit">Pay back money</button>
</form>
<form method="get" action="/index.php">
    <input type="hidden" name="action" value="balance"><br>
    <button type="submit">Balance</button>
</form>

<?php 

if (isset($_GET["action"]))
{

    //the buttons inject a get variable called action which then determines what the user is doing:
    //either making a loan payment, simply sending money or viewing related loans.

    echo "<hr>";
    $action = $_GET["action"];
    
    if ($action == "loan")
    {
        include "loan.php";
    }

    if ($action == "pay")
    {
        include "pay.php";
    }

    if ($action == "balance")
    {
        get_related_loans($_SESSION["user_id"]);
    }

}
?>