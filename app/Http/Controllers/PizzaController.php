<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pizza;

class PizzaController extends Controller
{

	public function index()
	{
		return Pizza::all();
	}

	public function search()
	{
		$keyword = '%' . request('keyword') . '%';

		return Pizza::where('size', 'like', $keyword)
			->orWhere('crust', 'like', $keyword)
			->orWhere('type', 'like', $keyword)
			->orWhere('number_of_toppings', 'like', $keyword)
			->get();
	}

	public function store()
	{
		$response = '';

		$order = Order::create([
			'number' => request('order.order.number')
		]);

		$response .= '<h5>Order ' . request('order.order.number') . '</h5>';
	
		foreach(request('order.order.pizzas') as $pizza) {
			$pizzaData = $order->pizzas()->create([
				'number' => $pizza['number'],
				'size' => $pizza['size'],
				'crust' => $pizza['crust'],
				'type' => $pizza['type'],
				'number_of_toppings' => (!empty($pizza['toppings'])) ? count($pizza['toppings']) : 0
			]);

			$response .= '<div style="margin-left: 3rem;">Pizza ' . $pizza['number'] . ' - ' . $pizza['size'] . ', ' . $pizza['crust'] . '</div>';

			if(!empty($pizza['toppings'])) {
				foreach($pizza['toppings'] as $topping) {
					$toppingsData = $pizzaData->toppings()->create([
						'area' => $topping['area']
					]);

					$area = ['Whole', 'First-Half', 'Second-Half'];

					$response .= '<div style="margin-left: 6rem;">Toppings ' . $area[$topping['area']] . ':</div>';

					if(!empty($topping['items'])) {
						foreach($topping['items'] as $toppingItem) {
							$toppingsData->items()->create([
								'name' => $toppingItem
							]);

							$response .= '<div style="margin-left: 9rem;">' . $toppingItem . '</div>';
						}
					}
				}
			}
		}
	
		return $response;
	}

}
