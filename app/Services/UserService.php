<?php

namespace App\Services;

use App\Models\Groups;
use App\Models\GroupUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
  public function create(Request $request): User
{
    // Membuat pengguna baru
    $user = User::create(array_merge(
        $request->validated(),
        [
            'password' => Hash::make('password'),
            'email_verified_at' => !blank($request->verified) ? now() : null
        ]
    ));

    // Mengambil grup berdasarkan nama yang diberikan
    $g = Groups::where('name', $request->role)->firstOrFail(); // Menggunakan firstOrFail untuk memastikan data ditemukan
   
        if ($g) {
      $groupId = (string) $g->id;  
   
      return  GroupUsers::create([
          'user_id' => $user->id,
          'group_id' => $groupId, // pastikan ID valid
      ]);
      
    }
 
 }

  public function update(Request $request, User $user): User|bool
  {
    
    $g = Groups::where('name', $request->role)->firstOrFail();

    if ($g) {
        $groupId = (string) $g->id;  
    
        GroupUsers::updateOrCreate(
            [
                'user_id' => $request->user_id,
             ],
            [
                'group_id' => $groupId, 
            ]
        );
    }
    
    $email = $request->email === $user->email
      ? $request->email
      : (blank(User::firstWhere('email', $request->email)) ? $request->email : null);

    return blank($email) ? false : $user->update(array_merge(
      $request->validated(),
      array(
        'email' => $email,
        'email_verified_at' => !blank($request->verified) ? now() : null
      )
    ));
  }
}
