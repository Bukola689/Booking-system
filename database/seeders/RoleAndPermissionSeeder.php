<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // reset cached roles and permissions
//           app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

          
//           $addUser = 'add user';
//           $editUser = 'edit user';
//           $deleteUser = 'delete user';
//           $approveBusiness = 'approve user';
//           $suspendBusiness = 'suspend user';
  
//           $addBusiness = 'add business';
//           $editBusiness = 'edit business';
//           $deleteBusiness = 'delete business';

//           $addProductLine = 'add productline';
//           $editProductLine = 'edit productline';
//           $deleteProductLine = 'delete productline';

//           $addBrand = 'add brand';
//           $editBrand = 'edit brand';
//           $deleteBrand = 'delete brand';

//           $viewProduct = 'view product';
//           $addProduct = 'add product';
//           $editProduct = 'edit product';
//           $deleteProduct = 'delete product';

           
//           //user permisssion..//
//           Permission::create(['name' => $addUser]);
//           Permission::create(['name' => $editUser]);
//           Permission::create(['name' => $deleteUser]);
//           Permission::create(['name' => $approveStore]);
//           Permission::create(['name' => $suspendStore]);
  
//           Permission::create(['name' => $addStore]);
//           Permission::create(['name' => $editStore]);
//           Permission::create(['name' => $deleteStore]);
  
//           Permission::create(['name' => $addBrand]);
//           Permission::create(['name' => $editBrand]);
//           Permission::create(['name' => $deleteBrand]);
  
//           Permission::create(['name' => $addProductLine]);
//           Permission::create(['name' => $editProductLine]);
//           Permission::create(['name' => $deleteProductLine]);

//           Permission::create(['name' => $viewProduct]);
//           Permission::create(['name' => $addProduct]);
//           Permission::create(['name' => $editProduct]);
//           Permission::create(['name' => $deleteProduct]);
  
         
//             //...Roles...//
  
//             $superAdmin = 'super-admin';
//             $systemAdmin = 'system-admin';
//             $BookingOwner = 'business-owner';
//             $BookingAdmin = 'business-admin';
//             $customer = 'customer';

//         Role::create(['name' => $superAdmin])->givePermissionTo(Permission::all());

//                Role::create(['name' => $systemAdmin])->givePermissionTo([
//                   $addUser,
//                   $editUser,
//                   $deleteUser,
//                   $addBusiness,
//                   $editBusiness,
//                   $deleteBusiness,
//                   $approveBusiness,
//                   $suspendBusiness,
//               ]);
  
//               Role::create(['name' => $storeOwner])->givePermissionTo([
//                   $addStore,
//                   $editStore,
//                   $deleteStore,
//                   $addBrand,
//                   $editBrand,
//                   $deleteBrand,
//                   $addProductLine,
//                   $editProductLine,
//                   $deleteProductLine,
//                   $addProduct,
//                   $editProduct,
//                   $deleteProduct,
//               ]);
  
  
//           Role::create(['name' => $storeAdmin])->givePermissionTo([
//                   $addUser,
//                   $editUser,
//                   $deleteUser,
//                   $editBrand,
//                   $editProductLine,
//                   $addProduct,
//                   $editProduct,
//                   $deleteProduct,
//           ]);
  
//           Role::create(['name' => $customer])->givePermissionTo([
//               $viewProduct,
//           ]);
    }
 }

