<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class OrderMember extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

    public $sortable = [
        'user_organization_membership_id',
        'id',
        'service_order_id',
        'order_member_state_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function service_order()
    {
        return $this -> belongsTo(ServiceOrder::class);
    }

    public function user_organization_membership(){
        return $this -> belongsTo(UserOrganizationMembership::class);
    }

    public function order_member_state()
    {
        return $this -> belongsTo(OrderMemberState::class);
    }



}
