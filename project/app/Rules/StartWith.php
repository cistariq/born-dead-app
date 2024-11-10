<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class StartWith implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected  $start_num1 ,$start_num2;
    public function __construct($start_num1,$start_num2)
    {
        $this->start_num1 = $start_num1;
        $this->start_num2 = $start_num2;
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
        return Str::startsWith($value, $this->start_num1) || Str::startsWith($value, $this->start_num2);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'رقم الجوال يجب أن يبدأ ب '. $this->start_num1 . ' أو '.$this->start_num2;
    }
}
