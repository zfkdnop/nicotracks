<?php
namespace App\Publishers;

use CodeIgniter\Publisher\Publisher;

/**
 * https://codeigniter.com/user_guide/libraries/publisher.html#asset-dependencies-example
 * A publisher handles copying files into the project
 * This is a MANUAL action! This must be manually executed by the dev team (as below)
 * 
 ** Now add the dependency via Composer and call spark publish to run the publication:
 **   > composer require twbs/bootstrap
 **   > php spark publish
 */
class BootskrapPublisher extends Publisher {
    // bootstrap is maintained via composer, so its downloaded into the VENDORPATH
    protected $source = VENDORPATH . 'twbs/bootstrap/';

    // assets are copied into the destination ($destination must already exist before automation can occur)
    protected $destination = FCPATH . 'bootshkrap';

    // this is the function that automates "installing" the asset(s) into our app/project
    public function publish(): bool {
        return $this
                // files/directories to be "installed"; relative to $source
                // ${source}/dist == vendor/twbs/bootstrap/dist
                ->addPath('dist')

                // only install the minimized versions (only copy files matching this pattern)
                ->retainPattern('*.min.*')

                // merge & replace to retain original directory structure
                ->merge(true);
    }
}