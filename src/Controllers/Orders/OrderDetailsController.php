<?php

	namespace KobiLab\Http\Controllers\Orders;

	use Illuminate\Routing\Controller;

	use KobiLab\OrderDetails;
	use KobiLab\Parts;
	use KobiLab\Orders;
	use KobiLab\ProductionOrders;

	/**
	 * Siparişlerle alakalı işlemleri yapan sınıf
	 */
	class OrderDetailsController extends Controller
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
				'second'=> 'order'
			];
		}

		/**
		 * Siparişe sipariş itemi eklemek için gerekli olan sayfayı derleyen method
		 * 
		 * @param integer $siparisId Sipariş Id
		 * @return view
		 */
		public function create($siparisId)
		{
			$this->data['parts'] = Parts::all();
			$this->data['detail'] = Orders::find($siparisId);

			return view('zahmetsizce::orders.orders.details.addPart', $this->data);
		}

		/**
		 * Siparişe eklenen itemi veritabanına eklemeye yarayayn method
		 *
		 * @param  integer $siparisId Sipariş Id
		 * @return redirect
		 */
		public function store($orderId)
		{
			$result = OrderDetails::setFromAllInput()->setIt('order_id', $orderId)->setIt('status', 1)->setRulesForTable('order_details');

			if (!$result->autoCreate()) {
				return redirectTo('addPartToOrder', $orderId)
						->withErrors($result->getErrors())
						->withInput($result->getOld());
			} else {
				return redirectTo('showOrder', $orderId);
			}

			/*$veriler = [
				'order_id'	=> $orderId,
				'part_id'	=> Input::get('partId'),
				'quantity'	=> Input::get('quantity'),
				'remainder'	=> Input::get('quantity'),
				'reserved'	=> 0
			];*/

		}

		/**
		 * Sipariş itemini düzenlemek için gerekli olan sayfayı derlemeye yarayan method
		 * 
		 * @param  integer $siparisDetayId Sipariş Detay Id
		 * @return view
		 */
		public function edit($orderDetailId)
		{
			$this->data['detail'] = OrderDetails::find($orderDetailId);

			return view('zahmetsizce::orders.orders.details.partEdit', $this->data);
		}

		/**
		 * Sipariş itemini veritabanında düzenleme işlemini gerçekleştiren method
		 *
		 * @see    burda şöyle bir sıkıntı oluşabilir. sipariş için ayırtılan itemden daha düşük bir sayıya güncelleme yaparsa 
		 *         stokta tutarsızlık olacaktır.
		 * @param  integer $siparisDetayId Sipariş Detay Id
		 * @return redirect
		 */
		public function update($orderDetailId)
		{
			$result = OrderDetails::setFromAllInput()->setId($orderDetailId)->setRulesForTable('order_detail_edit');

			if (!$result->autoUpdate()) {
				return redirectTo('editOrderDetail', $orderDetailId)
						->withErrors($result->getErrors())
						->withInput($result->getOld());
			} else {
				return redirectTo('orders');
			}
		}

		/**
		 * Sipariş itemini silmeye yarayan method
		 *
		 * @see    yukardaki sorunun aynısı siparişe parça ayırt edilmişse ve 
		 *         sipariş silinirse stokta tutarsızlık olacaktır.
		 * @param  integer $siparisDetayId Sipariş Detay Id
		 * @return redirect
		 */
		public function delete($orderDetailId)
		{
			OrderDetails::find($orderDetailId)->delete();

			return redirectTo('orders');
		}

		public function produceOrderDetail($orderDetailId)
		{
			$key = str_random(8);

			ProductionOrders::setData([
				'production_order_code' => 'E-O-'.$key,
				'part_id' => OrderDetails::find($orderDetailId)['part_id'],
				'quantity' => OrderDetails::find($orderDetailId)['quantity'],
				'customer_order_detail_id' => $orderDetailId
			])->setRulesForTable('production_order')->autoCreate();

			OrderDetails::find($orderDetailId)->update([
				'production_order_id' => ProductionOrders::where('production_order_code', 'E-O-'.$key)->first()['id']
			]);

			return redirectTo('productionOrders');
		}

	}
