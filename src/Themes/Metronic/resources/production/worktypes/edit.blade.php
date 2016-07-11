@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Operasyon Düzenle </h3>
<div class="row">
	<div class="col-md-12">
		{{open(['editWorkType', $detail['id']])}}
			<div class="form-body">
				{{text('Operasyon Adı', 'title', $detail['title'])}}
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
	Operasyon Düzenle
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Ürünler & Üretim', '#'],
	['Operasyonlar', 'workTypes'],
	[$detail['title']. ' Düzenle']
])}}
@endsection