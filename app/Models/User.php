<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Admin\Answer;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\IndustrialDesign;
use App\Models\Admin\Initiative;
use App\Models\Admin\InitiativeDossier;
use App\Models\Admin\InitiativeEvaluate;
use App\Models\Admin\Patent;
use App\Models\Admin\Product;
use App\Models\Admin\Role;
use App\Models\Admin\Trademark;
use App\Models\Admin\UserCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
 
class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'category_id', 'district_id', 'commune_id', 'name', 'full_name',
        'phone', 'address', 'email', 'email_verified_at', 'birthday', 'description',
        'ip', 'password', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'datetime',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(UserCategory::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function patents()
    {
        return $this->hasMany(Patent::class);
    }

    public function trademarks()
    {
        return $this->hasMany(Trademark::class);
    }

    public function industrialdesigns()
    {
        return $this->hasMany(IndustrialDesign::class);
    }

    public function initiatives()
    {
        return $this->hasMany(Initiative::class);
    }

    public function dossiers()
    {
        return $this->hasMany(InitiativeDossier::class);
    }

    public function evaluations()
    {
        return $this->hasMany(InitiativeEvaluate::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function checkPermissionAccess($permissionCheck)
    {
        // Lấy các quyền của user đang đăng nhập
        $roles = $this->roles;
        
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            // Kiểm tra từng quyền một
            foreach ($permissions as $permission) {
                if ($permission->key_code === $permissionCheck) {
                    return true; // Nếu tìm thấy quyền, trả về true
                }
            }
        }
        
        return false; // Nếu không tìm thấy quyền, trả về false
    }

    
    //////

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user_images')
            ->useDisk('user');
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }

    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d.m.Y h:i'),
        );
    }

    public function getStatusLabelAttribute(): string
    {
        if ($this->status == 1) {
            return '<span class="text-green-500">Kích hoạt</span>';
        } else {
            return '<span class="text-red-500">Không kích hoạt</span>';
        }
    }
}
