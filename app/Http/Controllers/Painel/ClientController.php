<?php
namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use App\Models\Address\Address;
use App\Models\Client\Client;

class ClientController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index()
    {
        $clients = $this->client->with('address')->where('status', 1)->get();

        return view('painel.client.index', compact('clients'));
    }
    public function create()
    {
        return view('painel.client.create');
    }
    public function store(ClientRequest $request)
    {
        $cpf = $request->input('cpf');
        $exists = Client::where('cpf', $cpf)->first();

        if($exists){
            $exists->update($request->except(['cpf']));
            $exists->update([
                'name' => strtoupper($request->input('name')),
                'email' => strtoupper($request->input('email')),
                'birthdate' => $request->input('birthdate'),
                'status' => 1,
            ]);

            $exists->address()->update([
                'zip_code' => $request->input('zip_code'),
                'street' => strtoupper($request->input('street')),
                'house_number' => strtoupper($request->input('house_number')),
                'city' => strtoupper($request->input('city')),
                'state' => strtoupper($request->input('state')),
            ]);

             return redirect()->route('client.index')->with('success', 'Cadastrado com sucesso.');
        }else{
            $status = $request["status"] = 'on' ? 1 : 0;

            $client = new Client([
                'name' => strtoupper($request['name']),
                'email' => strtoupper($request['email']),
                'cpf' => strtoupper($request['cpf']),
                'birthdate' => $request['birthdate'],
                'status' => $status
            ]);

            $client->save();

            $address = new Address([
                'zip_code' => $request['zip_code'],
                'street' => strtoupper($request['street']),
                'house_number' => strtoupper($request['house_number']),
                'city' => strtoupper($request['city']),
                'state' => strtoupper($request['state']),
            ]);
    
            $client->address()->save($address);
            
            return redirect()->route('client.index')->with('success', 'Cadastrado com sucesso.');
        }
    }
    public function edit(Client $client)
    {
        return view('painel.client.edit', compact('client'));
    }
    public function update(ClientRequest $request, Client $client)
    {
        $status = $request["status"] = 'on' ? 1 : 0;

        $client->update([
            'name' => strtoupper($request['name']),
            'email' => strtoupper($request['email']),
            'cpf' => strtoupper($request['cpf']),
            'birthdate' => $request['birthdate'],
            'status' => $status
        ]);

        $client->address()->update([
            'zip_code' => $request['zip_code'],
            'street' => strtoupper($request['street']),
            'house_number' => strtoupper($request['house_number']),
            'city' => strtoupper($request['city']),
            'state' => strtoupper($request['state']),
        ]);

        return redirect()->route('client.index')->with('success', 'Atualizado com sucesso.');
        
    }
    public function destroy(Client $client)
    {
        $client->update(['status' => 0]);

        return redirect()->route('client.index')->with('success', 'Deletado com sucesso.');
    }
}
