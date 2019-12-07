<!-- jQuery 2.2.3 -->
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- page script -->
<script>
  function remove(id)
  {
    var confir = confirm('Anda yakin?');
    if(confir){
      $('#id').val(id);
      $('#delete').submit();
    }
  }
  function reset(id)
  {
    var confir = confirm('Anda yakin?');
    if(confir){
      $('#id2').val(id);
      $('#reset').submit();
    }
  }
  function restore(id)
  {
    var confir = confirm('Anda yakin?');
    if(confir){
      $('#restoreid').val(id);
      $('#restore').submit();
    }
  }
  function reset2()
  {
    var confir = confirm('Anda yakin?');
    if(confir){
      $('#reset2').submit();
    }
  }
  function logout()
  {
    $('#logout').submit();
  }
  function products(url)
  {
    window.location = url;
  }
  function replace(string)
  {
    if(string.includes('/')){
      string = string.replace('/','-');
      string = replace(string);
    }
    return string;
  }
  function to(url)
  {
    if(url.includes('/20'))
      url = replace(url);
    window.location = url;
  }
  function filter(url)
  {
    var month = $('#month').val();
    var year = $('#year').val();
    window.location = url+'/'+month+'/'+year;
  }
  function profile()
  { 
    $('#profileModal').modal();
  }
  function avatar()
  { 
    $('#avatarModal').modal();
  }
  function pass()
  { 
    $('#passwordModal').modal();
  }
  function checkimage(v)
  {
    if(v!='' && !(v.includes('.png') || v.includes('.jpg'))){
      alert('Harus ekstensi .png atau .jpg');
      $('#avatar').val("");
    }
  }
  function checkprice(url)
  {
    console.log($('#transaction').serialize());
    $.ajax({
      type:'post',
      url:url,
      data:$('#transaction').serialize(),
      success:function(Response){
        console.log(Response);
        // var Response = Response;
        var table = '<table class="table table-bordered table-striped"><thead><th>No</th><th>Produk</th><th>Harga (Rp)</th><th>Qty</th><th>Sub Total (Rp)</th></thead><tbody>';
        var table2 = '<table class="table table-bordered table-striped"><thead><th>No</th><th>Produk</th><th>Stok</th></thead><tbody>';
        var no = 0;
        var total = 0;
        for(r in Response){
          var subtotal = Response[no].quantity*Response[no].price;
          table += '<tr><td>'+(no+1)+'</td><td>'+Response[no].name+'</td><td class="text-right">'+Response[no].price+'</td><td>'+Response[no].quantity+'</td><td class="text-right">'+subtotal+'</td></tr>';
          table2 += '<tr><td>'+(no+1)+'</td><td>'+Response[no].name+'</td><td>'+Response[no].stock+'</td></tr>';
          total += subtotal;
          no++;
        }
        table += '<tr><td colspan="4" class="text-right"><strong>Total (Rp)</strong></td><td class="text-right">'+total+'</td></tr><tr><td colspan="4" class="text-right"><strong>Pembayaran (Rp)</strong></td><td class="text-right">'+$('#payin').val()+'</td></tr><tr><td colspan="4" class="text-right"><strong>Kembalian (Rp)</strong></td><td class="text-right">'+($('#payin').val()-total)+'</td></tr></tbody></table>';
        table2 += '</tbody></table>'
        $('#struct').html(table);
        $('#productstatus').html(table2);
      }
    });
  }
  function barcodeadd()
  {
    $('#barcodeDiv').append(
      '<div class="form-group">'+
        '<div class="row brc">'+
          '<div class="col-md-5">'+
            '<label for="barcode">Barcode</label>'+
            '<input type="number" min="1000000000" class="form-control" id="barcode" placeholder="Masukkan Barcode" name="barcode[]" required> '+ 
          '</div>'+
          '<div class="col-md-5">'+
            '<label for="quantity">Kuantitas</label>'+
            '<input type="number" min="1" class="form-control" id="quantity" placeholder="Masukkan Kuantitas" name="quantity[]" required>'+
          '</div>'+
          '<div class="col-md-2">'+
            '<label>Aksi</label>'+
            '<a class="form-control btn btn-default" onclick="barcoderemove(this)"><i class="fa fa-remove"></i></button>'+
          '</div>'+
        '</div>'+
      '</div>');
  }
  function barcoderemove(el)
  {
    $(el).parent().parent().parent().remove();
  }
  function transactiondetail(url)
  {
    $.ajax({
      url:url,
      data:{
        '_token': '{{csrf_token()}}' 
      },
      type:'post',
      success:function(Response){
        var tbody = '';
        for(var i=0; i<Response.length; i++){
          tbody += 
            '<tr>'+
              '<td>'+(i+1)+'</td>'+
              '<td>'+Response[i].name+'</td>'+
              '<td>'+Response[i].price+'</td>'+
              '<td>'+Response[i].sell_price+'</td>'+
              '<td>'+(Response[i].sell_price-Response[i].price)+'</td>'+
              '<td>'+Response[i].quantity+'</td>'+
            '</tr>'
        }
        $('.detail-body').html(tbody);
        $('#transactionModal').modal();
      }
    })
  }
  @stack('script')
    $(function () {
      $('#birthdate').datepicker({
        autoclose: true
      });
      $(".select2").select2();
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
      $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>