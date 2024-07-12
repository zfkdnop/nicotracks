<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Templates
     * --------------------------------------------------------------------------
     *
     * Pagination links are rendered out using views to configure their
     * appearance. This array contains aliases and the view names to
     * use when rendering the links.
     *
     * Within each view, the Pager object will be available as $pager,
     * and the desired group as $pagerGroup;
     *
     * @var array<string, string>
     */
    public array $templates = [
        // 'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        // 'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        // 'default_head'   => 'CodeIgniter\Pdefaults\default_head',
        'default_full'  => 'App\Views\Pagers\default_full',
        'default_simple'  => 'App\Views\Pagers\default_simple',
        'default_head'  => 'App\Views\Pagers\default_head',
    ];

    /**
     * --------------------------------------------------------------------------
     * Items Per Page
     * --------------------------------------------------------------------------
     *
     * The default number of results shown in a single page.
     */
    public int $perPage = 20;
}
