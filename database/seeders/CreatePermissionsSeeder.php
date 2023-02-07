<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $aPanel = Permission::create(['name' => 'admin-panel']);
      $showUser = Permission::create(['name' => 'user-show']);
      $addUser = Permission::create(['name' => 'user-add']);
      $editUser = Permission::create(['name' => 'user-edit']);
      $editUserMore = Permission::create(['name' => 'user-edit-more']);
      $deleteUser = Permission::create(['name' => 'user-delete']);
      $banUser = Permission::create(['name' => 'user-ban']);
      $userRole = Permission::create(['name' => 'user-role']);
      $userTabInfo = Permission::create(['name' => 'user-tab-info']);
      $userTabExpert = Permission::create(['name' => 'user-tab-expert']);
      $userTabProduct = Permission::create(['name' => 'user-tab-product']);
      $userTabAuthor = Permission::create(['name' => 'user-tab-author']);
      $userTabCompany = Permission::create(['name' => 'user-tab-company']);
      $userTabEmployee = Permission::create(['name' => 'user-tab-employee']);
      $userTabOrder = Permission::create(['name' => 'user-tab-order']);
      $userTabArticles = Permission::create(['name' => 'user-tab-articles']);

      $productShow = Permission::create(['name' => 'product-show']);
      $productAdd = Permission::create(['name' => 'product-add']);
      $productEdit = Permission::create(['name' => 'product-edit']);
      $productDelete = Permission::create(['name' => 'product-delete']);

      $categoryShow = Permission::create(['name' => 'category-show']);
      $categoryAdd = Permission::create(['name' => 'category-add']);
      $categoryEdit = Permission::create(['name' => 'category-edit']);
      $categoryDelete = Permission::create(['name' => 'category-delete']);

      $tagShow = Permission::create(['name' => 'tag-show']);
      $tagAdd = Permission::create(['name' => 'tag-add']);
      $tagEdit = Permission::create(['name' => 'tag-edit']);
      $tagDelete = Permission::create(['name' => 'tag-delete']);

      $uPanel = Permission::create(['name' => 'user-panel']);



      $aPanel->assignRole('admin');
      $showUser->assignRole('admin');
      $addUser->assignRole('admin');
      $editUser->assignRole('admin');
      $deleteUser->assignRole('admin');
      $editUserMore->assignRole('admin');
      $banUser->assignRole('admin');
      $userRole->assignRole('admin');

      $uPanel->assignRole('user');

      $aPanel->assignRole('employee');
      $showUser->assignRole('employee');

      $aPanel->assignRole('support');
      $showUser->assignRole('support');
      $addUser->assignRole('support');
      $editUser->assignRole('support');
    }
}
