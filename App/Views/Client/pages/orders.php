<section style="background-color: #eee;" style="min-height: 85vh;">
     <?php
     if (!empty($data['orders'])) {
     ?>
          <div class="wrapper">
               <div class="order-product" style="min-width:40%;">
                    <h2 style="text-align:center;">Chi tiết</h2>
                    <div class="container" style="min-height:70vh; ">
                         <div class="table-container table-responsive">
                              <table class="table ">
                                   <thead> <!-- Header-->
                                        <tr>
                                             <th scope="col">No.</th>
                                             <th scope="col">Tên sản phẩm</th>
                                             <th scope="col">Giá</th>
                                             <th scope="col">Số lượng</th>
                                             <th scope="col">Tổng tiền</th>
                                        </tr>
                                   </thead>
                                   <tbody id="order_product_tbody" style="max-height:100%;"> <!-- Body-->
                                        <?php
                                        $id = 1;
                                        if (isset($data['order_products'])) {
                                             foreach ($data['order_products'] as $item) {
                                        ?>
                                                  <tr>
                                                       <th scope="row" id="order_product_no"><?php echo $id++; ?></th>
                                                            <td style="text-align:center;" id="order_product_name"><?php 
                                                                 foreach ($data['product'] as $value){
                                                                      if ($value->id == $item->product_id){
                                                                           echo $value->name;
                                                                      }
                                                                 }
                                                            ?></td>
                                                            <td style="text-align:right;" id="order_product_price"><?php 
                                                                 foreach ($data['product'] as $value){
                                                                      if ($value->id == $item->product_id){
                                                                           echo $value->price." VND";
                                                                      }
                                                            }
                                                            " VND"; ?></td>
                                                       <td style="text-align:center;" id="order_product_qty"><?php echo $item->qty; ?></td>
                                                       <td style="text-align:right;" id="order_product_total"><?php 
                                                                 foreach ($data['product'] as $value){
                                                                      if($value->id == $item->product_id){
                                                                           echo $value->price * $item->qty. " VND";
                                                                      }
                                                                 }
                                                         ?></td>
                                                  </tr>
                                        <?php
                                             }
                                        }
                                        ?>

                                   </tbody>
                              </table>
                         </div>
                         <div class="order-detail-container" id="order_detail">
                              <h4>Thông tin nhận hàng</h4>
                              <div class="order-detail">
                                   <p id="name_receiver">Người nhận : <?php if (isset($data['order'])) echo $data['order']->name_receiver ?></p>
                                   <p id="address_receiver">Địa chỉ : <?php if (isset($data['order'])) echo $data['order']->address_receiver ?></p>
                                   <p id="phone_receiver">Số điện thoại : <?php if (isset($data['order'])) echo $data['order']->phone_receiver ?></p>
                                   <p id="payment_status">Thanh toán : <?php if (isset($data['order'])) if ($data['order']->payment_status == 1) echo "Đã thanh toán";
                                                                           else {
                                                                                echo "Chưa thanh toán";
                                                                           } ?></p>

                                   <?php
                                   $color;
                                   $note;
                                   if (isset($data['order']->order_status)) {
                                        switch ($data['order']->order_status) {
                                             case 1:
                                                  $note = "Đang chờ xử lý";
                                                  $color = "#0d6efd";
                                                  break;
                                             case 2:
                                                  $note =  "Đã xác nhận và sẵn sàng giao hàng";
                                                  $color = "#0d6efd";
                                                  break;
                                             case 3:
                                                  $note =  "Đang giao hàng";
                                                  $color = "#0d6efd";
                                                  break;
                                             case 4:
                                                  $note =  "Đã giao hàng";
                                                  $color = "green";
                                                  break;
                                             case 5:
                                                  $note =  "Đã hủy";
                                                  $color = "red";
                                                  break;
                                        }
                                   }
                                   if (isset($color) && isset($note)) echo "<p id='order_status' >Trạng thái đơn hàng : <span style='color:$color'>$note</span></p>"
                                   ?>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="order" style="min-width:60%">
                    <div class="container" style="min-height:70vh;">
                         <h2 style="text-align:center;">Lịch sử đơn hàng</h2>
                         <div class="table-container table-responsive">
                              <table class="table table-hover ">
                                   <thead> <!-- Header-->
                                        <tr>
                                             <th scope="col">Mã đơn</th>
                                             <th scope="col">Người nhận</th>
                                             <th scope="col">SDT</th>
                                             <th scope="col">Tổng tiền</th>
                                             <th scope="col">Thanh toán</th>
                                             <th scope="col">Ghi chú</th>
                                        </tr>
                                   </thead>
                                   <tbody style="max-height:100%;"> <!-- Body-->
                                        <?php
                                        foreach ($data['orders'] as $item) {
                                        ?>
                                             <tr onclick="rowClicked(this)">
                                                  <td style="text-align:center;"><?php echo $item->id; ?></td>
                                                  <td style="text-align:center;"><?php echo $item->name_receiver; ?></td>
                                                  <td style="text-align:center;"><?php echo $item->phone_receiver; ?></td>
                                                  <td style="text-align:center;"><?php echo $item->total . " VND"; ?></td>
                                                  <td style="text-align:center;"><?php if ($item->payment_status == 1) echo "Đã thanh toán";
                                                                                     else {
                                                                                          echo "Chưa thanh toán";
                                                                                     }
                                                                                     ?>
                                                  </td>
                                                  <td style="text-align:center;">
                                                       <?php
                                                       if (isset($item->note)) {
                                                            echo $item->note;
                                                       } else {
                                                            echo "Không";
                                                       }
                                                       ?>
                                                  </td>
                                             </tr>
                                        <?php
                                        }
                                        ?>

                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     <?php
     } else {
     ?>
          <div class="alter">
               <h3 style='text-align:center'>Bạn hiện chưa có đơn hàng nào cả </h3>
               <br>
               <h4 style='text-align:center'>Ấn vào đây để kiếm vài đơn hàng nào !</h4>
               <div class="href">
                    <p style='text-align: center;'     ><img class="gif" src="https://media1.tenor.com/m/xY6Yo4UuOYgAAAAC/click-here.gif" alt="GIF"></p>
                    <p style='text-align:center;'><span><a href="/the-coffee/product">Dạo sốp </a></span></p>
               </div>
          </div>
     <?php
     }
     ?>
</section>
<style>
     .alter {
          height: 75vh;
     }
     .href{
          display: fixed;
     }
     .gif {
          max-height: 10vh;
     }
     .href a {
          text-decoration: none;
          color:#fb8e18;
     }
     .href a:hover {
          text-decoration: none;
          color: blue;
     }
     .wrapper {
          display: flex;
          flex-direction: row;
     }

     .order-product {
          border-right: 2px solid #fb8e18;
     }

     .order {
          border-left: 2px solid #fb8e18;
     }


     .table {
          max-height: 490;
          max-width: 1620;
          border-collapse: collapse;
          overflow-y: scroll;
     }

     .table td,
     .table th {
          min-width: fit-content;
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
          // Tạo một đối tượng XMLHttpRequest
          var xhttp = new XMLHttpRequest();
          // Xác định phương thức và URL của file PHP cần include
          // alert("the-coffee/Orders/" + rowData[1]);
          $.ajax({
               url: '/the-coffee/Orders/detail/' + rowData[0], // URL đích
               method: 'GET',
               success: function(response) {
                    // Dữ liệu được trả về từ server       
                    var data = JSON.parse(response);
                    // Cập nhật bảng khác dựa trên dữ liệu
                    console.log(data);
                    updateOtherTable(data);
               },
               error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                    console.error(xhr.responseText);
               }
          });

          function updateOtherTable(data) {
               var count = 1;
               var tbodyHTML = '';
               console.log(data);
               for (var key in data) {
                    var rowHTML = '<tr>';
                    rowHTML += '<th scope="row" id="order_product_no">' + (count) + '</th>';
                    count++;
                    rowHTML += '<td style="text-align:center;" id="order_product_name">' + data[key]['name'] + '</td>';
                    rowHTML += '<td style="text-align:right;" id="order_product_price">' + data[key]['price'] + ' VND</td>';
                    rowHTML += '<td style="text-align:center;" id="order_product_qty">' + data[key]['qty'] + '</td>';
                    rowHTML += '<td style="text-align:right;" id="order_product_total">' + (data[key]['qty'] * data[key]['price']) + ' VND</td>';
                    rowHTML += '</tr>';
                    tbodyHTML += rowHTML;
               }
               document.getElementById('name_receiver').innerHTML = "Người nhận : " + data[0]['name_receiver'];
               document.getElementById('address_receiver').innerHTML = "Địa chỉ : " + data[0]['address_receiver'];
               document.getElementById('phone_receiver').innerHTML = "Số điện thoại : " + data[0]['phone_receiver'];
               if (data[0]['payment_status'] == 1) {
                    document.getElementById('payment_status').innerHTML = "Thanh toán : Đã thanh toán";
               } else {
                    document.getElementById('payment_status').innerHTML = "Số điện thoại : Chưa thanh toán";
               }
               switch (data[0]['order_status']) {
                    case 1:
                         var note = "Đang chờ xử lý";
                         var color = "#0d6efd";
                         document.getElementById('order_status').innerHTML = "Trạng thái đơn hàng : <span style='color:" + color + "'>" + note + "</span>";
                         break;
                    case 2:
                         var note = "Đã xác nhận và sẵn sàng giao hàng";
                         var color = "#0d6efd";
                         document.getElementById('order_status').innerHTML = "Trạng thái đơn hàng : <span style='color:" + color + "'>" + note + "</span>";
                         break;
                    case 3:
                         var note = "Đang giao hàng";
                         var color = "#0d6efd";
                         document.getElementById('order_status').innerHTML = "Trạng thái đơn hàng : <span style='color:" + color + "'>" + note + "</span>";
                         break;
                    case 4:
                         var note = "Đã giao hàng";
                         var color = "green";
                         document.getElementById('order_status').innerHTML = "Trạng thái đơn hàng : <span style='color:" + color + "'>" + note + "</span>";
                         break;
                    case 5:
                         var note = "Đã hủy";
                         var color = "red";
                         document.getElementById('order_status').innerHTML = "Trạng thái đơn hàng : <span style='color:" + color + "'>" + note + "</span>";
                         break;
               }
               document.getElementById('order_product_tbody').innerHTML = tbodyHTML;
          }
     }
</script>