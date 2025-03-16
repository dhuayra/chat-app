<p align="center"><a href="https://laravel.com" target="_blank"><img src="./public/logo.png" width="80" alt="H Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/badge/dev-dhuayra-blue" alt="Latest Stable Version"></a>
</p>
# Pusher Integration in Laravel

This project uses **Pusher** for real-time broadcasting and event handling. Follow the steps below to create a Pusher account, obtain credentials, and configure them in Laravel.

## Steps to Set Up Pusher

### 1. **Create a Pusher Account**

1. Go to the [Pusher website](https://pusher.com/).
2. Click **Sign Up** or **Get Started Free** to create an account.
3. Fill in the registration form or sign up using your Google account.
4. Verify your email address to activate your account.
5. Log in to your Pusher account.

### 2. **Create a New Pusher App**

1. After logging in, go to your **Dashboard**.
2. Click **Create App** to create a new Pusher application.
3. Enter an **App Name** and select an environment (e.g., "Development" or "Production").
4. Select a **Cluster** (e.g., `mt1`, `us2`), which corresponds to the region where your app will be hosted.
5. After creating the app, you will be given the following credentials:
   - **App ID**: Unique identifier for your app.
   - **App Key**: Public key used for authenticating Pusher requests.
   - **App Secret**: Private key for secure server-side interactions with Pusher.
   - **Cluster**: Region where your app is hosted (e.g., `mt1`, `us2`).

### 3. **Set Up Pusher Credentials in Laravel**

1. Open your `.env` file and add the following lines with the credentials you received from Pusher:

    ```env
    BROADCAST_DRIVER=pusher
    PUSHER_APP_ID=your_app_id
    PUSHER_APP_KEY=your_app_key
    PUSHER_APP_SECRET=your_app_secret
    PUSHER_APP_CLUSTER=your_app_cluster
    ```

2. Ensure the `config/broadcasting.php` file is properly configured for Pusher (this is the default in Laravel):

    ```php
    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true,
            ],
        ],
    ],
    ```

### 4. **Ensure HTTPS is Enabled (for Production)**

1. **Forcing HTTPS**: In your `AppServiceProvider.php` file, add the following to force HTTPS in production:

    ```php
    use Illuminate\Support\Facades\URL;

    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
    ```

2. **Why HTTPS is Important**: Pusher requires encrypted connections for real-time broadcasting. By forcing HTTPS, you ensure that all communication between your Laravel app and Pusher is secure.

### 5. **Testing Pusher Integration**

1. **Emit Events in Laravel**: To broadcast events in Laravel, use the following example:

    ```php
    use App\Events\YourEvent;

    broadcast(new YourEvent($data));
    ```

2. **Listen for Events in Frontend (JavaScript)**:

    If you're using JavaScript with Laravel Echo to listen for events, here's an example:

    ```js
    Echo.channel('your-channel')
        .listen('YourEvent', (event) => {
            console.log(event);
        });
    ```

3. **Verify Integration**: Make sure events are being emitted and received correctly. If you see the events in the frontend and backend, the integration is successful.

---

## Additional Notes

- **Production Environment**: If deploying to production, ensure your application is using HTTPS. Pusher will not work properly over HTTP due to security concerns.
- **Check Configuration**: Double-check that the Pusher credentials in your `.env` file match the ones in the `config/broadcasting.php` file.

By following these steps, you should be able to integrate Pusher into your Laravel application and start broadcasting events in real time.
