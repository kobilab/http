	@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Operasyon İncele </h3>
	<table class="table table-bordered">
		<tr>
			<th>Operasyon Adı</th>
			<td>{{$detail['title']}}</td>
		</tr>
		<tr>
			<th>Operasyonun Yapıldığı İstasyonlar</th>
			<td>
				@if($detail->getStations->count()>0)
					<table class="table table-bordered">
						{{tableTitles(['İş İstasyonu Adı', 'İşlemler'])}}
						<tbody>
							@foreach($detail->getStations as $e)
								<tr>
									<td>{{$e->getWorkCenter['title']}}</td>
									<td>{{createLink('Kaldır', 'removeConnectionWorkTypeWorkCenter', $e['id'], 'unlink')}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					Operasyonun yapıldığı herhangi bir is istasyonu yok.
				@endif
			</td>
		</tr>
	</table>
@endsection

@section('title')
	Operasyon Detayları
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Operasyonlar', 'workTypes'],
	[$detail['title'], 'showWorkType', $detail['id']],
	['Düzenle']
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
				{{editLink('editWorkType', $detail['id'])}}
			</li>
			<li>
				{{showLink('showWorkType', $detail['id'])}}
			</li>

			<li class="divider"> </li>
			<li>
				{{createLink('Operasyon İstasyonu Tanımla', 'defineWorkCenterToWorkType', $detail['id'], 'link')}}
			</li>
			<li>
				{{createLink('İşleri', 'manufacturingOfJob', $detail['id'], 'star')}}
			</li>
			<li>
				{{deleteLink('sil', null, true)}}
			</li>
			<li>
				{{createLink('Operasyon Tanımla', 'defineWorkTypeToRoute', $detail['id'], 'link')}}
		   	</li>
		</ul>
	</div>
</div>
{{modal('sil', 'deleteRoute', $detail['id'])}}
@endsection