<?php

namespace App\Http\Responses;

use App\Models\PropertyValue;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductResponse implements Responsable
{
    public function __construct(
        public $data,
        public readonly int $status = Response::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        $data = $this->data->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'price' => $item->price,
                'properties' => $item->propertyValues()->get()->map(function (PropertyValue $prop) {
                    return [
                        $prop->property->name => $prop->value
                    ];
                }),

            ];
        });
        return new JsonResponse(
            data: $this->data,
            status: $this->status,
        );
    }
}
