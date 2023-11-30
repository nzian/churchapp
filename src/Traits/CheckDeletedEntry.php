<?php

declare(strict_types=1);

namespace App\Traits;

trait CheckDeletedEntry
{
    public function removeDeletedEntries(array $entries): array
    {
        $main_entries = [];
        if(is_array($entries) && count($entries) > 0) :
            foreach($entries as $entry) :
                if($entry['deleted_at'] == null):
                    $main_entries[] = $entry;
                endif;
            endforeach;
        endif;

        return $main_entries;
    }
    public function removeDeletedEntry(object $entry): null|object
    {
        if(is_object($entry) && isset($entry->deleted_at)) :
            if(strlen($entry->deleted_at) > 0):
                return null;
            endif;
        endif;
        return $entry;

    }
}
