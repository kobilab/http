<?php

	namespace KobiLab\Http\Controllers\Orders;

	use Illuminate\Routing\Controller;

	use KobiLab\Orders;
	use KobiLab\Companies;
	/**
	 * Siparişlerle alakalı işlemleri yapan sınıf
	 * @see tamamlanmamış, tamamlanmış gibi seçenekler eklenebilir
	 */
	class OrdersController extends Controller
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
				'second'=> 'orders'
			];
		}

		/**
		 * Siparişleri listeleme sayfasını derlemeye yarayan method
		 * 
		 * @return view
		 */
		public function index()
		{
			$this->data['orders'] = Orders::all();
			$this->data['third'] = 'accordingToOrders';

			return view('zahmetsizce::orders.orders.list', $this->data);
		}
		
		/**
		 * Sipariş oluşturmak için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @return view
		 */
		public function create()
		{
			$this->data['companies'] = Companies::all();

			return view('zahmetsizce::orders.orders.create', $this->data);
		}

		/**
		 * Siparişi veritabanına eklemeye yarayan method
		 * 
		 * @return redirect
		 */
		public function store()
		{
			$result = Orders::setFromAllInput()->setRulesForTable('orders');

			if (!$result->autoCreate()) {
				return redirectTo('newOrder');
			} else {
				return redirectTo('orders');
			}
		}

		/**
		 * Siparişi incelemek için sayfayı derleyen method
		 * 
		 * @param  integer $siparisId Sipariş Id
		 * @return view
		 */
		public function show($orderId)
		{
			$this->data['detail'] = Orders::find($orderId);

			return view('zahmetsizce::orders.orders.show', $this->data);
		}

		/**
		 * Siparişi düzenlemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @param  integer $siparisId Sipariş Id
		 * @return view
		 */
		public function edit($orderId)
		{
			$this->data['detail'] = Orders::find($orderId);
			$this->data['companies'] = Companies::all();

			return view('zahmetsizce::orders.orders.edit', $this->data);
		}

		/**
		 * Siparişi veritabanında düzenleme işlemini yapan method
		 * 
		 * @param  integer $siparisId Sipariş Id
		 * @return redirect
		 */
		public function update($orderId)
		{
			$result = Orders::setFromAllInput()->setId($orderId)->setRulesForTable('orders');

			if (!$result->autoUpdate()) {
				return redirectTo('editOrder', $orderId);
			} else {
				return redirectTo('orders');
			}
		}

		/**
		 * Siparişi veritabanından silmeye yarayan method
		 *
		 * @param  integer $siparisId Sipariş Id
		 * @return redirect
		 */
		public function delete($orderId)
		{
			Orders::delete($orderId);

			return redirectTo('orders');
		}


	}
