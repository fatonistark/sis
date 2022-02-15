        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <?php 
                            $menu = $this->db->get_where('menus', array('role_id' => $this->session->userdata('role_id'), 'parrent_id' => NULL));

                            if ($menu->num_rows() > 0) {
                                foreach ($menu->result() as $mn) {
                                    $sub_menu = $this->db->get_where('menus', array('parrent_id' => $mn->id));
                                    
                                    echo '<li class="nav-small-cap"><span class="hide-menu">'.$mn->name.'</span></li>';
                                    if ($sub_menu->num_rows() > 0) {
                                        foreach ($sub_menu->result() as $sb) {
                                            echo '<li class="sidebar-item">
                                                    <a class="sidebar-link sidebar-link" href="'. base_url($this->session->userdata('role_slug').'/'.$sb->slug) .'" aria-expanded="false">
                                                        <i class="'.$sb->icon.'"></i>
                                                        <span class="hide-menu">'.$sb->name.'</span>
                                                    </a>
                                                </li>';
                                        }
                                    }
                                }
                            }
                        ?>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../../docs/docs.html"
                                aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                                    class="hide-menu">Documentation</span></a></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="_blank" data-toggle="modal" data-target="#modal-logout"
                                aria-expanded="false">
                                <i data-feather="log-out" class="feather-icon"></i>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-danger">
                        <h4 class="modal-title" id="warning-header-modalLabel">Logout
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin keluar dari aplikasi ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Ya</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>