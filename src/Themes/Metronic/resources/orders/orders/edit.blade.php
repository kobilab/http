@extends('zahmetsizce::themes.main')

@section('boxBodyClass') form @endsection

@section('content')
	{{open(['editOrder', $detail['id']])}}
		<div class="form-body">
			{{text(trans('e.orderCode'), 'order_code', $detail['order_code'])}}
			{{select(trans('e.company'), 'company_id', listThem($companies, 'id', 'name'), $detail['company_id'])}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.edit'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	{{trans('e.editOrder')}}
@endsection