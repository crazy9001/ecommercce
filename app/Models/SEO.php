<?php

namespace App\Models;

class SEO extends BaseModel
{
    protected $table = 'seo';
    public $timestamps = false;
    protected $guarded = [];

    public $filter = ['seo_title', 'seo_description', 'seo_keywords', 'robots'];

    public function createSEO($data)
    {
        return $this->create(array_only($data, $this->filter));
    }

}
