<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Notification extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id', 'type', 'webhook',
    ];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function notify($title, $description)
    {
        $this->discordNotification($title, $description);
        $this->slackdNotification($title, $description);
    }

    public static function discordNotification($title, $description)
    {
        $webhook = Notification::select('webhook')->where('type', 'discord')->where('team_id', auth()->user()->currentTeam->id)->whereNotNull('webhook')->first();
        if(!empty($webhook->webhook)){
            try {
                return Http::post($webhook->webhook, [
                    'content' => "👋 New event on " . config('app.name'),
                    'embeds' => [
                        [
                            'title' => $title,
                            'description' => "**User:** " . auth()->user()->name . "\n **Description:** " . $description,
                            'color' => '7506394',
                        ]
                    ],
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    public static function slackdNotification($title, $description){
        $webhook = Notification::select('webhook')->where('type', 'slack')->where('team_id', auth()->user()->currentTeam->id)->whereNotNull('webhook')->first();
        if(!empty($webhook->webhook)){
            try {
                return Http::post($webhook->webhook, [
                    "text" => "👋 New event on " . config('app.name') . ":\n" . $title . "\n User: " . auth()->user()->name . "\n Description: " . $description,
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}
