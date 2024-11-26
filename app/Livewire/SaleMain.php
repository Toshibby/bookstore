<?php

namespace App\Livewire;

use App\Livewire\Forms\ClientCreateForm;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleType;
use App\Models\PaymentMethod;
use Livewire\Component;
use App\Models\Basket;
use App\Models\Detail;
use App\Models\Sale;
use Livewire\Attributes\On;

// use LaravelDaily\Invoices\Invoice;
// use LaravelDaily\Invoices\Classes\Buyer;
// use LaravelDaily\Invoices\Classes\InvoiceItem;
// use LaravelDaily\Invoices\Classes\Buyer;
// use LaravelDaily\Invoices\Classes\InvoiceItem;
// use LaravelDaily\Invoices\Facades\Invoice;

class SaleMain extends Component
{
    public ClientCreateForm $client_create;
    public $search_clients;
    public $search_products;
    public $isOpenClient=false;
    public $client_id;
    public $baskets = [];
    public $cantidad = [];
    public $total=0;
    public $dni;
    public $sale_type_id;
    public $payment_method_id;
    public $selected_client_name;
    public $sub_total = 0;
    public $igv = 0;


    public function mount()
    {
        // Cargar la canasta al inicializar el componente
        $this->loadBasket();
    }
    public function render()
    {
        $clients = Client::where('dni', 'like', '%' . $this->search_clients . '%')->take(1)->get();
        $products = Product::where('nombre', 'like', '%' . $this->search_products . '%')->take(5)->get();
        $sale_types = SaleType::all();
        $payment_methods = PaymentMethod::all();
        $baskets=Basket::all();

        return view('livewire.sale-main', compact('clients', 'products', 'sale_types', 'payment_methods',"baskets"));
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

    public function removeFromBasket($basket_id)
    {
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
        $this->selected_client_name = $client_name; // Muestra el nombre del cliente seleccionado
    }

    public function finalizeSale()
    {
        if (!$this->client_id) {
            session()->flash('error', 'Debe seleccionar un cliente antes de finalizar la venta.');
            return;
        }

        if (!$this->payment_method_id) {
            session()->flash('error', 'Debe seleccionar un método de pago.');
            return;
        }

        // Validar que haya productos en la canasta
        // if ($this->baskets->isEmpty() ) {
        //     session()->flash('error', 'La canasta está vacía. Agregue productos antes de finalizar la venta.');
        //     return;
        // }

        $this->calculateTotal();
        $client = Client::find($this->client_id);

        $sale = Sale::create([
            'client_id' => $client->id,
            'sale_type_id' => $this->sale_type_id,
            'payment_method_id' => $this->payment_method_id,
            'sub_total' => $this->total / 1.18,  // Se asume que el total ya incluye IGV
            'igv' => $this->total - ($this->total / 1.18),  // IGV
            'total' => $this->total,
            'fecha_venta' => now(),
        ]);

        // Registrar los detalles de la venta
        foreach ($this->baskets as $basket) {
            $product = $basket->product;
            $precio_unitario = $product->precio_venta;
            $cantidad = $basket->cantidad;
            $sub_total = $precio_unitario * $cantidad;

            // Crear el detalle de la venta
            Detail::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario,
                'importe_total' => $sub_total,
            ]);

            // Actualizar el stock del producto
            $product->cantidad_stock -= $cantidad;
            $product->save();
            $this->calculateTotal();
        }
        // Vaciar la canasta
        session()->flash('success', '¡Venta realizada exitosamente!');
        Basket::truncate();
        $this->loadBasket();
    }
    #[On('delItem')]
    public function destroy(Sale $sale){
        //dd($post);
        $sale->delete();
    }

//     public function createInvoice()
// {
//     // Recupera la última venta registrada, cargando las relaciones necesarias
//     $sale = Sale::with(['client', 'details.product'])->latest()->first();

//     // Verifica si se encontró una venta
//     if (!$sale) {
//         session()->flash('error', 'No se encontró una venta para generar la factura.');
//         return;
//     }

//     // Verifica si la venta tiene cliente y detalles
//     if (!$sale->client || $sale->details->isEmpty()) {
//         session()->flash('error', 'La venta no tiene cliente o detalles para generar la factura.');
//         return;
//     }

//     // Asegura que los datos estén en UTF-8
//     $clientName = mb_convert_encoding($sale->client->nombre, 'UTF-8', 'UTF-8');
//     $clientDni = mb_convert_encoding($sale->client->dni, 'UTF-8', 'UTF-8');
//     $clientPhone = mb_convert_encoding($sale->client->telefono ?? 'No registrado', 'UTF-8', 'UTF-8');

//     // Configura el cliente de la factura
//     $customer = new Buyer([
//         'name' => $clientName, // Nombre del cliente
//         'custom_fields' => [
//             'DNI' => $clientDni, // DNI del cliente
//             'Teléfono' => $clientPhone, // Teléfono opcional
//         ],
//     ]);

//     // Agrega los items de la factura
//     $items = $sale->details->map(function ($detail) {
//         $productName = mb_convert_encoding($detail->product->nombre, 'UTF-8', 'UTF-8'); // Asegura la codificación de los nombres de productos
//         return InvoiceItem::make($productName) // Nombre del producto
//             ->pricePerUnit($detail->precio_unitario) // Precio unitario
//             ->quantity($detail->cantidad); // Cantidad vendida
//     })->toArray();

//     // Genera la factura
//     $invoice = Invoice::make()
//         ->buyer($customer) // Asocia el cliente
//         ->discountByPercent(0) // Descuento, si aplica
//         ->taxRate(18) // IGV
//         ->addItems($items); // Agrega los productos

//     // Devuelve el PDF para que el usuario lo descargue o visualice
//     return $invoice->stream(); // Genera y muestra la factura en el navegador
// }

}
