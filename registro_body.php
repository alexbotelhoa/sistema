<?php include 'conexao.php';?>
<style type="text/css">
body{
margin: 0px 0px 0px 0px;
padding: 0;
}
</style>
<center><br>
    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">

        <tr height="30" bgcolor="#f0f8ff">
            <td width="30" align="center">N°</td>
            <td width="150" align="center">Data Venda</td>
            <td width="100" align="center">VT Venda</td>
            <td width="100" align="center">VT Reposição</td>
            <td width="100" align="center">VT Imposto</td>
            <td width="100" align="center">VT Lucro</td>
        </tr>

        <?php

        $date = date_create();


        $sql = "SELECT * FROM se_venda ORDER BY vnd_id ASC";
        $consulta=mysqli_query($con, $sql); $x="1";
        while ($dados = mysqli_fetch_array($consulta)) {
            echo "<tr>
                    <td align='center'>".$x."</td>
                    <td align='center'>".date('H:i:s d/m/Y', $dados['vnd_data'])."</td>
                    <td align='center'>R$ ".number_format($dados['vnd_total'], 2, ',', '.')."</td>
                    <td align='center'>R$ ".number_format($dados['vnd_repos'], 2, ',', '.')."</td>
                    <td align='center'>R$ ".number_format($dados['vnd_impos'], 2, ',', '.')."</td>
                    <td align='center'>R$ ".number_format($dados['vnd_lucro'], 2, ',', '.')."</td>

                </tr>";
            $x++;} mysqli_close($con);
        ?>
    </table>
</center><br>