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
						<thead>
							<tr>
								<th>İş İstasyon Adı</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							@foreach($detail->getStations as $e)
								<tr>
									<td>{{$e->getWorkCenter['title']}}</td>
									<td><a href="{{route('removeConnectionWorkTypeWorkCenter', $e['id'])}}">Kaldır</a></td>
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
				 <a data-toggle="modal" href="#sil">
				 	<i class="icon-trash"></i> Sil </a>
			</li>
			<li>
				<a href="{{route('editWorkType', $detail['id'])}}">
					<i class="icon-bell"></i> Düzenle </a>
			</li>
			<li>
				<a href="{{route('defineWorkTypeToRoute', $detail['id'])}}">
					<i class="icon-star"></i> Operasyon Tanımla </a>
		   	</li>
			<li>
				<a href="{{route('defineBomToRoute', $detail['id'])}}">
					<i class="icon-star"></i> Ürün Ağacına Bağla </a>
		   	</li>
		</ul>
	</div>
</div>
{{modal('sil', 'deleteRoute', $detail['id'])}}
@endsection