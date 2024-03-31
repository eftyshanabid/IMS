<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Language\app\Models\LanguageLibrary;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Make a language permission

        $languages = [
            'SL', 'Name', 'URL', 'Menu For', 'Sub Menu', 'Status', 'Created At', 'Action', 'Add New Menu', 'No Menu Data', 'Menu Lists', 'Icon Class', 'Serial', 'Menu For', 'Open New Tab', 'Permission', 'Submit', 'Update', 'Email', 'Phone',
            'Profile Photo', 'Assigned Role', 'Main Menu Lists', 'SL',
            'Menu', 'Sub Menu', 'URL', 'Menu For', 'Status', 'Created At', 'Action', 'Founder', "Follow", "Message", "About Me", "Full Name", "Mobile", "Email", "Location", "Personal Info", "Name", "User Name", "Bio", "Phone", "Email Address", "Password", "Profile Photo", "avatar", "Company Info", "Company Name", "Website", "Location", "Social", "Facebook", "Twitter", "Instagram", "Linkedin", "Skype", "Github", "Save", 'Role Name', 'Guard name', 'Word Restrictions', 'Add New User', 'User Details', 'Profile Photo', 'Assigned Role', 'Confirm Password', 'Allow Permissions', 'Check all Permissions', 'Allow Permissions', 'Save User', 'Cancel', 'Add New Document Type', 'Document Types', 'Title', 'Add New Service',
            'Service Details', 'Languages', 'Add New Language', 'Plan', 'Documents', 'Reports', 'Subject', 'Description', 'Subject', 'Description', 'Report Documents', 'Upload Reports', 'Documents', 'Mail Mailer', 'Mail Host', 'Mail Port', 'Mail User Name', 'User Password', 'Encryption', 'From Address', 'Mail Name', 'App Secret key', 'API Key', 'App Version', 'CallBack Url', 'Cancel URL', 'Official Email', 'Official Phone Number', 'Website Logo', 'Favicon', 'Call', 'Welcome to', 'Home', 'About Us', 'Quick Links', 'About Us', 'Benifits', 'Plan and Price', 'Contact', 'Privacy Policy', 'Term Of Use', 'FAQs',
            'Position', 'Phone', 'Address', 'Zip', 'Business Structure', 'TAX Filling Status', 'TAX ID', 'Update Business Information',
            'Current Password', 'New Password', 'Confirm Password', 'Update Password', 'View All Documents', 'Home', 'Documents', 'Documents', 'Upload Documents', 'SL', 'Code', 'Year', 'Month', 'Subject', 'Status', 'Options', 'Reports', 'View Document',
            'Total Monthly', 'Payment', 'Additional Services', 'Total Amount', 'Subscribed form', 'Agreement', 'Additional Monthly Services', 'Proceed to Next', 'Year', 'Month'
        ];

        if (isset($languages) && count($languages) > 0) {
            foreach ($languages as $language_id => $translation) {
                LanguageLibrary::updateOrCreate([
                    'slug' => $translation,
                    'language_id' => 1
                ], [
                    'translation' => $translation
                ]);
            }

            foreach ($languages as $language_id => $translation) {
                LanguageLibrary::updateOrCreate([
                    'slug' => $translation,
                    'language_id' => 2
                ], [
                    'translation' => $translation
                ]);
            }
        }
    }
}
