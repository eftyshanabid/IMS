<?php

namespace Modules\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\MailerSettings;
use Modules\Website\Entities\SocialMediaSettings;
use Modules\Website\Entities\WalletSettings;
use Modules\Website\Entities\WebsiteSettings;
use Modules\Language\app\Models\Language;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function websiteIndex()
    {

        $website = WebsiteSettings::orderby('id', 'desc')->first();
        $languages = Language::all();
        $title = "Website Settings";

        return view('website::websiteSetting.index', compact('website', 'title', 'languages'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function socialMediaIndex()
    {
        $model = SocialMediaSettings::orderby('id', 'desc')->first();
        $title = "Social Media Settings";

        return view('website::socialMedia.index', compact('model', 'title'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function walletaIndex()
    {
        $model = WalletSettings::orderby('id', 'desc')->first();
        $title = "Wallet Settings";

        return view('website::wallet.index', compact('model', 'title'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function mailIndex()
    {
        $model = MailerSettings::orderby('id', 'desc')->first();
        $title = "Mail Settings";

        return view('website::mail.index', compact('model', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function websiteStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'name.*' => 'required',
            'slogan' => "required",
            'slogan.*' => "required",
            'logo' => 'image|mimes:jpeg,jpg,png,gif,webp|nullable|max:3048',
            'favicon' => 'image|nullable|max:2048',
            'default_user_logo' => 'image|mimes:jpeg,jpg,png,gif,webp|nullable|max:2048',
            'default_user_cover' => 'image|mimes:jpeg,jpg,png,gif,webp|nullable|max:2048',
        ]);

        $input = $request->except('_token');

        $website = WebsiteSettings::orderby('id', 'desc')->first();

        DB::beginTransaction();

        try {

            if ($request->hasFile('logo')) {
                if (!empty($website) && file_exists($website->logo)) {
                    unlink($website->logo);
                }

                $logo = $this->fileUpload($request->file('logo'), 'uploads/website/logo');
                $input['logo'] = $logo;
            }

            if ($request->hasFile('favicon')) {
                if (!empty($website) && file_exists($website->favicon)) {
                    unlink($website->favicon);
                }
                $favicon = $this->fileUpload($request->file('favicon'), 'uploads/website/favicon');
                $input['favicon'] = $favicon;
            }

            if ($request->hasFile('default_user_logo')) {
                if (!empty($website) && file_exists($website->default_user_logo)) {
                    unlink($website->default_user_logo);
                }
                $default_user_logo = $this->fileUpload($request->file('default_user_logo'), 'uploads/website/defaultUser');
                $input['default_user_logo'] = $default_user_logo;
            }

            if ($request->hasFile('default_user_cover')) {
                if (!empty($website) && file_exists($website->default_user_cover)) {
                    unlink($website->default_user_cover);
                }
                $default_user_cover = $this->fileUpload($request->file('default_user_cover'), 'uploads/website/defaultCover');
                $input['default_user_cover'] = $default_user_cover;
            }

            WebsiteSettings::updateOrCreate([
                'id' => 1,
            ], [
                'name' => json_encode($request->name),
                'slogan' => json_encode($request->slogan),
                'monthly_plan_features' => $request->monthly_plan_features,
                'service_agreements' => $request->service_agreements,
                'official_email' => $input['official_email'],
                'membership_email' => $input['membership_email'],
                'agreement_email' => $input['agreement_email'],
                'official_phone' => $input['official_phone'],
                'official_address' => json_encode($request->official_address),
                'logo' => isset($input['logo']) ? $input['logo'] : $website->logo,
                'favicon' => isset($input['favicon']) ? $input['favicon'] : $website->favicon,
                'default_user_logo' => isset($input['default_user_logo']) ? $input['default_user_logo'] : $website->default_user_logo,
                'default_user_cover' => isset($input['default_user_cover']) ? $input['default_user_cover'] : $website->default_user_cover,
                'business_structures' => json_encode($request->business_structures),
                'tax_filing_statuses' => json_encode($request->tax_filing_statuses),
            ]);

            session()->forget('settings');
            DB::commit();
            return $this->backWithSuccess('Website settings are save successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    public function socialStore(Request $request)
    {
        $this->validate($request, [
            // 'twitter' => 'required',
            'facebook' => 'required',
            'telegram' => 'required',
            'discord' => 'required',
            'youtube' => 'required',
            // 'vimeo' => 'required',
        ]);

        $input = $request->except('_token');
        $website = SocialMediaSettings::orderby('id', 'desc')->first();
        DB::beginTransaction();
        try {
            $user = SocialMediaSettings::updateOrCreate(
                [
                    'id' => 1,
                ],
                [
                    // 'twitter' => $input['twitter'],
                    'facebook' => $input['facebook'],
                    'telegram' => $input['telegram'],
                    'discord' => $input['discord'] ?? $website->discord,
                    'youtube' => $input['youtube'] ?? $website->youtube,
                    // 'vimeo' => $input['vimeo'] ?? $website->vimeo,
                    'tiktok' => $input['tiktok'] ?? $website->tiktok
                ]);

            session()->forget('settings');
            DB::commit();

            return $this->backWithSuccess('Social settings are save successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    public function walletStore(Request $request)
    {
        $this->validate($request, [
            'environment' => 'required',
            'access_token' => 'required',
            'application_id' => 'required',
            'location_id' => 'required',
//            'redirect_url' => 'required',
            'merchant_support_email' => 'required',
        ]);

        DB::beginTransaction();
        try {
            WalletSettings::updateOrCreate([
                'id' => 1,
            ], [
                'environment' => $request->environment,
                'access_token' => $request->access_token,
                'application_id' => $request->application_id,
                'location_id' => $request->location_id,
//                'redirect_url' => $request->redirect_url,
                'merchant_support_email' => $request->merchant_support_email,
            ]);

            session()->forget('settings');
            DB::commit();

            return $this->backWithSuccess('Wallet settings are save successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    public function mailStore(Request $request)
    {
        $this->validate($request, [
            'mail_mailer' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_user_name' => 'required',
            'mail_user_password' => 'required',
            'mail_encryption' => 'required',
        ]);

        $input = $request->except('_token');
        $website = MailerSettings::orderby('id', 'desc')->first();
        DB::beginTransaction();
        try {
            $user = MailerSettings::updateOrCreate(
                [
                    'id' => 1,
                ],
                [
                    'mail_mailer' => $input['mail_mailer'],
                    'mail_host' => $input['mail_host'],
                    'mail_port' => $input['mail_port'],
                    'mail_user_name' => $input['mail_user_name'] ?? $website->mail_user_name,
                    'mail_user_password' => $input['mail_user_password'] ?? $website->mail_user_password,
                    'mail_encryption' => $input['mail_encryption'] ?? $website->mail_encryption,
                    'mail_from_address' => $input['mail_from_address'] ?? $website->mail_from_address,
                    'mail_name' => $input['mail_name'] ?? $website->mail_name,
                ]);

            session()->forget('settings');
            DB::commit();

            return $this->backWithSuccess('Mail settings are save successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }


}
