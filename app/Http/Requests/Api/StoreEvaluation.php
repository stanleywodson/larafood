<?php

namespace App\Http\Requests\Api;

use App\Respositories\Contracts\OrderRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$client = auth()->user()){
            return false;
        }

        if (!$order = app(OrderRepositoryInterface::class)->getOrderByIdentify($this->identifyOrder)){
            return false;
        }

        return $client->id == $order->client_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'stars' => ['required', 'numeric', 'min:1', 'max:5'],
            'comments' => ['nullable', 'min:3', 'max:500']
        ];
    }
}
