<?php

	namespace KobiLab\Http\Controllers\Production\WorkTypes;

	use Illuminate\Routing\Controller;

	use KobiLab\WorkTypes;

	/**
	 * Üretim rotasyonları ile ilgili işlemleri yapan sınıf
	 */
	class WorkTypesController extends Controller
	{

		/**
		 * Sınıf içerisinde dolaşacak veriler
		 * 
		 * @var array
		 */
		var $data = [];

		public function __construct() {
			$this->data['theme'] = [
				'first'	=> 'production',
				'second'=> 'operation'
			];
		}

		/**
		 * Rotasyonları listeleyen method
		 * 
		 * @return view
		 */
		public function index()
		{
			$this->data['routes'] = WorkTypes::all();

			return view('zahmetsizce::production.worktypes.list', $this->data);
		}
		
		/**
		 * Rotasyon eklemek için gerekli olan sayfayı derleyen method
		 * 
		 * @return view
		 */
		public function create()
		{
			return view('zahmetsizce::production.worktypes.create', $this->data);
		}
		
		/**
		 * Rotasyon eklemek için gerekli kontrolleri yapan ve ekleyen method
		 * 
		 * @return redirect
		 */
		public function store()
		{
			$result = WorkTypes::setFromAllInput()->autoCreate();

			if (!$result) {
				return redirectTo('newWorkType');
			} else {
				return redirectTo('workTypes');
			}
		}

		/**
		 * Rotasyon düzenlemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return view
		 */
		public function edit($routeId)
		{
			$this->data['detail'] = WorkTypes::find($routeId);

			return view('zahmetsizce::production.worktypes.edit', $this->data);
		}
		
		/**
		 * Rotasyonu veritabanında düzenleyen method
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return redirect
		 */
		public function update($routeId)
		{
			$result = WorkTypes::setId($routeId)->setFromAllInput()->autoUpdate();

			if (!$result) {
				return redirectTo('editWorkType', $routeId);
			} else {
				return redirectTo('workTypes');
			}
		}
		
		/**
		 * Rotasyon inceleme sayfasını derleyen mehod
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return view
		 */
		public function show($routeId)
		{
			$this->data['detail'] = WorkTypes::find($routeId);

			return view('zahmetsizce::production.worktypes.show', $this->data);
		}
		
		/**
		 * Rotasyon silme işlemini yapan method
		 * 
		 * @param  integer $rotaId Rotasyon Id
		 * @return redirect
		 */
		public function delete($routeId)
		{
			WorkTypes::find($routeId)->delete();

			return redirect()
					->route('workTypes');
		}

	}
