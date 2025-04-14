<?php 

    function template_header() {
        echo <<< EOT
            <body>
                <div class="container app">
                    <div class="row">
                        <div class="col">
                            <div class="container pagina pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <nav class="navbar navbar-expand-md navbar-light bg-light p-3 justify-content-between round">
                                            <div class="navbar-brand">
                                                <img class="mx-1 my-auto" src="img/logo.png" alt="logo" width="50">
                                                <a class="navbar-brand my-auto" href="#">Lista de Tarefas</a>
                                            </div>
                                            <form class="form-inline mx-4 my-auto" method="post" action="tarefa_controller.php?acao=create">	
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="inputNewTask" class="form-control mr-sm-2" type="text" name="tarefa" onkeyup="typed()" placeholder="Adicionar Tarefa">
                                                        <div class="input-group-append">
                                                            <button id="button" class="btn btn-info my-2 my-sm-0" type="submit" disabled>Adicionar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </nav>
                                        
                                    </div>
                                </div>
        EOT;
    }

    function template_footer() {
        echo <<< EOT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>						
                    </div>
                </body>
            </html>
        EOT;
    }
?>