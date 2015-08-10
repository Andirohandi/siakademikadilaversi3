                        <li class="active">
                            <a href="<?=base_url()?>index.php/home"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>


                        <?php 
                            foreach ($this->model_menu->getAllMenugroups()->result() as $rows)  
                            {
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><?= $rows->nm_menu_groups?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <?php
                          
                            foreach ($this->model_menu->getAllMenudetails($rows->id_menu_groups, $session_level)->result() as $rows)  
                            {
                            ?>
                                <li>
                                    <a href="<?=base_url();?>index.php/<?= $rows->url?>"><?= $rows->nm_menu_details?></a>
                                </li>
                            <?php } ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>