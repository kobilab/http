@extends('zahmetsizce::themes.main')

@section('boxBodyClass') form @endsection

@section('content')
	{{open('newOrder')}}
		<div class="form-body">
			{{text(trans('e.orderCod'), 'order_code')}}
			{{select(trans('e.company'), 'company_id', listThem($companies, 'id', 'name'))}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.add'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	{{trans('e.newOrder')}}
@endsection