<?php 
    function calcularRecorteFotoCNH($largura_total, $altura_total) {
        
        if($altura_total > $largura_total){
            // CNH em pé
            $altura_recorte = $largura_total * 0.55;
            $largura_recorte = $altura_total * 0.35;  
            
            $x_origem = $largura_total * 0.19;
            $y_origem = $altura_total * 0.25;
        } else {
            // CNH deitada
            $largura_recorte = $largura_total * 0.35;
            $altura_recorte = $altura_total * 0.469;  
            
            $x_origem = $largura_total * 0.144;
            $y_origem = $altura_total * 0.385;
        }

        return [
            'x_inicial' => $x_origem,
            'y_inicial' => $y_origem,
            'largura_foto' => $largura_recorte,
            'altura_foto' => $altura_recorte
        ];
    }

    $caminho_imagem = 'imagens/';
    $arquivos = scandir($caminho_imagem);

    foreach ($arquivos as $arquivo) {

        if ($arquivo === '.' || $arquivo === '..') {
            continue;
        }

        $caminho_completo = $caminho_imagem . $arquivo;

        echo "Arquivo: " . $arquivo . "\n"; 
        echo "Caminho completo: " . $caminho_completo . "\n"; 

        if (!file_exists($caminho_completo) || !is_readable($caminho_completo)) {
            echo "\nArquivo não acessível: $arquivo";
            continue;
        }

        // Carregar imagem
        $imagem = file_get_contents($caminho_completo);
        $src_imagem = imagecreatefromstring($imagem);

        if (!$src_imagem) {
            echo "\nErro ao carregar imagem: $arquivo";
            continue;
        }

        list($largura, $altura) = getimagesize($caminho_completo);
        echo "Altura: $altura - Largura: $largura\n";

        // Calcular recorte
        $recorte = calcularRecorteFotoCNH($largura, $altura);
        $x_origem = $recorte['x_inicial'];
        $y_origem = $recorte['y_inicial'];
        $largura_recorte = $recorte['largura_foto'];
        $altura_recorte = $recorte['altura_foto'];

        // Criar nova imagem recortada
        $nova_imagem = imagecreatetruecolor($largura_recorte, $altura_recorte);
        imagecopyresampled(
            $nova_imagem,
            $src_imagem,
            0, 0,
            $x_origem, $y_origem,
            $largura_recorte, $altura_recorte,
            $largura_recorte, $altura_recorte
        );

        // Salvar recorte
        $novo_nome = 'recorte_imagens/recorte_' . $arquivo;
        imagejpeg($nova_imagem, $novo_nome);

        echo "\nImagem recortada e salva como $novo_nome.\n";

        // Liberar memória
        imagedestroy($src_imagem);
        imagedestroy($nova_imagem);
    }
?>
