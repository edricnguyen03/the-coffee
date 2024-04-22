
<div class="wrapper">
     <div class="container">
          <h2>こんにちわ</h2>
          <div class="table-container">
               <table class="table table-hover">
                    <thead> <!-- Header-->
                         <tr>
                              <th scope="col">No.</th>
                              <th scope="col">Order No.</th>
                              <th scope="col">Name</th>
                              <th scope="col">Price</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                         </tr>
                    </thead>
                    <tbody> <!-- Body-->
                         <?php
                         $id = 1;
                         foreach ($data['orders'] as $item) {
                         ?>
                              <tr onclick="rowClicked(this)">
                                   <th scope="row"><?php echo $id++; ?></th>
                                   <td style="text-align:center;"><?php echo $item->order_id; ?></td>
                                   <td><?php echo $item->product_name; ?></td>
                                   <td style="text-align:right;"><?php echo $item->product_price . " VND"; ?></td>
                                   <td style="text-align:center;"><?php echo $item->qty; ?></td>
                                   <td style="text-align:right;"><?php echo ($item->product_price * $item->qty) . " VND" ?></td>
                              </tr>
                         <?php
                         }
                         ?>

                    </tbody>
               </table>
          </div>
     </div>
     <div class="row justify-content-center" style="align-items: center; background-color: rgb(238 238 238);">
          <div class="col-auto">
               <ul class="pagination" style=" margin:0px; padding:5px;">
                    <li class="page-item">
                         <!--Điền link zo php-->
                         <a class="page-link" href="#" aria-label="Previous" style="display: flex; align-items: center; justify-content:center;">
                              <i class="fa-solid fa-angle-left" id="previous-icon" style="color: #fb8e18;"></i>
                         </a>
                    </li>
                    <li class="page-item">
                         <!--chổ này điền số trang vào bằng php-->
                         <div class="page-number">1</div>
                    </li>
                    <li class="page-item">
                         <!--Điền link zo php-->
                         <a class="page-link" href="#" aria-label="Next" style="display: flex; align-items: center; justify-content:center;">
                              <i class="fa-solid fa-angle-right" id="next-icon" style="color: #fb8e18;"></i>
                         </a>
                    </li>
               </ul>
          </div>
     </div>
</div>
<style>
     .pagination {
          justify-content: center;
          background-color: #eeeeee;
     }

     .page-link {
          width: 30px;
          height: 30px;
          border: none;
          background-color: #eeeeee;
     }

     .page-link:hover {
          background-color: white;
     }

     .page-number {
          background-color: azure;
          width: 30px;
          height: 30px;
          background-color: #fb8e18;
          color: black;
          border-radius: 20%;
          text-align: center;
          padding-top:10%;
     }

     .table-container {
          display: flex;
          flex-direction: column;
     }

     .table {
          max-height: 490;
          max-width: 1620;
          border-collapse: collapse;
     }

     .table td,
     .table th {
          border: 1px solid #ddd;
          padding: 8px;
     }

     .table th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: center;
     }

     .table {
          border-radius: 10px !important;
     }
</style>
<script>
     function rowClicked(row) {
          // Lấy dữ liệu từ hàng đó
          var cells = row.cells;
          var rowData = [];
          for (var i = 0; i < cells.length; i++) {
               rowData.push(cells[i].innerText);
          }
          // In ra dữ liệu từ hàng đó
          console.log("Row clicked! Data: " + rowData.join(", "));
     }
</script>