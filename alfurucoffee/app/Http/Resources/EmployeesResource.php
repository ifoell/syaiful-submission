<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "Employee"=>[
              'id' => $this->id,
              'name' => $this->name,
              'job_title' => $this->job_title,
              'salary' => $this->salary,
              'department' => $this->department,
              'joined_date' => $this->joined_date,
              ],
            "sales"=>$this->sales
        ];
    }
}
