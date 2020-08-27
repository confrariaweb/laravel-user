<?php

namespace ConfrariaWeb\User\Traits;

use ConfrariaWeb\Entrust\Traits\EntrustTrait;
use ConfrariaWeb\User\Scopes\UserAccountScope;
use ConfrariaWeb\User\Scopes\UserOrderByScope;
use Illuminate\Support\Facades\Config;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

trait UserTrait
{
    use HasRelationships;
    use EntrustTrait;

    protected static function booted()
    {
        static::addGlobalScope(new UserAccountScope);
        static::addGlobalScope(new UserOrderByScope);
    }

    /*
    public function options()
    {
        return $this->hasManyDeep(
            'ConfrariaWeb\Option\Models\Option',
            [
                Config::get('cw_entrust.role_user_table'),
                'ConfrariaWeb\Entrust\Models\Role',
                'option_role'
            ], // Intermediate models and tables, beginning at the far parent (User).
            [
                'user_id', // Foreign key on the "role_user" table.
                'id',      // Foreign key on the "roles" table (local key).
                'role_id'  // Foreign key on the "options" table.
            ],
            [
                'id',      // Local key on the "users" table.
                'role_id', // Local key on the "role_user" table (foreign key).
                'id'       // Local key on the "roles" table.
            ]
        )->distinct();
    }
    */

    public function isAdmin()
    {
        return $this->roles->contains('name', 'administrator');
    }

    /**
     * Lista todos os indicados do usuário
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function indications()
    {
        return $this->belongsToMany('App\User', 'user_indications', 'indicator_id', 'indicated_id');
    }

    /**
     * Lista o usuario indicador, lista quem indicou
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function indicator()
    {
        return $this->belongsToMany('App\User', 'user_indications', 'indicated_id', 'indicator_id');
    }

    /**
     * Metodo utilizado em conjunto com o pacote de dashboard "confrariaweb/laravel-dashboard"
     * @return mixed
     */
    public function dashboards()
    {
        return $this->hasMany('ConfrariaWeb\Dashboard\Models\Dashboard');
    }

    function avatar()
    {
        return $this->get_gravatar();
        //return ($this->files()->count() > 0) ? $this->files()->orderBy('created_at', 'desc')->first()->url : $this->get_gravatar();
    }

    function get_gravatar($email = null, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim(isset($email) ? $email : $this->email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

}
