<?php 
    include('navbar.php');
?>

  <div class="container1">
    <h2 style="text-align: center; color: #000; margin-bottom: 20px !important; font-weight: bold;">Welcome to Sparks Bank</h2>
    <hr>
    
      <ul>
        <li class="operations">
            <a href="users.php">
            <button class="btn" id="black"> <b>View All Users</b></button></a>
        </li>
        <li class="operations">
            <a href="transfer.php">
            <button class="btn" id="black"><b>Trasnfer Money</b></button></a>
        </li>
        <li class="operations">
            <a href="history.php">
            <button class="btn" id="black"><b>View Transfer History</b></button></a>
        </li>
      </ul>
</div>
  <?php include('footer.php') ?>
</body>
</html>