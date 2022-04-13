<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.include.head')
</head>

<body class="g-sidenav-show bg-gray-100">
  <main class="main-content max-height-vh-100 h-100">
    <div class="container-fluid my-3 py-3">
      <div class="row">
        <div class="col-md-8 col-sm-10 mx-auto">
          <form class="" action="index.html" method="post">
            <div class="card my-sm-5">
              <div class="card-header text-center">
                <div class="row justify-content-between">
                  <div class="col-lg-5 col-md-4 text-md-end text-start mt-5" style="text-align: left !important;">
                    <h6 class="d-block mt-2 mb-0">MADINAH AL-COMPUTER&ELECTRONIC</h6>
                    <p class="text-secondary">Seles& maintenance all types of
                        Computer and Electronics,
                        Ink Printers, Laptops, Photocopy
                        Machines, Security Camara, Networking
                        School Service Centra
                    </p>
                  </div>
                  <div class="col-lg-2 col-md-2 text-md-end text-start mt-5">
                    <img class="mb-2 w-25 p-2" src="../../../assets/img/logo-ct.png" alt="Logo">
                  </div>
                  <div class="col-lg-5 col-md-5 text-md-end text-start mt-5">
                    <p class="text-secondary">مدينة الكمبيوتروالكترونيات<br>
                      بيع وصيانة لجميع انواع كمبيوتر<br>
                      والكترونياتواحبار طابعات محمول الةتصوير كاميرات
                        <br>مراقبةخدمات مدارس شبكات سنترال
                        <br>صاحب المؤسسة:رشادعلي عبدالله الزهراني
                    </p>
                  </div>
                </div>
                <br>
                <div class="row justify-content-md-between">
                  <div class="col-lg-6 col-md-5 mt-auto">
                    <div class="row mt-md-5 mt-4 text-md-end text-start" style="text-align: left !important;">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">Invoice Number:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0">{{$row->id}}</h6>
                      </div>
                    </div>
                    <div class="row text-md-end text-start" style="text-align: left !important;">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">Invoice Issue Date:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0"><?php $originalDate = $row->created_at; echo date("d-m-Y", strtotime($originalDate)); ?></h6>
                      </div>
                    </div>
                    <div class="row text-md-end text-start" style="text-align: left !important;">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">Payment Mode:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0">{{$row->payment_type}}</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-2 mt-auto">
                    <div class="row mt-md-5 mt-4 text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">رة ر</h6>
                      </div>
                    </div>
                    <div class="row text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">ة اصدار ت</h6>
                      </div>
                    </div>
                    <div class="row text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">طريقة الدفع:نقد\اجل</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 text-start mt-5">
                    <img class="mb-2 w-25 p-2" src="../../../assets/img/logo-ct.png" alt="Logo">
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table text-right">
                        <thead class="bg-default">
                          <tr>
                            <th scope="col" class="pe-2 text-start ps-2">DESCRIPTION</th>
                            <th scope="col" class="pe-2">UNIT PRICE(SAR) </th>
                            <th scope="col" class="pe-2" colspan="2">QUANTITY</th>
                            <th scope="col" class="pe-2">SUB-TOTAL</th>
                          </tr>
                        </thead>
                        <tbody><?php $item=DB::table('tbl_invoiceOrderItemTable')->join('tbl_product','tbl_product.id','=','tbl_invoiceOrderItemTable.item_id')->where('tbl_invoiceOrderItemTable.order_id',$row->id)->get(); ?>
                        @foreach($item as $value)
                          <tr>
                            <td class="text-start">{{$value->product_name}}</td>
                            <td class="ps-4">{{$value->price}}</td>
                            <td class="ps-4" colspan="2">{{$value->order_item_quantity}}</td>
                            <td class="ps-4">{{$value->order_item_final_amount}}</td>
                          </tr>@endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th></th>
                            <th class="h6 ps-4" colspan="2">Sub-Total الاجمالي ا</th>
                            <th colspan="1" class="text-right h6 ps-4">{{$row->order_total_before_tax}}</th>
                          </tr>
                          <tr>
                            <th></th>
                            <th></th>
                            <th class="h6 ps-4" colspan="2">Discount الخصم </th>
                            <th colspan="1" class="text-right h6 ps-4">{{$row->order_amount_paid}}</th>
                          </tr>
                          <tr>
                            <th></th>
                            <th></th>
                            <th class="h6 ps-4" colspan="2">VAT-{{$row->order_total_tax}}% ض</th>
                            <th colspan="1" class="text-right h6 ps-4">{{$row->order_tax_per}}</th>
                          </tr>
                          <tr>
                            <th></th>
                            <th></th>
                            <th class="h6 ps-4" colspan="2">GRAND TOTAL الاجمالي المبلغ </th>
                            <th colspan="1" class="text-right h6 ps-4">SAR {{$row->order_total_amount_due}}</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer mt-md-5 mt-4">
                <div class="row">
                  <div class="col-lg-6 text-left">
                    <h5>Remarks</h5>
                    <p class="text-secondary text-sm">Item received in good condition<br>Item sold not returnable & replicable
                    <br>Warranty does not cover ink, toner & consumable 
                    <br>items</p>
                    <p class="text-secondary text-sm"> </p>
                    <h6 class="text-secondary mb-0">
                      Salesman Signature
                      <span class="text-dark">توقيع البايع</span>
                    </h6>
                  </div>
                  <div class="col-lg-6  text-md-end">
                    <h5>ملاحظات</h5>
                    <p class="text-secondary text-sm">1 تم الاستلام البضاعةبصورة سليمة
                    <br>2 البضاعةالمباع لا تردولاتستبدل
                    <br>3 الضمان لا يشمل الاحبارولاصناف الاستهلاكية</p>
                    <p class="text-secondary text-sm"> </p>
                    <h6 class="text-secondary mb-0">
                      Received BY  
                      <span class="text-dark">توقيع المستلم</span>
                    </h6>
                  </div>
                </div><br>
                 <div class="row">
                  <div class="col-lg-6 text-left">
                    <p class="text-secondary text-sm">Makkah - Al Nowariyah
                    <br>Opposite Petrol Punp Al Nowariyah
                    <br>General Street Telefax: 5206588</p>
                  </div>
                  <div class="col-lg-6  text-md-end">
                    <p class="text-secondary text-sm">
                    مكة المكرمة-النورية-مقابل محطة النورية
                    
                    <br/>   الشارع العام تيليفاكس  5206588
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-7 text-md-end mt-md-0 mt-3">
                    <button class="btn bg-gradient-info mt-lg-7 mb-0" onClick="window.print()" type="button" name="button">Print</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../../../assets/js/core/popper.min.js"></script>
  <script src="../../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Kanban scripts -->
  <script src="../../../assets/js/plugins/dragula/dragula.min.js"></script>
  <script src="../../../assets/js/plugins/jkanban/jkanban.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../../assets/js/soft-ui-dashboard.min.js?v=1.0.4"></script>
</body>

</html>