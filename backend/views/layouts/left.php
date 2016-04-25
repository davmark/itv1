<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Admin</p>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['/']],
                    ['label' => 'Users', 'icon' => 'fa fa-users', 'url' => ['/users']],
                    [
                        'label' => 'Countries',
                        'icon' => 'fa fa-fw fa-globe',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/countries'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/countries/create'],],
                        ],
                    ],
                    [
                        'label' => 'Tvs',
                        'icon' => 'fa fa-fw fa-tv',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/tvs'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/tvs/create'],],
                        ],
                    ],
                    [
                        'label' => 'categories',
                        'icon' => 'fa fa-fw fa-soccer-ball-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/categories'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/categories/create'],],
                        ],
                    ],
                    [
                        'label' => 'Shows',
                        'icon' => 'fa fa-fw fa-video-camera',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/shows'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/shows/create'],],
                        ],
                    ],
                    [
                        'label' => 'Programs',
                        'icon' => 'fa fa-fw fa-youtube-play',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/programs'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/programs/create'],],
                        ],
                    ],
                    [
                        'label' => 'Time Lines',
                        'icon' => 'fa fa-fw fa-calendar-times-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/time-lines'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/time-lines/create'],],
                        ],
                    ],
                    [
                        'label' => 'Comments',
                        'icon' => 'fa fa-fw fa-commenting',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/comments'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/comments/create'],],
                        ],
                    ],
                    [
                        'label' => 'Languages',
                        'icon' => 'fa fa-fw fa-language',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/languages'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/languages/create'],],
                        ],
                    ],

                    [
                        'label' => 'banners',
                        'icon' => 'fa fa-fw fa-cc-diners-club',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/banners'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/banners/create'],],
                        ],
                    ],

                    [
                        'label' => 'sliders',
                        'icon' => 'fa fa-fw fa-cc-diners-club',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'fa fa-fw fa-list-alt', 'url' => ['/sliders'],],
                            ['label' => 'Add', 'icon' => 'fa fa-fw fa-plus', 'url' => ['/sliders/create'],],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
