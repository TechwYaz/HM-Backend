<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function index(Request $request)
  {
    $notifications = $request->user()
      ->notifications()
      ->latest()
      ->take(30)
      ->get()
      ->map(fn($n) => [
        'id'         => $n->id,
        'data'       => $n->data,
        'read_at'    => $n->read_at,
        'created_at' => $n->created_at,
      ]);

    return response()->json($notifications);
  }

  public function markRead(Request $request, string $id)
  {
    $notification = $request->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return response()->json(['ok' => true]);
  }

  public function markAllRead(Request $request)
  {
    $request->user()->unreadNotifications->markAsRead();
    return response()->json(['ok' => true]);
  }
}
