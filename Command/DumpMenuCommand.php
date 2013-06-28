<?php
/**
 * This file is part of VinceTAdminBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */

namespace VinceT\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use VinceT\AdminBundle\Menu\MenuItem;


/**
 * This file is part of VinceTAdminBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class DumpMenuCommand extends ContainerAwareCommand
{
    /**
     * configure command
     *
     * @return null
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('vincet:admin:dump-menu')
            ->setDescription('Dump the admin menu')
            ->setHelp(
<<<EOF
The <info>vincet:admin:dump-menu</info> command dumps the admin menu.
EOF
            );
    }

    /**
     * execute command
     *
     * @param InputInterface  $input  InputInterface instance
     * @param OutputInterface $output OutputInterface instance
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $menuBuilder = $this->getContainer()->get('vince_t.admin.menu.builder');

        $menu = $menuBuilder->createMainMenu(new Request());

        $this->_printMenu($output, $menu);
    }

    /**
     * [_printMenu description]
     *
     * @param OutputInterface $output [description]
     * @param MenuItem        $menu   [description]
     * @param integer         $depth  [description]
     *
     * @return [type]
     */
    private function _printMenu(OutputInterface $output, MenuItem $menu, $depth = 0)
    {
        $prefix = '';
        if ( $depth != 0 ) {
            $prefix = '|->';
            if ( $depth > 1 ) {
                $prefix = str_repeat('    ', $depth - 1).$prefix;
            }
        }
        $line = sprintf(
            '%s <info>%s</info> : <comment>%s</comment> (%s)',
            $prefix,
            $menu->getName(),
            $menu->getUri(),
            $menu->getTranslationDomain()
        );
        $output->writeln($line);
        foreach ($menu->getChildren() as $child) {
            $this->_printMenu($output, $child, $depth+1);
        }
    }
}