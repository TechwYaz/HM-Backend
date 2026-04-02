# Half Million Cafe — Backend

This is the backend for my graduation project. It's a REST API built with Laravel 12 that powers the Half Million Cafe web app — handling user auth, the menu, orders, table bookings, and notifications.

## Tech stack

I went with Laravel 12 because I was already comfortable with it and it made structuring the API clean and straightforward. Auth is handled with Sanctum, the database is MySQL, and I used Eloquent for everything database-related.

## Running it

```bash
php artisan serve
```

API runs at `http://127.0.0.1:8000/api`

## Folder structure

```
app/
  Http/Controllers/Api/
    Auth/        login, register, profile
    Bookings/    table booking
    Catalog/     menu items and categories
    Commerce/    cart and orders
    System/      notifications
  Models/
    Bookings/    TableBooking
    Catalog/     Category, MenuItem
    Commerce/    Cart, CartItem, Order, OrderItem
    User.php
routes/
  api.php
```

