@extends('zahmetsizce::themes.main')

@set('datatablesContent', true)

@section('content')
<h3 class="page-title"> Lotlar </h3>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
			{{tableTitles(['Lot Kodu', 'Parça Adı', 'Kaç Adet', 'İşlemler'])}}
			<tbody>
				@foreach($lots as $lot)
					<tr>
						<td>{{$lot['lot_code']}}</td>
						<td>{{$lot->getPart['title']}}</td>
						<td>{{numberFormat($lot['quantity'])}} {{$lot->getPart->getUnit['short_form']}}</td>
						<td>
							{{buttonGroup('İşlemler', [
								showLink('showLot', $lot['id']),
								deleteLink('sil'.$lot['id'], null, true)
							])}}
						</td>
					</tr>
					{{modal('sil'.$lot['id'], 'deleteLot', $lot['id'])}}
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('title')
	Lotlar
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Depo', '#'],
	['Lotlar']
])}}
@endsection

@section('ekjs')
<script type="text/javascript">
var TableDatatablesManaged = function () {

	var initTable1 = function () {

		var table = $('#sample_1');

		// begin first table
		table.dataTable({

			// Internationalisation. For more info refer to http://datatables.net/manual/i18n
			"language": {
			   url: '{{asset('assets/global/scripts/datatable.json')}}'
			},

			// Or you can use remote translation file
			//"language": {
			//   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
			//},

			// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
			// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
			// So when dropdowns used the scrollable div should be removed. 
			//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

			"columnDefs": [{
				"targets": 3,
				"orderable": false,
				"searchable": false
			}],

			"lengthMenu": [
				[5, 15, 25, -1],
				[5, 15, 25, "All"] // change per page values here
			],
			// set the initial value
			"pageLength": 15,			
			"pagingType": "bootstrap_full_number",
			"order": [
				[1, "asc"]
			] // set first column as a default sort by asc
		});

	}

	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initTable1();
		}

	};

}();

if (App.isAngularJsApp() === false) { 
	jQuery(document).ready(function() {
		TableDatatablesManaged.init();
	});
}
</script>
@endsection


@section('pageToolBar')
<div class="page-toolbar">
	<div class="btn-group pull-right">
		<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> İşlemler
			<i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>
				{{newLink('Lot', 'newLot')}}
			</li>
		</ul>
	</div>
</div>
@endsection