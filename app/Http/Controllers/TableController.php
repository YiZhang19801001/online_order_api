<?php

namespace App\Http\Controllers;

// use App\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(Request $request)
    {
        $tables = Table::all();

        return response()->json(compact("tables"), 200);
    }

    public function update(Request $request, $table_id)
    {

        $table = Table::find($table_id);

        switch ($request->input('method', 'change_status')) {
            case 'change_status':
                $table->status = $request->status;
                if ($request->status == 0) {
                    $table->current_order_id = "";
                }
                $table->save();
                break;

            case 'change_order':
                $table->current_order_id = $request->current_order_id;
                $table->save();
                break;

            default:
                break;
        }

        return response()->json(compact("table"), 200);
    }
}
