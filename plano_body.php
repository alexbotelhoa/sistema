<br>
<?php
if (isset($_POST['add']) or isset($_POST['alt'])) {
    if ($_POST['nome'] == "" or $_POST['valor'] == "") {
        echo "<br><br><br><br><br>";
        echo "<center><font style='Arial' size='3' color='red'>Campos obrigatórios sem preenchimento!</font>";
        echo "<br><br><br><br><br>";
        echo "<meta http-equiv='refresh' content='2;URL=plano.php'>";
    } else {
        if (isset($_POST['add'])) {
            $nome = utf8_decode($_POST['nome']);
            $valor = str_replace(",", ".", $_POST['valor']);

            $sql = "INSERT INTO sm_planos (plan_nome,plan_valor) VALUES ('$nome','$valor')";
            mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na gravação dos dados</font>");
            //mysqli_close($con);

            echo "<br><br><br><br><br>";
            echo "<center><font style='Arial' size='3' color='green'>Produto adicionado com sucesso!</font>";
            echo "<br><br><br><br><br>";
            echo "<meta http-equiv='refresh' content='1;URL=plano.php'>";
        } else {
            $nome = utf8_decode($_POST['nome']);
            $valor = str_replace(",", ".", $_POST['valor']);

            $sql = "UPDATE sm_planos SET plan_nome='$nome',plan_valor='$valor' WHERE plan_id=$_GET[id]";
            mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na alteração dos dados</font>");
            //mysqli_close($con);

            echo "<br><br><br><br><br>";
            echo "<center><font style='Arial' size='3' color='green'>Produto alterado com sucesso!</font>";
            echo "<br><br><br><br><br>";
            echo "<meta http-equiv='refresh' content='1;URL=plano.php'>";
        }
    }
} else {
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM sm_planos WHERE plan_id=$_GET[id]";
        $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta dos dados</font>");
        $dados = mysqli_fetch_array($consulta);

        $nome = utf8_encode($dados['plan_nome']);
        $valor = $dados['plan_valor'];

    } else {
        $nome = "";
        $valor = "";
    }
    ?>
    <center>
        <font color="red" size="2">*Campos em vermelho são obrigatórios*</font>
        <form name="form" action='plano.php<?php if (isset($_GET['id'])) {
            echo "?id=" . $_GET['id'] . "";
        } ?>' method='POST'>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="40" bgcolor="#f0f8ff" align="center">Cadastro de Plano</td>
                </tr>
                <tr>
                    <td height="40">
                        <table border="0" cellpadding="0" cellspacing="0"
                               style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                            <tr height="30">
                                <td width="80" align="right"><font color="red">Nome:</font></td>
                                <td width="140"><input type="text" name="nome" maxlength="20" size="14"
                                                       value="<?php echo $nome ?>"></td>
                                <td width="80" align="right"><font color="red">Valor:</font></td>
                                <td width="90"><input type="text" class="money" name="valor" maxlength="8" size="5"
                                                      value="<?php echo $valor ?>"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <table border="0" width="300" cellspacing="0" cellpadding="0">
                <tr>
                    <?php
                    if (isset($_GET['id'])) {
                        echo "<td align='center'><input type='hidden' name='alt' value='1'><input class='button' type='Submit' value='Alterar'></form></td><form name='form' action='plano.php' method='POST'><td align='center'><input class='button' type='submit' value='Limpar'></td></form></form>";
                    } else {
                        echo "<td align='center'><input type='hidden' name='add' value='1'><input class='button' type='Submit' value='Salvar'></td><td align='center'><input class='button' type='reset' value='Limpar'></td></form>";
                    }
                    ?>
                </tr>
            </table>
            <br>
            <table border="1" cellpadding="0" cellspacing="0"
                   style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                <tr height="30" bgcolor="#f0f8ff">
                    <td width="140">&nbsp;&nbsp;Nome do Plano</td>
                    <td width="80" align="center">Valor (R$)</td>
                    <td width="80" align="center" colspan="2">Opções</td>
                </tr>
                <?php
                $sql = "SELECT * FROM sm_planos ORDER BY plan_nome ASC";
                $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta dos dados</font>");
                $x = "1";

                while ($dados = mysqli_fetch_array($consulta)) {
                    echo "<tr>
                    <td>&nbsp;&nbsp;" . utf8_encode($dados['plan_nome']) . "</td>
                    <td align='center'>" . moeda($dados['plan_valor']) . "</td>
                    <td align='center'><a href='plano.php?id=" . $dados['plan_id'] . "'><img src='imagens/site/alt.png'></a></td>
                    <td align='center'><img onclick='confirma(50)' src='imagens/site/del.png'></td>
                </tr>";
                    $x++;
                }
                mysqli_close($con);
                ?>
            </table>
            <br>
    </center>
    <?php
}
?>

