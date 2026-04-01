<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set($key, $value)
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        Cache::forget("setting.{$key}");
        return $setting;
    }

    public static function getDefaults()
    {
        return [
            'library_name' => 'Perpustakaan Sekolah',
            'library_address' => 'Jl. Pendidikan No. 1',
            'borrowing_days' => '14',
            'fine_per_day' => '1000',
        ];
    }
}
