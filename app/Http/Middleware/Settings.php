<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Settings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!session()->has('settings')){
            session()->put('settings', [
                'website' => \Modules\Website\Entities\WebsiteSettings::orderBy('id', 'asc')->first(),
                'social-media' => \Modules\Website\Entities\SocialMediaSettings::orderBy('id', 'asc')->first(),
                'wallet' => \Modules\Website\Entities\WalletSettings::orderBy('id', 'asc')->first(),
                'mailer' => \Modules\Website\Entities\MailerSettings::orderBy('id', 'asc')->first(),
            ]);
        }

        \Config::set('mail.mailers.smtp.transport', mailSettings()->mail_mailer);
        \Config::set('mail.mailers.smtp.host', mailSettings()->mail_host);
        \Config::set('mail.mailers.smtp.port', mailSettings()->mail_port);
        \Config::set('mail.mailers.smtp.encryption', mailSettings()->mail_encryption);
        \Config::set('mail.mailers.smtp.username', mailSettings()->mail_user_name);
        \Config::set('mail.mailers.smtp.password', mailSettings()->mail_user_password);
        \Config::set('mail.from.address', mailSettings()->mail_from_address);
        \Config::set('mail.from.name', mailSettings()->mail_name);

        return $next($request);
    }
}
