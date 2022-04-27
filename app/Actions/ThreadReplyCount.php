<?php

namespace App\Actions;

use App\Models\ThreadReply;
use TCG\Voyager\Actions\AbstractAction;

class ThreadReplyCount extends AbstractAction
{
    public function getTitle()
    {
        $this -> num_replies = ThreadReply::where('thread_id', $this -> data -> id) -> count() ;
        if ($this -> num_replies == 0){
            return 'No Replies';
        }
        if ($this -> num_replies == 1){
            return $this -> num_replies . ' Reply';
        } else {
            return $this -> num_replies . ' Replies';
        }
        
    }

    public function getIcon()
    {
        return '';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        $color = ($this -> num_replies == 0) ? 'danger' : 'success';
        // dump($color);
        return [
            'class' => 'disabled badge badge-'.$color,
            'style' => 'padding: 5px 10px'
        ];
    }

    public function getDefaultRoute()
    {
        return '#';
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
