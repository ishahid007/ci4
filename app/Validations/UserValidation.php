<?php

namespace App\Validations;

class UserValidation extends BaseValidation
{
    /**
     * Validation rules.
     *
     * @return array <string, string>
     */
    public function rules(): array
    {
        return [
            'username' => 'strip_tags|required|min_length[3]|max_length[20]|is_unique[users.username]',
            'status'   => 'required|in_list[1,0]',
            'active'   => 'required|in_list[1,0]',
        ];
    }
}
