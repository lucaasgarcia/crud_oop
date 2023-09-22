<?php
    $mensagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']) {
            case 'sucess':
                $mensagem = '<div class="alert alert-success">Acao executada com sucesso!</div>';
                break;
            case 'error':
                $mensagem = '<div class="alert alert-danger">Acao nao executada!</div>';
                break;
        }
    }

    $resultados =  '';
    foreach ($vagas as $vaga){
        $resultados .='<tr>
                        <td>'.$vaga->id.'</td>
                        <td>'.$vaga->titulo.'</td>
                        <td>'.$vaga->descricao.'</td>
                        <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo' ).'</td>
                        <td>'.date('d/m/Y à\s H:i:s', strtotime($vaga->data)).'</td>
                        <td>
                            <a href="editar.php?id='.$vaga->id.'">
                                <button type="button" class="btn btn-primary">Editar</button>
                            </a>
                            <a href="excluir.php?id='.$vaga->id.'">
                                <button type="button" class="btn btn-danger">Excluir</button>
                            </a>
                        </td>
                       </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="6" class="text-center">
                                                               Nenhum registro encontrado
                                                               </td>
                                                        </tr>'

?>
<main>

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button type="button" class="btn btn-success">Nova registro</button>
        </a>
    </section>

    <section>

        <form method="get">
            <div class="row my-4">

                <div class="col">
                    <label>Buscar por titulo</label>
                    <input type="text" name="busca" class="form-control" value="<?=$busca?>">
                </div>

                <div class="col">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">Todos</option>
                        <option value="s">Ativa</option>
                        <option value="n">Inativa</option>
                    </select>
                </div>
                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>

            </div>
        </form>


    </section>

    <section>

        <table class="table bg-light mt-3">
            <thead>
                <tr>
                   <th>ID</th>
                   <th>Título</th>
                   <th>Descricao</th>
                   <th>Status</th>
                   <th>Data</th>
                   <th>Acoes</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>

    </section>
</main>