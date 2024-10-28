<?php include "connect.php" ?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Food</title>
    <link href="food.css" rel="stylesheet" type="text/css" />
    <link href="footer.css" rel="stylesheet" type="text/css" />
    <style>

        .Register {
            text-align: center;
            border: 3px solid white;
            background: linear-gradient(90deg, #3EBB1F 0%, #35C290 100%);
            width: 300px;
            padding: 15px;
            border-radius: 20px;
        }
    </style>
  </head>

  <body>
<header>
    <h1>ร้านอาหารครัวพระจอม
    <a href="logout.php" style="float: right; margin-right: 50px;">
                <svg class="user" width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.0625 13.8645C24.0625 17.4889 21.1244 20.427 17.5 20.427C13.8756 20.427 10.9375 17.4889 10.9375 13.8645C10.9375 10.2401 13.8756 7.302 17.5 7.302C21.1244 7.302 24.0625 10.2401 24.0625 13.8645Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 18.2395C0 8.57452 7.83502 0.739502 17.5 0.739502C27.165 0.739502 35 8.57452 35 18.2395C35 27.9045 27.165 35.7395 17.5 35.7395C7.83502 35.7395 0 27.9045 0 18.2395ZM17.5 2.927C9.04314 2.927 2.1875 9.78264 2.1875 18.2395C2.1875 21.8564 3.4415 25.1804 5.53844 27.8004C7.09391 25.2947 10.5101 22.6145 17.5 22.6145C24.4899 22.6145 27.9061 25.2947 29.4616 27.8004C31.5585 25.1804 32.8125 21.8564 32.8125 18.2395C32.8125 9.78264 25.9569 2.927 17.5 2.927Z" fill="white"/>
                </svg>
    </a>

      </h1>
</header>
<nav>
    <h3>
        <a href="Userm.php"> User management</a>
        <a href="Orderm.php"> Order management</a>
        <a href="#"> อาหารอีสาน</a>
        <a href="#"> อาหารเหนือ</a>
        <a href="#"> อื่นๆ</a>
    </h3>
</nav>
      <section>
        <div class="h">
            <h1>Order managementt</h1>
        </div>
      </section>
      <article  style="text-align: center;">
    <table border='1' style="margin: auto; width: 80%;">
        <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อผู้สั่ง</th>
            <th>สถานะการจ่ายเงิน</th>
            <th>สถานะการส่งอาหาร</th>
        </tr>
        <?php
        $stmt = $pdo->prepare("SELECT Order_PCK.id, Order_PCK.user_id, User_PCK.name_cus, User_PCK.surname_cus, Order_PCK.payment_status, Order_PCK.status_food FROM User_PCK JOIN Order_PCK ON User_PCK.id = Order_PCK.user_id");
        $stmt->execute();
        while ($row = $stmt->fetch()) { 
        ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name_cus'] . ' ' . $row['surname_cus'] ?></td>
            <td><?php echo $row['payment_status'] ?></td>
            <td><?php echo $row['status_food'] ?></td>
        </tr>
        <?php       
        }
        ?>
    </table>
</article>

    <footer>
        <div class="footer">
            <div class="sb_footer section_padding">
                <div class="sb_footer-links">
                    <div class="sb_footer-links-div">
                        <h4>Categories</h4>
                        <a href="/comics and Novels">
                            <p>Comics and Novels</p>
                        </a>
                        <a href="/sciences">
                            <p>Sciences</p>
                        </a>
                        <a href="/bussiness and Economics">
                            <p>Business and Economics</p>
                        </a>
                    </div>
                    <div class="sb_footer-links-div">
                        <h4>Help</h4>
                        <a href="/FAQ">
                            <p>FAQ</p>
                        </a>
                        <a href="/term of use">
                            <p>Term of use</p>
                        </a>
                        <a href="/privacy policy">
                            <p>Privacy policy</p>
                        </a>
                    </div>
                    <div class="sb_footer-links-div">
                        <h4>About us</h4>
                        <a href="/employer">
                            <p>Location</p>
                        </a>
                    </div>
                    <div class="sb_footer-links-div">
                        <h4>Contact</h4>
                        <a href="/about">
                            <p>Facebook</p>
                        </a>
                        <a href="/press">
                            <p>Instagram</p>
                        </a>
                        <a href="/career">
                            <p>Twitter</p>
                        </a>
                        <a href="/contact">
                            <p>Thread</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
      </footer>
  </body>
</html>

