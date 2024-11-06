<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $total_usuario = DB::select('select count(*) as total from usuario where estado=1');
        //compartiendo la consulta a todas las vistas
        View::share("total_usuario", $total_usuario[0]->total);

        $total_ciente = DB::select('select count(*) as total from cliente');
        View::share("total_cliente", $total_ciente[0]->total);

        $total_ventas = DB::select('select sum(total) as total from venta where estado=1 and fecha=CURDATE()');
        View::share("total_ventas", $total_ventas[0]->total);

        $total_producto = DB::select('select count(*) as total from producto where estado=1');
        View::share("total_producto", $total_producto[0]->total);
    
        $venta = DB::select("
        select 
        sum(venta.pagoTotal) as 'tot',
        MONTHNAME(venta.fecha) as 'fecha',
        MONTH(venta.fecha) as 'fechaN',
        venta.total, venta.id_venta
        from
        venta
        where
        EXTRACT(YEAR FROM fecha) = EXTRACT(YEAR FROM NOW()) and venta.estado = 1
        GROUP BY MONTHNAME(venta.fecha)
        ORDER BY mONTH(FECHA) ASC 
        ");
        $data = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($venta as $key => $value){
            $data [$value->fechaN -1] = $value ->tot;
        }
        View::share("ventas", $venta);
    }
}
