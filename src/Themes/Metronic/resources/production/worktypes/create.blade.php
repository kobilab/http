@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Yeni Operasyon </h3>
<div class="row">
	<div class="col-md-12">
		{{open('newWorkType')}}
			<div class="form-body">
				{{text('Operasyon Adı', 'title')}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{addButton()}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Yeni Operasyon
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Operasyonlar', 'workTypes'],
	['Yeni']
])}}
@endsection