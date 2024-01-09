<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'category_create',
            ],
            [
                'id'    => 18,
                'title' => 'category_edit',
            ],
            [
                'id'    => 19,
                'title' => 'category_show',
            ],
            [
                'id'    => 20,
                'title' => 'category_delete',
            ],
            [
                'id'    => 21,
                'title' => 'category_access',
            ],
            [
                'id'    => 22,
                'title' => 'type_event_access',
            ],
            [
                'id'    => 23,
                'title' => 'city_create',
            ],
            [
                'id'    => 24,
                'title' => 'city_edit',
            ],
            [
                'id'    => 25,
                'title' => 'city_show',
            ],
            [
                'id'    => 26,
                'title' => 'city_delete',
            ],
            [
                'id'    => 27,
                'title' => 'city_access',
            ],
            [
                'id'    => 28,
                'title' => 'slider_create',
            ],
            [
                'id'    => 29,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 30,
                'title' => 'slider_show',
            ],
            [
                'id'    => 31,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 32,
                'title' => 'slider_access',
            ],
            [
                'id'    => 33,
                'title' => 'artist_create',
            ],
            [
                'id'    => 34,
                'title' => 'artist_edit',
            ],
            [
                'id'    => 35,
                'title' => 'artist_show',
            ],
            [
                'id'    => 36,
                'title' => 'artist_delete',
            ],
            [
                'id'    => 37,
                'title' => 'artist_access',
            ],
            [
                'id'    => 38,
                'title' => 'type_create',
            ],
            [
                'id'    => 39,
                'title' => 'type_edit',
            ],
            [
                'id'    => 40,
                'title' => 'type_show',
            ],
            [
                'id'    => 41,
                'title' => 'type_delete',
            ],
            [
                'id'    => 42,
                'title' => 'type_access',
            ],
            [
                'id'    => 43,
                'title' => 'contact_show',
            ],
            [
                'id'    => 44,
                'title' => 'contact_delete',
            ],
            [
                'id'    => 45,
                'title' => 'contact_access',
            ],
            [
                'id'    => 46,
                'title' => 'tag_create',
            ],
            [
                'id'    => 47,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 48,
                'title' => 'tag_show',
            ],
            [
                'id'    => 49,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 50,
                'title' => 'tag_access',
            ],
            [
                'id'    => 51,
                'title' => 'event_create',
            ],
            [
                'id'    => 52,
                'title' => 'event_edit',
            ],
            [
                'id'    => 53,
                'title' => 'event_show',
            ],
            [
                'id'    => 54,
                'title' => 'event_delete',
            ],
            [
                'id'    => 55,
                'title' => 'event_access',
            ],
            [
                'id'    => 56,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 57,
                'title' => 'customer_show',
            ],
            [
                'id'    => 58,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 59,
                'title' => 'customer_access',
            ],
            [
                'id'    => 60,
                'title' => 'artist_tag_access',
            ],
            [
                'id'    => 61,
                'title' => 'ticket_show',
            ],
            [
                'id'    => 62,
                'title' => 'ticket_delete',
            ],
            [
                'id'    => 63,
                'title' => 'ticket_access',
            ],
            [
                'id'    => 64,
                'title' => 'zone_create',
            ],
            [
                'id'    => 65,
                'title' => 'zone_edit',
            ],
            [
                'id'    => 66,
                'title' => 'zone_show',
            ],
            [
                'id'    => 67,
                'title' => 'zone_delete',
            ],
            [
                'id'    => 68,
                'title' => 'zone_access',
            ],
            [
                'id'    => 69,
                'title' => 'carpooling_show',
            ],
            [
                'id'    => 70,
                'title' => 'carpooling_delete',
            ],
            [
                'id'    => 71,
                'title' => 'carpooling_access',
            ],
            [
                'id'    => 72,
                'title' => 'carpooling_request_show',
            ],
            [
                'id'    => 73,
                'title' => 'carpooling_request_delete',
            ],
            [
                'id'    => 74,
                'title' => 'carpooling_request_access',
            ],
            [
                'id'    => 75,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
