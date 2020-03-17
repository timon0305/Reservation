<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/27/2019
 * Time: 12:59 PM
 */

namespace App\Http\Helper;
use Illuminate\Contracts\Validation\Rule;

class MimeCheckRules implements Rule
{
    protected $customValue;

    public function __construct(array $customValue)
    {
        $this->customValue = $customValue;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $ext = $value->getClientOriginalExtension();
        return in_array($ext, $this->customValue);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a file of type:'.implode(',',$this->customValue).'.';
    }
}