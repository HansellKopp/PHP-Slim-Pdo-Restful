<?php
namespace App\Models;

class CompanyModel
{
    /**
    * @var string
    */
    const TABLE = 'company';

    /**
    * @var array
    */
    const FIELDS = [
      'id',
      'taxId',
      'name',
      'address',
      'email',
      'phoneNumber'
    ];
}
