<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 21.8.2020
 * Time: 01:25
 */

namespace App\Core;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponserTrait;

class BaseController extends Controller
{
    use ApiResponserTrait;
}
