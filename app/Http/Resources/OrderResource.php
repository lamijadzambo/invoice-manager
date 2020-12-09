<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'order_number' => $this->resource['id'],
            'order_status' => $this->resource['status'],
            'order_date' => $this->resource['date_created'],
            'customer_note' => $this->resource['customer_note'],

            //'billing_first_name' => $this->resource['first_name'],
            //'billing_last_name' => $this->resource['last_name'],
            //'billing_company' => $this->resource['company'],
            //'billing_address' => $this->resource['company'],
            //'billing_address' => $this->resource['address_1'],
            //'billing_city' => $this->resource['city'],

        ];
        //return parent::toArray($request);
    }
}
