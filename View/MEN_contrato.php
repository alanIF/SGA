<?php
include("head.php");
?>
<script type="text/javascript">
  function confirmar(){
    // só permitirá o envio se o usuário responder OK
    var resposta = window.confirm("Deseja mesmo" + 
                   " excluir este aluguel?");
    if(resposta)
      return true;
    else
      return false; 
  }

// Início do código de Aumentar/ Diminuir a letra
 
// Para usar coloque o comando:
// "javascript:mudaTamanho('tag_ou_id_alvo', -1);" para diminuir
// e o comando "javascript:mudaTamanho('tag_ou_id_alvo', +1);" para aumentar
 
var tagAlvo = new Array('p'); //pega todas as tags p//
 
// Especificando os possíveis tamanhos de fontes, poderia ser: x-small, small...
var tamanhos = new Array('14px','15px','16px','17px','18px' );
var tamanhoInicial = 2;
 
function mudaTamanho( idAlvo,acao ){
if (!document.getElementById) return
var selecionados = null,tamanho = tamanhoInicial,i,j,tagsAlvo;
tamanho += acao;
if ( tamanho < 0 ) tamanho = 0;
if ( tamanho > 6 ) tamanho = 6;
tamanhoInicial = tamanho;
if ( !( selecionados = document.getElementById( idAlvo ) ) ) selecionados = document.getElementsByTagName( idAlvo )[ 0 ];
 
selecionados.style.fontSize = tamanhos[ tamanho ];
 
for ( i = 0; i < tagAlvo.length; i++ ){
tagsAlvo = selecionados.getElementsByTagName( tagAlvo[ i ] );
for ( j = 0; j < tagsAlvo.length; j++ ) tagsAlvo[ j ].style.fontSize = tamanhos[ tamanho ];
}
}
// Fim do código de Aumentar/ Diminuir a letra
 
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="texto">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->

                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-12 connectedSortable">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Contrato:
                            <?php
                                 if (isset($_GET['id_inquilino'])){
                    $id_inquilino = (int)$_GET['id_inquilino'];
                    $idUsu = $_SESSION['idUSU'];
                    $conn = F_conect();
                    $result = mysqli_query($conn, "Select * from iquilino where id_usuario=" . $idUsu." and id=".$id_inquilino);
                      if (mysqli_num_rows($result) >=1){
                            while ($row = $result->fetch_assoc()) {
                                $nome_inquilino=$row['nome'];
                                $email=$row['email'];
                                $telefone=$row['telefone'];
                             }
                             echo $nome_inquilino;
                      }else{
                         
                          echo "<script language= 'JavaScript'>
                                        location.href='erro.php'
                                </script>";
                      }
                        $conn->close();

                }else{
                    echo "<script language= 'JavaScript'>
                                        location.href='erro.php'
                                </script>";
        
                }
                            
                            ?>
                            -
                              <?php
                if (isset($_GET['id_propriedade'])){
                    $id_propriedade = (int)$_GET['id_propriedade'];
                    $conn = F_conect();
                    $result = mysqli_query($conn, "SELECT * FROM propriedade WHERE id_proprietario=" . $idUsu." and id=".$id_propriedade);
                      if (mysqli_num_rows($result) ==1){
                            while ($row = $result->fetch_assoc()) {
                                $rua = $row['rua'];
                                $bairro = $row['bairro'];
                                $cidade = $row['cidade'];
                                $cep = $row['cep'];
                                $situacao = $row['situacao'];
                                $obs = $row['observacao'];
                                $numero = $row['numero'];
                             }
                             echo $numero.",".$rua.",".$bairro.",".$cidade;
                      }else{
                         
                          echo "<script language= 'JavaScript'>
                                        location.href='erro.php'
                                </script>";
                      }
                        $conn->close();
                }else{
                    echo "<script language= 'JavaScript'>
                                        location.href='erro.php'
                                </script>";
        
    }
          ?>
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Situação</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once '../Controller/MensalidadeController.php';
                                    $objControl = new MensalidadeController();
                                    $objControl->mensalidades( $id_propriedade,$id_inquilino);
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> <a href="MEN_cadMensalidade.php?id_inquilino=<?php echo $id_inquilino;?>&id_propriedade=<?php echo $id_propriedade;?>"><i class="fa fa-plus-square" aria-hidden="true"></i></a></th>
                                        <th></th>   
                                    </tr>
                                </tfoot>
                            </table>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-question" aria-hidden="true"></i>
</button>
<button type="button" onClick="javascript:window.history.go(-1);" class="btn btn-info">Voltar</button>
        <a href="javascript:mudaTamanho('texto', 1);">+<i class="fa fa-font fa-2x" aria-hidden="true"></i></a>
        <a href="javascript:mudaTamanho('texto', -1);">-<i class="fa fa-font fa-1x" aria-hidden="true"></i> </a>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Minhas Mensalidades</h4>
      </div>
      <div class="modal-body">
          <p>Aqui estão listadas as mensalidades do contrato, para realizar o pagamento da mensalidade clique no ícone <i class="fa fa-credit-card"></i>.
          </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
                        </div>
                        <!-- /.box-body -->
                    </div>


                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<?php
include("foot.php");
?>



