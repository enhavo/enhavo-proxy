<?php
/**
 * ControlBlock.php
 *
 * @since 17/04/17
 * @author gseidel
 */

namespace App\Block;

use Enhavo\Bundle\AppBundle\Block\BlockInterface;
use Enhavo\Bundle\AppBundle\Type\AbstractType;

class ControlBlock extends AbstractType implements BlockInterface
{
    public function render($parameters)
    {
        return $this->renderTemplate('App:Block:control.html.twig', [
            'app' => 'project/Dashboard'
        ]);
    }

    public function getType()
    {
        return 'control';
    }
}