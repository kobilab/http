@extends('zahmetsizce::themes.main')

@set('datatablesContent', true)

@section('content')
<h3 class="page-title"> Operasyonlar </h3>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
			{{tableTitles(['Operasyon Adı', 'İşlemler'])}}
			<tbody>
				@foreach($routes as $rota)
					<tr>
						<td>{{$rota['title']}}</td>
						<td>{{buttonGroup('İşlemler', [
							editLink('editWorkType', $rota['id']),
							showLink('showWorkType', $rota['id']),
							deleteLink('sil'.$rota['id'], null, true),
							'divider',
							createLink('Operasyon İstasyonu Tanımla', 'defineWorkCenterToWorkType', $rota['id'], 'link'),
							createLink('İşleri', 'manufacturingOfJob', $rota['id'], 'star')
						])}}</td>
					</tr>
					{{modal('sil'.$rota['id'], 'deleteWorkType', $rota['id'])}}
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('title')
	Operasyonlar
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Operasyonlar']
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
				"targets": 1,
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
				{{newLink('Operasyon', 'newWorkType')}}
			</li>
		</ul>
	</div>
</div>
@endsection