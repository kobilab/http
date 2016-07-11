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
				'second'=> 'companies'
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
			return view('customers.companies.create', $this->data);
		}
		
		/**
		 * Müşteriyi veritabanına kontrol ettikten sonra eklemeye yarayan method
		 * 
		 * @return redirect
		 */
		public function store()
		{
			$veriler = [
				'company_code'	=> Input::get('companyCode'),
				'name'			=> Input::get('name')
			];

			$kurallar = [
				'company_code'	=> 'required|max:16|min:1|unique:companies,company_code,NULL,id,deleted_at,NULL',
				'name'			=> 'required|max:128|min:3'
			];

			$okunakli = [
				'company_code'	=> 'Müşteri kodu',
				'name'			=> 'Müşteri adı'
			];

			$validator = Validator::make($veriler, $kurallar);
			$validator->setAttributeNames($okunakli);

			if ($validator->fails()) {
				Messages::error($validator->errors()->all());

				return redirect()
						->route('newCompany')
						->withMessages(Messages::all())
						->withInput(Input::all());
			} else {
				Companies::create($veriler);
				
				Messages::success('Müşteri eklendi.');

				return redirect()
						->route('companies')
						->withMessages(Messages::all());
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

			return view('customers.companies.edit', $this->data);
		}

		/**
		 * Müşteriyi veritabanında güncellemesini yapan method
		 * 
		 * @param  integer $musteriId Müşteri Id
		 * @return redirect
		 */
		public function update($companyId)
		{
			$veriler = [
				'company_code'	=> Input::get('companyCode'),
				'name'			=> Input::get('name')
			];

			$kurallar = [
				'company_code'	=> 'required|max:16|min:1|unique:companies,company_code,'.$companyId.',id,deleted_at,NULL',
				'name'			=> 'required|max:128|min:3'
			];

			$okunakli = [
				'company_code'	=> 'Müşteri kodu',
				'name'			=> 'Müşteri adı'
			];

			$validator = Validator::make($veriler, $kurallar);
			$validator->setAttributeNames($okunakli);

			if ($validator->fails()) {
				Messages::error($validator->errors()->all());

				return redirect()
						->route('editCompany', $companyId)
						->withMessages(Messages::all())
						->withInput(Input::all());
			} else {
				Companies::find($companyId)->update($veriler);
				
				Messages::success('Müşteri düzenlendi.');

				return redirect()
						->route('companies')
						->withMessages(Messages::all());
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

			return view('customers.companies.show', $this->data);
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

			Messages::success('Müşteri silindi.');

			return redirect()
					->route('companies')
					->withMessages(Messages::all());
		}
		
	}
