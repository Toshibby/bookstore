<?php

namespace Database\Seeders;

use App\Models\Acquisition;
use App\Models\Category;
use App\Models\Client;
use App\Models\Detail;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Sale;
use App\Models\SaleType;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);


        User::create([
            'name'=>'ciro',
            'password'=>bcrypt('123456'),
            'email'=>'ciro@ciro',
        ])->assignRole('Admin');

        $phol=new User();
        $phol->name="garry";
        $phol->password="123456";
        $phol->email="garry@garry";
        $phol->save();

        $category1=new Category();
        $category1->tipo="terror";
        $category1->descripcion="da miedo xd";
        $category1->save();

        $category2=new Category();
        $category2->tipo="misterio";
        $category2->descripcion="es misterioso";
        $category2->save();

        $category3=new Category();
        $category3->tipo="fantasia";
        $category3->descripcion="es fantasia";
        $category3->save();

        $product1=new Product();
        $product1->nombre="biblia";
        $product1->cantidad_stock=123;
        $product1->descripcion="dfdffsd";
        $product1->category_id=3;
        $product1->costo_compra=20.00;
        $product1->precio_venta=25.00;
        $product1->save();

        $product2=new Product();
        $product2->nombre="termodinamica vol 1";
        $product2->cantidad_stock=123;
        $product2->descripcion="dfdffsd";
        $product2->category_id=1;
        $product2->costo_compra=30.00;
        $product2->precio_venta=35.00;
        $product2->save();

        $product3=new Product();
        $product3->nombre="harry potter";
        $product3->cantidad_stock=123;
        $product3->descripcion="dfdffsd";
        $product3->category_id=2;
        $product3->costo_compra=10.00;
        $product3->precio_venta=15.00;
        $product3->save();

        $product4=new Product();
        $product4->nombre=" El señor de los anillos";
        $product4->cantidad_stock=23;
        $product4->descripcion="dfdffsd";
        $product4->category_id=1;
        $product4->costo_compra=1.00;
        $product4->precio_venta=1.00;
        $product4->save();

        $product5=new Product();
        $product5->nombre="cuaderno";
        $product5->cantidad_stock=13;
        $product5->descripcion="dfdffsd";
        $product5->category_id=3;
        $product5->costo_compra=17.00;
        $product5->precio_venta=19.00;
        $product5->save();



        $payment_method1=new PaymentMethod();
        $payment_method1->forma="yape";
        $payment_method1->save();

        $payment_method2=new PaymentMethod();
        $payment_method2->forma="efectivo";
        $payment_method2->save();

        $sale_type1=new SaleType();
        $sale_type1->tipo="virtual";
        $sale_type1->save();

        $sale_type2=new SaleType();
        $sale_type2->tipo="presencial";
        $sale_type2->save();

        $client1=new Client();
        $client1->nombre="Nicolas";
        $client1->dni="123123";
        $client1->telefono="11111";
        $client1->save();

        $client2=new Client();
        $client2->nombre="goku";
        $client2->dni="234234";
        $client2->telefono="2222";
        $client2->save();

        $client1=new Client();
        $client1->nombre="luis miguel";
        $client1->dni="345345";
        $client1->telefono="33333";
        $client1->save();

        $order_status1=new OrderStatus();
        $order_status1->estado="Entregado";
        $order_status1->save();

        $order_status2=new OrderStatus();
        $order_status2->estado="Falta entregar";
        $order_status2->save();

        $payment_status1=new PaymentStatus();
        $payment_status1->estado="cancelado";
        $payment_status1->save();


        $payment_status2=new PaymentStatus();
        $payment_status2->estado="dio adelanto";
        $payment_status2->save();
    }
}
