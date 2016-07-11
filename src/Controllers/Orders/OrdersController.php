<?php

	namespace KobiLab\Http\Controllers\Orders;

	# Dış paketler
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\Routing\Controller;


	# Sistem içerisindeki tablolar
	use App\Tables\Parts;
	use App\Tables\Companies;
	use App\Tables\OrderDetails;
	use App\Tables\Orders;
	use App\Tables\Lots;

	# Sistem paketleri
	use App\Facades\Messages;
	use App\Facades\Transactions;

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
		public function orders()
		{
			$this->data['orders'] = Transactions::ordersToBeListOnOrdersPage();
			$this->data['third'] = 'accordingToOrders';

			return view('customers.orders.orders', $this->data);
		}

		/**
		 * Siparişleri Partse göre listeleme yarayan method
		 * 
		 * @return view
		 */
		public function parts()
		{
			$this->data['orders'] = Transactions::ordersToBeListAccordingToPartsOnOrdersPage();
			$this->data['third'] = 'accordingToParts';

			return view('customers.orders.items', $this->data);
		}
		
		/**
		 * Sipariş oluşturmak için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @return view
		 */
		public function create()
		{
			$this->data['companies'] = Transactions::getCompaniesForNewOrUpdateOrder();

			return view('customers.orders.create', $this->data);
		}

		/**
		 * Siparişi veritabanına eklemeye yarayan method
		 * 
		 * @return redirect
		 */
		public function store()
		{
			$result = Transactions::createNewOrder();

			if (!$result) {
				return redirectTo('newOrder');
			} else {
				return redirectTo('orders');
			}
		}

		/**
		 * Girilen siparişin Partsinin sistem içerisinde olup olmadığını kontrol etmeye yarayan ve listeleyen method
		 * 
		 * @param  integer $siparisId Sipariş Id
		 * @return view
		 */
		public function check($orderId)
		{
			$this->data['detail'] = Transactions::getOrder($orderId);
			$this->data['toplamlar'] = Transactions::checkOrderForAvailibleLot($orderId);

			return view('customers.orders.check', $this->data);
		}

		/**
		 * Siparişi incelemek için sayfayı derleyen method
		 * 
		 * @param  integer $siparisId Sipariş Id
		 * @return view
		 */
		public function show($orderId)
		{
			$this->data['detail'] = Transactions::getOrder($orderId);

			return view('customers.orders.show', $this->data);
		}

		/**
		 * Siparişi düzenlemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @param  integer $siparisId Sipariş Id
		 * @return view
		 */
		public function edit($orderId)
		{
			$this->data['detail'] = Transactions::getOrder($orderId);
			$this->data['companies'] = Transactions::getCompaniesForNewOrUpdateOrder();

			return view('customers.orders.edit', $this->data);
		}

		/**
		 * Siparişi veritabanında düzenleme işlemini yapan method
		 * 
		 * @param  integer $siparisId Sipariş Id
		 * @return redirect
		 */
		public function update($orderId)
		{
			$result = Transactions::editOrder($orderId);

			if (!$result) {
				return redirectTo('editOrder', $orderId);
			} else {
				return redirectTo('showOrder', $orderId);
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
			Transactions::deleteOrder($orderId);

			return redirectTo('homePage');
		}


	}
