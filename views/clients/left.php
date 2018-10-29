<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    /*['label' => 'Contract Review', 'icon' => '  fa-mail-forward (alias)', 'url' => ['/contract-review']],
                    ['label' => 'Customer Complaint Record', 'icon' => '  fa-mail-forward (alias)', 'url' => ['/customer-complaint-record']],*/
                    [
                        'label' => 'Marketing',
                        'icon' => '  fa-mail-forward (alias)',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Customer Requirements', 'icon' => '', 'url' => ['/customer-requirements']],
                        ],
                    ],
                    [
                        'label' => 'Masters',
                        'icon' => '  fa-mail-forward (alias)',
                        'url' => '#',
                        'items' => [

                            ['label' => 'Employees', 'icon' => '', 'url' => ['/users']],
                            ['label' => 'Clients', 'icon' => '', 'url' => ['/clients']],
                            ['label' => 'Product Masters', 'icon' => '', 'url' => ['/product-master']],
                            ['label' => 'Purchase Masters', 'icon' => '', 'url' => ['/product-master?type=purchase']],
                            ['label' => 'Vendor Master', 'icon' => '', 'url' => ['/vendors']],
                            ['label' => 'Operation Master', 'icon' => '', 'url' => ['/operation-master']],
                            ['label' => 'Parameter Master', 'icon' => '', 'url' => ['/parameters']],
                            ['label' => 'Masure Of Units Master', 'icon' => '', 'url' => ['/units-of-measures']],
                            ['label' => 'Instrument Master', 'icon' => '', 'url' => ['/instrument-master']],
                            ['label' => 'Machine Master', 'icon' => '', 'url' => ['/machine-master']],
                            ['label' => 'Process Master', 'icon' => '', 'url' => ['/process-master']],
                            ['label' => 'Documents And Distribution Master', 'icon' => '', 'url' => ['/documents-and-distribution-master']],
                            /*['label' => 'Quality Records', 'icon' => '', 'url' => ['/quality-record']],
                            ['label' => 'Responsibilities', 'icon' => '', 'url' => ['/responsibility']],
                            ['label' => 'Supplier Masters', 'icon' => '', 'url' => ['/supplier-master']],*/
                            // [
                            //     'label' => 'Level One',
                            //     'icon' => 'circle-o',
                            //     'url' => '#',
                            //     'items' => [
                            //         ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                            //         [
                            //             'label' => 'Level Two',
                            //             'icon' => 'circle-o',
                            //             'url' => '#',
                            //             'items' => [
                            //                 ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                            //                 ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                            //             ],
                            //         ],
                            //     ],
                            // ],
                            /*['label' => 'Instrument Masters', 'icon' => '', 'url' => ['/instrument-master']],
                            ['label' => 'Machine Masters', 'icon' => '', 'url' => ['/machine-master']],*/
                            /*['label' => 'Forms', 'icon' => '', 'url' => ['/forms']],*/
                            /*['label' => 'Documents And Distribution Masters', 'icon' => '', 'url' => ['/documents-and-distribution-master']],*/
                        ],
                    ],
                    [
                        'label' => 'Raw Material',
                        'icon' => '  fa-mail-forward (alias)',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Bill Of Materials', 'icon' => '', 'url' => ['/bill-of-material']],
                            ['label' => 'Purchase Order', 'icon' => '', 'url' => ['/purchase-order']],
                            ['label' => 'Incomming QC', 'icon' => '', 'url' => ['/incomming-qc']],
                            ['label' => 'Raw Material Receipt', 'icon' => '', 'url' => ['/purchase-receipt']],
                            ['label' => 'Raw Material Inventory', 'icon' => '', 'url' => ['/purchase-inventory']],
                            /*['label' => 'Purchase BOM', 'icon' => '  fa-mail-forward (alias)', 'url' => ['/customer-complaint-record']],*/
                        ],
                    ],
                    [
                        'label' => 'Production',
                        'icon' => '  fa-mail-forward (alias)',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Job Card', 'icon' => '', 'url' => ['/jobcard']],
                        ],
                        [
                            'label' => 'In Process QC',
                            'icon' => '  fa-mail-forward (alias)',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Primary Inspection', 'icon' => '', 'url' => ['/purchase-order']],
                                ['label' => 'Incomming QC', 'icon' => '', 'url' => ['/incomming-qc']],
                            ],
                        ],
                    ],

                    ['label' => 'Product BOM', 'icon' => '  fa-mail-forward (alias)', 'url' => ['/customer-complaint-record']],

                    [
                        'label' => 'Planners',
                        'icon' => '  fa-mail-forward (alias)',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Inspection Planer', 'icon' => '', 'url' => ['/inspection-planer']],
//                            ['label' => 'Inspection & Testing Quality Plan One', 'icon' => '', 'url' => ['/itqt-one-planner']],
//                            ['label' => 'Inspection & Testing Quality Plan Two', 'icon' => '', 'url' => ['/itqt-two-planner']],
                            ['label' => 'DND Plan DSNs', 'icon' => '', 'url' => ['/dnd-plan-dsn']],
                            ['label' => 'Bill Of Material (BOM)', 'icon' => '', 'url' => ['/bill-of-material']],
                            [
                                'label' => 'MFG Inventory Tracker',
                                'icon' => '  fa-mail-forward (alias)',
                                'url' => '#',
                                'items' => [

                                    ['label' => 'Product MFG Tracker', 'icon' => '', 'url' => ['/product-mfg-tracker']],
                                    ['label' => 'Raw Materials MFG Tracker', 'icon' => '', 'url' => ['/raw-materials-mfg-tracker']],
                                    ['label' => 'BOM MFG Tracker', 'icon' => '', 'url' => ['/bom-mfg-tracker']],
                                    ['label' => 'Order MFG Tracker', 'icon' => '', 'url' => ['/order-mfg-tracker']],
                                    ['label' => 'Tranning Planner', 'icon' => '', 'url' => ['/training-planner']],

                                ],
                            ],

                        ],

                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
