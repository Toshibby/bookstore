<?php

namespace App\Livewire;

use App\Livewire\Forms\ClientCreateForm;
use App\Livewire\Forms\OrderCreateForm;
use App\Livewire\Forms\ProductCreateForm;
use App\Models\Basket;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\SaleType;
use Livewire\Component;

class OrderMain extends Component
{
    public ClientCreateForm $client_create;
    public ProductCreateForm $product_create;
    public $search_clients;
    public $search_products;
    public $isOpenClient=false;
    public $isOpenProduct=false;
    public $client_id;
    public $product_id;
    public $baskets = [];
    public $cantidad = [];
    public $total=0;
    public $dni;
    public $order_status_id;
    public $payment_status_id;
    public $payment_method_id;
    public $selected_client_name;
    public $sub_total = 0;
    public $igv = 0;
    public $monto_adelanto = 0;
    public $descripcion;
    public function mount()
    {
        // Cargar la canasta al inicializar el componente
        $this->loadBasket();
    }
    public function render()
    {
        $orders=Order::all();
        $clients = Client::where('dni', 'like', '%' . $this->search_clients . '%')->take(1)->get();
        $products = Product::where('nombre', 'like', '%' . $this->search_products . '%')->take(1)->get();
        $payment_methods=PaymentMethod::all();
        $baskets=Basket::all();
        $sale_types=SaleType::all();
        $categories=Category::all();
        $order_statuses=OrderStatus::all();
        $payment_statuses=PaymentStatus::all();
        return view('livewire.order-main',compact("orders","products","clients","payment_methods","baskets","sale_types","categories","order_statuses","payment_statuses"));
    }

    public function addToBasket($product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            session()->flash('error', 'El producto no existe.');
            return;
        }

        $basket_item = Basket::where('product_id', $product->id)->first();

        if ($basket_item) {
            if ($basket_item->cantidad + 1 > $product->cantidad_stock) {
                session()->flash('error', 'No hay suficiente stock para este producto.');
                return;
            }

            $basket_item->cantidad += 1;
            $basket_item->save();
        } else {
            if (1 > $product->cantidad_stock) {
                session()->flash('error', 'No hay suficiente stock para este producto.');
                return;
            }

            Basket::create([
                'product_id' => $product->id,
                'cantidad' => 1,
            ]);
        }
        $this->loadBasket();
        $this->calculateTotal();
    }

    public function loadBasket()
    {
        // Cargar la canasta con productos relacionados
        $this->baskets = Basket::with('product')->get();

        // Inicializar las cantidades
        foreach ($this->baskets as $basket) {
            $this->cantidad[$basket['id']] = $basket['cantidad'];
        }
    }
    public function updatedCantidad($value, $basket_id)
    {
        $basket = Basket::find($basket_id);
        $product = Product::find($basket->product_id);

        if ($value > $product->cantidad_stock) {
            $this->cantidad[$basket_id] = $product->cantidad_stock;
            session()->flash('error', 'La cantidad supera el stock disponible.');
            return;
        }

        $basket->update(['cantidad' => $value]);
        $this->loadBasket();
        $this->calculateTotal();
    }

    public function removeFromBasket($basket_id)
    {
        // Eliminar un producto de la canasta
        Basket::destroy($basket_id);

        // Refrescar la canasta
        $this->loadBasket();
        $this->calculateTotal();
    }
    public function calculateTotal()
    {
        $sub_total = 0;
        $igv = 0;
        $igvRate = 0.18; // 18%

        foreach ($this->baskets as $basket) {
            $sub_total += $basket->product->precio_venta * $basket->cantidad;
        }

        $igv = $sub_total * $igvRate;
        $this->sub_total = $sub_total;
        $this->igv = $igv;
        $this->total = $sub_total + $igv;
    }

    public function selectClient($client_id, $client_name)
    {
        $this->client_id = $client_id;
        $this->selected_client_name = $client_name;
    }

    public function createClient(){
        $this->isOpenClient=true;
        $this->client_create->reset();
        $this->resetValidation();
    }

    public function storeClient(){


        $this->client_create->validate();

        if ($this->client_id) {
            $client = Client::find($this->client_id);
            $client->update($this->client_create->all());
        } else {
            Client::create($this->client_create->all());
        }

        $this->isOpenClient = false;

        $this->client_id = null;
    }

    public function createProduct(){
        $this->isOpenProduct=true;
        $this->product_create->reset();
        $this->resetValidation();
    }
    public function storeProduct(){


        $this->product_create->validate();

        if ($this->product_id) {
            $product = Product::find($this->product_id);
            $product->update($this->product_create->all());
        } else {
            Product::create($this->product_create->all());
        }

        $this->isOpenProduct = false;

        $this->product_id = null;
    }

    public function finalizeOrder()
    {
        $this->calculateTotal();
        $client = Client::find($this->client_id);



        // Crear el registro de la venta
        $order = Order::create([
            'client_id' => $client->id,
            'order_status_id' => $this->order_status_id,
            'payment_status_id' =>$this->payment_status_id,
            'sub_total' => $this->total / 1.18,
            'igv' => $this->total - ($this->total / 1.18),
            'total' => $this->total,
            'descripcion' => $this->descripcion,  // Si necesitas una descripción
            'payment_method_id' => $this->payment_method_id,
            'monto_adelanto' => $this->monto_adelanto,
            'fecha_venta' => now(),
        ]);

        // Registrar los detalles de la venta
        foreach ($this->baskets as $basket) {
            $product = $basket->product;
            $precio_unitario = $product->precio_venta;
            $cantidad = $basket->cantidad;
            $sub_total = $precio_unitario * $cantidad;

            // Crear el detalle de la venta
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario,
                'importe_total' => $sub_total,
            ]);

            // Actualizar el stock del producto
            $this->calculateTotal();
        }
        $this->descripcion = '';
        $this->order_status_id = null;
        $this->payment_status_id = null;
        $this->payment_method_id = null;
        $this->monto_adelanto = 0;
        $this->client_id = null;
        $this->selected_client_name = null;
        $this->sub_total = 0;

        // Vaciar la canasta
        Basket::truncate();
        $this->loadBasket();
    }
}
