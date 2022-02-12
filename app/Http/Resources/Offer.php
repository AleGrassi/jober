<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SkillRequirement as SkillRequirementResource;
use App\Http\Resources\LanguageRequirement as LanguageRequirementResource;
use App\Http\Resources\Company as CompanyResource;

class Offer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'company' => new CompanyResource($this->company),
            'role' => $this->title,
            'description' => $this->description,
            'education_requirements' => $this->education_requirements,
            'skill_requirements' => SkillRequirementResource::collection($this->skill_requirements),
            'language_requirements' => LanguageRequirementResource::collection($this->language_requirements),
            'starting_salary' => $this->starting_salary
        ];
    }
}
