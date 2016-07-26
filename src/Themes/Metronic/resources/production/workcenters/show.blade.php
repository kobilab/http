	@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> İş İstasyonu İncele </h3>
	<table class="table table-bordered">
		<tr>
			<th>İş İstasyonu Adı</th>
			<td>{{$detail['title']}}</td>
		</tr>
		<tr>
			<th>İş İstasyonunda Yapılan Operasyonlar</th>
			<td>
				@if($detail->getOperations->count()>0)
					<table class="table table-bordered">
						{{tableTitles(['Operasyon Adı', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getOperations as $e)
								<tr>
									<td>{{$e->getWorkType['title']}}</td>
									<td>{{createLink('Kaldır', 'removeConnectionWorkTypeWorkCenter', $e['id'], 'unlink')}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Tanımlanan herhangi bir operasyon yok
				@endif
			</td>
		</tr>
	</table>
@endsection

@section('title')
	İş İstasyonu İncele
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['İş İstasyonları', 'workCenters'],
	[$detail['title']]
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
				{{editLink('editWorkCenter', $detail['id'])}}
			</li>
			<li>
				{{deleteLink('sil', null, true)}}
			</li>
			<li>
				{{createLink('İşleri', 'manufacturingOfMachine', $detail['id'], 'star')}}
			</li>
		</ul>
	</div>
</div>
{{modal('sil', 'deleteWorkCenter', $detail['id'])}}
@endsection