<?php

use Illuminate\Support\Str;
use Modules\Packages\Entities\PackageOrder;
use Modules\Posts\Entities\ProductImages;
use Modules\Posts\Entities\Products;
use Modules\Sanajinx\Entities\WebActivityLog;
use Modules\Website\Entities\MailerSettings;
use Modules\Website\Entities\Pages;
use Modules\Website\Entities\SocialMediaSettings;
use Modules\Website\Entities\WalletSettings;
use Modules\Website\Entities\WebsiteSettings;

function daysOfWeekXML($day)
{
    // Give number of day in the week
    $day_number = date('N', strtotime($day));

    $day_week_futur = [];
    $day_week_past = [];

    // Retrieve future days in the week
    for ($i = $day_number; $i <= 7; $i++) {
        $next_day = strtotime('+' . $i - $day_number . ' day', strtotime($day));
        array_push($day_week_futur, date('Y-m-d', $next_day));
    }

    // Retrieve days past in the week
    for ($day_number; $day_number > 1; $day_number--) {
        $previous_day = strtotime('-' . ($day_number - 1) . ' day', strtotime($day));
        array_push($day_week_past, date('Y-m-d', $previous_day));
    }
    // Concatenate all days in the week in array
    return array_merge($day_week_past, $day_week_futur);
}

function status()
{
    return [
        'pending' => 'Pending',
        'received' => 'Received',
        'delivered' => 'Delivered',
        'halt' => 'Halt'
    ];
}

function regularStatus()
{
    return [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'cancel' => 'Cancel'
    ];
}

function sellerStatus()
{
    return [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'declined' => 'Declined'
    ];
}

function websiteSettings()
{
    return session()->get('settings')['website'];
}

function businessStructures()
{
    return json_decode(websiteSettings()->business_structures, true);
    return [
        'sole-proprietor' => "Sole Proprietor",
        'partnership' => "Partnership",
        'LLC' => "LLC",
        'c-corp' => "C-Corp",
        's-corp' => "S-Corp",
        'non-profit' => "Non-Profit"
    ];
}

function taxFilingStatus(){
    return json_decode(websiteSettings()->tax_filing_statuses, true);
    return [
        'individual' => "Individual",
        'partnership' => "Partnership",
        'corporation' => "Corporation"
    ];
}

function datatableOrdering()
{
    $order = false;
    if (isset(request()->order[0])) {
        foreach (request()->order as $key => $ordering) {
            if ($ordering['column'] != 0) {
                $order = $ordering;
            }
        }
    }

    return $order;
}

function pleaseSortMe($query, $order, $orderByQuery)
{
    return $query->when($order == 'asc', function ($query) use ($orderByQuery) {
        return $query->orderBy($orderByQuery);
    })
        ->when($order == 'desc', function ($query) use ($orderByQuery) {
            return $query->orderByDesc($orderByQuery);
        });
}

function userColumnVisibilities()
{
    $columnVisibilities = \App\Models\UserColumnVisibility::where([
        'user_id' => auth()->user()->id,
        'url' => request()->fullUrl()
    ])->first();
    if (isset($columnVisibilities->id)) {
        $columns = (!empty($columnVisibilities->columns) && is_array(json_decode($columnVisibilities->columns, true)) ? json_decode($columnVisibilities->columns, true) : []);
        $hidden = [];
        if (isset($columns[0])) {
            foreach ($columns as $key => $column) {
                if ($column == "false") {
                    array_push($hidden, $key);
                }
            }
        }

        return $hidden;
    }

    return [];
}

function wordRestrictions()
{
    $words = [];
    $roles = \Spatie\Permission\Models\Role::whereIn('name', auth()->user()->getRoleNames())->get();
    if (isset($roles[0])) {
        foreach ($roles as $key => $role) {
            $restrictions = array_map(function ($value) {
                return strtolower($value);
            }, isset(json_decode($role->word_restrictions, true)[0]) ? json_decode($role->word_restrictions, true) : []);
            if (isset($restrictions[0])) {
                foreach ($restrictions as $key => $restriction) {
                    array_push($words, $restriction);
                }
            }
        }
    }

    return array_unique($words);
}

function uniqueCode($length, $prefix, $table, $field)
{
    $prefix_length = strlen($prefix);
    $max_id = DB::table($table)->count($field);
    $new = (int)($max_id);
    $new++;
    $number_of_zero = $length - $prefix_length - strlen($new);
    $zero = str_repeat("0", $number_of_zero);
    $made_id = $prefix . $zero . $new;
    return $made_id;
}

function entryUniqueCode($length, $prefix, $table, $field)
{
    $prefix_length = strlen($prefix);
    $max_id = DB::table($table)->where(DB::raw('substr(`' . $field . '`, 1, ' . strlen($prefix) . ')'), $prefix)->max($field);
    $new = (int)(str_replace($prefix, '', $max_id));
    $new++;
    $number_of_zero = $length - $prefix_length - strlen($new);
    $zero = str_repeat("0", $number_of_zero);
    $made_id = $prefix . $zero . $new;
    return $made_id;
}

function uniqueCodeWithoutPrefix($length, $table, $field)
{
    $max = DB::table($table)->max($field);
    $new = (int)($max);
    $new++;
    $number_of_zero = $length - strlen($new);
    $zero = str_repeat("0", $number_of_zero);
    $made_id = $zero . $new;
    return $made_id;
}

function systemMoneyFormat($amount = 0, $symbol = '')
{
    return implode('.', explode('.', number_format($amount, 2))) . $symbol;
}

function systemDoubleValue($value, $digits = 4)
{
    return sprintf('%.' . $digits . 'f', floor($value * 10000 * ($value > 0 ? 1 : -1)) / 10000 * ($value > 0 ? 1 : -1));
}

function spaces($value, $extra = 0)
{
    $spaces = '';
    for ($i = 0; $i < ($value + $extra) * 6; $i++) {
        $spaces .= "&nbsp;";
    }
    return $spaces;
}

function activityNotification($type = null, $limit = null)
{
    return WebActivityLog::where('user_id', auth()->user()->id)
        ->when(!empty($type), function ($query) use ($type) {
            return $query->where('type', $type);
        })
        ->when(!empty($limit), function ($query) use ($limit) {
            return $query->limit($limit);
        })
        ->latest()
        ->get();
}

function socialMediaSettings()
{
    return session()->get('settings')['social-media'];
}

function walletSettings()
{
    return session()->get('settings')['wallet'];
}

function mailSettings()
{
    return session()->get('settings')['mailer'];
}

function languages()
{
    return session()->get('language-lists');
}

function convertToSlug($title): string
{
    return Str::slug($title);
}

function timeElapsedString($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function isOptionPermitted($option_name)
{
    return auth()->user()->hasPermissionTo($option_name);
}

function planTypes(){
    return [
        // 'daily' => 1,
        // 'weekly' => 7,
        'monthly' => 30,
        // 'half-yearly' => 180,
        // 'yearly' => 365
    ];
}

function languageValue($input = null, $lang = null){
    if(empty($lang)){
        $lang = session()->get('language');
    }

    if(!empty($input)){
        if(isset(json_decode($input, true)[$lang])){
            return json_decode($input, true)[$lang];
        }elseif(!is_array(json_decode($input, true))){
            return $input;
        }
    }
}

function languageValues($input = null){
    $languages = Modules\Language\app\Models\Language::all();

    $data = '<ul>';
    if(isset($languages[0])){
        foreach($languages as $language){
            $data .= '<li>'.$language->code.': '.languageValue($input, $language->code).'</li>';
        }
    }

    $data .= '</ul>';

    return $data;
}

function translate($slug, $language_code = null){
    if(empty($language_code)){
        $language_code = session()->get('language');
    }

    $languages = collect(session()->get('languages'));
    if($languages->where('slug', $slug)->where('language_code', $language_code)->count() > 0){
        return $languages->where('slug', $slug)->where('language_code', $language_code)->first()->translation;
    }
    
    return $slug;
}

function savelog($log){
    if(!empty($log)){
        \DB::table('logs')->insert([
            'log' => $log,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}

function serviceTypes(){
    return [
        'sellable' => "Sellable",
        'other-services-monthly-charge' => "Other Services (Monthly Charge)",
        'other-services-onetime-charge' => "Other Services (Onetime Charge)",
        'other-affiliate-services' => "Other Affiliate Services"
    ];
}

function viewMPDF($view, $data, $title, $filename, $format = 'a4', $orientation = 'P'){
	\PDF::loadView($view, $data, [], [
      'title'      => $title,
      'margin_top' => 0,
      'showImageErrors' => true,
      'format' => $format,
      'orientation' => $orientation,
      //'show_watermark_image' => true,
      //'display_mode' => 'fullpage',
      //'watermark_image_path' => public_path('/assets/idcard/letterhead/mbm_letterhead.png'),
      //'watermark_image_size'       => 'D',
    ])->stream($filename.'.pdf');
}

function outputMPDF($view, $data, $title, $filename, $format = 'a4', $orientation = 'P'){
	return \PDF::loadView($view, $data, [], [
      'title'      => $title,
      'margin_top' => 0,
      'showImageErrors' => true,
      'format' => $format,
    ])->output();
}

function downloadMPDF($view, $data, $title, $filename, $format = 'a4', $orientation = 'P'){
	\PDF::loadView($view, $data, [], [
      'title'      => $title,
      'margin_top' => 0,
      'showImageErrors' => true,
      'orientation' => $orientation
    ])->download($filename.'_'.date('Y-m-d g:i a').'.pdf');
}