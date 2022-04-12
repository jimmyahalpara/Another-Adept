<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class PayoutAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Approve';
    }

    public function getIcon()
    {
        return 'voyager-check';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('organizations.payout.confirmation', ['payout' => $this -> data -> id]);
        return route('home');
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'organization-payouts';
    }

    public function shouldActionDisplayOnRow($row)
    {
        // return true;
        return $row-> status == 0;
    }

}
