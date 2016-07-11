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
						<thead>
							<tr>
								<th>Operasyon Adı</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							@foreach($detail->getOperations as $e)
								<tr>
									<td>{{$e->getWorkType['title']}}</td>
									<td><a href="{{route('removeConnectionWorkTypeWorkCenter', $e['id'])}}">Kaldır</a></td>
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
	['Ürünler & Üretim', '#'],
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
				 <a data-toggle="modal" href="#sil">
				 	<i class="icon-trash"></i> Sil </a>
			</li>
			<li>
				<a href="{{route('editBom', $detail['id'])}}">
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