<?php
if (isset($_POST['add']) or isset($_POST['alt'])) {
    if ($_POST['ncm'] == "" or $_POST['desc'] == "" or $_POST['desc'] == "") {
        echo "<br><br><br><br><br>";
        echo "<center><font style='Arial' size='3' color='red'>Campos obrigatórios sem preenchimento!</font><br>";
        echo "<br><br><br><br><br>";
        echo "<meta http-equiv='refresh' content='2;URL=produto.php'>";
    } else {
        if (isset($_POST['add'])) {
            $ncm = $_POST['ncm'];
            $desc = utf8_decode($_POST['desc']);
            $valor = str_replace(",", ".", $_POST['valor']);
            $pis = str_replace(",", ".", $_POST['pis']);
            $cofins = str_replace(",", ".", $_POST['cofins']);
            $icms = str_replace(",", ".", $_POST['icms']);
            $ipi = str_replace(",", ".", $_POST['ipi']);
            $lucro = str_replace(",", ".", $_POST['lucro']);

            $sql = "INSERT INTO se_produtos (pdt_ncm,pdt_desc,pdt_valor,pdt_pis,pdt_cofins,pdt_icms,pdt_ipi,pdt_lucro) VALUES ('$ncm','$desc','$valor','$pis','$cofins','$icms','$ipi','$lucro')";
            mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na gravação dos dados</font>");
            mysqli_close($con);

            echo "<br><br><br><br><br>";
            echo "<center><font style='Arial' size='3' color='green'>Produto adicionado com sucesso!</font><br>";
            echo "<br><br><br><br><br>";
            echo "<meta http-equiv='refresh' content='1;URL=produto.php'>";
        } else {
            $ncm = $_POST['ncm'];
            $desc = utf8_decode($_POST['desc']);
            $valor = str_replace(",", ".", $_POST['valor']);
            $pis = str_replace(",", ".", $_POST['pis']);
            $cofins = str_replace(",", ".", $_POST['cofins']);
            $icms = str_replace(",", ".", $_POST['icms']);
            $ipi = str_replace(",", ".", $_POST['ipi']);
            $lucro = str_replace(",", ".", $_POST['lucro']);

            $sql = "UPDATE se_produtos SET pdt_ncm='$ncm',pdt_desc='$desc',pdt_valor='$valor',pdt_pis='$pis',pdt_cofins='$cofins',pdt_icms='$icms',pdt_ipi='$ipi',pdt_lucro='$lucro' WHERE pdt_id=$_GET[id]";
            mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na gravação dos dados</font>");
            mysqli_close($con);

            echo "<br><br><br><br><br>";
            echo "<center><font style='Arial' size='3' color='green'>Produto alterado com sucesso!</font><br>";
            echo "<br><br><br><br><br>";
            echo "<meta http-equiv='refresh' content='1;URL=produto.php'>";
        }
    }
} else {
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM se_produtos WHERE pdt_id=$_GET[id]";
        $consulta = mysqli_query($con, $sql);
        $dados = mysqli_fetch_array($consulta);

        $ncm = $dados['pdt_ncm'];
        $desc = $dados['pdt_desc'];
        $valor = $dados['pdt_valor'];
        $pis = $dados['pdt_pis'];
        $cofins = $dados['pdt_cofins'];
        $icms = $dados['pdt_icms'];
        $ipi = $dados['pdt_ipi'];
        $lucro = $dados['pdt_lucro'];

    } else {
        $ncm = "";
        $desc = "";
        $valor = "";
        $pis = "";
        $cofins = "";
        $icms = "";
        $ipi = "";
        $lucro = "";
    }
?>
    <script type="text/javascript">
        function confirma(id) {
            var confimar = confirm("Função de exclusão ainda não desenvolvida!");
            if(confirmar){
                window.location = 'produto.php';
            }
        }
    </script>
<center>
    <font color="red" size="2">*Campos em vermelho são obrigatórios*</font>
    <form name="form" action='produto.php<?php if (isset($_GET['id'])) {echo "?id=".$_GET['id']."";} ?>' method='POST'>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="30" bgcolor="#f0f8ff">&nbsp;Cadastro de Produto:</td>
            </tr>
            <tr>
                <td height="35">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                        <tr height="30">
                            <td width="45" align="right"><font color="red">NCM:</font></td>
                            <td width="90"><input type="text" class="ncm" name="ncm" maxlength="8" size="8" value="<?php echo $ncm ?>"></td>
                            <td width="75" align="right"><font color="red">Descrição:</font></td>
                            <td width="455"><input type="text" name="desc" maxlength="300" size="60" value="<?php echo $desc ?>"></td>
                            <td width="45" align="right"><font color="red">Valor:</font></td>
                            <td width="90"><input type="text" class="money" name="valor" maxlength="8" size="7" value="<?php echo $valor ?>"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="30" bgcolor="#f0f8ff">&nbsp;Acréscimos no valor:</td>
            </tr>
            <tr>
                <td height="35">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                        <tr>
                            <td width="35" align="right">PIS:</td>
                            <td width="100"><input type="text" class="percent" name="pis" maxlength="6" size="5" value="<?php echo $pis ?>">&nbsp;%
                            </td>
                            <td width="65" align="right">Cofins:</td>
                            <td width="100"><input type="text" class="percent" name="cofins" maxlength="6" size="5" value="<?php echo $cofins ?>">&nbsp;%
                            </td>
                            <td width="45" align="right">ICMS:</td>
                            <td width="100"><input type="text" class="percent" name="icms" maxlength="6" size="5" value="<?php echo $icms ?>">&nbsp;%
                            </td>
                            <td width="35" align="right">IPI:</td>
                            <td width="100"><input type="text" class="percent" name="ipi" maxlength="6" size="5" value="<?php echo $ipi ?>">&nbsp;%
                            </td>
                            <td width="45" align="right">Lucro:</td>
                            <td width="100"><input type="text" class="percent" name="lucro" maxlength="6" size="5" value="<?php echo $lucro ?>">&nbsp;%
                            </td>
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
                        echo "<td align='center'><input type='hidden' name='alt' value='1'><input class='button' type='Submit' value='Alterar'></form></td><form name='form' action='produto.php' method='POST'><td align='center'><input class='button' type='submit' value='Voltar'></td></form></form>";
                    } else {
                        echo "<td align='center'><input type='hidden' name='add' value='1'><input class='button' type='Submit' value='Salvar'></td><td align='center'><input class='button' type='reset' value='Limpar'></td></form>";
                    }
                ?>
            </tr>
        </table>

    <br>
    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
        <tr height="30" bgcolor="#f0f8ff">
            <td width="30" align="center">N°</td>
            <td width="90" align="center">NCM</td>
            <td width="400">&nbsp;&nbsp;Descrição</td>
            <td width="80" align="center">Valor</td>
            <td width="60" align="center">PIS</td>
            <td width="60" align="center">Cofins</td>
            <td width="60" align="center">ICMS</td>
            <td width="60" align="center">IPI</td>
            <td width="60" align="center">Lucro</td>
            <td width="80" align="center" colspan="2">Opções</td>
        </tr>
        <?php
            $sql = "SELECT * FROM se_produtos order by pdt_desc ASC";
            $consulta=mysqli_query($con, $sql); $x="1";
            while ($dados = mysqli_fetch_array($consulta)) {
                echo "<tr>
                    <td align='center'>".$x."</td>
                    <td align='center'>".$dados['pdt_ncm']."</td>
                    <td>&nbsp;&nbsp;".utf8_encode($dados['pdt_desc'])."</td>
                    <td align='center'>".$dados['pdt_valor']."</td>
                    <td align='center'>".$dados['pdt_pis']."</td>
                    <td align='center'>".$dados['pdt_cofins']."</td>
                    <td align='center'>".$dados['pdt_icms']."</td>
                    <td align='center'>".$dados['pdt_ipi']."</td>
                    <td align='center'>".$dados['pdt_lucro']."</td>
                    <td align='center'><a href='produto.php?id=".$dados['pdt_id']."'><img src='imagens/site/alt.png'></a></td>
                    <td align='center'><img onclick='confirma(50)' src='imagens/site/del.png'></td>
                </tr>";
            $x++;} mysqli_close($con);
        ?>
    </table>
<br>
</center>
    <?php
}
    ?>