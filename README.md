<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Laravel Sanctum API Token Authentication

## 🚀 Usage
1. Start server with `php artisan serve`
2. Send a `POST` request to `/api/auth/register` including the following params: `name`, `email`, `password` and `password_confirmation`.
3. Copy obtained authentication token and use it by sending a request to `/api/me` including the `Authentication: Bearer <token>` header.
