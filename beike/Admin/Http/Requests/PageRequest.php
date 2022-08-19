<?php
/**
 * AdminUserRequest.php
 *
 * @copyright  2022 opencart.cn - All Rights Reserved
 * @link       http://www.guangdawangluo.com
 * @author     Edward Yang <yangjin@opencart.cn>
 * @created    2022-08-15 18:58:20
 * @modified   2022-08-15 18:58:20
 */

namespace Beike\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'descriptions.*.title' => 'required|string|min:3|max:32',
            'descriptions.*.content' => 'required|string',
            'descriptions.*.locale' => 'required|string',
        ];

        return $rules;
    }
}