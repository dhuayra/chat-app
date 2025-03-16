<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class UpdateSettingForm extends Component
{
    public $pusher_app_id;
    public $pusher_app_key;
    public $pusher_app_secret;
    public $pusher_app_cluster;

    public function mount()
    {
        $this->pusher_app_id = config('broadcasting.connections.pusher.app_id');
        $this->pusher_app_key = config('broadcasting.connections.pusher.key');
        $this->pusher_app_secret = config('broadcasting.connections.pusher.secret');
        $this->pusher_app_cluster = config('broadcasting.connections.pusher.options.cluster');    
    }

    public function saveSettingInformation()
    {
        $this->updateEnv('PUSHER_APP_ID', $this->pusher_app_id);
        $this->updateEnv('PUSHER_APP_KEY', $this->pusher_app_key);
        $this->updateEnv('PUSHER_APP_SECRET', $this->pusher_app_secret);
        $this->updateEnv('PUSHER_APP_CLUSTER', $this->pusher_app_cluster);

        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');

        session()->flash('message', 'Settings updated successfully!');
    }

    protected function updateEnv($key, $value)
    {
        $path = base_path('.env');

        if (File::exists($path)) {
            $content = file_get_contents($path);

            $content = preg_replace("/^{$key}=(.*)$/m", "{$key}={$value}", $content);

            file_put_contents($path, $content);
        }
    }

    public function render()
    {
        return view('settings.update-setting-form');
    }
}
