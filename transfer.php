<?php 
    include('config.php');
?>
<?php
if(isset($_POST['submit'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * FROM  user where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * FROM  user where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);
    
    if($amount<=0){
        echo "<script type='text/javascript'>
              alert('Enter valid value to transfer!')
              </script>";
    }
    else if($amount > $sql1['balance']){
        echo "<script type='text/javascript'>
            alert('Bad Luck! Insufficient Balance!')
        </script>";
    }
    else{
        // deducting amount from sender's account
        $newbalance = $sql1['balance'] - $amount;
        $sql = "UPDATE user set balance=$newbalance where id=$from";
        mysqli_query($conn,$sql);

        // adding amount to reciever's account
        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE user set balance=$newbalance where id=$to";
        mysqli_query($conn,$sql);

        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
        $query=mysqli_query($conn,$sql);

        if($query){
            echo "<script> alert('Transaction Successful');
                window.location = 'history.php';
            </script>";
        }
        $newbalance= 0;
        $amount =0;
    }
}
?>
<?php 
    include('navbar.php');
?>
<div class="container1  my-4">
    <h2 style="text-align: center; color: #000; margin-bottom: 20px; font-weight: bold;">Transaction</h2>
    <hr>
    <form method="post">
        <strong>Transfer From:</strong> <br> <br>
        <select id='s1' onChange='reload()' name="from" class="form-control" required>
            <option value="" disabled selected>From</option>
            <?php
            if($_GET['id']){
            $sid = $_GET['id'];
            $sql = "SELECT * FROM user where id=$sid";
            $result=mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            ?>
                <option value="<?php echo $row['id'];?>" selected>
                    <?php echo $row['name'] ;?> (Balance:
                    <?php echo $row['balance'] ;?>)
                </option>

            <?php
            $sql = "SELECT * FROM user where id!=$sid";
            }
            else{$sql = "SELECT * FROM user";}
            $result=mysqli_query($conn,$sql);
            if(!$result)
            {
                echo "Error ".$sql."<br>".mysqli_error($conn);
            }
            while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>">
                    <?php echo $rows['name'] ;?> (Balance:
                    <?php echo $rows['balance'] ;?>)
                </option>
            <?php 
            } 
            ?>
        </select>
        <br>

        <strong>Transfer To:</strong> <br> <br>
        <select name="to" class="form-control" required>
                <option value="" disabled selected>To</option>
            <?php
            // $sql = "SELECT * FROM user where id!=$sid";
            $result=mysqli_query($conn,$sql);
            if(!$result)
            {
                echo "Error ".$sql."<br>".mysqli_error($conn);
            }
            while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>">
                    <?php echo $rows['name'] ;?> (Balance:
                    <?php echo $rows['balance'] ;?>)
                </option>
            <?php 
            } 
            ?>
        </select>
        <br>

        <strong>Amount:</strong> <br> <br>
        <input type="number" class="form-control" name="amount" required>
        <br><br>

        <div class="text-center">
            <button class="btn btn-primary" name="submit" type="submit" id="btn">Transfer</button>
        </div>
    </form>
</div>

<?php include('footer.php') ?>

</body>
<script>
    function reload() {
        var v1 = document.getElementById('s1').value;
        self.location = 'transfer.php?id= ' + v1;
    }
</script>
</html>