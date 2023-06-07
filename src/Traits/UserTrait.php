<?php

namespace ConfrariaWeb\User\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait UserTrait
{

    public function scopeOfColumn($query, $column, $value)
    {
        return $query->where($column, $value);
    }

    /*public function getAccountIdAttribute()
    {
        return $this->account_id?? $this->id;
    }*/

    /*public function avatar()
    {
        return $this->get_gravatar();
    }*/

    public function get_gravatar($email = null, $s = 80, $d = 'mp', $r = 'g')
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim(isset($email) ? $email : $this->email)));
        $url .= "?s=$s&d=$d&r=$r";
        return $url;
    }

    /**
     * Interact with the user's avatar.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->get_gravatar(),
            set: fn ($value) => $value,
        );
    }

    protected function dtCreated(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($attributes['created_at']) ? Carbon::parse($attributes['created_at'])->format('d/m/Y') : NULL,
            set: fn ($value) => $value,
        );
    }

    protected function dtUpdated(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($attributes['updated_at']) ? Carbon::parse($attributes['updated_at'])->format('d/m/Y') : NULL,
            set: fn ($value) => $value,
        );
    }
}
