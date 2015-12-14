<?php

namespace Concrete\Core\Express\Form\Control\Type;

use Concrete\Core\Entity\Express\Control\AttributeKeyControl;
use Concrete\Core\Entity\Express\Entity;
use Concrete\Core\Express\Form\Control\Type\Item\AttributeKeyItem;
use Doctrine\ORM\EntityManager;

class AttributeKeyType implements TypeInterface {

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getPluralDisplayName()
    {
        return t('Attributes');
    }

    public function getDisplayName()
    {
        return t('Attribute Key');
    }

    public function getItems(Entity $entity)
    {
        $r = $this->entityManager->getRepository('\Concrete\Core\Entity\Express\Attribute');
        $keys = $r->findByEntity($entity, array('id' => 'asc'));
        $items = array();
        foreach($keys as $attribute) {
            $item = new AttributeKeyItem($attribute->getAttribute());
            $items[] = $item;
        }
        return $items;
    }

    public function createControlByIdentifier($id)
    {
        $r = $this->entityManager->getRepository('\Concrete\Core\Entity\AttributeKey\AttributeKey');
        $key = $r->findOneBy(array('akID' => $id));
        $control = new AttributeKeyControl();
        $control->setAttributeKey($key);
        return $control;
    }



}