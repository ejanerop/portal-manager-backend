<?php

namespace App\Http\Controllers;

use App\Portal;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //->orderBy('dhcp_client', 'ASC')
        return Portal::with('clients')->get()->toJson(JSON_PRETTY_PRINT);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address_list' => 'required',
            'dhcp_client' => 'required'
        ]);

        $portal = new Portal();

        $portal->name = $request->input('name');
        $portal->address_list = $request->input('address_list');
        $portal->dhcp_client = $request->input('dhcp_client');

        $portal->save();

        return response()->json('Correcto', 201);
    }

        /**
        * Display the specified resource.
        *
        * @param  \App\Portal  $portal
        * @return \Illuminate\Http\Response
        */
        public function show(Portal $portal)
        {
            $portal->load('clients');

            return $portal->toJson(JSON_PRETTY_PRINT);
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\Portal  $portal
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, Portal $portal)
        {
            $validate = $request->validate([
                'name' => 'required|string',
                'address_list' => 'required|string',
                'dhcp_client' => 'required|string',
            ]);

            if ($request->input('name')) {
                $portal->name = $request->input('name');
            }
            if ($request->input('address_list')) {
                $portal->address_list = $request->input('address_list');
            }
            if ($request->input('dhcp_client')) {
                $portal->dhcp_client = $request->input('dhcp_client');
            }

            $portal->save();

            return response()->json('Correcto', 204);
        }

            /**
            * Remove the specified resource from storage.
            *
            * @param  \App\Portal  $portal
            * @return \Illuminate\Http\Response
            */
            public function destroy(Portal $portal)
            {
                if (count($portal->clients) != 0) {
                    return response()->json('El portal tiene usuarios asociados.', 422);
                }

                $portal->delete();

                return response()->json('Correcto', 204);

            }
        }
