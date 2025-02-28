<?php

class BaseClass
{

    // Function map array to class
    public function mapToClass(array $data): void
    {
        //TODO: Obviously needs a lot of validations + including the validation to the array and connections between entities would be great (Faction instead of startingFaction..)
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
