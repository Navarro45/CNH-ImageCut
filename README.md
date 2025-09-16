Recorte Automático de Fotos de CNHs
Este projeto em PHP realiza automaticamente o recorte da foto da CNH a partir de imagens originais.
As imagens são carregadas da pasta `imagens/`, processadas, e os recortes são salvos na pasta `recorte_imagens/`.
Como funciona
1.	O script lê todas as imagens dentro da pasta `imagens/`.
2.	Para cada imagem encontrada:
-	Calcula automaticamente a área do rosto usando proporções pré-definidas.
-	Recorta essa região.
-	Salva o resultado na pasta `recorte_imagens/` com o prefixo `recorte_`.
3. Ao final, você terá apenas os rostos recortados das CNHs.
Estrutura de pastas
/ seu-projeto
imagens/ # Coloque aqui as imagens originais das CNHs
recorte_imagens/ # Aqui serão salvos os recortes gerados
script.php # Código principal em PHP
Requisitos
-	PHP instalado (>=7.4 recomendado)
-	Extensão GD habilitada (normalmente já vem por padrão) Para verificar se a GD está ativa, rode: php -m | grep gd
Se não aparecer, instale conforme seu sistema:
-	Ubuntu/Debian:
sudo apt-get install php-gd
-	Windows: habilite extension=gd no php.ini.
Como executar
1.	Coloque suas imagens dentro da pasta `imagens/`.
2.	Execute o script no terminal:
php script.php
3.	Os recortes serão salvos automaticamente na pasta `recorte_imagens/`.
Observações
-	Atualmente o script foi configurado para JPG/JPEG.
-	Se quiser suporte a PNG ou outros formatos, basta ajustar a função de carregamento de imagem no código.
-	Certifique-se de que as pastas `imagens/` e `recorte_imagens/` tenham permissão de leitura e escrita.
Exemplo de saída
Entrada (na pasta imagens/):
cnh1.jpg cnh2.jpg
Saída (na pasta recorte_imagens/):
recorte_cnh1.jpg
recorte_cnh2.jpg
Desenvolvido para facilitar o processamento de imagens de CNHs de forma rápida e automatizada.
