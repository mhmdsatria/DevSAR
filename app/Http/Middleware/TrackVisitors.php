<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk logging

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debugging sementara, bisa dihapus setelah berfungsi
        // Log::info('TrackVisitors middleware is running for URL: ' . $request->fullUrl());

        // Pastikan kita tidak melacak bot atau kunjungan yang tidak valid
        if ($request->routeIs('beranda')) { // Pastikan nama rute beranda kamu adalah 'beranda'
        return $next($request);
    }
        return $next($request);
    }

    protected function isIgnoredUserAgent(?string $userAgent): bool
    {
        if (is_null($userAgent)) {
            return true;
        }

        $ignoredUserAgents = [
            'bot', 'crawl', 'spider', 'validator', 'lighthouse', 'google', 'bing', 'yandex', 'duckduckgo',
            'ahrefs', 'semrush', 'screaming frog', 'gtmetrix', 'pingdom', 'uptime robot', // Tambahkan beberapa lagi
        ];

        foreach ($ignoredUserAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return true;
            }
        }

        return false;
    }
}