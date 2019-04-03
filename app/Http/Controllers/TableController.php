<?php

namespace App\Http\Controllers;

use App\Table;
use App\TableLink;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * function to fetch all tables records from DB
     *
     * @param Request $request
     * @return Response Array(tables:[...])
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all');
        switch ($filter) {
            case 'all':
                $tables = Table::all();
                break;
            case 'active':
                $tables = Table::where('table_status', 1)->get();
                break;
            case 'available':
                $tables = Table::where('table_status', 0)->get();
                break;
            default:
                break;
        }

        return response()->json(compact("tables"), 200);
    }

    /**
     * function to update tables status, order_id in DB
     *
     * @param Request $request [method:['change_status','change_order','open_table'], ...table]
     * @param String  $table_id
     * @return Response  [table=>$table]
     */
    public function update(Request $request, $table_id)
    {

        $table = Table::find($table_id);

        switch ($request->input('method', 'change_status')) {
            case 'change_status':
                $table->table_status = $request->table_status;
                if ($request->status == 0) {
                    $table->current_order_id = "";
                }
                $table->save();
                break;

            case 'change_order':
                $table->current_order_id = $request->current_order_id;
                $table->save();
                break;

            case 'open_table':
                $table->table_status = 1;
                $dt = new \DateTime("now");
                $tableLink = TableLink::create(["table_code" => $table_id, "link_generate_time" => $dt]);
                $table->current_order_id = $tableLink->link_id;
                $table->save();
            default:
                break;
        }

        return response()->json(compact("table"), 200);
    }
}
