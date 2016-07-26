@extends('zahmetsizce::themes.main')

@set('datatablesContent', true)

@section('content')
<h3 class="page-title"> Üretim Emri İçin Gerekli Olan Parça Detayları </h3>
	<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
		{{tableTitles(['Parça', 'Gereken Adet', 'Ayırtılan Adet', 'Açıklama', 'Alt Parçaları', 'İşlemler'])}}
		<tbody>
			@foreach($gerekenMalzemeler as $partId => $value)
				@foreach($value as $k)
					@if($k['is_lower_part']==1)
						<tr>
							<td>{{$k->getPart['title']}}</td>
							<td>{{numberFormat($k['quantity'])}}</td>
							<td>{{numberFormat($k['reserved'])}}</td>
							<td>
								@if($partId==0)
									Ana Parça
								@endif
							</td>
							<td>
								@foreach($k->productionOrderId($detail['id'])->partId($k['part_id'])->get() as $key => $e)
									{{$e->getPart['title']}}
									@if(isset($k->productionOrderId($detail['id'])->partId($k['part_id'])->get()[$key+1]))
										,
									@endif
								@endforeach
							</td>
							<td>
								@if($k['remainder']>0)
									@if($k->getAvailableLots->count()>0)
										{{buttonGroup('İşlemler', [
											'<a href="'.route('consumeProductionNeededParts', $k['id']).'">Tüket</a>'
										])}}
									@else
										Depoda tanımlı parça yok
									@endif
								@else
									Tamamlandı
								@endif
							</td>
						</tr>
					@else
						<tr>
							<td>{{$k->getPart['title']}}</td>
							<td>{{numberFormat($k['quantity'])}}</td>
							<td>{{numberFormat($k['reserved'])}}</td>
							<td>
								Üretimin Alt Parçası
							</td>
							<td>
								@foreach($k->productionOrderId($detail['id'])->partId($k['part_id'])->get() as $key => $e)
									{{$e->getPart['title']}}
									@if(isset($k->productionOrderId($detail['id'])->partId($k['part_id'])->get()[$key+1]))
										,
									@endif
								@endforeach
							</td>
							<td>
							   <div class="btn-group">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
										<i class="fa fa-angle-down"></i>
									</button>
										<ul class="dropdown-menu" role="menu">
										<li>
											@if($k['remainder']>0)
												@if($k->getAvailableLots->count()>0)
													<a href="{{route('consumeProductionNeededParts', $k['id'])}}">Tüket</a>
												@else
													Depoda tanımlı parça yok
												@endif
											@else
												Tamamlandı
											@endif
										</li>
									</ul>
								</div>
							</td>
						</tr>
					@endif
				@endforeach
			@endforeach
		</tbody>
	</table>
	<h3>Yapılacak işlemler</h3>
	<table class="table table-bordered">
		{{tableTitles(['Operasyon', 'İstasyon', 'Kalan Adet', 'İşlemler'])}}
		<tbody>
			@foreach($islemler as $partId => $value)
				<tr>
					<th colspan="4">{{$value[0]->getPart['title']}} Parçası İçin Yapılacak İşlemler</th>
				</tr>
				@foreach($value as $k)
					<tr>
						<td>{{$k->getWorkType['title']}}</td>
						<td>
							@if($k->getWorkCenter['title']!==null)
								{{$k->getWorkCenter['title']}}
							@else
								-
							@endif
						</td>
						<td>{{numberFormat($k['remainder'])}}</td>
						<td>
							@if($k['status']==1)
							   <div class="btn-group">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
										<i class="fa fa-angle-down"></i>
									</button>
										<ul class="dropdown-menu" role="menu">
										<li>
											<a href="{{route('finishProductionRotation', $k['id'])}}">Tamamla</a>
										</li>
										<li>
											<a data-toggle="modal" href="#{{$k['id']}}"><i class="icon-trash"></i> İş İstasyonu Tanımla </a>
										</li>
										<li>
											<a data-toggle="modal" href="#{{$k['id']}}isinbikismi"><i class="icon-trash"></i> İşin Bir Kısmını Tamamla </a>
										</li>
									</ul>
								</div>
							@else
								Tamamlandı
							@endif
						</td>
					</tr>
						<div id="{{$k['id']}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">İş İstasyonu Tanımla</h4>
									</div>
									<div class="modal-body">
										<p>
										{{open(['defineWorkCenterForManufacturing', $k['id']])}}
											{{Form::select('workCenterId', $k['stations'], $k['work_center_id'], ['class' => 'form-control'])}}
										
										</p>
									</div>
									<div class="modal-footer">
										{{submit('Ata')}}
										{{close()}}
									</div>
								</div>
							</div>
						</div>
						<div id="{{$k['id']}}isinbikismi" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">İş İstasyonu Tanımla</h4>
									</div>
									<div class="modal-body">
										<p>
										{{open(['isinBiKisminiYap', $k['id']])}}
											{{Form::text('remainder', $k['remainder'], ['class' => 'form-control'])}}
										
										</p>
									</div>
									<div class="modal-footer">
										{{submit('Ata')}}
										{{close()}}
									</div>
								</div>
							</div>
						</div>
				@endforeach
			@endforeach
		</tbody>
	</table>
	<h3>Üretim Sonucu Oluşacak Parçalar</h3>
	<table class="table table-bordered">
		{{tableTitles(['Parça', 'Adet'])}}
		<tbody>
			@foreach($olusacaklar as $e)
				<tr>
					<td>{{$e->getPart['title']}}</td>
					<td>{{numberFormat($e['quantity'])}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('title')
	{{$detail['production_order_code']}} Kodlu Üretim Emri
@endsection

@section('ekjs')
<script type="text/javascript">
var TableDatatablesManaged = function () {

	var initTable1 = function () {

		var table = $('#sample_1');

		// begin first table
		table.dataTable({

			// Or you can use remote translation file
			"language": {
			   url: '{{asset('assets/global/scripts/datatable.json')}}'
			},

			// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
			// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
			// So when dropdowns used the scrollable div should be removed. 
			//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

			"columnDefs": [{
				"targets": 5,
				"orderable": false,
				"searchable": false
			},
			{
				"targets": [0,1,2,3,4],
				"orderable": false
			}
			],

			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"pageLength": -1
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

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Emirleri', 'productionOrders'],
	[$detail['production_order_code']]
])}}
@endsection

@section('pageToolBar')
<div class="page-toolbar">
	<div class="btn-group pull-right">
		<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> İşlemler
			<i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>
				{{deleteLink('sila', null, true)}}
			</li>
			<li>
				{{editLink('editProductionOrder', $detail['id'])}}
			</li>
		</ul>
	</div>
</div>
{{modal('sila', 'deleteProductionOrder', $detail['id'])}}
@endsection