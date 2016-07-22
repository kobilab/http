@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Yeni İş İstasyonu </h3>
<div class="row">
	<div class="col-md-12">
		{{open('newWorkCenter')}}
			<div class="form-body">
				{{text('İş İstasyonu Adı', 'title')}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{submit('Ekle')}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Yeni İş İstasyonu
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['İş İstasyonları', 'workCenters'],
	['Yeni']
])}}
@endsection