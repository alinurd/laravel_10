<?php

namespace App\Services;

use App\Models\Groups;
use App\Models\GroupUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
  public function create(Request $request)
{
      $user = User::create([
      'password' => Hash::make(!blank($request->password) ? $request->password : '$$admin$$'),
      'verified' => (int) !blank($request->verified) ? 1 : 0, // pastikan ID valid
      'name' => $request->name, // pastikan ID valid
      'email' => $request->email, // pastikan ID valid
      'email_verified_at' => now()
     ]);

        if ($user) {  
   
       $gu = GroupUsers::create([
          'user_id' => $user->id,
          'group_id' => $request->role, // pastikan ID valid
      ]);
      
    }
     return true;
 }

  public function update(Request $request, User $user): User|bool
  {
    
  
    $g = Groups::where('name', $request->roles)->firstOrFail();
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
        'email_verified_at' => now(),
        'verified' => (int) !blank($request->verified),

        // 'verified' => !blank($request->verified) ? 1 : 0, // pastikan ID valid
        'password' => !blank($request->password) ? Hash::make($request->password) : $user->password,

      )
    ));

    
  }
}
