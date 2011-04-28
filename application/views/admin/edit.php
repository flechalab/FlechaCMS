                        <?php
                        $url_edit = '/' . $this->uri->uri_string() . '/divs/' . $div['div_id'];
                        $url_del  = $url_edit . '/del';
                        ?>

                        <div class="edit-block radius-all">
                            <div>Configurações do Bloco (<?php echo $div['div_id'] ?>):</div>
                            <ul>
                                <li><a href="<?php echo $url_edit ?>">
                                    <span class="ui-icon ui-icon-pencil"></span>Editar</a></li>

                                <li><a href="<?php echo $url_del ?>">
                                    <span class="ui-icon ui-icon-trash"></span>Excluir</a></li>
                            </ul>
                            <br class="clear" />
                        </div>

