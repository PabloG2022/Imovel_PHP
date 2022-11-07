<!doctype HTML> 

<html lang="pt-br">
	<head>
		<title>Gravando Imovél</title>
		<meta charset="UTF-8">
	</head>
    
    <body>
        <?php
        
		$nome 			  = 	$_POST["nome"];
		$email 			  = 	$_POST["email"];
		$telefone 		  = 	$_POST["telefone"];
        $tipo 		      = 	$_POST["tipo"];
        $operacao         = 	$_POST["operacao"];
        $registro         = 	$_POST["registro"];
        $data             = 	$_POST["data"];
        $valor            = 	$_POST["valor"];
        
        
        $desocupado = 1; 
		if ( isset($_POST["desocupado"]) )
		{
			$desocupado = $_POST["desocupado"];
		}

        $foto 		= $_FILES["foto"]["name"];
		$tipoFoto 	= $_FILES["foto"]["type"];
		$tamanho 	= $_FILES["foto"]["size"];
		$nomeTmp	= $_FILES["foto"]["tmp_name"];

        $descricao 	    = 	$_POST["descricao"];
        
        
        if ($nome=="")
		{
			die("Nome do proprietário deve ser informado!");
		}

        if ($telefone=="")
		{
			die("Telefone do proprietário deve ser informado!");
		}   
        
        if ($tipo=="")
		{
			die("Tipo de Imóvel deve ser escolhido!");
		}

        if ($operacao=="")
		{
			die("Tipo de Operação deve ser selecionada!");
		}

       
		if ($valor < 0)
		{
		   die("Valor não pode ser menor que zero.");
		} 

        
        if ($nomeTmp < 2)
		{
			die("Deve ser informado no mìnimo 2 fotos da propriedade!");
		}

        if ($descricao=="")
		{
			die("Descrição do imóvel deve ser informada!");
		}

        
        echo "<h1>Guilherme Brito de Oliveira - 30238455</h1>";
        echo "Nome do proprietário é: $nome";
        echo "E-mail do proprietário é: $email";
        echo "Telefone do proprietário é: $telefone";
        echo "O tipo de imóvel é: $tipo";
        echo "O Tipo de Operação é: $operacao";
        echo "Número e local de registro da escritura: $registro";
        echo "Data da escritura do imóvel:$data";
        echo "Valor pretendido: $valor";
        echo "Imóvel está desocupado? $desocupado";

        echo "Foto: $foto<br>";
		echo "Tipo: $tipoFoto<br>";
		echo "Tamanho: $tamanho<br>";
		echo "Nome Temporário: $nomeTmp<br>";

        echo "<fieldset>"; 
		echo "<legend>Prontuário</legend>";
		echo "$descricao</fieldset>";
		echo "<hr>";

        
        $con = mysqli_connect("Cadastro.html", "admin", "123") ;
		
        
		mysqli_select_db($con, "SGP") or 
        die("Erro na abertura do banco:" .
            mysqli_error($con) );

        
        $sql = "INSERT INTO cadastro(
                            nome,
                            email,
                            telefone,
                            tipo,
                            operacao,
                            registro,
                            data,
                            valor,
                            ocupado,
                            fotos,
                            descricao)
                VALUES(
                            $nome,
                            $email,
                            $telefone,
                            $tipo,
                            $operacao,
                            $registro,
                            $data,
                            $valor,
                            $desocupado,
                            $foto,
                            $descricao)";

        
        mysqli_query($con, $sql) or
			die("Erro na inserção do imóvel" .
					mysqli_error($sql) );
        
       

        if ($foto<>"")
		{
            $destino= "arquivos\.$foto";
            echo "Transferindo de $nomeTmp para $destino...<br>";
            move_uploaded_file($nomeTmp, $destino) or die ("Erro na transferência: ". $_FILES["file"["error"]]);
        }

        
        echo "<hr> Imóvel de $nome cadastrado com sucesso!<hr>";
        ?>

Clique <a href="Cadastro.html">aqui</a> para cadastrar um novo Imóvel
    </body>
</html>