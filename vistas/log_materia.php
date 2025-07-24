<?php
require 'header.php';
?>

<div class="content-wrapper">     
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Agregaciones registradas por Trigger</h1>
                    </div>

                    <div class="panel-body table-responsive">
                        <table id="tbllogs" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>ID Log</th>
                                    <th>Acción</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID Log</th>
                                    <th>Acción</th>
                                    <th>Fecha</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'footer.php';
?>
<script type="text/javascript" src="scripts/log_materia.js"></script>
