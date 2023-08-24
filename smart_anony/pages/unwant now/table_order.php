<table width="100%" border="1px" cellspacing="0" id="myTable">
          <tr height="40px">
            <th>Product Name</th>
            <th>Availble Qty</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>&nbsp;Action&nbsp;</th>
          </tr>
          <?php
          /*if (isset(($_GET['id']))){
            $id = $_GET['id'];
            $query1="DELETE From "
          }*/
          $querytemp1 = "SELECT * from product_temp; ";
          $resulttemp1 = $conn->query($querytemp1);

          $rowtemp1 = mysqli_fetch_assoc($resulttemp1);
          ?>
          <tr>
            <td colspan="4" align="right">Discount : </td>
            <td><input type="text" value="5%"></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="4" align="right">Total Amount : </td>
            <td><input type="text"></td>
            <td></td>
          </tr>
          <tr align="center" id="looprow">
            <td>
            <input type="text" value="" readonly>
            </td>

            <td><input type="text" value="23" readonly></td>

            <td><input type="number" name="qty" value="1"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><?php echo "<a href='home.php?proname=$row' value='Delete' class='delete' >"?></td>
          </tr>


        </table>