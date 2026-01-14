<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip admin pages, assets, API routes
        if (
            $request->is('admin/*') ||
            $request->is('css/*') ||
            $request->is('js/*') ||
            $request->is('images/*') ||
            $request->is('api/*') ||
            $request->is('favicon.ico') ||
            $request->ajax()
        ) {
            return $next($request);
        }

        // Record page view
        PageView::create([
            'page_url' => $request->fullUrl(),
            'page_name' => $this->getPageName($request->path()),
            'referrer' => $request->header('referer'),
            'ip_address' => $request->ip(),
            'device_type' => $this->detectDeviceType($request->userAgent()),
            'session_id' => $request->session()->getId(),
        ]);

        return $next($request);
    }

    private function getPageName(string $path): string
    {
        if ($path === '/') {
            return 'Homepage';
        }

        return ucwords(str_replace(['-', '/'], ' ', $path));
    }

    private function detectDeviceType(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'desktop';
        }

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $userAgent)) {
            return 'tablet';
        }

        if (preg_match('/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile/', $userAgent)) {
            return 'mobile';
        }

        return 'desktop';
    }
}
