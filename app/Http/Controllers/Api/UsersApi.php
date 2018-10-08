<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Hash;
use App\Geolocation\PermissionService;

class UsersApi extends Controller
{
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * @var App\Geolocation\PermissionService;
     */
    protected $permission;

    /**
     * Constructor
     */
    public function __construct(Request $request,  Auth $auth, PermissionService $permission)
    {
        $this->request = $request;
        $this->auth = $auth;
        $this->permission = $permission;
    }

    /**
     * Operation createUser
     *
     * Create User.
     *
     *
     * @return Http response
     */
    public function createUser()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'role_id' => 'bail|required|integer|min:1',
            'company_id' => 'nullable',
            'username' => 'required|min:4|max:50',
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|min:6|max:255',
            'email' => 'required|email|max:100',
            'full_name' => 'nullable|max:100',
            'phone_number' => 'nullable|max:50',
        ]);

        $role_id = trim($input['role_id']);
        $company_id = trim($input['company_id']);
        $username = trim($input['username']);
        $password = trim($input['password']);
        $confirm_password = trim($input['confirm_password']);
        $email = trim($input['email']);
        $full_name = trim($input['full_name']);
        $phone_number = trim($input['phone_number']);

        // check exist Role
        if (is_null(Role::find($role_id)))
            return response('Role does not exist', 404);

        // check exist Company
        if ((int) $company_id > 0 && is_null(Company::find($company_id)))
            return response('Company does not exist', 404);

        //check username already exist
        if (!is_null(User::where('username', $username)->first()))
            return response('Username already exist', 404);

        if ($password != $confirm_password)
            return response('Password does not match the confirm password.', 404);

        // add user
        $user = new User();
        $user->role_id = $role_id;
        $user->company_id = $company_id;
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->full_name = $full_name;
        $user->phone_number = $phone_number;

        if ($user->save())
            return User::where('id', $user['id'])->with('role', 'company')->first();

        return response('Error', 404);
    }

    /**
     * Operation listUsers
     *
     * List of Users.
     *
     *
     * @return Http response
     */
    public function listUsers()
    {
        // get list Users
        $users = User::with('role','company')->get();
        return $users->toArray();
    }

    /**
     * Operation deleteUser
     *
     * Delete a User.
     *
     * @param int $user_id user Id to delete (required)
     *
     * @return Http response
     */
    public function deleteUser($user_id)
    {
        if (empty($user_id) || (int)$user_id < 0)
            return response('Invalid ID supplied', 400);

        // get User
        $user = User::find($user_id);

        if (is_null($user))
            return response('Not found', 404);

        if ($user->delete())
            return response('OK', 200);

        return response('Error', 404);
    }

    /**
     * Operation getUserById
     *
     * Find User by ID.
     *
     * @param int $user_id ID of User to return (required)
     *
     * @return Http response
     */
    public function getUserById($user_id)
    {
        if (empty($user_id) || (int)$user_id < 0)
            return response('Invalid ID supplied', 400);

        // get user
        $user = User::where('id', $user_id)->with('role', 'company')->first();

        if (is_null($user))
            return response('Not found', 404);

        return $user;
    }

    /**
     * Operation updateUser
     *
     * Updates a User.
     *
     * @param int $user_id ID of user that needs to be user (required)
     *
     * @return Http response
     */
    public function updateUser($user_id)
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'role_id' => 'bail|required|integer|min:1',
            'company_id' => 'nullable',
            'username' => 'required|min:4|max:50',
            'email' => 'required|email|max:100',
            'full_name' => 'nullable|max:100',
            'phone_number' => 'nullable|max:50',
        ]);

        if (empty($user_id) || (int)$user_id < 0)
            return response('Invalid ID supplied', 400);

        // get User
        $user = User::find($user_id);

        if (is_null($user)) return response('Not found', 404);

        // set data
        $role_id = $input['role_id'];
        $company_id = $input['company_id'];
        $username = trim($input['username']);
        $email = trim($input['email']);
        $full_name = trim($input['full_name']);
        $phone_number = trim($input['phone_number']);

        // check exist Role
        if (is_null(Role::find($role_id)))
            return response('Role does not exist', 404);

        // check exist Company
        if ((int) $company_id > 0 && is_null(Company::find($company_id)))
            return response('Company does not exist', 404);

        //check username already exist
        if ($user->username != $username) {

            if (!is_null(User::where('username', $username)->first()))
                return response('Username already exist', 404);
        }

        // update user
        $user->role_id = $role_id;
        $user->company_id = $company_id;
        $user->username = $username;
        $user->email = $email;
        $user->full_name = $full_name;
        $user->phone_number = $phone_number;

        if ($user->save())
            return User::where('id', $user->id)->with('role', 'company')->first();

        return response('Error', 404);
    }

    /**
     * Operation changePasswordOfUser
     *
     * change password of User.
     *
     * @param int $user_id ID of user that needs to be user (required)
     *
     * @return Http response
     */
    public function changePasswordOfUser($user_id)
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'current_password' => 'required|min:6|max:255',
            'new_password' => 'required|min:6|max:255',
            'confirm_password' => 'required|min:6|max:255'
        ]);

        if (empty($user_id) || (int)$user_id < 0)
            return response('Invalid ID supplied', 400);

        $password = trim($input['current_password']);
        $new_password = trim($input['new_password']);
        $confirm_password = trim($input['confirm_password']);

        // get User
        $user = User::find($user_id);

        if (is_null($user)) return response('Not found', 404);

        // check current password
        if (!Hash::check($password, $user->password))
            return response('The current password is incorrect.', 404);

        // check match
        if ($new_password != $confirm_password)
            return response('Password does not match the confirm password.', 404);

        //update password
        $user->password = Hash::make($new_password);

        if ($user->save())
            return User::where('id', $user['id'])->with('role', 'company')->first();

        return response('Error', 404);
    }
}
