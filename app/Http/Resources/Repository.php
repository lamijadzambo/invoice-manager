<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Repository extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getPost($id)
    {
        $response = $this->apiClient->get(
            'post',
            $query = ['id' => $id]
        );
        $data = json_decode($response, true);
        return OrderResource::make($data)->resolve();
    }
}
