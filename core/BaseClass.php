<?php

class BaseClass
{

    public function __construct(array $data)
    {
        $this->mapToClass($data);
    }

    /**
     * Maps the Data Array to the classes variables
     * @param array $data
     * @param array $ignore this is currently "optional", but this leaves out some of the variables (currently needed for models in a model)
     * @return void
     */
    public function mapToClass(array $data, array $ignore = []): void
    {
        //TODO: Obviously needs a lot of validations + including the validation to the array and connections between entities would be great (Faction instead of startingFaction..)

        $reflect = new ReflectionClass($this);
        $props = $reflect->getProperties();
        foreach ($props as $prop) {
            $propName = $prop->getName();
            if (array_key_exists($propName, $data)) {
                if ($prop->getType()->getName() == "DateTime") {
                    $date = new Datetime($data[$prop->getName()]);
                    $this->$propName = $date;
                } else {

                    $this->$propName = $data[$prop->getName()];
                }
            }
        }
    }
}
