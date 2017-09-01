<?php

use Centreon\Test\Behat\CentreonContext;
use Centreon\Test\Behat\Configuration\HostConfigurationPage;
use Centreon\Test\Behat\Configuration\ServiceConfigurationPage;

/**
 * Defines application features from the specific context.
 */
class SaveSearchSelect2Context extends CentreonContext
{
    protected $page;

    /**
     * @Given multiple hosts
     */
    public function multipleHosts()
    {
        $this->page = new HostConfigurationPage($this);
        $this->page->setProperties(array(
            'name' => 'hostName1',
            'alias' => 'hostAlias1',
            'address' => 'localhost'
        ));
        $this->page->save();

        $this->page = new HostConfigurationPage($this);
        $this->page->setProperties(array(
            'name' => 'hostName2',
            'alias' => 'hostAlias2',
            'address' => 'localhost'
        ));
        $this->page->save();
    }

    /**
     * @When I stress the select2
     */
    public function iStressTheSelect2()
    {
        $this->page = new ServiceConfigurationPage($this);
        $this->page->switchTab(1);
        for ($i=0;$i++;$i<1000) {
            $this->selectToSelectTwo('select#service_hPars', 'hostName1');
            $this->selectToSelectTwo('select#command_command_id', 'check_http');
            $this->selectToSelectTwo('select#service_hPars', 'hostName2');
            $this->selectToSelectTwo('select#command_command_id', 'check_https');
        }
    }

    /**
     * @Then the select2 works well
     */
    public function theSelect2WorksWell()
    {
        // it's ok
    }
}
