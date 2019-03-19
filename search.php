<div class="row">
  <!-- <h6 class="p-3 font-weight-bold pt-3 rounded-pill bg-primary text-white"> -->
  <h4 class="p-3 font-weight-bold">
    <i class="fas fa-search"></i> ค้นหาข้อมูลลูกค้ารายสำคัญ
  </h4>
  <!-- </h6> -->
</div>
<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <table data-toggle="table" data-url="./api/datatable/fetch_ca_automatic.php">
      <thead>
        <tr>
          <th>#</th>
          <th data-field="CA"><i class="fas fa-indent"></i> หมายเลข CA</th>
          <th data-field="BP"><i class="fas fa-business-time"></i> หมายเลข BP</th>
          <th data-field="BP_NAME"><i class="fas fa-user-tie"></i> ชื่อ BP</th>
          <th data-field="quantity_purchase"><i class="fas fa-receipt"></i> จำนวนครั้งการซื้อธุรกิจเสริม</th>
          <th data-formatter="operateFormatter" data-events="operateEvents"><i class="fas fa-cogs"></i> จัดการ</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<script>
  function operateFormatter(value, row, index) {
    return [
      '<a class="like" href="javascript:void(0)" title="Like">',
      '<i class="fa fa-heart"></i>',
      '</a>  ',
      '<a class="remove" href="javascript:void(0)" title="Remove">',
      '<i class="fa fa-trash"></i>',
      '</a>'
    ].join('');
  }

  window.operateEvents = {
    'click .like': function (e, value, row, index) {
      console.log(e, value, row, index);
      alert('You click like action, row: ' + JSON.stringify(row))
    },
    'click .remove': function (e, value, row, index) {
      $("table").bootstrapTable('remove', {
        field: 'id',
        values: [row.id]
      })
    }
  }
</script>
<!-- <div class="dropdown-divider"></div> -->