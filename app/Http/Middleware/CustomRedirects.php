<?php

namespace App\Http\Middleware;

use App\Models\Redirect as RedirectRule;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomRedirects
{
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->method(), ['GET', 'HEAD'], true)) {
            return $next($request);
        }

        $path = $request->getPathInfo();
        $path = '/' . ltrim($path, '/');
        $normalizedPath = rtrim($path, '/');
        if ($normalizedPath === '') {
            $normalizedPath = '/';
        }

        if ($this->shouldSkip($normalizedPath)) {
            return $next($request);
        }

        $redirects = RedirectRule::where('status', 1)->orderBy('id', 'desc')->get();
        foreach ($redirects as $redirect) {
            $source = $this->normalizeSource($redirect->source_url);
            $requestPath = $redirect->ignore_case ? Str::lower($normalizedPath) : $normalizedPath;
            $matchSource = $redirect->ignore_case ? Str::lower($source) : $source;

            $matched = false;
            if ($redirect->match_type === 'starts_with') {
                $matched = Str::startsWith($requestPath, $matchSource);
            } else {
                $matched = $requestPath === $matchSource;
            }

            if (!$matched) {
                continue;
            }

            $status = (int) $redirect->redirect_type;
            if (in_array($status, [410, 451], true)) {
                return response('', $status);
            }

            if (!$redirect->destination_url) {
                continue;
            }

            if ($this->isSameDestination($normalizedPath, $redirect->destination_url)) {
                return $next($request);
            }

            return redirect()->to($redirect->destination_url, $status);
        }

        return $next($request);
    }

    private function shouldSkip(string $path): bool
    {
        return Str::startsWith($path, [
            '/admin',
            '/seller',
            '/user',
            '/api',
            '/storage',
            '/_ignition',
            '/_debugbar',
        ]);
    }

    private function normalizeSource(string $source): string
    {
        $source = trim($source);
        if (Str::startsWith($source, ['http://', 'https://'])) {
            $parsedPath = parse_url($source, PHP_URL_PATH);
            $source = $parsedPath ?: '/';
        }
        $source = '/' . ltrim($source, '/');
        $source = rtrim($source, '/');
        return $source === '' ? '/' : $source;
    }

    private function isSameDestination(string $currentPath, string $destination): bool
    {
        $destPath = $destination;
        if (Str::startsWith($destPath, ['http://', 'https://'])) {
            $parsedPath = parse_url($destPath, PHP_URL_PATH);
            $destPath = $parsedPath ?: '/';
        }
        $destPath = '/' . ltrim($destPath, '/');
        $destPath = rtrim($destPath, '/');
        if ($destPath === '') {
            $destPath = '/';
        }

        return $destPath === $currentPath;
    }
}
