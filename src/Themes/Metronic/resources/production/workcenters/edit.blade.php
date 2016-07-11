@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> İş İstasyonu Düzenle </h3>
<div class="row">
	<div class="col-md-12">
		{{open(['editWorkCenter', $detail['id']])}}
			<div class="form-body">
				{{text('İş İstasyonu Adı', 'title', $detail['title'])}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{submit('Düzenle')}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Rota Düzenle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Ürünler & Üretim', '#'],
	['İş İstasyonları', 'workCenters'],
	[$detail['title']. ' Düzenle']
])}}
@endsection