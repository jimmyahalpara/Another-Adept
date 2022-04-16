<?php

namespace App\Actions;

use App\Models\Organization;
use TCG\Voyager\Actions\AbstractAction;

class MyAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Activate';
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
        // dd($this -> data -> documents -> first() -> document_path);
        $document = Organization::find($this -> data -> id) -> documents() -> first();
        // dd($document);
        return route('organizations.active.confirmation', [
            'organization' => $this -> data -> id,
            'document_path' => $document -> document_path,
        ]);
    }

    public function shouldActionDisplayOnDataType()
    {

        return $this->dataType->slug == 'organizations';
    }

    public function shouldActionDisplayOnRow($row)
    {
        return $row-> organization_state_id == 1;
    }

}
