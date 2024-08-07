<?php

namespace App\Models\Admin;

use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\TrademarkType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Support\Facades\DB;

class Trademark extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Loggable;

    protected $table = 'trademarks';

    protected $fillable = [
        'district_id',
        'commune_id',
        'user_id',
        'type_id',
        'geom',

        'mark',
        'mark_colors',
        'mark_feature',
        'vienna_classes',
        'disclaimer',
        'description',
        'owner',
        'address',
        'other_owner',

        'application_type',
        'filing_number',
        'filing_date',

        'publication_number',
        'publication_date',

        'registration_number',
        'registration_date',
        'expiration_date',

        'representative_name',
        'representative_address',

        'status',
    ];
    
    protected $dates = ['deleted_at'];

    // Relationships
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(TrademarkType::class, 'type_id');
    }

    //ngày nộp đơn
    public function getFilingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : null;
    }
    //ngày công bố
    public function getPublicationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : null;
    }
    //ngày cấp bằng
    public function getRegistrationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : null;
    }
    //ngày hết hạn
    public function getExpirationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : null;
    }

    // Phương thức cập nhật tọa độ
    public function updateCoordinates($id, $longitude, $latitude, $z = 0)
    {
        // Đảm bảo rằng các giá trị tọa độ là số
        if (is_numeric($longitude) && is_numeric($latitude)) {
            $affectedRows = DB::table($this->table)
                ->where('id', $id)
                ->update([
                    'geom' => DB::raw("ST_SetSRID(ST_MakePoint($longitude, $latitude), 4326)")
                ]);

            return $affectedRows > 0;
        }

        return false;
    }

    // Lấy kinh độ từ trường geom
    public function getLongitude($id)
    {
        $result = DB::table($this->table)
            ->select(DB::raw('ST_X(geom) as longitude'))
            ->where('id', $id)
            ->first();

        return $result ? $result->longitude : null;
    }

    // Lấy vĩ độ từ trường geom
    public function getLatitude($id)
    {
        $result = DB::table($this->table)
            ->select(DB::raw('ST_Y(geom) as latitude'))
            ->where('id', $id)
            ->first();

        return $result ? $result->latitude : null;
    }
}
