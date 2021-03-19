<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientType;
use App\Permission;
use App\Portal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return Client::with(['client_type' , 'portals' , 'permissions'])->get()->toJson(JSON_PRETTY_PRINT);
    }

    public function clientTypes()
    {
        return ClientType::all()->toJson(JSON_PRETTY_PRINT);
    }

    public function permissions()
    {
        return Permission::all()->toJson(JSON_PRETTY_PRINT);
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
            'nick' => 'nullable',
            'ip_address' => 'required|ipv4|unique:clients',
            'type' => 'required',
            'desc' => 'nullable|string',
            'portals' => 'required',
            'permissions' => 'nullable'
            ]);

            $type = ClientType::find($request->input('type'));
            $client = new Client();

            $client->nick = $request->input('nick') ? $request->input('nick') : '';
            $client->ip_address = $request->input('ip_address');
            $client->client_type()->associate($type);
            $portals = $request->input('portals');
            $permissions = $request->input('permissions');
            $client->save();

            foreach ($portals as $id) {
                $portal = Portal::find($id);
                $client->portals()->attach($portal);
            }

            if($permissions) {
                foreach ($permissions as $id) {
                    $permission = Permission::find($id);
                    $client->permissions()->attach($permission);
                }
            }

            return response()->json('Correcto', 201);

        }

        /**
        * Display the specified resource.
        *
        * @param  \App\Client  $client
        * @return \Illuminate\Http\Response
        */
        public function show(Client $client)
        {
            $client->load(['client_type', 'portals' , 'permissions']);

            return $client->toJson(JSON_PRETTY_PRINT);
        }

        /**
        * Display the specified resource.
        *
        * @param  \App\Client  $client
        * @return \Illuminate\Http\Response
        */
        public function clientByIp( Request $request )
        {
            $ip = $request->ip();
            $client = Client::where('ip_address', $ip)->with(['client_type', 'portals', 'permissions'])->first();

            if($client) {
                return $client->toJson(JSON_PRETTY_PRINT);
            }else {
                return response()->json( 'No encontrado', 404 );
            }
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\Client  $client
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, Client $client)
        {
            $validate = $request->validate([
                'nick' => 'nullable|string',
                'ip_address' => ['required', 'ipv4', Rule::unique('clients')->ignore($client)],
                'type' => 'required',
                'desc' => 'nullable|string',
                'portals' => 'required'
                ]);

                if ($request->input('nick')) {
                    $client->nick = $request->input('nick');
                }
                if ($request->input('ip_address')) {
                    $client->ip_address = $request->input('ip_address');
                }
                if ($request->input('desc')) {
                    $client->desc = $request->input('desc');
                }
                if ($request->input('type')) {
                    $type = ClientType::find($request->input('type'));
                    $client->client_type()->dissociate();
                    $client->client_type()->associate($type);
                }

                $portals = $request->input('portals');
                $client->portals()->detach();

                foreach ($portals as $id) {
                    $portal = Portal::find($id);
                    $client->portals()->attach($portal);
                }

                $permissions = $request->input('permissions');
                $client->permissions()->detach();

                if($permissions) {
                    foreach ($permissions as $id) {
                        $permission = Permission::find($id);
                        $client->permissions()->attach($permission);
                    }
                }

                $client->save();

                return response()->json('Correcto', 204);

            }

            /**
            * Remove the specified resource from storage.
            *
            * @param  \App\Client  $client
            * @return \Illuminate\Http\Response
            */
            public function destroy(Client $client)
            {
                $client->portals()->detach();
                $client->delete();

                return response()->json('Correcto', 204);

            }
        }
