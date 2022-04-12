<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ViewInvoicePDF extends AbstractAction
{
    public function getTitle()
    {
        return 'PDF';
    }

    public function getIcon()
    {
        return 'voyager-eye';
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
        return route('invoice.pdf.view', ['invoice' => $this -> data -> id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        // return true;

        return $this->dataType->slug == 'invoices';
    }

    public function shouldActionDisplayOnRow($row)
    {
        return true;
        // return $row-> organization_state_id == 1;
    }

}
