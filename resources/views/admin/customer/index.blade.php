@extends('admin.master')
@section('title')
    Customers
@endsection

@section('header')
{!! Html::style('admin/plugins/datatables/dataTables.bootstrap.css') !!}
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Customers</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row ">
    <div class="col-xs-6">
      <span style="font-weight: bold;font-size: 21px;">Customers</span>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
      <table class="table table-striped .table-responsive " id="data">
        <thead>
          <tr>
            <th> # </th>
            <th> Name </th>
            <th> Email Address </th>
            <th> Company </th>
            <th> Phone </th>
            <th> Country </th>
            <th> City </th>
            <th> Address 1 </th>
            <th> Address 2 </th>
            <th>State</th>
              <th> ZIP</th>
            <th> view </th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <div>
    </div>
    </div>
  </div>
</section>

@endsection
@section('footer')
{!! Html::script('admin/plugins/datatables/jquery.dataTables.min.js')!!}
{!! Html::script('admin/plugins/datatables/dataTables.bootstrap.min.js')!!}
<script type="text/javascript">

var lastIdx = null;

var table = $('#data').DataTable({
    processing: true,//line for loading
    serverSide: true,//use ajax and send requests to server
    ajax: "{{ url('/admin/customers/data') }}",//url get all data
    columns: [// the number of columns you have
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'company', name: 'company'},
        {data: 'phone', name: 'phone'},
        {data: 'country', name: 'country'},
        {data: 'city', name: 'city'},
        {data: 'address1', name: 'address1'},
        {data: 'address2', name: 'address2'},
          {data: 'state', name: 'state'},
          {data: 'zip', name: 'zip'},
        {data: 'view', name: 'view'},
    ],
    "language": {
      //if use english get another link
        "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/English.json"
    },
    "stateSave": false,
    "responsive": true,
    "order": [[0, 'desc']],
    "pagingType": "full_numbers",
    aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    iDisplayLength: 25,
    fixedHeader: true,

    "oTableTools": {
        "aButtons": [
            {
                "sExtends": "csv",
                "sButtonText": "ملف اكسل",
                "sCharSet": "utf16le"
            },
            {
                "sExtends": "copy",
                "sButtonText": "نسخ المعلومات",
            },
            {
                "sExtends": "print",
                "sButtonText": "طباعة",
                "mColumns": "visible",


            }
        ],

        "sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf"
    },

    "dom": '<"pull-left text-left" T><"pullright" i><"clearfix"><"pull-right text-right col-lg-6" f > <"pull-left text-left" l><"clearfix">rt<"pull-right text-right col-lg-6" pi > <"pull-left text-left" l><"clearfix"> '
    ,initComplete: function ()
    {
        var r = $('#data tfoot tr');
        r.find('th').each(function(){
            $(this).css('padding', 8);
        });
        $('#data thead').append(r);
        $('#search_0').css('text-align', 'center');
    }

});

table.columns().eq(0).each(function(colIdx) {
    $('input', table.column(colIdx).header()).on('keyup change', function() {
        table
                .column(colIdx)
                .search(this.value)
                .draw();
    });
});

table.columns().eq(0).each(function(colIdx) {
    $('select', table.column(colIdx).header()).on('change', function() {
        table
                .column(colIdx)
                .search(this.value)
                .draw();
    });

    $('select', table.column(colIdx).header()).on('click', function(e) {
        e.stopPropagation();
    });
});
$('#data tbody')
        .on( 'mouseover', 'td', function () {
            var colIdx = table.cell(this).index().column;

            if ( colIdx !== lastIdx ) {
                $( table.cells().nodes() ).removeClass( 'highlight' );
                $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
            }
        } )
        .on( 'mouseleave', function () {
            $( table.cells().nodes() ).removeClass( 'highlight' );
        } );
 </script>

@endsection
