<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ViewThread extends AbstractAction
{
    public function getTitle()
    {
        return 'Reply';
    }

    public function getIcon()
    {
        return 'voyager-chat';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success ',
        ];
    }

    public function getDefaultRoute()
    {
        return route('threads.show.admin', ['thread' => $this -> data -> id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'threads';
    }

    public function shouldActionDisplayOnRow($row)
    {
        return true;
        // return $row-> organization_state_id == 1;
    }

}
