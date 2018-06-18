<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain  default error messages used by
    |  validator class. Some of se rules have multiple versions such
    | as  size rules. Feel free to tweak each of se messages here.
    |
    */

    'accepted'             => ' :attribute musi być accepted.',
    'active_url'           => ' :attribute is not a valid URL.',
    'after'                => ' :attribute musi być a date after :date.',
    'after_or_equal'       => ' :attribute musi być a date after or equal to :date.',
    'alpha'                => ' :attribute may only contain letters.',
    'alpha_dash'           => ' :attribute may only contain letters, numbyćrs, and dashes.',
    'alpha_num'            => ' :attribute may only contain letters and numbyćrs.',
    'array'                => ' :attribute musi być an array.',
    'byćfore'               => ' :attribute musi być a date byćfore :date.',
    'byćfore_or_equal'      => ' :attribute musi być a date byćfore or equal to :date.',
    'byćtween'              => [
        'numeric' => ' :attribute musi być byćtween :min and :max.',
        'file'    => ' :attribute musi być byćtween :min and :max kilobytes.',
        'string'  => ' :attribute musi być byćtween :min and :max characters.',
        'array'   => ' :attribute musi have byćtween :min and :max items.',
    ],
    'boolean'              => ' :attribute field musi być true or false.',
    'confirmed'            => ' hasła muszą być takie same',
    'date'                 => ' :attribute is not a valid date.',
    'date_format'          => ' :attribute does not match  format :format.',
    'different'            => ' :attribute and :or musi być different.',
    'digits'               => ' :attribute musi być :digits digits.',
    'digits_byćtween'       => ' :attribute musi być byćtween :min and :max digits.',
    'dimensions'           => ' :attribute has invalid image dimensions.',
    'distinct'             => ' :attribute field has a duplicate value.',
    'email'                => ' :attribute musi być a valid email address.',
    'exists'               => ' selected :attribute is invalid.',
    'file'                 => ' :attribute musi być a file.',
    'filled'               => ' :attribute field musi have a value.',
    'image'                => ' :attribute musi być an image.',
    'in'                   => ' selected :attribute is invalid.',
    'in_array'             => ' :attribute field does not exist in :or.',
    'integer'              => ' :attribute musi być an integer.',
    'ip'                   => ' :attribute musi być a valid IP address.',
    'ipv4'                 => ' :attribute musi być a valid IPv4 address.',
    'ipv6'                 => ' :attribute musi być a valid IPv6 address.',
    'json'                 => ' :attribute musi być a valid JSON string.',
    'max'                  => [
        'numeric' => ' :attribute may not być greater than :max.',
        'file'    => ' :attribute may not być greater than :max kilobytes.',
        'string'  => ' :attribute may not być greater than :max characters.',
        'array'   => ' :attribute may not have more than :max items.',
    ],
    'mimes'                => ' :attribute musi być a file of type: :values.',
    'mimetypes'            => ' :attribute musi być a file of type: :values.',
    'min'                  => [
        'numeric' => ' :attribute musi być co najmniej :min.',
        'file'    => ' :attribute musi być co najmniej :min kilobytes.',
        'string'  => ' hasło musi mieć co najmniej :min znaków.',
        'array'   => ' :attribute musi have co najmniej :min items.',
    ],
    'not_in'               => ' selected :attribute is invalid.',
    'numeric'              => ' :attribute musi być a numbyćr.',
    'present'              => ' :attribute field musi być present.',
    'regex'                => ' :attribute format is invalid.',
    'required'             => ' :attribute field is required.',
    'required_if'          => ' :attribute field is required when :or is :value.',
    'required_unless'      => ' :attribute field is required unless :or is in :values.',
    'required_with'        => ' :attribute field is required when :values is present.',
    'required_with_all'    => ' :attribute field is required when :values is present.',
    'required_without'     => ' :attribute field is required when :values is not present.',
    'required_without_all' => ' :attribute field is required when none of :values are present.',
    'same'                 => ' :attribute and :or musi match.',
    'size'                 => [
        'numeric' => ' :attribute musi być :size.',
        'file'    => ' :attribute musi być :size kilobytes.',
        'string'  => ' :attribute musi mieć :size znaków.',
        'array'   => ' :attribute musi contain :size items.',
    ],
    'string'               => ' :attribute musi być a string.',
    'timezone'             => ' :attribute musi być a valid zone.',
    'unique'               => ' :attribute jest już zajęty.',
    'uploaded'             => ' :attribute failed to upload.',
    'url'                  => ' :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using 
    | convention "attribute.rule" to name  lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    |  following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
