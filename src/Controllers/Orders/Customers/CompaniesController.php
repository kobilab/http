<?php

	namespace KobiLab\Http\Controllers\Orders\Customers;


	use Illuminate\Routing\Controller;

	use KobiLab\Companies;

	/**
	 * Müşterilerle alakalı işlemleri yapan sınıf
	 */
	class CompaniesController extends Controller
	{

		/**
		 * Sınıf içerisinde dolaşacak veriler
		 * 
		 * @var array
		 */
		var $data = [];

		public function __construct() {
			$this->data['theme'] = [
				'first'	=> 'crm',
				'second'=> 'company'
			];
		}

		/**
		 * Müşterileri listelemeye yarayan method
		 * 
		 * @return view
		 */
		public function index()
		{
			$this->data['companies'] = Companies::all();

			return view('zahmetsizce::orders.customers.list', $this->data);
		}

		/**
		 * Müşteri eklemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @return view
		 */
		public function create()
		{
			return view('zahmetsizce::orders.customers.create', $this->data);
		}
		
		/**
		 * Müşteriyi veritabanına kontrol ettikten sonra eklemeye yarayan method
		 * 
		 * @return redirect
		 */
		public function store()
		{
			$result = Companies::setFromAllInput()->setRulesForTable('companies');

			if(!$result->autoCreate()) {
				return redirectTo('newCompany')->withErrors($result->errors());
			} else {
				return redirectTo('companies');
			}
		}

		/**
		 * Müşteriyi düzenlemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @param  integer $musteriId Müşteri Id
		 * @return view
		 */
		public function edit($companyId)
		{
			$this->data['detail'] = Companies::find($companyId);

			return view('zahmetsizce::orders.customers.edit', $this->data);
		}

		/**
		 * Müşteriyi veritabanında güncellemesini yapan method
		 * 
		 * @param  integer $musteriId Müşteri Id
		 * @return redirect
		 */
		public function update($companyId)
		{
			$result = Companies::setFromAllInput()->setId($companyId)->setRulesForTable('companies');

			if (!$result->autoUpdate()) {
				return redirectTo('editCompany', $companyId);
			} else {
				return redirectTo('companies');
			}
		}

		/**
		 * Müşteri inceleme sayfasını derlemeye yarayan method
		 * 
		 * @param  integer $musteriId Müşteri Id
		 * @return view
		 */
		public function show($companyId)
		{
			$this->data['detail'] = Companies::find($companyId);

			return view('zahmetsizce::orders.customers.show', $this->data);
		}
		
		/**
		 * Müşteriyi veritabanından kaldıran method
		 * 
		 * @param  integer $musteriId Müşteri Id
		 * @return redirect
		 */
		public function delete($companyId)
		{
			Companies::find($companyId)->delete();

			return redirectTo('companies');
		}
		
	}
