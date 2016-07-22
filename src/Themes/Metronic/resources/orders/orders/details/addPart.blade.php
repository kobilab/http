@extends('zahmetsizce::themes.main')

@section('boxBodyClass') form @endsection

@section('content')
	{{open(['addPartToOrder', $detail['id']])}}
		<div class="form-body">
			{{select(trans('e.part'), 'partId', listThem($parts, 'id', 'title'))}}
			{{text(trans('e.quantity'), 'quantity')}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('add'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	{{trans('e.addPartToOrder')}}
@endsection