<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kodeine\Acl\Traits\HasRole;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','address','city','phone_number'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function role(){
		return $this->hasOne('App\Role','id','role_id');
	}

	public function hasRole($roles){
		$this->have_role = $this->getUserRole();

		//Check if the user is a admin account
		if(count($this->have_role) > 0){
				if($this->have_role->name == 'administrator'){
				return true;
			}
		}else{
			echo 'You do not have necessary access here!';
			die();
		}

		if(is_array($roles)){
			foreach($roles as $need_role){
				if($this->checkIfUserHasRole($need_role)){
					return true;
				}
			}
		}else{
			return $this->checkIfUserHasRole($roles);
		}
		return false;
	}

	private function getUserRole(){
		return $this->role()->getResults();
	}

	private function checkIfUserHasRole($need_role){
		return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
	}

}
